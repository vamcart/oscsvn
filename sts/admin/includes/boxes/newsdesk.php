<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  $cl_box_groups[] = array(
    'heading' => BOX_HEADING_NEWSDESK,
    'apps' => array(
      array(
        'code' => FILENAME_NEWSDESK,
        'title' => BOX_NEWSDESK,
        'link' => tep_href_link(FILENAME_NEWSDESK)
      ),
      array(
        'code' => FILENAME_NEWSDESK_REVIEWS,
        'title' => BOX_NEWSDESK_REVIEWS,
        'link' => tep_href_link(FILENAME_NEWSDESK_REVIEWS)
      )
    )
  );

    $cfg_groups = '';
    $configuration_groups_query = tep_db_query("select configuration_group_id as cgID, configuration_group_key as cgKey, configuration_group_title as cgTitle from " . TABLE_NEWSDESK_CONFIGURATION_GROUP . " where visible = '1' order by sort_order");

  while ($configuration_groups = tep_db_fetch_array($configuration_groups_query)) {
    $cl_box_groups[sizeof($cl_box_groups)-1]['apps'][] = array(
      'code' => FILENAME_NEWSDESK_CONFIGURATION,
      'title' => constant(strtoupper($configuration_groups['cgKey'])),
      'link' => tep_href_link(FILENAME_NEWSDESK_CONFIGURATION, 'gID=' . $configuration_groups['cgID'], 'NONSSL')
    );
  }
?>