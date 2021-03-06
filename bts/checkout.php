<?php
/*
  $Id: checkout.php,v 1.7 2012/12/02

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  Copyright (c) 2012 STRUB

  Released under the GNU General Public License
*/

//description
//$sendto = is from db table ADRESS_BOOK the adress_book_id

require('includes/application_top.php');
//used for shipping
require('includes/classes/http_client.php');

  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));

//START functions specific
function tep_get_sc_titles_number() {
	if (SC_COUNTER_ENABLED == 'true') {
		static $sc_count = 0;
		$sc_count++;
		return $sc_count . '.&nbsp;&nbsp;';
	}
}
//END functions specific


if (isset($_POST['sc_shipping_address_show'])) { 
$sc_shipping_address_show = $_POST['sc_shipping_address_show'];
} else {
$sc_shipping_address_show = true;
}

if (isset($_POST['sc_shipping_modules_show'])) { 
$sc_shipping_modules_show = $_POST['sc_shipping_modules_show'];
} else {
$sc_shipping_modules_show = true; 
}


//used for the validation
if (isset($_POST['create_account'])) { 
	$create_account = $_POST['create_account'];
} else {
	$create_account = false; 
}

if (isset($_POST['sc_payment_address_show'])) { 
$sc_payment_address_show = $_POST['sc_payment_address_show'];
} else {
$sc_payment_address_show = true;
}

if (isset($_POST['sc_payment_modules_show'])) { 
$sc_payment_modules_show = $_POST['sc_payment_modules_show'];
} else {
$sc_payment_modules_show = true;
}


$checkout_possible = true;
$sc_is_virtual_product = false; //used to change Title Shipping Address to Payment Address and add text (you need to create account...) to create account
$sc_is_mixed_product = false; //virtul and normal products
$sc_is_free_virtual_product = false; // is free virtual product - used to change title shipping address to account information
$sc_payment_modules_process = true; //used to avoid runing payment selection()




//session are used if a visitor cancel during checkout process and returns again he does not need to type his data again
$sc_guest_gender = $_SESSION['sc_customers_gender'];
$sc_guest_firstname = $_SESSION['sc_customers_firstname'];
$sc_guest_lastname = $_SESSION['sc_customers_lastname'];
$sc_guest_dob = $_SESSION['sc_customers_dob'];
$sc_guest_email_address = $_SESSION['sc_customers_email_address'];
$sc_guest_default_address_id = $_SESSION['sc_customers_default_address_id'];
$sc_guest_telephone = $_SESSION['sc_customers_telephone'];
$sc_guest_fax = $_SESSION['sc_customers_fax'];
$sc_guest_company = $_SESSION['sc_customers_company'];
$sc_guest_street_address = $_SESSION['sc_customers_street_address'];
$sc_guest_suburb = $_SESSION['sc_customers_suburb'];
$sc_guest_city = $_SESSION['sc_customers_city'];
$sc_guest_postcode = $_SESSION['sc_customers_postcode'];




//load languages files
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT);
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SHIPPING);
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PAYMENT);
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_CONFIRMATION);
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);

  
////////////  Check Things  ////////////////////
// if there is nothing in the customers cart, redirect them to the shopping cart page
if ($cart->count_contents() < 1) {
   tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
}
 
 
 // Stock Check
  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (tep_check_stock($products[$i]['id'], $products[$i]['quantity'])) {
        tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
        break;
      }
    }
  }



//////////////////  End Check //////////////////////////////

$payment_address_selected = $_POST['payment_adress']; //init if checkbox for payment address is checked or not
$shipping_count_modules = $_POST['shipping_count']; //needed for validation

if (!tep_session_is_registered('customer_id')) { //only for not logged in user
	if (!isset($_POST['action'])) {
		$password_selected = true; 
	} else {
		if (SC_CREATE_ACCOUNT_CHECKOUT_PAGE != 'true') {
			$password_selected = true;
		} else {
			$password_selected = $_POST['password_checkbox']; 
		}
	}
	
	if ($password_selected != '1') { //not selected 
		$create_account = true;
	} else { //is selected
		$create_account = false; //set to false in order to avoid validation
	}
}



############################# Validate start - NOT LOGGED ON #######################################

  $process = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'not_logged_on') && isset($_POST['formid']) && ($_POST['formid'] == $sessiontoken)) {
    $process = true;
	
	if ($sc_shipping_address_show == true) { //show shipping otpions 
    if (ACCOUNT_GENDER == 'true') {
      if (isset($_POST['gender'])) {
        $gender = tep_db_prepare_input($_POST['gender']);
      } else {
        $gender = false;
      }
    }
    $firstname = tep_db_prepare_input($_POST['firstname']);
    $lastname = tep_db_prepare_input($_POST['lastname']);
    if (ACCOUNT_DOB == 'true') $dob = tep_db_prepare_input($_POST['dob']);
    $email_address = tep_db_prepare_input($_POST['email_address']);
    if (ACCOUNT_COMPANY == 'true') $company = tep_db_prepare_input($_POST['company']);
    $street_address = tep_db_prepare_input($_POST['street_address']);
    if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($_POST['suburb']);
    $postcode = tep_db_prepare_input($_POST['postcode']);
    $city = tep_db_prepare_input($_POST['city']);
    if (ACCOUNT_STATE == 'true') {
      $state = tep_db_prepare_input($_POST['state']);
      if (isset($_POST['zone_id'])) {
        $zone_id = tep_db_prepare_input($_POST['zone_id']);
      } else {
        $zone_id = false;
      }
    }
    $country = tep_db_prepare_input($_POST['country']);
    $telephone = tep_db_prepare_input($_POST['telephone']);
    $fax = tep_db_prepare_input($_POST['fax']);
    if (isset($_POST['newsletter'])) {
      $newsletter = tep_db_prepare_input($_POST['newsletter']);
    } else {
      $newsletter = false;
    }
    $password = tep_db_prepare_input($_POST['password']);
    $confirmation = tep_db_prepare_input($_POST['confirmation']);
	
	//start with input validation for shipping address /////////
    $error = false;
	
		
    //if (ACCOUNT_GENDER == 'true') {
      //if ( ($gender != 'm') && ($gender != 'f') ) {
        //$error = true;

        //$messageStack->add('smart_checkout', ENTRY_GENDER_ERROR);
      //}
    //}

    //if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      //$error = true;

      //$messageStack->add('smart_checkout', ENTRY_FIRST_NAME_ERROR);
    //}

    //if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      //$error = true;

      //$messageStack->add('smart_checkout', ENTRY_LAST_NAME_ERROR);
    //}

    //if (ACCOUNT_DOB == 'true') {
      //if ((is_numeric(tep_date_raw($dob)) == false) || (@checkdate(substr(tep_date_raw($dob), 4, 2), substr(tep_date_raw($dob), 6, 2), substr(tep_date_raw($dob), 0, 4)) == false)) {
        //$error = true;

        //$messageStack->add('smart_checkout', ENTRY_DATE_OF_BIRTH_ERROR);
      //}
    //}


	//if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      //$error = true;

      //$messageStack->add('smart_checkout', ENTRY_EMAIL_ADDRESS_ERROR);
    //} elseif (tep_validate_email($email_address) == false) {
      //$error = true;

      //$messageStack->add('smart_checkout', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    //} else {
	  //$check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
	  
      //$check_email = tep_db_fetch_array($check_email_query);
      //if ($check_email['total'] > 0) {
        //$error = true;
		

        //$messageStack->add('smart_checkout', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
      //}
    //}
    
    //if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      //$error = true;

      //$messageStack->add('smart_checkout', ENTRY_STREET_ADDRESS_ERROR);
    //}

    //if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      //$error = true;

      //$messageStack->add('smart_checkout', ENTRY_POST_CODE_ERROR);
    //}

    //if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      //$error = true;

      //$messageStack->add('smart_checkout', ENTRY_CITY_ERROR);
    //}

    //if (is_numeric($country) == false) {
      //$error = true;

      //$messageStack->add('smart_checkout', ENTRY_COUNTRY_ERROR);
    //}

    //if (ACCOUNT_STATE == 'true') {
      $zone_id = 0;
      $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
      $check = tep_db_fetch_array($check_query);
      $entry_state_has_zones = ($check['total'] > 0);
      if ($entry_state_has_zones == true) {
        $zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name = '" . tep_db_input($state) . "' or zone_code = '" . tep_db_input($state) . "')");
        //if (tep_db_num_rows($zone_query) == 1) {
          $zone = tep_db_fetch_array($zone_query);
          $zone_id = $zone['zone_id'];
        //} else {
          //$error = true;

          //$messageStack->add('smart_checkout', ENTRY_STATE_ERROR_SELECT);
        //}
      //} else {
        //if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          //$error = true;

          //$messageStack->add('smart_checkout', ENTRY_STATE_ERROR);
        //}
      //}
    }

    //if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      //$error = true;

      //$messageStack->add('smart_checkout', ENTRY_TELEPHONE_NUMBER_ERROR);
    //}
	
	//password validation
	//$password = tep_db_prepare_input($_POST['password']);
    //$confirmation = tep_db_prepare_input($_POST['confirmation']);
	//if ($create_account == true) {
		//if (!tep_session_is_registered('customer_id')) { //validate only for unregistered user
		 //if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
			  //$error = true;
	
			  //$messageStack->add('smart_checkout', ENTRY_PASSWORD_ERROR);
			//} elseif ($password != $confirmation) {
			  //$error = true;
	
			  //$messageStack->add('smart_checkout', ENTRY_PASSWORD_ERROR_NOT_MATCHING);
			//}
		//}
	//}	
	
	//shipping validation
	$shipping_validation = $_POST['shipping'];
	if ($sc_shipping_modules_show == true) {
		if (($shipping_validation == '') && ($shipping_count_modules > 1)) {
			$error = true;
			$messageStack->add('smart_checkout', SHIPPING_ERROR);
		}
	}
	
	
		
	/*if ($sc_shipping_modules_show == true) {
		if (($shipping_validation == '') && ($shipping_count_modules == 1)) {
			$error = true;
			$messageStack->add('smart_checkout', SHIPPING_ERROR);
		}
	}*/
	
	//payment validation
	$payment_validation = $_POST['payment'];
	if ($sc_payment_modules_show == true) { 
		if ($payment_validation == '') {
			$error = true;
			$messageStack->add('smart_checkout', PAYMENT_ERROR);
		}
	}

	//conditions validation
	//$conditions_validation = $_POST['TermsAgree'];
	//if (($conditions_validation == '') && (SC_CONDITIONS == 'true')) {
		//$error = true;
		//$messageStack->add('smart_checkout', CONDITIONS_ERROR);
    //}
	
	
	//End with input validation for shipping address /////////	
	} //End show shipping otpions


	// start new payment address input validation /////
	if ($payment_address_selected != '1') { //is unchecked - so payment address is different or if we have virtual products
	  
	 if ($sc_payment_address_show == true) { //validate only if not free payment 
		
      if (ACCOUNT_GENDER == 'true') $gender_payment = tep_db_prepare_input($_POST['gender_payment']);
      if (ACCOUNT_COMPANY == 'true') $company_payment = tep_db_prepare_input($_POST['company_payment']);
      $firstname_payment = tep_db_prepare_input($_POST['firstname_payment']);
      $lastname_payment = tep_db_prepare_input($_POST['lastname_payment']);
      $street_address_payment = tep_db_prepare_input($_POST['street_address_payment']);
      if (ACCOUNT_SUBURB == 'true') $suburb_payment = tep_db_prepare_input($_POST['suburb_payment']);
      $postcode_payment = tep_db_prepare_input($_POST['postcode_payment']);
      $city_payment = tep_db_prepare_input($_POST['city_payment']);
      $country_payment = tep_db_prepare_input($_POST['country_payment']);
      if (ACCOUNT_STATE == 'true') {
        if (isset($_POST['zone_id'])) {
          $zone_id_payment = tep_db_prepare_input($_POST['zone_id_payment']);
        } else {
          $zone_id_payment = false;
        }
        $state_payment = tep_db_prepare_input($_POST['state_payment']);
      }

      //if (ACCOUNT_GENDER == 'true') {
        //if ( ($gender_payment != 'm') && ($gender_payment != 'f') ) {
          //$error = true;

          //$messageStack->add('smart_checkout', ENTRY_GENDER_ERROR);
        //}
      //}

		
      //if (strlen($firstname_payment) < ENTRY_FIRST_NAME_MIN_LENGTH) {
        //$error = true;

        //$messageStack->add('smart_checkout', ENTRY_FIRST_NAME_ERROR);
      //}

      //if (strlen($lastname_payment) < ENTRY_LAST_NAME_MIN_LENGTH) {
        //$error = true;

        //$messageStack->add('smart_checkout', ENTRY_LAST_NAME_ERROR);
      //}

      //if (strlen($street_address_payment) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
        //$error = true;

        //$messageStack->add('smart_checkout', ENTRY_STREET_ADDRESS_ERROR);
      //}

      //if (strlen($postcode_payment) < ENTRY_POSTCODE_MIN_LENGTH) {
        //$error = true;

        //$messageStack->add('smart_checkout', ENTRY_POST_CODE_ERROR);
      //}

      //if (strlen($city_payment) < ENTRY_CITY_MIN_LENGTH) {
        //$error = true;

        //$messageStack->add('smart_checkout', ENTRY_CITY_ERROR);
      //}

      //if (ACCOUNT_STATE == 'true') {
        //$zone_id_payment = 0;
        //$check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_payment . "'");
        //$check = tep_db_fetch_array($check_query);
        //$entry_state_has_zones = ($check['total'] > 0);
        //if ($entry_state_has_zones == true) {
          //$zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_payment . "' and (zone_name = '" . tep_db_input($state_payment) . "' or zone_code = '" . tep_db_input($state_payment) . "')");
          //if (tep_db_num_rows($zone_query) == 1) {
            //$zone_payment = tep_db_fetch_array($zone_query);
            //$zone_id_payment = $zone_payment['zone_id'];
          //} else {
            //$error = true;

            //$messageStack->add('smart_checkout', ENTRY_STATE_ERROR_SELECT);
          //}
        //} else {
          //if (strlen($state_payment) < ENTRY_STATE_MIN_LENGTH) {
            //$error = true;

            //$messageStack->add('smart_checkout', ENTRY_STATE_ERROR);
          //}
        //}
      //}

      //if ( (is_numeric($country_payment) == false) || ($country_payment < 1) ) {
        //$error = true;

        //$messageStack->add('smart_checkout', ENTRY_COUNTRY_ERROR);
      //}
	 }
	} //END validate only if not free payment 
	 // End new payment address input validation /////

	$_SESSION['kvit_name'] = tep_db_prepare_input($_POST['kvit_name']);
	$_SESSION['kvit_address'] = tep_db_prepare_input($_POST['kvit_address']);

	$_SESSION['s_name'] = tep_db_prepare_input($_POST['s_name']);
	$_SESSION['s_inn'] = tep_db_prepare_input($_POST['s_inn']);
	$_SESSION['s_kpp'] = tep_db_prepare_input($_POST['s_kpp']);
	$_SESSION['s_ogrn'] = tep_db_prepare_input($_POST['s_ogrn']);
	$_SESSION['s_okpo'] = tep_db_prepare_input($_POST['s_okpo']);
	$_SESSION['s_rs'] = tep_db_prepare_input($_POST['s_rs']);
	$_SESSION['s_bank_name'] = tep_db_prepare_input($_POST['s_bank_name']);
	$_SESSION['s_bik'] = tep_db_prepare_input($_POST['s_bik']);
	$_SESSION['s_ks'] = tep_db_prepare_input($_POST['s_ks']);
	$_SESSION['s_address'] = tep_db_prepare_input($_POST['s_address']);
	$_SESSION['s_yur_address'] = tep_db_prepare_input($_POST['s_yur_address']);
	$_SESSION['s_fakt_address'] = tep_db_prepare_input($_POST['s_fakt_address']);
	$_SESSION['s_telephone'] = tep_db_prepare_input($_POST['s_telephone']);
	$_SESSION['s_fax'] = tep_db_prepare_input($_POST['s_fax']);
	$_SESSION['s_email'] = tep_db_prepare_input($_POST['s_email']);
	$_SESSION['s_director'] = tep_db_prepare_input($_POST['s_director']);
	$_SESSION['s_accountant'] = tep_db_prepare_input($_POST['s_accountant']);
	
}
//////////////////////////  Validation END - NOT LOGGED ON//////////////////////////////////



/////////////////// Validation for LOGGED ON ////////////////////////////////////////////
if (isset($_POST['action']) && ($_POST['action'] == 'logged_on') && isset($_POST['formid']) && ($_POST['formid'] == $sessiontoken)) {

		if (!tep_session_is_registered('comments')) tep_session_register('comments');
		if (tep_not_null($_POST['comments'])) {
		  $comments = tep_db_prepare_input($_POST['comments']);
		}

	$_SESSION['kvit_name'] = tep_db_prepare_input($_POST['kvit_name']);
	$_SESSION['kvit_address'] = tep_db_prepare_input($_POST['kvit_address']);

	$_SESSION['s_name'] = tep_db_prepare_input($_POST['s_name']);
	$_SESSION['s_inn'] = tep_db_prepare_input($_POST['s_inn']);
	$_SESSION['s_kpp'] = tep_db_prepare_input($_POST['s_kpp']);
	$_SESSION['s_ogrn'] = tep_db_prepare_input($_POST['s_ogrn']);
	$_SESSION['s_okpo'] = tep_db_prepare_input($_POST['s_okpo']);
	$_SESSION['s_rs'] = tep_db_prepare_input($_POST['s_rs']);
	$_SESSION['s_bank_name'] = tep_db_prepare_input($_POST['s_bank_name']);
	$_SESSION['s_bik'] = tep_db_prepare_input($_POST['s_bik']);
	$_SESSION['s_ks'] = tep_db_prepare_input($_POST['s_ks']);
	$_SESSION['s_address'] = tep_db_prepare_input($_POST['s_address']);
	$_SESSION['s_yur_address'] = tep_db_prepare_input($_POST['s_yur_address']);
	$_SESSION['s_fakt_address'] = tep_db_prepare_input($_POST['s_fakt_address']);
	$_SESSION['s_telephone'] = tep_db_prepare_input($_POST['s_telephone']);
	$_SESSION['s_fax'] = tep_db_prepare_input($_POST['s_fax']);
	$_SESSION['s_email'] = tep_db_prepare_input($_POST['s_email']);
	$_SESSION['s_director'] = tep_db_prepare_input($_POST['s_director']);
	$_SESSION['s_accountant'] = tep_db_prepare_input($_POST['s_accountant']);
	
	// start with input validation /////////
    $error = false;
	
	//shipping validation
	$shipping_validation = $_POST['shipping'];
	if ($sc_shipping_modules_show == true) {
		if (($shipping_validation == '') && ($shipping_count_modules > 1)) {
			$error = true;
			$messageStack->add('smart_checkout', SHIPPING_ERROR);
		}
	}
	
	//payment validation
	$payment_validation = $_POST['payment'];
	if ($sc_payment_modules_show == true) { 
		if ($payment_validation == '') {
			$error = true;
			$messageStack->add('smart_checkout', PAYMENT_ERROR);
		}
	}
	
	//conditions validation
	//$conditions_validation = $_POST['TermsAgree'];
	//if (($conditions_validation == '') && (SC_CONDITIONS == 'true')) {
		//$error = true;
		//$messageStack->add('smart_checkout', CONDITIONS_ERROR);
    //}
	
}	

/////////// end with input validation for LOOGED ON /////////

//load Classes 
require(DIR_WS_CLASSES.'shipping.php');
require(DIR_WS_CLASSES.'payment.php'); 
require(DIR_WS_CLASSES.'order.php');
require(DIR_WS_CLASSES.'order_total.php');






if (!tep_session_is_registered('payment')) {tep_session_register('payment');}
if (!tep_session_is_registered('sendto')) {tep_session_register('sendto');} //need to set it otherwise in checkout_process.php we get redirected to checkout_shipping.php
if (!tep_session_is_registered('billto')) {tep_session_register('billto');} //need to set it otherwise in checkout_process.php we get redirected to payment_shipping.php
if (tep_session_is_registered('free_payment')) {tep_session_unregister('free_payment');} //hack for free payment unregister it if changing products

if (tep_session_is_registered('noaccount')) {tep_session_unregister('noaccount');} //used for order class - order.php
if (tep_session_is_registered('show_account_data')) {tep_session_unregister('show_account_data');} //used for confirmation page to show account data
if (tep_session_is_registered('create_account')) {tep_session_unregister('create_account');} //used for confirmation page to send email if account is created
if (tep_session_is_registered('hide_shipping_data')) {tep_session_unregister('hide_shipping_data');} //used for confirmation page to hide shipping data
if (tep_session_is_registered('hide_payment_data')) {tep_session_unregister('hide_payment_data');} //used for confirmation page to hide payment data





//Classes init need to set here
$order = new order;  



//set $selected_country_id
//if logged in set $selected_country_id from order class else from selected Post
if (tep_session_is_registered('customer_id')) {
$selected_country_id = $order->delivery['country']['id'];
} else {
//$selected_country_id = $_POST['country'];
if (isset($_POST['country'])) {
  $selected_country_id = $_POST['country'];
} else {
  $selected_country_id = STORE_COUNTRY; //here you can set your default country ID
}

}



// country is selected
        $country_info = tep_get_countries($selected_country_id,true);
        $cache_state_prov_values = tep_db_fetch_array(tep_db_query("select zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$selected_country_id . "' and zone_name = '" . tep_db_input($_POST['state']) . "'"));
        $cache_state_prov_code = $cache_state_prov_values['zone_code'];
        if (!tep_session_is_registered('customer_id')) {
        $order->delivery = array('postcode' => tep_db_prepare_input($_POST['postcode']),
                                 'state' => tep_db_prepare_input($_POST['state']),
                                 'city' => tep_db_prepare_input($_POST['city']),
                                 'country' => array('id' => $selected_country_id, 'title' => $country_info['countries_name'], 'iso_code_2' => $country_info['countries_iso_code_2'], 'iso_code_3' =>  $country_info['countries_iso_code_3']),
                                 'country_id' => $selected_country_id,
//add state zone_id
                                 'zone_id' => $cache_state_prov_values['zone_id'],
                                 'format_id' => tep_get_address_format_id($selected_country_id));
// country is selected End					
        }							 	  


  


$shipping_modules = new shipping; //set it after getting country_info otherwise it won't update shipping methods with jquery

$total_weight = $cart->show_weight(); //set before $shipping is defined

//used for post data for validation
$shipping_count = tep_count_shipping_modules();




// Free Shipping module
  if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) {
    $pass = false;

    switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
      case 'national':
        if ($order->delivery['country_id'] == STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'international':
        if ($order->delivery['country_id'] != STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'both':
        $pass = true;
        break;
    }

    $free_shipping = false;
    if ( ($pass == true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) ) {
      $free_shipping = true;

      include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');
    }
  } else {
    $free_shipping = false;
  }

		
// Free Shipping module End





// START calculation if 0 shipping method is active ////
if (tep_count_shipping_modules() == 0) {
// get all available shipping quotes
		$shipping = array	('id' => '', 'title' => '<span class="errorText">' . TEXT_NO_SHIPPING_AVAILABLE . '</span>', 'cost' => '');
		$checkout_possible = false;
		
}
// END calculation if 0 shipping method is active ////

// calculation if only 1 shipping method is set ////
  if (tep_count_shipping_modules() == 1) {
  		
		// get all available shipping quotes
		$quotes = $shipping_modules->quote();

		$ship_id = $quotes[0]['id'] . '_' . $quotes[0]['methods'][0]['id'];
		  
		if ($quotes[0]['error'] == '') {
		  	$ship_title = $quotes[0]['module'] . ' (' . $quotes[0]['methods'][0]['title'] . ')';
			
		} elseif ($quotes[0]['methods'][0]['title'] == 'u') {
		  	$ship_title = '<span class="errorText">adsfdsfsdf</span>';
			$checkout_possible = false; //checkout not possible
		} else {
		  	$ship_title = '<span class="errorText">' . $quotes[0]['error'] . '</span>';
			$checkout_possible = false; //checkout not possible
			
			
		}
		
		
		$ship_cost = $quotes[0]['methods'][0]['cost'];
		
		if ($free_shipping == true) {
			$shipping = array	('id' => '', 'title' => FREE_SHIPPING_TITLE, 'cost' => 0); 
		} else {
			$shipping = array	('id' => $ship_id, 'title' => $ship_title, 'cost' => $ship_cost);
			if ($ship_cost == 0) {
				$checkout_possible = false;
			} 
			
		}	  
  		
		//calculation for Jquery Post
		if (isset($_POST['shipping']) && tep_not_null($_POST['shipping'])){  //$shipping start test
			//no calculation yet
			
		} else {
		  //calculation first time ////////////
		  
			if ($order->content_type == 'virtual') {
				$shipping = false; //set it also in this case if only one shipping method is set
			}
			
			$order = new order;  //set it here again to calculate shipping method after $shipping is defined
			
			
			// country info for country change
					$country_info = tep_get_countries($selected_country_id,true);
					$cache_state_prov_values = tep_db_fetch_array(tep_db_query("select zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$selected_country_id . "' and zone_name = '" . tep_db_input($_POST['state']) . "'"));
					$cache_state_prov_code = $cache_state_prov_values['zone_code'];
					if (!tep_session_is_registered('customer_id')) {
					$order->delivery = array('postcode' => tep_db_prepare_input($_POST['postcode']),
											 'state' => tep_db_prepare_input($_POST['state']),
                                  'city' => tep_db_prepare_input($_POST['city']),
											 'country' => array('id' => $selected_country_id, 'title' => $country_info['countries_name'], 'iso_code_2' => $country_info['countries_iso_code_2'], 'iso_code_3' =>  $country_info['countries_iso_code_3']),
											 'country_id' => $selected_country_id,
			//add state zone_id
											 'zone_id' => $cache_state_prov_values['zone_id'],
											 'format_id' => tep_get_address_format_id($selected_country_id));
			// end country info for country change			
					}								 	  
			  
		} //$shipping end test
  } 
// END - if only 1 shipping method is set ////  
  
 
//Classes init ##########################################
$total_count = $cart->count_contents();  

if (isset($_POST['payment'])){ $payment = $_POST['payment'];} //payment post data assignment

//payment class
if ((!isset($_POST['payment'])) || ($error == true)) {
	$payment_modules = new payment();
} elseif (isset($_POST['payment'])) {
	$payment_modules = new payment($payment);
}


$order_total_modules = new order_total;

//Classes init end ##########################################



############# Shipping specific  ####################
/*
 // if no shipping destination address was selected, use the customers own address as default
  if (!tep_session_is_registered('sendto')) {
    tep_session_register('sendto');
    $sendto = $customer_default_address_id;
  } else {
// verify the selected shipping address
    if ( (is_array($sendto) && empty($sendto)) || is_numeric($sendto) ) {
      $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$sendto . "'");
      $check_address = tep_db_fetch_array($check_address_query);

      if ($check_address['total'] != '1') {
        $sendto = $customer_default_address_id;
        if (tep_session_is_registered('shipping')) tep_session_unregister('shipping');
      }
    }
  }
*/

  
// register a random ID in the session to check throughout the checkout procedure
// against alterations in the shopping cart contents
  if (!tep_session_is_registered('cartID')) tep_session_register('cartID');
  $cartID = $cart->cartID;

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      tep_redirect(tep_href_link(FILENAME_SHOPPING_CART, '', 'SSL'));
    }
  }

############## START definition of product types #######################################################   
  //normal product
  if ($order->content_type == 'physical') {
  	//define
  }
  
  // in this case we need to hide shipping address and only payment address is shown as there is no shipping 
  if ($order->content_type == 'virtual') {
    if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
    $shipping = false;
    $sendto = false;
	$checkout_possible = true; //avoid shipping validation
	
	$payment_address_selected = '1'; //hide payemt address validation
	$sc_is_virtual_product = true; // change Title
	if (!tep_session_is_registered('hide_shipping_data')) tep_session_register('hide_shipping_data'); //hide shipping data
	$sc_payment_address_show = false; // hide payemt address as shipping address is used for payment address
	$sc_shipping_modules_show = false; //hide shipping modules
	$create_account = true; //you need to create an account
	
	if (tep_session_is_registered('customer_id')) { //IS LOGGED ON - change shipping address to payment address
		$sc_payment_address_show = true;
		$sc_shipping_address_show = false;
		$create_account = false;
		//if (tep_session_is_registered('create_account')) {tep_session_unregister('create_account');} //is not possible
		if (!tep_session_is_registered('hide_shipping_data')) tep_session_register('hide_shipping_data'); //hide shipping data
	}
  }

//Mixed virtual products
  if ($order->content_type == 'mixed') {
	$create_account = true; //you need to create an account
	if (!tep_session_is_registered('create_account')) {tep_session_register('create_account');}
	$sc_is_mixed_product = true;
	if (tep_session_is_registered('customer_id')) { //IS LOGGED ON
		$create_account = false;
	}
  }

//Free products - could have shipping costs so payment is needed
  if ($order->info['subtotal'] == '0') {
	if (tep_session_is_registered('customer_id')) { //IS LOGGED ON
		$sendto = $customer_default_address_id; 
	}
  }


//Free products and free shipping
  /*if ($order->info['total'] == '0') {
	$payment_address_selected = '1'; //hide payemt address validation
	$sc_payment_address_show = false; // hide payemt address as shipping address is used for payment address
	$sc_payment_modules_show = false; //hide payment modules
	if (!tep_session_is_registered('free_payment')) {tep_session_register('free_payment');} //hack for free payment
	
	if (tep_session_is_registered('customer_id')) { //IS LOGGED ON
		$sendto = $customer_default_address_id; 
	}
  }*/


//Free Virtual Products
  if (($order->info['subtotal'] == '0') && ($order->content_type == 'virtual')) {
	  
	  $sc_is_free_virtual_product = true; // is free virtual product
	  $sc_payment_address_show = false;
	  $sc_payment_modules_show = false; //hide payment modules
	  if (!tep_session_is_registered('hide_payment_data')) tep_session_register('hide_payment_data');
	  if (!tep_session_is_registered('show_account_data')) tep_session_register('show_account_data');
	  if (!tep_session_is_registered('free_payment')) {tep_session_register('free_payment');} //hack for free payment
	  
	  if (tep_session_is_registered('customer_id')) { //IS LOGGED ON
		$sendto = $customer_default_address_id;
	  }
  }
  

//  

  
	
	
  if (SC_CREATE_ACCOUNT_CHECKOUT_PAGE == 'true') {
  	//$create_account = true; //you need to create an account
	//if (!tep_session_is_registered('create_account')) {tep_session_register('create_account');}
	if (tep_session_is_registered('customer_id')) { //IS LOGGED ON
	//	if (tep_session_is_registered('create_account')) {tep_session_unregister('create_account');} //is not possible
	}
  }
  
  if (SC_CREATE_ACCOUNT_REQUIRED == 'true') {
  	$create_account = true; //you need to create an account
	if (!tep_session_is_registered('create_account')) {tep_session_register('create_account');}
	if (tep_session_is_registered('customer_id')) { //IS LOGGED ON
		$create_account = false;
	}
  }
  
  
  //register session to create account
  if (SC_CONFIRMATION_PAGE == 'true') {
  	if (tep_session_is_registered('customer_id')) {
		if (tep_session_is_registered('create_account')) {tep_session_unregister('create_account');} //is not possible
	} else { //is not looged on
		if ($create_account == true) {
			if (!tep_session_is_registered('create_account')) {tep_session_register('create_account');}
		} else {
			if (tep_session_is_registered('create_account')) {tep_session_unregister('create_account');}
		}
	}
	//after session set, if confirmation page always set to false as it will be created in confirmation_page.php 
	$create_account = false;
  } 
  
############## END definition of product types #######################################################  


//bugfix
if ($sendto == '') {
	$new_address_query = tep_db_query("select customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
	$new_address = tep_db_fetch_array($new_address_query);   // Hole Language aus orders DB
	$sendto = $new_address['customers_default_address_id'];
}
//bugfix end


if (!tep_session_is_registered('shipping')){ tep_session_register('shipping');}


if (isset($_POST['shipping']) && tep_not_null($_POST['shipping'])){ //used THAT IT IS not 0 again
  if ($_POST['shipping'] != 'undefined') { //to avoid setting Jquery send data which is undefined
    if ( (tep_count_shipping_modules() > 1) || ($free_shipping == true) ) { //set (tep_count_shipping_modules() > 1) to 1 instead of 0 because only one shipping method is calculated below
      
		$shipping = $_POST['shipping']; //shipping post data assignement
		//here is the selected shipping module defined
		
        list($module, $method) = explode('_', $shipping);
        if ( is_object($$module) || ($shipping == 'free_free') ) {
          if ($shipping == 'free_free') {
            $quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;
            $quote[0]['methods'][0]['cost'] = '0';
          } else {
            $quote = $shipping_modules->quote($method, $module);
          }
          if (isset($quote['error'])) {
            tep_session_unregister('shipping');
          } else {
            if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ) {
				
              $shipping = array('id' => $shipping,
                                'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
                                'cost' => $quote[0]['methods'][0]['cost']);

              //tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
          }
        } else {
          tep_session_unregister('shipping');
        }
     
    }
	}
  }	
################## Shipping specific END  #####################


################## Payment specific   #####################
// if no billing destination address was selected, use the customers own address as default
  if (!tep_session_is_registered('billto')) {
    tep_session_register('billto');
    $billto = $customer_default_address_id;
  } else {
 
// verify the selected billing address
    if ( (is_array($billto) && empty($billto)) || is_numeric($billto) ) {
      $check_billto_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$billto . "'");
      $check_billto = tep_db_fetch_array($check_billto_query);
      if ($check_billto['total'] != '1') {
        $billto = $customer_default_address_id;
        if (tep_session_is_registered('payment')) tep_session_unregister('payment');
      } 
    }
  }

//solves bug for no payment address
if (($billto == '') && (!tep_session_is_registered('changed_adress'))) {
	$new_address_query = tep_db_query("select customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
	$new_address = tep_db_fetch_array($new_address_query);   // Hole Language aus orders DB
	$billto = $new_address['customers_default_address_id'];
}
if (tep_session_is_registered('changed_adress')) tep_session_unregister('changed_adress');
// end bug

################## Payment specific END  #####################



//CHECK if checkout is possible here after all calculations for noaccount and logged on user/////
//if (isset($_POST['action'])) {
//if ($checkout_possible != true) {
		//$error = true;
		//$messageStack->add('smart_checkout', SC_ERROR_NO_SHIPPING_POSSIBLE);
	//}
//}
//END CHECK if checkout is possible here after all calculations /////	
	

///////////////////  START PROCESS Button pressed for NO ACCOUNT onepage and confirmation page  ////////////////////////////////////////////
if (isset($_POST['action']) && (($_POST['action'] == 'not_logged_on') && ($create_account != true)) && isset($_POST['formid']) && ($_POST['formid'] == $sessiontoken)) {
//if no errors
//checkout not possible used for shipping method or whatever
	
	
	
    if ($error == false) {
		
		$dbPass = tep_encrypt_password($password);
		
      	if (!tep_session_is_registered('noaccount')) {tep_session_register('noaccount');} //used for order class - order.php
        //create sessions
		$_SESSION['sc_payment_address_selected'] = $payment_address_selected; //payment address selected
		
		//customer data is also shipping data
    	$_SESSION['sc_customers_gender'] = $gender;
		$_SESSION['sc_customers_firstname'] = $firstname;
		$_SESSION['sc_customers_lastname'] = $lastname;
		$_SESSION['sc_customers_email_address'] = $email_address;
		$_SESSION['sc_customers_telephone'] = $telephone;
		$_SESSION['sc_customers_fax'] = $fax;
		$_SESSION['sc_customers_company'] = $company;
		$_SESSION['sc_customers_street_address'] = $street_address;
		$_SESSION['sc_customers_suburb'] = $suburb;
		$_SESSION['sc_customers_city'] = $city;
		$_SESSION['sc_customers_postcode'] = $postcode;
		$_SESSION['sc_customers_state'] = $state;
		$_SESSION['sc_customers_country'] = $country;
		
		//for account
		$_SESSION['sc_customers_newsletter'] = $newsletter;
		$_SESSION['sc_customers_password'] = $dbPass;
		$_SESSION['sc_customers_dob'] = $dob;
		
		if (ACCOUNT_STATE == 'true') {
			if ($zone_id > 0) {
			  $_SESSION['sc_customers_zone_id'] = $zone_id;
			  $_SESSION['sc_customers_state'] = '';
			} else {
			  $_SESSION['sc_customers_zone_id'] = '0';
			  $_SESSION['sc_customers_state'] = $state;
			}
     	}
		
		
		
		//payment data only if different
		if ($payment_address_selected != '1') { //is unchecked - so payment address is different
		
			$_SESSION['sc_payment_gender'] = $gender_payment;
			$_SESSION['sc_payment_firstname'] = $firstname_payment;
			$_SESSION['sc_payment_lastname'] = $lastname_payment;
			$_SESSION['sc_payment_company'] = $company_payment;
			$_SESSION['sc_payment_street_address'] = $street_address_payment;
			$_SESSION['sc_payment_suburb'] = $suburb_payment;
			$_SESSION['sc_payment_city'] = $city_payment;
			$_SESSION['sc_payment_postcode'] = $postcode_payment;
			$_SESSION['sc_payment_state'] = $state_payment;
			$_SESSION['sc_payment_country'] = $country_payment;
			
			if (ACCOUNT_STATE == 'true') {
				if ($zone_id > 0) {
				  $_SESSION['sc_payment_zone_id'] = $zone_id_payment;
				  $_SESSION['sc_payment_state'] = '';
				} else {
				  $_SESSION['sc_payment_zone_id'] = '0';
				  $_SESSION['sc_payment_state'] = $state_payment;
				}
			}
		}
				  

		if (SESSION_RECREATE == 'True') {
	    	tep_session_recreate();
		}	
		
		  
		############################# process the selected shipping method ######################################
		if (!tep_session_is_registered('comments')) tep_session_register('comments');
		if (tep_not_null($_POST['comments'])) {
		  $comments = tep_db_prepare_input($_POST['comments']);
		}


		/// This we ne to process also for updating jquery shipping value
		if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
		if (isset($_POST['shipping']) && tep_not_null($_POST['shipping'])){ //used THAT IT IS not 0 again
	
		if ( (tep_count_shipping_modules() > 1) || ($free_shipping == true) ) {
			//here is the selected shipping module defined
			$shipping = $_POST['shipping']; 
		

		
			list($module, $method) = explode('_', $shipping);
			if ( is_object($$module) || ($shipping == 'free_free') ) {
			  if ($shipping == 'free_free') {
				$quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;
				$quote[0]['methods'][0]['cost'] = '0';
			  } else {
				$quote = $shipping_modules->quote($method, $module);
			  }
			  if (isset($quote['error'])) {
				tep_session_unregister('shipping');
			  } else {
				if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ) {
				  $shipping = array('id' => $shipping,
									'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
									'cost' => $quote[0]['methods'][0]['cost']);
	
				  //tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
				}
			  }
			} else {
			  tep_session_unregister('shipping');
			}
		  }
		}	  
		############################# process the selected shipping method END ######################################
	
	
		############################# process the selected payment method ######################################
		if (isset($_POST['payment'])) $payment = $_POST['payment'];
		############################# process the selected payment method END ######################################
	
	
		
		//if everything is OK process the order
		$sc_payment_url = false;
		if (isset($$payment->form_action_url)) {
			if (SC_CONFIRMATION_PAGE == 'true') {
				$sc_payment_url = false;
				$form_action_url = tep_href_link(FILENAME_SC_CHECKOUT_CONFIRMATION, '', 'SSL');
				tep_redirect($form_action_url); //redirect to checkout_pocess.php
				//$order = new order;  //set new order for post data
			} else {
				//$form_action_url = $$payment->form_action_url;
				$sc_payment_url = true;
				$sc_payment_modules_process = false; //set to false in order not to load payment selection()
				$order = new order;  //set new order for post data
			}
		} else { //process for non-url payment modules
			if (SC_CONFIRMATION_PAGE == 'true') {
				//if confimation is true
				$form_action_url = tep_href_link(FILENAME_SC_CHECKOUT_CONFIRMATION, '', 'SSL');
			} else {
				$form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
			}
			tep_redirect($form_action_url); //redirect to checkout_pocess.php
		}
	
	}
}
///////////////////  END PROCESS Button pressed for NO ACCOUNT onepage and no confirmation page  ////////////////////////////////////////////



///////////////////  START PROCESS Button pressed for ACCOUNT CREATION - only onepage ////////////////////////////////////////////
if (isset($_POST['action']) && (($_POST['action'] == 'not_logged_on') && ($create_account == true)) && isset($_POST['formid']) && ($_POST['formid'] == $sessiontoken)) {
//if no errors

        $extra_fields_query = tep_db_query("select ce.fields_id, ce.fields_input_type, ce.fields_required_status, cei.fields_name, ce.fields_status, ce.fields_input_type, ce.fields_size from " . TABLE_EXTRA_FIELDS . " ce, " . TABLE_EXTRA_FIELDS_INFO . " cei where ce.fields_status=1 and ce.fields_required_status=1 and cei.fields_id=ce.fields_id and cei.languages_id =" . $languages_id);
   while($extra_fields = tep_db_fetch_array($extra_fields_query)){
    if(strlen($_POST['fields_' . $extra_fields['fields_id']])<$extra_fields['fields_size']){
      $error = true;
      $string_error=sprintf(ENTRY_EXTRA_FIELDS_ERROR,$extra_fields['fields_name'],$extra_fields['fields_size']);
      $messageStack->add('create_account', $string_error);
    }
  }

    if ($error == false) {

	  $dbPass = tep_encrypt_password($password);

      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_newsletter' => $newsletter,
                              'customers_password' => $dbPass);
                              

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($dob);

      tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

      $customer_id = tep_db_insert_id();

   	  	$extra_fields_query = tep_db_query("select ce.fields_id from " . TABLE_EXTRA_FIELDS . " ce where ce.fields_status=1 ");
    	  while($extra_fields = tep_db_fetch_array($extra_fields_query))
				{
				  if(isset($_POST['fields_' . $extra_fields['fields_id']])){
            $sql_data_array = array('customers_id' => (int)$customer_id,
                              'fields_id' => $extra_fields['fields_id'],
                              'value' => $_POST['fields_' . $extra_fields['fields_id']]);
       		}
       		else
					{
					  $sql_data_array = array('customers_id' => (int)$customer_id,
                              'fields_id' => $extra_fields['fields_id'],
                              'value' => '');
						$is_add = false;
						for($i = 1; $i <= $_POST['fields_' . $extra_fields['fields_id'] . '_total']; $i++)
						{
							if(isset($_POST['fields_' . $extra_fields['fields_id'] . '_' . $i]))
							{
							  if($is_add)
							  {
                  $sql_data_array['value'] .= "\n";
								}
								else
								{
                  $is_add = true;
								}
              	$sql_data_array['value'] .= $_POST['fields_' . $extra_fields['fields_id'] . '_' . $i];
							}
						}
					}

					tep_db_perform(TABLE_CUSTOMERS_TO_EXTRA_FIELDS, $sql_data_array);
      	}

      $sql_data_array = array('customers_id' => $customer_id,
                              'entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_country_id' => $country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = $zone_id;
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }
	  

      tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

      $address_id = tep_db_insert_id();

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

      tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");

      if (SESSION_RECREATE == 'True') {
        tep_session_recreate();
      }

      $customer_first_name = $firstname;
      $customer_default_address_id = $address_id;
      $customer_country_id = $country;
      $customer_zone_id = $zone_id;
      tep_session_register('customer_id');  
      tep_session_register('customer_first_name');
      tep_session_register('customer_default_address_id');
      tep_session_register('customer_country_id');
      tep_session_register('customer_zone_id');
	  // Customers Data are stored into to DB table "customers" and "Adress_book"
############################# create_account End process #######################################

      if ($payment_address_selected != '1') { //is unchecked - so payment address is different or if virtual product
        $sql_data_array = array('customers_id' => $customer_id,
                                'entry_firstname' => $firstname_payment,
                                'entry_lastname' => $lastname_payment,
                                'entry_street_address' => $street_address_payment,
                                'entry_postcode' => $postcode_payment,
                                'entry_city' => $city_payment,
                                'entry_country_id' => $country_payment);

        if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender_payment;
        if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company_payment;
        if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb_payment;
        if (ACCOUNT_STATE == 'true') {
          if ($zone_id > 0) {
            $sql_data_array['entry_zone_id'] = $zone_id_payment;
            $sql_data_array['entry_state'] = '';
          } else {
            $sql_data_array['entry_zone_id'] = '0';
            $sql_data_array['entry_state'] = $state_payment;
          }
        }

        if (!tep_session_is_registered('billto')) tep_session_register('billto');

        tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

        $billto_payment = tep_db_insert_id();
      }
	
############################# end new payment address #######################################



############################# process the selected shipping method ######################################
    if (!tep_session_is_registered('comments')) tep_session_register('comments');
    if (tep_not_null($_POST['comments'])) {
      $comments = tep_db_prepare_input($_POST['comments']);
    }


/// This we ne to process also for updating jquery shipping value
if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
if (isset($_POST['shipping']) && tep_not_null($_POST['shipping'])){ //used THAT IT IS not 0 again

    if ( (tep_count_shipping_modules() > 1) || ($free_shipping == true) ) {
		//here is the selected shipping module defined
		$shipping = $_POST['shipping']; 
		

		
        list($module, $method) = explode('_', $shipping);
        if ( is_object($$module) || ($shipping == 'free_free') ) {
          if ($shipping == 'free_free') {
            $quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;
            $quote[0]['methods'][0]['cost'] = '0';
          } else {
            $quote = $shipping_modules->quote($method, $module);
          }
          if (isset($quote['error'])) {
            tep_session_unregister('shipping');
          } else {
            if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ) {
              $shipping = array('id' => $shipping,
                                'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
                                'cost' => $quote[0]['methods'][0]['cost']);

              //tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
          }
        } else {
          tep_session_unregister('shipping');
        }
    }
  }	  
############################# process the selected shipping method END ######################################


############################# process the selected payment method ######################################
if (isset($_POST['payment'])) $payment = $_POST['payment'];
############################# process the selected payment method END ######################################

// set them here after $customer_default_address_id is created (ca. line 491)
$sendto = $customer_default_address_id;



//if unchecked checkbox "Billing address is the same as shipping address" we need to change $billto


if ($payment_address_selected == '1') { //is selected - payment address is same as shipping address
	$billto = $customer_default_address_id; 
} else { //not selected - so a new address is being created
	$billto = $billto_payment; 
}



	
//if everything is OK process the order
$sc_payment_url = false;
if (isset($$payment->form_action_url)) {
	if (SC_CONFIRMATION_PAGE == 'true') {
		$sc_payment_url = false;
		$form_action_url = tep_href_link(FILENAME_SC_CHECKOUT_CONFIRMATION, '', 'SSL');
		tep_redirect($form_action_url); //redirect to checkout_pocess.php
		//$order = new order;  //set new order for post data
	} else {
		//START send create account mail
		//if ($create_account == true) {
			  $name = $firstname . ' ' . $lastname;
		
			  if (ACCOUNT_GENDER == 'true') {
				 if ($gender == 'm') {
				   $email_text = sprintf(EMAIL_GREET_MR, $lastname);
				 } else {
				   $email_text = sprintf(EMAIL_GREET_MS, $lastname);
				 }
			  } else {
				$email_text = sprintf(EMAIL_GREET_NONE, $firstname);
			  }
			  
			  if (SC_EMAIL_LOGIN_DATA == 'true') {
				  $email_text .= EMAIL_WELCOME . EMAIL_USERNAME . EMAIL_PASSWORD . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
			  } else {
			  	  $email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
			  }
			  
			  tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
			  
		
		//} //END send create account mail
		
		$sc_payment_url = true;
		$sc_payment_modules_process = false; //set to false in order not to load payment selection()
		$order = new order;  //set new order for post data
	}
} else { //process for non-url payment modules
	
	
	if (SC_CONFIRMATION_PAGE == 'true') {
		//if confimation is true
		$form_action_url = tep_href_link(FILENAME_SC_CHECKOUT_CONFIRMATION, '', 'SSL');
	} else {
		//START send create account mail
		//if ($create_account == true) {
			  $name = $firstname . ' ' . $lastname;
		
			  if (ACCOUNT_GENDER == 'true') {
				 if ($gender == 'm') {
				   $email_text = sprintf(EMAIL_GREET_MR, $lastname);
				 } else {
				   $email_text = sprintf(EMAIL_GREET_MS, $lastname);
				 }
			  } else {
				$email_text = sprintf(EMAIL_GREET_NONE, $firstname);
			  }
		
			  if (SC_EMAIL_LOGIN_DATA == 'true') {
				  $email_text .= EMAIL_WELCOME . EMAIL_USERNAME . EMAIL_PASSWORD . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
			  } else {
			  	  $email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
			  }
			  
			  tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
		
		//} //END send create account mail
		
		$form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
		
	}
	tep_redirect($form_action_url); //redirect to checkout_pocess.php
}
  
  
  


//reset session token
//$sessiontoken = md5(tep_rand() . tep_rand() . tep_rand() . tep_rand());

// restore cart contents
//$cart->restore_contents();
    }
  }
/////////////////// END PROCESS Button pressed for ACCOUNT CREATION - only onepage ////////////////////////////////////////////


/////////////////// START PROCESS Button pressed for LOGGED ON ////////////////////////////////////////////
if (isset($_POST['action']) && ($_POST['action'] == 'logged_on') && isset($_POST['formid']) && ($_POST['formid'] == $sessiontoken)) {

	if ($error == false) {
	
	
	############################# process the selected payment method ######################################
	if (isset($_POST['payment'])) $payment = $_POST['payment'];
	############################# process the selected payment method END ######################################
	
	
	
	//just to be sure - we are a logged in user so don't delete customer account
	if (tep_session_is_registered('noaccount')){ tep_session_unregister('noaccount');}
	
	
	
	
	//if everything is OK process the order
	$sc_payment_url = false;
	if (isset($$payment->form_action_url)) {
		if (SC_CONFIRMATION_PAGE == 'true') {
			$form_action_url = tep_href_link(FILENAME_SC_CHECKOUT_CONFIRMATION, '', 'SSL');
			tep_redirect($form_action_url); //redirect to checkout_pocess.php
		} else {
			//$form_action_url = $$payment->form_action_url;
			$sc_payment_url = true;
			$sc_payment_modules_process = false; //set to false in order not to load payment selection()
			$order = new order;  //set new order for post data
		}
	  } else { //non-url payment modules
	  	if (SC_CONFIRMATION_PAGE == 'true') {
			$form_action_url = tep_href_link(FILENAME_SC_CHECKOUT_CONFIRMATION, '', 'SSL');
		} else {
			$form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
		}
		tep_redirect($form_action_url); //redirect to checkout_pocess.php
	  }

	} //error end
}
/////////////////// END PROCESS Button pressed for LOGGED ON ////////////////////////////////////////////


// get all available shipping quotes
  $quotes = $shipping_modules->quote();

  $order_total_modules->process();

// if no shipping method has been selected, automatically select the cheapest method.
// if the modules status was changed when none were available, to save on implementing
// a javascript force-selection method, also automatically select the cheapest shipping
// method if more than one module is now enabled

// don't use this as it will not get the toal correct the first time
 // if ( !tep_session_is_registered('shipping') || ( tep_session_is_registered('shipping') && ($shipping == false) && (tep_count_shipping_modules() > 1) ) ) $shipping = $shipping_modules->cheapest();
 
  $content = CONTENT_CHECKOUT;
  $javascript = 'checkout.js.php';

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
