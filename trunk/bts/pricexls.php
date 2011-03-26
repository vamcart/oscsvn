<?php
    require('price_settings.php');
    require_once('includes/application_top.php');
    require_once('Worksheet.php');
    require_once('Workbook.php'); 

function tep_iconv($text) {

    if (function_exists('iconv')) {
       return iconv('UTF-8', 'WINDOWS-1251', $text); 
    } else {
      return $text;
    }
  }

// есть у группы продукты?
// group have products?
function check_products($id_group){
	$products_price_query = tep_db_query("select products_to_categories.products_id FROM products_to_categories where products_to_categories.categories_id = ".$id_group." LIMIT 0,1");
	if($products_price = tep_db_fetch_array($products_price_query)){
		return true;	
	}
	return false;
}

// выводим список продуктов определенной группы $id_group
// list products determined group
function get_products($id_group,$count){
	global $currencies;
	global $worksheet1;
	global $formatg;
	global $formatp;
	global $languages_id;
	
	$query = "";
	if(!SHOW_MARKED_OUT_STOCK){
		$query = " and products.products_status = 1";
	}
	$products_price_query = tep_db_query("select products_description.products_name, products_tax_class_id, products.products_quantity, products.products_price, products.products_model, products_to_categories.products_id, products_to_categories.categories_id FROM products, products_description, products_to_categories where products.products_id = products_description.products_id".$query." and products.products_id = products_to_categories.products_id and products_to_categories.categories_id = ".$id_group." and products_description.language_id = ".$languages_id);
	$x=0;
	while ($products_price = tep_db_fetch_array($products_price_query)){

	//TotalB2B start & TotalB2B start

	if ($new_price = tep_get_products_special_price($products_price['products_id'])) {
     $products_price['products_price'] = $new_price; // Обычная цена
     $products_price['specials_new_products_price'] = tep_xppp_getproductprice($products_price['products_id']); // Спец. цена
	  $cell = tep_iconv($currencies->display_price_nodiscount($products_price['products_price'], tep_get_tax_rate($products_price['products_tax_class_id'])));
    } else {
     $products_price['products_price'] = $new_price; // Обычная цена
     $products_price['specials_new_products_price'] = tep_xppp_getproductprice($products_price['products_id']); // Спец. цена
	  $cell = tep_iconv($currencies->display_price($products_price['specials_new_products_price'], tep_get_tax_rate($products_price['products_tax_class_id'])));
    }


//		$cell = tep_get_products_special_price($products_price['products_id']);
//		if($cell == 0)
//			$cell = $products_price['products_price'];

         // BOF FlyOpenair: Extra Product Price
//         $cell = extra_product_price($cell);
         // EOF FlyOpenair: Extra Product Price
			
//		$cell = $currencies->display_price($cell,TAX_INCREASE);
				
		$quantity = "";
		$model = "";
		if(SHOW_QUANTITY)
			$quantity = "(".$products_price['products_quantity'].")";
		if(SHOW_MODEL)
			$model = "[".$products_price['products_model']."]";
		$worksheet1->write_string($count, 0, "",$formatg);
		$worksheet1->write_string($count, 1, $model,$formatg);
		$worksheet1->write_string($count, 2, preg_replace("/&quot;/","\"",preg_replace("/&#39/","'",tep_iconv($products_price['products_name']))),$formatg);
		$worksheet1->write_string($count, 3, $quantity,$formatp);
		$worksheet1->write_string($count, 4, $cell ,$formatp);
		$count++;
	}
	return $count-1;
}

// рекурсивная функция, получает группы по порядку
// get all groups
function get_group($id_parent,$position){
	global $workbook;
	global $worksheet1;
	global $formatot;
	global $formatg;
	
global $languages_id;
$groups_price_query = tep_db_query("select categories.categories_id, categories_description.categories_name from
categories, categories_description where categories_status=1 and categories.categories_id = categories_description.categories_id and
categories.parent_id = ".$id_parent." and categories_description.language_id = '" . (int)$languages_id . "' order by
categories.sort_order");

	static $count = 1;
	while ($groups_price = tep_db_fetch_array($groups_price_query)){
		if($position == 0 && $count != 1) {
			$worksheet1->write_string($count, 0, "", $formatg);
			$worksheet1->write_string($count, 1, "", $formatg);
			$worksheet1->write_string($count, 2, "", $formatg);
			$worksheet1->write_string($count, 3, "", $formatg);
			$worksheet1->write_string($count, 4, "", $formatg);
			$count++;
		}
		if(check_products($groups_price['categories_id']) || $position == 0){
			$worksheet1->write_string($count, $position, $str.tep_iconv($groups_price['categories_name']),$formatot);
			if($position == 0){
				$worksheet1->write_string($count, 2, "",$formatg);
			}
			$worksheet1->write_string($count, 3, "",$formatg);
			$worksheet1->write_string($count, 4, "",$formatg);
			$count++;
			$count = get_products($groups_price['categories_id'],$count);
		}else{
			$count--;
		}
		$count++;
		get_group($groups_price['categories_id'],$position+1); // следующая группа
	}
}

  $workbook = new Workbook(FILE_NAME_PRICE.".xls");
  $worksheet1 =&$workbook->add_worksheet(tep_iconv('Прайс-лист'));
      
  $formatot =& $workbook->add_format();
  $formatot->set_size(10);
  $formatot->set_align('left');
  $formatot->set_color('black');
  $formatot->set_bold();
  $formatot->set_pattern(0);
  $formatot->set_fg_color('white');

  $formatg =& $workbook->add_format();
  $formatg->set_size(10);
  $formatg->set_align('left');
  $formatg->set_color('black');
  $formatg->set_fg_color('white');
  $formatg->set_pattern(0);
  
  $formatp =& $workbook->add_format();
  $formatp->set_size(10);
  $formatp->set_align('left');
  $formatp->set_color('black');
  $formatp->set_fg_color('white');
  $formatp->set_pattern(0);
  
  $form =& $workbook->add_format();
  $form->set_size(12);
  $form->set_bold();
  $form->set_align('center');
  $form->set_color('black');
  $form->set_fg_color('white');
  $form->set_pattern(0);

  $worksheet1->set_row(0, 30);
  $worksheet1->write_string(0, 0, "",$formatot);
  $worksheet1->write_string(0, 1, "",$formatot);
  $worksheet1->write_string(0, 2, HTTP_SERVER,$form);
  $worksheet1->write_string(0, 3, "",$formatot);
  $worksheet1->write_string(0, 4, "",$formatot);

  $worksheet1->set_column(0, 0, 23);
  if(SHOW_MODEL){
  	$worksheet1->set_column(1, 1, 10);
  }else{
  	$worksheet1->set_column(1, 1, 5);
  }
  $worksheet1->set_column(2, 2, 60);
  $worksheet1->set_column(3, 3, 10);
  $worksheet1->set_column(4, 4, 20);
  get_group(0,0);
  $workbook->close();
  
  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=".FILE_NAME_PRICE.".xls");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Pragma: public");
  
  $blah = readfile(DIR_FS_CATALOG.FILE_NAME_PRICE.".xls");
  echo $blah[0];
?>
