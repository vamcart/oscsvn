<?php
/*
  $Id: gv_mail.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Отправить сертификат');

define('TEXT_CUSTOMER', 'Клиент:');
define('TEXT_SUBJECT', 'Тема:');
define('TEXT_FROM', 'От:');
define('TEXT_TO', 'Кому:');
define('TEXT_AMOUNT', 'Сумма сертификата');
define('TEXT_MESSAGE', 'Сообщение:');
define('TEXT_SINGLE_EMAIL', '<span class="smallText">Используйте данное поле, чтобы отправить сертификат и на другие email адреса, которых нет в списке выше.</span>');
define('TEXT_SELECT_CUSTOMER', 'Выберите клиента');
define('TEXT_ALL_CUSTOMERS', 'Все клиенты');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Всем подписчикам рассылки магазина');

define('NOTICE_EMAIL_SENT_TO', 'Уведомление: Email отправлен: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Ошибка: Вы не выбрали клиента.');
define('ERROR_NO_AMOUNT_SELECTED', 'Ошибка: Вы не указали сумму сертификата.');

define('TEXT_GV_WORTH', 'Сертификат на сумму ');
define('TEXT_TO_REDEEM', 'Чтобы активизировать сертификат, нажмите на ссылку ниже и укажите код сертификата - ');
define('TEXT_WHICH_IS', '');
define('TEXT_IN_CASE', '');
define('TEXT_OR_VISIT', 'или посетив наш интернет-магазин по адресу ');
define('TEXT_ENTER_CODE', ' Вы можете указать код сертификата при оформлении заказа.');

define ('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Вы активизировали свой сертификат, но его можно будет использовать при совершении покупок только после проверки администратором магазина, это сделано исключительно в целях безопасности. Как только сертификат будет проверен администратором. Вы получите уведомление на email.');
define ('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'Сертификат на сумму %s');
define ('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'Вы можете отправить свой сертификат или часть суммы сертификата своим знакомым и друзьям.');
define ('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");

?>