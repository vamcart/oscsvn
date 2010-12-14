<?php

// utf8cp1251 and cp1251toutf8 functions

function Utf8ToWin($fcontents) {

    if (function_exists('iconv')) {
       return iconv('UTF-8', 'CP1251', $fcontents); 
    } else {

    $out = $c1 = '';
    $byte2 = false;
    for ($c = 0;$c < strlen($fcontents);$c++) {
        $i = ord($fcontents[$c]);
        if ($i <= 127) {
            $out .= $fcontents[$c];
        }
        if ($byte2) {
            $new_c2 = ($c1 & 3) * 64 + ($i & 63);
            $new_c1 = ($c1 >> 2) & 5;
            $new_i = $new_c1 * 256 + $new_c2;
            if ($new_i == 1025) {
                $out_i = 168;
            } else {
                if ($new_i == 1105) {
                    $out_i = 184;
                } else {
                    $out_i = $new_i - 848;
                }
            }
            $out .= chr($out_i);
            $byte2 = false;
        }
        if (($i >> 5) == 6) {
            $c1 = $i;
            $byte2 = true;
        }
    }
    return $out;


    }

}

function CP1251toUTF8($str){

    if (function_exists('iconv')) {
       return iconv('CP1251', 'UTF-8', $str); 
    } else {

static $table = array("\xA8" => "\xD0\x81", 
"\xB8" => "\xD1\x91", 
// Р±пїЅРљР±пїЅРђР°Р