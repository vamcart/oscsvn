<?php
/*
  $Id: options_images_popup.php,v 1.18 2003/08/21

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $navigation->remove_current_page();

  $options_query = tep_db_query("select pov.products_options_values_name, pov.products_options_values_thumbnail from " . TABLE_PRODUCTS_OPTIONS_VALUES . " as pov where pov.products_options_values_id = '" . (int)$_GET['oID'] . "' and pov.language_id = '" . (int)$languages_id . "'");
  $options = tep_db_fetch_array($options_query);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo $options['products_options_values_name']; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<script language="javascript"><!--
var i=0;
function resize() {
  if (navigator.appName == 'Netscape') i=40;
  if (document.images[0]) window.resizeTo(document.images[0].width +30, document.images[0].height+60-i);
  self.focus();
}
//--></script>
</head>
<body onload="resize();">
<?php echo tep_image(DIR_WS_IMAGES . 'options/' . $options['products_options_values_thumbnail'], $options['products_options_values_name']); ?>
</body>
</html>
<?php require('includes/application_bottom.php'); ?>
