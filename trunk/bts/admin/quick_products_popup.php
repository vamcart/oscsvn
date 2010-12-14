<?php
/*
   WebMakers.com Added: Show current products by categories and attribute option
   Created from:
   quick_deactivate.php v1.1 by mattice@xs4all.nl / http://www.matthijs.org
*/

include('includes/application_top.php');

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title>Список номеров товаров</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">

<script>
<!--
function selectAll(formObj, isInverse)
{
   for (var i=0;i < formObj.length;i++)
   {
      fldObj = formObj.elements[i];
      if (fldObj.type == 'checkbox')
      {
         if(isInverse)
            fldObj.checked = (fldObj.checked) ? false : true;
         else fldObj.checked = true;
       }
   }
}
-->
</script>

<?php /* BOF: WebMakers.com Added: PopUp Window */ ?>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function NewWindow3(mypage, myname, w, h, scroll) {
var winl = (screen.width - w) / 2;
var wint = (screen.height - h) / 2;
winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'
win = window.open(mypage, myname, winprops)
if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}
//  End -->
</script>
<?php /* EOF: WebMakers.com Added: PopUp Window */ ?>

</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<table cellpadding="0" cellspacing="0" border="0" align="center" valign="0" class="none" style="border:none">
  <tr><td class="smallText">
<?php

?>
<br><form method="post" action="quick_products_popup.php">
<?php

   // first select all categories that have 0 as parent:
      $sql = tep_db_query("SELECT c.categories_id, cd.categories_name from categories c, categories_description cd WHERE c.parent_id = 0 AND c.categories_id = cd.categories_id AND cd.language_id = 1");
        echo '<center><b>Выберите категорию</b>'. tep_draw_separator('pixel_trans.gif', '100%', '1') . '</center>' . "\n";
        echo '<table border="0" align="center">' . "\n" . ' ' . ' <tr class="smallText">' . "\n";
        $count_it=0;
        while ($parents = tep_db_fetch_array($sql)) {
          // check if the parent has products
          $check = tep_db_query("SELECT products_id FROM products_to_categories WHERE categories_id = '" . $parents['categories_id'] . "'");
    	    if (tep_db_num_rows($check) > 0) {
            $tree = tep_get_category_tree();
            $dropdown= tep_draw_pull_down_menu('cat_id', $tree, '', 'onChange="this.form.submit();"'); //single
            $all_list = "\n" . '<form method="post" action="quick_products_popup.php"> ' . "\n" . ' ' . ' <td class="smallText" align="left" valign="top" width="115"><B>Все категории:</B><br>' . $dropdown . '</form></td>' . "\n";
          } else {
            // get the tree for that parent
            $tree = tep_get_category_tree($parents['categories_id']);
            // draw a dropdown with it:
            $dropdown = tep_draw_pull_down_menu('cat_id', $tree, '', 'onChange="this.form.submit();"');
            $list .= "\n" . '<form method="post" action="quick_products_popup.php"> '  . "\n" . ' ' . ' <td class="smallText" align="left" valign="top" width="115">' . $parents['categories_name'] . ':<br>' . $dropdown . '</form></td>' . "\n";
          }
            $count_it++;
            if ($count_it > 4) {
              $count_it=0;
              $list .= '</tr>' . "\n" . '<tr class="smallText">';
            }
        }
//       echo $list . $all_list . '</tr></table><p>';
        echo $all_list . $list;

   // see if there is a category ID:

  if ($_POST['cat_id']) {

      // start the table
      echo "\n" . '<form method="post" action="quick_products_popup.php"><table border="0" width="100%"><tr>' . "\n";
       $i = 0;

      // get all active prods in that specific category

       $sql2 = tep_db_query("SELECT p.products_id, p.products_status, p.products_image, pd.products_name from products p, products_description pd, products_to_categories ptc where p.products_id = ptc.products_id and p.products_id = pd.products_id and p.products_status=1 and pd.language_id = '" . $languages_id . "' and ptc.categories_id = '" . $_POST['cat_id'] . "'");

     while ($results = tep_db_fetch_array($sql2)) {
           $i++;
             echo '<td valign="top" class="smallText" align="center">' . tep_image(DIR_WS_CATALOG . DIR_WS_IMAGES . $results['products_image'], $results['products_id'], (SMALL_IMAGE_WIDTH * .50), (SMALL_IMAGE_HEIGHT * .50));
             echo '<br>' . $results['products_name'] . '<br clear="all">Номер товара: <b>' . $results['products_id'];
             $show_attributes='<a href="' . 'quick_attributes_popup.php?look_it_up=' . $results['products_id'] . '&my_languages_id=' . $languages_id . '" onclick="NewWindow3(this.href,\'name3\',\'700\',\'400\',\'yes\');return false;">Смотреть<br>атрибуты</a></font>';
             echo '<P>' . $show_attributes . '</td>' . "\n";
          if ($i == 5) {
               echo '</tr><tr>' . "\n";
               $i =0;
         }
    }
  echo '<input type="hidden" name="cat_id" value="' . $_POST['cat_id'] . '">' . "\n";
  echo '</tr>' . "\n";
  } //if
?>
    </tr></table>
  </td></tr>
</table>

<BR><BR>
<center>
<a href="javascript:window.close()">[ Закрыть окно ]</a>
</center>
<BR><BR>

</body>
</html>
