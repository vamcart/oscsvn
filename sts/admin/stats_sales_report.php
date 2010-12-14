<?php
/*
  $Id: stats_sales_report.php,v 1.3 2002/11/27 19:02:22 cwi Exp $

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  // default view (daily)
  $sales_report_default_view = 2;
  // report views (1: hourly 2: daily 3: weekly 4: monthly 5: yearly)
  $sales_report_view = $sales_report_default_view;
  if ( ($_GET['report']) && (tep_not_null($_GET['report'])) ) {
    $sales_report_view = $_GET['report'];
  }
  if ($sales_report_view > 5) {
    $sales_report_view = $sales_report_default_view;
  }
	else {
    $report = $sales_report_view;
  }

  switch( $report ) {
  	case 1:
    	$summary1 = AVERAGE_HOURLY_TOTAL;
    	$summary2 = TODAY_TO_DATE;
    	$report_desc = REPORT_TYPE_HOURLY;
    	break;
    	
  	case 2:
    	$summary1 = AVERAGE_DAILY_TOTAL;
    	$summary2 = WEEK_TO_DATE;
    	$report_desc = REPORT_TYPE_DAILY;
    	break;
    	
  	case 3:
     $summary1 = AVERAGE_WEEKLY_TOTAL;
     $summary2 = MONTH_TO_DATE;
     $report_desc = REPORT_TYPE_WEEKLY;
     break;
     
 	 case 4:
  	$summary1 = AVERAGE_MONTHLY_TOTAL;
    $summary2 = YEAR_TO_DATE;
    $report_desc = REPORT_TYPE_MONTHLY;
    break;
    
  	case 5:
    	$summary1 = AVERAGE_YEARLY_TOTAL;
    	$summary2 = YEARLY_TOTAL;
    	$report_desc = REPORT_TYPE_YEARLY;
    	break;
  }

  // check start and end Date
  $startDate = "";
  if ( ($_GET['startDate']) && (tep_not_null($_GET['startDate'])) ) {
    $startDate = $_GET['startDate'];
  }
  $endDate = "";
  if ( ($_GET['endDate']) && (tep_not_null($_GET['endDate'])) ) {
    $endDate = $_GET['endDate'];
  }

  // check filters
  if (($_GET['filter']) && (tep_not_null($_GET['filter']))) {
    $sales_report_filter = $_GET['filter'];
    $sales_report_filter_link = "&filter=$sales_report_filter";
  }

  require(DIR_WS_CLASSES . 'sales_report.php');
  $report = new sales_report($sales_report_view, $startDate, $endDate, $sales_report_filter);

  if (strlen($sales_report_filter) == 0) {
    $sales_report_filter = $report->filter;
    $sales_report_filter_link = "";
  }

?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="content-type" content="text/html; charset=CP1251">
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title> 
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">

<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td class="boxCenter" width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
    
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>

			<table border="0" width="100%" cellspacing="0" cellpadding="2">
			    <tr>
					<td colspan=2>
						<table border="0" width="100%" cellspacing="0" cellpadding="0">
							<tr>
<td align="right">
<?php
  echo '<a href="' . tep_href_link(FILENAME_STATS_SALES_REPORT, 'report=1' . $sales_report_filter_link, 'NONSSL') . '">' . REPORT_TYPE_HOURLY .'</a> | ';
  echo '<a href="' . tep_href_link(FILENAME_STATS_SALES_REPORT, 'report=2' . $sales_report_filter_link, 'NONSSL') . '">' . REPORT_TYPE_DAILY .'</a> | ';
  echo '<a href="' . tep_href_link(FILENAME_STATS_SALES_REPORT, 'report=3' . $sales_report_filter_link, 'NONSSL') . '">' . REPORT_TYPE_WEEKLY . '</a> | ';
  echo '<a href="' . tep_href_link(FILENAME_STATS_SALES_REPORT, 'report=4' . $sales_report_filter_link, 'NONSSL') . '">' . REPORT_TYPE_MONTHLY . '</a> | ';
  echo '<a href="' . tep_href_link(FILENAME_STATS_SALES_REPORT, 'report=5' . $sales_report_filter_link, 'NONSSL') . '">' . REPORT_TYPE_YEARLY . '</a>';
?>
</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

<?php
  if (ENABLE_TABS == 'true') { 
?>
		<script type="text/javascript">
			$(function(){
				$('#tabs').tabs({ fx: { opacity: 'toggle', duration: 'fast' } });
			});
		</script>
<?php } ?>
			
<div id="tabs">
				
			<ul>
				<li><a href="#chart"><?php echo TAB_CHART; ?></a></li>
				<li><a href="#table"><?php echo TAB_TABLE; ?></a></li>
				<li><a href="#status"><?php echo TAB_STATUS; ?></a></li>
			</ul>

        <div id="chart">
			<table border="0" width="95%" cellspacing="0" cellpadding="2">
				<tr>
					<td valign="top" width="95%" align="center">
<?php
include(DIR_WS_CLASSES . 'ofc-library/open_flash_chart_object.php');
open_flash_chart_object( '100%', 250, tep_href_link('chart_data.php', tep_get_all_get_params(), 'NONSSL'), false );
?>
					</td>
				</tr>
<?php
  if (strlen($report->previous . " " . $report->next) > 1) {
?>
										<tr>
											<td width=100% colspan=5>
												<table width=100%>
													<tr>
														<td align=left>
<?php
    if (strlen($report->previous) > 0) {
      echo '<a href="' . tep_href_link(FILENAME_STATS_SALES_REPORT, $report->previous, 'NONSSL') . '">&lt;&lt;&nbsp;' . TEXT_PREVIOUS . '</a>';
    }
?>
														</td>
										                <td align=right>
<?php
    if (strlen($report->next) > 0) {
      echo '<a href="' . tep_href_link(FILENAME_STATS_SALES_REPORT, $report->next, 'NONSSL') . '">' . TEXT_NEXT . '&nbsp;&gt;&gt;</a>';
      echo "";
    }
?>
														</td>
													</tr>
												</table>
											</td>
										</tr>
<?php
  }
?>				
          </table>
        </div>				

        <div id="table">
			<table border="0" width="98%" cellspacing="0" cellpadding="2">
				<tr>
					<td valign="top" width="100%" align="center">
				
									<table border="0" width="100%" cellspacing="0" cellpadding="2">
										<tr class="dataTableHeadingRow">
											<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DATE; ?></td>
											<td class="dataTableHeadingContent" align=center><?php echo TABLE_HEADING_STAT_ORDERS; ?></td>
											<td class="dataTableHeadingContent" align=right><?php echo TABLE_HEADING_CONV_PER_ORDER; ?></td>
											<td class="dataTableHeadingContent" align=right><?php echo TABLE_HEADING_CONVERSION; ?></td>
											<td class="dataTableHeadingContent" align=right><?php echo TABLE_HEADING_VARIANCE; ?></td>
										</tr>
<?php

  $last_value = 0;
  $sum = 0;
  for ($i = 0; $i < $report->size; $i++) {
    if ($last_value != 0) {
      $percent = 100 * $report->info[$i]['sum'] / $last_value - 100;
    } else {
      $percent = "0";
    }
    $sum += $report->info[$i]['sum'];
    $avg += $report->info[$i]['avg'];
    $last_value = $report->info[$i]['sum'];
?>
										<tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='hand'" onmouseout="this.className='dataTableRow'">
							                <td class="dataTableContent">
<?php
    if (strlen($report->info[$i]['link']) > 0 ) {
      echo '<a href="' . tep_href_link(FILENAME_STATS_SALES_REPORT, $report->info[$i]['link'], 'NONSSL') . '">';
    }
    echo $report->info[$i]['text'] . $date_text[$i];
    if (strlen($report->info[$i]['link']) > 0 ) {
      echo '</a>';
    }
?></td>
											<td class="dataTableContent" align=center><?php echo $report->info[$i]['count']?></td>
											<td class="dataTableContent"align=right><?php echo $currencies->format($report->info[$i]['avg'])?></td>
											<td class="dataTableContent" align=right><?php echo $currencies->format($report->info[$i]['sum'])?></td>
											<td class="dataTableContent" align=right>
<?php
    if ($percent == 0){
      echo "---";
    } else {
      echo number_format($percent,0) . "%";
    }
?>
</td>
										</tr>
<?php
 }
?>

<?php
  if (strlen($report->previous . " " . $report->next) > 1) {
?>
										<tr>
											<td width=100% colspan=5>
												<table width=100%>
													<tr>
														<td align=left>
<?php
    if (strlen($report->previous) > 0) {
      echo '<a href="' . tep_href_link(FILENAME_STATS_SALES_REPORT, $report->previous, 'NONSSL') . '">&lt;&lt;&nbsp;' . TEXT_PREVIOUS . '</a>';
    }
?>
														</td>
										                <td align=right>
<?php
    if (strlen($report->next) > 0) {
      echo '<a href="' . tep_href_link(FILENAME_STATS_SALES_REPORT, $report->next, 'NONSSL') . '">' . TEXT_NEXT . '&nbsp;&gt;&gt;</a>';
      echo "";
    }
?>
														</td>
													</tr>
												</table>
											</td>
										</tr>
<?php
  }
?>

                  </table>
                 
                  <table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php if ($order_cnt != 0){
?>
                    <tr class="dataTableRow">
                      <td class="dataTableContent" width=100% align=right><?php echo '<b>'. AVERAGE_ORDER . ' </b>' ?></td>
                      <td class="dataTableContent" align=right><?php echo $currencies->format($sum / $order_cnt) ?></td>
                    </tr>
<?php } 
  if ($report->size != 0) {
?>
                    <tr class="dataTableRow">
                      <td class="dataTableContent" width=100% align=right><?php echo '<b>'. $summary1 . ' </b>' ?></td>
                      <td class="dataTableContent" align=right><?php echo $currencies->format($sum / $report->size) ?></td>
                    </tr>
<?php } ?>
                    <tr class="dataTableRow">
                      <td class="dataTableContent" width=100% align=right><?php echo '<b>'. $summary2 . ' </b>' ?></td>
                      <td class="dataTableContent" align=right><?php echo $currencies->format($sum) ?></td>
                    </tr>
                  </table>
             
</td>
</tr>
</table>
             
                </div>                  

        <div id="status">
			<table border="0" width="98%" cellspacing="0" cellpadding="2">
				<tr>
					<td valign="top" width="100%" align="center">

                  <table border="0" width="100%" cellspacing="0" cellpadding="2">
                    <tr class="dataTableRow">
                      <td class="dataTableContent" align="left" width="100%"><?php echo FILTER_STATUS  ?></td>
                      <td class="dataTableContent" align="center"><?php echo FILTER_VALUE ?></td>
                    </tr>
<?php
  if (($sales_report_filter) == 0) {
    for ($i = 0; $i < $report->status_available_size; $i++) {
      $sales_report_filter .= "0";
    }
  }

  for ($i = 0; $i < $report->status_available_size; $i++) {
?>
                    <tr>
                      <td class="dataTableContent" align="left"><?php echo $report->status_available[$i]['value'] ?></a></td>
<?php
    if (substr($sales_report_filter,$i,1) ==  "0") {
      $tmp = substr($sales_report_filter, 0, $i) . "1" . substr($sales_report_filter, $i+1, $report->status_available_size - ($i + 1));

      $tmp = tep_href_link(FILENAME_STATS_SALES_REPORT, $report->filter_link . "&filter=". $tmp, 'NONSSL');
?>
      <td class="dataTableContent"  align="center"><?php echo tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) ?>&nbsp;<a href="<?php echo $tmp; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) ?></a></td>
<?php
    } else {
      $tmp = substr($sales_report_filter, 0, $i) . "0" . substr($sales_report_filter, $i+1);
      $tmp = tep_href_link(FILENAME_STATS_SALES_REPORT, $report->filter_link . "&filter=". $tmp, 'NONSSL');
?>
      <td class="dataTableContent" width="100%" align="center"><a href="<?php echo $tmp; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) ?></a>&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) ?></td>
<?php
    }
?>
                    </tr>
<?php
  }
?>
                  </table>

</td>
</tr>
</table>

               </div>
</div>


    </td></table>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>