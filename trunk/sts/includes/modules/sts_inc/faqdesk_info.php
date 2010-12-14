<?php
/*
  $Id: faqdesk_info.php,v 4.1 2006/01/25 23:55:58 rigadin Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  Released under the GNU General Public License
Based on: Simple Template System (STS) - Copyright (c) 2004 Brian Gallagher - brian@diamondsea.com
STS v4.1 by Rigadin (rigadin@osc-help.net)
*/

	$faqdesk_id=intval($_GET['faqdesk_id']);
// Create variables for faq ID, added in v4.0.6	
// Faq

$configuration_query = tep_db_query("select configuration_key as cfgKey, configuration_value as cfgValue from " . TABLE_FAQDESK_CONFIGURATION . "");
while ($configuration = tep_db_fetch_array($configuration_query)) {
	define($configuration['cfgKey'], $configuration['cfgValue']);
}

$product_info = tep_db_query("
select p.faqdesk_id, pd.faqdesk_question, pd.faqdesk_answer_long, pd.faqdesk_answer_short, 
p.faqdesk_image, p.faqdesk_image_two, p.faqdesk_image_three, pd.faqdesk_extra_url, pd.faqdesk_extra_viewed, p.faqdesk_date_added, 
p.faqdesk_date_available 
from " . TABLE_FAQDESK . " p, " . TABLE_FAQDESK_DESCRIPTION . " pd where p.faqdesk_id = '" . $faqdesk_id . "' 
and pd.faqdesk_id = '" . $faqdesk_id . "' and pd.language_id = '" . $languages_id . "'");

$product_info_values = tep_db_fetch_array($product_info);

// Картинки faq

if (($product_info_values['faqdesk_image'] != 'Array') && ($product_info_values['faqdesk_image'] != '')) {
$insert_image = tep_image(DIR_WS_IMAGES . $product_info_values['faqdesk_image'], $product_info_values['faqdesk_question']);
}


if (($product_info_values['faqdesk_image_two'] != '') && ($product_info_values['faqdesk_image_two'] != '')) {
$insert_image_two = tep_image(DIR_WS_IMAGES . $product_info_values['faqdesk_image_two'], $product_info_values['faqdesk_question']);
}

if (($product_info_values['faqdesk_image_three'] != '') && ($product_info_values['faqdesk_image_three'] != '')) {
$insert_image_three = tep_image(DIR_WS_IMAGES . $product_info_values['faqdesk_image_three'], $product_info_values['faqdesk_question']);
}
    
    
    $template_pinfo['faqdesk_id'] = $faqdesk_id;
    $template_pinfo['faqdesk_image'] = $insert_image;
    $template_pinfo['faqdesk_image_two'] = $insert_image_two;
    $template_pinfo['faqdesk_image_three'] = $insert_image_three;
    $template_pinfo['faqdesk_question'] = $product_info_values['faqdesk_question'];
    $template_pinfo['faqdesk_answer_short'] = $product_info_values['faqdesk_answer_short'];
    $template_pinfo['faqdesk_answer_long'] =  $product_info_values['faqdesk_answer_long'];
    $template_pinfo['faqdesk_extra_viewed'] =  TEXT_FAQDESK_VIEWED . $product_info_values['faqdesk_extra_viewed'];
    $template_pinfo['faqdesk_date_added'] = sprintf(TEXT_FAQDESK_DATE, tep_date_long($product_info_values['faqdesk_date_added']));

    $template_pinfo['faqdesk_search'] = '<form name="quick_find_faq" method="get" action="' . tep_href_link(FILENAME_FAQDESK_SEARCH_RESULT, '', 'NONSSL', false) .'">' . $hide = tep_hide_session_id() . $hide . TEXT_FAQDESK_SEARCH . '<input type="text" name="keywords" size="20" maxlength="30" value="' . htmlspecialchars(StripSlashes(@$_GET["keywords"])) .'" style="width: ' . (BOX_WIDTH-30) . 'px">
<input type="hidden" name="description" value="1">&nbsp;' . tep_image_submit('button_quick_find.gif', BOX_HEADING_SEARCH) . '</form>';

// See if there are any reviews
if ( DISPLAY_FAQDESK_REVIEWS ) {
$reviews = tep_db_query("
select count(*) as count from " . TABLE_FAQDESK_REVIEWS . " where approved='1' and faqdesk_id = '" 
. $faqdesk_id . "'
");
$reviews_values = tep_db_fetch_array($reviews);
if ($reviews_values['count'] > 0) {
  $template_pinfo['faqdesk_reviews'] = TEXT_FAQDESK_REVIEWS . ' ' . $reviews_values['count'];
} else {
  $template_pinfo['faqdesk_reviews'] = '';
}
}
	
// See if there is a faq URL
    if (tep_not_null($product_info_values['faqdesk_extra_url'])) {
  $template_pinfo['faqdesk_more_info_label'] = TEXT_FAQDESK_LINK;
  $template_pinfo['faqdesk_more_info_url'] = tep_href_link(FILENAME_REDIRECT, 'action=faqurl&goto=' . urlencode($product_info_values['faqdesk_extra_url']), 'NONSSL', true, false); 
} else {
  $template_pinfo['faqdesk_more_info_label'] = '';
  $template_pinfo['faqdesk_more_info_url'] = '';
}

$template_pinfo['faqdesk_more_info_label'] = str_replace('%s', $template_pinfo['faqdesk_more_info_url'], $template_pinfo['faqdesk_more_info_label']);

// See if any faq reviews
$template_pinfo['faqdesk_reviews_url'] = tep_href_link(FILENAME_FAQDESK_REVIEWS_ARTICLE, tep_get_all_get_params());
$template_pinfo['faqdesk_reviews_write_url'] = tep_href_link(FILENAME_FAQDESK_REVIEWS_WRITE, tep_get_all_get_params());
$template_pinfo['faqdesk_reviews_button'] = tep_image_button('button_reviews.gif', IMAGE_BUTTON_REVIEWS);
$template_pinfo['faqdesk_reviews_write_button'] = tep_image_button('button_write_review.gif', IMAGE_BUTTON_WRITE_REVIEW);

// See if any "Also Purchased" items. Feature added in v4.0.6
$sts->start_capture();
if ( DISPLAY_FAQDESK_REVIEWS ) {
	if ($reviews_values['count'] > 0) {
		include FILENAME_FAQDESK_ARTICLE_REQUIRE;
	}
}
$sts->stop_capture ('faqdesk_reviews_block'); // Get the result to the main array
$template_pinfo['faqdesk_reviews_block']= $sts->template['faqdesk_reviews_block']; // Put it in the article info

?>