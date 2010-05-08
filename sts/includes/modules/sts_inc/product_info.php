<?php
/*
  $Id: product_info.php,v 4.1 2006/01/25 23:55:58 rigadin Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  Released under the GNU General Public License
Based on: Simple Template System (STS) - Copyright (c) 2004 Brian Gallagher - brian@diamondsea.com
STS v4.1 by Rigadin (rigadin@osc-help.net)
*/
	
	$products_id=intval($_GET['products_id']);
// Create variables for product ID, added in v4.0.6	
    $template['productid'] = $products_id;
    $template_pinfo['product_id'] = $products_id;
    $template['productsid'] = $products_id; // Just for consistende with osC names
	
// Start the "Add to Cart" form
    $template_pinfo['startform'] = tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product'));
// Add the hidden form variable for the Product_ID
    $template_pinfo['startform'] .= tep_draw_hidden_field('products_id', $products_id);
    $template_pinfo['endform'] = "</form>";

// Get product information from products_id parameter
    $product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_tab_1,pd.products_tab_2,pd.products_tab_3,pd.products_tab_4,pd.products_tab_5,pd.products_tab_6, pd.products_description, p.products_model, p.products_quantity, p.products_image, p.products_image_med, p.products_image_lrg, p.products_image_sm_1, p.products_image_xl_1, p.products_image_sm_2, p.products_image_xl_2, p.products_image_sm_3, p.products_image_xl_3, p.products_image_sm_4, p.products_image_xl_4, p.products_image_sm_5, p.products_image_xl_5, p.products_image_sm_6, p.products_image_xl_6, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$products_id . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_info = tep_db_fetch_array($product_info_query);


	//TotalB2B start
	$product_info['products_price'] = tep_xppp_getproductprice($product_info['products_id']);
    //TotalB2B end

	if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
     $product_info['products_price'] = $new_price; // Обычная цена
     $product_info['specials_new_products_price'] = tep_xppp_getproductprice($product_info['products_id']); // Спец. цена
	  $template_pinfo['regularprice'] = '<s>' . $currencies->display_price_nodiscount($product_info['specials_new_products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</s>&nbsp;<span class="productSpecialPrice">' . 
                                           $currencies->display_price_nodiscount($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
     $template_pinfo['specialprice'] = '';
    } else {
     $product_info['products_price'] = $new_price; // Обычная цена
     $product_info['specials_new_products_price'] = tep_xppp_getproductprice($product_info['products_id']); // Спец. цена
     $template_pinfo['regularprice'] = $currencies->display_price($product_info['specials_new_products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
     $template_pinfo['specialprice'] = '';
    }

    $template_pinfo['productname'] = $product_info['products_name'];
    $template_pinfo['productmodel'] =  $product_info['products_model'];


    $template_pinfo['wishlist'] =  tep_image_submit('button_add_wishlist.gif', IMAGE_BUTTON_ADD_WISHLIST, 'name="wishlist" value="wishlist"');

 if ($product_info['products_image_med']!='') {
          $new_image = $product_info['products_image_med'];
          $image_width = MEDIUM_IMAGE_WIDTH;
          $image_height = MEDIUM_IMAGE_HEIGHT;
         } else {
          $new_image = $product_info['products_image'];
          $image_width = SMALL_IMAGE_WIDTH;
          $image_height = SMALL_IMAGE_HEIGHT;
          }
 if ($product_info['products_image_lrg']!='') {
          $popup_image = $product_info['products_image_lrg'];
         } elseif ($product_info['products_image_med']!='') {
          $popup_image = $product_info['products_image_med'];
          } else {
          $popup_image = $product_info['products_image'];
          }

if (tep_not_null($product_info['products_image'])) {
  $template_pinfo['imagesmall'] = tep_image(DIR_WS_IMAGES . $new_image, addslashes($product_info['products_name']), $image_width, $image_height, 'hspace="5" vspace="5"');
  $template_pinfo['imagelarge'] = tep_image(DIR_WS_IMAGES . $product_info['products_image'], addslashes($product_info['products_name']), '','','');
  $template_pinfo['product_popup']= '<script type="text/javascript" src="jscript/jquery/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="jscript/jquery/plugins/fancybox/jquery.fancybox-1.2.5.css" media="screen" />
<script type="text/javascript" src="jscript/jquery/plugins/fancybox/jquery.fancybox-1.2.5.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("a.zoom").fancybox({
		"zoomOpacity"			: true,
		"overlayShow"			: false,
		"zoomSpeedIn"			: 500,
		"zoomSpeedOut"			: 500
	});
	});
</script>'."\n".
								   '<a class="zoom" rel="group" href="' . tep_href_link(DIR_WS_IMAGES . $popup_image) . '" target="_blank">'.$template_pinfo['imagesmall'] . '<br>' . TEXT_CLICK_TO_ENLARGE .'</a>'."\n";
} else {
  $template_pinfo['imagesmall'] ='';
  $template_pinfo['imagelarge'] ='';
  $template_pinfo['product_popup']='';	
}

$template_pinfo['productdesc'] = stripslashes($product_info['products_description']); 

// Get the number of product attributes (the select list options)
    $products_attributes_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$_GET['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "'");
    $products_attributes = tep_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] > 0) {
// otf 1.71 added width
  // Print the options header
  $template_pinfo['optionheader'] = TEXT_PRODUCT_OPTIONS;

  // Select the list of attribute (option) names
// otf 1.71 Update query to pull option_type
      $products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name, popt.products_options_type, popt.products_options_length, popt.products_options_comment from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id='" . (int)$_GET['products_id'] . "' and pa.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_sort_order, popt.products_options_name");
//      $products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$_GET['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_sort_order");
      while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
// otf 1.71 relocate arrays to each type of field
//        $products_options_array = array();
//        $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$_GET['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "'".$addcgid." order by pa.products_options_sort_order");
// otf 1.71 add case statement to check option type

        switch ($products_options_name['products_options_type']) {

          case PRODUCTS_OPTIONS_TYPE_TEXT:
            //CLR 030714 Add logic for text option
            $products_attribs_query = tep_db_query("select distinct pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id='" . (int)$_GET['products_id'] . "' and pa.options_id = '" . $products_options_name['products_options_id'] . "'");
            $products_attribs_array = tep_db_fetch_array($products_attribs_query);
            $tmp_html = '<input type="text" name ="id[' . TEXT_PREFIX . $products_options_name['products_options_id'] . ']" size="' . $products_options_name['products_options_length'] .'" maxlength="' . $products_options_name['products_options_length'] . '" value="' . $cart->contents[$_GET['products_id']]['attributes_values'][$products_options_name['products_options_id']] .'">  ' . $products_options_name['products_options_comment'] ;
            if ($products_attribs_array['options_values_price'] != '0') {
              $tmp_html .= '(' . $products_attribs_array['price_prefix'] . $currencies->display_price($products_attribs_array['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .')';
            }
            $template_pinfo['optionnames'] .= $products_options_name['products_options_name'] . ':<br>';
            $template_pinfo['optionchoices'] .= $tmp_html . '<br>';
            break;

          case PRODUCTS_OPTIONS_TYPE_TEXTAREA:
// otf 1.71 Add logic for text option
            $products_attribs_query = tep_db_query("select distinct pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id='" . (int)$_GET['products_id'] . "' and pa.options_id = '" . $products_options_name['products_options_id'] . "'");
            $products_attribs_array = tep_db_fetch_array($products_attribs_query);
		    $tmp_html = '<textarea onKeyDown="textCounter(this,\'progressbar' . $products_options_name['products_options_id'] . '\',' . $products_options_name['products_options_length'] . ')" 
								   onKeyUp="textCounter(this,\'progressbar' . $products_options_name['products_options_id'] . '\',' . $products_options_name['products_options_length'] . ')" 
								   onFocus="textCounter(this,\'progressbar' . $products_options_name['products_options_id'] . '\',' . $products_options_name['products_options_length'] . ')" 
								   wrap="soft" 
								   name="id[' . TEXT_PREFIX . $products_options_name['products_options_id'] . ']" 
								   rows=5
								   id="id[' . TEXT_PREFIX . $products_options_name['products_options_id'] . ']"
								   value="' . $cart->contents[$_GET['products_id']]['attributes_values'][$products_options_name['products_options_id']] . '"></textarea>
						<div id="progressbar' . $products_options_name['products_options_id'] . '" class="progress"></div>
						<script>textCounter(document.getElementById("id[' . TEXT_PREFIX . $products_options_name['products_options_id'] . ']"),"progressbar' . $products_options_name['products_options_id'] . '",' . $products_options_name['products_options_length'] . ')</script>';

            if ($products_attribs_array['options_values_price'] != '0') {
               $template_pinfo['optionnames'] .= $products_options_name['products_options_name'].'<br>('.$products_options_name['products_options_comment'].' '.$products_attribs_array['price_prefix'] . $currencies->display_price($products_attribs_array['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . ')'.'<br>';
            } else {
               $template_pinfo['optionnames'] .= $products_options_name['products_options_name'].'<br>('.$products_options_name['products_options_comment'].')'.'<br>';
            }

    $template_pinfo['optionchoices'] .=  $tmp_html . '<br>';
            break;

          case PRODUCTS_OPTIONS_TYPE_RADIO:
// otf 1.71 Add logic for radio buttons
//            $tmp_html = '<table>';
            $tmp_html = '';
            $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_thumbnail, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$_GET['products_id'] . "' and pa.options_id = '" . $products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . $languages_id . "'");
            $checked = true;
            while ($products_options_array = tep_db_fetch_array($products_options_query)) {
//              $tmp_html .= '<tr><td class="main">';
                  if ($products_options_array['products_options_values_thumbnail'] != '') { 
                  if (OPTIONS_IMAGES_CLICK_ENLARGE == 'true'){ 
                   $tmp_image = '<a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_OPTIONS_IMAGES_POPUP, 'oID=' . $products_options_array['products_options_values_id']) .'\')">' . tep_image(DIR_WS_IMAGES . 'options/' . $products_options_array['products_options_values_thumbnail'], $products_options_array['products_options_values_name'], OPTIONS_IMAGES_WIDTH, OPTIONS_IMAGES_HEIGHT) . '</a>';
                  }else{
                    $tmp_image = '' . tep_image(DIR_WS_IMAGES . 'options/' . $opti_array['thumbnail'], $opti_array['text'], OPTIONS_IMAGES_WIDTH, OPTIONS_IMAGES_HEIGHT) . '';
                  }
                  } else {
                    $tmp_image = '';
                  }
              $tmp_html .= '';
              $tmp_html .= tep_draw_radio_field('id[' . $products_options_name['products_options_id'] . ']', $products_options_array['products_options_values_id'], $checked);
              $checked = false;
              $tmp_html .= $products_options_array['products_options_values_name'] .  $tmp_image;
              $tmp_html .=$products_options_name['products_options_comment'] ;
              if ($products_options_array['options_values_price'] != '0') {
                $tmp_html .= '(' . $products_options_array['price_prefix'] . $currencies->display_price($products_options_array['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .')&nbsp';
              }
//              $tmp_html .= '</tr></td>';
              $tmp_html .= '';
            }
//            $tmp_html .= '</table>';
            $tmp_html .= '';
            $template_pinfo['optionnames'] .= $products_options_name['products_options_name'] . ':<br>';
            $template_pinfo['optionchoices'] .=  $tmp_html . '<br>';
            break;

          case PRODUCTS_OPTIONS_TYPE_CHECKBOX:
// otf 1.71 Add logic for checkboxes
            $products_attribs_query = tep_db_query("select distinct pa.options_values_id, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id='" . (int)$_GET['products_id'] . "' and pa.options_id = '" . $products_options_name['products_options_id'] . "'");
            $products_attribs_array = tep_db_fetch_array($products_attribs_query);
            $template_pinfo['optionnames'] .=  $products_options_name['products_options_name'] . ':<br>';
            if ($products_attribs_array['options_values_price'] != '0') {
            $template_pinfo['optionchoices'] .=  tep_draw_checkbox_field('id[' . $products_options_name['products_options_id'] . ']', $products_attribs_array['options_values_id']) . '' . $products_options_name['products_options_comment'] . '(' . $products_attribs_array['price_prefix'] . $currencies->display_price($products_attribs_array['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .')<br>';
            } else {
             $template_pinfo['optionchoices'] .=  tep_draw_checkbox_field('id[' . $products_options_name['products_options_id'] . ']', $products_attribs_array['options_values_id']) . '' . $products_options_name['products_options_comment'] . '<br>';
}
            
//            echo '</td></tr>';
            break;


          default:
// otf 1.71 default is select list
// otf 1.71 reset selected_attribute variable
            $selected_attribute = false;
        		$products_options_array = array();
        		$products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$_GET['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "' order by pa.products_options_sort_order");
        		while ($products_options = tep_db_fetch_array($products_options_query)) {
          		$products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          		if ($products_options['options_values_price'] != '0') {
            		$products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';
          		}
        		}

        		if (isset($cart->contents[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']])) {
          		$selected_attribute = $cart->contents[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']];
        		} else {
          		$selected_attribute = false;
        		}
    $template_pinfo['optionnames'] .= $products_options_name['products_options_name'] . ':<br>'; 
    $template_pinfo['optionchoices'] .=  tep_draw_pull_down_menu('id[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute) . "<br>"; 
        }  // otf 1.71 end switch
      } // otf 1.71 end while
    } // otf 1.71 end if
 else {
  // No options, blank out the template variables for them
  $template_pinfo['optionheader'] = '';
  $template_pinfo['optionnames'] = '';
  $template_pinfo['optionchoices'] = '';
}


// See if there are any reviews
$reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " where products_id = '" . (int)$_GET['products_id'] . "'");
$reviews = tep_db_fetch_array($reviews_query);
if ($reviews['count'] > 0) {
  $template_pinfo['reviews'] = TEXT_CURRENT_REVIEWS . ' ' . $reviews['count']; 
} else {
  $template_pinfo['reviews'] = '';
}

// See if there is a product URL
if (tep_not_null($product_info['products_url'])) {
  $template_pinfo['moreinfolabel'] = TEXT_MORE_INFORMATION;
  $template_pinfo['moreinfourl'] = tep_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($product_info['products_url']), 'NONSSL', true, false); 
} else {
  $template_pinfo['moreinfolabel'] = '';
  $template_pinfo['moreinfourl'] = '';
}

$template_pinfo['moreinfolabel'] = str_replace('%s', $template_pinfo['moreinfourl'], $template_pinfo['moreinfolabel']);

// See if product is not yet available
if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) {
  $template_pinfo['productdatelabel'] = sprintf(TEXT_DATE_AVAILABLE, tep_date_long($product_info['products_date_available']))  ; // Modified in v4.5
  $template_pinfo['productdate'] = tep_date_long($product_info['products_date_available']);
} else {
  $template_pinfo['productdatelabel'] = sprintf(TEXT_DATE_ADDED, tep_date_long($product_info['products_date_added']) ); // Modified in v4.5
  $template_pinfo['productdate'] = tep_date_long($product_info['products_date_added']); 
}

// Strip out %s values
$template_pinfo['productdatelabel'] = str_replace('%s', '', $template_pinfo['productdatelabel']);

// See if any product reviews
$template_pinfo['reviewsurl'] = tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params());
$template_pinfo['reviewsbutton'] = tep_image_button('button_reviews.gif', IMAGE_BUTTON_REVIEWS);
$template_pinfo['addtocartbutton'] = 

'<input type="text" name="cart_quantity" value="' . (tep_get_products_quantity_order_min($_GET['products_id'])) . '" maxlength="3" size="3">' . ((tep_get_products_quantity_order_min($_GET['products_id'])) > 1 ? PRODUCTS_ORDER_QTY_MIN_TEXT . (tep_get_products_quantity_order_min($_GET['products_id'])) : "") .'' . (tep_get_products_quantity_order_units($_GET['products_id']) > 1 ? PRODUCTS_ORDER_QTY_UNIT_TEXT . (tep_get_products_quantity_order_units($_GET['products_id'])) : "") .'' .

tep_image_submit('button_in_cart.gif', IMAGE_BUTTON_IN_CART);


// Begin product properties 2
    $properties = tep_db_query("select options_id, options_values_id from " . TABLE_PRODUCTS_PROPERTIES . " where products_id = '" . $products_id . "' order by sort_order asc");
    $num_properties = tep_db_num_rows($properties);
    if ($num_properties > '0') {
    $template_pinfo['product_properties_header'] = TEXT_PRODUCTS_PROPERTIES;
  while ($properties_values = tep_db_fetch_array($properties)) {
    $options_name = tep_get_prop_options_name($properties_values['options_id']);
    $values_name = tep_get_prop_values_name($properties_values['options_values_id']);
    $template_pinfo['properties_name'].= $options_name . '<br>';
    $template_pinfo['properties_value'].= $values_name . '<br>';
  }
    } else {
    $template_pinfo['product_properties_header'] = TEXT_PRODUCTS_PROPERTIES;
    $template_pinfo['properties_name'] = '';
    $template_pinfo['properties_value'] = '';
    
    }

// End product properties 2

// Begin product extra fields

                      $extra_fields_query = tep_db_query("
                      SELECT pef.products_extra_fields_status as status, pef.products_extra_fields_name as name, ptf.products_extra_fields_value as value
                      FROM ". TABLE_PRODUCTS_EXTRA_FIELDS ." pef
             LEFT JOIN  ". TABLE_PRODUCTS_TO_PRODUCTS_EXTRA_FIELDS ." ptf
            ON ptf.products_extra_fields_id=pef.products_extra_fields_id
            WHERE ptf.products_id=". (int) $products_id ." and ptf.products_extra_fields_value<>'' and (pef.languages_id='0' or pef.languages_id='".$languages_id."')
            ORDER BY products_extra_fields_order");
    
    
    $num_extra_fields = tep_db_num_rows($extra_fields_query);
    if ($num_extra_fields > '0') {
    $template_pinfo['product_extra_fields_header'] = PRODUCT_EXTRA_FIELDS;
  while ($extra_fields = tep_db_fetch_array($extra_fields_query)) {
    $extra_fields_name = $extra_fields['name'];
    $extra_fields_value = $extra_fields['value'];
    $template_pinfo['properties_extra_fields_name'].= $extra_fields_name . '<br>';
    $template_pinfo['properties_extra_fields_value'].= $extra_fields_value . '<br>';
  }
    } else {
    $template_pinfo['product_extra_fields_header'] = PRODUCT_EXTRA_FIELDS;
    $template_pinfo['properties_extra_fields_name'] = '';
    $template_pinfo['properties_extra_fields_value'] = '';
    
    }

// End product extra fields

// Ultra pics
 if (ULTIMATE_ADDITIONAL_IMAGES == 'enable') {
$sts->start_capture();
include(DIR_WS_MODULES . 'additional_images.php');
echo tep_draw_separator('pixel_trans.gif', '100%', '10');
$sts->stop_capture ('ultrapics_module');
$template_pinfo['ultrapics_module']= $sts->template['ultrapics_module'];
} else { 
$template_pinfo['ultrapics_module']= '';
}

// See if any "Also Purchased" items. Feature added in v4.0.6
$sts->start_capture();
 if ((USE_CACHE == 'true') && empty($SID)) {
   echo tep_cache_also_purchased(3600);
 } else {
   include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
 }
$sts->stop_capture ('alsopurchased'); // Get the result to the main array
$template_pinfo['alsopurchased']= $sts->template['alsopurchased']; // Put it in the product info

// X-Sell
$sts->start_capture();
   include(DIR_WS_INCLUDES . 'products_next_previous.php');
echo tep_draw_separator('pixel_trans.gif', '100%', '10');
$sts->stop_capture ('next_previous_module'); // Get the result to the main array
$template_pinfo['next_previous_module']= $sts->template['next_previous_module']; // Put it in the product info

// Products next previous
$sts->start_capture();
include(DIR_WS_MODULES . FILENAME_XSELL_PRODUCTS_BUYNOW);
echo tep_draw_separator('pixel_trans.gif', '100%', '10');
$sts->stop_capture ('xsell_module'); // Get the result to the main array
$template_pinfo['xsell_module']= $sts->template['xsell_module']; // Put it in the product info
if ( ($error_cart_msg) ) {
$template_pinfo['error_cart']=' 
      <tr>
        <td colspan="2" align="right" class="QtyErrors"><br>' . tep_output_warning($error_cart_msg) .'</td>
      </tr>';
}
$template_pinfo['error_cart']='';

$sts->start_capture();
echo tep_draw_separator('pixel_trans.gif', '100%', '10');
include(DIR_WS_MODULES . FILENAME_PRODUCT_REVIEWS_INFO);
$sts->stop_capture ('reviews_module'); // Get the result to the main array
$template_pinfo['reviews_module']= $sts->template['reviews_module']; // Put it in the product info

$sts->start_capture();
include(DIR_WS_MODULES . FILENAME_ARTICLES_PXSELL);
$sts->stop_capture ('articles_xsell'); // Get the result to the main array
$template_pinfo['articles_xsell']= $sts->template['articles_xsell']; // Put it in the product info

$sts->start_capture();
include(DIR_WS_MODULES . FILENAME_PRODUCTS_SPECIFICATIONS);
$sts->stop_capture ('product_specifications'); // Get the result to the main array
$template_pinfo['product_specifications']= $sts->template['product_specifications']; // Put it in the product info
?>