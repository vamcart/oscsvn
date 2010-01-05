<?php
/*
  $Id: invoice.php,v 1.1 2003/05 xaglo
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('TITLE_PRINT_ORDER', 'СЧЕТ');
define('TITLE_PRINT_ORDER_NUM', '№ ЗАКАЗА:');
define('TITLE_PRINT_NUMBER_TEXT', ' ');

define('TABLE_HEADING_INN', 'ИНН');
define('TABLE_HEADING_CONTNUM', 'Счет №');
define('TABLE_HEADING_BIK', 'БИК');
define('TABLE_HEADING_NUM', '№');
define('TABLE_HEADING_OT', 'от');
define('TABLE_HEADING_SUMMA', 'К оплате:');
define('TABLE_HEADING_COMMENTS', 'Коментарии');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Артикул	');
define('TABLE_HEADING_PRODUCTS_CONT', 'Кол-во');
define('TABLE_HEADING_PRODUCTS', 'Товар');
define('TABLE_HEADING_TAX', 'НДС');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Цена за ед.<br> без НДС');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Цена за ед с НДС');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Сумма без НДС');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Сумма с НДС');

define('IMAGE_BUTTON_PRINT', 'Печать');

define('ENTRY_EXT_DA', 'ПОСТАВЩИК:');
define('ENTRY_EXT_DA_1', 'Получатель');
define('ENTRY_EXT_DA_2', 'Банк получателя');

define('ENTRY_EXT_DA_3', 'Сбербанк России г. Москва');

define('ENTRY_OBR_DA', 'Образец заполнения платежного поручения:');
define('ENTRY_SOLD_TO', 'ПЛАТЕЛЬЩИК:');
define('ENTRY_SOLD_TO_1', 'ПРЕДСТАВИТЕЛЬ ПЛАТЕЛЬЩИКА:');
define('ENTRY_SOLD_TO_2', 'ТЕЛЕФОНЫ:');
define('ENTRY_SHIP_TO', 'ГРУЗОПОЛУЧАТЕЛЬ:');
define('ENTRY_PAYMENT_METHOD', 'Форма оплаты:');
define('ENTRY_BOSS', 'Руководитель:');

define('ENTRY_BOSS_NOME', MODULE_PAYMENT_RUS_SCHET_9);

define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_1', MODULE_PAYMENT_RUS_SCHET_1);
define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_2', MODULE_PAYMENT_RUS_SCHET_2);
define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_3', MODULE_PAYMENT_RUS_SCHET_3);
define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_4', MODULE_PAYMENT_RUS_SCHET_4);
define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_5', MODULE_PAYMENT_RUS_SCHET_5);
define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_6', MODULE_PAYMENT_RUS_SCHET_6);
define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_7', MODULE_PAYMENT_RUS_SCHET_7);

define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_8','<font color=red>Оплата производится в рублях по курсу ЦБ РФ на день покупки</font><br>После оплаты заказа обязательно сообщите нам по электронной почте о факте оплаты или позвоните по тел. В сообщении укажите дату и сумму оплаты, номер заказа, ФИО и номер платежного документа. Оригиналы счета, счет-фактуры и накладных будут предоставлены при получении товара или высланы по почте.');

define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_9','<font color=red>ВНИМАНИЕ!</font> Оплата данного предварительного счета означает согласие с условиями поставки товара. Счет действителен в течение 3-х банковских дней с момента выписки. По истечении срока действия счета оплату производить строго по уведомлению.');

define('MODULE_PAYMENT_RUS_SCHET_TEXT_DESCRIPTION_10', MODULE_PAYMENT_RUS_SCHET_8);
?>
