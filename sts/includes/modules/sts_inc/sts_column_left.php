<?php
/*
  $Id: sts_column_left.php,v 4.3.3 2006/03/12 22:06:41 rigadin Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2005 osCommerce

  Released under the GNU General Public License

STS v4.3.3 by Rigadin (rigadin@osc-help.net)
Based on: Simple Template System (STS) - Copyright (c) 2004 Brian Gallagher - brian@diamondsea.com
*/

  $sts->restart_capture(); // Clear buffer but do not save it nowhere, no interesting information in buffer.
// Get categories box from db or cache  
  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_categories_box();
  } else {
    if (SET_BOX_CATEGORIES == 'true') include(DIR_WS_BOXES . 'categories.php');
  }  
  $sts->restart_capture ('categorybox', 'box');  

// Get manufacturer box from db or cache  
  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_manufacturers_box();
  } else {
    if (SET_BOX_MANUFACTURERS == 'true') include(DIR_WS_BOXES . 'manufacturers.php');
  }
  $sts->restart_capture ('manufacturerbox', 'box');

if (SPECIFICATIONS_FILTERS_BOX == 'True' && (basename ($PHP_SELF) == FILENAME_DEFAULT || basename ($PHP_SELF) == FILENAME_PRODUCTS_FILTERS)) {
  if (SET_BOX_FILTERS == 'true') require(DIR_WS_BOXES . 'products_filter.php');
  $sts->restart_capture ('filterbox', 'box');
} else {
	$sts->template['filterbox']='';
}

  if (SET_BOX_LATESTNEWS == 'true') require(DIR_WS_BOXES . 'newsdesk_latest.php');
  $sts->restart_capture ('newsdesk_latestbox', 'box');
  
  if (SET_BOX_WHATSNEW == 'true') require(DIR_WS_BOXES . 'whats_new.php');
  $sts->restart_capture ('whatsnewbox', 'box'); // Get What's new box
  
  if (SET_BOX_SEARCH == 'true') require(DIR_WS_BOXES . 'search.php');
  $sts->restart_capture ('searchbox', 'box'); // Get search box

  if (SET_BOX_FEATURED == 'true') require(DIR_WS_BOXES . 'featured.php');
  $sts->restart_capture ('featuredbox', 'box');
 
  if (SET_BOX_LATESTNEWS == 'true') require(DIR_WS_BOXES . 'newsdesk.php');
  $sts->restart_capture ('newsdeskbox', 'box');
 
  if (SET_BOX_SHOP_BY_PRICE == 'true') require(DIR_WS_BOXES . 'shop_by_price.php');
  $sts->restart_capture ('shop_by_pricebox', 'box');
  
  if (SET_BOX_ARTICLES == 'true') require(DIR_WS_BOXES . 'articles.php');
  $sts->restart_capture ('articlesbox', 'box');
  
  if (SET_BOX_AUTHORS == 'true') require(DIR_WS_BOXES . 'authors.php');
  $sts->restart_capture ('authorsbox', 'box');
  
  if (SET_BOX_LINKS == 'true') require(DIR_WS_BOXES . 'links.php');
  $sts->restart_capture ('linksbox', 'box');
  
  if (SET_BOX_INFORMATION == 'true') require(DIR_WS_BOXES . 'information.php');
  $sts->restart_capture ('informationbox', 'box');  // Get information box

if (!tep_session_is_registered('customer_id') && ENABLE_PAGE_CACHE == 'true' && class_exists('page_cache') ) {
  echo "<%CART_CACHE%>";
} else {
  if (SET_BOX_CART == 'true') require(DIR_WS_BOXES . 'shopping_cart.php');
}
$sts->restart_capture ('cartbox', 'box'); // Get shopping cart box

  if (SET_BOX_DOWNLOADS == 'true') require(DIR_WS_BOXES . 'download_files.php');
  $sts->restart_capture ('download_filesbox', 'box');

  if (SET_BOX_HELP == 'true') require(DIR_WS_BOXES . 'help.php');
  $sts->restart_capture ('helpbox', 'box');

  if (SET_BOX_LOGIN == 'true') require(DIR_WS_BOXES . 'loginbox.php');
  $sts->restart_capture ('accountbox', 'box');

  if (SET_BOX_WISHLIST == 'true') require(DIR_WS_BOXES . 'wishlist.php');
  $sts->restart_capture ('wishlistbox', 'box');

  if (SET_BOX_AFFILIATE == 'true') require(DIR_WS_BOXES . 'affiliate.php');
  $sts->restart_capture ('affiliatebox', 'box');

//  if (SET_BOX_FAQ == 'true') require(DIR_WS_BOXES . 'faqdesk.php');
//  $sts->restart_capture ('faqdeskbox', 'box');

  if (SET_BOX_FAQ_LATEST == 'true') require(DIR_WS_BOXES . 'faqdesk_latest.php');
  $sts->restart_capture ('faqdesk_latestbox', 'box');

  if (SET_BOX_POLLS == 'true') require(DIR_WS_BOXES . 'polls.php');
  $sts->restart_capture ('pollsbox', 'box');

  if (isset($_GET['products_id']) or SET_BOX_MANUFACTURERS_INFO == 'true') include(DIR_WS_BOXES . 'manufacturer_info.php');
  $sts->restart_capture ('maninfobox', 'box'); // Get manufacturer info box (empty if no product selected)

  if (tep_session_is_registered('customer_id')  or SET_BOX_ORDER_HISTORY == 'true') include(DIR_WS_BOXES . 'order_history.php');
  $sts->restart_capture ('orderhistorybox', 'box'); // Get customer's order history box (empty if visitor not logged)
  
  if (SET_BOX_BESTSELLERS == 'true') include(DIR_WS_BOXES . 'best_sellers.php');
  $sts->restart_capture ('bestsellersbox_only', 'box'); // Get bestseller box only, new since v4.0.5

// Get bestseller or product notification box. If you use this, do not use these boxes separately!  
  if (isset($_GET['products_id'])) {
    if (SET_BOX_NOTIFICATIONS == 'true') include(DIR_WS_BOXES . 'product_notifications.php');
	$sts->restart_capture ('notificationbox', 'box'); // Get product notification box
  
// Get bestseller or product notification box. If you use this, do not use these boxes separately!    
    if (tep_session_is_registered('customer_id')) {
      $check_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "' and global_product_notifications = '1'");
      $check = tep_db_fetch_array($check_query);
      if ($check['count'] > 0) {
        $sts->template['bestsellersbox']=$sts->template['bestsellersbox_only']; // Show bestseller box if customer asked for general notifications
      } else {
        $sts->template['bestsellersbox']=$sts->template['notificationbox']; // Otherwise select notification box
      }
    } else {
      $sts->template['bestsellersbox']=$sts->template['notificationbox']; // 
    }
  } else {
    $sts->template['bestsellersbox']=$sts->template['bestsellersbox_only'];
	$sts->template['notificationbox']='';
  }

  if (SET_BOX_SPECIALS == 'true') include(DIR_WS_BOXES . 'specials.php');
  $sts->restart_capture ('specialbox', 'box'); // Get special box
  $sts->template['specialfriendbox']=$sts->template['specialbox']; // Shows specials or tell a friend
  
  if (isset($_GET['products_id']) && basename($PHP_SELF) != FILENAME_TELL_A_FRIEND) {
    if (SET_BOX_TELL_A_FRIEND == 'true') include(DIR_WS_BOXES . 'tell_a_friend.php');
	$sts->restart_capture ('tellafriendbox', 'box'); // Get tell a friend box
	$sts->template['specialfriendbox']=$sts->template['tellafriendbox']; // Shows specials or tell a friend
  } else $sts->template['tellafriendbox']='';
  

// Get languages and currencies boxes, empty if in checkout procedure  
  if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
    if (SET_BOX_LANGUAGES == 'true') include(DIR_WS_BOXES . 'languages.php');
    $sts->restart_capture ('languagebox', 'box');

    if (SET_BOX_CURRENCIES == 'true') include(DIR_WS_BOXES . 'currencies.php');
    $sts->restart_capture ('currenciesbox', 'box');
  } else {
    $sts->template['languagebox']='';
    $sts->template['currenciesbox']='';
  }
  if (basename($PHP_SELF) != FILENAME_PRODUCT_REVIEWS_INFO) {
    if (SET_BOX_REVIEWS == 'true') require(DIR_WS_BOXES . 'reviews.php');
    $sts->restart_capture ('reviewsbox', 'box');  // Get the reviews box
  } else {
    $sts->template['reviewsbox']='';
  }	
?>