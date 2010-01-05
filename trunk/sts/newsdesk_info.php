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

require('includes/application_top.php');
require('includes/functions/newsdesk_general.php'); 
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_NEWSDESK_INFO);

// set application wide parameters
// this query set is for NewsDesk

$configuration_query = tep_db_query("select configuration_key as cfgKey, configuration_value as cfgValue from " . TABLE_NEWSDESK_CONFIGURATION . "");
while ($configuration = tep_db_fetch_array($configuration_query)) {
	define($configuration['cfgKey'], $configuration['cfgValue']);
}

// lets retrieve all $_GET keys and values..
$get_params = tep_get_all_get_params();
$get_params_back = tep_get_all_get_params(array('reviews_id')); // for back button
$get_params = substr($get_params, 0, -1); //remove trailing &
if ($get_params_back != '') {
    $get_params_back = substr($get_params_back, 0, -1); //remove trailing &
} else {
    $get_params_back = $get_params;
}


if ($_GET['newsPath']) {
   $newsPath = $_GET['newsPath'];
} elseif ($_GET['newsdesk_id'] && !$_GET['manufacturers_id']) {
   $newsPath = newsdesk_get_product_path($_GET['newsdesk_id']);
} else {
   $newsPath = '';
}

if (strlen($newsPath) > 0) {
   $newsPath_array = newsdesk_parse_category_path($newsPath);
   $newsPath = implode('_', $newsPath_array);
   $current_category_id = $newsPath_array[(sizeof($newsPath_array)-1)];
} else {
   $current_category_id = 0;
}
if (isset($newsPath_array)) {
   $n = sizeof($newsPath_array);
   for ($i = 0; $i < $n; $i++) {
      $categories_query = tep_db_query(
      "select categories_name from " . TABLE_NEWSDESK_CATEGORIES_DESCRIPTION . " where categories_id = '" . $newsPath_array[$i]
      . "' and language_id='" . $languages_id . "'"
      );
      if (tep_db_num_rows($categories_query) > 0) {
         $categories = tep_db_fetch_array($categories_query);
         $breadcrumb->add($categories['categories_name'], tep_href_link(FILENAME_NEWSDESK_INDEX, 'newsPath='
         . implode('_', array_slice($newsPath_array, 0, ($i+1)))));
      } else {
         break;
      }
   }
}

if (isset($_GET['newsdesk_id'])){
   $news_query = tep_db_query("select p.newsdesk_id, pd.newsdesk_article_name from " . TABLE_NEWSDESK . " p, " . TABLE_NEWSDESK_DESCRIPTION . " pd where p.newsdesk_id = '" . $_GET['newsdesk_id'] . "' and pd.newsdesk_id = '" . $_GET['newsdesk_id'] . "' and pd.language_id = '" . $languages_id . "'");
   if (tep_db_num_rows($news_query)) {
      $news = tep_db_fetch_array($news_query);
      $breadcrumb->add($news['newsdesk_article_name'], tep_href_link(FILENAME_NEWSDESK_INFO, tep_get_all_get_params(), 'NONSSL'));
   }
}

?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<?php
// BOF: WebMakers.com Changed: Header Tag Controller v1.0
// Replaced by header_tags.php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <title><?php echo TITLE ?></title>
<?php
}
// EOF: WebMakers.com Changed: Header Tag Controller v1.0
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
</table>
		</td>
<!-- body_text //-->
		<td width="100%" valign="top">
<table border="0" width="100%" cellspacing="0" cellpadding="0">

      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="pageHeading"><?php echo TEXT_NEWSDESK_HEADING; ?></td>
		<td class="pageHeading" align="right">
<?php echo tep_image(DIR_WS_IMAGES . '/table_background_account.gif', TEXT_NEWSDESK_HEADING, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
		</td>
	</tr>
<tr>
<form name="quick_find_news" method="get" action="<?php echo tep_href_link(FILENAME_NEWSDESK_SEARCH_RESULT, '', 'NONSSL', false)?>">
<td colspan="2" class="main">
<?php
  $hide = tep_hide_session_id();
?>
<?php echo $hide . TEXT_NEWSDESK_SEARCH ?> 
<input type="text" name="keywords" size="20" maxlength="30" value="<?php echo htmlspecialchars(StripSlashes(@$_GET["keywords"])) ?>" style="width: '<?php echo (BOX_WIDTH-30) ?>'px">
&nbsp;
<?php echo tep_image_submit('button_quick_find.gif', BOX_HEADING_SEARCH) ?>
</td></form>
</tr>        	
</table></td>
      </tr>


<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		<td>
<?php
$product_info = tep_db_query("
select p.newsdesk_id, pd.newsdesk_article_name, pd.newsdesk_article_description, pd.newsdesk_article_shorttext, 
p.newsdesk_image, p.newsdesk_image_two, p.newsdesk_image_three, pd.newsdesk_article_url, pd.newsdesk_article_viewed, p.newsdesk_date_added, 
p.newsdesk_date_available 
from " . TABLE_NEWSDESK . " p, " . TABLE_NEWSDESK_DESCRIPTION . " pd where p.newsdesk_id = '" . $_GET['newsdesk_id'] . "' 
and pd.newsdesk_id = '" . $_GET['newsdesk_id'] . "' and pd.language_id = '" . $languages_id . "'");

if (!tep_db_num_rows($product_info)) { // product not found in database
?>

<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="main"><br><?php echo TEXT_NEWS_NOT_FOUND; ?></td>
	</tr>
	<tr>
		<td align="right">
			<br>
<a href="<?php echo tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'); ?>"><?php echo tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></a>
		</td>
	</tr>
</table>

<?php
} else {
	tep_db_query("update " . TABLE_NEWSDESK_DESCRIPTION . " set newsdesk_article_viewed = newsdesk_article_viewed+1 where newsdesk_id = '" . $_GET['newsdesk_id'] . "' and language_id = '" . $languages_id . "'");
	$product_info_values = tep_db_fetch_array($product_info);

//if ($product_info_values['newsdesk_image'] != 'Array') {
if (($product_info_values['newsdesk_image'] != 'Array') && ($product_info_values['newsdesk_image'] != '')) {
$insert_image = '
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
'. tep_image(DIR_WS_IMAGES . $product_info_values['newsdesk_image'], $product_info_values['newsdesk_question'], '', '', 
'hspace="5" vspace="5"'). '
		</td>
	</tr>
</table>
';
}
//}


//if ($product_info_values['newsdesk_image_two'] != 'Array') {
if (($product_info_values['newsdesk_image_two'] != 'Array') && ($product_info_values['newsdesk_image_two'] != '')) {
$insert_image_two = '
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
'. tep_image(DIR_WS_IMAGES . $product_info_values['newsdesk_image_two'], $product_info_values['newsdesk_question'], '', '', 
'hspace="5" vspace="5"'). '
		</td>
	</tr>
</table>
';
}
//}

//if ($product_info_values['newsdesk_image_three'] != 'Array') {
if (($product_info_values['newsdesk_image_three'] != 'Array') && ($product_info_values['newsdesk_image_three'] != '')) {
$insert_image_three = '
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
'. tep_image(DIR_WS_IMAGES . $product_info_values['newsdesk_image_three'], $product_info_values['newsdesk_question'], '', '', 
'hspace="5" vspace="5"'). '
		</td>
	</tr>
</table>
';
}
//}

?>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		<td width="100%" class="main" valign="top" colspan="2">
<table border="0" width="100%" cellspacing="0" cellpadding="3">
	<tr class="headerNavigation">
		<td class="tableHeading"><?php echo $product_info_values['newsdesk_article_name']; ?></td>
		<td class="subBar" align="right">&nbsp;
			<?php echo sprintf(TEXT_NEWSDESK_DATE, tep_date_long($product_info_values['newsdesk_date_added']));; ?>
		</td>
	</tr>
</table>
		</td>
	</tr>
	<tr>
		<td width="100%" class="main" valign="top">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="main"><?php echo TEXT_NEWSDESK_SUMMARY; ?></td>
	</tr>
	<tr>
		<td class="footer"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
	</tr>
</table>
<?php echo stripslashes($product_info_values['newsdesk_article_shorttext']); ?>

<br>
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="main"><?php echo TEXT_NEWSDESK_CONTENT; ?></td>
	</tr>
	<tr>
		<td class="footer"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
	</tr>
</table>
<?php echo stripslashes($product_info_values['newsdesk_article_description']); ?>

<?php if ($product_info_values['newsdesk_article_url']) { ?>
<br>
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="main"><?php echo TEXT_NEWSDESK_LINK_HEADING; ?></td>
	</tr>
	<tr>
		<td class="footer"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
	</tr>
	<tr>
		<td class="main">
<?php echo sprintf(TEXT_NEWSDESK_LINK, tep_href_link(FILENAME_REDIRECT, 'action=newsurl&goto=' . urlencode($product_info_values['newsdesk_article_url']), 'NONSSL', true, false)); ?>
		</td>
	</tr>
</table>
<?php } ?>

<?php
$reviews = tep_db_query("
select count(*) as count from " . TABLE_NEWSDESK_REVIEWS . " where approved='1' and newsdesk_id = '" 
. $_GET['newsdesk_id'] . "'
");
$reviews_values = tep_db_fetch_array($reviews);
?>
<br>
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="main"><?php echo TEXT_NEWSDESK_REVIEWS_HEADING; ?></td>
	</tr>
	<tr>
		<td class="footer"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
	</tr>
	<tr>
		<td class="main"><?php echo TEXT_NEWSDESK_VIEWED . $product_info_values['newsdesk_article_viewed'] ?></td>
	</tr>
<?php
if ( DISPLAY_NEWSDESK_REVIEWS ) {
?>
	<tr>
		<td class="main"><?php echo TEXT_NEWSDESK_REVIEWS . ' ' . $reviews_values['count']; ?></td>
	</tr>
<?php
}
?>
</table>



		</td>
		<td width="" class="main" valign="top" align="center">
<?php
echo $insert_image;
echo $insert_image_two;
echo $insert_image_three;
?>
		</td>

	</tr>
	<tr>
		<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
	</tr>
</table>

<?php
if ( DISPLAY_NEWSDESK_REVIEWS ) {
	if ($reviews_values['count'] > 0) {
		require FILENAME_NEWSDESK_ARTICLE_REQUIRE;
	}
}
?>
<?php
/*
<table border="0" width="100%" cellspacing="0" cellpadding="2">
	<tr>
		<td class="main">
<?php
echo '<a href="' . tep_href_link(FILENAME_NEWSDESK_INFO, $get_params_back, 'NONSSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>';
?>
		</td>
		<td align="right" class="main">
<?php 
echo '<a href="' . tep_href_link(FILENAME_NEWSDESK_REVIEWS_WRITE, $get_params, 'NONSSL') . '">' . tep_image_button('button_write_review.gif', IMAGE_BUTTON_WRITE_REVIEW) . '</a>';
?>
		</td>
	</tr>
</table>



<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
	</tr>
	<tr>
		<td class="main">
		<a href="<?php echo tep_href_link(FILENAME_NEWSDESK_REVIEWS_ARTICLE, substr(tep_get_all_get_params(), 0, -1)); ?>">
<?php echo tep_image_button('button_reviews.gif', IMAGE_BUTTON_REVIEWS); ?></a>
		</td>
		<td align="right" class="main">
<a href="<?php echo tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'); ?>"><?php echo tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></a>
		</td>
	</tr>
</table>
*/
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
	</tr>
	<tr>
		<td class="main">
<?php 
if ( DISPLAY_NEWSDESK_REVIEWS ) {
	echo '<a href="' . tep_href_link(FILENAME_NEWSDESK_REVIEWS_WRITE, $get_params, 'NONSSL') . '">' . tep_image_button('button_write_review.gif',
	IMAGE_BUTTON_WRITE_REVIEW) . '</a>';
}
?>
		</td>
		<td align="right" class="main">
<a href="<?php echo tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'); ?>"><?php echo tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></a>
		</td>
	</tr>
</table>

<?php } ?>

		</td>
	</tr>
</table>

<!-- body_text_eof //-->
		    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
</table>
		</td>
	</tr>
</table>

<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>