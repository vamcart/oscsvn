<?php
/*
  $Id: order_edit_english.php,v 1.1 2003/09/24 14:33:18 wilt Exp $

  
  Contribution based on:
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License
*/

// pull down default text
define('PULL_DOWN_DEFAULT', '��������');
define('TYPE_BELOW', '�������� ����');

define('JS_ERROR', '������ ��� ���������� �����!\n\n��������� ����������:\n\n');

define('JS_GENDER', '* �� ������ ������� ���� ���.\n');
define('JS_FIRST_NAME', '* ���� ��� ������ ��������� ��� ������� ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' �������.\n');
define('JS_LAST_NAME', '* ���� ������� ������ ��������� ��� ������� ' . ENTRY_LAST_NAME_MIN_LENGTH . ' �������.\n');
define('JS_DOB', '* ���� �������� ���������� ������� � ��������� �������: MM/DD/YYYY (������ 05/21/1970)\n');
define('JS_EMAIL_ADDRESS', '* ���� E-Mail ������ ��������� ��� ������� ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' ��������.\n');
define('JS_ADDRESS', '* ���� ����� � ����� ���� ������ ��������� ��� ������� ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' ��������.\n');
define('JS_POST_CODE', '* ���� �������� ������ ������ ��������� ��� ������� ' . ENTRY_POSTCODE_MIN_LENGTH . ' �������.\n');
define('JS_CITY', '* ���� ����� ������ ��������� ��� ������� ' . ENTRY_CITY_MIN_LENGTH . ' �������.\n');
define('JS_STATE', '* ���� ����� ������ ���� ���������.\n');
define('JS_STATE_SELECT', '-- �������� ���� --');
define('JS_ZONE', '* ���� ������ ������ ���� ���������.\n');
define('JS_COUNTRY', '* ���� ����� ������ ���� ���������.\n');
define('JS_TELEPHONE', '* ���� ������� ������ ��������� ��� ������� ' . ENTRY_TELEPHONE_MIN_LENGTH . ' �������.\n');
define('JS_PASSWORD', '* ���� ����������� ������ ������ ��������� � ����� ������ � ������ ��������� ��� ������� ' . ENTRY_PASSWORD_MIN_LENGTH . ' ��������.\n');

define('CATEGORY_COMPANY', '�����������');
define('CATEGORY_PERSONAL', '���� ������������ ������');
define('CATEGORY_ADDRESS', '��� �����');
define('CATEGORY_CONTACT', '���������� ����������');
define('CATEGORY_OPTIONS', '��������');
define('CATEGORY_PASSWORD', '��� ������');
define('CATEGORY_CORRECT', '���� ���������� ������ ���������, ������� ������ �����������, ������� ��������� ����.');
define('ENTRY_CUSTOMERS_ID', 'ID:');
define('ENTRY_CUSTOMERS_ID_TEXT', '&nbsp;<small><font color="red">�����������</font></small>');
define('ENTRY_COMPANY', '�������� ��������:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', '���:');
define('ENTRY_GENDER_ERROR', '&nbsp;<small><font color="red">�����������</font></small>');
define('ENTRY_GENDER_TEXT', '&nbsp;<small><font color="red">�����������</font></small>');
define('ENTRY_FIRST_NAME', '���:');
define('ENTRY_FIRST_NAME_ERROR', '���� ��� ������ ��������� ��� ������� ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' �������.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', '�������:');
define('ENTRY_LAST_NAME_ERROR', '���� ������� ������ ��������� ��� ������� ' . ENTRY_LAST_NAME_MIN_LENGTH . ' �������.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', '���� ��������:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '���� �������� ���������� ������� � ��������� �������: MM/DD/YYYY (������ 05/21/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (������ 05/21/1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '���� E-Mail ������ ��������� ��� ������� ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' ��������.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '��� E-Mail ����� ������ �����������, ���������� ��� ���.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '�������� ���� E-Mail ��� ��������������� � ����� ��������, ���������� ������� ������ E-Mail �����.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', '����� � ����� ����:');
define('ENTRY_STREET_ADDRESS_ERROR', '���� ����� � ����� ���� ������ ��������� ��� ������� ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' ��������.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', '�����:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', '�������� ������:');
define('ENTRY_POST_CODE_ERROR', '���� �������� ������ ������ ��������� ��� ������� ' . ENTRY_POSTCODE_MIN_LENGTH . ' �������.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', '�����:');
define('ENTRY_CITY_ERROR', '���� ����� ������ ��������� ��� ������� ' . ENTRY_CITY_MIN_LENGTH . ' �������.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', '�������:');
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
define('ENTRY_NEWSLETTER', '������� ��������:');
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

// manual order box text in includes/boxes/manual_order.php

define('BOX_HEADING_MANUAL_ORDER', '�������� ������� ����� �������');
define('BOX_MANUAL_ORDER_CREATE_ACCOUNT', '����������� �������');
define('BOX_MANUAL_ORDER_CREATE_ORDER', '������� �����');
?>