<?php
/*
  $Id: ik.php 1778 2008-01-09 23:37:44Z hpdl $

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

//$fp = fopen('ik.log', 'a+');
//$str=date('Y-m-d H:i:s').' - ';
//foreach ($_POST as $vn=>$vv) {
//  $str.=$vn.'='.$vv.';';
//}

//fwrite($fp, $str."\n");
//fclose($fp);

// variables prepearing
$crc = get_var('ik_sign_hash');

$inv_id = get_var('ik_payment_id');
$order = new order($inv_id);
$order_sum = $order->info['total'];

$hash_source = $_POST['ik_shop_id'].":".$_POST['ik_payment_amount'].":".$_POST['ik_payment_id'].":".$_POST['ik_paysystem_alias'].":".$_POST['ik_baggage_fields'].":".MODULE_PAYMENT_IK_SECRET_KEY;
$hash = md5($hash_source);

// checking and handling
if ($_POST['ik_payment_state'] == 'success') {
if (strtoupper($hash) == strtoupper($crc)) {
if (number_format($_POST['ik_payment_amount'],0) == number_format($order->info['total'],0)) {
  $sql_data_array = array('orders_status' => MODULE_PAYMENT_IK_ORDER_STATUS_ID);
  tep_db_perform('orders', $sql_data_array, 'update', "orders_id='".$inv_id."'");

  $sql_data_arrax = array('orders_id' => $inv_id,
                          'orders_status_id' => MODULE_PAYMENT_IK_ORDER_STATUS_ID,
                          'date_added' => 'now()',
                          'customer_notified' => '0',
                          'comments' => 'InterKassa accepted this order payment');
  tep_db_perform('orders_status_history', $sql_data_arrax);

  echo 'OK'.$inv_id;
}
}
}
?>