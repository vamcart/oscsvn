<?php
/*
  $Id: privacy.php,v 1.3 2001/12/20 14:14:15 dgw_ Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'RSS ������');
define('HEADING_TITLE', 'RSS ������');
define('TEXT_INFORMATION', '


<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=news' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=news</a> - �������.<br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=articles' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=articles</a> - ������.<br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=categories' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=categories</a> - ���������.<br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=products&limit=10' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=products&limit=10</a> - ������.<br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=products&products_id=1' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=products&products_id=1</a> - ����� � id ����� 1.</a><br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=products&cPath=28&limit=10' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=products&cPath=28&limit=10</a> - ������ � ��������� (28 ��� ������������� ���������, �������������� ����� ������, � ������� � ?feed=categories, � ������ ���������, �.�. �� ������ ���������� ������ ������ �� ����������� ���������).<br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=new_products&limit=10' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=new_products&limit=10</a> - �������.</a><br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=best_sellers&limit=10' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=best_sellers&limit=10</a> - ������ ������.<br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=specials&limit=10' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=specials&limit=10</a> - ������.<br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=featured&limit=10' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=featured&limit=10</a> - ������������� ������.<br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=upcoming&limit=10' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=upcoming&limit=10</a> - ��������� ������.<br>

<br>

<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=new_products_random' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=new_products_random</a> - ��������� ����� �� ����� �������.<br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=best_sellers_random' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=best_sellers_random</a> - ��������� ����� �� ������ �������.<br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=specials_random' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=specials_random</a> - ��������� ����� �� ������.<br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=featured_random' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=featured_random</a> - ��������� ����� �� ������������� �������.<br>
<a href="' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=upcoming_random' .'">' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_RSS2. '?feed=upcoming_random</a> - ��������� ����� �� ��������� �������.<br>
<br />
<h3>����� ��������</h3>
<p>�������� �������� �� �������� limit.<br />
����� ��������, � �������, �� ��� ������� (rss2.php?feed=new_products), � ������ 10, ������ ���������� �������� limit (rss2.php?feed=new_products&amp;limit=10)</p>
<h3>���������� ID ���</h3>
<p>�������� �������� �� �������� ref.<br />
���� � ��� � �������� ���������� ������ ���������� ���������, ���� ������� ����� �������� RSS ������ �� ����� ���������� �����, ��������, ������ � id ����� 1 ����� �������� ������ ������� ��������� ������� rss2.php?feed=new_products&amp;ref=1</p>
');

?>