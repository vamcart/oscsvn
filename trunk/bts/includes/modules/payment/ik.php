<?php
/*
  Payment module for using with interkassa.com Payment Gateway
  Author: Andrew Yermakov (andrew@cti.org.ua)
  Copyright (c) 2007 Andrew Yermakov
  Released under the GNU General Public License
*/

  class ik {
    var $code, $title, $description, $enabled;

    // class constructor
    function ik() {
      global $order;

      $this->code = 'ik';
      $this->title = MODULE_PAYMENT_IK_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_IK_TEXT_DESCRIPTION;
      $this->icon = DIR_WS_ICONS . 'interkassa.png';
      $this->sort_order = MODULE_PAYMENT_IK_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_IK_STATUS == 'True') ? true : false);


      if ((int)MODULE_PAYMENT_IK_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_IK_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->form_action_url = 'https://interkassa.com/lib/payment.php';
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_IK_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_IK_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

    function javascript_validation() {
      return false;
    }

      if (tep_not_null($this->icon)) $icon = tep_image($this->icon, $this->title);
      
    function selection() {
      return array('id' => $this->code,
      				'icon' => $icon,
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return false;
    }

    function process_button() {
      global $order, $currencies, $currency, $vamPrice;

      $order_id_query = tep_db_query("select max(orders_id) as max from " . TABLE_ORDERS);
      $order_id = tep_db_fetch_array($order_id_query );
      $order_id = $order_id['max'];
      $OrderID = $order_id + 1;
      
      $TotalAmount = number_format($currencies->format($order->info['total'], true, MODULE_PAYMENT_IK_CURRENCY, $order->info['currency_value']), 2, '.', '');

      $ik_sign_hash_str = MODULE_PAYMENT_IK_SHOP_ID . ':' . $TotalAmount . ':' . $OrderID . ':' . '' . ':' . tep_session_id() . ':' . MODULE_PAYMENT_IK_SECRET_KEY;

      $ik_sign_hash = md5($ik_sign_hash_str);

      $process_button_string = tep_draw_hidden_field('ik_shop_id', MODULE_PAYMENT_IK_SHOP_ID) .
                               tep_draw_hidden_field('ik_payment_amount', $TotalAmount) .
                               tep_draw_hidden_field('ik_payment_id', $OrderID) .
                               tep_draw_hidden_field('ik_payment_desc', 'Order-' . $OrderID) .
                               tep_draw_hidden_field('ik_paysystem_alias', '') . 
                               tep_draw_hidden_field('ik_baggage_fields', tep_session_id()) . 
                               tep_draw_hidden_field('ik_sign_hash', $ik_sign_hash);

      return $process_button_string;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

    function output_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_IK_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable ik  Module', 'MODULE_PAYMENT_IK_STATUS', 'True', 'Do you want to accept ik  payments?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Shop ID', 'MODULE_PAYMENT_IK_SHOP_ID', '', '', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Secret Key', 'MODULE_PAYMENT_IK_SECRET_KEY', '', '', '6', '3', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Currency', 'MODULE_PAYMENT_IK_CURRENCY', 'UAH', '', '6', '4', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_IK_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '5', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_IK_SORT_ORDER', '1', 'Sort order of display. Lowest is displayed first.', '6', '6', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_IK_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_IK_STATUS', 'MODULE_PAYMENT_IK_SHOP_ID', 'MODULE_PAYMENT_IK_SECRET_KEY', 'MODULE_PAYMENT_IK_CURRENCY', 'MODULE_PAYMENT_IK_ZONE', 'MODULE_PAYMENT_IK_SORT_ORDER', 'MODULE_PAYMENT_IK_ORDER_STATUS_ID');
    }
  }
?>
