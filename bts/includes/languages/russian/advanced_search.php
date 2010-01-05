<?php
/*
  $Id: advanced_search.php,v 1.1.1.1 2003/09/18 19:04:28 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', '����������� �����');
define('NAVBAR_TITLE_2', '���������� ������');

define('HEADING_TITLE_1', '����������� �����');
define('HEADING_TITLE_2', '������, ��������������� ������ �������');

define('HEADING_SEARCH_CRITERIA', '����� �������');

define('TEXT_SEARCH_IN_DESCRIPTION', '������ � �������� �������');
define('ENTRY_CATEGORIES', '���������:');
define('ENTRY_INCLUDE_SUBCATEGORIES', '������� ������������');
define('ENTRY_MANUFACTURERS', '�������������:');
define('ENTRY_PRICE_FROM', '���� ��:');
define('ENTRY_PRICE_TO', '��:');
define('ENTRY_DATE_FROM', '���� ���������� ��:');
define('ENTRY_DATE_TO', '��:');

define('TEXT_SEARCH_HELP_LINK', '<u>������������ �� ������</u> [?]');

define('TEXT_ALL_CATEGORIES', '��� ���������');
define('TEXT_ALL_MANUFACTURERS', '��� �������������');

define('HEADING_SEARCH_HELP', '������������ �� ������');
define('TEXT_SEARCH_HELP', '������� ������ ��������� ��� ������ ��������, ��������, �������� � ������������� �� ��������� �����.<br><br>��� ������, �� ������ ��������� �������� ����� � ����� ���������� *AND*, *OR*. ��������, �� ������ ������ <u>���������� AND ����������</u>. � ���������� ����� ����� �������� ������, ���������� ��� �����. ��� �� �����, ���� �� �������� <u>���������� OR ����������</u>, �� �������� ������, ������� �������� ��� ��� ���� �� ����, �������� � ������. ���� ����� �� ����������� ��������� � ��� ���, ����� ����� �������� � ������������ ���.<br><br>�� ������ ����� ����� ����� �������� �����, �������� �� � �������. ��������, ���� �� ����� <u>"����� ������"</u>, �� �������� ������ ���������, ������� �������� ��� ����� �������.<br><br>������ ����� ��������������, ����� ��������� �������� ���������� ��������. ��������, �� ������ ������ <u>���������� (��������� or ��������)</u>.');
define('TEXT_CLOSE_WINDOW', '<u>������� ����</u> [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', '��� ������');
define('TABLE_HEADING_PRODUCTS', '��������');
define('TABLE_HEADING_MANUFACTURER', '�������������');
define('TABLE_HEADING_QUANTITY', '����������');
define('TABLE_HEADING_PRICE', '����');
define('TABLE_HEADING_WEIGHT', '���');
define('TABLE_HEADING_BUY_NOW', '������ ������');
define('TABLE_HEADING_PRODUCT_SORT', '�������');


define('TEXT_NO_PRODUCTS', '<br><span style="font-size:11px;">�� ������ ������� - <b>' . stripslashes($_GET['keywords']) . '</b> - ������ �� �������.</span><br><br>������������ �� ������:<ol><li>���������� ������������ ��������� �������.</li><li>����������� ������ �������� �����.</li><li>����������� ��������� �������� ����.</li></ol>');

define('ERROR_AT_LEAST_ONE_INPUT', '�� �� ��������� ���� �� ����������� ����� �����.');
define('ERROR_INVALID_FROM_DATE', '����������� ��������� ���� ���� ���������� ��.');
define('ERROR_INVALID_TO_DATE', '����������� ��������� ���� ���� ���������� ��.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', '�������� ���� ���� ���������� �� ������ ���� ������ �������� ���� ���� ���������� ��.');
define('ERROR_PRICE_FROM_MUST_BE_NUM', '���� ���� �� ������ ��������� ������ �����.');
define('ERROR_PRICE_TO_MUST_BE_NUM', '���� ���� �� ������ ��������� ������ �����.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', '�������� ���� ���� �� ������ ���� ������ �������� ���� ���� ��.');
define('ERROR_INVALID_KEYWORDS', '��������� ������ ��������� �������.');

define('TEXT_REPLACEMENT_SUGGESTION', '����� ����������� ������: ');

define('TABLE_HEADING_INFO', '������� ��������');

?>
