<?php
	
	define("MCETYPOGRAF_ENGINES", realPath(dirName(__FILE__) . "/../../../engines"));
	
	header("Content-type: text/plain; charset=utf-8");
	mb_internal_encoding("UTF-8");
	setLocale(LC_ALL,			"ru_RU.UTF-8", "Russian.UTF-8", "ru_RU", "Russian");
	setLocale(LC_NUMERIC,	"C", "en_US.UTF-8", "en_US", "English");

	// ----------------------------------------------------------------------------------------------------------------------------------------------------------------//
	//   Getting params                                                                                                                                                //
	// ----------------------------------------------------------------------------------------------------------------------------------------------------------------//
	
	$xml = simplexml_load_file("php://input", "SimpleXMLElement", LIBXML_NOCDATA); // Ignore CDATA sections вЂ” make them as usual text,  returned text is always in UTF-8
	
	// ----------------------------------------------------------------------------------------------------------------------------------------------------------------//
	//   Prepearing replaces for non-typographic areas - Lebedev's typograf can't do it by itself ;)                                                                                                                //
	// ----------------------------------------------------------------------------------------------------------------------------------------------------------------//
	
	$patterns = array();
	$replaces = array();
	$text = preg_split('%(<code.*?>.*?</code>)%si', trim($xml->text), -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	
	for ($i = 0, $m = count($text); $i < $m; $i++) {
		
		if (mb_substr(mb_strtolower($text[$i]), 0, 5) == "<code") {
			
			$patterns[$i] = "{mceTypograf-replaced-{$i}}";
			$replaces[$i] = $text[$i];
			$text[$i] = $patterns[$i];
			
		}
		
	}
	
	$text = implode($text);
	
	// ----------------------------------------------------------------------------------------------------------------------------------------------------------------//
	//   Typographing                                                                                                                                                  //
	// ----------------------------------------------------------------------------------------------------------------------------------------------------------------//
	
	if ($xml->type == "spearance") {
		
		$params = array();
		$params[] = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
		$params[] = "<preferences>";
		$params[] = "	<tags delete='0'>1</tags>"; // РўРµРіРё
		$params[] = "	<paragraph insert='0'>"; // РђР±Р·Р°С†С‹
		$params[] = "		<start><![CDATA[<p>]]></start>";
		$params[] = "		<end><![CDATA[</p>]]></end>";
		$params[] = "	</paragraph>";
		$params[] = "	<newline insert='0'><![CDATA[<br />]]></newline>"; // РџРµСЂРµРІРѕРґС‹ СЃС‚СЂРѕРє
		$params[] = "	<cmsNewLine valid='0' />"; // РџРµСЂРµРІРѕРґС‹ СЃС‚СЂРѕРє <p>&nbsp;</p>
		$params[] = "	<dos-text delete='0' />"; // DOS С‚РµРєСЃС‚
		$params[] = "	<nowraped insert='1' nonbsp='0' length='0'>"; // РќРµСЂР°Р·СЂС‹РІРЅС‹Рµ РєРѕРЅСЃС‚СЂСѓРєС†РёРё
		$params[] = "		<start><![CDATA[<nobr>]]></start>";
		$params[] = "		<end><![CDATA[</nobr>]]></end>";
		$params[] = "	</nowraped>";
		$params[] = "	<hanging-punct insert='0' />"; // Р’РёСЃСЏС‡Р°СЏ РїСѓРЅРєС‚СѓР°С†РёСЏ
		$params[] = "	<hanging-line delete='0' />"; // РЈРґР°Р»СЏС‚СЊ РІРёСЃСЏС‡РёРµ СЃР»РѕРІР°
		$params[] = "	<minus-sign><![CDATA[&ndash;]]></minus-sign>"; // РЎРёРјРІРѕР» РјРёРЅСѓСЃ
		$params[] = "	<hyphen insert='0' length='0' />"; // РџРµСЂРµРЅРѕСЃС‹
		$params[] = "	<acronym insert='1'></acronym>"; // РђРєСЂРѕРЅРёРјС‹
		$params[] = "	<symbols type='0' />"; // Р’С‹РІРѕРґ СЃРёРјРІРѕР»РѕРІ 0 - Р±СѓРєРІР°РјРё 1 - С‡РёСЃР»Р°РјРё
		$params[] = "	<link target='' class='' />"; // РџР°СЂР°РјРµС‚СЂС‹ СЃСЃС‹Р»РѕРє
		$params[] = "</preferences>";
		$params = implode("", $params);
		
		function post($host, $script, $data) { 
			
			$fp = fsockopen($host,80,$errno, $errstr, 30 );  
			
			if ($fp) { 
				
				fputs($fp, "POST $script HTTP/1.1\n");  
				fputs($fp, "Host: $host\n");  
				fputs($fp, "Content-type: application/x-www-form-urlencoded\n");  
				fputs($fp, "Content-length: " . strlen($data) . "\n");
				fputs($fp, "User-Agent: PHP Script\n");  
				fputs($fp, "Connection: close\n\n");  
				fputs($fp, $data);  
				while(fgets($fp,2048) != "\r\n" && !feof($fp));
				unset($buf);
				while(!feof($fp)) $buf .= fread($fp,2048);
				fclose($fp); 
				
			} else {
				
				return "Server not responding"; 
				
			}
			
			return $buf; 
			
		}
		
		$result = post("typograf.ru", "/webservice/", "chr=utf-8&text=" . urlencode($text) . '&xml=' . urlencode($params));
		
	} elseif ($xml->type == "jare") {
		
		set_include_path(get_include_path() . PATH_SEPARATOR . MCETYPOGRAF_ENGINES);
		require("Jare/Typograph.php");
		
		$jareTypo = new Jare_Typograph($text);
		$jareTypo->getTof("etc")->disableBaseParam("paragraphs")->disableParsing(true);
		$result = $jareTypo->parse($jareTypo->getBaseTofsNames());
		
	} else {
		
		// 1 вЂ” mixedEntities	вЂ” Р±СѓРєРІРµРЅРЅС‹РјРё Рё С‡РёСЃР»РѕРІС‹РјРё РєРѕРґР°РјРё (РґР»СЏ СѓРЅРёРІРµСЂСЃР°Р»СЊРЅРѕРіРѕ РєРѕРґР°. РЎРѕРІРјРµСЃС‚РёРјРѕ СЃРѕ РІСЃРµРјРё РѕСЃРЅРѕРІС‹РјРё РЅРѕРІС‹РјРё Рё СЃС‚Р°СЂС‹РјРё Р±СЂР°СѓР·РµСЂР°РјРё)
		// 2 вЂ” xmlEntities		вЂ” С‚РѕР»СЊРєРѕ Р±СѓРєРІРµРЅРЅС‹РјРё РєРѕРґР°РјРё (С…РѕСЂРѕС€Рѕ РґР»СЏ XML, РїР»РѕС…Рѕ РґР»СЏ СЃС‚Р°СЂС‹С… Р±СЂР°СѓР·РµСЂРѕРІ)
		// 3В вЂ” htmlEntities		вЂ” С‚РѕР»СЊРєРѕ С‡РёСЃР»РѕРІС‹РјРё РєРѕРґР°РјРё (РєРѕРјСѓ-С‚Рѕ РЅСѓР¶РЅРѕ. РџР»РѕС…Рѕ РґР»СЏ СЃС‚Р°СЂС‹С… Р±СЂР°СѓР·РµСЂРѕРІ)
		// 4 вЂ” noEntities			вЂ” РіРѕС‚РѕРІС‹РјРё СЃРёРјРІРѕР»Р°РјРё (СЃРёРјРІРѕР»С‹ РІС‹РґР°СЋС‚СЃСЏ РІ С‚РѕРј РІРёРґРµ, РІ РєР°РєРѕРј РёС… РІРёРґРёС‚ РІ СЂРµР·СѓР»СЊС‚Р°С‚Рµ С‡РёС‚Р°С‚РµР»СЊ)
		
		require(MCETYPOGRAF_ENGINES . "/remotetypograf.php");
		
		$remoteTypograf = new RemoteTypograf ("UTF-8");
		$remoteTypograf->htmlEntities();
		$remoteTypograf->br(false);
		$remoteTypograf->p(false);
		$remoteTypograf->nobr(3);
		
		$result = $remoteTypograf->processText($text);
		
	}
	
	// ----------------------------------------------------------------------------------------------------------------------------------------------------------------//
	//   Reverting non-typographic areas                                                                                                                               //
	// ----------------------------------------------------------------------------------------------------------------------------------------------------------------//
	
	print str_replace($patterns, $replaces, $result);
	
?>