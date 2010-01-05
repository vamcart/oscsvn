<?php
/*
  $Id: paypalipn.php,v 1.2 2003/09/24 13:57:07 wilt Exp $
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Paypal IPN v0.981 for Milestone 2
  Copyright (c) 2003 Pablo Pasqualino
  pablo_osc@osmosisdc.com
  http://www.osmosisdc.com

  Released under the GNU General Public License
*/
?>
<!-- paypalipn //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => BOX_HEADING_PAYPALIPN_ADMIN,
                     'link'  => tep_href_link(FILENAME_PAYPALIPN_TRANSACTIONS, 'selected_box=paypalipn'));

  if ($selected_box == 'paypalipn' || $menu_dhtml == true) {
    $contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_PAYPALIPN_TRANSACTIONS) . '?action=view">' . BOX_PAYPALIPN_ADMIN_TRANSACTIONS . '</a><br>');
    $contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_PAYPALIPN_TESTS) . '?action=view">' . BOX_PAYPALIPN_ADMIN_TESTS . '</a><br>');
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- paypalipn_eof //-->