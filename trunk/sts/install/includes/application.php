<?php
/*
  $Id: application.php,v 1.7 2004/05/20 23:44:33 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2004 osCommerce

  Released under the GNU General Public License
*/

// Set the level of error reporting
  error_reporting(E_ALL & ~E_NOTICE);

// check support for register_globals
  if (function_exists('ini_get') && (ini_get('register_globals') == false) && (PHP_VERSION < 4.3) ) {
    exit('Server Requirement Error: register_globals is disabled in your PHP configuration. This can be enabled in your php.ini configuration file or in the .htaccess file in your catalog directory. Please use PHP 4.3+ if register_globals cannot be enabled on the server.');
  }

  require('includes/functions/compatibility.php');

  if (isset($_GET['language'])) {
    setcookie('osC_Language', $_GET['language']);

    $language = $_GET['language'];
  } elseif (isset($_COOKIE['osC_Language'])) {
    $language = $_COOKIE['osC_Language'];
  } else {
    $language = 'russian';
  }

  require('languages/' . $language . '.php');
  require('languages/' . $language . '/' . basename($_SERVER['PHP_SELF']));

  require('../includes/functions/general.php');
  require('functions/general.php');
  require('../includes/functions/html_output.php');
  require('functions/html_output.php');

  require('functions/database.php');
?>
