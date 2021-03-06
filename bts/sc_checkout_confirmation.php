<?php
/*
  $Id: checkout.php,v 1.7 2012/12/02

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  Copyright (c) 2012 STRUB

  Released under the GNU General Public License
*/

/*session description
tep_session_is_registered('create_account') = is used for data processing only
tep_session_is_registered('only_account') = is used to hide shipping and payment data and show only account data
tep_session_is_registered('is_virtual_product') = 

 
tep_session_is_registered('no_pay_no_ship') = is used to hide all data (shipping, payment, account)
*/

require('includes/application_top.php');

  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2);

$hide_shipping_data = false;
$hide_payment_data = false;
$show_account_data = false; //account data will only be shown if in checkout.php the account heading is shown. This happens by free virtual products
$sc_payment_url = false; //used for redirection for url payment modules

if (tep_session_is_registered('hide_shipping_data')) {
	$hide_shipping_data = true; //used to hide shipping data
}

if (tep_session_is_registered('hide_payment_data')) {
	$hide_payment_data = true; //used to hide payment data
}

if (tep_session_is_registered('show_account_data')) {
	$show_account_data = true; //used to show account data
	$hide_shipping_data = true;
	$hide_payment_data = true;
}


// if the customer is not logged on, redirect them to the login page
  if ((!tep_session_is_registered('customer_id')) && (!tep_session_is_registered('noaccount'))) {
    $navigation->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_PAYMENT));
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }




############################# Validate start - NOT LOGGED ON #######################################

$process = false;
if ((tep_session_is_registered('create_account')) && (isset($_POST['action']) && ($_POST['action'] == 'process'))) {
    $process = true;
		
	$error = false;
}




if ($error == true) {
	//for testing
}





// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!tep_session_is_registered('shipping')) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

  if (!tep_session_is_registered('payment')) tep_session_register('payment');
  if (isset($_POST['payment'])) $payment = $_POST['payment'];

  if (!tep_session_is_registered('comments')) tep_session_register('comments');
  if (tep_not_null($_POST['comments'])) {
    $comments = tep_db_prepare_input($_POST['comments']);
  }

// load the selected payment module
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment($payment);



  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

  $payment_modules->update_status();

if (!tep_session_is_registered('free_payment')) { //hack for free payment
  if ( ($payment_modules->selected_module != $payment) || ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$payment) ) || (is_object($$payment) && ($$payment->enabled == false)) ) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
  }
}

  if (is_array($payment_modules->modules)) {
    $payment_modules->pre_confirmation_check();
  }

// load the selected shipping module
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping($shipping);

  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;
  $order_total_modules->process();

// Stock Check
  $any_out_of_stock = false;
  if (STOCK_CHECK == 'true') {
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
        $any_out_of_stock = true;
      }
    }
    // Out of Stock
    if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock == true) ) {
      tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
    }
  }


///////////// START create account //////////////////////////////////////////////////
//if no errors
if ((tep_session_is_registered('create_account')) && (isset($_POST['action']) && ($_POST['action'] == 'process'))) {
    if ($error == false) {

      $sql_data_array = array('customers_firstname' => $_SESSION['sc_customers_firstname'],
                              'customers_lastname' => $_SESSION['sc_customers_lastname'],
                              'customers_email_address' => $_SESSION['sc_customers_email_address'],
                              'customers_telephone' => $_SESSION['sc_customers_telephone'], 
                              'customers_fax' => $_SESSION['sc_customers_fax'],
                              'customers_newsletter' => $_SESSION['sc_customers_newsletter'], 
                              'customers_password' => $_SESSION['sc_customers_password']);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $_SESSION['sc_customers_gender'];
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($_SESSION['sc_customers_dob']);

      tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

      $customer_id = tep_db_insert_id();

      $sql_data_array = array('customers_id' => $customer_id,
                              'entry_firstname' => $_SESSION['sc_customers_firstname'], 
                              'entry_lastname' => $_SESSION['sc_customers_lastname'], 
                              'entry_street_address' => $_SESSION['sc_customers_street_address'], 
                              'entry_postcode' => $_SESSION['sc_customers_postcode'], 
                              'entry_city' => $_SESSION['sc_customers_city'],
                              'entry_country_id' => $_SESSION['sc_customers_country']);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $_SESSION['sc_customers_gender'];
      if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $_SESSION['sc_customers_company']; 
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $_SESSION['sc_customers_suburb']; 
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = $_SESSION['sc_customers_zone_id']; 
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $_SESSION['sc_customers_state']; 
        }
      }
	  

      tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

      $address_id = tep_db_insert_id();

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

      tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");
	  
	  
	  //billto START
	  if ($_SESSION['sc_payment_address_selected'] != '1') { //is unchecked - so payment address is different or if virtual product
        $sql_data_array = array('customers_id' => $customer_id,
                                'entry_firstname' => $_SESSION['sc_payment_firstname'],
                                'entry_lastname' => $_SESSION['sc_payment_lastname'],
                                'entry_street_address' => $_SESSION['sc_payment_street_address'],
                                'entry_postcode' => $_SESSION['sc_payment_postcode'],
                                'entry_city' => $_SESSION['sc_payment_city'],
                                'entry_country_id' => $_SESSION['sc_payment_country']);

        if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $_SESSION['sc_payment_gender'];
        if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $_SESSION['sc_payment_company'];
        if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $_SESSION['sc_payment_suburb'];
        if (ACCOUNT_STATE == 'true') {
          if ($zone_id > 0) {
            $sql_data_array['entry_zone_id'] = $_SESSION['sc_payment_zone_id'];
            $sql_data_array['entry_state'] = '';
          } else {
            $sql_data_array['entry_zone_id'] = '0';
            $sql_data_array['entry_state'] = $_SESSION['sc_payment_state'];
          }
        }

        if (!tep_session_is_registered('billto')) tep_session_register('billto');

        tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

        $billto_payment = tep_db_insert_id();
      }
	  //billto END
	  
	  //register sessions
	  tep_session_register('customer_id');  
	  if (tep_session_is_registered('noaccount')) {tep_session_unregister('noaccount');} 
	  
	  //assign new default address and billing address
	  $customer_default_address_id = $address_id;
	  if ($_SESSION['sc_payment_address_selected'] == '1') { //is selected - payment address is same as shipping address
	  $billto = $customer_default_address_id; 
	  } else { //not selected - so a new address is being created
		  $billto = $billto_payment; 
	  }

	  
	  //do we need this???
	  //tep_session_register('sc_processed');
      tep_session_register('customer_first_name');
      tep_session_register('customer_default_address_id');
      tep_session_register('customer_country_id');
      tep_session_register('customer_zone_id');


	//START send create account mail
	//data needed: gender, firstname, lastname, email
		
	if (tep_session_is_registered('create_account')) {
		//load language file for email
		require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);
	
		$name = $_SESSION['sc_customers_firstname'] . ' ' . $_SESSION['sc_customers_lastname'];
			
		if (ACCOUNT_GENDER == 'true') {
			 if ($gender == 'm') {
				 $email_text = sprintf(EMAIL_GREET_MR, $_SESSION['sc_customers_lastname']);
			} else {
				$email_text = sprintf(EMAIL_GREET_MS, $_SESSION['sc_customers_lastname']);
			}
		} else {
			$email_text = sprintf(EMAIL_GREET_NONE, $_SESSION['sc_customers_firstname']);
		}
		
		if (SC_EMAIL_LOGIN_DATA == 'true') {
				  $email_text .= EMAIL_WELCOME . EMAIL_USERNAME . EMAIL_PASSWORD . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
		} else {
			  $email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
		}
			  	
		tep_mail($name, $_SESSION['sc_customers_email_address'], EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
			
	} 
	tep_session_unregister('create_account');
	//END send create account mail

	} //error end
}  
///////////// END create account //////////////////////////////////////////////////	  
	  

///////////// START Redirection for create account //////////////////////////////////////////////////	
if ((tep_session_is_registered('create_account')) && (isset($_POST['action']) && ($_POST['action'] == 'process'))) {  
// confirm order
	if ($error == false) {
		if (isset($$payment->form_action_url)) {
			$sc_payment_url = true;
			tep_session_unregister('sc_confirmation'); //to make sure if not returning back to checkout_success.php
			$form_action_url = $$payment->form_action_url;
		} else {
			$form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
			tep_redirect($form_action_url); //redirect
		}
	} //error end
}
///////////// END Redirection for create account //////////////////////////////////////////////////	

///////////// START Redirection for noaccount //////////////////////////////////////////////////	
if ((!tep_session_is_registered('create_account')) && (isset($_POST['action']) && ($_POST['action'] == 'process'))) {  
// confirm order
	if (isset($$payment->form_action_url)) {
		$sc_payment_url = true;
		tep_session_unregister('sc_confirmation'); //to make sure if not returning back to checkout_success.php
		$form_action_url = $$payment->form_action_url;
	} else {
		$form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
		tep_redirect($form_action_url); //redirect
	}
}
///////////// END Redirection for noaccount //////////////////////////////////////////////////	




  $content = CONTENT_SC_CHECKOUT_CONFIRMATION;
  $javascript = 'checkout.js.php';

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
