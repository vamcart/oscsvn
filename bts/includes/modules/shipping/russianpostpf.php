<?php
/*
	������ ������ �������� ������ ������.
	Filename: modules/shipping/russianpostpf.php
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	�������� Igel'��.
	WWW:  http://igel.pp.ru/oscommerce/russianpost/
	MAIL: igel@weblight.us
	ICQ: 9006615
	06.11.2006.
	v.1.02 [24.11.2006]
	Modification: xtCommerce standart

   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License 
   -----------------------------------------------------------------------------------------

*/

	class russianpostt{
		var $code, $title, $description, $enabled, $settings;


		function all_settings()
		{
			/* �������� ��� ��������� ������ ������*/
            if(sizeof($this->settings) <= 1)
            {
				$sql = tep_db_query("SELECT configuration_key, configuration_value FROM " . TABLE_CONFIGURATION . "
				WHERE configuration_key LIKE '%\_RP\_%'");

				while($config_rows = tep_db_fetch_array($sql))
				{
	            	$crow[] = $config_rows['configuration_key'];
				}

				$this->settings = $crow;
			}
		}

		function is_wrapper($products)
		{
 			/* ������ ������� ��� ��������� */
 			$wrapper = 1;
      		foreach($products as $prod)
			{
				$signal_num = strpos($prod['model'], MODULE_SHIPPING_RP_WRAPPER_SEPARATOR);

				if ($signal_num === false)
				{
					$wrapper = 0;
					break;
				}

				$signal_table = constant('MODULE_SHIPPING_RP_WRAPPER_ISSET');
				$signals = preg_split("/[,]/", $signal_table);
				if (!in_array(substr($prod['model'],0, $signal_num), $signals))
				{
					$wrapper = 0;
					break;
				}
			}
 			/*************/

 			return $wrapper;
		}

		function _install($module)
		{
			$this->all_settings();



			$zones = array(
				array(
						'�������,������������� �������,������������ �������,��������� �������,�������� �������,�����-���������',
						'0.5:97,1:105,1.5:113,2:121,2.5:129,3:137,3.5:145,4:153,4.5:161,5:169,5.5:177,6:185,6.5:193,7:201,7.5:209,8:217,8.5:225,9:233,9.5:241,10:249,10.5:318,11:327,11.5:337,12:347,12.5:357,13:367,13.5:377,14:387,14.5:397,15:407,15.5:417,16:427,16.5:437,17:447,17.5:457,18:467,18.5:477,19:487,19.5:497,20:507',
					 ),

				array(
						'������������� �������,������������ �������,�������� �������,������������ �������,������������� �������,����������� �������,����������� �������,���������� �������,��������������� �������,��������� �������,��������� �������,����,����������� �������,��������� �������,������� �������,�������� �������,��������� ����������,���������� ����������,���������� �������,���������� �������,������������� �������,��������� �������,���������� �������,�������� ����,���������� �������,��������� �������,����������� �������,���������� �������,���������� �������,���������,�������� �������,��������,����������� �������,�������,����������� �������,������',
						'0.5:98,1:107,1.5:116,2:125,2.5:134,3:143,3.5:152,4:161,4.5:170,5:179,5.5:188,6:197,6.5:206,7:215,7.5:224,8:233,8.5:242,9:251,9.5:260,10:269,10.5:348,11:359,11.5:370,12:381,12.5:392,13:403,13.5:414,14:425,14.5:436,15:447,15.5:458,16:469,16.5:480,17:491,17.5:502,18:513,18.5:524,19:535,19.5:546,20:557',
					 ),
				array(
						'������,��������� ����,������������ �������,��������,������ �����,��������,���������,���������-��������,���������-��������,����������� �������,������������� ����,������������ ����,���������� �������,������������� �������,������ �������,������������ �������,������������ �������,�������� ������,�������������� ����,������� �������,����,��������� �������,�������,����������� �������,�����',
						'0.5:102,1:115,1.5:128,2:141,2.5:154,3:167,3.5:180,4:193,4.5:206,5:219,5.5:232,6:245,6.5:258,7:271,7.5:284,8:297,8.5:310,9:323,9.5:336,10:349,10.5:457,11:473,11.5:489,12:505,12.5:521,13:537,13.5:553,14:569,14.5:585,15:601,15.5:617,16:633,16.5:649,17:665,17.5:681,18:697,18.5:713,19:729,19.5:745,20:761',
					 ),
				array(
						'�������,��������� �������,��������,��������� �������,�������� ��������� ��,����-��������� ��������� ��',
						'0.5:125,1:143,1.5:161,2:179,2.5:197,3:215,3.5:233,4:251,4.5:269,5:287,5.5:305,6:323,6.5:341,7:359,7.5:377,8:395,8.5:413,9:431,9.5:449,10:467,10.5:629,11:652,11.5:675,12:698,12.5:721,13:744,13.5:767,14:790,14.5:813,15:836,15.5:859,16:882,16.5:905,17:928,17.5:951,18:974,18.5:997,19:1020,19.5:1043,20:1066',
					 ),
				array(
						'�������� �������,��������� ���������� �������,���������� ����,����������� �������,���������� ����,����������� �������,����������� ����,��������� ��,������,����������� ��,�����-�������� ��',
						'0.5:165,1:211,1.5:257,2:303,2.5:349,3:395,3.5:441,4:487,4.5:533,5:579,5.5:625,6:671,6.5:717,7:763,7.5:809,8:855,8.5:901,9:947,9.5:993,10:1039,10.5:1145,11:1191,11.5:1237,12:1283,12.5:1329,13:1375,13.5:1421,14:1467,14.5:1513,15:1559,15.5:1605,16:1651,16.5:1697,17:1743,17.5:1789,18:1835,18.5:1881,19:1927,19.5:1973,20:2019',
					 ),
			);

			$countries = array(
				array(
						'BY,EE,UZ',
						'0.1:28,0.25:44,0.5:71,1:112,2:150'
					 ),

				array(
						'*',
						'0.1:62,0.25:87,0.5:131,1:194,2:257'
					 ),
			);




			//������� ������� ���� - ���� �� ������ ��� ���� ��������
			//������� ������� ���� ��������� (������� ��� ���� TEXT)
			$sql = tep_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " LIMIT 1");
			$meta = tep_db_fetch_fields($sql);
			if($meta->blob == 0)
			{
				tep_db_query("ALTER TABLE `" . TABLE_CONFIGURATION . "` CHANGE `configuration_value` `configuration_value` TEXT NOT NULL");
				//������? tep_db_query("ALTER TABLE `" . TABLE_CONFIGURATION . "` CHANGE `configuration_title` `configuration_title` VARCHAR( 128 ) NOT NULL");
			}

			/*
			������?
			$sql = tep_db_query("SELECT configuration_description FROM " . TABLE_CONFIGURATION . " LIMIT 1");

			$meta = tep_db_fetch_fields($sql);
			if($meta->blob == 0)
			{
            	tep_db_query("ALTER TABLE `" . TABLE_CONFIGURATION . "` CHANGE `configuration_description` `configuration_description` TEXT NOT NULL");
			}
			*/



			/********** ������� **********
			*
			*
			******************************/
			if($module != 'prepay')
			{
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('��������� ���������� ����� �������.', 'MODULE_SHIPPING_RP_PARCEL_STATUS_PF', 'True', '�� ������ ������������ &laquo;�������&raquo; ��� �������?', '6', '15', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('��������� ���������� ����� ���������.', 'MODULE_SHIPPING_RP_WRAPPER_STATUS_PF', 'True', '�� ������ ������������ &laquo;�������&raquo; ��� ���������?', '6', '18', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('�����������', 'MODULE_SHIPPING_RP_SORT_ORDER_PF', '9', '��������� ����� ������ � ������ �������.', '6', '24', now())");

				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('����� ������ (&laquo;�������&raquo;) - Tax Class', 'MODULE_SHIPPING_RP_TAX_CLASS_PF', '0', 'Use the following tax class on the shipping fee.', '6', '21', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");

				//������� �������� �� �������
		 		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('������� �������� �� &laquo;�������&raquo; �� �������.', 'MODULE_SHIPPING_RP_PARCEL_COST', '0', 'Zx% - ����� ������� �� ��������� ������; x - ������������� ���������. x - �����-���� �����, Z �����: <b>p</b> - ������� �� ��������� ������, <b>d</b> - ������� �� ��������� �������� (� ������ ����� �� ������), <b>a (��� ���������� �����)</b> - ������� �� ��������� ������ � ��������. <br><i>��������� ����� (�������) ���������� � ��������� ��������.</i>', '6', '74', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, date_added) values ('������� �������� �� &laquo;�������&raquo; �� ���������.', 'MODULE_SHIPPING_RP_WRAPPER_COST', '0', 'Zx% - ����� ������� �� ��������� ������; x - ������������� ���������. x - �����-���� �����, Z �����: <b>p</b> - ������� �� ��������� ������, <b>d</b> - ������� �� ��������� �������� (� ������ ����� �� ������), <b>a (��� ���������� �����)</b> - ������� �� ��������� ������ � ��������. <br><i>��������� ����� (�������) ���������� � ��������� ��������.</i>', '6', '77', now())");

			 	//����������� �������� ��� �������
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, date_added) values ('�������, � ������� ������� &laquo;��������&raquo; �� ������������.', 'MODULE_SHIPPING_RP_PARCEL_LIMITATION_PF', '0', '��������� �������� ����� ������� ����� �������.', '6', '83', now())");
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, date_added) values ('�������, � ������� ��������� &laquo;��������&raquo; �� ������������.', 'MODULE_SHIPPING_RP_WRAPPER_LIMITATION_PF', '0', '��������� �������� ����� ������� ����� �������.', '6', '86', now())");

			}


			/********* ���������� *********
			*
			*
			******************************/
			if($module == 'prepay')
			{
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('��������� ���������� ����� �������.', 'MODULE_SHIPPING_RP_PARCEL_STATUS', 'True', '�� ������ ������������ &laquo;�������&raquo; ��� �������?', '6', '3', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('��������� ���������� ����� ���������.', 'MODULE_SHIPPING_RP_WRAPPER_STATUS', 'True', '�� ������ ������������ &laquo;�������&raquo; ��� ���������?', '6', '6', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('����� ������ (&laquo;�������&raquo;) - Tax Class', 'MODULE_SHIPPING_RP_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '21', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");

				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('�����������', 'MODULE_SHIPPING_RP_SORT_ORDER_PREPAY', '7', '��������� ����� ������ � ������ �������.', '6', '24', now())");

				//������ ������� ������ - ��������, ����������, �������
		   		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description,
				configuration_group_id, sort_order, date_added) values ('*������ ������� ������ (��������, ����������, �������)', 
				'MODULE_SHIPPING_RP_COUNTRY_1', '" . $countries[0][0]  ."', '������� ���� (ISO 2) ����� ������� ������ (��������, ����������, �������).', '6', '50', now())");

			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('������ ������� ������: ������� ���������', 'MODULE_SHIPPING_RP_COUNTRY_PRICE_1', '" . $countries[0][1]  ." ',  '�� �������: <i>���:����,���:����</i>. ������ 3:8.50,7:10.50,... � �.�.', '6', '53', now())");

				//��������� ������
		   		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description,
				configuration_group_id, sort_order, date_added) values ('*��������� ������', 
				'MODULE_SHIPPING_RP_COUNTRY_2', '" . $countries[1][0]  ."', '������� ���� (ISO 2) ��������� �����. ���� �� ������ ���������� �� ����� ����, �� ������� * (��������), ����� ������� ����.', '6', '56', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('��������� ������: ������� ���������', 'MODULE_SHIPPING_RP_COUNTRY_PRICE_2', '" . $countries[1][1]  ." ', '�� �������: <i>���:����,���:����</i>. ������ 3:8.50,7:10.50,... � �.�.', '6', '59', now())");

				//��������� �����
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('����� ��������� ��������� ������� (��� ��).', 'MODULE_SHIPPING_RP_PARCEL_INSURANCE_PRICE', '0', '0 - ����� ������ ����� ����� ��������� ������ � ���������; x% - ����� ������� �� ��������� ������; x - ������������� ���������. x - �����-���� �����', '6', '68', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('����� ��������� ��������� ��������� (��� ��).', 'MODULE_SHIPPING_RP_WRAPPER_INSURANCE_PRICE', '0', '0 - ����� ������ ����� ����� ��������� ������ � ���������; x% - ����� ������� �� ��������� ������; x - ������������� ���������. x - �����-���� �����', '6', '71', now())");



		 		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('��������� ���������� ������������� �������.', 'MODULE_SHIPPING_RP_INTER_REG', '0', '������� �����', '6', '85', now())");

			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('������������ ��� ����� ������������� �������.', 'MODULE_SHIPPING_RP_INTER_MAXWEIGHT', '10', '����� ������������ ��� ����� ���� � �������? ���� ��� ����� ������, ����� ����� ������ �� ��������� �������.', '6', '65', now())");

				//���������� ��������
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('����� ��� ���������� �������� �������.', 'MODULE_SHIPPING_RP_PARCEL_FREE', '0', '������� �����, ��� ������� �������� ����� ����������. ���� ������� 0, �� ���������� �������� �� �����.', '6', '86', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('����� ��� ���������� �������� ���������.', 'MODULE_SHIPPING_RP_WRAPPER_FREE', '0', '������� �����, ��� ������� �������� ����� ����������. ���� ������� 0, �� ���������� �������� �� �����.', '6', '89', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('����� ��� ���������� �������� ������������� �������.', 'MODULE_SHIPPING_RP_INTER_FREE', '0', '������� �����, ��� ������� �������� � ������ ������ ����� ����������. ���� ������� 0, �� ���������� �������� �� �����.', '6', '92', now())");

			}


            //��������� ������� ������
			if(
			   !@in_array(MODULE_SHIPPING_RP_PARCEL_STATUS , $this->settings) &&
			   !@in_array(MODULE_SHIPPING_RP_WRAPPER_STATUS , $this->settings) &&
			   !@in_array(MODULE_SHIPPING_RP_PARCEL_STATUS_PF , $this->settings) &&
			   !@in_array(MODULE_SHIPPING_RP_WRAPPER_STATUS_PF , $this->settings)
			   )
			{

				//���������� ���������
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*����������� ������ (��������) ������ � &laquo;�����&raquo; ���������.', 'MODULE_SHIPPING_RP_WRAPPER_SEPARATOR', '-', '���������� �������, ����� �������� ����� ���������� ������ (�������) ������ �� ����� ���������. ��������: <i><font color=#008080>banderol</font><b>-</b><font color=#800040>ART6789B</font></i>', '6', '9', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*���������� ����� ��� ���������� ���������.', 'MODULE_SHIPPING_RP_WRAPPER_ISSET', 'bn,book', '�� ������ ������ ��������� ���������� ������ ����� �������.', '6', '12', now())");


       	     //���������� ����
      	      $g = 0;
     	       for($i=1; $i<=5; $i++)
    	        {
  		          	$k = $i -1;
	   				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description,configuration_group_id, sort_order,
	   				date_added) values ('" . $i ."-� ����',
					'MODULE_SHIPPING_RP_STATES_" . $i ."', '" . $zones[$k][0] . "', '������� �������� �������� �� ��� " . $i ."-� ����.', '6', '".(27+$g)."', now())");

			        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('" . $i ."-� ����: ������� ��������� �������', 'MODULE_SHIPPING_RP_STATES_PRICE_PARCEL_" . $i ."', '" . $zones[$k][1]  ."', '�� �������: <i>���:����,���:����</i>. ������ 3:8.50,7:10.50,... � �.�.', '6', '".(27+$g+1)."',  now())");
			        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('" . $i ."-� ����: ������� ��������� ���������', 'MODULE_SHIPPING_RP_STATES_PRICE_WRAPPER_" . $i ."', '" . $zones[$k][2]  ."', '�� �������: <i>���:����,���:����</i>. ������ 3:8.50,7:10.50,... � �.�.', '6', '".(27+$g+2)."',  now())");
			        $g = $g+3;
	            }

		 		//��������� ��������
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*��������, ��������� ������ �� ��������� ��������� �������.', 'MODULE_SHIPPING_RP_PARCEL_INSURANCE', '4', '������� ������ �����', '6', '62', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*��������, ��������� ������ �� ��������� ��������� ���������.', 'MODULE_SHIPPING_RP_WRAPPER_INSURANCE', '3', '������� ������ �����', '6', '65', now())");

			 	//������������ ���
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*������������ ��� ����� ���������.', 'MODULE_SHIPPING_RP_WRAPPER_MAXWEIGHT', '2', '����� ������������ ��� ����� ���� � ���������? ���� ��� ����� ������, ����� ������� ������� ��� ����� ����� ������ �� ��������� ����������.', '6', '65', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*������������ ��� ����� �������.', 'MODULE_SHIPPING_RP_PARCEL_MAXWEIGHT', '10', '����� ������������ ��� ����� ���� � �������? ���� ��� ����� ������, ����� ����� ������ �� ��������� �������.', '6', '65', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('*��������� &laquo;������������&raquo; ��������� �� ��������� ���� (����� ������������ �������)?', 'MODULE_SHIPPING_RP_WRAPPERS_OR_PARCEL', 'True', '<b>��</b> - ��������� �� ��������� ����������.<br><b>���</b> - ������� � ������ �������.', '6', '6', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");


				//��������� ���������� ��������� �����������
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*��������� ���������� �������.', 'MODULE_SHIPPING_RP_PARCEL_REG', '0','������� �����','6', '80', now())");
		 		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*��������� ���������� ���������.','MODULE_SHIPPING_RP_WRAPPER_REG', '0','������� �����','6', '83', now())");

		 	}
	    }


		function _remove($module)
		{

            $this->all_settings();
			/********** ������� **********
			*
			*
			******************************/
			if($module != 'prepay' &&
			   !@in_array(MODULE_SHIPPING_RP_PARCEL_STATUS , $this->settings) &&
			   !@in_array(MODULE_SHIPPING_RP_WRAPPER_STATUS , $this->settings)
			   )
            		tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key IN ('" . implode("', '", $this->_keys('all')) . "')");




			/********* ���������� *********
			*
			*
			******************************/
			if($module == 'prepay' &&
			   !@in_array(MODULE_SHIPPING_RP_PARCEL_STATUS_PF , $this->settings) &&
			   !@in_array(MODULE_SHIPPING_RP_WRAPPER_STATUS_PF , $this->settings)
			   )
            		tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key IN ('" . implode("', '", $this->_keys('all')) . "')");


			tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key IN ('" . implode("', '", $this->_keys($module)) . "')");
		}


		function _keys($module, $act='')
		{
			//�������
			$Pkeys = array(
			0 => 'MODULE_SHIPPING_RP_PARCEL_STATUS',//���./����. ������� - 1
			3 => 'MODULE_SHIPPING_RP_WRAPPER_STATUS', //���./����. ��������� - 1

			6 => 'MODULE_SHIPPING_RP_TAX_CLASS',//�����

			9 => 'MODULE_SHIPPING_RP_SORT_ORDER_PREPAY',//���������� - 3

			45 => 'MODULE_SHIPPING_RP_COUNTRY_1',//���� ����� "������� ������" (����������, ����������, �������)
			48 => 'MODULE_SHIPPING_RP_COUNTRY_2',//���� ��������� ����� (* - ����� ������) - *

			46 => 'MODULE_SHIPPING_RP_COUNTRY_PRICE_1',//���� ��� ����� "������� ������" (����������, ����������, �������)
			49 => 'MODULE_SHIPPING_RP_COUNTRY_PRICE_2',//���� ��� ��������� ����� (* - ����� ������) - *

			55 => 'MODULE_SHIPPING_RP_PARCEL_INSURANCE_PRICE',//��������� ���������: 0=��������� ������ � ���������;
			58 => 'MODULE_SHIPPING_RP_WRAPPER_INSURANCE_PRICE',//��������� ���������: 0=��������� ������ � ���������;

			73 => 'MODULE_SHIPPING_RP_INTER_REG',//���� �� ���������� ������������� �������

			77 => 'MODULE_SHIPPING_RP_INTER_MAXWEIGHT',//������������ ��� ������������� �������

			80 => 'MODULE_SHIPPING_RP_PARCEL_FREE',//�����, ��� ������� �������� �������� ��������� - 0
			83 => 'MODULE_SHIPPING_RP_WRAPPER_FREE',//�����, ��� ������� �������� ���������� ��������� - 0
			87 => 'MODULE_SHIPPING_RP_INTER_FREE',//�����, ��� ������� ������������� �������� ���������

			);

            //�������
			$PFkeys = array(
			0 => 'MODULE_SHIPPING_RP_PARCEL_STATUS_PF',//���./����. ������� ������� - 1
			3 => 'MODULE_SHIPPING_RP_WRAPPER_STATUS_PF',//���./����. ������� ��������� - 1

			9 => 'MODULE_SHIPPING_RP_SORT_ORDER_PF',//���������� - 3

			6 => 'MODULE_SHIPPING_RP_TAX_CLASS_PF',//�����

			80 => 'MODULE_SHIPPING_RP_PARCEL_COST',//������� ��� ����� �� ������� (���� "�������" �������� ��-�� "��������� �����") ������� - 0
			83 => 'MODULE_SHIPPING_RP_WRAPPER_COST',//������� ��� ����� �� ������� (���� "�������" �������� ��-�� "��������� �����") ��������� - 0

			86 => 'MODULE_SHIPPING_RP_PARCEL_LIMITATION_PF',//�������, � ������� ������ ���������� ������� ��������
			87 => 'MODULE_SHIPPING_RP_WRAPPER_LIMITATION_PF',//�������, � ������� ������ ���������� ��������� ��������

			);


			$ALLkeys = array(

			12 => 'MODULE_SHIPPING_RP_WRAPPER_SEPARATOR',//�� ����� ������ ������ ��������� - -
			15=> 'MODULE_SHIPPING_RP_WRAPPER_ISSET',//���������� ����� ������ (��������) - band

			27 => 'MODULE_SHIPPING_RP_STATES_1',//������ ����
			30 => 'MODULE_SHIPPING_RP_STATES_2',//������ ����
			34 => 'MODULE_SHIPPING_RP_STATES_3',//������ ����
			37 => 'MODULE_SHIPPING_RP_STATES_4',//��������� ����
			40 => 'MODULE_SHIPPING_RP_STATES_5',//����� ����

			//��������� ���������
			28 => 'MODULE_SHIPPING_RP_STATES_PRICE_WRAPPER_1',//������ ����
			31 => 'MODULE_SHIPPING_RP_STATES_PRICE_WRAPPER_2',//������ ����
			35 => 'MODULE_SHIPPING_RP_STATES_PRICE_WRAPPER_3',//������ ����
			38 => 'MODULE_SHIPPING_RP_STATES_PRICE_WRAPPER_4',//��������� ����
			41 => 'MODULE_SHIPPING_RP_STATES_PRICE_WRAPPER_5',//����� ����

			//��������� �������
			29 => 'MODULE_SHIPPING_RP_STATES_PRICE_PARCEL_1',//������ ����
			32 => 'MODULE_SHIPPING_RP_STATES_PRICE_PARCEL_2',//������ ����
			36 => 'MODULE_SHIPPING_RP_STATES_PRICE_PARCEL_3',//������ ����
			39 => 'MODULE_SHIPPING_RP_STATES_PRICE_PARCEL_4',//��������� ����
			42 => 'MODULE_SHIPPING_RP_STATES_PRICE_PARCEL_5',//����� ����

			61 => 'MODULE_SHIPPING_RP_PARCEL_INSURANCE',//��������� ������� ��������� ������ �� ������� - 3
			64 => 'MODULE_SHIPPING_RP_WRAPPER_INSURANCE',//��������� ������� ��������� ������ �� ��������� - 3

			67 => 'MODULE_SHIPPING_RP_PARCEL_REG',//���� �� ���������� �������
			70 => 'MODULE_SHIPPING_RP_WRAPPER_REG',//���� �� ���������� ���������

			75 => 'MODULE_SHIPPING_RP_WRAPPER_MAXWEIGHT',//������������ ��� ���������
			76 => 'MODULE_SHIPPING_RP_PARCEL_MAXWEIGHT',//������������ ��� ���������


			78 => 'MODULE_SHIPPING_RP_WRAPPERS_OR_PARCEL',//��� �������� ������������ �������� �� ��������� ���������� ��� ���������� � �������
			);

			//�������
			if($module!='prepay')$key = $PFkeys;

			//����������
			if($module=='prepay')$key = $Pkeys;

			//�����
			if($module=='all')$key = $ALLkeys;


			if($act == 'all')
			{
				//$key = array_merge($key , $ALLkeys);
				foreach($ALLkeys as $k=>$v)
				{
					$key[$k] = $v;
				}
			}

			ksort($key);
			foreach($key as $k=>$v)
			{
				$key2[] = $v;
			}

			return $key2;
		}

		//������� ��������� ������������
		function om_number($number, $titles)
		{
		        $cases = array (2, 0, 1, 1, 1, 2);
		    return $number." ".$titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
		}


		//��������� ���������
		//$cost_table - array('����', '���','����', '���');
		//$weight - ���
		//$need_parcel - ����������� ���-�� �������
		//$maxweight - ������������ ��� �������
		//$reg - ��������� ����� ����� �������
		function price($cost_table, $weight, $need_parcel, $maxweight, $reg)
		{
			//������������ ��� ������ �������
			$shipping = 0;
			if($need_parcel > 1)
			{
				$first = $maxweight;
	      		for ($i=0; $i<sizeof($cost_table); $i+=2)
	        	{
	         		if ($first <= $cost_table[$i])
	          		{
	         		 	$shipping = $cost_table[$i+1]+$reg;
	     		        break;
					}
				}

				$shipping = $shipping*($need_parcel-1);

				$final = $weight-($maxweight*($need_parcel-1));

			}
			else $final = $weight;

	  		for ($i=0; $i<sizeof($cost_table); $i+=2)
	    	{
	     		if ($final <= $cost_table[$i])
	       		{
	         		$shipping = $shipping + $cost_table[$i+1]+$reg;
	     		    break;
				}
			}

			return $shipping;
		}


		//������������ �����, ������� ������� ������ ����� ��
		//��������� ���������.
		//$price - �����
		//4rate - �������
		function insurance($price, $rate)
		{
			if($rate==0)return 0;

			$x = 100-$rate;
            $y = ($price/$x)*100;
			return $y-$price;
		}

	}


	class russianpostpf extends  russianpostt{
		var $code, $title, $description, $enabled;

		function russianpostpf()
		{
		      $this->code = 'russianpostpf';
		      $this->title = MODULE_SHIPPING_RP_TEXT_TITLE_PF;
		      $this->description = MODULE_SHIPPING_RP_TEXT_DESCRIPTION_PF;
		      $this->sort_order = MODULE_SHIPPING_RP_SORT_ORDER_PF;
		      $this->icon = '';
		      $this->tax_class = MODULE_SHIPPING_RP_TAX_CLASS_PF;
		      $this->enabled = ((MODULE_SHIPPING_RP_PARCEL_STATUS_PF == 'True' || MODULE_SHIPPING_RP_WRAPPER_STATUS_PF == 'True') ? true : false);


		}


		function check()
		{
			if (!isset($this->_check))
			{
				$check_query = tep_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_SHIPPING_RP_PARCEL_STATUS_PF' || configuration_key = 'MODULE_SHIPPING_RP_WRAPPER_STATUS_PF' LIMIT 1");
				$this->_check = tep_db_num_rows($check_query);
			}
			return $this->_check;
		}



		// class methods
    	function quote($method = '')
    	{
			global $order, $shipping_weight, $currencies, $cart;

   			$home = false;

			$dest_country = $order->delivery['country']['iso_code_2'];
			$dest_province = $order->delivery['state'];
			$dest_zone_id;

			$dest_zone = 0;
			$error = false;
			$err_msg;

			//���� ������ ������, �� ���� ������� �� �������
			//"��������" ������.
			if($dest_country == "RU")
			{
				$dest_zone_id = $dest_province;
				$home = true;
			}

			//������� ��� ������ �� ������
			else
			{
				$error = true;
				$err_msg = MODULE_SHIPPING_RP_INVALID_ZONE_PF;
			}



			//������� ������ ������
			for ($i=1; $i<=5; $i++)
			{
				$zones_table = constant('MODULE_SHIPPING_RP_STATES_' . $i);
				$zones = preg_split("/[,]/", $zones_table);
				if (in_array($dest_zone_id, $zones))
				{
					$dest_zone = $i;
					break;
				}
			}


			//������ ������� ��� ���������
			//��� ������ ������ ������������� ��� ���������
			$need_wr = (MODULE_SHIPPING_RP_WRAPPER_MAXWEIGHT < $shipping_weight) ? ((MODULE_SHIPPING_RP_WRAPPERS_OR_PARCEL == 'True') ? 1 : 0) : 1;
			//$wrapper = 0 - �������
			//$wrapper = 1 - ���������
#####			$wrapper = (MODULE_SHIPPING_RP_WRAPPER_STATUS_PF == 'True' && $need_wr) ? $this->is_wrapper($order->products)  : 0;
			$wrapper = (MODULE_SHIPPING_RP_WRAPPER_STATUS_PF == 'True' && $need_wr) ? $this->is_wrapper($cart->get_products())  : 0;

			if($wrapper == 0 && MODULE_SHIPPING_RP_PARCEL_STATUS_PF != 'True')return false;

			$mode = ($wrapper == 1) ? 'WRAPPER' : 'PARCEL';


			//������� ����������� �������
			$zones_table = constant('MODULE_SHIPPING_RP_'.$mode.'_LIMITATION_PF');
			$zones = preg_split("/[,]/", $zones_table);
			if (in_array($dest_zone_id, $zones))
			{
				return false;
				/*
					$error = true;
          			$err_msg = MODULE_SHIPPING_RP_UNDEFINED_RATE_PF;
     			*/
			}


			//����������� �� ������� �������/���������� ����� ������� �����
			$need_parcel = 1;
			$maxweight = constant('MODULE_SHIPPING_RP_'.$mode.'_MAXWEIGHT');
			if($shipping_weight > $maxweight)
			{
				$need_parcel = ceil($shipping_weight/$maxweight);
			}


      		if ($dest_zone == 0)
	      	{
				$error = true;
				$err_msg = MODULE_SHIPPING_RP_INVALID_ZONE_PF;
			}

			else
			{
				$zones_cost = constant('MODULE_SHIPPING_RP_STATES_PRICE_'.$mode.'_' . $dest_zone);

				$cost_table = preg_split("/[:,]/" , $zones_cost);

				$shipping = $this->price($cost_table, $shipping_weight, $need_parcel, $maxweight, constant('MODULE_SHIPPING_RP_'.$mode.'_REG'));

	   			$shipping_method = constant('MODULE_SHIPPING_RP_TEXT_WAY_'.$mode.'_PF').' <nobr>('.$order->delivery['state'].
	       		     							' - '.$shipping_weight.' '.MODULE_SHIPPING_RP_TEXT_UNITS_PF.'</nobr> <nobr>['.
	       		     							constant('MODULE_SHIPPING_RP_'.$mode.'_NEED_PF').
	       		     							$this->om_number($need_parcel, array(constant('MODULE_SHIPPING_RP_'.$mode.'_1_PF'),
	       		     																constant('MODULE_SHIPPING_RP_'.$mode.'_2_PF'),
	       		     																constant('MODULE_SHIPPING_RP_'.$mode.'_5_PF')
	       		     																)).
	       		     							']</nobr>)';

                if($shipping == 0)$shipping = -1;


				if ($shipping == -1)
				{
					$error = true;
          			$err_msg = MODULE_SHIPPING_RP_UNDEFINED_RATE_PF;
        		}

        		else
        		{

          			/**** ������� �������� ���� ****/

	          		/*-- "�����" �������� --*/



             		//����� ��������
             		$burden = 0;
					$burden_data = constant('MODULE_SHIPPING_RP_'.$mode.'_COST');

					if(!empty($burden_data) || $burden_data > 0)
					{

	            		$burden = (strpos($burden_data, '%') === false ) ?
	                    				$burden_data :
	                    				substr($burden_data, 0, strpos($burden_data, '%'));

	            		$burden_proc = (strpos($burden_data, '%') === false) ? false : true;

                    	//������ ������ ����������� ���������
                    	$burden_method = 0;
                     	if($burden_proc)
                     	{
                     		$bm = substr($burden_data,0,1);
                     		if($bm == 'p' || $bm == 'P' || $bm == '�' || $bm == '�')$burden_method = 'products';
                     		else if($bm == 'd' || $bm == 'D')$burden_method = 'delivery';
                     		else {$burden_method = 'all';}

###                     		$burden = substr(substr($burden_data, 0, strpos($burden_data, '%')), ((intval($bm) > 0)?0:1), strlen($burden_data)-1);
                     		$burden = substr(substr($burden_data, 0, strpos($burden_data, '%')), (($bm == '')?0:1), strlen($burden_data)-1);
                     	}

					}

					if($burden_method == 'delivery' && $burden_proc)
						$delivery = $shipping+(($shipping/100)*$burden);

					elseif($burden_method == 'products' && $burden_proc)
						$delivery = $shipping+(($cart->show_total()/100)*$burden);

					elseif($burden_method == 'all'  && $burden_proc)
                         $delivery = $shipping+
                         			((($shipping+$cart->show_total())/100)*$burden);

					else $delivery = $shipping;

					//�������� ��������� ����� �������� (�� �������)
					if(!$burden_proc)$delivery+= $burden;

					//�������� + ����� ������
					$appraisal_price = $delivery + $cart->show_total();

					//����������� ��������� ���������
					$insurance_price = $this->insurance($appraisal_price, intval(constant('MODULE_SHIPPING_RP_'.$mode.'_INSURANCE')));

	   	    		//�������� ��������� �������� = �������� + ����� �� ���� ������� + ��������� �������
					$shipping_cost = $delivery + $insurance_price;
        		}
      }


      $this->quotes = array('id' => $this->code,
                            'module' => MODULE_SHIPPING_RP_TEXT_TITLE_PF,
                            'methods' => array(
                            					array('id' => $this->code,
                                                     'title' => $shipping_method,
                                                     'cost' => ceil($shipping_cost)
                                                     )
                                         	)

                            );




      if ($this->tax_class > 0) {
        $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }

      if (tep_not_null($this->icon)) $this->quotes['icon'] = tep_image($this->icon, $this->title);

      if ($error == true) $this->quotes['error'] = $err_msg;

      return $this->quotes;
    }


    function install()
    {
    	$this->_install('pf');
    }

    function remove()
    {
    	$this->_remove('pf');
    }


    function keys()
    {
    	return $this->_keys('pf', 'all');
    }
  }
?>