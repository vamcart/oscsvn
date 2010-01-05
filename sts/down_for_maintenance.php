<?php
/*
  $Id: best_sellers.php,v 1.00 2005/08/12 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License

	Best Sellers v1.0 released by Tornadoburn.com
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . DOWN_FOR_MAINTENANCE_FILENAME);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(DOWN_FOR_MAINTENANCE_FILENAME));
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

    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">

          <tr>
            <td class="main"><?php echo DOWN_FOR_MAINTENANCE_TEXT_INFORMATION; ?></td>
          </tr>
		<?php if (DISPLAY_MAINTENANCE_TIME == 'true') { ?>
          <tr>
            <td class="main"><?php echo TEXT_MAINTENANCE_ON_AT_TIME . TEXT_DATE_TIME; ?></td>
          </tr>
		 <?php
		  } 
		  if (DISPLAY_MAINTENANCE_PERIOD == 'true') { ?>
		  <tr>
            <td class="main"><?php echo TEXT_MAINTENANCE_PERIOD . TEXT_MAINTENANCE_PERIOD_TIME; ?></td>
          </tr>
		  <?php } ?>

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