<?php
/*
  $Id: allprods.php,v 1.7 2002/12/02

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  Copyright (c) 2002 HMCservices

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLES);

// Set number of columns in listing
define ('NR_COLUMNS', 1);
//
  $breadcrumb->add(HEADING_TITLE, tep_href_link(FILENAME_ARTICLES, '', 'NONSSL'));

  $content = CONTENT_ARTICLES;

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>