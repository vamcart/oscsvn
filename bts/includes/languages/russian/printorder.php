<?php
/*
  $Id: invoice.php,v 1.1 2003/05 xaglo
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('TITLE_PRINT_ORDER', '����');
define('TITLE_PRINT_ORDER_NUM', '� ������:');
define('TITLE_PRINT_NUMBER_TEXT', ' ');

define('TABLE_HEADING_INN', '���');
define('TABLE_HEADING_CONTNUM', '���� �');
define('TABLE_HEADING_BIK', '���');
define('TABLE_HEADING_NUM', '�');
define('TABLE_HEADING_OT', '��');
define('TABLE_HEADING_SUMMA', '� ������:');
define('TABLE_HEADING_COMMENTS', '����������');
define('TABLE_HEADING_PRODUCTS_MODEL', '�������	');
define('TABLE_HEADING_PRODUCTS_CONT', '���-��');
define('TABLE_HEADING_PRODUCTS', '�����');
define('TABLE_HEADING_TAX', '���');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', '���� �� ��.<br> ��� ���');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', '���� �� �� � ���');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', '����� ��� ���');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', '����� � ���');

define('IMAGE_BUTTON_PRINT', '������');

define('ENTRY_EXT_DA', '���������:');
define('ENTRY_EXT_DA_1', '����������');
define('ENTRY_EXT_DA_2', '���� ����������');

define('ENTRY_EXT_DA_3', '�������� ������ �. ������');

define('ENTRY_OBR_DA', '������� ���������� ���������� ���������:');
define('ENTRY_SOLD_TO', '����������:');
define('ENTRY_SOLD_TO_1', '������������� �����������:');
define('ENTRY_SOLD_TO_2', '��������:');
define('ENTRY_SOLD_TO_INN', '���');
define('ENTRY_SOLD_TO_KPP', '���');
define('ENTRY_SOLD_TO_OGRN', '����');
define('ENTRY_SOLD_TO_OKPO', '����');
define('ENTRY_SOLD_TO_RS', '�/�');
define('ENTRY_SOLD_TO_BANK_NAME', '����');
define('ENTRY_SOLD_TO_BIK', '���');
define('ENTRY_SOLD_TO_KS', '�/�');
define('ENTRY_SHIP_TO', '���������������:');
define('ENTRY_PAYMENT_METHOD', '����� ������:');
define('ENTRY_BOSS', '������������:');

define('ENTRY_BOSS_NOME', MODULE_PAYMENT_RUS_SCHET_9);

define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_1', MODULE_PAYMENT_RUS_SCHET_1);  // ����
define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_2', MODULE_PAYMENT_RUS_SCHET_2);  // ���� ����������
define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_3', MODULE_PAYMENT_RUS_SCHET_3);  // ���
define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_4', MODULE_PAYMENT_RUS_SCHET_4);  // ���� �����
define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_5', MODULE_PAYMENT_RUS_SCHET_5);  // ���
define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_6', MODULE_PAYMENT_RUS_SCHET_6);  // ����������
define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_7', MODULE_PAYMENT_RUS_SCHET_7);  // ���

define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_8','<font color=red>������ ������������ � ������ �� ����� �� �� �� ���� �������</font><br>����� ������ ������ ����������� �������� ��� �� ����������� ����� � ����� ������ ��� ��������� �� ���. � ��������� ������� ���� � ����� ������, ����� ������, ��� � ����� ���������� ���������. ��������� �����, ����-������� � ��������� ����� ������������� ��� ��������� ������ ��� ������� �� �����.');

define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_9','<font color=red>��������!</font> ������ ������� ���������������� ����� �������� �������� � ��������� �������� ������. ���� ������������ � ������� 3-� ���������� ���� � ������� �������. �� ��������� ����� �������� ����� ������ ����������� ������ �� �����������.');

define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_10', MODULE_PAYMENT_RUS_SCHET_8); // ����� ����������

define('text_zero', '����');
define('text_three', '���');
define('text_four', '������');
define('text_five', '����');
define('text_six', '�����');
define('text_seven', '����');
define('text_eight', '������');
define('text_nine', '������');
define('text_ten', '������');
define('text_eleven', '����������');
define('text_twelve', '����������');
define('text_thirteen', '����������');
define('text_fourteen', '������������');
define('text_fifteen', '����������');
define('text_sixteen', '�����������');
define('text_seventeen', '����������');
define('text_eighteen', '������������');
define('text_nineteen', '������������');
define('text_twenty', '��������');
define('text_thirty', '��������');
define('text_forty', '�����');
define('text_fifty', '���������');
define('text_sixty', '����������');
define('text_seventy', '���������');
define('text_eighty', '�����������');
define('text_ninety', '���������');
define('text_hundred', '���');
define('text_two_hundred', '������');
define('text_three_hundred', '������');
define('text_four_hundred', '���������');
define('text_five_hundred', '�������');
define('text_six_hundred', '��������');
define('text_seven_hundred', '�������');
define('text_eight_hundred', '���������');
define('text_nine_hundred', '���������');
define('text_penny', '�������');
define('text_kopecks', '������');
define('text_single_kopek', '���� �������');
define('text_two_penny', '��� �������');
define('text_ruble', '�����');
define('text_rubles', '������');
define('text_one_ruble', '���� �����');
define('text_two_rubles', '��� �����');
define('text_thousands', '������');
define('text_thousand', '�����');
define('text_one_thousand', '���� ������');
define('text_two_thousand', '��� ������');
define('text_million', '��������');
define('text_millions', '���������');
define('text_one_million', '���� �������');
define('text_two_million', '��� ��������');
define('text_billion', '���������');
define('text_billions', '����������');
define('text_one_billion', '���� ��������');
define('text_two_billion', '��� ���������');
define('text_trillion', '���������');
define('text_trillions', '����������');
define('text_one_trillion', '���� ��������');
define('text_two_trillion', '��� ���������');

?>