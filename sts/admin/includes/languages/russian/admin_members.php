<?php
/*
  $Id: admin_members.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

if ($_GET['gID']) {
  define('HEADING_TITLE', '������');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', '��������� ������');
} else {
  define('HEADING_TITLE', '��������������');
}

define('TEXT_COUNT_GROUPS', '������: ');

define('TABLE_HEADING_NAME', '���');
define('TABLE_HEADING_EMAIL', 'Email �����');
define('TABLE_HEADING_PASSWORD', '������');
define('TABLE_HEADING_CONFIRM', '����������� ������');
define('TABLE_HEADING_GROUPS', '������');
define('TABLE_HEADING_CREATED', '���� ��������');
define('TABLE_HEADING_MODIFIED', '��������� ���������');
define('TABLE_HEADING_LOGDATE', '��������� ����');
define('TABLE_HEADING_LOGNUM', '���������� ������');
define('TABLE_HEADING_LOG_NUM', '���������� ������');
define('TABLE_HEADING_ACTION', '��������');

define('TABLE_HEADING_GROUPS_NAME', '�������� ������');
define('TABLE_HEADING_GROUPS_DEFINE', '����� � �����, ��������� ��� ������ ������');
define('TABLE_HEADING_GROUPS_GROUP', '������');
define('TABLE_HEADING_GROUPS_CATEGORIES', '��������� ����� � �����');


define('TEXT_INFO_HEADING_DEFAULT', '������������� ');
define('TEXT_INFO_HEADING_DELETE', '������� ������ ');
define('TEXT_INFO_HEADING_EDIT', '�������� ������ / ');
define('TEXT_INFO_HEADING_NEW', '����� ������������� ');

define('TEXT_INFO_DEFAULT_INTRO', '������');
define('TEXT_INFO_DELETE_INTRO', '�� ������������� ������ ������� <nobr><b>%s</b></nobr> �� <nobr>���������������?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', '�� �� ������ ������� ������ <nobr>%s!</nobr>');
define('TEXT_INFO_EDIT_INTRO', '����� ������� � ������ � ������: ');

define('TEXT_INFO_FULLNAME', '���: ');
define('TEXT_INFO_FIRSTNAME', '���: ');
define('TEXT_INFO_LASTNAME', '�������: ');
define('TEXT_INFO_EMAIL', 'Email �����: ');
define('TEXT_INFO_PASSWORD', '������: ');
define('TEXT_INFO_CONFIRM', '����������� ������: ');
define('TEXT_INFO_CREATED', '������ �������: ');
define('TEXT_INFO_MODIFIED', '��������� ���������: ');
define('TEXT_INFO_LOGDATE', '��������� ����: ');
define('TEXT_INFO_LOGNUM', '���������� ������: ');
define('TEXT_INFO_GROUP', '������: ');
define('TEXT_INFO_ERROR', '<font color="red">�������� Email ��� ���������������! ���������� ������� ������ �����.</font>');

define('JS_ALERT_FIRSTNAME',        '- �� �� ������� ��� ���. \n');
define('JS_ALERT_LASTNAME',         '- �� �� ������� ���� �������. \n');
define('JS_ALERT_EMAIL',            '- �� �� ������� ���� Email �����. \n');
define('JS_ALERT_EMAIL_FORMAT',     '- �� ����������� �������� Email �����! \n');
define('JS_ALERT_EMAIL_USED',       '- �������� Email ����� ��� ���������������! \n');
define('JS_ALERT_LEVEL', '- �� �� ������� ������ \n');

define('ADMIN_EMAIL_SUBJECT', '����� �������������');
define('ADMIN_EMAIL_TEXT', '������������, %s!' . "\n\n" . '�� ������ �������� � ������� �� �������� �������. ����� ���� ��� �� ������ � �������, �� ������������ ��� ����������� �������� ���� ������!' . "\n\n" . '����: %s' . "\n" . 'Email: %s' . "\n" . '������: %s' . "\n\n" . '�������!' . "\n" . '%s' . "\n\n" . '��� ������ ���������� �������������, �� ����� �� ���� ��������!'); 
define('ADMIN_EMAIL_EDIT_SUBJECT', '���� ���������� �������� ���������������');
define('ADMIN_EMAIL_EDIT_TEXT', '������������, %s!' . "\n\n" . '���� ���������� �������� ���������������.' . "\n\n" . '����: %s' . "\n" . 'Email: %s' . "\n" . '������: %s' . "\n\n" . '�������!' . "\n" . '%s' . "\n\n" . '��� ������ ���������� �������������, �� ����� �� ���� ��������!'); 

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', '������ ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', '������� ������ ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>��������:</b><li><b>��������:</b> ��������� �������� ������.</li><li><b>�������:</b> �������� ������.</li><li><b>������ � ������:</b> ��������� ������� � ������ � ������.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', '������ ������ ������, �� ����� �������� ���� ���������������, ����������� � ���� ������. �� ������������� ������ ������� ������ <nobr><b>%s</b>?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', '�� �� ������ ������� ������ ������!');
define('TEXT_INFO_GROUPS_INTRO', '����� �������� ����� ������, ����� ������� ������ "�����".');

define('TEXT_INFO_HEADING_GROUPS', '����� ������');
define('TEXT_INFO_GROUPS_NAME', ' <b>�������� ������:</b><br>������� �������� ����� ������, ����� ������� ������ "�����".<br>');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<font color="red"><b>������:</b> �������� ������ ������ �������� ������� �� 2 ��������!</font>');
define('TEXT_INFO_GROUPS_NAME_USED', '<font color="red"><b>������:</b> �������� �������� ������ ��� ����, ���������� ������� ������ ��-�������!</font>');
define('TEXT_INFO_GROUPS_LEVEL', '������: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>����� ������� � ������:</b><br>������������� ������� � ������.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', '�������� ���� � ����: ');

define('TEXT_INFO_HEADING_EDIT_GROUP', '�������� �������� ������');
define('TEXT_INFO_EDIT_GROUP_INTRO', '�� ������ �������� �������� ������ ������ �� �����, ������� ����� �������� � ������� ������ <b>���������</b>');

// BOF: KategorienAdmin / OLISWISS
define('TEXT_INFO_CATEGORIEACCESS','������:');
define('TEXT_RIGHTS_CNEW','��������� ���������');
define('TEXT_RIGHTS_CEDIT','�������� ���������');
define('TEXT_RIGHTS_CMOVE','���������� ���������');
define('TEXT_RIGHTS_CDELETE','������� ���������');
define('TEXT_RIGHTS_PNEW','��������� ������');
define('TEXT_RIGHTS_PEDIT','�������� ������');
define('TEXT_RIGHTS_PMOVE','���������� ������');
define('TEXT_RIGHTS_PCOPY','���������� ������');
define('TEXT_RIGHTS_PDELETE','������� ������');
define('TEXT_RIGHTS_ID','ID ���');
// EOF: KategorienAdmin / OLISWISS

define('TEXT_INFO_HEADING_DEFINE', '��������� ������');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>�� �� ������ �������� ������ � ������ � ������ ��� ���� ������.<br><br>');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>�� ������ ���������� ���� ����� ������ � ������ � ������ ��� ������ ������. ������� ����� ������  <b>���������</b> ��� ���������� �������� ���������.<br><br>');
}
?>
