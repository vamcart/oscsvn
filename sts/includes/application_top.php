<?php
/*
  $Id: application_top.php,v 1.2 2003/09/24 15:34:33 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

// start the timer for the page parse time log
  define('PAGE_PARSE_START_TIME', microtime());
  define('DEBUG', false);
  $query_counts = 0;
  $query_total_time = 0;

while (list($key, $value) = each($_GET)){
    $_GET[$key] = preg_replace('/[<>]/', '', $value);
    unset($GLOBALS[$key]);
}

if (isset($_GET['products_id']))
    $_GET['products_id'] = $_GET['products_id'] = $products_id = $GLOBALS['products_id']= (int)$_GET['products_id'];
    
// set the level of error reporting
  error_reporting(E_ALL & ~E_NOTICE);

// check support for register_globals
  if (function_exists('ini_get') && (ini_get('register_globals') == false) && (PHP_VERSION < 4.3) ) {
    exit('Server Requirement Error: register_globals is disabled in your PHP configuration. This can be enabled in your php.ini configuration file or in the .htaccess file in your catalog directory. Please use PHP 4.3+ if register_globals cannot be enabled on the server.');
  }

// Set the local configuration parameters - mainly for developers
  if (file_exists('includes/local/configure.php')) include('includes/local/configure.php');

// include server parameters
  require('includes/configure.php');

// Redirect to install if configure.php is empty
if (defined('DIR_WS_INCLUDES') === false) header('Location: install');

  // Spiderkiller 
  require(DIR_WS_INCLUDES . 'spider_configure.php');


  if (strlen(DB_SERVER) < 1) {
    if (is_dir('install')) {
      header('Location: install/index.php');
    }
  }

// define the project version
  define('PROJECT_VERSION', 'osCommerce 2.2-MS2');

// some code to solve compatibility issues
  require(DIR_WS_FUNCTIONS . 'compatibility.php');

// set the type of request (secure or not)
  $request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';

// set php_self in the local scope
  if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];

  if ($request_type == 'NONSSL') {
    define('DIR_WS_CATALOG', DIR_WS_HTTP_CATALOG);
  } else {
    define('DIR_WS_CATALOG', DIR_WS_HTTPS_CATALOG);
  }

// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// customization for the design layout
define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');

// set the application parameters
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }

// if gzip_compression is enabled, start to buffer the output
  if ( (GZIP_COMPRESSION == 'true') && ($ext_zlib_loaded = extension_loaded('zlib')) && (PHP_VERSION >= '4') ) {
    if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
      if (PHP_VERSION >= '4.0.4') {
        ob_start('ob_gzhandler');
      } else {
        include(DIR_WS_FUNCTIONS . 'gzip_compression.php');
        ob_start();
        ob_implicit_flush();
      }
    } else {
      ini_set('zlib.output_compression_level', GZIP_LEVEL);
    }
  }

// set the HTTP GET parameters manually if search_engine_friendly_urls is enabled
  if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') {
    if (strlen(getenv('PATH_INFO')) > 1) {
      $GET_array = array();
      $PHP_SELF = str_replace(getenv('PATH_INFO'), '', $PHP_SELF);
      $vars = explode('/', substr(getenv('PATH_INFO'), 1));
      for ($i=0, $n=sizeof($vars); $i<$n; $i++) {
        if (strpos($vars[$i], '[]')) {
          $GET_array[substr($vars[$i], 0, -2)][] = $vars[$i+1];
        } else {
          $_GET[$vars[$i]] = $_GET[$vars[$i]] = $vars[$i+1];
        }
        $i++;
      }

      if (sizeof($GET_array) > 0) {
        while (list($key, $value) = each($GET_array)) {
          $_GET[$key] = $_GET[$key] = $value;
        }
      }
    }
  }

// define general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'general.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');

// set the cookie domain
  $cookie_domain = (($request_type == 'NONSSL') ? HTTP_COOKIE_DOMAIN : HTTPS_COOKIE_DOMAIN);
  $cookie_path = (($request_type == 'NONSSL') ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH);

// include cache functions if enabled
  if (USE_CACHE == 'true') include(DIR_WS_FUNCTIONS . 'cache.php');

// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

// include wishlist class
  require(DIR_WS_CLASSES . 'wishlist.php');

// include navigation history class
  require(DIR_WS_CLASSES . 'navigation_history.php');

// check if sessions are supported, otherwise use the php3 compatible session class
  if (!function_exists('session_start')) {
    define('PHP_SESSION_NAME', 'osCsid');
    define('PHP_SESSION_PATH', $cookie_path);
    define('PHP_SESSION_DOMAIN', $cookie_domain);
    define('PHP_SESSION_SAVE_PATH', SESSION_WRITE_DIRECTORY);

    include(DIR_WS_CLASSES . 'sessions.php');
  }

// define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

// set the session name and save path
  tep_session_name('osCsid');
  tep_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
   if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, $cookie_path, $cookie_domain);
  } elseif (function_exists('ini_set')) {
    ini_set('session.cookie_lifetime', '0');
    ini_set('session.cookie_path', $cookie_path);
    ini_set('session.cookie_domain', $cookie_domain);
  }

// set the session ID if it exists
   if (isset($_POST[tep_session_name()])) {
     tep_session_id($_POST[tep_session_name()]);
   } elseif ( ($request_type == 'SSL') && isset($_GET[tep_session_name()]) ) {
     tep_session_id($_GET[tep_session_name()]);
   }

// start the session
  $session_started = false;
  if (SESSION_FORCE_COOKIE_USE == 'True') {
    tep_setcookie('cookie_test', 'please_accept_for_session', time()+60*60*24*30, $cookie_path, $cookie_domain);

    if (isset($_COOKIE['cookie_test'])) {
      tep_session_start();
      $session_started = true;
    }
  } elseif (SESSION_BLOCK_SPIDERS == 'True') {
    $user_agent = strtolower(getenv('HTTP_USER_AGENT'));
    $spider_flag = false;

    if (tep_not_null($user_agent)) {
      $spiders = file(DIR_WS_INCLUDES . 'spiders.txt');

      for ($i=0, $n=sizeof($spiders); $i<$n; $i++) {
        if (tep_not_null($spiders[$i])) {
          if (is_integer(strpos($user_agent, trim($spiders[$i])))) {
            $spider_flag = true;
            break;
          }
        }
      }
    }

// START HACK for remove old sessions from search engines

if (($spider_flag)&&(is_integer(strpos($_SERVER{'REQUEST_URI'}, "?osCsid=")))){
preg_match("/(.+)\?osCsid=.+/",$_SERVER{'REQUEST_URI'},$matches);
   header ('Location: '.$matches[1]);
   header ('HTTP/1.0 301 Moved Permanently');
     die;  // Don't send any more output.
}
// END HACK

//$headers = apache_request_headers();

if ($headers{'If-Modified-Since'}) {

    if (is_integer(strpos($_SERVER{'SCRIPT_NAME'}, "/product_info.php"))){$table=TABLE_PRODUCTS;$modified_field="products_";}
    if (is_integer(strpos($_SERVER{'SCRIPT_NAME'}, "/newsdesk_info.php"))){$table=TABLE_NEWSDESK;$modified_field="newsdesk_";}
    if (is_integer(strpos($_SERVER{'SCRIPT_NAME'}, "product_reviews_info.php"))){$table=TABLE_REVIEWS;$modified_field="";$modified_add="reviews_";}
	if ($table) {
    $id=(int)$_GET[$modified_field.$modified_add."id"];
    $product_check_query = tep_db_query("select " . $modified_field . "date_added , " . $modified_field . "last_modified FROM " . $table . " WHERE ". $modified_field . $modified_add . "id=" . $id);
    $product_modify = tep_db_fetch_array($product_check_query);

    $date_added=$product_modify[$modified_field . "date_added"];

    if ($product_modify{$modified_field."last_modified"}) {$date_added=$product_modify[$modified_field."last_modified"];};

    if (strtotime($date_added)<(strtotime($headers{'If-Modified-Since'}))) {
	    	header ('Content-Type: text/html; charset=WINDOWS-1251');
	    	header ('HTTP/1.0 304 Not Modified');
			die;  // Don't send any more output.
    } else {
	    		header ('Content-Type: text/html; charset=WINDOWS-1251');
			header("Last-Modified: ".gmdate("D, d M Y G:i:s T",strtotime($date_added)));
	}
	}
}

if (!$table) {header("Last-Modified: ".gmdate( "D, d M Y G:i:s T" ));}

    if ($spider_flag == false) {
      tep_session_start();
      $session_started = true;
    }
  } else {
    tep_session_start();
    $session_started = true;
  }

  if ( ($session_started == true) && (PHP_VERSION >= 4.3) && function_exists('ini_get') && (ini_get('register_globals') == false) ) {
    extract($_SESSION, EXTR_OVERWRITE+EXTR_REFS);
  }

  //HTTP_REFERER
  if (!$referer_url) {
  	if ($_SERVER['HTTP_REFERER']) {
    $referer_url = $_SERVER['HTTP_REFERER'];
    tep_session_register('referer_url');
	}
  }


// set SID once, even if empty
  $SID = (defined('SID') ? SID : '');

// verify the ssl_session_id if the feature is enabled
  if ( ($request_type == 'SSL') && (SESSION_CHECK_SSL_SESSION_ID == 'True') && (ENABLE_SSL == true) && ($session_started == true) ) {
    $ssl_session_id = getenv('SSL_SESSION_ID');
    if (!tep_session_is_registered('SSL_SESSION_ID')) {
      $SESSION_SSL_ID = $ssl_session_id;
      tep_session_register('SESSION_SSL_ID');
    }

    if ($SESSION_SSL_ID != $ssl_session_id) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_SSL_CHECK));
    }
  }

// verify the browser user agent if the feature is enabled
  if (SESSION_CHECK_USER_AGENT == 'True') {
    $http_user_agent = getenv('HTTP_USER_AGENT');
    if (!tep_session_is_registered('SESSION_USER_AGENT')) {
      $SESSION_USER_AGENT = $http_user_agent;
      tep_session_register('SESSION_USER_AGENT');
    }

    if ($SESSION_USER_AGENT != $http_user_agent) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
  }

// verify the IP address if the feature is enabled
  if (SESSION_CHECK_IP_ADDRESS == 'True') {
    $ip_address = tep_get_ip_address();
    if (!tep_session_is_registered('SESSION_IP_ADDRESS')) {
      $SESSION_IP_ADDRESS = $ip_address;
      tep_session_register('SESSION_IP_ADDRESS');
    }

    if ($SESSION_IP_ADDRESS != $ip_address) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
  }

// create the shopping cart & fix the cart if necesary
  if (tep_session_is_registered('cart') && is_object($cart)) {
    if (PHP_VERSION < 4) {
      $broken_cart = $cart;
      $cart = new shoppingCart;
      $cart->unserialize($broken_cart);
    }
  } else {
    tep_session_register('cart');
    $cart = new shoppingCart;
  }

// include currencies class and create an instance
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

// include the mail classes
//  require(DIR_WS_CLASSES . 'mime.php');//  require(DIR_WS_CLASSES . 'email.php');
  require(DIR_WS_CLASSES . 'class.phpmailer.php');

// set the language
  if (!tep_session_is_registered('language') || isset($_GET['language'])) {
    if (!tep_session_is_registered('language')) {
      tep_session_register('language');
      tep_session_register('languages_id');
    }

    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();

    if (isset($_GET['language']) && tep_not_null($_GET['language'])) {
      $lng->set_language($_GET['language']);
    } else {
      $lng->set_language(DEFAULT_LANGUAGE);
      //$lng->get_browser_language();
    }

    $language = $lng->language['directory'];
    $languages_id = $lng->language['id'];
  }

// include the language translations
  require(DIR_WS_LANGUAGES . $language . '.php');

// currency
  if (!tep_session_is_registered('currency') || isset($_GET['currency']) || ( (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') && (LANGUAGE_CURRENCY != $currency) ) ) {
    if (!tep_session_is_registered('currency')) tep_session_register('currency');

    if (isset($_GET['currency']) && $currencies->is_set($_GET['currency'])) { 
      $currency = $_GET['currency'];
    } else {
      $currency = (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    }
  }

// navigation history
  if (tep_session_is_registered('navigation') && is_object($navigation)) {
    if (PHP_VERSION < 4) {
      $broken_navigation = $navigation;
      $navigation = new navigationHistory;
      $navigation->unserialize($broken_navigation);
    }
  } else {
    tep_session_register('navigation');
    $navigation = new navigationHistory;
  }
  $navigation->add_current_page();

// BOF: Down for Maintenance except for admin ip
if (EXCLUDE_ADMIN_IP_FOR_MAINTENANCE != getenv('REMOTE_ADDR')){
	if (DOWN_FOR_MAINTENANCE=='true' and !strstr($PHP_SELF,DOWN_FOR_MAINTENANCE_FILENAME)) { tep_redirect(tep_href_link(DOWN_FOR_MAINTENANCE_FILENAME)); }
	}
// do not let people get to down for maintenance page if not turned on
if (DOWN_FOR_MAINTENANCE=='false' and strstr($PHP_SELF,DOWN_FOR_MAINTENANCE_FILENAME)) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
}
// EOF: WebMakers.com Added: Down for Maintenance


// BOF: WebMakers.com Added: Functions Library
    include(DIR_WS_FUNCTIONS . 'webmakers_added_functions.php');
// EOF: WebMakers.com Added: Functions Library

// wishlist data
 if(!tep_session_is_registered('wishList')) {
 tep_session_register('wishList');
 $wishList = new wishlist;
 } 
 
//Wishlist actions (must be before shopping cart actions)
 if(isset($_POST['wishlist_x'])) {
 if(isset($_POST['products_id'])) {
 if(isset($_POST['id'])) {
 $attributes_id = $_POST['id'];
 tep_session_register('attributes_id');
 }
 $wishlist_id = $_POST['products_id'];
 tep_session_register('wishlist_id');
 }
 tep_redirect(tep_href_link(FILENAME_WISHLIST));
 }
               
// Shopping cart actions

  if (isset($_GET['action'])) {
// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled
    if ($session_started == false) {
      tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
    }

    if (DISPLAY_CART == 'true') {
      $goto =  FILENAME_SHOPPING_CART;
      $parameters = array('action', 'cPath', 'products_id', 'pid');
    } else {
      $goto = basename($PHP_SELF);
      if ($_GET['action'] == 'buy_now') {
        $parameters = array('action', 'pid', 'products_id');
      } else {
        $parameters = array('action', 'pid');
      }
    }
    switch ($_GET['action']) {
      // customer wants to update the product quantity in their shopping cart
      case 'update_product' : for ($i=0; $i<sizeof($_POST['products_id']);$i++) {
                                if (in_array($_POST['products_id'][$i], (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array()))) {
                                  $cart->remove($_POST['products_id'][$i]);
                                } else {
                                  if (PHP_VERSION < 4) {
                                    // if PHP3, make correction for lack of multidimensional array.
                                    reset($_POST);
                                    while (list($key, $value) = each($_POST)) {
                                      if (is_array($value)) {
                                        while (list($key2, $value2) = each($value)) {
                                          if (preg_match ("/(.*)\]\[(.*)/", $key2, $var)) {
                                            $id2[$var[1]][$var[2]] = $value2;
                                          }
                                        }
                                      }
                                    }
                                    $attributes = ($id2[$_POST['products_id'][$i]]) ? $id2[$_POST['products_id'][$i]] : '';
                                  } else {
                                    $attributes = ($_POST['id'][$_POST['products_id'][$i]]) ? $_POST['id'][$_POST['products_id'][$i]] : '';
                                  }
                                  if ( ($_POST['cart_quantity'][$i] >= tep_get_products_quantity_order_min($_POST['products_id'][$i])) ) {
                                    if ( ($_POST['cart_quantity'][$i]%tep_get_products_quantity_order_units($_POST['products_id'][$i])==0) ) {
                                      $cart->add_cart($_POST['products_id'][$i], $_POST['cart_quantity'][$i], $attributes, false);
                                    } else {
                                      $error_cart_msg=trim($error_cart_msg) . '<br>' . trim(tep_image(DIR_WS_IMAGES . 'pixel_trans.gif','', '11', '10') . ERROR_PRODUCTS_QUANTITY_ORDER_UNITS_TEXT . ' ' . tep_get_products_name($_POST['products_id'][$i]) . ' - ' . ERROR_PRODUCTS_UNITS_INVALID . ' ' . $_POST['cart_quantity'][$i] . ' - ' . PRODUCTS_ORDER_QTY_UNIT_TEXT_CART . ' ' . tep_get_products_quantity_order_units($_POST['products_id'][$i]));
                                    }
                                  } else {
                                    $error_cart_msg=trim($error_cart_msg) . '<br>' . trim(tep_image(DIR_WS_IMAGES . 'pixel_trans.gif','', '11', '10') . ERROR_PRODUCTS_QUANTITY_ORDER_MIN_TEXT . ' ' . tep_get_products_name($_POST['products_id'][$i]) . ' - ' . ERROR_PRODUCTS_QUANTITY_INVALID . ' ' . $_POST['cart_quantity'][$i] . ' - ' . PRODUCTS_ORDER_QTY_MIN_TEXT_CART . ' ' . tep_get_products_quantity_order_min($_POST['products_id'][$i]));
                                  }
                                }

//added for xsell_cart
if (isset($_POST['add_recommended'])) {
  foreach ($_POST['add_recommended'] as $value) {
    if (ereg('^[0-9]+$', $value)) {
      $cart->add_cart($value, $cart->get_quantity(tep_get_uprid($value, $_POST['id']))+1, $_POST['id']);
    }
  }
}
//added for xsell_cart

                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters), 'NONSSL'));
                              break;

/*
      // customer adds a product from the products page
      case 'add_product' :    if (isset($_POST['products_id']) && is_numeric($_POST['products_id'])) {
                                $cart->add_cart($_POST['products_id'], $cart->get_quantity(tep_get_uprid($_POST['products_id'], $_POST['id']))+1, $_POST['id']);
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
*/



      // customer adds a product from the products page
      case 'add_product' :    if (preg_match('/^[0-9]+$/', $_POST['products_id'])) {
          if ( ($_POST['cart_quantity'] >= tep_get_products_quantity_order_min($_POST['products_id'])) or ($cart->get_quantity(tep_get_uprid($_POST['products_id'], $_POST['id'])) >= tep_get_products_quantity_order_min($_POST['products_id']) ) ) {
              if ( $_POST['cart_quantity']%tep_get_products_quantity_order_units($_POST['products_id'])==0 and $cart->get_quantity(tep_get_uprid($_POST['products_id'], $_POST['id']))+($_POST['cart_quantity']) >= tep_get_products_quantity_order_min($_POST['products_id']) ) {
                $cart->add_cart($_POST['products_id'], $cart->get_quantity(tep_get_uprid($_POST['products_id'], $_POST['id']))+($_POST['cart_quantity']), $_POST['id']);
              } else {
                $error_cart_msg=ERROR_PRODUCTS_QUANTITY_ORDER_UNITS_TEXT . ERROR_PRODUCTS_UNITS_INVALID . $_POST['cart_quantity']  . ' - ' . PRODUCTS_ORDER_QTY_UNIT_TEXT_INFO . ' ' . tep_get_products_quantity_order_units($_POST['products_id']);
              }
          } else {
            $error_cart_msg=ERROR_PRODUCTS_QUANTITY_ORDER_MIN_TEXT . ERROR_PRODUCTS_QUANTITY_INVALID . $_POST['cart_quantity'] . ' - ' . PRODUCTS_ORDER_QTY_MIN_TEXT_INFO . ' ' . tep_get_products_quantity_order_min($_POST['products_id']);
          }
        }
        if ( strlen($error_cart_msg)==0 ) {
          tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters), 'NONSSL'));
        }
        break;

      // performed by the 'buy now' button in product listings and review page
      case 'buy_now' :        if (isset($_GET['products_id'])) {
                                if (tep_has_product_attributes($_GET['products_id'])) {
//      case 'buy_now' :        if ( tep_has_product_attributes($_GET['products_id']) or tep_get_products_quantity_order_units($_GET['products_id']) > 1 or tep_get_products_quantity_order_min($_GET['products_id']) > 1 ) {
                                tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id'], 'NONSSL'));
                              } else {
//                                $cart->add_cart($_GET['products_id'], $cart->get_quantity($_GET['products_id'])+tep_get_products_quantity_order_min($_POST['products_id']));
                                $cart->add_cart($_GET['products_id'], $cart->get_quantity($_GET['products_id'])+1);
                                tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters), 'NONSSL'));
                              }
                             }
                              break;
      case 'notify' :         if (tep_session_is_registered('customer_id')) {
                                if (isset($_GET['products_id'])) {
                                  $notify = $_GET['products_id'];
                                } elseif (isset($_GET['notify'])) {
                                  $notify = $_GET['notify'];
                                } elseif (isset($_POST['notify'])) {
                                  $notify = $_POST['notify'];
                                } else {
                                  tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'notify'))));
                                }
                                if (!is_array($notify)) $notify = array($notify);
                                for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
                                  $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $notify[$i] . "' and customers_id = '" . $customer_id . "'");
                                  $check = tep_db_fetch_array($check_query);
                                  if ($check['count'] < 1) {
                                    tep_db_query("insert into " . TABLE_PRODUCTS_NOTIFICATIONS . " (products_id, customers_id, date_added) values ('" . $notify[$i] . "', '" . $customer_id . "', now())");
                                  }
                                }
                                tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'notify'))));
                              } else {
                                $navigation->set_snapshot();
                                tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'notify_remove' :  if (tep_session_is_registered('customer_id') && isset($_GET['products_id'])) {
                                $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $_GET['products_id'] . "' and customers_id = '" . $customer_id . "'");
                                $check = tep_db_fetch_array($check_query);
                                if ($check['count'] > 0) {
                                  tep_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $_GET['products_id'] . "' and customers_id = '" . $customer_id . "'");
                                }
                                tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action'))));
                              } else {
                                $navigation->set_snapshot();
                                tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;


      case 'cust_order' :     if (tep_session_is_registered('customer_id') && isset($_GET['pid'])) {
                                if (tep_has_product_attributes($_GET['pid'])) {
                                  tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['pid']));
                                } else {
                                  $cart->add_cart($_GET['pid'], $cart->get_quantity($_GET['pid'])+1);
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;

    }
  }

// include the who's online functions
//  require(DIR_WS_FUNCTIONS . 'whos_online.php');
//  tep_update_whos_online();

// include the password crypto functions
  require_once(DIR_WS_FUNCTIONS . 'password_funcs.php');

// include validation functions (right now only email address)
  require_once(DIR_WS_FUNCTIONS . 'validations.php');

// split-page-results
  require(DIR_WS_CLASSES . 'split_page_results.php');

// infobox
  require(DIR_WS_CLASSES . 'boxes.php');

// auto activate and expire banners
  require(DIR_WS_FUNCTIONS . 'banner.php');
  tep_activate_banners();
  tep_expire_banners();

// auto expire special products
  require(DIR_WS_FUNCTIONS . 'specials.php');
  tep_expire_specials();

// auto expire featured products
  require(DIR_WS_FUNCTIONS . 'featured.php');
  tep_expire_featured();

// calculate category path
  if (isset($_GET['cPath'])) {
    $cPath = $_GET['cPath'];
  } elseif (isset($_GET['products_id']) && !isset($_GET['manufacturers_id'])) {
    $cPath = tep_get_product_path($_GET['products_id']);
  } else {
    $cPath = '';
  }

  if (tep_not_null($cPath)) {
    $cPath_array = tep_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $cPath_array[(sizeof($cPath_array)-1)];
  } else {
    $current_category_id = 0;
  }

// include the breadcrumb class and start the breadcrumb trail
  require(DIR_WS_CLASSES . 'breadcrumb.php');
  $breadcrumb = new breadcrumb;

//  $breadcrumb->add(HEADER_TITLE_TOP, HTTP_SERVER);
  $breadcrumb->add(HEADER_TITLE_CATALOG, tep_href_link(FILENAME_DEFAULT));

// add category names or the manufacturer name to the breadcrumb trail
  if (isset($cPath_array)) {
    for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) {
      $categories_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$cPath_array[$i] . "' and language_id = '" . (int)$languages_id . "'");
      if (tep_db_num_rows($categories_query) > 0) {
        $categories = tep_db_fetch_array($categories_query);
        $breadcrumb->add($categories['categories_name']);
      } else {
        break;
      }
    }
  } elseif (isset($_GET['manufacturers_id'])) {
// BOF manufacturers descriptions
//  $manufacturers_query = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'");
    $manufacturers_query = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and languages_id = '" . (int)$languages_id . "'");
// EOF manufacturers descriptions
    if (tep_db_num_rows($manufacturers_query)) {
      $manufacturers = tep_db_fetch_array($manufacturers_query);
      $breadcrumb->add($manufacturers['manufacturers_name']);
    }
  }

// add the products model to the breadcrumb trail

// add the products model to the breadcrumb trail
if (isset($_GET['products_id'])) {
$model_query = tep_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pd.products_id = p.products_id where p.products_id = '" .
(int)$_GET['products_id'] . "' and p.products_status = '1' and pd.language_id = '" . (int)$languages_id . "'");
if (tep_db_num_rows($model_query)) {
$model = tep_db_fetch_array($model_query);
$breadcrumb->add($model['products_name']);
}
}


// include the articles functions
  require(DIR_WS_FUNCTIONS . 'articles.php');
  require(DIR_WS_FUNCTIONS . 'article_header_tags.php'); 

// calculate topic path
  if (isset($_GET['tPath'])) {
    $tPath = $_GET['tPath'];
  } elseif (isset($_GET['articles_id']) && !isset($_GET['authors_id'])) {
    $tPath = tep_get_article_path($_GET['articles_id']);
  } else {
    $tPath = '';
  }

  if (tep_not_null($tPath)) {
    $tPath_array = tep_parse_topic_path($tPath);
    $tPath = implode('_', $tPath_array);
    $current_topic_id = $tPath_array[(sizeof($tPath_array)-1)];
  } else {
    $current_topic_id = 0;
  }

// add topic names or the author name to the breadcrumb trail
  if (isset($tPath_array)) {
    for ($i=0, $n=sizeof($tPath_array); $i<$n; $i++) {
      $topics_query = tep_db_query("select topics_name from " . TABLE_TOPICS_DESCRIPTION . " where topics_id = '" . (int)$tPath_array[$i] . "' and language_id = '" . (int)$languages_id . "'");
      if (tep_db_num_rows($topics_query) > 0) {
        $topics = tep_db_fetch_array($topics_query);
        $breadcrumb->add($topics['topics_name']);
      } else {
        break;
      }
    }
  } elseif (isset($_GET['authors_id'])) {
    $authors_query = tep_db_query("select authors_name from " . TABLE_AUTHORS . " where authors_id = '" . (int)$_GET['authors_id'] . "'");
    if (tep_db_num_rows($authors_query)) {
      $authors = tep_db_fetch_array($authors_query);
      $breadcrumb->add('Articles by ' . $authors['authors_name']);
    }
  }

// add the articles name to the breadcrumb trail
  if (isset($_GET['articles_id'])) {
    $article_query = tep_db_query("select articles_name from " . TABLE_ARTICLES_DESCRIPTION . " where articles_id = '" . (int)$_GET['articles_id'] . "'");
    if (tep_db_num_rows($article_query)) {
      $article = tep_db_fetch_array($article_query);
      if (isset($_GET['authors_id'])) {
        $breadcrumb->add($article['articles_name']);
      } else {
        $breadcrumb->add($article['articles_name']);
      }
    }
  }

//  if (isset($_GET['products_id'])) {
//    $model_query = tep_db_query("select products_model from " . TABLE_PRODUCTS . " where products_id = '" . (int)$_GET['products_id'] . "'");
//    if (tep_db_num_rows($model_query)) {
//      $model = tep_db_fetch_array($model_query);
//      $breadcrumb->add($model['products_model'], tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $cPath . '&products_id=' . $_GET['products_id']));
//    }
//  }

  // START STS 4.5
  require (DIR_WS_CLASSES.'sts.php');
  $sts= new sts();
  $sts->start_capture();
  // END STS

// initialize the message stack for output messages
  require(DIR_WS_CLASSES . 'message_stack.php');
  $messageStack = new messageStack;

// set which precautions should be checked
  define('WARN_INSTALL_EXISTENCE', 'true');
  define('WARN_CONFIG_WRITEABLE', 'true');
  define('WARN_SESSION_DIRECTORY_NOT_WRITEABLE', 'true');
  define('WARN_SESSION_AUTO_START', 'true');
  define('WARN_DOWNLOAD_DIRECTORY_NOT_READABLE', 'true');
// Include OSC-AFFILIATE
  require(DIR_WS_INCLUDES . 'affiliate_application_top.php');
REQUIRE(DIR_WS_INCLUDES . 'add_ccgvdc_application_top.php');

//include('includes/application_top_support.php');
include('includes/application_top_newsdesk.php');
include('includes/application_top_faqdesk.php');

// BOF: WebMakers.com Added: Header Tags Controller v1.0
  require(DIR_WS_FUNCTIONS . 'header_tags.php');
// Clean out HTML comments from ALT tags etc.
  require(DIR_WS_FUNCTIONS . 'clean_html_comments.php');
// Also used by: WebMakers.com Added: FREE-CALL FOR PRICE
// EOF: WebMakers.com Added: Header Tags Controller v1.0

// set the pollbooth parameters (can be modified through the administration tool)
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from phesis_poll_config');
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }

// +Country-State Selector
define ('DEFAULT_COUNTRY', STORE_COUNTRY);
// -Country-State Selector

// BOF FlyOpenair: Extra Product Price
  require(DIR_WS_FUNCTIONS . 'extra_product_price.php');
// EOF FlyOpenair: Extra Product Price

// adapted for Total B2B Contributions start
//Minimum group price to order   
  // min price
	$min_price_query  = tep_db_query("select g.customers_groups_min_price from " . TABLE_CUSTOMERS_GROUPS . " g inner join  " . TABLE_CUSTOMERS  . " c on g.customers_groups_id = c.customers_groups_id and c.customers_id = '" . $customer_id . "'");
    $min_price = tep_db_fetch_array($min_price_query); 
    $customers_groups_min_price = $min_price['customers_groups_min_price'];
	// define the minimum order
	define('MIN_ORDER_B2B', $customers_groups_min_price);
//Minimum group price to order 
//  adapted for Total B2B Contributions end

/*--------------------------------------------------------*\
#	Page cache contribution - by Chemo
#	Define the pages to be cached in the $cache_pages array
\*--------------------------------------------------------*/
$cache_pages = array('index.php', 'product_info.php', 'information.php', 'price.php', 'products_new.php', 'featured_products.php');
if (!tep_session_is_registered('customer_id') && ENABLE_PAGE_CACHE == 'true') {
	# Start the output buffer for the shopping cart
	ob_start();
	require(DIR_WS_INCLUDES . '/boxes/' . 'shopping_cart.php');
	$cart_cache = ob_get_clean();
	# End the output buffer for cart and save as $cart_cache string

	# Loop through the $cache_pages array and start caching if found
	foreach ($cache_pages as $index => $page){
		if ( strpos($_SERVER['PHP_SELF'], $page) ){

  # Start the output buffer for the shopping cart
  ob_start();
  require(DIR_WS_INCLUDES . '/boxes/' . 'shopping_cart.php');
  $cart_cache = ob_get_clean();
  if (is_object($sts) && $sts->display_template_output) {
    $cart_cache = sts_strip_unwanted_tags($cart_cache, 'cartbox');
  }  # End the output buffer for cart and save as $cart_cache string

			include(DIR_WS_CLASSES . 'page_cache.php');
			$page_cache = new page_cache($cart_cache);
			# The cache timelife is set globally 
			# in the admin control panel settings
			# Example below overrides the setting to 60 minutes
			# Leave blank to use default setting
			# $page_cache->cache_this_page(60);
			$page_cache->cache_this_page();
		} # End if
	} # End foreach
} # End if

    require('includes/local_modules.php');

////
// BOF: WebMakers.com Added: configuration key value lookup
  function tep_get_configuration_key_value($lookup) {
    $configuration_query_raw= tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key='" . $lookup . "'");
    $configuration_query= tep_db_fetch_array($configuration_query_raw);
    $lookup_value= $configuration_query['configuration_value'];
    if ( !($lookup_value) ) {
      $lookup_value='<font color="FF0000">' . $lookup . '</font>';
    }
    return $lookup_value;
  }
// EOF: WebMakers.com Added: configuration key value lookup

// starts canonical tag function
function CanonicalUrl() {
$domain = substr((($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER), 0); // gets the base URL minus the trailing slash
$string = $_SERVER['REQUEST_URI']; // gets the url
$search = '/\&osCsid.[^\&\?]*|\?osCsid.[^\&\?]*|\?sort.[^\&\?]*|\&sort.[^\&\?]*|\?direction.[^\&\?]*|\&direction.[^\&\?]*|\?on_page.[^\&\?]*|\&on_page.[^\&\?]*|\?page=1|\&page=1|\&cat.[^\&\?]*|\&filter_id.[^\&\?]*|\&manufacturers_id.[^\&\?]*|\&params.[^\&\?]*|\?q.[^\&\?]*|\&q.[^\&\?]*|\?price_min.[^\&\?]*|\&price_min.[^\&\?]*|\?price_max.[^\&\?]*|\&price_max.[^\&\?]*/'; // searches for the session id in the url
$replace = ''; // replaces with nothing i.e. deletes
echo $domain . preg_replace( $search, $replace, $string ); // merges the variables and echoing them
}
// eof - canonical tag

  define('SMTP_MAIL_SERVER', EMAIL_SMTP_SERVER);
  define('SMTP_MAIL_USERNAME', EMAIL_SMTP_USERNAME);
  define('SMTP_MAIL_PASSWORD', EMAIL_SMTP_PASSWORD);
  define('SMTP_PORT_NUMBER', EMAIL_SMTP_PORT);
  define('SMTP_SENDMAIL_FROM', STORE_OWNER_EMAIL_ADDRESS);
  define('SMTP_FROMEMAIL_NAME', STORE_NAME);
  
?>