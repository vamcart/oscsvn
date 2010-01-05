<?php
/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('TEXT_MAIN', '');
define('TABLE_HEADING_NEW_ARTICLES', '����� ������ � ������� %s');
define('TEXT_ARTICLES_SEARCH', '����� � �������: ');

if ( ($topic_depth == 'articles') || (isset($_GET['authors_id'])) ) {
  define('HEADING_TITLE', $topics['topics_name']);
  define('TABLE_HEADING_ARTICLES', '������');
  define('TABLE_HEADING_AUTHOR', '�����');
  define('TEXT_NO_ARTICLES', '�� ������ ������ ��� ������ � ������ �������.');
  define('TEXT_NO_ARTICLES2', '�� ������ ������ ��� �������������� ������ ������ �������.');
  define('TEXT_NUMBER_OF_ARTICLES', '���������� ������: ');
  define('TEXT_SHOW', '��������:');
  define('TEXT_NOW', '\' ������');
  define('TEXT_ALL_TOPICS', '��� �������');
  define('TEXT_ALL_AUTHORS', '��� ������');
  define('TEXT_ARTICLES_BY', '������ ������ ');
  define('TEXT_ARTICLES', '������ ������ �� ���� ���������� � ������� ��������:');
  define('TEXT_DATE_ADDED', '������������:');
  define('TEXT_AUTHOR', '�����:');
  define('TEXT_TOPIC', '������');
  define('TEXT_BY', '�����:');
  define('TEXT_READ_MORE', '������ �����...');
  define('TEXT_MORE_INFORMATION', '��� ��������� ������������� ����������, �������� <a href="http://%s" target="_blank">���� ������</a>.');
} elseif ($topic_depth == 'top') {
  define('HEADING_TITLE', '��� ������');
  define('TEXT_ALL_ARTICLES', '������ ������ �� ���� ���������� � ������� ��������:');
  define('TEXT_CURRENT_ARTICLES', '');
  define('TEXT_UPCOMING_ARTICLES', '������, ������� ����� ������������ � ��������� �����.');
  define('TEXT_NO_ARTICLES', '��� ��������� ������.');
  define('TEXT_DATE_ADDED', '������������:');
  define('TEXT_DATE_EXPECTED', '���������:');
  define('TEXT_AUTHOR', '�����:');
  define('TEXT_TOPIC', '������
  :');
  define('TEXT_BY', 'by');
  define('TEXT_READ_MORE', '������ �����...');
} elseif ($topic_depth == 'nested') {
  define('HEADING_TITLE', '������');
}

  define('HEADING_TITLE', '������');

?>
