<?php
/**
 * Jare_Typograph
 *
 * @copyright  	Copyright (c) 2009 E.Muravjev Studio (http://emuravjev.ru)
 * @license    	http://emuravjev.ru/works/tg/eula/
 * @version 	2.0.0
 * @author 		Arthur Rusakov <arthur@emuravjev.ru>
 * @category    Jare
 * @package 	Jare_Typograph
 */
class Jare_Typograph
{
	/**
	 * РџРµСЂРµС‡РµРЅСЊ РЅР°Р·РІР°РЅРёР№ С‚РѕС„РѕРІ, РёРґСѓС‰РёС… СЃ РґРёСЃС‚СЂРёР±СѓС‚РёРІРѕРј
	 *
	 * @var array
	 */
	protected $_baseTof = array('quote', 'dash', 'punctmark', 'number', 'space', 'etc');
	
	/**
	 * РњР°СЃСЃРёРІ РёР· С‚РѕС„РѕРІ, РіРґРµ РєР°Р¶РґРѕР№ РїР°СЂРµ-РєР»СЋС‡ СЃРѕРѕС‚РІРµС‚СЃС‚РІСѓРµС‚ РЅР°Р·РІР°РЅРёРµ С‚РѕС„Р°
	 * Рё РµРіРѕ РѕР±СЉРµРєС‚
	 *
	 * @var array
	 */
	protected $_tof = array();
	
	/**
	 * РљРѕРЅСЃС‚СЂСѓРєС‚РѕСЂ
	 *
	 * @param 	string $text СЃС‚СЂРѕРєР° РґР»СЏ С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёСЏ
	 * @return 	void
	 */
	public function __construct($text)
	{
		$this->_text = $text;
		$this->_text = trim($this->_text);
	}
	
	/**
	 * РњРµС‚РѕРґ РґР»СЏ Р±С‹СЃС‚СЂРѕРіРѕ С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёСЏ С‚РµРєСЃС‚Р°, РїСЂРё РєРѕС‚РѕСЂРѕРј РЅРµ РЅСѓР¶РЅРѕ
	 * РґРµР»Р°С‚СЊ РЅР°СЃС‚СЂРѕР№РєРё С‚РѕС„РѕРІ, РёС… Р±Р°Р·РѕРІС‹С… РїР°СЂР°РјРµС‚СЂРѕРІ Рё С‚.Рї.
	 *
	 * @param 	string $text СЃС‚СЂРѕРєР° РґР»СЏ С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёСЏ
	 * @return 	string
	 */
	public static function quickParse($text)
	{
		$typograph = new self($text);
		return $typograph->parse($typograph->getBaseTofsNames());
	}
	
	/**
	 * Р’РѕР·РІСЂР°С‰Р°РµС‚ РјР°СЃСЃРёРІ РёР· РЅР°Р·РІР°РЅРёР№ С‚РѕС„РѕРІ, РєРѕС‚РѕСЂС‹Рµ РёРґСѓС‚ РІРјРµСЃС‚Рµ СЃ РґРёСЃС‚СЂРёР±СѓС‚РёРІРѕРј
	 *
	 * @return 	array
	 */
	public function getBaseTofsNames()
	{
		return $this->_baseTof;
	}
	
	/**
	 * Р”РѕР±Р°РІР»РµРЅРёРµ С‚РѕС„Р° РІ РѕС‡РµСЂРµРґСЊ РЅР° РѕР±СЂР°Р±РѕС‚РєСѓ С‚РµРєСЃС‚Р°
	 *
	 * @param 	string $name РЅР°Р·РІР°РЅРёРµ С‚РѕС„Р°
	 * @param 	Jare_Typograph_Tof $object СЌРєР·РµРјР»СЏСЂ РєР»Р°СЃСЃР°, СѓРЅР°СЃР»РµРґРѕРІР°РЅРЅРѕРіРѕ РѕС‚ 'Jare_Typograph_Tof'
	 * @throws  Jare_Typograph_Exception
	 * @return 	void
	 */
	public function setTof($name, $object)
	{
		$name = strtolower($name);
		
		if (!$object instanceof Jare_Typograph_Tof) {
			require_once 'Pride/Typograph/Exception.php';
    		throw new Pride_Typograph_Exception("Tof '$name' class must be extend Jare_Typograph_Tof");
		}
		
		$this->_tof[$name] = $object;
		$this->_tof[$name]->setStringToParse(&$this->_text);
	}
	
	/**
	 * РџРѕР»СѓС‡РµРЅРёРµ РѕР±СЉРµРєС‚Р° С‚РѕС„Р°
	 * 
	 * Р•СЃР»Рё С‚РѕС„ РЅРµ Р±С‹Р» СЂР°РЅРЅРµРµ РґРѕР±Р°РІР»РµРЅ Рё РїСЂРё СЌС‚РѕРј РѕРЅ СЏРІР»СЏРµС‚СЃСЏ Р±Р°Р·РѕРІС‹Рј, СЌРєР·РµРјР»СЏСЂ РµРіРѕ РєР»Р°СЃСЃР°
	 * Р±СѓРґРµС‚ СЃРѕР·РґР°РЅ Р°РІС‚РѕРјР°С‚РёС‡РµСЃРєРё
	 *
	 * @param 	string $name
	 * @throws 	Jare_Typograph_Exception
	 * @return 	Jare_Typograph_Tof
	 */
	public function getTof($name)
	{
		$name = strtolower($name);
		
		if (!isset($this->_tof[$name])) {
			if (!in_array($name, $this->_baseTof)) {
				require_once 'Jare/Typograph/Exception.php';
				throw new Jare_Typograph_Exception('Incorrect name of tof');
			}
			
			$fileName = 'Jare/Typograph/Tof/' . ucfirst($name) . '.php';
			$className = 'Jare_Typograph_Tof_' . ucfirst($name);
			
			require_once $fileName;
			
			if (!class_exists($className, false)) {
    			require_once 'Jare/Typograph/Exception.php';
    			throw new Jare_Typograph_Exception('Class not exists');
    		}
    		
    		$this->setTof($name, new $className);
		}
		
		return $this->_tof[$name];
	}
	
	/**
	 * РўРёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёРµ С‚РµРєСЃС‚Р°
	 *
	 * @param 	mixed $tofs СЃС‚СЂРѕРєР° РёР»Рё РјР°СЃСЃРёРІ РёР· РЅР°Р·РІР°РЅРёР№ С‚РѕС„РѕРІ, РєРѕС‚РѕСЂС‹Рµ Р±СѓРґСѓС‚ РїСЂРёРјРµРЅРµРЅС‹ РїСЂРё С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёРµ С‚РµРєСЃС‚Р°
	 * @throws 	Jare_Typograph_Exception
	 * @return 	string
	 */
	public function parse($tofs)
	{
		if (is_string($tofs)) {
			$tofs = array($tofs);
		}
		
		if (!is_array($tofs)) {
			require_once 'Jare/Typograph/Exception.php';
    			throw new Jare_Typograph_Exception('Incorrect type of tof-variable - try set array or string');
		}

		if (!count($tofs)) {
			require_once 'Jare/Typograph/Exception.php';
    			throw new Jare_Typograph_Exception('You must set 1 or more tofs; your array is empty!');
		}
		
		require_once 'Jare/Typograph/Tool.php';
		Jare_Typograph_Tool::addCustomBlocks('<pre>', '</pre>');
		Jare_Typograph_Tool::addCustomBlocks('<script>', '</script>');
		Jare_Typograph_Tool::addCustomBlocks('<style>', '</style>');
		
		$this->_text = Jare_Typograph_Tool::safeCustomBlocks($this->_text, true);
		$this->_text = Jare_Typograph_Tool::safeTagChars($this->_text, true);
		$this->_text = Jare_Typograph_Tool::clearSpecialChars($this->_text, Jare_Typograph_Tool::CLEAR_MODE_UTF8_NATIVE | Jare_Typograph_Tool::CLEAR_MODE_HTML_MATTER);
		
		foreach ($tofs as $tofName) {
			$this->getTof($tofName)->parse();
		}
		
		$this->_text = Jare_Typograph_Tool::safeTagChars($this->_text, false);
		$this->_text = Jare_Typograph_Tool::safeCustomBlocks($this->_text, false);
		
		return $this->_text;
	}
}