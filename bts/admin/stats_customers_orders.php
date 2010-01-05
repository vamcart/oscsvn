<?php
/*
  $Id: stats_customers_orders.php,v 1.2 24 mars 2005 


  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2005 osCommerce

  originally developed by xaglo
  Released under the GNU General Public License
*/
// change to your needs following
//  list of minimum for dropdown selection
  $list_mini = array("1", "2", "3", "4", "5", "10", "20");
// END CHANGING


  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

// detecte les constantes ou initialise
  $today = getdate();
  if ($_GET['year']) $year = tep_db_prepare_input($_GET['year']); 
  else $year = $today['year']; //  else $year = 'ALL';
  if ($_GET['month']) $month = tep_db_prepare_input($_GET['month']);   
    else $month = $today['mon']; //  else $month = 'ALL';
  if ($_GET['mini_ordered']) $mini_ordered = tep_db_prepare_input($_GET['mini_ordered']); 
  else $mini_ordered = 1;
  if ($_GET['no_status']) $no_status = tep_db_prepare_input($_GET['no_status']); 
  if ($_GET['status']) $status = tep_db_prepare_input($_GET['status']); 

//  get list of years for dropdown selection
$year_begin_query = tep_db_query(" select startdate from counter");
$year_begin = tep_db_fetch_array($year_begin_query);
$year_begin = substr($year_begin['startdate'], 0, 4);
$current_year = $year_begin;
while ($current_year != $today['year'] + 1) {
  $list_year_array[] = array('id' => $current_year,
                              'text' => $current_year);
$current_year++;
}

//  get list of month for dropdown selection
  $list_month = array(JAN, FEV, MAR, AVR, MAI, JUN, JUI, AOU, SEP, OCT, NOV, DEC);
  for ($i = 0, $n = sizeof($list_month); $i < $n; $i++) {
    $list_month_array[] = array('id' => $i+1,
                                'text' => $list_month[$i]);
}

// get list of minimum names for dropdown selection
for ($i = 0, $n = sizeof($list_mini); $i < $n; $i++) {
  $list_mini_array[] = array('id' => $list_mini[$i],
                              'text' => $list_mini[$i]);
}


// get list of orders_status names for dropdown selection
  $orders_statuses = array();
  $orders_status_array = array();
  $orders_status_query = tep_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . $languages_id . 
  "'");
  while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    $orders_statuses[] = array('id' => $orders_status['orders_status_id'],
                 'text' => $orders_status['orders_status_name']);
    $orders_status_array[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
     };

// Total new_customers
  $new_customers_query_raw = "select count(customers_info_id) as tot_new_customers from " . TABLE_CUSTOMERS_INFO . " where 1=1";
  if ($month != 'ALL') $new_customers_query_raw .= " and MONTH(customers_info_date_account_created) = " . $month ;
  if ($year != 'ALL') $new_customers_query_raw .= " and YEAR(customers_info_date_account_created) = " . $year;
  $new_customers_query = tep_db_query($new_customers_query_raw);
  $new_customers = tep_db_fetch_array($new_customers_query);
  $new_customers_count = $new_customers['tot_new_customers'];

//* Total distinct customers
  $customers_query_raw = "select distinct(customers_id) from " . TABLE_ORDERS . " where 1=1";
  if ($month != 'ALL') $customers_query_raw .= " and MONTH(date_purchased) = " . $month ;
  if ($year != 'ALL') $customers_query_raw .= " and YEAR(date_purchased) = " . $year;
  if ($no_status) $customers_query_raw .= " and orders_status <> " . $no_status;
  if ($status) $customers_query_raw .= " and orders_status = " . $status;
  $customers_query = tep_db_query($customers_query_raw);
  $customers_id_array = array();
  while ($customers = tep_db_fetch_array($customers_query)) {
    $customers_id_array[] = $customers['customers_id']; 
  }
  $customers_count = sizeof($customers_id_array);
//* Total new_customers_bought
  $new_customers_bought_query_raw = "select distinct(o.customers_id) from " . TABLE_ORDERS . " o, " . TABLE_CUSTOMERS_INFO . " ci where 
  ci.customers_info_id = o.customers_id";
  if ($month != 'ALL') $new_customers_bought_query_raw .= " and MONTH(o.date_purchased) = " . $month . " and MONTH(ci.customers_info_date_account_created) = 
  " . $month ;
  if ($year != 'ALL') $new_customers_bought_query_raw .= " and YEAR(o.date_purchased) = " . $year .  " and YEAR(ci.customers_info_date_account_created) = " . 
  $year;
  if ($no_status) $new_customers_query_raw .= " and o.orders_status <> " . $no_status;
  if ($status) $new_customers_query_raw .= " and o.orders_status = " . $status;
  $new_customers_bought_query = tep_db_query($new_customers_bought_query_raw);
  $new_customers_bought_id_array = array();
  while ($new_customers_bought = tep_db_fetch_array($new_customers_bought_query)) {
    $new_customers_bought_id_array[] = $new_customers_bought['customers_id']; 
  }
  $new_customers_bought_count = sizeof($new_customers_bought_id_array);
  if ($new_customers_bought_count > 0) $new_customers_bought_percent = tep_round($new_customers_bought_count/$new_customers_count*100, 0);

//* Total customers_bought
  $customers_bought_query_raw = "select customers_id from " . TABLE_ORDERS;
  if ($no_status) $customers_query_raw .= " where orders_status <> " . $no_status;
  if ($status) $customers_query_raw .= " where orders_status = " . $status;
  $customers_bought_query = tep_db_query($customers_bought_query_raw);
  $customers_bought_id_array = array();
  while ($customers_bought = tep_db_fetch_array($customers_bought_query)) { 
    $customers_bought_id_array[] = $customers_bought['customers_id'];     
      }

  $count_customers_again = 0;
  foreach($customers_id_array as $value) {
    $key = sizeof(array_keys($customers_bought_id_array, $value));
    if ($key>$mini_ordered) $count_customers_again++;
  }
  if ($customers_count > 0) $percent_customers_again = tep_round($count_customers_again/$customers_count*100, 0);

//* Total orders
  $orders_query_raw = "select count(*) as total from " . TABLE_ORDERS . " where 1=1 ";
  if ($month != 'ALL') $orders_query_raw .= " and MONTH(date_purchased) = " . $month ;
  if ($year != 'ALL') $orders_query_raw .= " and YEAR(date_purchased) = " . $year;
  if ($no_status) $orders_query_raw .= " and orders_status <> " . $no_status;
  if ($status) $orders_query_raw .= " and orders_status = " . $status;
  $orders_query = tep_db_query($orders_query_raw);
  $orders = tep_db_fetch_array($orders_query);
  $count_orders = $orders['total'];

//* Total sales
  $tot_sale_query_raw = "select sum(ot.value) as total, count(ot.value) as count from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot where 
  ot.class='ot_total' and ot.orders_id=o.orders_id";
  if ($month != 'ALL') $tot_sale_query_raw .= " and MONTH(o.date_purchased) = " . $month ;
  if ($year != 'ALL') $tot_sale_query_raw .= " and YEAR(o.date_purchased) = " . $year;  
    if ($no_status) $tot_sale_query_raw .= " and o.orders_status <> " . $no_status;
  if ($status) $tot_sale_query_raw .= " and o.orders_status = " . $status;
  $tot_sale_query = tep_db_query($tot_sale_query_raw);
  $tot_sale = tep_db_fetch_array($tot_sale_query);

//* Total taxes
  $tot_taxes_query_raw = "select sum(ot.value) as total from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot where ot.class='ot_tax' and 
  ot.orders_id=o.orders_id";
  if ($month != 'ALL') $tot_taxes_query_raw .= " and MONTH(date_purchased) = " . $month ;
  if ($year != 'ALL') $tot_taxes_query_raw .= " and YEAR(date_purchased) = " . $year;
  if ($no_status) $tot_taxes_query_raw .= " and orders_status <> " . $no_status;
  if ($status) $tot_taxes_query_raw .= " and orders_status = " . $status;
  $tot_taxes_query = tep_db_query($tot_taxes_query_raw);
    $tot_taxes = tep_db_fetch_array($tot_taxes_query);


//* Total shipping
  $tot_shipping_query_raw = "select sum(ot.value) as total from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot where ot.class='ot_shipping' and 
  ot.orders_id=o.orders_id";
  if ($month != 'ALL') $tot_shipping_query_raw .= " and MONTH(date_purchased) = " . $month ;
  if ($year != 'ALL') $tot_shipping_query_raw .= " and YEAR(date_purchased) = " . $year;
  if ($no_status) $tot_shipping_query_raw .= " and orders_status <> " . $no_status;
  if ($status) $tot_shipping_query_raw .= " and orders_status = " . $status;
  $tot_shipping_query = tep_db_query($tot_shipping_query_raw);
  $tot_shipping = tep_db_fetch_array($tot_shipping_query);

  $tot_HT=$tot_sale['total']-$tot_taxes['total']-$tot_shipping['total'];
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" 
    class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="0"><?php echo tep_draw_form('search', FILENAME_STATS_CUSTOMERS_ORDERS, '', 'get'); ?>
          <tr>
            <td class="dataTableContent" align="center"><?php echo HEADING_MONTH; ?>&nbsp;</td>
            <td class="dataTableContent" align="center"><?php echo HEADING_YEAR; ?>&nbsp;</td>
            <td class="dataTableContent" align="center"><?php echo HEADING_NUMBER_ORDERS; ?>&nbsp;</td>
<?php if ($status == '') { ?>
            <td class="dataTableContent" align="center"><?php echo HEADING_TITLE_NO_STATUS; ?>&nbsp;</td>
<?php } if ($no_status == '') { ?>
            <td class="dataTableContent" align="center"><?php echo HEADING_TITLE_STATUS; ?></td>
<?php } ?>
          </tr>
          <tr>
            <td class="main" align="center"><?php echo tep_draw_pull_down_menu('month', array_merge(array(array('id' => 'ALL', 'text' => TEXT_ALL_MOIS)), 
            $list_month_array), '', 'onChange="this.form.submit();"');?>&nbsp;</td>
            <td class="main" align="center"><?php echo tep_draw_pull_down_menu('year', array_merge(array(array('id' => 'ALL', 'text' => TEXT_ALL_ANNEE)), 
            $list_year_array), '', 'onChange="this.form.submit();"'); ?>&nbsp;</td>
            <td class="main" align="center"><?php echo tep_draw_pull_down_menu('mini_ordered', $list_mini_array, '', 'onChange="this.form.submit();"'); ?>&nbsp;</td>
<?php if ($status == '') { ?>
            <td class="main" align="center"><?php echo tep_draw_pull_down_menu('no_status', array_merge(array(array('id' => '', 'text' => TEXT_NO_ORDERS)), 
            $orders_statuses), '', 'onChange="this.form.submit();"'); ?>&nbsp;</td>
<?php } if ($no_status == '') { ?>
            <td class="main" align="center"><?php echo tep_draw_pull_down_menu('status', array_merge(array(array('id' => '', 'text' => TEXT_ALL_ORDERS)), 
            $orders_statuses), '', 'onChange="this.form.submit();"'); ?></td>
<?php } ?>
          </tr>
        </form></table></td>
      </tr>
      <tr>      
              <td><table border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr class="dataTableHeadingRow">
            <td align="right" class="dataTableHeadingContent"><?php echo NEW_CUSTOMERS; ?></td>
            <td class="dataTableHeadingContent"><?php echo $new_customers_count; ?></td>
          </tr>
          <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='hand'" onmouseout="this.className='dataTableRow'">
            <td align="right" class="dataTableContent"><?php echo CUSTOMERS_BOUGHT; ?></td>
            <td class="dataTableContent"><?php echo $customers_count; ?></td>
          </tr>
          <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='hand'" onmouseout="this.className='dataTableRow'">
            <td align="right" class="dataTableContent"><?php echo NEW_CUSTOMERS_BOUGHT; ?></td>
            <td class="dataTableContent"><?php echo $new_customers_bought_count . ' (' . $new_customers_bought_percent . "%)"; ?></td>
          </tr>
          <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='hand'" onmouseout="this.className='dataTableRow'">
            <td align="right" class="dataTableContent"><?php echo sprintf(TEXT_MINI_ORDERED, $mini_ordered);?></td>
            <td class="dataTableContent"><?php echo $count_customers_again . ' (' . $percent_customers_again . '%)'; ?></td>
          </tr>
          <tr class="dataTableHeadingRow">
            <td align="right" class="dataTableHeadingContent"><?php echo NUMBER_ORDER; ?></td>
            <td class="dataTableHeadingContent"><?php echo $count_orders; ?></td>
          </tr>
          <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='hand'" onmouseout="this.className='dataTableRow'">
            <td align="right" class="dataTableContent"><?php echo TOTAL_TTC; ?></td>
            <td align ="right" class="dataTableContent"><?php echo $currencies->format($tot_sale['total']); ?></td>
          </tr>
          <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='hand'" onmouseout="this.className='dataTableRow'">
            <td align="right" class="dataTableContent"><?php echo TOTAL_SHIPPING; ?></td>
            <td align ="right"  class="dataTableContent"><?php echo $currencies->format($tot_shipping['total']); ?></td>
          </tr>
          <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='hand'" onmouseout="this.className='dataTableRow'">
            <td align="right" class="dataTableContent"><?php echo TOTAL_TAX; ?></td>
            <td align ="right"  class="dataTableContent"><?php echo $currencies->format($tot_taxes['total']); ?></td>
          </tr>
          <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='hand'" onmouseout="this.className='dataTableRow'">
            <td align="right" class="dataTableContent"><?php echo TOTAL_HT; ?></td>

            <td align ="right"  class="dataTableContent"><?php echo $currencies->format($tot_HT); ?></td>
          </tr>
          <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='hand'" onmouseout="this.className='dataTableRow'">
            <td align="right" class="dataTableContent"><?php echo BASKET_TTC; ?></td>
            <td align ="right"  class="dataTableContent"><?php if ($count_orders > 0) echo $currencies->format($tot_sale['total']/$count_orders); ?></td>
          </tr>
          <tr class="dataTableHeadingRow">
            <td align="right" class="dataTableHeadingContent"><?php echo BASKET_HT; ?></td>
            <td align ="right"  class="dataTableHeadingContent"><?php if ($count_orders > 0) echo $currencies->format($tot_HT/$count_orders); ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>

<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
</body>
</html>