<?php
/*
  $Id: html_output.php,v 1.1.1.1 2003/09/18 19:05:10 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

////
// The HTML href link wrapper function
  function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
    global $request_type, $session_started, $SID;

    if (!tep_not_null($page)) {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>');
    }

    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == true) {
        $link = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
      } else {
        $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
      }
    } else {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL</b><br><br>');
    }

    if (tep_not_null($parameters)) {
      $link .= $page . '?' . tep_output_string($parameters);
      $separator = '&';
    } else {
      $link .= $page;
      $separator = '?';
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

// Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if ( ($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'False') ) {
      if (tep_not_null($SID)) {
        $_sid = $SID;
      } elseif ( ( ($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true) ) || ( ($request_type == 'SSL') && ($connection == 'NONSSL') ) ) {
        if (HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
          $_sid = tep_session_name() . '=' . tep_session_id();
        }
      }
    }

    if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) {
      while (strstr($link, '&&')) $link = str_replace('&&', '&', $link);

      $link = str_replace('?', '/', $link);
      $link = str_replace('&', '/', $link);
      $link = str_replace('=', '/', $link);

      $separator = '?';
    }


// Page Cache Start

//    if (isset($_sid)) {
//      $link .= $separator . tep_output_string($_sid);
//    }
    
    
if (!tep_session_is_registered('customer_id') && ENABLE_PAGE_CACHE == 'true' && class_exists('page_cache')) {
      $link .= $separator . '<osCsid>';
      } elseif (isset($_sid)) {
      $link .= $separator . tep_output_string($_sid);
      }    

    return $link;
  }

// Page Cache End

////
// The HTML image wrapper function
  function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
      return false;
    }

// begin radders added
  $src = tep_image_resample($src,$width,$height);
//end radders added

// alt is added to the img tag even if it is null to prevent browsers from outputting
// the image filename as default
    $image = '<img src="' . tep_output_string($src) . '" border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) {
      $image .= ' title=" ' . tep_output_string($alt) . ' "';
    }

    if ( (CONFIG_CALCULATE_IMAGE_SIZE == 'true') && (empty($width) || empty($height)) ) {
      if ($image_size = @getimagesize($src)) {
        if (empty($width) && tep_not_null($height)) {
          $ratio = $height / $image_size[1];
          $width = $image_size[0] * $ratio;
        } elseif (tep_not_null($width) && empty($height)) {
          $ratio = $width / $image_size[0];
          $height = $image_size[1] * $ratio;
        } elseif (empty($width) && empty($height)) {
          $width = $image_size[0];
          $height = $image_size[1];
        }
      } elseif (IMAGE_REQUIRED == 'false') {
        return false;
      }
    }

    if (tep_not_null($width) && tep_not_null($height)) {
      $image .= ' width="' . tep_output_string($width) . '" height="' . tep_output_string($height) . '"';
    }

    if (tep_not_null($parameters)) $image .= ' ' . $parameters;

    $image .= '>';

    return $image;
  }

  function tep_image_old($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
      return false;
    }

// alt is added to the img tag even if it is null to prevent browsers from outputting
// the image filename as default
    $image = '<img src="' . tep_output_string($src) . '" border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) {
      $image .= ' title=" ' . tep_output_string($alt) . ' "';
    }

    if ( (CONFIG_CALCULATE_IMAGE_SIZE == 'true') && (empty($width) || empty($height)) ) {
      if ($image_size = @getimagesize($src)) {
        if (empty($width) && tep_not_null($height)) {
          $ratio = $height / $image_size[1];
          $width = $image_size[0] * $ratio;
        } elseif (tep_not_null($width) && empty($height)) {
          $ratio = $width / $image_size[0];
          $height = $image_size[1] * $ratio;
        } elseif (empty($width) && empty($height)) {
          $width = $image_size[0];
          $height = $image_size[1];
        }
      } elseif (IMAGE_REQUIRED == 'false') {
        return false;
      }
    }

    if (tep_not_null($width) && tep_not_null($height)) {
      $image .= ' width="' . tep_output_string($width) . '" height="' . tep_output_string($height) . '"';
    }

    if (tep_not_null($parameters)) $image .= ' ' . $parameters;

    $image .= '>';

    return $image;
  }

// begin radders added
function tep_image_resample($src,$width,$height) {

	define(JPEGQUALITY, 90);
	define(ALLOWSQUASH,0.10);
	if ($src=='') {
		return $src;
 	}
	$i = @getimagesize( $src );   // 1-gif (ignore), 2-jpeg, 3-png

	if (!(($width == SMALL_IMAGE_WIDTH) && ($height == SMALL_IMAGE_HEIGHT))) {
		return $src; // can amend to work with other images
 	}
	if (!( ($i[2] == 3) || ($i[2] ==2))) {
		return $src;
 	}

	$file = preg_replace( '/\.([a-z]{3,4})$/', "-{$width}x{$height}.\\1", $src );  // name of resampled image
	if (is_file( $file ) ) {	
		return $file;
	}

	$scr_w	 =  $i[0];
	$scr_h	 = $i[1];
	if (($scr_w * $scr_h * $width * $height) == 0) {
		return $src;
 	}

	$howsquashed = ($width / $height * $scr_h / $scr_w);
	if (((1 / (1 + ALLOWSQUASH)) < $howsquashed) && ($howsquashed < (1 + ALLOWSQUASH))) $simpleway='true';
	$scalefactor = min($width/$scr_w, $height/$scr_h);          
	$scaled_w	= (int)($scr_w * $scalefactor);
	$scaled_h	 = (int)($scr_h * $scalefactor); 
	$offset_w	= max(0,round(($width - $scaled_w) / 2,0));
	$offset_h	 = max(0,round(($height - $scaled_h) / 2)); 
 	$dst = DIR_FS_CATALOG . '/' . $file; 
   	$dstim = @imagecreatetruecolor ($width, $height);
	$background_color = imagecolorallocate ($dstim, 255, 255, 255);
	imagefilledrectangle($dstim, 0, 0, $width, $height, $background_color);
	if ( $i[2] == 2) {
		$srcim = @ImageCreateFromJPEG ($src); // open
	}
	elseif ( $i[2] == 3) {
		$srcim	 = @ImageCreateFromPNG ($src);
	}
	if ($simpleway == 'true') {	
		imagecopyresampled ($dstim, $srcim, 0, 0, 0, 0, $width, $height, $scr_w, $scr_h);	
	}
	else {
		$intim = @imagecreatetruecolor ($width, $height); 
		imagecopyresampled ($intim, $srcim, $offset_w, $offset_h, 0, 0, $scaled_w, $scaled_h, $scr_w, $scr_h);
		imagecopy ( $dstim, $intim, $offset_w, $offset_h, $offset_w, $offset_h, $scaled_w, $scaled_h);
		imagedestroy ($intim);
	}
	if ( $i[2] == 2) {
		imagejpeg ($dstim , $dst , JPEGQUALITY);  
	}
	elseif ( $i[2] == 3) {
		imagepng ($dstim , $dst);
	}
	imagedestroy ($srcim);
	imagedestroy ($dstim);
	return $file;                 // Use the newly resampled image
}
// end radders added

////
// The HTML form submit button wrapper function
// Outputs a button in the selected language
  function tep_image_submit($image, $alt = '', $parameters = '') {
    global $language;

    $image_submit = '<input type="image" src="' . tep_output_string(DIR_WS_LANGUAGES_IMAGES . $language . '/images/buttons/' . $image) . '" border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) $image_submit .= ' title=" ' . tep_output_string($alt) . ' "';

    if (tep_not_null($parameters)) $image_submit .= ' ' . $parameters;

    $image_submit .= '>';

    return $image_submit;
  }

function tep_template_image_submit($image, $alt = '', $parameters = '') {
  return tep_image_submit($image, $alt, $parameters);
}

////
// Output a function button in the selected language
  function tep_image_button($image, $alt = '', $parameters = '') {
    global $language;

    return tep_image(DIR_WS_LANGUAGES_IMAGES . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
  }

////
// Output a separator either through whitespace, or with an image
  function tep_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1') {
    return tep_image(DIR_WS_IMAGES . $image, '', $width, $height);
  }

function tep_template_image_button($image, $alt = '', $parameters = '') {
  return tep_image_button($image, $alt, $parameters);
}

////
// Output a form
  function tep_draw_form($name, $action, $method = 'post', $parameters = '') {
    $form = '<form name="' . tep_output_string($name) . '" action="' . tep_output_string($action) . '" method="' . tep_output_string($method) . '"';

    if (tep_not_null($parameters)) $form .= ' ' . $parameters;

    $form .= '>';

    return $form;
  }

////
// Output a form input field
  function tep_draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
	    global $_GET, $_POST;

    $field = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if ( ($reinsert_value == true) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
 	      if (isset($_GET[$name]) && is_string($_GET[$name])) {
 	        $value = stripslashes($_GET[$name]);
 	      } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
 	        $value = stripslashes($_POST[$name]);
 	      }
 	    }
 	 
 	    if (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    return $field;
  }

////
// Output a form password field
  function tep_draw_password_field($name, $value = '', $parameters = 'maxlength="40"') {
    return tep_draw_input_field($name, $value, $parameters, 'password', false);
  }

////
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
  function tep_draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '') {
	    global $_GET, $_POST;

    $selection = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) $selection .= ' value="' . tep_output_string($value) . '"';

    if ( ($checked == true) || (isset($_GET[$name]) && is_string($_GET[$name]) && (($_GET[$name] == 'on') || (stripslashes($_GET[$name]) == $value))) || (isset($_POST[$name]) && is_string($_POST[$name]) && (($_POST[$name] == 'on') || (stripslashes($_POST[$name]) == $value))) ) {
    
      $selection .= ' CHECKED';
    }

    if (tep_not_null($parameters)) $selection .= ' ' . $parameters;

    $selection .= '>';

    return $selection;
  }

////
// Output a form checkbox field
  function tep_draw_checkbox_field($name, $value = '', $checked = false, $parameters = '') {
    return tep_draw_selection_field($name, 'checkbox', $value, $checked, $parameters);
  }

////
// Output a form radio field
  function tep_draw_radio_field($name, $value = '', $checked = false, $parameters = '') {
    return tep_draw_selection_field($name, 'radio', $value, $checked, $parameters);
  }

////
// Output a form textarea field
  function tep_draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
	    global $_GET, $_POST;

    $field = '<textarea name="' . tep_output_string($name) . '" wrap="' . tep_output_string($wrap) . '" cols="' . tep_output_string($width) . '" rows="' . tep_output_string($height) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ( ($reinsert_value == true) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
 	      if (isset($_GET[$name]) && is_string($_GET[$name])) {
 	        $field .= tep_output_string_protected(stripslashes($_GET[$name]));
 	      } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
 	        $field .= tep_output_string_protected(stripslashes($_POST[$name]));
 	      }
    } elseif (tep_not_null($text)) {
      $field .= tep_output_string_protected($text);
    }

    $field .= '</textarea>';

    return $field;
  }

////
// Output a form hidden field
  function tep_draw_hidden_field($name, $value = '', $parameters = '') {
	    global $_GET, $_POST;

    $field = '<input type="hidden" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    } elseif ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) {
 	      if ( (isset($_GET[$name]) && is_string($_GET[$name])) ) {
 	        $field .= ' value="' . tep_output_string(stripslashes($_GET[$name])) . '"';
 	      } elseif ( (isset($_POST[$name]) && is_string($_POST[$name])) ) {
 	        $field .= ' value="' . tep_output_string(stripslashes($_POST[$name])) . '"';
 	      }
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    return $field;
  }

////
// Hide form elements
  function tep_hide_session_id() {
    global $session_started, $SID;

    if (($session_started == true) && tep_not_null($SID)) {
      return tep_draw_hidden_field(tep_session_name(), tep_session_id());
    }
  }

////
// Output a form pull down menu
  function tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {
    global $_GET, $_POST;

    $field = '<select name="' . tep_output_string($name) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
      if (isset($_GET[$name]) && is_string($_GET[$name])) {
        $default = stripslashes($_GET[$name]);
      } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
        $default = stripslashes($_POST[$name]);
      }
    }

// Start Products Specifications
    foreach ($values as $link_data) {
      switch (true) {
        case ($link_data['count'] != '' && $link_data['count'] < 1 && SPECIFICATIONS_FILTER_NO_RESULT == 'none'):
          break;
        
        case ($link_data['count'] != '' && $link_data['count'] < 1 && SPECIFICATIONS_FILTER_NO_RESULT == 'grey'):
          $field .= '<optgroup class="no_results" label="';
          $field .= tep_output_string ($link_data['text'] );
          if (SPECIFICATIONS_FILTER_SHOW_COUNT == 'True' && $link_data['count'] != '') {
            $field .= ' (' . $link_data['count'] . ')';
          }
          $field .= '"></optgroup>';
          break;
        
        default:
          $field .= '<option value="' . tep_output_string ($link_data['id']) . '"';
          if (in_array ($link_data['id'], (array) $default) ) {
            $field .= ' SELECTED';
          }

          $field .= '>' . tep_output_string ($link_data['text'], array (
            '"' => '&quot;',
            '\'' => '&#039;',
            '<' => '&lt;',
            '>' => '&gt;'
          ));
            
          if (SPECIFICATIONS_FILTER_SHOW_COUNT == 'True' && $link_data['count'] != '') {
            $field .= '<span class="filter_count"> (' . $link_data['count'] . ')</span>';
          }
          $field .= '</option>';
          break;
      } // switch (true)
    } // foreach ($values
// End Products Specifications

    $field .= '</select>';
    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }

////
// Creates a pull-down list of countries
  function tep_get_country_list($name, $selected = '', $parameters = '') {
    $countries_array = array(array('id' => '', 'text' => PULL_DOWN_DEFAULT));
    $countries = tep_get_countries();

    for ($i=0, $n=sizeof($countries); $i<$n; $i++) {
      $countries_array[] = array('id' => $countries[$i]['countries_id'], 'text' => $countries[$i]['countries_name']);
    }

    return tep_draw_pull_down_menu($name, $countries_array, $selected, $parameters);
  }
?>
