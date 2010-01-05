<?php
/*
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
  
  Featured Products Listing
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_FEATURED_PRODUCTS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_FEATURED_PRODUCTS, '', 'NONSSL'));

  $location = ' &raquo; <a href="' . tep_href_link(FILENAME_FEATURED_PRODUCTS, '', 'NONSSL') . '" class="headerNavigation">' . NAVBAR_TITLE . '</a>';
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
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
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_products_new.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
<?php
  list($usec, $sec) = explode(' ', microtime());
  srand( (float) $sec + ((float) $usec * 100000) );
  $mtm= rand();

// BOF manufacturers descriptions
//  $featured_products_query_raw = "select p.products_id, pd.products_name, pd.products_info, p.products_image, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, p.products_date_added, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id left join " . TABLE_FEATURED . " f on p.products_id = f.products_id where p.products_status = '1' and f.status = '1' order by rand($mtm) ";
  $featured_products_query_raw = "select p.products_id, pd.products_name, pd.products_info, p.products_image, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, p.products_date_added, mi.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$languages_id . "') left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id left join " . TABLE_FEATURED . " f on p.products_id = f.products_id where p.products_status = '1' and f.status = '1' order by rand($mtm) ";  
// EOF manufacturers descriptions
   //$featured_products_query_raw = "select p.products_id, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, p.products_date_added, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id left join " . TABLE_FEATURED . " f on p.products_id = f.products_id where p.products_status = '1' and f.status = '1' order by p.products_date_added DESC, pd.products_name";

  $featured_products_split = new splitPageResults($featured_products_query_raw, MAX_DISPLAY_FEATURED_PRODUCTS_LISTING);

  if (($featured_products_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<?php
if ( ($error_cart_msg) ) {
?>
      <tr>
        <td align="right"><?php echo tep_output_warning($error_cart_msg); ?><br></td>
      </tr>
<?php
}
$error_cart_msg='';
?>

      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $featured_products_split->display_count(TEXT_DISPLAY_NUMBER_OF_FEATURED); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $featured_products_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>

<?php
  }
?>

      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
  if ($featured_products_split->number_of_rows > 0) {
    $featured_products_query = tep_db_query($featured_products_split->sql_query);
    while ($featured_products = tep_db_fetch_array($featured_products_query)) {
    
		//TotalB2B start
        $featured_products['products_price'] = tep_xppp_getproductprice($featured_products['products_id']);
        //TotalB2B end

      if ($new_price = tep_get_products_special_price($featured_products['products_id'])) {
		
        //TotalB2B start
//		$query_special_prices_hide = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPECIAL_PRICES_HIDE'");
//        $query_special_prices_hide_result = tep_db_fetch_array($query_special_prices_hide); 
        $query_special_prices_hide_result = SPECIAL_PRICES_HIDE;
        if ($query_special_prices_hide_result == 'true') {
          $products_price = '<span class="productSpecialPrice">' . $currencies->display_price_nodiscount($new_price, tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</span>';
	    } else {
          $products_price = '<s>' . $currencies->display_price_nodiscount($featured_products['products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price_nodiscount($new_price, tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</span>';
	    }
        //TotalB2B end

      } else {
        $products_price = $currencies->display_price($featured_products['products_price'], tep_get_tax_rate($featured_products['products_tax_class_id']));
      }

    
//      if ($new_price = tep_get_products_special_price($featured_products['products_id'])) {
//        $products_price = '<s>' . $currencies->display_price($featured_products['products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</span>';
//      } else {
//        $products_price = $currencies->display_price($featured_products['products_price'], tep_get_tax_rate($featured_products['products_tax_class_id']));
//      }
?>
          <tr>
            <td width="<?php echo SMALL_IMAGE_WIDTH + 10; ?>" valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $featured_products['products_image'], $featured_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>'; ?></td>
            <td valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']) . '"><b><u>' . $featured_products['products_name'] . '</u></b></a><br>' . $featured_products['products_info'] . '<br>' . TEXT_DATE_ADDED . ' ' . tep_date_long($featured_products['products_date_added']) . '<br>' . TEXT_MANUFACTURER . ' ' . $featured_products['manufacturers_name'] . '<br><br>' . TEXT_PRICE . ' ' . $products_price; ?></td>
            <td align="right" valign="middle" class="main">
            
<!--            
            <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $featured_products['products_id']) . '">' . tep_image_button('button_in_cart.gif', IMAGE_BUTTON_IN_CART) . '</a>'; ?>
-->

<?php
if (tep_has_product_attributes($featured_products['products_id'])) {
              if (isset($_GET['manufacturers_id'])) {
?>              
                <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . '&products_id=' . $featured_products['products_id']) . '">' . TEXT_MORE_INFO . '</a>'; ?>
<?php
              } else {
?>
                <?php echo '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $featured_products['products_id']) . '">' . TEXT_MORE_INFO . '</a>'; ?>
<?php
              }
} else {
?>
        
              <?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_FEATURED_PRODUCTS, tep_get_all_get_params(array('action')) . 'action=add_product', 'NONSSL')); ?> 
<?php echo PRODUCTS_ORDER_QTY_TEXT; ?><input type="text" name="cart_quantity" value=<?php echo (tep_get_products_quantity_order_min($featured_products['products_id'])); ?> maxlength="3" size="3"><?php echo ((tep_get_products_quantity_order_min($featured_products['products_id'])) > 1 ? PRODUCTS_ORDER_QTY_MIN_TEXT . (tep_get_products_quantity_order_min($featured_products['products_id'])) : ""); ?><?php echo (tep_get_products_quantity_order_units($featured_products['products_id']) > 1 ? PRODUCTS_ORDER_QTY_UNIT_TEXT . (tep_get_products_quantity_order_units($featured_products['products_id'])) : ""); ?>

<br>                
                <?php echo tep_draw_hidden_field('products_id', $featured_products['products_id']) . tep_image_submit('button_in_cart.gif', IMAGE_BUTTON_IN_CART); ?></form>
<?php } ?>            
            
            
            
            
            </td>
          </tr>
          <tr>
            <td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
    }
  } else {
?>
          <tr>
            <td class="main"><?php echo TEXT_NO_NEW_PRODUCTS; ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
  }
?>

        </table></td>
      </tr>
<?php
  if (($featured_products_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $featured_products_split->display_count(TEXT_DISPLAY_NUMBER_OF_FEATURED); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $featured_products_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>

    </table></td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>