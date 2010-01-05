<?php
/*
$Id: sts_product_listing.php,v 1.0.3 2006/05/08 09:36:00 rigadin $

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2006 osCommerce

Released under the GNU General Public License
* 
STS PLUS v4 module for index.php by Rigadin (rigadin@osc-help.net)
*/

class sts_product_listing {

  var $template_file;
  
  function sts_product_listing (){
    $this->code = 'sts_product_listing';
    $this->title = MODULE_STS_PRODUCT_LISTING_TITLE;
    $this->description = MODULE_STS_PRODUCT_LISTING_DESCRIPTION;
	$this->sort_order=8;
	$this->enabled = ((MODULE_STS_PRODUCT_LISTING_STATUS == 'true') ? true : false);  
  }

  function find_template (){
  // Private function to check if there is a content template for products.

	$check_file= STS_TEMPLATE_DIR . "product_listing_item.html"; 
	if (file_exists($check_file)) return $check_file;
	  
	// If no content template found, return empty string
	return '';	
  } // End function

  function capture_fields () {
  // Returns list of files to include from folder sts_inc in order to build the $template fields
    return MODULE_STS_PRODUCT_LISTING_NORMAL;
  }
  
  function replace (&$template) {
    $template['content']=sts_strip_content_tags($template['content'], 'Product listing content');
  }

//======================================
// Functions needed for admin
//======================================
  
    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_STS_PRODUCT_LISTING_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_STS_PRODUCT_LISTING_STATUS', 'MODULE_STS_PRODUCT_LISTING_NORMAL');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Use template for product listing items', 'MODULE_STS_PRODUCT_LISTING_STATUS', 'true', 'Do you want to use templates for product listing items?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Files for product listing template', 'MODULE_STS_PRODUCT_LISTING_NORMAL', 'sts_user_code.php', 'Files to include for product listing template, separated by semicolon', '6', '2', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }  

}// end class
?>
