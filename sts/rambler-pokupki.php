<?php
 require('includes/application_top.php');

// Set number of columns in listing
define ('NR_COLUMNS', 2);
//
// РЎРѕР·РґР°С‘Рј Р±Р°Р·РѕРІСѓСЋ Р°СѓРЅС‚РµС„РёРєР°С†РёСЋ
//Р•СЃР»Рё РјС‹ РёСЃРїРѕР»СЊР·СѓРµРј IIS, РјС‹ РґРѕР»Р¶РЅС‹ СѓСЃС‚Р°РЅРѕРІРёС‚СЊ $PHP_AUTH_USER Рё $PHP_AUTH_PW
/*if (substr($SERVER_SOFTWARE, 0, 9) == "Microsoft" &&
    !isset($PHP_AUTH_USER) &&
    !isset($PHP_AUTH_PW) &&
    substr($HTTP_AUTHORIZATION, 0, 6) == "Basic "
   ) 
{ 
  list($PHP_AUTH_USER, $PHP_AUTH_PW) = 
    explode(":", base64_decode(substr($HTTP_AUTHORIZATION, 6))); 
} 

// РЎРґРµСЃСЊ РјС‹ РјРѕР¶РµРј РІС‹С‚Р°СЃРєРёРІР°С‚СЊ РїР°СЃРїРѕСЂС‚ РёР· Р±Р°Р·С‹ РґР°РЅРЅС‹С… РЅРѕ СЌС‚Рѕ РїРѕС‚РѕРј
// Р