<?php
/*
  $Id: gv_send.php,v 1.1.1.1 2003/09/18 19:04:28 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('HEADING_TITLE', '��������� ����������');
define('NAVBAR_TITLE', '��������� ����������');
define('EMAIL_SUBJECT', '��������� �� ��������-��������');
define('HEADING_TEXT','<br>����� ��������� ����������, �� ������ ��������� ��������� �����.<br>');
define('ENTRY_NAME', '��� ����������:');
define('ENTRY_EMAIL', 'E-Mail ����� ����������:');
define('ENTRY_MESSAGE', '���������:');
define('ENTRY_AMOUNT', '����� �����������:');
define('ERROR_ENTRY_AMOUNT_CHECK', '&nbsp;&nbsp;<span class="errorText">�������� �����</span>');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', '&nbsp;&nbsp;<span class="errorText">�������� Email �����</span>');
define('MAIN_MESSAGE', '�� ������ ��������� ���������� �� ����� %s ������ ��������� %s, ��� Email �����: %s<br><br>���������� ����������� ������� ��������� ���������:<br><br>��������� %s<br><br>
                        ��� ��������� ���������� �� ����� %s, �����������: %s');

define('PERSONAL_MESSAGE', '%s �����:');
define('TEXT_SUCCESS', '�����������, ��� ���������� ������� ���������');


define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER', '�����������, �� �������� ���������� �� ����� %s');
define('EMAIL_GV_TEXT_SUBJECT', '������� �� %s');
define('EMAIL_GV_FROM', '����������� ����� ����������� - %s');
define('EMAIL_GV_MESSAGE', '��������� �����������: ');
define('EMAIL_GV_SEND_TO', '������������, %s');
define('EMAIL_GV_REDEEM', '����� �������������� ����������, �������� ������, ������� ����������� ����. ��� �����������: %s');
define('EMAIL_GV_LINK', '�������� �����, ����� �������������� ���������� ');
define('EMAIL_GV_VISIT', ' ��� ������� ���� ');
define('EMAIL_GV_ENTER', ' � ������� ��� ����������� ');
define('EMAIL_GV_FIXED_FOOTER', '���� � ��� ��������� �������� ��� ����������� ����������� � ������� ������, ��������� ����, ' . "\n" . 
                                '�� ����������� ������� ��� ����������� ��� ���������� ������, � �� ����� ������, ��������� ����.' . "\n\n");
define('EMAIL_GV_SHOP_FOOTER', '');
?>