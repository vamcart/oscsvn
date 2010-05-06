<?php
/*
  $Id: product_info.php,v 1.2 2003/09/24 14:33:16 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);  

// Start Products Specifications
  require_once (DIR_WS_FUNCTIONS . 'products_specifications.php');

  // Handle the output of the Ask a Question form
  $from_name = '';
  $from_email_address = '';
  $message = '';
  $error_string = '';
  if (isset($_GET['action']) && ($_GET['action'] == 'process') ) {
    $error = false;

    $to_email_address = STORE_OWNER_EMAIL_ADDRESS;
    $to_name = STORE_OWNER;
    $from_email_address = tep_db_prepare_input ($_POST['from_email_address']);
    $from_name = tep_db_prepare_input ($_POST['from_name']);
    $message = tep_db_prepare_input ($_POST['message']);

    if (empty ($from_name) ) {
      $error_string .= 'name';
      $error = true;
    }

    if (!tep_validate_email($from_email_address)) {
      if ($error == true) {
        $error_string .= '-';
      }
      $error_string .= 'email';
    }

    if ($error == false) {
      $email_subject = sprintf (TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME);
      $email_body = sprintf (TEXT_EMAIL_INTRO, $to_name, $from_name, $product_info['products_name'], $product_info['products_model'], STORE_NAME) . "\n\n";

      if (tep_not_null($message)) {
        $email_body .= $message . "\n\n";
      }

      $email_body .= sprintf (TEXT_EMAIL_LINK, tep_href_link (FILENAME_PRODUCT_INFO, 'products_id=' . $_GETS['products_id']) ) . "\n\n" .
                     sprintf (TEXT_EMAIL_SIGNATURE, STORE_NAME . "\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n");

//      tep_mail ($to_name, $to_email_address, $email_subject, $email_body, $from_name, $from_email_address);

      $messageStack->add_session ('header', sprintf (TEXT_EMAIL_SUCCESSFUL_SENT, $product_info['products_name'], tep_output_string_protected ($to_name) ), 'success');

      tep_redirect (tep_href_link (FILENAME_PRODUCT_INFO, tep_get_all_get_params (array ('action', 'tab') ) . 'action=success&tab=ASK'));
    } else {
      tep_redirect (tep_href_link (FILENAME_PRODUCT_INFO, tep_get_all_get_params (array ('action', 'tab') ) . 'tab=ASK&error=' . $error_string));
    }
    
  } elseif (tep_session_is_registered ('customer_id') ) {
    $account_query = tep_db_query ("select customers_firstname, 
                                           customers_lastname, 
                                           customers_email_address 
                                   from " . TABLE_CUSTOMERS . " 
                                   where customers_id = '" . (int) $customer_id . "'
                                 ");
    $account = tep_db_fetch_array($account_query);

    $from_name = $account['customers_firstname'] . ' ' . $account['customers_lastname'];
    $from_email_address = $account['customers_email_address'];
  }

  // Handle errors -- missing name or invalid email. We don't check the message field.
  if (isset ($_GET['error']) && $_GET['error'] != '') {
    $error_array = explode ('-', $_GET['error']);
    for ($index=0, $end=count($error_array); $index<$end; $index++) {
      if ($error_array[$index] == 'name') {
        $messageStack->add ('ask', ERROR_FROM_NAME);
      } else {
        $messageStack->add ('ask', ERROR_FROM_ADDRESS);
      } // if ($error_array .... else ...
    } // for ($index=0
  } // if (isset
// End Products Specifications

  $product_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
  $product_check = tep_db_fetch_array($product_check_query);
  if ($product_check['total'] == 0) {
    header('HTTP/1.1 404 Not Found');
  }

  $content = CONTENT_PRODUCT_INFO;
  $javascript = 'product_info.js';

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
