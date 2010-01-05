<?php
/*
  $Id: order_history.php,v 1.1.1.1 2003/09/18 19:05:50 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
*/

// retreive the last x products purchased
  $orders_query = tep_db_query("select distinct op.products_id from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_PRODUCTS . " p where o.customers_id = '" . $customer_id . "' and o.orders_id = op.orders_id and op.products_id = p.products_id and p.products_status = '1' group by products_id order by o.date_purchased desc limit " . MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX);
  if (tep_db_num_rows($orders_query)) {
?>
<!-- customer_orders //-->
<div class="box">
<b class="top"><b class="b1"></b><b class="b2"></b><b class="b3"></b><b class="b4"></b><b class="b5"></b></b>
<div class="boxHeader">
<h5><?php echo BOX_HEADING_CUSTOMER_ORDERS; ?></h5>
</div>
<div class="boxContent">
<?php

    $product_ids = '';
    while ($orders = tep_db_fetch_array($orders_query)) {
      $product_ids .= $orders['products_id'] . ',';
    }
    $product_ids = substr($product_ids, 0, -1);

    $customer_orders_string = '<table border="0" width="100%" cellspacing="0" cellpadding="1">' . "\n";
    $products_query = tep_db_query("select products_id, products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id in (" . $product_ids . ") and language_id = '" . $languages_id . "' order by products_name");
    while ($products = tep_db_fetch_array($products_query)) {
      $customer_orders_string .= '  <tr>' . "\n" .
                                 '    <td class="infoBoxContents"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id']) . '">' . $products['products_name'] . '</a></td>' . "\n" .
                                 '    <td class="infoBoxContents" align="right" valign="top"><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=cust_order&pid=' . $products['products_id'], 'NONSSL') . '">' . tep_image(DIR_WS_ICONS . 'cart.gif', ICON_CART) . '</a></td>' . "\n" .
                                 '  </tr>' . "\n";
    }
    $customer_orders_string .= '</table>';

    echo $customer_orders_string;

?>
</div>
<b class="bottom"><b class="b5b"></b><b class="b4b"></b><b class="b3b"></b><b class="b2b"></b><b class="b1b"></b></b>
</div>
<!-- customer_orders_eof //-->
<?php
  }
?>