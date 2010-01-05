<?php
/*
  $Id: popup_image.php,v MoPics 6 2003/06/05 23:26:23 Rigadin $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  $products_query = tep_db_query("select pd.products_name, p.products_image, p.products_image_lrg, p.products_image_xl_1, p.products_image_xl_2, p.products_image_xl_3, p.products_image_xl_4, p.products_image_xl_5, p.products_image_xl_6 from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where p.products_status = '1' and p.products_id = '" . (int)$_GET['pID'] . "' and pd.language_id = '" . (int)$languages_id . "'");
  $products = tep_db_fetch_array($products_query);

           if (($_GET['image'] ==0) &&
($products['products_image_lrg'] != '')) {
     $sts->template['popupimage'] = tep_image(DIR_WS_IMAGES .$products['products_image_lrg'],$products['products_name'],'','','name="prodimage"');
     } elseif ($_GET['image'] ==1) {
     $sts->template['popupimage'] = tep_image(DIR_WS_IMAGES .$products['products_image_xl_1'],$products['products_name'],'','','name="prodimage"');
     } elseif ($_GET['image'] ==2) {
     $sts->template['popupimage'] = tep_image(DIR_WS_IMAGES .$products['products_image_xl_2'],$products['products_name'],'','','name="prodimage"');
     } elseif ($_GET['image'] ==3) {
     $sts->template['popupimage'] = tep_image(DIR_WS_IMAGES .$products['products_image_xl_3'],$products['products_name'],'','','name="prodimage"');
     } elseif ($_GET['image'] ==4) {
     $sts->template['popupimage'] = tep_image(DIR_WS_IMAGES .$products['products_image_xl_4'],$products['products_name'],'','','name="prodimage"');
     } elseif ($_GET['image'] ==5) {
     $sts->template['popupimage'] = tep_image(DIR_WS_IMAGES .$products['products_image_xl_5'],$products['products_name'],'','','name="prodimage"');
     } elseif ($_GET['image'] ==6) {
     $sts->template['popupimage'] = tep_image(DIR_WS_IMAGES .$products['products_image_xl_6'],$products['products_name'],'','','name="prodimage"');
     } else
     $sts->template['popupimage'] = tep_image(DIR_WS_IMAGES .$products['products_image'],$products['products_name'],'','','name="prodimage"');
	
	$sts->template['productname'] = $products['products_name'];
	$sts->template['productmodel'] =  $products['products_model'];
	
// Empty placeholders, to be used in case you build something for several product images
  $sts->template['back']=''; // Back button, in case there are several product images
	$sts->template['next']= ''; // Next button
	$sts->template['count']=''; // For the text 1/7 (first picture on seven, ...)
	
?>