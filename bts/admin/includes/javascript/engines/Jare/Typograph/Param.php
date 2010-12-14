<?php
/**
 * Jare_Typograph_Param
 *
 * @copyright  	Copyright (c) 2009 E.Muravjev Studio (http://emuravjev.ru)
 * @license    	http://emuravjev.ru/works/tg/eula/
 * @version 	2.0.0
 * @author 		Arthur Rusakov <arthur@emuravjev.ru>
 * @category    Jare
 * @package 	Jare_Typograph
 */
class Jare_Typograph_Param
{
	/**
	 * РљР»СЋС‡Рё РЅР°СЃС‚СЂРѕРµРє
	 */
	const KEY_DISABLE_DEFAULT = '_disable';
	const KEY_DISABLE_USER = 'user_disable';
	const KEY_PARSE_PATTERN = 'pattern';
	const KEY_PARSE_REPLACE = 'replacement';
	const KEY_FUNCTION_LINK = 'function_link';
	const KEY_POSITION = 'position';
	
	/**
	 * РќР°СЃС‚СЂРѕР№РєРё 
	 *
	 * @var array
	 */
	protected $_option = array();
	
	/**
	 * РќР°СЃС‚СЂРѕР№РєРё, РєРѕС‚РѕСЂС‹Рµ Р±С‹Р»Рё Р·Р°РґР°РЅС‹ РїРѕ СѓРјРѕР»С‡Р°РЅРёСЋ РїСЂРё СЃРѕР·РґР°РЅРёРµ СЌРєР·РµРјРїР»СЏСЂР° РєР»Р°СЃСЃР°; РЅРµРІРѕР·РјРѕР¶РЅРѕ РёР·РјРµРЅРёС‚СЊ
	 *
	 * @var array
	 */
	protected $_defaultOption = array();
	
	/**
	 * РљРѕРЅСЃС‚СЂСѓРєС‚РѕСЂ
	 *
	 * @param 	array $option РјР°СЃСЃРёРІ РёР· РЅР°СЃС‚СЂРѕРµРє, РєРѕС‚РѕСЂС‹Рµ Р±СѓРґСѓС‚ Р·Р°РґР°РЅС‹ РїРѕ СѓРјРѕР»С‡Р°РЅРёСЋ
	 * @return 	void
	 */
	public function __construct($option = array())
	{
		$this->_defaultOption = $option;
		$this->_option = $option;
	}
	
	/**
	 * РћС‚РєР»СЋС‡РµРЅРёРµ РїР°СЂР°РјРµС‚СЂР°
	 *
	 * @param 	bool $status
	 * @return 	Jare_Typograph_Param
	 */
	public function disable($status)
	{
		$this->_option[self::KEY_DISABLE_USER] = (bool) $status;
		return $this;
	}
	
	/**
	 * РЎР±СЂРѕСЃ Р·Р°РґР°РЅРЅС‹С… РЅР°СЃС‚СЂРѕРµРє Рє С‚РµРј, РєРѕС‚РѕСЂС‹Рµ Р±С‹Р»Рё Р·Р°РґР°РЅС‹ РїСЂРё СЃРѕР·РґР°РЅРёРµ СЌРєР·РµРјРїР»СЏСЂР° РєР»Р°СЃСЃР°
	 *
	 * @throws 	Jare_Typograph_Param_Exception
	 * @return 	Jare_Typograph_Param
	 */
	public function reset()
	{
		if (!count($this->_defaultOption)) {
			require_once 'Jare/Typograph/Param/Exception.php';
			throw new Jare_Typograph_Param_Exception('This parameter does not have default options');
		}
		
		$this->_option = $this->_defaultOption;
		
		return $this;
	}
	
	/**
	 * Р—Р°РґР°РЅРёРµ РЅР°СЃС‚СЂРѕР№РєРё
	 *
	 * @param 	string $name
	 * @param 	string $value
	 * @throws 	Jare_Typograph_Param_Exception
	 * @return 	Jare_Typograph_Param
	 */
	public function setOption($name, $value)
	{
		$name = strtolower($name);
		$value = trim($value);
		
		if ('_' === substr($name, 0, 1)) {
			require_once 'Jare/Typograph/Param/Exception.php';
			throw new Jare_Typograph_Param_Exception('Prefix "_" reserved for system option');
		}
		
		if (empty($value)) {
			require_once 'Jare/Typograph/Param/Exception.php';
			throw new Jare_Typograph_Param_Exception('Empty value. It\'s bad.');
		}
		
		switch ($name) {
			case self::KEY_FUNCTION_LINK:
				$this->_option[self::KEY_PARSE_PATTERN] = '';
				$this->_option[self::KEY_PARSE_REPLACE] = '';
			case self::KEY_PARSE_PATTERN:
			case self::KEY_PARSE_REPLACE:
				$this->_option[self::KEY_FUNCTION_LINK] = '';
		}
		
		$this->_option[$name] = $value;
		
		return $this;
	}
	
	/**
	 * Р’РѕР·РІСЂР°С‚ СЃРїРёСЃРєР° Р·Р°РґР°РЅРЅС‹С… РЅР°СЃС‚СЂРѕРµРє РїР°СЂР°РјРµС‚СЂР°
	 *
	 * @throws 	Jare_Typograph_Param_Exception
	 * @return 	array
	 */
	public function getOptions()
	{
		if (!count($this->_option)) {
			require_once 'Jare/Typograph/Param/Exception.php';
			throw new Jare_Typograph_Param_Exception('This parameter does not have options!');
		}
		
		if (!empty($this->_option[self::KEY_FUNCTION_LINK])) {
			return $this->_option;
		}
		
		if (empty($this->_option[self::KEY_PARSE_PATTERN]) && !empty($this->_option[self::KEY_PARSE_REPLACE])) {
			require_once 'Jare/Typograph/Param/Exception.php';
			throw new Jare_Typograph_Param_Exception('You must set up pattern and replacement or function link');
		}
		
		return $this->_option;
	}
	
	/**
	 * РџРѕР»СѓС‡РµРЅРёРµ Р·РЅР°С‡РµРЅРёСЏ РЅР°СЃС‚СЂРѕР№РєРё
	 *
	 * @param 	string $name
	 * @throws 	Jare_Typograph_Param_Exception
	 * @return 	string
	 */
	public function getOption($name)
	{
		if (!in_array($name, $this->option)) {
			require_once 'Jare/Typograph/Param/Exception.php';
			throw new Jare_Typograph_Param_Exception("This option doesn't have value");
		}
		
		return $this->_option[$name];
	}
}