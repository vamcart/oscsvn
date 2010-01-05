<?php
/*
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License

  IMPORTANT NOTE:

  This script is not part of the official osC distribution
  but an add-on contributed to the osC community. Please
  read the README and  INSTALL documents that are provided
  with this file for further information and installation notes.

  loginbox.php -   Version 1.0
  This puts a login request in a box with a login button.
  If already logged in, will not show anything.

  Modified to utilize SSL to bypass Security Alert
*/

// WebMakers.com Added: Do not show if on login or create account
if ( (!strstr($_SERVER['PHP_SELF'],'login.php')) and (!strstr($_SERVER['PHP_SELF'],'create_account.php')) and !tep_session_is_registered('customer_id') )  {
?>
<!-- loginbox //-->
<?php

    if (!tep_session_is_registered('customer_id')) {
?>
          <tr>
            <td>
<?php

  $info_box_contents = array();
$info_box_contents[] = array('text' => '<font color="' . $font_color . '">' . BOX_HEADING_LOGIN . '</font>');
    new infoBoxHeading($info_box_contents, false, false);

    $loginboxcontent = "
            <table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
            <form name=\"login\" method=\"post\" action=\"" . tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL') . "\">
              <tr>
                <td align=\"left\" class=\"infoboxContents\">
                  " . BOX_LOGINBOX_EMAIL . "
                </td>
              </tr>
              <tr>
                <td align=\"left\" class=\"infoboxContents\">
                  <input type=\"text\" name=\"email_address\" maxlength=\"96\" size=\"13\" value=\"\">
                </td>
              </tr>
              <tr>
                <td align=\"left\" class=\"infoboxContents\">
                  " . BOX_LOGINBOX_PASSWORD . "
                </td>
              </tr>
              <tr>
                <td align=\"left\" class=\"infoboxContents\">
                  <input type=\"password\" name=\"password\" maxlength=\"40\" size=\"13\" value=\"\">
                </td>
              </tr>
		    <tr>
        		<td align=\"center\">
			" . tep_draw_separator('pixel_trans.gif', '100%', '5') . "
			</td>
      	    </tr>
              <tr>
                <td class=\"infoboxContents\" align=\"center\">
                  " . tep_template_image_submit('button_login.gif', IMAGE_BUTTON_LOGIN, 'SSL') . "
                </td>
              </tr>
		    <tr>
        		<td align=\"center\">
			" . tep_draw_separator('pixel_trans.gif', '100%', '5') . "
			</td>
      	    </tr>
		    <tr>
        		<td align=\"center\" class=\"boxText\">
			<a href=\"" . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . "\">" . HEADER_TITLE_CREATE_ACCOUNT . "</a>
			</td>
      	    </tr>
            </form>
            </table>
              ";
    $info_box_contents = array();
    $info_box_contents[] = array('align' => 'center',
                                 'text'  => $loginboxcontent
                                );
new infoBox($info_box_contents);


?>
            </td>
          </tr>
<?php
  } else {
  // If you want to display anything when the user IS logged in, put it
  // in here...  Possibly a "You are logged in as :" box or something.
  }
?>
<!-- loginbox_eof //-->
<?php
// WebMakers.com Added: My Account Info Box
} else {
  if (tep_session_is_registered('customer_id') and ($guest_account == false)) {
?>

<!-- my_account_info //-->
          <tr>
            <td>
<?php

  $info_box_contents = array();
  $info_box_contents[] = array('text' => '<font color="' . $font_color . '">' . BOX_HEADING_LOGIN . '</font>');
  new infoBoxHeading($info_box_contents, false, false);

  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'text'  =>
                                          '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . LOGIN_BOX_MY_ACCOUNT . '</a><br>' .
                                          '<a href="' . tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">' . LOGIN_BOX_ACCOUNT_EDIT . '</a><br>' .
                                          '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">' . LOGIN_BOX_ACCOUNT_HISTORY . '</a><br>' .
                                          '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . LOGIN_BOX_ADDRESS_BOOK . '</a><br>' .
                                          '<a href="' . tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'NONSSL') . '">' . LOGIN_BOX_PRODUCT_NOTIFICATIONS . '</a><br>' .
                                          '<a href="' . tep_href_link(FILENAME_LOGOFF, '', 'NONSSL') . '">' . LOGIN_BOX_LOGOFF . '</a>'
                              );
new infoBox($info_box_contents);

?>
            </td>
          </tr>
<!-- my_account_info_eof //-->

<?php
  }
}
?>
