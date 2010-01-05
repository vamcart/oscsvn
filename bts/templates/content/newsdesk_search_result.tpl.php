<table border="0" width="100%" cellspacing="0" cellpadding="<?php echo CELLPADDING_SUB;?>">
<?php 
// Set number of columns in listing
define ('NR_COLUMNS', 2);?>
<?php
// BOF: Lango Added for template MOD
if (SHOW_HEADING_TITLE_ORIGINAL == 'yes') {
$header_text = '&nbsp;'
//EOF: Lango Added for template MOD
?>
      <tr> 
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0"> 
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE_2; ?></td>
            <td align="right"><?php echo tep_image(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/images/content/specials.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td> 
      </tr>
<?php
// BOF: Lango Added for template MOD
}else{
$header_text = NAVBAR_TITLE_SEARCH;
}
// EOF: Lango Added for template MOD
?>

<?php
// BOF: Lango Added for template MOD
if (MAIN_TABLE_BORDER == 'yes'){
$header_text = NAVBAR_TITLE_SEARCH;
table_image_border_top(false, false, $header_text);
}
// EOF: Lango Added for template MOD
?>

      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">
<?php
// create column list
$define_list = array(
	'NEWSDESK_DATE_AVAILABLE' => NEWSDESK_DATE_AVAILABLE,
	'NEWSDESK_ARTICLE_DESCRIPTION' => NEWSDESK_ARTICLE_DESCRIPTION,
	'NEWSDESK_ARTICLE_SHORTTEXT' => NEWSDESK_ARTICLE_SHORTTEXT,
	'NEWSDESK_ARTICLE_NAME' => NEWSDESK_ARTICLE_NAME,
);

asort($define_list);

$column_list = array();
reset($define_list);
while (list($column, $value) = each($define_list)) {
	if ($value) $column_list[] = $column;
}

$select_column_list = '';

for ($col=0; $col<sizeof($column_list); $col++) {
	if ( ($column_list[$col] == 'NEWSDESK_DATE_AVAILABLE') || ($column_list[$col] == 'NEWSDESK_ARTICLE_NAME') ) {
		continue;
	}

	if ($select_column_list != '') {
		$select_column_list .= ', ';
	}

	switch ($column_list[$col]) {
	case 'NEWSDESK_DATE_AVAILABLE': $select_column_list .= 'p.newsdesk_date_added';
		break;
	case 'NEWSDESK_ARTICLE_DESCRIPTION': $select_column_list .= 'pd.newsdesk_article_description';
		break;
	case 'NEWSDESK_ARTICLE_SHORTTEXT': $select_column_list .= 'pd.newsdesk_article_shorttext';
		break;
	case 'NEWSDESK_ARTICLE_NAME': $select_column_list .= 'pd.newsdesk_article_name';
		break;
	}
}

if ($select_column_list != '') {
	$select_column_list .= ', ';
}

$select_str = "select " . $select_column_list . " p.newsdesk_id, p.newsdesk_date_added, pd.newsdesk_article_name, 
pd.newsdesk_article_description, pd.newsdesk_article_shorttext ";

$from_str = "from " . TABLE_NEWSDESK . " p, " . TABLE_NEWSDESK_DESCRIPTION . " pd, " 
. TABLE_NEWSDESK_CATEGORIES . " c, " . TABLE_NEWSDESK_TO_CATEGORIES . " p2c";

$where_str = " where p.newsdesk_status = '1' and p.newsdesk_id = pd.newsdesk_id and pd.language_id = '" . $languages_id . "' and 
p.newsdesk_id = p2c.newsdesk_id and p2c.categories_id = c.categories_id ";

if ($_GET['categories_id']) {
	if ($_GET['inc_subcat'] == "1") {
		$subcategories_array = array();
		newsdesk_get_subcategories($subcategories_array, $_GET['categories_id']);
		$where_str .= " and p2c.newsdesk_id = p.newsdesk_id and p2c.newsdesk_id = pd.newsdesk_id and (p2c.categories_id = '" 
		. $_GET['categories_id'] . "'";

		for ($i=0; $i<sizeof($subcategories_array); $i++ ) {
			$where_str .= " or p2c.categories_id = '" . $subcategories_array[$i] . "'";
		}
		$where_str .= ")";
	} else {
		$where_str .= " and p2c.newsdesk_id = p.newsdesk_id and p2c.newsdesk_id = pd.newsdesk_id and pd.language_id = '" 
		. $languages_id . "' and p2c.categories_id = '" . $_GET['categories_id'] . "'";
	}
}

if ($_GET['keywords']) {
	if (tep_parse_search_string( StripSlashes($_GET['keywords']), $search_keywords)) {
		$where_str .= " and (";
		for ($i=0; $i<sizeof($search_keywords); $i++ ) {
			switch ($search_keywords[$i]) {
				case '(':
				case ')':
				case 'and':
				case 'or':
				$where_str .= " " . $search_keywords[$i] . " ";
			break;
			default:
$where_str .= "
(pd.newsdesk_article_name like '%" . AddSlashes($search_keywords[$i]) . "%' or 
pd.newsdesk_article_shorttext like '%" . AddSlashes($search_keywords[$i]) . "%' or 
pd.newsdesk_article_description like '%" . AddSlashes($search_keywords[$i]) . "%'";
				if ($_GET['search_in_description']) $where_str .= " 
				or pd.newsdesk_article_description like '%" . AddSlashes($search_keywords[$i]) . "%'";
				$where_str .= ')';
			break;
			}
		}
		$where_str .= " )";
	}
}

if ($_GET['dfrom'] && $_GET['dfrom'] != DOB_FORMAT_STRING) {
	$where_str .= " and p.newsdesk_date_added >= '" . tep_date_raw($dfrom_to_check) . "'";
}

if ($_GET['dto'] && $_GET['dto'] != DOB_FORMAT_STRING) {
	$where_str .= " and p.newsdesk_date_added <= '" . tep_date_raw($dto_to_check) . "'";
}


if ( (!$_GET['sort']) || (!preg_match('/[1-8][ad]/', $_GET['sort'])) || (substr($_GET['sort'],0,1) > sizeof($column_list)) ) {
	for ($col=0; $col<sizeof($column_list); $col++) {
		if ($column_list[$col] == 'NEWSDESK_ARTICLE_NAME') {
			$_GET['sort'] = $col+1 . 'a';
			$order_str .= " order by pd.newsdesk_article_name";
			break;
		}
	}
} else {
	$sort_col = substr($_GET['sort'], 0, 1);
	$sort_order = substr($_GET['sort'], 1);
	$order_str .= ' order by ';
	switch ($column_list[$sort_col-1]) {
	case 'NEWSDESK_DATE_AVAILABLE': $order_str .= "p.newsdesk_date_added " . ($sort_order == 'd' ? "desc" : "") . ", pd.newsdesk_article_name";
		break;
	case 'NEWSDESK_ARTICLE_NAME': $order_str .= "pd.newsdesk_article_name " . ($sort_order == 'd' ? "desc" : "");
		break;
	case 'NEWSDESK_ARTICLE_SHORTTEXT': $order_str .= "pd.newsdesk_article_shorttext " . ($sort_order == 'd' ? "desc" : "") . ", pd.newsdesk_article_name";
		break;
	case 'NEWSDESK_ARTICLE_DESCRIPTION': $order_str .= "pd.newsdesk_article_description " . ($sort_order == 'd' ? "desc" : "") . ", pd.newsdesk_article_name";
		break;
	}
}

$listing_sql = $select_str . $from_str . $where_str . $order_str;

require(DIR_WS_MODULES . FILENAME_NEWSDESK_LISTING);
?>
</td>
          </tr>
        </table></td>
      </tr>
<?php
// BOF: Lango Added for template MOD
if (MAIN_TABLE_BORDER == 'yes'){
table_image_border_bottom();
}
// EOF: Lango Added for template MOD
?>

   </table>
