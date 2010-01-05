<?php
/*
  $Id: install.php,v 1.3 2004/11/07 21:02:11 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2004 osCommerce

  Released under the GNU General Public License
*/

  define('PAGE_TITLE_INSTALLATION', 'Новая установка');
  define('TEXT_CUSTOMIZE_INSTALLATION', 'Выберите режим установки магазина:');

  define('CONFIG_IMPORT_CATALOG_DATABASE', 'Импортировать базу данных:');
  define('CONFIG_IMPORT_CATALOG_DATABASE_DESCRIPTION', 'Импортировать базу данных при установке');
  define('CONFIG_IMPORT_CATALOG_DATABASE_DESCRIPTION_LONG', 'При первой установке интернет-магазина данная опция должна быть включена, иначе интернет-магазин работать не будет. Можно не отмечать данную опцию, если Вы хотите только обновить файлы конфигураций (и не трогать существующую базу данных) уже <b>установленного</b> интернет-магазина, например, если изменились пути до файлов и папок.');

  define('CONFIG_AUTOMATIC_CONFIGURATION', 'Автоматическая настройка:');
  define('CONFIG_AUTOMATIC_CONFIGURATION_DESCRIPTION', 'Автоматическая настройка интернет-магазина');
  define('CONFIG_AUTOMATIC_CONFIGURATION_DESCRIPTION_LONG', 'Если данная опция включена, то при установке интернет-магазина все пути до файлов и папок будут настраиваться автоматически, Вам нужно будет только указать координаты базы данных MySQL. Рекомендуется <b>включать</b> автоматическую настройку, если Вы устанавливаете интернет-магазин впервые.');

  define('PAGE_SUBTITLE_DATABASE_IMPORT', 'Импорт базы данных');
  define('TEXT_ENTER_DATABASE_INFORMATION', 'Пожалуйста, укажите информацию для доступа к базе данных:');

  define('CONFIG_DATABASE_SERVER', 'Сервер базы данных:');
  define('CONFIG_DATABASE_SERVER_DESCRIPTION', 'Адрес либо IP-адрес сервера базы данных.');
  define('CONFIG_DATABASE_SERVER_DESCRIPTION_LONG', 'Обычно сервер базы данных находится по адресу localhost, если Вы не знаете адрес сервера базы данных, свяжитесь со своим хостинг-провайдером.');

  define('CONFIG_DATABASE_USERNAME', 'Имя пользователя:');
  define('CONFIG_DATABASE_USERNAME_DESCRIPTION', 'Имя пользователя базы данных');
  define('CONFIG_DATABASE_USERNAME_DESCRIPTION_LONG', 'Имя пользователя, используемое для подключения к базе данных.<br>Если Вы не знаете имя пользователя для доступа к базе данных, свяжитесь со своим хостинг-провайдером.');
  define('CONFIG_DATABASE_USERNAME_RESTRICTED_DESCRIPTION_LONG', 'Имя пользователя, используемое для подключения к базе данных.<br>Если Вы не знаете имя пользователя для доступа к базе данных, свяжитесь со своим хостинг-провайдером.');

  define('CONFIG_DATABASE_PASSWORD', 'Пароль:');
  define('CONFIG_DATABASE_PASSWORD_DESCRIPTION', 'Пароль доступа к базе данных');
  define('CONFIG_DATABASE_PASSWORD_DESCRIPTION_LONG', 'Пароль, используемый для подключения к базе данных. <br>Если Вы не знаете пароль для доступа к базе данных, свяжитесь со своим хостинг-провайдером.');

  define('CONFIG_DATABASE_NAME', 'Имя базы данных:');
  define('CONFIG_DATABASE_NAME_DESCRIPTION', 'Имя базы данных');
  define('CONFIG_DATABASE_NAME_DESCRIPTION_LONG', 'Имя базы данных, которая будет использоваться для установки интернет-магазина.<br>Если Вы не знаете имя базы данных, свяжитесь со своим хостинг-провайдером.');

  define('CONFIG_DATABASE_TABLE_PREFIX', 'Database Table Prefix:');
  define('CONFIG_DATABASE_TABLE_PREFIX_DESCRIPTION', 'Database table prefix');
  define('CONFIG_DATABASE_TABLE_PREFIX_DESCRIPTION_LONG', 'The prefix to use for the database tables created. An example table prefix is \'osc_\' which would create a table name of osc_products.');

  define('CONFIG_DATABASE_PERSISTENT_CONNECTIONS', 'Постоянное подключение:');
  define('CONFIG_DATABASE_PERSISTENT_CONNECTIONS_DESCRIPTION', '');
  define('CONFIG_DATABASE_PERSISTENT_CONNECTIONS_DESCRIPTION_LONG', 'Использовать постоянное подключение к базе данных.<br>Рекомендуется <b>не</b> включать данную опцию. Включайте данную опцию, если у Вас выделенный сервер.');

  define('CONFIG_DATABASE_CLASS', 'Database Type:');
  define('CONFIG_DATABASE_CLASS_DESCRIPTION', '');
  define('CONFIG_DATABASE_CLASS_DESCRIPTION_LONG', 'The database type to use.<br><br>"Transaction-Safe" database types are recommended however will only be used if the database server supports transactions.');

  define('CONFIG_SESSION_STORAGE', 'Хранить сессии в:');
  define('CONFIG_SESSION_STORAGE_FILES', 'Файлах');
  define('CONFIG_SESSION_STORAGE_DATABASE', 'Базе данных');
  define('CONFIG_SESSION_STORAGE_DESCRIPTION', '');
  define('CONFIG_SESSION_STORAGE_DESCRIPTION_LONG', 'Выберите, где хранить сессии: в файлах или в базе данных.<br>Внимание: Рекомендуется хранить сессии в базе данных, т.к. это наиболее безопасный вариант.');

  define('CONFIG_IMPORT_SAMPLE_DATA', 'Import Sample Data:');
  define('CONFIG_IMPORT_SAMPLE_DATA_DESCRIPTION', '');
  define('CONFIG_IMPORT_SAMPLE_DATA_DESCRIPTION_LONG', 'Insert sample data into the database (recommended for first time installations).');

  define('ERROR_UNSUCCESSFUL_DATABASE_TYPE', '<p>The selected database type of <b>%s</b> is not supported by the database server. The database table type will be set back to the default value of <b>%s</b>.</p>');
  define('ERROR_UNSUCCESSFUL_DATABASE_CONNECTION', '<p>Соединение с базой данных <b>НЕ</b> было установлено.</p><p>Сообщение об ошибке:</p><p class="boxme">%s</p><p>Нажмите <i>Вернуться</i> чтобы исправить допущенные ошибки.</p>
      <p>Если Вы не знаете информации для доступа к своей базе данных, свяжитесь с Вашим хостинг-провайдером.</p>');

  define('TEXT_SUCCESSFUL_DATABASE_CONNECTION', '<p>Соединение с базой данных <b>успешно</b> установлено.</p><p>Продолжайте процедуру установки, далее будут загружены данные интернет-магазина в Вашу базу данных.</p><p>Это важный этап установки магазина, если данные интернет-магазина не будут загружены в базу данных, интернет-магазин работать не будет.</p>');
  define('TEXT_IMPORT_SQL', '<p>Файл с данными интернет-магазина должен находиться по адресу:</p><p>%s</p>');
  define('TEXT_IMPORT_DATA_SAMPLE_SQL', '<p>The sample data file to import must be located and named at:</p><p>%s</p>');

  define('ERROR_UNSUCCESSFUL_DATABASE_IMPORT', '<p>Произошла следующая ошибка:</p><p class="boxme">%s</p>');

  define('TEXT_SUCCESSFUL_DATABASE_IMPORT', 'База данных <b>успешно</b> загружена!');

  define('PAGE_SUBTITLE_OSCOMMERCE_CONFIGURATION', 'Настройка osCommerce');
  define('TEXT_ENTER_WEBSERVER_INFORMATION', 'Пожалуйста, укажите информацию о Вашем интернет-магазине:');

  define('CONFIG_WWW_ADDRESS', 'WWW Адрес:');
  define('CONFIG_WWW_ADDRESS_DESCRIPTION', 'Полный адрес интернет-магазина');
  define('CONFIG_WWW_ADDRESS_DESCRIPTION_LONG', 'Адрес интернет-магазина, например <i>http://www.my-server.com/catalog/</i>');

  define('CONFIG_WWW_ROOT_DIRECTORY', 'Директория интернет-магазина:');
  define('CONFIG_WWW_ROOT_DIRECTORY_DESCRIPTION', 'Путь до директории, где находится интернет-магазин');
  define('CONFIG_WWW_ROOT_DIRECTORY_DESCRIPTION_LONG', 'Полный путь до директории, где находится интернет-магазин, например <i>/home/myname/public_html/oscommerce/</i><br> В большинстве случаев, Вам не нужно прописывать путь до директории, скрипт установки автоматически определит местонахождение магазина и пропишет путь до директории автоматически.');

  define('CONFIG_WWW_HTTP_COOKIE_DOMAIN', 'Cookie Домен:');
  define('CONFIG_WWW_HTTP_COOKIE_DOMAIN_DESCRIPTION', 'Домен, для которого будут записываться cookies');
  define('CONFIG_WWW_HTTP_COOKIE_DOMAIN_DESCRIPTION_LONG', 'Здесь должен быть указан только домен второго уровня. Например, если интернет-магазин устанавливается в http://www.my-server.com/catalog/ или http://shop.my-server.com или просто http://www.my-server.com, тогда нужно писать <i>my-server.com</i><br> В большинстве случаев, Вам не нужно прописывать домен, скрипт установки автоматически определит домен и пропишет его автоматически.');

  define('CONFIG_WWW_HTTP_COOKIE_PATH', 'Cookie путь:');
  define('CONFIG_WWW_HTTP_COOKIE_PATH_DESCRIPTION', 'Путь, где будут храниться cookies');
  define('CONFIG_WWW_HTTP_COOKIE_PATH_DESCRIPTION_LONG', 'Например <i>/catalog/</i><br> В большинстве случаев, Вам не нужно прописывать путь, скрипт установки автоматически определит путь и пропишет его автоматически.');

  define('CONFIG_ENABLE_SSL', 'Использовать SSL:');
  define('CONFIG_ENABLE_SSL_DESCRIPTION', '');
  define('CONFIG_ENABLE_SSL_DESCRIPTION_LONG', 'Использовать соединение по безопасному протоколу SSL/HTTPS. Если Вы не знаете, что такое SSL, как настраивать данный протокол, <b>настоятельно</b> рекомендуется <b>не</b> использовать SSL, иначе интернет-магазин работать не будет.');

  define('CONFIG_WWW_WORK_DIRECTORY', 'Work Directory:');
  define('CONFIG_WWW_WORK_DIRECTORY_DESCRIPTION', 'The path to store osCommerce work data under (cache, sessions)');
  define('CONFIG_WWW_WORK_DIRECTORY_DESCRIPTION_LONG', 'This path should be located <u>outside</u> the public HTML directory. (please avoid /tmp/ for security reasons)');

  define('ERROR_WORK_DIRECTORY_NON_EXISTANT', '<p>The following error has occurred:</p><p><div class="boxMe"><b>The work directory does not exist.</b><br><br>Please perform the following actions:<ul class="boxMe"><li>mkdir %s</li></ul></div></p>');
  define('ERROR_WORK_DIRECTORY_NOT_WRITEABLE', '<p>The following error has occurred:</p><p><div class="boxMe"><b>The work directory cannot be written to by the web server.</b><br><br>Please perform the following actions:<ul class="boxMe"><li>chmod 706 %s</li></ul></div></p><p class="noteBox">If <i>chmod 706</i> does not work, please try <i>chmod 777</i>.</p>');

  define('TEXT_ENTER_SECURE_WEBSERVER_INFORMATION', 'Пожалуйста, укажите информацию о безопасном SSL соединении:');

  define('CONFIG_WWW_HTTPS_ADDRESS', 'SSL WWW адрес:');
  define('CONFIG_WWW_HTTPS_ADDRESS_DESCRIPTION', 'Полный SSL Адрес интернет-магазина');
  define('CONFIG_WWW_HTTPS_ADDRESS_DESCRIPTION_LONG', 'SSL Адрес интернет-магазина, например <i>https://ssl.my-hosting-company.com/my_name/catalog/</i><br> В большинстве случаев, Вам не нужно прописывать адрес, скрипт установки автоматически определит адрес и пропишет его автоматически.');

  define('CONFIG_WWW_HTTPS_COOKIE_DOMAIN', 'SSL Cookie домен:');
  define('CONFIG_WWW_HTTPS_COOKIE_DOMAIN_DESCRIPTION', 'Домен, для которого будут записываться cookies');
  define('CONFIG_WWW_HTTPS_COOKIE_DOMAIN_DESCRIPTION_LONG', 'Здесь должен быть указан только домен второго уровня, например <i>ssl.my-hosting-company.com</i><br> В большинстве случаев, Вам не нужно прописывать домен, скрипт установки автоматически определит домен и пропишет его автоматически.');

  define('CONFIG_WWW_HTTPS_COOKIE_PATH', 'SSL Cookie путь:');
  define('CONFIG_WWW_HTTPS_COOKIE_PATH_DESCRIPTION', 'Путь, где будут храниться cookies');
  define('CONFIG_WWW_HTTPS_COOKIE_PATH_DESCRIPTION_LONG', 'Например <i>/my_name/catalog/</i><br> В большинстве случаев, Вам не нужно прописывать путь, скрипт установки автоматически определит путь и пропишет его автоматически.');

  define('ERROR_CONFIG_FILE_NOT_WRITEABLE', '<p>Исправьте следующие ошибки:</p><p><div class="boxMe"><b>Файлы настроек либо отсутствуют, либо установлены неверные права доступа.</b><br><br>Установите права доступа 706 на следующий файл:<ul class="boxMe"><li>cd %sincludes/</li><li>touch configure.php</li><li>chmod 706 configure.php</li></ul></div></p><p class="noteBox">Если <i>chmod 706</i> не выставляется, попробуйте <i>chmod 777</i>.</p><p class="noteBox">В операционной системе Windows вы просто должны убедиться, что данные файлы <b>не</b> имеют атрибут <b>Только для чтения</b>.</p>');

  define('ERROR_CONFIG_ADMIN_FILE_NOT_WRITEABLE', '<p>Исправьте следующие ошибки:</p><p><div class="boxMe"><b>Файлы настроек либо отсутствуют, либо установлены неверные права доступа.</b><br><br>Установите права доступа 706 на следующий файл:<ul class="boxMe"><li>cd %sadmin/includes/</li><li>touch configure.php</li><li>chmod 706 configure.php</li></ul></div></p><p class="noteBox">Если <i>chmod 706</i> не выставляется, попробуйте <i>chmod 777</i>.</p><p class="noteBox">В операционной системе Windows вы просто должны убедиться, что данные файлы <b>не</b> имеют атрибут <b>Только для чтения</b>.</p>');

  define('TEXT_SUCCESSFUL_CONFIGURATION', 'Настройка конфигурационных файлов завершена!');
  define('TEXT_SUCCESSFUL1_CONFIGURATION', 'Установка интернет-магазина завершена!<br><br>Для входа в администраторскую установлены следующие данные:<br>E-Mail Адрес: <b>admin@localhost.com</b><br>Пароль: <b>admin</b><br>После входа в администраторскую обязательно установите новый e-mail адрес и пароль для входа.<br>');
?>
