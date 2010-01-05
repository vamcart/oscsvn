<?php
/*
  $Id: kvitan.php,v 1.6 2003/06/20 00:37:30 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  
require(DIR_WS_LANGUAGES . $language . '/modules/payment/rusbank.php');

require(DIR_WS_CLASSES . 'order.php');
  $order = new order($_GET['order_id']);

  if ($order->customer['id'] != $customer_id) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'SSL'));
  }

/*error_log("Квитанция заказ ".$order);
error_log("Квитанция корзина ".$cart->count_contents());
error_log("Квитанция заказ всего " .$order->info['total']);
error_log("Квитанция заказ доставка страна " . $order->delivery['country']);
error_log("Квитанция заказ доставка name " . $order->delivery['name']);
error_log("Квитанция заказ доставка street_address " . $order->delivery['street_address']);
error_log("Квитанция заказ доставка city  " . $order->delivery['city']);
error_log("Квитанция заказ доставка postcode " . $order->delivery['postcode']);
error_log("Квитанция заказ покупатель name " . $order->customer['customers_name']);
error_log("Квитанция заказ покупатель city " . $order->customer['city']);
error_log("Это cart ---------------------", 0);
      while ( list( $key, $val ) = each($cart) ) {
         error_log("$key => $val", 0);
         }
error_log("Это order delivery ---------------------", 0);
      while ( list( $key, $val ) = each($order->delivery) ) {
         error_log("$key => $val", 0);
         }
error_log("Это shipping ---------------------", 0);
      while ( list( $key, $val ) = each($shipping) ) {
         error_log("$key => $val", 0);
         }
error_log("Это order_total ---------------------", 0);
      while ( list( $key, $val ) = each($order_total)) {
         error_log("$key => $val", 0);
         }*/
$FIO = $order->delivery['name'];

  $payment_info_query = tep_db_query("select name,address from " . TABLE_PERSONS . " where orders_id = '". tep_db_input(tep_db_prepare_input($_GET['order_id'])) . "'");
  $payment_info = tep_db_fetch_array($payment_info_query);

$Adress = $payment_info['name'] . "<br />" . $payment_info['address']; 
$total = $order->info['total'];
//$total = number_format( $order->info['total'] * $currencies->get_value('RUR'), $currencies->get_decimal_places('RUR')) . " руб.";
//error_log("Это FIO ". $FIO, 0);
$date = date("d-m-Y");
//error_log("Это дата ". $date, 0);

//'Название банка', 'MODULE_PAYMENT_RUS_BANK_1'
//'Расчетный счет', 'MODULE_PAYMENT_RUS_BANK_2'
//'БИК', 'MODULE_PAYMENT_RUS_BANK_3'
//'Кор./счет', 'MODULE_PAYMENT_RUS_BANK_4'
//'ИНН', 'MODULE_PAYMENT_RUS_BANK_5'
//'Получатель', 'MODULE_PAYMENT_RUS_BANK_6'
//'КПП', 'MODULE_PAYMENT_RUS_BANK_7'

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML dir=ltr lang=ru><HEAD><TITLE>Квитанция на оплату для  <?php echo $FIO ?></TITLE>
<META content="text/html; charset=windows-1251" http-equiv=Content-Type>
<META content="MSHTML 5.00.3700.6699" name=GENERATOR>
<style type="text/css">
BODY {FONT-FAMILY: Verdana, "Arial", sans-serif; FONT-SIZE: 10px;} TABLE {FONT-FAMILY: Verdana, "Arial", sans-serif; FONT-SIZE: 12px;} .ramka {BORDER-RIGHT: black 1px dotted ; BORDER-TOP: black 1px dotted; BORDER-LEFT: black 1px dotted ; BORDER-BOTTOM: black 1px dotted ;} .line {BORDER-LEFT: black 1px solid;} .n6 { 	FONT-SIZE: 7pt; FONT-FAMILY: "Verdana", "Arial Cyr", Arial, Helvetica } .t10 { 	FONT-WEIGHT: bold; FONT-SIZE: 10pt; FONT-FAMILY: "Times New Roman", Times, serif } .t11 { 	FONT-WEIGHT: bold; FONT-SIZE: 11pt; FONT-FAMILY: "Times New Roman", Times, serif } .n7 { 	FONT-SIZE: 7pt; FONT-FAMILY: "Arial Cyr", Arial, Helvetica } .b12 { 	FONT-WEIGHT: bold; FONT-SIZE: 12pt; BORDER-LEFT-COLOR: black; BORDER-BOTTOM-WIDTH: thin; BORDER-BOTTOM-COLOR: black; CURSOR: hand; BORDER-TOP-COLOR: black; FONT-FAMILY: "Arial Cyr", Arial, Helvetica; BORDER-RIGHT-COLOR: black } .b10 { 	BORDER-RIGHT: black 0px solid; BORDER-TOP: black 0px solid; FONT-WEIGHT: normal; FONT-SIZE: 10pt; BORDER-LEFT: black 0px solid; BORDER-BOTTOM: black 1px solid; FONT-FAMILY: "Verdana", "Arial Cyr", Arial, Helvetica } .n10 { 	BORDER-RIGHT: black 0px solid; BORDER-TOP: black 0px solid; FONT-WEIGHT: normal; FONT-SIZE: 10pt; BORDER-LEFT: black 0px solid; CURSOR: hand; BORDER-BOTTOM: black 1px solid; FONT-FAMILY: "Arial Cyr", Arial, Helvetica } .b10i { 	BORDER-RIGHT: black 0px solid; BORDER-TOP: black 0px solid; FONT-WEIGHT: bold; FONT-SIZE: 10pt; BORDER-LEFT: black 0px solid; CURSOR: hand; BORDER-BOTTOM: black 1px solid; FONT-STYLE: italic; FONT-FAMILY: "Arial Cyr", Arial, Helvetica } .t10n { 	FONT-WEIGHT: normal; FONT-SIZE: 10pt; FONT-FAMILY: "Times New Roman", Times, serif } .n10_ { 	FONT-WEIGHT: normal; FONT-SIZE: 10pt; BORDER-LEFT-COLOR: black; BORDER-BOTTOM-COLOR: #000000; CURSOR: hand; BORDER-TOP-COLOR: black; FONT-FAMILY: "Arial Cyr", Arial, Helvetica; BORDER-RIGHT-COLOR: black } .n10_a { 	FONT-WEIGHT: normal; FONT-SIZE: 10pt; BORDER-LEFT-COLOR: black; BORDER-BOTTOM-COLOR: #000000; CURSOR: hand; BORDER-TOP-COLOR: black; FONT-FAMILY: "Arial Cyr", Arial, Helvetica; TEXT-ALIGN: justify; BORDER-RIGHT-COLOR: black } .c10n { 	FONT-SIZE: 11pt; FONT-FAMILY: "Courier New", Courier, mono } .c10b { 	FONT-WEIGHT: bold; FONT-SIZE: 11pt; FONT-FAMILY: "Courier New", Courier, mono } .c7n { 	FONT-SIZE: 7pt; FONT-FAMILY: "Courier New", Courier, mono } .n7_ { 	FONT-SIZE: 7pt; FONT-FAMILY: "Arial Cyr", Arial, Helvetica; TEXT-ALIGN: justify } 
</style>
</HEAD>
<BODY>
<CENTER>
<table border="0" cellspacing="0" cellpadding="1" align="center">
  <tr class=ramka> 
    <td class=ramka> 
      <table class="b10" border=0 cellpadding=0 cellspacing=0 align="center" width="640" bgcolor="#FFFFFF">
        <tr> 
          <td rowspan=9 width="25">&nbsp; </td>
          <td valign="top" width="140"> 
            <div align="right"><img src="images/pixel_trans.gif" width="1" height="5"><br>

              <b>ИЗВЕЩЕНИЕ&nbsp;&nbsp;</b></div>
          </td>
<!-- start 1-->
          <td class=line rowspan=2><img src="images/pixel_trans.gif" width="1" height="1"></td>
          <td rowspan=2><img src="images/pixel_trans.gif" width="3" height="1"></td>
          <td rowspan=2 valign="top"> 
            <table border=0 cellpadding=0 cellspacing=2 align="center" width="100%">
              <tr> 
                <td class="b10" valign="bottom" colspan="3" height="25"> 
                  <div align="center"><?php echo MODULE_PAYMENT_RUS_BANK_6 ?></div>

                </td>
              </tr>
              <tr> 
                <td height="10" class="n6" valign="top" colspan="3"> 
                  <div align="center">(наименование получателя платежа)</div>
                </td>
              </tr>
              <tr> 
                <td class="b10" valign="bottom"> 
                  <div align="center"><?php echo MODULE_PAYMENT_RUS_BANK_5 ?>/<?php echo MODULE_PAYMENT_RUS_BANK_7 ?></div>

                </td>
                <td valign="bottom"> 
                  <div align="center">№</div>
                </td>
                <td class="b10" valign="bottom"> 
                  <div align="center"><?php echo MODULE_PAYMENT_RUS_BANK_2 ?></div>
                </td>
              </tr>
              <tr> 
                <td valign="top" class="n6"> 
                  <div align="center">(ИНН/КПП получателя платежа)</div>

                </td>
                <td valign="top" class="n6">&nbsp;</td>
                <td valign="top" class="n6"> 
                  <div align="center">(номер р/с получателя платежа)</div>
                </td>
              </tr>
              <tr> 
                <td class="b10" valign="bottom" colspan="3"> 
                  <div align="center"><?php echo MODULE_PAYMENT_RUS_BANK_1 ?></div>

                </td>
              </tr>
              <tr> 
                <td valign="top" class="n6" colspan="3"> 
                  <div align="center">(наименование банка получателя платежа)</div>
                </td>
              </tr>
              <tr> 
                <td valign="bottom" colspan="3"> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="1">

                    <tr> 
                      <td>БИК</td>
                      <td class="b10"><?php echo MODULE_PAYMENT_RUS_BANK_3 ?></td>
                      <td> 
                        <div align="center">№</div>
                      </td>
                      <td> 
                        <div align="center" class="b10"><?php echo MODULE_PAYMENT_RUS_BANK_4 ?></div>

                      </td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td valign="top" class="n6"> 
                        <div align="center">(номер к/с банка получателя платежа)</div>
                      </td>

                    </tr>
                  </table>
                </td>
              </tr>
              <tr valign="top"> 
                <td colspan="3" height="15"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" height="15">
                      <tr> 
                        <td align="left" width="90">Плательщик:</td>
                        <td class="b10"><?php echo $Adress ?></td>

                      </tr>
                    </table>
                </td>
              </tr>
<!-- 
              <tr> 
                <td colspan="3" height="15">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="left" width="50">Адрес:</td>

                      <td class="b10">&nbsp;</td>
                    </tr>
                  </table>
                </td>
              </tr>
/-->
              <tr> 
                <td colspan="3"> 
                  <div align="left">Назначение платежа:<br><?php echo MODULE_PAYMENT_RUS_BANK_8 . MODULE_PAYMENT_RUS_BANK_ORDER_NUMBER . $_GET['order_id']; ?></div>
                </td>

              </tr>
              <tr valign="top"> 
                <td class="t10" colspan="3"> 
                  <div align="center"> 
                    <table width="100%" border="0" cellspacing="2" cellpadding="0">
                      <tr> 
                        <td> 
                          <div align="right">Сумма платежа: </div>
                        </td>
                        <td> 
                          <div align="center"><b><?php echo $total ?></b></div>
                        </td>
<!--
                        <td class="b10" valign="bottom"> 
                          <div align="center">&nbsp;&nbsp;</div>
                        </td>
                        <td> 
                          <div align="center"><b>&nbsp;</b>коп.</div>
                        </td>
/-->
                      </tr>
                      <tr> 
                        <td> 
                          <div align="left">Плательщик: ____________ (подпись) 
                          </div>
                        </td>
                        <td> 
                          <div align="center">Дата:</div>
                        </td>

                        <td colspan="3">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" height="15">
                            <tr> 
                              <td class="b10"><?php echo $date ?></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="5"><img src="images/pixel_trans.gif" width="1" height="8"></td>
                      </tr>
                    </table>
                  </div>
                </td>
              </tr>
            </table>
          </td>
          <td class="b10" valign="bottom" rowspan="2"> 
            <div align="center"></div>
          </td>
          <td rowspan=9><img src="images/pixel_trans.gif" width="5" height="1"> </td>
<!-- end 1-->
        </tr>
        <tr> 
          <td valign="bottom" width="180">Кассир<br>
            <img src="images/pixel_trans.gif" width="1" height="8"> </td>
        </tr>
      </table>

      <table border=0 cellpadding=0 cellspacing=0 align="center" width="640" bgcolor="#FFFFFF">
        <tr> 
          <td rowspan=9 width="25">&nbsp; </td>
          <td valign="top" width="140"> </td>
<!-- start 2-->
          <td class=line rowspan=2><img src="images/pixel_trans.gif" width="1" height="1"></td>
          <td rowspan=2><img src="images/pixel_trans.gif" width="3" height="1"></td>
          <td rowspan=2 valign="top"> 
            <table border=0 cellpadding=0 cellspacing=2 align="center" width="100%">
              <tr> 
                <td class="b10" valign="bottom" colspan="3" height="25"> 
                  <div align="center"><?php echo MODULE_PAYMENT_RUS_BANK_6 ?></div>

                </td>
              </tr>
              <tr> 
                <td height="10" class="n6" valign="top" colspan="3"> 
                  <div align="center">(наименование получателя платежа)</div>
                </td>
              </tr>
              <tr> 
                <td class="b10" valign="bottom"> 
                  <div align="center"><?php echo MODULE_PAYMENT_RUS_BANK_5 ?>/<?php echo MODULE_PAYMENT_RUS_BANK_7 ?></div>

                </td>
                <td valign="bottom"> 
                  <div align="center">№</div>
                </td>
                <td class="b10" valign="bottom"> 
                  <div align="center"><?php echo MODULE_PAYMENT_RUS_BANK_2 ?></div>
                </td>
              </tr>
              <tr> 
                <td valign="top" class="n6"> 
                  <div align="center">(ИНН/КПП получателя платежа)</div>

                </td>
                <td valign="top" class="n6">&nbsp;</td>
                <td valign="top" class="n6"> 
                  <div align="center">(номер р/с получателя платежа)</div>
                </td>
              </tr>
              <tr> 
                <td class="b10" valign="bottom" colspan="3"> 
                  <div align="center"><?php echo MODULE_PAYMENT_RUS_BANK_1 ?></div>

                </td>
              </tr>
              <tr> 
                <td valign="top" class="n6" colspan="3"> 
                  <div align="center">(наименование банка получателя платежа)</div>
                </td>
              </tr>
              <tr> 
                <td valign="bottom" colspan="3"> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="1">

                    <tr> 
                      <td>БИК</td>
                      <td class="b10"><?php echo MODULE_PAYMENT_RUS_BANK_3 ?></td>
                      <td> 
                        <div align="center">№</div>
                      </td>
                      <td> 
                        <div align="center" class="b10"><?php echo MODULE_PAYMENT_RUS_BANK_4 ?></div>

                      </td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td valign="top" class="n6"> 
                        <div align="center">(номер к/с банка получателя платежа)</div>
                      </td>

                    </tr>
                  </table>
                </td>
              </tr>
              <tr valign="top"> 
                <td colspan="3" height="15"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" height="15">
                      <tr> 
                        <td align="left" width="90">Плательщик:</td>
                        <td class="b10"><?php echo $Adress ?></td>

                      </tr>
                    </table>
                </td>
              </tr>
<!-- 
              <tr> 
                <td colspan="3" height="15">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="left" width="50">Адрес:</td>

                      <td class="b10">&nbsp;</td>
                    </tr>
                  </table>
                </td>
              </tr>
/-->
              <tr> 
                <td colspan="3"> 
                  <div align="left">Назначение платежа:<br><?php echo MODULE_PAYMENT_RUS_BANK_8 . MODULE_PAYMENT_RUS_BANK_ORDER_NUMBER . $_GET['order_id']; ?></div>
                </td>

              </tr>
              <tr valign="top"> 
                <td class="t10" colspan="3"> 
                  <div align="center"> 
                    <table width="100%" border="0" cellspacing="2" cellpadding="0">
                      <tr> 
                        <td> 
                          <div align="right">Сумма платежа: </div>
                        </td>
                        <td> 
                          <div align="center"><b><?php echo $total ?></b></div>
                        </td>
<!--
                        <td class="b10" valign="bottom"> 
                          <div align="center">&nbsp;&nbsp;</div>
                        </td>
                        <td> 
                          <div align="center"><b>&nbsp;</b>коп.</div>
                        </td>
/-->
                      </tr>
                      <tr> 
                        <td> 
                          <div align="left">Плательщик: ____________ (подпись) 
                          </div>
                        </td>
                        <td> 
                          <div align="center">Дата:</div>
                        </td>

                        <td colspan="3">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" height="15">
                            <tr> 
                              <td class="b10"><?php echo $date ?></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="5"><img src="images/pixel_trans.gif" width="1" height="8"></td>
                      </tr>
                    </table>
                  </div>
                </td>
              </tr>
            </table>
          </td>
          <td class="b10" valign="bottom" rowspan="2"> 
            <div align="center"></div>
          </td>
          <td rowspan=9><img src="images/pixel_trans.gif" width="5" height="1"> </td>
<!-- end 2-->
        </tr>
        <tr> 
          <td valign="bottom" width="180"> 
            <p align="right"><b>КВИТАНЦИЯ</b>&nbsp;&nbsp;</p>
            <p>Кассир<br>
              <img src="images/pixel_trans.gif" width="1" height="8"> </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
</CENTER>
</BODY>
</HTML>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>

