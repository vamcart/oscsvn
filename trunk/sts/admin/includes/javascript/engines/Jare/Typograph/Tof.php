<?php
/**
 * РљР»Р°СЃСЃ-РѕР±РµСЂС‚РєР° РґР»СЏ СЂР°Р±РѕС‚С‹ СЃ РїР°СЂР°РјРµС‚СЂР°РјРё С‚РѕС„Р°
 * 
 * @see Jare_Typograph_Param
 */
require_once 'Jare/Typograph/Param.php';

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
abstract class Jare_Typograph_Tof
{
	/**
	 * РћС‚РєР»СЋС‡РµРЅРёРµ РѕР±СЂР°Р±РѕС‚РєРё С‚РµРєСЃС‚Р° С‚РѕС„РѕРј
	 *
	 * @var bool
	 */
	protected $_disableParsing = false;
	
	/**
	 * РўРµРєСЃС‚ РґР»СЏ С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёСЏ
	 *
	 * @var string
	 */
	protected $_text = '';
	
	/**
	 * Р‘Р°Р·РѕРІС‹Рµ РїР°СЂР°РјРµС‚СЂС‹ С‚РѕС„Р°
	 *
	 * @var array
	 */
	protected $_baseParam = array();
	
	/**
	 * РЈСЃС‚Р°РЅРѕРІРєР° Р±Р°Р·РѕРІРѕРіРѕ РїР°СЂР°РјРµС‚СЂР°
	 *
	 * @param 	string $name
	 * @param 	Jare_Typograph_Param $param
	 * @return 	Jare_Typograph_Tof
	 */
	public function setBaseParam($name, Jare_Typograph_Param $param)
	{
		$this->_baseParam[$name] = $param->getOptions();
		return $this;
	}
	
	/**
	 * РџРѕР»СѓС‡РµРЅРёРµ СЌРєР·РµРјРїР»СЏСЂР° РєР»Р°СЃСЃР° Р±Р°Р·РѕРІРѕРіРѕ РїР°СЂР°РјРµС‚СЂР°
	 *
	 * @param 	string $name
	 * @throws 	Jare_Typograph_Exception
	 * @return 	Jare_Typograph_Param
	 */
	public function getBaseParam($name)
	{
		if(!isset($this->_baseParam[$name])) {
			require_once 'Jare/Typograph/Exception.php';
			throw new Jare_Typograph_Exception("Incorrect base parameter name");
		}
		
		$param = new Jare_Typograph_Param($this->_baseParam[$name]);
		return $param;
	}
	
	/**
	 * РЈСЃС‚Р°РЅРѕРІРєР° С‚РµРєСЃС‚Р° РґР»СЏ С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёСЏ
	 *
	 * @param 	string $text
	 * @return 	void
	 */
	public function setStringToParse($text)
	{
		$this->_text = &$text;
	}
	
	/**
	 * РћС‚РєР»СЋС‡РµРЅРёРµ С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёСЏ С‚РµРєСЃС‚Р° РґР°РЅРЅС‹Рј С‚РѕС„РѕРј
	 *
	 * @param 	bool $status
	 * @return 	Jare_Typograph_Tof
	 */
	public function disableParsing($status)
	{
		$this->_disableParsing = (bool) $status;
		return $this;
	}
	
	/**
	 * Р’РѕР·РІСЂР°С‚ СЃС‚Р°С‚СѓСЃР° РґР»СЏ С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёСЏ РґР°РЅРЅС‹Рј С‚РѕС„РѕРј
	 *
	 * @return 	bool
	 */
	public function isDisabledParsing()
	{
		return $this->_disableParsing;
	}
	
	/**
	 * РћС‚РєР»СЋС‡РµРЅРёРµ Р±Р°Р·РѕРІС‹С… РїР°СЂР°РјРµС‚СЂРѕРІ С‚РѕС„Р°
	 *
	 * @param 	mixed $name РјР°СЃСЃРёРІ РёР»Рё СЃС‚СЂРѕРєР° РёР· РЅР°Р·РІР°РЅРёР№ РїР°СЂР°РјРµС‚СЂРѕРІ, РєРѕС‚РѕСЂС‹Рµ РЅРµРѕР±С…РѕРґРёРјРѕ РѕС‚РєР»СЋС‡РёС‚СЊ
	 * @return 	Jare_Typograph_Tof
	 */
	public function disableBaseParam($name)
	{
		if (!is_array($this->_baseParam) || !count($this->_baseParam)) {
			require_once 'Jare/Typograph/Exception.php';
			throw new Jare_Typograph_Exception("This tof dosn't have base parameters");
		}
		
		if (is_string($name)) {
			$name = array($name);
		}
		
		if (!is_array($name)) {
			require_once 'Jare/Typograph/Exception.php';
			throw new Jare_Typograph_Exception("Incorrect var type");
		}

		foreach ($name as $accessKey) {
			if (!isset($this->_baseParam[$accessKey])) {
				require_once 'Jare/Typograph/Exception.php';
				throw new Jare_Typograph_Exception("Incorrect name of base param - '$accessKey'");
			} else {
				$this->_baseParam[$accessKey][Jare_Typograph_Param::KEY_DISABLE_USER] = true;
			}
		}
		
		return $this;
	}
	
	/**
	 * РЎС‚Р°РЅРґР°СЂС‚РЅРѕРµ С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёРµ С‚РµРєСЃС‚Р° С‚РѕС„РѕРј
	 *
	 * @throws 	Jare_Typograph_Exception
	 * @return 	string
	 */
	public function parse()
	{
		$this->_preParse();
		
		if (true === $this->_disableParsing) {
			return $this->_text;
		}
		
		if (is_array($this->_baseParam) || count($this->_baseParam)) {
			foreach ($this->_baseParam as $accessKey => $param) {
				$ignoreParsing = null;
				
				// РўРёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёРµ РїР°СЂР°РјРµС‚СЂРѕРј РѕС‚РєР»СЋС‡РµРЅРѕ РёР»Рё РІРєР»СЋС‡РµРЅРѕ РїРѕР»СЊР·РѕРІР°С‚РµР»РµРј
				if (isset($param[Jare_Typograph_Param::KEY_DISABLE_USER])) {
					$ignoreParsing = (bool) $param[Jare_Typograph_Param::KEY_DISABLE_USER];
				}
				
				if (null === $ignoreParsing) {
					// РџР°СЂР°РјРµС‚СЂ РѕС‚РєР»СЋС‡РµРЅ РїРѕ СѓРјРѕР»С‡Р°РЅРёСЋ...
					if (isset($param[Jare_Typograph_Param::KEY_DISABLE_DEFAULT])) {
						$ignoreParsing = $param[Jare_Typograph_Param::KEY_DISABLE_DEFAULT];
					}
				}
				
				if ($ignoreParsing) {
					continue;
				}
				
				// РЎСЃС‹Р»РєР° РЅР° РјРµС‚РѕРґ РєР»Р°СЃСЃР° СЃ РїСЂР°РІРёР»Р°РјРё С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёСЏ
				if (!empty($param[Jare_Typograph_Param::KEY_FUNCTION_LINK])) {
					$methodName = $param[Jare_Typograph_Param::KEY_FUNCTION_LINK];
					
					if (method_exists($this, $methodName)) {
						$this->$methodName();
						continue;
					} else {
						require_once 'Jare/Typograph/Exception.php';
						throw new Jare_Typograph_Exception("Incorrect method name - '$methodName'");
					}
				}
				
				// РљР»Р°СЃСЃРёС‡РµСЃРєРѕРµ С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёРµ СЂРµРіСѓР»СЏСЂРЅС‹РјРё РІС‹СЂР°Р¶РµРЅРёСЏРјРё
				$this->_text = preg_replace($param[Jare_Typograph_Param::KEY_PARSE_PATTERN], $param[Jare_Typograph_Param::KEY_PARSE_REPLACE], $this->_text);
			}
		}
		
		$this->_postParse();
		
		return $this->_text;
	}
	
	/**
	 * РњРµС‚РѕРґ, РєРѕС‚РѕСЂС‹Р№ РІС‹Р·С‹РІР°РµС‚СЃСЏ РїРµСЂРµРґ СЃС‚Р°РЅРґР°СЂС‚РЅС‹Рј С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёРµРј С‚РµРєСЃС‚Р° С‚РѕС„РѕРј
	 *
	 * @return 	void
	 */
	protected function _preParse()
	{
	}
	
	/**
	 * РњРµС‚РѕРґ, РєРѕС‚РѕСЂС‹Р№ РІС‹Р·С‹РІР°РµС‚СЃСЏ РїРѕСЃР»Рµ СЃС‚Р°РЅРґР°СЂС‚РЅС‹Рј С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёРµРј С‚РµРєСЃС‚Р° С‚РѕС„РѕРј
	 *
	 * @return 	void
	 */
	protected function _postParse()
	{
	}
	
	/**
	 * РЎРѕР·РґР°РЅРёРµ Р·Р°С‰РёС‰РµРЅРЅРѕРіРѕ С‚РµРіР° СЃ СЃРѕРґРµСЂР¶РёРјС‹Рј
	 *
	 * @see 	Jare_Typograph_Tool::buildSafeTag
	 * @param 	string $content
	 * @param 	string $tag
	 * @param 	array $attribute
	 * @return 	string
	 */
	protected function _buildTag($content, $tag = 'span', $attribute = array())
	{
		require_once 'Jare/Typograph/Tool.php';
		$html = Jare_Typograph_Tool::buildSafedTag($content, $tag, $attribute);
		
		return $html;
	}
}