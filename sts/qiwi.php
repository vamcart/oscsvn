<?php
/*
  $Id: qiwi.php 106 2010-04-14 13:37:44Z oleg_vamsoft $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 VaMSoft Ltd. http://kypi.ru

  Released under the GNU General Public License
*/

include('includes/application_top.php');

require_once(DIR_WS_CLASSES . 'nusoap/nusoap.php');
        
$server = new nusoap_server;
$server->register('updateBill');
$server->service($HTTP_RAW_POST_DATA);

function updateBill($login, $password, $txn, $status) {

//обработка возможных ошибок авторизации
if ( $login != MODULE_PAYMENT_QIWI_ID )
return 150;

//if ( !empty($password) && $password != strtoupper(md5($txn+strtoupper(md5(MODULE_PAYMENT_QIWI_SECRET_KEY)))) )
//return 150;

// получаем номер заказа
$transaction = intval($txn);

// меняем статус заказа при условии оплаты счёта
if ( $status == 60 ) {
	
  $sql_data_array = array('orders_status' => MODULE_PAYMENT_QIWI_ORDER_STATUS_ID);
  tep_db_perform('orders', $sql_data_array, 'update', "orders_id='".$transaction."'");

  $sql_data_arrax = array('orders_id' => $transaction,
                          'orders_status_id' => MODULE_PAYMENT_QIWI_ORDER_STATUS_ID,
                          'date_added' => 'now()',
                          'customer_notified' => '0',
                          'comments' => 'QIWI accepted this order payment');
  tep_db_perform('orders_status_history', $sql_data_arrax);

// Отправляем письмо клиенту и админу о смене статуса заказа

	require_once(DIR_WS_CLASSES . 'order.php');
  
  	$order = new order($transaction);
  	$language = 'russian';

			  $lang_query = tep_db_query("select languages_id from " . TABLE_LANGUAGES . " where directory = '" . $language . "'");
			  $lang = tep_db_fetch_array($lang_query);
			  $lang=$lang['languages_id'];
			
			  if (!isset($lang)) $lang=(int)$languages_id;

				$orders_status_array = array ();
				$orders_status_query = tep_db_query("select orders_status_id, orders_status_name from ".TABLE_ORDERS_STATUS." where language_id = '".$lang."'");
				while ($orders_status = tep_db_fetch_array($orders_status_query)) {
					$orders_statuses[] = array ('id' => $orders_status['orders_status_id'], 'text' => $orders_status['orders_status_name']);
					$orders_status_array[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
				}

				include_once (DIR_FS_CATALOG.'admin/includes/languages/'.$language.'/orders.php');
				include_once (DIR_WS_LANGUAGES.$language.'/modules/payment/qiwi.php');

            $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $transaction . "\n" . EMAIL_TEXT_INVOICE_URL . ' ' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $transaction, 'SSL') . "\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . tep_date_long($order->info['date_purchased']) . "\n\n" . $notify_comments . sprintf(EMAIL_TEXT_STATUS_UPDATE, $orders_status_array[MODULE_PAYMENT_QIWI_ORDER_STATUS_ID]);

	// send mail to admin
            tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, MODULE_PAYMENT_QIWI_EMAIL_SUBJECT . ' ' . $transaction, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

	// send mail to customer
            tep_mail($order->customer['firstname'].' '.$order->customer['lastname'], $order->customer['email_address'], MODULE_PAYMENT_QIWI_EMAIL_SUBJECT . ' ' . $transaction, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

	
}

}
?>