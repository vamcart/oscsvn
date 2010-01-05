<?php
/*
  $Id: orders.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', '������ �������');
define('HEADING_TITLE_SEARCH', '����� �� ID ������');
define('HEADING_TITLE_STATUS', '���������:');

define('TABLE_HEADING_COMMENTS', '�����������');
define('TABLE_HEADING_CUSTOMERS', '�������');
define('TABLE_HEADING_ORDER_TOTAL', '����� �����');
define('TABLE_HEADING_DATE_PURCHASED', '���� �������');
define('TABLE_HEADING_STATUS', '���������');
define('TABLE_HEADING_ACTION', '��������');
define('TABLE_HEADING_QUANTITY', '����������');
define('TABLE_HEADING_PRODUCTS_MODEL', '��� ������');
define('TABLE_HEADING_PRODUCTS', '������');
define('TABLE_HEADING_TAX', '�����');
define('TABLE_HEADING_TOTAL', '�����');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', '���� (�� ������� �����)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', '����');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', '����� (�� ������� �����)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', '�����');

define('TABLE_HEADING_STATUS', '������');
define('TABLE_HEADING_DATE_ADDED', '���� ����������');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', '������ ��������');

define('ENTRY_CUSTOMER', '������:');
define('ENTRY_SOLD_TO', '����������:');
define('ENTRY_DELIVERY_TO', '�����:');
define('ENTRY_SHIP_TO', '����� ��������:');
define('ENTRY_SHIPPING_ADDRESS', '����� ��������:');
define('ENTRY_BILLING_ADDRESS', '����� ����������:');
define('ENTRY_PAYMENT_METHOD', '������ ������:');
define('ENTRY_CREDIT_CARD_TYPE', '��� ��������� ��������:');
define('ENTRY_CREDIT_CARD_OWNER', '�������� ��������� ��������:');
define('ENTRY_CREDIT_CARD_NUMBER', '����� ��������� ��������:');
define('ENTRY_CREDIT_CARD_EXPIRES', '���� ��������� �������� ��������� ��������:');
define('ENTRY_SUB_TOTAL', '��������������� ����:');
define('ENTRY_TAX', '�����:');
define('ENTRY_SHIPPING', '��������:');
define('ENTRY_TOTAL', '�����:');
define('ENTRY_DATE_PURCHASED', '���� �������:');
define('ENTRY_STATUS', '���������:');
define('ENTRY_DATE_LAST_UPDATED', '��������� ���������:');
define('ENTRY_NOTIFY_CUSTOMER', '��������� �������:'); 
define('ENTRY_NOTIFY_COMMENTS', '�������� �����������:');
define('ENTRY_PRINTABLE', '���������� ����');

define('TEXT_INFO_HEADING_DELETE_ORDER', '������� �����');
define('TEXT_INFO_DELETE_INTRO', '�� ������������� ������ ������� ���� �����?');
define('TEXT_INFO_DELETE_DATA', '����������:');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', '����������� ���������� ������ �� ������');
define('TEXT_INFO_DELETE_DATA_OID', '����� ������:');
define('TEXT_DATE_ORDER_CREATED', '���� ��������:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', '��������� ���������:');
define('TEXT_INFO_PAYMENT_METHOD', '������ ������:');

define('TEXT_ALL_ORDERS', '��� ������');
define('TEXT_NO_ORDER_HISTORY', '������� ������ �����������');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', '������ ������ ������ ������');
define('EMAIL_TEXT_ORDER_NUMBER', '����� ������:');
define('EMAIL_TEXT_INVOICE_URL', '���������� � ������:');
define('EMAIL_TEXT_DATE_ORDERED', '���� ������:');
define('EMAIL_TEXT_STATUS_UPDATE', '������ ������ ������ ������.' . "\n\n" . '����� ������: %s' . "\n\n" . '���� � ��� �������� �������, ������ ������� ��� �� � �������� ������.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', '����������� � ������ ������' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', '������: ����� �� ����������.');
define('SUCCESS_ORDER_UPDATED', '���������: ����� ������� �������.');
define('WARNING_ORDER_NOT_UPDATED', '��������: �������� ������. ����� �� �������.');
// denuz
define('TABLE_HEADING_ORDER_NETTO', '�����');
define('TABLE_HEADING_ORDER_NUMBER', '�����');
define('TABLE_HEADING_ORDER_MARJA', '�����');
define('TITLE_ORDER_NETTO', '�����:');
define('TITLE_ORDER_MARJA', '�����:');
define('TEXT_TOTAL', '�����: ');
define('TEXT_NETTO', '�����: ');
define('TEXT_MARJA', '�����: ');
// eof denuz
define('EMAIL_TEXT_CUSTOMER_NAME', '����������:');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'Email:');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', '�������:');
define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', '���� �� ����� �������� ������ ������� ������������� ������ � ��� �������� � ����� ������. ' . "\n\n" . '������:');
define('EMAIL_TEXT_LIMIT', '����������� ������: ');
define('EMAIL_TEXT_CURRENT_GROUP', '����� ������: ');
define('EMAIL_TEXT_DISCOUNT', '����� ������: ');
define('EMAIL_ACC_SUBJECT', '������������� ������');
define('EMAIL_ACC_INTRO_CUSTOMER', '�����������, �� �������� ����� ������������� ������. ��� ������ ����:');
define('EMAIL_ACC_FOOTER', '���� � ��� ���� �������, ������� ��� �� � �������� ������.');

define('TEXT_REFERER', '������ ������: ');
define('TEXT_ORDER_DELETE', '�������: ');
define('TEXT_ORDER_DELETE_CONFIRM1', '�� ������������� ������ ������� ');
define('TEXT_ORDER_DELETE_CONFIRM2', '?');

define('TEXT_ORDER_SUMMARY','����������');
define('TEXT_ORDER_PAYMENT','������ / ��������');
define('TEXT_ORDER_PRODUCTS','������');
define('TEXT_ORDER_STATUS','������');

define('BUS_HEADING_TITLE','����� �������');
define('BUS_TEXT_NEW_STATUS', '�������� ����� ������');
define('BUS_NOTIFY_CUSTOMERS', '��������� ���������� (��)');
define('BUS_SELECT_ALL', '������� ���');
define('BUS_SELECT_NONE', '����� ���������');
define('BUS_SUBMIT', '��������');
define('BUS_SUCCESS','��������� ������ ���������!');
define('BUS_WARNING','��������� ������ �� ���������!');
define('BUS_DELETE_SUCCESS','��������� ������ �������!');
define('BUS_DELETE_WARNING','��������� ������ �� �������!');
define('BUS_DELETE_ORDERS','������� ��������� ������');

?>