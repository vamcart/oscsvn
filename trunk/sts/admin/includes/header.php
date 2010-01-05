<?php
/*
  $Id: header.php,v 1.2 2003/09/24 13:57:07 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  if ($messageStack->size > 0) {
    echo $messageStack->output();
  }

?>

<table border="0" width="100%" height="82" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
  <tr>
    <td bgcolor="#ffffff">
    	<?php 
       	echo '<a href="#">' . tep_image(DIR_WS_IMAGES . 'oscommerce.gif') . '</a>'; 
        ?>
    </td>
    </tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td bgcolor="black" height="1" colspan=2></td></tr>
<tr class="headerNavigation" height="25">
    <td  height="25" background="images/back.gif" class="headerBarContent" align="right" valign="middle"><?php echo '&nbsp;&nbsp;<a href="' . tep_catalog_href_link() . '" class="headerLink">' . HEADER_TITLE_ONLINE_CATALOG . '</a> &nbsp;|&nbsp; <a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '" class="headerLink">' . HEADER_TITLE_TOP . '</a> &nbsp;|&nbsp; <a href="' . tep_href_link(FILENAME_LOGOFF, '', 'NONSSL') . '" class="headerLink">' . HEADER_TITLE_LOGOFF . '</a>'; ?>&nbsp;&nbsp;</td>
</tr>
<tr><td bgcolor="black" height="1" colspan="2"></td></tr>
</table>

<?php if (MENU_DHTML == true) require(DIR_WS_INCLUDES . 'header_navigation.php'); ?>