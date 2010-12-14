<?php
/*
  $Id: article_info.php,v 4.1 2006/01/25 23:55:58 rigadin Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  Released under the GNU General Public License
Based on: Simple Template System (STS) - Copyright (c) 2004 Brian Gallagher - brian@diamondsea.com
STS v4.1 by Rigadin (rigadin@osc-help.net)
*/

	$articles_id=intval($_GET['articles_id']);
// Create variables for article ID, added in v4.0.6	
// Статьи
  $article_check_query = tep_db_query("select count(*) as total from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where a.articles_status = '1' and a.articles_id = '" . $articles_id . "' and ad.articles_id = a.articles_id and ad.language_id = '" . (int)$languages_id . "'");
  $article_check = tep_db_fetch_array($article_check_query);

    $article_info_query = tep_db_query("select a.articles_id, a.articles_date_added, a.articles_date_available, a.authors_id, ad.articles_name, ad.articles_description, ad.articles_url, au.authors_name from " . TABLE_ARTICLES . " a left join " . TABLE_AUTHORS . " au on a.authors_id = au.authors_id, " . TABLE_ARTICLES_DESCRIPTION . " ad where a.articles_status = '1' and a.articles_id = '" . $articles_id . "' and ad.articles_id = a.articles_id and ad.language_id = '" . (int)$languages_id . "'");
    $article_info = tep_db_fetch_array($article_info_query);

    tep_db_query("update " . TABLE_ARTICLES_DESCRIPTION . " set articles_viewed = articles_viewed+1 where articles_id = '" . (int)$_GET['articles_id'] . "' and language_id = '" . (int)$languages_id . "'");
    
    $template_pinfo['articles_id'] = $articles_id;
    $template_pinfo['articles_name'] = $article_info['articles_name'];
    $template_pinfo['articles_authors_id'] = $article_info['authors_id'];
    $template_pinfo['articles_author'] =  $article_info['authors_name'];
    $template_pinfo['articles_description'] = $article_info['articles_description'];    
    $template_pinfo['articles_search'] = '<form name="quick_find" method="get" action="' . tep_href_link(FILENAME_ARTICLE_SEARCH, '', 'NONSSL', false) .'">' . $hide = tep_hide_session_id() . $hide . TEXT_ARTICLES_SEARCH . '<input type="text" name="akeywords" size="20" maxlength="30" value="' . htmlspecialchars(StripSlashes(@$_GET["akeywords"])) .'" style="width: ' . (BOX_WIDTH-30) . 'px">
<input type="hidden" name="description" value="1">&nbsp;' . tep_image_submit('button_quick_find.gif', BOX_HEADING_SEARCH) . '</form>';


if ($article_info['articles_date_available'] > date('Y-m-d H:i:s')) {
  $template_pinfo['articles_date_label'] = TEXT_DATE_AVAILABLE;
  $template_pinfo['articles_date'] = tep_date_long($article_info['articles_date_available']);
} else {
  $template_pinfo['articles_date_label'] = TEXT_DATE_ADDED;
  $template_pinfo['articles_date'] = tep_date_long($article_info['articles_date_added']); 
}
// Strip out %s values
$template_pinfo['articles_date_label'] = str_replace('%s.', '', $template_pinfo['articles_date_label']);

// See if there are any reviews
  if (ENABLE_ARTICLE_REVIEWS == 'true') {
    $reviews_query = tep_db_query("select count(*) as count from " . TABLE_ARTICLE_REVIEWS . " where articles_id = '" . (int)$_GET['articles_id'] . "' and approved = '1'");
    $reviews = tep_db_fetch_array($reviews_query);
if ($reviews['count'] > 0) {
  $template_pinfo['articles_reviews'] = TEXT_CURRENT_REVIEWS . ' ' . $reviews['count']; 
} else {
  $template_pinfo['articles_reviews'] = '';
}
}
	
// See if there is a article URL
    if (tep_not_null($article_info['articles_url'])) {
  $template_pinfo['articles_more_info_label'] = TEXT_MORE_INFORMATION;
  $template_pinfo['articles_more_info_url'] = tep_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($article_info['articles_url']), 'NONSSL', true, false); 
} else {
  $template_pinfo['articles_more_info_label'] = '';
  $template_pinfo['articles_more_info_url'] = '';
}

$template_pinfo['articles_more_info_label'] = str_replace('%s', $template_pinfo['articles_more_info_url'], $template_pinfo['articles_more_info_label']);

// See if any article reviews
$template_pinfo['articles_reviews_url'] = tep_href_link(FILENAME_ARTICLE_REVIEWS, tep_get_all_get_params());
$template_pinfo['articles_reviews_write_url'] = tep_href_link(FILENAME_ARTICLE_REVIEWS_WRITE, tep_get_all_get_params());
$template_pinfo['articles_reviews_button'] = tep_image_button('button_reviews.gif', IMAGE_BUTTON_REVIEWS);
$template_pinfo['articles_reviews_write_button'] = tep_image_button('button_write_review.gif', IMAGE_BUTTON_WRITE_REVIEW);

// See if any "Also Purchased" items. Feature added in v4.0.6
$sts->start_capture();
 if ((USE_CACHE == 'true') && empty($SID)) {
   echo tep_cache_also_purchased(3600);
 } else {
     include(DIR_WS_MODULES . FILENAME_ARTICLES_XSELL);
 }
$sts->stop_capture ('articles_also_purchased'); // Get the result to the main array
$template_pinfo['articles_also_purchased']= $sts->template['articles_also_purchased']; // Put it in the article info

?>