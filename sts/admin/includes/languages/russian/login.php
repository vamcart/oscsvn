<?php
/*
  $Id: login.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

if ($_GET['origin'] == FILENAME_CHECKOUT_PAYMENT) {
  define('NAVBAR_TITLE', '�����');
  define('HEADING_TITLE', '������� ����� �����.');
  define('TEXT_STEP_BY_STEP', '�� ������� �������� ����� ��� �� �����.');
} else {
  define('NAVBAR_TITLE', '����');
  define('HEADING_TITLE', '����� ����������, ������� ���� ������');
  define('TEXT_STEP_BY_STEP', ''); // should be empty
}

define('HEADING_RETURNING_ADMIN', '����:');
define('HEADING_PASSWORD_FORGOTTEN', '����������� ������:');
define('TEXT_RETURNING_ADMIN', '������ ��� ���������������!');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail �����:');
define('ENTRY_PASSWORD', '������:');
define('ENTRY_FIRSTNAME', '���:');
define('IMAGE_BUTTON_LOGIN', '�����');

define('TEXT_PASSWORD_FORGOTTEN', '������ ������?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>������:</b></font> �������� email ����� ���(�) ������!');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>������:</b></font> ��� � ������ �� ���������!');
define('TEXT_FORGOTTEN_FAIL', '�� �������� ����� ����� 3 ���. � ����� ������������, ��������� � ��������������� ��� ��������� ������ �� ����.<br>&nbsp;<br>&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', '����� ������ ��� ��������� �� ��� email �����. ��������� ����� � ���������� ����� ��� ���.<br>&nbsp;<br>&nbsp;');

define('ADMIN_EMAIL_SUBJECT', '��� ����� ������!'); 
define('ADMIN_EMAIL_TEXT', '������������ %s,' . "\n\n" . '�� ������ ����� � ����������������� �� ��������� �������. ����� ����� � ������ �������, �� ����������� �������� ������ �� �����!' . "\n\n" . '���� : %s' . "\n" . 'Email: %s' . "\n" . '������: %s' . "\n\n" . '�������!' . "\n" . '%s' . "\n\n" . '��� ������ ���������� �������������, �� ����� �� ���� ��������!'); 
?>
