<?php
/*
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
  
  Featured Products V1.1
  Displays a list of featured products, selected from admin
  For use as an Infobox instead of the "New Products" Infobox  
*/
?>
<!-- featured_products //-->
<?php
 if(FEATURED_PRODUCTS_DISPLAY == true)
 {
  $featured_products_category_id = $new_products_category_id;
  $cat_name_query = tep_db_query("select categories_name from categories_description where categories_id = '" . $featured_products_category_id . "' limit 1");
  $cat_name_fetch = tep_db_fetch_array($cat_name_query);
  $cat_name = $cat_name_fetch['categories_name'];
  $info_box_contents = array();

// STS Featured Products Module Templates Start

function FeaturedProductsModuleListingTemplate($url,$pid,$description,$manufacturer,$category,$model,$quantity,$weight,$name,$image,$price)
	{
	    if (file_exists(STS_TEMPLATE_DIR."content/featured_products_module_item.html"))
		{
			$template=sts_read_template_file (STS_TEMPLATE_DIR."content/featured_products_module_item.html");
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

// STS Featured Products Module Templates End


  if ( (!isset($featured_products_category_id)) || ($featured_products_category_id == '0') ) {
    $info_box_contents[] = array('align' => 'left', 'text' => TABLE_HEADING_FEATURED_PRODUCTS);
    $featured_products_query = tep_db_query("select p.products_id, products_model, products_quantity, products_weight, manufacturers_id, p.products_image, p.products_tax_class_id, s.status as specstat, s.specials_new_products_price, p.products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on s.products_id = p.products_id, " . TABLE_FEATURED . " f where p.products_id = f.products_id and p.products_status = '1' and f.status = '1' order by rand() DESC limit " . MAX_DISPLAY_FEATURED_PRODUCTS);
  } else {
    $info_box_contents[] = array('align' => 'left', 'text' => sprintf(TABLE_HEADING_FEATURED_PRODUCTS_CATEGORY, $cat_name));
    $featured_products_query = tep_db_query("select distinct p.products_id, products_model, products_quantity, products_weight, manufacturers_id, p.products_image, p.products_tax_class_id, s.status as specstat, s.specials_new_products_price, p.products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on s.products_id = p.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_FEATURED . " f where p.products_id = f.products_id and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.parent_id = '" . $featured_products_category_id . "' and p.products_status = '1' and f.status = '1' order by rand() DESC limit " . MAX_DISPLAY_FEATURED_PRODUCTS);
}
  $row = 0;
  $col = 0; 
  $num = 0;
  $width = 100 / PRODUCT_LIST_COL_NUM;
  while ($featured_products = tep_db_fetch_array($featured_products_query)) {
    $num ++; if ($num == 1) { new infoBoxHeading($info_box_contents, false, false, tep_href_link(FILENAME_FEATURED_PRODUCTS));}
    $featured_products['products_name'] = tep_get_products_name($featured_products['products_id']);
	if ($featured_price = tep_get_products_special_price($featured_products['products_id'])) {
     $featured_products['products_price'] = $featured_price; // Обычная цена
     $featured_products['specials_featured_products_price'] = tep_xppp_getproductprice($featured_products['products_id']); // Спец. цена

// STS Featured Products Module Templates Start

  // START  STS
	  require_once(DIR_WS_MODULES."sts/sts_featured_products_module_listing.php");
	  $sts_featured_products_module_listing=new sts_featured_products_module_listing();
	  if ($sts_featured_products_module_listing->enabled)
	  {
      
        $info_box_contents[$row][$col] = array('align' => 'center', 'params' => 'class="smallText" width="' . $width . '%" valign="top"',
                                                'text' => FeaturedProductsModuleListingTemplate(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']),$featured_products['products_id'],tep_get_products_info($featured_products['products_id']),tep_get_manufacturers_name($featured_products['manufacturers_id']),tep_get_categories_name($current_category_id),$featured_products['products_model'],$featured_products['products_quantity'],$featured_products['products_weight'],$featured_products['products_name'],tep_image(DIR_WS_IMAGES . $featured_products['products_image'], $featured_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT),'<s>' . $currencies->display_price_nodiscount($featured_products['specials_featured_products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</s><br><span class="productSpecialPrice">' . 
                                           $currencies->display_price_nodiscount($featured_products['products_price'], tep_get_tax_rate($featured_products['products_tax_class_id']))));
	  }
	  else
	  {
	  $info_box_contents[$row][$col] = array('align' => 'center',
                                       'params' => 'class="smallText" width="' . $width . '%" valign="top"',
                                       'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $featured_products['products_image'], $featured_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']) . '">' . $featured_products['products_name'] . '</a><br><s>' . $currencies->display_price_nodiscount($featured_products['specials_featured_products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</s><br><span class="productSpecialPrice">' . 
                                           $currencies->display_price_nodiscount($featured_products['products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])));
    }
	  // END STS
// STS Featured Products Module Templates Start


    } else {
     $featured_products['products_price'] = $featured_price; // Обычная цена
     $featured_products['specials_featured_products_price'] = tep_xppp_getproductprice($featured_products['products_id']); // Спец. цена
     
// STS Featured Products Module Templates Start

  // START  STS
	  require_once(DIR_WS_MODULES."sts/sts_featured_products_module_listing.php");
	  $sts_featured_products_module_listing=new sts_featured_products_module_listing();
	  if ($sts_featured_products_module_listing->enabled)
	  {
      
        $info_box_contents[$row][$col] = array('align' => 'center', 'params' => 'class="smallText" width="' . $width . '%" valign="top"',
                                                'text' => FeaturedProductsModuleListingTemplate(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']),$featured_products['products_id'],tep_get_products_info($featured_products['products_id']),tep_get_manufacturers_name($featured_products['manufacturers_id']),tep_get_categories_name($current_category_id),$featured_products['products_model'],$featured_products['products_quantity'],$featured_products['products_weight'],$featured_products['products_name'],tep_image(DIR_WS_IMAGES . $featured_products['products_image'], $featured_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT),$currencies->display_price($featured_products['specials_featured_products_price'], tep_get_tax_rate($featured_products['products_tax_class_id']))));
	  }
	  else
	  {
	  $info_box_contents[$row][$col] = array('align' => 'center',
                                       'params' => 'class="smallText" width="' . $width . '%" valign="top"',
                                       'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $featured_products['products_image'], $featured_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']) . '">' . $featured_products['products_name'] . '</a><br>' . $currencies->display_price($featured_products['specials_featured_products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])));
    }
	  }
	  // END STS
// STS Featured Products Module Templates Start
     
    $col ++;
    if ($col > PRODUCT_LIST_COL_NUM - 1) {
      $col = 0;
      $row ++;
    }
  }
  if($num) {
      
      new contentBox($info_box_contents);
  }
 } else // If it's disabled, then include the original New Products box
 {
   include (DIR_WS_MODULES . FILENAME_NEW_PRODUCTS);
 }
?>
<!-- featured_products_eof //-->
