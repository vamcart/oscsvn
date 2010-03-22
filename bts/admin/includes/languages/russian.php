<?php
/*
  $Id: russian.php,v 1.3 2003/09/28 23:37:26 anotherlango Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

//Admin begin
// header text in includes/header.php
define('HEADER_TITLE_ACCOUNT', '��� �������');
define('HEADER_TITLE_LOGOFF', '�����');

// Admin Account
define('BOX_HEADING_MY_ACCOUNT', '��� �������');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', '��������������');
define('BOX_ADMINISTRATOR_MEMBERS', '������ �������������');
define('BOX_ADMINISTRATOR_MEMBER', '������������');
define('BOX_ADMINISTRATOR_BOXES', '����� �������');
define('BOX_ADMINISTRATOR_ACCOUNT_UPDATE', '�������� ���������� � ����');

// images
define('IMAGE_FILE_PERMISSION', '����� �������');
define('IMAGE_GROUPS', '������ �����');
define('IMAGE_INSERT_FILE', '�������� ����');
define('IMAGE_MEMBERS', '������ �������������');
define('IMAGE_NEW_GROUP', '�������� ������');
define('IMAGE_NEW_MEMBER', '�������� ������������');
define('IMAGE_NEXT', '�����');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ������)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �������������)');
//Admin end

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'ru_RU.CP1251');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%d %B %Y �.'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'dd/MM/yyyy');  //Use only 'dd', 'MM' and 'yyyy' here in any order


////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2); 
  }
}

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="ru"');

// charset for web pages and emails
define('CHARSET', 'windows-1251');

// page title
define('TITLE', '�����������������');

// header text in includes/header.php
define('HEADER_TITLE_TOP', '�����������������');
define('HEADER_TITLE_SUPPORT_SITE', '���� ���������');
define('HEADER_TITLE_ONLINE_CATALOG', '�������');
define('HEADER_TITLE_ADMINISTRATION', '�����������������');
define('HEADER_TITLE_CHAINREACTION', 'osCommerce');
define('HEADER_TITLE_PHESIS', 'Loaded6');
// MaxiDVD Added Line For WYSIWYG HTML Area: BOF
define('BOX_CATALOG_DEFINE_MAINPAGE', '�������� ������� ��������');
// MaxiDVD Added Line For WYSIWYG HTML Area: EOF


// text for gender
define('MALE', '�������');
define('FEMALE', '�������');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', '���������');
define('BOX_CONFIGURATION_MYSTORE', '�������');
define('BOX_CONFIGURATION_LOGGING', '����');
define('BOX_CONFIGURATION_CACHE', '���');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', '������');
define('BOX_MODULES_PAYMENT', '������');
define('BOX_MODULES_SHIPPING', '��������');
define('BOX_MODULES_ORDER_TOTAL', '����� �����');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', '�������');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', '���������/������');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', '�������� - ���������');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES_NEW', '�������� - ���������');
define('BOX_CATALOG_MANUFACTURERS', '�������������');
define('BOX_CATALOG_REVIEWS', '������');
define('BOX_CATALOG_SPECIALS', '������');
define('BOX_CATALOG_PRODUCTS_EXPECTED', '��������� ������'); 
define('BOX_CATALOG_EASYPOPULATE', 'Excel ������/�������');

define('BOX_CATALOG_SALEMAKER', '�������� ������');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', '�������');
define('BOX_CUSTOMERS_CUSTOMERS', '�������');
define('BOX_CUSTOMERS_ORDERS', '������');
define('BOX_CUSTOMERS_EDIT_ORDERS', '������������� ������');


// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', '����� / ������');
define('BOX_TAXES_COUNTRIES', '������');
define('BOX_TAXES_ZONES', '�������');
define('BOX_TAXES_GEO_ZONES', '��������� ����');
define('BOX_TAXES_TAX_CLASSES', '���� �������');
define('BOX_TAXES_TAX_RATES', '������ �������');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', '������');
define('BOX_REPORTS_PRODUCTS_VIEWED', '������������� ������');
define('BOX_REPORTS_PRODUCTS_PURCHASED', '���������� ������');
define('BOX_REPORTS_ORDERS_TOTAL', '������ �������');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', '�����������');
define('BOX_TOOLS_BACKUP', '��������� ����������� ��');
define('BOX_TOOLS_BANNER_MANAGER', '�������� ��������');
define('BOX_TOOLS_CACHE', '�������� ����');
define('BOX_TOOLS_DEFINE_LANGUAGE', '�������� �����');
define('BOX_TOOLS_FILE_MANAGER', '�������� ��������');
define('BOX_TOOLS_MAIL', '��������� Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', '�������� �������� ��������');
define('BOX_TOOLS_SERVER_INFO', '���������� � �������');
define('BOX_TOOLS_WHOS_ONLINE', '��� � �������');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', '�����������');
define('BOX_LOCALIZATION_CURRENCIES', '������');
define('BOX_LOCALIZATION_LANGUAGES', '�����');
define('BOX_LOCALIZATION_ORDERS_STATUS', '������� �������');

// infobox box text in includes/boxes/info_boxes.php
define('BOX_HEADING_BOXES', '���������� �������');
define('BOX_HEADING_TEMPLATE_CONFIGURATION', '��������� ��������');
define('BOX_HEADING_DESIGN_CONTROLS', '�������');

// VJ Links Manager v1.00 begin
// links manager box text in includes/boxes/links.php
define('BOX_HEADING_LINKS', '������');
define('BOX_LINKS_LINKS', '������');
define('BOX_LINKS_LINK_CATEGORIES', '���������');
define('BOX_LINKS_LINKS_CONTACT', '�������� �����');
// VJ Links Manager v1.00 end

// javascript messages
define('JS_ERROR', '��� ���������� ����� �� ��������� ������!\n��������, ����������, ��������� �����������:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* ����� ������� ������ ����� ����� ����\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* ����� ������� ������ ����� ����� ������� �������\n');

define('JS_PRODUCTS_NAME', '* ��� ������ ������ ������ ���� ������� ������������\n');
define('JS_PRODUCTS_DESCRIPTION', '* ��� ������ ������ ������ ���� ������� ��������\n');
define('JS_PRODUCTS_PRICE', '* ��� ������ ������ ������ ���� ������� ����\n');
define('JS_PRODUCTS_WEIGHT', '* ��� ������ ������ ������ ���� ������ ���\n');
define('JS_PRODUCTS_QUANTITY', '* ��� ������ ������ ������ ���� ������� ����������\n');
define('JS_PRODUCTS_MODEL', '* ��� ������ ������ ������ ���� ������ ��� ������\n');
define('JS_PRODUCTS_IMAGE', '* ��� ������ ������ ������ ���� ��������\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* ��� ����� ������ ������ ���� ����������� ����� ����\n');

define('JS_GENDER', '* ���� \'���\' ������ ���� �������.\n');
define('JS_FIRST_NAME', '* ���� \'���\' ������ ��������� �� ����� ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' ��������.\n');
define('JS_LAST_NAME', '* ���� \'�������\' ������ ��������� �� ����� ' . ENTRY_LAST_NAME_MIN_LENGTH . ' ��������.\n');
define('JS_DOB', '* ���� \'���� ��������\' ������ ����� ������: xx/xx/xxxx (����/�����/���).\n');
define('JS_EMAIL_ADDRESS', '* ���� \'E-Mail �����\' ������ ��������� �� ����� ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' ��������.\n');
define('JS_ADDRESS', '* ���� \'�����\' ������ ��������� �� ����� ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' ��������.\n');
define('JS_POST_CODE', '* ���� \'������\' ������ ��������� �� ����� ' . ENTRY_POSTCODE_MIN_LENGTH . ' ��������.\n');
define('JS_CITY', '* ���� \'�����\' ������ ��������� �� ����� ' . ENTRY_CITY_MIN_LENGTH . ' ��������.\n');
define('JS_STATE', '* ���� \'������\' ������ ���� �������.\n');
define('JS_STATE_SELECT', '-- �������� ���� --');
define('JS_ZONE', '* ���� \'������\' ������ ��������������� �������� ������.');
define('JS_COUNTRY', '* ���� \'������\' ����� ���� ���������.\n');
define('JS_TELEPHONE', '* ���� \'�������\' ������ ��������� �� ����� ' . ENTRY_TELEPHONE_MIN_LENGTH . ' ��������.\n');
define('JS_PASSWORD', '* ���� \'������\' � \'�������������\' ������ ��������� � ��������� �� ����� ' . ENTRY_PASSWORD_MIN_LENGTH . ' ��������.\n');

define('JS_ORDER_DOES_NOT_EXIST', '����� ����� %s �� ������!');

define('CATEGORY_PERSONAL', '������������');
define('CATEGORY_ADDRESS', '�����');
define('CATEGORY_CONTACT', '��� ��������');
define('CATEGORY_COMPANY', '��������');
define('CATEGORY_OPTIONS', '��������');
define('DISCOUNT_OPTIONS', '������');

define('ENTRY_GENDER', '���:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">�����������</span>');
define('ENTRY_FIRST_NAME', '���:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">������� ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' ��������</span>');
define('ENTRY_LAST_NAME', '�������:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">������� ' . ENTRY_LAST_NAME_MIN_LENGTH . ' ��������</span>');
define('ENTRY_DATE_OF_BIRTH', '���� ��������:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(������ 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail �����:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">������� ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' ��������</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">�� ����� �������� email �����!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">������ email ����� ��� ���������������!</span>');
define('ENTRY_COMPANY', '�������� ��������:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', '�����:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">������� ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' ��������</span>');
define('ENTRY_SUBURB', '�����:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', '������:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">������� ' . ENTRY_POSTCODE_MIN_LENGTH . ' ��������</span>');
define('ENTRY_CITY', '�����:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">������� ' . ENTRY_CITY_MIN_LENGTH . ' ��������</span>');
define('ENTRY_STATE', '������:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">�����������</span>');
define('ENTRY_COUNTRY', '������:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', '�������:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">������� ' . ENTRY_TELEPHONE_MIN_LENGTH . ' ��������</span>');
define('ENTRY_FAX_NUMBER', '����:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', '�������� ��������:');
define('ENTRY_NEWSLETTER_YES', '��������');
define('ENTRY_NEWSLETTER_NO', '�� ��������');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', '��������� E-Mail');
define('IMAGE_BACK', '�����');
define('IMAGE_BACKUP', '���. �����');
define('IMAGE_CANCEL', '��������');
define('IMAGE_CONFIRM', '�����������');
define('IMAGE_COPY', '����������');
define('IMAGE_COPY_TO', '���������� �');
define('IMAGE_DETAILS', '���������');
define('IMAGE_DELETE', '�������');
define('IMAGE_EDIT', '�������������');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', '�������� ������');
define('IMAGE_ICON_STATUS_GREEN', '��������');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', '��������������');
define('IMAGE_ICON_STATUS_RED', '����������');
define('IMAGE_ICON_STATUS_RED_LIGHT', '������� ����������');
define('IMAGE_ICON_INFO', '�������������� ��������');
define('IMAGE_INSERT', '��������');
define('IMAGE_LOCK', '�����');
define('IMAGE_MODULE_INSTALL', '���������� ������');
define('IMAGE_MODULE_REMOVE', '������� ������');
define('IMAGE_MOVE', '�����������');
define('IMAGE_NEW_BANNER', '����� ������');
define('IMAGE_NEW_CATEGORY', '����� ���������');
define('IMAGE_NEW_COUNTRY', '����� ������');
define('IMAGE_NEW_CURRENCY', '����� ������'); 
define('IMAGE_NEW_FILE', '����� ����');
define('IMAGE_NEW_FOLDER', '����� �����');
define('IMAGE_NEW_LANGUAGE', '����� ����');
define('IMAGE_NEW_NEWSLETTER', '����� ������ ��������');
define('IMAGE_NEW_PRODUCT', '����� �����');
define('IMAGE_NEW_SALE', '����� ����������');
define('IMAGE_NEW_TAX_CLASS', '����� �����'); 
define('IMAGE_NEW_TAX_RATE', '����� ������ ������');
define('IMAGE_NEW_TAX_ZONE', '����� ��������� ����');
define('IMAGE_NEW_ZONE', '����� ����');
define('IMAGE_ORDERS', '������');
define('IMAGE_ORDERS_INVOICE', '����-�������');
define('IMAGE_ORDERS_PACKINGSLIP', '���������');
define('IMAGE_PREVIEW', '������������');
define('IMAGE_RESTORE', '������������');
define('IMAGE_RESET', '�����');
define('IMAGE_SAVE', '���������');
define('IMAGE_SEARCH', '������');
define('IMAGE_SELECT', '�������');
define('IMAGE_SEND', '���������');
define('IMAGE_SEND_EMAIL', '��������� Email');
define('IMAGE_UNLOCK', '��������������');
define('IMAGE_UPDATE', '��������');
define('IMAGE_UPDATE_CURRENCIES', '��������������� ����� �����');
define('IMAGE_UPLOAD', '���������');
define('TEXT_IMAGE_NONEXISTENT', '��� ��������'); 

define('ICON_CROSS', '���������������');
define('ICON_CURRENT_FOLDER', '������� ����������');
define('ICON_DELETE', '�������');
define('ICON_ERROR', '������:');
define('ICON_FILE', '����');
define('ICON_FILE_DOWNLOAD', '��������');
define('ICON_FOLDER', '�����');
define('ICON_LOCKED', '�������������');
define('ICON_PREVIOUS_LEVEL', '���������� �������');
define('ICON_PREVIEW', '�������������');
define('ICON_STATISTICS', '����������');
define('ICON_SUCCESS', '���������');
define('ICON_TICK', '������');
define('ICON_UNLOCKED', '��������������');
define('ICON_WARNING', '��������');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', '�������� %s �� %d');

define('TEXT_DISPLAY_NUMBER_OF_BANNERS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ��������)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �����)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ��������)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �����)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �������� �������)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ��������������)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ��������)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �������)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �������)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �������)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ��������� �������)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ������� � �������)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ����������� �����������)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ����� �������)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ��������� ���)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ������ �������)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ���)');
define('TEXT_DISPLAY_NUMBER_OF_NEWS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ��������)');
define('TEXT_DISPLAY_NUMBER_OF_FAQS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ��������)');

define('PREVNEXT_BUTTON_PREV', '����������');
define('PREVNEXT_BUTTON_NEXT', '���������');

define('TEXT_DEFAULT', '�� ���������');
define('TEXT_SET_DEFAULT', '���������� �� ���������');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* �����������</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', '������: � ���������� ������� �� ���� ������ �� ���� ����������� �� ���������. ����������, ���������� ���� �� ��� �: ����������� -> ������');

define('TEXT_CACHE_CATEGORIES', '���� ���������');
define('TEXT_CACHE_MANUFACTURERS', '���� ��������������');
define('TEXT_CACHE_ALSO_PURCHASED', '����� ������ �������'); 

define('TEXT_NONE', '--���--');
define('TEXT_TOP', '������');

define('ERROR_DESTINATION_DOES_NOT_EXIST', '������: ������� �� ����������.');
define('ERROR_DESTINATION_NOT_WRITEABLE', '������: ������� ������� �� ������, ���������� ����������� ����� �������.');
define('ERROR_FILE_NOT_SAVED', '������: ���� �� ��� ��������.');
define('ERROR_FILETYPE_NOT_ALLOWED', '������: ������ ���������� ����� ������� ����.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', '���������: ���� ������� ��������.');
define('WARNING_NO_FILE_UPLOADED', '��������������: �� ������ ����� �� ���������.');
define('WARNING_FILE_UPLOADS_DISABLED', '��������������: ����� �������� ������ ��������� � ���������������� ����� php.ini.');

define('BOX_CATALOG_XSELL_PRODUCTS', '������������� ������');

define('IMAGE_BUTTON_PRINT_ORDER', '������ ��� ������');

 // X-Sell
REQUIRE(DIR_WS_LANGUAGES . 'add_ccgvdc_russian.php');

// BOF: Lango Added for print order MOD
define('IMAGE_BUTTON_PRINT', '��������');
// EOF: Lango Added for print order MOD

// BOF: Lango Added for Featured product MOD
  define('BOX_CATALOG_FEATURED', '������������� ������');
// EOF: Lango Added for Featured product MOD

// BOF: Lango Added for Sales Stats MOD
define('BOX_REPORTS_MONTHLY_SALES', '���������� ������');
// EOF: Lango Added for Sales Stats MOD

// BOF: Lango Added for template MOD
// WebMakers.com Added: Attribute Sorter, Copier and Catalog additions
require(DIR_WS_LANGUAGES . $language . '/' . 'attributes_sorter.php');

//BEGIN Dynamic information pages unlimited
define('BOX_HEADING_INFORMATION', '�������������� ��������');
define('BOX_INFORMATION', '��������');
//END Dynamic information pages unlimited

	define('BOX_REPORTS_RECOVER_CART_SALES', '������������� ������');
	define('BOX_TOOLS_RECOVER_CART', '������������� ������');

  define('BOX_TOOLS_KEYWORDS', '��������� �������');

// RJW Begin Meta Tags Code
  define('TEXT_META_TITLE', 'Meta Title');
  define('TEXT_META_DESCRIPTION', 'Meta Description');
  define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

// Article Manager
define('BOX_HEADING_ARTICLES', '������');
define('BOX_TOPICS_ARTICLES', '������/�������');
define('BOX_ARTICLES_CONFIG', '���������');
define('BOX_ARTICLES_AUTHORS', '������');
define('BOX_ARTICLES_REVIEWS', '������'); 
define('BOX_ARTICLES_XSELL', '������-������');
define('IMAGE_NEW_TOPIC', '����� ������');
define('IMAGE_NEW_ARTICLE', '����� ������');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �������)'); 

//TotalB2B start
define('BOX_CUSTOMERS_GROUPS', '������');
define('BOX_MANUDISCOUNT', '������ �� ������ ������ �������������');
//TotalB2B end

// add for Group minimum price to order start		
define('GROUP_MIN_PRICE', '����������� ��������� ������ ������');
// add for Group minimum price to order end

// add for color groups start
define('GROUP_COLOR_BAR', '���� ������');
// add for color groups end
//TotalB2B end
define('BOX_CATALOG_QUICK_UPDATES', '���������� ������');

define('IMAGE_PROPERTIES_POPUP_ADD_CHANGE_DELETE', '��������/������� ���. ���������');
define('IMAGE_PROPERTIES_POPUP_ADD', '�������� ���. ���������');
define('IMAGE_PROPERTIES', '���. ���������');

// polls box text in includes/boxes/polls.php

define('BOX_HEADING_POLLS', '������');
define('BOX_POLLS_POLLS', '������');
define('BOX_POLLS_CONFIG','���������');

define('BOX_INDEX_GIFTVOUCHERS', '����������� / ������');

define('BOX_REPORTS_SALES_REPORT2', '���������� ������ 2');
define('BOX_REPORTS_SALES_REPORT', '���������� ������ 3');
define('BOX_REPORTS_CUSTOMERS_ORDERS', '���������� ��������');

define('TEXT_NEW_ATTRIBUTE_EDIT', '������������� �������� ������');

define('CONFIGURATION_GROUP_1', '��� �������');
define('CONFIGURATION_GROUP_2', '����������� ��������');
define('CONFIGURATION_GROUP_3', '������������ ��������');
define('CONFIGURATION_GROUP_4', '��������');
define('CONFIGURATION_GROUP_5', '������ ����������');
define('CONFIGURATION_GROUP_6', '������������� ������');
define('CONFIGURATION_GROUP_7', '��������/��������');
define('CONFIGURATION_GROUP_8', '����� ������');
define('CONFIGURATION_GROUP_9', '�����');
define('CONFIGURATION_GROUP_10', '����');
define('CONFIGURATION_GROUP_11', '���');
define('CONFIGURATION_GROUP_12', '��������� E-Mail');
define('CONFIGURATION_GROUP_13', '����������');
define('CONFIGURATION_GROUP_14', 'GZip ����������');
define('CONFIGURATION_GROUP_15', '������');
define('CONFIGURATION_GROUP_112', 'HTML ��������');
define('CONFIGURATION_GROUP_900', '���������� ���������');
define('CONFIGURATION_GROUP_16', '���. ������������');
define('CONFIGURATION_GROUP_40', '������� ����������');
define('CONFIGURATION_GROUP_901', '������');
define('CONFIGURATION_GROUP_300', '���������� ������');
define('CONFIGURATION_GROUP_12954', '���������� ������');
define('CONFIGURATION_GROUP_26229', '��� �������');
define('CONFIGURATION_GROUP_26230', '������-������');
define('CONFIGURATION_GROUP_401', '������ ��������� �� ������� ��������');
define('CONFIGURATION_GROUP_160', '���������� �������');
define('CONFIGURATION_GROUP_72', '�������� �������');
define('CONFIGURATION_GROUP_735', '�������� ���������');
define('CONFIGURATION_GROUP_736', '�����');
define('CONFIGURATION_GROUP_1610', '������������ �������');

define('FAQDESK_LISTING_DB', '��������� ������');
define('FAQDESK_SETTINGS_DB', '����� ���������');
define('FAQDESK_REVIEWS_DB', '��������� �������');
define('FAQDESK_STICKY_DB', '��������� "�������" ��������');
define('FAQDESK_OTHER_DB', '������ ���������');

define('NEWSDESK_LISTING_DB', '��������� ������');
define('NEWSDESK_SETTINGS_DB', '����� ���������');
define('NEWSDESK_REVIEWS_DB', '��������� �������');
define('NEWSDESK_STICKY_DB', '��������� "�������" ��������');

define('ATTRIBUTES_COPY_TEXT1', ' ��������: ������ ����������� �������� �� ������ ����� ');
define('ATTRIBUTES_COPY_TEXT2', ' � ����� �����');
define('ATTRIBUTES_COPY_TEXT3', '. ������ �� �����������.');
define('ATTRIBUTES_COPY_TEXT4', ' ��������: ��� ��������� ��� ����������� �� ������ ����� ');
define('ATTRIBUTES_COPY_TEXT5', ' � ����� ');
define('ATTRIBUTES_COPY_TEXT6', '. ������ �� �����������.');
define('ATTRIBUTES_COPY_TEXT7', ' ��������: ����� � ������� ');
define('ATTRIBUTES_COPY_TEXT8', ' �� ������. ���� �� �� ������� ����� ������, ���� ��������� ����� �� ����������. ������ �� �����������.');

//include('includes/languages/english_support.php');

// BOF FlyOpenair: Extra Product Price
define('BOX_EXTRA_PRODUCT_PRICE', '�������');
define('EXTRA_PRODUCT_PRICE_ID_TITLE', '������� �������');
define('EXTRA_PRODUCT_PRICE_ID_DESC', '��������� � ���������� ������ ������� �������');
// EOF FlyOpenair: Extra Product Price

define('BOX_TITLE_VAM', 'osCommerce');
define('VAM_LINK_TITLE', '��� ����� osCommerce VaM Edition');
define('VAM_LINK_FORUM', '����� ���������');
define('VAM_LINK_BUGTRACKER', '����� ������');
define('VAM_LINK_MANUAL', '����������� ������������ osCommerce VaM Edition');
define('VAM_LINK_MODULES', '������');
define('VAM_LINK_TEMPLATES', '�������');
define('VAM_LINK_SERVICES', '������');

define('TEXT_IMAGE_OVERWRITE_WARNING','��������: ��� ����� ���� ��������, �� �� ������������ ');          

define('BOX_MODULES_SHIP2PAY', '��������-������');
define('BROWSE_BY_CATEGORIES_TITLE', '�������� ���������');

include('includes/languages/russian_newsdesk.php');
include('includes/languages/russian_faqdesk.php');
include('includes/languages/order_edit_russian.php');

define('BOX_TOOLS_EXTRA_FIELDS_MANAGER','�������������� ���� �����������');
define('ENTRY_EXTRA_FIELDS_ERROR','���� %s ������ ��������� ��� ������� %d ��������');
define('TEXT_DISPLAY_NUMBER_OF_FIELDS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �����)');

// START: Product Extra Fields
define('BOX_CATALOG_PRODUCTS_EXTRA_FIELDS', '�������������� ���� �������');
// END: Product Extra Fields

define('CIP_TITLE','��������� �������');
define('BOX_CONTRIB_INSTALLER', '��������� �������');

define('TEXT_OTHER', '������');         

define('TEXT_INDEX_LANGUAGE','����: ');
define('TEXT_SUMMARY_CUSTOMERS','����������');
define('TEXT_SUMMARY_ORDERS','������');
define('TEXT_SUMMARY_PRODUCTS','������');
define('TEXT_SUMMARY_HELP','������');
define('TEXT_SUMMARY_STAT','����������');

define('TABLE_HEADING_HELP', '������');

define('TABLE_HEADING_CUSTOMERS', '��������� ����������');
define('TABLE_HEADING_LASTNAME', '�������');
define('TABLE_HEADING_FIRSTNAME', '���');
define('TABLE_HEADING_DATE', '����');

define('TABLE_HEADING_ORDERS', '��������� ������');
define('TABLE_HEADING_CUSTOMER', '����������');
define('TABLE_HEADING_NUMBER', '�����');
define('TABLE_HEADING_ORDER_TOTAL', '�����');
define('TABLE_HEADING_STATUS', '������');

define('TABLE_HEADING_SUMMARY_PRODUCTS', '��������� ������');
define('TABLE_HEADING_PRODUCT_NAME', '������');
define('TABLE_HEADING_PRODUCT_PRICE', '���������');

define('BOX_CATEGORY_SPECIALS', '��������� �� ��������');
define('TEXT_DISPLAY_NUMBER_OF_SPECIAL_CATEGORY', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ��������� �� ��������)');

//Options as Images Mod
define('BOX_CATALOG_OPTIONS_IMAGES', '�������� ���������');

define('BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI', '�������� ��������/�����������/����������� �������.');

// Products Specifications
define('BOX_CATALOG_PRODUCTS_SPECIFICATIONS', '������������ �������');

define('BOX_EMAIL_QUEUE', '������� Email');
         
?>