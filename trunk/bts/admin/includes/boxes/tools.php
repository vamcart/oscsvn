<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  $cl_box_groups[] = array(
    'heading' => BOX_HEADING_TOOLS,
    'apps' => array(
      array(
        'code' => FILENAME_BACKUP,
        'title' => BOX_TOOLS_BACKUP,
        'link' => tep_href_link(FILENAME_BACKUP)
      ),
      array(
        'code' => FILENAME_BANNER_MANAGER,
        'title' => BOX_TOOLS_BANNER_MANAGER,
        'link' => tep_href_link(FILENAME_BANNER_MANAGER)
      ),
      array(
        'code' => FILENAME_MAIL,
        'title' => BOX_TOOLS_MAIL,
        'link' => tep_href_link(FILENAME_MAIL)
      ),
      array(
        'code' => FILENAME_NEWSLETTERS,
        'title' => BOX_TOOLS_NEWSLETTER_MANAGER,
        'link' => tep_href_link(FILENAME_NEWSLETTERS)
      ),
      array(
        'code' => FILENAME_RECOVER_CART_SALES,
        'title' => BOX_REPORTS_RECOVER_CART_SALES,
        'link' => tep_href_link(FILENAME_RECOVER_CART_SALES)
      ),
      array(
        'code' => FILENAME_EXTRA_FIELDS,
        'title' => BOX_TOOLS_EXTRA_FIELDS_MANAGER,
        'link' => tep_href_link(FILENAME_EXTRA_FIELDS)
      ),
      array(
        'code' => FILENAME_PRODUCTS_EXTRA_FIELDS,
        'title' => BOX_CATALOG_PRODUCTS_EXTRA_FIELDS,
        'link' => tep_href_link(FILENAME_PRODUCTS_EXTRA_FIELDS)
      ),
      array(
        'code' => FILENAME_KEYWORDS,
        'title' => BOX_TOOLS_KEYWORDS,
        'link' => tep_href_link(FILENAME_KEYWORDS)
      ),
      array(
        'code' => FILENAME_EMAIL_QUEUE,
        'title' => BOX_EMAIL_QUEUE,
        'link' => tep_href_link(FILENAME_EMAIL_QUEUE)
      ),
      array(
        'code' => FILENAME_YML_IMPORT,
        'title' => BOX_YML_IMPORT,
        'link' => tep_href_link(FILENAME_YML_IMPORT)
      ),
      array(
        'code' => FILENAME_WHOS_ONLINE,
        'title' => BOX_TOOLS_WHOS_ONLINE,
        'link' => tep_href_link(FILENAME_WHOS_ONLINE)
      )
    )
  );
?>