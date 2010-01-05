<?php
/*
  $Id: newsdesk_info.php,v 4.1 2006/01/25 23:55:58 rigadin Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  Released under the GNU General Public License
Based on: Simple Template System (STS) - Copyright (c) 2004 Brian Gallagher - brian@diamondsea.com
STS v4.1 by Rigadin (rigadin@osc-help.net)
*/

	$newsdesk_id=intval($_GET['newsdesk_id']);
// Create variables for news ID, added in v4.0.6	
// Faq

$configuration_query = tep_db_query("select configuration_key as cfgKey, configuration_value as cfgValue from " . TABLE_NEWSDESK_CONFIGURATION . "");
while ($configuration = tep_db_fetch_array($configuration_query)) {
	define($configuration['cfgKey'], $configuration['cfgValue']);
}

$product_info = tep_db_query("
select p.newsdesk_id, pd.newsdesk_article_name, pd.newsdesk_article_description, pd.newsdesk_article_shorttext, 
p.newsdesk_image, p.newsdesk_image_two, p.newsdesk_image_three, pd.newsdesk_article_url, pd.newsdesk_article_viewed, p.newsdesk_date_added, 
p.newsdesk_date_available 
from " . TABLE_NEWSDESK . " p, " . TABLE_NEWSDESK_DESCRIPTION . " pd where p.newsdesk_id = '" . $newsdesk_id . "' 
and pd.newsdesk_id = '" . $newsdesk_id . "' and pd.language_id = '" . $languages_id . "'");

$product_info_values = tep_db_fetch_array($product_info);

// Картинки новостей

if (($product_info_values['newsdesk_image'] != 'Array') && ($product_info_values['newsdesk_image'] != '')) {
$insert_image = tep_image(DIR_WS_IMAGES . $product_info_values['newsdesk_image'], $product_info_values['newsdesk_article_name']);
}


if (($product_info_values['newsdesk_image_two'] != '') && ($product_info_values['newsdesk_image_two'] != '')) {
$insert_image_two = tep_image(DIR_WS_IMAGES . $product_info_values['newsdesk_image_two'], $product_info_values['newsdesk_article_name']);
}

if (($product_info_values['newsdesk_image_three'] != '') && ($product_info_values['newsdesk_image_three'] != '')) {
$insert_image_three = tep_image(DIR_WS_IMAGES . $product_info_values['newsdesk_image_three'], $product_info_values['newsdesk_article_name']);
}
    
    
    $template_pinfo['newsdesk_id'] = $newsdesk_id;
    $template_pinfo['newsdesk_image'] = $insert_image;
    $template_pinfo['newsdesk_image_two'] = $insert_image_two;
    $template_pinfo['newsdesk_image_three'] = $insert_image_three;
    $template_pinfo['newsdesk_article_name'] = $product_info_values['newsdesk_article_name'];
    $template_pinfo['newsdesk_article_shorttext'] = $product_info_values['newsdesk_article_shorttext'];
    $template_pinfo['newsdesk_article_description'] =  $product_info_values['newsdesk_article_description'];
    $template_pinfo['newsdesk_article_viewed'] =  TEXT_NEWSDESK_VIEWED . $product_info_values['newsdesk_article_viewed'];
    $template_pinfo['newsdesk_date_added'] = sprintf(TEXT_NEWSDESK_DATE, tep_date_long($product_info_values['newsdesk_date_added']));

    $template_pinfo['newsdesk_search'] = '<form name="quick_find_news" method="get" action="' . tep_href_link(FILENAME_NEWSDESK_SEARCH_RESULT, '', 'NONSSL', false) .'">' . $hide = tep_hide_session_id() . $hide . TEXT_NEWSDESK_SEARCH . '<input type="text" name="keywords" size="20" maxlength="30" value="' . htmlspecialchars(StripSlashes(@$_GET["keywords"])) .'" style="width: ' . (BOX_WIDTH-30) . 'px">
<input type="hidden" name="description" value="1">&nbsp;' . tep_image_submit('button_quick_find.gif', BOX_HEADING_SEARCH) . '</form>';

// See if there are any reviews
if ( DISPLAY_NEWSDESK_REVIEWS ) {
$reviews = tep_db_query("
select count(*) as count from " . TABLE_NEWSDESK_REVIEWS . " where approved='1' and newsdesk_id = '" 
. $newsdesk_id . "'
");
$reviews_values = tep_db_fetch_array($reviews);
if ($reviews_values['count'] > 0) {
  $template_pinfo['newsdesk_reviews'] = TEXT_NEWSDESK_REVIEWS . ' ' . $reviews_values['count'];
} else {
  $template_pinfo['newsdesk_reviews'] = '';
}
}
	
// See if there is a news URL
    if (tep_not_null($product_info_values['newsdesk_article_url'])) {
  $template_pinfo['newsdesk_more_info_label'] = TEXT_NEWSDESK_LINK;
  $template_pinfo['newsdesk_more_info_url'] = tep_href_link(FILENAME_REDIRECT, 'action=newsurl&goto=' . urlencode($product_info_values['newsdesk_article_url']), 'NONSSL', true, false); 
} else {
  $template_pinfo['newsdesk_more_info_label'] = '';
  $template_pinfo['newsdesk_more_info_url'] = '';
}

$template_pinfo['newsdesk_more_info_label'] = str_replace('%s', $template_pinfo['newsdesk_more_info_url'], $template_pinfo['newsdesk_more_info_label']);

// See if any news reviews
$template_pinfo['newsdesk_reviews_url'] = tep_href_link(FILENAME_NEWSDESK_REVIEWS_ARTICLE, tep_get_all_get_params());
$template_pinfo['newsdesk_reviews_write_url'] = tep_href_link(FILENAME_NEWSDESK_REVIEWS_WRITE, tep_get_all_get_params());
$template_pinfo['newsdesk_reviews_button'] = tep_image_button('button_reviews.gif', IMAGE_BUTTON_REVIEWS);
$template_pinfo['newsdesk_reviews_write_button'] = tep_image_button('button_write_review.gif', IMAGE_BUTTON_WRITE_REVIEW);

// See if any "Also Purchased" items. Feature added in v4.0.6
$sts->start_capture();
if ( DISPLAY_NEWSDESK_REVIEWS ) {
	if ($reviews_values['count'] > 0) {
		include FILENAME_NEWSDESK_ARTICLE_REQUIRE;
	}
}
$sts->stop_capture ('newsdesk_reviews_block'); // Get the result to the main array
$template_pinfo['newsdesk_reviews_block']= $sts->template['newsdesk_reviews_block']; // Put it in the article info

?>