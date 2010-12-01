<?php
/*
  $Id: wu.php,v 1.2 2002/11/22

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  class wu {
    var $code, $title, $description, $enabled;

// class constructor
    function wu() {
      $this->code = 'wu';
      $this->title = MODULE_PAYMENT_WU_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_WU_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_WU_SORT_ORDER;
      $this->email_footer = MODULE_PAYMENT_WU_TEXT_EMAIL_FOOTER;
      $this->enabled = MODULE_PAYMENT_WU_STATUS;
    }

// class methods
    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return array('title' => MODULE_PAYMENT_WU_TEXT_DESCRIPTION);
    }

    function process_button() {
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

    function get_error() {
      return false;
    }

    function check() {
      if (!isset($this->check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_WU_STATUS'");
        $this->check = tep_db_num_rows($check_query);
      }
      return $this->check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Western Union', 'MODULE_PAYMENT_WU_STATUS', '1', 'Вы хотите использовать модуль Western Union? 1 - да, 0 - нет', '6', '1', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Имя', 'MODULE_PAYMENT_WU_1', 'Ivan', 'First Name', '6', '1', now());");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Фамилия', 'MODULE_PAYMENT_WU_2', 'Ivanov', 'Last Name', '6', '1', now());");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Город', 'MODULE_PAYMENT_WU_3', 'Moscow', 'City', '6', '1', now());");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Страна', 'MODULE_PAYMENT_WU_4', 'Russia', 'Country', '6', '1', now());");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Порядок сортировки.', 'MODULE_PAYMENT_WU_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', now())");
   }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      $keys = array('MODULE_PAYMENT_WU_STATUS', 'MODULE_PAYMENT_WU_1', 'MODULE_PAYMENT_WU_2', 'MODULE_PAYMENT_WU_3', 'MODULE_PAYMENT_WU_4', 'MODULE_PAYMENT_WU_SORT_ORDER');

      return $keys;
    }
  }
?>