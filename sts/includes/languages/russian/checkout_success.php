<?php
/*
  $Id: checkout_success.php,v 1.1.1.1 2003/09/18 19:04:30 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', '���������� ������');
define('NAVBAR_TITLE_2', '�������');

define('HEADING_TITLE', '��� ����� ��������!');

define('TEXT_SUCCESS', '��� ����� ������� ��������! ���������� ������ ����� ���������� ��� ����� �� ����� ����������� ������� �� ��� ����.<br><br> � ��� �������� �������, �����������, �����������, ���������, ����������,  � <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">����� ������� ������������</a>.'); 
define('TEXT_NOTIFY_PRODUCTS', '�������� �� ������, � ������� �� ������ �������� �����������:');
define('TEXT_SEE_ORDERS', '�� ������ ���������� ������� ����� �������, ����� �� ���� ������������ �������� <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'��� ������\'</a> � �����  <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">\'������� �������\'</a>.');
define('TEXT_CONTACT_STORE_OWNER', '');
define('TEXT_THANKS_FOR_SHOPPING', '���������� ��� �� �������!');

define('TABLE_HEADING_COMMENTS', '� ��� ���� �������, �����������, �����������');

define('TABLE_HEADING_DOWNLOAD_DATE', '������ ������������� ��: ');
define('TABLE_HEADING_DOWNLOAD_COUNT', ' ��� ����� ��������� ����.');
define('HEADING_DOWNLOAD', '������ ��� ����������:');
define('FOOTER_DOWNLOAD', '�� ������ ����� ��������� ���� �������� ����� � \'%s\'');

// Guest account start
define('TEXT_GUEST_ORDERS', '');
?>