<?php

require('includes/application_top.php');

if (!tep_session_is_registered('customer_id')) {
	$navigation->set_snapshot();
	tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}

if (@$_GET['action'] == 'process') {
	$customer = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'");
	$customer_values = tep_db_fetch_array($customer);
	$date_now = date('Ymd');

	tep_db_query("insert into " . TABLE_NEWSDESK_REVIEWS . " (newsdesk_id, customers_id, customers_name, reviews_rating, date_added) values ('" . $_GET['newsdesk_id'] . "', '" . $customer_id . "', '" . addslashes($customer_values['customers_firstname']) . ' ' . addslashes($customer_values['customers_lastname']) . "', '" . $_POST['rating'] . "', now())");
    $insert_id = tep_db_insert_id();
    tep_db_query("insert into " . TABLE_NEWSDESK_REVIEWS_DESCRIPTION . " (reviews_id, languages_id, reviews_text) values ('" . $insert_id . "', '" . $languages_id . "', '" . $_POST['review'] . "')");

	tep_redirect(tep_href_link(FILENAME_NEWSDESK_REVIEWS_ARTICLE, $_POST['get_params'], 'NONSSL'));
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

require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_NEWSDESK_REVIEWS_WRITE);

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_NEWSDESK_REVIEWS_ARTICLE, $get_params, 'NONSSL'));

$product = tep_db_query("select pd.newsdesk_article_name, p.newsdesk_image from " . TABLE_NEWSDESK . " p, " . TABLE_NEWSDESK_DESCRIPTION . " pd where p.newsdesk_id = '" . $_GET['newsdesk_id'] . "' and pd.newsdesk_id = p.newsdesk_id and pd.language_id = '" . $languages_id . "'");

$product_info_values = tep_db_fetch_array($product);

$customer = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'");
$customer_values = tep_db_fetch_array($customer);

if ($product_info_values['newsdesk_image'] != '') {
$insert_image = '
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
<a href="' . tep_href_link(FILENAME_NEWSDESK_INFO, 'newsdesk_id=' . $product_info_values['newsdesk_id']) . '">' . tep_image(DIR_WS_IMAGES . 
$product_info_values['newsdesk_image'], '', '') . '</a>
		</td>
	</tr>
</table>
';
 }

//' . tep_image(DIR_WS_IMAGES . $product_info_values['newsdesk_image'], $product_info_values['newsdesk_article_name'] '', '') . '



$content = CONTENT_NEWSDESK_REVIEWS_WRITE;
$javascript = "newsdesk_reviews_write.js";

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