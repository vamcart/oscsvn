<?php
/*
  $Id: edit_orders.php v5.0 08/05/2007 djmonkey1 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', '�������������� ������ ����� %s �� %s');
define('ADDING_TITLE', '��������� ����� � ������ ����� %s');

define('ENTRY_UPDATE_TO_CC', '(�������� ������ ������ �� ' . ORDER_EDITOR_CREDIT_CARD . ' ��� ��������� ����� � ����������� � ��������� ��������.)');
define('TABLE_HEADING_COMMENTS', '�����������');
define('TABLE_HEADING_STATUS', '������');
define('TABLE_HEADING_NEW_STATUS', '����� ������');
define('TABLE_HEADING_ACTION', '��������');
define('TABLE_HEADING_DELETE', '�������?');
define('TABLE_HEADING_QUANTITY', '����������');
define('TABLE_HEADING_PRODUCTS_MODEL', '���');
define('TABLE_HEADING_PRODUCTS', '������');
define('TABLE_HEADING_TAX', '�����');
define('TABLE_HEADING_TOTAL', '�����');
define('TABLE_HEADING_BASE_PRICE', '����<br>(�� �������)');
define('TABLE_HEADING_UNIT_PRICE', '����<br>(��� ������)');
define('TABLE_HEADING_UNIT_PRICE_TAXED', '����<br>(� �������)');
define('TABLE_HEADING_TOTAL_PRICE', '�����<br>(��� ������)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', '�����<br>(� �������)');
define('TABLE_HEADING_OT_TOTALS', '����� ������:');
define('TABLE_HEADING_OT_VALUES', '��������:');
define('TABLE_HEADING_SHIPPING_QUOTES', '��������:');
define('TABLE_HEADING_NO_SHIPPING_QUOTES', '��� ����������!');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', '���������� ��������');
define('TABLE_HEADING_DATE_ADDED', '����');

define('ENTRY_CUSTOMER', '����������');
define('ENTRY_NAME', '���:');
define('ENTRY_CITY_STATE', '�����:');
define('ENTRY_SHIPPING_ADDRESS', '����� ��������');
define('ENTRY_BILLING_ADDRESS', '����� ����������');
define('ENTRY_PAYMENT_METHOD', '������ ������');
define('ENTRY_CREDIT_CARD_TYPE', '��� ��������:');
define('ENTRY_CREDIT_CARD_OWNER', '�������� ��������:');
define('ENTRY_CREDIT_CARD_NUMBER', '����� ��������:');
define('ENTRY_CREDIT_CARD_EXPIRES', '������������� ��:');
define('ENTRY_SUB_TOTAL', '��������� ������:');

//the definition of ENTRY_TAX is important when dealing with certain tax components and scenarios
define('ENTRY_TAX', '�����');
//do not use a colon (:) in the defintion, ie 'VAT' is ok, but 'VAT:' is not

define('ENTRY_SHIPPING', '��������:');
define('ENTRY_TOTAL', '�����:');
define('ENTRY_STATUS', '������:');
define('ENTRY_NOTIFY_CUSTOMER', '��������� ����������:');
define('ENTRY_NOTIFY_COMMENTS', '��������� �����������:');
define('ENTRY_CURRENCY_TYPE', '������');
define('ENTRY_CURRENCY_VALUE', '��������');

define('TEXT_INFO_PAYMENT_METHOD', '������ ������:');
define('TEXT_NO_ORDER_PRODUCTS', '� ������ ������ ��� �������');
define('TEXT_ADD_NEW_PRODUCT', '�������� �����');
define('TEXT_PACKAGE_WEIGHT_COUNT', '���: %s  |  ���������� ������ ������: %s');

define('TEXT_STEP_1', '<b>��� 1:</b>');
define('TEXT_STEP_2', '<b>��� 2:</b>');
define('TEXT_STEP_3', '<b>��� 3:</b>');
define('TEXT_STEP_4', '<b>��� 4:</b>');
define('TEXT_SELECT_CATEGORY', '- �������� ��������� -');
define('TEXT_PRODUCT_SEARCH', '<b>- ��� ������� �������� ����� ��� ������ -</b>');
define('TEXT_ALL_CATEGORIES', '��� ���������/��� ������');
define('TEXT_SELECT_PRODUCT', '- �������� ����� -');
define('TEXT_BUTTON_SELECT_OPTIONS', '�������� ��������');
define('TEXT_BUTTON_SELECT_CATEGORY', '������� ������ ���������');
define('TEXT_BUTTON_SELECT_PRODUCT', '������� ������ �����');
define('TEXT_SKIP_NO_OPTIONS', '<em>��� ��������� - ���������...</em>');
define('TEXT_QUANTITY', '����������:');
define('TEXT_BUTTON_ADD_PRODUCT', '�������� � ������');
define('TEXT_CLOSE_POPUP', '<u>������� ����</u> [x]');
define('TEXT_ADD_PRODUCT_INSTRUCTIONS', '����������� ��������� �����, ����� ����� �������� ���� ����������� �����, ������ �������� ����.');
define('TEXT_PRODUCT_NOT_FOUND', '<b>����� �� ������<b>');
define('TEXT_SHIPPING_SAME_AS_BILLING', '����� �������� � ����� ���������� ���������');
define('TEXT_BILLING_SAME_AS_CUSTOMER', '������ ����������');

define('IMAGE_ADD_NEW_OT', '������� ����� ������ ����� �����');
define('IMAGE_REMOVE_NEW_OT', '������� ������ ������');
define('IMAGE_NEW_ORDER_EMAIL', '��������� e-mail � ����������� � ������');

define('TEXT_NO_ORDER_HISTORY', '��� ������� ������');

define('PLEASE_SELECT', '��������');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', '��� ����� ��� �������');
define('EMAIL_TEXT_ORDER_NUMBER', '����� ������:');
define('EMAIL_TEXT_INVOICE_URL', '��������� ���������� � ������:');
define('EMAIL_TEXT_DATE_ORDERED', '���� ������:');
define('EMAIL_TEXT_STATUS_UPDATE', '������� �� ��� �����!' . "\n\n" . '������ ������ ������ ��� ������.' . "\n\n" . '����� ������: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', '���� � ��� ���� �������, ������� �� ��� � �������� ������.' . "\n\n" . '� ���������, ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', '����������� � ������ ������:' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', '������: ����� %s �� ������.');
define('SUCCESS_ORDER_UPDATED', '�������: ����� ��� ������� �������.');
define('WARNING_ORDER_NOT_UPDATED', '��������������: ������� ��������� ������� �� ����.');

//the hints
define('HINT_UPDATE_TO_CC', '���������� ������ ������ �� ' . ORDER_EDITOR_CREDIT_CARD . ' � �������� ���� � ����������� � ��������� ��������. ������ ���� ����� ������, ���� �� ����� ������ ���������� ������ ������, ������ ������ ��� ��������� �������� ������������ � ������� - ��������� - �������� �������.');
define('HINT_UPDATE_CURRENCY', '��� ����� ������ ������ ����� ����������� ��� �������� ����� ������.');
define('HINT_SHIPPING_ADDRESS', '��� ����� �������, ��������� ������� ��� ������ �� ������� ��������������, ����������� ��� ��� �������� ��������� ������.');
define('HINT_TOTALS', '�� ������ ��������� ������, �������� ������������� ��������. ���� ��������� ������, ����� � ����� ������������� ������.');
define('HINT_PRESS_UPDATE', '������� �������� ��� ���������� �������� ��������.');
define('HINT_BASE_PRICE', '���� (�� �������) - ��� ���� ������� ������ ��� ����� ��������� ������');
define('HINT_PRICE_EXCL', '���� (��� ������) - ��� ���� ������, ���������� � ���� ��������, �� ��� ������');
define('HINT_PRICE_INCL', '���� (� �������) - ��� ���� ������ + �����');
define('HINT_TOTAL_EXCL', '����� (��� ������) - ��� ���� ������ * �� ���������� ������, �� ��� ������.');
define('HINT_TOTAL_INCL', '����� (� �������) - ��� ���� ������ * �� ���������� ������, ������� �����.');
//end hints

//new order confirmation email- this is a separate email from order status update
define('ENTRY_SEND_NEW_ORDER_CONFIRMATION', '��������� E-Mail:');
define('EMAIL_TEXT_DATE_MODIFIED', '����:');
define('EMAIL_TEXT_PRODUCTS', '������');
define('EMAIL_TEXT_DELIVERY_ADDRESS', '����� ��������');
define('EMAIL_TEXT_BILLING_ADDRESS', '����� ����������');
define('EMAIL_TEXT_PAYMENT_METHOD', '������ ������');
// If you want to include extra payment information, enter text below (use <br> for line breaks):
//define('EMAIL_TEXT_PAYMENT_INFO', ''); //why would this be useful???
// If you want to include footer text, enter text below (use <br> for line breaks):
define('EMAIL_TEXT_FOOTER', '');
//end email

//add-on for downloads
define('ENTRY_DOWNLOAD_COUNT', '�������� ');
define('ENTRY_DOWNLOAD_FILENAME', '��� �����');
define('ENTRY_DOWNLOAD_MAXDAYS', '������ ������� (����)');
define('ENTRY_DOWNLOAD_MAXCOUNT', '�������� ��������');

//add-on for Ajax
define('AJAX_CONFIRM_PRODUCT_DELETE', '�� ������������� ������ ������� ������ ����� �� ������?');
define('AJAX_CONFIRM_COMMENT_DELETE', '�� ������������� ������ ������� ������ ����������� �� ������� ������?');
define('AJAX_MESSAGE_STACK_SUCCESS', '���������! \' + %s + \' ���������');
define('AJAX_CONFIRM_RELOAD_TOTALS', '�� �������� ���������� � ��������. ������ ����� ���� ����������� �������� ����� ������?');
define('AJAX_CANNOT_CREATE_XMLHTTP', '�� ���� ������� XMLHTTP');
define('AJAX_SUBMIT_COMMENT', '�������� ����� ����������� �/��� ������');
define('AJAX_NO_QUOTES', '��� ����������.');
define('AJAX_SELECTED_NO_SHIPPING', '�� ������� ����� ������ ��������, ������ ����� ���� ����������� �������� ����� ������?');
define('AJAX_RELOAD_TOTALS', '����� ������� ���� ��������� � �����, �� �������� ����� �� ���� �����������. ������� ��������.');
define('AJAX_NEW_ORDER_EMAIL', '�� ������������� ������ ��������� e-mail ���������� � ����������� � ��������� ���������� � ������?');
define('AJAX_INPUT_NEW_EMAIL_COMMENTS', '������� �����������, ���� �������� ���� ������, ���� �� ������ ��������� �����������. ������� enter, �� ���������� �������� �����.');
define('AJAX_SUCCESS_EMAIL_SENT', '���������! ���������� � ������ ���������� %s');
define('AJAX_WORKING', '��������, ����������, ���������....');

define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', '���� �� ����� �������� ������ ������� ������������� ������ � ��� ��������� � ����� ������. ' . "\n\n" . '������:');
define('EMAIL_TEXT_LIMIT', '����������� ������: ');
define('EMAIL_TEXT_CURRENT_GROUP', '����� ������: ');
define('EMAIL_TEXT_DISCOUNT', '������: ');
define('EMAIL_ACC_SUBJECT', '������������� ������');
define('EMAIL_ACC_INTRO_CUSTOMER', '�����������, �� �������� ����� ������������� ������. ��� ������ ����:');
define('EMAIL_ACC_FOOTER', '������ �� ������ ����������, ����� ������� � ����� ��������-��������.');

define('EMAIL_TEXT_CUSTOMER_NAME', '����������:');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'Email:');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', '�������:');

define('TEXT_ORDER_COMMENTS', '����������� � ������');

define('ENTRY_TYPE_BELOW', '��������'); 
define('ERROR_NO_ORDER_SELECTED', '�� �� ������� ����� ��� ��������������, ���� �� ������ ID ����� ������ ��� ��������������.');

?>