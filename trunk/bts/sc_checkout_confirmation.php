<?php
/*
  $Id: checkout.php,v 1.7 2012/12/02

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  Copyright (c) 2012 STRUB

  Released under the GNU General Public License
*/

/*session description
tep_session_is_registered('create_account') = is used for data processing only
tep_session_is_registered('only_account') = is used to hide shipping and payment data and show only account data
tep_session_is_registered('is_virtual_product') = 

 
tep_session_is_registered('no_pay_no_ship') = is used to hide all data (shipping, payment, account)
*/

require('includes/application_top.php');

  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2);

  $content = CONTENT_SC_CHECKOUT_CONFIRMATION;
  $javascript = 'checkout.js.php';

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
