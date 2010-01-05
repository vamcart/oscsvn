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

// define the filenames used in the project

// BEGIN newdesk
define('FILENAME_NEWSDESK_REVIEWS_WRITE', 'newsdesk_reviews_write.php');
define('FILENAME_NEWSDESK_REVIEWS_INFO', 'newsdesk_reviews_info.php');
define('FILENAME_NEWSDESK_REVIEWS_ARTICLE', 'newsdesk_reviews_article.php');
define('FILENAME_NEWSDESK_INFO', 'newsdesk_info.php');
define('FILENAME_NEWSDESK_INDEX', 'newsdesk_index.php');

define('FILENAME_NEWSDESK', 'newsdesk.php');
define('FILENAME_NEWSDESK_LISTING', 'newsdesk_listing.php');
define('FILENAME_NEWSDESK_LATEST', 'newsdesk_latest.php');

define('FILENAME_NEWSDESK_REVIEWS', 'newsdesk_reviews.php');
define('FILENAME_NEWSDESK_ARTICLE_REQUIRE', DIR_WS_INCLUDES . 'modules/newsdesk/newsdesk_article_require.php');

define('FILENAME_NEWSDESK_SEARCH_RESULT', 'newsdesk_search_result.php');

define('DIR_WS_RSS', DIR_WS_INCLUDES . 'modules/newsdesk/rss/');
//define('FILENAME_NEWSDESK_STICKY', 'newsdesk_sticky.php');
// END newsdesk

// BEGIN newdesk
define('TABLE_NEWSDESK', 'newsdesk');
define('TABLE_NEWSDESK_DESCRIPTION', 'newsdesk_description');
define('TABLE_NEWSDESK_TO_CATEGORIES', 'newsdesk_to_categories');
define('TABLE_NEWSDESK_CATEGORIES', 'newsdesk_categories');
define('TABLE_NEWSDESK_CATEGORIES_DESCRIPTION', 'newsdesk_categories_description');
define('TABLE_NEWSDESK_CONFIGURATION', 'newsdesk_configuration');
define('TABLE_NEWSDESK_CONFIGURATION_GROUP', 'newsdesk_configuration_group');

define('TABLE_NEWSDESK_REVIEWS', 'newsdesk_reviews');
define('TABLE_NEWSDESK_REVIEWS_DESCRIPTION', 'newsdesk_reviews_description');
// END newsdesk

?>