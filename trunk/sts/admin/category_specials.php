<?php
/*
$Id: category_specials.php,v 1.00 2005/11/08 08:13:00

AddOn to osCommerce, Open Source E-Commerce Solutions
http://www.wtmtechnologies.com

Copyright (c) 2005 WTM Technologies

Released under the GNU General Public License
Pleast contact @ ashish@wtmtechnologies.com for bugs, suggestions, doubts, implementation or anything
*/
require('includes/application_top.php');

require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();

$action = (isset($_GET['action']) ? $_GET['action'] : '');

if (tep_not_null($action))
{
	switch ($action)
	{
		case 'setflag':
			$specials_id = (int)$_GET['id'];
			$flag = (int)$_GET['flag'];
	
			$query = "update ". TABLE_SPECIAL_CATEGORY. " set status = '$flag' where special_id = $specials_id";
			tep_db_query($query);
	
			$specials_query = tep_db_query("select product_id from ". TABLE_SPECIAL_PRODUCT. " where special_id = $specials_id");
			while($specials = tep_db_fetch_array($specials_query))
			{
				$product_id[] = $specials['product_id'];
			}
	
			$product_id = implode(", ", $product_id);
	
			$query = "update ". TABLE_SPECIALS. " set status = '$flag' where products_id in ($product_id)";
			tep_db_query($query);
	
			tep_redirect(tep_href_link(FILENAME_CATEGORY_SPECIALS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'sID=' . $_GET['id'], 'NONSSL'));
			break;
		case 'subsetflag':
			$specials_id = (int)$_GET['id'];
			$flag = (int)$_GET['flag'];
	
			$query = "update ". TABLE_SPECIALS. " set status = '$flag' where specials_id = $specials_id";
			tep_db_query($query);
	
			tep_redirect(tep_href_link(FILENAME_CATEGORY_SPECIALS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'sID=' . $_GET['sID']. '&action=edit', 'NONSSL'));
			break;
		case 'noflag':
			$product_id = (int)$_GET['pid'];
			$special_id = (int)$_GET['sID'];
	
			$query = "select discount, discount_type, expire_date, status from ". TABLE_SPECIAL_CATEGORY. " where special_id = $special_id";
			$special_query = tep_db_query($query);
			$special = tep_db_fetch_array($special_query);
			
			$query = "select products_price from ". TABLE_PRODUCTS. " where products_id = $product_id";
			$product_query = tep_db_query($query);
			$product = tep_db_fetch_array($product_query);

			$specials_price = $special['discount_type'] == "p" ? $product['products_price'] - ($product['products_price'] * $special['discount'] / 100) : $product['products_price'] - $special['discount'];
			$specials_price = sprintf("%0.2f", $specials_price);

			$query = "insert into ". TABLE_SPECIALS. " (products_id, specials_new_products_price, specials_date_added, expires_date, status) 
					values ($product_id, $specials_price, now(), '". $special['expire_date']. "', '". $special['status']. "')";
			tep_db_query($query);
	
			tep_redirect(tep_href_link(FILENAME_CATEGORY_SPECIALS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'sID=' . $_GET['sID']. "&action=edit", 'NONSSL'));
			break;
		case 'insert':
			$categ_id = tep_db_prepare_input($_POST['categ_id']);
			$specials_price = tep_db_prepare_input($_POST['specials_price']);
         $day = tep_db_prepare_input($_POST['expires-dd']);
         $month = tep_db_prepare_input($_POST['expires-mm']);
         $year = tep_db_prepare_input($_POST['expires']);
			$override = tep_db_prepare_input($_POST['override']);
	
			$query = "select special_id from ". TABLE_SPECIAL_CATEGORY. " where categ_id = $categ_id";
			$result = tep_db_query($query);
			if(mysql_num_rows($result) < 1)
			{
				$discount_type = substr($specials_price, -1) == '%' ? "p" : "f";
				$specials_price = sprintf("%0.2f", $specials_price);
	
				$expires_date = '';
				if (tep_not_null($day) && tep_not_null($month) && tep_not_null($year))
				{
					$expires_date = $year;
					$expires_date .= (strlen($month) == 1) ? '0' . $month : $month;
					$expires_date .= (strlen($day) == 1) ? '0' . $day : $day;
				}
	
	
				$query = "insert into ". TABLE_SPECIAL_CATEGORY. " (categ_id, discount, discount_type, special_date_added, special_last_modified, expire_date, date_status_change, status)
							values ($categ_id, $specials_price, '$discount_type', now(), now(), '$expires_date', now(), 1)";
				tep_db_query($query);
	
				$specials_id = mysql_insert_id();
	
				if($override == "y")
				{
					$query = "select A.products_id, A.products_price from ". TABLE_PRODUCTS. " A, ". TABLE_PRODUCTS_TO_CATEGORIES. " C
								where C.categories_id = $categ_id and A.products_id = C.products_id";
					$specials_query = tep_db_query($query);
					while($specials = tep_db_fetch_array($specials_query))
					{
						$product_id = (int)$specials['products_id'];
						$new_price = $discount_type == "p" ? $specials['products_price'] - ($specials['products_price'] * $specials_price / 100) : $specials['products_price'] - $specials_price;
						$new_price = sprintf("%0.2f", $new_price);
	
						$query = "insert into ". TABLE_SPECIAL_PRODUCT. " values (null, $specials_id, $product_id)";
						tep_db_query($query);
	
						$query = "select products_id from ". TABLE_SPECIALS. " where products_id = $product_id";
						$product_query = tep_db_query($query);
						if(mysql_num_rows($product_query) < 1)
						{
							$query = "insert into ". TABLE_SPECIALS. " (products_id, specials_new_products_price, expires_date) values ($product_id, $new_price, '$expires_date')";
							tep_db_query($query);
						}
						else
						{
							tep_db_query("update " . TABLE_SPECIALS . " set specials_new_products_price = '$new_price', specials_last_modified = now(),
											expires_date = '" . tep_db_input($expires_date) . "' where products_id = '" . (int)$product_id . "'");
						}
					}
				}
				else
				{
//					$query = "select A.products_id, B.products_price from ". TABLE_PRODUCTS_TO_CATEGORIES. " A, ". TABLE_PRODUCTS. " B left join ". TABLE_SPECIALS. " C on C.products_id = A.products_id
//								where A.categories_id = $categ_id and B.products_id = A.products_id and C.products_id IS NULL";
					$query = "select A.products_id, B.products_price from (". TABLE_PRODUCTS_TO_CATEGORIES. " A, ". TABLE_PRODUCTS. " B) left join ". TABLE_SPECIALS. " C on C.products_id = A.products_id
								where A.categories_id = $categ_id and B.products_id = A.products_id and C.products_id IS NULL";
						$specials_query = tep_db_query($query);
					while($specials = tep_db_fetch_array($specials_query))
					{
						$product_id = $specials['products_id'];
						$new_price = $discount_type == "p" ? $specials['products_price'] - ($specials['products_price'] * $specials_price / 100) : $specials['products_price'] - $specials_price;
						$new_price = sprintf("%0.2f", $new_price);
	
						$query = "insert into ". TABLE_SPECIAL_PRODUCT. " values (null, $specials_id, $product_id)";
						tep_db_query($query);
	
						$query = "insert into ". TABLE_SPECIALS. " (products_id, specials_new_products_price, expires_date) values ($product_id, $new_price, '$expires_date')";
						tep_db_query($query);
					}
				}
	
				tep_redirect(tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page=' . $_GET['page']));
				break;
			}
			else
			{
				$specials_id = tep_db_fetch_array($result);
				$_POST['specials_id'] = $specials_id['special_id'];
				$action = "update";
			}
		case 'update':
			$specials_id = tep_db_prepare_input($_POST['specials_id']);
			$specials_price = tep_db_prepare_input($_POST['specials_price']);
			$day = tep_db_prepare_input($_POST['day']);
			$month = tep_db_prepare_input($_POST['month']);
			$year = tep_db_prepare_input($_POST['year']);
			$override = tep_db_prepare_input($_POST['override']);
	
			$discount_type = substr($specials_price, -1) == '%' ? "p" : "f";
			$specials_price = sprintf("%0.2f", $specials_price);
	
			$expires_date = '';
			if (tep_not_null($day) && tep_not_null($month) && tep_not_null($year))
			{
				$expires_date = $year;
				$expires_date .= (strlen($month) == 1) ? '0' . $month : $month;
				$expires_date .= (strlen($day) == 1) ? '0' . $day : $day;
			}
	
			tep_db_query("update ". TABLE_SPECIAL_CATEGORY. " set discount = '" . tep_db_input($specials_price) . "', special_last_modified = now(),
							expire_date = '" . tep_db_input($expires_date) . "', discount_type = '$discount_type' 
							where special_id = '" . (int)$specials_id . "'");
	
			$query = "select status from ". TABLE_SPECIAL_CATEGORY. " where special_id = $specials_id";
			$status_query = tep_db_query($query);
			$status = tep_db_fetch_array($status_query);
			$status = $status['status'];
	
			if($override == "y")
			{
				$query = "select A.products_id, A.products_price from ". TABLE_PRODUCTS. " A, ". TABLE_SPECIAL_CATEGORY. " B, ". TABLE_PRODUCTS_TO_CATEGORIES. " C
							where C.categories_id = B.categ_id and B.special_id = $specials_id
							and A.products_id = C.products_id";
				$specials_query = tep_db_query($query);
				while($specials = tep_db_fetch_array($specials_query))
				{
					$product_id = (int)$specials['products_id'];
					$new_price = $discount_type == "p" ? $specials['products_price'] - ($specials['products_price'] * $specials_price / 100) : $specials['products_price'] - $specials_price;
					$new_price = sprintf("%0.2f", $new_price);
	
					$query = "select product_id from ". TABLE_SPECIAL_PRODUCT. " where product_id = $product_id and special_id = $specials_id";
					$product_query = tep_db_query($query);
					if(mysql_num_rows($product_query) < 1)
					{
						$query = "insert into ". TABLE_SPECIAL_PRODUCT. " values (null, $specials_id, $product_id)";
						tep_db_query($query);
	
						$query = "insert into ". TABLE_SPECIALS. " (products_id, specials_new_products_price, expires_date, status) values
									($product_id, $new_price, '$expires_date', '$status')";
						tep_db_query($query);
					}
					else
					{
						tep_db_query("update " . TABLE_SPECIALS . " set specials_new_products_price = '$new_price', specials_last_modified = now(),
										expires_date = '" . tep_db_input($expires_date) . "' where products_id = '" . (int)$product_id . "'");
					}
				}
			}
			else
			{
				$query = "select A.product_id, B.products_price from ". TABLE_SPECIAL_PRODUCT. " A, ". TABLE_PRODUCTS. " B where A.special_id = $specials_id
							and B.products_id = A.product_id";
				$specials_query = tep_db_query($query);
				while($specials = tep_db_fetch_array($specials_query))
				{
					$product_id = $specials['product_id'];
					$new_price = $discount_type == "p" ? $specials['products_price'] - ($specials['products_price'] * $specials_price / 100) : $specials['products_price'] - $specials_price;
					$new_price = sprintf("%0.2f", $new_price);
	
					tep_db_query("update " . TABLE_SPECIALS . " set specials_new_products_price = '$new_price', specials_last_modified = now(),
									expires_date = '" . tep_db_input($expires_date) . "' where products_id = '" . (int)$product_id . "'");
				}
			}
	
			tep_redirect(tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page=' . $_GET['page'] . '&sID=' . $specials_id));
			break;
		case 'deleteconfirm':
			$specials_id = tep_db_prepare_input($_GET['sID']);
			$product_id = array();
			$product_id[] = 0;
	
			$specials_query = tep_db_query("select product_id from ". TABLE_SPECIAL_PRODUCT. " where special_id = $specials_id");
			while($specials = tep_db_fetch_array($specials_query))
			{
				$product_id[] = $specials['product_id'];
			}
	
			$product_id = implode(", ", $product_id);
	
			@tep_db_query("delete from " . TABLE_SPECIALS . " where products_id in ($product_id)");
			tep_db_query("delete from ". TABLE_SPECIAL_CATEGORY. " where special_id = '" . (int)$specials_id . "'");
			tep_db_query("delete from ". TABLE_SPECIAL_PRODUCT. " where special_id = '" . (int)$specials_id . "'");
	
			tep_redirect(tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page=' . $_GET['page']));
			break;
		case 'subcity':
			$act = tep_db_prepare_input($_POST['act']);
			$product_id = tep_db_prepare_input($_POST['product_id']);
			$new_price = tep_db_prepare_input($_POST['new_price']);
			$new_price = sprintf("%0.2f", $new_price);
			$special_id = tep_db_prepare_input($_GET['sID']);

			switch($act)
			{
				case 're-add':
					if($new_price > 0.00)
					{
						$query = "select expire_date, status from ". TABLE_SPECIAL_CATEGORY. " where special_id = $special_id";
						$special_query = tep_db_query($query);
						$special = tep_db_fetch_array($special_query);
		
						$query = "insert into ". TABLE_SPECIALS. " (products_id, specials_new_products_price, specials_date_added, expires_date, status)
							values ($product_id, $new_price, now(), '". $special['expire_date']. "', '". $special['status']. "')";
						tep_db_query($query);
					}	

					tep_redirect(tep_href_link(FILENAME_CATEGORY_SPECIALS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'sID=' . $_GET['sID']. "&action=edit", 'NONSSL'));
					break;
				case 'delete':
					$query = "delete from ". TABLE_SPECIAL_PRODUCT. " where product_id = $product_id and special_id = $special_id";
					tep_db_query($query);
					
					$query = "delete from ". TABLE_SPECIALS. " where products_id = $product_id";
					tep_db_query($query);

					tep_redirect(tep_href_link(FILENAME_CATEGORY_SPECIALS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'sID=' . $_GET['sID']. "&action=edit", 'NONSSL'));
					break;
				case 'update':
					if($new_price > 0.00)
					{
						$query = "update ". TABLE_SPECIALS. " set specials_new_products_price = $new_price, specials_last_modified = now() 
							where products_id = $product_id";
						tep_db_query($query);
					}	

					tep_redirect(tep_href_link(FILENAME_CATEGORY_SPECIALS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'sID=' . $_GET['sID']. "&action=edit", 'NONSSL'));
					break;
				case 'make-special':
					if($new_price > 0.00)
					{
						$query = "insert into ". TABLE_SPECIALS. " (products_id, specials_new_products_price, specials_date_added, expires_date, status)
							values ($product_id, $new_price, now(), '0000-00-00', '1')";
						tep_db_query($query);
					}	
					else 
					{
						$query = "select discount, discount_type, expire_date, status from ". TABLE_SPECIAL_CATEGORY. " where special_id = $special_id";
						$special_query = tep_db_query($query);
						$special = tep_db_fetch_array($special_query);

						$query = "select products_price from ". TABLE_PRODUCTS. " where products_id = $product_id";
						$product_query = tep_db_query($query);
						$product = tep_db_fetch_array($product_query);

						$specials_price = $special['discount_type'] == "p" ? $product['products_price'] - ($product['products_price'] * $special['discount'] / 100) : $product['products_price'] - $special['discount'];
						$specials_price = sprintf("%0.2f", $specials_price);

						$query = "insert into ". TABLE_SPECIALS. " (products_id, specials_new_products_price, specials_date_added, expires_date, status)
								values ($product_id, $specials_price, now(), '". $special['expire_date']. "', '". $special['status']. "')";
						tep_db_query($query);

						$query = "insert into ". TABLE_SPECIAL_PRODUCT. " (special_id, product_id) values ($special_id, $product_id)";
						tep_db_query($query);
					}

					tep_redirect(tep_href_link(FILENAME_CATEGORY_SPECIALS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'sID=' . $_GET['sID']. "&action=edit", 'NONSSL'));
					break;
			}
	}
}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<STYLE type="text/css">
.dataTableRowWTM1 { background-color: #C0DCC0; }
.dataTableRowWTM2 { background-color: #FFFFEF; }
.dataTableRowWTM3 { background-color: #F0F1F1; }
</STYLE>
<script language="javascript" src="includes/general.js"></script>
<?php
if ( ($action == 'new') || ($action == 'edit') )
{
?>
<link rel="stylesheet" type="text/css" href="includes/javascript/calendar.css">
<script language="JavaScript" src="includes/javascript/calendarcode.js"></script>
<?php
}
?>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="SetFocus();">
<div id="popupcalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
if ( ($action == 'new') || ($action == 'edit') )
{
	$form_action = 'insert';
	if ( ($action == 'edit') && isset($_GET['sID']) )
	{
		$form_action = 'update';

		$product_query = tep_db_query("select A.categ_id, B.categories_name, A.discount, A.discount_type, A.expire_date from ". TABLE_SPECIAL_CATEGORY. " A, " .
		TABLE_CATEGORIES_DESCRIPTION . " B where A.categ_id = B.categories_id and B.language_id = '" . (int)$languages_id . "'
					and A.special_id = '" . (int)$_GET['sID'] . "'");
		$product = tep_db_fetch_array($product_query);
		$sInfo = new objectInfo($product);
	}
	else
	{
		$sInfo = new objectInfo(array());

		// create an array of products on special, which will be excluded from the pull down menu of products
		// (when creating a new product on special)
		$specials_array = array();
		$specials_query = tep_db_query("select p.products_id from " . TABLE_PRODUCTS . " p, " . TABLE_SPECIALS . " s where s.products_id = p.products_id");
		while ($specials = tep_db_fetch_array($specials_query))
		{
			$specials_array[] = $specials['products_id'];
		}
	}

	$per =  $sInfo->discount_type == "p" ? "%" : "";
?>
<form name="new_special" <?php echo 'action="' . tep_href_link(FILENAME_CATEGORY_SPECIALS, tep_get_all_get_params(array('action', 'info', 'sID')) . 'action=' . $form_action, 'NONSSL') . '"'; ?> method="post">
      <tr><?php if ($form_action == 'update') echo tep_draw_hidden_field('specials_id', $_GET['sID']); ?>
        <td><br>
          <table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_SPECIALS_CATEGORY; ?>&nbsp;</td>
            <td class="main"><?php echo (isset($sInfo->categories_name)) ? $sInfo->categories_name 
				: tep_draw_pull_down_menu('categ_id', tep_get_category_tree(), $specials_array); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_SPECIALS_SPECIAL_PRICE; ?>&nbsp;</td>
            <td class="main"><?php echo tep_draw_input_field('specials_price', (isset($sInfo->discount) ? ($sInfo->discount . $per) : '')); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_SPECIALS_EXPIRES_DATE; ?>&nbsp;</td>
            <td class="main"><?php echo tep_draw_input_field('day', (isset($sInfo->expire_date) ? substr($sInfo->expire_date, 8, 2) : ''), 'size="2" maxlength="2" class="cal-TextBox"') . tep_draw_input_field('month', (isset($sInfo->expire_date) ? substr($sInfo->expire_date, 5, 2) : ''), 'size="2" maxlength="2" class="cal-TextBox"') . tep_draw_input_field('year', (isset($sInfo->expire_date) ? substr($sInfo->expire_date, 0, 4) : ''), 'size="4" maxlength="4" class="cal-TextBox"'); ?><a class="so-BtnLink" href="javascript:calClick();return false;" onmouseover="calSwapImg('BTN_date', 'img_Date_OVER',true);" onmouseout="calSwapImg('BTN_date', 'img_Date_UP',true);" onclick="calSwapImg('BTN_date', 'img_Date_DOWN');showCalendar('new_special','dteWhen','BTN_date');return false;"><?php echo tep_image(DIR_WS_IMAGES . 'cal_date_up.gif', 'Calendar', '22', '17', 'align="absmiddle" name="BTN_date"'); ?></a></td>
          </tr>
          <tr>
            <td colspan="2" valign="middle" class="main"><?php echo tep_draw_checkbox_field('override', 'y'); ?> &nbsp; <?php echo TEXT_SPECIALS_OVERRIDE; ?></td>
          </tr>
        </table></td>
      </tr>
	
      <tr>
        <td>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><br><?php echo TEXT_SPECIALS_PRICE_TIP; ?></td>
            <td class="main" align="right" valign="top"><br><?php echo (($form_action == 'insert') ? tep_image_submit('button_insert.gif', IMAGE_INSERT) : tep_image_submit('button_update.gif', IMAGE_UPDATE)). '&nbsp;&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page=' . $_GET['page'] . (isset($_GET['sID']) ? '&sID=' . $_GET['sID'] : '')) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
          </tr></TABLE>	  
	  </td>
      </tr>
</form>	
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?
if($action == 'edit')
{
?>
          <tr>
            <td class="main" colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td class="main" colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr class="dataTableHeadingRow">
                        <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
                        <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRODUCTS_PRICE; ?>&nbsp;</td>
                        <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCTS_SPECIAL_PRICE; ?></td>
                        <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
                        <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
                      </tr>
<?php
$categ_id = $sInfo->categ_id;			    
$specials_query_raw = "select A.products_id, B.products_name, A.products_price, C.specials_id, C.specials_new_products_price, 
				C.specials_date_added, C.specials_last_modified, C.expires_date, C.date_status_change, C.status, F.special_id from " . 
				TABLE_PRODUCTS . " A, " . TABLE_PRODUCTS_DESCRIPTION . " B , products_to_categories E 
				left join " . TABLE_SPECIALS . " C on C.products_id = E.products_id left join special_product F on F.product_id = C.products_id
				left join special_category D on E.categories_id = D.categ_id where E.categories_id = $categ_id and E.products_id = A.products_id and 
				A.products_id = B.products_id and B.language_id = '" . (int)$languages_id . "' order by F.special_id, C.specials_id, B.products_name ";
$specials_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $specials_query_raw, $specials_query_numrows);
$specials_query = tep_db_query($specials_query_raw);
while ($specials = tep_db_fetch_array($specials_query))
{
	if($specials['specials_id'] > 0 && $specials['special_id'] > 0)
	{
		echo '                  <tr class="dataTableRowWTM3" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
	}
	else if($specials['specials_id'] > 0 && $specials['special_id'] < 1)
	{
		echo '                  <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
	}
	else if($specials['specials_id'] < 1 && $specials['special_id'] > 0)
	{
		echo '                  <tr class="dataTableRowWTM1" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
	}
	else
	{
		echo '                  <tr class="dataTableRowWTM2" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
	}
	$class = $specials['specials_new_products_price'] != "" ? "oldPrice" : "specialPrice";
	$specials['specials_new_products_price'] = $specials['specials_new_products_price'] != "" ? sprintf("%0.2f", $specials['specials_new_products_price']) : "";
?>
<form action="?sID=<?= $_GET["sID"]; ?>&action=subcity&page=<?= $_GET["page"]; ?>" method="post">
<INPUT type="hidden" name="product_id" value="<?= $specials['products_id']; ?>">
<INPUT type="hidden" name="act">
		<td  class="dataTableContent"><?php echo $specials['products_name']; ?></td>
            <td  class="dataTableContent" align="right"><span class="<?= $class; ?>"><?php echo $currencies->format($specials['products_price']); ?></span>&nbsp;</td>
            <td  class="dataTableContent">&nbsp;<span class="specialPrice">$<INPUT type="text" size="10" name="new_price" value="<?php echo $specials['specials_new_products_price']; ?>"></span></td>
		<td  class="dataTableContent" align="center">
<?
	if($specials['specials_id'] > 0)
	{
		if ($specials['status'] == '1')
		{
			echo tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page='. $_GET["page"]. '&sID='. $_GET["sID"]. '&action=subsetflag&flag=0&id=' . $specials['specials_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
		}
		else
		{
			echo '<a href="' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page='. $_GET["page"]. '&sID='. $_GET["sID"]. '&action=subsetflag&flag=1&id=' . $specials['specials_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
		}
	}
	else if($specials['special_id'] > 0)
	{
			echo '<a href="' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page='. $_GET["page"]. '&sID='. $_GET["sID"]. '&action=noflag&pid=' . $specials['products_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	else
	{
		echo "N/A";
	}
?>
		</td>
                      <td class="dataTableContent" align="right">
<?
if($specials['specials_id'] > 0)
{
?>
			    <INPUT type="button" value="<?= BUTTON_UPDATE; ?>" onClick="this.form.act.value = 'update'; this.form.submit();">&nbsp;&nbsp;<INPUT type="button" value="<?= BUTTON_DELETE; ?>" onClick="this.form.act.value = 'delete'; this.form.submit();">
<?
}
else if($specials['special_id'] > 0 )
{
?>
			    <INPUT type="button" value="<?= BUTTON_RE_ADD; ?>" onClick="this.form.act.value = 're-add'; this.form.submit();">&nbsp;&nbsp;<INPUT type="button" value="<?= BUTTON_DELETE; ?>" onClick="this.form.act.value = 'delete'; this.form.submit();">
<?
}
else
{
?>
			    <INPUT type="button" value="<?= BUTTON_MAKE_SPECIAL; ?>" onClick="this.form.act.value = 'make-special'; this.form.submit();">
<?
}
?>			    
			    
			    </td>
</form>

                    </tr>
                    <?php
}
?>
                    <tr>
                      <td colspan="5"><table border="0" width="100%" cellpadding="0"cellspacing="2">
                        <tr>
                          <td class="smallText" valign="top"><?php echo $specials_split->display_count($specials_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></td>
                          <td class="smallText" align="right"><?php echo $specials_split->display_links($specials_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], "sID=". $_GET["sID"]. "&action=edit"); ?></td>
                        </tr>
                        <?php
          if (empty($action))
          {
?>
                        <tr>
                          <td colspan="2" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&action=new') . '">' . tep_image_button('button_new_product.gif', IMAGE_NEW_PRODUCT) . '</a>'; ?></td>
                        </tr>
                        <?php
          }
?>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
              </td>
          </tr>
<?
}
?>  
        </table></td>
      </tr>
<?php
}
else
{
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CATEGORY; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_SPECIAL_PRODUCT; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_CATEGORY_DISCOUNT; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
$specials_query_raw = "select A.special_id, A.categ_id, A.discount, A.discount_type, A.status, B.categories_name, A.special_date_added, A.special_last_modified, A.expire_date,
					A.date_status_change from ". TABLE_SPECIAL_CATEGORY. " A, " . TABLE_CATEGORIES_DESCRIPTION . " B where A.categ_id = B.categories_id and 
					B.language_id = '" . (int)$languages_id . "' order by B.categories_name";
$specials_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $specials_query_raw, $specials_query_numrows);
$specials_query = tep_db_query($specials_query_raw);
while ($specials = tep_db_fetch_array($specials_query))
{
	if ((!isset($_GET['sID']) || (isset($_GET['sID']) && ($_GET['sID'] == $specials['special_id']))) && !isset($sInfo))
	{
		$products_query = tep_db_query("select categories_image from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$specials['categ_id'] . "'");
		$products = tep_db_fetch_array($products_query);
		$sInfo_array = array_merge($specials, $products);
		$sInfo = new objectInfo($sInfo_array);
	}

	if (isset($sInfo) && is_object($sInfo) && ($specials['special_id'] == $sInfo->special_id))
	{
		echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page=' . $_GET['page'] . '&sID=' . $sInfo->special_id . '&action=edit') . '\'">' . "\n";
	}
	else
	{
		echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page=' . $_GET['page'] . '&sID=' . $specials['special_id']) . '\'">' . "\n";
	}

	$query = "select count(*) as cnt from ". TABLE_SPECIAL_PRODUCT. " where special_id = ". $specials['special_id'];
	$prod_count = tep_db_query($query);
	$prod_count = tep_db_fetch_array($prod_count);
	$special_product = $prod_count['cnt'];


	$query = "select count(A.products_id) as cnt from ". TABLE_PRODUCTS_TO_CATEGORIES. " A, ". TABLE_SPECIAL_CATEGORY. " B where A.categories_id = B.categ_id and B.special_id = ". $specials['special_id'];
	$prod_count = tep_db_query($query);
	$prod_count = tep_db_fetch_array($prod_count);
	$total_product = $prod_count['cnt'];
?>
                <td  class="dataTableContent"><?php echo $specials['categories_name']; ?></td>
                <td  class="dataTableContent" align="center"><?php echo $special_product. " / ". $total_product; ?></td>
                <td  class="dataTableContent" align="right"><span class="specialPrice"><?= $specials['discount_type'] == "f" ? "$" : "%"; ?> <?php echo sprintf("%0.2f", $specials['discount']); ?></span></td>
                <td  class="dataTableContent" align="right">
<?php
if ($specials['status'] == '1')
{
	echo tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'action=setflag&flag=0&id=' . $specials['special_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
}
else
{
	echo '<a href="' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'action=setflag&flag=1&id=' . $specials['special_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
}
?>                </td>
                <td class="dataTableContent" align="right"><?php if (isset($sInfo) && is_object($sInfo) && ($specials['special_id'] == $sInfo->special_id)) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page=' . $_GET['page'] . '&sID=' . $specials['special_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
      </tr>
<?php
}
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellpadding="0"cellspacing="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $specials_split->display_count($specials_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_SPECIAL_CATEGORY); ?></td>
                    <td class="smallText" align="right"><?php echo $specials_split->display_links($specials_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
if (empty($action))
{
?>
                  <tr>
                    <td colspan="2" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page=' . $_GET['page'] . '&action=new') . '">' . tep_image_button('button_new_category.gif', IMAGE_NEW_CATEGORY) . '</a>'; ?>&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&action=new') . '">' . tep_image_button('button_new_product.gif', IMAGE_NEW_PRODUCT) . '</a>'; ?></td>
                  </tr>
<?php
}
?>
                </table></td>
              </tr>
            </table></td>
<?php
$heading = array();
$contents = array();

switch ($action)
{
	case 'delete':
	$heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_SPECIALS . '</b>');

	$contents = array('form' => tep_draw_form('specials', FILENAME_CATEGORY_SPECIALS, 'page=' . $_GET['page'] . '&sID=' . $sInfo->special_id . '&action=deleteconfirm'));
	$contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
	$contents[] = array('text' => '<br><b>' . $sInfo->categories_name . '</b>');
	$contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page=' . $_GET['page'] . '&sID=' . $sInfo->special_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
	break;
	default:
	if (is_object($sInfo))
	{
		$discount_type = $sInfo->discount_type == "p" ? "Percentage" : "Flat Rate Diduction";
		$discount = $sInfo->discount_type == "p" ? sprintf("%0.2f", $sInfo->discount). " %" : $currencies->format($sInfo->discount);

		$heading[] = array('text' => '<b>' . $sInfo->categories_name . '</b>');

		$contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page=' . $_GET['page'] . '&sID=' . $sInfo->special_id . '&action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORY_SPECIALS, 'page=' . $_GET['page'] . '&sID=' . $sInfo->special_id . '&action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
		$contents[] = array('text' => '<br>' . TEXT_INFO_DATE_ADDED . ' ' . tep_date_short($sInfo->special_date_added));
		$contents[] = array('text' => '' . TEXT_INFO_LAST_MODIFIED . ' ' . tep_date_short($sInfo->special_last_modified));
		$contents[] = array('align' => 'center', 'text' => '<br>' . tep_info_image($sInfo->categories_image, $sInfo->categories_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT));
		$contents[] = array('text' => '<br>' . TEXT_INFO_DISCOUNT_TYPE . ' ' . $discount_type);
		$contents[] = array('text' => '' . TEXT_INFO_DISCOUNT . ' ' . $discount);

		$contents[] = array('text' => '<br>' . TEXT_INFO_EXPIRES_DATE . ' <b>' . tep_date_short($sInfo->expire_date) . '</b>');
		$contents[] = array('text' => '' . TEXT_INFO_STATUS_CHANGE . ' ' . tep_date_short($sInfo->date_status_change));
	}
	break;
}
if ( (tep_not_null($heading)) && (tep_not_null($contents)) )
{
	echo '            <td width="25%" valign="top">' . "\n";

	$box = new box;
	echo $box->infoBox($heading, $contents);

	echo '            </td>' . "\n";
}
}
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>