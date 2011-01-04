<?php
/*
  $Id: webmoney.php 1778 2008-01-09 23:37:44Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

function get_var($name, $default = 'none') {
  return (isset($_GET[$name])) ? $_GET[$name] : ((isset($_POST[$name])) ? $_POST[$name] : $default);
}

require('includes/application_top.php');
require (DIR_WS_CLASSES.'order.php');

// logging

//$fp = fopen('liqpay.log', 'a+');
//$str=date('Y-m-d H:i:s').' - ';
//foreach ($_POST as $vn=>$vv) {
//  $str.=$vn.'='.$vv.';';
//}

//fwrite($fp, $str."\n");
//fclose($fp);

// variables prepearing

$xml_decoded=base64_decode($_POST['xml']);

$xml = simplexml_load_string($xml_decoded);

// checking and handling
if ($xml->status == 'success') {
if (number_format($xml->amount,0) == number_format($order->info['total'],0)) {
  $sql_data_array = array('orders_status' => MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID);
  tep_db_perform('orders', $sql_data_array, 'update', "orders_id='".$xml->order_id."'");

  $sql_data_arrax = array('orders_id' => $xml->order_id,
                          'orders_status_id' => MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID,
                          'date_added' => 'now()',
                          'customer_notified' => '0',
                          'comments' => 'LiqPAY accepted this order payment');
  tep_db_perform('orders_status_history', $sql_data_arrax);

  echo 'OK'.$xml->order_id;
}
}
?>