<?php
/*
  $Id: products_specifications.php v1.0 20090909 kymation $
  Based on: categories.php 1739 2007-12-20 00:52:16Z hpdl $
  $Loc: catalog/admin/includes/languages/english/ $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

// Headings
  define ('HEADING_TITLE_GROUPS', '������');
  define ('HEADING_TITLE_SPECIFICATIONS', '������������ � ������: ');
  define ('HEADING_TITLE_FILTERS', '������� � ������������: ');
  define ('HEADING_TITLE_VALUES', '�������� � ������������: ');
  define ('HEADING_TITLE_SEARCH_GROUPS', '����� ������:');
  define ('HEADING_TITLE_SEARCH_SPECIFICATIONS', '����� ������������:');
  define ('HEADING_TITLE_SEARCH_FILTERS', '����� �������:');
  define ('HEADING_TITLE_SEARCH_VALUES', '����� �������� ������������:');
  define ('HEADING_TITLE_GROUPS', '�����: ');
  define ('HEADING_TITLE_GOTO', '�������: ');

// Specification Groups
  // Table Headings
  define ('TABLE_HEADING_ID', 'ID');
  define ('TABLE_HEADING_GROUPS', '�������� ������');
  define ('TABLE_HEADING_SPECS', '������������');
  define ('TABLE_HEADING_FILTERS', '�������');
  define ('TABLE_HEADING_ACTION', '��������');
  define ('TABLE_HEADING_PRODUCTS', '���������� �� �������� �������� ������');
  define ('TABLE_HEADING_FILTER', '���������� ������');
  define ('TABLE_HEADING_IN_FILTER', '���������� � �������');
  define ('TABLE_HEADING_COMPARISON', '���������� �������� ���������');
  define ('TABLE_HEADING_ON_COMPARISON', '���������� �� �������� ���������');
  define ('TABLE_HEADING_SORT_ORDER', '������� ����������');
  define ('TABLE_HEADING_VALUES', '��������');
  
  define ('TEXT_GROUPS_TOTAL', '����� �����: ');
  define ('TEXT_SPECS_TOTAL', '����� ������������: ');
  define ('TEXT_FILTERS_TOTAL', '����� ��������: ');
  define ('TEXT_VALUES_TOTAL', '����� ��������: ');
  define ('TEXT_FILTERS_TOTAL_SPEC', '����� �������� � ������ ������������: ');
  define ('TEXT_VALUES_TOTAL_SPEC', '����� �������� ��� ������ ������������: ');
  define ('TEXT_SPECS_TOTAL_GROUP', '����� ������������ � ������ ������: ');
  define ('TEXT_FILTERS_TOTAL_GROUP', '����� �������� � ������ ������: ');
  define ('TEXT_VALUES_TOTAL_GROUP', '����� �������� ��� ������ ������: ');

  define ('TEXT_INFO_HEADING_NEW_GROUP', '����� ������');
  define ('TEXT_INFO_HEADING_EDIT_GROUP', '�������������� ������');
  define ('TEXT_NEW_GROUP_INTRO', '����������, ��������� ����� ��� �������� ����� ������.');
  define ('TEXT_GROUP_NAME', '�������� ������:');
  define ('TEXT_SHOW_COMPARISON', '���������� �������� ���������:');
  define ('TEXT_SHOW_ON_PRODUCTS', '���������� �� �������� ���������');
  define ('TEXT_SHOW_FILTER', '���������� ������:');
  define ('TEXT_SHOW', '��');
  define ('TEXT_DONT_SHOW', '���');
  define ('TEXT_FILTER_CLASS', '����� �������');
  define ('TEXT_FILTER_DISPLAY', '���������� ������ ���');
  define ('TEXT_FILTER_SHOW_ALL', '������ �������� ���');
  define ('TEXT_ENTER_FILTER', '������� ������');
  define ('TEXT_ENTER_VALUE', '������� �������� ������������');

  define ('TEXT_INFO_HEADING_COPY_GROUP', '����������� ������');
  define ('TEXT_COPY_GROUP_INTRO', '������� ����� ������ ������?<br>���������� ������ ������, ������� ���������� �����.');
  define ('TEXT_COPY_QUERY_LINKS', '��� �� ���������� ������ �� ���������: %s');
  define ('TEXT_COPY_QUERY_SPECS', '��� �� ���������� ������������: %s');
  define ('TEXT_COPY_QUERY_PRODUCTS', '��� �� ���������� ������������ �������: %s');
  define ('TEXT_COPY_QUERY_FILTERS', '��� �� ���������� ��������: %s');
  define ('TEXT_COPY_QUERY_VALUES', '��� �� ���������� �������� ������������: %s');
  define ('TEXT_INFO_CURRENT_GROUP', '������� ������: ');
  define ('TEXT_GROUPS', '�������� ����� ������:');
  define ('TEXT_NO_GROUP_SELECT', '������ �� �������!');
  
  define ('TEXT_SPECIFICATIONS', '������������ � ������ ������: ');
  define ('TEXT_FILTERS_GROUP', '������� � ������ ������: ');
  define ('TEXT_FILTERS_SPEC', '������� �� ������ ������������: ');
  define ('TEXT_ALL_CATEGORIES', '����� ����� ������������: ');
  define ('TEXT_ALL_SPECIFICATIONS', '����� ������������: ');
  define ('TEXT_ALL_FILTERS', '����� ��������: ');
  define ('TEXT_LIST_CATEGORIES_LINKED', '��������� � ����������: ');

  define ('TEXT_INFO_HEADING_LINK_CATEGORY', '��������� ������ ������ ������������ � ���������');
  define ('TEXT_LINK_CATEGORIES_INTRO', '�������� ���������, � ������� ���������� �������� ������ ������������.');
  define ('TEXT_LINK_TO', '���������: ');
  define ('TEXT_LINK_TO_SUBCATS', '������� ��� ������������');

  define ('TEXT_INFO_HEADING_LINK_ALL_CATEGORIES', '��������� �� ���� ����������');
  define ('TEXT_LINK_ALL_INTRO', '<b>��������!</b> ��������� �� ���� ���������� ���� �������!');
  
  define ('TEXT_INFO_HEADING_UNLINK_CATEGORY', '����� � ���������');
  define ('TEXT_UNLINK_INTRO', '�������� ���������, � ������� ����� ��������');
  define ('TEXT_UNLINK_CATEGORY', '���������: ');
  define ('TEXT_NO_CATEGORIES', '��� ���������!');
  
  define ('TEXT_INFO_HEADING_UNLINK_ALL_CATEGORIES', '����� �� ���� ���������');
  define ('TEXT_UNLINK_ALL_INTRO', '<b>��������!</b> ��������� �������� �� ���� ���������� ���� �������!!');
  
  define ('TEXT_INFO_HEADING_DELETE_GROUP', '������� ������');
  define ('TEXT_DELETE_GROUP_INTRO', '�� ������������� ������ ������� ������?');
  define ('TEXT_DELETE_WARNING_SPECS', '<b>��������!</b> ����� ������� ������������: %s!');
  define ('TEXT_DELETE_WARNING_PRODUCTS', '<b>��������!</b> ����� ������� ������������ �������: %s!');
  define ('TEXT_DELETE_WARNING_FILTERS', '<b>��������!</b> ����� ������� ��������: %s!');

  define ('TEXT_INFO_HEADING_EMPTY_GROUP', '��� ������!');
  define ('TEXT_NO_GROUPS', '�������� ������ ������������.');
  
  define ('TEXT_INFO_HEADING_EMPTY_SPECIFICATIONS', '��� ������!');
  define ('TEXT_NO_SPECIFICATIONS', '�������� ������������ � ������ ������.');
  
  define ('TEXT_INFO_HEADING_EDIT_GROUP', '������������� ������');
  define ('TEXT_INFO_HEADING_MOVE_GROUP', '����������� ������');

// Specifications
  define ('TEXT_SPECIFICATION', '������������');
  define ('TEXT_SPEC_NAME', '�������� ������������: ');
  define ('TEXT_SPEC_DESCRIPTION', '�������� ������������: ');
  define ('TEXT_SPEC_PREFIX', '������� ������������: ');
  define ('TEXT_SPEC_SUFFIX', '������� ������������: ');
  define ('TEXT_SPEC_SORT_ORDER', '������� ����������: ');
  define ('TEXT_SPEC_COLUMN_NAME', '�������� �������: ');
  define ('TEXT_SPEC_JUSTIFICATION', '������������: ');
  define ('TEXT_SPECS_LEGEND', '�������');
  define ('TEXT_SPECS_LEGEND_FILTERS', '������ ��������');
  define ('TEXT_SPECS_LEGEND_VALUES', '������ �������� ������������');

  define ('TEXT_INFO_HEADING_NEW_SPECIFICATION', '����� ������������ � &quot;%s&quot;');
  define ('TEXT_NEW_SPECIFICATION_INTRO', '����������, ��������� ����� ��� �������� ����� ������������ � ������ �������.');
  define ('TEXT_SPECIFICATION_NAME', '�������� ������������:');
  define ('TEXT_SPECIFICATION_DESCRIPTION', '�������� ������������:');
  define ('TEXT_SPECIFICATION_PREFIX', '������� ������������:');
  define ('TEXT_SPECIFICATION_SUFFIX', '������� ������������:');
  define ('TEXT_EXISTING_FIELD', '������������ ������������ � ���� ������ ����:');
  define ('TEXT_EXISTING_FIELD_NOTE', '<b>���������:</b> ���� ������ ��������� �����, ����� ������������ ������ �� ���������� ����.');
  
  define ('TEXT_INFO_HEADING_EDIT_SPECIFICATION', '�������������� ������������');
  define ('TEXT_EDIT_INTRO', '������� ����������� ���������');
  define ('TEXT_EDIT_SORT_ORDER', '������� ����������');
  define ('TEXT_COLUMN_JUSTIFY', '������������');

  
  define ('TEXT_INFO_HEADING_COPY_SPECIFICATION', '����������� ������������');
  define ('TEXT_INFO_COPY_SPECIFICATION_INTRO', '���� �� ������ ����������� ������������ %s?');
  define ('TEXT_COPY_SPECIFICATION_TO', '���������� � ������:');
  
  define ('TEXT_INFO_HEADING_MOVE_SPECIFICATION', '����������� ������������');
  define ('TEXT_MOVE_SPECIFICATION_INTRO', '���� �� ������ ����������� ������������ %s?');
  define ('TEXT_MOVE_SPECIFICATION_TO', '����������� � ������:');
  define ('TEXT_MOVE', '����������� <b>%s</b> �:');

  define ('TEXT_INFO_HEADING_DELETE_SPECIFICATION', '�������� ������������');
  define ('TEXT_DELETE_SPECIFICATION_INTRO', '�� ������������� ������ ������� ������������?');
  
// Filters
  define ('TEXT_INFO_HEADING_FILTER', '����� �������: ');
  define ('TEXT_FILTER_VALUE', '������: ');
  define ('TEXT_FILTER_SORT_ORDER', '������� ����������');
  define ('TEXT_INFO_HEADING_EMPTY_FILTERS', '������ ������');
  define ('TEXT_NO_FILTERS', '�� ������ ������� ���� ��� ��������� �������� � ������ ������������.');
  
  define ('TEXT_INFO_HEADING_NEW_FILTER', '����� ������');
  define ('TEXT_NEW_FILTER_INTRO', '����������, ��������� ����� ��� �������� ������ �������.');
  define ('TEXT_NEW_FILTER', '������');

  define ('TEXT_INFO_HEADING_EDIT_FILTER', '�������������� �������');
  define ('TEXT_EDIT_FILTER_INTRO', '������� ����������� ���������');
  define ('TEXT_EDIT_FILTER', '������');
  
  define ('TEXT_INFO_HEADING_COPY_FILTER', '����������� �������');
  define ('TEXT_COPY_FILTER_INTRO', '� ����� ������������ �� ������ ����������� ������ ������?');
  define ('TEXT_COPY_FILTER_TO', '���������� ������ <b>%s</b> �: ');

  define ('TEXT_INFO_HEADING_MOVE_FILTER', '����������� �������');
  define ('TEXT_MOVE_FILTER_INTRO', '���� �� ������ ����������� ������ ������?');
  define ('TEXT_MOVE_FILTER_TO', '����������� ������ <b>%s</b> �: ');

  define ('TEXT_INFO_HEADING_DELETE_FILTER', '�������� �������');
  define ('TEXT_DELETE_FILTER_INTRO', '�� ������������� ������ ������� ������ ������?');
  
// Specification Values
  define ('TEXT_INFO_HEADING_VALUE', '�������� ������������');
  define ('TEXT_SPECIFICATION_VALUE', '�������� ������������: ');
  define ('TEXT_INFO_HEADING_EMPTY_VALUES', '������ �������� ������������');
  define ('TEXT_NO_VALUES', '�� ������ ������� ���� ��� ��������� �������� � ������ ������������.');

  define ('TEXT_INFO_HEADING_NEW_VALUE', '����� �������� ������������');
  define ('TEXT_NEW_VALUE_INTRO', '�������� ����� �������� ��� %s, ��������� ����� %s');
  define ('TEXT_NEW_VALUE', '��������:');

  define ('TEXT_EDIT_VALUE_INTRO', '�������� �������� ��� %s, ��������� ����� %s');
  define ('TEXT_EDIT_VALUE', '��������:');
  define ('TEXT_VALUE_SORT_ORDER', '������� ���������� ��������:');

  define ('TEXT_INFO_HEADING_DELETE_VALUE', '�������� �������� ������������');
  define ('TEXT_DELETE_VALUE_INTRO', '�� ������������� ������ ������� ������ ��������?');
  

  define ('TEXT_INFO_HEADING_EDIT_VALUE', '�������� ������������: ');
  define ('TEXT_VALUE', '��������: ');
  define ('TEXT_VALUE_SORT_ORDER', '������� ���������� ��������: ');

  define ('TEXT_INFO_HEADING_COPY_VALUE', '����������� ��������');
  define ('TEXT_COPY_VALUE_INTRO', '� ����� ������������ �� ������ ����������� ������ ��������?');
  define ('TEXT_COPY_VALUE_TO', '���������� �������� <b>%s</b> �:');

  define ('TEXT_INFO_HEADING_MOVE_VALUE', '����������� ��������');
  define ('TEXT_MOVE_VALUE_INTRO', '� ����� ������������ �� ������ ����������� ������ ��������?');
  define ('TEXT_MOVE_VALUE_TO', '����������� �������� <b>%s</b> �:');

// General
  define ('IMAGE_LINK', '���������� � ���������');
  define ('IMAGE_LINK_ALL', '���������� �� ���� ����������');
  define ('IMAGE_UNLINK', '����� � ���������');
  define ('IMAGE_NEW_FILTER', '�������� ����� ������');
  define ('IMAGE_NEW_VALUE', '�������� ����� ��������');
  define ('IMAGE_IMPORT_MANUFACTURERS', '������ ���� ��������������');
  define ('ICON_BLANK', '');
  
  define ('TEXT_NONE', '���');
  define ('TEXT_COMBI', '����������');
  define ('TEXT_BUY_NOW', '������');
  define ('TEXT_PRODUCTS_MODEL', '��� ������');
  define ('TEXT_PRODUCTS_IMAGE', '�������� ������');
  define ('TEXT_PRODUCTS_PRICE', '����');
  define ('TEXT_PRODUCTS_WEIGHT', '���');
  define ('TEXT_PRODUCTS_MANUFACTURER', '�������������');
  define ('TEXT_PRODUCTS_NAME', '�������� ������');
  define ('TEXT_LEFT', '�����');
  define ('TEXT_CENTER', '�����');
  define ('TEXT_RIGHT', '������');
  define ('TEXT_NO_FILTER', '��� �������');
  define ('TEXT_EXACT', '������');
  define ('TEXT_MULTIPLE', '���������');
  define ('TEXT_RANGE', '��������');
  define ('TEXT_REVERSE', '��������');
  define ('TEXT_START', '���������');
  define ('TEXT_PARTIAL', '���������');
  define ('TEXT_LIKE', '�������');
  define ('TEXT_PULLDOWN', 'Dropdown ����');
  define ('TEXT_RADIO', '����� ������');
  define ('TEXT_LINKS', '������ ������');
  define ('TEXT_TEXT_BOX', '�����');
  define ('TEXT_MULTI', '������ dropdown');
  define ('TEXT_CHECK_BOXES', '��� �����');
  define ('TEXT_IMAGES', '��������');
  define ('TEXT_MULTI_IMAGE', '������ ��������');
  define ('TEXT_FINAL_PRICE', '�����');

?>