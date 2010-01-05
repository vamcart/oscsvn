<?php
/*
  $Id: allprods.php,v 1.7 2002/12/02

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  Copyright (c) 2002 HMCservices

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_WISHLIST_PUBLIC);

if(!isset($_GET['public_id'])) {
  	tep_redirect(tep_href_link(FILENAME_DEFAULT));
}

  $public_id = $_GET['public_id'];

/*******************************************************************
****************** QUERY CUSTOMER INFO FROM ID *********************
*******************************************************************/

 	$customer_query = tep_db_query("select customers_firstname from " . TABLE_CUSTOMERS . " where customers_id = '" . $public_id . "'");
	$customer = tep_db_fetch_array($customer_query);

/*******************************************************************
****************** ADD PRODUCT TO SHOPPING CART ********************
*******************************************************************/

  if (isset($_POST['add_wishprod'])) {
	if(isset($_POST['add_prod_x'])) {
		foreach ($_POST['add_wishprod'] as $value) {
			$product_id = tep_get_prid($value);
			$cart->add_cart($product_id, $cart->get_quantity(tep_get_uprid($product_id, $_POST['id'][$value]))+1, $_POST['id'][$value]); 
		}
	tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
	}
  }
  $breadcrumb->add(HEADING_TITLE, tep_href_link(FILENAME_WISHLIST_PUBLIC, '', 'NONSSL'));

  $content = CONTENT_WISHLIST_PUBLIC;

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
