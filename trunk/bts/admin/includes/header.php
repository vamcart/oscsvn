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

<link rel="stylesheet" type="text/css" href="../jscript/jquery/plugins/ui/css/smoothness/jquery-ui-1.8.7.custom.css">
<script type="text/javascript" src="../jscript/jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../jscript/jquery/plugins/ui/jquery-ui-1.8.6.min.js"></script>

<table border="0" width="100%" cellspacing="0" cellpadding="0">

<tr>
<td align="left" colspan="2" width="100%" valign="top">
<br />
    	<?php 
        	echo '<a href="#">' . tep_image(DIR_WS_IMAGES . 'oscommerce.gif') . '</a>'; 
        ?>
<br /><br />        
</td>        
</tr>

<tr>
<td align="left" colspan="2" width="100%" valign="top">

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td bgcolor="black" height="1" colspan=2></td></tr>
<tr class="headerNavigation" height="25">
    <td  height="25" background="images/back.gif" class="headerBarContent" align="right" valign="middle"><?php echo '&nbsp;&nbsp;<a href="' . tep_catalog_href_link() . '" class="headerLink">' . HEADER_TITLE_ONLINE_CATALOG . '</a> &nbsp;|&nbsp; <a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '" class="headerLink">' . HEADER_TITLE_TOP . '</a> &nbsp;|&nbsp; <a href="' . tep_href_link(FILENAME_LOGOFF, '', 'NONSSL') . '" class="headerLink">' . HEADER_TITLE_LOGOFF . '</a>'; ?>&nbsp;&nbsp;
</td>
</tr>
<tr><td bgcolor="black" height="1" colspan="2"></td></tr>
</table>

</td>        
</tr>

</table>

<?php if (MENU_DHTML == true) require(DIR_WS_INCLUDES . 'header_navigation.php'); ?>