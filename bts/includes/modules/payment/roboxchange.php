<?php
/*
  http://metashop.ru
  metashop@metashop.ru
*/

  class roboxchange {
    var $code, $title, $description, $enabled;

// class constructor
    function roboxchange() {
      global $order;

      $this->code = 'roboxchange';
      $this->title = MODULE_PAYMENT_ROBOXCHANGE_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_ROBOXCHANGE_TEXT_DESCRIPTION;
      $this->icon = DIR_WS_ICONS . 'robokassa.png';
      $this->sort_order = MODULE_PAYMENT_ROBOXCHANGE_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_ROBOXCHANGE_STATUS == 'True') ? true : false);

//      $this->form_action_url = 'https://www.roboxchange.com/ssl/calc.asp';
    }

// class methods
    function update_status() {
      return false;
    }

    function javascript_validation() {
      return false;
    }

    function selection() {

      if (tep_not_null($this->icon)) $icon = tep_image($this->icon, $this->title);

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
/*
      global $order, $currencies, $language;

      $inv_id='0';
      $inv_desc='';
      $out_summ=$order->info['total'];

      $crc = md5(MODULE_PAYMENT_ROBOXCHANGE_LOGIN.':'.$out_summ.':'.$inv_id.':'.MODULE_PAYMENT_ROBOXCHANGE_PASSWORD1);

      $process_button_string = tep_draw_hidden_field('mrh', MODULE_PAYMENT_ROBOXCHANGE_LOGIN) .
                               tep_draw_hidden_field('out_summ', $out_summ) .
                               tep_draw_hidden_field('inv_id', $inv_id) .
                               tep_draw_hidden_field('inv_desc', $inv_desc) .
                               tep_draw_hidden_field('p', 'vecher') .
                               tep_draw_hidden_field('lang', (($language=='russian')?'ru':'en')) .
                               tep_draw_hidden_field('crc', $crc);

      return $process_button_string;
*/
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      global $insert_id, $currencies, $language, $cart, $order;

      $inv_id=$insert_id;
//      $out_summ=$order->info['total_value'];
      $out_summ=number_format($order->info['total'],0,'.',''); 
      $crc = md5(MODULE_PAYMENT_ROBOXCHANGE_LOGIN.':'.$out_summ.':'.$inv_id.':'.MODULE_PAYMENT_ROBOXCHANGE_PASSWORD1);

      $cart->reset(true);
      tep_session_unregister('sendto');
      tep_session_unregister('billto');
      tep_session_unregister('shipping');
      tep_session_unregister('payment');
      tep_session_unregister('comments');
      tep_redirect('https://www.roboxchange.com/ssl/calc.asp?mrh='.MODULE_PAYMENT_ROBOXCHANGE_LOGIN.'&out_summ='.$out_summ.'&inv_id='.$inv_id.'&lang='.(($language=='russian')?'ru':'en').'&crc='.$crc.'&p=vecher');
    }

    function output_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_ROBOXCHANGE_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('��������� ������ roboxchange', 'MODULE_PAYMENT_ROBOXCHANGE_STATUS', 'False', '��������� ������������� ������ roboxchange.<br><br><a href=../robox.txt target=_blank><font color=red>��� ����������� ������</font></a>', '6', '3', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('��� �����', 'MODULE_PAYMENT_ROBOXCHANGE_LOGIN', '', '��� ����� � ������� roboxchange cash register', '6', '4', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('������ ����� 1', 'MODULE_PAYMENT_ROBOXCHANGE_PASSWORD1', '', '��� ������ ������ � roboxchange cash register', '6', '5', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('������� ����������', 'MODULE_PAYMENT_ROBOXCHANGE_SORT_ORDER', '0', '������� ���������� ������.', '6', '7', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('������ ����� 2', 'MODULE_PAYMENT_ROBOXCHANGE_PASSWORD2', '', '��� ������ ������ � roboxchange cash register', '6', '5', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('������ ����������� ������', 'MODULE_PAYMENT_ROBOXCHANGE_ORDER_STATUS', '0', '������, ��������������� ������ ����� �������� ������', '6', '8', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_ROBOXCHANGE_STATUS', 'MODULE_PAYMENT_ROBOXCHANGE_LOGIN', 'MODULE_PAYMENT_ROBOXCHANGE_PASSWORD1', 'MODULE_PAYMENT_ROBOXCHANGE_ORDER_STATUS', 'MODULE_PAYMENT_ROBOXCHANGE_PASSWORD2', 'MODULE_PAYMENT_ROBOXCHANGE_SORT_ORDER');
    }
  }
?>
