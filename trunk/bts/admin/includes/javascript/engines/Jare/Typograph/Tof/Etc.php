<?php
/**
 * @see Jare_Typograph_Tof
 */
require_once 'Jare/Typograph/Tof.php';

/**
 * Jare_Typograph_Tof_Etc
 * 
 * @copyright  	Copyright (c) 2009 E.Muravjev Studio (http://emuravjev.ru)
 * @license    	http://emuravjev.ru/works/tg/eula/
 * @version 	2.0.0
 * @author 		Arthur Rusakov <arthur@emuravjev.ru>
 * @category    Jare
 * @package 	Jare_Typograph
 * @subpackage 	Tof
 */
class Jare_Typograph_Tof_Etc extends Jare_Typograph_Tof
{
	/**
	 * Р—Р°С‰РёС‰РµРЅРЅС‹Рµ С‚РµРіРё
	 * 
	 * @todo РїСЂРёРІСЏР·Р°С‚СЊ Рє РјРµС‚РѕРґР°Рј РёР· Jare_Typograph_Tool
	 */
	const BASE64_PARAGRAPH_TAG = 'cA=='; // p
	const BASE64_BREAKLINE_TAG = 'YnIgLw=='; // br / (СЃ РїСЂРѕР±РµР»РѕРј Рё СЃР»СЌС€РµРј)
	
	/**
	 * Р‘Р°Р·РѕРІС‹Рµ РїР°СЂР°РјРµС‚СЂС‹ С‚РѕС„Р°
	 *
	 * @var array
	 */
	protected $_baseParam = array(	
		'tm_replace' => array(
			'_disable'		=> false,
			'pattern' 		=> '/([\040\t])?\(tm\)/i', 
			'replacement' 	=> '&trade;'),
		'r_sign_replace' => array(
			'_disable'		=> false,
			'pattern' 		=> '/\(r\)/ei', 
			'replacement' 	=> '$this->_buildTag($this->_buildTag("&reg;", "small"), "sup")'),		
		'copy_replace' => array(
			'_disable'		=> false,
			'pattern' 		=> '/\((c|СЃ)\)\s+/iu', 
			'replacement' 	=> '&copy;&nbsp;'),
		'acute_accent' => array(
			'_disable'		=> false,
			'pattern' 		=> '/(Сѓ|Рµ|С‹|Р°|Рѕ|СЌ|СЏ|Рё|СЋ|С‘)\`(\w)/i', 
			'replacement' 	=> '\1&#769;\2'),
		'auto_links' => array(
			'_disable'		=> false,
			'pattern' 		=> '/(\s|^)(http|ftp|mailto|https)(:\/\/)([\S]{4,})(\s|\.|\,|\!|\?|$)/ieu', 
			'replacement' 	=> '"\1" . $this->_buildTag("\4", "a", array("href" => "\2\3\4")) . "\5"'),
		'email' => array(
			'_disable'		=> false,
			'pattern' 		=> '/(\s|^)([a-z0-9\-\_\.]{3,})\@([a-z0-9\-\.]{2,})\.([a-z]{2,6})(\s|\.|\,|\!|\?|$|\<)/e',
			'replacement' 	=> '"\1" . $this->_buildTag("\2@\3.\4", "a", array("href" => "mailto:\2@\3.\4")) . "\5"'),	
		'hyphen_nowrap' => array(
			'_disable'		=> false,
			'pattern' 		=> '/(\&nbsp\;|\s|\>|^)([a-zР°-СЏ]+)\-([a-zР°-СЏ]+)(\s|\.|\,|\!|\?|\&nbsp\;|\&hellip\;|$)/uie',
			'replacement' 	=> '"\1" . $this->_buildTag("\2-\3", "span", array("style" => "word-spacing:nowrap;")) . "\4"'),	
		'simple_arrow' => array(
			'_disable'		=> false,
			'function_link'	=> '_buildArrows'),
		'ip_address' => array(
			'_disable'		=> false,
			'pattern' 		=> '/(\s|\&nbsp\;|^)(\d{0,3}\.\d{0,3}\.\d{0,3}\.\d{0,3})/ie', 
			'replacement' 	=> '"\1" . $this->_nowrapIpAddress("\2")'),	
		'optical_alignment' => array(
			'_disable'		=> false,
			'function_link' => '_buildOpticalAlignment'),
		'paragraphs' => array(
			'_disable'		=> false,
			'function_link'	=> '_buildParagraphs'),	
			
		);

	/**
	 * РћР±СЉРµРґРёРЅРµРЅРёРµ IP-Р°РґСЂРµСЃСЃРѕРІ РІ РЅРµСЂР°Р·СЂС‹РІРЅС‹Рµ РєРѕРЅСЃС‚СЂСѓРєС†РёРё (IPv4 only)
	 *
	 * @param unknown_type $triads
	 * @return unknown
	 */
	protected function _nowrapIpAddress($triads)
	{
		$triad = explode('.', $triads);
		$addTag = true;
		
		foreach ($triad as $value) {
			$value = (int) $value;
			if ($value > 255) {
				$addTag = false;
				break;
			}
		}
		
		if (true === $addTag) {
			$triads = $this->_buildTag($triads, 'span', array('style' => "word-spacing:nowrap;"));
		}
		
		return $triads;
	}
		
	/**
	 * РћРїС‚РёС‡РµСЃРєРѕРµ РІС‹СЂР°РІРЅРёРІР°РЅРёРµ РґР»СЏ РїСѓРЅРєС‚СѓР°С†РёРё
	 *
	 * @return	void
	 */
	protected function _buildOpticalAlignment()
	{
		$this->_text = preg_replace('/(\040|\&nbsp\;|\t)\(/ei', '$this->_buildTag("\1", "span", array("style" => "margin-right:0.3em;")) . $this->_buildTag("(", "span", array("style" => "margin-left:-0.3em;"))', $this->_text);
		$this->_text = preg_replace('/(\n|\r|^)\(/ei', '"\1" . $this->_buildTag("(", "span", array("style" => "margin-left:-0.3em;"))', $this->_text);
		$this->_text = preg_replace('/([Р°-СЏa-z0-9]+)\,(\040+)/iue', '"\1" . $this->_buildTag(",", "span", array("style" => "margin-right:-0.2em;")) . $this->_buildTag(" ", "span", array("style" => "margin-left:0.2em;"))', $this->_text);
	}

	/**
	 * Р Р°СЃСЃС‚Р°РЅРѕРІРєР° Р·Р°С‰РёС‰РµРЅРЅС‹С… С‚РµРіРѕРІ РїР°СЂР°РіСЂР°С„Р° (<p>...</p>) Рё РїРµСЂРµРЅРѕСЃР° СЃС‚СЂРѕРєРё
	 *
	 * @return  void
	 */
	protected function _buildParagraphs()
	{
		if (!preg_match('/\<\/?' . self::BASE64_PARAGRAPH_TAG . '\>/', $this->_text)) {
			$this->_text = '<' . self::BASE64_PARAGRAPH_TAG . '>' . $this->_text . '</' . self::BASE64_PARAGRAPH_TAG . '>';
			$this->_text = preg_replace('/([\040\t]+)?(\n|\r){2,}/e', '"</" . self::BASE64_PARAGRAPH_TAG . "><" .self::BASE64_PARAGRAPH_TAG . ">"', $this->_text);
		}

		if (!preg_match('/\<' . self::BASE64_BREAKLINE_TAG . '\>/', $this->_text)) {
			$this->_text = preg_replace('/(\n|\r)/e', '"<" . self::BASE64_BREAKLINE_TAG . ">"', $this->_text);
		}
	}
	
	/**
	 * РџСЂРµРѕР±СЂР°Р·РѕРІР°РЅРёРµ -> Рё <- РІ РєРѕРґС‹
	 *
	 * @return  void
	 */
	protected function _buildArrows()
	{
		$this->_text = preg_replace('/(\s|\>|\&nbsp\;)\-\>(\s|\&nbsp\;|\<\/)/', '\1&rarr;\2', $this->_text);
		$this->_text = preg_replace('/(\s|\>|\&nbsp\;)\<\-(\s|\&nbsp\;)/', '\1&larr;\2', $this->_text);
	}
}