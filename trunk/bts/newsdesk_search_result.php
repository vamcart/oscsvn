<?php

require('includes/application_top.php');
require('includes/functions/newsdesk_general.php');

require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_NEWSDESK_SEARCH_RESULT);

// set application wide parameters --- this query set is for NEWSDesk
$configuration_query = tep_db_query("select configuration_key as cfgKey, configuration_value as cfgValue from " . TABLE_NEWSDESK_CONFIGURATION . "");
while ($configuration = tep_db_fetch_array($configuration_query)) {
	define($configuration['cfgKey'], $configuration['cfgValue']);
}

$error = 0; // reset error flag to false
$errorno = 0;

if ( ($_GET['keywords'] == "" || strlen($_GET['keywords']) < 1) &&
	($_GET['dfrom'] == ""    || $_GET['dfrom'] == DOB_FORMAT_STRING || strlen($_GET['dfrom']) < 1 ) &&
	($_GET['dto'] == ""      || $_GET['dto']   == DOB_FORMAT_STRING || strlen($_GET['dto']) < 1) &&
	($_GET['pfrom'] == ""    || strlen($_GET['pfrom']) < 1) &&
	($_GET['pto'] == ""      || strlen($_GET['pto']) < 1) ) {
		$errorno += 1;
		$error = 1;
}

if ($_GET['dfrom'] == DOB_FORMAT_STRING)
{	$dfrom_to_check = "";
}else{
	$dfrom_to_check = $_GET['dfrom'];
}

if ($_GET['dto'] == DOB_FORMAT_STRING){
	$dto_to_check = "";
}else{
	$dto_to_check = $_GET['dto'];
}

if (strlen($dfrom_to_check) > 0) {
	if (!tep_checkdate($dfrom_to_check, DOB_FORMAT_STRING, $dfrom_array)) {
		$errorno += 10;
	$error = 1;
	}
}

if (strlen($dto_to_check) > 0) {
	if (!tep_checkdate($dto_to_check, DOB_FORMAT_STRING, $dto_array)) {
		$errorno += 100;
		$error = 1;
	}
}

if (strlen($dfrom_to_check) > 0 && !(($errorno & 10) == 10) &&
	strlen($dto_to_check) > 0 && !(($errorno & 100) == 100)) {
	if (mktime(0, 0, 0, $dfrom_array[1], $dfrom_array[2], $dfrom_array[0]) > mktime(0, 0, 0, $dto_array[1], $dto_array[2], $dto_array[0])) {
		$errorno += 1000;
		$error = 1;
	}
}

if (strlen($_GET['pfrom']) > 0) {
	$pfrom_to_check = $_GET['pfrom'];
	if (!settype($pfrom_to_check, "double")) {
		$errorno += 10000;
		$error = 1;
	}
}

if (strlen($_GET['pto']) > 0) {
	$pto_to_check = $_GET['pto'];
	if (!settype($pto_to_check, "double")) {
		$errorno += 100000;
		$error = 1;
	}
}

if (strlen($_GET['pfrom']) > 0 && !(($errorno & 10000) == 10000) &&
	strlen($_GET['pto']) > 0 && !(($errorno & 100000) == 100000)) {
	if ($pfrom_to_check > $pto_to_check) {
		$errorno += 1000000;
		$error = 1;
	}
}

if (strlen($_GET['keywords']) > 0) {
	if (!tep_parse_search_string(stripslashes($_GET['keywords']), $search_keywords)) {
		$errorno += 10000000;
		$error = 1;
	}
}


//FILENAME_NEWSDESK_SEARCH
if ($error == 1) {
	tep_redirect(tep_href_link(FILENAME_NEWSDESK_INFO, 'errorno=' . $errorno . '&' . tep_get_all_get_params(array('x', 'y')), 'NONSSL'));
} else {

	$breadcrumb->add(HEADING_TITLE);
	$breadcrumb->add(HEADING_TITLE_2, tep_href_link(FILENAME_NEWSDESK_SEARCH_RESULT, 'keywords=' . $_GET['keywords'] 
	. '&search_in_description=' . $_GET['search_in_description'] . '&categories_id=' . $_GET['categories_id'] 
	. '&inc_subcat=' . $_GET['inc_subcat'] . '&pfrom=' 
	. $_GET['pfrom'] . '&pto=' . $_GET['pto'] . '&dfrom=' . $_GET['dfrom'] . '&dto=' . $_GET['dto']));

//$javascript = "support.js";
}

$content = CONTENT_NEWSDESK_SEARCH_RESULT;
require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>




