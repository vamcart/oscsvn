<?php

require('includes/application_top.php');
require('includes/functions/newsdesk_general.php'); 
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_NEWSDESK_INFO);

// set application wide parameters
// this query set is for NewsDesk

$configuration_query = tep_db_query("select configuration_key as cfgKey, configuration_value as cfgValue from " . TABLE_NEWSDESK_CONFIGURATION . "");
while ($configuration = tep_db_fetch_array($configuration_query)) {
	define($configuration['cfgKey'], $configuration['cfgValue']);
}

// lets retrieve all $_GET keys and values..
$get_params = tep_get_all_get_params();
$get_params_back = tep_get_all_get_params(array('reviews_id')); // for back button
$get_params = substr($get_params, 0, -1); //remove trailing &
if ($get_params_back != '') {
    $get_params_back = substr($get_params_back, 0, -1); //remove trailing &
} else {
    $get_params_back = $get_params;
}


if ($_GET['newsPath']) {
   $newsPath = $_GET['newsPath'];
} elseif ($_GET['newsdesk_id'] && !$_GET['manufacturers_id']) {
   $newsPath = newsdesk_get_product_path($_GET['newsdesk_id']);
} else {
   $newsPath = '';
}

if (strlen($newsPath) > 0) {
   $newsPath_array = newsdesk_parse_category_path($newsPath);
   $newsPath = implode('_', $newsPath_array);
   $current_category_id = $newsPath_array[(sizeof($newsPath_array)-1)];
} else {
   $current_category_id = 0;
}
if (isset($newsPath_array)) {
   $n = sizeof($newsPath_array);
   for ($i = 0; $i < $n; $i++) {
      $categories_query = tep_db_query(
      "select categories_name from " . TABLE_NEWSDESK_CATEGORIES_DESCRIPTION . " where categories_id = '" . $newsPath_array[$i]
      . "' and language_id='" . $languages_id . "'"
      );
      if (tep_db_num_rows($categories_query) > 0) {
         $categories = tep_db_fetch_array($categories_query);
         $breadcrumb->add($categories['categories_name'], tep_href_link(FILENAME_NEWSDESK_INDEX, 'newsPath='
         . implode('_', array_slice($newsPath_array, 0, ($i+1)))));
      } else {
         break;
      }
   }
}

if (isset($_GET['newsdesk_id'])){
   $news_query = tep_db_query("select p.newsdesk_id, pd.newsdesk_article_name from " . TABLE_NEWSDESK . " p, " . TABLE_NEWSDESK_DESCRIPTION . " pd where p.newsdesk_id = '" . $_GET['newsdesk_id'] . "' and pd.newsdesk_id = '" . $_GET['newsdesk_id'] . "' and pd.language_id = '" . $languages_id . "'");
   if (tep_db_num_rows($news_query)) {
      $news = tep_db_fetch_array($news_query);
      $breadcrumb->add($news['newsdesk_article_name'], tep_href_link(FILENAME_NEWSDESK_INFO, tep_get_all_get_params(), 'NONSSL'));
   }
}

//$javascript = "support.js";


$content = CONTENT_NEWSDESK_INFO;
require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>





<?php
/*

	osCommerce, Open Source E-Commerce Solutions ---- http://www.oscommerce.com
	Copyright (c) 2002 osCommerce
	Released under the GNU General Public License

	IMPORTANT NOTE:

	This script is not part of the official osC distribution but an add-on contributed to the osC community.
	Please read the NOTE and INSTALL documents that are provided with this file for further information and installation notes.

	script name:	NewsDesk
	version:		1.4.5
	date:			2003-08-31
	author:			Carsten aka moyashi
	web site:		www..com

*/
?>