<?php
/*
  $Id: shop_by_price.php,v 1.0 2003/5/26  $

  Contribution by Meltus
  http://www.highbarn-consulting.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', '���������� �� ����');
define('HEADING_TITLE', '���������� �� ����');
define('BOX_HEADING_SHOP_BY_PRICE', '���������� �� ����');
define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_PRICE', '����');
define('TABLE_HEADING_BUY_NOW', '������');
define('TABLE_HEADING_MODEL', '���');
define('TABLE_HEADING_PRODUCTS', '��������');
define('TABLE_HEADING_MANUFACTURER', '�������������');
define('TABLE_HEADING_QUANTITY', '����������');

$price_ranges = Array( 	"�� 100",
						"�� 100 �� 250",
						"�� 250 �� 500",
						"�� 500 �� 1000",
						"�� 1000 � ����" );

$price_ranges_sql = Array( 	"p.products_price < 100",
							"(p.products_price <= 250 and p.products_price >= 100)",
							"(p.products_price <= 500 and p.products_price >= 250)",
							"(p.products_price <= 1000 and p.products_price >= 500)",
							"p.products_price >= 1000");

?>