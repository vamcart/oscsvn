<?php
/*
  $Id: information.php,v 1.1.1.1 2003/09/18 19:05:51 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2001 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- information //-->
          <tr>
            <td>
<?php


  $info_box_contents = array();
    $info_box_contents[] = array('text'  => '<font color="' . $font_color . '">' . HELP_HEADING . '</font>');
  new infoBoxHeading($info_box_contents, false, false);

  $info_box_contents = array();
  $info_box_contents[] = array('text' => '' . ICQ . '' . '' . HELP . '');


new infoBox($info_box_contents);

$info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                                'text'  => tep_draw_separator('pixel_trans.gif', '100%', '1')
                              );
  new infoboxFooter($info_box_contents, true, true);
?>
            </td>
          </tr>
<!-- information_eof //-->
