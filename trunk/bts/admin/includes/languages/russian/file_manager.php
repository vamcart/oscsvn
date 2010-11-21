<?php
/*
  $Id: file_manager.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Файловый Менеджер');

define('TABLE_HEADING_FILENAME', 'Имя');
define('TABLE_HEADING_SIZE', 'Размер');
define('TABLE_HEADING_PERMISSIONS', 'Права');
define('TABLE_HEADING_USER', 'Пользователь');
define('TABLE_HEADING_GROUP', 'Группа');
define('TABLE_HEADING_LAST_MODIFIED', 'Последнее изменение');
define('TABLE_HEADING_ACTION', 'Действие');

define('TEXT_INFO_HEADING_UPLOAD', 'Загрузить');
define('TEXT_FILE_NAME', 'Имя файла:');
define('TEXT_FILE_SIZE', 'Размер:');
define('TEXT_FILE_CONTENTS', 'Содержание:');
define('TEXT_LAST_MODIFIED', 'Последнее изменение:');
define('TEXT_NEW_FOLDER', 'Новая папка');
define('TEXT_NEW_FOLDER_INTRO', 'Введите имя новой папки:');
define('TEXT_DELETE_INTRO', 'Вы действительно хотите удалить этот файл?'); 
define('TEXT_UPLOAD_INTRO', 'Выберите файл для загрузки.');

define('ERROR_DIRECTORY_NOT_WRITEABLE', 'Ошибка: нет права записи в директорию, нужно изменить права доступа: %s');
define('ERROR_FILE_NOT_WRITEABLE', 'Ошибка: нет права записи для файла, нужно изменить права доступа: %s');
define('ERROR_DIRECTORY_NOT_REMOVEABLE', 'Ошибка: не могу удалить директорию, установить права доступа: %s');
define('ERROR_FILE_NOT_REMOVEABLE', 'Ошибка: не могу удалить файл, измените права доступа: %s');
define('ERROR_DIRECTORY_DOES_NOT_EXIST', 'Ошибка: Директория отсутствует: %s');
?>
