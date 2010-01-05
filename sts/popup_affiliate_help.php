<?php
/*
  $Id: popup_affiliate_help.php,v 1.2 2003/09/24 14:33:16 wilt Exp $

  OSC-Affiliate

  Contribution based on:

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (in_array('remove_current_page',get_class_methods($navigation)) ) $navigation->remove_current_page();

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_POPUP_AFFILIATE_HELP);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_STYLE;?>">
</head>
<style type="text/css"><!--
BODY { margin-bottom: 10px; margin-left: 10px; margin-right: 10px; margin-top: 10px; }
//--></style>
<body marginwidth="10" marginheight="10" topmargin="10" bottommargin="10" leftmargin="10" rightmargin="10">

<?php
  $info_box_contents = array();
    $info_box_contents[] = array('text'  => '<font color="' . $font_color . '">' . HEADING_SUMMARY_HELP . '</font>');

  new infoBoxHeading($info_box_contents, false, false);
  $info_box_contents = array();
    switch ($_GET['action']) {

      case '1':
  $info_box_contents[] = array('align' => 'left',
                               'text'  => TEXT_IMPRESSIONS_HELP);
      break;

      case '2':
  $info_box_contents[] = array('align' => 'left',
                               'text'  => TEXT_VISITS_HELP);
      break;

      case '3':
  $info_box_contents[] = array('align' => 'left',
                               'text'  => TEXT_TRANSACTIONS_HELP);
      break;

      case '4':
  $info_box_contents[] = array('align' => 'left',
                               'text'  => TEXT_CONVERSION_HELP);
      break;

      case '5':
  $info_box_contents[] = array('align' => 'left',
                               'text'  => TEXT_AMOUNT_HELP);
      break;

      case '6':
  $info_box_contents[] = array('align' => 'left',
                               'text'  => TEXT_AVERAGE_HELP);
      break;

      case '7':
  $info_box_contents[] = array('align' => 'left',
                               'text'  => TEXT_COMMISSION_RATE_HELP);
      break;

      case '8':
  $info_box_contents[] = array('align' => 'left',
                               'text'  => TEXT_COMMISSION_HELP);
      break;

    }
  new infoBox($info_box_contents);

?>

<p class="smallText" align="right"><?php echo '<a href="javascript:window.close()">' . TEXT_CLOSE_WINDOW . '</a>'; ?></p>


</body>

</html>