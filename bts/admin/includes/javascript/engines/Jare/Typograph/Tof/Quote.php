<?php
/**
 * @see Jare_Typograph_Tof
 */
require_once 'Jare/Typograph/Tof.php';

/**
 * Jare_Typograph_Tof_Quote
 * 
 * @copyright  	Copyright (c) 2009 E.Muravjev Studio (http://emuravjev.ru)
 * @license    	http://emuravjev.ru/works/tg/eula/
 * @version 	2.0.0
 * @author 		Arthur Rusakov <arthur@emuravjev.ru>
 * @category    Jare
 * @package 	Jare_Typograph
 * @subpackage 	Tof
 */
class Jare_Typograph_Tof_Quote extends Jare_Typograph_Tof
{
	/**
	 * РўРёРїС‹ РєР°РІС‹С‡РµРє
	 */
	const QUOTE_FIRS_OPEN = '&laquo;';
    const QUOTE_FIRS_CLOSE = '&raquo;';
    const QUOTE_CRAWSE_OPEN = '&bdquo;';
    const QUOTE_CRAWSE_CLOSE = '&ldquo;';
    
	/**
	 * Р‘Р°Р·РѕРІС‹Рµ РїР°СЂР°РјРµС‚СЂС‹ С‚РѕС„Р°
	 *
	 * @var array
	 */
    protected $_baseParam = array(
		'quotes_outside_a' => array(
			'_disable'		=> false,
			'pattern' 		=> '/(\<%%\_\_.+?\>)\"(.+?)\"(\<\/%%\_\_.+?\>)/s',
			'replacement' 	=> '"\1\2\3"'),
		'open_quote' => array(
			'_disable'		=> false,
			'function_link' => '_buildOpenQuote'),
		'close_quote' => array(
			'_disable'		=> false,
			'function_link' => '_buildCloseQuote'),
		'optical_alignment' => array(
			'_disable'		=> false,
			'function_link' => '_buildOpticalAlignment'),
		);

	/**
	 * Р Р°СЃСЃС‚Р°РЅРѕРІРєР° Р·Р°РєСЂС‹РІР°СЋС‰РёС… РєР°РІС‹С‡РµРє
	 * 
	 * @return 	void
	 */
	protected function _buildOpenQuote()
	{
		$regExpMask = '/(^|\(|\s|\>)(\"|\\\")(\S+)/iu';

		while(preg_match($regExpMask, $this->_text)) {
			$this->_text = preg_replace($regExpMask . 'e', '"\1" . self::QUOTE_FIRS_OPEN . "\3"', $this->_text);
		}
	}
	
	/**
	 * Р Р°СЃСЃС‚Р°РЅРѕРІРєР° Р·Р°РєСЂС‹РІР°СЋС‰РёС… РєР°РІС‹С‡РµРє
	 * 
	 * @return 	void
	 */
	protected function _buildCloseQuote()
	{
		$regExpMask = '/([a-zР°-СЏ0-9]|\.|\&hellip\;|\!|\?|\>)(\"|\\\")+(\.|\&hellip\;|\;|\:|\?|\!|\,|\s|\)|\<\/|$)/ui';

		while(preg_match($regExpMask, $this->_text)) {
			$this->_text = preg_replace($regExpMask . 'e', '"\1" . self::QUOTE_FIRS_CLOSE . "\3"', $this->_text);
		}
	}
	
	/**
	 * РћРїС‚РёС‡РµСЃРєРѕРµ РІС‹СЂР°РІРЅРёРІР°РЅРёРµ РѕС‚РєСЂС‹РІР°СЋС‰РµР№ РєР°РІС‹С‡РєРё
	 *
	 * @return 	void
	 */
	protected function _buildOpticalAlignment()
	{
		$this->_text = preg_replace('/([a-zР°-СЏ\-]{3,})(\040|\&nbsp\;|\t)(\&laquo\;)/uie', '"\1" . $this->_buildTag("\2", "span",array("style" => "margin-right:0.44em;")) . $this->_buildTag("\3", "span", array("style" => "margin-left:-0.44em;"))', $this->_text);
		$this->_text = preg_replace('/(\n|\r|^)(\&laquo\;)/ei', '"\1" . $this->_buildTag("\2", "span", array("style" => "margin-left:-0.44em;"))', $this->_text);
	}
}