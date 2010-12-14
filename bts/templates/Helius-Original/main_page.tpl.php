<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<link rel="shortcut icon" href="favicon.ico" >
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
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

<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_STYLE;?>">
<?php if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT .
basename($javascript))) { require(DIR_WS_JAVASCRIPT .
basename($javascript)); } ?>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- warnings //-->
<?php require(DIR_WS_INCLUDES . 'warnings.php'); ?>
<!-- warning_eof //-->

<!-- header //-->
<?php
// WebMakers.com Added: Down for Maintenance
// Hide header if not to show
if (DOWN_FOR_MAINTENANCE_HEADER_OFF =='false') {

if (SITE_WIDTH!='100%') {
?>
    <table width="100%" cellpadding="10" cellspacing="0" border="0" BGCOLOR="#ffffff">
      <tr><td>
        <table CELLSPACING="2" CELLPADDING="4" BORDER="0" width="<?php echo SITE_WIDTH;?>" align="center" BGCOLOR="FFFFFF">
      <tr>
        <td>
        <table border="0" width="100%" bordercolor="#000000" style="border-collapse: collapse" cellpadding="0" cellspacing="0">
          <tr>
            <td>

<?php
}
?>
            <table width="100%" border="0" cellspacing="0" cellpadding="6">
  <tr>
        <td height="80" bgcolor="#ffffff" background="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME;?>/images/bg_cat4.gif"><a href="index.php"><img src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME;?>/images/oscommerce.gif" border="0" alt="Р