<?php
/*
  $Id: tell_a_friend.php,v 1.42 2003/06/11 17:35:01 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id') && (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $valid_product = false;
  if (isset($_GET['products_id'])) {
    $product_info_query = tep_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
    if (tep_db_num_rows($product_info_query)) {
      $valid_product = true;

      $product_info = tep_db_fetch_array($product_info_query);
    } else {
      tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']));
    }
  }

  $valid_article = false;
  if (isset($_GET['articles_id'])) {
    $article_info_query = tep_db_query("select pd.articles_name from " . TABLE_ARTICLES . " p, " . TABLE_ARTICLES_DESCRIPTION . " pd where p.articles_status = '1' and p.articles_id = '" . (int)$_GET['articles_id'] . "' and p.articles_id = pd.articles_id and pd.language_id = '" . (int)$languages_id . "'");
    if (tep_db_num_rows($article_info_query)) {
      $valid_article = true;

      $article_info = tep_db_fetch_array($article_info_query);
    } else {
      tep_redirect(tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $_GET['articles_id']));
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_TELL_A_FRIEND);

  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $error = false;

    $to_email_address = tep_db_prepare_input($_POST['to_email_address']);
    $to_name = tep_db_prepare_input($_POST['to_name']);
    $from_email_address = tep_db_prepare_input($_POST['from_email_address']);
    $from_name = tep_db_prepare_input($_POST['from_name']);
    $message = tep_db_prepare_input($_POST['message']);
    $captcha = tep_db_prepare_input($_POST['captcha']);

    if (empty($from_name)) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_NAME);
    }

    if (!tep_validate_email($from_email_address)) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_ADDRESS);
    }

    if (empty($to_name)) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_NAME);
    }

    if (!tep_validate_email($to_email_address)) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_ADDRESS);
    }

    if ($captcha == '' or $captcha != $_SESSION['captcha_keystring']) {
      $error = true;

      $messageStack->add('friend', ENTRY_CAPTCHA_ERROR);
    }

    if ($error == false) {
      // Modify e-mail depending on whether prodect or article
      // if product
      if ($valid_product) {
        $email_subject = sprintf(TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME);
        $email_body = sprintf(TEXT_EMAIL_INTRO, $to_name, $from_name, $product_info['products_name'], STORE_NAME) . "\n\n";

      if (tep_not_null($message)) {
        $email_body .= $message . "\n\n";
      }

      $email_body .= sprintf(TEXT_EMAIL_LINK, tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id'])) . "\n\n" .
                     sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME . "\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n");

      tep_mail($to_name, $to_email_address, $email_subject, $email_body, $from_name, $from_email_address);

        $messageStack->add_session('header', sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $product_info['products_name'], tep_output_string_protected($to_name)), 'success');

        tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']));
        // if article
        } else if ($valid_article) {
          $email_subject = sprintf(TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME);
          $email_body = sprintf(TEXT_EMAIL_INTRO, $to_name, $from_name, $article_info['articles_name'], STORE_NAME) . "\n\n";

          if (tep_not_null($message)) {
            $email_body .= $message . "\n\n";
          }

          $email_body .= sprintf(TEXT_EMAIL_LINK_ARTICLE, tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $_GET['articles_id'])) . "\n\n" .
                         sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME . "\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n");

          tep_mail($to_name, $to_email_address, $email_subject, $email_body, $from_name, $from_email_address);

          $messageStack->add_session('header', sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $article_info['articles_name'], tep_output_string_protected($to_name)), 'success');

          tep_redirect(tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $_GET['articles_id']));
          }
    }
  } elseif (tep_session_is_registered('customer_id')) {
    $account_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
    $account = tep_db_fetch_array($account_query);

    $from_name = $account['customers_firstname'] . ' ' . $account['customers_lastname'];
    $from_email_address = $account['customers_email_address'];
  }

  if ($valid_product) {
    $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_TELL_A_FRIEND, 'products_id=' . $_GET['products_id']));
    } else if ($valid_article) {
      $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_TELL_A_FRIEND, 'articles_id=' . $_GET['articles_id']));
      }

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<?php
// BOF: WebMakers.com Changed: Header Tag Controller v1.0
// Replaced by header_tags.php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <title><?php echo TITLE ?></title>
<?php
}
// EOF: WebMakers.com Changed: Header Tag Controller v1.0
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top">
    <?php
      // Modify form processing depending on whether product or article
      if ($valid_product) {
          echo tep_draw_form('email_friend', tep_href_link(FILENAME_TELL_A_FRIEND, 'action=process&products_id=' . $_GET['products_id']));
        } else if ($valid_article) {
          echo tep_draw_form('email_friend', tep_href_link(FILENAME_TELL_A_FRIEND, 'action=process&articles_id=' . $_GET['articles_id']));
      }
    ?>    
    
    
<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">
            
            <?php

              // Modify heading depending on whether product or article
              if ($valid_product) {
                 $title = $product_info['products_name'];
                 } else if ($valid_article) {
                   $title = $article_info['articles_name'];
              }
              echo sprintf(HEADING_TITLE, $title);

            ?>            
            
            
            </td>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_contact_us.gif', sprintf(HEADING_TITLE, $product_info['products_name']), HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($messageStack->size('friend') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('friend'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo FORM_TITLE_CUSTOMER_DETAILS; ?></b></td>
                <td class="inputRequirement" align="right"><?php echo FORM_REQUIRED_INFORMATION; ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
              <tr class="infoBoxContents">
                <td><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo FORM_FIELD_CUSTOMER_NAME; ?></td>
                    <td class="main"><?php echo tep_draw_input_field('from_name') . '&nbsp;<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo FORM_FIELD_CUSTOMER_EMAIL; ?></td>
                    <td class="main"><?php echo tep_draw_input_field('from_email_address') . '&nbsp;<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>'; ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><b><?php echo FORM_TITLE_FRIEND_DETAILS; ?></b></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
              <tr class="infoBoxContents">
                <td><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo FORM_FIELD_FRIEND_NAME; ?></td>
                    <td class="main"><?php echo tep_draw_input_field('to_name') . '&nbsp;<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo FORM_FIELD_FRIEND_EMAIL; ?></td>
                    <td class="main"><?php echo tep_draw_input_field('to_email_address') . '&nbsp;<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>'; ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><b><?php echo FORM_TITLE_FRIEND_MESSAGE; ?></b></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
              <tr class="infoBoxContents">
                <td><?php echo tep_draw_textarea_field('message', 'soft', 40, 8); ?></td>
              </tr>
            </table></td>
          </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main" colspan="2"><?php echo '<img src="'.tep_href_link(FILENAME_DISPLAY_CAPTCHA).'" alt="captcha" />'; ?></td>
              </tr>
              <tr>
                <td class="main" width="25%"><?php echo ENTRY_CAPTCHA; ?></td>
                <td class="main"><?php echo tep_draw_input_field('captcha', '', 'size="6"', 'text', false); ?></td>
              </tr>
            </table></td>
          </tr>           
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']) . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                <td align="right"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></form></td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>