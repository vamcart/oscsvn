<?php

if ( ($category_depth == 'products') ) {

define('HEADING_TITLE', '�������');
define('NAVBAR_TITLE', '�������');

define('TABLE_HEADING_IMAGE', '��������');
define('TABLE_HEADING_ARTICLE_NAME', '���������');
define('TABLE_HEADING_ARTICLE_SHORTTEXT', '������');
define('TABLE_HEADING_ARTICLE_DESCRIPTION', '����������');
define('TABLE_HEADING_STATUS', '������');
define('TABLE_HEADING_DATE_AVAILABLE', '����');
define('TABLE_HEADING_ARTRICLE_URL', 'URL ���������');

define('TEXT_NO_ARTICLES', '� ������ ������� ��� ��������.');

define('TEXT_NUMBER_OF_ARTICLES', '���������� ��������: ');
define('TEXT_SHOW', '<b>��������:</b>');

} elseif ($category_depth == 'top') {

define('HEADING_TITLE', '��� ������?');

} elseif ($category_depth == 'nested') {

define('HEADING_TITLE', '�������');

}

?>