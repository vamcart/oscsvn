<?php
if(!defined('DIR_WS_ADMIN')){
	//oscommerce v3
	define('DIR_WS_ADMIN', DIR_WS_HTTP_CATALOG . 'admin/');
	define('DIR_FS_ADMIN', DIR_FS_CATALOG . 'admin/');
}
if(!defined('DIR_FS_ADMIN_INCLUDES')){
    define('DIR_WS_ADMIN_INCLUDES', DIR_WS_ADMIN . 'includes/');
    define('DIR_WS_ADMIN_LANGUAGES', DIR_WS_ADMIN_INCLUDES . 'languages/');
    define('DIR_WS_ADMIN_IMAGES', DIR_WS_ADMIN . 'images/');
    define('DIR_WS_ADMIN_ICONS', DIR_WS_ADMIN_IMAGES . 'icons/');

    define('DIR_FS_ADMIN_IMAGES', DIR_FS_ADMIN . 'images/');
    define('DIR_FS_ADMIN_BACKUP', DIR_FS_ADMIN . 'backups/');
    define('DIR_FS_ADMIN_INCLUDES', DIR_FS_ADMIN . 'includes/');
    define('DIR_FS_ADMIN_BOXES', DIR_FS_ADMIN_INCLUDES . 'boxes/');
    define('DIR_FS_ADMIN_FUNCTIONS', DIR_FS_ADMIN_INCLUDES . 'functions/');
    define('DIR_FS_ADMIN_CLASSES', DIR_FS_ADMIN_INCLUDES . 'classes/');
    define('DIR_FS_ADMIN_MODULES', DIR_FS_ADMIN_INCLUDES . 'modules/');
    define('DIR_FS_ADMIN_LANGUAGES', DIR_FS_ADMIN_INCLUDES . 'languages/');

    //-- CATALOG SUBFOLDERS ----------------------------------------------------------------------------------


    if(!defined('DIR_FS_DOWNLOAD')) define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
    if(!defined('DIR_FS_DOWNLOAD_PUBLIC'))define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');
    define('DIR_FS_IMAGES', DIR_FS_CATALOG . 'images/');
    define('DIR_FS_INCLUDES', DIR_FS_CATALOG . 'includes/');
    define('DIR_FS_BOXES', DIR_FS_INCLUDES . 'boxes/');
    define('DIR_FS_FUNCTIONS', DIR_FS_INCLUDES . 'functions/');
    define('DIR_FS_CLASSES', DIR_FS_INCLUDES . 'classes/');
    define('DIR_FS_MODULES', DIR_FS_INCLUDES . 'modules/');
    define('DIR_FS_LANGUAGES', DIR_FS_INCLUDES . 'languages/');

    if(!defined('DIR_WS_DOWNLOAD_PUBLIC'))define('DIR_WS_DOWNLOAD_PUBLIC', DIR_WS_CATALOG . 'pub/');
    define('DIR_WS_INCLUDES', DIR_WS_CATALOG . 'includes/');
    define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
    if(!defined('DIR_WS_IMAGES'))define('DIR_WS_IMAGES', DIR_WS_CATALOG . 'images/');
    define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
}
?>