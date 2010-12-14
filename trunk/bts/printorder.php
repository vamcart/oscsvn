<?php
/*
  $Id: printorder.php,v 1.1 2003/01 xaglo
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $customer_number_query = tep_db_query("select customers_id from " . TABLE_ORDERS . " where orders_id = '". tep_db_input(tep_db_prepare_input($_GET['order_id'])) . "'");
  $customer_number = tep_db_fetch_array($customer_number_query);
  if ($customer_number['customers_id'] != $customer_id) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }
  
  $payment_info_query = tep_db_query("select payment_info from " . TABLE_ORDERS . " where orders_id = '". tep_db_input(tep_db_prepare_input($_GET['order_id'])) . "'");
  $payment_info = tep_db_fetch_array($payment_info_query);

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ORDERS_PRINTABLE);

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order($_GET['order_id']);

  if ($order->customer['id'] != $customer_id) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'SSL'));
  }
  
  $company_query = tep_db_query("SELECT * FROM " . TABLE_COMPANIES . " WHERE orders_id='". tep_db_input(tep_db_prepare_input($_GET['order_id'])) . "'");
  $company = tep_db_fetch_array($company_query);

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE_PRINT_ORDER . TABLE_HEADING_NUM . '&nbsp;' . $_GET['order_id'] . TITLE_PRINT_NUMBER_TEXT; ?></title>
<base href="<?php echo (getenv('HTTPS') == 'on' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="print.css">
</head>
<body onload = myPrint() marginwidth="0" marginheight="0" topmargin="-10" bottommargin="0" leftmargin="0" rightmargin="0">


<!-- body_text //-->
<table width="600" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr> 
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr> 
          <td colspan="2" class="pageHeading"><?php echo tep_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
        </tr>
        <tr> 
         <td colspan="2" class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'printorder.gif', TITLE_PRINT_ORDER ); ?></td>
        </tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
		<td colspan="2" align="left" class="titleHeading_1"><?php echo MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_9 ?></td>
		</tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
<!-- Вывод реквизитов поставщика (Ваши реквизиты) //-->	
		<td colspan="2" align="left" class="main"><strong><?php echo ENTRY_EXT_DA . '&nbsp;' . '&nbsp;' . MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_6 . '&nbsp;' . MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_1 . '<br>' . MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_10; ?></strong></td>
<!-- End Вывод реквизитов поставщика //-->
		</tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
		<td colspan="2" align="center" class="main"><strong><?php echo ENTRY_OBR_DA ; ?></strong></td>
		</tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
		<td colspan="2"><table width="100%" border="1" bordercolor="#808080" cellpadding="1" cellspacing="1">
		<tr>
		<td width="100%">
<!-- Вывод образца заполнения платежного поручения //-->		
<table width="100%" border="0" cellspacing="1" cellpadding="1">
<tr>
<td class="titleHeading_2"><?php echo ENTRY_EXT_DA_1; ?></td>
</tr>
<tr>
<td class="titleHeading_2"><?php echo TABLE_HEADING_INN . '&nbsp;' . MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_7 . '&nbsp;' . MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_6;?></td>
</tr>
<tr>
<td class="titleHeading_2"></td>
</tr>
</table></td>
<td>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td class="titleHeading_2"><nobr><?php echo TABLE_HEADING_CONTNUM ?></td>
</tr>
</table></td>
<td>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td class="titleHeading_2"><?php echo MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_2; ?></td>
</tr>
</table></td>
</tr>
<tr>
<td rowspan="2">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td class="titleHeading_2"><?php echo ENTRY_EXT_DA_2; ?></td>
</tr>
<tr>
<td><?php echo MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_1; ?></td>
</tr>
</table></td>
<td align="center" class="titleHeading_2"><?php echo TABLE_HEADING_BIK ?></td>
<td rowspan="2">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td class="titleHeading_2"><?php echo MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_3; ?></td>
</tr>
<tr><td><?php echo MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_4; ?></td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center" class="titleHeading_2"><nobr><?php echo TABLE_HEADING_CONTNUM ?></td>
</tr>
</table>
<!-- End Вывод образца заполнения платежного поручения //-->
</td>
		</tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
        <tr> 
          <td colspan="2" align="center" class="main"><b><?php echo TITLE_PRINT_ORDER . TABLE_HEADING_NUM . '&nbsp;' . $_GET['order_id'] . TITLE_PRINT_NUMBER_TEXT . '&nbsp;' . TABLE_HEADING_OT . '&nbsp;' . tep_date_short($order->info['date_purchased']); ?></b></td>
        </tr>
        <tr align="left"> 
          <td colspan="2" class="titleHeading"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr> 
          <td valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr> 
                <td class="main" width="20" valign="top"> 
                  <?php if (tep_not_null($company['name'])) { echo '<b>' . ENTRY_SOLD_TO .'</b></td><td class="main" valign="top">' . $company['name'];
                           if (tep_not_null($company['address'])) { echo ', ' . $company['address'] . ' '; }
                           if (tep_not_null($company['rs'])) { echo ', <b>' . ENTRY_SOLD_TO_RS . '</b>&nbsp;' . $company['rs']; }
                           if (tep_not_null($company['bank_name'])) { echo ', <b>' .  ENTRY_SOLD_TO_BANK_NAME . '</b>&nbsp;' . $company['bank_name']; }
                           if (tep_not_null($company['ks'])) { echo ', <b>' . ENTRY_SOLD_TO_KS . '</b>&nbsp;' . $company['ks']; }
                           if (tep_not_null($company['bik'])) { echo ', <b>' . ENTRY_SOLD_TO_BIK . '</b>&nbsp;' . $company['bik']; }
                           if (tep_not_null($company['inn'])) { echo ', <b>' . ENTRY_SOLD_TO_INN . '</b>&nbsp;' . $company['inn']; }
                           if (tep_not_null($company['kpp'])) { echo ', <b>' . ENTRY_SOLD_TO_KPP . '</b>&nbsp;' . $company['kpp']; }
                        } else { echo '</td><td>'; } ?>
                </td>
                <td valign="top" class="main" align="right">
                  <?php if (tep_not_null($company['telephone'])) { echo '<b>' . ENTRY_SOLD_TO_2 .'</b>&nbsp;' . $company['telephone']; } ?>
                </td>
              </tr>
              <tr> 
                <td class="main" colspan="3"><?php echo  '<b>' . ENTRY_SOLD_TO_1 . '</b>' . '&nbsp;' . $order->customer['name']; ?></td>
              </tr>
			  <tr> 
                <td class="main" colspan="3"><?php echo  '<b>' . TITLE_PRINT_ORDER_NUM . '</b>' . '&nbsp;' . $_GET['order_id']; ?></td>
              </tr>
            </table></td>          
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
  <tr> 
    <td class="main"><?php echo '<b>' . ENTRY_PAYMENT_METHOD . '</b> ' . $order->info['payment_method']; ?></td>
  </tr>
  <tr> 
    <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
  <tr> 
    <td><table width="100%" border="1" bordercolor="#808080" cellspacing="1" cellpadding="1">
        <tr class="dataTableHeadingRow">
		  <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td> 
          <td class="dataTableHeadingContent" align="center"><?php echo '<nobr>' . TABLE_HEADING_PRODUCTS; ?></td>
		  <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PRODUCTS_CONT; ?></td>
          <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_TAX; ?></td>
          <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PRICE_EXCLUDING_TAX; ?></td>
          <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_TOTAL_EXCLUDING_TAX; ?></td>
          <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_TOTAL_INCLUDING_TAX; ?></td>
        </tr>
        <?php
    for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
      echo '      <tr class="dataTableRow" align="center">' . "\n" .
	 ' <td class="dataTableContent" valign="middle">' . $order->products[$i]['model'] . '</td>' . "\n" .
           '        <td class="dataTableContent" valign="middle">' . $order->products[$i]['name'] . "\n";
      if ($k = sizeof($order->products[$i]['attributes']) > 0) {
        for ($j = 0; $j < $k; $j++) {
          echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          if ($order->products[$i]['attributes'][$j]['price'] != '0') echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
          echo '</i></small></nobr>';
        }
      }
         echo  '        </td><td class="dataTableContent" valign="middle">' .
$order->products[$i]['qty'] . '</td>';
      echo '        </td>' . "\n";
      echo '        <td class="dataTableContent" valign="middle">' . tep_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n" .
           '        <td class="dataTableContent" align="right" valign="middle"><b>' . $currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
           
           '        <td class="dataTableContent" align="right" valign="middle"><b>' . $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
           '        <td class="dataTableContent" align="right" valign="middle"><b>' . $currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n";
      echo '      </tr>' . "\n";
    }
?>
        <tr> 
          <td align="right" colspan="7"><table border="0" cellspacing="0" cellpadding="2">
              <?php
  for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
    echo '          <tr>' . "\n" .
         '            <td align="right" class="smallText">' . $order->totals[$i]['title'] . '</td>' . "\n" .
         '            <td align="right" class="smallText">' . $order->totals[$i]['text'] . '</td>' . "\n" .
         '          </tr>' . "\n";
  }
?>
            </table></td>
        </tr>
		<tr><td colspan="8"><?php echo '<strong>' . TABLE_HEADING_SUMMA . '</strong>' . '&nbsp;'; 
require 'includes/summa.php'; 
?> 
</td></tr>
      </table></td>
  </tr>
  <tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
  <tr>
  <td>
  <?php echo ENTRY_BOSS . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . ENTRY_BOSS_NOME;?> 
  </td>
  </tr>
  <tr>
		<td colspan="2">&nbsp;</td>
		</tr>
  <tr>
		<td colspan="2" class="titleHeading_1"><?php echo MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_8 ;?></td>
		</tr>  
  <tr>
    <?php
  for ($i = 0, $n = sizeof($order->payment_info); $i < $n; $i++) {

  echo ' <td class="dataTableContent" valign="top">' . $order->products[$i]['model'] . '</td>';

  }
    ?>
  </tr>
  <tr> 
    <td align="left" class="main"><table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr> 
          <td class="main"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td align="left" class="main"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
</table>
<!-- body_text_eof //-->
<SCRIPT language=JavaScript>
	<!--
	function myPrint() {
	  if (window.print) {
	    if (confirm("Распечатать счет?")) {
	      window.print();
	    }
	  }
	}
	//-->
	</SCRIPT>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>