<?php
/*
  $Id: z_payment.php 1778 2008-01-09 23:37:44Z hpdl $

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
//$fp = fopen('webmoney.log', 'a+');
//$str=date('Y-m-d H:i:s').' - ';
//foreach ($_REQUEST as $vn=>$vv) {
//  $str.=$vn.'='.$vv.';';
//}

//fwrite($fp, $str."\n");
//fclose($fp);
// variables prepearing
$crc = get_var('LMI_HASH');

$inv_id = get_var('LMI_PAYMENT_NO');
$order = new order($inv_id);
$order_sum = $order->info['total'];

$hash = strtoupper(md5($_POST['LMI_PAYEE_PURSE'].$_POST['LMI_PAYMENT_AMOUNT'].$_POST['LMI_PAYMENT_NO'].$_POST['LMI_MODE']. 
$_POST['LMI_SYS_INVS_NO'].$_POST['LMI_SYS_TRANS_NO'].$_POST['LMI_SYS_TRANS_DATE'].MODULE_PAYMENT_Z_PAYMENT_SECRET_KEY. 
$_POST['LMI_PAYER_PURSE'].$_POST['LMI_PAYER_WM'])); 

// checking and handling
if ($hash == $crc) {
if (number_format($_POST['LMI_PAYMENT_AMOUNT'],0) == number_format($order->info['total'],0)) {
  $sql_data_array = array('orders_status' => MODULE_PAYMENT_Z_PAYMENT_ORDER_STATUS_ID);
  tep_db_perform('orders', $sql_data_array, 'update', "orders_id='".$inv_id."'");

  $sql_data_arrax = array('orders_id' => $inv_id,
                          'orders_status_id' => MODULE_PAYMENT_Z_PAYMENT_ORDER_STATUS_ID,
                          'date_added' => 'now()',
                          'customer_notified' => '0',
                          'comments' => 'Z-Payment accepted this order payment');
  tep_db_perform('orders_status_history', $sql_data_arrax);

  echo 'OK'.$inv_id;
}
}
?>