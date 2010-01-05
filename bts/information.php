<?php
  /*
  Module: Information Pages Unlimited
  		  File date: 2003/03/03
		  Based on the FAQ script of adgrafics
  		  Adjusted by Joeri Stegeman (joeri210 at yahoo.com), The Netherlands

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
  */

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_INFORMATION);

  $page_info_query = tep_db_query("select p.pages_id, pd.pages_name, pd.pages_description, p.pages_image, p.pages_date_added from " . TABLE_PAGES . " p, " . TABLE_PAGES_DESCRIPTION . " pd where p.pages_status = '1' and p.pages_id = '" . (int)$_GET['pages_id'] . "' and pd.pages_id = p.pages_id and pd.language_id = '" . $languages_id . "'");
    $page_info = tep_db_fetch_array($page_info_query);

  $breadcrumb->add($page_info['pages_name']);
  
  $content = CONTENT_INFORMATION;

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
