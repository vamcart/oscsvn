<?php
  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_SEARCH);


 $akeywords = '';
    if (isset($_GET['akeywords'])) {
      $akeywords = $_GET['akeywords'];
    }
         

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ADVANCED_SEARCH));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, tep_get_all_get_params(), 'NONSSL', true, false));

  $content = CONTENT_ARTICLE_SEARCH;
  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);
  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>
