<?php

require('includes/application_top.php');
require('includes/functions/faqdesk_general.php');

if ($_GET['action']) {
	switch ($_GET['action']) {
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// status call area ... you know the green/red lights
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'setflag':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
	if ($_GET['pID']) {
		faqdesk_set_product_status($_GET['pID'], $_GET['flag']);
	}
	if ($_GET['cID']) {
		faqdesk_set_categories_status($_GET['cID'], $_GET['flag']);
	}

	if (USE_CACHE == 'true') {
		tep_reset_cache_block('categories');
		tep_reset_cache_block('faqdesk');
	}
}

// -----------------------------------------------------------------------
// sticky call area ... you know the green/red lights
// -----------------------------------------------------------------------
case 'setflag_sticky':
// -----------------------------------------------------------------------
if ( ($_GET['flag_sticky'] == '0') || ($_GET['flag_sticky'] == '1') ) {
	if ($_GET['pID']) {
		faqdesk_set_product_sticky($_GET['pID'], $_GET['flag_sticky']);
	}

	if (USE_CACHE == 'true') {
		tep_reset_cache_block('categories');
		tep_reset_cache_block('faqdesk');
	}
}


tep_redirect(tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath')) . 'cPath=' . $_GET['cPath']));
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'insert_category':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'update_category':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
//  double call codes ... all in one mentality ???
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
$categories_id = tep_db_prepare_input($_POST['categories_id']);
$sort_order = tep_db_prepare_input($_POST['sort_order']);

//$sql_data_array = array('sort_order' => $sort_order);
$catagory_status = tep_db_prepare_input($_POST['catagory_status']);
$sql_data_array = array('sort_order' => $sort_order, 'catagory_status' => $catagory_status);

if ($_GET['action'] == 'insert_category') {
	$insert_sql_data = array(
		'parent_id' => $current_category_id,
		'date_added' => 'now()'
	);
	$sql_data_array = array_merge($sql_data_array, $insert_sql_data);
	tep_db_perform(TABLE_FAQDESK_CATEGORIES, $sql_data_array);
	$categories_id = tep_db_insert_id();
} elseif ($_GET['action'] == 'update_category') {
	$update_sql_data = array('last_modified' => 'now()');
	$sql_data_array = array_merge($sql_data_array, $update_sql_data);
	tep_db_perform(TABLE_FAQDESK_CATEGORIES, $sql_data_array, 'update', 'categories_id = \'' . $categories_id . '\'');
}  // top if closing bracket

$languages = tep_get_languages();
$categories_name_array = $_POST['categories_name'];
$categories_description_array = $_POST['categories_description'];
for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
	$language_id = $languages[$i]['id'];
	$sql_data_array = array('categories_name' => tep_db_prepare_input($categories_name_array[$language_id]),
                          'categories_description' => tep_db_prepare_input($categories_description_array[$language_id])
                    );
	if ($_GET['action'] == 'insert_category') {
		$insert_sql_data = array(
			'categories_id' => $categories_id,
			'language_id' => $languages[$i]['id']
		);
		$sql_data_array = array_merge($sql_data_array, $insert_sql_data);
		tep_db_perform(TABLE_FAQDESK_CATEGORIES_DESCRIPTION, $sql_data_array);
	} elseif ($_GET['action'] == 'update_category') {
		tep_db_perform(TABLE_FAQDESK_CATEGORIES_DESCRIPTION, $sql_data_array, 'update', 'categories_id = \'' . $categories_id . '\' and language_id = \'' . $languages[$i]['id'] . '\'');
	}
}

$categories_image = tep_get_uploaded_file('categories_image');
$image_directory = tep_get_local_path(DIR_FS_CATALOG_IMAGES);

if (is_uploaded_file($categories_image['tmp_name'])) {
	tep_db_query("update " . TABLE_FAQDESK_CATEGORIES . " set categories_image = '" . $categories_image['name'] . "' where categories_id = '" . tep_db_input($categories_id) . "'");
	tep_copy_uploaded_file($categories_image, $image_directory);
}

if (USE_CACHE == 'true') {
	tep_reset_cache_block('categories');
	tep_reset_cache_block('also_purchased');
}

tep_redirect(tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath', 'cID')) . 'cPath=' . $cPath . '&cID=' . $categories_id));
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'delete_category_confirm':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
if ($_POST['categories_id']) {
$categories_id = tep_db_prepare_input($_POST['categories_id']);

$categories = faqdesk_get_category_tree($categories_id, '', '0', '', true);
$products = array();
$products_delete = array();

for ($i = 0, $n = sizeof($categories); $i < $n; $i++) {
	$product_ids_query = tep_db_query("select faqdesk_id from " . TABLE_FAQDESK_TO_CATEGORIES . " where categories_id = '" . $categories[$i]['id'] . "'");
	while ($product_ids = tep_db_fetch_array($product_ids_query)) {
		$products[$product_ids['faqdesk_id']]['categories'][] = $categories[$i]['id'];
	}
}

reset($products);
while (list($key, $value) = each($products)) {
	$category_ids = '';
	for ($i = 0, $n = sizeof($value['categories']); $i < $n; $i++) {
		$category_ids .= '\'' . $value['categories'][$i] . '\', ';
	}
	$category_ids = substr($category_ids, 0, -2);

	$check_query = tep_db_query("select count(*) as total from " . TABLE_FAQDESK_TO_CATEGORIES . " where faqdesk_id = '" . $key . "' and categories_id not in (" . $category_ids . ")");
	$check = tep_db_fetch_array($check_query);
	if ($check['total'] < '1') {
		$products_delete[$key] = $key;
	}
}

// Removing categories can be a lengthy process
tep_set_time_limit(0);
for ($i = 0, $n = sizeof($categories); $i < $n; $i++) {
	faqdesk_remove_category($categories[$i]['id']);
}

reset($products_delete);
while (list($key) = each($products_delete)) {
	faqdesk_remove_product($key);
}

}  // main if closing bracket

if (USE_CACHE == 'true') {
	tep_reset_cache_block('categories');
	tep_reset_cache_block('also_purchased');
}

tep_redirect(tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath')) . 'cPath=' . $cPath));
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'delete_product_confirm':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
if ( ($_POST['faqdesk_id']) && (is_array($_POST['product_categories'])) ) {
$product_id = tep_db_prepare_input($_POST['faqdesk_id']);
$product_categories = $_POST['product_categories'];

for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
	tep_db_query("delete from " . TABLE_FAQDESK_TO_CATEGORIES . " where faqdesk_id = '" . tep_db_input($product_id) . "' and categories_id = '" . tep_db_input($product_categories[$i]) . "'");
}

$product_categories_query = tep_db_query("select count(*) as total from " . TABLE_FAQDESK_TO_CATEGORIES . " where faqdesk_id = '" . tep_db_input($product_id) . "'");
$product_categories = tep_db_fetch_array($product_categories_query);

if ($product_categories['total'] == '0') {
	faqdesk_remove_product($product_id);
}

if ($_POST['delete_image'] == 'yes') {
		unlink(DIR_FS_CATALOG_IMAGES . $_POST['products_previous_image']);
}

}  // top if closing bracket

if (USE_CACHE == 'true') {
	tep_reset_cache_block('categories');
	tep_reset_cache_block('also_purchased');
}

tep_redirect(tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath')) . 'cPath=' . $cPath));
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'move_category_confirm':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
if ( ($_POST['categories_id']) && ($_POST['categories_id'] != $_POST['move_to_category_id']) ) {
$categories_id = tep_db_prepare_input($_POST['categories_id']);
$new_parent_id = tep_db_prepare_input($_POST['move_to_category_id']);
tep_db_query("update " . TABLE_FAQDESK_CATEGORIES . " set parent_id = '" . tep_db_input($new_parent_id) . "', last_modified = now() where categories_id = '" . tep_db_input($categories_id) . "'");

if (USE_CACHE == 'true') {
	tep_reset_cache_block('categories');
	tep_reset_cache_block('also_purchased');
}

}  // top if closing bracket

tep_redirect(tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath', 'cID')) . 'cPath=' . $new_parent_id . '&cID=' . $categories_id));
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'move_product_confirm':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
$faqdesk_id = tep_db_prepare_input($_POST['faqdesk_id']);
$new_parent_id = tep_db_prepare_input($_POST['move_to_category_id']);

$duplicate_check_query = tep_db_query("select count(*) as total from " . TABLE_FAQDESK_TO_CATEGORIES . " where faqdesk_id = '" . tep_db_input($faqdesk_id) . "' and categories_id = '" . tep_db_input($new_parent_id) . "'");
$duplicate_check = tep_db_fetch_array($duplicate_check_query);
if ($duplicate_check['total'] < 1) tep_db_query("update " . TABLE_FAQDESK_TO_CATEGORIES . " set categories_id = '" . tep_db_input($new_parent_id) . "' where faqdesk_id = '" . tep_db_input($faqdesk_id) . "' and categories_id = '" . $current_category_id . "'");

if (USE_CACHE == 'true') {
	tep_reset_cache_block('categories');
	tep_reset_cache_block('also_purchased');
}

tep_redirect(tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath', 'pID')) . 'cPath=' . $new_parent_id . '&pID=' . $faqdesk_id));
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'insert_product':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'update_product':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// Another double case situation -- must be an all in one mentality!
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
if ( ($_POST['edit_x']) || ($_POST['edit_y']) ) {
	$_GET['action'] = 'new_product';
} else {

// added by IGONZA
if ($_POST['delete_image'] == 'yes') {unlink(DIR_FS_CATALOG_IMAGES . $_POST['products_previous_image']);}
if ($_POST['delete_image_two'] == 'yes') {unlink(DIR_FS_CATALOG_IMAGES . $_POST['products_previous_image_two']);}
if ($_POST['delete_image_three'] == 'yes') {unlink(DIR_FS_CATALOG_IMAGES . $_POST['products_previous_image_three']);}
// end added by IGONZA

$faqdesk_id = tep_db_prepare_input($_GET['pID']);
$faqdesk_date_available = tep_db_prepare_input($_POST['faqdesk_date_available']);

$faqdesk_date_available = (date('Y-m-d') < $faqdesk_date_available) ? $faqdesk_date_available : 'null';

$sql_data_array = array(
		'faqdesk_image' => (($_POST['faqdesk_image'] == 'none') ? '' : tep_db_prepare_input($_POST['faqdesk_image'])),
		'faqdesk_image_two' => (($_POST['faqdesk_image_two'] == 'none') ? '' : tep_db_prepare_input($_POST['faqdesk_image_two'])),
		'faqdesk_image_three' => (($_POST['faqdesk_image_three'] == 'none') ? '' : tep_db_prepare_input($_POST['faqdesk_image_three'])),
		'faqdesk_date_available' => $faqdesk_date_available,
		'faqdesk_status' => tep_db_prepare_input($_POST['faqdesk_status']),
		'faqdesk_sticky' => tep_db_prepare_input($_POST['faqdesk_sticky']),
	);

// added by IGONZA
if (($_POST['unlink_image'] == 'yes') or ($_POST['delete_image'] == 'yes')) {
      $sql_data_array['faqdesk_image'] = '';
    } else {
     if (isset($_POST['faqdesk_image']) && tep_not_null($_POST['faqdesk_image']) && ($_POST['faqdesk_image'] != 'none')) {
            $sql_data_array['faqdesk_image'] = tep_db_prepare_input($_POST['faqdesk_image']);
          }
		  }
if (($_POST['unlink_image_two'] == 'yes') or ($_POST['delete_image_two'] == 'yes')) {
      $sql_data_array['faqdesk_image_two'] = '';
    } else {
     if (isset($_POST['faqdesk_image_two']) && tep_not_null($_POST['faqdesk_image_two']) && ($_POST['faqdesk_image_two'] != 'none')) {
            $sql_data_array['faqdesk_image_two'] = tep_db_prepare_input($_POST['faqdesk_image_two']);
          }
		  }
if (($_POST['unlink_image_three'] == 'yes') or ($_POST['delete_image_three'] == 'yes')) {
      $sql_data_array['faqdesk_image_three'] = '';
    } else {
     if (isset($_POST['faqdesk_image_three']) && tep_not_null($_POST['faqdesk_image_three']) && ($_POST['faqdesk_image_three'] != 'none')) {
            $sql_data_array['faqdesk_image_three'] = tep_db_prepare_input($_POST['faqdesk_image_three']);
          }
		  }
// end added by IGONZA
if ($_GET['action'] == 'insert_product') {
	$insert_sql_data = array('faqdesk_date_added' => 'now()');
	$sql_data_array = array_merge($sql_data_array, $insert_sql_data);
	tep_db_perform(TABLE_FAQDESK, $sql_data_array);
	$faqdesk_id = tep_db_insert_id();
	tep_db_query("insert into " . TABLE_FAQDESK_TO_CATEGORIES . " (faqdesk_id, categories_id) values ('" . $faqdesk_id . "', '" . $current_category_id . "')");
} elseif ($_GET['action'] == 'update_product') {
	$update_sql_data = array('faqdesk_last_modified' => 'now()');
	$sql_data_array = array_merge($sql_data_array, $update_sql_data);
	tep_db_perform(TABLE_FAQDESK, $sql_data_array, 'update', 'faqdesk_id = \'' . tep_db_input($faqdesk_id) . '\'');
}

$languages = tep_get_languages();
for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
	$language_id = $languages[$i]['id'];

	$sql_data_array = array(
			'faqdesk_question' => tep_db_prepare_input($_POST['faqdesk_question'][$language_id]),
			'faqdesk_answer_long' => tep_db_prepare_input($_POST['faqdesk_answer_long'][$language_id]),
			'faqdesk_answer_short' => tep_db_prepare_input($_POST['faqdesk_answer_short'][$language_id]),
			'faqdesk_extra_url' => tep_db_prepare_input($_POST['faqdesk_extra_url'][$language_id]),
			'faqdesk_image_text' => tep_db_prepare_input($_POST['faqdesk_image_text'][$language_id]),
			'faqdesk_image_text_two' => tep_db_prepare_input($_POST['faqdesk_image_text_two'][$language_id]),
			'faqdesk_image_text_three' => tep_db_prepare_input($_POST['faqdesk_image_text_three'][$language_id]),
		);

	if ($_GET['action'] == 'insert_product') {
		$insert_sql_data = array(
			'faqdesk_id' => $faqdesk_id,
			'language_id' => $language_id
		);
		$sql_data_array = array_merge($sql_data_array, $insert_sql_data);
		tep_db_perform(TABLE_FAQDESK_DESCRIPTION, $sql_data_array);
	} elseif ($_GET['action'] == 'update_product') {
		tep_db_perform(TABLE_FAQDESK_DESCRIPTION, $sql_data_array, 'update', 'faqdesk_id = \'' . tep_db_input($faqdesk_id) . '\' and language_id = \'' . $language_id . '\'');
	}
}

if (USE_CACHE == 'true') {
	tep_reset_cache_block('categories');
	tep_reset_cache_block('also_purchased');
}

tep_redirect(tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath', 'pID')) . 'cPath=' . $cPath . '&pID=' . $faqdesk_id));
}  // midway closing if bracket
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'copy_to_confirm':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
if ( (tep_not_null($_POST['faqdesk_id'])) && (tep_not_null($_POST['categories_id'])) ) {
	$faqdesk_id = tep_db_prepare_input($_POST['faqdesk_id']);
	$categories_id = tep_db_prepare_input($_POST['categories_id']);

if ($_POST['copy_as'] == 'link') {
	if ($_POST['categories_id'] != $current_category_id) {
		$check_query = tep_db_query("select count(*) as total from " . TABLE_FAQDESK_TO_CATEGORIES . " where faqdesk_id = '" . tep_db_input($faqdesk_id) . "' and categories_id = '" . tep_db_input($categories_id) . "'");
		$check = tep_db_fetch_array($check_query);
		if ($check['total'] < '1') {
			tep_db_query("insert into " . TABLE_FAQDESK_TO_CATEGORIES . " (faqdesk_id, categories_id) values ('" . tep_db_input($faqdesk_id) . "', '" . tep_db_input($categories_id) . "')");
		}
		} else {
			$messageStack->add_session(ERROR_CANNOT_LINK_TO_SAME_CATEGORY, 'error');
		}
		} elseif ($_POST['copy_as'] == 'duplicate') {


$product_query = tep_db_query("
select faqdesk_image, faqdesk_image_two, faqdesk_image_three, faqdesk_date_added, faqdesk_date_available, faqdesk_status, faqdesk_sticky 
from " . TABLE_FAQDESK . " where faqdesk_id = '" . tep_db_input($faqdesk_id) . "'
");
$product = tep_db_fetch_array($product_query);

tep_db_query("
insert into " . TABLE_FAQDESK . " (faqdesk_image, faqdesk_image_two, faqdesk_image_three, faqdesk_date_added, faqdesk_date_available, 
faqdesk_status, faqdesk_sticky) values ('" . $product['faqdesk_image'] . "','" . $product['faqdesk_image_two'] . "',
'" . $product['faqdesk_image_three'] . "', '".date('Y-m-d G:i:s')."', '".date('Y-m-d G:i:s')."', 
'" . $product['faqdesk_status'] . "', '" . $product['faqdesk_sticky'] . "')
");
$dup_faqdesk_id = tep_db_insert_id();


$description_query = tep_db_query("
select language_id, faqdesk_question, faqdesk_answer_long, faqdesk_extra_url, faqdesk_image_text, faqdesk_image_text_two, 
faqdesk_image_text_three, faqdesk_extra_viewed, faqdesk_answer_short from " . TABLE_FAQDESK_DESCRIPTION . " where faqdesk_id = '" . 
tep_db_input($faqdesk_id) . "'
");

while ($description = tep_db_fetch_array($description_query)) {
	tep_db_query("insert into " . TABLE_FAQDESK_DESCRIPTION . " (faqdesk_id, language_id, faqdesk_question, 
faqdesk_answer_long, faqdesk_extra_url, faqdesk_image_text, faqdesk_image_text_two, faqdesk_image_text_three, 
faqdesk_extra_viewed, faqdesk_answer_short) values ('" . $dup_faqdesk_id . "', '" . $description['language_id'] . "', '" 
. addslashes($description['faqdesk_question']) . "', '" . addslashes($description['faqdesk_answer_long']) . "', 
'" . $description['faqdesk_extra_url'] . "', '" . $description['faqdesk_image_text'] . "', '" . $description['faqdesk_image_text_two'] . "', 
'" . $description['faqdesk_image_text_three'] . "', '0', 
'" . $description['faqdesk_answer_short'] . "')");
}


			tep_db_query("insert into " . TABLE_FAQDESK_TO_CATEGORIES . " (faqdesk_id, categories_id) values ('" . $dup_faqdesk_id . "', '" . tep_db_input($categories_id) . "')");
			$faqdesk_id = $dup_faqdesk_id;
		}

	if (USE_CACHE == 'true') {
		tep_reset_cache_block('categories');
		tep_reset_cache_block('also_purchased');
	}
}  // top closing if bracket

tep_redirect(tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath', 'pID')) . 'cPath=' . $categories_id . '&pID=' . $faqdesk_id));
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
	} // very top switch closing bracket
}  // very top if closing bracket

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// check if the catalog image directory exists
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
if (is_dir(DIR_FS_CATALOG_IMAGES)) {
	if (!is_writeable(DIR_FS_CATALOG_IMAGES)) $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE, 'error');
	} else {
		$messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
}

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// end of the case scenrio code
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
//
// html head / body / left column code area
//
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<?php
  if (HTML_AREA_WYSIWYG_DISABLE_FAQDESK == 'Enable') { 
?>
<script language="javascript" type="text/javascript" src="includes/javascript/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="includes/javascript/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	editor_deselector : "notinymce",
	theme : "advanced",
	width : 650,
	height : 300,
	language : "<?php echo DEFAULT_LANGUAGE; ?>",
	paste_create_paragraphs : false,
	paste_create_linebreaks : false,
	paste_use_dialog : true,
	convert_urls : false,

	plugins : "safari,typograf,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",

	file_browser_callback : "tinyBrowser",

	spellchecker_languages : "+Russian=ru,English=en",
	spellchecker_rpc_url : "<?php echo HTTP_SERVER . DIR_WS_CATALOG; ?>admin/includes/javascript/tiny_mce/plugins/spellchecker/rpc_proxy.php",

	// Theme options
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,typograf,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true

});
</script>
<?php } ?>
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<?php
  if (ENABLE_TABS == 'true') { 
?>
		<link type="text/css" href="../jscript/jquery/plugins/ui/css/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../jscript/jquery/jquery.js"></script>
		<script type="text/javascript" src="../jscript/jquery/plugins/ui/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$('#tabs').tabs();
			});
		</script>
<?php } ?>
</head>

<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
	<tr>
		<td width="<?php echo BOX_WIDTH; ?>" valign="top">

<table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
</table>

		</td>
<!-- body_text //-->
		<td width="100%" valign="top">

<table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
//  start of main body-text table
//
//  Also in here you'll find the new_product wood work
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
if ($_GET['action'] == 'new_product') {
if ( ($_GET['pID']) && (!$_POST) ) {
$product_query = tep_db_query("
select pd.faqdesk_question, pd.faqdesk_answer_long, pd.faqdesk_answer_short, pd.faqdesk_extra_url, 
pd.faqdesk_image_text, pd.faqdesk_image_text_two, pd.faqdesk_image_text_three, p.faqdesk_id, p.faqdesk_image, p.faqdesk_image_two, 
p.faqdesk_image_three, p.faqdesk_date_added, p.faqdesk_last_modified, date_format(p.faqdesk_date_available, '%Y-%m-%d') 
as faqdesk_date_available, p.faqdesk_status, p.faqdesk_sticky from " 
. TABLE_FAQDESK . " p, " . TABLE_FAQDESK_DESCRIPTION . " pd where p.faqdesk_id = '" 
. $_GET['pID'] . "' and p.faqdesk_id = pd.faqdesk_id and pd.language_id = '" . $languages_id . "'");
$product = tep_db_fetch_array($product_query);

$pInfo = new objectInfo($product);
} elseif ($_POST) {
	$pInfo = new objectInfo($_POST);
	$faqdesk_question = $_POST['faqdesk_question'];
	$faqdesk_answer_long = $_POST['faqdesk_answer_long'];
	$faqdesk_answer_short = $_POST['faqdesk_answer_short'];
	$faqdesk_extra_url = $_POST['faqdesk_extra_url'];
	$faqdesk_image_text = $_POST['faqdesk_image_text'];
	$faqdesk_image_text_two = $_POST['faqdesk_image_text_two'];
	$faqdesk_image_text_three = $_POST['faqdesk_image_text_three'];
	$faqdesk_image = $_POST['faqdesk_image'];
	$faqdesk_image_two = $_POST['faqdesk_image_two'];
	$faqdesk_image_three = $_POST['faqdesk_image_three'];
} else {
	$pInfo = new objectInfo(array());
}

$languages = tep_get_languages();

switch ($pInfo->faqdesk_status) {
	case '0': $in_status = false; $out_status = true; break;
	case '1':
	default: $in_status = true; $out_status = false;
}

switch ($pInfo->faqdesk_sticky) {
	case '0': $sticky_on = false; $sticky_off = true; break;
	case '1': $sticky_on = true; $sticky_off = false; break;
	default: $sticky_on = false; $sticky_off = true;
}




// -------------------------------------------------------------------------------------------------------------------------------------------------------------
?>
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript">
var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "new_product", "faqdesk_date_available","btnDate1","<?php echo $pInfo->faqdesk_date_available; ?>",scBTNMODE_CUSTOMBLUE);
</script>

	<tr>
		<td>
<?php 
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
?>

<?php echo tep_draw_form('new_product', FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath', 'pID')) . 'cPath=' . $cPath . '&pID=' . $_GET['pID'] . '&action=new_product_preview', 'post', 'enctype="multipart/form-data"'); ?>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		<td class="pageHeading"><?php echo sprintf(TEXT_NEW_FAQDESK, faqdesk_output_generated_category_path($current_category_id)); ?></td>
		<td class="pageHeading" align="right">
<?php echo tep_image_submit('button_preview.gif', IMAGE_PREVIEW) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&pID=' . $_GET['pID']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?>
		</td>
	</tr>
</table>

<div id="tabs">

			<ul>
				<li><a href="#data"><?php echo TEXT_FAQDESK_DATA; ?></a></li>
<?php
    for ($l=0; $l<sizeof($languages); $l++) {
?>
				<li><a href="#language_<?php echo $languages[$l]['id']; ?>"><?php echo $languages[$l]['name']; ?></a></li>
<?php
	}
?>
				<li><a href="#images"><?php echo TEXT_FAQDESK_IMAGES; ?></a></li>
			</ul>

        <div id="data">
          <table border="0" width="100%">

<tr>
<td>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_STATUS; ?></td>
	</tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		<td class="main">
<?php echo tep_draw_radio_field('faqdesk_status', '1', $in_status) . '&nbsp;' . TEXT_FAQDESK_AVAILABLE; ?>
<?php echo tep_draw_radio_field('faqdesk_status', '0', $out_status) . '&nbsp;' . TEXT_FAQDESK_NOT_AVAILABLE; ?>
		</td>
	</tr>
</table>


<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_STICKY; ?></td>
	</tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		<td class="main">
<?php echo tep_draw_radio_field('faqdesk_sticky', '1', $sticky_on) . '&nbsp;' . TEXT_FAQDESK_STICKY_ON; ?>
<?php echo tep_draw_radio_field('faqdesk_sticky', '0', $sticky_off) . '&nbsp;' . TEXT_FAQDESK_STICKY_OFF; ?>
		</td>
	</tr>
	<tr>
</table>


<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_DATE_FORMAT; ?>&nbsp;&nbsp;<small>(YYYY-MM-DD)</small></td>
	</tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		<td class="main" width="25%"><?php echo TEXT_FAQDESK_START_DATE; ?></td>
		<td class="main">
<script language="javascript">dateAvailable.writeControl(); dateAvailable.dateFormat="yyyy-MM-dd";</script>
		</td>
	</tr>
</table>

</td>
</tr>

</table>
</div>

<?php
    for ($i=0; $i<sizeof($languages); $i++) {
?>

        <div id="language_<?php echo $languages[$i]['id']; ?>">

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="main" valign="top">


<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_QUESTION; ?></td>
	</tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		<td class="main">
<?php echo tep_draw_input_field('faqdesk_question[' . $languages[$i]['id'] . ']', (($faqdesk_question[$languages[$i]['id']]) ? 
stripslashes($faqdesk_question[$languages[$i]['id']]) : faqdesk_get_faqdesk_question($pInfo->faqdesk_id, $languages[$i]['id'])), 'size="50"'); ?>
		</td>
	</tr>
</table>


<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_ANSWER_SHORT; ?></td>
	</tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		<td class="main">

<?php
echo faqdesk_draw_textarea_field('faqdesk_answer_short_' . $languages[$i]['id'] . '', 'soft', '50', '3', (($faqdesk_answer_short[$languages[$i]['id']]) ? stripslashes($faqdesk_answer_short[$languages[$i]['id']]) : faqdesk_get_faqdesk_answer_short($pInfo->faqdesk_id, $languages[$i]['id'])));
?>

		</td>
	</tr>
</table>


<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_ANSWER_LONG; ?></td>
	</tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		<td class="main">
<?php
echo faqdesk_draw_textarea_field('faqdesk_answer_long_' . $languages[$i]['id'] . '', 'soft', '50', '3', (($faqdesk_answer_long[$languages[$i]['id']]) ? stripslashes($faqdesk_answer_long[$languages[$i]['id']]) : faqdesk_get_faqdesk_answer_long($pInfo->faqdesk_id, $languages[$i]['id'])));
?>

		</td>
	</tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_URL . '&nbsp;&nbsp;<small>' . TEXT_FAQDESK_URL_WITHOUT_HTTP . '</small>'; ?></td>
	</tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		<td class="main">
<?php echo tep_draw_input_field('faqdesk_extra_url[' . $languages[$i]['id'] . ']', (($faqdesk_extra_url[$languages[$i]['id']]) ? stripslashes($faqdesk_extra_url[$languages[$i]['id']]) : faqdesk_get_faqdesk_extra_url($pInfo->faqdesk_id, $languages[$i]['id'])), 'size="45"'); ?>
		</td>
	</tr>
</table>

</table>     
</div>
     
<?php
    }
?>

        <div id="images">
          <table border="0" width="100%">

<tr>		

		<td class="main" valign="top">
		
<table border="0" width="100%" cellspacing="3" cellpadding="3">
        <tr class="headerBar">
                <td class="headerBarContent"><?php echo TEXT_FAQDESK_IMAGE; ?></td>
        </tr>
</table>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr class="main">
                <td valign="top" colspan="2"><?php echo TEXT_FAQDESK_IMAGE_ONE; ?></td>
			<?php // modified by IGONZA  ?>
                <td valign="top" class="main"><?php echo faqdesk_draw_file_field('faqdesk_image', 'size="30"').'<br><input type="checkbox" name="unlink_image" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<br><input type="checkbox" name="delete_image" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '42');?></td>
			<?php // end modified by IGONZA  ?>
                <td class="main">
<?php
echo tep_draw_hidden_field('products_previous_image', $pInfo->faqdesk_image);
echo (($pInfo->faqdesk_image) ? tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->faqdesk_image):TEXT_IMAGE_NONEXISTENT);
?>
                </td>
                <td class="main">
<?php
echo $pInfo->faqdesk_image;
?>
                </td>
        </tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
<?php for ($i = 0, $n = sizeof($languages); $i < $n; $i++) { ?>
        <tr class="main">
                <td>&nbsp;</td>
                <td class="main" colspan="2"><?php echo TEXT_FAQDESK_IMAGE_SUBTITLE; ?></td>
        </tr>
        <tr>
                <td class="main">
<?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
                </td>
                <td class="main">
<?php echo tep_draw_input_field('faqdesk_image_text[' . $languages[$i]['id'] . ']', (($faqdesk_image_text[$languages[$i]['id']]) ?
stripslashes($faqdesk_image_text[$languages[$i]['id']]) : faqdesk_get_faqdesk_image_text($pInfo->faqdesk_id, $languages[$i]['id'])), 'size="50"'); ?>
                </td>
        </tr>
<?php
} //  ........... <<<< .............. end of faqdesk_image_text loop
?>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
        <tr class="headerBar">
                <td class="headerBarContent"><?php echo TEXT_FAQDESK_IMAGE_TWO; ?></td>
        </tr>
</table>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr class="main">
                <td valign="top" colspan="2"><?php echo TEXT_FAQDESK_IMAGE_TWO; ?></td>
		<?php // modified by IGONZA  ?>
                <td valign="top" class="main"><?php echo faqdesk_draw_file_field('faqdesk_image_two', 'size="30"').'<br><input type="checkbox" name="unlink_image_two" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<br><input type="checkbox" name="delete_image_two" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '42');?></td>
		<?php // end modified by IGONZA  ?>
                <td class="main">
<?php
echo tep_draw_hidden_field('products_previous_image_two', $pInfo->faqdesk_image_two);
echo (($pInfo->faqdesk_image_two) ? tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->faqdesk_image_two):TEXT_IMAGE_NONEXISTENT);
?>
                </td>
                <td class="main">
<?php
echo $pInfo->faqdesk_image_two;
?>
                </td>
        </tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
<?php for ($i = 0, $n = sizeof($languages); $i < $n; $i++) { ?>
        <tr class="main">
                <td>&nbsp;</td>
                <td class="main" colspan="2"><?php echo TEXT_FAQDESK_IMAGE_SUBTITLE_TWO; ?></td>
        </tr>
        <tr>
                <td class="main">
<?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
                </td>
                <td class="main">
<?php echo tep_draw_input_field('faqdesk_image_text_two[' . $languages[$i]['id'] . ']', (($faqdesk_image_text_two[$languages[$i]['id']]) ?
stripslashes($faqdesk_image_text_two[$languages[$i]['id']]) : faqdesk_get_faqdesk_image_text_two($pInfo->faqdesk_id, $languages[$i]['id'])), 'size="50"'); ?>
                </td>
        </tr>
<?php
} //  ........... <<<< .............. end of faqdesk_image_text loop
?>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
        <tr class="headerBar">
                <td class="headerBarContent"><?php echo TEXT_FAQDESK_IMAGE_THREE; ?></td>
        </tr>
</table>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr class="main">
                <td valign="top" colspan="2"><?php echo TEXT_FAQDESK_IMAGE_THREE; ?></td>
		<?php // modified by IGONZA  ?>
                <td valign="top" class="main"><?php echo faqdesk_draw_file_field('faqdesk_image_three', 'size="30"').'<br><input type="checkbox" name="unlink_image_three" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<br><input type="checkbox" name="delete_image_three" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '42');?></td>
		<?php // end modified by IGONZA  ?>
                <td class="main">
<?php
echo tep_draw_hidden_field('products_previous_image_three', $pInfo->faqdesk_image_three);
echo (($pInfo->faqdesk_image_three) ? tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->faqdesk_image_three):TEXT_IMAGE_NONEXISTENT);
?>
                </td>
                <td class="main">
<?php
echo $pInfo->faqdesk_image_three;
?>
                </td>
        </tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
<?php for ($i = 0, $n = sizeof($languages); $i < $n; $i++) { ?>
        <tr class="main">
                <td>&nbsp;</td>
                <td class="main" colspan="2"><?php echo TEXT_FAQDESK_IMAGE_SUBTITLE_THREE; ?></td>
        </tr>
        <tr>
                <td class="main">
<?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
                </td>
                <td class="main">
<?php echo tep_draw_input_field('faqdesk_image_text_three[' . $languages[$i]['id'] . ']', (($faqdesk_image_text_three[$languages[$i]['id']]) ?
stripslashes($faqdesk_image_text_three[$languages[$i]['id']]) : faqdesk_get_faqdesk_image_text_three($pInfo->faqdesk_id, $languages[$i]['id'])), 'size="50"'); ?>
                </td>
        </tr>
<?php
} //  ........... <<<< .............. end of faqdesk_image_text loop
?>
</table>


                </td>
        </tr>
</table>

</div>
</div>

</form>

		</td>
	</tr>


<?php
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
} elseif ($_GET['action'] == 'new_product_preview') {
if ($_POST) {
$pInfo = new objectInfo($_POST);
$faqdesk_question = $_POST['faqdesk_question'];
$faqdesk_answer_long = $_POST['faqdesk_answer_long'];
$faqdesk_answer_short = $_POST['faqdesk_answer_short'];


$faqdesk_answer_short[1] = $_POST['faqdesk_answer_short_1'];
$faqdesk_answer_short[2] = $_POST['faqdesk_answer_short_2'];
$faqdesk_answer_short[3] = $_POST['faqdesk_answer_short_3'];
$faqdesk_answer_short[4] = $_POST['faqdesk_answer_short_4'];

$faqdesk_answer_long[1] = $_POST['faqdesk_answer_long_1'];
$faqdesk_answer_long[2] = $_POST['faqdesk_answer_long_2'];
$faqdesk_answer_long[3] = $_POST['faqdesk_answer_long_3'];
$faqdesk_answer_long[4] = $_POST['faqdesk_answer_long_4'];


$faqdesk_extra_url = $_POST['faqdesk_extra_url'];
$faqdesk_image_text = $_POST['faqdesk_image_text'];
$faqdesk_image_text_two = $_POST['faqdesk_image_text_two'];
$faqdesk_image_text_three = $_POST['faqdesk_image_text_three'];

// copy image only if modified
$faqdesk_image = tep_get_uploaded_file('faqdesk_image');
$faqdesk_image_two = tep_get_uploaded_file('faqdesk_image_two');
$faqdesk_image_three = tep_get_uploaded_file('faqdesk_image_three');
$image_directory = tep_get_local_path(DIR_FS_CATALOG_IMAGES);

// BEGIN code by Peter
if ( ($faqdesk_image != 'none') && ($faqdesk_image != '') ) {
	$faqdesk_image = tep_get_uploaded_file('faqdesk_image');
	$image_directory = tep_get_local_path(DIR_FS_CATALOG_IMAGES);
}
if ( ($faqdesk_image_two != 'none') && ($faqdesk_image_two != '') ) {
	$faqdesk_image_two = tep_get_uploaded_file('faqdesk_image_two');
	$image_directory = tep_get_local_path(DIR_FS_CATALOG_IMAGES);
}
if ( ($faqdesk_image_three != 'none') && ($faqdesk_image_three != '') ) {
	$faqdesk_image_three = tep_get_uploaded_file('faqdesk_image_three');
	$image_directory = tep_get_local_path(DIR_FS_CATALOG_IMAGES);
}

if (is_uploaded_file($faqdesk_image['tmp_name'])) {
	tep_copy_uploaded_file($faqdesk_image, $image_directory);
	$faqdesk_image_name = $faqdesk_image['name'];
} else {
	$faqdesk_image_name = $_POST['products_previous_image'];
}

if (is_uploaded_file($faqdesk_image_two['tmp_name'])) {
	tep_copy_uploaded_file($faqdesk_image_two, $image_directory);
	$faqdesk_image_name_two = $faqdesk_image_two['name'];
} else {
	$faqdesk_image_name_two = $_POST['products_previous_image_two'];
}

if (is_uploaded_file($faqdesk_image_three['tmp_name'])) {
	tep_copy_uploaded_file($faqdesk_image_three, $image_directory);
	$faqdesk_image_name_three = $faqdesk_image_three['name'];
} else {
	$faqdesk_image_name_three = $_POST['products_previous_image_three'];
}
// END of Peter's changes

} else {
$product_query = tep_db_query("
select p.faqdesk_id, pd.language_id, pd.faqdesk_question, pd.faqdesk_answer_long, pd.faqdesk_answer_short, 
pd.faqdesk_extra_url, pd.faqdesk_image_text, pd.faqdesk_image_text_two, pd.faqdesk_image_text_three, p.faqdesk_image, 
p.faqdesk_image_two, p.faqdesk_image_three, p.faqdesk_date_added, p.faqdesk_last_modified, 
p.faqdesk_date_available, p.faqdesk_status, p.faqdesk_sticky from " . TABLE_FAQDESK . " p, " . TABLE_FAQDESK_DESCRIPTION . " 
pd where p.faqdesk_id = pd.faqdesk_id and p.faqdesk_id = '" . $_GET['pID'] . "'
");
	$product = tep_db_fetch_array($product_query);

	$pInfo = new objectInfo($product);
	$faqdesk_image_name = $pInfo->faqdesk_image;
	$faqdesk_image_name_two = $pInfo->faqdesk_image_two;
	$faqdesk_image_name_three = $pInfo->faqdesk_image_three;
}

$form_action = ($_GET['pID']) ? 'update_product' : 'insert_product';

echo tep_draw_form($form_action, FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath', 'pID')) . 'cPath=' . $cPath . '&pID=' . $_GET['pID'] . '&action=' . $form_action, 'post');

$languages = tep_get_languages();
for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
if ($_GET['read'] == 'only') {
	$pInfo->faqdesk_question = faqdesk_get_faqdesk_question($pInfo->faqdesk_id, $languages[$i]['id']);
	$pInfo->faqdesk_answer_long = faqdesk_get_faqdesk_answer_long($pInfo->faqdesk_id, $languages[$i]['id']);
	$pInfo->faqdesk_answer_short = faqdesk_get_faqdesk_answer_short($pInfo->faqdesk_id, $languages[$i]['id']);
	$pInfo->faqdesk_extra_url = faqdesk_get_faqdesk_extra_url($pInfo->faqdesk_id, $languages[$i]['id']);
	$pInfo->faqdesk_image_text = faqdesk_get_faqdesk_image_text($pInfo->faqdesk_id, $languages[$i]['id']);
	$pInfo->faqdesk_image_text_two = faqdesk_get_faqdesk_image_text_two($pInfo->faqdesk_id, $languages[$i]['id']);
	$pInfo->faqdesk_image_text_three = faqdesk_get_faqdesk_image_text_three($pInfo->faqdesk_id, $languages[$i]['id']);
} else {
	$pInfo->faqdesk_question = tep_db_prepare_input($faqdesk_question[$languages[$i]['id']]);
	$pInfo->faqdesk_answer_long = tep_db_prepare_input($faqdesk_answer_long[$languages[$i]['id']]);
	$pInfo->faqdesk_answer_short = tep_db_prepare_input($faqdesk_answer_short[$languages[$i]['id']]);
	$pInfo->faqdesk_extra_url = tep_db_prepare_input($faqdesk_extra_url[$languages[$i]['id']]);
	$pInfo->faqdesk_image_text = tep_db_prepare_input($faqdesk_image_text[$languages[$i]['id']]);
	$pInfo->faqdesk_image_text_two = tep_db_prepare_input($faqdesk_image_text_two[$languages[$i]['id']]);
	$pInfo->faqdesk_image_text_three = tep_db_prepare_input($faqdesk_image_text_three[$languages[$i]['id']]);
}
?>

	<tr>
		<td>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr>
		<td>

<table border="0" width="100%" cellspacing="0" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent" width="5%">
<?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
		</td>
		<td class="headerBarContent"><?php echo $pInfo->faqdesk_question; ?></td>
	</tr>
</table>

		</td>
	</tr>
	<tr>
		<td valign="top">

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_ANSWER_SHORT; ?></td>
	</tr>
	<tr>
		<td class="main">
<?php echo $pInfo->faqdesk_answer_short; ?>
		</td>
	</tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_ANSWER_LONG; ?></td>
	</tr>
	<tr>
		<td class="main">
<?php echo $pInfo->faqdesk_answer_long; ?>
		</td>
	</tr>
</table>


		</td>
		
</tr>
<tr>		
		<td valign="top">


<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_IMAGE_PREVIEW_ONE; ?></td>
	</tr>
        <tr>
                <td class="main">
<?php
// BEGIN >> code change by Peter & IGONZA
if (($_POST['unlink_image'] != 'yes') and ($_POST['delete_image'] != 'yes')) {
echo (($faqdesk_image_name) ? tep_image(DIR_WS_CATALOG_IMAGES . $faqdesk_image_name, $pInfo->faqdesk_question, '', '',
'align="right" hspace="5" vspace="5"') : '') .'';
}
// END >> code change by Peter & IGONZA
?>
                </td>
        </tr>
        <tr>
                <td><?php echo $pInfo->faqdesk_image_text; ?></td>
        </tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_IMAGE_PREVIEW_TWO; ?></td>
	</tr>
        <tr>
                <td class="main">
<?php
// BEGIN >> code change by Peter & IGONZA
if (($_POST['unlink_image_two'] != 'yes') and ($_POST['delete_image_two'] != 'yes')) {
echo (($faqdesk_image_name_two) ? tep_image(DIR_WS_CATALOG_IMAGES . $faqdesk_image_name_two, $pInfo->faqdesk_question, '', '',
'align="right" hspace="5" vspace="5"') : '') .'';
}
// END >> code change by Peter & IGONZA
?>
                </td>
        </tr>
        <tr>
                <td><?php echo $pInfo->faqdesk_image_text_two; ?></td>
        </tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_IMAGE_PREVIEW_THREE; ?></td>
	</tr>
        <tr>
                <td class="main">
<?php
// BEGIN >> code change by Peter & IGONZA
if (($_POST['unlink_image_three'] != 'yes') and ($_POST['delete_image_three'] != 'yes')) {
echo (($faqdesk_image_name_three) ? tep_image(DIR_WS_CATALOG_IMAGES . $faqdesk_image_name_three, $pInfo->faqdesk_question, '', '',
'align="right" hspace="5" vspace="5"') : '') .'';
}
// END >> code change by Peter & IGONZA
?>
                </td>
        </tr>
        <tr>
                <td><?php echo $pInfo->faqdesk_image_text_three; ?></td>
        </tr>
</table>

<?php if ($pInfo->faqdesk_extra_url) { ?>
<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_ADDED_LINK_HEADER; ?></td>
	</tr>
	<tr>
		<td class="main">
<?php echo sprintf($pInfo->faqdesk_extra_url); ?>
		</td>
	</tr>
</table>
<?php
} // --------->>>>>>>> end of loop control for checking url
?>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_DATE_ADDED; ?></td>
	</tr>
	<tr>
		<td class="main"><?php echo sprintf(tep_date_long($pInfo->faqdesk_date_added)); ?></td>
	</tr>
	<tr>
</table>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
	<tr class="headerBar">
		<td class="headerBarContent"><?php echo TEXT_FAQDESK_DATE_AVAILABLE; ?></td>
	</tr>
	<tr>
		<td class="main"><?php echo sprintf(tep_date_long($pInfo->faqdesk_date_available)); ?></td>
	</tr>
	<tr>
</table>


		</td>
	</tr>
</table>


<?php } // --------->>>>>>>> break time to run some code checks


if ($_GET['read'] == 'only') {
if ($_GET['origin']) {
	$pos_params = strpos($_GET['origin'], '?', 0);
	if ($pos_params != false) {
		$back_url = substr($_GET['origin'], 0, $pos_params);
		$back_url_params = substr($_GET['origin'], $pos_params + 1);
	} else {
		$back_url = $_GET['origin'];
		$back_url_params = '';
	}
	} else {
		$back_url = FILENAME_FAQDESK;
		$back_url_params = 'cPath=' . $cPath . '&pID=' . $pInfo->faqdesk_id;
	}
?>

	<tr>
		<td align="right">
<?php echo '<a href="' . tep_href_link($back_url, $back_url_params, 'NONSSL') . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?>
		</td>
	</tr>

<?php
} else {  // --------->>>>>>>> were do we go from here
?>


	<tr>
		<td align="right" class="smallText">


<?php
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// Re-Post all POST'ed variables
// main table area that shows the catagories, the left box, and the counts at the bottom of the catagory area
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
reset($_POST);
while (list($key, $value) = each($_POST)) {
	if (!is_array($_POST[$key])) {
		echo tep_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
	}
}

$languages = tep_get_languages();
for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
	echo tep_draw_hidden_field('faqdesk_question[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($faqdesk_question[$languages[$i]['id']])));
	echo tep_draw_hidden_field('faqdesk_answer_long[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($faqdesk_answer_long[$languages[$i]['id']])));
	echo tep_draw_hidden_field('faqdesk_answer_short[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($faqdesk_answer_short[$languages[$i]['id']])));
	echo tep_draw_hidden_field('faqdesk_extra_url[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($faqdesk_extra_url[$languages[$i]['id']])));
	echo tep_draw_hidden_field('faqdesk_image_text[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($faqdesk_image_text[$languages[$i]['id']])));
	echo tep_draw_hidden_field('faqdesk_image_text_two[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($faqdesk_image_text_two[$languages[$i]['id']])));
	echo tep_draw_hidden_field('faqdesk_image_text_three[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($faqdesk_image_text_three[$languages[$i]['id']])));
}

echo tep_draw_hidden_field('faqdesk_image', stripslashes($faqdesk_image_name));
echo tep_draw_hidden_field('faqdesk_image_two', stripslashes($faqdesk_image_name_two));
echo tep_draw_hidden_field('faqdesk_image_three', stripslashes($faqdesk_image_name_three));

echo tep_image_submit('button_back.gif', IMAGE_BACK, 'name="edit"') . '&nbsp;&nbsp;';

if ($_GET['pID']) {
	echo tep_image_submit('button_update.gif', IMAGE_UPDATE);
} else {
	echo tep_image_submit('button_insert.gif', IMAGE_INSERT);
}

echo '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&pID=' . $_GET['pID']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>';
?>

		</td>
</form>
	</tr>

<?php
}
} else {
?>

	<tr>
		<td>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
		<td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
		<td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
<?php echo tep_draw_form('search', FILENAME_FAQDESK, '', 'get'); ?>
	<td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search', $_GET['search']); ?></td>
</form>
	</tr>
	<tr>
<?php echo tep_draw_form('goto', FILENAME_FAQDESK, '', 'get'); ?>
		<td class="smallText" align="right">
<?php echo HEADING_TITLE_GOTO . ' ' . tep_draw_pull_down_menu('cPath', faqdesk_get_category_tree(), $current_category_id, 'onChange="this.form.submit();"'); ?>
		</td>
</form>
	</tr>
</table>
		</td>
	</tr>
</table>
		</td>
	</tr>
	<tr>
		<td>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">
<table border="0" width="100%" cellspacing="0" cellpadding="2">
	<tr class="dataTableHeadingRow">
		<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CATEGORIES_FAQDESK; ?></td>
		<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>

		<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STICKY; ?></td>

		<td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
	</tr>

<?php
$categories_count = 0;
$rows = 0;

if ($_GET['search']) {
/*
	$categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_FAQDESK_CATEGORIES . " c, " . TABLE_FAQDESK_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . $languages_id . "' and cd.categories_name like '%" . $_GET['search'] . "%' order by c.sort_order, cd.categories_name");
} else {
	$categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_FAQDESK_CATEGORIES . " c, " . TABLE_FAQDESK_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . $current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . $languages_id . "' order by c.sort_order, cd.categories_name");
*/

	$categories_query = tep_db_query("select c.categories_id, cd.categories_name, cd.categories_description, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.catagory_status from " . TABLE_FAQDESK_CATEGORIES . " c, " . TABLE_FAQDESK_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . $languages_id . "' and cd.categories_name like '%" . $_GET['search'] . "%' order by c.sort_order, cd.categories_name");
} else {
	$categories_query = tep_db_query("select c.categories_id, cd.categories_name, cd.categories_description, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.catagory_status from " . TABLE_FAQDESK_CATEGORIES . " c, " . TABLE_FAQDESK_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . $current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . $languages_id . "' order by c.sort_order, cd.categories_name");}



while ($categories = tep_db_fetch_array($categories_query)) {
	$categories_count++;
	$rows++;
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// Get parent_id for subcategories if search 
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
if ($_GET['search']) $cPath= $categories['parent_id'];

if ( ((!$_GET['cID']) && (!$_GET['pID']) || (@$_GET['cID'] == $categories['categories_id'])) && (!$cInfo) && (substr($_GET['action'], 0, 4) != 'new_') ) {
	$category_childs = array('childs_count' => faqdesk_childs_in_category_count($categories['categories_id']));
	$category_products = array('products_count' => faqdesk_products_in_category_count($categories['categories_id']));

	$cInfo_array = array_merge($categories, $category_childs, $category_products);
	$cInfo = new objectInfo($cInfo_array);
}

if ( (is_object($cInfo)) && ($categories['categories_id'] == $cInfo->categories_id) ) {
	echo '<tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_FAQDESK, faqdesk_get_path($categories['categories_id'])) . '\'">' . "\n";
} else {
	echo '<tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('cID', 'action', 'cPath')) . 'cPath=' . $cPath . '&cID=' . $categories['categories_id']) . '\'">' . "\n";
}

?>

		<td class="dataTableContent">
<?php
echo '<a href="' . tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('cID', 'action', 'cPath')) . faqdesk_get_path($categories['categories_id'])) . '">' 
. tep_image(DIR_WS_ICONS . 'folder.gif', ICON_FOLDER) . '</a>&nbsp;<b>' . $categories['categories_name'] . '</b>';
?>
	</td>
		<td class="dataTableContent" align="center">

<?php
if ($categories['catagory_status'] == '1') {
echo tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' 
. tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('cID', 'action', 'cPath')) . 'action=setflag&flag=0&cID=' . $categories['categories_id'] . '&cPath=' . $cPath) . '">' 
. tep_image(DIR_WS_IMAGES . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
} else {
echo '<a href="' . tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('cID', 'action', 'cPath')) . 'action=setflag&flag=1&cID=' . $categories['categories_id'] 
. '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) 
. '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
}
?>

		</td>
		<td class="dataTableContent" align="right">&nbsp;</td>

		<td class="dataTableContent" align="right">
<?php
if ( (is_object($cInfo)) && ($categories['categories_id'] == $cInfo->categories_id) ) {
	echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
} else {
echo '<a href="' . tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('cID', 'action', 'cPath')) . 'cPath=' . $cPath . '&cID=' . $categories['categories_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
}
?>

		&nbsp;</td>
	</tr>

<?php
}

$products_count = 0;
if ($_GET['search']) {
$products_query_raw = "
select p.faqdesk_id, pd.faqdesk_question, p.faqdesk_image, p.faqdesk_image_two, p.faqdesk_image_three, p.faqdesk_date_added, 
p.faqdesk_last_modified, p.faqdesk_date_available, p.faqdesk_status, p.faqdesk_sticky, p2c.categories_id from " . TABLE_FAQDESK . " p, " 
. TABLE_FAQDESK_DESCRIPTION . " pd, " . TABLE_FAQDESK_TO_CATEGORIES . " p2c where p.faqdesk_id = pd.faqdesk_id and pd.language_id = '" 
. $languages_id . "' and p.faqdesk_id = p2c.faqdesk_id and pd.faqdesk_question like '%" . $_GET['search'] . "%' 
order by pd.faqdesk_question
";
} else {
$products_query_raw = "
select p.faqdesk_id, pd.faqdesk_question, p.faqdesk_image, p.faqdesk_image_two, p.faqdesk_image_three, p.faqdesk_date_added, 
p.faqdesk_last_modified, p.faqdesk_date_available, p.faqdesk_status, p.faqdesk_sticky from " . TABLE_FAQDESK . " p, " 
. TABLE_FAQDESK_DESCRIPTION . " pd, " . TABLE_FAQDESK_TO_CATEGORIES . " p2c where p.faqdesk_id = pd.faqdesk_id and pd.language_id = '" 
. $languages_id . "' and p.faqdesk_id = p2c.faqdesk_id and p2c.categories_id = '" . $current_category_id . "' order by 
pd.faqdesk_question
";
}
    $products_split = new splitPageResults($_GET['page'], MAX_PROD_ADMIN_SIDE, $products_query_raw, $products_query_numrows);
    $products_query = tep_db_query($products_query_raw);
    
while ($products = tep_db_fetch_array($products_query)) {
	$products_count++;
	$rows++;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// Get categories_id for product if search 
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
if ($_GET['search']) $cPath=$products['categories_id'];
	if ( ((!$_GET['pID']) && (!$_GET['cID']) || (@$_GET['pID'] == $products['faqdesk_id'])) && (!$pInfo) && (!$cInfo) && (substr($_GET['action'], 0, 4) != 'new_') ) {
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// find out the rating average from customer reviews
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
$reviews_query = tep_db_query("select (avg(reviews_rating) / 5 * 100) as average_rating from " . TABLE_REVIEWS . " where products_id = '" . $products['faqdesk_id'] . "'");
	$reviews = tep_db_fetch_array($reviews_query);
	$pInfo_array = array_merge($products, $reviews);
	$pInfo = new objectInfo($pInfo_array);
	}

	if ( (is_object($pInfo)) && ($products['faqdesk_id'] == $pInfo->faqdesk_id) ) {
		echo '<tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&pID=' . $products['faqdesk_id'] . '&page=' . $_GET['page'] . '&action=new_product_preview&read=only') . '\'">' . "\n";
	} else {
		echo '<tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&page=' . $_GET['page'] . '&pID=' . $products['faqdesk_id']) . '\'">' . "\n";
	}
?>
		<td class="dataTableContent">
<?php
echo '<a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&pID=' . $products['faqdesk_id'] . '&action=new_product_preview&read=only') . '">' . tep_image(DIR_WS_ICONS . 'preview.gif', ICON_PREVIEW) . '</a>&nbsp;' . $products['faqdesk_question'];
?>
		</td>
		<td class="dataTableContent" align="center">
<?php
if ($products['faqdesk_status'] == '1') {
	echo tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_FAQDESK, 'action=setflag&flag=0&pID=' . $products['faqdesk_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
} else {
	echo '<a href="' . tep_href_link(FILENAME_FAQDESK, 'action=setflag&flag=1&pID=' . $products['faqdesk_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
}
?>
		</td>
		<td class="dataTableContent" align="center">
<?php
if ($products['faqdesk_sticky'] == '1') {
	echo tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_FAQDESK, 'action=setflag_sticky&flag_sticky=0&pID=' . $products['faqdesk_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
} else {
	echo '<a href="' . tep_href_link(FILENAME_FAQDESK, 'action=setflag_sticky&flag_sticky=1&pID=' . $products['faqdesk_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
}
?>
		</td>
		<td class="dataTableContent" align="right">
<?php
if ( (is_object($pInfo)) && ($products['faqdesk_id'] == $pInfo->faqdesk_id) ) {
	echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
} else {
	echo '<a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&pID=' . $products['faqdesk_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
}
?>
		&nbsp;</td>
	</tr>
<?php
}

if ($cPath_array) {
	$cPath_back = '';
	for($i = 0, $n = sizeof($cPath_array) - 1; $i < $n; $i++) {
		if ($cPath_back == '') {
			$cPath_back .= $cPath_array[$i];
		} else {
			$cPath_back .= '_' . $cPath_array[$i];
		}
	}
}

    $cPath_back = ($cPath_back) ? 'cPath=' . $cPath_back : '';
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
//  Bottom to main page that has counts and new catagories and news items buttons
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
?>

	<tr>
		<td colspan="4">
<table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_PROD_ADMIN_SIDE, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_FAQS); ?></td>
                    <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_PROD_ADMIN_SIDE, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'cID'))); ?></td>
                  </tr>
</table>                  
<table border="0" width="100%" cellspacing="0" cellpadding="2">
	<tr>
		<td class="smallText"><?php echo TEXT_CATEGORIES . '&nbsp;' . $categories_count . '<br>' . TEXT_FAQDESK . '&nbsp;' . $products_count; ?></td>
		<td align="right" class="smallText">
<?php
if ($cPath) echo '<a href="' . tep_href_link(FILENAME_FAQDESK, $cPath_back . '&cID=' . $current_category_id) . '">' . 
tep_image_button('button_back.gif', IMAGE_BACK) . '</a>&nbsp;'; if (!$_GET['search']) echo '<a href="' . 
tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&action=new_category') . '">' . tep_image_button('button_new_category.gif', 
IMAGE_NEW_CATEGORY) . '</a>&nbsp;<a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&action=new_product') . '">' . tep_image_button('button_new_faq.gif', IMAGE_NEW_STORY) . '</a>';
?>
		</td>
	</tr>
</table>
		</td>
	</tr>
</table>
		</td>

<?php
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// types of actions and the text based informatioin declaration area
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
$heading = array();
$contents = array();
switch ($_GET['action']) {

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'new_category':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
$heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_CATEGORY . '</b>');

$contents = array('form' => tep_draw_form('newcategory', FILENAME_FAQDESK, 'action=insert_category&cPath=' . $cPath, 'post', 'enctype="multipart/form-data"'));
$contents[] = array('text' => TEXT_NEW_CATEGORY_INTRO);

$category_inputs_string = '';
$languages = tep_get_languages();
for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
	$category_inputs_string .= '
<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], 
$languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_name[' . $languages[$i]['id'] . ']
	');
}

$categories_description_inputs_string = '';
$languages = tep_get_languages();
for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
	$categories_description_inputs_string .= '
<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], 
$languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_description[' . $languages[$i]['id'] . ']
	');
}

$contents[] = array('text' => '<br>' . TEXT_CATEGORIES_NAME . $category_inputs_string);
$contents[] = array('text' => '<br>' . TEXT_CATEGORIES_DESCRIPTION_NAME . $categories_description_inputs_string);
$contents[] = array('text' => '<br>' . TEXT_CATEGORIES_IMAGE . '<br>' . tep_draw_file_field('categories_image'));
$contents[] = array('text' => '<br>' . TEXT_SORT_ORDER . '<br>' . tep_draw_input_field('sort_order', '', 'size="2"'));
//$contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
$contents[] = array('text' => '<br>' . TEXT_SHOW_STATUS . '<br>' . tep_draw_input_field('catagory_status', $cInfo->catagory_status, 'size="2"') . '<br><br>' . TEXT_FAQDESK_ENABLE . '<br>' . TEXT_FAQDESK_DISABLE);
$contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'edit_category':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
$heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_CATEGORY . '</b>');
$contents = array(
	'form' => tep_draw_form('categories', FILENAME_FAQDESK, 'action=update_category&cPath=' . $cPath, 'post', 'enctype="multipart/form-data"') . tep_draw_hidden_field('categories_id', $cInfo->categories_id)
);
$contents[] = array('text' => TEXT_EDIT_INTRO);

$category_inputs_string = '';
$languages = tep_get_languages();
for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
	$category_inputs_string .= '
<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], 
$languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_name[' . $languages[$i]['id'] . ']', 
faqdesk_get_category_name($cInfo->categories_id, $languages[$i]['id'])
);
}

$categories_description_inputs_string = '';
$languages = tep_get_languages();
for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
	$categories_description_inputs_string .= '
<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], 
$languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_description[' . $languages[$i]['id'] . ']', 
faqdesk_get_category_description($cInfo->categories_id, $languages[$i]['id'])
);
}

$contents[] = array('text' => '<br>' . TEXT_EDIT_CATEGORIES_NAME . $category_inputs_string);
$contents[] = array('text' => '<br>' . TEXT_EDIT_CATEGORIES_DESCRIPTION . $categories_description_inputs_string);
$contents[] = array(
	'text' => '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $cInfo->categories_image, $cInfo->categories_name) . '<br>' . DIR_WS_CATALOG_IMAGES . '<br><b>' . $cInfo->categories_image . '</b>'
);
$contents[] = array('text' => '<br>' . TEXT_EDIT_CATEGORIES_IMAGE . '<br>' . tep_draw_file_field('categories_image'));
$contents[] = array('text' => '<br>' . TEXT_EDIT_SORT_ORDER . '<br>' . tep_draw_input_field('sort_order', $cInfo->sort_order, 'size="2"'));
/*
$contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
*/
$contents[] = array('text' => '<br>' . TEXT_SHOW_STATUS . '<br>' . tep_draw_input_field('catagory_status', $cInfo->catagory_status, 'size="2"') . '<br><br>' . TEXT_FAQDESK_ENABLE . '<br>' . TEXT_FAQDESK_DISABLE);
$contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');


break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'delete_category':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------

$heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_CATEGORY . '</b>');

$contents = array('form' => tep_draw_form('categories', FILENAME_FAQDESK, 'action=delete_category_confirm&cPath=' . $cPath) . tep_draw_hidden_field('categories_id', $cInfo->categories_id));
$contents[] = array('text' => TEXT_DELETE_CATEGORY_INTRO);
$contents[] = array('text' => '<br><b>' . $cInfo->categories_name . '</b>');
if ($cInfo->childs_count > 0) $contents[] = array('text' => '<br>' . sprintf(TEXT_DELETE_WARNING_CHILDS, $cInfo->childs_count));
if ($cInfo->products_count > 0) $contents[] = array('text' => '<br>' . sprintf(TEXT_DELETE_WARNING_FAQDESK, $cInfo->products_count));
$contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'move_category':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------

$heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_MOVE_CATEGORY . '</b>');

$contents = array('form' => tep_draw_form('categories', FILENAME_FAQDESK, 'action=move_category_confirm') . tep_draw_hidden_field('categories_id', $cInfo->categories_id));
$contents[] = array('text' => sprintf(TEXT_MOVE_CATEGORIES_INTRO, $cInfo->categories_name));
$contents[] = array('text' => '<br>' . sprintf(TEXT_MOVE, $cInfo->categories_name) . '<br>' . tep_draw_pull_down_menu('move_to_category_id', faqdesk_get_category_tree('0', '', $cInfo->categories_id), $current_category_id));
$contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_move.gif', IMAGE_MOVE) . ' <a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'delete_product':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------

$heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_NEWS . '</b>');

$contents = array('form' => tep_draw_form('products', FILENAME_FAQDESK, 'action=delete_product_confirm&cPath=' . $cPath) . tep_draw_hidden_field('faqdesk_id', $pInfo->faqdesk_id));
$contents[] = array('text' => TEXT_DELETE_PRODUCT_INTRO);
$contents[] = array('text' => '<br><b>' . $pInfo->faqdesk_question . '</b>');

$product_categories_string = '';
$product_categories = faqdesk_generate_category_path($pInfo->faqdesk_id, 'product');
for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
	$category_path = '';
	for ($j = 0, $k = sizeof($product_categories[$i]); $j < $k; $j++) {
		$category_path .= $product_categories[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
	}
	$category_path = substr($category_path, 0, -16);
	$product_categories_string .= tep_draw_checkbox_field('product_categories[]', $product_categories[$i][sizeof($product_categories[$i])-1]['id'], true) . '&nbsp;' . $category_path . '<br>';
}

$product_categories_string = substr($product_categories_string, 0, -4);

$contents[] = array('text' => '<br>' . $product_categories_string);

$contents[] = array('text' => '<br>' . TEXT_DELETE_IMAGE_INTRO);

$contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&pID=' . $pInfo->faqdesk_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
      case 'move_product':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------

$heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_MOVE_PRODUCT . '</b>');

$contents = array('form' => tep_draw_form('products', FILENAME_FAQDESK, 'action=move_product_confirm&cPath=' . $cPath) . tep_draw_hidden_field('faqdesk_id', $pInfo->faqdesk_id));
$contents[] = array('text' => sprintf(TEXT_MOVE_FAQDESK_INTRO, $pInfo->faqdesk_question));
$contents[] = array('text' => '<br>' . TEXT_INFO_CURRENT_CATEGORIES . '<br><b>' . faqdesk_output_generated_category_path($pInfo->faqdesk_id, 'product') . '</b>');
$contents[] = array('text' => '<br>' . sprintf(TEXT_MOVE, $pInfo->faqdesk_question) . '<br>' . tep_draw_pull_down_menu('move_to_category_id', faqdesk_get_category_tree(), $current_category_id));
$contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_move.gif', IMAGE_MOVE) . ' <a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&pID=' . $pInfo->faqdesk_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
      case 'copy_to':
// -------------------------------------------------------------------------------------------------------------------------------------------------------------

$heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_COPY_TO . '</b>');

$contents = array(
	'form' => tep_draw_form('copy_to', FILENAME_FAQDESK, 'action=copy_to_confirm&cPath=' . $cPath) . 
			tep_draw_hidden_field('faqdesk_id', $pInfo->faqdesk_id)
		);
$contents[] = array('text' => TEXT_INFO_COPY_TO_INTRO);
$contents[] = array(
	'text' => '<br>' . TEXT_INFO_CURRENT_CATEGORIES . '<br><b>' . faqdesk_output_generated_category_path($pInfo->faqdesk_id, 'product') 
			. '</b>'
		);
$contents[] = array(
	'text' => '<br>' . TEXT_CATEGORIES . '<br>' . tep_draw_pull_down_menu('categories_id', faqdesk_get_category_tree(), $current_category_id)
		);
$contents[] = array(
	'text' => '<br>' . TEXT_HOW_TO_COPY . '<br>' . tep_draw_radio_field('copy_as', 'link', true) . ' ' . TEXT_COPY_AS_LINK . '<br>' 
			. tep_draw_radio_field('copy_as', 'duplicate') . ' ' . TEXT_COPY_AS_DUPLICATE
		);
$contents[] = array(
	'align' => 'center', 'text' => '<br>' . tep_image_submit('button_copy.gif', IMAGE_COPY) . ' <a href="' . tep_href_link(FILENAME_FAQDESK, 
			'cPath=' . $cPath . '&pID=' . $pInfo->faqdesk_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'
		);
break;

// -------------------------------------------------------------------------------------------------------------------------------------------------------------
default:
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
//  right box that runs the buttons and what not
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
if ($rows > 0) {
if (is_object($cInfo)) { // category info box contents
	$heading[] = array('text' => '<b>' . $cInfo->categories_name . '</b>');

	$contents[] = array(
		'align' => 'center',
		'text' => '
<a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id . '&action=edit_category') . '">' . 
tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&cID=' . 
$cInfo->categories_id . '&action=delete_category') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . 
tep_href_link(FILENAME_FAQDESK, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id . '&action=move_category') . '">' . 
tep_image_button('button_move.gif', IMAGE_MOVE) . '</a>'
	);
	$contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . tep_date_short($cInfo->date_added));

	if (tep_not_null($cInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($cInfo->last_modified));
		$contents[] = array(
			'text' => '<br>' . tep_info_image($cInfo->categories_image, $cInfo->categories_name, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '<br>' . $cInfo->categories_image
		);
		$contents[] = array('text' => '<br>' . TEXT_SUBCATEGORIES . ' ' . $cInfo->childs_count . '<br>' . TEXT_FAQDESK . ' ' . $cInfo->products_count);
	} elseif (is_object($pInfo)) { // news info box contents
		$heading[] = array('text' => '<b>' . faqdesk_get_faqdesk_question($pInfo->faqdesk_id, $languages_id) . '</b>');
		$contents[] = array(
			'align' => 'center',
			'text' => '<a href="' . tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath', 'pID')) . 'cPath=' . $cPath . '&pID=' . $pInfo->faqdesk_id . '&action=new_product') . 
'">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath', 'pID')) . 'cPath=' . $cPath . '&pID=' . 
$pInfo->faqdesk_id . '&action=delete_product') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . 
tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath', 'pID')) . 'cPath=' . $cPath . '&pID=' . $pInfo->faqdesk_id . '&action=move_product') . '">' . 
tep_image_button('button_move.gif', IMAGE_MOVE) . '</a> <a href="' . tep_href_link(FILENAME_FAQDESK, tep_get_all_get_params(array('action', 'cPath', 'pID')) . 'cPath=' . $cPath . '&pID=' . 
$pInfo->faqdesk_id . '&action=copy_to') . '">' . tep_image_button('button_copy_to.gif', IMAGE_COPY_TO) . '</a>'
		);
		$contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . tep_date_short($pInfo->faqdesk_date_added));
		if (tep_not_null($pInfo->faqdesk_last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($pInfo->faqdesk_last_modified));
			if (date('Y-m-d') < $pInfo->faqdesk_date_available) $contents[] = array('text' => TEXT_DATE_AVAILABLE . ' ' . tep_date_short($pInfo->faqdesk_date_available));
				$contents[] = array(
					'text' => '
<br>' . tep_info_image($pInfo->faqdesk_image, $pInfo->faqdesk_question, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '<br>' . $pInfo->faqdesk_image .
'<br>' . tep_info_image($pInfo->faqdesk_image_two, $pInfo->faqdesk_question, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '<br>' . $pInfo->faqdesk_image_two .
'<br>' . tep_info_image($pInfo->faqdesk_image_three, $pInfo->faqdesk_question, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '<br>' . $pInfo->faqdesk_image_three
				);
				$contents[] = array('text' => '<br>' . TEXT_FAQDESK_AVERAGE_RATING . ' ' . number_format($pInfo->average_rating, 2) . '%');
			}
		} else { // create category/news info
			$heading[] = array('text' => '<b>' . EMPTY_CATEGORY . '</b>');
			$contents[] = array('text' => sprintf(TEXT_NO_CHILD_CATEGORIES_OR_story, $parent_categories_name));
		}

		break;

	}

	if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
		echo '<td width="25%" valign="top">' . "\n";
		$box = new box;
		echo $box->infoBox($heading, $contents);
		echo '</td>' . "\n";
	}
?>

	</tr>
</table>
		</td>
	</tr>

<?php
}
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
// end of file area .... FOOTER code
// -------------------------------------------------------------------------------------------------------------------------------------------------------------
?>
</table>
		</td>
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
