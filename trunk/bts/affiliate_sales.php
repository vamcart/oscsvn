<?php

/*

  $Id: affiliate_sales.php,v 1.2 2003/09/24 15:34:25 wilt Exp $



  OSC-Affiliate



  Contribution based on:



  osCommerce, Open Source E-Commerce Solutions

  http://www.oscommerce.com



  Copyright (c) 2002 - 2003 osCommerce



  Released under the GNU General Public License

*/



  require('includes/application_top.php');



  if (!tep_session_is_registered('affiliate_id')) {

    $navigation->set_snapshot();

    tep_redirect(tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));

  }



  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_SALES);



  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_SALES, '', 'SSL'));



  $affiliate_sales_raw = "

    select  a.*, o.orders_status as orders_status_id, os.orders_status_name as orders_status from " . TABLE_AFFILIATE_SALES . " a 

    left join " . TABLE_ORDERS . " o on (a.affiliate_orders_id = o.orders_id) 

    left join " . TABLE_ORDERS_STATUS . " os on (o.orders_status = os.orders_status_id and language_id = '" . $languages_id . "') 

    where a.affiliate_id = '" . $affiliate_id . "'	 

    order by affiliate_date DESC

    ";



  $affiliate_sales_split = new splitPageResults($affiliate_sales_raw, MAX_DISPLAY_SEARCH_RESULTS);



  $content = affiliate_sales; 



  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);



  require(DIR_WS_INCLUDES . 'application_bottom.php'); 

?>
