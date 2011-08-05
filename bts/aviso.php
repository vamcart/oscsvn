<?php
/*
  $Id: aviso.php 1778 2011-08-05 17:37:44Z VaM $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2011 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');
require (DIR_WS_CLASSES.'order.php');

// checking and handling
$aviso_data = json_decode(implode("", file('php://input')),true);

if ($aviso_data['access_key'] == MODULE_PAYMENT_AVISO_ACCESS_KEY) {
if ($aviso_data['order_status'] == 'success') {
  $sql_data_array = array('orders_status' => MODULE_PAYMENT_AVISO_ORDER_STATUS_ID);
  tep_db_perform('orders', $sql_data_array, 'update', "orders_id='".$aviso_data['merchant_order_id']."'");

  $sql_data_arrax = array('orders_id' => $aviso_data['merchant_order_id'],
                          'orders_status_id' => MODULE_PAYMENT_AVISO_ORDER_STATUS_ID,
                          'date_added' => 'now()',
                          'customer_notified' => '0',
                          'comments' => 'AvisoSMS accepted this order payment');
  tep_db_perform('orders_status_history', $sql_data_arrax);

}
}

?>