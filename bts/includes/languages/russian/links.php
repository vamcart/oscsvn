<?php
/*
  $Id: links.php,v 1.00 2003/10/03 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', '������');

if ($display_mode == 'links') {
  define('HEADING_TITLE', '������');
  define('TABLE_HEADING_LINKS_IMAGE', '');
  define('TABLE_HEADING_LINKS_TITLE', '��������');
  define('TABLE_HEADING_LINKS_URL', 'URL �����');
  define('TABLE_HEADING_LINKS_DESCRIPTION', '��������');
  define('TABLE_HEADING_LINKS_COUNT', '�����');
  define('TEXT_NO_LINKS', '� ������ ������� ��� �� ����� ������.');
} elseif ($display_mode == 'categories') {
  define('HEADING_TITLE', '�������');
  define('TEXT_NO_CATEGORIES', '��� �� ������ �������.');
}

// VJ todo - move to common language file
define('TEXT_DISPLAY_NUMBER_OF_LINKS', '�������� <b>%d</b> - <b>%d</b> (����� <b>%d</b> ������)');

define('IMAGE_BUTTON_SUBMIT_LINK', '�������� ������');
?>
