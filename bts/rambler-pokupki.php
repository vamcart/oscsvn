<?php
 require('includes/application_top.php');

// Set number of columns in listing
define ('NR_COLUMNS', 2);
//
// ������ ������� ������������
//���� �� ���������� IIS, �� ������ ���������� $PHP_AUTH_USER � $PHP_AUTH_PW
/*if (substr($SERVER_SOFTWARE, 0, 9) == "Microsoft" &&
    !isset($PHP_AUTH_USER) &&
    !isset($PHP_AUTH_PW) &&
    substr($HTTP_AUTHORIZATION, 0, 6) == "Basic "
   ) 
{ 
  list($PHP_AUTH_USER, $PHP_AUTH_PW) = 
    explode(":", base64_decode(substr($HTTP_AUTHORIZATION, 6))); 
} 

// ����� �� ����� ����������� ������� �� ���� ������ �� ��� �����
// �������� ���� � ������� if ���� user and pass
if (@$PHP_AUTH_USER != "i4uru" || $PHP_AUTH_PW != "Mysqli4Ur")
{
  // ������������ �� ���� ������ 
  // ��� � ������� �� ����������

  header('WWW-Authenticate: Basic realm="Realm-Name"'); 
  if (substr($SERVER_SOFTWARE, 0, 9) == "Microsoft") 
    header("Status: 401 Unauthorized"); 
  else 
    header("HTTP/1.0 401 Unauthorized"); 

  require('figu_market/figu.html');
} 
else
{
 



// ����� ������������*/
 
echo"<?xml version=\"1.0\" encoding=\"windows-1251\"?>";
// �� ������ ������������ \" ������ " � ��������� ���������� ����������� � "" � \n (������� ������) ����� ������� ����

//������� ���� � �����:
//��������� ���
echo"<yml_catalog date=\"";
// ���������� ������� ���� � ����� �������� date:
echo date('Y-m-d H:i');
//��������� ���
echo"\">\n\n"; 
echo"<shop>\n";
echo"<name> �������</name>\n";
echo"<company>��� \"\"</company>\n";
echo"<url>http://www..ru/</url>\n\n";
// ���������� ����
echo"<currencies>\n";
// ������� �������� � �����

echo"<currency  id=\"RUR\" rate=\"1\"/>\n";
//echo"<currency  id=\"USD\" rate=\"29.30\"/>\n";

// ��� �� �� ����� �������
/*
echo"<currency  id=\"RUR\" rate=\"1\"/>\n";
echo"<currency  id=\"USD\" rate=\"CBRF\" plus=\"2\"/>\n";
*/
echo"</currencies>\n\n";
// ����������� ���������

$arr = array (26 => '��������� ������', 32 => '��������� ������-->��� �����', 33 => '��������� ������-->������� �����-->����� �����');

// ����� ���������

//echo"<deliveryIncluded/>\n";

echo"<offers>\n";

 $languages_query = tep_db_query("select languages_id, name, code, image, directory from " . TABLE_LANGUAGES . " order by sort_order");
	 while ($languages = tep_db_fetch_array($languages_query)) {
		$languages_array[] = array('id'			=> $languages['languages_id'],
					   'name'		=> $languages['name'],
                                 		   'code'		=> $languages['code'],
                                 		   'image'		=> $languages['image'],
                                           'directory'	=> $languages['directory']);
			 }
          	 for ($i=0; $i<(sizeof($languages_array)); $i++) {			 
             	$this_language_id = $languages_array[$i]['id'];
				$this_language_name = $languages_array[$i]['name'];
				$this_language_code = $languages_array[$i]['code'];
				$this_language_image = $languages_array[$i]['image'];
				$this_language_directory = $languages_array[$i]['directory'];

             	$products_query = tep_db_query("SELECT p.products_image, p.products_price, p.products_id, p.products_model, pd.products_info, pd.products_name, pd.products_description,  pc.categories_id FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " pc, " . TABLE_PRODUCTS_DESCRIPTION . " pd WHERE p.products_id = pd.products_id AND p.products_status = 1 AND p.products_to_xml = 1 AND p.products_id = pc.products_id AND pd.language_id = $this_language_id ORDER BY pd.products_name");
				$products_array = array();
				while($products = tep_db_fetch_array($products_query)) {
				   $products_array[] = array('id'   => $products['products_id'],
         						     'name' => $products['products_name'],
                                                             'price' => $products['products_price'],
							     'image' => $products['products_image'],
							     'categories_id' => $products['categories_id'],							     
                                                             'description' => $products['products_description'],
															 'descript_short' => $products['products_info']);
				}
				for ($j=0; $j<NR_COLUMNS; $j++) {
					echo "\n";
					for ($k=$j; $k<sizeof($products_array); $k+=NR_COLUMNS) {
						$this_products_id   = $products_array[$k]['id'];
						$this_products_name = $products_array[$k]['name'];
						$this_products_price = $products_array[$k]['price'];
						$this_products_image = $products_array[$k]['image'];
						$this_categories_id = $products_array[$k]['categories_id'];
//������ ������ �������� ��������, ���� ��� ����������
if ($products_array[$k]['descript_short'] != '') {$this_products_description = $products_array[$k]['descript_short'];} else {
						$this_products_description = substr($products_array[$k]['description'], 0, strlen($products_array[$k]['description'])-strlen (strstr ($products_array[$k]['description'],'<')));};
//����� ������ �������� ��������, ���� ��� ����������
                       //������� ������ �������� ������� ����� ������
                       $from = array('&#34', '&#38', '&#60', '&#62', ' & ', "\r\n");
                       //������� ������ �������� �� ������� ����� ������
                        $to =  array('&quot;', '&amp;', '&lt;', '&gt;', ' &amp; ', ' ');
                        //��� ����� ������� ������ �� ���� (��, ��� ������ print):
                        $str =("<offer id=\"". $this_products_id . "\">\n<url>" . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $this_products_id, 'NONSSL', false) . "</url>\n<price>" . $this_products_price . "</price>\n<currencyId>RUR</currencyId>\n<category>" . $arr[$this_categories_id] . "</category>\n<img>" . tep_href_link(DIR_WS_IMAGES . $this_products_image, '', 'NONSSL', false) . "</img>\n<deliveryIncluded/>\n<title>" . $this_products_name . "</title>\n<descript>" . $this_products_description . "</descript>\n</offer>\n\n");
						// ������� ������
						echo str_replace($from, $to, $str);

					}
					echo "";
				}
			    echo "";
			}

echo"</offers>\n";

echo"</shop>\n";
echo"</yml_catalog>\n";
// ������ ���� ��������� ������� else � �����������
//}
?>