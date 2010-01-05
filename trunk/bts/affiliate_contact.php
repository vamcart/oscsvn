<?php
/*
  $Id: affiliate_contact.php,v 1.2 2003/09/24 15:34:25 wilt Exp $

  OSC-Affiliate

  Contribution based on:

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('affiliate_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_CONTACT);

// BOF: BugFix: Spam mailer exploit
$sanita = array("|([\r\n])[\s]+|","@Content-Type:@");
$_POST['email'] = $_POST['email'] = preg_replace( $sanita, " ", $_POST['email'] );
$_POST['name'] = $_POST['name'] = preg_replace( $sanita, " ", $_POST['name'] );
// EOF: BugFix: Spam mailer exploit 

  $error = false;
  if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
    if (tep_validate_email(trim($_POST['email']))) {
      tep_mail(STORE_OWNER, AFFILIATE_EMAIL_ADDRESS, EMAIL_SUBJECT, $_POST['enquiry'], $_POST['name'], $_POST['email']);
      tep_redirect(tep_href_link(FILENAME_AFFILIATE_CONTACT, 'action=success'));
    } else {
      $error = true;
    }
  }

  $enquiry = "";
  $name = "";
  $email = "";
  
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_CONTACT));

  $affiliate_values = tep_db_query("select * from " . TABLE_AFFILIATE . " where affiliate_id = '" . $affiliate_id . "'");
  $affiliate = tep_db_fetch_array($affiliate_values);

  $content = CONTENT_AFFILIATE_CONTACT;

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>
