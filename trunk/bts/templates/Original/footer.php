<?php
/*
  $Id: footer.php,v 1.26 2003/02/10 22:30:54 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/



// WebMakers.com Added: Down for Maintenance
// Hide footer.php if not to show
if (DOWN_FOR_MAINTENANCE_FOOTER_OFF =='false') {
  require(DIR_WS_INCLUDES . 'counter.php');
?>
<table border="0" width="100%" cellspacing="0" cellpadding="1">
  <tr class="footer">
    <td class="footer">&nbsp;&nbsp;<?php echo strftime(DATE_FORMAT_LONG); ?>&nbsp;&nbsp;</td>
    <td align="right" class="footer">&nbsp;&nbsp;<?php echo $counter_now . ' ' . FOOTER_TEXT_REQUESTS_SINCE . ' ' . $counter_startdate_formatted; ?>&nbsp;&nbsp;</td>
  </tr>
</table>
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="smallText">

<!-- footer //-->
<br>
<!--Counters-->
<br>
<center>
<span class="smallText">
<?php require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/counters.txt'); ?>
</span>
</center>
<br>
<!--/Counters-->
<?php echo FOOTER_TEXT_BODY; ?> 
<br>
<center>
<span class="smallText">
<?php if (DISPLAY_PAGE_PARSE_TIME == 'true') { ?>
<?php echo TOTAL_QUERIES . $query_counts; ?>
<br>
<?php echo TOTAL_TIME . $query_total_time; ?>
<?php } ?>
</span>
</center>

<!-- footer_eof //-->


    </td>
  </tr>
</table>
<?php
}
  if ($banner = tep_banner_exists('dynamic', '468x50')) {
?>
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  </tr>
</table>
<?php
  }
?>


<!-- footer_eof //-->
