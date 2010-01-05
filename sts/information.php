<?php
/*
  $Id: page_info.php,v 1.92 2003/02/14 05:51:21 hpdl Exp $

  -----> page.php is a edited copy of product_info.php.
  If product_info.php code changes in newer releases
  update this file accordingly. <-----

  Author: Xander Witteveen (xanderwitteveen@hotmail.com)

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_INFORMATION);

  $page_info_query = tep_db_query("select p.pages_id, pd.pages_name, pd.pages_description, p.pages_image, p.pages_date_added from " . TABLE_PAGES . " p, " . TABLE_PAGES_DESCRIPTION . " pd where p.pages_status = '1' and p.pages_id = '" . (int)$_GET['pages_id'] . "' and pd.pages_id = p.pages_id and pd.language_id = '" . $languages_id . "'");
    $page_info = tep_db_fetch_array($page_info_query);

  $breadcrumb->add($page_info['pages_name']);

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<?php
// BOF: WebMakers.com Changed: Header Tag Controller v1.0
// Replaced by header_tags.php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <title><?php echo TITLE ?></title>
<?php
}
// EOF: WebMakers.com Changed: Header Tag Controller v1.0
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top">
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <?php

  $page_info_query = tep_db_query("select p.pages_id, pd.pages_name, pd.pages_description, p.pages_image, p.pages_date_added from " . TABLE_PAGES . " p, " . TABLE_PAGES_DESCRIPTION . " pd where p.pages_status = '1' and p.pages_id = '" . (int)$_GET['pages_id'] . "' and pd.pages_id = p.pages_id and pd.language_id = '" . $languages_id . "'");

  if (!tep_db_num_rows($page_info_query)) { // page not found in database
?>
        <tr> 
          <td colspan="2" class="main">
          <br>
            <?php echo TEXT_PAGE_NOT_FOUND; ?>
          <br>
          <br>  
            </td>
        </tr>

        <?php
  } else {
    tep_db_query("update " . TABLE_PAGES_DESCRIPTION . " set pages_viewed = pages_viewed+1 where pages_id = '" . (int)$_GET['pages_id'] . "' and language_id = '" . $languages_id . "'");
    $page_info = tep_db_fetch_array($page_info_query);

?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="pageHeading"><?php echo $page_info['pages_name']; ?></td>
				    <td align="right">&nbsp;</td>
              </tr>
        </table></td>
      </tr>
        <tr>
          <td colspan="2" class="main">
          <?php echo stripslashes($page_info['pages_description']); ?>
        </td>
        <tr>
          <td colspan="2" align="center" class="smallText"><br>
            <?php echo sprintf(TEXT_DATE_ADDED, tep_date_long($page_info['pages_date_added'])); ?></td>
        </tr>
        <tr> 
          <td colspan="2"><br> 
            <?php
    if ( (USE_CACHE == 'true') && !defined('SID')) {
      echo tep_cache_also_purchased(3600);
    }
  }
?>
          </td>
        </tr>

</tr>
      </form></td>
      </table></td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>