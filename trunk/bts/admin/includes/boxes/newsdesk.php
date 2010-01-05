<!-- newsdesk //-->

	<tr>
		<td>

<?php
	$heading = array();
	$contents = array();

$heading[] = array(
	'text'  => BOX_HEADING_NEWSDESK,
	'link'  => tep_href_link(FILENAME_NEWSDESK, 'selected_box=newsdesk')
);

    $cfg_groups = '';
    $configuration_groups_query = tep_db_query("select configuration_group_id as cgID, configuration_group_key as cgKey, configuration_group_title as cgTitle from " . TABLE_NEWSDESK_CONFIGURATION_GROUP . " where visible = '1' order by sort_order");
    while ($configuration_groups = tep_db_fetch_array($configuration_groups_query)) {
      $cfg_groups .= '<a href="' . tep_href_link(FILENAME_NEWSDESK_CONFIGURATION, 'gID=' . $configuration_groups['cgID'], 'NONSSL') . '" class="menuBoxContentLink">' . constant(strtoupper($configuration_groups['cgKey'])) . '</a><br>';
    }

if ($selected_box == 'newsdesk' || $menu_dhtml == true) {
	$contents[] = array('text'  => 
//Admin begin
tep_admin_files_boxes(FILENAME_NEWSDESK, BOX_NEWSDESK) .
tep_admin_files_boxes(FILENAME_NEWSDESK_REVIEWS, BOX_NEWSDESK_REVIEWS) .
$cfg_groups
//tep_admin_files_boxes_newsdesk('', '')
	);
//Admin end
}


	$box = new box;
	echo $box->menuBox($heading, $contents);
?>

		</td>
	</tr>

<!-- newsdesk_eof //-->


<?php 
/*

	osCommerce, Open Source E-Commerce Solutions ---- http://www.oscommerce.com
	Copyright (c) 2002 osCommerce
	Released under the GNU General Public License

	IMPORTANT NOTE:

	This script is not part of the official osC distribution but an add-on contributed to the osC community.
	Please read the NOTE and INSTALL documents that are provided with this file for further information and installation notes.

	script name:	NewsDesk
	version:		1.4.5
	date:			2003-08-31
	author:			Carsten aka moyashi
	web site:		www..com

*/
?>