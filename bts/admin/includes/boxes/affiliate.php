<?php
/*
  $Id: affiliate.php,v 1.2 2003/09/24 13:57:07 wilt Exp $

  OSC-Affiliate

  Contribution based on:

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- affiliates //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_AFFILIATE,
                     'link'  => tep_href_link(FILENAME_AFFILIATE_SUMMARY, 'selected_box=affiliate'));

  if ($selected_box == 'affiliate' || $menu_dhtml == true) {
    $contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_AFFILIATE_SUMMARY, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_AFFILIATE_SUMMARY . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_AFFILIATE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_AFFILIATE . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_AFFILIATE_PAYMENT, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_AFFILIATE_PAYMENT . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_AFFILIATE_SALES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_AFFILIATE_SALES . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_AFFILIATE_CLICKS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_AFFILIATE_CLICKS . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNER_MANAGER, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_AFFILIATE_BANNERS . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_AFFILIATE_CONTACT, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_AFFILIATE_CONTACT . '</a>');
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- affiliates_eof //-->