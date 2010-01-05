<?php
/*
  $Id: column_right.php,v 1.17 2003/06/09 22:06:41 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// START STS 4.1
if ($sts->display_template_output) {
$sts->restart_capture ('content');
} else {
//END STS 4.1

if (!tep_session_is_registered('customer_id') && ENABLE_PAGE_CACHE == 'true' && class_exists('page_cache') ) {
      echo "<%CART_CACHE%>";
      } else {
      	if (SET_BOX_CART == 'true') require(DIR_WS_BOXES . 'shopping_cart.php');
      }

  if (SET_BOX_DOWNLOADS == 'true') require(DIR_WS_BOXES . 'download_files.php');
  if (SET_BOX_HELP == 'true') require(DIR_WS_BOXES . 'help.php');
  if (SET_BOX_LOGIN == 'true') require(DIR_WS_BOXES . 'loginbox.php');
  if (SET_BOX_WISHLIST == 'true') require(DIR_WS_BOXES . 'wishlist.php');
  if (SET_BOX_AFFILIATE == 'true') require(DIR_WS_BOXES . 'affiliate.php');
  if (SET_BOX_FAQ == 'true') require(DIR_WS_BOXES . 'faqdesk.php');
  if (SET_BOX_FAQ_LATEST == 'true') require(DIR_WS_BOXES . 'faqdesk_latest.php');
  if (SET_BOX_POLLS == 'true') require(DIR_WS_BOXES . 'polls.php');
      
  if (isset($_GET['products_id']) or SET_BOX_MANUFACTURERS_INFO == 'true') include(DIR_WS_BOXES . 'manufacturer_info.php');

  if (tep_session_is_registered('customer_id') or SET_BOX_ORDER_HISTORY == 'true') include(DIR_WS_BOXES . 'order_history.php');

  if (isset($_GET['products_id'])) {
    if (tep_session_is_registered('customer_id')) {
      $check_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "' and global_product_notifications = '1'");
      $check = tep_db_fetch_array($check_query);
      if ($check['count'] > 0) {
        if (SET_BOX_BESTSELLERS == 'true') include(DIR_WS_BOXES . 'best_sellers.php');
      } else {
        if (SET_BOX_NOTIFICATIONS == 'true') include(DIR_WS_BOXES . 'product_notifications.php');
      }
    } else {
      if (SET_BOX_NOTIFICATIONS == 'true') include(DIR_WS_BOXES . 'product_notifications.php');
    }
  } else {
    if (SET_BOX_BESTSELLERS == 'true') include(DIR_WS_BOXES . 'best_sellers.php');
  }

  if (isset($_GET['products_id'])) {
    if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND or SET_BOX_TELL_A_FRIEND == 'true') include(DIR_WS_BOXES . 'tell_a_friend.php');
  } else {
    if (SET_BOX_SPECIALS == 'true') include(DIR_WS_BOXES . 'specials.php');
  }

  if (SET_BOX_REVIEWS == 'true') require(DIR_WS_BOXES . 'reviews.php');

  if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
    if (SET_BOX_LANGUAGES == 'true') include(DIR_WS_BOXES . 'languages.php');
    if (SET_BOX_CURRENCIES == 'true') include(DIR_WS_BOXES . 'currencies.php');
  }
  
// START  STS 4.1
}
// END STS 4.1
  
?>