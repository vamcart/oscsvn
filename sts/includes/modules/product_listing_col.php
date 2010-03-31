<?php
/*
  $Id: product_listing.php,v 1.44 2003/06/09 22:49:59 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

function ProductListingTemplate($url,$pid,$description,$manufacturer,$category,$model,$quantity,$weight,$name,$image,$price)
	{
	    if (file_exists(STS_TEMPLATE_DIR."content/product_listing_item.html"))
		{
			$template=sts_read_template_file (STS_TEMPLATE_DIR."content/product_listing_item.html");
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

if (isset($pw_mispell)){ //added for search enhancements mod
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
<tr><td><?php echo $pw_string; ?></td></tr>
</table>
<?php
 } //end added search enhancements mod
 // BOF display_all_products
  if ($_GET['page'] == 'all') {
    $listing_split = new splitPageResults($listing_sql, 32767, 'p.products_id');
  } else
// EOF display_all_products
  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id');
// fix counted products

  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
    <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>
<?php
// BOF display_all_products
if ($listing_split->number_of_pages > 1) {
?>
    <?php echo '&nbsp;<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('page', 'info', 'x', 'y')) . 'page=all', $request_type) . '" class="pageResults" title=" ' . TEXT_DISPLAY_ALL_PRODUCTS . ' "><u>' . TEXT_DISPLAY_ALL_PRODUCTS . '</u></a>&nbsp;&nbsp;'; ?>
<?php
} elseif ($_GET['page'] == 'all') {
?>
    <?php echo '&nbsp;<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('page', 'info', 'x', 'y')) . 'page=1', $request_type) . '" class="pageResults" title=" ' . TEXT_DISPLAY_BY_PAGES . ' "><u>' . TEXT_DISPLAY_BY_PAGES . '</u></a>&nbsp;&nbsp;'; ?>
<?php
}
// EOF display_all_products
?>    
    </td>
  </tr>
</table>
<?php
  }
  
  if (PRODUCT_LISTING_DISPLAY_STYLE == 'list') {

    $list_box_contents = array();

    for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
      switch ($column_list[$col]) {
        case 'PRODUCT_LIST_MODEL':
          $lc_text = TABLE_HEADING_MODEL;
          $lc_align = '';
          break;
        case 'PRODUCT_LIST_NAME':
          $lc_text = TABLE_HEADING_PRODUCTS;
          $lc_align = '';
          break;
        case 'PRODUCT_LIST_MANUFACTURER':
          $lc_text = TABLE_HEADING_MANUFACTURER;
          $lc_align = '';
          break;
        case 'PRODUCT_LIST_PRICE':
          $lc_text = TABLE_HEADING_PRICE;
          $lc_align = 'right';
          break;
        case 'PRODUCT_LIST_QUANTITY':
          $lc_text = TABLE_HEADING_QUANTITY;
          $lc_align = 'right';
          break;
        case 'PRODUCT_LIST_WEIGHT':
          $lc_text = TABLE_HEADING_WEIGHT;
          $lc_align = 'right';
          break;
        case 'PRODUCT_LIST_BUY_NOW':
          $lc_text = TABLE_HEADING_BUY_NOW;
          $lc_align = 'center';
          break;
       case 'PRODUCT_SORT_ORDER':
      	$lc_text = TABLE_HEADING_PRODUCT_SORT;
      	$lc_align = 'center';
      	break;     
        case 'PRODUCT_LIST_IMAGE':
          $lc_text = TABLE_HEADING_IMAGE;
          $lc_align = 'center';
          break;
      }

      if ( ($column_list[$col] != 'PRODUCT_LIST_BUY_NOW') && ($column_list[$col] != 'PRODUCT_LIST_IMAGE') ) {
        $lc_text = tep_create_sort_heading($_GET['sort'], $col+1, $lc_text);
      }

      $list_box_contents[0][] = array('align' => $lc_align,
                                     'params' => 'class="productListing-heading"',
                                       'text' => '&nbsp;' . $lc_text . '&nbsp;');
    }

    if ($listing_split->number_of_rows > 0) {
      $rows = 0;
      $listing_query = tep_db_query($listing_split->sql_query);

// Start products specifications
      if ( (SPECIFICATIONS_COMP_TABLE_ROW == 'top' || SPECIFICATIONS_COMP_TABLE_ROW == 'both') && $current_category_id != 0 && $show_comparison == true && tep_has_spec_group ($current_category_id, 'show_comparison') == true && basename ($PHP_SELF) == 'index.php') {
        $list_box_contents[0] = array ('params' => 'class="productListing-even"');
        for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
          $lc_align = '';

          switch ($column_list[$col]) {
            case 'PRODUCT_LIST_NAME':
              $lc_text = '&nbsp;<a href="' . tep_href_link (FILENAME_COMPARISON, 'cPath=' . $cPath) . '">' . TEXT_LINK_PRODUCTS_COMPARISON . '</a>&nbsp;';
              break;
            case 'PRODUCT_LIST_MODEL':
              if (PRODUCT_LIST_NAME == 0) {
                $lc_text = '&nbsp;<a href="' . tep_href_link (FILENAME_COMPARISON, 'cPath=' . $cPath) . '">' . TEXT_LINK_PRODUCTS_COMPARISON . '</a>&nbsp;';
              }
              break;
            case 'PRODUCT_LIST_IMAGE':
              $lc_align = 'center';
              $lc_text = '&nbsp;<a href="' . tep_href_link (FILENAME_COMPARISON, 'cPath=' . $cPath) . '">' . tep_image_button ('products_comparison.png', TEXT_LINK_PRODUCTS_COMPARISON, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>&nbsp;';
              break;
            default:
              $lc_text = '&nbsp;';
              break;
          } // switch ($column_list
        
          $list_box_contents[0][] = array ('align' => $lc_align,
                                           'params' => 'class="productListing-data"',
                                           'text'  => $lc_text
                                          );
          } // for ($col=0
        } // if ( (SPECIFICATIONS_COMP_TABLE_ROW
// End products specifications      

      while ($listing = tep_db_fetch_array($listing_query)) {
        $rows++;

        if (($rows/2) == floor($rows/2)) {
          $list_box_contents[] = array('params' => 'class="productListing-even"');
        } else {
          $list_box_contents[] = array('params' => 'class="productListing-odd"');
        }

        $cur_row = sizeof($list_box_contents) - 1;

        for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
          $lc_align = '';

          switch ($column_list[$col]) {
            case 'PRODUCT_LIST_MODEL':
              $lc_align = '';
              $lc_text = '&nbsp;' . $listing['products_model'] . '&nbsp;';
              break;
            case 'PRODUCT_LIST_NAME':
              $lc_align = '';
              if (isset($_GET['manufacturers_id']) && tep_not_null($_GET['manufacturers_id'])) {
                $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . '&products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a><br>&nbsp;' . tep_get_products_info($listing['products_id']);
              } else {
                $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a><br>&nbsp;' . tep_get_products_info($listing['products_id']);
              }
              break;
            case 'PRODUCT_LIST_MANUFACTURER':
              $lc_align = '';
              $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing['manufacturers_id']) . '">' . $listing['manufacturers_name'] . '</a>&nbsp;';
              break;
          case 'PRODUCT_LIST_PRICE':
            $lc_align = 'right';
		    
			//TotalB2B start
		    $listing['products_price'] = tep_xppp_getproductprice($listing['products_id']);
            //TotalB2B end

			//TotalB2B start
		    if ($new_price = tep_get_products_special_price($listing['products_id'])) {
              $listing['specials_new_products_price'] = $new_price;
//			  $query_special_prices_hide = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPECIAL_PRICES_HIDE'");
//              $query_special_prices_hide_result = tep_db_fetch_array($query_special_prices_hide); 
              $query_special_prices_hide_result = SPECIAL_PRICES_HIDE; 
              if ($query_special_prices_hide_result == 'true') {
			    $lc_text = '&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price_nodiscount($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>&nbsp;';
	          } else {
			    $lc_text = '&nbsp;<s>' .  $currencies->display_price_nodiscount($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price_nodiscount($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>&nbsp;';
	          }
			//TotalB2B end
              
			} else {
              $lc_text = '&nbsp;' . $currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '&nbsp;';
            }
              break;
            case 'PRODUCT_LIST_QUANTITY':
              $lc_align = 'right';
              $lc_text = '&nbsp;' . $listing['products_quantity'] . '&nbsp;';
              break;
            case 'PRODUCT_LIST_WEIGHT':
              $lc_align = 'right';
              $lc_text = '&nbsp;' . $listing['products_weight'] . '&nbsp;';
              break;
            case 'PRODUCT_LIST_BUY_NOW':
              $lc_align = 'center';

if (tep_has_product_attributes($listing['products_id'])) {
              if (isset($_GET['manufacturers_id']) && tep_not_null($_GET['manufacturers_id'])) {
                $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . '&products_id=' . $listing['products_id']) . '">' . TEXT_MORE_INFO . '</a>';
              } else {
                $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing['products_id']) . '">' . TEXT_MORE_INFO . '</a>';
              }
} else {
              $lc_text =                
              tep_draw_form('cart_quantity', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=add_product', 'NONSSL')) . PRODUCTS_ORDER_QTY_TEXT . '<input type="text" name="cart_quantity" maxlength="4" size="4" value='. (tep_get_products_quantity_order_min($listing['products_id'])) .'>' . ((tep_get_products_quantity_order_min($listing['products_id'])) > 1 ? PRODUCTS_ORDER_QTY_MIN_TEXT . (tep_get_products_quantity_order_min($listing['products_id'])) : "") . (tep_get_products_quantity_order_units($listing['products_id']) > 1 ? PRODUCTS_ORDER_QTY_UNIT_TEXT . (tep_get_products_quantity_order_units($listing['products_id'])) : "") . tep_draw_hidden_field('products_id', $listing['products_id']) . '<br>' . tep_image_submit('button_buy_now.gif', IMAGE_BUTTON_IN_CART) . '</form>'              
              ;            
}
              break;
           case 'PRODUCT_SORT_ORDER';
            $lc_align = 'center';
            $lc_text = '&nbsp;' . $listing['products_sort_order'] . '&nbsp;';
            break;             
            case 'PRODUCT_LIST_IMAGE':
              $lc_align = 'center';
              if (isset($_GET['manufacturers_id']) && tep_not_null($_GET['manufacturers_id'])) {
                $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . '&products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
              } else {
                $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>&nbsp;';
              }
              break;
          }

          $list_box_contents[$cur_row][] = array('align' => $lc_align,
                                                'params' => 'class="productListing-data"',
                                                 'text'  => $lc_text);
        }
      }

// Start products specifications      
    if ( (SPECIFICATIONS_COMP_TABLE_ROW == 'bottom' || SPECIFICATIONS_COMP_TABLE_ROW == 'both') && $current_category_id != 0 && $show_comparison == true && tep_has_spec_group ($current_category_id, 'show_comparison') == true && basename ($PHP_SELF) == 'index.php') {
      $rows++;

      if (($rows/2) == floor($rows/2)) {
        $list_box_contents[] = array('params' => 'class="productListing-even"');
      } else {
        $list_box_contents[] = array('params' => 'class="productListing-odd"');
      }

      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
        $lc_align = '';

        switch ($column_list[$col]) {
          case 'PRODUCT_LIST_NAME':
            $lc_text = '&nbsp;<a href="' . tep_href_link (FILENAME_COMPARISON, 'cPath=' . $cPath) . '">' . TEXT_LINK_PRODUCTS_COMPARISON . '</a>&nbsp;';
            break;
          case 'PRODUCT_LIST_MODEL':
            if (PRODUCT_LIST_NAME == 0) {
              $lc_text = '&nbsp;<a href="' . tep_href_link (FILENAME_COMPARISON, 'cPath=' . $cPath) . '">' . TEXT_LINK_PRODUCTS_COMPARISON . '</a>&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_IMAGE':
            $lc_align = 'center';
            $lc_text = '&nbsp;<a href="' . tep_href_link (FILENAME_COMPARISON, 'cPath=' . $cPath) . '">' . tep_image_button ('products_comparison.png', TEXT_LINK_PRODUCTS_COMPARISON, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>&nbsp;';
            break;
          default:
            $lc_text = '&nbsp;';
            break;
        } // switch ($column_list
        
        $list_box_contents[$cur_row + 1][] = array ('align' => $lc_align,
                                                    'params' => 'class="productListing-data"',
                                                    'text'  => $lc_text
                                                   );
        } // for ($col=0
      } // if ( (SPECIFICATIONS_COMP_TABLE_ROW
// End products specifications      

      new productListingBox($list_box_contents);
    } else {
      $list_box_contents = array();

      $list_box_contents[0] = array('params' => 'class="productListing-odd"');
      $list_box_contents[0][] = array('params' => 'class="productListing-data"',
                                        'text' => TEXT_NO_PRODUCTS);

      new productListingBox($list_box_contents);
    }
    
  } elseif (PRODUCT_LISTING_DISPLAY_STYLE == 'columns') {

    $info_box_contents = array();
    if ($listing_split->number_of_rows > 0) {
      $row = 0;
      $col = 0;
      $listing_query = tep_db_query($listing_split->sql_query);
      while ($listing = tep_db_fetch_array($listing_query)) {
        $listing['products_name'] = tep_get_products_name($listing['products_id']);
        
        if (PRODUCT_LIST_IMAGE > 0) {
	      $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>';
        }
          
        if (PRODUCT_LIST_NAME > 0) {
	      $lc_text .= '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a><br>';
        }

        if (PRODUCT_LIST_MODEL > 0) {
	      $lc_text .= '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $listing['products_id']) . '">' . $listing['products_model'] . '</a><br>';
        }

        if (PRODUCT_LIST_MANUFACTURER > 0) {
	      $lc_text .= '<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing['manufacturers_id']) . '">' . $listing['manufacturers_name'] . '</a><br>';
        }

        if (PRODUCT_LIST_PRICE > 0) {

			//TotalB2B start
		    $listing['products_price'] = tep_xppp_getproductprice($listing['products_id']);
            //TotalB2B end

		    $new_price = tep_get_products_special_price($listing['products_id']);
              $listing['specials_new_products_price'] = $new_price;

          if (tep_not_null($listing['specials_new_products_price'])) {
            $lc_text .= '<s>' .  $currencies->display_price_nodiscount($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price_nodiscount($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>';
          } else {
            $lc_text .= '&nbsp;' . $currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '&nbsp;';
          }
        }

        if (PRODUCT_LIST_BUY_NOW) {
          $lc_text .= '';   	  
//          $lc_text .= '<br><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing['products_id'], 'NONSSL') . '">' . tep_image_button('button_buy_now.gif', TEXT_BUY . $listing['products_name'] . TEXT_NOW) . '</a>';   	  
        }

        $width = 100 / PRODUCT_LIST_COL_NUM;

	  // START  STS
	  require_once(DIR_WS_MODULES."sts/sts_product_listing.php");
	  $sts_product_listing=new sts_product_listing();
	  if ($sts_product_listing->enabled)
	  {
	  
          if (tep_not_null($listing['specials_new_products_price'])) {
        $info_box_contents[$row][$col] = array('align' => 'center', 'params' => 'class="smallText" width="' . $width . '%" valign="top"',
                                                'text' => ProductListingTemplate(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $listing['products_id']),$listing['products_id'],tep_get_products_info($listing['products_id']),tep_get_manufacturers_name($listing['manufacturers_id']),tep_get_categories_name($current_category_id),$listing['products_model'],$listing['products_quantity'],$listing['products_weight'],$listing['products_name'],tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT),'<s>' .  $currencies->display_price_nodiscount($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price_nodiscount($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>'));

          } else {
        $info_box_contents[$row][$col] = array('align' => 'center', 'params' => 'class="smallText" width="' . $width . '%" valign="top"',
                                                'text' => ProductListingTemplate(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $listing['products_id']),$listing['products_id'],tep_get_products_info($listing['products_id']),tep_get_manufacturers_name($listing['manufacturers_id']),tep_get_categories_name($current_category_id),$listing['products_model'],$listing['products_quantity'],$listing['products_weight'],$listing['products_name'],tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT),$currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id']))));
          }	  
	  
	  }
	  else
	  {
        $info_box_contents[$row][$col] = array('align' => 'center', 'params' => 'class="smallText" width="' . $width . '%" valign="top"',
                                                'text' => $lc_text);
	  }
	  // END STS

        $col ++;
        if ($col > PRODUCT_LIST_COL_NUM-1) {
          $col = 0;
          $row ++;
        }
      }

      new productListingBox($info_box_contents);

    } else {

      $info_box_contents = array();

      $info_box_contents[0] = array('params' => 'class="productListing-odd"');
      $info_box_contents[0][] = array('params' => 'class="productListing-data"',
                                        'text' => TEXT_NO_PRODUCTS);

      new productListingBox($info_box_contents);

    }
  }
    
  if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
    <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>
<?php
// BOF display_all_products
if ($listing_split->number_of_pages > 1) {
?>
    <?php echo '&nbsp;<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('page', 'info', 'x', 'y')) . 'page=all', $request_type) . '" class="pageResults" title=" ' . TEXT_DISPLAY_ALL_PRODUCTS . ' "><u>' . TEXT_DISPLAY_ALL_PRODUCTS . '</u></a>&nbsp;&nbsp;'; ?>
<?php
} elseif ($_GET['page'] == 'all') {
?>
    <?php echo '&nbsp;<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('page', 'info', 'x', 'y')) . 'page=1', $request_type) . '" class="pageResults" title=" ' . TEXT_DISPLAY_BY_PAGES . ' "><u>' . TEXT_DISPLAY_BY_PAGES . '</u></a>&nbsp;&nbsp;'; ?>
<?php
}
// EOF display_all_products
?>    
    </td>
  </tr>
</table>
<?php
  }
?>