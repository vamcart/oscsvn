<?php
/*
  $Id: index.php,v 1.5 2004/07/22 20:47:11 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2004 osCommerce

  Released under the GNU General Public License
*/

  $languages_array = array(array('id' => 'russian', 'text' => 'Р СѓСЃСЃРєРёР№'),
                           array('id' => 'english', 'text' => 'English'));
?>

<p class="pageTitle"><?php echo PAGE_TITLE_WELCOME; ?></p>

<form action="index.php" method="get"><p align="right"><?php echo TEXT_CHOOSE_LANGUAGE; ?><?php echo tep_draw_pull_down_menu('language', $languages_array, $language, 'onChange="this.form.submit();"'); ?></p></form>

<table width="95%" class="formPage" cellpadding="2">
  <tr>
    <td><?php echo TEXT_WELCOME; ?></td>
  </tr>
</table>

<p><?php echo TEXT_CHOOSE_INSTALLATION_TYPE; ?></p>

<table border="0" width="95%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" align="center"><a href="install.php"><img src="templates/<?php echo $template; ?>/languages/<?php echo $language; ?>/images/install.gif" border="0" alt="<?php echo IMAGE_INSTALL; ?>"></a></td>
  </tr>
</table>
