<?php
/*
  $Id: new_products.php,v 1.1.1.1 2003/09/18 19:04:53 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- new_products //-->
<?php

// STS New Products Module Templates Start

function NewProductsModuleListingTemplate($url,$pid,$description,$manufacturer,$category,$model,$quantity,$weight,$name,$image,$price)
	{
	    if (file_exists(STS_TEMPLATE_DIR."content/new_products_module_item.html"))
		{
			$template=sts_read_template_file (STS_TEMPLATE_DIR."content/new_products_module_item.html");
			$template = str_replace('$url', $url, $template);
			$template = str_replace('$pid', $pid, $template);
			$template = str_replace('$description', $description, $template);
			$template = str_replace('$manufacturer', $manufacturer, $template);
			$template = str_replace('$category', $category, $template);
			$template = str_replace('$model', $model, $template);
			$template = str_replace('$quantity', $quantity, $template);
			$template = str_replace('$weight', $weight, $template);
			$template = str_replace('$name', $name, $template);
			$template = str_replace('$image', $image, $template);
			$template = str_replace('$price', $price, $template);
		return $template;
		}
    }

// STS New Products Module Templates End

  //TotalB2B start
  if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
    $new_products_query = tep_db_query("select p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS);
  } else {
    $new_products_query = tep_db_query("select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.parent_id = '" . (int)$new_products_category_id . "' and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS);
  }
  //TotalB2B end
  
 $info_box_contents = array();
  $info_box_contents[] = array('text' => '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, '', 'NONSSL') . '">' . sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')) . '</a>');

  new infoBoxHeading($info_box_contents, false, false, tep_href_link(FILENAME_PRODUCTS_NEW));


  $row = 0;
  $col = 0;
  $info_box_contents = array();
  $width = 100 / PRODUCT_LIST_COL_NUM;
  while ($new_products = tep_db_fetch_array($new_products_query)) {

//    $special_price = tep_get_products_special_price($new_products['products_id']);
//    if ($special_price) {
//      $products_price = '<s>' .  $currencies->display_price($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price($special_price, tep_get_tax_rate($new_products['products_tax_class_id'])) . '</span>';
//    } else {
//      $products_price = $currencies->display_price($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id']));
//    }

	//TotalB2B start & TotalB2B start

	if ($new_price = tep_get_products_special_price($new_products['products_id'])) {
     $new_products['products_price'] = $new_price; // Обычная цена
     $new_products['specials_new_products_price'] = tep_xppp_getproductprice($new_products['products_id']); // Спец. цена

// STS New Products Module Templates Start

  // START  STS
	  require_once(DIR_WS_MODULES."sts/sts_new_products_module_listing.php");
	  $sts_new_products_module_listing=new sts_new_products_module_listing();
	  if ($sts_new_products_module_listing->enabled)
	  {
      
        $info_box_contents[$row][$col] = array('align' => 'center', 'params' => 'class="smallText" width="' . $width . '%" valign="top"',
                                                'text' => NewProductsModuleListingTemplate(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']),$new_products['products_id'],tep_get_products_info($new_products['products_id']),tep_get_manufacturers_name($new_products['manufacturers_id']),tep_get_categories_name($current_category_id),$new_products['products_model'],$new_products['products_quantity'],$new_products['products_weight'],$new_products['products_name'],tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT),'<s>' . $currencies->display_price_nodiscount($new_products['specials_new_products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</s><br><span class="productSpecialPrice">' . 
                                           $currencies->display_price_nodiscount($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id']))));
	  }
	  else
	  {
	  $info_box_contents[$row][$col] = array('align' => 'center',
                                       'params' => 'class="smallText" width="' . $width . '%" valign="top"',
                                       'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . $new_products['products_name'] . '</a><br><s>' . $currencies->display_price_nodiscount($new_products['specials_new_products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</s><br><span class="productSpecialPrice">' . 
                                           $currencies->display_price_nodiscount($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])));
    }
	  // END STS
// STS New Products Module Templates Start


    } else {
     $new_products['products_price'] = $new_price; // Обычная цена
     $new_products['specials_new_products_price'] = tep_xppp_getproductprice($new_products['products_id']); // Спец. цена

// STS New Products Module Templates Start

  // START  STS
	  require_once(DIR_WS_MODULES."sts/sts_new_products_module_listing.php");
	  $sts_new_products_module_listing=new sts_new_products_module_listing();
	  if ($sts_new_products_module_listing->enabled)
	  {
      
        $info_box_contents[$row][$col] = array('align' => 'center', 'params' => 'class="smallText" width="' . $width . '%" valign="top"',
                                                'text' => NewProductsModuleListingTemplate(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']),$new_products['products_id'],tep_get_products_info($new_products['products_id']),tep_get_manufacturers_name($new_products['manufacturers_id']),tep_get_categories_name($current_category_id),$new_products['products_model'],$new_products['products_quantity'],$new_products['products_weight'],$new_products['products_name'],tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT),$currencies->display_price($new_products['specials_new_products_price'], tep_get_tax_rate($new_products['products_tax_class_id']))));
	  }
	  else
	  {
    $info_box_contents[$row][$col] = array('align' => 'center',
                                       'params' => 'class="smallText" width="' . $width . '%" valign="top"',
                                       'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . $new_products['products_name'] . '</a><br>' . $currencies->display_price($new_products['specials_new_products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])));
    }
	  }
	  // END STS
// STS New Products Module Templates Start


	//TotalB2B end & TotalB2B end

//    $info_box_contents[$row][$col] = array('align' => 'center',
//                                           'params' => 'class="smallText" width="33%" valign="top"',
//                                           'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . $new_products['products_name'] . '</a><br>' . $products_price);


    $col ++;
    if ($col > PRODUCT_LIST_COL_NUM - 1) {
      $col = 0;
      $row ++;
    }
  }

  new contentBox($info_box_contents);
?>
<!-- new_products_eof //-->
