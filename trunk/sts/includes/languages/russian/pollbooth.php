<?php
/*
  $Id: pollbooth.php,v 1.5 2003/04/06 21:45:33 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/
if (!isset($_GET['op'])) {
	$_GET['op']="list";
	}
if ($_GET['op']=='results') {
  define('TOP_BAR_TITLE', '���������� ������');
  define('HEADING_TITLE', '���������� ������');
  define('SUB_BAR_TITLE', '���������� ������');
}
if ($_GET['op']=='list') {
  define('TOP_BAR_TITLE', '���������� ������');
  define('HEADING_TITLE', '���������� ������');
  define('SUB_BAR_TITLE', '������ ������');
}
if ($_GET['op']=='vote') {
  define('TOP_BAR_TITLE', '���������� ������');
  define('HEADING_TITLE', '���������� ������');
  define('SUB_BAR_TITLE', '������������');
}
if ($_GET['op']=='comment') {
  define('HEADING_TITLE', '������');
}
define('_WARNING', '��������������: ');
define('_ALREADY_VOTED', '�� ��� ����������.');
define('_NO_VOTE_SELECTED', '�� �� ������� ����� ��� �����������.');
define('_TOTALVOTES', '����� �������');
define('_OTHERPOLLS', '������ ������');
define('NAVBAR_TITLE_1', '���������� ������');
define('_POLLRESULTS', '���������� ������');
define('_VOTING', '����������');
define('_RESULTS', '����������');
define('_VOTES', '�������');
define('_VOTE', '����������');
define('_COMMENT', '�����');
define('_COMMENTS', '������');
define('_COMMENTS_POSTED', '������ ���������');
define('_COMMENTS_BY', '����� ������� ');
define('_COMMENTS_ON', '  ');
define('_YOURNAME', '���� ���:');
define('_OTZYV', '�����:');
define('TEXT_CONTINUE', '�������� �����');
define('_PUBLIC','�������� �����������');
define('_PRIVATE','�������� �����������');
define('_POLLOPEN','����� ������');
define('_POLLCLOSED','����� ��� ������������������ �������������');
define('_POLLPRIVATE','����� ��� ������������������ �������������, ������� � �������, ����� ������ ��� ������������������ �������������');
define('_ADD_COMMENTS', '�������� �����');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> �������)');
?>
