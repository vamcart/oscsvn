<?php
/*
  $Id: create_account_process.php,v 1.1 2003/09/24 14:33:18 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
define('NAVBAR_TITLE', 'Create an Account');
define('HEADING_TITLE', 'Account Information');
define('HEADING_NEW', 'Order Process');
define('NAVBAR_NEW_TITLE', 'Order Process');

define('EMAIL_SUBJECT', 'Welcome to ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Dear Mr. ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Dear Ms. ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Dear ' . stripslashes($_POST['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'We welcome you to <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'You can now take part in the <b>various services</b> we have to offer you. Some of these services include:' . "\n\n" . '<li><b>Permanent Cart</b> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n" . '<li><b>Address Book</b> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.' . "\n" . '<li><b>Order History</b> - View your history of purchases that you have made with us.' . "\n" . '<li><b>Products Reviews</b> - Share your opinions on products with our other customers.' . "\n\n");
define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us by one of our customers. If you did not signup to be a member, please send a email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

define('IMAGE_BUTTON_CONTINUE', 'Continue');

?>