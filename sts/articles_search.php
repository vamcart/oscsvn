<?php
/*
  $Id: articles_new.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_SEARCH);

 $akeywords = '';
    if (isset($_GET['akeywords'])) {
      $akeywords = $_GET['akeywords'];
    }

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ADVANCED_SEARCH));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, tep_get_all_get_params(), 'NONSSL', true, false));
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
    </table></td>
<!-- body_text //-->
      <tr>
        <td>
<?php
  if ($akeywords == ""){
?>  
	  <tr>
	    <td class="main"><?php echo ERROR_INPUT; ?></td>
	  </tr>
<?php
    } else {		 
	
  if (isset($_GET['description'])) {
    $search_query = tep_db_query("select ad.articles_name, a.articles_id, ad.articles_description from " . TABLE_ARTICLES_DESCRIPTION . " ad inner join " . TABLE_ARTICLES . " a on ad.articles_id = a.articles_id where a.articles_status = '1' and ad.language_id = '" . (int)$languages_id . "' and (ad.articles_name like '%" . $akeywords . "%' or ad.articles_description like '%" . $akeywords . "%' or ad.articles_head_desc_tag like '%" . $akeywords . "%' or ad.articles_head_keywords_tag like '%" . $akeywords . "%' or ad.articles_head_title_tag like '%" . $akeywords . "%') order by ad.articles_name ASC");
  }  else {
    $search_query = tep_db_query("select ad.articles_name, a.articles_id, ad.articles_description from " . TABLE_ARTICLES_DESCRIPTION . " ad inner join " . TABLE_ARTICLES . " a on ad.articles_id = a.articles_id where a.articles_status='1' and ad.language_id = '" . (int)$languages_id . "' and (ad.articles_name like '%" . $akeywords . "%' or ad.articles_head_desc_tag like '%" . $akeywords . "%' or ad.articles_head_keywords_tag like '%" . $akeywords . "%' or ad.articles_head_title_tag like '%" . $akeywords . "%') order by ad.articles_name ASC");
  }    
    $count=0;
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
				  <tr>
	                <td valign="middle" align="center" width="33%"class="productListing-heading"><?php echo TEXT_ARTICLE_NAME; ?></td>
	                <td valign="middle" align="center" class="productListing-heading"><?php echo TEXT_ARTICLE_EXCERPT; ?></td>
	                <td valign="middle" align="center" class="productListing-heading"><?php echo TEXT_ARTICLE_LINK; ?></td>
	              </tr>
      <tr>
        <td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>

<?php		
    while($results = tep_db_fetch_array($search_query)){
	  $article_ex = substr($results['articles_description'], 0, 300);
	  
?>
	               <tr>
	                 <td valign="middle" align="center" valign="top" width="33%"class="main"><a href="<?php echo FILENAME_ARTICLE_INFO; ?>?articles_id=<?php echo $results['articles_id'] ?>"><?php echo $results['articles_name'] ?></a></td>
	                 <td valign="middle" align="center" valign="top" class="main"><?php echo $article_ex; ?> ...</td>
	                 <td valign="middle" align="center" valign="top" class="main"><a href="<?php echo FILENAME_ARTICLE_INFO; ?>?articles_id=<?php echo $results['articles_id'] ?>">Перейти к данной статье</a></td>
		           </tr>

		  
<?php
    $count++;
	} 
	if ($count == 0){
?>	

      <tr>
        <td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
				   <tr>
		            <td class="main" colspan="3" align="center"><?php echo TEXT_NO_ARTICLES ?></td>
		           </tr>
<?php	
	}  
?>
                 </table></td>
			   </tr>
		    </table></td>
		</tr>			 		
<?php
  }
?>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>