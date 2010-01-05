<?php
/*
  $Id: egold.php,v 1.2 2002/11/22

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  class egold {
    var $code, $title, $description, $enabled;

// class constructor
    function egold() {
      $this->code = 'egold';
      $this->title = MODULE_PAYMENT_EGOLD_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_EGOLD_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_EGOLD_SORT_ORDER;
      $this->email_footer = MODULE_PAYMENT_EGOLD_TEXT_EMAIL_FOOTER;
      $this->enabled = MODULE_PAYMENT_EGOLD_STATUS;
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
      return array('title' => MODULE_PAYMENT_EGOLD_TEXT_DESCRIPTION);
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
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_EGOLD_STATUS'");
        $this->check = tep_db_num_rows($check_query);
      }
      return $this->check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('������ ����� ������� EGOLD', 'MODULE_PAYMENT_EGOLD_STATUS', '1', '�� ������ ������������ ������ ������ ����� ������� EGOLD? 1 - ��, 0 - ���', '6', '1', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('��� EGold �������������', 'MODULE_PAYMENT_EGOLD_1', '11111111', '������� ��� EGold ID', '6', '1', now());");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('������� ����������.', 'MODULE_PAYMENT_EGOLD_SORT_ORDER', '0', '������� ���������� ������.', '6', '0', now())");
   }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      $keys = array('MODULE_PAYMENT_EGOLD_STATUS', 'MODULE_PAYMENT_EGOLD_1', 'MODULE_PAYMENT_EGOLD_SORT_ORDER');

      return $keys;
    }
  }
?>