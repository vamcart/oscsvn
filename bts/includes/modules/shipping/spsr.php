<?php
/*
  ������ �������� "���� ��������"
  $Id: spsr.php, v 1.06 19/01/09
  �����: ������������ �����, spmob@mail.ru
  ������� �� ������ ���������� ����������� aka VAM
  
	  ���������� �� ������:
	  $Id: pickup.php,v 1.40 2003/02/05 22:41:52 hpdl Exp $
	
	  osCommerce, Open Source E-Commerce Solutions
	  http://www.oscommerce.com
	
	  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class spsr {
    var $code, $title, $description, $icon, $enabled;

// class constructor
  function spsr(){
      global $order, $own_zone_id;

      $this->code = 'spsr';
      $this->title = MODULE_SHIPPING_SPSR_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_SPSR_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_SPSR_SORT_ORDER;
      $this->icon = DIR_WS_ICONS . 'shipping_spsr.gif';
      $this->tax_class = MODULE_SHIPPING_SPSR_TAX_CLASS;
      $this->enabled = ((MODULE_SHIPPING_SPSR_STATUS == 'True') ? true : false);

      if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_SPSR_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_SPSR_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
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
    	
		$check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key='STORE_ZONE'");
        $check = tep_db_fetch_array($check_query);
		$own_zone_id = $check['configuration_value'];	
	
	//������������� �������� �� ������ ������
	if (($this->enabled == true) && (MODULE_SHIPPING_SPSR_OWN_CITY_DELIVERY == 'False')){		         		        
		if (strtolower(MODULE_SHIPPING_SPSR_FROM_CITY) == strtolower($order->delivery['city'])){				
			$this->enabled = false;
		}
	}
			
	//������������� �������� �� ������ �������
	if (($this->enabled == true) && (MODULE_SHIPPING_SPSR_OWN_REGION_DELIVERY == 'False'))	{		         		
		if ($own_zone_id == $order->delivery['zone_id']){				
			$this->enabled = false;
		}
	}
	
	//���������� �������� ��� ��������� �������
	if (($this->enabled == true) && (MODULE_SHIPPING_SPSR_DISABLE_CITIES !== '')){		         		        
		$disabled_cities = explode(',',MODULE_SHIPPING_SPSR_DISABLE_CITIES);
		foreach ($disabled_cities as $cityvalue){			
			if (strtolower($cityvalue) == strtolower($order->delivery['city'])){				
				$this->enabled = false;
			}
		}
	}
	
  }

// class methods
    function quote($method = '') {
      global $order, $cart, $shipping_weight, $own_zone_id;		  
				
		if ($shipping_weight == 0)
			{
			$shipping_weight = MODULE_SHIPPING_SPSR_DEFAULT_SHIPPING_WEIGHT;
			}
			
      if ($this->tax_class > 0) {
        $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }
      	

		//����������� Region ID ������ ���������� ����
		$region_id = tep_get_spsr_zone_id($order->delivery['zone_id']);
		
		//����������� ���� Region ID �� ����
		$own_cpcr_id = tep_get_spsr_zone_id($order->delivery['zone_id']);

	//oscommerce ������ ����������� ���� �������� c cpcr.ru - �� ������������� ���� �������� (��� ������ ������������) � ����� ������������� ���� �������� (������� ������ "����������"). �.�. ������, ������ ��� �������� oscommerce. ����� �� ����������� ������ �������� $cost � hidden ���� cost.
	if (!isset($_POST['cost'])) {		 		
		//����������� ������� ��������� ��������
		if(isset($_POST['error_tocity']))
			{
			$request='http://cpcr.ru/cgi-bin/postxml.pl?TariffCompute&FromRegion='.$own_cpcr_id.'|0&FromCityName='.MODULE_SHIPPING_SPSR_FROM_CITY.'&Weight='. $shipping_weight .'&Nature='.MODULE_SHIPPING_SPSR_NATURE.'&Amount=0&Country=209|0&ToCity='.$_POST['error_tocity'];
			}
		else
			{
			$request='http://cpcr.ru/cgi-bin/postxml.pl?TariffCompute&FromRegion='.$own_cpcr_id.'|0&FromCityName='.MODULE_SHIPPING_SPSR_FROM_CITY.'&Weight='. $shipping_weight .'&Nature='.MODULE_SHIPPING_SPSR_NATURE.'&Amount=0&Country=209|0&ToRegion='.$region_id.'|0&ToCityName='.$order->delivery['city'];
			}
		
		//�������� ����� � ��������
		$server_link = false;
		
		$file_headers = @get_headers($request);
		if(($file_headers[0] !== 'HTTP/1.1 404 Not Found') && ($file_headers!==false)) {
			$server_link = true;
		}
	
		//������ ��������� � cpcr.ru
		if ($server_link==true){
			$xmlstring= simplexml_load_file($request);
		}else{
			$title = "<font color=red>��� ����� � �������� cpcr.ru, ��������� �������� �� ����������.</font>";
			$cost = 0;
		}

		//��������� ���� ��������
		if ($xmlstring->PayTariff)
			{
			$find_symbols = array(chr(160),'�.',' '); //������ ������� � ��������� �������� cpcr.ru ���������� ������ � ascii ����� 160.
			$cost = ceil(str_replace(',','.',str_replace($find_symbols,'',$xmlstring->Total)));
			$title .= '�������� � '.$order->delivery['city'].', '.$order->delivery['state'];
			if ($cost>0) {$title .= '<input type="hidden" name="cost" value="'.$cost.'">';}			
			}
	//���� $cost ��� ��� ���������
	}else{
		$cost = $_POST['cost'];
		$title .= '�������� � '.$order->delivery['city'].', '.$order->delivery['state'];
		if ($cost>0) {$title .= '<input type="hidden" name="cost" value="'.$cost.'">';}	
	}			
		
		//��������� ������ ����� �� ������
		if ($xmlstring->Error->ToCity && $server_link == true)
			{
			$title .= "<font color=red>������, ����� \"".$order->delivery['city']."\" �� ������. ���� � �������� ������ �������� ������, ���� � ������ ����� ���� �������� �� ����������.</font><br>";
			}
		
			//��������� �������� ������, ��� ��������� City_Id c ������� cpcr.ru
		if (!$xmlstring->Error->ToCity->City->CityName=='')
			{
			$title .= "<font color=red>���������� �������� �������� ������ ������:</font><br>";
			if ($xmlstring->Error->ToCity->City)
				{
				foreach ($xmlstring->Error->ToCity->City as $city_value)
					{		
					$title .= "<input type=radio name=error_tocity value=\"".$city_value->City_Id."|".$city_value->City_Owner_Id."\" onChange=\"this.form.submit()\">".$city_value->CityName.", ".$city_value->RegionName."<br>";
					//������ ��� ��� ���������� � �������������
					echo "<input type=hidden name=\"".$city_value->City_Id."|".$city_value->City_Owner_Id."\" value=\"".$city_value->CityName.", ".$city_value->RegionName."\">";	
					//����� ��� ��� ���������� � �������������						
					}
				}
			}
			
		//��������� ������ ����
		if ($xmlstring->Error->Weight)
			{
			$title .= "<br><font color=red>������! ������������ ������ ����</font>";
			}
		
		//��������� ������ ��������� ���������	
		if ($xmlstring->Error->Amount)
			{
			$title .= "<br><font color=red>������! ������������ ������ ��������� ���������</font>";
			}
		if (!isset($own_cpcr_id))
			{
			$title .= "<br><font color=red>������! �� �� ������� ����! (�����������������>���������>My store>Zone)</font>";
			}
			
		//��������� ������ Mutex Wait Timeout
		if ($xmlstring->Error['Type']=='Mutex' & $xmlstring->Error['SubType']=='Wait Timeout')  {
			$title .= "<br><font color=red>������! cpcr.ru �� ������ ����� �� ������. ���������� �������� ��������.</font>";
		}
		
		//��������� ������ ComputeTariff CalcError
		if ($xmlstring->Error['Type']=='ComputeTariff' & $xmlstring->Error['SubType']=='CalcError')  {
			$title .= "<br><font color=red>������! ������ ���������� ��������� ��������.</font>";
		}		
		
		//��������� ������ Command Unknown
		if ($xmlstring->Error['Type']=='Command' & $xmlstring->Error['SubType']=='Unknown')  {
			$title .= "<br><font color=red>������! ����������� �������.</font>";
		}
		
		//��������� ������ Unknown Unknown (������ ������)
		if ($xmlstring->Error['Type'])  {
			$title .= "<br><font color=red>����������� ������, ���������� �����.</font>";
		}		
		
		//������������ ���������� ����������
		if(MODULE_SHIPPING_SPSR_DEBUG=='True')
			{
			$title .= "<br>".'$own_zone_id='.$own_zone_id."<br>".
			'$order->delivery[\'zone_id\']='.$order->delivery['zone_id']."<br>".
			'$own_cpcr_id='.$own_cpcr_id."<br>".
			'MODULE_SHIPPING_SPSR_OWN_CITY_DELIVERY='.MODULE_SHIPPING_SPSR_OWN_CITY_DELIVERY."<br>".
			'MODULE_SHIPPING_SPSR_OWN_REGION_DELIVERY='.MODULE_SHIPPING_SPSR_OWN_REGION_DELIVERY."<br>".			
			'$shipping_weight='.$shipping_weight."<br>".
			'MODULE_SHIPPING_SPSR_NATURE='.MODULE_SHIPPING_SPSR_NATURE."<br>".
			'$request='.$request."<br>".
			'$cost='.$cost."<br>".
			'$_POST[\'cost\']='.$_POST['cost'];
			'$xmlstring:'."<br>".
			(is_object($xmlstring)?"<textarea readonly=\"readonly\" rows=\"5\">".$xmlstring->asXML()."</textarea>":'');			
			}
			
      $this->quotes = array('id' => $this->code,
                            'module' => MODULE_SHIPPING_SPSR_TEXT_TITLE,
                            'methods' => array(array('id' => $this->code,
                                                     'title' => $title,
                                                     'cost' => $cost)));

      if (tep_not_null($this->icon)) $this->quotes['icon'] = tep_image($this->icon, $this->title);
      return $this->quotes;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_SPSR_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

   function install() {
 		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('�������� ����-��������?', 'MODULE_SHIPPING_SPSR_STATUS', 'True', '�� ������ �������� ������ �������� ����-��������?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order,  date_added) values ('����� �����������', 'MODULE_SHIPPING_SPSR_FROM_CITY', '�����-���������', '�������� ������, ������ �������������� ��������', '6', '0', now())");
		
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order,  date_added) values ('��������� ��� �������', 'MODULE_SHIPPING_SPSR_DISABLE_CITIES', '', '������, ��� ������� ���� ������ �������� �� ����������, ����� �������', '6', '0', now())");
		
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('�������� �������� �� ������ ������?', 'MODULE_SHIPPING_SPSR_OWN_CITY_DELIVERY', 'True', '', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('�������� �������� �� ������ �������?', 'MODULE_SHIPPING_SPSR_OWN_REGION_DELIVERY', 'True', '', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order,  date_added) values ('��� ������ �� ���������', 'MODULE_SHIPPING_SPSR_DEFAULT_SHIPPING_WEIGHT', '0.7', '���� ��� ������ �� ����������, �� ���������� ��� �� ���������', '6', '0', now())");		
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order,  date_added) values ('��� �����������', 'MODULE_SHIPPING_SPSR_NATURE', '3', '��� ����������� (�����):<br>1 - ���������<br>2 - ��������� ��������<br>3 - ������� � ����������<br>4 - ������ ������<br>5 - ��������� �������<br>6 - ���������<br>7 - ������ � ����������� ���.<br>8 � ������<br>', '6', '0', now())");
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('�������� ����� �������', 'MODULE_SHIPPING_SPSR_DEBUG', 'False', '����� ��������� ���������� ����������', '6', '0','tep_cfg_select_option(array(\'True\', \'False\'),', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('�����', 'MODULE_SHIPPING_SPSR_TAX_CLASS', '0', '������������ �����.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('����', 'MODULE_SHIPPING_SPSR_ZONE', '0', '���� ������� ����, �� ������ ������ �������� ����� ����� ������ ����������� �� ��������� ����.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('������� ����������', 'MODULE_SHIPPING_SPSR_SORT_ORDER', '0', '������� ���������� ������.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_SHIPPING_SPSR_STATUS','MODULE_SHIPPING_SPSR_FROM_CITY','MODULE_SHIPPING_SPSR_OWN_CITY_DELIVERY','MODULE_SHIPPING_SPSR_OWN_REGION_DELIVERY','MODULE_SHIPPING_SPSR_DISABLE_CITIES','MODULE_SHIPPING_SPSR_DEFAULT_SHIPPING_WEIGHT','MODULE_SHIPPING_SPSR_NATURE','MODULE_SHIPPING_SPSR_DEBUG', 'MODULE_SHIPPING_SPSR_TAX_CLASS', 'MODULE_SHIPPING_SPSR_ZONE', 'MODULE_SHIPPING_SPSR_SORT_ORDER');
    }
  }
?>