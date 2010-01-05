<?php
/*
  $Id: categories.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

// BOF MaxiDVD: Added For Ultimate-Images Pack!
define('TEXT_PRODUCTS_IMAGE_NOTE','<b>�������� ������:</b><small><br>�������� �������� ������, ������� ������������ ��� ��������� ������ � <br><u>���������� � �� �������� ���������� �������� ������.</u>. ������������� ������ �������� �������� �� �������� �������� � �������, ���� �������� �������� ������� �������� � ��� �������� �����������.<small>');
define('TEXT_PRODUCTS_IMAGE_MEDIUM', '<b>������� ��������:</b><br><small>�������� �������� �������� ������ �� ��������<br><u>���������� ��������</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LARGE', '<b>�������� ��� Pop-up ����:</b><br><small>�������� �������� ������ <br><u>�� ����������� ����</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LINKED', '<u>������������ ��� ������ ��� �������� =</u>');
define('TEXT_PRODUCTS_IMAGE_REMOVE', '�� ������������� ������ <b>�������</b> ��� ��������?');
define('TEXT_PRODUCTS_IMAGE_DELETE', '<b>�������</b> ��� �������� � �������?');
define('TEXT_PRODUCTS_IMAGE_REMOVE_SHORT', '������� ��������, ������� ���� �������� �� �������');
define('TEXT_PRODUCTS_IMAGE_DELETE_SHORT', '������� �������� ������ � ������');
define('TEXT_PRODUCTS_IMAGE_TH_NOTICE', '<b>�� = ��������� ��������,</b> ������������ ������<br>��� ��������� ������ � �������� � ��������� �������� ���������� �������� ������<br>���� �� �� ������� ������� �������� (��), ��������� �������� ����� ��������� � Pop-up ����, �� ���� �� ������� ������� �������� (��), �� � Pop-Up ���� ��������� ������ ������� �������� (��)<br><br>');
define('TEXT_PRODUCTS_IMAGE_XL_NOTICE', '<b>�� = ������� ��������,</b> ��������� � Pop-up ����<br><br><br>');
define('TEXT_PRODUCTS_IMAGE_ADDITIONAL', '�������������� �������� ������ - ����� �� ������ �������� � ������ �������������� ��������, ���� � ������ ������ ���� �������� ��� � ��� ������, �� ������, ������������� ����, ����� �� ���������.');
define('TEXT_PRODUCTS_IMAGE_SM_1', '��1:');
define('TEXT_PRODUCTS_IMAGE_XL_1', '��1:');
define('TEXT_PRODUCTS_IMAGE_SM_2', '��2:');
define('TEXT_PRODUCTS_IMAGE_XL_2', '��2:');
define('TEXT_PRODUCTS_IMAGE_SM_3', '��3:');
define('TEXT_PRODUCTS_IMAGE_XL_3', '��3:');
define('TEXT_PRODUCTS_IMAGE_SM_4', '��4:');
define('TEXT_PRODUCTS_IMAGE_XL_4', '��4:');
define('TEXT_PRODUCTS_IMAGE_SM_5', '��5:');
define('TEXT_PRODUCTS_IMAGE_XL_5', '��5:');
define('TEXT_PRODUCTS_IMAGE_SM_6', '��6:');
define('TEXT_PRODUCTS_IMAGE_XL_6', '��6:');
// EOF MaxiDVD: Added For Ultimate-Images Pack!
define('HEADING_TITLE', '��������� / ������');
define('HEADING_TITLE_SEARCH', '�����:');
define('HEADING_TITLE_GOTO', '������� �:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', '��������� / ������');
define('TABLE_HEADING_ACTION', '��������');
define('TABLE_HEADING_STATUS', '������');

define('TEXT_NEW_PRODUCT', '����� ����� � &quot;%s&quot;');
define('TEXT_CATEGORIES', '���������:');
define('TEXT_SUBCATEGORIES', '������������:');
define('TEXT_PRODUCTS', '������� �� ��������:');
define('TEXT_PRODUCTS_PRICE_INFO', '����:');
define('TEXT_PRODUCTS_TAX_CLASS', '����� �������:');
define('TEXT_PRODUCTS_AVERAGE_RATING', '������� ������:');
define('TEXT_PRODUCTS_QUANTITY_INFO', '����������:');
define('TEXT_DATE_ADDED', '���� ����������:');
define('TEXT_DELETE_IMAGE', '������� ��������');

define('TEXT_DATE_AVAILABLE', '�������� �:');
define('TEXT_LAST_MODIFIED', '��������� ���������:');
define('TEXT_IMAGE_NONEXISTENT', '�������� �� �������');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', '��������, ����������, ����� ��������� ��� �����.');
define('TEXT_PRODUCT_MORE_INFORMATION', '����� ��������� ���������� � ������ <a href="http://%s" target="blank"><u>�� ���� ��������</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', '���� ����� ��� �������� � ������� %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', '���� ����� ����� � ������� � %s.');

define('TEXT_EDIT_INTRO', '����������, ������� ����������� ���������');
define('TEXT_EDIT_CATEGORIES_ID', 'ID ���������:');
define('TEXT_EDIT_CATEGORIES_NAME', '�������� ���������:');
define('TEXT_EDIT_CATEGORIES_IMAGE', '�������� ��� ���������:');
define('TEXT_EDIT_SORT_ORDER', '������� ����������:');
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', '�������� ��������:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', '��������:');

define('TEXT_INFO_COPY_TO_INTRO', '��������, ����������, ����� ���������, ���� �� ������ ����������� ���� �����');
define('TEXT_INFO_CURRENT_CATEGORIES', '������� ���������:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', '����� ���������');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', '�������� ���������');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', '������� ���������');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', '��������� ���������');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', '������� �����');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', '��������� �����');
define('TEXT_INFO_HEADING_COPY_TO', '���������� �');

define('TEXT_DELETE_CATEGORY_INTRO', '�� ������������� ������ ������� ��� ���������?');
define('TEXT_DELETE_PRODUCT_INTRO', '�� ������������� ������ ������� ���� �����?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>��������:</b> ���� ��� %s ������������, ��������� � ���� ����������!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>��������:</b> ���� ��� %s ������������ ������, ��������� � ���� ����������!');

define('TEXT_MOVE_PRODUCTS_INTRO', '����������, �������� ��������� ��� ����������� <b>%s</b> �');
define('TEXT_MOVE_CATEGORIES_INTRO', '����������, �������� ��������� ��� ����������� <b>%s</b> �');
define('TEXT_MOVE', '����������� <b>%s</b> �:');

define('TEXT_NEW_CATEGORY_INTRO', '����������, ��������� ��������� ���������� ��� ����� ���������');
define('TEXT_CATEGORIES_NAME', '�������� ���������:');
define('TEXT_CATEGORIES_IMAGE', '�������� ���������:');
define('TEXT_SORT_ORDER', '������� ����������:');

define('TEXT_PRODUCTS_STATUS', '������ ������:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', '���� �����������:');
define('TEXT_PRODUCT_AVAILABLE', '� �������');
define('TEXT_PRODUCT_NOT_AVAILABLE', '��� � �������');
define('TEXT_PRODUCTS_MANUFACTURER', '�������������:');
define('TEXT_PRODUCTS_NAME', '��������:');
define('TEXT_PRODUCTS_DESCRIPTION', '�������� ������:');
define('TEXT_PRODUCTS_QUANTITY', '���������� ������ �� ������:');
define('TEXT_PRODUCTS_MODEL', '��� ������:');
define('TEXT_PRODUCTS_IMAGE', '�������� ������:');
define('TEXT_PRODUCTS_URL', 'URL ������:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(��� http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', '���� (��� ������):');
define('TEXT_PRODUCTS_PRICE_GROSS', '���� (� �������):');
define('TEXT_PRODUCTS_WEIGHT', '��� ������:');
define('TEXT_NONE', '--���--');

define('EMPTY_CATEGORY', '������ ���������');

define('TEXT_HOW_TO_COPY', '����� �����������:');
define('TEXT_COPY_AS_LINK', '������ �� �����');
define('TEXT_COPY_AS_DUPLICATE', '����������� �����');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', '������: ������ ������ ������ �� ����� � ��� �� ���������.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', '������: ������� � ���������� ����� �������� ����� �������: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', '������: ������� � ���������� �����������: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', '������: ��������� �� ����� ���� ����������.');


//
define('ENTRY_PRODUCTS_PRICE', '���� ������');
define('ENTRY_PRODUCTS_PRICE_DISABLED', '�� �������');
//


define('TEXT_PRODUCTS_PAGE_TITLE', 'Meta Title:');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Meta Description:');
define('TEXT_PRODUCTS_KEYWORDS', 'Meta Keywords:');


// RJW Begin Meta Tags Code
  define('TEXT_META_TITLE', 'Meta Title');
  define('TEXT_META_DESCRIPTION', 'Meta Description');
  define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code


  define('TEXT_EDIT', '��������/��������');
  define('TABLE_HEADING_PARAMETERS', '���. ���������');

define('TEXT_PRODUCTS_INFO', '������� ��������:');

define('TEXT_ATTRIBUTE_HEAD', '�������� ������:');
define('TABLE_HEADING_ATTRIBUTE_1', '�������� ��������');
define('TABLE_HEADING_ATTRIBUTE_2', '�������');
define('TABLE_HEADING_ATTRIBUTE_3', '���������');
define('TABLE_HEADING_ATTRIBUTE_4', '������� ����������');
define('TABLE_HEADING_ATTRIBUTE_5', '����');
define('TABLE_HEADING_ATTRIBUTE_6', '������ ������� (����)');
define('TABLE_HEADING_ATTRIBUTE_7', '�������� ��������');
define('TABLE_HEADING_ATTRIBUTE_9', '���');

define('TABLE_HEADING_PRODUCT_SORT', '�������');
define('TEXT_ATTRIBUTE_DESC', '�� ������ �������� �������� ��� ������, ������� ����������� �������� � ������ ���������. ���� � ������ ��� ���������, ������ ���������� ������ ����. ���� �� ������ ������ ������ �������� ���������, ������ � �������� ��������� �����������/���������� � ������� <a href="products_attributes.php">������� - �������� - ���������</a>.');

#Add:
define('TABLE_HEADING_XML', 'XML');
define('TEXT_PRODUCTS_TO_XML', '����� XML:');
define('TEXT_PRODUCT_AVAILABLE_TO_XML', '��������');
define('TEXT_PRODUCT_NOT_AVAILABLE_TO_XML', '�� ��������');

// BOF Enable - Disable Categories Contribution--------------------------------------
define('TEXT_EDIT_STATUS', '������');
define('TEXT_DEFINE_CATEGORY_STATUS', '1=�������; 0=���������');
// EOF Enable - Disable Categories Contribution--------------------------------------

define('TEXT_MIN_QUANTITY', '����������� ���������� ������ ��� ������:');
define('TEXT_MIN_QUANTITY_UNITS', '���:');

define('ATTRIBUTES_COPY_MANAGER_1', '���������� �������� ������� � ��������� ...');
define('ATTRIBUTES_COPY_MANAGER_2', '���������� �������� ������ ');
define('ATTRIBUTES_COPY_MANAGER_3', ' ������� ����� ������');
define('ATTRIBUTES_COPY_MANAGER_4', '�� ��� ������ ��������� ');
define('ATTRIBUTES_COPY_MANAGER_5', '����� ���������: ');
define('ATTRIBUTES_COPY_MANAGER_6', '������� ��� ������������ � ��������� �������� ����� ������������ ');
define('ATTRIBUTES_COPY_MANAGER_7', '��� �� ...');
define('ATTRIBUTES_COPY_MANAGER_8', '������������� �������� ����� ��������� ');
define('ATTRIBUTES_COPY_MANAGER_9', '������������� �������� ����� ������������ ');
define('ATTRIBUTES_COPY_MANAGER_10', '���������� �������� � ������� ');
define('ATTRIBUTES_COPY_MANAGER_11', '�������� ���������');
define('ATTRIBUTES_COPY_MANAGER_12', '���������� �������� �� ������ ������ �� ��� ������ ��������� ');
define('ATTRIBUTES_COPY_MANAGER_13', '����������� ���������');
define('ATTRIBUTES_COPY_MANAGER_14', '�������� �����');
define('ATTRIBUTES_COPY_MANAGER_15', '����� ������: ');
define('ATTRIBUTES_COPY_MANAGER_16', '� �����: ');
define('ATTRIBUTES_COPY_MANAGER_17', '������� ��� ������������ � ������ �������� ����� ������������ ����� ��������� ');
define('ATTRIBUTES_COPY_MANAGER_COPY', '���������� ��������');

define('TEXT_PAGES', '��������: ');
define('TEXT_TOTAL_PRODUCTS', '������� � ������ ���������: ');
define('TEXT_ATT_UPLOAD', '�����...');

define('TEXT_WEIGHT_HELP', '<span class="main"><b><font color="red">��������:</font></b> ���� �� ���������� �� ����������� �����, ����������� ������� ��� ������ ������ 0, �������� 0.1, �����, ��� ���������� ������ ����� �������� ���� ������ ������� �������� ������, ���� ��� ������ 0, �� ����� ��������� ����������� �, �������������, �������� ������ ������ �� ����� (����������� ����� ������ ����������� � ���� �����), ���������� ������ ���� ��� ���������� ������� � ��������-�������.</span>');

define('HEADING_TITLE_SEARCH_MODEL', '����� �� ���� ������:');

define('TEXT_PRODUCTS_IMAGE_DIR', '���������� ��������:');
define('TEXT_IMAGES_MAIN_DIRECTORY', 'images');
define('TABLE_HEADING_YES','��');
define('TABLE_HEADING_NO','���');
define('TEXT_IMAGES_OVERWRITE', '������������ ������������ �����������?');
define('TEXT_IMAGES_OVERWRITE1', '����������� "���" ��� ������� �������� ��������');
define('TEXT_IMAGE_OVERWRITE_WARNING','��������: ��� ����� ���� ��������, �� �� ������������ ');          

define('TEXT_PRODUCTS_DATA','������');
define('TEXT_PRODUCTS_TAB_PRICE','����');
define('TEXT_PRODUCTS_TAB_IMAGES','��������');
define('TEXT_PRODUCTS_TAB_ATTRIBUTES','�������� ������');
define('TEXT_TAB_CATEGORIES_IMAGE', '�������� ���������');

define('TEXT_BUTTON_DELETE','�������');
define('TEXT_BUTTON_CLEAR','��������');
define('TEXT_DELETE_CONFIRM','�� �������?');

define('TEXT_BUTTON_UPDATE','��������� �������');

// Start Products Specifications
  define ('TEXT_TAB_DESCRIPTION', '��������');
  define ('TEXT_TAB_SPECIFICATIONS', '������������');
  define ('TEXT_TAB_1', '�����������');
  define ('TEXT_TAB_2', '�����');
  define ('TEXT_TAB_3', '����������');
  define ('TEXT_TAB_4', '������');
  define ('TEXT_TAB_5', '��������');
  define ('TEXT_TAB_6', '��������');
  define ('TEXT_TITLE_1', '�����������');
  define ('TEXT_TITLE_2', '�����');
  define ('TEXT_TITLE_3', '����������');
  define ('TEXT_TITLE_4', '������');
  define ('TEXT_TITLE_5', '��������');
  define ('TEXT_TITLE_6', '��������');
  define ('SPECIFICATION_TITLE_PRODUCTS', '&nbsp;������������:');
  define ('SPECIFICATIONS_TEXT_ALL', '���');
// End Products Specifications

?>