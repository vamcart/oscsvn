<?php
/*
  $Id: index.php,v 1.1.1.1 2003/09/18 19:04:30 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('TEXT_MAIN', '&nbsp;');
define('TABLE_HEADING_NEW_PRODUCTS', '������� %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', '���������');
define('TABLE_HEADING_DATE_EXPECTED', '���� �����������');
define('TABLE_HEADING_DEFAULT_SPECIALS', '������ %s');

if ( ($category_depth == 'products') || (isset($_GET['manufacturers_id'])) ) {
  define('HEADING_TITLE', '������ �������');

  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', '��� ������');
  define('TABLE_HEADING_PRODUCTS', '������������');
  define('TABLE_HEADING_MANUFACTURER', '�������������');
  define('TABLE_HEADING_QUANTITY', '����������');
  define('TABLE_HEADING_PRICE', '����');
  define('TABLE_HEADING_WEIGHT', '���');
  define('TABLE_HEADING_BUY_NOW', '������');
  define('TABLE_HEADING_PRODUCT_SORT', '�������');   
  define('TEXT_NO_PRODUCTS', '��� �� ������ ������ � ���� �������.');
  define('TEXT_NO_PRODUCTS2', '��� �� ������ ������ ������� �������������.');
  define('TEXT_NUMBER_OF_PRODUCTS', '���������� ������: ');
  define('TEXT_SHOW', '<b>��������:</b>');
  define('TEXT_BUY', '������ \'');
  define('TEXT_NOW', '\' ������');
  define('TEXT_ALL_CATEGORIES', '��� �������');
  define('TEXT_ALL_MANUFACTURERS', '��� �������������');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', '����� ����������');
} elseif ($category_depth == 'nested') {
  define('HEADING_TITLE', '�������');
}
  define('HEADING_CUSTOMER_GREETING', '����� ����������');
  define('MAINPAGE_HEADING_TITLE', '������������ ��� � ����� ��������-��������');
// BOF: Lango added for Featured Products
  define('TABLE_HEADING_FEATURED_PRODUCTS', '������������� ������');
  define('TABLE_HEADING_FEATURED_PRODUCTS_CATEGORY', '������������� ������ ������� %s'); 
// EOF: Lango added for Featured Products

// Start Products Specifications
  define('TEXT_BUTTON_COMPARISON', '�������� �������� ���������');
  define('TEXT_LINK_PRODUCTS_COMPARISON', '�������� �������� ���������');
// End Products Specifications

?>