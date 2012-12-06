<?php
/*
  $Id: checkout.php,v 1.7 2012/12/02

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  Copyright (c) 2012 STRUB

  Released under the GNU General Public License
*/

//description
//$sendto = is from db table ADRESS_BOOK the adress_book_id

require('includes/application_top.php');
//used for shipping
require('includes/classes/http_client.php');

  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));

  $content = CONTENT_CHECKOUT;
  $javascript = 'checkout.js.php';

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
