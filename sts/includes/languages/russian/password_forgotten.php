<?php
/*
  $Id: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', '����');
define('NAVBAR_TITLE_2', '�������������� ������');

define('HEADING_TITLE', '� ����� ���� ������!');

define('TEXT_MAIN', '���� �� ������ ���� ������, ������� e-mail �����, ������� �� ��������� ��� ����������� � �������� � �� �������� ����� ���o�� �� ��������� e-mail.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<font color="#ff0000"><b>������:</b></font> E-Mail ����� �� ������������� ����� ������� ������, ���������� ��� ���.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - ��� ������');
define('EMAIL_PASSWORD_REMINDER_BODY', '������ �� ��������� ������ ������ ��� ������� �� ' . $_SERVER['REMOTE_ADDR'] . '.' . "\n\n" . '��� ����� ������ � \'' . STORE_NAME . '\' :' . "\n\n" . '   %s' . "\n\n");

define('SUCCESS_PASSWORD_SENT', '���������: ��� ����� ������ ��������� ��� �� e-mail.');
?>