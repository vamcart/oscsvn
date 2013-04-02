<?php
/*
  $Id: install_2.php,v 1.9 2004/07/22 20:47:11 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2004 osCommerce

  Released under the GNU General Public License
*/

  $db_table_types = array(array('id' => 'mysql', 'text' => 'MySQL - MyISAM (Default)'),
                          array('id' => 'mysql_innodb', 'text' => 'MySQL - InnoDB (Transaction-Safe)'));
?>

<p class="pageTitle"><?php echo PAGE_TITLE_INSTALLATION; ?></p>

<p class="pageSubTitle"><?php echo PAGE_SUBTITLE_DATABASE_IMPORT; ?></p>

<?php
  if (isset($_POST['DB_SERVER']) && !empty($_POST['DB_SERVER']) && isset($_POST['DB_TEST_CONNECTION']) && ($_POST['DB_TEST_CONNECTION'] == 'true')) {
    $db = array();
    $db['DB_SERVER'] = trim(stripslashes($_POST['DB_SERVER']));
    $db['DB_SERVER_USERNAME'] = trim(stripslashes($_POST['DB_SERVER_USERNAME']));
    $db['DB_SERVER_PASSWORD'] = trim(stripslashes($_POST['DB_SERVER_PASSWORD']));
    $db['DB_DATABASE'] = trim(stripslashes($_POST['DB_DATABASE']));

    osc_db_connect($db['DB_SERVER'], $db['DB_SERVER_USERNAME'], $db['DB_SERVER_PASSWORD'], $db['DB_DATABASE']);

    if ($db_error == false) {
      osc_db_test_create_db_permission($db['DB_DATABASE']);
    }

    if ($db_error != false) {
?>
<form name="install" action="install.php?step=2" method="post">

<table width="95%" border="0" cellpadding="2" class="formPage">
  <tr>
    <td><?php echo $db_error; ?></td>
  </tr>
</table>

<?php
      foreach($_POST as $key => $value) {
        if (($key != 'x') && ($key != 'y') && ($key != 'DB_TEST_CONNECTION')) {
          if (is_array($value)) {
            for ($i=0, $n=sizeof($value); $i<$n; $i++) {
              echo osc_draw_hidden_field($key . '[]', $value[$i]);
            }
          } else {
            echo osc_draw_hidden_field($key, $value);
          }
        }
      }
?>

<p>&nbsp;</p>

<table width="95%" border="0" cellspacing="2">
  <tr>
    <td align="right"><input type="image" src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/buttons/back.gif" border="0" alt="<?php echo IMAGE_BUTTON_BACK; ?>">&nbsp;&nbsp;<a href="index.php"><img src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/buttons/cancel.gif" border="0" alt="<?php echo IMAGE_BUTTON_CANCEL; ?>"></a></td>
  </tr>
</table>

</form>

<?php
    } else {
      if ($_POST['DB_DATABASE_CLASS'] == 'mysql_innodb') {
        $db_has_innodb = false;

        $Qinno = $osC_Database->query('show variables like "have_innodb"');
        if (($Qinno->numberOfRows() === 1) && (strtolower($Qinno->value('Value')) == 'yes')) {
          $db_has_innodb = true;
        }
      }

      $script_filename = getenv('PATH_TRANSLATED');
      if (empty($script_filename)) {
        $script_filename = getenv('SCRIPT_FILENAME');
      }

      $script_filename = str_replace('\\', '/', $script_filename);
      $script_filename = str_replace('//', '/', $script_filename);

      $dir_fs_www_root_array = explode('/', dirname($script_filename));
      $dir_fs_www_root = array();
      for ($i=0, $n=sizeof($dir_fs_www_root_array)-1; $i<$n; $i++) {
        $dir_fs_www_root[] = $dir_fs_www_root_array[$i];
      }
      $dir_fs_www_root = implode('/', $dir_fs_www_root) . '/';
?>

<form name="install" action="install.php?step=3" method="post">

<table width="95%" border="0" cellpadding="2" class="formPage">
  <tr>
    <td>
<?php
      echo TEXT_SUCCESSFUL_DATABASE_CONNECTION;

      echo sprintf(TEXT_IMPORT_SQL, $dir_fs_www_root . 'install/vam.sql');

?>
    </td>
  </tr>
</table>

<?php
      foreach ($_POST as $key => $value) {
        if (($key != 'x') && ($key != 'y') && ($key != 'DB_TEST_CONNECTION')) {
          if (is_array($value)) {
            for ($i=0, $n=sizeof($value); $i<$n; $i++) {
              echo osc_draw_hidden_field($key . '[]', $value[$i]);
            }
          } else {
            echo osc_draw_hidden_field($key, $value);
          }
        }
      }
?>

<p>&nbsp;</p>

<table width="95%" border="0" cellspacing="2">
  <tr>
    <td align="right"><input type="image" src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/buttons/continue.gif" border="0" alt="<?php echo IMAGE_BUTTON_CONTINUE; ?>">&nbsp;&nbsp;<a href="index.php"><img src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/buttons/cancel.gif" border="0" alt="<?php echo IMAGE_BUTTON_CANCEL; ?>"></a></td>
  </tr>
</table>

</form>

<?php
    }
  } else {
?>

<form name="install" action="install.php?step=2" method="post">

<p><?php echo TEXT_ENTER_DATABASE_INFORMATION; ?></p>

<table width="95%" border="0" cellpadding="2" class="formPage">
  <tr>
    <td width="30%" valign="top"><?php echo CONFIG_DATABASE_SERVER; ?></td>
    <td width="70%" class="smallDesc">
      <?php echo osc_draw_input_field('DB_SERVER'); ?>
      <img src="templates/<?php echo $template; ?>/images/help_icon.gif" onClick="toggleBox('dbHost');"><br>
      <div id="dbHostSD"><?php echo CONFIG_DATABASE_SERVER_DESCRIPTION; ?></div>
      <div id="dbHost" class="longDescription"><?php echo CONFIG_DATABASE_SERVER_DESCRIPTION_LONG; ?></div>
    </td>
  </tr>
  <tr>
    <td width="30%" valign="top"><?php echo CONFIG_DATABASE_USERNAME; ?></td>
    <td width="70%" class="smallDesc">
      <?php echo osc_draw_input_field('DB_SERVER_USERNAME'); ?>
      <img src="templates/<?php echo $template; ?>/images/help_icon.gif"  onClick="toggleBox('dbUser');"><br>
      <div id="dbUserSD"><?php echo CONFIG_DATABASE_USERNAME_DESCRIPTION; ?></div>
      <div id="dbUser" class="longDescription"><?php echo CONFIG_DATABASE_USERNAME_DESCRIPTION_LONG; ?></div>
    </td>
  </tr>
  <tr>
    <td width="30%" valign="top"><?php echo CONFIG_DATABASE_PASSWORD; ?></td>
    <td width="70%" class="smallDesc">
      <?php echo osc_draw_password_field('DB_SERVER_PASSWORD'); ?>
      <img src="templates/<?php echo $template; ?>/images/help_icon.gif" onClick="toggleBox('dbPass');"><br>
      <div id="dbPassSD"><?php echo CONFIG_DATABASE_PASSWORD_DESCRIPTION; ?></div>
      <div id="dbPass" class="longDescription"><?php echo CONFIG_DATABASE_PASSWORD_DESCRIPTION_LONG; ?></div>
    </td>
  </tr>
  <tr>
    <td width="30%" valign="top"><?php echo CONFIG_DATABASE_NAME; ?></td>
    <td width="70%" class="smallDesc">
      <?php echo osc_draw_input_field('DB_DATABASE'); ?>
      <img src="templates/<?php echo $template; ?>/images/help_icon.gif" onClick="toggleBox('dbName');"><br>
      <div id="dbNameSD"><?php echo CONFIG_DATABASE_NAME_DESCRIPTION; ?></div>
      <div id="dbName" class="longDescription"><?php echo CONFIG_DATABASE_NAME_DESCRIPTION_LONG; ?></div>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="30%" valign="top"><?php echo CONFIG_DATABASE_PERSISTENT_CONNECTIONS; ?></td>
    <td width="70%" class="smallDesc">
      <?php echo osc_draw_checkbox_field('USE_PCONNECT', 'true'); ?>
      <img src="templates/<?php echo $template; ?>/images/help_icon.gif" onClick="toggleBox('dbConn');"><br>
      <div id="dbConnSD"><?php echo CONFIG_DATABASE_PERSISTENT_CONNECTIONS_DESCRIPTION; ?></div>
      <div id="dbConn" class="longDescription"><?php echo CONFIG_DATABASE_PERSISTENT_CONNECTIONS_DESCRIPTION_LONG; ?></div>
    </td>
  </tr>
  <tr>
    <td width="30%" valign="top"><?php echo CONFIG_SESSION_STORAGE; ?></td>
    <td width="70%" class="smallDesc">
      <?php echo osc_draw_radio_field('STORE_SESSIONS', 'files'); ?>&nbsp;<?php echo CONFIG_SESSION_STORAGE_FILES; ?>&nbsp;&nbsp;<?php echo osc_draw_radio_field('STORE_SESSIONS', 'mysql', true); ?>&nbsp;<?php echo CONFIG_SESSION_STORAGE_DATABASE; ?>&nbsp;&nbsp;
      <img src="templates/<?php echo $template; ?>/images/help_icon.gif" onClick="toggleBox('dbSess');"><br>
      <div id="dbSessSD"><?php echo CONFIG_SESSION_STORAGE_DESCRIPTION; ?></div>
      <div id="dbSess" class="longDescription"><?php echo CONFIG_SESSION_STORAGE_DESCRIPTION_LONG; ?></div>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>

<p>&nbsp;</p>

<table width="95%" border="0" cellspacing="2">
  <tr>
    <td align="right"><input type="image" src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/buttons/continue.gif" border="0" alt="<?php echo IMAGE_BUTTON_CONTINUE; ?>">&nbsp;&nbsp;<a href="index.php"><img src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/buttons/cancel.gif" border="0" alt="<?php echo IMAGE_BUTTON_CANCEL; ?>"></a></td>
  </tr>
</table>

<?php
  foreach ($_POST as $key => $value) {
    if (($key != 'x') && ($key != 'y') && ($key != 'DB_SERVER') && ($key != 'DB_SERVER_USERNAME') && ($key != 'DB_SERVER_PASSWORD') && ($key != 'DB_DATABASE') && ($key != 'DB_DATABASE_CLASS') && ($key != 'DB_TABLE_PREFIX') && ($key != 'USE_PCONNECT') && ($key != 'STORE_SESSIONS') && ($key != 'DB_INSERT_SAMPLE_DATA') && ($key != 'DB_TEST_CONNECTION')) {
      if (is_array($value)) {
        for ($i=0, $n=sizeof($value); $i<$n; $i++) {
          echo osc_draw_hidden_field($key . '[]', $value[$i]);
        }
      } else {
        echo osc_draw_hidden_field($key, $value);
      }
    }
  }

  echo osc_draw_hidden_field('DB_TEST_CONNECTION', 'true');
?>

</form>

<?php
  }
?>
