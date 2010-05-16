<?php
/*
  $Id: invoice.php,v 1.2 2003/09/24 15:18:15 wilt Exp $
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $customer_number_query = tep_db_query("select customers_id from " . TABLE_ORDERS . " where orders_id = '". tep_db_input(tep_db_prepare_input($_GET['order_id'])) . "'");
  $customer_number = tep_db_fetch_array($customer_number_query);
/*
  if ($customer_number['customers_id'] != $customer_id) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }
*/  
  $payment_info_query = tep_db_query("select payment_info from " . TABLE_ORDERS . " where orders_id = '". tep_db_input(tep_db_prepare_input($_GET['order_id'])) . "'");
  $payment_info = tep_db_fetch_array($payment_info_query);
  $payment_info = $payment_info['payment_info'];

//  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_INVOICE);

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $oID = tep_db_prepare_input($_GET['oID']);
  $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . tep_db_input($oID) . "'");

  include(DIR_WS_CLASSES . 'order.php');
  $order = new order($oID);

?>
<?php

class inwords { 

var $diw=Array(    0 =>    Array(    0  => Array( 0=> text_zero,    1=>1), 
                1  => Array( 0=> "",        1=>2), 
                2  => Array( 0=> "",        1=>3), 
                3  => Array( 0=> text_three,        1=>0), 
                4  => Array( 0=> text_four,    1=>0), 
                5  => Array( 0=> text_five,    1=>1), 
                6  => Array( 0=> text_six,    1=>1), 
                7  => Array( 0=> text_seven,    1=>1), 
                8  => Array( 0=> text_eight,    1=>1), 
                9  => Array( 0=> text_nine,    1=>1), 
                10 => Array( 0=> text_ten,    1=>1), 
                11 => Array( 0=> text_eleven,    1=>1), 
                12 => Array( 0=> text_twelve,    1=>1), 
                13 => Array( 0=> text_thirteen,    1=>1), 
                14 => Array( 0=> text_fourteen,1=>1), 
                15 => Array( 0=> text_fifteen,    1=>1), 
                16 => Array( 0=> text_sixteen,    1=>1), 
                17 => Array( 0=> text_seventeen,    1=>1), 
                18 => Array( 0=> text_eighteen,1=>1), 
                19 => Array( 0=> text_nineteen,1=>1) 
            ), 
        1 =>    Array(    2  => Array( 0=> text_twenty,    1=>1), 
                3  => Array( 0=> text_thirty,    1=>1), 
                4  => Array( 0=> text_forty,    1=>1), 
                5  => Array( 0=> text_fifty,    1=>1), 
                6  => Array( 0=> text_sixty,    1=>1), 
                7  => Array( 0=> text_seventy,    1=>1), 
                8  => Array( 0=> text_eighty,    1=>1), 
                9  => Array( 0=> text_ninety,    1=>1)  
            ), 
        2 =>    Array(    1  => Array( 0=> text_hundred,        1=>1), 
                2  => Array( 0=> text_two_hundred,    1=>1), 
                3  => Array( 0=> text_three_hundred,    1=>1), 
                4  => Array( 0=> text_four_hundred,    1=>1), 
                5  => Array( 0=> text_five_hundred,    1=>1), 
                6  => Array( 0=> text_six_hundred,    1=>1), 
                7  => Array( 0=> text_seven_hundred,    1=>1), 
                8  => Array( 0=> text_eight_hundred,    1=>1), 
                9  => Array( 0=> text_nine_hundred,    1=>1) 
            ) 
); 

var $nom=Array(    0 => Array(0=> text_penny,  1=> text_kopecks,    2=> text_single_kopek, 3=> text_two_penny), 
        1 => Array(0=> text_ruble,    1=> text_rubles,    2=> text_one_ruble,   3=> text_two_rubles), 
        2 => Array(0=> text_thousands,   1=> text_thousand,     2=> text_one_thousand,  3=> text_two_thousand), 
        3 => Array(0=> text_million, 1=> text_millions, 2=> text_one_million, 3=> text_two_million), 
        4 => Array(0=> text_billion, 1=> text_billions, 2=> text_one_billion, 3=> text_two_billion), 
/* :))) */ 
        5 => Array(0=> text_trillion, 1=> text_trillions, 2=> text_one_trillion, 3=>text_two_trillion) 
); 

var $out_rub; 

function get($summ){ 
 if($summ>=1) $this->out_rub=0; 
 else $this->out_rub=1; 
 $summ_rub= doubleval(sprintf("%0.0f",$summ)); 
 if(($summ_rub-$summ)>0) $summ_rub--; 
 $summ_kop= doubleval(sprintf("%0.2f",$summ-$summ_rub))*100; 
 $kop=$this->get_string($summ_kop,0); 
 $retval=""; 
 for($i=1;$i<6&&$summ_rub>=1;$i++): 
  $summ_tmp=$summ_rub/1000; 
  $summ_part=doubleval(sprintf("%0.3f",$summ_tmp-intval($summ_tmp)))*1000; 
  $summ_rub= doubleval(sprintf("%0.0f",$summ_tmp)); 
  if(($summ_rub-$summ_tmp)>0) $summ_rub--; 
  $retval=$this->get_string($summ_part,$i)." ".$retval; 
 endfor; 
 if(($this->out_rub)==0) $retval.=' ' . text_rubles; 
 return $retval." ".$kop; 
} 

function get_string($summ,$nominal){ 
 $retval=""; 
 $nom=-1; 
 $summ=round($summ); 
 if(($nominal==0&&$summ<100)||($nominal>0&&$nominal<6&&$summ<1000)): 
  $s2=intval($summ/100); 
  if($s2>0): 
   $retval.=" ".$this->diw[2][$s2][0]; 
   $nom=$this->diw[2][$s2][1]; 
  endif; 
  $sx=doubleval(sprintf("%0.0f",$summ-$s2*100)); 
  if(($sx-($summ-$s2*100))>0) $sx--; 
  if(($sx<20&&$sx>0)||($sx==0&&$nominal==0)): 
   $retval.=" ".$this->diw[0][$sx][0]; 
   $nom=$this->diw[0][$sx][1]; 
  else: 
   $s1=doubleval(sprintf("%0.0f",$sx/10)); 
   if(($s1-$sx/10)>0)$s1--; 
   $s0=doubleval($summ-$s2*100-$s1*10); 
   if($s1>0): 
    $retval.=" ".$this->diw[1][$s1][0]; 
    $nom=$this->diw[1][$s1][1]; 
   endif; 
   if($s0>0): 
    $retval.=" ".$this->diw[0][$s0][0]; 
    $nom=$this->diw[0][$s0][1]; 
   endif; 
  endif; 
 endif; 
 if($nom>=0): 
  $retval.=" ".$this->nom[$nominal][$nom]; 
  if($nominal==1) $this->out_rub=1; 
 endif; 
 return trim($retval); 
} 

} 

  $company_query = tep_db_query("SELECT * FROM ".TABLE_COMPANIES."
  					WHERE orders_id='".(int)$_GET['oID']."'");
  					
  $company = tep_db_fetch_array($company_query);

	$total_summ_query = tep_db_query("select value
	                                  from ".TABLE_ORDERS_TOTAL."
	                                  where orders_id = '".(int)$_GET['oID']."'
	                                  and class = 'ot_total'");

  $total_summ = tep_db_fetch_array($total_summ_query);

  $comments_query = tep_db_query("SELECT comments FROM ".TABLE_ORDERS_STATUS_HISTORY."
  					WHERE orders_id='".(int)$_GET['oID']."' and orders_status_id='1'");
  					
  $comments = tep_db_fetch_array($comments_query);

   $iw=new inwords; 
     
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo TITLE_PRINT_ORDER . $oID; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css" />
</head>
<body onload="window.print()">
<div class="page">


<?php if (MODULE_PAYMENT_RUS_SCHET_STATUS == 'True') { ?>
<p><b><?php echo TEXT_1; ?></b> <?php echo MODULE_PAYMENT_RUS_SCHET_6; ?><br />
<b><?php echo TEXT_2; ?></b> <?php echo MODULE_PAYMENT_RUS_SCHET_8; ?><br />
<b><?php echo TEXT_3; ?></b> 
<?php echo MODULE_PAYMENT_RUS_SCHET_2; ?> <b><?php echo TEXT_4; ?></b> <?php echo MODULE_PAYMENT_RUS_SCHET_1; ?><br />
<b><?php echo TEXT_5; ?></b> 
<?php echo MODULE_PAYMENT_RUS_SCHET_4; ?> <b><?php echo TEXT_6; ?></b> <?php echo MODULE_PAYMENT_RUS_SCHET_3; ?><br />
<b><?php echo TEXT_7; ?></b> <?php echo MODULE_PAYMENT_RUS_SCHET_7; ?>&nbsp; <b><?php echo TEXT_8; ?></b> <?php echo MODULE_PAYMENT_RUS_SCHET_5; ?><br /></p>
<?php } ?>
<?php if (tep_not_null($company['name'])) { ?>
<p><b><?php echo TEXT_9; ?></b> <?php echo $company['name']; ?></p>
<?php } else { ?>
<p><b><?php echo TEXT_9; ?></b> <?php echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, '&nbsp;', '<br>'); ?></p>
<?php } ?>

<?php if (tep_not_null($company['address'])) { ?><b><?php echo TEXT_2; ?></b> <?php echo $company['address']; ?><br /><?php } ?>
<?php if (tep_not_null($company['rs'])) { ?><b><?php echo TEXT_3; ?></b> <?php echo $company['rs']; ?><?php } ?>
<?php if (tep_not_null($company['bank_name'])) { ?>&nbsp;<b><?php echo TEXT_4; ?></b> <?php echo $company['bank_name']; ?><br /><?php } ?>
<?php if (tep_not_null($company['ks'])) { ?><b><?php echo TEXT_5; ?></b> <?php echo $company['ks']; ?><?php } ?>
<?php if (tep_not_null($company['bik'])) { ?>&nbsp;<b><?php echo TEXT_6; ?></b> <?php echo $company['bik']; ?><br /><?php } ?>
<?php if (tep_not_null($company['inn'])) { ?><b><?php echo TEXT_7; ?></b> <?php echo $company['inn']; ?><?php } ?>
<?php if (tep_not_null($company['kpp'])) { ?>&nbsp;<b><?php echo TEXT_8; ?></b> <?php echo $company['kpp']; ?><br /><?php } ?>

<p><b><?php echo ENTRY_TELEPHONE_NUMBER; ?></b>&nbsp;&nbsp;<?php echo $order->customer['telephone']; ?><br />
<b><?php echo ENTRY_EMAIL_ADDRESS; ?></b>&nbsp;&nbsp;<?php echo '<a href="mailto:' . $order->customer['email_address'] . '"><u>' . $order->customer['email_address'] . '</u></a>'; ?></p>
<p><?php echo $comments['comments']; ?></p>
<p><?php echo '<b>' . ENTRY_PAYMENT_METHOD . '</b> ' . $order->info['payment_method']; ?><br />
<?php echo $payment_info; ?></p>
<hr>
<p><b><font size="5"><?php echo TEXT_10; ?> <?php echo $oID; ?> <?php echo TEXT_11; ?> <?php echo tep_date_long($order->info['date_purchased']); ?></font></b></p>
<p>&nbsp;</p>
<table border="0" width="92%" id="table1" cellspacing="0">

	<tr>
		<td width="5%" style="border-style: solid; border-width: 1px" align="center"><b><?php echo TEXT_12; ?></b></td>
		<td width="17%" style="border-style: solid; border-width: 1px" align="center">
		<?php echo TEXT_13; ?></td>
		<td width="48%" style="border-style: solid; border-width: 1px" align="center"><b><?php echo TEXT_14; ?></b></td>
		<td width="12%" style="border-style: solid; border-width: 1px" align="center"><b><?php echo TEXT_15; ?></b></td>
		<td style="border-style: solid; border-width: 1px" width="6%" align="center"><b><?php echo TEXT_16; ?></b></td>
		<td width="9%" style="border-style: solid; border-width: 1px" align="center"><b><?php echo TEXT_17; ?></b></td>
	</tr>
<?php
    for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
    $num = $i +1;
      echo '      <tr>' . "\n" .
           '        <td width="5%" style="border-style: solid; border-width: 1px">' . $num . '.</td>' . "\n" .
           '        <td width="17%" style="border-style: solid; border-width: 1px">' . $order->products[$i]['model'] . '</td>' . "\n" .
           '        <td width="48%" style="border-style: solid; border-width: 1px">' . $order->products[$i]['name'];

      if (sizeof($order->products[$i]['attributes']) > 0) {
        for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {
          echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          echo '</i></small></nobr>';
        }
      }

      echo '        </td>' . "\n" .
           '        <td width="12%" style="border-style: solid; border-width: 1px">' . $order->products[$i]['qty'] . '</td>' . "\n" .
           '        <td style="border-style: solid; border-width: 1px" width="6%">' . number_format($currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']),2) . '</td>' . "\n" .
           '        <td width="9%" style="border-style: solid; border-width: 1px">' . number_format($currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax'], true) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']),2) . '</td>' . "\n";
           '      </tr>' . "\n";
    }
?>


              <?php
  for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
    echo '          <tr>' . "\n" .
         '            <td colspan="5" style="border-style: solid; border-width: 1px"><p align="right"><b>' . $order->totals[$i]['title'] . '</b></p></td>' . "\n" .
         '            <td width="9%" style="border-style: solid; border-width: 1px">' . number_format($order->totals[$i]['value'],2) . '</td>' . "\n" .
         '          </tr>' . "\n";
  }
?>

</table>
<p><b><?php echo TEXT_18; ?> <?php echo $iw->get($total_summ['value']); ?><?php echo TEXT_24; ?></b></p>
<p>&nbsp;</p>
<p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<?php echo TEXT_19; ?> ___________________ /<?php echo TEXT_20; ?>/</b></p>
<p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo TEXT_21; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<p>&nbsp;</p>
<p>&nbsp;</p>

</div>
</body></html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>