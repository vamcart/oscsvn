<?php
/*
  $Id: column_left.php,v 1.15 2003/07/01 14:34:54 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// START  STS 4.1
if ($sts->display_template_output) {
  include DIR_WS_MODULES.'sts_inc/sts_column_left.php';
} else {
//END STS 4.1

  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_categories_box();
  } else {
    if (SET_BOX_CATEGORIES == 'true') include(DIR_WS_BOXES . 'categories.php');
  }

if (SPECIFICATIONS_FILTERS_BOX == 'True' && (basename ($PHP_SELF) == FILENAME_DEFAULT || basename ($PHP_SELF) == FILENAME_PRODUCTS_FILTERS)) {
  if (SET_BOX_FILTERS == 'true') include(DIR_WS_BOXES . 'products_filter.php');
}

  if (SET_BOX_INFORMATION == 'true') require(DIR_WS_BOXES . 'information.php');

  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_manufacturers_box();
  } else {
    if (SET_BOX_MANUFACTURERS == 'true') include(DIR_WS_BOXES . 'manufacturers.php');
  }

  if (SET_BOX_LATESTNEWS == 'true') require(DIR_WS_BOXES . 'newsdesk_latest.php');
  if (SET_BOX_SEARCH == 'true') require(DIR_WS_BOXES . 'search.php');
  if (SET_BOX_WHATSNEW == 'true') require(DIR_WS_BOXES . 'whats_new.php');
  if (SET_BOX_FEATURED == 'true') require(DIR_WS_BOXES . 'featured.php');
  if (SET_BOX_SHOP_BY_PRICE == 'true') require(DIR_WS_BOXES . 'shop_by_price.php');
//  require(DIR_WS_BOXES . 'newsdesk.php');
  if (SET_BOX_ARTICLES == 'true') require(DIR_WS_BOXES . 'articles.php');
  if (SET_BOX_AUTHORS == 'true') require(DIR_WS_BOXES . 'authors.php');
  if (SET_BOX_LINKS == 'true') require(DIR_WS_BOXES . 'links.php');

// START  STS 4.1
}
// END STS 4.1
  
?>