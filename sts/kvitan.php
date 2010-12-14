<?php
/*
  $Id: kvitan.php,v 1.6 2003/06/20 00:37:30 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  
require(DIR_WS_LANGUAGES . $language . '/modules/payment/rusbank.php');

require(DIR_WS_CLASSES . 'order.php');
  $order = new order($_GET['order_id']);

  if ($order->customer['id'] != $customer_id) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'SSL'));
  }

/*error_log("РљРІРёС‚Р°РЅС†РёСЏ Р·Р°РєР°Р· ".$order);
error_log("РљРІРёС‚Р°РЅС†РёСЏ РєРѕСЂР·РёРЅР° ".$cart->count_contents());
error_log("РљРІРёС‚Р°РЅС†РёСЏ Р·Р°РєР°Р· РІСЃРµРіРѕ " .$order->info['total']);
error_log("РљРІРёС‚Р°РЅС†РёСЏ Р·Р°РєР°Р· РґРѕСЃС‚Р°РІРєР° СЃС‚СЂР°РЅР° " . $order->delivery['country']);
error_log("РљРІРёС‚Р°РЅС†РёСЏ Р·Р°РєР°Р· РґРѕСЃС‚Р°РІРєР° name " . $order->delivery['name']);
error_log("РљРІРёС‚Р°РЅС†РёСЏ Р·Р°РєР°Р· РґРѕСЃС‚Р°РІРєР° street_address " . $order->delivery['street_address']);
error_log("РљРІРёС‚Р°РЅС†РёСЏ Р·Р°РєР°Р· РґРѕСЃС‚Р°РІРєР° city  " . $order->delivery['city']);
error_log("РљРІРёС‚Р°РЅС†РёСЏ Р·Р°РєР°Р· РґРѕСЃС‚Р°РІРєР° postcode " . $order->delivery['postcode']);
error_log("РљРІРёС‚Р°РЅС†РёСЏ Р·Р°РєР°Р· РїРѕРєСѓРїР°С‚РµР»СЊ name " . $order->customer['customers_name']);
error_log("РљРІРёС‚Р°РЅС†РёСЏ Р·Р°РєР°Р· РїРѕРєСѓРїР°С‚РµР»СЊ city " . $order->customer['city']);
error_log("Р­С‚Рѕ cart ---------------------", 0);
      while ( list( $key, $val ) = each($cart) ) {
         error_log("$key => $val", 0);
         }
error_log("Р­С‚Рѕ order delivery ---------------------", 0);
      while ( list( $key, $val ) = each($order->delivery) ) {
         error_log("$key => $val", 0);
         }
error_log("Р­С‚Рѕ shipping ---------------------", 0);
      while ( list( $key, $val ) = each($shipping) ) {
         error_log("$key => $val", 0);
         }
error_log("Р­С‚Рѕ order_total ---------------------", 0);
      while ( list( $key, $val ) = each($order_total)) {
         error_log("$key => $val", 0);
         }*/
$FIO = $order->delivery['name'];

  $payment_info_query = tep_db_query("select name,address from " . TABLE_PERSONS . " where orders_id = '". tep_db_input(tep_db_prepare_input($_GET['order_id'])) . "'");
  $payment_info = tep_db_fetch_array($payment_info_query);

$Adress = $payment_info['name'] . "<br />" . $payment_info['address']; 
$total = $order->info['total'];
//$total = number_format( $order->info['total'] * $currencies->get_value('RUR'), $currencies->get_decimal_places('RUR')) . " СЂСѓР±.";
//error_log("Р­С‚Рѕ FIO ". $FIO, 0);
$date = date("d-m-Y");
//error_log("Р­С‚Рѕ РґР°С‚Р° ". $date, 0);

//'РќР°Р·РІР°РЅРёРµ Р±Р°РЅРєР°', 'MODULE_PAYMENT_RUS_BANK_1'
//'Р Р°СЃС‡РµС‚РЅС‹Р№ СЃС‡РµС‚', 'MODULE_PAYMENT_RUS_BANK_2'
//'Р‘Р