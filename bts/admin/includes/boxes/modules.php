<?php
/*
  $Id: modules.php,v 1.2 2003/09/24 13:57:07 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- modules //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_MODULES,
                     'link'  => tep_href_link(FILENAME_MODULES, 'set=payment&selected_box=modules'));

  if ($selected_box == 'modules' || $menu_dhtml == true) {
    $contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_PAYMENT . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_MODULES, 'set=shipping', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_SHIPPING . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_MODULES, 'set=ordertotal', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_ORDER_TOTAL . '</a><br>' . 
                                   '<a href="' . tep_href_link(FILENAME_CIP_MANAGER, 'selected_box=modules', 'NONSSL') . '" class="menuBoxContentLink">' . CIP_TITLE . '</a><br>' . 
                                   '<a href="' . tep_href_link(FILENAME_SHIP2PAY, 'set=ordertotal', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_SHIP2PAY . '</a>');
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- modules_eof //-->
