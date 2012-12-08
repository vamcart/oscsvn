<?php

###################### payment url redirection START ###################################
//if payment method such as paypal is choosen,  repost process_button data
  if ((isset($$payment->form_action_url)) && ($sc_payment_url == true)) {
		
	$form_action_url = $$payment->form_action_url;
	echo tep_draw_form('checkoutUrl', $form_action_url, 'post');
	   
  
  
    
	if (is_array($payment_modules->modules)) {
		$payment_modules->pre_confirmation_check();
	}
  
  
	if (is_array($payment_modules->modules)) {
		echo $payment_modules->process_button();
	}

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

<?php




//draw form 
  //echo tep_draw_form('checkout_confirmation', $form_action_url, 'post');
$form_action_url = tep_href_link(FILENAME_SC_CHECKOUT_CONFIRMATION, '', 'SSL');
echo tep_draw_form('checkout_confirmation', $form_action_url, 'post');

  //echo tep_draw_form('checkout_confirmation', tep_href_link(FILENAME_SC_CHECKOUT_CONFIRMATION, 'action=process', 'SSL')); 

  echo tep_draw_hidden_field('action', 'process');

?> 
 


<div id="sc_content">


<div class="sc_box">

<?php
 /////////////  START Shipping address //////////////////////////// ?>
<div id="conf_shipping_box">

	<?php 
	if ($hide_shipping_data == true) {
		if  ($show_account_data != true) {
			echo '<p>' . SC_NO_SHIPMENT_INFORMATION . '</p>'; 
		}
	} else {
		echo '<h4>' . HEADING_DELIVERY_ADDRESS . '</h4>'; ?>
		<p><?php echo '' . tep_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); 
	 ?></p>
    
		<?php
        if ($order->info['shipping_method']) {
        ?>
        
                <p>&nbsp;</p>
                <?php echo '<h4>' . HEADING_SHIPPING_METHOD . ' </h4>'; ?>
                
                <p><?php echo $order->info['shipping_method']; ?></p>
                
                
              
    <?php
        }
	} //end $hide_shipping_data
    ?>

      


</div><!-- Div end conf_shipping_box -->
<?php /////////////  END Shipping address //////////////////////////// ?>



<?php /////////////  START Payment address //////////////////////////// ?>
<?php if ($hide_payment_data == true) {
	//show nothing
} else { ?>
<div id="conf_payment_box">
  <h2><?php echo HEADING_BILLING_INFORMATION; ?></h2>

 	
    
         <?php echo '<h4>' . HEADING_BILLING_ADDRESS . '</h4>'; ?>
          <p><?php echo tep_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'); ?></p>
          
          <p>&nbsp;</p>
          <?php echo '<h4>' . HEADING_PAYMENT_METHOD . '</h4>'; ?>
         <p><?php echo $order->info['payment_method']; ?></p>



  

</div><!-- Div end Payment box -->        
<?php
  }
  /////////////  END Payment address //////////////////////////// ?>



</div><!-- Div end main box -->

<div class="line_space"></div>

<?php /////////////  START comments //////////////////////////// ?>
<div class="sc_box">
<?php
  if (tep_not_null($order->info['comments'])) {
?>

  <h2><?php echo HEADING_ORDER_COMMENTS; ?></h2>

  <div class="contentText">
    <?php echo nl2br(tep_output_string_protected($order->info['comments'])) . tep_draw_hidden_field('comments', $order->info['comments']); ?>
  </div>

<?php
  }
?>
</div><!-- Div end comments box -->
<?php ///////////// END comments //////////////////////////// ?>

<div class="line_space"></div>


<?php /////////////  START products //////////////////////////// ?>
<div class="sc_box"> 
<?php
  if (sizeof($order->info['tax_groups']) > 1) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="2"><?php echo '<h2>' . HEADING_PRODUCTS . '</h2>'; ?></td>
            <td align="right"><strong><?php echo HEADING_TAX; ?></strong></td>
            <td align="right"><strong><?php echo HEADING_TOTAL; ?></strong></td>
          </tr>
</table>
<?php
  } else {
?>

          
          <?php echo '<h2>' . HEADING_PRODUCTS . '</h2>'; ?>

<?php
  }
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php

  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
    echo '          <tr>' . "\n" .
         '            <td align="right" valign="top" width="30">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . "\n" .
         '            <td valign="top">' . $order->products[$i]['name'];

    if (STOCK_CHECK == 'true') {
      echo tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty']);
    }

    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        echo '<br /><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'] . '</i></small></nobr>';
      }
    }

    echo '</td>' . "\n";

    if (sizeof($order->info['tax_groups']) > 1) echo '            <td valign="top" align="right">' . tep_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n";

    echo '            <td align="right" valign="top">' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . '</td>' . "\n" .
         '          </tr>' . "\n";
  }
?>

        </table>

</div><!-- Div end Products box --> 
<?php ///////////// END products //////////////////////////// ?>

<div class="line_space"></div>

<?php ///////////// START Total //////////////////////////// ?>
<div style="float: right;">
    <table border="0" cellspacing="0" cellpadding="2">
    <?php
	  if (MODULE_ORDER_TOTAL_INSTALLED) {
		echo $order_total_modules->output();
	  }
	?>
	</table>

</div>
 <?php ///////////// END Total //////////////////////////// ?> 
 
 <div class="line_space"></div>
 
 <div class="contentText">
    <div style="float: right;">
<?php
  if (is_array($payment_modules->modules)) {
    echo $payment_modules->process_button();
  }

?>

    </div>
  </div>

 
<div class="line_space"></div>  
  
<?php
  if (is_array($payment_modules->modules)) {
    if ($confirmation = $payment_modules->confirmation()) {
?>

  <h2><?php echo HEADING_PAYMENT_INFORMATION; ?></h2>

  <div class="contentText">
    <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="4"><?php echo $confirmation['title']; ?></td>
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
  
<br /><br />
<?php echo tep_template_image_submit('button_confirm_order.gif', IMAGE_BUTTON_CONFIRM_ORDER); ?> 

</div>



<script type="text/javascript">
$('#coProgressBar').progressbar({
  value: 100
});
</script>

</form>

<!-- body_eof //-->

<?php  if (SC_CONFIRMATION_PAGE == 'fffff') { ?>
  	<script type="text/javascript">
    document.checkout_confirmation.submit();
    </script>
	<noscript><input type="submit" value="verify submit"></noscript>
<?php  } ?>