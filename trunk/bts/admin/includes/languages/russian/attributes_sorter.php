<?php
/*
  Definitions for Attributes Sorter
*/

// Turn things off
define('I_AM_OFF',true);

// WebMakers.com Added: Attributes - Definitions to move to attribute_sorter.php
define('TABLE_HEADING_PRODUCT_ATTRIBUTE_ONE_TIME','������������ ����');

// WebMakers.com Added: Attribute Copy Option
define('TEXT_COPY_ATTRIBUTES_ONLY','������������ ������ ��� ������������� �������...');
define('TEXT_COPY_ATTRIBUTES','���������� �������� ������?');
define('TEXT_COPY_ATTRIBUTES_YES','��');
define('TEXT_COPY_ATTRIBUTES_NO','���');

// WebMakers.com Added: Attributes Copy from Existing Product to Existing Product
define('PRODUCT_NAMES_HELPER','<a href="' . 'quick_products_popup.php' . '" onclick="NewWindow(this.href,\'name\',\'700\',\'500\',\'yes\');return false;"><b><font color=red>[ �������� ������ ������� ]</font></b></a>');
define('ATTRIBUTES_NAMES_HELPER','<a href="' . 'quick_attributes_popup.php?look_it_up=' . $_GET['pID'] . '&my_languages_id=' . $languages_id . '" onclick="NewWindow2(this.href,\'name2\',\'700\',\'400\',\'yes\');return false;">[ �������� �������� ������� ������ ]<br></a>����� ������� ������: ' . $_GET['pID']);

// WebMakers.com Added: Product Option Attributes Sort Order - products_attributes.php
define('TABLE_HEADING_OPTION_SORT_ORDER','������� ����������');
?>
