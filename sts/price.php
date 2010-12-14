<?php
   require('includes/application_top.php');
	require('price_settings.php');
	// the following cPath references come from application_top.php
	$category_depth = 'top';
	if (isset($cPath) && tep_not_null($cPath)) {
		$categories_products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
		$cateqories_products = tep_db_fetch_array($categories_products_query);
		if ($cateqories_products['total'] > 0) {
			$category_depth = 'products'; // display products
		} else {
			$category_parent_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$current_category_id . "'");
			$category_parent = tep_db_fetch_array($category_parent_query);
			if ($category_parent['total'] > 0) {
				$category_depth = 'nested'; // navigate through the categories
			} else {
				$category_depth = 'products'; // category has no products, but display the 'no products' message
			}
		}
	}
	require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRICE_HTML);
	$breadcrumb->add(TITLE_PRICE, tep_href_link("price.php", '', 'SSL')); 
?>

<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"> 
<?php
// BOF: WebMakers.com Changed: Header Tag Controller v1.0
// Replaced by header_tags.php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <title><?php echo TITLE ?></title>
<?php
}
// EOF: WebMakers.com Changed: Header Tag Controller v1.0
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
	<!-- header //-->
		<?php require(DIR_WS_INCLUDES . 'header.php');?>
	<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		<td width="<?php echo BOX_WIDTH; ?>" valign="top">
			<table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
				<!-- left_navigation //-->
					<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
				<!-- left_navigation_eof //-->
			</table>
		</td>
		<!-- body_text //-->
		<td valign="top">
			<table border="0" cellspacing="0" cellpadding="2">
      <tr> 
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0"> 
          <tr>
            <td class="pageHeading"><?php echo TITLE_PRICE; ?></td>
            <td align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_specials.gif', TITLE_PRICE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td> 
      </tr>
  				<tr>
    				<td>
<?php 
// есть у группы продукты?
// group have products?
function check_products($id_group){
	$products_price_query = tep_db_query("select products_to_categories.products_id FROM products_to_categories where products_to_categories.categories_id = ".$id_group." LIMIT 0,1");
	if(tep_db_fetch_array($products_price_query)){
		return true;	
	}
	return false;
}

// выводим список продуктов определенной группы $id_group
// list products determined group
function get_products($id_group){
	global $currencies;
	global $languages_id;
	
	$query = "";
	if(!SHOW_MARKED_OUT_STOCK){
		$query = " and products.products_status = 1";
	}
	if(USED_QUANTITY){
		$query = $query." and products.products_quantity <> 0";
	}
	$products_price_query = tep_db_query("select products_description.products_name, products_tax_class_id, products.products_quantity, products.products_price, products.products_model, products_to_categories.products_id, products_to_categories.categories_id FROM products, products_description, products_to_categories where products.products_id = products_description.products_id".$query." and products.products_id = products_to_categories.products_id and products_to_categories.categories_id = ".$id_group." and products_description.language_id = ".$languages_id);
	$x=0;
	while ($products_price = tep_db_fetch_array($products_price_query)){
		if($x==1) {
			$col = "#ffffff";
			$x = 0;	
		}else{
			$col = "#e5e5e5";
			$x++;
		}

	//TotalB2B start & TotalB2B start

	if ($new_price = tep_get_products_special_price($products_price['products_id'])) {
    $col = "#FFEAEA";
     $products_price['products_price'] = $new_price; // Обычная цена
     $products_price['specials_new_products_price'] = tep_xppp_getproductprice($products_price['products_id']); // Спец. цена
	  $cell = $currencies->display_price_nodiscount($products_price['products_price'], tep_get_tax_rate($products_price['products_tax_class_id']));
    } else {
     $products_price['products_price'] = $new_price; // Обычная цена
     $products_price['specials_new_products_price'] = tep_xppp_getproductprice($products_price['products_id']); // Спец. цена
	  $cell = $currencies->display_price($products_price['specials_new_products_price'], tep_get_tax_rate($products_price['products_tax_class_id']));
    }


//		$cell = tep_get_products_special_price($products_price['products_id']);
//		if($cell == 0)
//			$cell = $products_price['products_price'];

         // BOF FlyOpenair: Extra Product Price
//         $cell = extra_product_price($cell);
         // EOF FlyOpenair: Extra Product Price
			
//		$cell = $currencies->display_price($cell,TAX_INCREASE);

//		}else{
//			$col = "#FFEAEA";
//		}
		$quantity = "";
		$model = "";
		if(SHOW_QUANTITY)
			$quantity = "<td width=\"100\" align=\"right\" class=\"boxText\">(".$products_price['products_quantity'].")</td>";
		if(SHOW_MODEL)
			$model = "<td width=\"100\" align=\"right\" class=\"boxText\">[".$products_price['products_model']."]</td>";
		print "<tr bgcolor=\"".$col."\">".$model."<td width=\"80%\" class=\"boxText\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"" . tep_href_link(FILENAME_PRODUCT_INFO, "products_id=" . $products_price['products_id']) . "\">".$products_price['products_name']."</a></td>".$quantity."<td width=\"20%\" align=\"right\" class=\"boxText\">".$cell."</td></tr>";
	}
}

// рекурсивная функция, получает группы по порядку
// get all groups
function get_group($id_parent,$position){
global $languages_id;
$groups_price_query = tep_db_query("select categories.categories_id, categories_description.categories_name from
categories, categories_description where categories_status=1 and categories.categories_id = categories_description.categories_id and
categories.parent_id = ".$id_parent." and categories_description.language_id = '" . (int)$languages_id . "' order by
categories.sort_order");

	while ($groups_price = tep_db_fetch_array($groups_price_query)){
		$str = "";
		for($i = 0; $i < $position; $i++){
			$str = $str . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		}
		$class = "productListing-heading";
		if($position == 0) {
			$class = "headerNavigation";
			print "<tr><td colspan=\"4\" width=\"1000\" class=\"boxText\">&nbsp;</td></tr>"; // пустая строка
		}
		if(check_products($groups_price['categories_id']) || $position == 0){
			print "<tr><td colspan=\"4\" width=\"1000\" class=\"infoBoxHeading\"><font color=\"black\">".$str.$groups_price['categories_name']."</font></td></tr>";
			get_products($groups_price['categories_id']);
		}
		get_group($groups_price['categories_id'],$position+1); // следующая группа
	}
}
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
<?php
  get_group(0,0);
?>
</table>
    				</td>
  				</tr>
			</table>
		</td>
		<!-- body_text_eof //-->
		<td width="<?php echo BOX_WIDTH; ?>" valign="top">
			<table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
			<!-- right_navigation //-->
				<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
			<!-- right_navigation_eof //-->
			</table>
		</td>
	</tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>