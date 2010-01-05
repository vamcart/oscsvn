<!-- faqdesk //-->
<?php


// set application wide parameters
// this query set is for FAQDesk

$configuration_query = tep_db_query("select configuration_key as cfgKey, configuration_value as cfgValue from " . TABLE_FAQDESK_CONFIGURATION . "");
while ($configuration = tep_db_fetch_array($configuration_query)) {
	define($configuration['cfgKey'], $configuration['cfgValue']);
}


$faqdesk_var_query = tep_db_query(
'select p.faqdesk_id, pd.language_id, pd.faqdesk_question, pd.faqdesk_answer_long, pd.faqdesk_answer_short, 
pd.faqdesk_extra_url, p.faqdesk_image, p.faqdesk_image_two, p.faqdesk_image_three, p.faqdesk_date_added, p.faqdesk_last_modified, pd.faqdesk_extra_viewed, 
p.faqdesk_date_available, p.faqdesk_status, p.faqdesk_sticky from ' . TABLE_FAQDESK . ' p, ' . TABLE_FAQDESK_DESCRIPTION . ' 
pd WHERE pd.faqdesk_id = p.faqdesk_id and pd.language_id = "' . $languages_id . '" and faqdesk_status = 1 
and p.faqdesk_sticky = 1 ORDER BY faqdesk_date_added DESC LIMIT ' . MAX_DISPLAY_FAQDESK_FAQS
);


if (!tep_db_num_rows($faqdesk_var_query)) { // there is no news
	echo '<!-- ' . TEXT_NO_FAQDESK_NEWS . ' -->';

} else {

	$row = 0;
	while ($faqdesk_var = tep_db_fetch_array($faqdesk_var_query)) {


if ( STICKY_IMAGE ) {
if ($faqdesk_var['faqdesk_image'] != '') {
$insert_image = '
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
<a href="' . tep_href_link(FILENAME_FAQDESK_INFO, 'faqdesk_id=' . $faqdesk_var['faqdesk_id']) . '">' . tep_image(DIR_WS_IMAGES . 
$faqdesk_var['faqdesk_image'], '', '') . '</a>
		</td>
	</tr>
</table>
';
 }
 }
if ( STICKY_IMAGE_TWO ) {
if ($faqdesk_var['faqdesk_image_two'] != '') {
$insert_image_two = '
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
<a href="' . tep_href_link(FILENAME_FAQDESK_INFO, 'faqdesk_id=' . $faqdesk_var['faqdesk_id']) . '">' . tep_image(DIR_WS_IMAGES . 
$faqdesk_var['faqdesk_image_two'], '', '') . '</a>
		</td>
	</tr>
</table>
';
 }
 }
if ( STICKY_IMAGE_THREE ) {
if ($faqdesk_var['faqdesk_image_three'] != '') {
$insert_image_three = '
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
<a href="' . tep_href_link(FILENAME_FAQDESK_INFO, 'faqdesk_id=' . $faqdesk_var['faqdesk_id']) . '">' . tep_image(DIR_WS_IMAGES . 
$faqdesk_var['faqdesk_image_three'], '', '') . '</a>
		</td>
	</tr>
</table>
';
 }
 }

if ( STICKY_FAQDESK_VIEWCOUNT ) {
$insert_viewcount = TEXT_FAQDESK_VIEWED . $faqdesk_var['faqdesk_extra_viewed'];
}

if ( STICKY_FAQDESK_READMORE ) {
$insert_readmore = '
<tr>
	<td class="smallText">
<a class="smallText" href="' . tep_href_link(FILENAME_FAQDESK_INFO, 'faqdesk_id=' . $faqdesk_var['faqdesk_id']) . '">[' . TEXT_FAQDESK_READMORE . 
']</a>
	</td>
</tr>
';
}

if ( STICKY_SHORT_ANSWER ) {
$insert_summary = '
<tr>
	<td class="smallText">'. $faqdesk_var['faqdesk_answer_short'] . '</td>
</tr>
<tr>
	<td>' . tep_draw_separator('pixel_trans.gif', '100%', '5') . '</td>
</tr>
';
}

if ( STICKY_LONG_ANSWER ) {
$insert_content = '
<tr>
	<td class="smallText">'. $faqdesk_var['faqdesk_answer_long'] . '</td>
</tr>
';
}

if ( STICKY_QUESTION ) {
$insert_headline = '<b>' . $faqdesk_var['faqdesk_question'] . '</b>';
}

if ( STICKY_DATE_ADDED ) {
$insert_date = ' - ' . tep_date_long($faqdesk_var['faqdesk_date_added']);
}

if ( STICKY_EXTRA_URL ) {
$insert_url = '
<tr>
	<td class="smallText">' . $faqdesk_var['faqdesk_extra_url'] . '</td>
</tr>
';
}

echo '
<table border="0" width="100%" cellspacing="3" cellpadding="0">
	<tr>
		<td class="smallText">' . $insert_headline . $insert_date . '</td>
		<td class="smallText" align="right">' . $insert_viewcount . '</td>
	</tr>
	<tr>
		<td class="headerNavigation" colspan="2">' . tep_draw_separator('pixel_trans.gif', '100%', '1') . '</td>
	</tr>
	<tr>
		<td colspan="2">' . tep_draw_separator('pixel_trans.gif', '100%', '5') . '</td>
	</tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="0">
	<tr>
		<td valign="top" width="100%" colspan="2">


<table border="0" width="100%" cellspacing="3" cellpadding="0">
' . $insert_summary . '
' . $insert_content . '
' . $insert_url . '
	<tr>
		<td>' . tep_draw_separator('pixel_trans.gif', '100%', '10') . '</td>
	</tr>
' . $insert_readmore . '
</table>


		</td>
		<td valign="top">
' . $insert_image . '
' . $insert_image_two . '
' . $insert_image_three . '
		</td>
	</tr>
	<tr>
		<td colspan="2">' . tep_draw_separator('pixel_trans.gif', '100%', '5') . '</td>
	</tr>
</table>
';

$row++;

// WE need a better solution for my fudge code below ...
$insert_image = '';
$insert_image_two ='';
$insert_image_three = '';

	}
}

?>
<!-- faqdesk_eof //-->

<?php
/*

	osCommerce, Open Source E-Commerce Solutions ---- http://www.oscommerce.com
	Copyright (c) 2002 osCommerce
	Released under the GNU General Public License

	IMPORTANT NOTE:

	This script is not part of the official osC distribution but an add-on contributed to the osC community.
	Please read the NOTE and INSTALL documents that are provided with this file for further information and installation notes.

	script name:	FaqDesk
	version:		1.2.5
	date:			2003-09-01
	author:			Carsten aka moyashi
	web site:		www..com

*/
?>