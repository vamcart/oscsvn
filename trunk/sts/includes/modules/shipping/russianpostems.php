<?php
/*
  $Id: russianpostems.php,v 1.1.1.1 2003/09/18 19:04:54 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class russianpostems {
    var $code, $title, $description, $icon, $enabled;

// class constructor
    function russianpostems() {
      global $order;

      $this->code = 'russianpostems';
      $this->title = MODULE_SHIPPING_RUSSIANPOSTEMS_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_RUSSIANPOSTEMS_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_RUSSIANPOSTEMS_SORT_ORDER;
      $this->icon = DIR_WS_ICONS . 'shipping_ems.jpg';
      $this->tax_class = MODULE_SHIPPING_RUSSIANPOSTEMS_TAX_CLASS;
      $this->enabled = ((MODULE_SHIPPING_RUSSIANPOSTEMS_STATUS == 'True') ? true : false);

      if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_RUSSIANPOSTEMS_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_RUSSIANPOSTEMS_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->delivery['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

// class methods
    function quote($method = '') {
      global $order, $shipping_weight, $total_count;

        $this->quotes = array('id' => $this->code,
                            'module' => MODULE_SHIPPING_RUSSIANPOSTEMS_TEXT_TITLE,
                            'methods' => array(array('id' => $this->code,
                                                     'title' => MODULE_SHIPPING_RUSSIANPOSTEMS_TEXT_NOTE)));

        if (tep_not_null($this->icon)) $this->quotes['icon'] = tep_image($this->icon, $this->title);
		
		
		//Проверка на максимальный вес	
$urlWeight = 'http://emspost.ru/api/rest/?method=ems.get.max.weight';		
	
 // create curl resource
        $ch = curl_init();

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // set url
		curl_setopt($ch, CURLOPT_URL, $urlWeight);
		$outWeight = curl_exec($ch);
	
	    $WeightList = json_decode($outWeight, true);

       foreach ($WeightList as $weight){
	   $max_weight = $weight['max_weight'];

	if ($shipping_weight > $max_weight){
	  $this->quotes['error']='Превышен максимально возможный вес одного отправления. Разбейте заказ на несколько частей.';
	  return $this->quotes;

 }
 }
		
//Получаем список городов и регионов		

        $urlRussia = 'http://emspost.ru/api/rest?method=ems.get.locations&type=russia';

        // create curl resource
        $ch = curl_init();

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // set url
		curl_setopt($ch, CURLOPT_URL, $urlRussia);
		$outRussia = curl_exec($ch);
		
    
	
	//Вытягиваем регион магазина
		$zones_shop = STORE_ZONE;
		$zones_zones = tep_db_query("select zone_id, zone_name from " . TABLE_ZONES . " where (zone_id='$zones_shop')");
		$zones_id = tep_db_fetch_array($zones_zones);
		$zonesshop = $zones_id['zone_name'];
		
	//Вытягиваем город получателя
	$tocity = $order->delivery['city'];	
	
	//Вытягиваем регион получателя 
	$tostate_id = $order->delivery['state']; 
	$tostate_tostate = tep_db_query("select zone_id, zone_name from " . TABLE_ZONES . " where (zone_name='$tostate_id')");
	$tostate_tostate_id = tep_db_fetch_array($tostate_tostate);
	$tostate = $tostate_tostate_id['zone_name'];
	
	
	
		
		//проверяем город/регион отправителя/получателя
		$RussiaList = json_decode(utf8_encode($outRussia), true);
        foreach ($RussiaList['rsp']['locations'] as $russia){
          if (strtolower(iconv("UTF-8", CHARSET, $russia['name'])) == strtolower(MODULE_SHIPPING_RUSSIANPOSTEMS_CITY)){
            $from = $russia['value'];			
		  }
		  if ($from === null){
		   if (strtolower(iconv("UTF-8", CHARSET, $russia['name'])) == strtolower($zonesshop)){
            $from = $russia['value'];			
		   }
		  }
		  
		  if (strtolower(iconv("UTF-8", CHARSET, $russia['name'])) == strtolower($tocity)){
            $to = $russia['value'];
			$tomessag = 'город: '. iconv("UTF-8", CHARSET, $russia['name']);
          }
		  if ($to === null){
		   if (strtolower(iconv("UTF-8", CHARSET, $russia['name'])) == strtolower($tostate)){
            $to = $russia['value'];
			$tomessag = 'регион: '. iconv("UTF-8", CHARSET, $russia['name']);
		   }
		  }
		 }
	
		
  // Если вдруг ничего не нашлось		
		
	if ($from === null){
	  $this->quotes['error']='Доставка из города:  '. MODULE_SHIPPING_RUSSIANPOSTEMS_CITY. ' не производится! Возможно Вы допустили ошибку в адресе.';
	  return $this->quotes;
	} else if ($to === null){
	  $this->quotes['error']='Доставка в город:  '. $tocity. ' не производится! Возможно Вы допустили ошибку в адресе.';
	  return $this->quotes;
	}
	//----

		

		$url = 'http://emspost.ru/api/rest?method=ems.calculate&from='.$from.'&to='.$to.'&weight='.$shipping_weight;
		
		curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);

        $contents = $output;
        $contents = utf8_encode($contents);
        $results = json_decode($contents, true);

        if ($results['rsp']['stat'] == 'fail'){
          $this->quotes['error'] = 'Ошибка: '.$results['rsp']['err']['msg'];
		  return $this->quotes;
		}
	$shPrice = $results['rsp']['price'];
	if (MODULE_SHIPPING_RUSSIANPOSTEMS_DCVAL_PERCENT >0){
	  $shPrice += $order->info['subtotal']*MODULE_SHIPPING_RUSSIANPOSTEMS_DCVAL_PERCENT/100;
	}
        $this->quotes['methods'][key($this->quotes['methods'])]['cost'] = $shPrice + MODULE_SHIPPING_RUSSIANPOSTEMS_HANDLING;
		$this->quotes['methods'][key($this->quotes['methods'])]['title'] = 'Доставка в ' . $tomessag. '. ';
        $dlvr_min = $results['rsp']['term']['min'];
        $dlvr_max = $results['rsp']['term']['max'];
        if (($dlvr_min > 0) AND ( $dlvr_max > 0)){
          if ($dlvr_min == $dlvr_max){
            $this->quotes['methods'][key($this->quotes['methods'])]['title'] .= '(<i>Срок доставки '.$dlvr_max;
          } else {
            $this->quotes['methods'][key($this->quotes['methods'])]['title'] .= '(<i>Срок доставки '.$dlvr_min.' - '.$dlvr_max;
          }
          if ($dlvr_max == 1){
            $this->quotes['methods'][key($this->quotes['methods'])]['title'] .= ' день';
          } else if (($dlvr_max > 1) and ($dlvr_max < 5)){
            $this->quotes['methods'][key($this->quotes['methods'])]['title'] .= ' дня';
          } else {
            $this->quotes['methods'][key($this->quotes['methods'])]['title'] .= ' дней';
          }
          $this->quotes['methods'][key($this->quotes['methods'])]['title'] .= '</i>)';
        }

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }


      return $this->quotes;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_RUSSIANPOSTEMS_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Разрешить модуль EMS Почта России', 'MODULE_SHIPPING_RUSSIANPOSTEMS_STATUS', 'True', 'Вы хотите разрешить модуль EMS Почта России?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Город отправки', 'MODULE_SHIPPING_RUSSIANPOSTEMS_CITY', 'Москва', 'Город отправки посылок.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Стоимость', 'MODULE_SHIPPING_RUSSIANPOSTEMS_HANDLING', '0', 'Стоимость использования данного способа доставки.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Налог', 'MODULE_SHIPPING_RUSSIANPOSTEMS_TAX_CLASS', '0', 'Использовать налог.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Зона', 'MODULE_SHIPPING_RUSSIANPOSTEMS_ZONE', '0', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Порядок сортировки', 'MODULE_SHIPPING_RUSSIANPOSTEMS_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Процентная ставка для объявленной ценности', 'MODULE_SHIPPING_RUSSIANPOSTEMS_DCVAL_PERCENT', '0', '0 - не учитывать, 1-100 - текущая процентная ставка из расчета суммы заказа', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_SHIPPING_RUSSIANPOSTEMS_STATUS', 'MODULE_SHIPPING_RUSSIANPOSTEMS_CITY', 'MODULE_SHIPPING_RUSSIANPOSTEMS_HANDLING', 'MODULE_SHIPPING_RUSSIANPOSTEMS_TAX_CLASS', 'MODULE_SHIPPING_RUSSIANPOSTEMS_ZONE', 'MODULE_SHIPPING_RUSSIANPOSTEMS_SORT_ORDER', 'MODULE_SHIPPING_RUSSIANPOSTEMS_DCVAL_PERCENT');
    }
  }
?>