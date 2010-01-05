<?php
/*
  $Id: checkout_success.php,v 1.49 2003/06/09 23:03:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// if the customer is not logged on, redirect them to the shopping cart page
  if (!tep_session_is_registered('customer_id')) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

  if (isset($_GET['action']) && ($_GET['action'] == 'update')) {
    $notify_string = '';

    if (isset($_POST['notify']) && !empty($_POST['notify'])) {
      $notify = $_POST['notify'];

      if (!is_array($notify)) {
        $notify = array($notify);
      }

      for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
        if (is_numeric($notify[$i])) {
          $notify_string .= 'notify[]=' . $notify[$i] . '&';
        }
      }

      if (!empty($notify_string)) {
        $notify_string = 'action=notify&' . substr($notify_string, 0, -1);
      }
    }

    tep_redirect(tep_href_link(FILENAME_DEFAULT, $notify_string));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SUCCESS);

  $breadcrumb->add(NAVBAR_TITLE_1);

  $global_query = tep_db_query("select global_product_notifications from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "'");
  $global = tep_db_fetch_array($global_query);

  if ($global['global_product_notifications'] != '1') {
    $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where customers_id = '" . (int)$customer_id . "' order by date_purchased desc limit 1");
    $orders = tep_db_fetch_array($orders_query);

    $products_array = array();
    $products_query = tep_db_query("select products_id, products_name from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$orders['orders_id'] . "' order by products_name");
    while ($products = tep_db_fetch_array($products_query)) {
      $products_array[] = array('id' => $products['products_id'],
                                'text' => $products['products_name']);
    }
  }

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="content-type" content="text/html; charset=CP1251" >
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
    <td width="100%" valign="top"><?php echo tep_draw_form('order', tep_href_link(FILENAME_CHECKOUT_SUCCESS, 'action=update', 'SSL')); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="4" cellpadding="2">
          <tr>
            <td valign="top"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_man_on_board.gif', HEADING_TITLE); ?></td>
            <td valign="top" class="main"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?><div align="center" class="pageHeading"><?php echo HEADING_TITLE; ?></div><br><?php echo TEXT_SUCCESS; ?><br><br>

<?php
  if ($guest_account == false) { // not a guest Account
      echo TEXT_SEE_ORDERS . '<br><br>' . TEXT_CONTACT_STORE_OWNER;
    }
   else { // guest accounts action
    echo TEXT_GUEST_ORDERS . '<br><br>' . TEXT_CONTACT_STORE_OWNER;
  } // guest account end
?>                   
            <h3><?php echo TEXT_THANKS_FOR_SHOPPING; ?></h3></td>
          </tr>
        </table></td>
      </tr>
<?php require('add_checkout_success.php'); //ICW CREDIT CLASS/GV SYSTEM ?>      <tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      
<?php

$orders_query = tep_db_query("select orders_id, orders_status from ".TABLE_ORDERS." where customers_id = '".$customer_id."' order by orders_id desc limit 1");
$orders = tep_db_fetch_array($orders_query);
$last_order = $orders['orders_id'];

	include (DIR_WS_CLASSES.'order.php');
	$order = new order($orders['orders_id']);

require(DIR_WS_LANGUAGES . $language . '/modules/payment/schet.php');
if ($order->info['payment_method'] == MODULE_PAYMENT_RUS_SCHET_TEXT_TITLE) {

?>

<script language="javascript"><!--
function popupPrintorder(url) {
  window.open(url,'popupPrintorder','toolbar=yes,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=600') . focus();
}
//--></script>

      <tr> 
        <td align="left" colspan="2" class="main"><a href="javascript:popupPrintorder('<?php echo tep_href_link(FILENAME_ORDERS_PRINTABLE, 'order_id=' . $_GET['order_id']); ?>')"><?php echo tep_image_button('button_printorder.gif', IMAGE_BUTTON_PRINT_ORDER); ?></a>
      </td>
      </tr>
     
<?php
} 
?>

<?php 
require(DIR_WS_LANGUAGES . $language . '/modules/payment/rusbank.php');
if ($order->info['payment_method'] == MODULE_PAYMENT_RUS_BANK_TEXT_TITLE) {
?>

<script language="javascript"><!--
function popupPrintorder(url) {
  window.open(url,'popupPrintorder','toolbar=yes,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=600') . focus();
}
//--></script>

      <tr> 
        <td align="left" colspan="2" class="main"><a href="javascript:popupPrintorder('<?php echo tep_href_link('kvitan.php', 'order_id=' . $_GET['order_id']); ?>')"><?php echo MODULE_PAYMENT_RUS_BANK_TEXT_PRINT; ?></a>
      </td>
      </tr>
     
<?php
}
?> 

      <tr> 
        <td align="right" class="main" colspan="2"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
      </tr>

      <tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" align="right"><?php echo tep_draw_separator('pixel_silver.gif', '1', '5'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
                <td width="50%"><?php echo tep_image(DIR_WS_IMAGES . 'checkout_bullet.gif'); ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_DELIVERY; ?></td>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_PAYMENT; ?></td>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
            <td align="center" width="25%" class="checkoutBarCurrent"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
          </tr>
        </table></td>
      </tr>
<?php if (DOWNLOAD_ENABLED == 'true') include(DIR_WS_MODULES . 'downloads.php'); ?>
    </table></form></td>
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