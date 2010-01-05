<?php
/*
  $Id: main_page.php,v 1.5 2004/02/16 06:59:37 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2004 osCommerce

  Released under the GNU General Public License
*/

  $template = 'main_page';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>

<head>

<title>osCommerce :// Open Source E-Commerce Solutions</title>

<meta name="ROBOTS" content="NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">

<link rel="stylesheet" type="text/css" href="templates/main_page/stylesheet.css">

<script language="javascript" src="templates/main_page/javascript.js"></script>

</head>

<body text="#000000" bgcolor="#ffffff" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">

<?php require('templates/main_page/header.php'); ?>

<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center">
  <tr>
    <td width="5%" class="leftColumn" valign="top" background="templates/main_page/images/left_column_background.gif"><img src="templates/main_page/images/left_column_top.gif"></td>
    <td width="85%" valign="top"><?php require('templates/pages/' . $page_contents); ?></td>
    <td width="5%" class="rightColumn" valign="top"><img src="templates/main_page/images/right_column_upper_curve.gif" width="47"></td>
  </tr>
</table>

<?php require('templates/main_page/footer.php'); ?>

</body>

</html>
