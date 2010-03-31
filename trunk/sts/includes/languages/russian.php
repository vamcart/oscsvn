<?php
/*
  $Id: russian.php,v 1.1.1.1 2003/09/18 19:04:27 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
@setlocale(LC_TIME, 'ru_RU.CP1251');

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%d %B %Y �.'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

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

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'RUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="ru"');

// charset for web pages and emails
define('CHARSET', 'windows-1251');

// page title
define('TITLE', '��������-�������');

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', '�����������');
define('HEADER_TITLE_MY_ACCOUNT', '��� ������');
define('HEADER_TITLE_CART_CONTENTS', '�������');
define('HEADER_TITLE_CHECKOUT', '�������� �����');
define('HEADER_TITLE_TOP', '�������');
define('HEADER_TITLE_CATALOG', '�������');
define('HEADER_TITLE_LOGOFF', '�����');
define('HEADER_TITLE_LOGIN', '��� ������');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', '������� �������� ������� c');

// text for gender
define('MALE', '�������');
define('FEMALE', '�������');
define('MALE_ADDRESS', '�-�');
define('FEMALE_ADDRESS', '�-��');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_SEARCH_TEXT', '������� ����� ��� ������.');
define('BOX_SEARCH_ADVANCED_SEARCH', '����������� �����');

// reviews box text in includes/boxes/reviews.php
define('BOX_REVIEWS_WRITE_REVIEW', '�������� ���� ������ � ������!');
define('BOX_REVIEWS_NO_REVIEWS', '� ���������� ������� ��� �� ������ ������');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s �� 5 ����!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_SHOPPING_CART_EMPTY', '������� �����');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_NOTIFICATIONS_NOTIFY', '�������� ��� � �������� �&nbsp;<b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', '�� ��������� ��� � �������� <b>%s</b>');

// manufacturer box text
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '���� %s');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', '������ ������ ������� �������������');

// information box text in includes/boxes/information.php
define('BOX_INFORMATION_PRIVACY', '������������');
define('BOX_INFORMATION_CONDITIONS', '������� � ��������');
define('BOX_INFORMATION_SHIPPING', '�������� � �������');
define('BOX_INFORMATION_CONTACT', '��������� � ����');

define('BOX_INFORMATION_PRICE_XLS', '�����-���� (Excel)');
define('BOX_INFORMATION_PRICE_HTML', '�����-���� (HTML)');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_TELL_A_FRIEND_TEXT', '�������� ����� ������� � ������� � ����� ��������');

//BEGIN allprods modification
define('BOX_INFORMATION_ALLPRODS', '������ ������ �������');
//END allprods modification

// VJ Links Manager v1.00 begin
define('BOX_INFORMATION_LINKS', '������');
// VJ Links Manager v1.00 end

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', '����� ��������');
define('CHECKOUT_BAR_PAYMENT', '������ ������');
define('CHECKOUT_BAR_CONFIRMATION', '�������������');
define('CHECKOUT_BAR_FINISHED', '����� ��������!');

// pull down default text
define('PULL_DOWN_DEFAULT', '��������');
define('TYPE_BELOW', '����� ����');

// javascript messages
define('JS_ERROR', '������ ��� ���������� �����!\n\n��������� ����������:\n\n');

define('JS_REVIEW_TEXT', '* ���� \'����� ������\' ������ ��������� �� ����� ' . REVIEW_TEXT_MIN_LENGTH . ' ��������.\n');

define('JS_FIRST_NAME', '* ���� \'���\' ������ ��������� �� ����� ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' ��������.\n');
define('JS_LAST_NAME', '* ���� \'�������\' ������ ��������� �� ����� ' . ENTRY_LAST_NAME_MIN_LENGTH . ' ��������.\n');


define('JS_REVIEW_RATING', '* �� �� ������� �������.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* �������� ����� ������ ��� ������ ������.\n');

define('JS_ERROR_SUBMITTED', '��� ����� ��� ���������. ��������� Ok.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', '��������, ����������, ����� ������ ��� ������ ������.');

define('CATEGORY_COMPANY', '�����������');
define('CATEGORY_PERSONAL', '���� ������������ ������');
define('CATEGORY_ADDRESS', '��� �����');
define('CATEGORY_CONTACT', '���������� ����������');
define('CATEGORY_OPTIONS', '��������');
define('CATEGORY_PASSWORD', '��� ������');

define('ENTRY_COMPANY', '�������� ��������:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', '���:');
define('ENTRY_GENDER_ERROR', '�� ������ ������� ���� ���.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', '���:');
define('ENTRY_FIRST_NAME_ERROR', '���� ��� ������ ��������� ��� ������� ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' �������.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', '�������:');
define('ENTRY_LAST_NAME_ERROR', '���� ������� ������ ��������� ��� ������� ' . ENTRY_LAST_NAME_MIN_LENGTH . ' �������.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', '���� ��������:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '���� �������� ���������� ������� � ��������� �������: DD/MM/YYYY (������ 21/05/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (������ 21/05/1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '���� E-Mail ������ ��������� ��� ������� ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' ��������.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '��� E-Mail ����� ������ �����������, ���������� ��� ���.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '�������� ���� E-Mail ��� ��������������� � ����� ��������, ���������� ������� ������ E-Mail �����.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', '�����:');
define('ENTRY_STREET_ADDRESS_ERROR', '���� ����� � ����� ���� ������ ��������� ��� ������� ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' ��������.');
define('ENTRY_STREET_ADDRESS_TEXT', '* ������: ��. ���� 346, ��. 78');
define('ENTRY_SUBURB', '�����:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', '�������� ������:');
define('ENTRY_POST_CODE_ERROR', '���� �������� ������ ������ ��������� ��� ������� ' . ENTRY_POSTCODE_MIN_LENGTH . ' �������.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', '�����:');
define('ENTRY_CITY_ERROR', '���� ����� ������ ��������� ��� ������� ' . ENTRY_CITY_MIN_LENGTH . ' �������.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', '������:');
define('ENTRY_STATE_ERROR', '���� ������� ������ ��������� ��� ������� ' . ENTRY_STATE_MIN_LENGTH . ' �������.');
define('ENTRY_STATE_ERROR_SELECT', '�������� �������.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', '������:');
define('ENTRY_COUNTRY_ERROR', '�������� ������.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', '�������:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '���� ������� ������ ��������� ��� ������� ' . ENTRY_TELEPHONE_MIN_LENGTH . ' �������.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', '����:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', '�������� ���������� � �������, ������, ��������:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', '�����������');
define('ENTRY_NEWSLETTER_NO', '���������� �� ��������');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', '������:');
define('ENTRY_PASSWORD_ERROR', '��� ������ ������ ��������� ��� ������� ' . ENTRY_PASSWORD_MIN_LENGTH . ' ��������.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', '���� ����������� ������ ������ ��������� � ����� ������.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', '����������� ������:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', '������� ������:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', '���� ������ ������ ��������� ��� ������� ' . ENTRY_PASSWORD_MIN_LENGTH . ' ��������.');
define('ENTRY_PASSWORD_NEW', '����� ������:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', '��� ����� ������ ������ ��������� ��� ������� ' . ENTRY_PASSWORD_MIN_LENGTH . ' ��������.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', '���� ����������� ������ � ����� ������ ������ ���������.');
define('PASSWORD_HIDDEN', '--�����--');

define('FORM_REQUIRED_INFORMATION', '* ����������� ��� ����������');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', '��������:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �������)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �������)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �������)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �������)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ����������� �����������)');
define('TEXT_DISPLAY_NUMBER_OF_FEATURED', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ������������� �������)');

define('PREVNEXT_TITLE_FIRST_PAGE', '������ ��������');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', '����������');
define('PREVNEXT_TITLE_NEXT_PAGE', '��������� ��������');
define('PREVNEXT_TITLE_LAST_PAGE', '��������� ��������');
define('PREVNEXT_TITLE_PAGE_NO', '�������� %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', '���������� %d �������');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', '��������� %d �������');
define('PREVNEXT_BUTTON_FIRST', '������');
define('PREVNEXT_BUTTON_PREV', '����������');
define('PREVNEXT_BUTTON_NEXT', '���������');
define('PREVNEXT_BUTTON_LAST', '���������');

define('IMAGE_BUTTON_ADD_ADDRESS', '�������� �����');
define('IMAGE_BUTTON_ADDRESS_BOOK', '�������� �����');
define('IMAGE_BUTTON_BACK', '�����');
define('IMAGE_BUTTON_BUY_NOW', '������ ������');
define('IMAGE_BUTTON_CHANGE_ADDRESS', '�������� �����');
define('IMAGE_BUTTON_CHECKOUT', '�������� �����');
define('IMAGE_BUTTON_CONFIRM_ORDER', '����������� �����');
define('IMAGE_BUTTON_CONTINUE', '����������');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', '��������� � �������');
define('IMAGE_BUTTON_DELETE', '�������');
define('IMAGE_BUTTON_EDIT_ACCOUNT', '������������� ������� ������');
define('IMAGE_BUTTON_HISTORY', '������� �������');
define('IMAGE_BUTTON_LOGIN', '�����');
define('IMAGE_BUTTON_IN_CART', '�������� � �������');
define('IMAGE_BUTTON_NOTIFICATIONS', '�����������');
define('IMAGE_BUTTON_QUICK_FIND', '������� �����');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', '������� �����������');
define('IMAGE_BUTTON_REVIEWS', '������');
define('IMAGE_BUTTON_SEARCH', '������');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', '������� ��������');
define('IMAGE_BUTTON_TELL_A_FRIEND', '�������� �����'); 
define('IMAGE_BUTTON_UPDATE', '��������');
define('IMAGE_BUTTON_UPDATE_CART', '�����������');
define('IMAGE_BUTTON_WRITE_REVIEW', '�������� �����');
define('IMAGE_REDEEM_VOUCHER', '���������');

define('SMALL_IMAGE_BUTTON_DELETE', '�������');
define('SMALL_IMAGE_BUTTON_EDIT', '��������');
define('SMALL_IMAGE_BUTTON_VIEW', '��������');

define('ICON_ARROW_RIGHT', '�������');
define('ICON_CART', '� �������');
define('ICON_ERROR', '������');
define('ICON_SUCCESS', '���������');
define('ICON_WARNING', '��������');

define('TEXT_GREETING_PERSONAL', '����� ����������, <span class="greetUser">%s!</span> �� ������ ���������� ����� <a href="%s"><u>����� ������</u></a> ��������� � ��� �������?');
define('TEXT_CUSTOMER_GREETING_HEADER', '����� ����������!');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>���� �� �� %s, ����������, <a href="%s"><u>�������</u></a> ���� ������ ��� �����.</small>');
define('TEXT_GREETING_GUEST', '����� ����������, <span class="greetUser">��������� �����!</span><br> ���� �� ��� ���������� ������, <a href="%s"><u>������� ���� ������������ ������</u></a> ��� �����. ���� �� � ��� ������� � ������ ������� �������, ��� ���������� <a href="%s"><u>������������������</u></a>.');

define('TEXT_SORT_PRODUCTS', '���������� ');
define('TEXT_DESCENDINGLY', '�� ��������');
define('TEXT_ASCENDINGLY', '�� �����������');
define('TEXT_BY', ', ������� ');

define('TEXT_REVIEW_BY', '- %s');
define('TEXT_REVIEW_WORD_COUNT', '%s �����');
define('TEXT_REVIEW_RATING', '�������: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', '���� ����������: %s');
define('TEXT_NO_REVIEWS', '� ���������� ������� ��� �������, �� ������ ����� ������.');

define('TEXT_NO_NEW_PRODUCTS', '������� ��� ����� ���������.');

define('TEXT_NO_PRODUCTS', '�� ������ ������ �� �������.');

define('TEXT_UNKNOWN_TAX_RATE', '���������� ��������� ������');

define('TEXT_REQUIRED', '<span class="errorText">�����������</span>');

// Down For Maintenance
define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', '��������: ������� ������ �� ����������� �������� ��: ');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', '��������: ������� ������ �� ����������� ��������');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>������:</small> ���������� ��������� email ����� ������ SMTP. ���������, ����������, ���� ��������� php.ini � ���� ����������, �������������� ������ SMTP.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', '��������������: �� ������� ���������� ��������� ��������: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/install. ����������, ������� ��� ���������� ��� ������������.');
define('WARNING_CONFIG_FILE_WRITEABLE', '��������������: ���� ������������ �������� ��� ������: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php. ��� - ������������� ���� ������������ - ����������, ���������� ����������� ����� ������� � ����� �����.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', '��������������: ���������� ������ �� ����������: ' . tep_session_save_path() . '. ������ �� ����� �������� ���� ��� ���������� �� ����� �������.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', '��������������: ��� ������� � �������� ������: ' . tep_session_save_path() . '. ������ �� ����� �������� ���� �� ����������� ����������� ����� �������.');
define('WARNING_SESSION_AUTO_START', '��������������: ����� session.auto_start �������� - ����������, ��������� ������ ����� � ����� php.ini � ������������� ���-������.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', '��������������: ���������� �����������: ' . DIR_FS_DOWNLOAD . '. �������� ����������.');


define('TEXT_CCVAL_ERROR_INVALID_DATE', '�� ������� �������� ���� ��������� ����� �������� ��������� ��������. ���������� ��� ���.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', '�� ������� �������� ����� ��������� ��������. ���������� ��� ���.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', '������ ����� ����� ��������� ��������: %s ���� �� ������� ����� ����� ��������� �������� ���������, �������� ���, ��� �� �� ��������� � ������ ������ ��� ��������� ��������. ���� �� ������� ����� ��������� �������� �������, ���������� ��� ���.');

/*
  The following copyright announcement can only be
  appropriately modified or removed if the layout of
  the site theme has been modified to distinguish
  itself from the default Chainreaction-copyrighted
  theme.

  For more information please read the following
  Frequently Asked Questions entry on the osCommerce
  support site:

  http://www.oscommerce.com/community.php/faq,26/q,50

  Please leave this comment intact together with the
  following copyright announcement.
*/
define('FOOTER_TEXT_BODY', '<center>
<span class="smallText">
<a href="http://kypi.ru" target="_blank">������� ��������-��������</a> <a href="http://kypi.ru" target="_blank">osCommerce VaM Edition ������ ' . implode('', file(DIR_FS_CATALOG .'VERSION.txt')) . '</a><br>
<a href="rss2_info.php"><img src="images/rss.png" width="36" height="14" alt="RSS ������" border="0"></a><br>
</span>
</center>');
require(DIR_WS_LANGUAGES . 'add_ccgvdc_russian.php');
/////////////////////////////////////////////////////////////////////
// HEADER.PHP
// Header Links
define('HEADER_LINKS_DEFAULT','������');
define('HEADER_LINKS_WHATS_NEW','�������');
define('HEADER_LINKS_SPECIALS','������');
define('HEADER_LINKS_REVIEWS','������');
define('HEADER_LINKS_LOGIN','�����');
define('HEADER_LINKS_LOGOFF','�����');
define('HEADER_LINKS_PRODUCTS_ALL','�������');
define('HEADER_LINKS_ACCOUNT_INFO','���� ������');
define('HEADER_LINKS_CHECKOUT','�������� �����');
define('HEADER_LINKS_CART','�������');
define('HEADER_LINKS_DVD', '������� �������');

/////////////////////////////////////////////////////////////////////

// BOF: Lango added for print order mod
define('IMAGE_BUTTON_PRINT_ORDER', '������ ��� ������');
// EOF: Lango added for print order mod

// WebMakers.com Added: Attributes Sorter
require(DIR_WS_LANGUAGES . $language . '/' . 'attributes_sorter.php');

define('BOX_LOGINBOX_HEADING', '����');
define('BOX_LOGINBOX_EMAIL', 'E-Mail:');
define('BOX_LOGINBOX_PASSWORD', '������:');
define('IMAGE_BUTTON_LOGIN', '�����');

define('BOX_HEADING_LOGIN_BOX_MY_ACCOUNT','��� ������');
define('LOGIN_BOX_ACCOUNT_EDIT','�������� ������');
define('LOGIN_BOX_ACCOUNT_HISTORY','������� �������');
define('LOGIN_BOX_ADDRESS_BOOK','�������� �����');
define('LOGIN_BOX_PRODUCT_NOTIFICATIONS','�����������');
define('LOGIN_BOX_MY_ACCOUNT','��� ������');
define('LOGIN_BOX_LOGOFF','�����');


// VJ Guestbook for OSC v1.0 begin
define('BOX_INFORMATION_GUESTBOOK', '�������� �����');
// VJ Guestbook for OSC v1.0 end

// VJ Guestbook for OSC v1.0 begin
define('GUESTBOOK_TEXT_MIN_LENGTH', '10'); //[TODO] move to config db table
define('JS_GUESTBOOK_TEXT', '* ���� \'���� ���������\' ������ ��������� ��� ������� ' . GUESTBOOK_TEXT_MIN_LENGTH . ' ��������.\n');
define('JS_GUESTBOOK_NAME', '* �� ������ ��������� ���� \'���� ���\'.\n');
// VJ Guestbook for OSC v1.0 end

// VJ Guestbook for OSC v1.0 begin
define('TEXT_DISPLAY_NUMBER_OF_GUESTBOOK_ENTRIES', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �������)');
// VJ Guestbook for OSC v1.0 end

// VJ Guestbook for OSC v1.0 begin
define('IMAGE_BUTTON_SIGN_GUESTBOOK', '�������� ������');
// VJ Guestbook for OSC v1.0 end

// VJ Guestbook for OSC v1.0 begin
define('TEXT_GUESTBOOK_DATE_ADDED', '����: %s');
define('TEXT_NO_GUESTBOOK_ENTRY', '���� ��� �� ����� ������ � �������� �����. ������ �������!');
// VJ Guestbook for OSC v1.0 end

define('DISCOUNT_HEADING', '������');

define('HELP', '<a href="http://web.icq.com/whitepages/message_me/1,,,00.icq?uin=' . STORE_OWNER_ICQ_NUMBER . '&action=message" target="_blank"><img src="http://status.icq.com/online.gif?icq=' . STORE_OWNER_ICQ_NUMBER . '&img=26" title="������ ICQ" align="absmiddle" border="0">' . STORE_OWNER_ICQ_NUMBER . '</a>
<br>
');

define('ICQ', 'ICQ:<br>');
define('TEXT_MORE_INFO', '���������...');

// Article Manager
define('BOX_ALL_ARTICLES', '��� ������');
define('BOX_NEW_ARTICLES', '����� ������');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ������)');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES_NEW', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ����� ������)');
define('TABLE_HEADING_AUTHOR', '�����');
define('TABLE_HEADING_ABSTRACT', '������');
define('BOX_HEADING_AUTHORS', '������ ������');
define('NAVBAR_TITLE_DEFAULT', '������');

define('TABLE_HEADING_INFO','������� ��������');

//TotalB2B start
define('PRICES_LOGGED_IN_TEXT','������� � �������, ����� ������� ����!');
//TotalB2B end

define('PRODUCTS_ORDER_QTY_TEXT','����������: ');
define('PRODUCTS_ORDER_QTY_MIN_TEXT','<br>' . ' �������: ');
define('PRODUCTS_ORDER_QTY_MIN_TEXT_INFO','������� ������ ��� ������: '); // order_detail.php
define('PRODUCTS_ORDER_QTY_MIN_TEXT_CART','������� ������ ��� ������: '); // order_detail.php
define('PRODUCTS_ORDER_QTY_MIN_TEXT_CART_SHORT',' �������: '); // order_detail.php
define('PRODUCTS_ORDER_QTY_UNIT_TEXT',', ���: ');
define('PRODUCTS_ORDER_QTY_UNIT_TEXT_INFO','���: '); // order_detail.php
define('PRODUCTS_ORDER_QTY_UNIT_TEXT_CART','���: '); // order_detail.php
define('PRODUCTS_ORDER_QTY_UNIT_TEXT_CART_SHORT',' ���: '); // order_detail.php
define('ERROR_PRODUCTS_QUANTITY_ORDER_MIN_TEXT','');
define('ERROR_PRODUCTS_QUANTITY_INVALID','�� ��������� �������� � ������� �������� ���������� ������: ');
define('ERROR_PRODUCTS_QUANTITY_ORDER_UNITS_TEXT','');
define('ERROR_PRODUCTS_UNITS_INVALID','�� ��������� �������� � ������� �������� ���������� ������: ');

// Poll Box Text
define('_RESULTS', '����������');
define('_VOTE', '����������');
define('_COMMENTS','�������:');
define('_VOTES', '�������:');
define('_NOPOLLS','��� �������');
define('_NOPOLLSCONTENT','�� ������ ������ ��� �� ������ ��������� ������, �� ������ ���������� ���������� ���� ������������� ����� �������.<br><br><a href="pollbooth.php">['._POLLS.']');

define('IMAGE_BUTTON_PREVIOUS', '���������� �����');
define('IMAGE_BUTTON_NEXT', '��������� �����');
define('IMAGE_BUTTON_RETURN_TO_PRODUCT_LIST', '��������� � ������ �������');
define('PREV_NEXT_PRODUCT', '����� ');
define('PREV_NEXT_PRODUCT1', ' �� ');
define('PREV_NEXT_CAT', ' ��������� ');
define('PREV_NEXT_MB', ' ������������� ');

define('BOX_TEXT_DOWNLOAD', '���� ��������: ');
define('BOX_DOWNLOAD_DOWNLOAD', '��������� �����');
define('BOX_TEXT_DOWNLOAD_NOW', '���������');

// ������� �������� ������ 

define('BOX_HEADING_CATEGORIES', '�������');
define('BOX_HEADING_INFORMATION', '����������');
define('BOX_HEADING_TEMPLATE_SELECT', '����� �������');
define('BOX_HEADING_MANUFACTURERS', '�������������');
define('BOX_HEADING_SPECIALS', '������');
define('BOX_HEADING_NEWSDESK_LATEST', '��������� �������');
define('BOX_HEADING_SEARCH', '�����');
define('BOX_HEADING_WHATS_NEW', '�������');
define('BOX_HEADING_LANGUAGES', '����');
define('BOX_HEADING_NEWSBOX', '�������');
define('BOX_HEADING_FEATURED', '�������������');
define('BOX_HEADING_SHOP_BY_PRICE', '���������� �� ����');
define('BOX_HEADING_NEWSDESK_CATEGORIES', '�������');
define('BOX_HEADING_ARTICLES', '������');
define('BOX_HEADING_AUTHORS', '������');
define('BOX_HEADING_LINKS', '����� ��������');
define('BOX_HEADING_SHOPPING_CART', '�������');
define('BOX_HEADING_DOWNLOAD', '�����');
define('BOX_HEADING_LOGIN', '����');
define('HELP_HEADING', '�����������');
define('BOX_HEADING_WISHLIST', '���������� ������');
define('BOX_HEADING_REVIEWS', '������');
define('BOX_HEADING_CUSTOMER_ORDERS', '������� �������');
define('BOX_HEADING_AFFILIATE', '��������� � ����');
define('BOX_HEADING_MANUFACTURER_INFO', '�������������');
define('BOX_HEADING_BESTSELLERS', '������ ������');
define('BOX_HEADING_TELL_A_FRIEND', '���������� �����');
define('BOX_HEADING_NOTIFICATIONS', '�����������');
define('BOX_HEADING_CURRENCIES', '������');
define('BOX_HEADING_FAQDESK_CATEGORIES', 'FAQ');
define('BOX_HEADING_FAQDESK_LATEST', '��������� FAQ');
define('_POLLS', '������');

// ������� � ��������� �������� � �������
  define('SHIPPING_OPTIONS', '������� � ��������� ��������:');
  if (strstr($PHP_SELF,'shopping_cart.php')) {
    define('SHIPPING_OPTIONS_LOGIN', '����������, <a href="' . tep_href_link(FILENAME_LOGIN, '', 'SSL') . '"><u>�������</u></a> � �������, ����� ������� ������ ��������� �������� ������ ������.');
  } else {
    define('SHIPPING_OPTIONS_LOGIN', '����������, ������� � �������, ����� ������� ������� � ��������� �������� ������ ������.');
  }
  define('SHIPPING_METHOD_TEXT','������� ��������:');
  define('SHIPPING_METHOD_RATES','���������:');
  define('SHIPPING_METHOD_TO','����� ��������: ');
  define('SHIPPING_METHOD_TO_NOLOGIN', '����� ��������: <a href="' . tep_href_link(FILENAME_LOGIN, '', 'SSL') . '"><u>�������</u></a>');
  define('SHIPPING_METHOD_FREE_TEXT','���������� ��������');
  define('SHIPPING_METHOD_ALL_DOWNLOADS','- ����������');
  define('SHIPPING_METHOD_RECALCULATE','����������');
  define('SHIPPING_METHOD_ZIP_REQUIRED','true');
  define('SHIPPING_METHOD_ADDRESS','�����:');
  define('SHIPPING_METHOD_QTY','���������� ������: ');
  define('SHIPPING_METHOD_WEIGHT','��� ������: ');
  define('SHIPPING_METHOD_WEIGHT1',' ��.');

  define('LOW_STOCK_TEXT1','����� �� ������ �������������: ');
  define('LOW_STOCK_TEXT2','��� ������: ');
  define('LOW_STOCK_TEXT3','������� ����������: ');
  define('LOW_STOCK_TEXT4','������ �� �����: ');
  define('LOW_STOCK_TEXT5','������� �������� ���������� ����� ���������� ������ �� ������: ');

// wishlist box text in includes/boxes/wishlist.php
  define('BOX_HEADING_CUSTOMER_WISHLIST', '���������� ������');
  define('TEXT_WISHLIST_COUNT', '�� ������ ������ �������� �������: %s.');

  define('BOX_TEXT_VIEW', '��������');
  define('BOX_TEXT_HELP', '������');
  define('BOX_WISHLIST_EMPTY', '��� ���������� �������.');
  define('BOX_TEXT_NO_ITEMS', '��� ���������� �������.');
  define('IMAGE_BUTTON_ADD_WISHLIST', '��������');

  define('TEXT_VERSION', '������ ������: ');
  define('TOTAL_QUERIES', '����� ��������: ');
  define('TOTAL_TIME', '����� ����������: ');

// otf 1.71 defines needed for Product Option Type feature.
  define('PRODUCTS_OPTIONS_TYPE_SELECT', 0);
  define('PRODUCTS_OPTIONS_TYPE_TEXT', 1);
  define('PRODUCTS_OPTIONS_TYPE_RADIO', 2);
  define('PRODUCTS_OPTIONS_TYPE_CHECKBOX', 3);
  define('PRODUCTS_OPTIONS_TYPE_TEXTAREA', 4);
  define('TEXT_PREFIX', 'txt_');
  define('PRODUCTS_OPTIONS_VALUE_TEXT_ID', 0);  //Must match id for user defined "TEXT" value in db table TABLE_PRODUCTS_OPTIONS_VALUES


//include('includes/languages/english_support.php');
include(DIR_WS_LANGUAGES .$language.'_newsdesk.php');
include(DIR_WS_LANGUAGES .$language.'_faqdesk.php');

define('ENTRY_EXTRA_FIELDS_ERROR','���� %s ������ ��������� ��� ������� %d ��������');
define('CATEGORY_EXTRA_FIELDS', '�������������� ����������');
define('PRODUCT_EXTRA_FIELDS', '�������������� ���������� � ������');

define('TEXT_DISCOUNT', '���� ������: ');

define('NO_REVIEWS_TEXT', '�� ������ ������ ��� �� ������ ������.'); define('BOX_REVIEWS_HEADER_TEXT', '������'); 
define('TEXT_VIEW_ALL_REVIEWS', '�������� ��� ������');

define('ENTRY_CAPTCHA_ERROR', '�� ����������� ������� ��� �� ��������.');

define('TEXT_PXSELL_ARTICLES', '������������� ������:'); 

define('TEXT_ALL', '���'); 

define('TEXT_XSEEL_CART_RECOMMENDED', '������������� ������'); 
define('TEXT_XSEEL_CART_UPDATE', '����� �������� ������������� ����� � �������, �������� ����� � ������� "��������"'); 

// Start Products Specifications
// Products Filter box text in includes/boxes/products_filter.php
define('BOX_HEADING_PRODUCTS_FILTER', '�������');
define('TEXT_SHOW_ALL', '�������� ���');
define('TEXT_FIND_PRODUCTS', '����� ���������� ������');
// End Products Specifications

// Products Specifications
define('TEXT_NOT_AVAILABLE', '��� ������');

define('TEXT_DISPLAY_ALL_PRODUCTS', '�������� �� ����� ��������');
define('TEXT_DISPLAY_BY_PAGES', '������� �� ��������');

?>