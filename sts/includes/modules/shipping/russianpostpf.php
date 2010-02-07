<?php
/*
	Полный модуль доставки почтой России.
	Filename: modules/shipping/russianpostpf.php
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	Написано Igel'ем.
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
			/* Запросим все настройки нашего модуля*/
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
 			/* Узнаем посылка или бандероль */
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
						'Карелия,Ленинградская область,Новгородская область,Псковская область,Тверская область,Санкт-Петербург',
						'0.5:97,1:105,1.5:113,2:121,2.5:129,3:137,3.5:145,4:153,4.5:161,5:169,5.5:177,6:185,6.5:193,7:201,7.5:209,8:217,8.5:225,9:233,9.5:241,10:249,10.5:318,11:327,11.5:337,12:347,12.5:357,13:367,13.5:377,14:387,14.5:397,15:407,15.5:417,16:427,16.5:437,17:447,17.5:457,18:467,18.5:477,19:487,19.5:497,20:507',
					 ),

				array(
						'Архангельская область,Белгородская область,Брянская область,Владимирская область,Волгоградская область,Вологодская область,Воронежская область,Ивановская область,Калининградская область,Калужская область,Кировская область,Коми,Костромская область,Самарская область,Курская область,Липецкая область,Марийская Республика,Мордовская Республика,Московская область,Мурманская область,Нижегородская область,Орловская область,Пензенская область,Пермский край,Ростовская область,Рязанская область,Саратовская область,Смоленская область,Тамбовская область,Татарстан,Тульская область,Удмуртия,Ульяновская область,Чувашия,Ярославская область,Москва',
						'0.5:98,1:107,1.5:116,2:125,2.5:134,3:143,3.5:152,4:161,4.5:170,5:179,5.5:188,6:197,6.5:206,7:215,7.5:224,8:233,8.5:242,9:251,9.5:260,10:269,10.5:348,11:359,11.5:370,12:381,12.5:392,13:403,13.5:414,14:425,14.5:436,15:447,15.5:458,16:469,16.5:480,17:491,17.5:502,18:513,18.5:524,19:535,19.5:546,20:557',
					 ),
				array(
						'Адыгея,Алтайский край,Астраханская область,Башкирия,Горный Алтай,Дагестан,Ингушетия,Кабардино-Балкария,Карачаево-Черкесия,Кемеровская область,Краснодарский край,Красноярский край,Курганская область,Новосибирская область,Омская область,Оренбургская область,Свердловская область,Северная Осетия,Ставропольский край,Томская область,Тува,Тюменская область,Хакасия,Челябинская область,Чечня',
						'0.5:102,1:115,1.5:128,2:141,2.5:154,3:167,3.5:180,4:193,4.5:206,5:219,5.5:232,6:245,6.5:258,7:271,7.5:284,8:297,8.5:310,9:323,9.5:336,10:349,10.5:457,11:473,11.5:489,12:505,12.5:521,13:537,13.5:553,14:569,14.5:585,15:601,15.5:617,16:633,16.5:649,17:665,17.5:681,18:697,18.5:713,19:729,19.5:745,20:761',
					 ),
				array(
						'Бурятия,Иркутская область,Калмыкия,Читинская область,Агинский Бурятский АО,Усть-Ордынский Бурятский АО',
						'0.5:125,1:143,1.5:161,2:179,2.5:197,3:215,3.5:233,4:251,4.5:269,5:287,5.5:305,6:323,6.5:341,7:359,7.5:377,8:395,8.5:413,9:431,9.5:449,10:467,10.5:629,11:652,11.5:675,12:698,12.5:721,13:744,13.5:767,14:790,14.5:813,15:836,15.5:859,16:882,16.5:905,17:928,17.5:951,18:974,18.5:997,19:1020,19.5:1043,20:1066',
					 ),
				array(
						'Амурская область,Еврейская автономная область,Камчатский край,Магаданская область,Приморский край,Сахалинская область,Хабаровский край,Чукотский АО,Якутия,Эвенкийский АО,Ямало-Ненецкий АО',
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




			//таблица старого типа - туда не влезут все наши настроки
			//поэтому таблицу надо расширить (сделать тип поля TEXT)
			$sql = tep_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " LIMIT 1");
			$meta = tep_db_fetch_fields($sql);
			if($meta->blob == 0)
			{
				tep_db_query("ALTER TABLE `" . TABLE_CONFIGURATION . "` CHANGE `configuration_value` `configuration_value` TEXT NOT NULL");
				//нафига? tep_db_query("ALTER TABLE `" . TABLE_CONFIGURATION . "` CHANGE `configuration_title` `configuration_title` VARCHAR( 128 ) NOT NULL");
			}

			/*
			нафига?
			$sql = tep_db_query("SELECT configuration_description FROM " . TABLE_CONFIGURATION . " LIMIT 1");

			$meta = tep_db_fetch_fields($sql);
			if($meta->blob == 0)
			{
            	tep_db_query("ALTER TABLE `" . TABLE_CONFIGURATION . "` CHANGE `configuration_description` `configuration_description` TEXT NOT NULL");
			}
			*/



			/********** НАЛОЖКА **********
			*
			*
			******************************/
			if($module != 'prepay')
			{
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Разрешить наложенный платёж ПОСЫЛКИ.', 'MODULE_SHIPPING_RP_PARCEL_STATUS_PF', 'True', 'Вы хотите активировать &laquo;наложку&raquo; для ПОСЫЛКИ?', '6', '15', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Разрешить наложенный платёж БАНДЕРОЛИ.', 'MODULE_SHIPPING_RP_WRAPPER_STATUS_PF', 'True', 'Вы хотите активировать &laquo;наложку&raquo; для БАНДЕРОЛИ?', '6', '18', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Сортировать', 'MODULE_SHIPPING_RP_SORT_ORDER_PF', '9', 'Положение этого модуля в списке модулей.', '6', '24', now())");

				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Почта России (&laquo;наложка&raquo;) - Tax Class', 'MODULE_SHIPPING_RP_TAX_CLASS_PF', '0', 'Use the following tax class on the shipping fee.', '6', '21', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");

				//расходы магазина на наложку
		 		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Расходы магазина на &laquo;наложку&raquo; за ПОСЫЛКИ.', 'MODULE_SHIPPING_RP_PARCEL_COST', '0', 'Zx% - некий процент от стоимости заказа; x - фиксированная стоимость. x - какое-либо число, Z режим: <b>p</b> - процент от стоимости товара, <b>d</b> - процент от стоимости доставки (с учётом суммы за сборку), <b>a (или отсутствие буквы)</b> - процент от стоимости товара и доставки. <br><i>Указанная сумма (процент) прибавится к стоимости доставки.</i>', '6', '74', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, date_added) values ('Расходы магазина на &laquo;наложку&raquo; за БАНДЕРОЛИ.', 'MODULE_SHIPPING_RP_WRAPPER_COST', '0', 'Zx% - некий процент от стоимости заказа; x - фиксированная стоимость. x - какое-либо число, Z режим: <b>p</b> - процент от стоимости товара, <b>d</b> - процент от стоимости доставки (с учётом суммы за сборку), <b>a (или отсутствие буквы)</b> - процент от стоимости товара и доставки. <br><i>Указанная сумма (процент) прибавится к стоимости доставки.</i>', '6', '77', now())");

			 	//ограничение регионов для наложки
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, date_added) values ('Регионы, в которые ПОСЫЛКИ &laquo;наложкой&raquo; не доставляются.', 'MODULE_SHIPPING_RP_PARCEL_LIMITATION_PF', '0', 'Несколько регионов можно указать через запятую.', '6', '83', now())");
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, date_added) values ('Регионы, в которые БАНДЕРОЛИ &laquo;наложкой&raquo; не доставляются.', 'MODULE_SHIPPING_RP_WRAPPER_LIMITATION_PF', '0', 'Несколько регионов можно указать через запятую.', '6', '86', now())");

			}


			/********* ПРЕДОПЛАТА *********
			*
			*
			******************************/
			if($module == 'prepay')
			{
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Разрешить наложенный платёж ПОСЫЛКИ.', 'MODULE_SHIPPING_RP_PARCEL_STATUS', 'True', 'Вы хотите активировать &laquo;наложку&raquo; для ПОСЫЛКИ?', '6', '3', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Разрешить наложенный платёж БАНДЕРОЛИ.', 'MODULE_SHIPPING_RP_WRAPPER_STATUS', 'True', 'Вы хотите активировать &laquo;наложку&raquo; для БАНДЕРОЛИ?', '6', '6', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Почта России (&laquo;наложка&raquo;) - Tax Class', 'MODULE_SHIPPING_RP_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '21', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");

				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Сортировать', 'MODULE_SHIPPING_RP_SORT_ORDER_PREPAY', '7', 'Положение этого модуля в списке модулей.', '6', '24', now())");

				//страны первого уровня - Беларусь, Узбекистан, Эстония
		   		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description,
				configuration_group_id, sort_order, date_added) values ('*Страны первого уровня (Беларусь, Узбекистан, Эстония)', 
				'MODULE_SHIPPING_RP_COUNTRY_1', '" . $countries[0][0]  ."', 'Введите КОДЫ (ISO 2) стран первого уровня (Беларусь, Узбекистан, Эстония).', '6', '50', now())");

			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Страны первого уровня: таблица стоимости', 'MODULE_SHIPPING_RP_COUNTRY_PRICE_1', '" . $countries[0][1]  ." ',  'По шаблону: <i>вес:цена,вес:цена</i>. Пример 3:8.50,7:10.50,... и т.д.', '6', '53', now())");

				//остальные страны
		   		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description,
				configuration_group_id, sort_order, date_added) values ('*Остальные страны', 
				'MODULE_SHIPPING_RP_COUNTRY_2', '" . $countries[1][0]  ."', 'Введите КОДЫ (ISO 2) остальных стран. Если Вы готовы доставлять по всему миру, то введите * (звёздочку), иначе вводите коды.', '6', '56', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Остальные страны: таблица стоимости', 'MODULE_SHIPPING_RP_COUNTRY_PRICE_2', '" . $countries[1][1]  ." ', 'По шаблону: <i>вес:цена,вес:цена</i>. Пример 3:8.50,7:10.50,... и т.д.', '6', '59', now())");

				//оценочная сумма
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Сумма оценочной стоимости ПОСЫЛКИ (без НП).', 'MODULE_SHIPPING_RP_PARCEL_INSURANCE_PRICE', '0', '0 - сумма оценки будет равна стоимости заказа с доставкой; x% - некий процент от стоимости заказа; x - фиксированная стоимость. x - какое-либо число', '6', '68', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Сумма оценочной стоимости БАНДЕРОЛИ (без НП).', 'MODULE_SHIPPING_RP_WRAPPER_INSURANCE_PRICE', '0', '0 - сумма оценки будет равна стоимости заказа с доставкой; x% - некий процент от стоимости заказа; x - фиксированная стоимость. x - какое-либо число', '6', '71', now())");



		 		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Стоимость оформления МЕЖДУНАРОДНОЙ ПОСЫЛКИ.', 'MODULE_SHIPPING_RP_INTER_REG', '0', 'Укажите сумму', '6', '85', now())");

			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Максимальный вес одной МЕЖДУНАРОДНОЙ ПОСЫЛКИ.', 'MODULE_SHIPPING_RP_INTER_MAXWEIGHT', '10', 'Какой максимальный вес может быть у посылки? Если вес будет больше, заказ будет разбит на несколько посылок.', '6', '65', now())");

				//бесплатная доставка
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Сумма для бесплатной доставки ПОСЫЛКИ.', 'MODULE_SHIPPING_RP_PARCEL_FREE', '0', 'Укажите сумму, при которой доставка будет бесплатной. Если указать 0, то бесплатной доставки не будет.', '6', '86', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Сумма для бесплатной доставки БАНДЕРОЛИ.', 'MODULE_SHIPPING_RP_WRAPPER_FREE', '0', 'Укажите сумму, при которой доставка будет бесплатной. Если указать 0, то бесплатной доставки не будет.', '6', '89', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Сумма для бесплатной доставки МЕЖДУНАРОДНОЙ ПОСЫЛКИ.', 'MODULE_SHIPPING_RP_INTER_FREE', '0', 'Укажите сумму, при которой доставка в ДРУГИЕ СТРАНЫ будет бесплатной. Если указать 0, то бесплатной доставки не будет.', '6', '92', now())");

			}


            //установка свежего модуля
			if(
			   !@in_array(MODULE_SHIPPING_RP_PARCEL_STATUS , $this->settings) &&
			   !@in_array(MODULE_SHIPPING_RP_WRAPPER_STATUS , $this->settings) &&
			   !@in_array(MODULE_SHIPPING_RP_PARCEL_STATUS_PF , $this->settings) &&
			   !@in_array(MODULE_SHIPPING_RP_WRAPPER_STATUS_PF , $this->settings)
			   )
			{

				//вычисление бандероли
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*Разделитель модели (артикула) товара и &laquo;ключа&raquo; бандероли.', 'MODULE_SHIPPING_RP_WRAPPER_SEPARATOR', '-', 'Необходимо указать, каким символом будет отделяться модель (артикул) товара от метки бандероли. Например: <i><font color=#008080>banderol</font><b>-</b><font color=#800040>ART6789B</font></i>', '6', '9', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*Сигнальная часть для вычисления БАНДЕРОЛИ.', 'MODULE_SHIPPING_RP_WRAPPER_ISSET', 'bn,book', 'Вы можете ввести несколько сигнальных частей через запятую.', '6', '12', now())");


       	     //внутренние зоны
      	      $g = 0;
     	       for($i=1; $i<=5; $i++)
    	        {
  		          	$k = $i -1;
	   				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description,configuration_group_id, sort_order,
	   				date_added) values ('" . $i ."-я зона',
					'MODULE_SHIPPING_RP_STATES_" . $i ."', '" . $zones[$k][0] . "', 'Введите название областей РФ для " . $i ."-й зоны.', '6', '".(27+$g)."', now())");

			        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('" . $i ."-я зона: таблица стоимости ПОСЫЛКИ', 'MODULE_SHIPPING_RP_STATES_PRICE_PARCEL_" . $i ."', '" . $zones[$k][1]  ."', 'По шаблону: <i>вес:цена,вес:цена</i>. Пример 3:8.50,7:10.50,... и т.д.', '6', '".(27+$g+1)."',  now())");
			        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('" . $i ."-я зона: таблица стоимости БАНДЕРОЛИ', 'MODULE_SHIPPING_RP_STATES_PRICE_WRAPPER_" . $i ."', '" . $zones[$k][2]  ."', 'По шаблону: <i>вес:цена,вес:цена</i>. Пример 3:8.50,7:10.50,... и т.д.', '6', '".(27+$g+2)."',  now())");
			        $g = $g+3;
	            }

		 		//страховые проценты
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*Проценты, взимаемые почтой за оценочную стоимость ПОСЫЛКИ.', 'MODULE_SHIPPING_RP_PARCEL_INSURANCE', '4', 'Введите только цифры', '6', '62', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*Проценты, взимаемые почтой за оценочную стоимость БАНДЕРОЛИ.', 'MODULE_SHIPPING_RP_WRAPPER_INSURANCE', '3', 'Введите только цифры', '6', '65', now())");

			 	//максимальный вес
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*Максимальный вес одной БАНДЕРОЛИ.', 'MODULE_SHIPPING_RP_WRAPPER_MAXWEIGHT', '2', 'Какой максимальный вес может быть у бандероли? Если вес будет больше, будет выбрана посылка или заказ будет разбит на несколько бандеролей.', '6', '65', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*Максимальный вес одной ПОСЫЛКИ.', 'MODULE_SHIPPING_RP_PARCEL_MAXWEIGHT', '10', 'Какой максимальный вес может быть у посылки? Если вес будет больше, заказ будет разбит на несколько посылок.', '6', '65', now())");
			 	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('*Разбивать &laquo;тяжеловесные&raquo; бандероли на несколько штук (иначе использовать посылку)?', 'MODULE_SHIPPING_RP_WRAPPERS_OR_PARCEL', 'True', '<b>Да</b> - разбиение на несколько бандеролей.<br><b>Нет</b> - переход в разряд посылок.', '6', '6', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");


				//стоимость оформления почтового отправления
				tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*Стоимость оформления ПОСЫЛКИ.', 'MODULE_SHIPPING_RP_PARCEL_REG', '0','Укажите сумму','6', '80', now())");
		 		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('*Стоимость оформления БАНДЕРОЛИ.','MODULE_SHIPPING_RP_WRAPPER_REG', '0','Укажите сумму','6', '83', now())");

		 	}
	    }


		function _remove($module)
		{

            $this->all_settings();
			/********** НАЛОЖКА **********
			*
			*
			******************************/
			if($module != 'prepay' &&
			   !@in_array(MODULE_SHIPPING_RP_PARCEL_STATUS , $this->settings) &&
			   !@in_array(MODULE_SHIPPING_RP_WRAPPER_STATUS , $this->settings)
			   )
            		tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key IN ('" . implode("', '", $this->_keys('all')) . "')");




			/********* ПРЕДОПЛАТА *********
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
			//обычная
			$Pkeys = array(
			0 => 'MODULE_SHIPPING_RP_PARCEL_STATUS',//вкл./выкл. ПОСЫЛКУ - 1
			3 => 'MODULE_SHIPPING_RP_WRAPPER_STATUS', //вкл./выкл. БАНДЕРОЛЬ - 1

			6 => 'MODULE_SHIPPING_RP_TAX_CLASS',//налог

			9 => 'MODULE_SHIPPING_RP_SORT_ORDER_PREPAY',//сортировка - 3

			45 => 'MODULE_SHIPPING_RP_COUNTRY_1',//коды стран "первого уровня" (Белоруссия, Узбекистан, Эстония)
			48 => 'MODULE_SHIPPING_RP_COUNTRY_2',//Коды остальных стран (* - любая страна) - *

			46 => 'MODULE_SHIPPING_RP_COUNTRY_PRICE_1',//цены для стран "первого уровня" (Белоруссия, Узбекистан, Эстония)
			49 => 'MODULE_SHIPPING_RP_COUNTRY_PRICE_2',//цены для остальных стран (* - любая страна) - *

			55 => 'MODULE_SHIPPING_RP_PARCEL_INSURANCE_PRICE',//оценочная стоимость: 0=стоимость заказа с доставкой;
			58 => 'MODULE_SHIPPING_RP_WRAPPER_INSURANCE_PRICE',//оценочная стоимость: 0=стоимость заказа с доставкой;

			73 => 'MODULE_SHIPPING_RP_INTER_REG',//цена за оформление международной посылки

			77 => 'MODULE_SHIPPING_RP_INTER_MAXWEIGHT',//максимальный вес международной посылки

			80 => 'MODULE_SHIPPING_RP_PARCEL_FREE',//сумма, при которой доставка ПОСЫЛКОЙ бесплатна - 0
			83 => 'MODULE_SHIPPING_RP_WRAPPER_FREE',//сумма, при которой доставка БАНДЕРОЛЬЮ бесплатна - 0
			87 => 'MODULE_SHIPPING_RP_INTER_FREE',//сумма, при которой международная доставка бесплатна

			);

            //наложка
			$PFkeys = array(
			0 => 'MODULE_SHIPPING_RP_PARCEL_STATUS_PF',//вкл./выкл. наложку ПОСЫЛКИ - 1
			3 => 'MODULE_SHIPPING_RP_WRAPPER_STATUS_PF',//вкл./выкл. наложку БАНДЕРОЛИ - 1

			9 => 'MODULE_SHIPPING_RP_SORT_ORDER_PF',//сортировка - 3

			6 => 'MODULE_SHIPPING_RP_TAX_CLASS_PF',//налог

			80 => 'MODULE_SHIPPING_RP_PARCEL_COST',//процент или сумма за наложку (типа "расходы" магазина из-за "зависания денег") ПОСЫЛКИ - 0
			83 => 'MODULE_SHIPPING_RP_WRAPPER_COST',//процент или сумма за наложку (типа "расходы" магазина из-за "зависания денег") БАНДЕРОЛИ - 0

			86 => 'MODULE_SHIPPING_RP_PARCEL_LIMITATION_PF',//регионы, в которые нельзя отправлять ПОСЫЛКИ наложкой
			87 => 'MODULE_SHIPPING_RP_WRAPPER_LIMITATION_PF',//регионы, в которые нельзя отправлять БАНДЕРОЛИ наложкой

			);


			$ALLkeys = array(

			12 => 'MODULE_SHIPPING_RP_WRAPPER_SEPARATOR',//по какой строке искать бандероль - -
			15=> 'MODULE_SHIPPING_RP_WRAPPER_ISSET',//сигнальная часть модели (артикула) - band

			27 => 'MODULE_SHIPPING_RP_STATES_1',//Первая зона
			30 => 'MODULE_SHIPPING_RP_STATES_2',//Вторая зона
			34 => 'MODULE_SHIPPING_RP_STATES_3',//Третья зона
			37 => 'MODULE_SHIPPING_RP_STATES_4',//Четвертая зона
			40 => 'MODULE_SHIPPING_RP_STATES_5',//Пятая зона

			//стоимость бандероли
			28 => 'MODULE_SHIPPING_RP_STATES_PRICE_WRAPPER_1',//Первая цена
			31 => 'MODULE_SHIPPING_RP_STATES_PRICE_WRAPPER_2',//Вторая цена
			35 => 'MODULE_SHIPPING_RP_STATES_PRICE_WRAPPER_3',//Третья цена
			38 => 'MODULE_SHIPPING_RP_STATES_PRICE_WRAPPER_4',//Четвертая цена
			41 => 'MODULE_SHIPPING_RP_STATES_PRICE_WRAPPER_5',//Пятая цена

			//стоимость посылки
			29 => 'MODULE_SHIPPING_RP_STATES_PRICE_PARCEL_1',//Первая цена
			32 => 'MODULE_SHIPPING_RP_STATES_PRICE_PARCEL_2',//Вторая цена
			36 => 'MODULE_SHIPPING_RP_STATES_PRICE_PARCEL_3',//Третья цена
			39 => 'MODULE_SHIPPING_RP_STATES_PRICE_PARCEL_4',//Четвертая цена
			42 => 'MODULE_SHIPPING_RP_STATES_PRICE_PARCEL_5',//Пятая цена

			61 => 'MODULE_SHIPPING_RP_PARCEL_INSURANCE',//страховой процент взимаемый почтой за ПОСЫЛКУ - 3
			64 => 'MODULE_SHIPPING_RP_WRAPPER_INSURANCE',//страховой процент взимаемый почтой за БАНДЕРОЛЬ - 3

			67 => 'MODULE_SHIPPING_RP_PARCEL_REG',//цена за оформление ПОСЫЛКИ
			70 => 'MODULE_SHIPPING_RP_WRAPPER_REG',//цена за оформление БАНДЕРОЛИ

			75 => 'MODULE_SHIPPING_RP_WRAPPER_MAXWEIGHT',//макисмальный вес бандероли
			76 => 'MODULE_SHIPPING_RP_PARCEL_MAXWEIGHT',//макисмальный вес бандероли


			78 => 'MODULE_SHIPPING_RP_WRAPPERS_OR_PARCEL',//при перевесе использовать разбивку на несколько бандеролей или переходить в посылки
			);

			//наложка
			if($module!='prepay')$key = $PFkeys;

			//предоплата
			if($module=='prepay')$key = $Pkeys;

			//общее
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

		//функция обработки числительных
		function om_number($number, $titles)
		{
		        $cases = array (2, 0, 1, 1, 1, 2);
		    return $number." ".$titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
		}


		//стоимость доаставки
		//$cost_table - array('цена', 'вес','цена', 'вес');
		//$weight - вес
		//$need_parcel - необходимое кол-во посылок
		//$maxweight - максимальный вес посылки
		//$reg - стоимость сбора одной посылки
		function price($cost_table, $weight, $need_parcel, $maxweight, $reg)
		{
			//максимальный вес первой посылки
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


		//подсчитываем сумму, которую придётся отдать почте за
		//оценочную стоимость.
		//$price - сумма
		//4rate - процент
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

			//Если страна Россия, то цену смотрим по региону
			//"домашняя" страна.
			if($dest_country == "RU")
			{
				$dest_zone_id = $dest_province;
				$home = true;
			}

			//Наложка идёт только по России
			else
			{
				$error = true;
				$err_msg = MODULE_SHIPPING_RP_INVALID_ZONE_PF;
			}



			//смотрим нужный регион
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


			//узнаем посылка или бандероль
			//вес заказа меньше максимального для бандероли
			$need_wr = (MODULE_SHIPPING_RP_WRAPPER_MAXWEIGHT < $shipping_weight) ? ((MODULE_SHIPPING_RP_WRAPPERS_OR_PARCEL == 'True') ? 1 : 0) : 1;
			//$wrapper = 0 - посылка
			//$wrapper = 1 - бандероль
#####			$wrapper = (MODULE_SHIPPING_RP_WRAPPER_STATUS_PF == 'True' && $need_wr) ? $this->is_wrapper($order->products)  : 0;
			$wrapper = (MODULE_SHIPPING_RP_WRAPPER_STATUS_PF == 'True' && $need_wr) ? $this->is_wrapper($cart->get_products())  : 0;

			if($wrapper == 0 && MODULE_SHIPPING_RP_PARCEL_STATUS_PF != 'True')return false;

			$mode = ($wrapper == 1) ? 'WRAPPER' : 'PARCEL';


			//смотрим запрещённые регионы
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


			//высчитываем на сколько посылок/бандеролей нужно разбить заказ
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

          			/**** Формула подсчёта цены ****/

	          		/*-- "Риски" магазина --*/



             		//РИСКИ МАГАЗИНА
             		$burden = 0;
					$burden_data = constant('MODULE_SHIPPING_RP_'.$mode.'_COST');

					if(!empty($burden_data) || $burden_data > 0)
					{

	            		$burden = (strpos($burden_data, '%') === false ) ?
	                    				$burden_data :
	                    				substr($burden_data, 0, strpos($burden_data, '%'));

	            		$burden_proc = (strpos($burden_data, '%') === false) ? false : true;

                    	//узнаем откуда высчитывать страховку
                    	$burden_method = 0;
                     	if($burden_proc)
                     	{
                     		$bm = substr($burden_data,0,1);
                     		if($bm == 'p' || $bm == 'P' || $bm == 'р' || $bm == 'Р')$burden_method = 'products';
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

					//прибавим страховую сумму магазина (НЕ процент)
					if(!$burden_proc)$delivery+= $burden;

					//доставка + сумма заказа
					$appraisal_price = $delivery + $cart->show_total();

					//высчитываем страховую стоимость
					$insurance_price = $this->insurance($appraisal_price, intval(constant('MODULE_SHIPPING_RP_'.$mode.'_INSURANCE')));

	   	    		//итоговая стоимость доставки = доставка + плата за сбор посылки + страховой процент
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