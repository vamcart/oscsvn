# osCommerce, Open Source E-Commerce Solutions
# http://www.oscommerce.com
#
# Database Backup For �������� ��������
# Copyright (c) 2007 �������� ��������
#
# Database: sborka
# Database Server: localhost
#
# Backup Date: 03/06/2007 14:42:33

drop table if exists address_book;
create table address_book (
  address_book_id int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  entry_gender char(1) not null ,
  entry_company varchar(32) ,
  entry_firstname varchar(32) not null ,
  entry_lastname varchar(32) not null ,
  entry_street_address varchar(64) not null ,
  entry_suburb varchar(32) ,
  entry_postcode varchar(10) not null ,
  entry_city varchar(32) not null ,
  entry_state varchar(32) ,
  entry_country_id int(11) default '0' not null ,
  entry_zone_id int(11) default '0' not null ,
  PRIMARY KEY (address_book_id),
  KEY idx_address_book_customers_id (customers_id)
);

drop table if exists address_format;
create table address_format (
  address_format_id int(11) not null auto_increment,
  address_format varchar(128) not null ,
  address_summary varchar(48) not null ,
  PRIMARY KEY (address_format_id)
);

insert into address_format (address_format_id, address_format, address_summary) values ('1', '$firstname $lastname$cr$city$cr$streets, $postcode$cr$statecomma$country', '$city / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('2', '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country', '$city, $state / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('3', '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country', '$state / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('4', '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('5', '$firstname $lastname$cr$streets$cr$postcode $city$cr$country', '$city / $country');
drop table if exists admin;
create table admin (
  admin_id int(11) not null auto_increment,
  admin_groups_id int(11) ,
  admin_firstname varchar(32) not null ,
  admin_lastname varchar(32) ,
  admin_email_address varchar(96) not null ,
  admin_password varchar(40) not null ,
  admin_created datetime ,
  admin_modified datetime default '0000-00-00 00:00:00' not null ,
  admin_logdate datetime ,
  admin_lognum int(11) default '0' not null ,
  admin_cat_access text ,
  admin_right_access text ,
  PRIMARY KEY (admin_id),
  UNIQUE admin_email_address (admin_email_address)
);

insert into admin (admin_id, admin_groups_id, admin_firstname, admin_lastname, admin_email_address, admin_password, admin_created, admin_modified, admin_logdate, admin_lognum, admin_cat_access, admin_right_access) values ('1', '1', 'Default', 'Admin', 'admin@localhost.com', '1060bdf4e47bc8b4ab3fb0cfea9ef70b:77', '2003-07-17 11:35:03', '2004-03-20 18:07:39', '2007-06-03 14:41:36', '486', 'ALL', '');
drop table if exists admin_files;
create table admin_files (
  admin_files_id int(11) not null auto_increment,
  admin_files_name varchar(64) not null ,
  admin_files_is_boxes tinyint(5) default '0' not null ,
  admin_files_to_boxes int(11) default '0' not null ,
  admin_groups_id set('1','2') default '1' not null ,
  PRIMARY KEY (admin_files_id)
);

insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('1', 'administrator.php', '1', '0', '1,2');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('2', 'configuration.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('3', 'catalog.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('4', 'modules.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('5', 'customers.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('6', 'taxes.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('7', 'localization.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('8', 'reports.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('9', 'tools.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('10', 'admin_members.php', '0', '1', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('11', 'admin_files.php', '0', '1', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('12', 'configuration.php', '0', '2', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('13', 'categories.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('14', 'products_attributes.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('15', 'manufacturers.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('16', 'reviews.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('17', 'specials.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('18', 'products_expected.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('19', 'modules.php', '0', '4', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('20', 'customers.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('21', 'orders.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('22', 'countries.php', '0', '6', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('23', 'zones.php', '0', '6', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('24', 'geo_zones.php', '0', '6', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('25', 'tax_classes.php', '0', '6', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('26', 'tax_rates.php', '0', '6', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('27', 'currencies.php', '0', '7', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('28', 'languages.php', '0', '7', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('29', 'orders_status.php', '0', '7', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('30', 'stats_products_viewed.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('31', 'stats_products_purchased.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('32', 'stats_customers.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('33', 'backup.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('34', 'banner_manager.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('35', 'cache.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('36', 'define_language.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('37', 'file_manager.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('38', 'mail.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('39', 'newsletters.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('40', 'server_info.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('41', 'whos_online.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('42', 'banner_statistics.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('43', 'affiliate.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('44', 'affiliate_affiliates.php', '0', '43', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('45', 'affiliate_clicks.php', '0', '43', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('46', 'affiliate_banners.php', '0', '43', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('47', 'affiliate_contact.php', '0', '43', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('48', 'affiliate_invoice.php', '0', '43', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('49', 'affiliate_payment.php', '0', '43', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('50', 'affiliate_popup_image.php', '0', '43', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('51', 'affiliate_sales.php', '0', '43', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('52', 'affiliate_statistics.php', '0', '43', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('53', 'affiliate_summary.php', '0', '43', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('54', 'gv_admin.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('55', 'coupon_admin.php', '0', '54', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('56', 'gv_queue.php', '0', '54', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('57', 'gv_mail.php', '0', '54', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('58', 'gv_sent.php', '0', '54', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('62', 'coupon_restrict.php', '0', '54', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('64', 'xsell_products.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('65', 'easypopulate.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('68', 'define_mainpage.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('70', 'edit_orders.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('122', 'infobox_configuration.php', '0', '108', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('123', 'template_configuration.php', '0', '108', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('74', 'salemaker.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('75', 'admin_account.php', '0', '1', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('76', 'listcategories.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('77', 'quick_attributes_popup.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('78', 'quick_products_popup.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('79', 'newsdesk.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('80', 'newsdesk_configuration.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('81', 'newsdesk_configuration.php', '0', '80', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('82', 'newsdesk.php', '0', '79', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('83', 'newsdesk_reviews.php', '0', '79', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('92', 'faqdesk_configuration.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('91', 'faqdesk_reviews.php', '0', '89', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('90', 'faqdesk.php', '0', '89', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('89', 'faqdesk.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('93', 'faqdesk_configuration.php', '0', '92', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('94', 'featured.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('95', 'salemaker_info.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('103', 'create_account_success.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('102', 'create_account_process.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('105', 'create_order.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('104', 'create_account.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('106', 'create_order_process.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('107', 'stats_monthly_sales.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('108', 'design_controls.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('109', 'links.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('110', 'links.php', '0', '109', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('111', 'link_categories.php', '0', '109', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('112', 'links_contact.php', '0', '109', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('113', 'easypopulate_functions.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('114', 'popup_image0.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('115', 'popup_image1.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('116', 'popup_image2.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('117', 'popup_image3.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('118', 'popup_image4.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('119', 'popup_image5.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('120', 'popup_image6.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('121', 'popup_infobox_help.php', '0', '108', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('128', 'information.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('130', 'information_manager.php', '0', '128', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('134', 'recover_cart.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('135', 'stats_keywords.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('144', 'articles.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('145', 'article_reviews.php', '0', '144', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('146', 'articles.php', '0', '144', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('147', 'articles_config.php', '0', '144', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('148', 'articles_xsell.php', '0', '144', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('149', 'authors.php', '0', '144', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('150', 'customers_groups.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('151', 'polls.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('152', 'polls.php', '0', '151', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('153', 'pollbooth.php', '0', '151', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('154', 'quick_updates.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('155', 'products_properties.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('156', 'products_properties_popup.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('157', 'validcategories.php', '0', '54', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('158', 'validproducts.php', '0', '54', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('159', 'stats_sales_report.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('160', 'stats_sales_report2.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('161', 'stats_customers_orders.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('162', 'new_attributes.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('163', 'new_attributes_change.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('164', 'new_attributes_config.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('165', 'new_attributes_functions.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('166', 'new_attributes_include.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('167', 'new_attributes_select.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('169', 'extra_product_price.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('170', 'lister.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('171', 'viewer.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('172', 'files.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('173', 'insert_file.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('174', 'ship2pay.php', '0', '4', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('175', 'customer_extra_fields.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('176', 'product_extra_fields.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('177', 'cip_manager.php', '0', '4', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('178', 'edit_orders_add_product.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('179', 'edit_orders_ajax.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('180', 'chart_data.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('181', 'category_specials.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('182', 'options_images.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('183', 'products_multi.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('184', 'select_featured.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('185', 'select_special.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('186', 'products_specifications.php', '0', '3', '1');

drop table if exists admin_groups;
create table admin_groups (
  admin_groups_id int(11) not null auto_increment,
  admin_groups_name varchar(64) ,
  PRIMARY KEY (admin_groups_id),
  UNIQUE admin_groups_name (admin_groups_name)
);

insert into admin_groups (admin_groups_id, admin_groups_name) values ('1', '��������������');
insert into admin_groups (admin_groups_id, admin_groups_name) values ('2', '���������');
drop table if exists affiliate_affiliate;
create table affiliate_affiliate (
  affiliate_id int(11) not null auto_increment,
  affiliate_gender char(1) not null ,
  affiliate_firstname varchar(32) not null ,
  affiliate_lastname varchar(32) not null ,
  affiliate_dob datetime default '0000-00-00 00:00:00' not null ,
  affiliate_email_address varchar(96) not null ,
  affiliate_telephone varchar(32) not null ,
  affiliate_fax varchar(32) not null ,
  affiliate_password varchar(40) not null ,
  affiliate_homepage varchar(96) not null ,
  affiliate_street_address varchar(64) not null ,
  affiliate_suburb varchar(64) not null ,
  affiliate_city varchar(32) not null ,
  affiliate_postcode varchar(10) not null ,
  affiliate_state varchar(32) not null ,
  affiliate_country_id int(11) default '0' not null ,
  affiliate_zone_id int(11) default '0' not null ,
  affiliate_agb tinyint(4) default '0' not null ,
  affiliate_company varchar(60) not null ,
  affiliate_company_taxid varchar(64) not null ,
  affiliate_commission_percent decimal(4,2) default '0.00' not null ,
  affiliate_payment_check varchar(100) not null ,
  affiliate_payment_paypal varchar(64) not null ,
  affiliate_payment_bank_name varchar(64) not null ,
  affiliate_payment_bank_branch_number varchar(64) not null ,
  affiliate_payment_bank_swift_code varchar(64) not null ,
  affiliate_payment_bank_account_name varchar(64) not null ,
  affiliate_payment_bank_account_number varchar(64) not null ,
  affiliate_date_of_last_logon datetime default '0000-00-00 00:00:00' not null ,
  affiliate_number_of_logons int(11) default '0' not null ,
  affiliate_date_account_created datetime default '0000-00-00 00:00:00' not null ,
  affiliate_date_account_last_modified datetime default '0000-00-00 00:00:00' not null ,
  affiliate_lft int(11) default '0' not null ,
  affiliate_rgt int(11) default '0' not null ,
  affiliate_root int(11) default '0' not null ,
  affiliate_newsletter char(1) default '1' not null ,
  PRIMARY KEY (affiliate_id)
);

drop table if exists affiliate_banners;
create table affiliate_banners (
  affiliate_banners_id int(11) not null auto_increment,
  affiliate_banners_title varchar(64) not null ,
  affiliate_products_id int(11) default '0' not null ,
  affiliate_banners_image varchar(64) not null ,
  affiliate_banners_group varchar(10) not null ,
  affiliate_banners_html_text text ,
  affiliate_expires_impressions int(7) default '0' ,
  affiliate_expires_date datetime ,
  affiliate_date_scheduled datetime ,
  affiliate_date_added datetime default '0000-00-00 00:00:00' not null ,
  affiliate_date_status_change datetime ,
  affiliate_status int(1) default '1' not null ,
  PRIMARY KEY (affiliate_banners_id)
);

drop table if exists affiliate_banners_history;
create table affiliate_banners_history (
  affiliate_banners_history_id int(11) not null auto_increment,
  affiliate_banners_products_id int(11) default '0' not null ,
  affiliate_banners_id int(11) default '0' not null ,
  affiliate_banners_affiliate_id int(11) default '0' not null ,
  affiliate_banners_shown int(11) default '0' not null ,
  affiliate_banners_clicks tinyint(4) default '0' not null ,
  affiliate_banners_history_date date default '0000-00-00' not null ,
  PRIMARY KEY (affiliate_banners_history_id, affiliate_banners_products_id)
);

drop table if exists affiliate_clickthroughs;
create table affiliate_clickthroughs (
  affiliate_clickthrough_id int(11) not null auto_increment,
  affiliate_id int(11) default '0' not null ,
  affiliate_clientdate datetime default '0000-00-00 00:00:00' not null ,
  affiliate_clientbrowser varchar(200) default 'Could Not Find This Data' ,
  affiliate_clientip varchar(50) default 'Could Not Find This Data' ,
  affiliate_clientreferer varchar(200) default 'none detected (maybe a direct link)' ,
  affiliate_products_id int(11) default '0' ,
  affiliate_banner_id int(11) default '0' not null ,
  PRIMARY KEY (affiliate_clickthrough_id),
  KEY refid (affiliate_id)
);

drop table if exists affiliate_news;
create table affiliate_news (
  news_id int(11) not null auto_increment,
  headline varchar(255) not null ,
  content text ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  STATUS tinyint(1) default '0' not null ,
  PRIMARY KEY (news_id)
);

drop table if exists affiliate_newsletters;
create table affiliate_newsletters (
  affiliate_newsletters_id int(11) not null auto_increment,
  title varchar(255) not null ,
  content text ,
  module varchar(255) not null ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  date_sent datetime ,
  status int(1) ,
  locked int(1) default '0' ,
  PRIMARY KEY (affiliate_newsletters_id)
);

drop table if exists affiliate_payment;
create table affiliate_payment (
  affiliate_payment_id int(11) not null auto_increment,
  affiliate_id int(11) default '0' not null ,
  affiliate_payment decimal(15,2) default '0.00' not null ,
  affiliate_payment_tax decimal(15,2) default '0.00' not null ,
  affiliate_payment_total decimal(15,2) default '0.00' not null ,
  affiliate_payment_date datetime default '0000-00-00 00:00:00' not null ,
  affiliate_payment_last_modified datetime default '0000-00-00 00:00:00' not null ,
  affiliate_payment_status int(5) default '0' not null ,
  affiliate_firstname varchar(32) not null ,
  affiliate_lastname varchar(32) not null ,
  affiliate_street_address varchar(64) not null ,
  affiliate_suburb varchar(64) not null ,
  affiliate_city varchar(32) not null ,
  affiliate_postcode varchar(10) not null ,
  affiliate_country varchar(32) default '0' not null ,
  affiliate_company varchar(60) not null ,
  affiliate_state varchar(32) default '0' not null ,
  affiliate_address_format_id int(5) default '0' not null ,
  affiliate_last_modified datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (affiliate_payment_id)
);

drop table if exists affiliate_payment_status;
create table affiliate_payment_status (
  affiliate_payment_status_id int(11) default '0' not null ,
  affiliate_language_id int(11) default '1' not null ,
  affiliate_payment_status_name varchar(32) not null ,
  PRIMARY KEY (affiliate_payment_status_id, affiliate_language_id),
  KEY idx_affiliate_payment_status_name (affiliate_payment_status_name)
);

insert into affiliate_payment_status (affiliate_payment_status_id, affiliate_language_id, affiliate_payment_status_name) values ('0', '1', '�����������');
insert into affiliate_payment_status (affiliate_payment_status_id, affiliate_language_id, affiliate_payment_status_name) values ('1', '1', '�������');
drop table if exists affiliate_payment_status_history;
create table affiliate_payment_status_history (
  affiliate_status_history_id int(11) not null auto_increment,
  affiliate_payment_id int(11) default '0' not null ,
  affiliate_new_value int(5) default '0' not null ,
  affiliate_old_value int(5) ,
  affiliate_date_added datetime default '0000-00-00 00:00:00' not null ,
  affiliate_notified int(1) default '0' ,
  PRIMARY KEY (affiliate_status_history_id)
);

drop table if exists affiliate_sales;
create table affiliate_sales (
  affiliate_id int(11) default '0' not null ,
  affiliate_date datetime default '0000-00-00 00:00:00' not null ,
  affiliate_browser varchar(100) not null ,
  affiliate_ipaddress varchar(20) not null ,
  affiliate_orders_id int(11) default '0' not null ,
  affiliate_value decimal(15,2) default '0.00' not null ,
  affiliate_payment decimal(15,2) default '0.00' not null ,
  affiliate_clickthroughs_id int(11) default '0' not null ,
  affiliate_billing_status int(5) default '0' not null ,
  affiliate_payment_date datetime default '0000-00-00 00:00:00' not null ,
  affiliate_payment_id int(11) default '0' not null ,
  affiliate_percent decimal(4,2) default '0.00' not null ,
  affiliate_salesman int(11) default '0' not null ,
  PRIMARY KEY (affiliate_orders_id, affiliate_id)
);

drop table if exists article_reviews;
create table article_reviews (
  reviews_id int(11) not null auto_increment,
  articles_id int(11) default '0' not null ,
  customers_id int(11) ,
  customers_name varchar(64) not null ,
  reviews_rating int(1) ,
  date_added datetime ,
  last_modified datetime ,
  reviews_read int(5) default '0' not null ,
  approved tinyint(3) unsigned default '0' ,
  PRIMARY KEY (reviews_id)
);

drop table if exists article_reviews_description;
create table article_reviews_description (
  reviews_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  reviews_text text ,
  PRIMARY KEY (reviews_id, languages_id)
);

drop table if exists articles;
create table articles (
  articles_id int(11) not null auto_increment,
  articles_date_added datetime default '0000-00-00 00:00:00' not null ,
  articles_last_modified datetime ,
  articles_date_available datetime ,
  articles_status tinyint(1) default '0' not null ,
  authors_id int(11) ,
  PRIMARY KEY (articles_id),
  KEY idx_articles_date_added (articles_date_added)
);

insert into articles (articles_id, articles_date_added, articles_last_modified, articles_date_available, articles_status, authors_id) values ('2', '2005-06-22 17:55:21', NULL, NULL, '1', '0');
drop table if exists articles_description;
create table articles_description (
  articles_id int(11) not null auto_increment,
  language_id int(11) default '1' not null ,
  articles_name varchar(64) not null ,
  articles_description text ,
  articles_url varchar(255) ,
  articles_viewed int(5) default '0' ,
  articles_head_title_tag varchar(80) ,
  articles_head_desc_tag text ,
  articles_head_keywords_tag text ,
  PRIMARY KEY (articles_id, language_id),
  KEY articles_name (articles_name)
);

insert into articles_description (articles_id, language_id, articles_name, articles_description, articles_url, articles_viewed, articles_head_title_tag, articles_head_desc_tag, articles_head_keywords_tag) values ('2', '1', '���� ������', '', '', '0', '', '�����', '');
insert into articles_description (articles_id, language_id, articles_name, articles_description, articles_url, articles_viewed, articles_head_title_tag, articles_head_desc_tag, articles_head_keywords_tag) values ('2', '2', 'Sample article', '', '', '0', '', 'Text', '');
drop table if exists articles_to_topics;
create table articles_to_topics (
  articles_id int(11) default '0' not null ,
  topics_id int(11) default '0' not null ,
  PRIMARY KEY (articles_id, topics_id)
);

insert into articles_to_topics (articles_id, topics_id) values ('2', '2');
drop table if exists articles_xsell;
create table articles_xsell (
  ID int(10) not null auto_increment,
  articles_id int(10) unsigned default '1' not null ,
  xsell_id int(10) unsigned default '1' not null ,
  sort_order int(10) unsigned default '1' not null ,
  PRIMARY KEY (ID)
);

insert into articles_xsell (ID, articles_id, xsell_id, sort_order) values ('1', '1', '1', '1');
drop table if exists authors;
create table authors (
  authors_id int(11) not null auto_increment,
  authors_name varchar(32) not null ,
  authors_image varchar(64) ,
  date_added datetime ,
  last_modified datetime ,
  PRIMARY KEY (authors_id),
  KEY IDX_AUTHORS_NAME (authors_name)
);

drop table if exists authors_info;
create table authors_info (
  authors_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  authors_description text ,
  authors_url varchar(255) not null ,
  url_clicked int(5) default '0' not null ,
  date_last_click datetime ,
  PRIMARY KEY (authors_id, languages_id)
);

drop table if exists banners;
create table banners (
  banners_id int(11) not null auto_increment,
  banners_title varchar(64) not null ,
  banners_url varchar(255) not null ,
  banners_image varchar(64) not null ,
  banners_group varchar(10) not null ,
  banners_html_text text ,
  expires_impressions int(7) default '0' ,
  expires_date datetime ,
  date_scheduled datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  date_status_change datetime ,
  status int(1) default '1' not null ,
  PRIMARY KEY (banners_id),
  KEY idx_banners_group (banners_group)
);

insert into banners (banners_id, banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status) values ('1', 'osCommerce.Su', 'http://oscommerce.su', 'banners/oscommerce-su.jpg', '468x50', '', '0', NULL, NULL, '2003-07-17 10:29:22', NULL, '1');
drop table if exists banners_history;
create table banners_history (
  banners_history_id int(11) not null auto_increment,
  banners_id int(11) default '0' not null ,
  banners_shown int(5) default '0' not null ,
  banners_clicked int(5) default '0' not null ,
  banners_history_date datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (banners_history_id),
  KEY idx_banners_history_banners_id (banners_id)
);

drop table if exists categories;
create table categories (
  categories_id int(11) not null auto_increment,
  categories_image varchar(64) ,
  parent_id int(11) default '0' not null ,
  sort_order int(3) ,
  date_added datetime ,
  last_modified datetime ,
  categories_status tinyint(1) unsigned default '1' not null ,
  PRIMARY KEY (categories_id),
  KEY idx_categories_parent_id (parent_id)
);

insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified, categories_status) values ('28', 'br.gif', '0', '0', '2004-08-12 17:10:13', '2005-06-22 18:02:44', '1');
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified, categories_status) values ('29', 'br.gif', '0', '0', '2004-08-12 17:10:32', '2005-06-22 18:02:58', '0');
drop table if exists categories_description;
create table categories_description (
  categories_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  categories_name varchar(255) not null ,
  categories_heading_title varchar(255) ,
  categories_description text ,
  categories_meta_title varchar(255) ,
  categories_meta_description varchar(255) ,
  categories_meta_keywords varchar(255) ,
  PRIMARY KEY (categories_id, language_id),
  KEY idx_categories_name (categories_name)
);

insert into categories_description (categories_id, language_id, categories_name, categories_heading_title, categories_description, categories_meta_title, categories_meta_description, categories_meta_keywords) values ('28', '1', '����', '����� ��������� ����.', '���� ������, ����� � ������ ��������!', '', '', '');
insert into categories_description (categories_id, language_id, categories_name, categories_heading_title, categories_description, categories_meta_title, categories_meta_description, categories_meta_keywords) values ('29', '1', '������', '', '', '', '', '');
insert into categories_description (categories_id, language_id, categories_name, categories_heading_title, categories_description, categories_meta_title, categories_meta_description, categories_meta_keywords) values ('28', '2', 'Sample category', '', 'Category description', '', '', '');
insert into categories_description (categories_id, language_id, categories_name, categories_heading_title, categories_description, categories_meta_title, categories_meta_description, categories_meta_keywords) values ('29', '2', 'Sample category 2', '', '', '', '', '');
drop table if exists cip;
create table cip (
  cip_id int(11) not null auto_increment,
  cip_folder_name varchar(255) not null ,
  cip_downloads int(11) default '0' not null ,
  cip_uploader_id int(11) default '0' not null ,
  cip_installed int(1) default '0' not null ,
  cip_ident varchar(255) not null ,
  cip_version varchar(255) not null ,
  PRIMARY KEY (cip_id)
);

drop table if exists cip_depend;
create table cip_depend (
  cip_ident varchar(255) not null ,
  cip_ident_req varchar(255) not null ,
  cip_req_type int(2) default '0' not null ,
  PRIMARY KEY (cip_ident)
);

drop table if exists configuration;
create table configuration (
  configuration_id int(11) not null auto_increment,
  configuration_title varchar(255) not null ,
  configuration_key varchar(64) not null ,
  configuration_value varchar(255) not null ,
  configuration_description varchar(255) not null ,
  configuration_group_id int(11) default '0' not null ,
  sort_order int(5) ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  use_function varchar(255) ,
  set_function varchar(255) ,
  PRIMARY KEY (configuration_id)
);

insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1', '�������� ��������', 'STORE_NAME', '�������� ��������', '�������� ������ ��������', '1', '1', '2004-08-12 17:03:07', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('2', '�������� ��������', 'STORE_OWNER', '�������� ��������', '��� ��������� ��������', '1', '2', '2004-08-12 17:03:14', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('3', 'E-Mail �����', 'STORE_OWNER_EMAIL_ADDRESS', 'vam@test.com', 'E-Mail ����� ��������� ��������', '1', '3', '2004-08-12 17:03:20', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('4', 'E-Mail ��', 'EMAIL_FROM', '�������� �������� <vam@test.com>', 'E-Mail ����� � ������������ �������', '1', '4', '2004-08-12 17:03:36', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('5', '������', 'STORE_COUNTRY', '176', '������ ��������� ��������.<br><br><b>���������: �� �������� ����� ������� ����.</b>', '1', '6', '2004-04-22 17:39:54', '2003-07-17 10:29:22', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('6', '����', 'STORE_ZONE', '260', '������ ���������� ��������', '1', '7', '2004-04-22 17:40:00', '2003-07-17 10:29:22', 'tep_cfg_get_zone_name', 'tep_cfg_pull_down_zone_list(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('7', '������� ���������� ��������� �������', 'EXPECTED_PRODUCTS_SORT', 'desc', '������� ������� ���������� ��� ��������� �������, �� ����������� - asc ��� �� �������� - desc.', '1', '8', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'asc\', \'desc\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('8', '���������� ��������� �������', 'EXPECTED_PRODUCTS_FIELD', 'date_expected', '�� ������ �������� ����� ������������� ��������� ������.', '1', '9', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'products_name\', \'date_expected\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('9', '������������ �� ������ �������� �����', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'false', '�������������� ������������ ��� � �������� �� ������ �������� �����.', '1', '10', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('10', '�������� ����� ����� � �������', 'SEND_EXTRA_ORDER_EMAILS_TO', '����� <vam@test.com>', '���� �� ������ �������� ������ � ��������, �.�. ����� �� ������, ��� � �������� ������ ����� ���������� ������, ������� e-mail ����� ��� ��������� ����� ����� � ��������� �������: ��� 1 &lt;email@address1&gt;, ��� 2 &lt;email@address2&gt;', '1', '11', '2004-08-12 17:03:47', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('11', '������������ �������� URL ������ (��������� � ����������)', 'SEARCH_ENGINE_FRIENDLY_URLS', 'false', '������������ �������� URL ������ � ��������', '1', '12', '2004-03-20 21:55:41', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('12', '���������� � ������� ����� ���������� ������', 'DISPLAY_CART', 'true', '���������� � ������� ����� ���������� ������ � ������� ��� ���������� �� ��� �� ��������.', '1', '14', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('13', '��������� ������ ������������ ������� ���������� �����', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 'false', '��������� ������ ������������ ������� �������� ���������� �����, ���� ���, �� ������ �������� ����� ������������ ������ ������������������ ������������ ��������.', '1', '15', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('14', '�������� ������ �� ���������', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', '�������, ����� �������� ����� �������������� �� ��������� ��� ������������� ����������� ������ � ��������.', '1', '17', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'and\', \'or\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('15', '����� � ������� ��������', 'STORE_NAME_ADDRESS', '����� ��������', '����� �� ������ ������� ����� � ������� ��������', '1', '18', '2004-08-12 17:03:58', '2003-07-17 10:29:22', NULL, 'tep_cfg_textarea(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('16', '���������� ������� �������', 'SHOW_COUNTS', 'true', '���������� ���������� ������ � ������ ���������. ��� ������� ���������� ������ � �������� ������������� ��������� ������� - false, ����� ������� �������� �� MySQL ������, ��� ����� �������� �������� �������� ������ �������� ����������.', '1', '19', '2004-04-24 15:29:10', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('17', '���������� ������ ����� ������� � �������', 'TAX_DECIMAL_PLACES', '0', '���������� ������ ����� ������ ����� � �������.', '1', '20', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('18', '���������� ���� � ��������', 'DISPLAY_PRICE_WITH_TAX', 'false', '���������� ���� � �������� � �������� (true) ��� ���������� ����� ������ �� �������������� ����� ���������� ������ (false)', '1', '21', '2004-01-05 01:25:38', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('19', '���', 'ENTRY_FIRST_NAME_MIN_LENGTH', '2', '����������� ���������� �������� ���� ���', '2', '1', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('20', '�������', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', '����������� ���������� �������� ���� �������', '2', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('21', '���� ��������', 'ENTRY_DOB_MIN_LENGTH', '10', '����������� ���������� �������� ���� ���� ��������', '2', '3', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('22', 'E-Mail �����', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', '����������� ���������� �������� ���� E-Mail �����', '2', '4', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('23', '�����', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', '����������� ���������� �������� ���� �����', '2', '5', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('24', '��������', 'ENTRY_COMPANY_MIN_LENGTH', '2', '����������� ���������� �������� ���� ��������', '2', '6', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('25', '�������� ������', 'ENTRY_POSTCODE_MIN_LENGTH', '4', '����������� ���������� �������� ���� �������� ������', '2', '7', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('26', '�����', 'ENTRY_CITY_MIN_LENGTH', '3', '����������� ���������� �������� ���� �����', '2', '8', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('27', '������', 'ENTRY_STATE_MIN_LENGTH', '2', '����������� ���������� �������� ���� ������', '2', '9', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('28', '�������', 'ENTRY_TELEPHONE_MIN_LENGTH', '3', '����������� ���������� �������� ���� �������', '2', '10', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('29', '������', 'ENTRY_PASSWORD_MIN_LENGTH', '5', '����������� ���������� �������� ���� ������', '2', '11', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('30', '�������� ��������� ��������', 'CC_OWNER_MIN_LENGTH', '3', '����������� ���������� �������� ���� �������� ��������� ��������', '2', '12', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('31', '����� ��������� ��������', 'CC_NUMBER_MIN_LENGTH', '10', '����������� ���������� �������� ���� ����� ��������� ��������', '2', '13', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('32', '����� ������', 'REVIEW_TEXT_MIN_LENGTH', '10', '����������� ���������� �������� ��� ������', '2', '14', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('33', '������ ������', 'MIN_DISPLAY_BESTSELLERS', '1', '����������� ���������� ������, ���������� � ����� ������ ������', '2', '15', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('34', '����� ��������', 'MIN_DISPLAY_ALSO_PURCHASED', '1', '����������� ���������� ������, ���������� � ����� ����� ��������', '2', '16', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('35', '������ � �������� �����', 'MAX_ADDRESS_BOOK_ENTRIES', '5', '������������ ���������� �������, ������� ����� ������� ���������� � ����� �������� �����', '3', '1', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('36', '������� �� ����� �������� � ��������', 'MAX_DISPLAY_SEARCH_RESULTS', '10', '���������� ������, ���������� �� ����� ��������', '3', '2', '2003-08-06 12:35:41', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('37', '������ �� ��������', 'MAX_DISPLAY_PAGE_LINKS', '10', '���������� ������ �� ������ ��������', '3', '3', '2004-01-02 19:17:13', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('38', '����������� ����', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '3', '������������ ���������� ������, ���������� �� �������� ������', '3', '4', '2003-08-06 12:35:27', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('39', '�������', 'MAX_DISPLAY_NEW_PRODUCTS', '6', '������������ ���������� ������, ��������� � ����� �������', '3', '5', '2004-04-29 15:31:49', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('40', '��������� ������', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '3', '������������ ���������� ������, ���������� � ����� ��������� ������', '3', '6', '2003-08-06 12:36:07', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('41', '������ ��������������', 'MAX_DISPLAY_MANUFACTURERS_IN_A_LIST', '5', '������ ����� ������������ ��� ��������� ����� ��������������, ���� ����� �������������� ��������� ��������� � ������ �����, ������ �������������� ����� ���������� � ���� drop-down ������, ���� ����� �������������� ������ ���������� � ������ �����, �������', '3', '7', '2003-10-04 02:47:35', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('42', '������������� � ���� ����������� ����', 'MAX_MANUFACTURERS_LIST', '1', '������ ����� ������������ ��� ��������� ����� ��������������, ���� ������� ����� \'1\', �� ������ �������������� ��������� � ���� ������������ drop-down ������. ���� ������� ����� ������ �����, �� ��������� ������ X �������������� � ���� ����������� ����.', '3', '7', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('43', '����������� ����� �������� �������������', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', '������ ����� ������������ ��� ��������� ����� ��������������, �� ���������� ���������� ��������, ���������� � ����� ��������������, ���� �������� ������������� ����� �������� �� �������� ���������� ��������, �� ����� �������� ������ X �������� ��������', '3', '8', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('44', '����� ������', 'MAX_DISPLAY_NEW_REVIEWS', '6', '������������ ���������� ��������� ����� �������', '3', '9', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('45', '����� ��������� �������', 'MAX_RANDOM_SELECT_REVIEWS', '10', '���������� �������, ������� ����� �������������� ��� ������ ����������, �.�. ���� ������� X - ����� �������, �� ��������� ����� ����� ������ �� ���� X �������', '3', '10', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('46', '����� ���������� ������ � ����� �������', 'MAX_RANDOM_SELECT_NEW', '10', '���������� ������, ����� �������� ����� ������ ��������� ����� � ������� � ���� �������, �.�. ���� ������� ����� X, �� ����� �����, ������� ����� ������� � ����� ������� ����� ������ �� ���� X ����� �������', '3', '11', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('47', '����� ���������� ������ � ����� ������', 'MAX_RANDOM_SELECT_SPECIALS', '10', '���������� ������, ����� �������� ����� ������ ��������� ����� � ������� � ���� ������, �.�. ���� ������� ����� X, �� �����, ������� ����� ������� � ����� ������ ����� ������ �� ���� X �������', '3', '12', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('48', '���������� ��������� � ������', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '3', '������� ��������� �������� � ����� ������', '3', '13', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('49', '���������� ������� �� ��������', 'MAX_DISPLAY_PRODUCTS_NEW', '8', '������������ ���������� �������, ��������� �� ����� �������� � ������� �������', '3', '14', '2003-08-29 22:56:22', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('50', '������ ������', 'MAX_DISPLAY_BESTSELLERS', '10', '������������ ���������� ������� ������, ��������� � ����� ������ ������', '3', '15', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('51', '����� ��������', 'MAX_DISPLAY_ALSO_PURCHASED', '6', '������������ ���������� ������� � ����� ���� ���������� ����� ��������', '3', '16', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('52', '���� ������� �������', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', '������������ ���������� �������, ��������� � ����� ������� �������', '3', '17', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('53', '������� �������', 'MAX_DISPLAY_ORDER_HISTORY', '10', '������������ ���������� �������, ��������� �� �������� ������� �������', '3', '18', NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('70', 'Product Quantities In Shopping Cart', 'MAX_QTY_IN_CART', '0', 'Maximum number of product quantities that can be added to the shopping cart (0 for no limit)', '3', '19', now());
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('71', 'Maximum number of reviews on product info page', 'MAX_REVIEWS', '5', 'Maximum number of reviews displayed on product info page.', '3', '20', now(), now(), NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('54', '������ ��������� ��������', 'SMALL_IMAGE_WIDTH', '100', '������ �������� � ��������. �������� ���� ������ ��� ��������� 0, ���� �� ������ ������������ ������ ��������. ����������� ������ �������� �� ������ ����������� ���������� �������� ��������.', '4', '1', '2004-02-01 16:15:37', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('55', '������ ��������� ��������', 'SMALL_IMAGE_HEIGHT', '80', '������ �������� � ��������. �������� ���� ������ ��� ��������� 0, ���� �� ������ ������������ ������ ��������. ����������� ������ �������� �� ������ ����������� ���������� �������� ��������.', '4', '2', '2004-02-01 16:15:22', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('56', '������ �������� ���������', 'HEADING_IMAGE_WIDTH', '', '������ �������� � ��������. �������� ���� ������ ��� ��������� 0, ���� �� ������ ������������ ������ ��������. ����������� ������ �������� �� ������ ����������� ���������� �������� ��������.', '4', '3', '2004-04-24 14:47:21', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('57', '������ �������� ���������', 'HEADING_IMAGE_HEIGHT', '', '������ �������� � ��������. �������� ���� ������ ��� ��������� 0, ���� �� ������ ������������ ������ ��������. ����������� ������ �������� �� ������ ����������� ���������� �������� ��������.', '4', '4', '2004-04-24 14:47:18', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('58', '������ �������� ������������', 'SUBCATEGORY_IMAGE_WIDTH', '', '������ �������� � ��������. �������� ���� ������ ��� ��������� 0, ���� �� ������ ������������ ������ ��������. ����������� ������ �������� �� ������ ����������� ���������� �������� ��������.', '4', '5', '2004-04-24 14:47:24', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('59', '������ �������� ������������', 'SUBCATEGORY_IMAGE_HEIGHT', '', '������ �������� � ��������. �������� ���� ������ ��� ��������� 0, ���� �� ������ ������������ ������ ��������. ����������� ������ �������� �� ������ ����������� ���������� �������� ��������.', '4', '6', '2004-04-24 14:47:28', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('60', '��������� ������ ��������', 'CONFIG_CALCULATE_IMAGE_SIZE', 'false', '������ ����� ������ ������� ����������, ��������� ���� � ������� �������� �� ��������� ��������, ��� �� ������, ��� ���������� ������ �������� ����������, ���������� �������������� ����� �������� ������������ �������. ������������� ������� �������� false', '4', '7', '2004-02-01 16:17:01', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('61', '�������� �����������', 'IMAGE_REQUIRED', 'true', '���������� ��� ������ ������, � ������, ���� �������� �� ���������.', '4', '8', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('62', '���', 'ACCOUNT_GENDER', 'false', '���������� ���� ��� ��� ����������� ���������� � �������� � � �������� �����', '5', '1', '2004-01-30 17:21:22', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('63', '���� ��������', 'ACCOUNT_DOB', 'false', '���������� ���� ���� �������� ��� ����������� ���������� � �������� � � �������� �����', '5', '2', '2004-01-30 17:21:35', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('64', '��������', 'ACCOUNT_COMPANY', 'false', '���������� ���� �������� ��� ����������� ���������� � �������� � � �������� �����', '5', '3', '2004-01-30 17:21:39', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('65', '�����', 'ACCOUNT_SUBURB', 'false', '���������� ���� ����� ��� ����������� ���������� � �������� � � �������� �����', '5', '4', '2004-01-30 17:21:42', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('66', '������', 'ACCOUNT_STATE', 'true', '���������� ���� ������ ��� ����������� ���������� � �������� � � �������� �����', '5', '5', '2004-04-22 17:07:14', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('67', '������������� ������', 'MODULE_PAYMENT_INSTALLED', 'cod.php;egold.php;freecharger.php;mg.php;rusbank.php;schet.php;webmoney.php;wu.php;yandex.php', '������ ������������� ������� ������, ���������� ������ � �������. �������� ������������� �����������. ������ �������� �� �����, ��� ������ ������������� �������� �� ������������� �������. (��������: cc.php;cod.php;webmoney.php)', '6', '0', '2007-06-03 14:41:58', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('68', '������������� ������', 'MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_shipping.php;ot_tax.php;ot_coupon.php;ot_gv.php;ot_total.php', '������ ������������� ������� ����� �����, ���������� ������ � �������. �������� ������������� �����������. ������ �������� �� �����, ��� ������ ������������� �������� �� ������������� �������. (��������: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_tota', '6', '0', '2006-01-04 13:42:21', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('69', '������������� ������', 'MODULE_SHIPPING_INSTALLED', 'flat.php;freeshipper.php;table.php', '������ ������������� ������� ��������, ���������� ������ � �������. �������� ������������� �����������. ������ �������� �� �����, ��� ������ ������������� �������� �� ������������� �������. (��������: ups.php;flat.php;item.php)', '6', '0', '2006-03-25 18:30:56', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1559', '��� EGold �������������', 'MODULE_PAYMENT_EGOLD_1', '11111111', '������� ��� EGold ID', '6', '1', NULL, '2006-03-25 18:25:13', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1558', '������ ����� ������� EGOLD', 'MODULE_PAYMENT_EGOLD_STATUS', '1', '�� ������ ������������ ������ ������ ����� ������� EGOLD? 1 - ��, 0 - ���', '6', '1', NULL, '2006-03-25 18:25:13', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('84', 'Default Currency', 'DEFAULT_CURRENCY', 'RUR', 'Default Currency', '6', '0', '2003-09-06 22:01:21', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('85', 'Default Language', 'DEFAULT_LANGUAGE', 'ru', 'Default Language', '6', '0', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('86', 'Default Order Status For New Orders', 'DEFAULT_ORDERS_STATUS_ID', '1', 'When a new order is created, this order status will be assigned to it.', '6', '0', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('87', '���������� ��������', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', '�� ������ ���������� ��������� ��������?', '6', '1', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('88', '������� ����������', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '2', '������� ���������� ������.', '6', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('89', '��������� ���������� ��������', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'true', '�� ������ ��������� ������������� ������ ���������� ��������?', '7', '6', '2003-11-19 22:05:02', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('90', '���������� �������� ��� ������� �� ����� �����', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '5000', '������, ����� �����, ��������� ������ ����, ����� ������������ ���������.', '7', '7', '2003-12-31 15:14:15', '2003-07-17 10:29:22', 'currencies->format', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('91', '���������� �������� ��� �������, ����������� ��', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', 'national - ������ �� ������ ���������� ��������(���������� ������ ��������), international - ������ �� ����� ������, ����� ������ ���������� ��������, ���� both - ����� ��� ������. ��� �������, ��� ����� ������ ���� �����, ��������� � ���������� ����.', '7', '8', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'national\', \'international\', \'both\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('92', '���������� ��������� ������', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', '�� ������ ���������� ��������� ������?', '6', '1', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('93', '������� ����������', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '1', '������� ���������� ������.', '6', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('94', '���������� �����', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'true', '�� ������ ���������� �����?', '6', '1', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('95', '������� ����������', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '3', '������� ���������� ������.', '6', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('96', '���������� �����', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', '�� ������ ���������� ����� ��������� ������?', '6', '1', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('97', '������� ����������', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '800', '������� ���������� ������.', '6', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('98', '������ ��������', 'SHIPPING_ORIGIN_COUNTRY', '176', '������, ��� ��������� �������. ���������� ��� ��������� ������� ��������.', '7', '1', '2004-04-22 17:39:38', '2003-07-17 10:29:22', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('99', '�������� ������ ��������', 'SHIPPING_ORIGIN_ZIP', '355029', '������� �������� ������ ��������. ���������� ��� ��������� ������� ��������.', '7', '2', '2004-04-22 17:39:43', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('100', '������������ ��� ��������', 'SHIPPING_MAX_WEIGHT', '50', '�� ������ ������� ������������ ��� ��������, ����� �������� ������ �� ������������. ���������� ��� ��������� ������� ��������.', '7', '3', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('101', '��� ��������', 'SHIPPING_BOX_WEIGHT', '0', '�� ������ ������� ��� ��������.', '7', '4', '2003-07-29 15:06:50', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('102', '������ ������ - ���������� ���������� ���������', 'SHIPPING_BOX_PADDING', '10', '�������� �������, ��� ������� ������ ���������� � ���������� ������������ ��� ��������, ������������� �� ��������� �������. ���� �� ������ ������� ��������� �� 10%, ������ - 10', '7', '5', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('103', '���������� �������� ������', 'PRODUCT_LIST_IMAGE', '1', '������� ������� ������, �.�. ������� �����. ���� ������� 1, �� �������� ����� ����� �� ������ �����, ���� 2, �� �������� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�.', '8', '1', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('104', '���������� ������������� ������', 'PRODUCT_LIST_MANUFACTURER', '0', '������� ������� ������ ������� ���� � ����� ��������, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�.', '8', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('105', '���������� ��� ������', 'PRODUCT_LIST_MODEL', '0', '������� ������� ������ ������� ���� � ����� ��������, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�.', '8', '3', '2004-01-02 17:22:34', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('106', '���������� �������� ������', 'PRODUCT_LIST_NAME', '2', '������� ������� ������ ������� ���� � ����� ��������, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�.', '8', '4', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('107', '���������� ��������� ������', 'PRODUCT_LIST_PRICE', '3', '������� ������� ������ ������� ���� � ����� ��������, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�.', '8', '5', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('108', '���������� ���������� ������ �� ������', 'PRODUCT_LIST_QUANTITY', '0', '������� ������� ������ ������� ���� � ����� ��������, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�.', '8', '6', '2004-01-02 17:22:50', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('109', '���������� ��� ������', 'PRODUCT_LIST_WEIGHT', '0', '������� ������� ������ ������� ���� � ����� ��������, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�.', '8', '7', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('110', '���������� ������ ������ ������!', 'PRODUCT_LIST_BUY_NOW', '4', '������� ������� ������ ������� ���� � ����� ��������, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�.', '8', '8', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('111', '���������� ������ ���������/������������� (0=�� ����������; 1=����������)', 'PRODUCT_LIST_FILTER', '1', '���������� ����(drop-down) ����, � ������� �������� ����� ����������� ����� � �����-���� ��������� �������� �� �������������.', '8', '9', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('112', '������������ ��������� ���������/���������� ��������', 'PREV_NEXT_BAR_LOCATION', '3', '���������� ������������ ��������� ���������/���������� �������� (1-����, 2-���, 3-����+���)', '8', '10', '2003-10-05 19:19:32', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('113', '��������� ������� ������ �� ������', 'STOCK_CHECK', 'false', '���������, ���� �� ����������� ���������� ������ �� ������ ��� ���������� ������', '9', '1', '2004-02-01 16:18:45', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('114', '�������� ����� �� ������', 'STOCK_LIMITED', 'false', '�������� �� ������ �� ���������� ������, ������� ����� ������������ � ��������-��������', '9', '2', '2004-02-01 16:18:48', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('115', '��������� ���������� ������', 'STOCK_ALLOW_CHECKOUT', 'true', '��������� ����������� ��������� �����, ���� ���� �� ������ ��� ������������ ���������� ������ ������������� ������', '9', '3', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('116', '�������� �����, ������������� �� ������', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', '���������� ���������� ������ �������� ������ ��� ���������� ������, ���� �� ������ ��� ������������ ���������� ������ ������������� ������', '9', '4', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('117', '����� ���������� ������ �� ������', 'STOCK_REORDER_LEVEL', '5', '���� ���������� ������ �� ������ ������, ��� ��������� ����� � ������ ����������, �� � ������� ��������� �������������� � ������������� ���������� ������ �� ������ ��� ���������� ������.', '9', '5', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('118', '��������� ����� �������� �������', 'STORE_PAGE_PARSE_TIME', 'false', '������� �����, ����������� �� ���������(�������) ������� ��������.', '10', '1', '2003-11-02 23:59:48', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('119', '���������� �������� �����', 'STORE_PAGE_PARSE_TIME_LOG', '/tmp/page_parse_time.log', '������ ���� �� ���������� � �����, � ������� ����� ������������ ��� �������� �������.', '10', '2', '2003-11-02 23:56:10', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('120', '������ ���� �����', 'STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', '������ ����', '10', '3', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('121', '���������� ����� �������� �������', 'DISPLAY_PAGE_PARSE_TIME', 'false', '���������� ����� �������� �������� � ��������-�������� (����� ��������� ����� �������� ������� ������ ���� ��������)', '10', '4', '2006-04-21 20:49:23', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('122', '��������� ������� � ���� ������', 'STORE_DB_TRANSACTIONS', 'false', '��������� ��� ������� � ���� ������ � �����, ��������� � ���������� ���������� �������� ����� (������ ��� PHP4 � ����)', '10', '5', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('123', '������������ ���', 'USE_CACHE', 'false', '������������ ����������� ����������.', '11', '1', '2003-08-28 21:53:54', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('124', '��� ����������', 'DIR_FS_CACHE', '/home/test/temp/', '����������, ���� ����� ������������ � ����������� ���-�����.', '11', '2', '2004-08-12 17:04:39', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('125', '������ �������� E-Mail', 'EMAIL_TRANSPORT', 'sendmail', '�������, ����� ������ �������� ����� �� �������� ����� ��������������. ��� ��������, ���������� ��� ����������� Windows ��� MacOS ���������� ���������� SMTP ��� �������� �����.', '12', '1', '2004-02-16 11:48:47', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'sendmail\', \'smtp\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('126', '����������� ����� � E-Mail', 'EMAIL_LINEFEED', 'LF', '������������ ������������������ �������� ��� ���������� ���������� � ������.', '12', '2', '2004-02-16 11:51:52', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'LF\', \'CRLF\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('127', '������������ HTML ������ ��� �������� �����', 'EMAIL_USE_HTML', 'false', '���������� ������ �� �������� � HTML �������.', '12', '3', '2004-02-16 11:51:56', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('128', '��������� E-Mail ����� ����� DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', '���������, ������ �� e-mail ������ ����������� ��� ����������� � ��������-��������. ��� �������� ������������ DNS.', '12', '4', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('129', '���������� ������ �� ��������', 'SEND_EMAILS', 'true', '���������� ������ �� ��������.', '12', '5', '2003-11-02 20:00:22', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP ������', 'EMAIL_SMTP_SERVER', 'smtp.server.com', '������� smtp ������, ���� �� �������� �������� ����� ����� smtp.', '12', '6', NULL, '2003-07-17 10:29:22', NULL, '');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP ������: ����', 'EMAIL_SMTP_PORT', '25', '���������� ���� smtp �������.', '12', '7', NULL, '2003-07-17 10:29:22', NULL, '');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP �����������', 'EMAIL_SMTP_AUTH', 'false', 'SMTP �����������.', '12', '8', '2004-02-16 11:51:56', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP ������: ��� ������������', 'EMAIL_SMTP_USERNAME', 'username', '���������� ��� ������������ ��� ����������� � �������.', '12', '9', NULL, '2003-07-17 10:29:22', NULL, '');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP ������: ������', 'EMAIL_SMTP_PASSWORD', 'password', '���������� ������ ��� ����������� � �������.', '12', '10', NULL, '2003-07-17 10:29:22', NULL, '');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('130', '��������� ������� ���������� �������', 'DOWNLOAD_ENABLED', 'true', '��������� ������� ���������� �������.', '13', '1', '2003-07-29 15:38:22', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('131', '������������ ��������������� ��� ����������', 'DOWNLOAD_BY_REDIRECT', 'false', '������������ ��������������� � �������� ��� ���������� ������. ��� �� Unix ������(Windows, Mac OS � �.�.) ������ ������ false.', '13', '2', '2003-12-23 22:27:01', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('132', '���� ������������� ������ ��� ���������� (����)', 'DOWNLOAD_MAX_DAYS', '7', '���������� ���������� ����, � ������� ������� ���������� ����� ������� ���� �����. ���� ������� 0, ����� ���� ������������� ������ ��� ���������� ��������� �� �����.', '13', '3', NULL, '2003-07-17 10:29:22', NULL, '');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('133', '������������ ���������� ����������', 'DOWNLOAD_MAX_COUNT', '5', '���������� ������������ ���������� ���������� ��� ������ ������. ���� ������� 0, ����� ������� ����������� �� ���������� ���������� �� �����.', '13', '4', NULL, '2003-07-17 10:29:22', NULL, '');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('134', '��������� GZip ����������', 'GZIP_COMPRESSION', 'false', '��������� HTTP GZip ����������.', '14', '1', '2003-08-12 00:20:39', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('135', '������� ����������', 'GZIP_LEVEL', '5', '�� ������ ������� ������� ���������� �� 0 �� 9 (0 = �������, 9 = ��������).', '14', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('136', '���������� ������', 'SESSION_WRITE_DIRECTORY', '/tmp', '���� ������ �������� � ������, �� ����� ���������� ������� ������ ���� �� �����, � ������� ����� ��������� ����� ������.', '15', '1', '2004-08-12 17:04:54', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('137', '�������������� ������������� Cookie', 'SESSION_FORCE_COOKIE_USE', 'False', '������������� ������������ ������, ������ ����� � �������� ������������ cookies.', '15', '2', '2004-11-14 12:30:25', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('138', '��������� ID SSL ������', 'SESSION_CHECK_SSL_SESSION_ID', 'False', '���������  SSL_SESSION_ID ��� ������ ��������� � ��������, ���������� ���������� HTTPS.', '15', '3', '2003-08-28 18:18:22', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('139', '��������� ���������� User Agent', 'SESSION_CHECK_USER_AGENT', 'False', '��������� ���������� ������� user agent ��� ������ ��������� � ��������� ��������-��������.', '15', '4', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('140', '��������� IP �����', 'SESSION_CHECK_IP_ADDRESS', 'False', '��������� IP ������ �������� ��� ������ ��������� � ��������� ��������-��������.', '15', '5', '2003-08-28 18:18:30', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('141', '�� ���������� ������ � ������ ������ ��������� �����', 'SESSION_BLOCK_SPIDERS', 'True', '�� ���������� ������ � ������ ��� ��������� � �������� �������� ��������� ��������� ������. ������ ��������� ������ ��������� � ����� includes/spiders.txt.', '15', '6', '2003-07-17 10:34:45', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('142', '������������ ������', 'SESSION_RECREATE', 'False', '������������ ������ ��� ��������� ������ ID ���� ������ ��� ����� ������������������� ���������� � �������, ���� ��� ����������� ������ ���������� (������ ��� PHP 4.1 � ����).', '15', '7', '2003-07-17 10:35:04', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1171', '������������ WYSIWYG HTML �������� ��� ���� �������� ������?', 'HTML_AREA_WYSIWYG_DISABLE', 'Disable', 'Enable - �������� HTML �������� ��� ���� �������� ������ ��� ����������/�������������� ������<br>Disable - ��������� HTML ��������.', '112', '0', '2005-06-22 17:56:10', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1175', '������������ WYSIWYG HTML �������� �� �������� ��������� Email?', 'HTML_AREA_WYSIWYG_DISABLE_EMAIL', 'Disable', 'Enable - �������� HTML �������� <br>Disable - ��������� HTML ��������.', '112', '20', '2005-06-22 17:56:14', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1179', '������������ WYSIWYG HTML �������� �� �������� �������� ��������', 'HTML_AREA_WYSIWYG_DISABLE_NEWSLETTER', 'Disable', 'Enable - �������� HTML �������� <br>Disable - ��������� HTML ��������.', '112', '30', '2005-06-22 17:56:18', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1183', '������������ WYSIWYG HTML �������� ��� �������������� ������� ��', 'HTML_AREA_WYSIWYG_DISABLE_DEFINE', 'Disable', 'Enable - �������� HTML �������� <br>Disable - ��������� HTML ��������.', '112', '40', '2005-06-22 17:56:23', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('164', 'E-Mail �����', 'AFFILIATE_EMAIL_ADDRESS', '<affiliate@localhost.com>', 'E-Mail ����� ���������� ���������', '900', '1', '2003-07-17 21:46:04', '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('165', '������� � ������ �������, ����������� �������', 'AFFILIATE_PERCENT', '10.0000', '������� �� ����� ����������� ������, ����������� ��������', '900', '2', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('166', '����������� ����� � ������', 'AFFILIATE_THRESHOLD', '50.00', '����������� ����� ���������� �������� � ������', '900', '3', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('167', '����� �������� cookies', 'AFFILIATE_COOKIE_LIFETIME', '7200', '����� (� ��������) �������� cookies. ���� ���������� � ������ IP ������ ������ ���� ��� �������, � �������� � ��� ������� ���� ������� �������, �� � ��������� ��� ����� � ������� � ����� IP ����� ������������� ������ ����� 7200 ������ (�� ���������).', '900', '4', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('168', '������� ������ � ������', 'AFFILIATE_BILLING_TIME', '30', '�� ��������� ����� 30, ��� ������, ��� ����� ��� ������ �������� �������� ������������ ��� � �����', '900', '5', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('169', '����������� ������ ������', 'AFFILIATE_PAYMENT_ORDER_MIN_STATUS', '3', '���������� ��� ����, ����� �������� �������� ����������� ������ �� ���������� ������, ������ ID - 3 ��� ����. �� ��������� ����� 3 (�����������), �.�. ����� ��� ������� � �������� �������� ����������� ������ �� ���������� ������.', '900', '6', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('170', '������ �������� ����� WebMoney', 'AFFILIATE_USE_CHECK', 'true', '������ ���������� �������� ����� WebMoney. ��� ����������� ������ ��������� ���� ������ � WebMoney.<br>true - ��������<br>false - ���������', '900', '7', NULL, '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('171', '������ �������� ����� PayPal', 'AFFILIATE_USE_PAYPAL', 'false', '������ ����� ������� PayPal.<br>true - ��������<br>false - ���������', '900', '8', '2004-03-04 15:59:54', '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('172', '������ �������� ��������� �� ���� � �����', 'AFFILIATE_USE_BANK', 'false', '������ ���������� �������� ����� ����.<br>true - ��������<br>false - ���������', '900', '9', '2004-03-04 15:59:58', '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('173', '�������������� �������� ��� ��������', 'AFFILATE_INDIVIDUAL_PERCENTAGE', 'true', '��������� ��������� �������������� ��������� �������� ��� ��������. ��������, �� ��������� ����� 10% � ������� ��� ���� ������������������ ��������, � �� ������ �������� �������� �������� ������ �������� 15% � �������.', '900', '10', NULL, '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('174', '���������� ��������', 'AFFILATE_USE_TIER', 'false', '�������, �������������������� ����� ���� ����� ��������, ����� �������� �������� �� ������, ����������� ����� ��������, ������� �� ����� � �������.', '900', '11', '2003-07-17 21:46:43', '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('175', '���������� ������ ��������', 'AFFILIATE_TIER_LEVELS', '0', '���������� �������, ������� ����������� ��� ����� ��������.', '900', '12', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('176', '������� �������� ���������� ��������', 'AFFILIATE_TIER_PERCENTAGE', '8.00;5.00;1.00', '�������� �������� ��� ������� �� �������.<br>������: 8.00;5.00;1.00', '900', '13', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1502', '������������� �����', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'None', '������������� �����.', '6', '7', NULL, '2005-11-01 12:07:39', NULL, 'tep_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1503', '�����', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', '0', '������������ ����� ��� �������.', '6', '0', NULL, '2005-11-01 12:07:39', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1501', '��������� �����', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'true', '�������� � ������ �����.', '6', '6', NULL, '2005-11-01 12:07:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1499', '������� ����������', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', '9', '������� ���������� ������.', '6', '2', NULL, '2005-11-01 12:07:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1500', '��������� ��������', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'true', '�������� � ������ ��������.', '6', '5', NULL, '2005-11-01 12:07:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1498', '���������� �����', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 'true', '�� ������ ���������� ������� ������?', '6', '1', NULL, '2005-11-01 12:07:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1526', '����� �����������', 'MODULE_ORDER_TOTAL_GV_CREDIT_TAX', 'false', '��������� ����� � ��������� ���������� ������������.', '6', '8', NULL, '2006-01-04 13:42:21', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1525', '�����', 'MODULE_ORDER_TOTAL_GV_TAX_CLASS', '0', '������������ �����.', '6', '0', NULL, '2006-01-04 13:42:21', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1524', '������������� �����', 'MODULE_ORDER_TOTAL_GV_CALC_TAX', 'None', '������������� �����.', '6', '7', NULL, '2006-01-04 13:42:21', NULL, 'tep_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1523', '��������� �����', 'MODULE_ORDER_TOTAL_GV_INC_TAX', 'true', '�������� � ������ �����.', '6', '6', NULL, '2006-01-04 13:42:21', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1522', '��������� ��������', 'MODULE_ORDER_TOTAL_GV_INC_SHIPPING', 'true', '�������� � ������ ��������.', '6', '5', NULL, '2006-01-04 13:42:21', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1520', '������� ����������', 'MODULE_ORDER_TOTAL_GV_SORT_ORDER', '740', '������� ���������� ������.', '6', '2', NULL, '2006-01-04 13:42:21', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1521', '��������� ������������', 'MODULE_ORDER_TOTAL_GV_QUEUE', 'true', '�� ������ ������� ������������ ��������� ���������� �����������?', '6', '3', NULL, '2006-01-04 13:42:21', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1519', '���������� �����', 'MODULE_ORDER_TOTAL_GV_STATUS', 'true', '�� ������ ���������� ������� ����������� �����������?', '6', '1', NULL, '2006-01-04 13:42:21', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('211', '��������� �������� ���������', 'ALLOW_CATEGORY_DESCRIPTIONS', 'true', '��������� ���������� �������� ��� ���������.', '1', '19', '2003-10-05 19:17:30', '2003-08-02 13:42:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('191', '������ �� ���������', 'DEFAULT_TEMPLATE', 'vam', '����� �� ������ ������� ������, ������������ � �������� �� ���������.', '1', '0', '2004-01-04 05:37:39', '2003-03-07 22:45:35', NULL, 'tep_cfg_pull_down_template_list(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('272', '����������� ������������: ���./����.', 'DOWN_FOR_MAINTENANCE', 'false', '����������� ������������. ���� ��������, �� � �������� ������ ����� ������ ������ � ����� �������� �������������� � ���������� ������������ ������������ ��������.<br>true - ��������<br>false - ���������', '16', '1', '2004-02-07 14:19:08', '2003-08-19 20:45:30', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('273', '����������� ������������: ��� �����', 'DOWN_FOR_MAINTENANCE_FILENAME', 'down_for_maintenance.php', '����, ������� ����� ������� � ��������, ���� �������� ����������� ������������ ��������. �� ��������� - down_for_maintenance.php', '16', '2', NULL, '2003-08-19 20:45:30', NULL, '');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('274', '����������� ������������: �� ���������� �����', 'DOWN_FOR_MAINTENANCE_HEADER_OFF', 'false', '��� ���������� ����������� ������������ �� ������ ��������� ���������� ����� ��������<br>true - �� ����������<Br>false - ����������', '16', '3', NULL, '2003-08-19 20:45:30', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('275', '����������� ������������: �� ���������� ����� �������', 'DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF', 'true', '��� ���������� ����������� ������������ �� ������ ��������� ���������� ����� ������� ��������<br>true - �� ����������<Br>false - ����������', '16', '4', '2003-08-19 22:08:37', '2003-08-19 20:45:30', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('276', '����������� ������������: �� ���������� ������ �������', 'DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF', 'true', '��� ���������� ����������� ������������ �� ������ ��������� ���������� ������ ������� ��������<br>true - �� ����������<Br>false - ����������', '16', '5', '2003-08-21 22:50:51', '2003-08-19 20:45:30', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('277', '����������� ������������: �� ���������� ������ �����', 'DOWN_FOR_MAINTENANCE_FOOTER_OFF', 'false', '��� ���������� ����������� ������������ �� ������ ��������� ���������� ������ ����� ��������<br>true - �� ����������<Br>false - ����������', '16', '6', NULL, '2003-08-19 20:45:30', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('278', '����������� ������������: �� ���������� ����', 'DOWN_FOR_MAINTENANCE_PRICES_OFF', 'false', '��� ���������� ����������� ������������ �� ������ ��������� ���������� ���� �� ������ � ��������<br>true - �� ����������<Br>false - ����������', '16', '7', NULL, '2003-08-19 20:45:30', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('279', '����������� ������������: ��������� ��������� IP �����', 'EXCLUDE_ADMIN_IP_FOR_MAINTENANCE', '������� ��� IP �����', '��� ���������� IP ������ ������� ����� �������� ���� ��� ���������� ������ ����������� ������������. ������ ����� ��������� IP ����� �������������� ��������.', '16', '8', '2003-03-21 13:43:22', '2003-03-21 21:20:07', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('280', '���������� ����������� �������� ����� ������ �� ����������� ����', 'WARN_BEFORE_DOWN_FOR_MAINTENANCE', 'false', '������������� ����������� ����� ������ �� ����������� ������������. ���� ����������� ������������ ��� ��������, �� ������ ����� ������������� ��������������� � false.', '16', '9', '2003-11-19 21:38:35', '2003-03-21 11:42:47', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('281', '����� �����������', 'PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', '������� ����� ������ �� ����������� ������������ 19 ���� 2004 �.', '������� ����� �����������.', '16', '10', '2003-08-19 22:26:55', '2003-03-21 11:42:47', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('282', '���������� ���� ��������� ������ ����������� ������������', 'DISPLAY_MAINTENANCE_TIME', 'false', '���������� ���� ��������� ������ ����������� ������������.', '16', '11', '2003-08-19 22:19:57', '2003-03-21 11:42:47', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('283', '���������� ������ ������ ������ ����������� ������������', 'DISPLAY_MAINTENANCE_PERIOD', 'true', '���������� � ������� ������ ������� ������� ����� ���������� � ������ ����������� ������������.', '16', '12', '2004-02-07 14:13:18', '2003-03-21 11:42:47', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('284', '����� ������ ������ ����������� ������������', 'TEXT_MAINTENANCE_PERIOD_TIME', '30 �����', '������� ����� ������ �������� � ������ ����������� ������������', '16', '13', '2004-02-07 14:18:24', '2003-03-21 11:42:47', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('285', '���������� ������, ���������', 'CATEGORIES_SORT_ORDER', 'model', '<b>��������� ��������:<br>products_name<br>products_name-desc<br>model<br>model-desc</b>', '1', '99', '2003-08-28 21:53:38', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1238', '����', 'MODULE_SHIPPING_FREESHIPPER_ZONE', '0', '���� ������� ����, �� ������ ������ �������� ����� ����� ������ ����������� �� ��������� ����.', '6', '0', NULL, '2004-02-08 13:30:00', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1237', '�����', 'MODULE_SHIPPING_FREESHIPPER_TAX_CLASS', '0', '������������ �����.', '6', '0', NULL, '2004-02-08 13:30:00', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1236', '���������', 'MODULE_SHIPPING_FREESHIPPER_COST', '0.00', '��������� ������������� ������� ������� ��������.', '6', '6', NULL, '2004-02-08 13:30:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1235', '��������� ���������� ��������', 'MODULE_SHIPPING_FREESHIPPER_STATUS', '1', '�� ������ ��������� ������ ���������� ��������?', '6', '5', NULL, '2004-02-08 13:30:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1239', '������� ����������', 'MODULE_SHIPPING_FREESHIPPER_SORT_ORDER', '1', '������� ���������� ������.', '6', '0', NULL, '2004-02-08 13:30:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('351', '��������� ������', 'MIN_DISPLAY_XSELL', '1', '����������� ���������� �������, ��������� � ����� ��������� ������', '2', '17', '2003-08-28 22:55:49', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('998', '���������� ������� � ��������� �������� � �������', 'SHOW_SHIPPING_ESTIMATOR', 'true', '���������� ���������� � �������� � ��������� �������� � �������?<br>true - ����������.<br>false - �� ����������.', '7', '102', '2003-11-02 00:06:53', '2003-08-14 00:24:04', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('999', '���������� ������������� ������ � �������', 'SHOW_XSELL_CART', 'false', '���������� ������������� � �������?<br>true - ����������.<br>false - �� ����������.', '7', '102', '2003-11-02 00:06:53', '2003-08-14 00:24:04', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('235', '������� � ����� ������������� ������ �� ������� ��������', 'MAX_DISPLAY_FEATURED_PRODUCTS', '6', '������������ ���������� ������ � ����� ������������� ������ �� ������� ��������', '3', '170', NULL, '2003-08-14 00:25:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('236', '������� �� ����� �������� ������������� �������', 'MAX_DISPLAY_FEATURED_PRODUCTS_LISTING', '10', '���������� ������ �� ����� �������� ������������� �������', '3', '171', NULL, '2003-08-14 00:25:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('234', '���������� ������������� ������ �� ������� ��������', 'SHOW_MAIN_FEATURED_PRODUCTS', 'true', 'true - ����������<br>false - �� ����������', '1', '20', NULL, '2003-08-14 00:25:08', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1126', '���������� ����������� ������ �������, ������� ��������� ������', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS', '2', '���������� ����� (������) ����� ��������� ������ � ������, ���� ����� ����� ����� ��������� ������ (� ������ id ��� ������� ������). �� ��������� ���������� ��������� ��� ������� �� �������� ��� ������ (id ��� 2).', '13', '92', '2003-02-18 13:22:32', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1125', '��������������� � ������������� �������� ����������� �����', 'DOWNLOADS_CONTROLLER_ON_HOLD_MSG', '<BR><font color=\"FF0000\">��������: �� �� ������� ������� �����, ���� ������ ������ �� ����� ������������</font>', '�� ������ ������� ���������, ������� ����� �������� �������, � ������, ���� �� ������� ������� ��� ������������ �����.', '13', '91', '2003-02-18 13:22:32', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1124', '����� ���������� ����������', 'DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE', '4', '����� ID ����� ������� ������ ���������� ���������� ���� ������������� ������ ��� ���������� (����) � ������������ ���������� ���������� - �� ��������� ������������ (id ��� 4).', '13', '90', '2003-02-18 13:22:32', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1047', '������� ��������', 'STORE_LOGO', 'oscommerce.gif', '������� ��������', '0', '2', '2003-11-25 23:54:35', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1143', '��������� ������������� ������ �������������� ��������?', 'ULTIMATE_ADDITIONAL_IMAGES', 'disable', '�� ������ ��������/��������� ������ �������������� �������� ��� ������.', '4', '10', '2004-03-04 16:00:18', '2004-01-02 10:31:48', NULL, 'tep_cfg_select_option(array(\'enable\', \'disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1144', '������ �������������� ��������', 'ULT_THUMB_IMAGE_WIDTH', '100', '������ �������������� �������� � ��������. �������� ���� ������ ��� ��������� 0, ���� �� ������ ������������ ������ ��������. ����������� ������ �������� �� ������ ����������� ���������� �������� ��������.', '4', '11', '2004-04-29 09:53:39', '2004-01-02 10:31:48', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1145', '������ �������������� ��������', 'ULT_THUMB_IMAGE_HEIGHT', '80', '������ �������������� �������� � ��������. �������� ���� ������ ��� ��������� 0, ���� �� ������ ������������ ������ ��������. ����������� ������ �������� �� ������ ����������� ���������� �������� ��������.', '4', '12', '2004-04-29 09:53:44', '2004-01-02 10:31:48', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1146', '������ ������� ��������', 'MEDIUM_IMAGE_WIDTH', '', '������ ������� �������� � ��������. �������� ���� ������ ��� ��������� 0, ���� �� ������ ������������ ������ ������� ��������. ����������� ������ ������� �������� �� ������ ����������� ���������� �������� ��������.', '4', '13', '2004-01-02 11:11:59', '2004-01-02 10:31:48', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1147', '������ ������� ��������', 'MEDIUM_IMAGE_HEIGHT', '', '������ ������� �������� � ��������. �������� ���� ������ ��� ��������� 0, ���� �� ������ ������������ ������ ������� ��������. ����������� ������ ������� �������� �� ������ ����������� ���������� �������� ��������.', '4', '14', '2004-01-02 11:11:49', '2004-01-02 10:31:48', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1148', '������ �������� ��� pop-up ����', 'LARGE_IMAGE_WIDTH', '', '������ �������� ��� pop-up ���� � ��������. �������� ���� ������ ��� ��������� 0, ���� �� ������ ������������ ������ �������� ��� pop-up ����. ����������� ������ �������� ��� pop-up ���� �� ������ ����������� ���������� �������� ��������.', '4', '15', '2004-04-24 14:47:36', '2004-01-02 10:31:48', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1149', '������ �������� ��� pop-up ����', 'LARGE_IMAGE_HEIGHT', '', '������ �������� ��� pop-up ���� � ��������. �������� ���� ������ ��� ��������� 0, ���� �� ������ ������������ ������ �������� ��� pop-up ����. ����������� ������ �������� ��� pop-up ���� �� ������ ����������� ���������� �������� ��������.', '4', '16', '2004-04-24 14:47:39', '2004-01-02 10:31:48', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1201', '������� ����������� �����������, ������� ������� ����������, ���', 'NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', '0', '���� �� �� ������ ���������� ���������� ���������� ������������������ � �������� �����������, ������� 0. ����� ���������� ������������������ ����������� ����������, ��������, ��������� � 10$ - ������� 10, ���� 25.5$ - ������� 25.5 � �.�.', '1', '31', NULL, '2003-12-05 05:01:41', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1202', '��� ������, ������� ������� ����������, ��������� ����������� �', 'NEW_SIGNUP_DISCOUNT_COUPON', '', '���� �� �� ������ ������ ����� �����������, ��������� �����������, ������ �������� ���� ������, ���� ������� ��� ������������� ������, ������� �� ������ ������ ���� ������������������ �����������.', '1', '32', NULL, '2003-12-05 05:01:41', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1475', 'Last Database Restore', 'DB_LAST_RESTORE', 'loaded6_v4.sql', 'Last database restore file', '6', '0', '0000-00-00 00:00:00', '2005-03-27 12:59:23', '', '');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1604', '����', 'MODULE_SHIPPING_FLAT_ZONE', '0', '���� ������� ����, �� ������ ������ �������� ����� ����� ������ ����������� �� ��������� ����.', '6', '0', NULL, '2006-03-25 18:30:56', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1603', '�����', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', '������������ �����.', '6', '0', NULL, '2006-03-25 18:30:56', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1602', '���������', 'MODULE_SHIPPING_FLAT_COST', '5.00', '��������� ������������� ������� ������� ��������.', '6', '0', NULL, '2006-03-25 18:30:56', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1601', '��������� ������ ���������� ��������', 'MODULE_SHIPPING_FLAT_STATUS', 'True', '�� ������ ��������� ������ ���������� ��������?', '6', '0', NULL, '2006-03-25 18:30:56', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1278', '��������� ������ ���������� �����', 'MODULE_SHIPPING_TABLE_STATUS', 'True', '�� ������ ��������� ������ �������� ���������� �����?', '6', '0', NULL, '2004-02-12 13:27:36', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1279', '��������� ��������', 'MODULE_SHIPPING_TABLE_COST', '100000:0', '��������� �������� �������������� �� ������ ������ ���� ������ ��� ����� ��������� ������. ��������: 25:8.50,50:5.50,� �.�... ��� ������, ��� �� 25 �������� ����� ������ 8.50, �� 25 �� 50 ����� ������ 5.50 � �.�.', '6', '0', NULL, '2004-02-12 13:27:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1280', '����� �������', 'MODULE_SHIPPING_TABLE_MODE', 'price', '��������� ������� �������� ������ �� ������ ���� ������ (weight) ��� ������ �� ����� ��������� ������ (price).', '6', '0', NULL, '2004-02-12 13:27:36', NULL, 'tep_cfg_select_option(array(\'weight\', \'price\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1281', '���������', 'MODULE_SHIPPING_TABLE_HANDLING', '4', '��������� ������������� ������� ������� ��������.', '6', '0', NULL, '2004-02-12 13:27:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1282', '�����', 'MODULE_SHIPPING_TABLE_TAX_CLASS', '0', '������������ �����.', '6', '0', NULL, '2004-02-12 13:27:36', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1283', '����', 'MODULE_SHIPPING_TABLE_ZONE', '0', '���� ������� ����, �� ������ ������ �������� ����� ����� ������ ����������� �� ��������� ����.', '6', '0', NULL, '2004-02-12 13:27:36', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1284', '������� ����������', 'MODULE_SHIPPING_TABLE_SORT_ORDER', '0', '������� ���������� ������.', '6', '0', NULL, '2004-02-12 13:27:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1308', '������� ���������� ������', 'GUEST_ON', 'true', '��������� ����������� ������ ��������� �����.', '40', '1', '2003-09-09 13:07:44', '2003-09-09 12:10:51', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1311', '������� �� ����� �������� � �����������������', 'MAX_PROD_ADMIN_SIDE', '15', '���������� ������ �� ����� �������� � �����������������', '3', NULL, '2004-08-08 19:30:36', '2003-11-10 14:54:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1314', '������ ������ ������', 'PRODUCT_LISTING_DISPLAY_STYLE', 'list', '�� ������ �������, � ����� ������� �������� �����, � ���� ������� - list, ���� � ������� - columns.', '8', '0', NULL, '2004-04-11 14:10:36', '', 'tep_cfg_select_option(array(\'list\', \'columns\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1315', '���������� ������ � ����� ������', 'PRODUCT_LIST_COL_NUM', '5', '������ ����� ������������� ������ ���� � �������� ������ ������ ������ ����� ������ � ������� - columns. �� ������ �������, ����� ���������� ������ ����� ���������� � ����� ������.', '8', '1', '2004-06-16 15:39:41', '2004-04-11 14:10:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1564', '�����', 'MODULE_PAYMENT_MG_3', 'Moscow', 'City', '6', '1', NULL, '2006-03-25 18:25:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1563', '�������', 'MODULE_PAYMENT_MG_2', 'Ivanov', 'Last Name', '6', '1', NULL, '2006-03-25 18:25:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1562', '���', 'MODULE_PAYMENT_MG_1', 'Ivan', 'First Name', '6', '1', NULL, '2006-03-25 18:25:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1592', '������', 'MODULE_PAYMENT_WU_4', 'Russia', 'Country', '6', '1', NULL, '2006-03-25 18:26:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1586', '����� ������ Z ��������', 'MODULE_PAYMENT_WEBMONEY_3', 'Z111111111111', '������� ����� ������ Z ��������', '6', '1', NULL, '2006-03-25 18:26:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1458', '������� ����������.', 'MODULE_PAYMENT_COD_SORT_ORDER', '0', '������� ���������� ������.', '6', '0', NULL, '2004-08-12 16:40:17', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1708', '���', 'MODULE_PAYMENT_RUS_SCHET_7', 'test', '������� ��� ���', '6', '1', NULL, '2007-06-03 14:41:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1707', '����������', 'MODULE_PAYMENT_RUS_SCHET_6', 'test', '���������� �������', '6', '1', NULL, '2007-06-03 14:41:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1706', '���', 'MODULE_PAYMENT_RUS_SCHET_5', 'test', '������� ���', '6', '1', NULL, '2007-06-03 14:41:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1457', '����', 'MODULE_PAYMENT_COD_ZONE', '0', '���� ������� ����, �� ������ ������ ������ ����� ����� ������ ����������� �� ��������� ����.', '6', '2', NULL, '2004-08-12 16:40:17', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1585', '����� ������ R ��������', 'MODULE_PAYMENT_WEBMONEY_2', 'R11111111111', '������� ����� ������ R ��������', '6', '1', NULL, '2006-03-25 18:26:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1584', '��� WM �������������', 'MODULE_PAYMENT_WEBMONEY_1', '11111111111', '������� ��� WM �������������', '6', '1', NULL, '2006-03-25 18:26:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1583', '������ ����� ������� WebMoney', 'MODULE_PAYMENT_WEBMONEY_STATUS', '1', '�� ������ ������������ ������ ������ ����� ������� WebMoney? 1 - ��, 0 - ���', '6', '1', NULL, '2006-03-25 18:26:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1591', '�����', 'MODULE_PAYMENT_WU_3', 'Moscow', 'City', '6', '1', NULL, '2006-03-25 18:26:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1590', '�������', 'MODULE_PAYMENT_WU_2', 'Ivanov', 'Last Name', '6', '1', NULL, '2006-03-25 18:26:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1589', '���', 'MODULE_PAYMENT_WU_1', 'Ivan', 'First Name', '6', '1', NULL, '2006-03-25 18:26:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1588', 'Western Union', 'MODULE_PAYMENT_WU_STATUS', '1', '�� ������ ������������ ������ Western Union? 1 - ��, 0 - ���', '6', '1', NULL, '2006-03-25 18:26:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1365', '���������� ������ ����� ������', 'DISPLAY_NEW_ARTICLES', 'true', '���������� ������ ����� ������ � ����� ������?', '456', '1', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1366', '���������� ����, � ������� ������� ������ ��������� �����', 'NEW_ARTICLES_DAYS_DISPLAY', '30', '����� ���������� ���� ����� ����������, ������ ��������� ����� � ������������ �� �������� ����� ������.', '456', '2', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1367', '���������� ������ �� ����� �������� ����� ������', 'MAX_NEW_ARTICLES_PER_PAGE', '10', '������������ ���������� ������, ��������� �� ����� �������� ����� ������.', '456', '3', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1368', '���������� ������ ��� ������', 'DISPLAY_ALL_ARTICLES', 'true', '���������� ������ ��� ������ � ����� ������?', '456', '4', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1369', '���������� ������ �� ����� ��������', 'MAX_ARTICLES_PER_PAGE', '10', '������������ ���������� ������, ��������� �� ����� ��������.', '456', '5', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1370', '������������ ���������� ����������� � ���������� ������', 'MAX_DISPLAY_UPCOMING_ARTICLES', '5', '������������ ���������� ������, ��������� � ����� ��������� � ����������', '456', '6', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1371', '��������� ������ � �������', 'ENABLE_ARTICLE_REVIEWS', 'true', '��������� ����������� ��������� ���� ������ � �������.', '456', '7', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1372', '��������� ������� ���������� ���������', 'ENABLE_TELL_A_FRIEND_ARTICLE', 'false', '��������� ����������� ����������� ������� ���������� ���������.', '456', '8', '2004-08-12 17:15:58', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1373', '����������� ���������� ������, ���������� � ����� ��������� ����', 'MIN_DISPLAY_ARTICLES_XSELL', '1', '����������� ���������� ������, ���������� � ����� ��������� ������.', '456', '9', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1374', '������������ ���������� ������, ���������� � ����� ��������� ���', 'MAX_DISPLAY_ARTICLES_XSELL', '6', '������������ ���������� ������, ���������� � ����� ��������� ������.', '456', '10', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1375', '���������� ������� ������', 'SHOW_ARTICLE_COUNTS', 'true', '���������� ���������� ������ � ������ �������.', '456', '11', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1376', '������������ ����� ���� �����', 'MAX_DISPLAY_AUTHOR_NAME_LEN', '20', '������������ ���������� ��������, ��������� � ����� ������.', '456', '12', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1377', '������ ������ ������ �������', 'MAX_DISPLAY_AUTHORS_IN_A_LIST', '1', '���� ����� ������� ������ ��������� �����, ����� � ����� ������ ��������� ������� ������, ���� ����� ������� ������ ��������� �����, ����� ��������� drop-down ������ �������.', '456', '13', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1378', '������ � ���� ����������� ����', 'MAX_AUTHORS_LIST', '1', '������ ����� ������������ ��� ��������� ����� ������, ���� ������� ����� 1, �� ������ ������� ��������� � ���� ������������ drop-down ������. ���� ������� ����� ������ �����, �� ��������� ������ X �������������� � ���� ����������� ����.', '456', '14', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1379', '���������� ������ � ������ ������', 'DISPLAY_AUTHOR_ARTICLE_LISTING', 'true', '���������� ������ � ������ ������?', '456', '15', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1380', '���������� ������ � ������ ������', 'DISPLAY_TOPIC_ARTICLE_LISTING', 'true', '���������� ������ � ������ ������?', '456', '16', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1381', '���������� Meta Description � ������ ������', 'DISPLAY_ABSTRACT_ARTICLE_LISTING', 'true', '���������� Meta Description � ������ ������?', '456', '17', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1382', '���������� ���� ���������� � ������ ������', 'DISPLAY_DATE_ADDED_ARTICLE_LISTING', 'true', '���������� ���� ���������� � ������ ������?', '456', '18', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1383', '������������ ����� ���� Meta Description', 'MAX_ARTICLE_ABSTRACT_LENGTH', '300', '������������ ���������� �������� ���� Meta Description.', '456', '19', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1384', '���������� ������ ������/������', 'ARTICLE_LIST_FILTER', 'true', '���������� ������ ������/������?', '456', '20', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1385', '������������ ��������� ���������/���������� ��������', 'ARTICLE_PREV_NEXT_BAR_LOCATION', 'both', '������������ ��������� ���������/���������� ��������<br><br>top - ����<br>bottom - ���<br>both - (����+���)', '456', '21', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'top\', \'bottom\', \'both\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1396', '����� � ��������� ������', 'QUICKSEARCH_IN_DESCRIPTION', 'true', '��� ������ ������ � ������� ����� ������� �����, �� ������ �������, ��� ������ ������, ������ �� ��������� - FALSE ��� ������ � ��������� + ��������� - TRUE', '1', '113', '2004-07-06 16:13:39', '2004-06-10 16:42:11', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1397', '���������� �����, ������������ �� �������� ��������� � ����', 'CONTACT_US_LIST', '����� ������������ <email@address1>, ����� �������� <email@address2>', '�� ������ ������� ������ ����������� �� �������� ��������� � ����. ������ ������: ��� 1 &lt;email@address1&gt;, ��� 2 &lt;email@address2&gt;. ���� �� ������ �������� ����� ������ ���������� �����, ������ �������� ���� ������.', '1', '113', '2004-07-18 13:56:11', '2004-06-10 16:42:11', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1456', '��������� ������ ������ ��������� ��� ���������', 'MODULE_PAYMENT_COD_STATUS', 'True', '�� ������ ��������� ������������� ������ ��� ���������� �������?', '6', '1', NULL, '2004-08-12 16:40:17', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1595', '����� ������ ����� � ������� ������-������', 'MODULE_PAYMENT_YANDEX_1', '11111111111', '������� ����� ������ ����� � ������� ������-������.', '6', '1', NULL, '2006-03-25 18:26:17', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1594', '������ ����� ������� ������-������', 'MODULE_PAYMENT_YANDEX_STATUS', '1', '�� ������ ������������ ������ ������ ����� ������� ������-������? 1 - ��, 0 - ���', '6', '1', NULL, '2006-03-25 18:26:17', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1407', '����������� ����� ������', 'MIN_ORDER', '0', '���� ����� ������ ����� ������ ���������, ����� ����� ������ ����� ��������. ���������� ������ �����, ��� ������� ������ ($, ���. � �.�.). ��������� 0, ���� �� �� ������ ������������ ����������� ����� ������.', '2', '17', NULL, '2004-07-31 12:38:49', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1408', '��������� ������������� ���������� ������������ � �������', 'ALLOW_GIFT_VOUCHERS', 'false', '�� ������ �������� - true ��� ��������� - false ����������� ������������� ���������� ������������ � ������� ��� ���������� ������.', '1', '113', '2004-06-10 16:54:12', '2004-06-10 16:42:11', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('400', '���������� ��������� ��� ��� ������', 'XPRICES_NUM', '1', '����� �� ������ �������, ����� ���������� ��� ����� ����� ������ �����<br><br>��������, �� ������ ����������� �� ������ ���������� ���������� ���� ���� ������, ����������� �� ������ �������� - ���������� ������.', '1', '30', '2003-11-11 18:33:04', '0000-00-00 00:00:00', 'tep_update_prices', 'tep_cfg_pull_down_prices(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1409', '���������� ���� �����������', 'ALLOW_GUEST_TO_SEE_PRICES', 'true', '���� ����� false, �� ���� � �������� ����� ������ ������ ������������������ ����������, ���� true - ��� ���������� ����� ������ ���� � ��������.', '1', '31', '0000-00-00 00:00:00', '2004-03-15 14:59:05', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1410', '������ ��� �����������', 'GUEST_DISCOUNT', '0', '������ ��� ������� ����������� ��������. ��� ������������������ � �������� ����������� ������ ����� �� ���������.', '1', '32', '0000-00-00 00:00:00', '2004-03-15 14:59:05', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1459', '������ ������', 'MODULE_PAYMENT_COD_ORDER_STATUS_ID', '0', '������, ����������� � �������������� ������� ������ ������ ����� ��������� ��������� ������.', '6', '0', NULL, '2004-08-12 16:40:17', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1461', '������� ���������', 'ENABLE_LINKS_COUNT', 'True', '���������� ���������� ��������� �� ������.', '901', '1', NULL, '2004-09-13 13:20:32', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1462', '������������ �������� URL ������', 'ENABLE_SPIDER_FRIENDLY_LINKS', 'True', '������������ �������� URL ������.', '901', '2', NULL, '2004-09-13 13:20:32', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1463', '������ ��������', 'LINKS_IMAGE_WIDTH', '120', '������ �������� ������.', '901', '3', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1464', '������ ��������', 'LINKS_IMAGE_HEIGHT', '60', '������ �������� ������.', '901', '4', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1465', '���������� ��������', 'LINK_LIST_IMAGE', '1', '������� ������� ������ ������� ����, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�. ���� ������� 0, �� ������ ���� �� ����� ������������.', '901', '5', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1466', '���������� URL', 'LINK_LIST_URL', '4', '������� ������� ������ ������� ����, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�. ���� ������� 0, �� ������ ���� �� ����� ������������.', '901', '6', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1467', '���������� �������� ������', 'LINK_LIST_TITLE', '2', '������� ������� ������ ������� ����, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�. ���� ������� 0, �� ������ ���� �� ����� ������������.', '901', '7', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1468', '���������� �������� ������', 'LINK_LIST_DESCRIPTION', '3', '������� ������� ������ ������� ����, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�. ���� ������� 0, �� ������ ���� �� ����� ������������.', '901', '8', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1469', '���������� ���������� ���������', 'LINK_LIST_COUNT', '0', '������� ������� ������ ������� ����, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�. ���� ������� 0, �� ������ ���� �� ����� ������������.', '901', '9', '2006-01-16 19:40:25', '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1470', '����������� ���������� �������� ���� �������� �����', 'ENTRY_LINKS_TITLE_MIN_LENGTH', '2', '����������� ���������� ��������.', '901', '10', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1471', '����������� ���������� �������� ���� URL �����', 'ENTRY_LINKS_URL_MIN_LENGTH', '10', '����������� ���������� ��������.', '901', '11', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1472', '����������� ���������� �������� ���� ��������', 'ENTRY_LINKS_DESCRIPTION_MIN_LENGTH', '10', '����������� ���������� ��������.', '901', '12', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1473', '����������� ���������� �������� ���� ���� ���', 'ENTRY_LINKS_CONTACT_NAME_MIN_LENGTH', '2', '����������� ���������� ��������.', '901', '13', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1474', '����� ��� ��������', 'LINKS_CHECK_PHRASE', 'kypi.ru', '����� (������ ����� ��������), ������� ����� �������� ��� �������� ������. ���������� ��� ����, ����� ���������, ��� �� �����, ����������� � ������� ������, ����������� ������ �� ��� �������.', '901', '14', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('263', '���������� ������� ����������', 'PRODUCT_SORT_ORDER', '0', '������� ������� ������ ������� ���� � ����� ��������, �.�. ������� �����. ���� ������� 1, �� ������ ���� ����� ����� �� ������ �����, ���� 2, �� ���� ����� �������� �����(������) ����, � �������� ������� ����� 1 � �.�. 0 - ������ �� ���������� ������ ����', '8', '29', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1001', '���������� ��� ������', 'DISPLAY_MODEL', 'true', '����������/�� ���������� ��� ������', '300', '1', '2003-06-04 05:04:11', '2003-06-04 04:18:06', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1002', '���������� ��� ������', 'MODIFY_MODEL', 'true', '����������/�� ���������� ��� ������', '300', '2', '2003-06-04 05:04:07', '2003-06-04 04:25:57', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1003', '���������� �������� ������', 'MODIFY_NAME', 'true', '����������/�� ���������� �������� ������', '300', '3', '2003-06-04 05:04:01', '2003-06-04 04:30:31', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1004', '���������� ������ ������', 'DISPLAY_STATUT', 'true', '����������/�� ���������� ������ ������', '300', '4', '2003-06-04 05:07:11', '2003-06-04 05:00:58', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1005', '���������� ��� ������', 'DISPLAY_WEIGHT', 'true', '����������/�� ���������� ��� ������', '300', '5', '2003-06-04 05:06:44', '2003-06-04 04:33:16', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1006', '���������� ���������� ������', 'DISPLAY_QUANTITY', 'true', '����������/�� ���������� ���������� ������', '300', '6', '2003-06-04 05:06:48', '2003-06-04 04:34:34', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1007', '���������� ������� ����������', 'DISPLAY_SORT_ORDER', 'true', '����������/�� ���������� ������� ����������', '300', '6', '2003-06-04 05:06:48', '2003-06-04 04:34:34', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1008', '���������� ������� ��� ������', 'DISPLAY_ORDER_MIN', 'true', '����������/�� ���������� ������� ��� ������', '300', '6', '2003-06-04 05:06:48', '2003-06-04 04:34:34', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1009', '���������� ���', 'DISPLAY_ORDER_UNITS', 'true', '����������/�� ���������� ���', '300', '6', '2003-06-04 05:06:48', '2003-06-04 04:34:34', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1010', '���������� �������� ������', 'DISPLAY_IMAGE', 'false', '����������/�� ���������� �������� ������', '300', '7', '2003-06-04 05:06:52', '2003-06-04 04:36:57', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1011', '���������� XML', 'DISPLAY_XML', 'true', '����������/�� ���������� ������� XML', '300', '4', '2003-06-04 05:07:11', '2003-06-04 05:00:58', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1012', '���������� �������������� ������', 'MODIFY_MANUFACTURER', 'true', '����������/�� ���������� ������������� ������', '300', '8', '2003-06-04 05:06:57', '2003-06-04 04:37:40', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1013', '���������� �����', 'MODIFY_TAX', 'true', '����������/�� ���������� �����', '300', '9', '2003-06-04 05:06:40', '2003-06-04 04:31:53', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1014', '���������� ���� � ��������', 'DISPLAY_TVA_OVER', 'true', '����������/�� ���������� ���� � ��������', '300', '10', '2003-06-04 05:07:02', '2003-06-04 04:38:45', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1015', '���������� ���� � �������� ��� ��������� ����', 'DISPLAY_TVA_UP', 'true', '����������/�� ���������� ���� � �������� ��� ��������� ����', '300', '11', '2003-06-04 05:07:06', '2003-06-04 04:40:12', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1016', '���������� ������ �� �������� ������', 'DISPLAY_PREVIEW', 'true', '����������/�� ���������� ������ �� �������� ������', '300', '12', '2003-06-04 05:19:13', '2003-06-04 05:15:50', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1017', '���������� ������ �� �������������� ������', 'DISPLAY_EDIT', 'true', '����������/�� ���������� ������ �� �������������� ������', '300', '13', '2003-06-04 05:19:08', '2003-06-04 05:17:05', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1018', '���������� �������������', 'DISPLAY_MANUFACTURER', 'false', '����������/�� ���������� �������������', '300', '7', '2003-06-04 05:19:08', '2003-06-04 05:17:05', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1019', '���������� �����', 'DISPLAY_TAX', 'false', '����������/�� ���������� �����', '300', '8', '2003-06-04 05:19:08', '2003-06-04 05:17:05', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1020', '���������� ����������� ��������� ��������� ���', 'ACTIVATE_COMMERCIAL_MARGIN', 'true', '����������/�� ���������� ����������� ���������  ��������� ���', '300', '14', '2003-06-04 05:19:08', '2003-06-04 05:17:05', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1476', '��������� ���������� ���������� �� �������� ���������� ������', 'ALLOW_ATTRIBUTES_IN_PRODUCT_EDIT_PAGE', 'true', '�� ������ �������� - true ��� ��������� - false ����������� ���������� ���������� ������� ����� �� �������� ����������/�������������� �������.', '1', '114', '2004-06-10 16:54:12', '2004-06-10 16:42:11', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1477', '�������� ������������ ��� ������� ������ � ���������', 'SHOW_SUBCATEGORIES_WHEN_CATEGORIES_HAS_PRODUCTS', 'true', '���� � ��������� ���� ����� � � ������ ��������� ���� ������������, �� �� ��������� (true), ����� � ����� ���������, �� ������� ������ ������������ � ������ ������� ���������. ����� ��������� ����� ������������, ��� ����� ��������� false.', '1', '114', '2004-06-10 16:54:12', '2004-06-10 16:42:11', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1479', 'ICQ �����', 'STORE_OWNER_ICQ_NUMBER', '��� �����', 'ICQ �����, ������� ����� ������� � ����� ����������� � ��������.', '1', '3', '2004-08-12 17:03:20', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1480', 'Street Address', 'ACCOUNT_STREET_ADDRESS', 'true', 'Display Street Address on the Create Account page', '5', '6', '2005-09-30 12:00:25', '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1481', 'City', 'ACCOUNT_CITY', 'true', 'Display City on the Create Account page', '5', '7', NULL, '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1482', 'Post Code/ZIP', 'ACCOUNT_POSTCODE', 'true', 'Display Post Code/ZIP on the Create Account page', '5', '8', '2005-09-30 12:00:22', '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1483', 'Country', 'ACCOUNT_COUNTRY', 'true', 'Display Country on the Create Account page', '5', '9', NULL, '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1484', 'Telephone', 'ACCOUNT_TELE', 'true', 'Display Telephone Number on the Create Account page', '5', '10', NULL, '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1485', 'Fax', 'ACCOUNT_FAX', 'true', 'Display Fax Number on the Create Account page', '5', '11', NULL, '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1486', 'Newsletter', 'ACCOUNT_NEWS', 'true', 'Display Newsletter option on the Create Account page', '5', '12', NULL, '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1487', '������ �������', 'EXTRA_PRODUCT_PRICE_ID', 'true', '��������/��������� ������� �������', '1', '114', '2005-10-12 14:28:18', '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1492', 'Use tabs in admin', 'ENABLE_TABS', 'true', 'Enable tabs in admin', '1', '114', '2005-10-12 14:28:18', '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1493', 'Master Password', 'MASTER_PASS', '', 'This password will allow you to login to any customers account.', '1', '115', '2007-06-15 07:10:52', '2007-06-15 07:10:52', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1488', 'Max Wish List', 'MAX_DISPLAY_WISHLIST_PRODUCTS', '12', 'How many wish list items to show per page on the main wishlist.php file', '12954', '0', '2005-10-23 19:32:52', '2005-10-23 19:32:52', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1489', 'Max Wish List Box', 'MAX_DISPLAY_WISHLIST_BOX', '4', 'How many wish list items to display in the infobox before it changes to a counter', '12954', '0', '2005-10-23 19:32:52', '2005-10-23 19:32:52', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1490', 'Display Emails', 'DISPLAY_WISHLIST_EMAILS', '10', 'How many emails to display when the customer emails their wishlist link', '12954', '0', '2005-10-23 19:32:52', '2005-10-23 19:32:52', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1491', 'Wishlist Redirect', 'WISHLIST_REDIRECT', 'No', 'Do you want to redirect back to the product_info.php page when a customer adds a product to their wishlist?', '12954', '0', '2005-10-23 19:32:52', '2005-10-23 19:32:52', NULL, 'tep_cfg_select_option(array(\'Yes\', \'No\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1504', 'Enable Page Cache', 'ENABLE_PAGE_CACHE', 'false', 'Enable the page cache features to reduce server load and faster page renders?<br><br>Contribution by: <b>Chemo</b>', '26229', '1', NULL, '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1505', 'Cache Lifetime', 'PAGE_CACHE_LIFETIME', '5', 'How long to cache the pages (in minutes) ?<br><br>Contribution by: <b>Chemo</b>', '26229', '2', NULL, '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1506', 'Turn on Debug Mode?', 'PAGE_CACHE_DEBUG_MODE', 'false', 'Turn on the global debug output (located at the footer) ? This affects ALL browsers and is NOT for live shops!  YOu can turn on debug mode JUST for your browser by adding \"?debug=1\" to your URL.<br><br>Contribution by: <b>Chemo</b>', '26229', '3', NULL, '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1507', 'Disable URL Parameters?', 'PAGE_CACHE_DISABLE_PARAMETERS', 'false', 'In some cases (such as search engine safe URL\'s) or large number of affiliate referrals will cause excessive page writing.<br><br>Contribution by: <b>Chemo</b>', '26229', '4', NULL, '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1508', 'Delete Cache Files?', 'PAGE_CACHE_DELETE_FILES', 'false', 'If set to true the next catalog page request will delete all the cache files and then reset this value to false again.<br><br>Contribution by: <b>Chemo</b>', '26229', '5', NULL, '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1509', 'Config Cache Update File?', 'PAGE_CACHE_UPDATE_CONFIG_FILES', 'none', 'If you have a configuration cache contribution enter the FULL path to the update file.<br><br>Contribution by: <b>Chemo</b>', '26229', '6', NULL, '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1510', '�������� ��������', 'YML_NAME', '', '�������� �������� ��� ������-������. ���� ���� ������, �� ������������ STORE_NAME.', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1511', '�������� ��������', 'YML_COMPANY', '', '�������� �������� ��� ������-������. ���� ���� ������, �� ������������ STORE_OWNER.', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1512', '�������� ��������', 'YML_DELIVERYINCLUDED', 'false', '�������� �������� � ��������� ������?', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1513', '����� � �������', 'YML_AVAILABLE', 'stock', '����� � ������� ��� ��� �����?', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, 'tep_cfg_select_option(array(\'true\', \'false\', \'stock\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1514', '�����', 'YML_AUTH_USER', '', '����� ��� ������� � YML (market.php)', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1515', '������', 'YML_AUTH_PW', '', '������ ��� ������� � YML (market.php)', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1516', '������', 'YML_REFERER', 'false', '�������� � ����� ������ �������� � ������� �� User agent ��� ip?', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, 'tep_cfg_select_option(array(\'false\', \'ip\', \'agent\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1517', '����', 'YML_STRIP_TAGS', 'true', '������� html-���� � �������?', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, 'tep_cfg_select_option(array(\'false\', \'true\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1518', '������������� � UTF-8', 'YML_UTF8', 'false', '�������������� � UTF-8?', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, 'tep_cfg_select_option(array(\'false\', \'true\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1527', '������ ������', 'MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID', '0', '������, ����������� � �������������� ����������� �����������, ������������ ������ ��������� ������, ����� ����� ��������� ������.', '6', '0', NULL, '2006-01-04 13:42:21', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1528', '������������ WYSIWYG HTML �������� ��� �������������� ������', 'HTML_AREA_WYSIWYG_DISABLE_ARTICLES', 'Disable', 'Enable - �������� HTML �������� <br>Disable - ��������� HTML ��������.', '112', '40', '2005-06-22 17:56:23', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1530', '������������ WYSIWYG HTML �������� ��� �������������� faq', 'HTML_AREA_WYSIWYG_DISABLE_FAQDESK', 'Disable', 'Enable - �������� HTML �������� <br>Disable - ��������� HTML ��������.', '112', '40', '2005-06-22 17:56:23', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1532', '������������ WYSIWYG HTML �������� ��� �������������� ��������', 'HTML_AREA_WYSIWYG_DISABLE_NEWSDESK', 'Disable', 'Enable - �������� HTML �������� <br>Disable - ��������� HTML ��������.', '112', '40', '2005-06-22 17:56:23', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1534', '������������ WYSIWYG HTML �������� ��� �������������� �������������� �������', 'HTML_AREA_WYSIWYG_DISABLE_INFOPAGES', 'Disable', 'Enable - �������� HTML �������� <br>Disable - ��������� HTML ��������.', '112', '40', '2005-06-22 17:56:23', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1561', 'Money Gram', 'MODULE_PAYMENT_MG_STATUS', '1', '�� ������ ������������ ������ Money Gram? 1 - ��, 0 - ���', '6', '1', NULL, '2006-03-25 18:25:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1705', '���./����', 'MODULE_PAYMENT_RUS_SCHET_4', 'test', '������� ��� ���./����', '6', '1', NULL, '2007-06-03 14:41:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1704', '���', 'MODULE_PAYMENT_RUS_SCHET_3', 'test', '������� ��� ���', '6', '1', NULL, '2007-06-03 14:41:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1703', '��������� ����', 'MODULE_PAYMENT_RUS_SCHET_2', 'test', '������� ��� ��������� ����', '6', '1', NULL, '2007-06-03 14:41:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1560', '������� ����������.', 'MODULE_PAYMENT_EGOLD_SORT_ORDER', '0', '������� ���������� ������.', '6', '0', NULL, '2006-03-25 18:25:13', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1565', '������', 'MODULE_PAYMENT_MG_4', 'Russia', 'Country', '6', '1', NULL, '2006-03-25 18:25:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1566', '������� ����������.', 'MODULE_PAYMENT_MG_SORT_ORDER', '0', '������� ���������� ������.', '6', '0', NULL, '2006-03-25 18:25:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1696', '���', 'MODULE_PAYMENT_RUS_BANK_7', '', '������� ���', '6', '8', NULL, '2007-06-03 14:41:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1695', '����������', 'MODULE_PAYMENT_RUS_BANK_6', '', '���������� �������', '6', '7', NULL, '2007-06-03 14:41:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1587', '������� ����������.', 'MODULE_PAYMENT_WEBMONEY_SORT_ORDER', '0', '������� ���������� ������.', '6', '0', NULL, '2006-03-25 18:26:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1593', '������� ����������.', 'MODULE_PAYMENT_WU_SORT_ORDER', '0', '������� ���������� ������.', '6', '0', NULL, '2006-03-25 18:26:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1596', '������� ����������.', 'MODULE_PAYMENT_YANDEX_SORT_ORDER', '0', '������� ���������� ������.', '6', '0', NULL, '2006-03-25 18:26:17', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1597', '��������� ������ ���������� ��������', 'MODULE_PAYMENT_FREECHARGER_STATUS', 'True', '�� ������ ��������� ������ ���������� ��������?', '6', '1', NULL, '2006-03-25 18:27:29', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1598', '������� ����������.', 'MODULE_PAYMENT_FREECHARGER_SORT_ORDER', '0', '������� ���������� ������.', '6', '0', NULL, '2006-03-25 18:27:29', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1599', '����', 'MODULE_PAYMENT_FREECHARGER_ZONE', '0', '���� ������� ����, �� ������ ������ ������ ����� ����� ������ ����������� �� ��������� ����.', '6', '2', NULL, '2006-03-25 18:27:29', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1600', '������ ������', 'MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID', '0', '������, ����������� � �������������� ������� ������ ������ ����� ��������� ��������� ������.', '6', '0', NULL, '2006-03-25 18:27:29', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1605', '������� ����������', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '0', '������� ���������� ������.', '6', '0', NULL, '2006-03-25 18:30:56', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1606', '��������� ������ �������� ���������', 'BRWCAT_ENABLE', 'true', '������������ ������ �������� ���������.', '401', '1', '2006-04-21 20:48:32', '2006-04-21 20:45:51', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1607', '�������� ���������', 'BRWCAT_ICON_MODE', 'image with caption', '��������, ���������� �������� ��� ��� � ���� ����������, �� ���:<br><br>Disabled - �� ����������.<br>Text - �������� ��� ��������.<br>Image only - ��������.<br>Image with caption - �������� + �����.', '401', '2', NULL, '2006-04-21 20:45:51', NULL, 'tep_cfg_select_option(array(\'off\', \'text\', \'image only\', \'image with caption\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1608', '������ �� ������������', 'BRWCAT_SUBCAT_MODE', 'right top', '��� ���������� ������ �� ������������:<br><br>Off - �� ���������� ������.<br>Bottom - ���������� �����.<br>Right top - ������ ������.<br>Right middle - ������ ����������.<br>Right bottom - ������ �����.', '401', '3', NULL, '2006-04-21 20:45:51', NULL, 'tep_cfg_select_option(array(\'off\', \'bottom\', \'right top\', \'right middle\', \'right bottom\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1609', '������������ ���������� ������������ � ����� ������', 'BRWCAT_ICONS_PER_ROW', '2', '������� ������������ ���������� � ����� ������:', '401', '4', NULL, '2006-04-21 20:45:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1610', '������ ����� ��������� ���������', 'BRWCAT_SUBCAT_BULLET', '�&nbsp;', '������, ������������ ����� ��������� ���������.', '401', '5', NULL, '2006-04-21 20:45:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1611', '������� ���������� ������� � ����������', 'BRWCAT_SUBCAT_COUNTS', '(%s)', '������� ���������� ������ � ����������.', '401', '6', NULL, '2006-04-21 20:45:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1612', '������ ������ �������� ���������', 'BRWCAT_NAME_CASE', 'same', '��������, � ����� ������� �������� �������� ���������.', '401', '7', NULL, '2006-04-21 20:45:51', NULL, 'tep_cfg_select_option(array(\'same\', \'upper\', \'lower\', \'title\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1694', '���', 'MODULE_PAYMENT_RUS_BANK_5', '', '������� ���', '6', '6', NULL, '2007-06-03 14:41:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1693', '���./����', 'MODULE_PAYMENT_RUS_BANK_4', '', '������� ���./����', '6', '5', NULL, '2007-06-03 14:41:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1692', '���', 'MODULE_PAYMENT_RUS_BANK_3', '', '������� ���', '6', '4', NULL, '2007-06-03 14:41:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1691', '��������� ����', 'MODULE_PAYMENT_RUS_BANK_2', '', '������� ��� ��������� ����', '6', '3', NULL, '2007-06-03 14:41:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1690', '�������� �����', 'MODULE_PAYMENT_RUS_BANK_1', '', '������� �������� �����', '6', '2', NULL, '2007-06-03 14:41:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1689', '��������� ������ ������ �� ��������� ��������� ��', 'MODULE_PAYMENT_RUS_BANK_STATUS', 'True', '�� ������ ��������� ������������� ������ ��� ���������� �������?', '6', '1', NULL, '2007-06-03 14:41:51', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1676', 'Backup Database Before Install Each CIP', 'ALLOW_SQL_BACKUP', 'true', 'Choose TRUE and database will be backuped before each CIP install.', '160', '10', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1677', 'Restore Database When Remove Each CIP', 'ALLOW_SQL_RESTORE', 'false', 'Choose TRUE and files will be restored from backup.', '160', '20', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1678', 'Backup Files Before Install Each CIP', 'ALLOW_FILES_BACKUP', 'true', 'Choose TRUE and files will be backuped.<br>Backup contain only files which CIP will modify.', '160', '15', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1679', 'Restore Files When Remove Each CIP', 'ALLOW_FILES_RESTORE', 'false', 'Choose TRUE and files will be restored from backup.', '160', '25', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1680', 'Allow Overwrite Existing Modified Files', 'ALLOW_OVERWRITE_MODIFIED', 'false', 'Choose TRUE and ADDFILE will overwrite even files with changes.', '160', '30', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1681', 'Forum Link', 'TEXT_LINK_FORUM', 'http://oscommerce.su/modules/newbb/viewtopic.php?forum=4&post_id=', 'URL for support forum', '160', '50', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1682', 'URL to the Contribution\'s page', 'TEXT_LINK_CONTR', 'http://oscommerce.su/modules/wfdownloads/singlefile.php?cid=20&lid=', 'URL for contrib\'s page', '160', '130', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1683', 'Always Display Remove-Button', 'ALWAYS_DISPLAY_REMOVE_BUTTON', 'false', 'Choose TRUE and REMOVE button will be displayed for both installed and NOT installed CIPs.', '160', '30', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1684', 'Always Display Install-Button', 'ALWAYS_DISPLAY_INSTALL_BUTTON', 'false', 'Choose TRUE and INSTALL button will be displayed for both installed and NOT installed CIPs.', '160', '30', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1685', 'Show Size Column', 'SHOW_SIZE_COLUMN', 'false', 'Choose TRUE and Size column will be shown.', '160', '300', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1686', 'Show Pack and Unpack Buttons', 'SHOW_PACK_BUTTONS', 'false', 'Choose TRUE and Pack and Unpack Buttons will be shown.', '160', '300', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1687', 'Use Log System', 'USE_LOG_SYSTEM', 'false', 'Choose TRUE and all actions will be logged into file in backups folder.', '160', '300', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1688', 'Maximum filesize for uploaded CIP', 'MAX_UPLOADED_FILESIZE', '524288', 'Set maximum filesize in bytes for files that can be uploaded on server.', '160', '310', '2007-05-12 10:48:37', '2007-05-12 10:48:37', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1702', '�������� �����', 'MODULE_PAYMENT_RUS_SCHET_1', 'test', '������� �������� ����� ��������', '6', '1', NULL, '2007-06-03 14:41:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1701', '��������� ������ ���������� �� ����', 'MODULE_PAYMENT_RUS_SCHET_STATUS', 'True', '�� ������ ��������� ������������� ������ ��� ���������� �������?', '6', '1', NULL, '2007-06-03 14:41:58', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1697', '���������� �������', 'MODULE_PAYMENT_RUS_BANK_8', '', '������� ���������� �������', '6', '9', NULL, '2007-06-03 14:41:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1698', '������� ����������.', 'MODULE_PAYMENT_RUS_BANK_SORT_ORDER', '0', '������� ���������� ������.', '6', '10', NULL, '2007-06-03 14:41:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1699', '����', 'MODULE_PAYMENT_RUS_BANK_ZONE', '0', '���� ������� ����, �� ������ ������ ������ ����� ����� ������ ����������� �� ��������� ����.', '6', '11', NULL, '2007-06-03 14:41:51', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1700', '������ ������', 'MODULE_PAYMENT_RUS_BANK_ORDER_STATUS_ID', '0', '������, ����������� � �������������� ������� ������ ������ ����� ��������� ��������� ������.', '6', '12', NULL, '2007-06-03 14:41:51', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1709', '����������� �����', 'MODULE_PAYMENT_RUS_SCHET_8', 'test', '������� ��� ��. �����', '6', '1', NULL, '2007-06-03 14:41:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1710', '������������', 'MODULE_PAYMENT_RUS_SCHET_9', 'test', '�.�.�. ������������', '6', '1', NULL, '2007-06-03 14:41:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1711', '������� ����������.', 'MODULE_PAYMENT_RUS_SCHET_SORT_ORDER', '0', '������� ���������� ������.', '6', '0', NULL, '2007-06-03 14:41:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1712', '����', 'MODULE_PAYMENT_RUS_SCHET_ZONE', '0', '���� ������� ����, �� ������ ������ ������ ����� ����� ������ ����������� �� ��������� ����.', '6', '0', NULL, '2007-06-03 14:41:58', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1713', '������ ������', 'MODULE_PAYMENT_RUS_SCHET_ORDER_STATUS_ID', '0', '������, ����������� � �������������� ������� ������ ������ ����� ��������� ��������� ������.', '6', '0', NULL, '2007-06-03 14:41:58', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Display the Payment Method dropdown?', 'ORDER_EDITOR_PAYMENT_DROPDOWN', 'true', 'Based on this selection Order Editor will display the payment method as a dropdown menu (true) or as an input field (false).', '72', '1', now(), now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Use prices from Separate Pricing Per Customer?', 'ORDER_EDITOR_USE_SPPC', 'false', 'This should be set to true only if SPPC is installed.', '72', '3', now(), now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Allow the use of AJAX to update order information?', 'ORDER_EDITOR_USE_AJAX', 'true', 'This must be set to false if using a browser on which JavaScript is disabled or not available.', '72', '4', now(), now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Select your credit card payment method', 'ORDER_EDITOR_CREDIT_CARD', 'Credit Card', 'Order Editor will display the credit card fields when this payment method is selected.', '72', '5', now(), now(), NULL, 'tep_cfg_pull_down_payment_methods(');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('������������ ������ �������� ���������?', 'OPTIONS_AS_IMAGES_ENABLED', 'true', '������ ��������� ������?', 735, 1, '2003-08-18 22:19:45', '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('����� �������� � ����� ����', 'OPTIONS_IMAGES_NUMBER_PER_ROW', '2', '������� ������������ ����� ���� ��������', 735, 2, '2003-08-20 12:58:16', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('������ �������� ��������', 'OPTIONS_IMAGES_WIDTH', '25', '�������� ������', 735, 3, '2003-08-20 12:55:16', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('������ �������� ��������', 'OPTIONS_IMAGES_HEIGHT', '25', '�������� ������', 735, 4, '2003-08-20 12:55:22', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('���������� ������', 'OPTIONS_IMAGES_CLICK_ENLARGE', 'true', '������������ ������� ���������� �������� ������ �����?', 735, 5, '2003-08-21 12:59:58', '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('��� sales_notes', 'YML_SALES_NOTES', '', '����� ��� ���� sales_notes', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, NULL);

drop table if exists configuration_group;
create table configuration_group (
  configuration_group_id int(11) not null auto_increment,
  configuration_group_title varchar(64) not null ,
  configuration_group_description varchar(255) not null ,
  sort_order int(5) ,
  visible int(1) default '1' ,
  PRIMARY KEY (configuration_group_id)
);

insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('1', '��� �������', '�������� ��������� ��������.', '1', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('2', '����������� ��������', '����������� �������� ������� � ������.', '2', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('3', '������������ ��������', '������������ �������� ������� � ������', '3', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('4', '��������', '��������� ��������.', '4', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('5', '������ ����������', '��������� ����� �����������.', '5', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('6', '������������� ������', '������� �����.', '6', '0');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('7', '��������/��������', '��������� ���� �������� � ��������.', '7', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('8', '����� ������', '��������� ������ ������.', '8', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('9', '�����', '��������� ������.', '9', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('10', '����', '��������� �����.', '10', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('11', '���', '��������� ����.', '11', '0');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('12', '��������� E-Mail', '��������� E-Mail.', '12', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('13', '����������', '��������� ����������� �������.', '13', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('14', 'GZip ����������', '��������� GZip ����������.', '14', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('15', '������', 'Session options', '15', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('112', 'HTML ��������', '��������� HTML ���������.', '15', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('900', '���������� ���������', '��������� ���������� ���������.', '17', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('16', '���. ������������', '��������� ������ ����������� ������������.', '19', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('40', '������� ����������', '������� ���������� �������.', '40', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('901', '������', '��������� ������ ������.', '99', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('300', '���������� ������', '��������� ������ �������� ���������� ���.', '300', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('12954', 'Wish List Settings', 'Settings for your Wish List', '25', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('26229', 'Page Cache Settings', 'Settings for the page cache contribution', '20', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('26230', '������-������', '���������������� ������-������', '99', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('401', '������ ��������� �� ������� ��������', '���������', '401', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('160', '���������� �������', '���������', '160', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('72', 'Order Editor', 'Configuration options for Order Editor', 72, 1);
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('735', '�������� ���������', '���������� ������ ��������� ��������� ������ ��������', 20, 1);
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('1610', 'Products Specifications', 'Products Specifications configuration options', 1610, 1);

drop table if exists counter;
create table counter (
  startdate char(8) ,
  counter int(12) 
);

insert into counter (startdate, counter) values ('20031126', '1086');
drop table if exists counter_history;
create table counter_history (
  month char(8) ,
  counter int(12) 
);

drop table if exists countries;
create table countries (
  countries_id int(11) not null auto_increment,
  countries_name varchar(64) not null ,
  countries_iso_code_2 char(2) not null ,
  countries_iso_code_3 char(3) not null ,
  address_format_id int(11) default '0' not null ,
  PRIMARY KEY (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
);

insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('226', '����������', 'UZ', 'UZB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('220', '�������', 'UA', 'UKR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('207', '�����������', 'TJ', 'TJK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('176', '���������� ���������', 'RU', 'RUS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('140', '��������', 'MD', 'MDA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('123', '�����', 'LT', 'LTU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('117', '������', 'LV', 'LVA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('115', '����������', 'KG', 'KGZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('109', '���������', 'KZ', 'KAZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('80', '������', 'GE', 'GEO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('67', '�������', 'EE', 'EST', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('20', '����������', 'BY', 'BLR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('15', '�����������', 'AZ', 'AZE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('11', '�������', 'AM', 'ARM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('216', '������������', 'TM', 'TKM', '1');
drop table if exists coupon_email_track;
create table coupon_email_track (
  unique_id int(11) not null auto_increment,
  coupon_id int(11) default '0' not null ,
  customer_id_sent int(11) default '0' not null ,
  sent_firstname varchar(32) ,
  sent_lastname varchar(32) ,
  emailed_to varchar(32) ,
  date_sent datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (unique_id)
);

drop table if exists coupon_gv_customer;
create table coupon_gv_customer (
  customer_id int(5) default '0' not null ,
  amount decimal(8,4) default '0.0000' not null ,
  PRIMARY KEY (customer_id),
  KEY customer_id (customer_id)
);

drop table if exists coupon_gv_queue;
create table coupon_gv_queue (
  unique_id int(5) not null auto_increment,
  customer_id int(5) default '0' not null ,
  order_id int(5) default '0' not null ,
  amount decimal(8,4) default '0.0000' not null ,
  date_created datetime default '0000-00-00 00:00:00' not null ,
  ipaddr varchar(32) not null ,
  release_flag char(1) default 'N' not null ,
  PRIMARY KEY (unique_id),
  KEY uid (unique_id, customer_id, order_id)
);

drop table if exists coupon_redeem_track;
create table coupon_redeem_track (
  unique_id int(11) not null auto_increment,
  coupon_id int(11) default '0' not null ,
  customer_id int(11) default '0' not null ,
  redeem_date datetime default '0000-00-00 00:00:00' not null ,
  redeem_ip varchar(32) not null ,
  order_id int(11) default '0' not null ,
  PRIMARY KEY (unique_id)
);

drop table if exists coupons;
create table coupons (
  coupon_id int(11) not null auto_increment,
  coupon_type char(1) default 'F' not null ,
  coupon_code varchar(32) not null ,
  coupon_amount decimal(8,4) default '0.0000' not null ,
  coupon_minimum_order decimal(8,4) default '0.0000' not null ,
  coupon_start_date datetime default '0000-00-00 00:00:00' not null ,
  coupon_expire_date datetime default '0000-00-00 00:00:00' not null ,
  uses_per_coupon int(5) default '1' not null ,
  uses_per_user int(5) default '0' not null ,
  restrict_to_products varchar(255) ,
  restrict_to_categories varchar(255) ,
  restrict_to_customers text ,
  coupon_active char(1) default 'Y' not null ,
  date_created datetime default '0000-00-00 00:00:00' not null ,
  date_modified datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (coupon_id)
);

drop table if exists coupons_description;
create table coupons_description (
  coupon_id int(11) default '0' not null ,
  language_id int(11) default '0' not null ,
  coupon_name varchar(32) not null ,
  coupon_description text ,
  KEY coupon_id (coupon_id)
);

drop table if exists currencies;
create table currencies (
  currencies_id int(11) not null auto_increment,
  title varchar(32) not null ,
  code char(3) not null ,
  symbol_left varchar(12) ,
  symbol_right varchar(12) ,
  decimal_point char(1) ,
  thousands_point char(1) ,
  decimal_places char(1) ,
  value float(13,8) ,
  last_updated datetime ,
  PRIMARY KEY (currencies_id),
  KEY idx_currencies_code (code)
);

insert into currencies (currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('1', '�����', 'RUR', '', '���.', '.', ',', '0', '1.00000000', NULL);

drop table if exists customers;
create table customers (
  customers_id int(11) not null auto_increment,
  customers_gender char(1) not null ,
  customers_firstname varchar(32) not null ,
  customers_lastname varchar(32) not null ,
  customers_dob datetime default '0000-00-00 00:00:00' not null ,
  customers_email_address varchar(96) not null ,
  customers_default_address_id int(11) ,
  customers_telephone varchar(32) not null ,
  customers_fax varchar(32) ,
  customers_password varchar(40) not null ,
  customers_newsletter char(1) ,
  customers_selected_template varchar(20) not null ,
  guest_flag char(1) default '0' ,
  customers_discount decimal(8,2) default '-0.00' not null ,
  customers_groups_id int(11) default '1' not null ,
  customers_status int(1) default '1' not null ,
  customers_payment_allowed varchar(255),
  customers_shipment_allowed varchar(255),
  PRIMARY KEY (customers_id),
  KEY idx_customers_email_address (customers_email_address)
);

drop table if exists customers_basket;
create table customers_basket (
  customers_basket_id int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  products_id tinytext ,
  customers_basket_quantity int(2) default '0' not null ,
  final_price decimal(15,4) ,
  customers_basket_date_added varchar(8) ,
  PRIMARY KEY (customers_basket_id),
  KEY idx_customers_basket_customers_id (customers_id)
);

drop table if exists customers_basket_attributes;
create table customers_basket_attributes (
  customers_basket_attributes_id int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  products_id tinytext ,
  products_options_id int(11) default '0' not null ,
  products_options_value_id int(11) default '0' not null ,
  products_options_value_text text ,
  PRIMARY KEY (customers_basket_attributes_id),
  KEY idx_customers_basket_att_customers_id (customers_id)
);

drop table if exists customers_groups;
create table customers_groups (
  customers_groups_id int(11) not null auto_increment,
  customers_groups_name varchar(32) not null ,
  customers_groups_discount decimal(8,2) default '-0.00' not null ,
  customers_groups_price int(11) default '1' not null ,
  customers_groups_accumulated_limit decimal(15,4) default '0.0000' not null ,
  color_bar varchar(255) default '#ffffff' not null ,
  group_payment_allowed varchar(255) not null ,
  group_shipment_allowed varchar(255) not null ,
  customers_groups_min_price int(11) default '0' not null ,
  PRIMARY KEY (customers_groups_id)
);

insert into customers_groups (customers_groups_id, customers_groups_name, customers_groups_discount, customers_groups_price, customers_groups_accumulated_limit, color_bar, group_payment_allowed, group_shipment_allowed, customers_groups_min_price) values ('1', '����������', '-0.00', '1', '0.0000', '#ffffff', '', '', '0');
insert into customers_groups (customers_groups_id, customers_groups_name, customers_groups_discount, customers_groups_price, customers_groups_accumulated_limit, color_bar, group_payment_allowed, group_shipment_allowed, customers_groups_min_price) values ('2', '������� ����������', '-20.00', '1', '0.0000', '#ffffff', '', '', '0');
drop table if exists customers_groups_orders_status;
create table customers_groups_orders_status (
  customers_groups_id int(11) default '0' not null ,
  orders_status_id int(11) default '0' not null 
);

drop table if exists customers_info;
create table customers_info (
  customers_info_id int(11) default '0' not null ,
  customers_info_date_of_last_logon datetime ,
  customers_info_number_of_logons int(5) ,
  customers_info_date_account_created datetime ,
  customers_info_date_account_last_modified datetime ,
  global_product_notifications int(1) default '0' ,
  PRIMARY KEY (customers_info_id)
);

drop table if exists customers_to_extra_fields;
create table customers_to_extra_fields (
  customers_id int(11) default '0' not null ,
  fields_id int(11) default '0' not null ,
  value text 
);

drop table if exists customers_wishlist;
create table customers_wishlist (
  products_id tinytext ,
  customers_id int(13) default '0' not null 
);

drop table if exists customers_wishlist_attributes;
create table customers_wishlist_attributes (
  customers_wishlist_attributes_id int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  products_id tinytext ,
  products_options_id int(11) default '0' not null ,
  products_options_value_id int(11) default '0' not null ,
  PRIMARY KEY (customers_wishlist_attributes_id)
);

drop table if exists extra_fields;
create table extra_fields (
  fields_id int(11) not null auto_increment,
  fields_input_type int(11) default '0' not null ,
  fields_input_value text,
  fields_status tinyint(2) default '0' not null ,
  fields_required_status tinyint(2) default '0' not null ,
  fields_size int(5) default '0' not null ,
  fields_required_email tinyint(2) default '0' not null ,
  PRIMARY KEY (fields_id)
);

drop table if exists extra_fields_info;
create table extra_fields_info (
  fields_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  fields_name varchar(32) not null 
);

drop table if exists extra_product_price;
create table extra_product_price (
  extra_product_price_id int(11) not null auto_increment,
  extra_product_price_status tinyint(4) default '0' not null ,
  extra_product_price_name varchar(30) not null ,
  extra_product_price_deduction_value decimal(15,4) default '0.0000' not null ,
  extra_product_price_deduction_type tinyint(4) default '0' not null ,
  extra_product_price_pricerange_from decimal(15,4) default '0.0000' not null ,
  extra_product_price_pricerange_to decimal(15,4) default '0.0000' not null ,
  extra_product_price_specials_condition tinyint(4) default '0' not null ,
  extra_product_price_categories_selected varchar(255) ,
  extra_product_price_categories_all varchar(255) ,
  extra_product_price_date_start date default '0000-00-00' not null ,
  extra_product_price_date_end date default '0000-00-00' not null ,
  extra_product_price_date_added date default '0000-00-00' not null ,
  extra_product_price_date_last_modified date default '0000-00-00' not null ,
  extra_product_price_date_status_change date default '0000-00-00' not null ,
  PRIMARY KEY (extra_product_price_id)
);

drop table if exists faqdesk;
create table faqdesk (
  faqdesk_id int(11) not null auto_increment,
  faqdesk_image varchar(64) ,
  faqdesk_image_two varchar(64) ,
  faqdesk_image_three varchar(64) ,
  faqdesk_date_added datetime default '0000-00-00 00:00:00' not null ,
  faqdesk_last_modified datetime ,
  faqdesk_date_available datetime ,
  faqdesk_status tinyint(1) default '0' not null ,
  faqdesk_sticky tinyint(1) default '1' not null ,
  PRIMARY KEY (faqdesk_id),
  KEY idx_faqdesk_date_added (faqdesk_date_added)
);

insert into faqdesk (faqdesk_id, faqdesk_image, faqdesk_image_two, faqdesk_image_three, faqdesk_date_added, faqdesk_last_modified, faqdesk_date_available, faqdesk_status, faqdesk_sticky) values ('2', '', '', '', '2005-06-22 17:59:50', NULL, NULL, '1', '0');
drop table if exists faqdesk_categories;
create table faqdesk_categories (
  categories_id int(11) not null auto_increment,
  categories_image varchar(64) ,
  parent_id int(11) default '0' not null ,
  sort_order int(3) ,
  date_added datetime ,
  last_modified datetime ,
  catagory_status tinyint(1) default '1' not null ,
  PRIMARY KEY (categories_id),
  KEY idx_categories_parent_id (parent_id)
);

insert into faqdesk_categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified, catagory_status) values ('2', NULL, '0', '0', '2005-06-22 17:58:57', NULL, '1');
drop table if exists faqdesk_categories_description;
create table faqdesk_categories_description (
  categories_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  categories_name varchar(32) not null ,
  categories_heading_title varchar(64) ,
  categories_description text ,
  PRIMARY KEY (categories_id, language_id),
  KEY idx_categories_name (categories_name)
);

insert into faqdesk_categories_description (categories_id, language_id, categories_name, categories_heading_title, categories_description) values ('2', '1', '����', NULL, '��������');
insert into faqdesk_categories_description (categories_id, language_id, categories_name, categories_heading_title, categories_description) values ('2', '2', 'Sample', NULL, 'Description');
drop table if exists faqdesk_configuration;
create table faqdesk_configuration (
  configuration_id int(11) not null auto_increment,
  configuration_title varchar(64) not null ,
  configuration_key varchar(64) not null ,
  configuration_value varchar(255) not null ,
  configuration_description varchar(255) not null ,
  configuration_group_id int(11) default '0' not null ,
  sort_order int(5) ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  use_function varchar(255) ,
  set_function varchar(255) ,
  PRIMARY KEY (configuration_id)
);

insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1', '�������� �� ����� ��������', 'MAX_DISPLAY_FAQDESK_SEARCH_RESULTS', '20', '������� �������� ���������� �� ����� ��������?', '1', '1', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('2', '������ �� ��������', 'MAX_DISPLAY_FAQDESK_PAGE_LINKS', '5', '���������� ������ �� ������ ��������.', '1', '2', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('3', '���������� ������', 'FAQDESK_QUESTION', '1', '���������� ������ ��� ��������� faq? (0=�� ����������; 1-4=������� ������ ������� ����)', '1', '3', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('4', '���������� ������� �����', 'FAQDESK_SHORT_ANSWER', '2', '���������� ������� ����� ��� ��������� faq? (0=�� ����������; 1-4=������� ������ ������� ����)', '1', '4', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('5', '���������� ����������� �����', 'FAQDESK_LONG_ANSWER', '3', '���������� ����������� ����� ��� ��������� faq? (0=�� ����������; 1-4=������� ������ ������� ����)', '1', '5', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('6', '���������� ����', 'FAQDESK_DATE_AVAILABLE', '4', '���������� ���� ��� ��������� faq? (0=�� ����������; 1-4=������� ������ ������� ����)', '1', '6', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('7', '������������ ��������� ���������/���������� ��������', 'FAQDESK_PREV_NEXT_BAR_LOCATION', '3', '������������ ��������� ���������/���������� ��������<br><br>1 - ����<br>2 - ���<br>3 - (����+���)', '1', '12', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('8', '�������� �� ������� ��������', 'MAX_DISPLAY_FAQDESK_FAQS', '3', '������� �������� ���������� �� ������� ��������?', '2', '1', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('9', '�������� � ����� ������ ������� � FAQ', 'LATEST_DISPLAY_FAQDESK_FAQS', '5', '������� �������� ���������� � ����� ��������� �������?', '2', '2', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('10', '���������� ���� ������ ������� � FAQ', 'DISPLAY_LATEST_FAQS_BOX', '1', '���������� ���� ������ ������� � FAQ? (0=�� ����������; 1=����������)', '2', '3', '2004-01-02 14:34:06', '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('11', '���������� ���� FAQ', 'DISPLAY_FAQS_CATAGORY_BOX', '1', '���������� ���� FAQ? (0=�� ����������; 1=����������)', '2', '4', '2004-01-02 14:34:32', '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('12', '���������� ������� ����������', 'DISPLAY_FAQDESK_VIEWCOUNT', '1', '���������� ������� ���������� ���������� faq? (0=�� ����������; 1=����������)', '2', '5', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('13', '���������� ������ ���������', 'DISPLAY_FAQDESK_READMORE', '1', '���������� ������ ���������? (0=�� ����������; 1=����������)', '2', '6', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('14', '���������� �������� �����', 'DISPLAY_FAQDESK_SHORT_ANSWER', '1', '���������� �������� ����� �� ������? (0=�� ����������; 1=����������)', '2', '7', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('15', '���������� ������', 'DISPLAY_FAQDESK_QUESTION', '1', '���������� ������? (0=�� ����������; 1=����������)', '2', '8', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('16', '���������� ����', 'DISPLAY_FAQDESK_DATE', '1', '���������� ����? (0=�� ����������; 1=����������)', '2', '9', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('17', '���������� �������� 1', 'DISPLAY_FAQDESK_IMAGE', '1', '���������� �������� 1 �������? (0=�� ����������; 1=����������)', '2', '10', NULL, '2003-03-03 11:59:47', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('18', '���������� �������� 2', 'DISPLAY_FAQDESK_IMAGE_TWO', '1', '���������� �������� 2 �������? (0=�� ����������; 1=����������)', '2', '11', '2003-03-03 12:08:55', '2003-03-03 11:59:47', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('19', '���������� �������� 3', 'DISPLAY_FAQDESK_IMAGE_THREE', '1', '���������� �������� 3 �������? (0=�� ����������; 1=����������)', '2', '12', '2003-03-03 12:09:16', '2003-03-03 11:59:47', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('20', '���������� ������', 'DISPLAY_FAQDESK_REVIEWS', '1', '���������� ������? (0=�� ����������; 1=����������)', '3', '1', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('21', '������������ ���������� ����� �������', 'MAX_DISPLAY_NEW_REVIEWS', '10', '������������ ���������� ��������� ����� �������.', '3', '2', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('22', '���������� ������', 'STICKY_QUESTION', '1', '���������� ������? (0=�� ����������; 1=����������)', '4', '1', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('23', '���������� �������� �����', 'STICKY_SHORT_ANSWER', '1', '���������� �������� �����? (0=�� ����������; 1=����������)', '4', '2', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('24', '���������� ����������� �����', 'STICKY_LONG_ANSWER', '1', '���������� ����������� �����? (0=�� ����������; 1=����������)', '4', '3', '2003-03-02 00:49:34', '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('25', '���������� ������� ����������', 'STICKY_FAQDESK_VIEWCOUNT', '1', '���������� ������� ���������� ���������� faq? (0=�� ����������; 1=����������)', '4', '4', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('26', '���������� ������ ���������', 'STICKY_FAQDESK_READMORE', '1', '���������� ������ ���������? (0=�� ����������; 1=����������)', '4', '5', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('27', '���������� ����', 'STICKY_DATE_ADDED', '1', '���������� ����? (0=�� ����������; 1=����������) (0=disable; 1=enable)', '4', '6', '2003-03-02 00:49:54', '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('28', '���������� URL ������', 'STICKY_EXTRA_URL', '1', '���������� URL ������? (0=�� ����������; 1=����������)', '4', '7', '2003-03-02 00:50:28', '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('29', '���������� ��������', 'STICKY_IMAGE', '1', '���������� �������� 1 �������? (0=�� ����������; 1=����������)', '4', '8', '2003-03-02 00:50:14', '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('30', '���������� �������� 2', 'STICKY_IMAGE_TWO', '1', '���������� �������� 2 �������? (0=�� ����������; 1=����������)', '4', '9', NULL, '2003-03-03 23:10:34', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('31', '���������� �������� 3', 'STICKY_IMAGE_THREE', '1', '���������� �������� 3 �������? (0=�� ����������; 1=����������)', '4', '10', NULL, '2003-03-03 23:10:34', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('32', '��������� �������� ���������', 'ALLOW_CATEGORY_DESCRIPTIONS', '1', '��������� ���������� �������� ��� ���������? (true=���������; false=���������)', '5', '1', '2003-03-03 23:10:34', '2003-03-03 23:10:34', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
drop table if exists faqdesk_configuration_group;
create table faqdesk_configuration_group (
  configuration_group_id int(11) not null auto_increment,
  configuration_group_key varchar(255) not null ,
  configuration_group_title varchar(64) not null ,
  configuration_group_description varchar(255) not null ,
  sort_order int(5) ,
  visible int(1) default '1' ,
  PRIMARY KEY (configuration_group_id)
);

insert into faqdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('1', 'FAQDESK_LISTING_DB', '��������� ������', '��������� ������ FAQ', '1', '1');
insert into faqdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('2', 'FAQDESK_SETTINGS_DB', '����� ���������', '��������� ������� ��������', '1', '1');
insert into faqdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('3', 'FAQDESK_REVIEWS_DB', '��������� �������', '��������� �������', '1', '1');
insert into faqdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('4', 'FAQDESK_STICKY_DB', '��������� \"�������\" ��������', '��������� \"�������\" ��������', '1', '1');
insert into faqdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('5', 'FAQDESK_OTHER_DB', '������ ���������', '������ ���������', '1', '1');
drop table if exists faqdesk_description;
create table faqdesk_description (
  faqdesk_id int(11) not null auto_increment,
  language_id int(11) default '1' not null ,
  faqdesk_question varchar(64) not null ,
  faqdesk_answer_long text ,
  faqdesk_answer_short text ,
  faqdesk_extra_url varchar(255) ,
  faqdesk_extra_viewed int(5) default '0' ,
  faqdesk_image_text text ,
  faqdesk_image_text_two text ,
  faqdesk_image_text_three text ,
  PRIMARY KEY (faqdesk_id, language_id),
  KEY faqdesk_question (faqdesk_question)
);

insert into faqdesk_description (faqdesk_id, language_id, faqdesk_question, faqdesk_answer_long, faqdesk_answer_short, faqdesk_extra_url, faqdesk_extra_viewed, faqdesk_image_text, faqdesk_image_text_two, faqdesk_image_text_three) values ('2', '1', '������!', '����������� �����', '������� �����', '', '0', '', '', '');
insert into faqdesk_description (faqdesk_id, language_id, faqdesk_question, faqdesk_answer_long, faqdesk_answer_short, faqdesk_extra_url, faqdesk_extra_viewed, faqdesk_image_text, faqdesk_image_text_two, faqdesk_image_text_three) values ('2', '2', 'Question!', 'Long answer', 'Short answer', '', '0', '', '', '');
drop table if exists faqdesk_reviews;
create table faqdesk_reviews (
  reviews_id int(11) not null auto_increment,
  faqdesk_id int(11) default '0' not null ,
  customers_id int(11) ,
  customers_name varchar(64) not null ,
  reviews_rating int(1) ,
  date_added datetime ,
  last_modified datetime ,
  reviews_read int(5) default '0' not null ,
  approved tinyint(3) unsigned default '0' ,
  PRIMARY KEY (reviews_id)
);

drop table if exists faqdesk_reviews_description;
create table faqdesk_reviews_description (
  reviews_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  reviews_text text ,
  PRIMARY KEY (reviews_id, languages_id)
);

drop table if exists faqdesk_to_categories;
create table faqdesk_to_categories (
  faqdesk_id int(11) default '0' not null ,
  categories_id int(11) default '0' not null ,
  PRIMARY KEY (faqdesk_id, categories_id)
);

insert into faqdesk_to_categories (faqdesk_id, categories_id) values ('2', '2');
drop table if exists featured;
create table featured (
  featured_id int(11) not null auto_increment,
  products_id int(11) default '0' not null ,
  featured_date_added datetime ,
  featured_last_modified datetime ,
  expires_date datetime ,
  date_status_change datetime ,
  status int(1) default '1' ,
  PRIMARY KEY (featured_id)
);

insert into featured (featured_id, products_id, featured_date_added, featured_last_modified, expires_date, date_status_change, status) values ('1', '1', '2004-08-12 17:15:19', NULL, '0000-00-00 00:00:00', NULL, '1');
drop table if exists geo_zones;
create table geo_zones (
  geo_zone_id int(11) not null auto_increment,
  geo_zone_name varchar(32) not null ,
  geo_zone_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (geo_zone_id)
);

insert into geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) values ('1', 'Florida', 'Florida local sales tax zone', NULL, '2003-07-17 10:29:23');
drop table if exists infobox_configuration;
create table infobox_configuration (
  template_id int(3) unsigned ,
  infobox_id int(11) not null auto_increment,
  infobox_file_name varchar(64) not null ,
  infobox_define varchar(64) default 'BOX_HEADING_' not null ,
  infobox_display varchar(5) not null ,
  display_in_column varchar(64) default 'left' not null ,
  location int(3) default '0' not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  box_heading varchar(64) not null ,
  box_template varchar(64) default 'infobox' not null ,
  box_heading_font_color varchar(10) default '#000000' not null ,
  PRIMARY KEY (infobox_id)
);

insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '337', 'loginbox.php', 'BOX_HEADING_LOGIN', 'yes', 'right', '2', '2004-04-23 20:47:48', '2004-01-01 10:55:55', '����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '336', 'information.php', 'BOX_HEADING_INFORMATION', 'yes', 'left', '2', '2004-02-17 15:15:49', '2004-01-01 10:55:55', '����������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '335', 'faqdesk_latest.php', 'BOX_HEADING_FAQDESK_LATEST', 'yes', 'right', '50', '2004-08-12 17:21:29', '2004-01-01 10:55:55', '������ ������� � FAQ', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '334', 'faqdesk.php', 'BOX_HEADING_FAQDESK_CATEGORIES', 'yes', 'right', '40', '2004-08-12 17:21:36', '2004-01-01 10:55:55', 'FAQ', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '332', 'newsdesk.php', 'BOX_HEADING_NEWSDESK_CATEGORIES', 'no', 'left', '19', '2004-02-07 19:15:41', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '333', 'newsdesk_latest.php', 'BOX_HEADING_NEWSDESK_LATEST', 'no', 'left', '8', '2004-02-01 15:40:10', '2004-01-01 10:55:55', '��������� �������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '331', 'affiliate.php', 'BOX_HEADING_AFFILIATE', 'yes', 'right', '6', '2004-02-07 14:09:16', '2004-01-01 10:55:55', 'Affiliate Info', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '330', 'featured.php', 'BOX_HEADING_FEATURED', 'yes', 'left', '16', '2004-02-01 15:50:52', '2004-01-01 10:55:55', '�������������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '328', 'newsbox.php', 'BOX_HEADING_NEWSBOX', 'no', 'left', '15', '2004-02-01 15:41:55', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '327', 'whats_new.php', 'BOX_HEADING_WHATS_NEW', 'yes', 'left', '10', '2004-02-01 15:41:00', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '326', 'tell_a_friend.php', 'BOX_HEADING_TELL_A_FRIEND', 'yes', 'right', '12', '2004-02-01 15:49:15', '2004-01-01 10:55:55', '���������� �����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '325', 'specials.php', 'BOX_HEADING_SPECIALS', 'yes', 'left', '5', '2004-02-01 15:39:06', '2004-01-01 10:55:55', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '324', 'shopping_cart.php', 'BOX_HEADING_SHOPPING_CART', 'yes', 'right', '1', '2004-04-23 20:47:56', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '322', 'reviews.php', 'BOX_HEADING_REVIEWS', 'yes', 'right', '4', '2004-02-01 15:49:30', '2004-01-01 10:55:55', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '323', 'search.php', 'BOX_HEADING_SEARCH', 'yes', 'left', '9', '2004-02-01 15:50:02', '2004-01-01 10:55:55', '�����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '321', 'product_notifications.php', 'BOX_HEADING_NOTIFICATIONS', 'yes', 'right', '13', '2004-02-01 15:50:22', '2004-01-01 10:55:55', '�����������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '320', 'order_history.php', 'BOX_HEADING_CUSTOMER_ORDERS', 'yes', 'right', '4', '2004-02-07 13:59:35', '2004-01-01 10:55:55', '������� �������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '319', 'manufacturers.php', 'BOX_HEADING_MANUFACTURERS', 'yes', 'left', '3', '2004-04-23 21:06:37', '2004-01-01 10:55:55', '�������������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '316', 'currencies.php', 'BOX_HEADING_CURRENCIES', 'yes', 'right', '27', '2004-04-23 21:07:34', '2004-01-01 10:55:55', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '317', 'languages.php', 'BOX_HEADING_LANGUAGES', 'yes', 'left', '14', '2004-02-01 15:50:34', '2004-01-01 10:55:55', '����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '318', 'manufacturer_info.php', 'BOX_HEADING_MANUFACTURER_INFO', 'yes', 'right', '7', '2004-02-07 14:21:03', '2004-01-01 10:55:55', '�������������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '314', 'best_sellers.php', 'BOX_HEADING_BESTSELLERS', 'no', 'right', '8', '2004-02-01 15:42:37', '2004-01-01 10:55:55', '������ ������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '315', 'categories.php', 'BOX_HEADING_CATEGORIES', 'yes', 'left', '1', '2004-02-18 14:54:47', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '364', 'wishlist.php', 'BOX_HEADING_WISHLIST', 'yes', 'right', '3', '2004-02-07 13:59:10', '0000-00-00 00:00:00', '���������� ������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '365', 'shop_by_price.php', 'BOX_HEADING_SHOP_BY_PRICE', 'yes', 'left', '17', NULL, '0000-00-00 00:00:00', '���������� �� ����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '368', 'help.php', 'HELP_HEADING', 'yes', 'right', '2', '2005-03-27 12:51:41', '0000-00-00 00:00:00', '�����������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '369', 'articles.php', 'BOX_HEADING_ARTICLES', 'yes', 'left', '60', NULL, '0000-00-00 00:00:00', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '370', 'authors.php', 'BOX_HEADING_AUTHORS', 'yes', 'left', '61', NULL, '0000-00-00 00:00:00', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '371', 'polls.php', '_POLLS', 'yes', 'right', '60', '2004-09-08 14:38:06', '0000-00-00 00:00:00', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '372', 'links.php', 'BOX_HEADING_LINKS', 'yes', 'left', '62', NULL, '0000-00-00 00:00:00', '����� ��������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '373', 'download_files.php', 'BOX_HEADING_DOWNLOAD', 'yes', 'right', '1', '2005-04-23 17:29:41', '0000-00-00 00:00:00', '�����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '374', 'loginbox.php', 'BOX_HEADING_LOGIN', 'yes', 'right', '2', '2004-04-23 20:47:48', '2004-01-01 10:55:55', '����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '375', 'information.php', 'BOX_HEADING_INFORMATION', 'yes', 'left', '2', '2004-02-17 15:15:49', '2004-01-01 10:55:55', '����������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '376', 'faqdesk_latest.php', 'BOX_HEADING_FAQDESK_LATEST', 'yes', 'right', '50', '2004-08-12 17:21:29', '2004-01-01 10:55:55', '������ ������� � FAQ', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '377', 'faqdesk.php', 'BOX_HEADING_FAQDESK_CATEGORIES', 'yes', 'right', '40', '2004-08-12 17:21:36', '2004-01-01 10:55:55', 'FAQ', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '378', 'newsdesk.php', 'BOX_HEADING_NEWSDESK_CATEGORIES', 'no', 'left', '19', '2004-02-07 19:15:41', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '379', 'newsdesk_latest.php', 'BOX_HEADING_NEWSDESK_LATEST', 'no', 'left', '8', '2004-02-01 15:40:10', '2004-01-01 10:55:55', '��������� �������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '380', 'affiliate.php', 'BOX_HEADING_AFFILIATE', 'yes', 'right', '6', '2004-02-07 14:09:16', '2004-01-01 10:55:55', 'Affiliate Info', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '381', 'featured.php', 'BOX_HEADING_FEATURED', 'yes', 'left', '16', '2004-02-01 15:50:52', '2004-01-01 10:55:55', '�������������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '383', 'newsbox.php', 'BOX_HEADING_NEWSBOX', 'no', 'left', '15', '2004-02-01 15:41:55', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '384', 'whats_new.php', 'BOX_HEADING_WHATS_NEW', 'yes', 'left', '10', '2004-02-01 15:41:00', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '385', 'tell_a_friend.php', 'BOX_HEADING_TELL_A_FRIEND', 'yes', 'right', '12', '2004-02-01 15:49:15', '2004-01-01 10:55:55', '���������� �����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '386', 'specials.php', 'BOX_HEADING_SPECIALS', 'yes', 'left', '5', '2004-02-01 15:39:06', '2004-01-01 10:55:55', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '387', 'shopping_cart.php', 'BOX_HEADING_SHOPPING_CART', 'yes', 'right', '1', '2004-04-23 20:47:56', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '388', 'reviews.php', 'BOX_HEADING_REVIEWS', 'yes', 'right', '4', '2004-02-01 15:49:30', '2004-01-01 10:55:55', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '389', 'search.php', 'BOX_HEADING_SEARCH', 'yes', 'left', '9', '2004-02-01 15:50:02', '2004-01-01 10:55:55', '�����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '390', 'product_notifications.php', 'BOX_HEADING_NOTIFICATIONS', 'yes', 'right', '13', '2004-02-01 15:50:22', '2004-01-01 10:55:55', '�����������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '391', 'order_history.php', 'BOX_HEADING_CUSTOMER_ORDERS', 'yes', 'right', '4', '2004-02-07 13:59:35', '2004-01-01 10:55:55', '������� �������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '392', 'manufacturers.php', 'BOX_HEADING_MANUFACTURERS', 'yes', 'left', '3', '2004-04-23 21:06:37', '2004-01-01 10:55:55', '�������������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '393', 'currencies.php', 'BOX_HEADING_CURRENCIES', 'yes', 'right', '27', '2004-04-23 21:07:34', '2004-01-01 10:55:55', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '394', 'languages.php', 'BOX_HEADING_LANGUAGES', 'yes', 'left', '14', '2004-02-01 15:50:34', '2004-01-01 10:55:55', '����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '395', 'manufacturer_info.php', 'BOX_HEADING_MANUFACTURER_INFO', 'yes', 'right', '7', '2004-02-07 14:21:03', '2004-01-01 10:55:55', '�������������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '396', 'best_sellers.php', 'BOX_HEADING_BESTSELLERS', 'no', 'right', '8', '2004-02-01 15:42:37', '2004-01-01 10:55:55', '������ ������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '397', 'categories.php', 'BOX_HEADING_CATEGORIES', 'yes', 'left', '1', '2004-02-18 14:54:47', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '398', 'wishlist.php', 'BOX_HEADING_WISHLIST', 'yes', 'right', '3', '2004-02-07 13:59:10', '0000-00-00 00:00:00', '���������� ������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '399', 'shop_by_price.php', 'BOX_HEADING_SHOP_BY_PRICE', 'yes', 'left', '17', NULL, '0000-00-00 00:00:00', '���������� �� ����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '400', 'help.php', 'HELP_HEADING', 'yes', 'right', '2', '2005-03-27 12:51:41', '0000-00-00 00:00:00', '�����������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '401', 'articles.php', 'BOX_HEADING_ARTICLES', 'yes', 'left', '60', NULL, '0000-00-00 00:00:00', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '402', 'authors.php', 'BOX_HEADING_AUTHORS', 'yes', 'left', '61', NULL, '0000-00-00 00:00:00', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '403', 'polls.php', '_POLLS', 'yes', 'right', '60', '2004-09-08 14:38:06', '0000-00-00 00:00:00', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '404', 'links.php', 'BOX_HEADING_LINKS', 'yes', 'left', '62', NULL, '0000-00-00 00:00:00', '����� ��������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '405', 'download_files.php', 'BOX_HEADING_DOWNLOAD', 'yes', 'right', '1', '2005-04-23 17:29:41', '0000-00-00 00:00:00', '�����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '406', 'loginbox.php', 'BOX_HEADING_LOGIN', 'yes', 'right', '2', '2004-04-23 20:47:48', '2004-01-01 10:55:55', '����', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '407', 'information.php', 'BOX_HEADING_INFORMATION', 'yes', 'left', '2', '2004-02-17 15:15:49', '2004-01-01 10:55:55', '����������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '408', 'faqdesk_latest.php', 'BOX_HEADING_FAQDESK_LATEST', 'yes', 'right', '50', '2004-08-12 17:21:29', '2004-01-01 10:55:55', '������ ������� � FAQ', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '409', 'faqdesk.php', 'BOX_HEADING_FAQDESK_CATEGORIES', 'yes', 'right', '40', '2004-08-12 17:21:36', '2004-01-01 10:55:55', 'FAQ', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '410', 'newsdesk.php', 'BOX_HEADING_NEWSDESK_CATEGORIES', 'no', 'left', '19', '2004-02-07 19:15:41', '2004-01-01 10:55:55', '�������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '411', 'newsdesk_latest.php', 'BOX_HEADING_NEWSDESK_LATEST', 'no', 'left', '8', '2004-02-01 15:40:10', '2004-01-01 10:55:55', '��������� �������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '412', 'affiliate.php', 'BOX_HEADING_AFFILIATE', 'yes', 'right', '6', '2004-02-07 14:09:16', '2004-01-01 10:55:55', 'Affiliate Info', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '413', 'featured.php', 'BOX_HEADING_FEATURED', 'yes', 'left', '16', '2004-02-01 15:50:52', '2004-01-01 10:55:55', '�������������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '415', 'newsbox.php', 'BOX_HEADING_NEWSBOX', 'no', 'left', '15', '2004-02-01 15:41:55', '2004-01-01 10:55:55', '�������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '416', 'whats_new.php', 'BOX_HEADING_WHATS_NEW', 'yes', 'left', '10', '2004-02-01 15:41:00', '2004-01-01 10:55:55', '�������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '417', 'tell_a_friend.php', 'BOX_HEADING_TELL_A_FRIEND', 'yes', 'right', '12', '2004-02-01 15:49:15', '2004-01-01 10:55:55', '���������� �����', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '418', 'specials.php', 'BOX_HEADING_SPECIALS', 'yes', 'left', '5', '2004-02-01 15:39:06', '2004-01-01 10:55:55', '������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '419', 'shopping_cart.php', 'BOX_HEADING_SHOPPING_CART', 'yes', 'right', '1', '2004-04-23 20:47:56', '2004-01-01 10:55:55', '�������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '420', 'reviews.php', 'BOX_HEADING_REVIEWS', 'yes', 'right', '4', '2004-02-01 15:49:30', '2004-01-01 10:55:55', '������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '421', 'search.php', 'BOX_HEADING_SEARCH', 'yes', 'left', '9', '2004-02-01 15:50:02', '2004-01-01 10:55:55', '�����', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '422', 'product_notifications.php', 'BOX_HEADING_NOTIFICATIONS', 'yes', 'right', '13', '2004-02-01 15:50:22', '2004-01-01 10:55:55', '�����������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '423', 'order_history.php', 'BOX_HEADING_CUSTOMER_ORDERS', 'yes', 'right', '4', '2004-02-07 13:59:35', '2004-01-01 10:55:55', '������� �������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '424', 'manufacturers.php', 'BOX_HEADING_MANUFACTURERS', 'yes', 'left', '3', '2004-04-23 21:06:37', '2004-01-01 10:55:55', '�������������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '425', 'currencies.php', 'BOX_HEADING_CURRENCIES', 'yes', 'right', '27', '2004-04-23 21:07:34', '2004-01-01 10:55:55', '������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '426', 'languages.php', 'BOX_HEADING_LANGUAGES', 'yes', 'left', '14', '2004-02-01 15:50:34', '2004-01-01 10:55:55', '����', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '427', 'manufacturer_info.php', 'BOX_HEADING_MANUFACTURER_INFO', 'yes', 'right', '7', '2004-02-07 14:21:03', '2004-01-01 10:55:55', '�������������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '428', 'best_sellers.php', 'BOX_HEADING_BESTSELLERS', 'no', 'right', '8', '2004-02-01 15:42:37', '2004-01-01 10:55:55', '������ ������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '429', 'categories.php', 'BOX_HEADING_CATEGORIES', 'yes', 'left', '1', '2004-02-18 14:54:47', '2004-01-01 10:55:55', '�������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '430', 'wishlist.php', 'BOX_HEADING_WISHLIST', 'yes', 'right', '3', '2004-02-07 13:59:10', '0000-00-00 00:00:00', '���������� ������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '431', 'shop_by_price.php', 'BOX_HEADING_SHOP_BY_PRICE', 'yes', 'left', '17', NULL, '0000-00-00 00:00:00', '���������� �� ����', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '432', 'help.php', 'HELP_HEADING', 'yes', 'right', '2', '2005-03-27 12:51:41', '0000-00-00 00:00:00', '�����������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '433', 'articles.php', 'BOX_HEADING_ARTICLES', 'yes', 'left', '60', NULL, '0000-00-00 00:00:00', '������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '434', 'authors.php', 'BOX_HEADING_AUTHORS', 'yes', 'left', '61', NULL, '0000-00-00 00:00:00', '������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '435', 'polls.php', '_POLLS', 'yes', 'right', '60', '2004-09-08 14:38:06', '0000-00-00 00:00:00', '������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '436', 'links.php', 'BOX_HEADING_LINKS', 'yes', 'left', '62', NULL, '0000-00-00 00:00:00', '����� ��������', 'infobox', '#ffffff');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '437', 'download_files.php', 'BOX_HEADING_DOWNLOAD', 'yes', 'right', '1', '2005-04-23 17:29:41', '0000-00-00 00:00:00', '�����', 'infobox', '#ffffff');

insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'loginbox.php', 'BOX_HEADING_LOGIN', 'yes', 'right', '2', '2004-04-23 20:47:48', '2004-01-01 10:55:55', '����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'information.php', 'BOX_HEADING_INFORMATION', 'yes', 'left', '2', '2004-02-17 15:15:49', '2004-01-01 10:55:55', '����������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'faqdesk_latest.php', 'BOX_HEADING_FAQDESK_LATEST', 'yes', 'right', '50', '2004-08-12 17:21:29', '2004-01-01 10:55:55', '������ ������� � FAQ', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'faqdesk.php', 'BOX_HEADING_FAQDESK_CATEGORIES', 'yes', 'right', '40', '2004-08-12 17:21:36', '2004-01-01 10:55:55', 'FAQ', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'newsdesk.php', 'BOX_HEADING_NEWSDESK_CATEGORIES', 'no', 'left', '19', '2004-02-07 19:15:41', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'newsdesk_latest.php', 'BOX_HEADING_NEWSDESK_LATEST', 'no', 'left', '8', '2004-02-01 15:40:10', '2004-01-01 10:55:55', '��������� �������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'affiliate.php', 'BOX_HEADING_AFFILIATE', 'yes', 'right', '6', '2004-02-07 14:09:16', '2004-01-01 10:55:55', 'Affiliate Info', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'featured.php', 'BOX_HEADING_FEATURED', 'yes', 'left', '16', '2004-02-01 15:50:52', '2004-01-01 10:55:55', '�������������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'newsbox.php', 'BOX_HEADING_NEWSBOX', 'no', 'left', '15', '2004-02-01 15:41:55', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'whats_new.php', 'BOX_HEADING_WHATS_NEW', 'yes', 'left', '10', '2004-02-01 15:41:00', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'tell_a_friend.php', 'BOX_HEADING_TELL_A_FRIEND', 'yes', 'right', '12', '2004-02-01 15:49:15', '2004-01-01 10:55:55', '���������� �����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'specials.php', 'BOX_HEADING_SPECIALS', 'yes', 'left', '5', '2004-02-01 15:39:06', '2004-01-01 10:55:55', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'shopping_cart.php', 'BOX_HEADING_SHOPPING_CART', 'yes', 'right', '1', '2004-04-23 20:47:56', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'reviews.php', 'BOX_HEADING_REVIEWS', 'yes', 'right', '4', '2004-02-01 15:49:30', '2004-01-01 10:55:55', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'search.php', 'BOX_HEADING_SEARCH', 'yes', 'left', '9', '2004-02-01 15:50:02', '2004-01-01 10:55:55', '�����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'product_notifications.php', 'BOX_HEADING_NOTIFICATIONS', 'yes', 'right', '13', '2004-02-01 15:50:22', '2004-01-01 10:55:55', '�����������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'order_history.php', 'BOX_HEADING_CUSTOMER_ORDERS', 'yes', 'right', '4', '2004-02-07 13:59:35', '2004-01-01 10:55:55', '������� �������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'manufacturers.php', 'BOX_HEADING_MANUFACTURERS', 'yes', 'left', '3', '2004-04-23 21:06:37', '2004-01-01 10:55:55', '�������������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'currencies.php', 'BOX_HEADING_CURRENCIES', 'yes', 'right', '27', '2004-04-23 21:07:34', '2004-01-01 10:55:55', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'languages.php', 'BOX_HEADING_LANGUAGES', 'yes', 'left', '14', '2004-02-01 15:50:34', '2004-01-01 10:55:55', '����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'manufacturer_info.php', 'BOX_HEADING_MANUFACTURER_INFO', 'yes', 'right', '7', '2004-02-07 14:21:03', '2004-01-01 10:55:55', '�������������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'best_sellers.php', 'BOX_HEADING_BESTSELLERS', 'no', 'right', '8', '2004-02-01 15:42:37', '2004-01-01 10:55:55', '������ ������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'categories.php', 'BOX_HEADING_CATEGORIES', 'yes', 'left', '1', '2004-02-18 14:54:47', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'wishlist.php', 'BOX_HEADING_WISHLIST', 'yes', 'right', '3', '2004-02-07 13:59:10', '0000-00-00 00:00:00', '���������� ������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'shop_by_price.php', 'BOX_HEADING_SHOP_BY_PRICE', 'yes', 'left', '17', NULL, '0000-00-00 00:00:00', '���������� �� ����', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'help.php', 'HELP_HEADING', 'yes', 'right', '2', '2005-03-27 12:51:41', '0000-00-00 00:00:00', '�����������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'articles.php', 'BOX_HEADING_ARTICLES', 'yes', 'left', '60', NULL, '0000-00-00 00:00:00', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'authors.php', 'BOX_HEADING_AUTHORS', 'yes', 'left', '61', NULL, '0000-00-00 00:00:00', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'polls.php', '_POLLS', 'yes', 'right', '60', '2004-09-08 14:38:06', '0000-00-00 00:00:00', '������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'links.php', 'BOX_HEADING_LINKS', 'yes', 'left', '62', NULL, '0000-00-00 00:00:00', '����� ��������', 'infobox', '#000000');
insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'download_files.php', 'BOX_HEADING_DOWNLOAD', 'yes', 'right', '1', '2005-04-23 17:29:41', '0000-00-00 00:00:00', '�����', 'infobox', '#000000');

insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('16', '', 'products_filter.php', 'BOX_HEADING_PRODUCTS_FILTER', 'yes', 'left', '2', '2004-02-18 14:54:47', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');

insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('17', '', 'products_filter.php', 'BOX_HEADING_PRODUCTS_FILTER', 'yes', 'left', '2', '2004-02-18 14:54:47', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');

insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('3', '', 'products_filter.php', 'BOX_HEADING_PRODUCTS_FILTER', 'yes', 'left', '2', '2004-02-18 14:54:47', '2004-01-01 10:55:55', '�������', 'infobox', '#ffffff');

insert into infobox_configuration (template_id, infobox_id, infobox_file_name, infobox_define, infobox_display, display_in_column, location, last_modified, date_added, box_heading, box_template, box_heading_font_color) values ('1', '', 'products_filter.php', 'BOX_HEADING_PRODUCTS_FILTER', 'yes', 'left', '2', '2004-02-18 14:54:47', '2004-01-01 10:55:55', '�������', 'infobox', '#000000');

drop table if exists languages;
create table languages (
  languages_id int(11) not null auto_increment,
  name varchar(32) not null ,
  code char(2) not null ,
  image varchar(64) ,
  directory varchar(32) ,
  sort_order int(3) ,
  PRIMARY KEY (languages_id),
  KEY IDX_LANGUAGES_NAME (name)
);

insert into languages (languages_id, name, code, image, directory, sort_order) values ('1', '�������', 'ru', 'icon.gif', 'russian', '1');
insert into languages (languages_id, name, code, image, directory, sort_order) values ('2', 'English', 'en', 'icon.gif', 'english', '2');
drop table if exists latest_news;
create table latest_news (
  news_id int(11) not null auto_increment,
  headline varchar(255) not null ,
  content text ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  status tinyint(1) default '0' not null ,
  PRIMARY KEY (news_id)
);

drop table if exists link_categories;
create table link_categories (
  link_categories_id int(11) not null auto_increment,
  link_categories_image varchar(64) ,
  link_categories_sort_order int(3) ,
  link_categories_date_added datetime ,
  link_categories_last_modified datetime ,
  link_categories_status tinyint(1) default '0' not null ,
  PRIMARY KEY (link_categories_id),
  KEY idx_link_categories_date_added (link_categories_date_added)
);

insert into link_categories (link_categories_id, link_categories_image, link_categories_sort_order, link_categories_date_added, link_categories_last_modified, link_categories_status) values ('1', NULL, '1', '2004-11-02 12:43:25', NULL, '1');
drop table if exists link_categories_description;
create table link_categories_description (
  link_categories_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  link_categories_name varchar(32) not null ,
  link_categories_description text ,
  PRIMARY KEY (link_categories_id, language_id),
  KEY idx_link_categories_name (link_categories_name)
);

insert into link_categories_description (link_categories_id, language_id, link_categories_name, link_categories_description) values ('1', '1', '���������', '�������� ���������');
drop table if exists links;
create table links (
  links_id int(11) not null auto_increment,
  links_url varchar(255) ,
  links_reciprocal_url varchar(255) ,
  links_image_url varchar(255) ,
  links_contact_name varchar(64) ,
  links_contact_email varchar(96) ,
  links_date_added datetime default '0000-00-00 00:00:00' not null ,
  links_last_modified datetime ,
  links_status tinyint(1) default '0' not null ,
  links_clicked int(11) default '0' not null ,
  links_rating tinyint(1) default '0' not null ,
  PRIMARY KEY (links_id),
  KEY idx_links_date_added (links_date_added)
);

insert into links (links_id, links_url, links_reciprocal_url, links_image_url, links_contact_name, links_contact_email, links_date_added, links_last_modified, links_status, links_clicked, links_rating) values ('1', 'http://forum.oscommerce.ru', 'http://test.loc', '', '��������� ����������', 'orders@kypi.ru', '2004-11-02 12:45:04', NULL, '2', '1', '0');
drop table if exists links_description;
create table links_description (
  links_id int(11) not null auto_increment,
  language_id int(11) default '1' not null ,
  links_title varchar(64) not null ,
  links_description text ,
  PRIMARY KEY (links_id, language_id),
  KEY links_title (links_title)
);

insert into links_description (links_id, language_id, links_title, links_description) values ('1', '1', '����� osCommerce ��-������', '����� ��������� ������������� osCommerce!');
drop table if exists links_status;
create table links_status (
  links_status_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  links_status_name varchar(32) not null ,
  PRIMARY KEY (links_status_id, language_id),
  KEY idx_links_status_name (links_status_name)
);

insert into links_status (links_status_id, language_id, links_status_name) values ('1', '1', '������� ��������');
insert into links_status (links_status_id, language_id, links_status_name) values ('2', '1', '���������');
insert into links_status (links_status_id, language_id, links_status_name) values ('3', '1', '���������');
insert into links_status (links_status_id, language_id, links_status_name) values ('1', '2', 'Pending');
insert into links_status (links_status_id, language_id, links_status_name) values ('2', '2', 'Checked');
insert into links_status (links_status_id, language_id, links_status_name) values ('3', '2', 'Inactive');
drop table if exists links_to_link_categories;
create table links_to_link_categories (
  links_id int(11) default '0' not null ,
  link_categories_id int(11) default '0' not null ,
  PRIMARY KEY (links_id, link_categories_id)
);

insert into links_to_link_categories (links_id, link_categories_id) values ('1', '1');
drop table if exists manudiscount;
create table manudiscount (
  manudiscount_id int(11) not null auto_increment,
  manudiscount_name varchar(128) not null ,
  manudiscount_groups_id int(11) default '0' not null ,
  manudiscount_customers_id int(11) default '0' not null ,
  manudiscount_manufacturers_id int(11) default '0' not null ,
  manudiscount_discount decimal(8,2) default '-0.00' not null ,
  PRIMARY KEY (manudiscount_id)
);

drop table if exists manufacturers;
create table manufacturers (
  manufacturers_id int(11) not null auto_increment,
  manufacturers_image varchar(64) ,
  date_added datetime ,
  last_modified datetime ,
  PRIMARY KEY (manufacturers_id)
);

insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('5', 'br.gif', '2004-08-12 17:20:11', '2004-08-12 17:31:40');
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('4', 'br.gif', '2004-08-12 17:20:04', '2004-08-12 17:31:35');
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('6', NULL, '2004-08-12 17:20:15', NULL);
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('7', NULL, '2004-08-12 17:20:22', NULL);
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('8', NULL, '2004-08-12 17:20:30', NULL);
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('9', NULL, '2004-08-12 17:20:33', NULL);
drop table if exists manufacturers_info;
create table manufacturers_info (
  manufacturers_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  manufacturers_name varchar(255) not null ,
  manufacturers_description text ,
  manufacturers_meta_title text ,
  manufacturers_meta_keywords text ,
  manufacturers_meta_description text ,
  manufacturers_url varchar(255) not null ,
  url_clicked int(5) default '0' not null ,
  date_last_click datetime ,
  PRIMARY KEY (manufacturers_id, languages_id)
);

insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('5', '1', '������2', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('4', '1', '������1', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('6', '1', '������3', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('7', '1', '������4', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('8', '1', '������5', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('9', '1', '������6', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('4', '2', '������1', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('5', '2', '������2', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('6', '2', '������3', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('7', '2', '������4', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('8', '2', '������5', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('9', '2', '������6', '', '', '', '', '', '0', NULL);
drop table if exists newsdesk;
create table newsdesk (
  newsdesk_id int(11) not null auto_increment,
  newsdesk_image varchar(64) ,
  newsdesk_image_two varchar(64) ,
  newsdesk_image_three varchar(64) ,
  newsdesk_date_added datetime default '0000-00-00 00:00:00' not null ,
  newsdesk_last_modified datetime ,
  newsdesk_date_available datetime ,
  newsdesk_status tinyint(1) default '0' not null ,
  newsdesk_sticky tinyint(1) default '1' not null ,
  PRIMARY KEY (newsdesk_id),
  KEY idx_newsdesk_date_added (newsdesk_date_added)
);

insert into newsdesk (newsdesk_id, newsdesk_image, newsdesk_image_two, newsdesk_image_three, newsdesk_date_added, newsdesk_last_modified, newsdesk_date_available, newsdesk_status, newsdesk_sticky) values ('2', '', '', '', '2005-06-22 17:58:16', NULL, NULL, '1', '0');
drop table if exists newsdesk_categories;
create table newsdesk_categories (
  categories_id int(11) not null auto_increment,
  categories_image varchar(64) ,
  parent_id int(11) default '0' not null ,
  sort_order int(3) ,
  date_added datetime ,
  last_modified datetime ,
  catagory_status tinyint(1) default '1' not null ,
  PRIMARY KEY (categories_id),
  KEY idx_categories_parent_id (parent_id)
);

insert into newsdesk_categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified, catagory_status) values ('2', NULL, '0', '0', '2005-06-22 17:57:23', NULL, '1');
drop table if exists newsdesk_categories_description;
create table newsdesk_categories_description (
  categories_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  categories_name varchar(32) not null ,
  PRIMARY KEY (categories_id, language_id),
  KEY idx_categories_name (categories_name)
);

insert into newsdesk_categories_description (categories_id, language_id, categories_name) values ('2', '1', '����');
insert into newsdesk_categories_description (categories_id, language_id, categories_name) values ('2', '2', 'Sample');
drop table if exists newsdesk_configuration;
create table newsdesk_configuration (
  configuration_id int(11) not null auto_increment,
  configuration_title varchar(64) not null ,
  configuration_key varchar(64) not null ,
  configuration_value varchar(255) not null ,
  configuration_description varchar(255) not null ,
  configuration_group_id int(11) default '0' not null ,
  sort_order int(5) ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  use_function varchar(255) ,
  set_function varchar(255) ,
  PRIMARY KEY (configuration_id)
);

insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1', '�������� �� ����� ��������', 'MAX_DISPLAY_NEWSDESK_SEARCH_RESULTS', '20', '������� �������� ���������� �� ����� ��������?', '1', '1', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('2', '������ �� ��������', 'MAX_DISPLAY_NEWSDESK_PAGE_LINKS', '5', '���������� ������ �� ������ ��������.', '1', '2', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('3', '���������� ���� ���������', 'NEWSDESK_ARTICLE_NAME', '1', '���������� ���� ��������� ��� ��������� ��������? (0=�� ����������; 1=����������)', '1', '3', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('4', '���������� ���� ������', 'NEWSDESK_ARTICLE_SHORTTEXT', '1', '���������� ���� ������ ��� ��������� ��������? (0=�� ����������; 1=����������)', '1', '4', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('5', '���������� ���� ����������', 'NEWSDESK_ARTICLE_DESCRIPTION', '1', '���������� ���� ���������� ��� ��������� ��������? (0=�� ����������; 1=����������)', '1', '5', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('6', '���������� ����', 'NEWSDESK_DATE_AVAILABLE', '1', '���������� ���� ��� ��������� ��������? (0=�� ����������; 1=����������)', '1', '6', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('7', '���������� URL ������', 'NEWSDESK_ARTICLE_URL', '1', '���������� URL ������ ��� ��������� ��������? (0=�� ����������; 1=����������)', '1', '7', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('8', '���������� ������', 'NEWSDESK_STATUS', '1', '���������� ������ ��� ��������� ��������? (0=�� ����������; 1=����������)', '1', '8', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('9', '���������� ��������', 'NEWSDESK_IMAGE', '1', '���������� �������� 1 ��� ��������� ��������? (0=�� ����������; 1=����������)', '1', '9', '2003-03-03 23:06:46', '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('10', '���������� �������� 2', 'NEWSDESK_IMAGE_TWO', '1', '���������� �������� 2 ��� ��������� ��������? (0=�� ����������; 1=����������)', '1', '10', '2003-03-03 23:06:46', '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('11', '���������� �������� 3', 'NEWSDESK_IMAGE_THREE', '1', '���������� �������� 3 ��� ��������� ��������? (0=�� ����������; 1=����������)', '1', '11', '2003-03-03 23:06:46', '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('12', '������������ ��������� ���������/���������� ��������', 'NEWSDESK_PREV_NEXT_BAR_LOCATION', '3', '������������ ��������� ���������/���������� ��������<br><br>top - ����<br>bottom - ���<br>both - (����+���)', '1', '12', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('14', '�������� �� ������� ��������', 'MAX_DISPLAY_NEWSDESK_NEWS', '3', '������� �������� ���������� �� ������� ��������?', '2', '1', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('15', '�������� � ����� ��������� �������', 'LATEST_DISPLAY_NEWSDESK_NEWS', '5', '������� �������� ���������� � ����� ��������� �������?', '2', '2', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('16', '���������� ���� ��������� �������', 'DISPLAY_LATEST_NEWS_BOX', '1', '���������� ���� ������ �������? (0=�� ����������; 1=����������)', '2', '3', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('17', '���������� ���� ��������� ��������', 'DISPLAY_NEWS_CATAGORY_BOX', '1', '���������� ���� ��������� ��������? (0=�� ����������; 1=����������)', '2', '4', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('18', '���������� ������� ����������', 'DISPLAY_NEWSDESK_VIEWCOUNT', '1', '���������� ������� ���������� ���������� ��������? (0=�� ����������; 1=����������)', '2', '5', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('19', '���������� ������ ���������', 'DISPLAY_NEWSDESK_READMORE', '1', '���������� ������ ���������? (0=�� ����������; 1=����������)', '2', '6', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('20', '���������� ������� ���������� �������', 'DISPLAY_NEWSDESK_SUMMARY', '1', '���������� ������� ���������� �������? (0=�� ����������; 1=����������)', '2', '7', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('21', '���������� ��������� �������', 'DISPLAY_NEWSDESK_HEADLINE', '1', '���������� ��������� �������? (0=�� ����������; 1=����������)', '2', '8', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('22', '���������� ����', 'DISPLAY_NEWSDESK_DATE', '1', '���������� ���� ���������� �������? (0=�� ����������; 1=����������)', '2', '9', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('23', '���������� �������� 1', 'DISPLAY_NEWSDESK_IMAGE', '1', '���������� �������� 1 �������? (0=�� ����������; 1=����������)', '2', '10', NULL, '2003-03-03 11:59:47', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('24', '���������� �������� 2', 'DISPLAY_NEWSDESK_IMAGE_TWO', '1', '���������� �������� 2 �������? (0=�� ����������; 1=����������)', '2', '11', '2003-03-03 12:08:55', '2003-03-03 11:59:47', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('25', '���������� �������� 3', 'DISPLAY_NEWSDESK_IMAGE_THREE', '1', '���������� �������� 3 �������? (0=�� ����������; 1=����������)', '2', '12', '2003-03-03 12:09:16', '2003-03-03 11:59:47', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('26', '���������� ������', 'DISPLAY_NEWSDESK_REVIEWS', '1', '���������� ������? (0=�� ����������; 1=����������)', '3', '1', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('27', '������������ ���������� ����� �������', 'MAX_DISPLAY_NEW_REVIEWS', '10', '������������ ���������� ��������� ����� �������.', '3', '2', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('28', '���������� ���� ���������', 'STICKY_ARTICLE_NAME', '1', '���������� ��������� �������? (0=�� ����������; 1=����������)', '4', '1', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('29', '���������� ���� ������', 'STICKY_ARTICLE_SHORTTEXT', '1', '���������� ���� ������? (0=�� ����������; 1=����������)', '4', '2', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('30', '���������� ����������', 'STICKY_ARTICLE_DESCRIPTION', '1', '���������� ���������� �������? (0=�� ����������; 1=����������)', '4', '3', '2003-03-02 00:49:34', '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('31', '���������� ������� ����������', 'STICKY_NEWSDESK_VIEWCOUNT', '1', '���������� ������� ���������� �������? (0=�� ����������; 1=����������)', '4', '4', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('32', '���������� ������ ���������', 'STICKY_NEWSDESK_READMORE', '1', '���������� ������ ���������? (0=�� ����������; 1=����������)', '4', '5', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('33', '���������� ����', 'STICKY_DATE_ADDED', '1', '���������� ���� ���������� �������? (0=�� ����������; 1=����������)', '4', '6', '2003-03-02 00:49:54', '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('34', '���������� URL ������', 'STICKY_ARTICLE_URL', '1', '���������� URL ������ �������? (0=�� ����������; 1=����������)', '4', '7', '2003-03-02 00:50:28', '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('35', '���������� ��������', 'STICKY_IMAGE', '1', '���������� �������� 1 �������? (0=�� ����������; 1=����������)', '4', '8', '2003-03-02 00:50:14', '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('36', '���������� �������� 2', 'STICKY_IMAGE_TWO', '1', '���������� �������� 2 �������? (0=�� ����������; 1=����������)', '4', '9', NULL, '2003-03-03 23:10:34', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('37', '���������� �������� 3', 'STICKY_IMAGE_THREE', '1', '���������� �������� 3 �������? (0=�� ����������; 1=����������)', '4', '10', NULL, '2003-03-03 23:10:34', NULL, NULL);
drop table if exists newsdesk_configuration_group;
create table newsdesk_configuration_group (
  configuration_group_id int(11) not null auto_increment,
  configuration_group_key varchar(255) not null ,
  configuration_group_title varchar(64) not null ,
  configuration_group_description varchar(255) not null ,
  sort_order int(5) ,
  visible int(1) default '1' ,
  PRIMARY KEY (configuration_group_id)
);

insert into newsdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('1', 'NEWSDESK_LISTING_DB', '��������� ������', '��������� ������ �������� �� ��������', '1', '1');
insert into newsdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('2', 'NEWSDESK_SETTINGS_DB', '����� ���������', '����� ��������� ������', '1', '1');
insert into newsdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('3', 'NEWSDESK_REVIEWS_DB', '��������� �������', '��������� �������', '1', '1');
insert into newsdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('4', 'NEWSDESK_STICKY_DB', '��������� \"�������\" ��������', '��������� \"�������\" ��������', '1', '1');
drop table if exists newsdesk_description;
create table newsdesk_description (
  newsdesk_id int(11) not null auto_increment,
  language_id int(11) default '1' not null ,
  newsdesk_article_name varchar(64) not null ,
  newsdesk_article_description text ,
  newsdesk_article_shorttext text ,
  newsdesk_article_url varchar(255) ,
  newsdesk_article_viewed int(5) default '0' ,
  newsdesk_image_text text ,
  newsdesk_image_text_two text ,
  newsdesk_image_text_three text ,
  PRIMARY KEY (newsdesk_id, language_id),
  KEY newsdesk_article_name (newsdesk_article_name)
);

insert into newsdesk_description (newsdesk_id, language_id, newsdesk_article_name, newsdesk_article_description, newsdesk_article_shorttext, newsdesk_article_url, newsdesk_article_viewed, newsdesk_image_text, newsdesk_image_text_two, newsdesk_image_text_three) values ('2', '1', '������ �������!', '��������', '������', '', '0', '', '', '');
insert into newsdesk_description (newsdesk_id, language_id, newsdesk_article_name, newsdesk_article_description, newsdesk_article_shorttext, newsdesk_article_url, newsdesk_article_viewed, newsdesk_image_text, newsdesk_image_text_two, newsdesk_image_text_three) values ('2', '2', 'Sample news!', 'Content', 'Summary', '', '0', '', '', '');
drop table if exists newsdesk_reviews;
create table newsdesk_reviews (
  reviews_id int(11) not null auto_increment,
  newsdesk_id int(11) default '0' not null ,
  customers_id int(11) ,
  customers_name varchar(64) not null ,
  reviews_rating int(1) ,
  date_added datetime ,
  last_modified datetime ,
  reviews_read int(5) default '0' not null ,
  approved tinyint(3) unsigned default '0' ,
  PRIMARY KEY (reviews_id)
);

drop table if exists newsdesk_reviews_description;
create table newsdesk_reviews_description (
  reviews_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  reviews_text text ,
  PRIMARY KEY (reviews_id, languages_id)
);

drop table if exists newsdesk_to_categories;
create table newsdesk_to_categories (
  newsdesk_id int(11) default '0' not null ,
  categories_id int(11) default '0' not null ,
  PRIMARY KEY (newsdesk_id, categories_id)
);

insert into newsdesk_to_categories (newsdesk_id, categories_id) values ('2', '2');
drop table if exists newsletters;
create table newsletters (
  newsletters_id int(11) not null auto_increment,
  title varchar(255) not null ,
  content text ,
  module varchar(255) not null ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  date_sent datetime ,
  status int(1) ,
  locked int(1) default '0' ,
  PRIMARY KEY (newsletters_id)
);

drop table if exists orders;
create table orders (
  orders_id int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  customers_groups_id int(11) default '0' not null ,
  customers_name varchar(64) not null ,
  customers_company varchar(32) ,
  customers_street_address varchar(64) not null ,
  customers_suburb varchar(32) ,
  customers_city varchar(32) not null ,
  customers_postcode varchar(10) not null ,
  customers_state varchar(32) ,
  customers_country varchar(32) not null ,
  customers_telephone varchar(32) not null ,
  customers_email_address varchar(96) not null ,
  customers_address_format_id int(5) default '0' not null ,
  delivery_name varchar(64) not null ,
  delivery_company varchar(32) ,
  delivery_street_address varchar(64) not null ,
  delivery_suburb varchar(32) ,
  delivery_city varchar(32) not null ,
  delivery_postcode varchar(10) not null ,
  delivery_state varchar(32) ,
  delivery_country varchar(32) not null ,
  delivery_address_format_id int(5) default '0' not null ,
  billing_name varchar(64) not null ,
  billing_company varchar(32) ,
  billing_street_address varchar(64) not null ,
  billing_suburb varchar(32) ,
  billing_city varchar(32) not null ,
  billing_postcode varchar(10) not null ,
  billing_state varchar(32) ,
  billing_country varchar(32) not null ,
  billing_address_format_id int(5) default '0' not null ,
  payment_method varchar(255) not null ,
  payment_info text ,
  cc_type varchar(20) ,
  cc_owner varchar(64) ,
  cc_number varchar(32) ,
  cc_expires varchar(4) ,
  last_modified datetime ,
  date_purchased datetime ,
  orders_status int(5) default '0' not null ,
  orders_date_finished datetime ,
  currency char(3) ,
  currency_value decimal(14,6) ,
  customers_referer_url varchar(255) ,
  customers_fax varchar(32) not null ,
  shipping_module varchar(255) ,
  PRIMARY KEY (orders_id),
  KEY idx_orders_customers_id (customers_id)
);

drop table if exists orders_products;
create table orders_products (
  orders_products_id int(11) not null auto_increment,
  orders_id int(11) default '0' not null ,
  products_id int(11) default '0' not null ,
  products_model varchar(255) ,
  products_name varchar(255) not null ,
  products_price decimal(15,4) default '0.0000' not null ,
  final_price decimal(15,4) default '0.0000' not null ,
  products_tax decimal(7,4) default '0.0000' not null ,
  products_quantity int(2) default '0' not null ,
  PRIMARY KEY (orders_products_id),
  KEY idx_orders_products_orders_id (orders_id),
  KEY idx_orders_products_products_id (products_id)
);

drop table if exists orders_products_attributes;
create table orders_products_attributes (
  orders_products_attributes_id int(11) not null auto_increment,
  orders_id int(11) default '0' not null ,
  orders_products_id int(11) default '0' not null ,
  products_options varchar(32) not null ,
  products_options_values varchar(32) not null ,
  options_values_price decimal(15,4) default '0.0000' not null ,
  price_prefix char(1) not null ,
  PRIMARY KEY (orders_products_attributes_id),
  KEY idx_orders_products_att_orders_id (orders_id)
);

drop table if exists orders_products_download;
create table orders_products_download (
  orders_products_download_id int(11) not null auto_increment,
  orders_id int(11) default '0' not null ,
  orders_products_id int(11) default '0' not null ,
  orders_products_filename varchar(255) not null ,
  download_maxdays int(2) default '0' not null ,
  download_count int(2) default '0' not null ,
  PRIMARY KEY (orders_products_download_id),
  KEY idx_orders_products_download_orders_id (orders_id)
);

drop table if exists orders_status;
create table orders_status (
  orders_status_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  orders_status_name varchar(32) not null ,
  PRIMARY KEY (orders_status_id, language_id),
  KEY idx_orders_status_name (orders_status_name)
);

insert into orders_status (orders_status_id, language_id, orders_status_name) values ('1', '1', '������� ��������');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('2', '1', '��� ������');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('3', '1', '�����������');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('4', '1', '������������');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('5', '1', '���������');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('6', '1', '������');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('1', '2', 'Pending');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('2', '2', 'Waiting approval');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('3', '2', 'Processing');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('4', '2', 'Delivering');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('5', '2', 'Delivered');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('6', '2', 'Canceled');
drop table if exists orders_status_history;
create table orders_status_history (
  orders_status_history_id int(11) not null auto_increment,
  orders_id int(11) default '0' not null ,
  orders_status_id int(5) default '0' not null ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  customer_notified int(1) default '0' ,
  comments text ,
  PRIMARY KEY (orders_status_history_id),
  KEY idx_orders_status_history_orders_id (orders_id)
);

drop table if exists orders_total;
create table orders_total (
  orders_total_id int(10) unsigned not null auto_increment,
  orders_id int(11) default '0' not null ,
  title varchar(255) not null ,
  text varchar(255) not null ,
  value decimal(15,4) default '0.0000' not null ,
  class varchar(32) not null ,
  sort_order int(11) default '0' not null ,
  PRIMARY KEY (orders_total_id),
  KEY idx_orders_total_orders_id (orders_id)
);

drop table if exists pages;
create table pages (
  pages_id int(11) not null auto_increment,
  pages_image varchar(64) ,
  pages_date_added datetime default '0000-00-00 00:00:00' not null ,
  pages_last_modified datetime ,
  pages_status tinyint(1) default '0' not null ,
  sort_order int(3) ,
  PRIMARY KEY (pages_id),
  KEY idx_pages_date_added (pages_date_added)
);

insert into pages (pages_id, pages_image, pages_date_added, pages_last_modified, pages_status, sort_order) values ('4', 'br.gif', '2005-06-22 18:11:49', NULL, '1', '4');
insert into pages (pages_id, pages_image, pages_date_added, pages_last_modified, pages_status, sort_order) values ('3', 'br.gif', '2005-06-22 18:10:38', NULL, '1', '3');
insert into pages (pages_id, pages_image, pages_date_added, pages_last_modified, pages_status, sort_order) values ('2', 'br.gif', '2005-06-22 18:10:01', NULL, '1', '2');
insert into pages (pages_id, pages_image, pages_date_added, pages_last_modified, pages_status, sort_order) values ('1', 'br.gif', '2005-06-22 18:07:49', '2006-01-05 13:42:48', '1', '1');
insert into pages (pages_id, pages_image, pages_date_added, pages_last_modified, pages_status, sort_order) values ('5', 'br.gif', '2005-06-22 18:14:43', NULL, '1', '5');
drop table if exists pages_description;
create table pages_description (
  pages_id int(11) not null auto_increment,
  language_id int(11) default '1' not null ,
  pages_name varchar(64) not null ,
  pages_description text ,
  pages_viewed int(5) default '0' ,
  PRIMARY KEY (pages_id, language_id),
  KEY pages_name (pages_name)
);

insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('2', '2', 'Shipping and returns', 'Put here your shipping and returns', '1');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('3', '1', '������������', '<b>�����������, ������� �� �����������.</b><br><br>

��� ����������������  ����������, ������� �� ������������ �� ������ ���������, ���������� ����� ������, ��� ��������, 
������������ � ���������� ����������, �������� � ��������� ��������� � ������ ������ ����������������� ������ ������������ 
������, � ������������ ������� ���������� � ������������� ����, � �������������� ��������� SSL, �������������� ������������ 
����������� � ������������.<br>
�� ����������� ����������� ���� ���������������� ���������� ����������� �� ��������. �� ��� �� �����������, ��� ��� ���������� 
�� ����� �������� ��� �������� ���� ���� �������, ������� ������� ��� � �����������. <br>
<br>
 ������������ ������������ �������� SSL.<br><br>
�� ��������� 128-������� ��������� ���������� �� ������� SSL, � ������������ �� ����������� USA. ��� ��������� ��������, 
����������� ��� ����������� ���������� ���������� � ��������. ����������: ������������� ����������� ������ ������������ 
������� ����� ������ ���������� �� ������� ���.
��� ������ �������� � ���, � ��������� ����� ������������ ���������, �� ������ ���������� ���� �������� ������������ �� ����� 
������� ������� ������.<br>
<br>
������ SSL.<br>
�������� SSL (Secure Sockets Layer) �������� ��� ������ ������������ ����� �������� ����� �������� � ��������. ��� ������� ����������� 
�������� ���������� ������ ����� ��������� ������������� ���� � ����� ����� ���� ��������, �  ������ � ������ ��� �������� � 
������������� ���������� �������� ������ ����������.<br>', '0');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('2', '1', '�������� � �������', '��� ���������� ������ ������, ��� ���������� ����������� 
  ����� �� ��� ���������.<br> ��� �������, ����������� ����� ���������� 24 ����, � 
  � ��������� ������� ��� ����� ����������� �� �� ����, ��� ����� �������� �������� 
  ����� ��� � �������� � ����������� ���.<br>

  �������, �� ������ ��� ������ ���� ������ ���������������.<br> ����� ��� ���������� 
  �������������� 1-4 ������� ���, ����� �� ����� ����������� � ���������, � �� 
  ����� �������� ��� ����� � ���������� ����.</p>
  <br>
  ������������ � �������� ��������:<br>
  ���������� ��� �� ������� � ����� �������� ��������. ��������� ���������� ����������� 
  ������� ������������ � �������� ��������.<br>
  <br>
  ������:<br>

  ��� ���� ������������, ��������� �� ����� �����, ������ ����� ���� ����������� 
  � ������� ������� WebMoney, ���� ���������� ��������� �� ��� ����.<br>
  <br>
  ����� ������ ��� �������� ����������:<br>
  �� ������ ���������� �� ������������� ���� ������, � ������, ���� ������������ 
  ����� �� ������������� ����, ��� �� ���������� � ����� ����� ���� ��������� 
  ��������������� � ������ ��������. ����� ������ ���� ��������� � ����� ������������ �������� � ��������������� ������� �����������. <br>
  ���� � ��� ���� ����� �������, ����������, ��������� � ����� ������� ������������', '0');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('3', '2', 'Privacy', 'Put here your Privacy info', '1');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('4', '1', '������� � ��������', '������� �������������� �����. (Online agreement.)<br><br>

�������� ������� <b>�������� ��������</b><br>
   �������������� �������� ��������� ���������� ����� �������� �������� (� ���������� \"��������\") � ����������� (\"����������\") � ������������ ������� ��� �����, ����� �������� ���� �������� (\"����\"). ���� �� �� ������������ � ����� ���������, �� �� ������� ���������� ���� ������ � ������, ������� ����������� ���������� ����������� ��� ������� �� ���������� �������:<br><br>
1. ��������.<br> ���������� ����������� � ���������, ������������ � ���� ���������� ������ (\"����������\"), �� ����, ��� �������� �������, ����� � ���������� ��������������� ����� ����. ��� ���������� ������������ ����� ������� ����� ��������� � �����������, � �������� ����� �������������� ��� ���� ����������, �������� � ��������, � ����������� ���, ��� �������� �������, ����� � ���������� ��������������� ����������� �����. ���������� ����������� ����������� � �������� ��� ���������� �� ������� ������� ��� ����� �� �����.<br><br>
2. ���������� ��� �������.<br>���������� �������� � �����������, ��� �������� �� ���������� � ��������� �������� ��������, ���������� � ������. ������ ������� � ����� �������������� �����������, ����� ������� ��������� ��������� �������� ���������� � ���������� ������ ��������� ��������� ������������ ������� � �����, � ��� �� ��������� �������� ������� � �����, ������������� �� ������ ������, ������� ��� ����������� ������. ���������� ������ ���� ������������� �� ��� ������, ����������� � �������������� ������ ����������. ���������� ����������� ������� ��� ��� �� ������ ��������������� � ���������� �������� � �������� 24 ����� � ����� ������������������� ������������� ������ ��� ��������� ����� ����������. �������� �� �������� ���������� �� �������������������� ������������� ������ ����������. ������������ ��������� ����� ������ ������������� ����� ����������� � ��������� �� ����� ��������� ����� ������ $10,000 ���.<br><br>
3. ��������� �����.<br> ���������� ����� �������� ���������� �������, ������� ����������� �������� ����� � ������, (�������, ��, �� ������������� ���������������� ��������������). �����������, ����, ����������, ��������� �������, �������� �������������� � ������ ��������, ��������� � �������������� ����������, � ��� �� �����������, �����������������, ������������� ��� ���������� ����������� ������� ���������� ��� ����� ����� �����, ���������.<br><br>

4. ��������������, �������� � �����������.<br> �������� ����������� �� ����� ������������ ����� �� ��������������, �������� ��� ��������� �� ����� ����� ����������, � ��� �� �������� ��� ��������� ����� ������� � ����� ��� �������. �������� ����� �������������� ��� ����������, ��� ���� �� ������ � ������, � ������������ �� ���� ����������, ���� ��� ��������� � ���������� � �������������� �����, � ����� ���������� ���������������� ��� �������������� ����� ��� ��� ������� ����� �� ������ ������������ ���������� � ��� ���������������� �����������. ����������� ����� ���������� ����� ��������� �������������� ����� ���������� ��� �� �����, � ���������� � �������, ����������� ����� ���� ����������.<br><br>
5. ����� ������. <br>�������� ����������� �� ����� ����� �� ������ ������������ ����������, ���������� ������� ������� � �������������� �����, � ����� ������������ ������ � ������� ����� ������� ��� �����.<br><br>
6. ����������.<br> ���������� ����������� ���������, �������� � ������������ ������� �������� � �� �����������, ��������� � ����������� � ������������ �� ����� ���������������, �������, ��������� � ��������, ������� �������� ����������� ��������, ��������� � ���������� ����������� ����� ��������� ��� �������������� �����.<br><br>
7. ����������� �������� ���� ������� ����.<br> ����� ���������� ������������ ������, �������� ��� ������ ������ � �� �������� �������� ������� ���� ��� ����������� � ������������ ��������� � ��������� ������������� ��������� ��� ��������� ��������� �������� ����������.<br><br>
8. ������������ ���������������.<br> ��������������� ������ � ������, ����������, � ��� �� ������ ��������������� ����� ������ ������ ������������� \"��� ����\" � \"��� ��������\" � ��� ��������, ����� ��� �������, ��������� (�������, �� �� ������������� ������� �� ����� ������� �������� ������������ �������� � ����������� ��� ���������� ����). ������������ � ����� ������������ ��������������� �������� �� ����� ������� ����� ����������� ������ � ������������ ����������� �� ����� �������, ����� ���������� ������ ���������� �������� ��� ������������� ���������� ������� ��� �����. �������� � ����� �� �� ���������, ������� ��� ����������� �� ������������ �� ����� ���������, �����������, ���������, ��� ����������� �����, (������� ����� � ������ � �������, ���������� ������, �������� ����, ��� �������� ������� ������ � �������), ���������� �� ����, ��� ��� ������������ �� ��������� ���������, ��������� ��������, ����������� (������� ����������), � ���������� ������������� �������� ��� ������ ��� ���� ��������, ���� ���� �������������� ���� �������� � ����������� ������ ������. ����������� ������ ���������� ���� - ��������������� �������� ������ ������ ����� ��������� � �����������. ���� ����, ������ � ������ �� ������ ��������������� ��� ����� �����������. ��������� ��������������� ������ ����� ���� ��������� ������������ ����������� ���������������. ����� ��������� �������� ��������������� �������������� � ���� ���������� ���������.<br><br>

9. ������������� ����������.<br> �������� ����������� �����, � ���������� �������������� ��������, �� ������������� �� ���������� ���� ���������� ������������ ������������� ����������� ����� � ���� ���������� ��������������� �����������, �������� ����������� �������.<br><br>
10. ������.<br> ��� ���������� ������ ��������������� � ��� ����, ��� ��� ������������ �������� ��������, � ������ ����������� � ����������� � ������������ � �������� ���������� ���������. ����� �������� ����������, ���������� ��� ��������� ������ ������������� � ������� ����� ������� (6) ����� ������ ������������ ��������������� �� ����� ��� ���������� �������� ������������ �� ����� ���������. ��� �������� ������ ������������� � ������ �����������, ���������� � ������� 8. ���������� ����� ���������� ������ ���� �������� � ������ ����� �������, ��� ��� ����� ��������� ����������� ��� ����� ������. ���� ����� �� ������ ����� ���������� ����� �������� ������������ ��� ��������������, ��� ����� ������ ���� ��������� � ������������ � ������� ����� �������, ����� �������� �������� ��������� � �������� ����� ������. ��������� ����� ������ ���������� � ������ ���� � ��������. � ������, ���� ���-���� ��������� � ������ ��� ���������, �������� � �������� ��� ������������ � ���� �����������, ��� ���������� �������� ������������. ������� �������� � ������������� ������ �������������� ����� ���������� ���������� �� ������ ��������� ������������� �� ������ �������������� ��� ������������� �� ����� ������������ ����� ��������������.', '0');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('4', '2', 'Conditions of Use', 'Put here your Conditions of Use information.', '1');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('5', '1', '�����������', '<b>��� ������ ����������?</b><br/>
����������� ���������� ��� ��, ��� � ������� �����, �.�. ��� ���������� �������� ���������� � ������� � �������� �����, ��! ����� ���� ��� �� ������� ������, ��� ���������� ����� ������������� � �� ������� ��������� ������� � ������� ������ �����������, ���� �������� ���� ���������� ����� ������� ��� ��������. ����� ����������� �����������, �� �������� ����������� �� ���� Email �����.<br/>
<br/>
<b>��� ��������� ���������� ����-���� ���?</b><br/>
��� ����� ���������� ��������� ���������� ����� �� ����������� ����� ���������� ������, ���������� ����� ��������� ������������ ����� � ������ ������ \"����������\".<br/>
<br/>
<b>����� ����� ����������?</b><br/>
���������� ����� ���� ����������� ��� ������ ��� ��������� ������ ������ (� ����������� �� ����� �����������), ������������ � ����� ��������-��������, ������ ������� ������� �� ����������� �� �������, ���������� ������ ����� ������������ � ���������� ��� ���������� ������� � ����� ��������-��������, ����� ����, �� ������ �������� ���� ���������� ����� ������� � ��������.<br/>
<br/>
<b>��� ������������ ���������� ��� ���������� ������?</b><br/>
� �������� ���������� ������ � ����� ��������-�������� ��� ����� ���������� ��������������� ������������.<br/>
<br/>
<b>��� ������, ���� ��������� ��������, ������� ��� ������������� ������������?</b><br/>
���� � ��� ��������� ��������, ���� ������� ��� ������������� ������������, ����������� ������ ��������� � ���� � ����� ����������. �� ������� �� ��� ���� ������� � �������� �����.<br/>
<br/>', '0');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('5', '2', 'Gift Voucher FAQ', '<b>Purchasing Gift Vouchers.</b><br/>
Gift Vouchers are purchased just like any other item in our store. You can pay for them using the stores standard payment method(s). Once purchased the value of the Gift Voucher will be added to your own personal Gift Voucher Account. If you have funds in your Gift Voucher Account, you will notice that the amount now shows in the Shopping Cart box, and also provides a link to a page where you can send the Gift Voucher to some one via email.<br/>
<br/>
<b>How to Send Gift Vouchers</b><br/>
To send a Gift Voucher you need to go to our Send Gift Voucher Page. You can find the link to this page in the Shopping Cart Box in the right hand column of each page. When you send a Gift Voucher, you need to specify the following. The name of the person you are sending the Gift Voucher to. The email address of the person you are sending the Gift Voucher to. The amount you want to send. (Note you don\'t have to send the full amount that is in your Gift Voucher Account.) A short message which will appear in the email. Please ensure that you have entered all of the information correctly, although you will be given the opportunity to change this as much as you want before the email is actually sent.<br/>
<br/>
<b>Buying with Gift Vouchers.</b><br/>
If you have funds in your Gift Voucher Account, you can use those funds to purchase other items in our store. At the checkout stage, an extra box will appear. Ticking this box will apply those funds in your Gift Voucher Account. Please note, you will still have to select another payment method if there is not enough in your Gift Voucher Account to cover the cost of your purchase. If you have more funds in your Gift Voucher Account than the total cost of your purchase the balance will be left in your Gift Voucher Account for future purchases.<br/>
<br/>
<b>Redeeming Gift Vouchers.</b><br/>
If you receive a Gift Voucher by email it will contain details of who sent you the Gift Voucher, along with possibly a short message from them. The Email will also contain the Gift Voucher Number. It is probably a good idea to print out this email for future reference. You can now redeem the Gift Voucher in two ways.<br/>
1. By clicking on the link contained within the email for this express purpose. This will take you to the store\'s Redeem Voucher page. You will then be requested to create an account, before the Gift Voucher is validated and placed in your Gift Voucher Account ready for you to spend it on whatever you want.<br/>
2. During the checkout process, on the same page that you select a payment method there will be a box to enter a Redeem Code. Enter the code here, and click the redeem button. The code will be validated and added to your Gift Voucher account. You can then use the amount to purchase any item from our store.<br/>
<br/>
<b>When problems occur.</b><br/>
For any queries regarding the Gift Voucher System, please contact the store by email at root@localhost. Please make sure you give as much information as possible in the email.<br/>
<br/>', '1');

drop table if exists phesis_comments;
create table phesis_comments (
  commentid int(11) not null auto_increment,
  pollid int(11) default '0' ,
  customer_id int(11) default '0' not null ,
  date datetime ,
  name varchar(60) not null ,
  host_name varchar(60) ,
  comment text ,
  language_id int(11) default '1' not null ,
  PRIMARY KEY (commentid)
);

drop table if exists phesis_poll_check;
create table phesis_poll_check (
  ip varchar(20) not null ,
  time varchar(14) not null ,
  pollID int(10) default '0' not null 
);

insert into phesis_poll_check (ip, time, pollID) values ('127.0.0.1', '1094639684', '1');
insert into phesis_poll_check (ip, time, pollID) values ('127.0.0.1', '1094639937', '2');
insert into phesis_poll_check (ip, time, pollID) values ('127.0.0.1', '1094640148', '3');
drop table if exists phesis_poll_config;
create table phesis_poll_config (
  configuration_id int(5) not null auto_increment,
  configuration_title varchar(64) not null ,
  configuration_key varchar(64) not null ,
  configuration_value varchar(255) not null ,
  configuration_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (configuration_id)
);

insert into phesis_poll_config (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, last_modified, date_added) values ('1', '����� ����� ����������', 'DISPLAY_POLL_HOW', '2', '����� ������ ���������� � �����.<br>0 = ���������<br>1 = ����� ���������<br>2 = ����� ����������<br>3 = ��������� ���� ����� � ���� ID ������', '2001-12-08 18:22:30', '2001-12-07 16:56:23');
insert into phesis_poll_config (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, last_modified, date_added) values ('2', 'ID ������', 'DISPLAY_POLL_ID', '', '���� �� � ���������� ���������� ����� ������� 3, �� ����� ���������� ������� ID ��� ������, ������� ����� �������.', '2001-12-08 18:22:30', '2001-12-07 16:56:23');
insert into phesis_poll_config (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, last_modified, date_added) values ('3', '��������� ������', 'SHOW_POLL_COMMENTS', '1', '��������� ��������� ������ � ������?<br>0 = ���������<br>1 = ���������', '2003-04-06 16:19:43', '2001-12-07 16:58:09');
insert into phesis_poll_config (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, last_modified, date_added) values ('4', '���������� ���� ������� ���� ���� ��� �������', 'SHOW_NOPOLL', '0', '���������� ���� �������, ���� ���� �� ������ ������ �� ������ ������ �� ����������.<br>0 = �� ����������<br>1 = ����������', '2004-09-08 14:41:20', '2001-12-07 19:36:33');
insert into phesis_poll_config (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, last_modified, date_added) values ('5', '��������� ���������� ��������� ���', 'POLL_SPAM', '0', '��������� ���������� ������ �������� ��������� ��� � ����� � ��� �� ������.<br>0 = �� ��������� (�������������)<br>1 = ���������', '2001-12-07 20:20:26', '2001-12-07 20:20:26');
insert into phesis_poll_config (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, last_modified, date_added) values ('6', '���������� ������� �� ��������', 'MAX_DISPLAY_NEW_COMMENTS', '10', '������������ ���������� ������� �� ��������', '2001-12-07 20:20:26', '2001-12-07 20:20:26');
drop table if exists phesis_poll_data;
create table phesis_poll_data (
  pollID int(11) default '0' not null ,
  optionText varchar(255) not null ,
  optionCount int(11) default '0' not null ,
  voteID int(11) default '0' not null ,
  language_id int(11) default '1' not null 
);

insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '14', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '13', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '12', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '11', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '10', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '9', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '8', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '7', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '6', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '5', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '4', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '�� ����', '0', '3', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '������', '0', '2', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '����', '0', '1', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '��� ����� - ���� ��� ������?', '0', '0', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '15', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', 'Sample poll!', '0', '0', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', 'Answer 1', '0', '1', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', 'Answer 2', '0', '2', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', 'Answer 3', '0', '3', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '4', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '5', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '6', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '7', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '8', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '9', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '10', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '11', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '12', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '13', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '14', '2');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', '', '0', '15', '2');
drop table if exists phesis_poll_desc;
create table phesis_poll_desc (
  pollID int(11) not null auto_increment,
  timeStamp datetime ,
  voters mediumint(9) default '0' not null ,
  poll_type char(1) default '0' not null ,
  poll_open char(1) default '0' not null ,
  catID int(11) default '0' not null ,
  prodID int(11) default '0' not null ,
  PRIMARY KEY (pollID)
);

insert into phesis_poll_desc (pollID, timeStamp, voters, poll_type, poll_open, catID, prodID) values ('4', '2005-06-22 18:01:34', '0', '0', '0', '0', '0');
drop table if exists products;
create table products (
  products_id int(11) not null auto_increment,
  products_quantity int(4) default '0' not null ,
  products_model varchar(255) ,
  products_image varchar(64) ,
  products_image_med varchar(64) ,
  products_image_lrg varchar(64) ,
  products_image_sm_1 varchar(64) ,
  products_image_xl_1 varchar(64) ,
  products_image_sm_2 varchar(64) ,
  products_image_xl_2 varchar(64) ,
  products_image_sm_3 varchar(64) ,
  products_image_xl_3 varchar(64) ,
  products_image_sm_4 varchar(64) ,
  products_image_xl_4 varchar(64) ,
  products_image_sm_5 varchar(64) ,
  products_image_xl_5 varchar(64) ,
  products_image_sm_6 varchar(64) ,
  products_image_xl_6 varchar(64) ,
  products_price decimal(15,4) default '0.0000' not null ,
  products_date_added datetime default '0000-00-00 00:00:00' not null ,
  products_last_modified datetime ,
  products_date_available datetime ,
  products_weight decimal(5,2) default '0.00' not null ,
  products_status tinyint(1) default '0' not null ,
  products_to_xml tinyint(1) default '1' not null ,
  products_tax_class_id int(11) default '0' not null ,
  manufacturers_id int(11) ,
  products_ordered int(11) default '0' not null ,
  products_quantity_order_min int(8) default '1' not null ,
  products_quantity_order_units int(8) default '1' not null ,
  products_sort_order int(8) default '1000' not null ,
  PRIMARY KEY (products_id),
  KEY idx_products_model (products_model),
  KEY idx_products_date_added (products_date_added)
);

insert into products (products_id, products_quantity, products_model, products_image, products_image_med, products_image_lrg, products_image_sm_1, products_image_xl_1, products_image_sm_2, products_image_xl_2, products_image_sm_3, products_image_xl_3, products_image_sm_4, products_image_xl_4, products_image_sm_5, products_image_xl_5, products_image_sm_6, products_image_xl_6, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_to_xml, products_tax_class_id, manufacturers_id, products_ordered, products_quantity_order_min, products_quantity_order_units, products_sort_order) values ('1', '1000', 'kod1', 'osc-vam.gif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56.0000', '2004-08-12 17:12:28', '2005-06-22 18:04:34', NULL, '1.10', '1', '1', '0', '5', '0', '1', '1', '1000');
insert into products (products_id, products_quantity, products_model, products_image, products_image_med, products_image_lrg, products_image_sm_1, products_image_xl_1, products_image_sm_2, products_image_xl_2, products_image_sm_3, products_image_xl_3, products_image_sm_4, products_image_xl_4, products_image_sm_5, products_image_xl_5, products_image_sm_6, products_image_xl_6, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_to_xml, products_tax_class_id, manufacturers_id, products_ordered, products_quantity_order_min, products_quantity_order_units, products_sort_order) values ('2', '1000', 'kod2', 'osc-vam.gif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20.0000', '2004-08-12 17:13:28', '2005-06-22 18:03:47', NULL, '0.10', '1', '1', '0', '4', '0', '1', '1', '1000');
drop table if exists products_attributes;
create table products_attributes (
  products_attributes_id int(11) not null auto_increment,
  products_id int(11) default '0' not null ,
  options_id int(11) default '0' not null ,
  options_values_id int(11) default '0' not null ,
  options_values_price decimal(15,4) default '0.0000' not null ,
  price_prefix char(1) not null ,
  products_options_sort_order int(6) default '0' not null ,
  product_attributes_one_time tinyint(1) default '0' not null ,
  products_attributes_weight decimal(5,2) default '0.00' not null ,
  products_attributes_weight_prefix char(1) not null ,
  products_attributes_units int(4) default '0' not null ,
  products_attributes_units_price decimal(15,4) default '0.0000' not null ,
  PRIMARY KEY (products_attributes_id),
  KEY idx_products_attributes_products_id (products_id)
);

drop table if exists products_attributes_download;
create table products_attributes_download (
  products_attributes_id int(11) default '0' not null ,
  products_attributes_filename varchar(255) not null ,
  products_attributes_maxdays int(2) default '0' ,
  products_attributes_maxcount int(2) default '0' ,
  PRIMARY KEY (products_attributes_id)
);

drop table if exists products_description;
create table products_description (
  products_id int(11) not null auto_increment,
  language_id int(11) default '1' not null ,
  products_name varchar(255) not null ,
  products_description text ,
  products_tab_1 text default null,
  products_tab_2 text default null,
  products_tab_3 text default null,
  products_tab_4 text default null,
  products_tab_5 text default null,
  products_tab_6 text default null,
  products_url varchar(255) ,
  products_viewed int(5) default '0' ,
  products_head_title_tag varchar(255) ,
  products_head_desc_tag longtext ,
  products_head_keywords_tag longtext ,
  products_info text ,
  PRIMARY KEY (products_id, language_id),
  KEY products_name (products_name)
);

insert into products_description (products_id, language_id, products_name, products_description, products_tab_1, products_tab_2, products_tab_3, products_tab_4, products_tab_5, products_tab_6, products_url, products_viewed, products_head_title_tag, products_head_desc_tag, products_head_keywords_tag, products_info) values ('1', '1', '���� �����', '���� �����<br>
����� ������, ����� ������, ����� �������.', '', '', '', '', '', '', '', '2', '���� �����, ����� title ��� ��� ������', 'description', 'keywords', '������� �������� �����.');
insert into products_description (products_id, language_id, products_name, products_description, products_tab_1, products_tab_2, products_tab_3, products_tab_4, products_tab_5, products_tab_6, products_url, products_viewed, products_head_title_tag, products_head_desc_tag, products_head_keywords_tag, products_info) values ('2', '1', '���� ����', '��������', '', '', '', '', '', '', '', '5', '', '', '', '������� �� ������, ������� ���� ����� �� 20$.');
insert into products_description (products_id, language_id, products_name, products_description, products_tab_1, products_tab_2, products_tab_3, products_tab_4, products_tab_5, products_tab_6, products_url, products_viewed, products_head_title_tag, products_head_desc_tag, products_head_keywords_tag, products_info) values ('1', '2', 'Sample product 2', 'Description 2', '', '', '', '', '', '', '', '0', '', '', '', 'Short description 2');
insert into products_description (products_id, language_id, products_name, products_description, products_tab_1, products_tab_2, products_tab_3, products_tab_4, products_tab_5, products_tab_6, products_url, products_viewed, products_head_title_tag, products_head_desc_tag, products_head_keywords_tag, products_info) values ('2', '2', 'Sample product', 'Description', '', '', '', '', '', '', '', '0', '', '', '', 'Short description');

drop table if exists products_extra_fields;
create table products_extra_fields (
  products_extra_fields_id int(11) not null auto_increment,
  products_extra_fields_name varchar(64) not null ,
  products_extra_fields_order int(3) default '0' not null ,
  products_extra_fields_status tinyint(1) default '1' not null ,
  languages_id int(11) default '0' not null ,
  PRIMARY KEY (products_extra_fields_id)
);

drop table if exists products_notifications;
create table products_notifications (
  products_id int(11) default '0' not null ,
  customers_id int(11) default '0' not null ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (products_id, customers_id)
);

drop table if exists products_options;
create table products_options (
  products_options_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  products_options_name varchar(32) not null ,
  products_options_sort_order int(4) default '0' not null ,
  products_options_type int(5) default '0' not null ,
  products_options_length smallint(2) default '32' not null ,
  products_options_comment varchar(32) ,
  products_options_images_enabled varchar(5) NOT NULL default 'false',
  PRIMARY KEY (products_options_id, language_id)
);

insert into products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment,products_options_images_enabled) values ('1', '1', '������', '0', '0', '32', NULL,'false');
insert into products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment,products_options_images_enabled) values ('1', '2', 'Size', '0', '0', '32', NULL,'false');
drop table if exists products_options_values;
create table products_options_values (
  products_options_values_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  products_options_values_name varchar(255) not null ,
  products_options_values_thumbnail varchar(255) NOT NULL default '',
  PRIMARY KEY (products_options_values_id, language_id)
);

insert into products_options_values (products_options_values_id, language_id, products_options_values_name,products_options_values_thumbnail) values ('3', '1', '���������','');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name,products_options_values_thumbnail) values ('2', '1', '�������','');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name,products_options_values_thumbnail) values ('1', '1', '�������','');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name,products_options_values_thumbnail) values ('3', '2', 'Small','');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name,products_options_values_thumbnail) values ('2', '2', 'Middle','');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name,products_options_values_thumbnail) values ('1', '2', 'Big','');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name,products_options_values_thumbnail) values ('0', '1', 'TEXT','');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name,products_options_values_thumbnail) values ('0', '2', 'TEXT','');
drop table if exists products_options_values_to_products_options;
create table products_options_values_to_products_options (
  products_options_values_to_products_options_id int(11) not null auto_increment,
  products_options_id int(11) default '0' not null ,
  products_options_values_id int(11) default '0' not null ,
  PRIMARY KEY (products_options_values_to_products_options_id)
);

insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('16', '1', '3');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('15', '1', '2');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('14', '1', '1');
drop table if exists products_prop_options;
create table products_prop_options (
  products_options_id int(11) default '1' not null ,
  categories_options_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  products_options_name varchar(32) not null ,
  PRIMARY KEY (products_options_id, language_id)
);

drop table if exists products_prop_options_values;
create table products_prop_options_values (
  products_options_values_id int(11) default '1' not null ,
  categories_options_values_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  products_options_values_name varchar(255) not null ,
  PRIMARY KEY (products_options_values_id, language_id)
);

drop table if exists products_prop_options_values_to_products_prop_options;
create table products_prop_options_values_to_products_prop_options (
  products_options_values_to_products_options_id int(11) not null auto_increment,
  products_options_id int(11) default '0' not null ,
  products_options_values_id int(11) default '0' not null ,
  PRIMARY KEY (products_options_values_to_products_options_id)
);

drop table if exists products_properties;
create table products_properties (
  products_attributes_id int(11) not null auto_increment,
  products_id int(11) default '0' not null ,
  categories_id int(11) default '0' not null ,
  options_id int(11) default '0' not null ,
  options_values_id int(11) default '0' not null ,
  sort_order tinyint(4) default '0' ,
  PRIMARY KEY (products_attributes_id)
);

drop table if exists products_to_categories;
create table products_to_categories (
  products_id int(11) default '0' not null ,
  categories_id int(11) default '0' not null ,
  PRIMARY KEY (products_id, categories_id)
);

insert into products_to_categories (products_id, categories_id) values ('1', '28');
insert into products_to_categories (products_id, categories_id) values ('2', '28');
drop table if exists products_to_products_extra_fields;
create table products_to_products_extra_fields (
  products_id int(11) default '0' not null ,
  products_extra_fields_id int(11) default '0' not null ,
  products_extra_fields_value varchar(255) ,
  PRIMARY KEY (products_id, products_extra_fields_id)
);

drop table if exists products_xsell;
create table products_xsell (
  ID int(10) not null auto_increment,
  products_id int(10) unsigned default '1' not null ,
  xsell_id int(10) unsigned default '1' not null ,
  sort_order int(10) unsigned default '1' not null ,
  PRIMARY KEY (ID)
);

insert into products_xsell (ID, products_id, xsell_id, sort_order) values ('1', '2', '1', '1');
insert into products_xsell (ID, products_id, xsell_id, sort_order) values ('2', '1', '2', '1');
drop table if exists reviews;
create table reviews (
  reviews_id int(11) not null auto_increment,
  products_id int(11) default '0' not null ,
  customers_id int(11) ,
  customers_name varchar(64) not null ,
  reviews_rating int(1) ,
  date_added datetime ,
  last_modified datetime ,
  reviews_read int(5) default '0' not null ,
  status_otz tinyint(1) default '0' not null ,
  PRIMARY KEY (reviews_id),
  KEY idx_reviews_products_id (products_id),
  KEY idx_reviews_customers_id (customers_id)
);

drop table if exists reviews_description;
create table reviews_description (
  reviews_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  reviews_text text ,
  PRIMARY KEY (reviews_id, languages_id)
);

drop table if exists salemaker_sales;
create table salemaker_sales (
  sale_id int(11) not null auto_increment,
  sale_status tinyint(4) default '0' not null ,
  sale_name varchar(30) not null ,
  sale_deduction_value decimal(15,4) default '0.0000' not null ,
  sale_deduction_type tinyint(4) default '0' not null ,
  sale_pricerange_from decimal(15,4) default '0.0000' not null ,
  sale_pricerange_to decimal(15,4) default '0.0000' not null ,
  sale_specials_condition tinyint(4) default '0' not null ,
  sale_categories_selected varchar(255) ,
  sale_categories_all varchar(255) ,
  sale_date_start date default '0000-00-00' not null ,
  sale_date_end date default '0000-00-00' not null ,
  sale_date_added date default '0000-00-00' not null ,
  sale_date_last_modified date default '0000-00-00' not null ,
  sale_date_status_change date default '0000-00-00' not null ,
  PRIMARY KEY (sale_id)
);

drop table if exists scart;
create table scart (
  scartid int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  dateadded varchar(8) not null ,
  PRIMARY KEY (scartid)
);

drop table if exists search_queries;
create table search_queries (
  search_id int(11) not null auto_increment,
  search_text tinytext ,
  PRIMARY KEY (search_id)
);

drop table if exists search_queries_sorted;
create table search_queries_sorted (
  search_id smallint(6) not null auto_increment,
  search_text tinytext ,
  search_count int(11) default '0' not null ,
  PRIMARY KEY (search_id)
);

drop table if exists searchword_swap;
create table searchword_swap (
  sws_id mediumint(11) not null auto_increment,
  sws_word varchar(100) not null ,
  sws_replacement varchar(100) not null ,
  PRIMARY KEY (sws_id)
);

drop table if exists sessions;
create table sessions (
  sesskey varchar(32) not null ,
  expiry int(11) unsigned default '0' not null ,
  value text ,
  PRIMARY KEY (sesskey)
);

drop table if exists ship2pay;
create table ship2pay (
  s2p_id int(11) not null auto_increment,
  shipment varchar(100) not null ,
  payments_allowed varchar(250) not null ,
  zones_id int(11) default '0' not null ,
  status tinyint(4) default '0' not null ,
  PRIMARY KEY (s2p_id)
);

DROP TABLE IF EXISTS companies;
CREATE TABLE companies (
  orders_id int(11) NOT NULL default '0',
  name varchar(255) default NULL,
  inn varchar(255) default NULL,
  kpp varchar(255) default NULL,
  ogrn varchar(255) default NULL,
  okpo varchar(255) default NULL,
  rs varchar(255) default NULL,
  bank_name varchar(255) default NULL,
  bik varchar(255) default NULL,
  ks varchar(255) default NULL,
  address varchar(255) default NULL,
  yur_address varchar(255) default NULL,
  fakt_address varchar(255) default NULL,
  telephone varchar(255) default NULL,
  fax varchar(255) default NULL,
  email varchar(255) default NULL,
  director varchar(255) default NULL,
  accountant varchar(255) default NULL,
  KEY orders_id(orders_id)
);

DROP TABLE IF EXISTS persons;
CREATE TABLE persons (
  orders_id int(11) NOT NULL default '0',
  name varchar(255) default NULL,
  address varchar(255) default NULL,
  KEY orders_id(orders_id)
);

drop table if exists specials;
create table specials (
  specials_id int(11) not null auto_increment,
  products_id int(11) default '0' not null ,
  specials_new_products_price decimal(15,4) default '0.0000' not null ,
  specials_date_added datetime ,
  specials_last_modified datetime ,
  expires_date datetime ,
  date_status_change datetime ,
  status int(1) default '1' not null ,
  customers_groups_id int(11) default '0' not null ,
  customers_id int(11) default '0' not null ,
  PRIMARY KEY (specials_id),
  KEY idx_specials_products_id (products_id)
);

drop table if exists special_category;
create table special_category (
  special_id int(11) unsigned NOT NULL auto_increment,
  categ_id int(11) unsigned NOT NULL default '0',
  discount decimal(5,2) NOT NULL default '0.00',
  discount_type enum('p','f') NOT NULL default 'f',
  special_date_added datetime NOT NULL default '0000-00-00 00:00:00',
  special_last_modified datetime NOT NULL default '0000-00-00 00:00:00',
  expire_date datetime NOT NULL default '0000-00-00 00:00:00',
  date_status_change datetime NOT NULL default '0000-00-00 00:00:00',
  status tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (special_id)
);

drop table if exists special_product;
create table special_product (
  special_product_id int(11) unsigned NOT NULL auto_increment,
  special_id int(11) unsigned NOT NULL default '0',
  product_id int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (special_product_id)
);

drop table if exists tax_class;
create table tax_class (
  tax_class_id int(11) not null auto_increment,
  tax_class_title varchar(32) not null ,
  tax_class_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (tax_class_id)
);

insert into tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) values ('1', 'Taxable Goods', 'The following types of products are included non-food, services, etc', '2003-07-17 10:29:23', '2003-07-17 10:29:23');
drop table if exists tax_rates;
create table tax_rates (
  tax_rates_id int(11) not null auto_increment,
  tax_zone_id int(11) default '0' not null ,
  tax_class_id int(11) default '0' not null ,
  tax_priority int(5) default '1' ,
  tax_rate decimal(7,4) default '0.0000' not null ,
  tax_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (tax_rates_id)
);

insert into tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) values ('1', '1', '1', '1', '7.0000', 'FL TAX 7.0%', '2003-07-17 10:29:23', '2003-07-17 10:29:23');
drop table if exists template;
create table template (
  template_id int(11) not null auto_increment,
  template_name varchar(64) default '0' ,
  date_added datetime ,
  last_modified datetime ,
  template_image varchar(64) ,
  template_cellpadding_main char(3) default '0' not null ,
  template_cellpadding_sub char(3) default '0' not null ,
  template_cellpadding_left char(3) default '0' not null ,
  template_cellpadding_right char(3) default '0' not null ,
  site_width varchar(5) default '100%' not null ,
  include_column_left varchar(64) default 'yes' not null ,
  include_column_right varchar(64) default 'yes' not null ,
  box_width_left varchar(4) default '125' not null ,
  box_width_right varchar(4) default '125' not null ,
  main_table_border varchar(6) default 'yes' not null ,
  active char(1) default '1' not null ,
  show_heading_title_original varchar(6) default 'yes' not null ,
  languages_in_header char(3) default 'no' ,
  cart_in_header char(3) default 'no' not null ,
  show_header_link_buttons char(3) default 'no' not null ,
  module_one varchar(64) not null ,
  module_two varchar(64) not null ,
  module_three varchar(64) not null ,
  module_four varchar(64) not null ,
  module_five varchar(64) not null ,
  module_six varchar(64) not null ,
  customer_greeting char(3) default 'yes' not null ,
  edit_customer_greeting_personal text ,
  edit_customer_greeting_personal_relogon text ,
  edit_greeting_guest text ,
  side_box_left_width int(10) default '1' ,
  side_box_right_width int(10) default '1' ,
  PRIMARY KEY (template_id),
  KEY IDX_TEMPLATE_NAME (template_name)
);

insert into template (template_id, template_name, date_added, last_modified, template_image, template_cellpadding_main, template_cellpadding_sub, template_cellpadding_left, template_cellpadding_right, site_width, include_column_left, include_column_right, box_width_left, box_width_right, main_table_border, active, show_heading_title_original, languages_in_header, cart_in_header, show_header_link_buttons, module_one, module_two, module_three, module_four, module_five, module_six, customer_greeting, edit_customer_greeting_personal, edit_customer_greeting_personal_relogon, edit_greeting_guest, side_box_left_width, side_box_right_width) values ('16', 'Helius', '2004-01-01 10:55:55', '2006-04-21 20:47:43', 'helius.gif', '2', '8', '3', '3', '100%', 'yes', 'yes', '150', '150', 'yes', '1', 'yes', '', '', 'yes', 'mainpage.php', 'featured.php', 'new_products.php', 'newsdesk.php', 'browse_categories.php', 'upcoming_products.php', 'yes', '', '', '', '8', '12');
insert into template (template_id, template_name, date_added, last_modified, template_image, template_cellpadding_main, template_cellpadding_sub, template_cellpadding_left, template_cellpadding_right, site_width, include_column_left, include_column_right, box_width_left, box_width_right, main_table_border, active, show_heading_title_original, languages_in_header, cart_in_header, show_header_link_buttons, module_one, module_two, module_three, module_four, module_five, module_six, customer_greeting, edit_customer_greeting_personal, edit_customer_greeting_personal_relogon, edit_greeting_guest, side_box_left_width, side_box_right_width) values ('17', 'Helius-Original', '2004-01-01 10:55:55', '2006-04-21 20:47:36', 'helius-original.gif', '2', '8', '3', '3', '100%', 'yes', 'yes', '150', '150', 'yes', '1', 'yes', '', '', 'yes', 'mainpage.php', 'featured.php', 'new_products.php', 'newsdesk.php', 'browse_categories.php', 'upcoming_products.php', 'yes', '', '', '', '8', '12');
insert into template (template_id, template_name, date_added, last_modified, template_image, template_cellpadding_main, template_cellpadding_sub, template_cellpadding_left, template_cellpadding_right, site_width, include_column_left, include_column_right, box_width_left, box_width_right, main_table_border, active, show_heading_title_original, languages_in_header, cart_in_header, show_header_link_buttons, module_one, module_two, module_three, module_four, module_five, module_six, customer_greeting, edit_customer_greeting_personal, edit_customer_greeting_personal_relogon, edit_greeting_guest, side_box_left_width, side_box_right_width) values ('3', 'Original', '2004-01-01 10:55:55', '2006-04-21 20:47:29', 'original.gif', '2', '8', '3', '3', '100%', 'yes', 'yes', '150', '150', 'no', '1', 'yes', '', '', 'yes', 'mainpage.php', 'featured.php', 'new_products.php', 'newsdesk.php', 'browse_categories.php', 'upcoming_products.php', 'yes', '', '', '', '8', '12');
insert into template (template_id, template_name, date_added, last_modified, template_image, template_cellpadding_main, template_cellpadding_sub, template_cellpadding_left, template_cellpadding_right, site_width, include_column_left, include_column_right, box_width_left, box_width_right, main_table_border, active, show_heading_title_original, languages_in_header, cart_in_header, show_header_link_buttons, module_one, module_two, module_three, module_four, module_five, module_six, customer_greeting, edit_customer_greeting_personal, edit_customer_greeting_personal_relogon, edit_greeting_guest, side_box_left_width, side_box_right_width) values ('1', 'vam', '2004-01-01 10:55:55', '2006-04-21 20:47:43', 'helius.gif', '2', '8', '3', '3', '100%', 'yes', 'yes', '150', '150', 'yes', '1', 'yes', '', '', 'yes', 'mainpage.php', 'featured.php', 'new_products.php', 'newsdesk.php', 'browse_categories.php', 'upcoming_products.php', 'yes', '', '', '', '8', '12');

drop table if exists textual;
create table textual (
  name varchar(10) not null ,
  val text ,
  PRIMARY KEY (name)
);

drop table if exists topics;
create table topics (
  topics_id int(11) not null auto_increment,
  topics_image varchar(64) ,
  parent_id int(11) default '0' not null ,
  sort_order int(3) ,
  date_added datetime ,
  last_modified datetime ,
  PRIMARY KEY (topics_id),
  KEY idx_topics_parent_id (parent_id)
);

insert into topics (topics_id, topics_image, parent_id, sort_order, date_added, last_modified) values ('2', NULL, '0', '0', '2005-06-22 17:54:37', NULL);
drop table if exists topics_description;
create table topics_description (
  topics_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  topics_name varchar(32) not null ,
  topics_heading_title varchar(64) ,
  topics_description text ,
  PRIMARY KEY (topics_id, language_id),
  KEY idx_topics_name (topics_name)
);

insert into topics_description (topics_id, language_id, topics_name, topics_heading_title, topics_description) values ('2', '1', '����', '', '');
insert into topics_description (topics_id, language_id, topics_name, topics_heading_title, topics_description) values ('2', '2', 'Test', '', '');
drop table if exists whos_online;
create table whos_online (
  customer_id int(11) ,
  full_name varchar(64) not null ,
  session_id varchar(128) not null ,
  ip_address varchar(15) not null ,
  time_entry varchar(14) not null ,
  time_last_click varchar(14) not null ,
  last_page_url varchar(255) not null 
);

drop table if exists zones;
create table zones (
  zone_id int(11) not null auto_increment,
  zone_country_id int(11) default '0' not null ,
  zone_code varchar(255) not null ,
  zone_name varchar(255) not null ,
  PRIMARY KEY (zone_id),
  KEY idx_zones_country_id (zone_country_id)
);

insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('298', '109', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('299', '109', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('300', '109', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('301', '109', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('302', '109', '��������-������������� �������', '��������-������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('303', '109', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('304', '109', '�������-������������� �������', '�������-������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('305', '109', '�������������� �������', '�������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('306', '109', '������������� �������', '������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('307', '109', '������������ �������', '������������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('308', '109', '������������� �������', '������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('309', '109', '������������ �������', '������������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('310', '109', '������-������������� �������', '������-������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('311', '109', '����-������������� �������', '����-������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('312', '115', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('313', '115', '������-�������� �������', '������-�������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('314', '115', '�����-�������� �������', '�����-�������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('315', '115', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('316', '115', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('317', '115', '������ �������', '������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('318', '115', '������� �������', '������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('184', '176', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('185', '176', '��������', '��������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('186', '176', '�������', '�������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('187', '176', '������ �����', '������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('188', '176', '��������', '��������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('189', '176', '���������', '���������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('190', '176', '���������-��������', '���������-��������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('191', '176', '��������', '��������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('192', '176', '���������-��������', '���������-��������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('193', '176', '�������', '�������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('194', '176', '����', '����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('195', '176', '��������� ����������', '��������� ����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('196', '176', '���������� ����������', '���������� ����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('197', '176', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('198', '176', '�������� ������', '�������� ������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('199', '176', '���������', '���������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('200', '176', '����', '����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('201', '176', '��������', '��������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('202', '176', '�������', '�������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('203', '176', '�����', '�����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('204', '176', '�������', '�������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('205', '176', '��������� ����', '��������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('206', '176', '������������� ����', '������������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('207', '176', '������������ ����', '������������ ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('208', '176', '���������� ����', '���������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('209', '176', '�������������� ����', '�������������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('210', '176', '����������� ����', '����������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('211', '176', '�������� �������', '�������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('212', '176', '������������� �������', '������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('213', '176', '������������ �������', '������������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('214', '176', '������������ �������', '������������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('215', '176', '�������� �������', '�������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('216', '176', '������������ �������', '������������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('217', '176', '������������� �������', '������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('218', '176', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('219', '176', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('220', '176', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('221', '176', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('222', '176', '��������������� �������', '��������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('223', '176', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('224', '176', '���������� ����', '���������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('225', '176', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('226', '176', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('227', '176', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('228', '176', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('229', '176', '������� �������', '������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('230', '176', '������������� �������', '������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('231', '176', '�������� �������', '�������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('232', '176', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('233', '176', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('234', '176', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('235', '176', '������������� �������', '������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('236', '176', '������������ �������', '������������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('237', '176', '������������� �������', '������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('238', '176', '������ �������', '������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('239', '176', '������������ �������', '������������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('240', '176', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('241', '176', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('242', '176', '�������� ����', '�������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('243', '176', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('244', '176', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('245', '176', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('246', '176', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('247', '176', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('248', '176', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('249', '176', '������������ �������', '������������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('250', '176', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('251', '176', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('252', '176', '�������� �������', '�������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('253', '176', '������� �������', '������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('254', '176', '�������� �������', '�������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('255', '176', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('256', '176', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('257', '176', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('258', '176', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('259', '176', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('260', '176', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('261', '176', '�����-���������', '�����-���������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('262', '176', '��������� ���������� �������', '��������� ���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('263', '176', '�������� ��������� ��', '�������� ��������� ��');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('266', '176', '�������� ��', '�������� ��');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('267', '176', '���������� ��', '���������� ��');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('268', '176', '����-��������� ��������� ��', '����-��������� ��������� ��');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('269', '176', '�����-���������� ��', '�����-���������� ��');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('270', '176', '��������� ��', '��������� ��');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('271', '176', '����������� ��', '����������� ��');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('272', '176', '�����-�������� ��', '�����-�������� ��');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('319', '207', '�������-���������-���������', '�������-���������-���������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('320', '207', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('321', '207', '������������� �������', '������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('322', '216', '����', '����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('323', '216', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('324', '216', '��������', '��������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('325', '216', '�����', '�����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('326', '216', '����', '����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('273', '220', '���������� ����', '���������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('274', '220', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('275', '220', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('276', '220', '���������������� �������', '���������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('277', '220', '�������� �������', '�������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('278', '220', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('279', '220', '������������ �������', '������������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('280', '220', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('281', '220', '�����-����������� �������', '�����-����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('282', '220', '�������� �������', '�������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('283', '220', '�������������� �������', '�������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('284', '220', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('285', '220', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('286', '220', '������������ �������', '������������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('287', '220', '�������� �������', '�������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('288', '220', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('289', '220', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('290', '220', '������� �������', '������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('291', '220', '������������� �������', '������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('292', '220', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('293', '220', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('294', '220', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('295', '220', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('296', '220', '������������ �������', '������������ �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('297', '220', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('327', '226', '�����������', '�����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('328', '226', '���������', '���������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('329', '226', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('330', '226', '������������', '������������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('331', '226', '���������������', '���������������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('332', '226', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('333', '226', '������������', '������������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('334', '226', '�������������', '�������������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('335', '226', '����������������', '����������������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('336', '226', '�������������', '�������������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('337', '226', '�����������', '�����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('338', '226', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('339', '226', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('340', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('341', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('342', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('343', '15', '�������������� �����', '�������������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('344', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('345', '15', '���������� �����', '���������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('346', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('347', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('348', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('349', '15', '���������� �����', '���������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('350', '15', '������������� �����', '������������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('351', '15', '������������� �����', '������������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('352', '15', '�������������� �����', '�������������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('353', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('354', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('355', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('356', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('357', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('358', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('359', '15', '��������������� �����', '��������������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('360', '15', '���������� �����', '���������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('361', '15', '���������� �����', '���������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('362', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('363', '15', '������������� �����', '������������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('364', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('365', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('366', '15', '������������� �����', '������������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('367', '15', '�������������� �����', '�������������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('368', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('369', '15', '������� �����', '������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('370', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('371', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('372', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('373', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('374', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('375', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('376', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('377', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('378', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('379', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('380', '15', '������������� �����', '������������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('381', '15', '�������� �����', '�������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('382', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('383', '15', '������������� �����', '������������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('384', '15', '���������� �����', '���������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('385', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('386', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('387', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('388', '15', '���������� �����', '���������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('389', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('390', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('391', '15', '���������� �����', '���������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('392', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('393', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('394', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('395', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('396', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('397', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('398', '15', '���������� �����', '���������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('399', '15', '������������� ���������� ����������', '������������� ���������� ����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('400', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('401', '15', '������������ �����', '������������ �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('402', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('403', '15', '����������� �����', '����������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('404', '15', '���������� �����', '���������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('405', '15', '��������� �����', '��������� �����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('406', '67', '��������� ����', '��������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('407', '67', '����������� ����', '����������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('408', '67', '���-����������� ����', '���-����������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('409', '67', '�������������� ����', '�������������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('410', '67', '������������� ����', '������������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('411', '67', '������������ ����', '������������ ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('412', '67', '�����-����������� ����', '�����-����������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('413', '67', '������������ ����', '������������ ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('414', '67', '������������ ����', '������������ ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('415', '67', '������������ ����', '������������ ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('416', '67', '������������ ����', '������������ ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('417', '67', '������������ ����', '������������ ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('418', '67', '������������ ����', '������������ ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('419', '67', '��������������� ����', '��������������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('420', '67', '����������� ����', '����������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('421', '20', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('422', '20', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('423', '20', '������� �������', '������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('424', '20', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('425', '20', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('426', '20', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('427', '11', '������� ���������', '������� ���������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('428', '11', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('429', '11', '����������� �������', '����������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('430', '11', '�������������� �������', '�������������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('431', '11', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('432', '11', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('433', '11', '���������� �������', '���������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('434', '11', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('435', '11', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('436', '11', '������� ����� ����', '������� ����� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('437', '11', '��������� �������', '��������� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('438', '80', '�����', '�����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('439', '80', '�������', '�������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('440', '80', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('441', '80', '�����-������', '�����-������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('442', '80', '������-�������', '������-�������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('443', '80', '����-������� - ����� �������', '����-������� - ����� �������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('444', '80', '��������� - ����-�������', '��������� - ����-�������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('445', '80', '������-���������', '������-���������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('446', '80', '�������', '�������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('447', '80', '���� - ������', '���� - ������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('448', '80', '��������� ���������� ����������', '��������� ���������� ����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('449', '80', '��������� ���������� ����������', '��������� ���������� ����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('450', '80', '���������� ����� ������', '���������� ����� ������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('451', '140', '�����', '�����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('452', '140', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('453', '140', '�����', '�����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('454', '140', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('455', '140', '�������', '�������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('456', '140', '�����', '�����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('457', '140', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('458', '140', '��������', '��������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('459', '140', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('460', '140', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('461', '123', '���������� ����', '���������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('462', '123', '���������� ����', '���������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('463', '123', 'K���������� ����', 'K���������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('464', '123', 'Ma������������ ����', 'Ma������������ ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('465', '123', '����������� ����', '����������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('466', '123', '���������� ����', '���������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('467', '123', '���������� ����', '���������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('468', '123', 'T���������� ����', 'T���������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('469', '123', '�������� ����', '�������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('470', '123', '����������� ����', '����������� ����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('471', '117', '�������������', '�������������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('472', '117', '������������', '������������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('473', '117', '��������', '��������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('474', '117', '���������', '���������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('475', '117', '���������', '���������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('476', '117', '�����������', '�����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('477', '117', '�������������', '�������������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('478', '117', '�����������', '�����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('479', '117', '��������������', '��������������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('480', '117', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('481', '117', '������������', '������������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('482', '117', '���������', '���������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('483', '117', '�����������', '�����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('484', '117', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('485', '117', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('486', '117', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('487', '117', '��������', '��������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('488', '117', '���������', '���������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('489', '117', '��������', '��������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('490', '117', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('491', '117', '�����������', '�����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('492', '117', '�������', '�������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('493', '117', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('494', '117', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('495', '117', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('496', '117', '��������', '��������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('497', '117', '���������', '���������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('498', '117', '����������', '����������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('499', '117', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('500', '117', '������', '������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('501', '117', '�������', '�������');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('502', '117', '����', '����');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('503', '117', '������', '������');
drop table if exists zones_to_geo_zones;
create table zones_to_geo_zones (
  association_id int(11) not null auto_increment,
  zone_country_id int(11) default '0' not null ,
  zone_id int(11) ,
  geo_zone_id int(11) ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (association_id),
  KEY idx_zones_to_geo_zones_country_id (zone_country_id)
);

insert into zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) values ('1', '223', '18', '1', NULL, '2003-07-17 10:29:23');

##
## Table structure for table `specification_groups_to_categories`
##   This table links the specification_groups table
##   to the categories table. It allows multiple categories 
##   to have the same specification set
##
DROP TABLE IF EXISTS `specification_groups_to_categories`;
CREATE TABLE IF NOT EXISTS `specification_groups_to_categories` (
  `specification_group_id` int(11) NOT NULL DEFAULT '0',
  `categories_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`specification_group_id`,`categories_id`)
);


##
## Table structure for table `specification_groups`
##   This table relates to the store Categories through
##   the specifications_to_categories table
##
DROP TABLE IF EXISTS `specification_groups`;
CREATE TABLE IF NOT EXISTS `specification_groups` (
  `specification_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `specification_group_name` varchar(64) NOT NULL,
  `show_comparison` set('True','False') NOT NULL DEFAULT 'True',
  `show_products` set('True','False') NOT NULL DEFAULT 'True',
  `show_filter` set('True','False') NOT NULL DEFAULT 'True',
  PRIMARY KEY (`specification_group_id`)
);

##
## Table structure for table `specifications`
##
##
DROP TABLE IF EXISTS `specifications`;
CREATE TABLE IF NOT EXISTS `specifications` (
  `specifications_id` int(11) NOT NULL AUTO_INCREMENT,
  `specification_group_id` int(11) NOT NULL DEFAULT '0',
  `specification_sort_order` int(11) NOT NULL DEFAULT '0',
  `show_comparison` set('True','False') NOT NULL DEFAULT 'True',
  `show_products` set('True','False') NOT NULL DEFAULT 'True',
  `show_filter` set('True','False') NOT NULL DEFAULT 'True',
  `products_column_name` varchar(32) NOT NULL,
  `column_justify` set('Left','Center','Right') NOT NULL DEFAULT 'Left',
  `filter_class` set('none','exact','multiple','range','reverse','start','partial','like') NOT NULL DEFAULT 'none',
  `filter_display` set('pulldown','multi','checkbox','radio','links','text','image','multiimage') NOT NULL DEFAULT 'pulldown',
  `filter_show_all` set('True','False') NOT NULL DEFAULT 'True',
  `enter_values` set('pulldown','multi','checkbox','radio','links','text','image','multiimage') NOT NULL DEFAULT 'text',
  PRIMARY KEY (`specifications_id`),
  KEY `specification_group_id` (`specification_group_id`)
);


##
## Table structure for table `specification_description`
##   This table defines the Specification(s) for a given Specification Group
##   There can be multiple Specifications for each Group
##   All products in a Group use the same specification set
##
DROP TABLE IF EXISTS `specification_description`;
CREATE TABLE IF NOT EXISTS `specification_description` (
  `specification_description_id` int(11) NOT NULL AUTO_INCREMENT,
  `specifications_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `specification_name` varchar(32) NOT NULL DEFAULT '',
  `specification_description` varchar(128) NOT NULL,
  `specification_prefix` varchar(128) NOT NULL DEFAULT '',
  `specification_suffix` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`specification_description_id`,`language_id`),
  KEY `specifications_id` (`specifications_id`)
);


##
## Table structure for table `specification_filters`
##   This table sets up filters that can be used to search for products
##
DROP TABLE IF EXISTS `specification_filters`;
CREATE TABLE IF NOT EXISTS `specification_filters` (
  `specification_filters_id` int(11) NOT NULL AUTO_INCREMENT,
  `specifications_id` int(11) NOT NULL DEFAULT '0',
  `filter_sort_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`specification_filters_id`),
  KEY `specifications_id` (`specifications_id`)
);


##
## Table structure for table `specification_filters_description`
##   This table sets up filters that can be used to search for products
##
DROP TABLE IF EXISTS `specification_filters_description`;
CREATE TABLE IF NOT EXISTS `specification_filters_description` (
  `specification_filters_description_id` int(11) NOT NULL AUTO_INCREMENT,
  `specification_filters_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `filter` varchar(128) NOT NULL,
  PRIMARY KEY (`specification_filters_description_id`),
  KEY `language_id` (`language_id`),
  KEY `specification_filters_id` (`specification_filters_id`)
);


##
## Table structure for table `specification_values`
##   Sets up the values that can be used in product specifications
##
DROP TABLE IF EXISTS `specification_values`;
CREATE TABLE IF NOT EXISTS `specification_values` (
  `specification_values_id` int(11) NOT NULL AUTO_INCREMENT,
  `specifications_id` int(11) NOT NULL DEFAULT '0',
  `value_sort_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`specification_values_id`),
  KEY `specifications_id` (`specifications_id`)
);


##
## Table structure for table `specification_values_description`
##   Sets up the values that can be used in product specifications
##
DROP TABLE IF EXISTS `specification_values_description`;
CREATE TABLE IF NOT EXISTS `specification_values_description` (
  `specification_values_description_id` int(11) NOT NULL AUTO_INCREMENT,
  `specification_values_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `specification_value` varchar(128) NOT NULL,
  PRIMARY KEY (`specification_values_description_id`),
  KEY `specification_values_id` (`specification_values_id`),
  KEY `language_id` (`language_id`)
);


##
## Table structure for table `products_specifications`
##   This table contains the specification data for each Product
##
DROP TABLE IF EXISTS `products_specifications`;
CREATE TABLE IF NOT EXISTS `products_specifications` (
  `products_specification_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL DEFAULT '0',
  `specifications_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `specification` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`products_specification_id`),
  KEY `products_id` (`products_id`,`specifications_id`,`language_id`)
);

INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES
('<b>Products Info Page</b>', 'SPECIFICATIONS_PRODUCTS_HEAD', 'Subhead', 'Products Info page', 1610, 1, '2009-08-25 10:03:37', '2009-06-18 12:07:30', NULL, 'tep_cfg_select_option(array(''Subhead''), '),
('Minimum Spec Products', 'SPECIFICATIONS_MINIMUM_PRODUCTS', '1', 'The minimum number of specifications needed to have the Specifications box show up on the Product Info page', 1610, 5, '2009-06-18 12:07:30', '2009-06-18 12:07:30', NULL, NULL),
('Show Specification Name', 'SPECIFICATIONS_SHOW_NAME_PRODUCTS', 'False', 'Show the name of the specification in the box', 1610, 10, '2009-06-18 12:07:30', '2009-06-18 12:07:30', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
('Show Spec Box Title', 'SPECIFICATIONS_SHOW_TITLE_PRODUCTS', 'True', 'Show the title above the Specifications box', 1610, 15, '2009-06-18 12:07:30', '2009-06-18 12:07:30', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
('Spec Box Frame Style', 'SPECIFICATIONS_BOX_FRAME_STYLE', 'Plain', 'Show the Specifications in a standard box (Stock), a simple outline box (Simple), no box (Plain), or a tabbed content box (Tabs)', 1610, 20, '2009-08-13 21:28:59', '2009-06-18 12:07:30', NULL, 'tep_cfg_select_option(array(''Stock'', ''Simple'', ''Plain'',''Tabs''), '),
('Show Reviews Tab', 'SPECIFICATIONS_REVIEWS_TAB', 'True', 'Show the Reviews tab', 1610, 21, '2009-06-18 12:07:30', '2009-09-09 12:07:30', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
('Max Reviews in Tab', 'SPECIFICATIONS_MAX_REVIEWS', '3', 'The maxmum number of reviews that can show in the Reviews tab', 1610, 22, '2009-09-09 12:07:30', '2009-06-18 12:07:30', NULL, NULL),
('Show Question Tab', 'SPECIFICATIONS_QUESTION_TAB', 'True', 'Show the Ask a Question tab', 1610, 23, '2009-06-18 12:07:30', '2009-09-09 12:07:30', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),

('<b>Products Comparison Page</b>', 'SPECIFICATIONS_COMPARISON_HEAD', 'Subhead', 'Products Comparison page', 1610, 24, '2009-08-25 10:03:37', '2009-06-18 12:07:30', NULL, 'tep_cfg_select_option(array(''Subhead''), '),
('Minimum Spec Comparison', 'SPECIFICATIONS_MINIMUM_COMPARISON', '2', 'The minimum number of products having specifications needed to have the Comparison page show up for a Category', 1610, 25, '2009-07-19 19:52:33', '2009-06-18 12:07:30', NULL, NULL),
('Comparison Link in Index', 'SPECIFICATIONS_COMP_LINK', 'True', 'Show a link to the Comparison table on the Index page ', 1610, 30, '0000-00-00 00:00:00', '2009-06-26 12:07:30', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
('Comparison Row in Table', 'SPECIFICATIONS_COMP_TABLE_ROW', 'both', 'Show a link to the Comparison in the Products list on the Index page ', 1610, 35, '2009-06-26 18:24:00', '2009-06-26 12:07:30', NULL, 'tep_cfg_select_option(array(''top'', ''bottom'', ''both'', ''none''), '),
('Show Comparison', 'SPECIFICATIONS_BOX_COMPARISON', 'True', 'Show the Comparison table in a separate page', 1610, 40, '2009-06-18 12:07:30', '2009-06-18 12:07:30', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
('Comparison in Index', 'SPECIFICATIONS_BOX_COMP_INDEX', 'False', 'Show the Comparison table instead of the Products list in the Index page ', 1610, 45, '2009-06-18 12:07:30', '2009-06-18 12:07:30', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
('Comparison Suffix in Header', 'SPECIFICATIONS_COMP_SUFFIX', 'True', 'Show the Suffix in the Comparison table header (Otherwise in each field)', 1610, 50, '2009-07-18 22:11:04', '2009-06-18 12:07:30', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
('Comparison Box Style', 'SPECIFICATIONS_COMPARISON_STYLE', 'Simple', 'Show the Specifications in a standard box (Stock), a simple outline box (Simple), or no box (Plain)', 1610, 52, '2009-07-18 22:11:04', '2009-06-18 12:07:30', NULL, 'tep_cfg_select_option(array(''Stock'', ''Simple'', ''Plain''), '),
('Spec Combo Manufacturer', 'SPECIFICATIONS_COMBO_MFR', '0', 'Show the Manufacturer in a special combo box (0 = No, 1-9 = Sort Order)', 1610, 55, '2009-06-18 12:07:30', '2009-06-18 12:07:30', NULL, NULL),
('Spec Combo Weight', 'SPECIFICATIONS_COMBO_WEIGHT', '0', 'Show the Weight in a special combo box (0 = No, 1-9 = Sort Order)', 1610, 60, '2009-06-18 12:07:30', '2009-06-18 12:07:30', NULL, NULL),
('Spec Combo Price', 'SPECIFICATIONS_COMBO_PRICE', '0', 'Show the Price in a special combo box (0 = No, 1-9 = Sort Order)', 1610, 65, '2009-06-18 12:07:30', '2009-06-18 12:07:30', NULL, NULL),
('Spec Combo Model', 'SPECIFICATIONS_COMBO_MODEL', '2', 'Show the Model number in a special combo box (0 = No, 1-9 = Sort Order)', 1610, 70, '2009-06-18 15:31:23', '2009-06-18 12:07:30', NULL, NULL),
('Spec Combo Image', 'SPECIFICATIONS_COMBO_IMAGE', '1', 'Show the Image in a special combo box (0 = No, 1-9 = Sort Order)', 1610, 75, '2009-06-18 15:31:10', '2009-06-18 12:07:30', NULL, NULL),
('Spec Combo Name', 'SPECIFICATIONS_COMBO_NAME', '0', 'Show the Name in a special combo box (0 = No, 1-9 = Sort Order)', 1610, 80, '2009-06-18 12:07:30', '2009-06-18 12:07:30', NULL, NULL),
('Spec Combo Buy Now', 'SPECIFICATIONS_COMBO_BUY_NOW', '0', 'Show the Buy Now in a special combo box (0 = No, 1-9 = Sort Order)', 1610, 85, '2009-06-18 12:07:30', '2009-06-18 12:07:30', NULL, NULL),

('<b>Products Filters</b>', 'SPECIFICATIONS_FILTERS_HEAD', 'Subhead', 'Products Filters', 1610, 89, '2009-08-25 10:03:37', '2009-06-18 12:07:30', NULL, 'tep_cfg_select_option(array(''Subhead''), '),
('Show Filters Module', 'SPECIFICATIONS_FILTERS_MODULE', 'True', 'Show the Filters module in the center column (main part of the page)', 1610, 90, NULL, '2009-09-09 09:09:09', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
('Show Filters Box', 'SPECIFICATIONS_FILTERS_BOX', 'True', 'Show the Filters box in the side column', 1610, 95, NULL, '2009-07-06 00:19:30', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
('Minimum Spec Filter', 'SPECIFICATIONS_FILTER_MINIMUM', '2', 'The minimum number of filters needed to have the Filters box show up in the column', 1610, 100, '2009-06-18 12:07:30', '2009-06-18 12:07:30', NULL, NULL),
('Filter Subcategories', 'SPECIFICATIONS_FILTER_SUBCATEGORIES', 'True', 'Include subcategories in the filter results', 1610, 105, '2009-08-12 15:16:55', '2009-06-18 12:07:30', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
('Filter Show Count', 'SPECIFICATIONS_FILTER_SHOW_COUNT', 'True', 'Show the number of products that the filter would return', 1610, 110, '2009-09-21 00:00:00', '2009-09-21 00:00:00', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
('Filter No Result', 'SPECIFICATIONS_FILTER_NO_RESULT', 'grey', 'What to show for a filter that would return no result.', 1610, 115, '2009-08-23 22:00:43', '2009-07-15 19:15:14', NULL, 'tep_cfg_select_option(array(''none'', ''grey'', ''normal''), '),
('Filter Show Breadcrumb', 'SPECIFICATIONS_FILTER_BREADCRUMB', 'True', 'Show currently applied filters in the Breadcrumb trail with option to remove', 1610, 120, '2009-07-15 19:15:07', '2009-07-15 19:15:14', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
('Filter Image Width', 'SPECIFICATIONS_FILTER_IMAGE_WIDTH', '20', 'Set the width of the images displayed as filters in the filter box.', 1610, 125, '2009-07-15 18:46:21', '2009-07-15 18:46:30', NULL, NULL),
('Filter Image Height', 'SPECIFICATIONS_FILTER_IMAGE_HEIGHT', '20', 'Set the height of the images displayed as filters in the filter box.', 1610, 130, '2009-07-15 18:46:37', '2009-07-15 18:46:45', NULL, NULL);
