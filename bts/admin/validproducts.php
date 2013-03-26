<?php
/*
  $Id: validproducts.php,v 0.01 2002/08/17 15:38:34 Richard Fielder

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  

  Copyright (c) 2002 Richard Fielder

  Released under the GNU General Public License
*/

require('includes/application_top.php');


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title>Список товаров</title>
<style type="text/css">
<!--
h4 {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; text-align: center}
p {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small}
th {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small}
td {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small}
-->
</style>
<head>
<body>
<table width="550" border="1" cellspacing="1" bordercolor="gray">
<tr>
<td colspan="3">
<h4><?php echo TEXT_VALID_PRODUCTS_LIST; ?></h4>
</td>
</tr>
<?php
    echo "<tr><th>". TEXT_VALID_PRODUCTS_ID . "</th><th>" . TEXT_VALID_PRODUCTS_NAME . "</th></tr><tr>";
    $result = tep_db_query("SELECT * FROM products, products_description WHERE products.products_id = products_description.products_id and products_description.language_id = '" . $languages_id . "' ORDER BY products_description.products_name");
    if ($row = tep_db_fetch_array($result)) {
        do {
            echo "<td>".$row["products_id"]."</td>\n";
            echo "<td>".$row["products_name"]."</td>\n";
            echo "</tr>\n";
        }
        while($row = tep_db_fetch_array($result));
    }
    echo "</table>\n";
?>
<br>
<table width="550" border="0" cellspacing="1">
<tr>
<td align=middle><input type="button" value="Закрыть окно" onClick="window.close()"></td>
</tr></table>
</body>
</html>