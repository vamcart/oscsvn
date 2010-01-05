<?php
/*
  $Id: install.php,v 1.3 2004/11/07 21:02:11 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2004 osCommerce

  Released under the GNU General Public License
*/

  define('PAGE_TITLE_INSTALLATION', '����� ���������');
  define('TEXT_CUSTOMIZE_INSTALLATION', '�������� ����� ��������� ��������:');

  define('CONFIG_IMPORT_CATALOG_DATABASE', '������������� ���� ������:');
  define('CONFIG_IMPORT_CATALOG_DATABASE_DESCRIPTION', '������������� ���� ������ ��� ���������');
  define('CONFIG_IMPORT_CATALOG_DATABASE_DESCRIPTION_LONG', '��� ������ ��������� ��������-�������� ������ ����� ������ ���� ��������, ����� ��������-������� �������� �� �����. ����� �� �������� ������ �����, ���� �� ������ ������ �������� ����� ������������ (� �� ������� ������������ ���� ������) ��� <b>��������������</b> ��������-��������, ��������, ���� ���������� ���� �� ������ � �����.');

  define('CONFIG_AUTOMATIC_CONFIGURATION', '�������������� ���������:');
  define('CONFIG_AUTOMATIC_CONFIGURATION_DESCRIPTION', '�������������� ��������� ��������-��������');
  define('CONFIG_AUTOMATIC_CONFIGURATION_DESCRIPTION_LONG', '���� ������ ����� ��������, �� ��� ��������� ��������-�������� ��� ���� �� ������ � ����� ����� ������������� �������������, ��� ����� ����� ������ ������� ���������� ���� ������ MySQL. ������������� <b>��������</b> �������������� ���������, ���� �� �������������� ��������-������� �������.');

  define('PAGE_SUBTITLE_DATABASE_IMPORT', '������ ���� ������');
  define('TEXT_ENTER_DATABASE_INFORMATION', '����������, ������� ���������� ��� ������� � ���� ������:');

  define('CONFIG_DATABASE_SERVER', '������ ���� ������:');
  define('CONFIG_DATABASE_SERVER_DESCRIPTION', '����� ���� IP-����� ������� ���� ������.');
  define('CONFIG_DATABASE_SERVER_DESCRIPTION_LONG', '������ ������ ���� ������ ��������� �� ������ localhost, ���� �� �� ������ ����� ������� ���� ������, ��������� �� ����� �������-�����������.');

  define('CONFIG_DATABASE_USERNAME', '��� ������������:');
  define('CONFIG_DATABASE_USERNAME_DESCRIPTION', '��� ������������ ���� ������');
  define('CONFIG_DATABASE_USERNAME_DESCRIPTION_LONG', '��� ������������, ������������ ��� ����������� � ���� ������.<br>���� �� �� ������ ��� ������������ ��� ������� � ���� ������, ��������� �� ����� �������-�����������.');
  define('CONFIG_DATABASE_USERNAME_RESTRICTED_DESCRIPTION_LONG', '��� ������������, ������������ ��� ����������� � ���� ������.<br>���� �� �� ������ ��� ������������ ��� ������� � ���� ������, ��������� �� ����� �������-�����������.');

  define('CONFIG_DATABASE_PASSWORD', '������:');
  define('CONFIG_DATABASE_PASSWORD_DESCRIPTION', '������ ������� � ���� ������');
  define('CONFIG_DATABASE_PASSWORD_DESCRIPTION_LONG', '������, ������������ ��� ����������� � ���� ������. <br>���� �� �� ������ ������ ��� ������� � ���� ������, ��������� �� ����� �������-�����������.');

  define('CONFIG_DATABASE_NAME', '��� ���� ������:');
  define('CONFIG_DATABASE_NAME_DESCRIPTION', '��� ���� ������');
  define('CONFIG_DATABASE_NAME_DESCRIPTION_LONG', '��� ���� ������, ������� ����� �������������� ��� ��������� ��������-��������.<br>���� �� �� ������ ��� ���� ������, ��������� �� ����� �������-�����������.');

  define('CONFIG_DATABASE_TABLE_PREFIX', 'Database Table Prefix:');
  define('CONFIG_DATABASE_TABLE_PREFIX_DESCRIPTION', 'Database table prefix');
  define('CONFIG_DATABASE_TABLE_PREFIX_DESCRIPTION_LONG', 'The prefix to use for the database tables created. An example table prefix is \'osc_\' which would create a table name of osc_products.');

  define('CONFIG_DATABASE_PERSISTENT_CONNECTIONS', '���������� �����������:');
  define('CONFIG_DATABASE_PERSISTENT_CONNECTIONS_DESCRIPTION', '');
  define('CONFIG_DATABASE_PERSISTENT_CONNECTIONS_DESCRIPTION_LONG', '������������ ���������� ����������� � ���� ������.<br>������������� <b>��</b> �������� ������ �����. ��������� ������ �����, ���� � ��� ���������� ������.');

  define('CONFIG_DATABASE_CLASS', 'Database Type:');
  define('CONFIG_DATABASE_CLASS_DESCRIPTION', '');
  define('CONFIG_DATABASE_CLASS_DESCRIPTION_LONG', 'The database type to use.<br><br>"Transaction-Safe" database types are recommended however will only be used if the database server supports transactions.');

  define('CONFIG_SESSION_STORAGE', '������� ������ �:');
  define('CONFIG_SESSION_STORAGE_FILES', '������');
  define('CONFIG_SESSION_STORAGE_DATABASE', '���� ������');
  define('CONFIG_SESSION_STORAGE_DESCRIPTION', '');
  define('CONFIG_SESSION_STORAGE_DESCRIPTION_LONG', '��������, ��� ������� ������: � ������ ��� � ���� ������.<br>��������: ������������� ������� ������ � ���� ������, �.�. ��� �������� ���������� �������.');

  define('CONFIG_IMPORT_SAMPLE_DATA', 'Import Sample Data:');
  define('CONFIG_IMPORT_SAMPLE_DATA_DESCRIPTION', '');
  define('CONFIG_IMPORT_SAMPLE_DATA_DESCRIPTION_LONG', 'Insert sample data into the database (recommended for first time installations).');

  define('ERROR_UNSUCCESSFUL_DATABASE_TYPE', '<p>The selected database type of <b>%s</b> is not supported by the database server. The database table type will be set back to the default value of <b>%s</b>.</p>');
  define('ERROR_UNSUCCESSFUL_DATABASE_CONNECTION', '<p>���������� � ����� ������ <b>��</b> ���� �����������.</p><p>��������� �� ������:</p><p class="boxme">%s</p><p>������� <i>���������</i> ����� ��������� ���������� ������.</p>
      <p>���� �� �� ������ ���������� ��� ������� � ����� ���� ������, ��������� � ����� �������-�����������.</p>');

  define('TEXT_SUCCESSFUL_DATABASE_CONNECTION', '<p>���������� � ����� ������ <b>�������</b> �����������.</p><p>����������� ��������� ���������, ����� ����� ��������� ������ ��������-�������� � ���� ���� ������.</p><p>��� ������ ���� ��������� ��������, ���� ������ ��������-�������� �� ����� ��������� � ���� ������, ��������-������� �������� �� �����.</p>');
  define('TEXT_IMPORT_SQL', '<p>���� � ������� ��������-�������� ������ ���������� �� ������:</p><p>%s</p>');
  define('TEXT_IMPORT_DATA_SAMPLE_SQL', '<p>The sample data file to import must be located and named at:</p><p>%s</p>');

  define('ERROR_UNSUCCESSFUL_DATABASE_IMPORT', '<p>��������� ��������� ������:</p><p class="boxme">%s</p>');

  define('TEXT_SUCCESSFUL_DATABASE_IMPORT', '���� ������ <b>�������</b> ���������!');

  define('PAGE_SUBTITLE_OSCOMMERCE_CONFIGURATION', '��������� osCommerce');
  define('TEXT_ENTER_WEBSERVER_INFORMATION', '����������, ������� ���������� � ����� ��������-��������:');

  define('CONFIG_WWW_ADDRESS', 'WWW �����:');
  define('CONFIG_WWW_ADDRESS_DESCRIPTION', '������ ����� ��������-��������');
  define('CONFIG_WWW_ADDRESS_DESCRIPTION_LONG', '����� ��������-��������, �������� <i>http://www.my-server.com/catalog/</i>');

  define('CONFIG_WWW_ROOT_DIRECTORY', '���������� ��������-��������:');
  define('CONFIG_WWW_ROOT_DIRECTORY_DESCRIPTION', '���� �� ����������, ��� ��������� ��������-�������');
  define('CONFIG_WWW_ROOT_DIRECTORY_DESCRIPTION_LONG', '������ ���� �� ����������, ��� ��������� ��������-�������, �������� <i>/home/myname/public_html/oscommerce/</i><br> � ����������� �������, ��� �� ����� ����������� ���� �� ����������, ������ ��������� ������������� ��������� ��������������� �������� � �������� ���� �� ���������� �������������.');

  define('CONFIG_WWW_HTTP_COOKIE_DOMAIN', 'Cookie �����:');
  define('CONFIG_WWW_HTTP_COOKIE_DOMAIN_DESCRIPTION', '�����, ��� �������� ����� ������������ cookies');
  define('CONFIG_WWW_HTTP_COOKIE_DOMAIN_DESCRIPTION_LONG', '����� ������ ���� ������ ������ ����� ������� ������. ��������, ���� ��������-������� ��������������� � http://www.my-server.com/catalog/ ��� http://shop.my-server.com ��� ������ http://www.my-server.com, ����� ����� ������ <i>my-server.com</i><br> � ����������� �������, ��� �� ����� ����������� �����, ������ ��������� ������������� ��������� ����� � �������� ��� �������������.');

  define('CONFIG_WWW_HTTP_COOKIE_PATH', 'Cookie ����:');
  define('CONFIG_WWW_HTTP_COOKIE_PATH_DESCRIPTION', '����, ��� ����� ��������� cookies');
  define('CONFIG_WWW_HTTP_COOKIE_PATH_DESCRIPTION_LONG', '�������� <i>/catalog/</i><br> � ����������� �������, ��� �� ����� ����������� ����, ������ ��������� ������������� ��������� ���� � �������� ��� �������������.');

  define('CONFIG_ENABLE_SSL', '������������ SSL:');
  define('CONFIG_ENABLE_SSL_DESCRIPTION', '');
  define('CONFIG_ENABLE_SSL_DESCRIPTION_LONG', '������������ ���������� �� ����������� ��������� SSL/HTTPS. ���� �� �� ������, ��� ����� SSL, ��� ����������� ������ ��������, <b>������������</b> ������������� <b>��</b> ������������ SSL, ����� ��������-������� �������� �� �����.');

  define('CONFIG_WWW_WORK_DIRECTORY', 'Work Directory:');
  define('CONFIG_WWW_WORK_DIRECTORY_DESCRIPTION', 'The path to store osCommerce work data under (cache, sessions)');
  define('CONFIG_WWW_WORK_DIRECTORY_DESCRIPTION_LONG', 'This path should be located <u>outside</u> the public HTML directory. (please avoid /tmp/ for security reasons)');

  define('ERROR_WORK_DIRECTORY_NON_EXISTANT', '<p>The following error has occurred:</p><p><div class="boxMe"><b>The work directory does not exist.</b><br><br>Please perform the following actions:<ul class="boxMe"><li>mkdir %s</li></ul></div></p>');
  define('ERROR_WORK_DIRECTORY_NOT_WRITEABLE', '<p>The following error has occurred:</p><p><div class="boxMe"><b>The work directory cannot be written to by the web server.</b><br><br>Please perform the following actions:<ul class="boxMe"><li>chmod 706 %s</li></ul></div></p><p class="noteBox">If <i>chmod 706</i> does not work, please try <i>chmod 777</i>.</p>');

  define('TEXT_ENTER_SECURE_WEBSERVER_INFORMATION', '����������, ������� ���������� � ���������� SSL ����������:');

  define('CONFIG_WWW_HTTPS_ADDRESS', 'SSL WWW �����:');
  define('CONFIG_WWW_HTTPS_ADDRESS_DESCRIPTION', '������ SSL ����� ��������-��������');
  define('CONFIG_WWW_HTTPS_ADDRESS_DESCRIPTION_LONG', 'SSL ����� ��������-��������, �������� <i>https://ssl.my-hosting-company.com/my_name/catalog/</i><br> � ����������� �������, ��� �� ����� ����������� �����, ������ ��������� ������������� ��������� ����� � �������� ��� �������������.');

  define('CONFIG_WWW_HTTPS_COOKIE_DOMAIN', 'SSL Cookie �����:');
  define('CONFIG_WWW_HTTPS_COOKIE_DOMAIN_DESCRIPTION', '�����, ��� �������� ����� ������������ cookies');
  define('CONFIG_WWW_HTTPS_COOKIE_DOMAIN_DESCRIPTION_LONG', '����� ������ ���� ������ ������ ����� ������� ������, �������� <i>ssl.my-hosting-company.com</i><br> � ����������� �������, ��� �� ����� ����������� �����, ������ ��������� ������������� ��������� ����� � �������� ��� �������������.');

  define('CONFIG_WWW_HTTPS_COOKIE_PATH', 'SSL Cookie ����:');
  define('CONFIG_WWW_HTTPS_COOKIE_PATH_DESCRIPTION', '����, ��� ����� ��������� cookies');
  define('CONFIG_WWW_HTTPS_COOKIE_PATH_DESCRIPTION_LONG', '�������� <i>/my_name/catalog/</i><br> � ����������� �������, ��� �� ����� ����������� ����, ������ ��������� ������������� ��������� ���� � �������� ��� �������������.');

  define('ERROR_CONFIG_FILE_NOT_WRITEABLE', '<p>��������� ��������� ������:</p><p><div class="boxMe"><b>����� �������� ���� �����������, ���� ����������� �������� ����� �������.</b><br><br>���������� ����� ������� 706 �� ��������� ����:<ul class="boxMe"><li>cd %sincludes/</li><li>touch configure.php</li><li>chmod 706 configure.php</li></ul></div></p><p class="noteBox">���� <i>chmod 706</i> �� ������������, ���������� <i>chmod 777</i>.</p><p class="noteBox">� ������������ ������� Windows �� ������ ������ ���������, ��� ������ ����� <b>��</b> ����� ������� <b>������ ��� ������</b>.</p>');

  define('ERROR_CONFIG_ADMIN_FILE_NOT_WRITEABLE', '<p>��������� ��������� ������:</p><p><div class="boxMe"><b>����� �������� ���� �����������, ���� ����������� �������� ����� �������.</b><br><br>���������� ����� ������� 706 �� ��������� ����:<ul class="boxMe"><li>cd %sadmin/includes/</li><li>touch configure.php</li><li>chmod 706 configure.php</li></ul></div></p><p class="noteBox">���� <i>chmod 706</i> �� ������������, ���������� <i>chmod 777</i>.</p><p class="noteBox">� ������������ ������� Windows �� ������ ������ ���������, ��� ������ ����� <b>��</b> ����� ������� <b>������ ��� ������</b>.</p>');

  define('TEXT_SUCCESSFUL_CONFIGURATION', '��������� ���������������� ������ ���������!');
  define('TEXT_SUCCESSFUL1_CONFIGURATION', '��������� ��������-�������� ���������!<br><br>��� ����� � ����������������� ����������� ��������� ������:<br>E-Mail �����: <b>admin@localhost.com</b><br>������: <b>admin</b><br>����� ����� � ����������������� ����������� ���������� ����� e-mail ����� � ������ ��� �����.<br>');
?>
