<?php

/*
  $Id: affiliate_info.php,v 1.2 2003/09/24 15:34:25 wilt Exp $
  OSC-Affiliate
  Contribution based on:

  osCommerce, Open Source E-Commerce Solutions

  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License

*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_SIGNUP_OK);
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_SIGNUP_OK));

  $content = CONTENT_AFFILIATE_SIGNUP_OK; 

//  $content_template = TEMPLATENAME_STATIC;

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);
  require(DIR_WS_INCLUDES . 'application_bottom.php'); 

?>

