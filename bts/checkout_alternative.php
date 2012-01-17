<?php
/*
  $Id: checkout_alternative.php,v 1.7 2002/12/02

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  Copyright (c) 2002 HMCservices

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_ALTERNATIVE); 
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN); 
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOPPING_CART); 
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SHIPPING); 
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PAYMENT); 

  if (isset($_GET['error'])||isset($_POST['error'])) {
  $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR);
  $messageStack->add('create_account', ENTRY_STREET_ADDRESS_ERROR);
          echo  "<tr><td>".$messageStack->output('create_account')."</td></tr>";
          echo  "<tr><td>".tep_draw_separator('pixel_trans.gif', '100%', '10')."</td></tr>";

  }
  class productListBox extends tableBox {
    function productListBox($contents) {
      $this->table_parameters = '';
      $this->tableBox($contents, true);
    }
  }

  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;

  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment($payment);

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping;

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// check for minimum order  
  if ( $cart->show_total() >= 0 ) {
    if ( $cart->show_total() < MIN_ORDER ) {
  	tep_redirect(tep_href_link(FILENAME_MIN_ORDER, '', 'NONSSL'));
    }
  }

// check for minimum order  
  if ( $cart->show_total() >= 0 ) {
    if ( $cart->show_total() < MIN_ORDER_B2B ) {
  	tep_redirect(tep_href_link(FILENAME_MIN_ORDER_B2B, '', 'NONSSL'));
    }
  }

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
    if (($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)&&($pass)) {
      $free_shipping = true;

      include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');
    }
  } else {
    $free_shipping = false;
  }

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
  }
  $error = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {

if (!isset($_SESSION['kvit_name'])) $_SESSION['kvit_name'] = $_POST['kvit_name'];
if (!isset($_SESSION['kvit_address'])) $_SESSION['kvit_address'] = $_POST['kvit_address'];

if (!isset($_SESSION['qiwi_telephone'])) $_SESSION['qiwi_telephone'] = $_POST['qiwi_telephone'];
if (!isset($_SESSION['aviso_telephone'])) $_SESSION['aviso_telephone'] = $_POST['aviso_telephone'];

if (!isset($_SESSION['s_name'])) $_SESSION['s_name'] = $_POST['s_name'];
if (!isset($_SESSION['s_inn'])) $_SESSION['s_inn'] = $_POST['s_inn'];
if (!isset($_SESSION['s_kpp'])) $_SESSION['s_kpp'] = $_POST['s_kpp'];
if (!isset($_SESSION['s_ogrn'])) $_SESSION['s_ogrn'] = $_POST['s_ogrn'];
if (!isset($_SESSION['s_okpo'])) $_SESSION['s_okpo'] = $_POST['s_okpo'];
if (!isset($_SESSION['s_rs'])) $_SESSION['s_rs'] = $_POST['s_rs'];
if (!isset($_SESSION['s_bank_name'])) $_SESSION['s_bank_name'] = $_POST['s_bank_name'];
if (!isset($_SESSION['s_bik'])) $_SESSION['s_bik'] = $_POST['s_bik'];
if (!isset($_SESSION['s_ks'])) $_SESSION['s_ks'] = $_POST['s_ks'];
if (!isset($_SESSION['s_address'])) $_SESSION['s_address'] = $_POST['s_address'];
if (!isset($_SESSION['s_yur_address'])) $_SESSION['s_yur_address'] = $_POST['s_yur_address'];
if (!isset($_SESSION['s_fakt_address'])) $_SESSION['s_fakt_address'] = $_POST['s_fakt_address'];
if (!isset($_SESSION['s_telephone'])) $_SESSION['s_telephone'] = $_POST['s_telephone'];
if (!isset($_SESSION['s_fax'])) $_SESSION['s_fax'] = $_POST['s_fax'];
if (!isset($_SESSION['s_email'])) $_SESSION['s_email'] = $_POST['s_email'];
if (!isset($_SESSION['s_director'])) $_SESSION['s_director'] = $_POST['s_director'];
if (!isset($_SESSION['s_accountant'])) $_SESSION['s_accountant'] = $_POST['s_accountant'];

   //START REGISTRATION CODE
    $firstname = tep_db_prepare_input($_POST['firstname']);
    $lastname = tep_db_prepare_input($_POST['lastname']);
    if (ACCOUNT_DOB == 'true') $dob = tep_db_prepare_input($_POST['dob']);
    $email_address = tep_db_prepare_input($_POST['email_address']);
    if (ACCOUNT_COMPANY == 'true') $company = tep_db_prepare_input($_POST['company']);
    if (ACCOUNT_STREET_ADDRESS == 'true') $street_address = tep_db_prepare_input($_POST['street_address']);
    if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($_POST['suburb']);
    if (ACCOUNT_POSTCODE == 'true') $postcode = tep_db_prepare_input($_POST['postcode']);
    if (ACCOUNT_CITY == 'true') $city = tep_db_prepare_input($_POST['city']);
      if (ACCOUNT_STATE == 'true') {
          $zone_id = tep_db_prepare_input($_POST['zone_id']);
        $state = tep_db_prepare_input($_POST['state']);
      }
    if (ACCOUNT_COUNTRY == 'true') { $country = tep_db_prepare_input($_POST['country']);
    } else {
    $country = STORE_COUNTRY;
    } 
    if (ACCOUNT_TELE == 'true') $telephone = tep_db_prepare_input($_POST['telephone']);
    if (ACCOUNT_FAX == 'true') $fax = tep_db_prepare_input($_POST['fax']);
    if (isset($_POST['newsletter'])) {
      $newsletter = tep_db_prepare_input($_POST['newsletter']);
    } else {
      $newsletter = false;
    }
    $password = tep_RandomString(8);
    $confirmation = tep_db_prepare_input($_POST['confirmation']);

   // +Country-State Selector
//	if ($process) {
	// -Country-State Selector
    $error = false;

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (tep_validate_email($email_address) == false) {
      $error = true;

      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    } else {
      $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
      $check_email = tep_db_fetch_array($check_email_query);
      if ($check_email['total'] > 0) {
        $error = true;
        $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
      }
    }

    if (ACCOUNT_STATE == 'true') {
      $zone_id = 0;
      $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
      $check = tep_db_fetch_array($check_query);
      $entry_state_has_zones = ($check['total'] > 0);
      if ($entry_state_has_zones == true) {
        $zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and zone_name = '" . tep_db_input($state) . "'");
        if (tep_db_num_rows($zone_query) == 1) {
          $zone = tep_db_fetch_array($zone_query);
          $zone_id = $zone['zone_id'];
        } else {
          $error = true;

          $messageStack->add('checkout_address', ENTRY_STATE_ERROR_SELECT);
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          $messageStack->add('checkout_address', ENTRY_STATE_ERROR);
        }
      }
    }

        $extra_fields_query = tep_db_query("select ce.fields_id, ce.fields_input_type, ce.fields_required_status, cei.fields_name, ce.fields_status, ce.fields_input_type, ce.fields_size from " . TABLE_EXTRA_FIELDS . " ce, " . TABLE_EXTRA_FIELDS_INFO . " cei where ce.fields_status=1 and ce.fields_required_status=1 and cei.fields_id=ce.fields_id and cei.languages_id =" . $languages_id);
   while($extra_fields = tep_db_fetch_array($extra_fields_query)){
    if(strlen($_POST['fields_' . $extra_fields['fields_id']])<$extra_fields['fields_size']){
      $error = true;
      $string_error=sprintf(ENTRY_EXTRA_FIELDS_ERROR,$extra_fields['fields_name'],$extra_fields['fields_size']);
      $messageStack->add('create_account', $string_error);
    }
  }
  
    if ($error == false) {
      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_newsletter' => $newsletter,
                              'customers_password' => tep_encrypt_password($password));

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($dob);

      tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

      $customer_id = tep_db_insert_id();

    $customers_id = (int)$customer_id;
   	  	$extra_fields_query = tep_db_query("select ce.fields_id from " . TABLE_EXTRA_FIELDS . " ce where ce.fields_status=1 ");
    	  while($extra_fields = tep_db_fetch_array($extra_fields_query))
				{
				  if(isset($_POST['fields_' . $extra_fields['fields_id']])){
            $sql_data_array = array('customers_id' => (int)$customers_id,
                              'fields_id' => $extra_fields['fields_id'],
                              'value' => $_POST['fields_' . $extra_fields['fields_id']]);
       		}
       		else
					{
					  $sql_data_array = array('customers_id' => (int)$customers_id,
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
          $sql_data_array['entry_state'] = $state;
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

    $shipping_address_query = tep_db_query("select address_book_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "'");
    $shipping_address = tep_db_fetch_array($shipping_address_query);
    //print_r($shipping_address);
    //extract($_POST);

    foreach ($_POST as $key => $val) {
              //echo $key.'<br>';
              if (!tep_session_is_registered($key)) tep_session_register($key);
              $$key =$val;
                }
    tep_session_register('billto');
    //tep_session_register('sendto');
     $billto = $shipping_address['address_book_id'];
     //$sendto = $shipping_address['address_book_id'];
      // restore cart contents
      $cart->restore_contents();

// build the message content
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

// Guest Account Start
      if ($guest_account == true) {        tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));      } else {      $email_text .= EMAIL_WELCOME . EMAIL_TEXT . ENTRY_EMAIL_ADDRESS . ' ' . $email_address . "\n" . ENTRY_PASSWORD . ' ' . $password . "\n\n" . EMAIL_CONTACT . EMAIL_WARNING;      }// Guest Account End
// ICW - CREDIT CLASS CODE BLOCK ADDED  ******************************************************* BEGIN
  if (NEW_SIGNUP_GIFT_VOUCHER_AMOUNT > 0) {
    $coupon_code = create_coupon_code();
    $insert_query = tep_db_query("insert into " . TABLE_COUPONS . " (coupon_code, coupon_type, coupon_amount, date_created) values ('" . $coupon_code . "', 'G', '" . NEW_SIGNUP_GIFT_VOUCHER_AMOUNT . "', now())");
    $insert_id = tep_db_insert_id($insert_query);
    $insert_query = tep_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $insert_id ."', '0', 'Admin', '" . $email_address . "', now() )");

    $email_text .= sprintf(EMAIL_GV_INCENTIVE_HEADER, $currencies->format(NEW_SIGNUP_GIFT_VOUCHER_AMOUNT)) . "\n\n" .
                   sprintf(EMAIL_GV_REDEEM, $coupon_code) . "\n\n" .
                   EMAIL_GV_LINK . tep_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $coupon_code,'NONSSL', false) .
                   "\n\n";
  }
  if (NEW_SIGNUP_DISCOUNT_COUPON != '') {
		$coupon_code = NEW_SIGNUP_DISCOUNT_COUPON;
    $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_code = '" . $coupon_code . "'");
    $coupon = tep_db_fetch_array($coupon_query);
		$coupon_id = $coupon['coupon_id'];		
    $coupon_desc_query = tep_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $coupon_id . "' and language_id = '" . (int)$languages_id . "'");
    $coupon_desc = tep_db_fetch_array($coupon_desc_query);
    $insert_query = tep_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $coupon_id ."', '0', 'Admin', '" . $email_address . "', now() )");
    $email_text .= EMAIL_COUPON_INCENTIVE_HEADER .  "\n" .
                   sprintf("%s", $coupon_desc['coupon_description']) ."\n\n" .
                   sprintf(EMAIL_COUPON_REDEEM, $coupon['coupon_code']) . "\n\n" .
                   "\n\n";



  }
//    $email_text .= EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
// ICW - CREDIT CLASS CODE BLOCK ADDED  ******************************************************* END
        tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
   //END REGISTRATION CODE

   //START DIFFERENT SHIPPING CODE

   if (tep_not_null($_POST['ShipFirstName']) && tep_not_null($_POST['ShipLastName']) && tep_not_null($_POST['ShipAddress'])) {
      $process = true;

      $firstname = tep_db_prepare_input($_POST['ShipFirstName']);
      $lastname = tep_db_prepare_input($_POST['ShipLastName']);
      if (ACCOUNT_STREET_ADDRESS == 'true') $street_address = tep_db_prepare_input($_POST['ShipAddress']);
      //if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($_POST['shipstate']);
      if (ACCOUNT_POSTCODE == 'true') $postcode = tep_db_prepare_input($_POST['shippostcode']);
      if (ACCOUNT_CITY == 'true') $city = tep_db_prepare_input($_POST['ShipCity']);
      if (ACCOUNT_COUNTRY == 'true') { $country = tep_db_prepare_input($_POST['shipcountry']);
      } else {
      $country = STORE_COUNTRY;
      }
      if (ACCOUNT_STATE == 'true') {
          $zone_id = tep_db_prepare_input($_POST['zone_id']);
        $state = tep_db_prepare_input($_POST['shipstate']);
      }

      if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_FIRST_NAME_ERROR);
      }

      if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_LAST_NAME_ERROR);
      }


    if (ACCOUNT_STREET_ADDRESS == 'true') {
      if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_STREET_ADDRESS_ERROR);
      }
    }

    if (ACCOUNT_POSTCODE == 'true') {
      if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_POST_CODE_ERROR);
      }
    }

    if (ACCOUNT_CITY == 'true') {
      if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_CITY_ERROR);
      }
    }

    if (ACCOUNT_COUNTRY == 'true') {
	    if (is_numeric($country) == false) {
      $error = true;

      $messageStack->add('checkout_address', ENTRY_COUNTRY_ERROR);
    }
}

    if (ACCOUNT_STATE == 'true') {
      $zone_id = 0;
      $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
      $check = tep_db_fetch_array($check_query);
      $entry_state_has_zones = ($check['total'] > 0);
      if ($entry_state_has_zones == true) {
        $zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and zone_name = '" . tep_db_input($state) . "'");
        if (tep_db_num_rows($zone_query) == 1) {
          $zone = tep_db_fetch_array($zone_query);
          $zone_id = $zone['zone_id'];
        } else {
          $error = true;

          $messageStack->add('checkout_address', ENTRY_STATE_ERROR_SELECT);
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          $messageStack->add('checkout_address', ENTRY_STATE_ERROR);
        }
      }
    }
    
      if ($error == false) {
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

        if (!tep_session_is_registered('sendto')) tep_session_register('sendto');

        tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
          tep_session_unregister('sendto');
          tep_session_unregister('billto');
          //tep_session_register('sendto');
          //tep_session_register('billto');
        //$sendto = tep_db_insert_id();
        //$billto = $sendto -1;
    }
  }
   //END DIFFERENT SHIPPING CODE

   //START PAYMENT CODE

   $payment_modules->update_status();
    if ( ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$payment) ) || (is_object($$payment) && ($$payment->enabled == false)) ) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_ALTERNATIVE, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
   }



   while (list($key, $value) = each($_POST))
   {
          tep_session_register($key);
   }

     if (MODULE_ORDER_TOTAL_INSTALLED) {
         $order_total_modules->process();
      }
   //END PAYMENT CODE

   //START Shiping CODE

         if (!tep_session_is_registered('sendto')) {
           tep_session_register('sendto');
         }

   if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
    $total_weight = $cart->show_weight();
    $total_count = $cart->count_contents();

      if ( (isset($_POST['shipping'])) && (strpos($_POST['shipping'], '_')) ) {
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
            }
          }
        } else {
          tep_session_unregister('shipping');
        }
      }
   //END SHIPING CODE

   //START CONFORMITION CODE
   if (!tep_session_is_registered('payment')) tep_session_register('payment');
   if (isset($_POST['payment'])) $payment = $_POST['payment'];

   if (!tep_session_is_registered('comments')) tep_session_register('comments');
   if (tep_not_null($_POST['comments'])) {
    $comments = tep_db_prepare_input($_POST['comments']);
   }
    if (!tep_session_is_registered('customer_country_id')) tep_session_register('customer_country_id');
    if (!tep_session_is_registered('customer_zone_id')) tep_session_register('customer_zone_id');
    $customer_country_id = 0;
    $customer_zone_id = 0;
   //END CONFORMITION CODE
    $order->cart();
    $confirmation = $payment_modules->confirmation();
   //print_r($order);
   //$payment_modules = new payment($payment);

   tep_redirect(tep_href_link(FILENAME_CHECKOUT_CONFIRMATION));
  }
}
  if ($error == true) {
    $messageStack->add('login', TEXT_LOGIN_ERROR);
  }

 // +Country-State Selector 
// }
 if (!isset($country)){$country = DEFAULT_COUNTRY;}
 // -Country-State Selector

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CHECKOUT_ALTERNATIVE, '', 'SSL'));

  $content = CONTENT_CHECKOUT_ALTERNATIVE;
  $javascript = $content . '.js.php';

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>