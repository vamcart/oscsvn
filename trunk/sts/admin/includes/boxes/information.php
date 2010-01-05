<?php
/*
  $Id: information.php,v 1.20 2003/02/07 21:46:49 dgw_ Exp $

  Author: Xander Witteveen (xanderwitteveen@hotmail.com)

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

?>
<!-- information //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('align' => 'left',                               'text'  => BOX_HEADING_INFORMATION,                               'link'  => tep_href_link(FILENAME_INFORMATION, 'selected_box=information')
                              );
  if ($selected_box == 'information' || $menu_dhtml == true) {
    $contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_INFORMATION) . '" class="menuBoxContentLink">' . BOX_INFORMATION . '</a><br>');
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- information_eof //-->
