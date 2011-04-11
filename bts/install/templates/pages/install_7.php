<?php
/*
  $Id: install_7.php,v 1.4 2004/11/07 21:02:15 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2004 osCommerce

  Released under the GNU General Public License
*/

  $dir_fs_document_root = $_POST['DIR_FS_DOCUMENT_ROOT'];
  if ((substr($dir_fs_document_root, -1) != '/') && (substr($dir_fs_document_root, -1) != '/')) {
    $where = strrpos($dir_fs_document_root, '\\');
    if (is_string($where) && !$where) {
      $dir_fs_document_root .= '/';
    } else {
      $dir_fs_document_root .= '\\';
    }
  }
?>

<p class="pageTitle"><?php echo PAGE_TITLE_INSTALLATION; ?></p>

<p class="pageSubTitle"><?php echo PAGE_SUBTITLE_OSCOMMERCE_CONFIGURATION; ?></p>

<?php
  $db = array();
  $db['DB_SERVER'] = trim(stripslashes($_POST['DB_SERVER']));
  $db['DB_SERVER_USERNAME'] = trim(stripslashes($_POST['DB_SERVER_USERNAME']));
  $db['DB_SERVER_PASSWORD'] = trim(stripslashes($_POST['DB_SERVER_PASSWORD']));
  $db['DB_DATABASE'] = trim(stripslashes($_POST['DB_DATABASE']));

  $db_error = false;
  osc_db_connect($db['DB_SERVER'], $db['DB_SERVER_USERNAME'], $db['DB_SERVER_PASSWORD']);

  if ($db_error == false) {
    osc_db_test_connection($db['DB_DATABASE']);
  }

  if ($db_error != false) {
?>
<form name="install" action="install.php?step=6" method="post">

<table width="95%" border="0" cellpadding="2" class="formPage">
  <tr>
    <td><?php echo $db_error; ?></td>
  </tr>
</table>

<p>&nbsp;</p>

<table width="95%" border="0" cellspacing="2">
  <tr>
    <td align="right"><input type="image" src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/buttons/back.gif" border="0" alt="<?php echo IMAGE_BUTTON_BACK; ?>">&nbsp;&nbsp;<a href="index.php"><img src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/buttons/cancel.gif" border="0" alt="<?php echo IMAGE_BUTTON_CANCEL; ?>"></a></td>
  </tr>
</table>

<?php
    foreach ($_POST as $key => $value) {
      if ($key != 'x' && $key != 'y') {
        if (is_array($value)) {
          for ($i=0, $n=sizeof($value); $i<$n; $i++) {
            echo osc_draw_hidden_field($key . '[]', $value[$i]);
          }
        } else {
          echo osc_draw_hidden_field($key, $value);
        }
      }
    }
?>

</form>

<?php
  } elseif ( ( (file_exists($dir_fs_document_root . 'includes/configure.php')) && (!is_writeable($dir_fs_document_root . 'includes/configure.php')) ) || ( (file_exists($dir_fs_document_root . '/admin/includes/configure.php')) && (!is_writeable($dir_fs_document_root . '/admin/includes/configure.php')) ) ) {
?>
<form name="install" action="install.php?step=7" method="post">

<table width="95%" border="0" cellpadding="2" class="formPage">
  <tr>
    <td><?php echo sprintf(ERROR_CONFIG_FILE_NOT_WRITEABLE, $dir_fs_document_root); ?></td>
  </tr>
</table>

<table width="95%" border="0" cellpadding="2" class="formPage">
  <tr>
    <td><?php echo sprintf(ERROR_CONFIG_ADMIN_FILE_NOT_WRITEABLE, $dir_fs_document_root); ?></td>
  </tr>
</table>

<p>&nbsp;</p>

<table width="95%" border="0" cellspacing="2">
  <tr>
    <td align="right"><input type="image" src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/buttons/retry.gif" border="0" alt="<?php echo IMAGE_BUTTON_RETRY; ?>">&nbsp;&nbsp;<a href="index.php"><img src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/buttons/cancel.gif" border="0" alt="<?php echo IMAGE_BUTTON_CANCEL; ?>"></a></td>
  </tr>
</table>

<?php
    foreach ($_POST as $key => $value) {
      if ($key != 'x' && $key != 'y') {
        if (is_array($value)) {
          for ($i=0, $n=sizeof($value); $i<$n; $i++) {
            echo osc_draw_hidden_field($key . '[]', $value[$i]);
          }
        } else {
          echo osc_draw_hidden_field($key, $value);
        }
      }
    }
?>

</form>

<?php
  } else {
    $http_url = parse_url($_POST['HTTP_WWW_ADDRESS']);
    $http_server = $http_url['scheme'] . '://' . $http_url['host'];
    $http_catalog = $http_url['path'];
    if (isset($http_url['port']) && !empty($http_url['port'])) {
      $http_server .= ':' . $http_url['port'];
    }

    if (substr($http_catalog, -1) != '/') {
      $http_catalog .= '/';
    }

    $https_server = '';
    $https_catalog = '';
    if (isset($_POST['HTTPS_WWW_ADDRESS']) && !empty($_POST['HTTPS_WWW_ADDRESS'])) {
      $https_url = parse_url($_POST['HTTPS_WWW_ADDRESS']);
      $https_server = $https_url['scheme'] . '://' . $https_url['host'];
      $https_catalog = $https_url['path'];

      if (isset($https_url['port']) && !empty($https_url['port'])) {
        $https_server .= ':' . $https_url['port'];
      }

      if (substr($https_catalog, -1) != '/') {
        $https_catalog .= '/';
      }
    }

    $enable_ssl = (isset($_POST['ENABLE_SSL']) && ($_POST['ENABLE_SSL'] == 'true') ? 'true' : 'false');
    $http_cookie_domain = $_POST['HTTP_COOKIE_DOMAIN'];
    $https_cookie_domain = (isset($_POST['HTTPS_COOKIE_DOMAIN']) ? $_POST['HTTPS_COOKIE_DOMAIN'] : '');
    $http_cookie_path = $_POST['HTTP_COOKIE_PATH'];
    $https_cookie_path = (isset($_POST['HTTPS_COOKIE_PATH']) ? $_POST['HTTPS_COOKIE_PATH'] : '');

    $http_work_directory = $_POST['HTTP_WORK_DIRECTORY'];
    if (substr($http_work_directory, -1) != '/') {
      $http_work_directory .= '/';
    }
    
    $file_contents = '<?php' . "\n" .
                     '/*' . "\n" .
                     '  osCommerce, Open Source E-Commerce Solutions' . "\n" .
                     '  http://www.oscommerce.com' . "\n" .
                     '' . "\n" .
                     '  Copyright (c) 2003 osCommerce' . "\n" .
                     '' . "\n" .
                     '  Released under the GNU General Public License' . "\n" .
                     '*/' . "\n" .
                     '' . "\n" .
                     '// Define the webserver and path parameters' . "\n" .
                     '// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
                     '// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
                     '  define(\'HTTP_SERVER\', \'' . $http_server . '\'); // eg, http://localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'HTTPS_SERVER\', \'' . $https_server . '\'); // eg, https://localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'ENABLE_SSL\', ' . $enable_ssl . '); // secure webserver for checkout procedure?' . "\n" .
                     '  define(\'HTTP_COOKIE_DOMAIN\', \'' . $http_cookie_domain . '\');' . "\n" .
                     '  define(\'HTTPS_COOKIE_DOMAIN\', \'' . $https_cookie_domain . '\');' . "\n" .
                     '  define(\'HTTP_COOKIE_PATH\', \'' . $http_cookie_path . '\');' . "\n" .
                     '  define(\'HTTPS_COOKIE_PATH\', \'' . $https_cookie_path . '\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root . '\');' . "\n" .
                     '  define(\'DIR_WS_HTTP_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
                     '  define(\'DIR_WS_HTTPS_CATALOG\', \'' . $https_catalog . '\');' . "\n" .
                     '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                     '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                     '  define(\'DIR_WS_INCLUDES\', DIR_FS_CATALOG . \'includes/\');' . "\n" .
                     '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                     '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                     '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                     '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                     '  define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');' . "\n" .
                     '  define(\'DIR_WS_LANGUAGES_IMAGES\', \'includes/languages/\');' . "\n" .
                     '' . "\n" .
                     '//Added for BTS1.0' . "\n" .
                     '  define(\'DIR_WS_TEMPLATES\', \'templates/\');' . "\n" .
                     '  define(\'DIR_WS_CONTENT\', DIR_WS_TEMPLATES . \'content/\');' . "\n" .
                     '  define(\'DIR_WS_JAVASCRIPT\', DIR_WS_INCLUDES . \'javascript/\');' . "\n" .
                     '//End BTS1.0' . "\n" .
                     '  define(\'DIR_WS_DOWNLOAD_PUBLIC\', \'pub/\');' . "\n" .
                     '  define(\'DIR_FS_DOWNLOAD\', DIR_FS_CATALOG . \'download/\');' . "\n" .
                     '  define(\'DIR_FS_DOWNLOAD_PUBLIC\', DIR_FS_CATALOG . \'pub/\');' . "\n" .
                     '' . "\n" .
                     '  define(\'DIR_FS_FORUM_ROOT\', \'\');' . "\n" .
                     '  define(\'DIR_FS_SITE_ROOT\', \'\');' . "\n" .
                     '  define(\'OSC_COOKIE_NAME\', \'OSCCookie\');' . "\n" .
                     '  define(\'OSC_COOKIE_DOMAIN\', \'' . $http_cookie_domain . '\');' . "\n" .
                     '  define(\'OSC_COOKIE_PATH\', \'/\');' . "\n" .
                     '' . "\n" .
                     '  define(\'SESSION_WRITE_DIRECTORY\', DIR_FS_CATALOG . \'temp/\');' . "\n" .
                     '' . "\n" .
                     '// define our database connection' . "\n" .
                     '  define(\'DB_SERVER\', \'' . $_POST['DB_SERVER'] . '\'); // eg, localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'DB_SERVER_USERNAME\', \'' . $_POST['DB_SERVER_USERNAME'] . '\');' . "\n" .
                     '  define(\'DB_SERVER_PASSWORD\', \'' . $_POST['DB_SERVER_PASSWORD']. '\');' . "\n" .
                     '  define(\'DB_DATABASE\', \'' . $_POST['DB_DATABASE']. '\');' . "\n" .
                     '  define(\'USE_PCONNECT\', \'' . (($_POST['USE_PCONNECT'] == 'true') ? 'true' : 'false') . '\'); // use persistent connections?' . "\n" .
                     '  define(\'DB_CHARACTER_SET\', \'cp1251\');' . "\n" .
                     '  define(\'STORE_SESSIONS\', \'' . (($_POST['STORE_SESSIONS'] == 'files') ? '' : 'mysql') . '\'); // leave empty \'\' for default handler or set to \'mysql\'' . "\n" .
                     '?>';

    $fp = fopen($dir_fs_document_root . 'includes/configure.php', 'w');
    fputs($fp, $file_contents);
    fclose($fp);

    $file_contents = '<?php' . "\n" .
                     '/*' . "\n" .
                     '  osCommerce, Open Source E-Commerce Solutions' . "\n" .
                     '  http://www.oscommerce.com' . "\n" .
                     '' . "\n" .
                     '  Copyright (c) 2003 osCommerce' . "\n" .
                     '' . "\n" .
                     '  Released under the GNU General Public License' . "\n" .
                     '*/' . "\n" .
                     '' . "\n" .
                     '// Define the webserver and path parameters' . "\n" .
                     '// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
                     '// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
                     '  define(\'HTTP_SERVER\', \'' . $http_server . '\'); // eg, http://localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'HTTP_CATALOG_SERVER\', \'' . $http_server . '\');' . "\n" .
                     '  define(\'HTTPS_CATALOG_SERVER\', \'' . $https_server . '\');' . "\n" .
                     '  define(\'ENABLE_SSL_CATALOG\', \'' . $enable_ssl . '\'); // secure webserver for catalog module' . "\n" .
                     '  define(\'DIR_FS_DOCUMENT_ROOT\', \'' . $dir_fs_document_root . '\'); // where the pages are located on the server' . "\n" .
                     '  define(\'DIR_WS_ADMIN\', \'' . $http_catalog . 'admin/\'); // absolute path required' . "\n" .
                     '  define(\'DIR_FS_ADMIN\', \'' . $dir_fs_document_root . 'admin/\'); // absolute pate required' . "\n" .
                     '  define(\'DIR_WS_CATALOG\', \'' . $http_catalog . '\'); // absolute path required' . "\n" .
                     '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root . '\'); // absolute path required' . "\n" .
                     '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                     '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                     '  define(\'DIR_WS_CATALOG_IMAGES\', DIR_WS_CATALOG . \'images/\');' . "\n" .
                     '  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
                     '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                     '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                     '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                     '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                     '  define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');' . "\n" .
                     '  define(\'DIR_WS_LANGUAGES_IMAGES\', \'includes/languages/\');' . "\n" .
                     '  define(\'DIR_WS_CATALOG_LANGUAGES\', DIR_WS_CATALOG . \'includes/languages/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_LANGUAGES\', DIR_FS_CATALOG . \'includes/languages/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_IMAGES\', DIR_FS_CATALOG . \'images/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_MODULES\', DIR_FS_CATALOG . \'includes/modules/\');' . "\n" .
                     '  define(\'DIR_FS_BACKUP\', DIR_FS_ADMIN . \'backups/\');' . "\n" .
                     '' . "\n" .
                     '  define(\'DIR_FS_FORUM_ROOT\', \'\');' . "\n" .
                     '  define(\'DIR_FS_SITE_ROOT\', \'\');' . "\n" .
                     '  define(\'OSC_COOKIE_NAME\', \'OSCCookie\');' . "\n" .
                     '  define(\'OSC_COOKIE_DOMAIN\', \'' . $http_cookie_domain . '\');' . "\n" .
                     '  define(\'OSC_COOKIE_PATH\', \'/\');' . "\n" .
                     '' . "\n" .
                     '  define(\'SESSION_WRITE_DIRECTORY\', DIR_FS_CATALOG . \'temp/\');' . "\n" .
                     '' . "\n" .

                     '// Added for Templating' . "\n" .
  		     '	define(\'DIR_FS_CATALOG_MAINPAGE_MODULES\', DIR_FS_CATALOG_MODULES . \'mainpage_modules/\');' . "\n" .
  		     '	define(\'DIR_WS_TEMPLATES\', DIR_WS_CATALOG . \'templates/\');' . "\n" .
  		     '	define(\'DIR_FS_TEMPLATES\', DIR_FS_CATALOG . \'templates/\');' . "\n" .
                     '' . "\n" .


                     '// define our database connection' . "\n" .
                     '  define(\'DB_SERVER\', \'' . $_POST['DB_SERVER'] . '\'); // eg, localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'DB_SERVER_USERNAME\', \'' . $_POST['DB_SERVER_USERNAME'] . '\');' . "\n" .
                     '  define(\'DB_SERVER_PASSWORD\', \'' . $_POST['DB_SERVER_PASSWORD']. '\');' . "\n" .
                     '  define(\'DB_DATABASE\', \'' . $_POST['DB_DATABASE']. '\');' . "\n" .
                     '  define(\'USE_PCONNECT\', \'' . (($_POST['USE_PCONNECT'] == 'true') ? 'true' : 'false') . '\'); // use persisstent connections?' . "\n" .
                     '  define(\'DB_CHARACTER_SET\', \'cp1251\');' . "\n" .
                     '  define(\'STORE_SESSIONS\', \'' . (($_POST['STORE_SESSIONS'] == 'files') ? '' : 'mysql') . '\'); // leave empty \'\' for default handler or set to \'mysql\'' . "\n" .
                     '?>';





    $fp = fopen($dir_fs_document_root . 'admin/includes/configure.php', 'w');
    fputs($fp, $file_contents);
    fclose($fp);
?>

<table width="95%" border="0" cellpadding="2" class="formPage">
  <tr>
    <td><?php echo TEXT_SUCCESSFUL1_CONFIGURATION; ?></td>
 </tr>
</table>

<p>&nbsp;</p>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="<?php echo $http_server . $http_catalog . 'index.php'; ?>" target="_blank"><img src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/buttons/catalog.gif" border="0" alt="<?php echo IMAGE_BUTTON_CATALOG; ?>"></a></td>
    <td align="center"><a href="<?php echo $http_server . $http_catalog . 'admin/index.php'; ?>" target="_blank"><img src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/buttons/administration_tool.gif" border="0" alt="<?php echo IMAGE_BUTTON_ADMINISTRATION; ?>"></a></td>
  </tr>
</table>

<?php
  }
?>