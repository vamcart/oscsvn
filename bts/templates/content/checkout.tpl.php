<?php

###################### payment url redirection START ###################################
//if payment method such as paypal is choosen,  repost process_button data
  if ((isset($$payment->form_action_url)) && ($sc_payment_url == true)) {
		
    $form_action_url = $$payment->form_action_url;
	echo tep_draw_form('checkoutUrl', $form_action_url, 'post');
  } 
    
  if (is_array($payment_modules->modules)) {
	$payment_modules->pre_confirmation_check();
  }
  
  if (is_array($payment_modules->modules)) {
	$payment_modules->confirmation();
  }  
    
  if (is_array($payment_modules->modules)) {
  echo $payment_modules->process_button();
  }

//////////  START  redirection page for payment modules such as paypal if no confirmation page ////////////
if ((isset($$payment->form_action_url)) && ($sc_payment_url == true)) { 
?>

<!-- body //-->
<?php
if (is_array($payment_modules->modules)) {
    if ($confirmation = $payment_modules->confirmation()) {
	
?>

  <h2><?php echo HEADING_PAYMENT_INFORMATION; ?></h2>

  <div class="contentText">
    <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="4"><?php 
		
		
		echo $confirmation['title']; ?></td>
      </tr>

<?php
      for ($i=0, $n=sizeof($confirmation['fields']); $i<$n; $i++) {
	  
?>

      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
        <td class="main"><?php echo $confirmation['fields'][$i]['title']; ?></td>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
        <td class="main"><?php echo $confirmation['fields'][$i]['field']; ?></td>
      </tr>

<?php
      }
?>

    </table>
  </div>

<?php
    }
  }
 
?>

<p><?php echo SC_TEXT_REDIRECT; ?></p>



</form>

<!-- body_eof //-->

<script type="text/javascript">
    document.checkoutUrl.submit();
</script>
<noscript><input type="submit" value="verify submit"></noscript>

   
<?php 
}
//////////  END  redirection page for payment modules such as paypal if no confirmation page ////////////
?>

<!-- body //-->

<?php echo $payment_modules->javascript_validation(); ?>


<h1><?php echo HEADING_TITLE; ?></h1>

<div id="box">
<div id="checkout">
            

<?php
  if ($messageStack->size('smart_checkout') > 0) {
    echo $messageStack->output('smart_checkout');
  }
?>


<?php
	if (!tep_session_is_registered('customer_id')) {
?>
<p><?php echo sprintf(TEXT_ORIGIN_LOGIN, tep_href_link(FILENAME_LOGIN, tep_get_all_get_params(), 'SSL')); ?></p>
<?php
	}
?>


<?php 
//Draw form for pressing button "confirm order"
//first check input fields and check for payment choosen
$form_action_url = tep_href_link(FILENAME_CHECKOUT, '', 'SSL');
echo tep_draw_form('smart_checkout', $form_action_url, 'post', 'onsubmit="return check_form(smart_checkout);"', true);
 
 
// draw process hidden field
if (tep_session_is_registered('customer_id')) {  //logged on - process another action = 'logged_on'
	echo tep_draw_hidden_field('action', 'logged_on');
} else { //is not logged on - process another action = 'process'
	//not logged on
	echo tep_draw_hidden_field('action', 'not_logged_on');
}

echo tep_draw_hidden_field('shipping_count', $shipping_count); //need to post it for validation
echo tep_draw_hidden_field('sc_payment_address_show', $sc_payment_address_show); //need to post it for validation
echo tep_draw_hidden_field('sc_payment_modules_show', $sc_payment_modules_show); //need to post it for validation
echo tep_draw_hidden_field('create_account', $create_account); //need to post it for validation
echo tep_draw_hidden_field('sc_shipping_modules_show', $sc_shipping_modules_show); //need to post it for validation
echo tep_draw_hidden_field('sc_shipping_address_show', $sc_shipping_address_show); //need to post it for validation
echo tep_draw_hidden_field('checkout_possible', $checkout_possible); //need to post it for validation
?>

<?php if ($sc_shipping_address_show == true) { //show shipping otpions ?>
<div id="shipping_box" class="sm_layout_box">


<h2><?php if (($sc_is_virtual_product == true) && ($sc_is_free_virtual_product == false)) { 
echo tep_get_sc_titles_number() . TABLE_HEADING_BILLING_ADDRESS; 
} elseif (($sc_is_virtual_product == true) && ($sc_is_free_virtual_product == true)) {
echo tep_get_sc_titles_number(). SC_HEADING_CREATE_ACCOUNT_INFORMATION; 
} else {
echo tep_get_sc_titles_number() . TABLE_HEADING_SHIPPING_ADDRESS; 
} ?></h2> 


<?php ################ START Shipping Information - LOGGED ON ######################################## ?>
<?php if (tep_session_is_registered('customer_id')) { ?>
    	<div>
          <p><?php echo tep_address_label($customer_id, $sendto, true, ' ', '<br />'); ?></p>
          <p><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '">' . tep_template_image_button('button_change_address.gif', IMAGE_BUTTON_CHANGE_ADDRESS) . '</a>'; ?></p>
        </div>
<?php } else { //no account ?>
<?php ################ END Shipping Information - LOGGED ON ######################################## ?> 


<?php ################ START Shipping Information - NO ACCOUNT ######################################## ?>  
	
    <table border="0" cellspacing="2" cellpadding="2" width="100%">

<?php
  if (ACCOUNT_GENDER == 'true') {
?>

      <tr>
        <td class="fieldKey"><?php echo ENTRY_GENDER; ?></td>
        <td class="fieldValue">
		<?php 
		//not yet finished
		 //echo tep_draw_radio_field('gender', 'm', '', 'id="checkme"') . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f', '', 'id="checkme2"') . '&nbsp;&nbsp;' . FEMALE . '&nbsp;&nbsp;'. tep_draw_radio_field('gender', 'a', '', 'id="checkme1"') . '&nbsp;&nbsp;' . FIRMA . '&nbsp;' . (!tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); 
        
		echo tep_draw_radio_field('gender', 'm') . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f') . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (!tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?></td>
      </tr>
</table>
<?php
  }
?>



<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
<div id="extra">
     <table border="0" cellspacing="2" cellpadding="2" width="100%">
      <tr>
        <td class="fieldKey"><?php echo ENTRY_COMPANY; ?></td>
        <td class="fieldValue"><?php echo tep_draw_input_field('company', $sc_guest_company, 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
      </tr>
    </table>
</div>  

<?php
  }
?>
 <table border="0" cellspacing="2" cellpadding="2" width="100%">
      <tr>
        <td class="fieldKey"><?php echo ENTRY_FIRST_NAME; ?></td>
        <td class="fieldValue">
		<?php echo tep_draw_input_field('firstname', $sc_guest_firstname, 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?>
        </td>
      </tr>
      <tr> 
        <td class="fieldKey"><?php echo ENTRY_LAST_NAME; ?></td>
        <td class="fieldValue">
		<?php echo tep_draw_input_field('lastname', $sc_guest_lastname, 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?>
        </td>
      </tr>

<?php
  if (ACCOUNT_DOB == 'true') {
?>

      <tr>
        <td class="fieldKey"><?php echo ENTRY_DATE_OF_BIRTH; ?></td>
        <td class="fieldValue"><?php echo tep_draw_input_field('dob', $sc_guest_dob, 'class="text" id="dob"') . '&nbsp;' . (!tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="inputRequirement">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''); ?><script type="text/javascript">$('#dob').datepicker({dateFormat: '<?php echo JQUERY_DATEPICKER_FORMAT; ?>', changeMonth: true, changeYear: true, yearRange: '-100:+0'});</script></td>
      </tr>

<?php
  }
?>

      
    </table>
 





 <div id="shipping_address">
    <table border="0" cellspacing="2" cellpadding="2" width="100%">
<?php
if (ACCOUNT_STREET_ADDRESS == 'true') {
?>
      <tr>
        <td class="fieldKey"><?php echo ENTRY_STREET_ADDRESS; ?></td>
        <td class="fieldValue">
		<?php echo tep_draw_input_field('street_address', $sc_guest_street_address, 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?>
        </td>
      </tr>
<?php
}
?>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>

      <tr>
        <td class="fieldKey"><?php echo ENTRY_SUBURB; ?></td>
        <td class="fieldValue"><?php echo tep_draw_input_field('suburb', $sc_guest_suburb, 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
      </tr>

<?php
  }
?>
<?php
  if (ACCOUNT_POSTCODE == 'true') {
?>

      <tr>
        <td class="fieldKey"><?php echo ENTRY_POST_CODE; ?></td>
        <td class="fieldValue">
		<?php echo tep_draw_input_field('postcode', $sc_guest_postcode, 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?>
        </td>
      </tr>
<?php
  }
?>
<?php
  if (ACCOUNT_CITY == 'true') {
?>
      <tr>
        <td class="fieldKey"><?php echo ENTRY_CITY; ?></td>
        <td class="fieldValue">
		<?php echo tep_draw_input_field('city', $sc_guest_city, 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?>
        </td>
      </tr>
<?php
  }
?>
</table>
<div id="shipping_country_box">
<div id="shipping_country">

<table border="0" cellspacing="2" cellpadding="2" width="100%">
<?php
  if (ACCOUNT_COUNTRY == 'true') {
?>
	<tr>
        <td class="fieldKey"><?php echo ENTRY_COUNTRY; ?></td>
        <td class="fieldValue">
		<?php echo tep_get_country_list('country',$selected_country_id, 'onChange="changeselect();"') . '&nbsp;' . (!tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?>
        </td>
      </tr>
<?php
  }
?>
      
    </table>
  </div><!--div end shipping_country -->
  </div><!--div end shipping_country_box -->
<?php
  if (ACCOUNT_STATE == 'true') {
?>
<table border="0" cellspacing="2" cellpadding="2" width="100%">
      <tr>
        <td class="fieldKey"><?php echo ENTRY_STATE; ?></td>
        <td class="fieldValue">
<script language="javascript">
<!--
function changeselect(reg) {
//clear select
    document.smart_checkout.state.length=0;
    var j=0;
    for (var i=0;i<zones.length;i++) {
      if (zones[i][0]==document.smart_checkout.country.value) {
   document.smart_checkout.state.options[j]=new Option(zones[i][1],zones[i][1], zones[i][2]);
   j++;
   }
      }
    if (j==0) {
      document.smart_checkout.state.options[0]=new Option('-','-');
      }
    if (reg) { document.smart_checkout.state.value = reg; }
}
   var zones = new Array(
   <?php
       $zones_query = tep_db_query("select zone_country_id,zone_id,zone_name from " . TABLE_ZONES . " order by zone_name asc");
       $mas=array();
       while ($zones_values = tep_db_fetch_array($zones_query)) {
       	($zones_values['zone_id'] == STORE_ZONE) ? $selected = 'true' : $selected = 'false';
         $zones[] = 'new Array('.$zones_values['zone_country_id'].',"'.$zones_values['zone_name'].'",'.$selected.')';
       }
       echo implode(',',$zones);
       ?>
       );
document.write('<SELECT NAME="state">');
document.write('</SELECT>');
changeselect("<?php echo tep_db_prepare_input($_POST['state']); ?>");
-->
</script>
        </td>
      </tr>
</table>
<?php
  }
?>
</div> <!--div end shipping_address -->
<?php } //end no account ?>
<?php ################ END Shipping Information - NO ACCOUNT ######################################## ?> 

</div> <!--div end shipping_box --> 
<?php } //END show shipping otpions ?> 
 
  
 
 
 
 
<?php if ($sc_payment_address_show == true) { // hide payment if there is a virtual product because we use shipping address for payment address ?>
<div id="payment_address_box"  class="sm_layout_box">
 <h2><?php echo tep_get_sc_titles_number() . TABLE_HEADING_BILLING_ADDRESS; ?></h2>
<?php ################ START Payment Information - LOGGED ON ######################################## ?>
<?php if (tep_session_is_registered('customer_id')) { ?>
    	<div>
           <p><?php echo tep_address_label($customer_id, $billto, true, ' ', '<br />'); ?></p>
           <p><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL') . '">' . tep_template_image_button('button_change_address.gif', IMAGE_BUTTON_CHANGE_ADDRESS) . '</a>'; ?></p>
        </div>
<?php } else { //no account ?>
<?php ################ END Payment Information - LOGGED ON ######################################## ?> 


<?php ################ START Payment Information - NO ACCOUNT ######################################## ?> 

 <div id="payment_address_checkbox">
 <table border="0" cellspacing="2" cellpadding="2" width="100%">
 <tr>
        
   <?php if (($error == '1') && ($payment_address_selected != '1')) { //is not selected - otherwise payment address is same as shipping address ?>
        
        <td><?php echo tep_draw_checkbox_field('payment_adress', '1', false, 'id="pay_show"') . '&nbsp;' . (!tep_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="inputRequirement">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''). '&nbsp;&nbsp;' . TEXT_SHIPPING_SAME_AS_PAYMENT; ?></td>
        
        <?php } else { //is selected ?>
        
        <td><?php echo tep_draw_checkbox_field('payment_adress', '1', true, 'id="pay_show"') . '&nbsp;' . (!tep_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="inputRequirement">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''). '&nbsp;&nbsp;' . TEXT_SHIPPING_SAME_AS_PAYMENT; ?></td>
        
        <?php } ?>
        
      </tr>
      </table>
</div>



<div id="payment_address">

<table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
  if (ACCOUNT_GENDER == 'true') {
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
      $female = ($gender == 'f') ? true : false;
    } else {
      $male = false;
      $female = false;
    }
?>



    <tr>
      <td class="fieldKey"><?php echo ENTRY_GENDER; ?></td>
      <td class="fieldValue">
	  
	  <?php echo tep_draw_radio_field('gender_payment', 'm', $male) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender_payment', 'f', $female) . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (!tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?>
      
      </td>
    </tr>

<?php
  }
?>

<?php
  if (ACCOUNT_COMPANY == 'true') {
?>

    <tr>
      <td class="fieldKey"><?php echo ENTRY_COMPANY; ?></td>
      <td class="fieldValue"><?php echo tep_draw_input_field('company_payment', '',  'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
    </tr>

<?php
  }
?>

      
    <tr>
      <td class="fieldKey"><?php echo ENTRY_FIRST_NAME; ?></td>
      <td class="fieldValue">
		<?php echo tep_draw_input_field('firstname_payment', '', 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?>
	  </td>
    </tr>
    <tr>
      <td class="fieldKey"><?php echo ENTRY_LAST_NAME; ?></td>
      <td class="fieldValue">
		<?php echo tep_draw_input_field('lastname_payment', '', 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?>
		</td>
    </tr>

<?php
if (ACCOUNT_STREET_ADDRESS == 'true') {
?>

    <tr>
      <td class="fieldKey"><?php echo ENTRY_STREET_ADDRESS; ?></td>
      <td class="fieldValue">
		<?php echo tep_draw_input_field('street_address_payment', '', 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?>
		</td>
    </tr>
<?php
  }
?>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>

    <tr>
      <td class="fieldKey"><?php echo ENTRY_SUBURB; ?></td>
      <td class="fieldValue"><?php echo tep_draw_input_field('suburb_payment', '', 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
    </tr>

<?php
  }
?>
<?php
  if (ACCOUNT_POSTCODE == 'true') {
?>
    <tr>
      <td class="fieldKey"><?php echo ENTRY_POST_CODE; ?></td>
      <td class="fieldValue">
		<?php echo tep_draw_input_field('postcode_payment', '', 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?>
		</td>
    </tr>
<?php
  }
?>
<?php
  if (ACCOUNT_CITY == 'true') {
?>
    <tr>
      <td class="fieldKey"><?php echo ENTRY_CITY; ?></td>
      <td class="fieldValue">
		<?php echo tep_draw_input_field('city_payment', '', 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?>
	</td>
    </tr>
<?php
  }
?>
<?php
  if (ACCOUNT_COUNTRY == 'true') {
?>
    <tr>
      <td class="fieldKey"><?php echo ENTRY_COUNTRY; ?></td>
      <td class="fieldValue"><?php echo tep_get_country_list('country_payment',$selected_country_id, 'onChange="changeselectt();"') . '&nbsp;' . (!tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?></td>
    </tr>
<?php
  }
?>
<?php
  if (ACCOUNT_STATE == 'true') {
?>

    <tr>
      <td class="fieldKey"><?php echo ENTRY_STATE; ?></td>
      <td class="fieldValue">

<script language="javascript">
<!--
function changeselectt(reg) {
//clear select
    document.smart_checkout.state_payment.length=0;
    var j=0;
    for (var i=0;i<zones.length;i++) {
      if (zones[i][0]==document.smart_checkout.country_payment.value) {
   document.smart_checkout.state_payment.options[j]=new Option(zones[i][1],zones[i][1], zones[i][2]);
   j++;
   }
      }
    if (j==0) {
      document.smart_checkout.state_payment.options[0]=new Option('-','-');
      }
    if (reg) { document.smart_checkout.state_payment.value = reg; }
}
   var zones = new Array(
   <?php
       $zones_query = tep_db_query("select zone_country_id,zone_id,zone_name from " . TABLE_ZONES . " order by zone_name asc");
       $mas=array();
       while ($zones_values = tep_db_fetch_array($zones_query)) {
       	($zones_values['zone_id'] == STORE_ZONE) ? $selected = 'true' : $selected = 'false';
         $zones[] = 'new Array('.$zones_values['zone_country_id'].',"'.$zones_values['zone_name'].'",'.$selected.')';
       }
       echo implode(',',$zones);
       ?>
       );
document.write('<SELECT NAME="state_payment">');
document.write('</SELECT>');
changeselectt("<?php echo tep_db_prepare_input($_POST['state_payment']); ?>");
-->
</script>

      </td>
    </tr>

<?php
  }
?>
  </table>

 </div><!--div end payment_address-->
<?php } //end no account ?> 
</div><!--div end payment_address_box-->
<?php } //END hide payment if there is a virtual product because we use shipping address for payment address ?>
<?php ################ END Payment Information - NO ACCOUNT ######################################## ?> 




<?php if (!tep_session_is_registered('customer_id')) { //IS NOT LOGGED ON ?>
<?php ################ START Contact Information - NO ACCOUNT ######################################## ?> 
<div id="contact_box" class="sm_layout_box">

  <h2><?php echo tep_get_sc_titles_number() . CATEGORY_CONTACT; ?></h2>

  
    <table border="0" cellspacing="2" cellpadding="2" width="100%">
    <tr>
        <td class="fieldKey"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
        <td class="fieldValue">
		<?php echo tep_draw_input_field('email_address', $sc_guest_email_address, 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?>
        </td>
      </tr>
<?php
  if (ACCOUNT_TELE == 'true') {
?>      
      <tr>
        <td class="fieldKey"><?php echo ENTRY_TELEPHONE_NUMBER; ?></td>
        <td class="fieldValue">
		<?php echo tep_draw_input_field('telephone', $sc_guest_telephone, 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?>
        </td>
      </tr>
<?php
  }
?>
      <tr>
        <td class="fieldKey"><?php echo ENTRY_FAX_NUMBER; ?></td>
        <td class="fieldValue"><?php echo tep_draw_input_field('fax', $sc_guest_fax, 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''); ?></td>
      </tr>
      
<!--- extra fields start -->
       <?php echo tep_get_extra_fields($customer_id,$languages_id);?>  
<!--- extra fields end -->
 
     <tr>
       <td><?php echo tep_draw_hidden_field('guest', 'guest'); //do we need this??? ?></td>
     </tr>
  </table>
</div> <!--div end contact_box -->    
<?php ################ END Contact Information - NO ACCOUNT ######################################## ?>   
<?php } //End IS NOT LOGGED ON ?>


<div class="line_space"></div>  


 



<?php ################ START Password - NO ACCOUNT ######################################## ?>
<?php
//if ($create_account == true) { 
 if (!tep_session_is_registered('customer_id')) { //IS NOT LOGGED ON 
  if (($sc_is_virtual_product == true) || ($sc_is_mixed_product == true) || (SC_CREATE_ACCOUNT_REQUIRED == 'true') || (SC_CREATE_ACCOUNT_CHECKOUT_PAGE == 'true')) { ?>
<div id="password_box" class="sm_layout_box">

<h2><?php echo tep_get_sc_titles_number() . SC_HEADING_CREATE_ACCOUNT; ?></h2>

<?php 
if (SC_CREATE_ACCOUNT_REQUIRED == 'true') {
	echo '<p>' . SC_TEXT_PASSWORD_REQUIRED . '</p>'; //show message that you need to create an account
} elseif (($sc_is_virtual_product == true) || ($sc_is_mixed_product == true)) {
	echo '<p>' . SC_TEXT_VIRTUAL_PRODUCT . '</p>';  //show message that you need to create an account if virtual product
}
?>

<?php ################ START Password - optional ######################################## 
if (SC_CREATE_ACCOUNT_REQUIRED == 'true') {
	//show nothing
//} elseif ((SC_CREATE_ACCOUNT_CHECKOUT_PAGE == 'true') && (($sc_is_virtual_product != true) || ($sc_is_mixed_product != true))) {
} elseif (SC_CREATE_ACCOUNT_CHECKOUT_PAGE == 'true') {
	if (($sc_is_virtual_product == true) || ($sc_is_mixed_product == true)) {
	} else { ?>   
<div id="password_checkbox">
 <table border="0" cellspacing="2" cellpadding="2" width="100%">
 <tr>
        
   <?php if (($error == '1') && ($password_selected != '1')) { //is not selected ?>
        
        <td><?php echo tep_draw_checkbox_field('password_checkbox', '1', false, 'id="pw_show"') . '&nbsp;&nbsp;' . TEXT_CREATE_ACCOUNT_OPTIONAL; ?></td>
        
        <?php } else { //is selected ?>
        
        <td><?php echo tep_draw_checkbox_field('password_checkbox', '1', true, 'id="pw_show"') . '&nbsp;&nbsp;' . TEXT_CREATE_ACCOUNT_OPTIONAL; ?></td>
        
        <?php } ?>
        
     </tr>
  </table>
</div>    
<?php }
} ################ End Password - optional ######################################## ?>


<div id="password_fields">
    <table border="0" cellspacing="2" cellpadding="2" width="100%">
      <tr>
        <td class="fieldKey"><?php echo ENTRY_PASSWORD; ?></td>
        <td class="fieldValue">
		<?php echo tep_draw_password_field('password', '', 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_TEXT . '</span>': ''); ?>
        </td>
      </tr>
      <tr>
        <td class="fieldKey"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></td>
        <td class="fieldValue">
		<?php echo tep_draw_password_field('confirmation', '', 'class="text"') . '&nbsp;' . (!tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''); ?>
        </td>
      </tr>
   </table>
   </div> <!--div end password_fields --> 
</div> <!--div end password_box -->  
<?php
 } //end (($sc_is_virtual_product == true) || ($sc_is_mixed_product == true))
} //End IS NOT LOGGED ON ?> 
<?php ################ END Password - NO ACCOUNT ######################################## ?>
  



<?php ################ START Shipping Modules ######################################## ?>     
<?php if ($sc_shipping_modules_show == true) { //hide shipping modules - used for virtual products ?>

<?php if ((SC_HIDE_SHIPPING == 'true') && (tep_count_shipping_modules() <= 1)) { 
//if 0 or 1 shipping method and in admin hide shipping is set to true, hide shipping box 
//but we still need the divs in order to work with jquery update ?>
<div id="shipping_modules_box">
    <div id="shipping_options">
        <!--<p>shipping hidden as only 1 method</p>--> 
    </div>
</div>

<?php } //end hide shipping modules
else { // show shipping modules ?>


<div id="shipping_modules_box" class="sm_layout_box">
<div id="shipping_options"> 
<?php
  if (tep_count_shipping_modules() > 0) {
?>



  <h2><?php echo tep_get_sc_titles_number() . TABLE_HEADING_SHIPPING_METHOD; ?></h2>


<?php
if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
?>

  <div class="contentText">
    <div style="float: right;">
      <?php echo '<h5>' . TITLE_PLEASE_SELECT . '</h5>'; ?>
    </div>

   <p><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></p>
  </div>

<?php
    } elseif ($free_shipping == false) {
?>

  
    <p><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></p>
  

<?php
    }
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
    if ($free_shipping == true) {
?>

      <tr>
        <td><h5><?php echo FREE_SHIPPING_TITLE; ?></h5>&nbsp;<?php echo $quotes[$i]['icon']; ?></td>
      </tr>
      <tr id="defaultSelected" class="moduleRowSelected" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="selectRowEffect(this, 0)">
        <td style="padding-left: 15px;"><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . tep_draw_hidden_field('shipping', 'free_free'); ?></td>
      </tr>

<?php
    } else {
      $radio_buttons = 0;
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
?>

      <tr>
        <td colspan="3"><h5><?php echo $quotes[$i]['module']; ?></h5>&nbsp;<?php if (isset($quotes[$i]['icon']) && tep_not_null($quotes[$i]['icon'])) { echo $quotes[$i]['icon']; } ?></td>
      </tr>

<?php


        if (isset($quotes[$i]['error'])) {
?>

      <tr>
        <td colspan="3"><span class="errorText"><?php echo $quotes[$i]['error']; ?></span></td>
      </tr>

<?php
	
        } else {
          for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
            $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $shipping['id']) ? true : false);
			
            if ( ($checked == true) || ($n == 1 && $n2 == 1) ) {
              echo '      <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
            } else {
              echo '      <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
            }
?>

        <td width="75%" style="padding-left: 15px;"><?php echo $quotes[$i]['methods'][$j]['title']; ?></td>

<?php
            if ( ($n > 1) || ($n2 > 1) ) {


?>

        <td class="product_price"><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?></td>
        <td align="right"><?php echo tep_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked); ?></td>

<?php
            } else {
?>

        <td class="product_price" align="right" colspan="2"><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))) . tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); ?></td>

<?php
            }
?>

      </tr>

<?php
            $radio_buttons++;
          }
        }
      }
    }
?>

    </table>




<?php
  } //end (tep_count_shipping_modules()
?>
</div> <!--div end shipping_options-->
</div> <!--div end shipping_modules_box --> 
<?php
   } // end hide shipping 
?>  
<?php } //END hide shipping modules - used for virtual products ?>
<?php ################ END Shipping Modules ######################################## ?> 



<?php ################ START Payment Modules ######################################## ?> 
<?php if ($sc_payment_modules_show == true) { // hide payment modules ?>
<div id="payment_options" class="sm_layout_box"> 
<h2><?php echo tep_get_sc_titles_number() . TABLE_HEADING_PAYMENT_METHOD; ?></h2>

<?php
if ($sc_payment_modules_process == true) {
  $selection = $payment_modules->selection();


  if (sizeof($selection) > 1) {
?>

  
    
    <?php //echo '<strong>' . TITLE_PLEASE_SELECT . '</strong>'; ?>
  

    <p><?php echo TEXT_SELECT_PAYMENT_METHOD; ?></p>
  	

<?php
    } elseif ($free_shipping == false) {
?>

  
    <p><?php echo TEXT_ENTER_PAYMENT_INFORMATION; ?></p>
 

<?php
    }
?>

  

<?php
  $radio_buttons = 0;
  for ($i=0, $n=sizeof($selection); $i<$n; $i++) {
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
    if ( ($selection[$i]['id'] == $payment) || ($n == 1) ) {
      echo '      <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
    } else {
      echo '      <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
    }
?>

        <td><h5><?php echo $selection[$i]['icon']; ?> <?php echo $selection[$i]['module']; ?></h5></td>
        <td align="right">

<?php
    if (sizeof($selection) > 1) {
      echo tep_draw_radio_field('payment', $selection[$i]['id'], ($selection[$i]['id'] == $payment));
    } else {
      echo tep_draw_hidden_field('payment', $selection[$i]['id']);
    }
?>

        </td>
      </tr>

<?php
    if (isset($selection[$i]['error'])) {
?>

      <tr>
        <td colspan="2"><?php echo $selection[$i]['error']; ?></td>
      </tr>

<?php

    } elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
	
	
?>

      <tr>
        <td colspan="2"><table border="0" cellspacing="0" cellpadding="2">

<?php
      for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
	  
?>

          <tr>
            <td><?php echo $selection[$i]['fields'][$j]['title']; ?></td>
            <td><?php echo $selection[$i]['fields'][$j]['field']; ?></td>
          </tr>

<?php
      }
?>

        </table></td>
      </tr>

<?php
    }
?>

    </table>

<?php
    $radio_buttons++;
  }
}
?>


<?php
  // Discount Code 2.6 - start
  if (MODULE_ORDER_TOTAL_DISCOUNT_STATUS == 'true') {
?>

  <h2><?php echo tep_get_sc_titles_number() . TEXT_DISCOUNT_CODE; ?></h2>

  
  <?php echo tep_draw_input_field('discount_code', $sess_discount_code, 'class="text" size="10"'); ?>
  
  
<?php
  }
  // Discount Code 2.6 - end
?>
</div> <!--div end payment_options-->
<?php } //End hide payment modules ?>
<?php ################ END Payment Modules ######################################## ?> 





<?php ################ START Comment box ######################################## ?> 
<?php if (SC_HIDE_COMMENT != 'true') { ?>
<div id="comment_box" class="sm_layout_box">
	<h2><?php echo tep_get_sc_titles_number() . TABLE_HEADING_COMMENTS; ?></h2>

     <div class="contentText">
        <?php echo tep_draw_textarea_field('comments', 'soft', '60', '5', $comments); ?>
     </div>    
</div><!--div end comment_box--> 
<?php } ?>
<?php ################ END Comment box ######################################## ?> 




<?php ################ START Order Total Modules ######################################## ?> 
<div id="order_total_modules" class="sm_layout_box">
    <h2><?php echo tep_get_sc_titles_number() . HEADING_TOTAL; ?></h2>
    <div class="contentText">
    <div style="float: right;">
    <table border="0" cellspacing="0" cellpadding="2">
    
    <?php
      if (MODULE_ORDER_TOTAL_INSTALLED) {
        echo $order_total_modules->output();
      }
    ?>
    </table>
    </div>
    </div>
	<p>&nbsp;</p>
</div><!--div end order_total_modules -->
<?php ################ END Order Total Modules ######################################## ?> 

<div class="line_space"></div>

<?php
  if (is_array($payment_modules->modules)) {
  //  echo $payment_modules->process_button();
  }



 // echo tep_draw_button(IMAGE_BUTTON_CONFIRM_ORDER, 'check', null, 'primary');
?>
<div id="confirm_order">
<p>&nbsp;</p>
  <div class="buttonSet">
    <div class="buttonAction">
		<?php 
		if (SC_CONFIRMATION_PAGE == 'true') { //got to confimration page
			echo tep_template_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE);
		} else { //order now
			echo tep_template_image_submit('button_confirm_order.gif', IMAGE_BUTTON_CONFIRM_ORDER);
		}  ?>
		<br /><br />
    </div>
  </div>
</div>

</form>
</div><!-- Div end checkout -->
</div><!-- Div end checkout_container -->

<!-- body_eof //-->