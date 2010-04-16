<?php
/*
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2005 osCommerce

  Released under the GNU General Public License
  
  @Author: Raphael Vullriede (osc@rvdesign.de)
*/

  // XML-Specification: https://www.google.com/webmasters/sitemaps/docs/de/protocol.html

require('includes/application_top.php');

  define('CHANGEFREQ_CATEGORIES', 'weekly');  // Valid values are "always", "hourly", "daily", "weekly", "monthly", "yearly" and "never".
  define('CHANGEFREQ_PRODUCTS', 'daily'); // Valid values are "always", "hourly", "daily", "weekly", "monthly", "yearly" and "never".

  define('PRIORITY_CATEGORIES', '1.0');
  define('PRIORITY_PRODUCTS', '0.5');

  define('MAX_ENTRYS', 50000);
  define('MAX_SIZE', 10000000);

  define('SITEMAPINDEX_HEADER', "<?xml version='1.0' encoding='UTF-8'?>"."\n".'<sitemapindex xmlns="http://www.google.com/schemas/sitemap/0.84"'."\n".'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'."\n".'xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84'."\n".'http://www.google.com/schemas/sitemap/0.84/siteindex.xsd">'."\n");
  define('SITEMAPINDEX_FOOTER', '</sitemapindex>');
  define('SITEMAPINDEX_ENTRY', "\t".'<sitemap>'."\n\t\t".'<loc>%s</loc>'."\n\t\t".'<lastmod>%s</lastmod>'."\n\t".'</sitemap>'."\n");

  define('SITEMAP_HEADER', "<?xml version='1.0' encoding='UTF-8'?>"."\n".'<urlset xmlns="http://www.google.com/schemas/sitemap/0.84"'."\n".'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'."\n".'xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84'."\n".'http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">'."\n");
  define('SITEMAP_FOOTER', '</urlset>');
  define('SITEMAP_ENTRY', "\t".'<url>'."\n\t\t".'<loc>%s</loc>'."\n\t\t".'<priority>%s</priority>'."\n\t\t".'<lastmod>%s</lastmod>'."\n\t\t".'<changefreq>%s</changefreq>'."\n\t".'</url>'."\n");


  $usegzip        = false;
  $autogenerate   = false;
  $output_to_file = false;
  $notify_google  = false;
  $notify_url     = '';

  // request over http or command line?
  if (!isset($_SERVER['SERVER_PROTOCOL'])) {

    if (count($_SERVER['argv'] > 1)) {
      
      // option p ist only possible of min 1 more option isset
      if ( (strlen($_SERVER['argv'][1]) >= 2) && strpos($_SERVER['argv'][1], 'p') !== true) {
        $notify_google = true;
        $_SERVER['argv'][1] = str_replace('p', '', $_SERVER['argv'][1]);
      }
      
      switch($_SERVER['argv'][1]) {
      
        // dump to file
        case '-f':
          $output_to_file = true;
          $filename = $_SERVER['argv'][2];
          break;
          
        // dump to compressed file
        case '-zf':
          $usegzip        = true;
          $output_to_file = true;
          $filename = $_SERVER['argv'][2];
          break;
          
        // autogenerate sitemaps. useful for sites with more the 500000 Urls
        case '-a':
          $autogenerate = true;
          break;
          
        // autogenerate sitemaps and use gzip
        case '-za':
          $autogenerate   = true;
          $usegzip        = true;
          break;
      }
    }
  } else {

    if (count($_GET) > 0) {

      // dump to file
      if (isset($_GET['f'])) {
        $output_to_file = true;
        $filename = $_GET['f'];
      }
      // use gzip
      $usegzip = (isset($_GET['gzip']) && $_GET['gzip'] == true) ? true : false;
      
      // autogenerate sitemaps
      $autogenerate = (isset($_GET['auto']) && $_GET['auto'] == true) ? true : false;
      
      // notify google
      $notify_google = (isset($_GET['ping']) && $_GET['ping'] == true) ? true : false;
    }
  }

  // use gz... functions for compressed files
  if ($usegzip) {
    $function_open  = 'gzopen';
    $function_close = 'gzclose';
    $function_write = 'gzwrite';
    
    $file_extension = '.xml.gz';
  } else {
    $function_open  = 'fopen';
    $function_close = 'fclose';
    $function_write = 'fwrite';
    
    $file_extension = '.xml';
  }

  // < PHP5
  if (!function_exists('file_put_contents')) {
  
    function file_put_contents($filename, $content) {
    
      $fp = fopen($filename, 'w');
      fwrite($fp, $content);
      fclose($fp);
    }
  }

  // < PHP5
  function iso8601_date($timestamp) {
  
    if (PHP_VERSION < 5) {
       $tzd = date('O',$timestamp);
       $tzd = substr(chunk_split($tzd, 3, ':'),0,6);
       return date('Y-m-d\TH:i:s', $timestamp) . $tzd;
    } else {
      return date('c', $timestamp);
    }
  }

  // generates cPath with helper array
  function rv_get_path($cat_id, $code) {
    global $cat_array;
    
    $my_cat_array = array($cat_id);
    
    while($cat_array[$cat_id][$code]['parent_id'] != 0) {
      $my_cat_array[] = $cat_array[$cat_id][$code]['parent_id'];
      $cat_id = $cat_array[$cat_id][$code]['parent_id'];
    }
    
    return 'cPath='.implode('_', array_reverse($my_cat_array));
  }


  function output($string) {
    global $function_open, $function_close, $function_write, $output_to_file, $fp, $autogenerate;
    
    if ($output_to_file || $autogenerate) {
      $function_write($fp, $string);
    } else {
      echo $string;
    }
  }

  $c = 0;
  $i = 1;

  if ($autogenerate) {
    $fp = $function_open('sitemap'.$i.$file_extension, 'w');
    $notify_url = HTTP_SERVER.DIR_WS_HTTP_CATALOG.'sitemap'.$i.$file_extension;
  } else {
    if ($output_to_file) {
      $fp = $function_open($filename, 'w');
      $notify_url = HTTP_SERVER.DIR_WS_HTTP_CATALOG.'sitemap'.$i.$file_extension;
    } 
  }


  output(SITEMAP_HEADER);
  $strlen = strlen(SITEMAP_HEADER);


  $cat_result = tep_db_query("
    SELECT
      c.categories_id,
      c.parent_id,
      cd.language_id,
      UNIX_TIMESTAMP(c.date_added) as date_added,
      UNIX_TIMESTAMP(c.last_modified) as last_modified,
      l.code
    FROM 
      ".TABLE_CATEGORIES." c,
      ".TABLE_CATEGORIES_DESCRIPTION." cd,
      ".TABLE_LANGUAGES." l
    WHERE
      c.categories_id = cd.categories_id AND
      cd.language_id = l.languages_id
    ORDER by 
      cd.categories_id
  ");

  $cat_array = array();
  if (tep_db_num_rows($cat_result) > 0) {
    while($cat_data = tep_db_fetch_array($cat_result)) {
      $cat_array[$cat_data['categories_id']][$cat_data['code']] = $cat_data;
    }
  }
  reset($cat_array);


  foreach($cat_array as $lang_array) {
    foreach($lang_array as $cat_id => $cat_data) {
    
      $lang_param = ($cat_data['code'] != DEFAULT_LANGUAGE) ? '&language='.$cat_data['code'] : '';
      $date = ($cat_data['last_modified'] != NULL) ? $cat_data['last_modified'] : $cat_data['date_added'];

      $string = sprintf(SITEMAP_ENTRY, htmlspecialchars(utf8_encode(tep_href_link(FILENAME_DEFAULT, rv_get_path($cat_data['categories_id'], $cat_data['code']).$lang_param, 'NONSSL', false, SEARCH_ENGINE_FRIENDLY_URLS))) ,PRIORITY_CATEGORIES, iso8601_date($date), CHANGEFREQ_CATEGORIES);
      
      output($string);
      $strlen += strlen($string);
      
      $c++;
      if ($autogenerate) {
        // 500000 entrys or filesize > 10,485,760 - some space for the last entry
        if ( $c == MAX_ENTRYS || $strlen >= MAX_SIZE) {
          output(SITEMAP_FOOTER);
          $function_close($fp);
          $c = 0;
          $i++;
          $fp = $function_open('sitemap'.$i.$file_extension, 'w');
          output(SITEMAP_HEADER);
          $strlen = strlen(SITEMAP_HEADER);
        }
      }
    }
  }


  $product_result = tep_db_query("
    SELECT
      p.products_id,
      pd.language_id,
      UNIX_TIMESTAMP(p.products_date_added) as products_date_added,
      UNIX_TIMESTAMP(p.products_last_modified) as products_last_modified,
      l.code
    FROM
      ".TABLE_PRODUCTS." p, 
      ".TABLE_PRODUCTS_DESCRIPTION." pd,
      ".TABLE_LANGUAGES." l
    WHERE
      p.products_status='1' AND
      p.products_id = pd.products_id AND
      pd.language_id = l.languages_id
    ORDER BY
      p.products_id
  ");

  if (tep_db_num_rows($product_result) > 0) {
    while($product_data = tep_db_fetch_array($product_result)) {
    
      $lang_param = ($product_data['code'] != DEFAULT_LANGUAGE) ? '&language='.$product_data['code'] : '';
      $date = ($product_data['products_last_modified'] != NULL) ? $product_data['products_last_modified'] : $product_data['products_date_added'];
      
      $string = sprintf(SITEMAP_ENTRY, htmlspecialchars(utf8_encode(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id='.$product_data['products_id'].$lang_param, 'NONSSL', false, SEARCH_ENGINE_FRIENDLY_URLS))) , PRIORITY_PRODUCTS, iso8601_date($date), CHANGEFREQ_PRODUCTS);
      
      output($string);
      $strlen += strlen($string);
      
      $c++;
      if ($autogenerate) {
        // 500000 entrys or filesize > 10,485,760 - some space for the last entry
        if ( $c == MAX_ENTRYS || $strlen >= MAX_SIZE) {
          output(SITEMAP_FOOTER);
          $function_close($fp);
          $c = 0;
          $i++;
          $fp = $function_open('sitemap'.$i.$file_extension, 'w');
          output(SITEMAP_HEADER);
          $strlen = strlen(SITEMAP_HEADER);
        }
      }
    }
  }

  $product_result = tep_db_query("
    SELECT
      a.articles_id,
      ad.articles_name,
      ad.language_id,
      UNIX_TIMESTAMP(a.articles_date_added) as articles_date_added,
      UNIX_TIMESTAMP(a.articles_last_modified) as articles_last_modified,
      l.code
    FROM
      ".TABLE_ARTICLES." a, 
      ".TABLE_ARTICLES_DESCRIPTION." ad,
      ".TABLE_LANGUAGES." l
    WHERE ad.language_id = '".(int)$languages_id."' and 
      a.articles_status='1' AND
      a.articles_id = ad.articles_id AND
      ad.language_id = l.languages_id
    ORDER BY
      a.articles_id
  ");

  if (tep_db_num_rows($product_result) > 0) {
    while($product_data = tep_db_fetch_array($product_result)) {
    
      $lang_param = ($product_data['code'] != DEFAULT_LANGUAGE) ? '&language='.$product_data['code'] : '';
      $date = ($product_data['articles_last_modified'] != NULL) ? $product_data['articles_last_modified'] : $product_data['articles_date_added'];
      
      $string = sprintf(SITEMAP_ENTRY, htmlspecialchars(utf8_encode(tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id='.$product_data['articles_id']))) , PRIORITY_PRODUCTS, iso8601_date($date), CHANGEFREQ_PRODUCTS);
      
      output($string);
      $strlen += strlen($string);
      
      $c++;
      if ($autogenerate) {
        // 500000 entrys or filesize > 10,485,760 - some space for the last entry
        if ( $c == MAX_ENTRYS || $strlen >= MAX_SIZE) {
          output(SITEMAP_FOOTER);
          $function_close($fp);
          $c = 0;
          $i++;
          $fp = $function_open('sitemap'.$i.$file_extension, 'w');
          output(SITEMAP_HEADER);
          $strlen = strlen(SITEMAP_HEADER);
        }
      }
    }
  }

  $product_result = tep_db_query("
    SELECT
      p.pages_id,
      pd.pages_name,
      pd.language_id,
      UNIX_TIMESTAMP(p.pages_date_added) as date_added,
      UNIX_TIMESTAMP(p.pages_last_modified) as last_modified,
      l.code
    FROM
      ".TABLE_PAGES." p, 
      ".TABLE_PAGES_DESCRIPTION." pd,
      ".TABLE_LANGUAGES." l
    WHERE pd.language_id = '".(int)$languages_id."' and 
      p.pages_status='1' AND
      p.pages_id = pd.pages_id AND
      pd.language_id = l.languages_id
    ORDER BY
      p.pages_id
  ");

  if (tep_db_num_rows($product_result) > 0) {
    while($product_data = tep_db_fetch_array($product_result)) {
    
      $lang_param = ($product_data['code'] != DEFAULT_LANGUAGE) ? '&language='.$product_data['code'] : '';
      $date = ($product_data['last_modified'] != NULL) ? $product_data['last_modified'] : $product_data['date_added'];
      
      $string = sprintf(SITEMAP_ENTRY, htmlspecialchars(utf8_encode(tep_href_link(FILENAME_INFORMATION, 'pages_id='.$product_data['pages_id']))) , PRIORITY_PRODUCTS, iso8601_date($date), CHANGEFREQ_PRODUCTS);
      
      output($string);
      $strlen += strlen($string);
      
      $c++;
      if ($autogenerate) {
        // 500000 entrys or filesize > 10,485,760 - some space for the last entry
        if ( $c == MAX_ENTRYS || $strlen >= MAX_SIZE) {
          output(SITEMAP_FOOTER);
          $function_close($fp);
          $c = 0;
          $i++;
          $fp = $function_open('sitemap'.$i.$file_extension, 'w');
          output(SITEMAP_HEADER);
          $strlen = strlen(SITEMAP_HEADER);
        }
      }
    }
  }

  $product_result = tep_db_query("
    SELECT
      n.newsdesk_id,
      nd.newsdesk_article_name,
      nd.language_id,
      UNIX_TIMESTAMP(n.newsdesk_date_added) as date_added,
      UNIX_TIMESTAMP(n.newsdesk_last_modified) as last_modified,
      l.code
    FROM
      ".TABLE_NEWSDESK." n, 
      ".TABLE_NEWSDESK_DESCRIPTION." nd,
      ".TABLE_LANGUAGES." l
    WHERE nd.language_id = '".(int)$languages_id."' and 
      n.newsdesk_status='1' AND
      n.newsdesk_id = nd.newsdesk_id AND
      nd.language_id = l.languages_id
    ORDER BY
      n.newsdesk_id
  ");

  if (tep_db_num_rows($product_result) > 0) {
    while($product_data = tep_db_fetch_array($product_result)) {
    
      $lang_param = ($product_data['code'] != DEFAULT_LANGUAGE) ? '&language='.$product_data['code'] : '';
      $date = ($product_data['last_modified'] != NULL) ? $product_data['last_modified'] : $product_data['date_added'];
      
      $string = sprintf(SITEMAP_ENTRY, htmlspecialchars(utf8_encode(tep_href_link(FILENAME_NEWSDESK_INFO, 'newsdesk_id='.$product_data['newsdesk_id']))) , PRIORITY_PRODUCTS, iso8601_date($date), CHANGEFREQ_PRODUCTS);
      
      output($string);
      $strlen += strlen($string);
      
      $c++;
      if ($autogenerate) {
        // 500000 entrys or filesize > 10,485,760 - some space for the last entry
        if ( $c == MAX_ENTRYS || $strlen >= MAX_SIZE) {
          output(SITEMAP_FOOTER);
          $function_close($fp);
          $c = 0;
          $i++;
          $fp = $function_open('sitemap'.$i.$file_extension, 'w');
          output(SITEMAP_HEADER);
          $strlen = strlen(SITEMAP_HEADER);
        }
      }
    }
  }

  $product_result = tep_db_query("
    SELECT
      f.faqdesk_id,
      fd.faqdesk_question,
      fd.language_id,
      UNIX_TIMESTAMP(f.faqdesk_date_added) as date_added,
      UNIX_TIMESTAMP(f.faqdesk_last_modified) as last_modified,
      l.code
    FROM
      ".TABLE_FAQDESK." f, 
      ".TABLE_FAQDESK_DESCRIPTION." fd,
      ".TABLE_LANGUAGES." l
    WHERE fd.language_id = '".(int)$languages_id."' and 
      f.faqdesk_status='1' AND
      f.faqdesk_id = fd.faqdesk_id AND
      fd.language_id = l.languages_id
    ORDER BY
      f.faqdesk_id
  ");

  if (tep_db_num_rows($product_result) > 0) {
    while($product_data = tep_db_fetch_array($product_result)) {
    
      $lang_param = ($product_data['code'] != DEFAULT_LANGUAGE) ? '&language='.$product_data['code'] : '';
      $date = ($product_data['last_modified'] != NULL) ? $product_data['last_modified'] : $product_data['date_added'];
      
      $string = sprintf(SITEMAP_ENTRY, htmlspecialchars(utf8_encode(tep_href_link(FILENAME_FAQDESK_INFO, 'faqdesk_id='.$product_data['faqdesk_id']))) , PRIORITY_PRODUCTS, iso8601_date($date), CHANGEFREQ_PRODUCTS);
      
      output($string);
      $strlen += strlen($string);
      
      $c++;
      if ($autogenerate) {
        // 500000 entrys or filesize > 10,485,760 - some space for the last entry
        if ( $c == MAX_ENTRYS || $strlen >= MAX_SIZE) {
          output(SITEMAP_FOOTER);
          $function_close($fp);
          $c = 0;
          $i++;
          $fp = $function_open('sitemap'.$i.$file_extension, 'w');
          output(SITEMAP_HEADER);
          $strlen = strlen(SITEMAP_HEADER);
        }
      }
    }
  }

  output(SITEMAP_FOOTER);
  if ($output_to_file || $autogenerate) {
    $function_close($fp);
  }

  // generates sitemap-index file
  if ($autogenerate && $i > 1) {
    $notify_url = HTTP_SERVER.DIR_WS_HTTP_CATALOG.'sitemap_index'.$file_extension;
    $fp = $function_open('sitemap_index'.$file_extension, 'w');
    $function_write($fp, SITEMAPINDEX_HEADER);
    for($ii=1; $ii<=$i; $ii++) {
      $function_write($fp, sprintf(SITEMAPINDEX_ENTRY, HTTP_SERVER.DIR_WS_HTTP_CATALOG.'sitemap'.$ii.$file_extension, iso8601_date(time())));
    }
    $function_write($fp, SITEMAPINDEX_FOOTER);
    $function_close($fp);
  }

  if ($notify_google) {
    fopen('http://www.google.com/webmasters/sitemaps/ping?sitemap='.urlencode($notify_url), 'r');
  }


?>