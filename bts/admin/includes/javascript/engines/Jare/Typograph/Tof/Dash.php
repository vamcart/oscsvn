<?php
/**
 * @see Jare_Typograph_Tof
 */
require_once 'Jare/Typograph/Tof.php';

/**
 * Jare_Typograph_Tof_Dash
 * 
 * @copyright  	Copyright (c) 2009 E.Muravjev Studio (http://emuravjev.ru)
 * @license    	http://emuravjev.ru/works/tg/eula/
 * @version 	2.0.0
 * @author 		Arthur Rusakov <arthur@emuravjev.ru>
 * @category    Jare
 * @package 	Jare_Typograph
 * @subpackage 	Tof
 */
class Jare_Typograph_Tof_Dash extends Jare_Typograph_Tof
{
	/**
	 * Р‘Р°Р·РѕРІС‹Рµ РїР°СЂР°РјРµС‚СЂС‹ С‚РѕС„Р°
	 *
	 * @var array
	 */
	protected $_baseParam = array(
		'mdash' => array(
			'_disable'		=> false,
			'pattern' 		=> '/([a-zР°-СЏ0-9]+|\,|\:|\)|\&raquo\;|\|\")(\040|\t)(\-|\&mdash\;)(\s|$|\<)/u', 
			'replacement' 	=> '\1&nbsp;&mdash;\4'),
		'mdash_2' => array(
			'_disable'		=> false,
			'pattern' 		=> '/(\n|\r|^|\>)(\-|\&mdash\;)(\t|\040)/',
			'replacement' 	=> '\1&mdash;&nbsp;'),
		'mdash_3' => array(
			'_disable'		=> false,
			'pattern' 		=> '/(\.|\!|\?|\&hellip\;)(\040|\t|\&nbsp\;)(\-|\&mdash\;)(\040|\t|\&nbsp\;)/',
			'replacement' 	=> '\1 &mdash;&nbsp;'),
		'years' => array(
			'_disable'		=> false,
			'pattern' 		=> '/(СЃ|РїРѕ|РїРµСЂРёРѕРґ|СЃРµСЂРµРґРёРЅС‹|РЅР°С‡Р°Р»Р°|РЅР°С‡Р°Р»Рѕ|РєРѕРЅС†Р°|РєРѕРЅРµС†|РїРѕР»РѕРІРёРЅС‹|РІ|РјРµР¶РґСѓ)(\s+|\&nbsp\;)([\d]{4})(-)([\d]{4})(Рі|РіРі)?/eui',
			'replacement' 	=> '"\1\2" . $this->_buildYears("\3","\5","\4") . "\6"'),
		'iz_za_pod' => array(
			'_disable'		=> false,
			'pattern' 		=> '/(\s|\&nbsp\;|\>)(РёР·)(\040|\t|\&nbsp\;)\-?(Р·Р°|РїРѕРґ)([\.\,\!\?\:\;]|\040|\&nbsp\;)/uie',
			'replacement' 	=> '("\1" == "&nbsp;" ? " " : "\1") . "\2-\4" . ("\5" == "&nbsp;"? " " : "\5")'),
		'to_libo_nibud' => array(
			'_disable'		=> false,
			'function_link'	=> '_buildToLiboNibud')
		);

	/**
	 * Р Р°СЃСЃС‚Р°РЅРѕРІРєР° РєРѕСЂРѕС‚РєРѕРіРѕ С‚РёСЂРµ РјРµР¶РґСѓ РіРѕРґР°РјРё
	 *
	 * @param 	string $start
	 * @param 	string $end
	 * @param 	string $sep
	 * @return 	string
	 */
	protected function _buildYears($start, $end, $sep)
	{
		$start = (int) $start;
		$end = (int) $end;
		
		return ($start >= $end) ? "$start$sep$end" : "$start&ndash;$end";
	}
	
	/**
	 * Р Р°СЃСЃС‚Р°РЅРѕРІРєР° РґРµС„РёСЃР° РїРµСЂРµРґ -С‚Рѕ, -Р»РёР±Рѕ, -РЅРёР±СѓРґСЊ
	 *
	 * @return 	void
	 */
	protected function _buildToLiboNibud()
	{
		$regExpMask = '/(\s|^|\&nbsp\;|\>)(РєС‚Рѕ|РєРµРј|РєРѕРіРґР°|Р·Р°С‡РµРј|РїРѕС‡РµРјСѓ|РєР°Рє|С‡С‚Рѕ|С‡РµРј|РіРґРµ|С‡РµРіРѕ|РєРѕРіРѕ)\-?(\040|\t|\&nbsp\;)\-?(С‚Рѕ|Р»РёР±Рѕ|РЅРёР±СѓРґСЊ)([\.\,\!\?\;]|\040|\&nbsp\;|$)/ui';
		
		while( preg_match($regExpMask, $this->_text)) {
			$this->_text = preg_replace($regExpMask . 'e', '("\1" == "&nbsp;" ? " " : "\1") . "\2-\4" . ("\5" == "&nbsp;"? " " : "\5")', $this->_text);
		}
	}
}