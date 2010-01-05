<?php
/*
  $Id: manufacturer_info.php,v 1.1.1.1 2003/09/18 19:05:49 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2001 osCommerce

  Released under the GNU General Public License
*/
 if (isset($_GET['products_id'])){
// BOF manufacturers descriptions
//  $manufacturer_query = tep_db_query("select m.manufacturers_id, m.manufacturers_name, m.manufacturers_image from " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS . " p  where p.products_id = '" . $_GET['products_id'] . "' and p.manufacturers_id = m.manufacturers_id");
  $manufacturer_query = tep_db_query("select m.manufacturers_id, mi.manufacturers_name, m.manufacturers_image from " . TABLE_MANUFACTURERS . " m left join " . TABLE_MANUFACTURERS_INFO . " mi on (m.manufacturers_id=mi.manufacturers_id), " . TABLE_PRODUCTS . " p where p.products_id = '" . $_GET['products_id'] . "' and p.manufacturers_id = m.manufacturers_id and mi.languages_id = '" . (int)$languages_id . "'");
// EOF manufacturers descriptions
  if (tep_db_num_rows($manufacturer_query)) {
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    $manufacturer_url_query = tep_db_query("select manufacturers_url from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . $manufacturer['manufacturers_id'] . "'");
    $manufacturer_url_values = tep_db_fetch_array($manufacturer_url_query);
    $has_manufacturer_url = ($manufacturer_url_values['manufacturers_url']) ? 'true' : 'false';
?>
<!-- manufacturer_info //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
    $info_box_contents[] = array('text'  => BOX_HEADING_MANUFACTURER_INFO);
  new infoBoxHeading($info_box_contents, false, false);

     $manufacturer_info_string = '<div align="center">' . tep_image(DIR_WS_IMAGES . $manufacturer['manufacturers_image'], $manufacturer['manufacturers_name']) . '</div><table border="0" width="80%" cellspacing="0" cellpadding="0">';
    if ($has_manufacturer_url == 'true')
 $manufacturer_info_string .= '<tr><td valign="top" class="smalltext">-&nbsp;</td><td valign="top" class="smalltext"><a href="' . tep_href_link(FILENAME_REDIRECT, 'action=manufacturer&manufacturers_id=' . $manufacturer['manufacturers_id'], 'NONSSL') . '" target="_blank">' . sprintf(BOX_MANUFACTURER_INFO_HOMEPAGE, $manufacturer['manufacturers_name']) . '</a></td></tr>';

    $manufacturer_info_string .= '<tr><td valign="top" class="smalltext">-&nbsp;</td><td valign="top" class="smalltext"><a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturer['manufacturers_id'], 'NONSSL') . '">' . BOX_MANUFACTURER_INFO_OTHER_PRODUCTS . '</a></td></tr></table>';

    $info_box_contents = array();
    $info_box_contents[] = array('align' => 'left',
                                 'text'  => $manufacturer_info_string);
new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- manufacturer_info_eof //-->
<?php
}
?>

<?php
  }
?>