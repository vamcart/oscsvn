<?php
/**
 * Jare_Typograph_Tool
 *
 * @copyright  	Copyright (c) 2009 E.Muravjev Studio (http://emuravjev.ru)
 * @license    	http://emuravjev.ru/works/tg/eula/
 * @version 	2.0.0
 * @author 		Arthur Rusakov <arthur@emuravjev.ru>
 * @category    Jare
 * @package 	Jare_Typograph
 */
class Jare_Typograph_Tool
{
	/**
	 * Р РµР¶РёРјС‹ РѕС‡РёСЃС‚РєРё С‚РµРєСЃС‚Р°
	 */
	const CLEAR_MODE_UTF8_NATIVE = 1;
	const CLEAR_MODE_HTML_MATTER = 2;

	/**
	 * РўР°Р±Р»РёС†Р° СЃРёРјРІРѕР»РѕРІ
	 *
	 * @var array
	 */
	protected static $_charsTable = array(
		'"' 	=> array('html' => array('&laquo;', '&raquo;', '&ldquo;', '&lsquo;', '&bdquo;', '&ldquo;', '&quot;', '&#171;', '&#187;'),
					 	 'utf8' => array(0x201E, 0x201C, 0x201F, 0x201D, 0x00AB, 0x00BB)),
		' ' 	=> array('html' => array('&nbsp;', '&thinsp;', '&#160;'),
					 	 'utf8' => array(0x00A0, 0x2002, 0x2003, 0x2008, 0x2009)),
		'-' 	=> array('html' => array('&mdash;', '&ndash;', '&minus;', '&#151;', '&#8212;', '&#8211;'),
					 	 'utf8' => array(0x002D, 0x2014, 0x2010, 0x2012, 0x2013)),
		'==' 	=> array('html' => array('&equiv;'),
						 'utf8' => array(0x2261)),
		'...' 	=> array('html' => array('&hellip;', '&#0133;'),
						 'utf8' => array(0x2026)),
		'!=' 	=> array('html' => array('&ne;', '&#8800;'),
						 'utf8' => array(0x2260)),
		'<=' 	=> array('html' => array('&le;', '&#8804;'),
						 'utf8' => array(0x2264)),
		'>=' 	=> array('html' => array('&ge;', '&#8805;'),
						 'utf8' => array(0x2265)),
		'1/2' 	=> array('html' => array('&frac12;', '&#189;'),
						 'utf8' => array(0x00BD)),
		'1/4' 	=> array('html' => array('&frac14;', '&#188;'),
					     'utf8' => array(0x00BC)),
		'3/4' 	=> array('html' => array('&frac34;', '&#190;'),
						 'utf8' => array(0x00BE)),
		'+-' 	=> array('html' => array('&plusmn;', '&#177;'),
						 'utf8' => array(0x00B1)),
		'&' 	=> array('html' => array('&amp;', '&#38;')),
		'(tm)' 	=> array('html' => array('&trade;', '&#153;'),
						 'utf8' => array(0x2122)),
		'(r)' 	=> array('html' => array('&reg;', '&#174;'), 
						 'utf8' => array(0x00AE)),
		'(c)' 	=> array('html' => array('&copy;', '&#169;'), 
					     'utf8' => array(0x00A9)),
		'`' 	=> array('html' => array('&#769;')),
		'\'' 	=> array('html' => array('&rsquo;', 'вЂ™')),
		'x' 	=> array('html' => array('&times;', '&#215;'), 
					     'utf8' => array('Г—') /* РєР°РєРѕР№ Р¶Рµ Сѓ РЅРµРіРѕ РјРѕР¶РµС‚ Р±С‹С‚СЊ РєРѕРґ? */),
	);

	/**
	 * РЎРїРёСЃРѕРє РёР· СЌР»РµРјРµРЅС‚РѕРІ, РІ РєРѕС‚РѕСЂС‹С… С‚РµРєСЃС‚ РЅРµ Р±СѓРґРµС‚ С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°С‚СЊСЃСЏ
	 *
	 * @var array
	 */
	protected static $_customBlocks = array();
	
	/**
	 * Р”РѕР±Р°РІР»РµРЅРёРµ Рє С‚РµРіР°Рј Р°С‚СЂРёР±СѓС‚Р° 'id', Р±Р»Р°РіРѕРґР°СЂСЏ РєРѕС‚РѕСЂРѕРјСѓ
	 * РїСЂРё РїРѕРІС‚РѕСЂРЅРѕРј С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°РЅРёРµ С‚РµРєСЃС‚Р° Р±СѓРґСѓС‚ СѓРґР°Р»РµРЅС‹ С‚РµРіРё,
	 * СЂР°СЃСЃС‚Р°РІР»РµРЅРЅС‹Рµ РґР°РЅРЅС‹Рј С‚РёРїРѕРіСЂР°С„РѕРј
	 *
	 * @var array
	 */
	protected static $_typographSpecificTagId = false;
	

	/**
	 * РЈРґР°Р»РµРЅРёРµ РєРѕРґРѕРІ HTML РёР· С‚РµРєСЃС‚Р°
	 *
	 * <code>
	 *  // Remove UTF-8 chars:
	 * 	$str = Jare_Typograph_Tool::clearSpecialChars('your text', Jare_Typograph_Tool::CLEAR_MODE_UTF8_NATIVE);
	 *  // ... or HTML codes only:
	 * 	$str = Jare_Typograph_Tool::clearSpecialChars('your text', Jare_Typograph_Tool::CLEAR_MODE_HTML_MATTER);
	 * 	// ... or combo:
	 *  $str = Jare_Typograph_Tool::clearSpecialChars('your text', Jare_Typograph_Tool::CLEAR_MODE_UTF8_NATIVE|Jare_Typograph_Tool::CLEAR_MODE_HTML_MATTER);
	 * </code>
	 *
	 * @param 	string $text
	 * @param	int $mode
	 * @return 	string
	 */
	public static function clearSpecialChars($text, $mode)
	{
		$mode = (int) $mode;
	
		switch($mode) {
			case self::CLEAR_MODE_UTF8_NATIVE:
				$mode = array('utf8');
				break;
			case self::CLEAR_MODE_HTML_MATTER:
				$mode = array('html');
				break;
			case self::CLEAR_MODE_UTF8_NATIVE | self::CLEAR_MODE_HTML_MATTER:
				$mode = array('utf8', 'html');
				break;	
		}
		
		if (!is_array($mode)) {
			require_once 'Jare/Typograph/Tool/Exception.php';
			throw new Jare_Typograph_Tool_Exception("Incorrect mode");
		}
	
		foreach (self::$_charsTable as $char => $vals) {
			foreach ($mode as $type) {
				if (isset($vals[$type])) {
					foreach ($vals[$type] as $v) {
						if ('utf8' === $type && is_int($v)) {
							$v = self::_getUnicodeChar($v);
						}
						$text = str_replace($v, $char, $text);
					}
				}
			}
		}
		
		return $text;
	}
	
	/**
	 * РЈРґР°Р»РµРЅРёРµ С‚РµРіРѕРІ HTML РёР· С‚РµРєСЃС‚Р°
	 * РўРµРі <br /> Р±СѓРґРµС‚ РїСЂРµРѕР±СЂР°Р·РѕРІ РІ РїРµСЂРµРЅРѕСЃ СЃС‚СЂРѕРєРё \n, СЃРѕС‡РµС‚Р°РЅРёРµ С‚РµРіРѕРІ </p><p> -
	 * РІ РґРІРѕР№РЅРѕР№ РїРµСЂРµРЅРѕСЃ
	 *
	 * @param 	string $text
	 * @param 	array $allowableTag РјР°СЃСЃРёРІ РёР· С‚РµРіРѕРІ, РєРѕС‚РѕСЂС‹Рµ Р±СѓРґСѓС‚ РїСЂРѕРёРіРЅРѕСЂРёСЂРѕРІР°РЅС‹
	 * @return 	string
	 */
	public static function removeHtmlTags($text, $allowableTag = null)
	{
		$ignore = null;
		
		if (null !== $allowableTag) {
			if (is_string($allowableTag)) {
				$allowableTag = array($allowableTag);
			}
			
			if (is_array($allowableTag)) {
				require_once 'Jare/Typograph/Tool/Exception.php';
				throw new Jare_Typograph_Tool_Exception('Bad type of param #2');
			}
			
			foreach ($allowableTag as $tag) {
				if ('<' !== substr($tag, 0, 1) || '>' !== substr($tag, -1, 1)) {
					require_once 'Jare/Typograph/Tool/Exception.php';
					throw new Jare_Typograph_Tool_Exception("Incorrect tag $tag");
				}
				
				if ('/' === substr($tag, 1, 1)) {
					require_once 'Jare/Typograph/Tool/Exception.php';
					throw new Jare_Typograph_Tool_Exception("Incorrect tag $tag");
				}
			}
			
			$ignore = implode('', $allowableTag);
		}
		
		$text = preg_replace('/\<br\s*\/?>/i', "\n", $text);
		$text = preg_replace('/\<\/p\>\s*\<p\>/', "\n\n", $text);
		$text = strip_tags($text, $ignore);
		
		return $text;
	}
	
	/**
     * РЎРѕС…СЂР°РЅСЏРµРј СЃРѕРґРµСЂР¶РёРјРѕРµ С‚РµРіРѕРІ HTML
     *
     * РўРµРі 'a' РєРѕРґРёСЂСѓРµС‚СЃСЏ СЃРѕ СЃРїРµС†РёР°Р»СЊРЅС‹Рј РїСЂРµС„РёРєСЃРѕРј РґР»СЏ РґР°Р»СЊРЅРµР№С€РµР№
     * РІРѕР·РјРѕР¶РЅРѕСЃС‚Рё РІС‹РЅРѕСЃРёС‚СЊ Р·Р° РЅРµРіРѕ РєР°РІС‹С‡РєРё.
     * 
     * @param 	string $text
     * @param 	bool $safe
     * @return  string
     */
    public static function safeTagChars($text, $safe)
    {
    	$safe = (bool) $safe;
    	
    	if (true === $safe) {
        	$text = preg_replace('/(\<\/?)(.+?)(\>)/se', '"\1" .  ( substr(trim("\2"), 0, 1) === "a" ? "%%___"  : ""  ) . self::_encrypteContent(trim("\2"))  . "\3"', $text);
        } else {
        	$text = preg_replace('/(\<\/?)(.+?)(\>)/se', '"\1" .  ( substr(trim("\2"), 0, 3) === "%%___" ? self::_decrypteContent(substr(trim("\2"), 4)) : self::_decrypteContent(trim("\2")) ) . "\3"', $text);	
        }
        
        return $text;
    }
    
    /**
     * РЎРѕР·РґР°РЅРёРµ С‚РµРіР° СЃ Р·Р°С‰РёС‰РµРЅРЅС‹Рј СЃРѕРґРµСЂР¶РёРјС‹Рј 
     *
     * @param 	string $content С‚РµРєСЃС‚, РєРѕС‚РѕСЂС‹Р№ Р±СѓРґРµС‚ РѕР±СЂР°РјР»РµРЅ С‚РµРіРѕРј
     * @param 	string $tag 
     * @param 	array $attribute СЃРїРёСЃРѕРє Р°С‚СЂРёР±СѓС‚РѕРІ, РіРґРµ РєР»СЋС‡ - РёРјСЏ Р°С‚СЂРёР±СѓС‚Р°, Р° Р·РЅР°С‡РµРЅРёРµ - СЃР°РјРѕ Р·РЅР°С‡РµРЅРёРµ РґР°РЅРЅРѕРіРѕ Р°С‚СЂРёР±СѓС‚Р°
     * @return 	string
     */
    public static function buildSafedTag($content, $tag = 'span', $attribute = array())
    {
    	$htmlTag = $tag;
		
    	if (self::$_typographSpecificTagId) {
    		if(!isset($attribute['id'])) {
    			$attribute['id'] = 'jt-2' . mt_rand(1000,9999);
    		}
    	}
    	
		if (count($attribute)) {
			
			foreach ($attribute as $attr => $value) {
				$htmlTag .= " $attr=\"$value\"";
			}
		}
		
		return "<" . self::_encrypteContent($htmlTag) . ">$content</" . self::_encrypteContent($tag) . ">";
    }
    
    /**
     * РЎРїРёСЃРѕРє Р·Р°С‰РёС‰РµРЅРЅС‹С… Р±Р»РѕРєРѕРІ
     *
     * @return 	array
     */
    public static function getCustomBlocks()
    {
    	return self::$_customBlocks;
    }
    
    /**
     * РЈРґР°Р»РµРЅРЅРѕРіРѕ Р±Р»РѕРєР° РїРѕ РµРіРѕ РЅРѕРјРµСЂСѓ РєР»СЋС‡Р°
     *
     * @param 	int $blockId
     * @return  void
     */
    public static function removeCustomBlock($blockId)
    {
    	if (!is_int($blockId)) {
    		require_once 'Jare/Typograph/Tool/Exception.php';
			throw new Jare_Typograph_Tool_Exception("Incorrect type of value");
    	}
    	
    	if (!isset(self::$_customBlocks[$blockId])) {
    		require_once 'Jare/Typograph/Tool/Exception.php';
			throw new Jare_Typograph_Tool_Exception("Incorrect index");
    	}
    	
    	unset(self::$_customBlocks[$blockId]);
    }
    
    /**
     * Р”РѕР±Р°РІР»РµРЅРёРµ Р·Р°С‰РёС‰РµРЅРЅРѕРіРѕ Р±Р»РѕРєР°
     *
     * <code>
     *  Jare_Typograph_Tool::addCustomBlocks('<span>', '</span>');
     *  Jare_Typograph_Tool::addCustomBlocks('\<nobr\>', '\<\/span\>', true);
     * </code>
     * 
     * @param 	string $open РЅР°С‡Р°Р»Рѕ Р±Р»РѕРєР°
     * @param 	string $close РєРѕРЅРµС† Р·Р°С‰РёС‰РµРЅРЅРѕРіРѕ Р±Р»РѕРєР°
     * @param 	bool $quoted СЃРїРµС†РёР°Р»СЊРЅС‹Рµ СЃРёРјРІРѕР»С‹ РІ РЅР°С‡Р°Р»Рµ Рё РєРѕРЅС†Рµ Р±Р»РѕРєР° СЌРєСЂР°РЅРёСЂРѕРІР°РЅС‹
     * @return  void
     */
    public static function addCustomBlocks($open, $close, $quoted = false)
    {
    	$open = trim($open);
    	$close = trim($close);
    	
    	if (empty($open) || empty($close)) {
    		require_once 'Jare/Typograph/Tool/Exception.php';
			throw new Jare_Typograph_Tool_Exception("Bad value");
    	}
    	
    	if (false === $quoted) {
    		$open = preg_quote($open, '/');
            $close = preg_quote($close, '/');
    	}
    	
    	self::$_customBlocks[] = array($open, $close);
    }
    
    /**
     * РЎРѕС…СЂР°РЅРµРЅРёРµ СЃРѕРґРµСЂР¶РёРјРѕРіРѕ Р·Р°С‰РёС‰РµРЅРЅС‹С… Р±Р»РѕРєРѕРІ
     *
     * @param   string $text
     * @param   bool $safe РµСЃР»Рё true, С‚Рѕ СЃРѕРґРµСЂР¶РёРјРѕРµ Р±Р»РѕРєРѕРІ Р±СѓРґРµС‚ СЃРѕС…СЂР°РЅРµРЅРѕ, РёРЅР°С‡Рµ - СЂР°СЃРєРѕРґРёСЂРѕРІР°РЅРѕ. 
     * @return  string
     */
    public static function safeCustomBlocks($text, $safe)
    {
    	$safe = (bool) $safe;
    	
    	if (count(self::$_customBlocks)) {
    		$safeType = true === $safe ? "self::_encrypteContent('\\2')" : "stripslashes(self::_decrypteContent('\\2'))";
    		
       		foreach (self::$_customBlocks as $block) {
        		$text = preg_replace("/({$block[0]})(.+?)({$block[1]})/se",   "'\\1' . $safeType . '\\3'"  , $text);
        	}
    	}
        
        return $text;
    }
    
    /**
     * РњРµС‚РѕРґ, РѕСЃСѓС‰РµСЃС‚РІР»СЏСЋС‰РёР№ РєРѕРґРёСЂРѕРІР°РЅРёРµ (СЃРѕС…СЂР°РЅРµРЅРёРµ) РёРЅС„РѕСЂРјР°С†РёРё
     * СЃ С†РµР»СЊСЋ РЅРµРІРѕР·РјРѕР¶РЅРѕСЃС‚Рё С‚РёРїРѕРіСЂР°С„РёСЂРѕРІР°С‚СЊ РµРµ
     *
     * @param 	string $text
     * @return 	string
     */
    protected static function _encrypteContent($text)
    {
    	return base64_encode($text);
    }
    
    /**
     * РњРµС‚РѕРґ, РѕСЃСѓС‰РµСЃС‚РІР»СЏСЋС‰РёР№ РґРµРєРѕРґРёСЂРѕРІР°РЅРёРµ РёРЅС„РѕСЂРјР°С†РёРё
     *
     * @param 	string $text
     * @return 	string
     */
    protected static function _decrypteContent($text)
    {
    	return base64_decode($text);
    }
    
    /**
     * РљРѕСЃС‚С‹Р»Рё РґР»СЏ СЂР°Р±РѕС‚С‹ СЃ СЃРёРјРІРѕР»Р°РјРё UTF-8
     * 
     * @author	somebody?
     * @param	int $c РєРѕРґ СЃРёРјРІРѕР»Р° РІ РєРѕРґРёСЂРѕРІРєРµ UTF-8 (РЅР°РїСЂРёРјРµСЂ, 0x00AB)
     * @return	bool|string
     */
    protected static function _getUnicodeChar($c)
    {
    	if ($c <= 0x7F) {
        	return chr($c);
    	} else if ($c <= 0x7FF) {
        	return chr(0xC0 | $c >> 6)
        	     . chr(0x80 | $c & 0x3F);
    	} else if ($c <= 0xFFFF) {
        	return chr(0xE0 | $c >> 12)
        	     . chr(0x80 | $c >> 6 & 0x3F)
                 . chr(0x80 | $c & 0x3F);
    	} else if ($c <= 0x10FFFF) {
        	return chr(0xF0 | $c >> 18) 
        		 . chr(0x80 | $c >> 12 & 0x3F)                 	
        		 . chr(0x80 | $c >> 6 & 0x3F)
                 . chr(0x80 | $c & 0x3F);
    	} else {
        	return false;
    	}
    }
}