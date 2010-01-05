<?php
/*
  $Id: articles_pxsell.php, v1.0 2006/03/11 12:00:00 Rigadin $

osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com [^]

Copyright (c) 2006 osCommerce

Released under the GNU General Public License
*/

if ($_GET['products_id']) {
$xsell_query = tep_db_query("select distinct ax.articles_id, ad.articles_name, a.articles_last_modified from " . TABLE_ARTICLES_XSELL . " ax LEFT JOIN ".TABLE_ARTICLES." a USING(articles_id) LEFT JOIN " . TABLE_ARTICLES_DESCRIPTION . " ad USING(articles_id) where ax.xsell_id = '" . (int)$_GET['products_id'] . "' and ad.language_id = '" . (int)$languages_id . "' and a.articles_status = '1' order by a.articles_last_modified");
$num_products_xsell = tep_db_num_rows($xsell_query);
if ($num_products_xsell >= MIN_DISPLAY_ARTICLES_XSELL) {
?>
<!-- xsell_articles //-->
<?php
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_PXSELL_ARTICLES);
      new infoBoxHeading($info_box_contents, false, false);

      $row = 0;
      $col = 0;
      $info_box_contents = array();
      while ($xsell = tep_db_fetch_array($xsell_query)) {
        $xsell['products_name'] = tep_get_products_name($xsell['products_id']);
        $info_box_contents[$row][$col] = array('align' => 'left',
                                               'params' => 'class="smallText" width="99%" valign="top"',
                                               'text' => '<a href="'.tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $xsell['articles_id']).'">' . $xsell['articles_name'] . '</a><br />');
        $col ++;
        if ($col > 0) {
          $col = 0;
          $row ++;
        }
      }


     if ($info_box_contents){
 new contentBox($info_box_contents);
}
if (MAIN_TABLE_BORDER == 'yes'){
$info_box_contents = array();
$info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                                'text'  => tep_draw_separator('pixel_trans.gif', '100%', '1')
                              );
  new infoboxFooter($info_box_contents, true, true);
}
?>
<!-- xsell_articles_eof //-->
<?php
    }
  }
?>