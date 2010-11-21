# osCommerce, Open Source E-Commerce Solutions
# http://www.oscommerce.com
#
# Database Backup For Название магазина
# Copyright (c) 2007 Владелец магазина
#
# Database: sborka-sts
# Database Server: localhost
#
# Backup Date: 03/06/2007 14:44:21

drop table if exists address_book;
create table address_book (
  address_book_id int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  entry_gender char(1) not null ,
  entry_company varchar(255) ,
  entry_firstname varchar(255) not null ,
  entry_lastname varchar(255) not null ,
  entry_street_address varchar(64) not null ,
  entry_suburb varchar(255) ,
  entry_postcode varchar(10) not null ,
  entry_city varchar(255) not null ,
  entry_state varchar(255) ,
  entry_country_id int(11) default '0' not null ,
  entry_zone_id int(11) default '0' not null ,
  PRIMARY KEY (address_book_id),
  KEY idx_address_book_customers_id (customers_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists address_format;
create table address_format (
  address_format_id int(11) not null auto_increment,
  address_format varchar(128) not null ,
  address_summary varchar(48) not null ,
  PRIMARY KEY (address_format_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into address_format (address_format_id, address_format, address_summary) values ('1', '$firstname $lastname$cr$city$cr$streets, $postcode$cr$statecomma$country', '$city / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('2', '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country', '$city, $state / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('3', '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country', '$state / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('4', '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('5', '$firstname $lastname$cr$streets$cr$postcode $city$cr$country', '$city / $country');
drop table if exists admin;
create table admin (
  admin_id int(11) not null auto_increment,
  admin_groups_id int(11) ,
  admin_firstname varchar(255) not null ,
  admin_lastname varchar(255) ,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into admin (admin_id, admin_groups_id, admin_firstname, admin_lastname, admin_email_address, admin_password, admin_created, admin_modified, admin_logdate, admin_lognum, admin_cat_access, admin_right_access) values ('1', '1', 'Default', 'Admin', 'admin@localhost.com', '1060bdf4e47bc8b4ab3fb0cfea9ef70b:77', '2003-07-17 11:35:03', '2004-03-20 18:07:39', '2007-06-03 14:43:24', '486', 'ALL', '');
drop table if exists admin_files;
create table admin_files (
  admin_files_id int(11) not null auto_increment,
  admin_files_name varchar(64) not null ,
  admin_files_is_boxes tinyint(5) default '0' not null ,
  admin_files_to_boxes int(11) default '0' not null ,
  admin_groups_id set('1','2') default '1' not null ,
  PRIMARY KEY (admin_files_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('187', 'email_queue.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('188', 'email_batch_send.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('189', 'yml_import.php', '0', '9', '1');

drop table if exists admin_groups;
create table admin_groups (
  admin_groups_id int(11) not null auto_increment,
  admin_groups_name varchar(64) ,
  PRIMARY KEY (admin_groups_id),
  UNIQUE admin_groups_name (admin_groups_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into admin_groups (admin_groups_id, admin_groups_name) values ('1', 'Администраторы');
insert into admin_groups (admin_groups_id, admin_groups_name) values ('2', 'Менеджеры');
drop table if exists affiliate_affiliate;
create table affiliate_affiliate (
  affiliate_id int(11) not null auto_increment,
  affiliate_gender char(1) not null ,
  affiliate_firstname varchar(255) not null ,
  affiliate_lastname varchar(255) not null ,
  affiliate_dob datetime default '0000-00-00 00:00:00' not null ,
  affiliate_email_address varchar(96) not null ,
  affiliate_telephone varchar(255) not null ,
  affiliate_fax varchar(255) not null ,
  affiliate_password varchar(40) not null ,
  affiliate_homepage varchar(96) not null ,
  affiliate_street_address varchar(64) not null ,
  affiliate_suburb varchar(64) not null ,
  affiliate_city varchar(255) not null ,
  affiliate_postcode varchar(10) not null ,
  affiliate_state varchar(255) not null ,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists affiliate_news;
create table affiliate_news (
  news_id int(11) not null auto_increment,
  headline varchar(255) not null ,
  content text ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  STATUS tinyint(1) default '0' not null ,
  PRIMARY KEY (news_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
  affiliate_firstname varchar(255) not null ,
  affiliate_lastname varchar(255) not null ,
  affiliate_street_address varchar(64) not null ,
  affiliate_suburb varchar(64) not null ,
  affiliate_city varchar(255) not null ,
  affiliate_postcode varchar(10) not null ,
  affiliate_country varchar(255) default '0' not null ,
  affiliate_company varchar(60) not null ,
  affiliate_state varchar(255) default '0' not null ,
  affiliate_address_format_id int(5) default '0' not null ,
  affiliate_last_modified datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (affiliate_payment_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists affiliate_payment_status;
create table affiliate_payment_status (
  affiliate_payment_status_id int(11) default '0' not null ,
  affiliate_language_id int(11) default '1' not null ,
  affiliate_payment_status_name varchar(255) not null ,
  PRIMARY KEY (affiliate_payment_status_id, affiliate_language_id),
  KEY idx_affiliate_payment_status_name (affiliate_payment_status_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into affiliate_payment_status (affiliate_payment_status_id, affiliate_language_id, affiliate_payment_status_name) values ('0', '1', 'Проверяется');
insert into affiliate_payment_status (affiliate_payment_status_id, affiliate_language_id, affiliate_payment_status_name) values ('1', '1', 'Оплачен');
drop table if exists affiliate_payment_status_history;
create table affiliate_payment_status_history (
  affiliate_status_history_id int(11) not null auto_increment,
  affiliate_payment_id int(11) default '0' not null ,
  affiliate_new_value int(5) default '0' not null ,
  affiliate_old_value int(5) ,
  affiliate_date_added datetime default '0000-00-00 00:00:00' not null ,
  affiliate_notified int(1) default '0' ,
  PRIMARY KEY (affiliate_status_history_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists article_reviews_description;
create table article_reviews_description (
  reviews_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  reviews_text text ,
  PRIMARY KEY (reviews_id, languages_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into articles_description (articles_id, language_id, articles_name, articles_description, articles_url, articles_viewed, articles_head_title_tag, articles_head_desc_tag, articles_head_keywords_tag) values ('2', '1', 'Тест статья', '', '', '0', '', 'Текст', '');
insert into articles_description (articles_id, language_id, articles_name, articles_description, articles_url, articles_viewed, articles_head_title_tag, articles_head_desc_tag, articles_head_keywords_tag) values ('2', '2', 'Sample article', '', '', '0', '', 'Text', '');
drop table if exists articles_to_topics;
create table articles_to_topics (
  articles_id int(11) default '0' not null ,
  topics_id int(11) default '0' not null ,
  PRIMARY KEY (articles_id, topics_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into articles_to_topics (articles_id, topics_id) values ('2', '2');
drop table if exists articles_xsell;
create table articles_xsell (
  ID int(10) not null auto_increment,
  articles_id int(10) unsigned default '1' not null ,
  xsell_id int(10) unsigned default '1' not null ,
  sort_order int(10) unsigned default '1' not null ,
  PRIMARY KEY (ID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into articles_xsell (ID, articles_id, xsell_id, sort_order) values ('1', '1', '1', '1');
drop table if exists authors;
create table authors (
  authors_id int(11) not null auto_increment,
  authors_name varchar(255) not null ,
  authors_image varchar(64) ,
  date_added datetime ,
  last_modified datetime ,
  PRIMARY KEY (authors_id),
  KEY IDX_AUTHORS_NAME (authors_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists authors_info;
create table authors_info (
  authors_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  authors_description text ,
  authors_url varchar(255) not null ,
  url_clicked int(5) default '0' not null ,
  date_last_click datetime ,
  PRIMARY KEY (authors_id, languages_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into categories_description (categories_id, language_id, categories_name, categories_heading_title, categories_description, categories_meta_title, categories_meta_description, categories_meta_keywords) values ('28', '1', 'Рога', 'Здесь продаются рога.', 'Рога оленей, лосей и других животных!', '', '', '');
insert into categories_description (categories_id, language_id, categories_name, categories_heading_title, categories_description, categories_meta_title, categories_meta_description, categories_meta_keywords) values ('29', '1', 'Копыта', '', '', '', '', '');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists cip_depend;
create table cip_depend (
  cip_ident varchar(255) not null ,
  cip_ident_req varchar(255) not null ,
  cip_req_type int(2) default '0' not null ,
  PRIMARY KEY (cip_ident)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists configuration;
create table configuration (
  configuration_id int(11) not null auto_increment,
  configuration_title varchar(255) not null ,
  configuration_key varchar(64) not null ,
  configuration_value text ,
  configuration_description varchar(255) not null ,
  configuration_group_id int(11) default '0' not null ,
  sort_order int(5) ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  use_function varchar(255) ,
  set_function varchar(255) ,
  PRIMARY KEY (configuration_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1', 'Название магазина', 'STORE_NAME', 'Название магазина', 'Название Вашего магазина', '1', '1', '2004-08-12 17:03:07', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('2', 'Владелец магазина', 'STORE_OWNER', 'Владелец магазина', 'Имя владельца магазина', '1', '2', '2004-08-12 17:03:14', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('3', 'E-Mail Адрес', 'STORE_OWNER_EMAIL_ADDRESS', 'vam@test.com', 'E-Mail адрес владельца магазина', '1', '3', '2004-08-12 17:03:20', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('4', 'E-Mail От', 'EMAIL_FROM', 'Название магазина <vam@test.com>', 'E-Mail адрес в отправляемых письмах', '1', '4', '2004-08-12 17:03:36', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('5', 'Страна', 'STORE_COUNTRY', '176', 'Страна находения магазина.<br><br><b>Замечание: Не забудьте также указать Зону.</b>', '1', '6', '2004-04-22 17:39:54', '2003-07-17 10:29:22', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('6', 'Зона', 'STORE_ZONE', '260', 'Регион нахождения магазина', '1', '7', '2004-04-22 17:40:00', '2003-07-17 10:29:22', 'tep_cfg_get_zone_name', 'tep_cfg_pull_down_zone_list(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('7', 'Порядок сортировки ожидаемых товаров', 'EXPECTED_PRODUCTS_SORT', 'desc', 'Укажите порядок сортировки для ожидаемых товаров, по возрастанию - asc или по убыванию - desc.', '1', '8', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'asc\', \'desc\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('8', 'Сортировка ожидаемых товаров', 'EXPECTED_PRODUCTS_FIELD', 'date_expected', 'По какому значению будут сортироваться ожидаемые товары.', '1', '9', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'products_name\', \'date_expected\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('9', 'Переключение на валюту текущего языка', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'false', 'Автоматическое переключение цен в магазине на валюту текущего языка.', '1', '10', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('10', 'Отправка копий писем с заказом', 'SEND_EXTRA_ORDER_EMAILS_TO', 'Заказ <vam@test.com>', 'Если Вы хотите получать письма с заказами, т.е. такие же письма, что и получает клиент после оформления заказа, укажите e-mail адрес для получения копий писем в следующем формате: Имя 1 &lt;email@address1&gt;, Имя 2 &lt;email@address2&gt;', '1', '11', '2004-08-12 17:03:47', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('11', 'Использовать короткие URL адреса (находится в разработке)', 'SEARCH_ENGINE_FRIENDLY_URLS', 'false', 'Использовать короткие URL адреса в магазине', '1', '12', '2004-03-20 21:55:41', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('12', 'Переходить в корзину после добавления товара', 'DISPLAY_CART', 'true', 'Переходить в корзину после добавления товара в корзину или оставаться на той же странице.', '1', '14', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('13', 'Разрешить гостям использовать функцию Рассказать другу', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 'false', 'Позволить гостям использовать функцию магазина Рассказать другу, если нет, то данной функцией могут пользоваться только зарегистрированные пользователи магазина.', '1', '15', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('14', 'Оператор поиска по умолчанию', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', 'Укажите, какой оператор будет использоваться по умолчанию при осуществлении посетителем поиска в магазине.', '1', '17', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'and\', \'or\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('15', 'Адрес и телефон магазина', 'STORE_NAME_ADDRESS', 'Адрес магазина', 'Здесь Вы можете указать адрес и телефон магазина', '1', '18', '2004-08-12 17:03:58', '2003-07-17 10:29:22', NULL, 'tep_cfg_textarea(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('16', 'Показывать счётчик товаров', 'SHOW_COUNTS', 'true', 'Показывает количество товара в каждой категории. При большом количестве товара в магазина рекомендуется отключать счётчик - false, чтобы снизить нагрузку на MySQL сервер, тем самых скорость загрузки страницы Вашего магазина увеличится.', '1', '19', '2004-04-24 15:29:10', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('17', 'Количество знаков после запятой у налогов', 'TAX_DECIMAL_PLACES', '0', 'Количество знаков после целого числа у налогов.', '1', '20', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('18', 'Показывать цены с налогами', 'DISPLAY_PRICE_WITH_TAX', 'false', 'Показывать цены в магазине с налогами (true) или показывать налог только на заключительном этапе оформления заказа (false)', '1', '21', '2004-01-05 01:25:38', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('19', 'Имя', 'ENTRY_FIRST_NAME_MIN_LENGTH', '2', 'Минимальное количество символов поля Имя', '2', '1', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('20', 'Фамилия', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', 'Минимальное количество символов поля Фамилия', '2', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('21', 'Дата рождения', 'ENTRY_DOB_MIN_LENGTH', '10', 'Минимальное количество символов поля Дата рождения', '2', '3', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('22', 'E-Mail Адрес', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', 'Минимальное количество символов поля E-Mail адрес', '2', '4', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('23', 'Адрес', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', 'Минимальное количество символов поля Адрес', '2', '5', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('24', 'Компания', 'ENTRY_COMPANY_MIN_LENGTH', '2', 'Минимальное количество символов поля Компания', '2', '6', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('25', 'Почтовый индекс', 'ENTRY_POSTCODE_MIN_LENGTH', '4', 'Минимальное количество символов поля Почтовый индекс', '2', '7', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('26', 'Город', 'ENTRY_CITY_MIN_LENGTH', '3', 'Минимальное количество символов поля Город', '2', '8', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('27', 'Регион', 'ENTRY_STATE_MIN_LENGTH', '2', 'Минимальное количество символов поля Регион', '2', '9', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('28', 'Телефон', 'ENTRY_TELEPHONE_MIN_LENGTH', '3', 'Минимальное количество символов поля Телефон', '2', '10', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('29', 'Пароль', 'ENTRY_PASSWORD_MIN_LENGTH', '5', 'Минимальное количество символов поля Пароль', '2', '11', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('30', 'Владелец кредитной карточки', 'CC_OWNER_MIN_LENGTH', '3', 'Минимальное количество символов поля Владелец кредитной карточки', '2', '12', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('31', 'Номер кредитной карточки', 'CC_NUMBER_MIN_LENGTH', '10', 'Минимальное количество символов поля Номер кредитной карточки', '2', '13', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('32', 'Текст отзыва', 'REVIEW_TEXT_MIN_LENGTH', '10', 'Минимальное количество символов для отызов', '2', '14', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('33', 'Лидеры продаж', 'MIN_DISPLAY_BESTSELLERS', '1', 'Минимальное количество товара, выводимого в блоке Лидеры продаж', '2', '15', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('34', 'Также заказали', 'MIN_DISPLAY_ALSO_PURCHASED', '1', 'Минимальное количество товара, выводимого в боксе Также заказали', '2', '16', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('35', 'Записи в адресной книге', 'MAX_ADDRESS_BOOK_ENTRIES', '5', 'Максимальное количество записей, которые может сделать покупатель в своей адресной книге', '3', '1', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('36', 'Товаров на одной странице в каталоге', 'MAX_DISPLAY_SEARCH_RESULTS', '10', 'Количество товара, выводимого на одной странице', '3', '2', '2003-08-06 12:35:41', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('37', 'Ссылок на страницы', 'MAX_DISPLAY_PAGE_LINKS', '10', 'Количество ссылок на другие страницы', '3', '3', '2004-01-02 19:17:13', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('38', 'Специальные цены', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '3', 'Максимальное количество товара, выводимого на странице Скидки', '3', '4', '2003-08-06 12:35:27', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('39', 'Новинки', 'MAX_DISPLAY_NEW_PRODUCTS', '6', 'Максимальное количество товара, выводимых в боксе Новинки', '3', '5', '2004-04-29 15:31:49', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('40', 'Ожидаемые товары', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '3', 'Максимальное количество товара, выводимого в блоке Ожидаемые товары', '3', '6', '2003-08-06 12:36:07', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('41', 'Список производителей', 'MAX_DISPLAY_MANUFACTURERS_IN_A_LIST', '5', 'Данная опция используется для настройки бокса производителей, если число производителей превышает указанное в данной опции, список производителей будет выводиться в виде drop-down списка, если число производителей меньше указанного в данной опции, произво', '3', '7', '2003-10-04 02:47:35', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('42', 'Производители в виде развёрнутого меню', 'MAX_MANUFACTURERS_LIST', '1', 'Данная опция используется для настройки бокса производителей, если указана цифра \'1\', то список производителей выводится в виде стандартного drop-down списка. Если указана любая другая цифра, то выводится только X производителей в виде развёрнутого меню.', '3', '7', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('43', 'Ограничение длины названия производителя', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', 'Данная опция используется для настройки бокса производителей, Вы указываете количество символов, выводимого в боксе производителей, если название производителя будет состоять из большего количества символов, то будут выведены первые X символов названия', '3', '8', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('44', 'Новые отзывы', 'MAX_DISPLAY_NEW_REVIEWS', '6', 'Максимальное количество выводимых новых отзывов', '3', '9', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('45', 'Выбор случайных отзывов', 'MAX_RANDOM_SELECT_REVIEWS', '10', 'Количество отзывов, которое будет использоваться для вывода случайного, т.е. если указано X - число отзывов, то случайный отзыв будет выбран из этих X отзывов', '3', '10', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('46', 'Выбор случайного товара в боксе Новинки', 'MAX_RANDOM_SELECT_NEW', '10', 'Количество товара, среди которого будет выбран случайный товар и выведен в бокс Новинок, т.е. если указано число X, то новый товар, который будет показан в боксе Новинок будет выбран из этих X новых товаров', '3', '11', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('47', 'Выбор случайного товара в боксе Скидки', 'MAX_RANDOM_SELECT_SPECIALS', '10', 'Количество товара, среди которого будет выбран случайный товар и выведен в бокс Скидки, т.е. если указано число X, то товар, который будет показан в боксе Скидки будет выбран из этих X товаров', '3', '12', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('48', 'Количество категорий в строке', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '3', 'Сколько категорий выводить в одной строке', '3', '13', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('49', 'Количество Новинок на странице', 'MAX_DISPLAY_PRODUCTS_NEW', '8', 'Максимальное количество новинок, выводимых на одной странице в разделе Новинки', '3', '14', '2003-08-29 22:56:22', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('50', 'Лидеры продаж', 'MAX_DISPLAY_BESTSELLERS', '10', 'Максимальное количество лидеров продаж, выводимых в боксе Лидеры продаж', '3', '15', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('51', 'Также заказази', 'MAX_DISPLAY_ALSO_PURCHASED', '6', 'Максимальное количество товаров в боксе Наши покупатели также заказали', '3', '16', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('52', 'Бокс История заказов', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', 'Максимальное количество товаров, выводимых в боксе История заказов', '3', '17', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('53', 'История заказов', 'MAX_DISPLAY_ORDER_HISTORY', '10', 'Максимальное количество заказов, выводимых на странице История заказов', '3', '18', NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('70', 'Product Quantities In Shopping Cart', 'MAX_QTY_IN_CART', '0', 'Maximum number of product quantities that can be added to the shopping cart (0 for no limit)', '3', '19', now());
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('71', 'Maximum number of reviews on product info page', 'MAX_REVIEWS', '5', 'Maximum number of reviews displayed on product info page.', '3', '20', now(), now(), NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('54', 'Ширина маленькой картинки', 'SMALL_IMAGE_WIDTH', '100', 'Ширина картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать ширину картинки. Ограничение ширины картинки не значит физического уменьшения размеров картинки.', '4', '1', '2004-02-01 16:15:37', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('55', 'Высота маленькой картинки', 'SMALL_IMAGE_HEIGHT', '80', 'Высота картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать высоту картинки. Ограничение высоты картинки не значит физического уменьшения размеров картинки.', '4', '2', '2004-02-01 16:15:22', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('56', 'Ширина картинки категории', 'HEADING_IMAGE_WIDTH', '', 'Ширина картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать ширину картинки. Ограничение ширины картинки не значит физического уменьшения размеров картинки.', '4', '3', '2004-04-24 14:47:21', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('57', 'Высота картинки категории', 'HEADING_IMAGE_HEIGHT', '', 'Высота картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать высоту картинки. Ограничение высоты картинки не значит физического уменьшения размеров картинки.', '4', '4', '2004-04-24 14:47:18', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('58', 'Ширина картинки подкатегории', 'SUBCATEGORY_IMAGE_WIDTH', '', 'Ширина картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать ширину картинки. Ограничение ширины картинки не значит физического уменьшения размеров картинки.', '4', '5', '2004-04-24 14:47:24', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('59', 'Высота картинки подкатегории', 'SUBCATEGORY_IMAGE_HEIGHT', '', 'Высота картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать высоту картинки. Ограничение высоты картинки не значит физического уменьшения размеров картинки.', '4', '6', '2004-04-24 14:47:28', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('60', 'Вычислять размер картинки', 'CONFIG_CALCULATE_IMAGE_SIZE', 'false', 'Данная опция просто смотрит переменные, указанные выше и сжимает картинку до указанных размеров, это не значит, что физический размер картинки уменьшится, происходит принудительный вывод картинки определённого размера. Рекомендуется ставить значение false', '4', '7', '2004-02-01 16:17:01', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('61', 'Картинка обязательна', 'IMAGE_REQUIRED', 'true', 'Необходимо для поиска ошибок, в случае, если картинка не выводится.', '4', '8', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('62', 'Пол', 'ACCOUNT_GENDER', 'false', 'Показывать поле Пол при регистрации покупателя в магазине и в адресной книге', '5', '1', '2004-01-30 17:21:22', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('63', 'Дата рождения', 'ACCOUNT_DOB', 'false', 'Показывать поле Дата рождения при регистрации покупателя в магазине и в адресной книге', '5', '2', '2004-01-30 17:21:35', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('64', 'Компания', 'ACCOUNT_COMPANY', 'false', 'Показывать поле Компания при регистрации покупателя в магазине и в адресной книге', '5', '3', '2004-01-30 17:21:39', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('65', 'Район', 'ACCOUNT_SUBURB', 'false', 'Показывать поле Район при регистрации покупателя в магазине и в адресной книге', '5', '4', '2004-01-30 17:21:42', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('66', 'Регион', 'ACCOUNT_STATE', 'true', 'Показывать поле Регион при регистрации покупателя в магазине и в адресной книге', '5', '5', '2004-04-22 17:07:14', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('67', 'Установленные модули', 'MODULE_PAYMENT_INSTALLED', 'cod.php;egold.php;freecharger.php;mg.php;rusbank.php;schet.php;webmoney.php;wu.php;yandex.php', 'Список установленных модулей оплаты, разделённых точкой с запятой. Страница автоматически обновляется. Ничего изменять не нужно, это просто информативная страница об установленных модулях. (Например: cc.php;cod.php;webmoney.php)', '6', '0', '2007-06-03 14:41:58', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('68', 'Установленные модули', 'MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_shipping.php;ot_tax.php;ot_coupon.php;ot_gv.php;ot_total.php', 'Список установленных модулей заказ итого, разделённых точкой с запятой. Страница автоматически обновляется. Ничего изменять не нужно, это просто информативная страница об установленных модулях. (Например: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_tota', '6', '0', '2006-01-04 13:42:21', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('69', 'Установленные модули', 'MODULE_SHIPPING_INSTALLED', 'flat.php;freeshipper.php;table.php', 'Список установленных модулей доставки, разделённых точкой с запятой. Страница автоматически обновляется. Ничего изменять не нужно, это просто информативная страница об установленных модулях. (Например: ups.php;flat.php;item.php)', '6', '0', '2006-03-25 18:30:56', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1559', 'Ваш EGold Идентификатор', 'MODULE_PAYMENT_EGOLD_1', '11111111', 'Введите Ваш EGold ID', '6', '1', NULL, '2006-03-25 18:25:13', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1558', 'Оплата через систему EGOLD', 'MODULE_PAYMENT_EGOLD_STATUS', '1', 'Вы хотите использовать модуль Оплата через систему EGOLD? 1 - да, 0 - нет', '6', '1', NULL, '2006-03-25 18:25:13', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('84', 'Default Currency', 'DEFAULT_CURRENCY', 'RUR', 'Default Currency', '6', '0', '2003-09-06 22:01:21', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('85', 'Default Language', 'DEFAULT_LANGUAGE', 'ru', 'Default Language', '6', '0', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('86', 'Default Order Status For New Orders', 'DEFAULT_ORDERS_STATUS_ID', '1', 'When a new order is created, this order status will be assigned to it.', '6', '0', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('87', 'Показывать доставку', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', 'Вы хотите показывать стоимость доставки?', '6', '1', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('88', 'Порядок сортировки', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '2', 'Порядок сортировки модуля.', '6', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('89', 'Разрешить бесплатную доставку', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'true', 'Вы хотите разрешить использование модуля бесплатной доставки?', '7', '6', '2003-11-19 22:05:02', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('90', 'Бесплатная доставка для заказов на сумму свыше', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '5000', 'Заказы, свыше суммы, указанной данной поле, будут доставляться бесплатно.', '7', '7', '2003-12-31 15:14:15', '2003-07-17 10:29:22', 'currencies->format', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('91', 'Бесплатная доставка для заказов, оформленных из', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', 'national - заказы из страны нахождения магазина(переменная Страна магазина), international - заказы из любой страны, кроме страны нахождения магазина, если both - тогда все заказы. При условии, что сумма заказы выше суммы, указанной в переменной выше.', '7', '8', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'national\', \'international\', \'both\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('92', 'Показывать стоимость товара', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', 'Вы хотите показывать стоимость товара?', '6', '1', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('93', 'Порядок сортировки', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '1', 'Порядок сортировки модуля.', '6', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('94', 'Показывать налог', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'true', 'Вы хотите показывать налог?', '6', '1', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('95', 'Порядок сортировки', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '3', 'Порядок сортировки модуля.', '6', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('96', 'Показывать всего', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', 'Вы хотите показывать общую стоимость заказа?', '6', '1', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('97', 'Порядок сортировки', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '800', 'Порядок сортировки модуля.', '6', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('98', 'Страна магазина', 'SHIPPING_ORIGIN_COUNTRY', '176', 'Страна, где находится магазин. Необходимо для некоторых модулей доставки.', '7', '1', '2004-04-22 17:39:38', '2003-07-17 10:29:22', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('99', 'Почтовый индекс магазина', 'SHIPPING_ORIGIN_ZIP', '355029', 'Укажите почтовый индекс магазина. Необходимо для некоторых модулей доставки.', '7', '2', '2004-04-22 17:39:43', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('100', 'Максимальный вес доставки', 'SHIPPING_MAX_WEIGHT', '50', 'Вы можете указать максимальный вес доставки, свыше которого заказы не доставляются. Необходимо для некоторых модулей доставки.', '7', '3', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('101', 'Вес упаковки', 'SHIPPING_BOX_WEIGHT', '0', 'Вы можете указать вес упаковки.', '7', '4', '2003-07-29 15:06:50', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('102', 'Тяжёлые заказы - Процентное увеличение стоимости', 'SHIPPING_BOX_PADDING', '10', 'Доставка заказов, вес которых больше указанного в переменной Максимальный вес доставки, увеличивается на указанный процент. Если Вы хотите увелить стоимость на 10%, пишите - 10', '7', '5', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('103', 'Показывать картинку товара', 'PRODUCT_LIST_IMAGE', '1', 'Укажите порядок вывода, т.е. введите цифру. Если укажите 1, то картинка будет слева на первом месте, если 2, то картинка будет показана после(правее) поля, у которого указана цифра 1 и т.д.', '8', '1', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('104', 'Показывать производителя товара', 'PRODUCT_LIST_MANUFACTURER', '0', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.', '8', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('105', 'Показывать код товара', 'PRODUCT_LIST_MODEL', '0', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.', '8', '3', '2004-01-02 17:22:34', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('106', 'Показывать название товара', 'PRODUCT_LIST_NAME', '2', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.', '8', '4', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('107', 'Показывать стоимость товара', 'PRODUCT_LIST_PRICE', '3', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.', '8', '5', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('108', 'Показывать количество товара на складе', 'PRODUCT_LIST_QUANTITY', '0', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.', '8', '6', '2004-01-02 17:22:50', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('109', 'Показывать вес товара', 'PRODUCT_LIST_WEIGHT', '0', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.', '8', '7', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('110', 'Показывать кнопку Купить сейчас!', 'PRODUCT_LIST_BUY_NOW', '4', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.', '8', '8', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('111', 'Показывать фильтр Категория/Производители (0=не показывать; 1=показывать)', 'PRODUCT_LIST_FILTER', '1', 'Показывать бокс(drop-down) меню, с помощью которого можно сортировать товар в какой-либо категории магазина по Производителю.', '8', '9', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('112', 'Расположение навигации Следующая/Предыдущая страница', 'PREV_NEXT_BAR_LOCATION', '3', 'Установите расположение навигации Следующая/Предыдущая страница (1-верх, 2-низ, 3-верх+низ)', '8', '10', '2003-10-05 19:19:32', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('113', 'Проверять наличие товара на складе', 'STOCK_CHECK', 'false', 'Проверять, есть ли необходимое количество товара на складе при оформлении заказа', '9', '1', '2004-02-01 16:18:45', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('114', 'Вычитать товар со склада', 'STOCK_LIMITED', 'false', 'Вычитать со склада то количество товара, которое будет заказываться в интернет-магазине', '9', '2', '2004-02-01 16:18:48', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('115', 'Разрешить оформление заказа', 'STOCK_ALLOW_CHECKOUT', 'true', 'Разрешить покупателям оформлять заказ, даже если на складе нет достаточного количества единиц заказываемого товара', '9', '3', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('116', 'Отмечать товар, отсутствующий на складе', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', 'Показывать покупателю маркер напротив товара при оформлении заказа, если на складе нет необходимого количества единиц заказываемого товара', '9', '4', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('117', 'Лимит количества товара на складе', 'STOCK_REORDER_LEVEL', '5', 'Если количество товара на складе меньше, чем указанное число в данной переменной, то в корзине выводится предупреждение о недостаточном количестве товара на складе для выполнения заказа.', '9', '5', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('118', 'Сохранять время парсинга страниц', 'STORE_PAGE_PARSE_TIME', 'false', 'Хранить время, затраченное на генерацию(парсинг) страниц магазина.', '10', '1', '2003-11-02 23:59:48', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('119', 'Директория хранения логов', 'STORE_PAGE_PARSE_TIME_LOG', '/tmp/page_parse_time.log', 'Полный путь до директории и файла, в который будет записываться лог парсинга страниц.', '10', '2', '2003-11-02 23:56:10', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('120', 'Формат даты логов', 'STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', 'Формат даты', '10', '3', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('121', 'Показывать время парсинга страниц', 'DISPLAY_PAGE_PARSE_TIME', 'false', 'Показывать время парсинга страницы в интернет-магазине (опция Сохранять время парсинга страниц должна быть включена)', '10', '4', '2006-04-21 20:49:23', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('122', 'Сохранять запросы к базе дынных', 'STORE_DB_TRANSACTIONS', 'false', 'Сохранять все запросы к базе данных в файле, указанном в переменной Директория хранение логов (только для PHP4 и выше)', '10', '5', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('123', 'Использовать кэш', 'USE_CACHE', 'false', 'Использовать кэширование информации.', '11', '1', '2003-08-28 21:53:54', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('124', 'Кэш директория', 'DIR_FS_CACHE', '/home/test/temp/', 'Директория, куда будут записываться и сохраняться кэш-файлы.', '11', '2', '2004-08-12 17:04:39', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('125', 'Способ отправки E-Mail', 'EMAIL_TRANSPORT', 'sendmail', 'Укажите, какой способ отправки писем из магазина будет использоваться. Для серверов, работающих под управлением Windows или MacOS необходимо установить SMTP для отправки писем.', '12', '1', '2004-02-16 11:48:47', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'sendmail\', \'smtp\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('126', 'Разделитель строк в E-Mail', 'EMAIL_LINEFEED', 'LF', 'Используемая последовательность символов для разделения заголовков в письме.', '12', '2', '2004-02-16 11:51:52', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'LF\', \'CRLF\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('127', 'Использовать HTML формат при отправке писем', 'EMAIL_USE_HTML', 'false', 'Отправлять письма из магазина в HTML формате.', '12', '3', '2004-02-16 11:51:56', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('128', 'Проверять E-Mail адрес через DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', 'Проверять, верные ли e-mail адреса указываются при регистрации в интернет-магазине. Для проверки используется DNS.', '12', '4', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('129', 'Отправлять письма из магазина', 'SEND_EMAILS', 'true', 'Отправлять письма из мгаазина.', '12', '5', '2003-11-02 20:00:22', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('130', 'Разрешить функцию скачивания товаров', 'DOWNLOAD_ENABLED', 'true', 'Разрешить функцию скачивания товаров.', '13', '1', '2003-07-29 15:38:22', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('131', 'Использовать перенаправление при скачивании', 'DOWNLOAD_BY_REDIRECT', 'false', 'Использовать перенаправление в браузере для скачивания товара. Для не Unix систем(Windows, Mac OS и т.д.) должно стоять false.', '13', '2', '2003-12-23 22:27:01', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('132', 'Срок существования ссылки для скачивания (дней)', 'DOWNLOAD_MAX_DAYS', '7', 'Установите количество дней, в течение которых покупатель может скачать свой товар. Если укажите 0, тогда срок существования ссылки для скачивания ограничен не будет.', '13', '3', NULL, '2003-07-17 10:29:22', NULL, '');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('133', 'Максимальное количество скачиваний', 'DOWNLOAD_MAX_COUNT', '5', 'Установите максимальное количество скачиваний для одного товара. Если укажите 0, тогда никаких ограничений по количеству скачиваний не будет.', '13', '4', NULL, '2003-07-17 10:29:22', NULL, '');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('134', 'Разрешить GZip компрессию', 'GZIP_COMPRESSION', 'false', 'Разрешить HTTP GZip компрессию.', '14', '1', '2003-08-12 00:20:39', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('135', 'Уровень компрессии', 'GZIP_LEVEL', '5', 'Вы можете указать уровень компрессии от 0 до 9 (0 = минимум, 9 = максимум).', '14', '2', NULL, '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('136', 'Директория сессий', 'SESSION_WRITE_DIRECTORY', '/tmp', 'Если сессии хранятся в файлах, то здесь необходимо указать полный путь до папки, в которой будут храниться файлы сессий.', '15', '1', '2004-08-12 17:04:54', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('137', 'Принудительное использование Cookie', 'SESSION_FORCE_COOKIE_USE', 'False', 'Принудительно использовать сессии, только когда в браузере активированы cookies.', '15', '2', '2004-11-14 12:30:25', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('138', 'Проверять ID SSL сессии', 'SESSION_CHECK_SSL_SESSION_ID', 'False', 'Проверять  SSL_SESSION_ID при каждом обращении к странице, защищённой протоколом HTTPS.', '15', '3', '2003-08-28 18:18:22', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('139', 'Проверять переменную User Agent', 'SESSION_CHECK_USER_AGENT', 'False', 'Проверять переменную бразура user agent при каждом обращении к страницам интернет-магазина.', '15', '4', NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('140', 'Проверять IP адрес', 'SESSION_CHECK_IP_ADDRESS', 'False', 'Проверять IP адреса клиентов при каждом обращении к страницам интернет-магазина.', '15', '5', '2003-08-28 18:18:30', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('141', 'Не показывать сессию в адресе паукам поисковых машин', 'SESSION_BLOCK_SPIDERS', 'True', 'Не показывать сессию в адресе при обращении к станицам магазина известных поисковых пауков. Список известных пауков находится в файле includes/spiders.txt.', '15', '6', '2003-07-17 10:34:45', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('142', 'Воссоздавать сессию', 'SESSION_RECREATE', 'False', 'Воссоздавать сессию для генерации нового ID кода сессии при входе зарегистрированного покупателя в магазин, либо при регистрации нового покупателя (Только для PHP 4.1 и выше).', '15', '7', '2003-07-17 10:35:04', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1171', 'Использовать WYSIWYG HTML редактор для поля Описание товара?', 'HTML_AREA_WYSIWYG_DISABLE', 'Disable', 'Enable - Включить HTML редактор для поля Описание товара при добавлении/редактировании товара<br>Disable - Выключить HTML редактор.', '112', '0', '2005-06-22 17:56:10', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1175', 'Использовать WYSIWYG HTML редактор на странице Отправить Email?', 'HTML_AREA_WYSIWYG_DISABLE_EMAIL', 'Disable', 'Enable - Включить HTML редактор <br>Disable - Выключить HTML редактор.', '112', '20', '2005-06-22 17:56:14', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1179', 'Использовать WYSIWYG HTML редактор на странице Менеджер почтовых', 'HTML_AREA_WYSIWYG_DISABLE_NEWSLETTER', 'Disable', 'Enable - Включить HTML редактор <br>Disable - Выключить HTML редактор.', '112', '30', '2005-06-22 17:56:18', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1183', 'Использовать WYSIWYG HTML редактор при редактировании главной ст', 'HTML_AREA_WYSIWYG_DISABLE_DEFINE', 'Disable', 'Enable - Включить HTML редактор <br>Disable - Выключить HTML редактор.', '112', '40', '2005-06-22 17:56:23', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('164', 'E-Mail Адрес', 'AFFILIATE_EMAIL_ADDRESS', '<affiliate@localhost.com>', 'E-Mail Адрес Партнёрской программы', '900', '1', '2003-07-17 21:46:04', '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('165', 'Процент с каждой продажи, начисляемый партнёру', 'AFFILIATE_PERCENT', '10.0000', 'Процент от суммы оплаченного заказа, начисляемый партнёрам', '900', '2', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('166', 'Минимальная сумма к оплате', 'AFFILIATE_THRESHOLD', '50.00', 'Минимальная сумма партнёрской комиссии к оплате', '900', '3', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('167', 'Время хранения cookies', 'AFFILIATE_COOKIE_LIFETIME', '7200', 'Время (в секундах) хранения cookies. Если посетитель с одного IP адреса сделал клик или покупку, и комиссия с его покупки была зачтена партнёру, то в следующий раз клики и продажи с этого IP будут засчитыватсья только через 7200 секунд (по умолчанию).', '900', '4', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('168', 'Выписка счетов к оплате', 'AFFILIATE_BILLING_TIME', '30', 'По умолчанию стоит 30, это значит, что счета для оплаты комиссий партнёрам выписываются раз в месяц', '900', '5', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('169', 'Минимальный статус заказа', 'AFFILIATE_PAYMENT_ORDER_MIN_STATUS', '3', 'Необходимо для того, чтобы комиссия партнёрам начислялась только за оплаченные заказы, статус ID - 3 или выше. По умолчанию стоит 3 (Выполняется), т.е. заказ уже оплачен и комиссия партнёрам начисляется только за оплаченные заказы.', '900', '6', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('170', 'Оплата партнёрам через WebMoney', 'AFFILIATE_USE_CHECK', 'true', 'Оплата партнёрских комиссий через WebMoney. При регистрации партнёр указывает свои данные в WebMoney.<br>true - Включено<br>false - Выключено', '900', '7', NULL, '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('171', 'Оплата партнёрам через PayPal', 'AFFILIATE_USE_PAYPAL', 'false', 'Оплата через систему PayPal.<br>true - Включено<br>false - Выключено', '900', '8', '2004-03-04 15:59:54', '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('172', 'Оплата партнёрам переводом на счёт в банке', 'AFFILIATE_USE_BANK', 'false', 'Оплата партнёрских комиссий через банк.<br>true - Включено<br>false - Выключено', '900', '9', '2004-03-04 15:59:58', '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('173', 'Индивидуальные проценты для партнёров', 'AFFILATE_INDIVIDUAL_PERCENTAGE', 'true', 'Позволяет указывать индивидуальные процентны комиссии для партнёров. Например, по умолчанию стоит 10% с продажи для всех зарегистрированных партнёров, а Вы можете наиболее успешным партнёрам давать комиссию 15% с продажи.', '900', '10', NULL, '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('174', 'Партнёрская пирамида', 'AFFILATE_USE_TIER', 'false', 'Партнёры, зарегистрировавшиеся через себя новых партнёров, могут получать комиссию за заказы, оформленные через партнёров, которых он привёл в магазин.', '900', '11', '2003-07-17 21:46:43', '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('175', 'Количество уровей пирамиды', 'AFFILIATE_TIER_LEVELS', '0', 'Количество уровней, которое учитываются при учёте комиссии.', '900', '12', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('176', 'Процент комиссии партнёрской пирамиды', 'AFFILIATE_TIER_PERCENTAGE', '8.00;5.00;1.00', 'Проценты комиссии для каждого из уровней.<br>Пример: 8.00;5.00;1.00', '900', '13', NULL, '2003-07-17 13:48:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1502', 'Пересчитывать налог', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'None', 'Пересчитывать налог.', '6', '7', NULL, '2005-11-01 12:07:39', NULL, 'tep_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1503', 'Налог', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', '0', 'Использовать налог для купонов.', '6', '0', NULL, '2005-11-01 12:07:39', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1501', 'Учитывать налог', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'true', 'Включать в расчёт налог.', '6', '6', NULL, '2005-11-01 12:07:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1499', 'Порядок сортировки', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', '9', 'Порядок сортировки модуля.', '6', '2', NULL, '2005-11-01 12:07:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1500', 'Учитывать доставку', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'true', 'Включать в расчёт доставку.', '6', '5', NULL, '2005-11-01 12:07:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1498', 'Показывать всего', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 'true', 'Вы хотите показывать номинал купона?', '6', '1', NULL, '2005-11-01 12:07:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1526', 'Налог сертификата', 'MODULE_ORDER_TOTAL_GV_CREDIT_TAX', 'false', 'Добавлять налог к купленным подарочным сертификатам.', '6', '8', NULL, '2006-01-04 13:42:21', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1525', 'Налог', 'MODULE_ORDER_TOTAL_GV_TAX_CLASS', '0', 'Использовать налог.', '6', '0', NULL, '2006-01-04 13:42:21', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1524', 'Пересчитывать налог', 'MODULE_ORDER_TOTAL_GV_CALC_TAX', 'None', 'Пересчитывать налог.', '6', '7', NULL, '2006-01-04 13:42:21', NULL, 'tep_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1523', 'Учитывать налог', 'MODULE_ORDER_TOTAL_GV_INC_TAX', 'true', 'Включать в расчёт налог.', '6', '6', NULL, '2006-01-04 13:42:21', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1522', 'Учитывать доставку', 'MODULE_ORDER_TOTAL_GV_INC_SHIPPING', 'true', 'Включать в расчёт доставку.', '6', '5', NULL, '2006-01-04 13:42:21', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1520', 'Порядок сортировки', 'MODULE_ORDER_TOTAL_GV_SORT_ORDER', '740', 'Порядок сортировки модуля.', '6', '2', NULL, '2006-01-04 13:42:21', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1521', 'Активация сертификатов', 'MODULE_ORDER_TOTAL_GV_QUEUE', 'true', 'Вы хотите вручную активировать купленные подарочные сертификаты?', '6', '3', NULL, '2006-01-04 13:42:21', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1519', 'Показывать всего', 'MODULE_ORDER_TOTAL_GV_STATUS', 'true', 'Вы хотите показывать номинал подарочного сертификата?', '6', '1', NULL, '2006-01-04 13:42:21', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('211', 'Разрешить описания категорий', 'ALLOW_CATEGORY_DESCRIPTIONS', 'true', 'Разрешить добавление описаний для категорий.', '1', '19', '2003-10-05 19:17:30', '2003-08-02 13:42:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('272', 'Техническое обслуживание: Вкл./Выкл.', 'DOWN_FOR_MAINTENANCE', 'false', 'Техническое обслуживание. Если включено, то в магазине нельзя будет делать заказы и будет выведено предупреждение о проведении технического обслуживания магазина.<br>true - Включено<br>false - Выключено', '16', '1', '2004-02-07 14:19:08', '2003-08-19 20:45:30', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('273', 'Техническое обслуживание: Имя файла', 'DOWN_FOR_MAINTENANCE_FILENAME', 'down_for_maintenance.php', 'Файл, который будет показан в магазине, если включено Техническое обслуживание магазина. По умолчанию - down_for_maintenance.php', '16', '2', NULL, '2003-08-19 20:45:30', NULL, '');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('274', 'Техническое обслуживание: Не показывать шапку', 'DOWN_FOR_MAINTENANCE_HEADER_OFF', 'false', 'При включённом техническом обслуживании Вы можете запретить показывать шапку магазина<br>true - Не показывать<Br>false - Показывать', '16', '3', NULL, '2003-08-19 20:45:30', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('275', 'Техническое обслуживание: Не показывать левую колонку', 'DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF', 'true', 'При включённом техническом обслуживании Вы можете запретить показывать левую колонку магазина<br>true - Не показывать<Br>false - Показывать', '16', '4', '2003-08-19 22:08:37', '2003-08-19 20:45:30', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('276', 'Техническое обслуживание: Не показывать правую колонку', 'DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF', 'true', 'При включённом техническом обслуживании Вы можете запретить показывать правую колонку магазина<br>true - Не показывать<Br>false - Показывать', '16', '5', '2003-08-21 22:50:51', '2003-08-19 20:45:30', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('277', 'Техническое обслуживание: Не показывать нижнюю часть', 'DOWN_FOR_MAINTENANCE_FOOTER_OFF', 'false', 'При включённом техническом обслуживании Вы можете запретить показывать нижнюю часть магазина<br>true - Не показывать<Br>false - Показывать', '16', '6', NULL, '2003-08-19 20:45:30', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('278', 'Техническое обслуживание: Не показывать цены', 'DOWN_FOR_MAINTENANCE_PRICES_OFF', 'false', 'При включённом техническом обслуживании Вы можете запретить показывать цены на товары в магазине<br>true - Не показывать<Br>false - Показывать', '16', '7', NULL, '2003-08-19 20:45:30', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('279', 'Техническое обслуживание: Исключить указанный IP адрес', 'EXCLUDE_ADMIN_IP_FOR_MAINTENANCE', 'Укажите Ваш IP адрес', 'Для указанного IP адреса магазин будет доступен даже при включённом режиме Техническое обслуживание. Обычно здесь указывает IP адрес администратора магазина.', '16', '8', '2003-03-21 13:43:22', '2003-03-21 21:20:07', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('280', 'Уведомлять посетителей магазина перед уходом на Техническое обсл', 'WARN_BEFORE_DOWN_FOR_MAINTENANCE', 'false', 'Предупреждать посетителей перед уходом на техническое обслуживание. Если техническое обслуживание уже включено, то данная опция автоматически устанавливается в false.', '16', '9', '2003-11-19 21:38:35', '2003-03-21 11:42:47', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('281', 'Текст уведомления', 'PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', 'Магазин будет закрыт на техническое обслуживание 19 июля 2004 г.', 'Укажите текст уведомления.', '16', '10', '2003-08-19 22:26:55', '2003-03-21 11:42:47', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('282', 'Показывать дату активации режима Техническое обслуживание', 'DISPLAY_MAINTENANCE_TIME', 'false', 'Показывать дату активации режима Техническое обслуживание.', '16', '11', '2003-08-19 22:19:57', '2003-03-21 11:42:47', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('283', 'Показывать период работы режима Техническое обслуживание', 'DISPLAY_MAINTENANCE_PERIOD', 'true', 'Показывать в течение какого времени магазин будет находиться в режиме Техническое обслуживание.', '16', '12', '2004-02-07 14:13:18', '2003-03-21 11:42:47', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('284', 'Время работы режима Техническое обслуживание', 'TEXT_MAINTENANCE_PERIOD_TIME', '30 минут', 'Укажите время работы магазина в режиме Техническое обслуживание', '16', '13', '2004-02-07 14:18:24', '2003-03-21 11:42:47', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('285', 'Сортировка товара, категорий', 'CATEGORIES_SORT_ORDER', 'model', '<b>Возможные значения:<br>products_name<br>products_name-desc<br>model<br>model-desc</b>', '1', '99', '2003-08-28 21:53:38', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1238', 'Зона', 'MODULE_SHIPPING_FREESHIPPER_ZONE', '0', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.', '6', '0', NULL, '2004-02-08 13:30:00', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1237', 'Налог', 'MODULE_SHIPPING_FREESHIPPER_TAX_CLASS', '0', 'Использовать налог.', '6', '0', NULL, '2004-02-08 13:30:00', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1236', 'Стоимость', 'MODULE_SHIPPING_FREESHIPPER_COST', '0.00', 'Стоимость использования данного способа доставки.', '6', '6', NULL, '2004-02-08 13:30:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1235', 'Разрешить бесплатную доставку', 'MODULE_SHIPPING_FREESHIPPER_STATUS', '1', 'Вы хотите разрешить модуль бесплатная доставка?', '6', '5', NULL, '2004-02-08 13:30:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1239', 'Порядок сортировки', 'MODULE_SHIPPING_FREESHIPPER_SORT_ORDER', '1', 'Порядок сортировки модуля.', '6', '0', NULL, '2004-02-08 13:30:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('351', 'Связанные товары', 'MIN_DISPLAY_XSELL', '1', 'Минимальное количество товаров, выводимых в боксе Связанные товары', '2', '17', '2003-08-28 22:55:49', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('998', 'Показывать способы и стоимость доставки в корзине', 'SHOW_SHIPPING_ESTIMATOR', 'true', 'Показывать информацию о способах и стоимости доставки в корзине?<br>true - показывать.<br>false - не показывать.', '7', '102', '2003-11-02 00:06:53', '2003-08-14 00:24:04', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('999', 'Показывать сопутствующие товары в корзине', 'SHOW_XSELL_CART', 'false', 'Показывать сопутствующие в корзине?<br>true - показывать.<br>false - не показывать.', '7', '102', '2003-11-02 00:06:53', '2003-08-14 00:24:04', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('235', 'Товаров в боксе Рекомендуемые товары на главной странице', 'MAX_DISPLAY_FEATURED_PRODUCTS', '6', 'Максимальное количество товара в боксе Рекомендуемые товары на главной странице', '3', '170', NULL, '2003-08-14 00:25:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('236', 'Товаров на одной странице Рекомендуемых товаров', 'MAX_DISPLAY_FEATURED_PRODUCTS_LISTING', '10', 'Количество товара на одной странице Рекомендуемых товаров', '3', '171', NULL, '2003-08-14 00:25:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('234', 'Показывать рекомендуемые товары на главной странице', 'SHOW_MAIN_FEATURED_PRODUCTS', 'true', 'true - Показывать<br>false - Не показывать', '1', '20', NULL, '2003-08-14 00:25:08', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1126', 'Скачивание разрешается только заказам, имеющим указанный статус', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS', '2', 'Скачивание файла (файлов) будет разрешено только в случае, если заказ будет иметь указанный статус (а именно id код статуса заказа). По умолчанию скачивание разрешено для заказов со статусом ждём оплаты (id код 2).', '13', '92', '2003-02-18 13:22:32', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1125', 'Предупреждением о необходимости оплатить скачиваемый товар', 'DOWNLOADS_CONTROLLER_ON_HOLD_MSG', '<BR><font color=\"FF0000\">Внимание: Вы не сможете скачать товар, пока оплата заказа не будет подтверждена</font>', 'Вы можете указать сообщение, которое будет показано клиенту, в случае, если он захочет скачать ещё неоплаченный товар.', '13', '91', '2003-02-18 13:22:32', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1124', 'Сброс статистики скачиваний', 'DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE', '4', 'Какой ID номер статуса заказа сбрасывает переменные Срок существования ссылки для скачивания (дней) и Максимальное количество скачиваний - По умолчанию Доставляется (id код 4).', '13', '90', '2003-02-18 13:22:32', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1047', 'Логотип магазина', 'STORE_LOGO', 'oscommerce.gif', 'Логотип магазина', '0', '2', '2003-11-25 23:54:35', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1143', 'Разрешить использование модуля дополнительных картинок?', 'ULTIMATE_ADDITIONAL_IMAGES', 'disable', 'Вы можете включить/выключить модуль дополнительных картинок для товара.', '4', '10', '2004-03-04 16:00:18', '2004-01-02 10:31:48', NULL, 'tep_cfg_select_option(array(\'enable\', \'disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1144', 'Ширина дополнительной картинки', 'ULT_THUMB_IMAGE_WIDTH', '100', 'Ширина дополнительной картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать ширину картинки. Ограничение ширины картинки не значит физического уменьшения размеров картинки.', '4', '11', '2004-04-29 09:53:39', '2004-01-02 10:31:48', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1145', 'Высота дополнительной картинки', 'ULT_THUMB_IMAGE_HEIGHT', '80', 'Высота дополнительной картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать высоту картинки. Ограничение высоты картинки не значит физического уменьшения размеров картинки.', '4', '12', '2004-04-29 09:53:44', '2004-01-02 10:31:48', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1146', 'Ширина большой картинки', 'MEDIUM_IMAGE_WIDTH', '', 'Ширина большой картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать ширину большой картинки. Ограничение ширины большой картинки не значит физического уменьшения размеров картинки.', '4', '13', '2004-01-02 11:11:59', '2004-01-02 10:31:48', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1147', 'Высота большой картинки', 'MEDIUM_IMAGE_HEIGHT', '', 'Высота большой картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать высоту большой картинки. Ограничение высоты большой картинки не значит физического уменьшения размеров картинки.', '4', '14', '2004-01-02 11:11:49', '2004-01-02 10:31:48', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1148', 'Ширина картинки для pop-up окна', 'LARGE_IMAGE_WIDTH', '', 'Ширина картинки для pop-up окна в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать ширину картинки для pop-up окна. Ограничение ширины картинки для pop-up окна не значит физического уменьшения размеров картинки.', '4', '15', '2004-04-24 14:47:36', '2004-01-02 10:31:48', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1149', 'Высота картинки для pop-up окна', 'LARGE_IMAGE_HEIGHT', '', 'Высота картинки для pop-up окна в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать высоту картинки для pop-up окна. Ограничение высоты картинки для pop-up окна не значит физического уменьшения размеров картинки.', '4', '16', '2004-04-24 14:47:39', '2004-01-02 10:31:48', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1201', 'Номинал подарочного сертификата, который получат посетители, про', 'NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', '0', 'Если Вы не хотите отправлять подарочный сертификат зарегистрированным в магазине покупателям, укажите 0. Чтобы отправлять зарегистрированным покупателям сертификат, например, номиналом в 10$ - укажите 10, если 25.5$ - укажите 25.5 и т.д.', '1', '31', NULL, '2003-12-05 05:01:41', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1202', 'Код купона, который получат посетители, прошедшие регистрацию в', 'NEW_SIGNUP_DISCOUNT_COUPON', '', 'Если Вы не хотите давать купон посетителям, прошедшим регистрацию, просто оставьте поле пустым, либо укажите код существующего купона, который Вы хотите давать всем зарегистрированным покупателям.', '1', '32', NULL, '2003-12-05 05:01:41', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1475', 'Last Database Restore', 'DB_LAST_RESTORE', 'loaded6_v4.sql', 'Last database restore file', '6', '0', '0000-00-00 00:00:00', '2005-03-27 12:59:23', '', '');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1604', 'Зона', 'MODULE_SHIPPING_FLAT_ZONE', '0', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.', '6', '0', NULL, '2006-03-25 18:30:56', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1603', 'Налог', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', 'Использовать налог.', '6', '0', NULL, '2006-03-25 18:30:56', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1602', 'Стоимость', 'MODULE_SHIPPING_FLAT_COST', '5.00', 'Стоимость использования данного способа доставки.', '6', '0', NULL, '2006-03-25 18:30:56', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1601', 'Разрешить модуль курьерская доставка', 'MODULE_SHIPPING_FLAT_STATUS', 'True', 'Вы хотите разрешить модуль курьерская доставка?', '6', '0', NULL, '2006-03-25 18:30:56', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1278', 'Разрешить модуль Российская почта', 'MODULE_SHIPPING_TABLE_STATUS', 'True', 'Вы хотите разрешить модуль доставки Российская почта?', '6', '0', NULL, '2004-02-12 13:27:36', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1279', 'Стоимость доставки', 'MODULE_SHIPPING_TABLE_COST', '100000:0', 'Стоимость доставки рассчитывается на основе общего веса заказа или общей стоимости заказа. Например: 25:8.50,50:5.50,и т.д... Это значит, что до 25 доставка будет стоить 8.50, от 25 до 50 будет стоить 5.50 и т.д.', '6', '0', NULL, '2004-02-12 13:27:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1280', 'Метод расчёта', 'MODULE_SHIPPING_TABLE_MODE', 'price', 'Стоимость расчёта доставки исходя из общего веса заказа (weight) или исходя из общей стоимости заказа (price).', '6', '0', NULL, '2004-02-12 13:27:36', NULL, 'tep_cfg_select_option(array(\'weight\', \'price\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1281', 'Стоимость', 'MODULE_SHIPPING_TABLE_HANDLING', '4', 'Стоимость использования данного способа доставки.', '6', '0', NULL, '2004-02-12 13:27:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1282', 'Налог', 'MODULE_SHIPPING_TABLE_TAX_CLASS', '0', 'Использовать налог.', '6', '0', NULL, '2004-02-12 13:27:36', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1283', 'Зона', 'MODULE_SHIPPING_TABLE_ZONE', '0', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.', '6', '0', NULL, '2004-02-12 13:27:36', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1284', 'Порядок сортировки', 'MODULE_SHIPPING_TABLE_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', NULL, '2004-02-12 13:27:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1308', 'Быстрое оформление заказа', 'GUEST_ON', 'true', 'Разрешить покупателям быстро оформлять заказ.', '40', '1', '2003-09-09 13:07:44', '2003-09-09 12:10:51', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1311', 'Товаров на одной странице в администраторской', 'MAX_PROD_ADMIN_SIDE', '15', 'Количество товара на одной странице в администраторской', '3', NULL, '2004-08-08 19:30:36', '2003-11-10 14:54:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1314', 'Формат вывода товара', 'PRODUCT_LISTING_DISPLAY_STYLE', 'list', 'Вы можете выбрать, в каком формате выводить товар, в виде таблицы - list, либо в столбец - columns.', '8', '0', NULL, '2004-04-11 14:10:36', '', 'tep_cfg_select_option(array(\'list\', \'columns\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1315', 'Количество товара в одной строке', 'PRODUCT_LIST_COL_NUM', '5', 'Данная опция действительна только если в качестве вывода товара выбран вывод товара в столбец - columns. Вы можете указать, какое количество товара будет выводиться в одной строке.', '8', '1', '2004-06-16 15:39:41', '2004-04-11 14:10:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1564', 'Город', 'MODULE_PAYMENT_MG_3', 'Moscow', 'City', '6', '1', NULL, '2006-03-25 18:25:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1563', 'Фамилия', 'MODULE_PAYMENT_MG_2', 'Ivanov', 'Last Name', '6', '1', NULL, '2006-03-25 18:25:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1562', 'Имя', 'MODULE_PAYMENT_MG_1', 'Ivan', 'First Name', '6', '1', NULL, '2006-03-25 18:25:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1592', 'Страна', 'MODULE_PAYMENT_WU_4', 'Russia', 'Country', '6', '1', NULL, '2006-03-25 18:26:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1586', 'Номер Вашего Z кошелька', 'MODULE_PAYMENT_WEBMONEY_3', 'Z111111111111', 'Введите номер Вашего Z кошелька', '6', '1', NULL, '2006-03-25 18:26:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1458', 'Порядок сортировки.', 'MODULE_PAYMENT_COD_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', NULL, '2004-08-12 16:40:17', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1712', 'Статус заказа', 'MODULE_PAYMENT_RUS_BANK_ORDER_STATUS_ID', '0', 'Заказы, оформленные с использованием данного модуля оплаты будут принимать указанный статус.', '6', '12', NULL, '2007-06-03 14:44:07', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1457', 'Зона', 'MODULE_PAYMENT_COD_ZONE', '0', 'Если выбрана зона, то данный модуль оплаты будет виден только покупателям из выбранной зоны.', '6', '2', NULL, '2004-08-12 16:40:17', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1585', 'Номер Вашего R кошелька', 'MODULE_PAYMENT_WEBMONEY_2', 'R11111111111', 'Введите номер Вашего R кошелька', '6', '1', NULL, '2006-03-25 18:26:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1584', 'Ваш WM Идентификатор', 'MODULE_PAYMENT_WEBMONEY_1', '11111111111', 'Введите Ваш WM идентификатор', '6', '1', NULL, '2006-03-25 18:26:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1583', 'Оплата через систему WebMoney', 'MODULE_PAYMENT_WEBMONEY_STATUS', '1', 'Вы хотите использовать модуль Оплата через систему WebMoney? 1 - да, 0 - нет', '6', '1', NULL, '2006-03-25 18:26:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1591', 'Город', 'MODULE_PAYMENT_WU_3', 'Moscow', 'City', '6', '1', NULL, '2006-03-25 18:26:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1590', 'Фамилия', 'MODULE_PAYMENT_WU_2', 'Ivanov', 'Last Name', '6', '1', NULL, '2006-03-25 18:26:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1589', 'Имя', 'MODULE_PAYMENT_WU_1', 'Ivan', 'First Name', '6', '1', NULL, '2006-03-25 18:26:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1588', 'Western Union', 'MODULE_PAYMENT_WU_STATUS', '1', 'Вы хотите использовать модуль Western Union? 1 - да, 0 - нет', '6', '1', NULL, '2006-03-25 18:26:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1365', 'Показывать ссылку новые статьи', 'DISPLAY_NEW_ARTICLES', 'true', 'Показывать ссылку новые статьи в боксе статьи?', '456', '1', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1366', 'Количество дней, в течение которых статья считается новой', 'NEW_ARTICLES_DAYS_DISPLAY', '30', 'Какое количество дней после добавления, статья считается новой и отображатеся на странице новые статьи.', '456', '2', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1367', 'Количество статей на одной странице новых статей', 'MAX_NEW_ARTICLES_PER_PAGE', '10', 'Максимальное количество статей, выводимых на одной странице новых статей.', '456', '3', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1368', 'Показывать ссылку все статьи', 'DISPLAY_ALL_ARTICLES', 'true', 'Показывать ссылку все статьи в боксе статьи?', '456', '4', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1369', 'Количество статей на одной странице', 'MAX_ARTICLES_PER_PAGE', '10', 'Максимальное количество статей, выводимых на одной странице.', '456', '5', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1370', 'Максимальное количество готовящихся к публикации статей', 'MAX_DISPLAY_UPCOMING_ARTICLES', '5', 'Максимальное количество статей, выводимых в блоке готовятся к публикации', '456', '6', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1371', 'Разрешить отзывы к статьям', 'ENABLE_ARTICLE_REVIEWS', 'true', 'Разрешить посетителям оставлять свои отзывы о статьях.', '456', '7', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1372', 'Разрешить функцию рассказать знакомому', 'ENABLE_TELL_A_FRIEND_ARTICLE', 'false', 'Разрешить посетителям использовть функцию Рассказать знакомому.', '456', '8', '2004-08-12 17:15:58', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1373', 'Минимальное количество товара, выводимого в боксе связанные това', 'MIN_DISPLAY_ARTICLES_XSELL', '1', 'Минимальное количество товара, выводимого в боксе связанные товары.', '456', '9', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1374', 'Максимальное количество товара, выводимого в боксе связанные тов', 'MAX_DISPLAY_ARTICLES_XSELL', '6', 'Максимальное количество товара, выводимого в боксе связанные товары.', '456', '10', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1375', 'Показывать счётчик статей', 'SHOW_ARTICLE_COUNTS', 'true', 'Показывать количество статей в каждой разделе.', '456', '11', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1376', 'Максимальная длина поля автор', 'MAX_DISPLAY_AUTHOR_NAME_LEN', '20', 'Максимальная количество символов, выводимых в боксе авторы.', '456', '12', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1377', 'Формат вывода списка авторов', 'MAX_DISPLAY_AUTHORS_IN_A_LIST', '1', 'Если число авторов меньше указанной цифры, тогда в боксе авторы выводится простой список, если число авторов больше указанной цифры, тогра выводится drop-down список авторов.', '456', '13', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1378', 'Авторы в виде развёрнутого меню', 'MAX_AUTHORS_LIST', '1', 'Данная опция используется для настройки бокса авторы, если указана цифра 1, то список авторов выводится в виде стандартного drop-down списка. Если указана любая другая цифра, то выводится только X производителей в виде развёрнутого меню.', '456', '14', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1379', 'Показывать автора в списке статей', 'DISPLAY_AUTHOR_ARTICLE_LISTING', 'true', 'Показывать автора в списке статей?', '456', '15', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1380', 'Показывать раздел в списке статей', 'DISPLAY_TOPIC_ARTICLE_LISTING', 'true', 'Показывать раздел в списке статей?', '456', '16', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1381', 'Показывать Meta Description в списке статей', 'DISPLAY_ABSTRACT_ARTICLE_LISTING', 'true', 'Показывать Meta Description в списке статей?', '456', '17', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1382', 'Показывать дату добавления в списке статей', 'DISPLAY_DATE_ADDED_ARTICLE_LISTING', 'true', 'Показывать дату добавления в списке статей?', '456', '18', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1383', 'Максимальная длина поля Meta Description', 'MAX_ARTICLE_ABSTRACT_LENGTH', '300', 'Максимальное количество символов поля Meta Description.', '456', '19', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1384', 'Показывать фильтр Раздел/Авторы', 'ARTICLE_LIST_FILTER', 'true', 'Показывать фильтр Раздел/Авторы?', '456', '20', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1385', 'Расположение навигации Следующая/Предыдущая страница', 'ARTICLE_PREV_NEXT_BAR_LOCATION', 'both', 'Расположение навигации Следующая/Предыдущая страница<br><br>top - верх<br>bottom - низ<br>both - (верх+низ)', '456', '21', '2004-06-16 15:29:39', '2004-06-16 15:29:39', NULL, 'tep_cfg_select_option(array(\'top\', \'bottom\', \'both\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1396', 'Поиск в описаниях товара', 'QUICKSEARCH_IN_DESCRIPTION', 'true', 'При поиске товара с помощью бокса быстрый поиск, Вы можете указать, как искать товары, только по названиям - FALSE или искать в названиях + описаниях - TRUE', '1', '113', '2004-07-06 16:13:39', '2004-06-10 16:42:11', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1397', 'Получатели писем, отправленных со страницы Свяжитесь с нами', 'CONTACT_US_LIST', 'Отдел обслуживания <email@address1>, Отдел доставки <email@address2>', 'Вы можете указать разных получателей на странице Свяжитесь с нами. Формат записи: Имя 1 &lt;email@address1&gt;, Имя 2 &lt;email@address2&gt;. Если Вы хотите оставить всего одного получателя писем, просто оставьте поле пустым.', '1', '113', '2004-07-18 13:56:11', '2004-06-10 16:42:11', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1456', 'Разрешить модуль Оплата наличными при получении', 'MODULE_PAYMENT_COD_STATUS', 'True', 'Вы хотите разрешить использование модуля при оформлении заказов?', '6', '1', NULL, '2004-08-12 16:40:17', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1595', 'Номер Вашего счёта в системе Яндекс-Деньги', 'MODULE_PAYMENT_YANDEX_1', '11111111111', 'Введите номер Вашего счёта в системе Яндекс-Деньги.', '6', '1', NULL, '2006-03-25 18:26:17', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1594', 'Оплата через систему Яндекс-Деньги', 'MODULE_PAYMENT_YANDEX_STATUS', '1', 'Вы хотите использовать модуль Оплата через систему Яндекс-Деньги? 1 - да, 0 - нет', '6', '1', NULL, '2006-03-25 18:26:17', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1407', 'Минимальная сумма заказа', 'MIN_ORDER', '0', 'Если сумма заказа будет меньше указанной, такой заказ нельзя будет оформить. Указывайте просто число, без симолов валюты ($, руб. и т.д.). Поставьте 0, если Вы не хотите ограничивать минимальную сумму заказа.', '2', '17', NULL, '2004-07-31 12:38:49', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1408', 'Разрешить использование подарочных сертификатов и купонов', 'ALLOW_GIFT_VOUCHERS', 'false', 'Вы можете включить - true или выключить - false возможность использования подарочных сертификатов и купонов при оформлении заказа.', '1', '113', '2004-06-10 16:54:12', '2004-06-10 16:42:11', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('400', 'Количество возможных цен для товара', 'XPRICES_NUM', '1', 'Здесь Вы можете указать, какое количество цен может иметь каждый товар<br><br>Например, Вы можете покупателям из группы Покупатели показывать одну цену товара, покупателям из группы Оптовики - показывать другую.', '1', '30', '2003-11-11 18:33:04', '0000-00-00 00:00:00', 'tep_update_prices', 'tep_cfg_pull_down_prices(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1409', 'Показывать цены посетителям', 'ALLOW_GUEST_TO_SEE_PRICES', 'true', 'Если стоит false, то цены в магазине могут видеть только зарегистрированные посетители, если true - все посетители могут видеть цены в магазине.', '1', '31', '0000-00-00 00:00:00', '2004-03-15 14:59:05', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1410', 'Скидка для посетителей', 'GUEST_DISCOUNT', '0', 'Скидка для простых посетителей магазина. Для зарегистрированных в магазине посетителей данная опция не действует.', '1', '32', '0000-00-00 00:00:00', '2004-03-15 14:59:05', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1459', 'Статус заказа', 'MODULE_PAYMENT_COD_ORDER_STATUS_ID', '0', 'Заказы, оформленные с использованием данного модуля оплаты будут принимать указанный статус.', '6', '0', NULL, '2004-08-12 16:40:17', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1461', 'Счётчик переходов', 'ENABLE_LINKS_COUNT', 'True', 'Показывать количество переходов по ссылке.', '901', '1', NULL, '2004-09-13 13:20:32', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1462', 'Использовать короткие URL адреса', 'ENABLE_SPIDER_FRIENDLY_LINKS', 'True', 'Использовать короткие URL адреса.', '901', '2', NULL, '2004-09-13 13:20:32', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1463', 'Ширина картинки', 'LINKS_IMAGE_WIDTH', '120', 'Ширина картинки ссылки.', '901', '3', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1464', 'Высота картинки', 'LINKS_IMAGE_HEIGHT', '60', 'Высота картинки ссылки.', '901', '4', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1465', 'Показывать картинку', 'LINK_LIST_IMAGE', '1', 'Укажите порядок вывода данного поля, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д. Если укажите 0, то данное поле не будет показываться.', '901', '5', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1466', 'Показывать URL', 'LINK_LIST_URL', '4', 'Укажите порядок вывода данного поля, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д. Если укажите 0, то данное поле не будет показываться.', '901', '6', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1467', 'Показывать название ссылки', 'LINK_LIST_TITLE', '2', 'Укажите порядок вывода данного поля, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д. Если укажите 0, то данное поле не будет показываться.', '901', '7', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1468', 'Показывать описание ссылки', 'LINK_LIST_DESCRIPTION', '3', 'Укажите порядок вывода данного поля, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д. Если укажите 0, то данное поле не будет показываться.', '901', '8', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1469', 'Показывать количество переходов', 'LINK_LIST_COUNT', '0', 'Укажите порядок вывода данного поля, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д. Если укажите 0, то данное поле не будет показываться.', '901', '9', '2006-01-16 19:40:25', '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1470', 'Минимальное количество символов поля Название сайта', 'ENTRY_LINKS_TITLE_MIN_LENGTH', '2', 'Минимальное количество символов.', '901', '10', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1471', 'Минимальное количество символов поля URL Адрес', 'ENTRY_LINKS_URL_MIN_LENGTH', '10', 'Минимальное количество символов.', '901', '11', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1472', 'Минимальное количество символов поля Описание', 'ENTRY_LINKS_DESCRIPTION_MIN_LENGTH', '10', 'Минимальное количество символов.', '901', '12', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1473', 'Минимальное количество символов поля Ваше имя', 'ENTRY_LINKS_CONTACT_NAME_MIN_LENGTH', '2', 'Минимальное количество символов.', '901', '13', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1474', 'Текст для проверки', 'LINKS_CHECK_PHRASE', 'kypi.ru', 'Текст (обычно адрес магазина), который будет искаться при проверке ссылки. Необходимо для того, чтобы убедиться, что на сайте, добавленном в каталог ссылок, установлена ссылка на Ваш магазин.', '901', '14', NULL, '2004-09-13 13:20:32', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('263', 'Показывать порядок сортировки', 'PRODUCT_SORT_ORDER', '0', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д. 0 - значит не показывать данное поле', '8', '29', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1001', 'Показывать код товара', 'DISPLAY_MODEL', 'true', 'Показывать/Не показывать код товара', '300', '1', '2003-06-04 05:04:11', '2003-06-04 04:18:06', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1002', 'Показывать код товара', 'MODIFY_MODEL', 'true', 'Показывать/Не показывать код товара', '300', '2', '2003-06-04 05:04:07', '2003-06-04 04:25:57', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1003', 'Показывать название товара', 'MODIFY_NAME', 'true', 'Показывать/Не показывать название товара', '300', '3', '2003-06-04 05:04:01', '2003-06-04 04:30:31', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1004', 'Показывать статус товара', 'DISPLAY_STATUT', 'true', 'Показывать/Не показывать статус товара', '300', '4', '2003-06-04 05:07:11', '2003-06-04 05:00:58', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1005', 'Показывать вес товара', 'DISPLAY_WEIGHT', 'true', 'Показывать/Не показывать вес товара', '300', '5', '2003-06-04 05:06:44', '2003-06-04 04:33:16', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1006', 'Показывать количество товара', 'DISPLAY_QUANTITY', 'true', 'Показывать/Не показывать количество товара', '300', '6', '2003-06-04 05:06:48', '2003-06-04 04:34:34', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1007', 'Показывать порядок сортировки', 'DISPLAY_SORT_ORDER', 'true', 'Показывать/Не показывать порядок сортировки', '300', '6', '2003-06-04 05:06:48', '2003-06-04 04:34:34', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1008', 'Показывать минимум для заказа', 'DISPLAY_ORDER_MIN', 'true', 'Показывать/Не показывать минимум для заказа', '300', '6', '2003-06-04 05:06:48', '2003-06-04 04:34:34', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1009', 'Показывать шаг', 'DISPLAY_ORDER_UNITS', 'true', 'Показывать/Не показывать шаг', '300', '6', '2003-06-04 05:06:48', '2003-06-04 04:34:34', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1010', 'Показывать картинку товара', 'DISPLAY_IMAGE', 'false', 'Показывать/Не показывать картинку товара', '300', '7', '2003-06-04 05:06:52', '2003-06-04 04:36:57', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1011', 'Показывать XML', 'DISPLAY_XML', 'true', 'Показывать/Не показывать колонку XML', '300', '4', '2003-06-04 05:07:11', '2003-06-04 05:00:58', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1012', 'Показывать производителей товара', 'MODIFY_MANUFACTURER', 'true', 'Показывать/Не показывать производителя товара', '300', '8', '2003-06-04 05:06:57', '2003-06-04 04:37:40', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1013', 'Показывать налог', 'MODIFY_TAX', 'true', 'Показывать/Не показывать налог', '300', '9', '2003-06-04 05:06:40', '2003-06-04 04:31:53', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1014', 'Показывать цены с налогами', 'DISPLAY_TVA_OVER', 'true', 'Показывать/Не показывать цены с налогами', '300', '10', '2003-06-04 05:07:02', '2003-06-04 04:38:45', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1015', 'Показывать цены с налогами при изменении цены', 'DISPLAY_TVA_UP', 'true', 'Показывать/Не показывать цены с налогами при изменении цены', '300', '11', '2003-06-04 05:07:06', '2003-06-04 04:40:12', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1016', 'Показывать ссылку на описание товара', 'DISPLAY_PREVIEW', 'true', 'Показывать/Не показывать ссылку на описание товара', '300', '12', '2003-06-04 05:19:13', '2003-06-04 05:15:50', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1017', 'Показывать ссылку на редактирование товара', 'DISPLAY_EDIT', 'true', 'Показывать/Не показывать ссылку на редактирование товара', '300', '13', '2003-06-04 05:19:08', '2003-06-04 05:17:05', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1018', 'Показывать производителя', 'DISPLAY_MANUFACTURER', 'false', 'Показывать/Не показывать производителя', '300', '7', '2003-06-04 05:19:08', '2003-06-04 05:17:05', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1019', 'Показывать налог', 'DISPLAY_TAX', 'false', 'Показывать/Не показывать налог', '300', '8', '2003-06-04 05:19:08', '2003-06-04 05:17:05', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1020', 'Показывать возможность массового изменения цен', 'ACTIVATE_COMMERCIAL_MARGIN', 'true', 'Показывать/Не показывать возможность массового  изменения цен', '300', '14', '2003-06-04 05:19:08', '2003-06-04 05:17:05', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1476', 'Разрешить управление атрибутами на странице добавления товара', 'ALLOW_ATTRIBUTES_IN_PRODUCT_EDIT_PAGE', 'true', 'Вы можете включить - true или выключить - false возможность управления атрибутами товаров прямо на странице добавления/редактирования товаров.', '1', '114', '2004-06-10 16:54:12', '2004-06-10 16:42:11', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1477', 'Выводить субкатегории при наличии товара в категории', 'SHOW_SUBCATEGORIES_WHEN_CATEGORIES_HAS_PRODUCTS', 'true', 'Если в категории есть товар и в данной категории есть субкатегории, то по умолчанию (true), зайдя в такую категорию, Вы увидите список субкатегорий и список товаров категории. Можно отключить вывод субкатегорий, для этого поставьте false.', '1', '114', '2004-06-10 16:54:12', '2004-06-10 16:42:11', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1479', 'ICQ номер', 'STORE_OWNER_ICQ_NUMBER', 'Ваш номер', 'ICQ номер, который будет выведен в боксе Консультант в магазине.', '1', '3', '2004-08-12 17:03:20', '2003-07-17 10:29:22', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1480', 'Street Address', 'ACCOUNT_STREET_ADDRESS', 'true', 'Display Street Address on the Create Account page', '5', '6', '2005-09-30 12:00:25', '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1481', 'City', 'ACCOUNT_CITY', 'true', 'Display City on the Create Account page', '5', '7', NULL, '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1482', 'Post Code/ZIP', 'ACCOUNT_POSTCODE', 'true', 'Display Post Code/ZIP on the Create Account page', '5', '8', '2005-09-30 12:00:22', '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1483', 'Country', 'ACCOUNT_COUNTRY', 'true', 'Display Country on the Create Account page', '5', '9', NULL, '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1484', 'Telephone', 'ACCOUNT_TELE', 'true', 'Display Telephone Number on the Create Account page', '5', '10', NULL, '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1485', 'Fax', 'ACCOUNT_FAX', 'true', 'Display Fax Number on the Create Account page', '5', '11', NULL, '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1486', 'Newsletter', 'ACCOUNT_NEWS', 'true', 'Display Newsletter option on the Create Account page', '5', '12', NULL, '2005-09-30 11:57:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1487', 'Модуль наценки', 'EXTRA_PRODUCT_PRICE_ID', 'true', 'Включить/Выключить систему наценок', '1', '114', '2005-10-12 14:28:18', '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
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
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1510', 'Название магазина', 'YML_NAME', '', 'Название магазина для Яндекс-Маркет. Если поле пустое, то используется STORE_NAME.', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1511', 'Название компании', 'YML_COMPANY', '', 'Название компании для Яндекс-Маркет. Если поле пустое, то используется STORE_OWNER.', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1512', 'Доставка включена', 'YML_DELIVERYINCLUDED', 'false', 'Доставка включена в стоимость товара?', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1513', 'Товар в наличии', 'YML_AVAILABLE', 'stock', 'Товар в наличии или под заказ?', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, 'tep_cfg_select_option(array(\'true\', \'false\', \'stock\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1514', 'Логин', 'YML_AUTH_USER', '', 'Логин для доступа к YML (market.php)', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1515', 'Пароль', 'YML_AUTH_PW', '', 'Пароль для доступа к YML (market.php)', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1516', 'Ссылка', 'YML_REFERER', 'false', 'Добавить в адрес товара параметр с ссылкой на User agent или ip?', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, 'tep_cfg_select_option(array(\'false\', \'ip\', \'agent\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1517', 'Теги', 'YML_STRIP_TAGS', 'true', 'Убирать html-теги в строках?', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, 'tep_cfg_select_option(array(\'false\', \'true\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1518', 'Перекодировка в UTF-8', 'YML_UTF8', 'false', 'Перекодировать в UTF-8?', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, 'tep_cfg_select_option(array(\'false\', \'true\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1527', 'Статус заказа', 'MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID', '0', 'Заказы, оформленные с использованием подарочного сертификата, покрывающего полную стоимость заказа, будут иметь указанный статус.', '6', '0', NULL, '2006-01-04 13:42:21', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1528', 'Использовать WYSIWYG HTML редактор при редактировании статей', 'HTML_AREA_WYSIWYG_DISABLE_ARTICLES', 'Disable', 'Enable - Включить HTML редактор <br>Disable - Выключить HTML редактор.', '112', '40', '2005-06-22 17:56:23', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1530', 'Использовать WYSIWYG HTML редактор при редактировании faq', 'HTML_AREA_WYSIWYG_DISABLE_FAQDESK', 'Disable', 'Enable - Включить HTML редактор <br>Disable - Выключить HTML редактор.', '112', '40', '2005-06-22 17:56:23', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1532', 'Использовать WYSIWYG HTML редактор при редактировании новостей', 'HTML_AREA_WYSIWYG_DISABLE_NEWSDESK', 'Disable', 'Enable - Включить HTML редактор <br>Disable - Выключить HTML редактор.', '112', '40', '2005-06-22 17:56:23', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1534', 'Использовать WYSIWYG HTML редактор при редактировании информационных страниц', 'HTML_AREA_WYSIWYG_DISABLE_INFOPAGES', 'Disable', 'Enable - Включить HTML редактор <br>Disable - Выключить HTML редактор.', '112', '40', '2005-06-22 17:56:23', '2004-01-02 10:52:04', NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1561', 'Money Gram', 'MODULE_PAYMENT_MG_STATUS', '1', 'Вы хотите использовать модуль Money Gram? 1 - да, 0 - нет', '6', '1', NULL, '2006-03-25 18:25:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1711', 'Зона', 'MODULE_PAYMENT_RUS_BANK_ZONE', '0', 'Если выбрана зона, то данный модуль оплаты будет виден только покупателям из выбранной зоны.', '6', '11', NULL, '2007-06-03 14:44:07', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1701', 'Разрешить модуль Оплата по квитанции Сбербанка РФ', 'MODULE_PAYMENT_RUS_BANK_STATUS', 'True', 'Вы хотите разрешить использование модуля при оформлении заказов?', '6', '1', NULL, '2007-06-03 14:44:07', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1560', 'Порядок сортировки.', 'MODULE_PAYMENT_EGOLD_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', NULL, '2006-03-25 18:25:13', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1565', 'Страна', 'MODULE_PAYMENT_MG_4', 'Russia', 'Country', '6', '1', NULL, '2006-03-25 18:25:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1566', 'Порядок сортировки.', 'MODULE_PAYMENT_MG_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', NULL, '2006-03-25 18:25:36', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1587', 'Порядок сортировки.', 'MODULE_PAYMENT_WEBMONEY_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', NULL, '2006-03-25 18:26:08', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1593', 'Порядок сортировки.', 'MODULE_PAYMENT_WU_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', NULL, '2006-03-25 18:26:12', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1596', 'Порядок сортировки.', 'MODULE_PAYMENT_YANDEX_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', NULL, '2006-03-25 18:26:17', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1597', 'Разрешить модуль Бесплатная загрузка', 'MODULE_PAYMENT_FREECHARGER_STATUS', 'True', 'Вы хотите разрешить модуль бесплатная загрузка?', '6', '1', NULL, '2006-03-25 18:27:29', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1598', 'Порядок сортировки.', 'MODULE_PAYMENT_FREECHARGER_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', NULL, '2006-03-25 18:27:29', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1599', 'Зона', 'MODULE_PAYMENT_FREECHARGER_ZONE', '0', 'Если выбрана зона, то данный модуль оплаты будет виден только покупателям из выбранной зоны.', '6', '2', NULL, '2006-03-25 18:27:29', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1600', 'Статус заказа', 'MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID', '0', 'Заказы, оформленные с использованием данного модуля оплаты будут принимать указанный статус.', '6', '0', NULL, '2006-03-25 18:27:29', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1605', 'Порядок сортировки', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', NULL, '2006-03-25 18:30:56', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1606', 'Разрешить модуль просмотр категорий', 'BRWCAT_ENABLE', 'true', 'Активировать модуль просмотр категорий.', '401', '1', '2006-04-21 20:48:32', '2006-04-21 20:45:51', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1607', 'Картинки категорий', 'BRWCAT_ICON_MODE', 'image with caption', 'Выберите, показывать картинки или нет и если показывать, то как:<br><br>Disabled - Не показывать.<br>Text - Название без картинки.<br>Image only - Картинка.<br>Image with caption - Картинка + текст.', '401', '2', NULL, '2006-04-21 20:45:51', NULL, 'tep_cfg_select_option(array(\'off\', \'text\', \'image only\', \'image with caption\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1608', 'Ссылки на подкатегории', 'BRWCAT_SUBCAT_MODE', 'right top', 'Как показывать ссылку на подкатегории:<br><br>Off - Не показывать вообще.<br>Bottom - Показывать снизу.<br>Right top - Справа сверху.<br>Right middle - Справа посередине.<br>Right bottom - Справа снизу.', '401', '3', NULL, '2006-04-21 20:45:51', NULL, 'tep_cfg_select_option(array(\'off\', \'bottom\', \'right top\', \'right middle\', \'right bottom\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1609', 'Максимальное количество подкатегорий в одной строке', 'BRWCAT_ICONS_PER_ROW', '2', 'Сколько подкатегорий показывать в одной строке:', '401', '4', NULL, '2006-04-21 20:45:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1610', 'Символ перед названием категорий', 'BRWCAT_SUBCAT_BULLET', '»&nbsp;', 'Символ, показываемый перед названием категории.', '401', '5', NULL, '2006-04-21 20:45:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1611', 'Счетчик количества товаров в категориях', 'BRWCAT_SUBCAT_COUNTS', '(%s)', 'Счётчик количества товара в категориях.', '401', '6', NULL, '2006-04-21 20:45:51', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1612', 'Формат вывода названий категорий', 'BRWCAT_NAME_CASE', 'same', 'Выберите, в каком формате выводить названия категорий.', '401', '7', NULL, '2006-04-21 20:45:51', NULL, 'tep_cfg_select_option(array(\'same\', \'upper\', \'lower\', \'title\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1709', 'Назначение платежа', 'MODULE_PAYMENT_RUS_BANK_8', '', 'Укажите назначение платежа', '6', '9', NULL, '2007-06-03 14:44:07', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1710', 'Порядок сортировки.', 'MODULE_PAYMENT_RUS_BANK_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '10', NULL, '2007-06-03 14:44:07', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1707', 'Получатель', 'MODULE_PAYMENT_RUS_BANK_6', '', 'Получатель платежа', '6', '7', NULL, '2007-06-03 14:44:07', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1708', 'КПП', 'MODULE_PAYMENT_RUS_BANK_7', '', 'Введите КПП', '6', '8', NULL, '2007-06-03 14:44:07', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1704', 'БИК', 'MODULE_PAYMENT_RUS_BANK_3', '', 'Введите БИК', '6', '4', NULL, '2007-06-03 14:44:07', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1705', 'Кор./счет', 'MODULE_PAYMENT_RUS_BANK_4', '', 'Введите Кор./счет', '6', '5', NULL, '2007-06-03 14:44:07', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1706', 'ИНН', 'MODULE_PAYMENT_RUS_BANK_5', '', 'Введите ИНН', '6', '6', NULL, '2007-06-03 14:44:07', NULL, NULL);
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
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1703', 'Расчетный счет', 'MODULE_PAYMENT_RUS_BANK_2', '', 'Введите Ваш расчетный счет', '6', '3', NULL, '2007-06-03 14:44:07', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1702', 'Название банка', 'MODULE_PAYMENT_RUS_BANK_1', '', 'Введите название банка', '6', '2', NULL, '2007-06-03 14:44:07', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1737', 'Зона', 'MODULE_PAYMENT_RUS_SCHET_ZONE', '0', 'Если выбрана зона, то данный модуль оплаты будет виден только покупателям из выбранной зоны.', '6', '0', NULL, '2007-06-03 14:44:15', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1736', 'Порядок сортировки.', 'MODULE_PAYMENT_RUS_SCHET_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', NULL, '2007-06-03 14:44:15', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1735', 'Руководитель', 'MODULE_PAYMENT_RUS_SCHET_9', 'test', 'Ф.И.О. руководителя', '6', '1', NULL, '2007-06-03 14:44:15', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1734', 'Юридический адрес', 'MODULE_PAYMENT_RUS_SCHET_8', 'test', 'Введите Ваш юр. адрес', '6', '1', NULL, '2007-06-03 14:44:15', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1733', 'ИНН', 'MODULE_PAYMENT_RUS_SCHET_7', 'test', 'Введите Ваш ИНН', '6', '1', NULL, '2007-06-03 14:44:15', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1732', 'Получатель', 'MODULE_PAYMENT_RUS_SCHET_6', 'test', 'Получатель платежа', '6', '1', NULL, '2007-06-03 14:44:15', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1731', 'КПП', 'MODULE_PAYMENT_RUS_SCHET_5', 'test', 'Введите КПП', '6', '1', NULL, '2007-06-03 14:44:15', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1730', 'Кор./счет', 'MODULE_PAYMENT_RUS_SCHET_4', 'test', 'Введите Ваш Кор./счет', '6', '1', NULL, '2007-06-03 14:44:15', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1729', 'БИК', 'MODULE_PAYMENT_RUS_SCHET_3', 'test', 'Введите Ваш БИК', '6', '1', NULL, '2007-06-03 14:44:15', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1727', 'Название банка', 'MODULE_PAYMENT_RUS_SCHET_1', 'test', 'Введите название Вашей компании', '6', '1', NULL, '2007-06-03 14:44:15', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1728', 'Расчетный счет', 'MODULE_PAYMENT_RUS_SCHET_2', 'test', 'Введите Ваш расчетный счет', '6', '1', NULL, '2007-06-03 14:44:15', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1726', 'Разрешить модуль Предоплата на счёт', 'MODULE_PAYMENT_RUS_SCHET_STATUS', 'True', 'Вы хотите разрешить использование модуля при оформлении заказов?', '6', '1', NULL, '2007-06-03 14:44:15', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1738', 'Статус заказа', 'MODULE_PAYMENT_RUS_SCHET_ORDER_STATUS_ID', '0', 'Заказы, оформленные с использованием данного модуля оплаты будут принимать указанный статус.', '6', '0', NULL, '2007-06-03 14:44:15', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Display the Payment Method dropdown?', 'ORDER_EDITOR_PAYMENT_DROPDOWN', 'true', 'Based on this selection Order Editor will display the payment method as a dropdown menu (true) or as an input field (false).', '72', '1', now(), now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Use prices from Separate Pricing Per Customer?', 'ORDER_EDITOR_USE_SPPC', 'false', 'This should be set to true only if SPPC is installed.', '72', '3', now(), now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Allow the use of AJAX to update order information?', 'ORDER_EDITOR_USE_AJAX', 'true', 'This must be set to false if using a browser on which JavaScript is disabled or not available.', '72', '4', now(), now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Select your credit card payment method', 'ORDER_EDITOR_CREDIT_CARD', 'Credit Card', 'Order Editor will display the credit card fields when this payment method is selected.', '72', '5', now(), now(), NULL, 'tep_cfg_pull_down_payment_methods(');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Использовать модуль картинок атрибутов?', 'OPTIONS_AS_IMAGES_ENABLED', 'true', 'Хотите разрешить модуль?', 735, 1, '2003-08-18 22:19:45', '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Число картинок в одном ряду', 'OPTIONS_IMAGES_NUMBER_PER_ROW', '2', 'Введите максимальную длину ряда картинок', 735, 2, '2003-08-20 12:58:16', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Ширина картинки атрибута', 'OPTIONS_IMAGES_WIDTH', '25', 'Выберите ширину', 735, 3, '2003-08-20 12:55:16', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Высота картинки атрибута', 'OPTIONS_IMAGES_HEIGHT', '25', 'Выберите высоту', 735, 4, '2003-08-20 12:55:22', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Увеличение кликом', 'OPTIONS_IMAGES_CLICK_ENLARGE', 'true', 'Активировать функцию увеличения картинки кликом мышки?', 735, 5, '2003-08-21 12:59:58', '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Разделы', 'SET_BOX_CATEGORIES', 'true', 'Включить/выключить бокс.', '736', '1', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Информация', 'SET_BOX_INFORMATION', 'true', 'Включить/выключить бокс.', '736', '2', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Производители', 'SET_BOX_MANUFACTURERS', 'true', 'Включить/выключить бокс.', '736', '3', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Новости', 'SET_BOX_LATESTNEWS', 'true', 'Включить/выключить бокс.', '736', '4', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Поиск', 'SET_BOX_SEARCH', 'true', 'Включить/выключить бокс.', '736', '5', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Новинки', 'SET_BOX_WHATSNEW', 'true', 'Включить/выключить бокс.', '736', '6', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Рекомендуемые', 'SET_BOX_FEATURED', 'true', 'Включить/выключить бокс.', '736', '7', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Сортировка по цене', 'SET_BOX_SHOP_BY_PRICE', 'true', 'Включить/выключить бокс.', '736', '8', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Статьи', 'SET_BOX_ARTICLES', 'true', 'Включить/выключить бокс.', '736', '9', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Авторы', 'SET_BOX_AUTHORS', 'true', 'Включить/выключить бокс.', '736', '10', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Ссылки', 'SET_BOX_LINKS', 'true', 'Включить/выключить бокс.', '736', '11', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Корзина', 'SET_BOX_CART', 'true', 'Включить/выключить бокс.', '736', '12', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Мои загрузки', 'SET_BOX_DOWNLOADS', 'true', 'Включить/выключить бокс.', '736', '13', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Консультант', 'SET_BOX_HELP', 'true', 'Включить/выключить бокс.', '736', '14', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Вход', 'SET_BOX_LOGIN', 'true', 'Включить/выключить бокс.', '736', '15', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Отложенные', 'SET_BOX_WISHLIST', 'true', 'Включить/выключить бокс.', '736', '16', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Партнёрская программа', 'SET_BOX_AFFILIATE', 'true', 'Включить/выключить бокс.', '736', '17', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Вопросы и ответы - категории', 'SET_BOX_FAQ', 'true', 'Включить/выключить бокс.', '736', '18', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Последние вопросы и ответы', 'SET_BOX_FAQ_LATEST', 'true', 'Включить/выключить бокс.', '736', '19', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Опросы', 'SET_BOX_POLLS', 'true', 'Включить/выключить бокс.', '736', '20', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Информация о производителе', 'SET_BOX_MANUFACTURERS_INFO', 'true', 'Включить/выключить бокс.', '736', '21', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('История заказов', 'SET_BOX_ORDER_HISTORY', 'true', 'Включить/выключить бокс.', '736', '22', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Лучшие товары', 'SET_BOX_BESTSELLERS', 'true', 'Включить/выключить бокс.', '736', '23', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Уведомления', 'SET_BOX_NOTIFICATIONS', 'true', 'Включить/выключить бокс.', '736', '24', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Рассказать другу', 'SET_BOX_TELL_A_FRIEND', 'true', 'Включить/выключить бокс.', '736', '25', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Скидки', 'SET_BOX_SPECIALS', 'true', 'Включить/выключить бокс.', '736', '26', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Отзывы', 'SET_BOX_REVIEWS', 'true', 'Включить/выключить бокс.', '736', '27', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Языки', 'SET_BOX_LANGUAGES', 'true', 'Включить/выключить бокс.', '736', '28', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Валюты', 'SET_BOX_CURRENCIES', 'true', 'Включить/выключить бокс.', '736', '29', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Фильтры', 'SET_BOX_FILTERS', 'true', 'Включить/выключить бокс.', '736', '30', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Тэг sales_notes', 'YML_SALES_NOTES', '', 'Текст для тэга sales_notes', '26230', '2', NULL, '2006-01-04 13:42:04', NULL, NULL);

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Показывать закладку карта на странице заказа', 'ENABLE_MAP_TAB', 'true', 'Включить/Отключить закладку карта на странице заказа.', '1', '116', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Яндекс карты API-Ключ', 'MAP_API_KEY', '', 'Укажите Ваш API ключ.', '1', '117', NULL, '2006-01-04 13:42:04', NULL, NULL);

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP сервер', 'EMAIL_SMTP_SERVER', 'smtp.server.com', 'Укажите smtp сервер, если Вы включили отправку почты через smtp.', '12', '6', NULL, '2003-07-17 10:29:22', NULL, '');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP сервер: Порт', 'EMAIL_SMTP_PORT', '25', 'Установите порт smtp сервера.', '12', '7', NULL, '2003-07-17 10:29:22', NULL, '');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP авторизация', 'EMAIL_SMTP_AUTH', 'false', 'SMTP авторизация.', '12', '8', '2004-02-16 11:51:56', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP сервер: Имя пользователя', 'EMAIL_SMTP_USERNAME', 'username', 'Установите имя пользователя для подключения к серверу.', '12', '9', NULL, '2003-07-17 10:29:22', NULL, '');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP сервер: Пароль', 'EMAIL_SMTP_PASSWORD', 'password', 'Установите пароль для подключения к серверу.', '12', '10', NULL, '2003-07-17 10:29:22', NULL, '');

drop table if exists configuration_group;
create table configuration_group (
  configuration_group_id int(11) not null auto_increment,
  configuration_group_title varchar(64) not null ,
  configuration_group_description varchar(255) not null ,
  sort_order int(5) ,
  visible int(1) default '1' ,
  PRIMARY KEY (configuration_group_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('1', 'Мой магазин', 'Основные настройки магазина.', '1', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('2', 'Минимальные значения', 'Минимальные значения функций и данных.', '2', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('3', 'Максимальные значения', 'Максимальные значения функций и данных', '3', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('4', 'Картинки', 'Настройки картинок.', '4', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('5', 'Данные покупателя', 'Настройка формы регистрации.', '5', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('6', 'Установленные модули', 'Скрытые опции.', '6', '0');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('7', 'Доставка/Упаковка', 'Настройка опци доставки и упаковки.', '7', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('8', 'Вывод товара', 'Настройка вывода товара.', '8', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('9', 'Склад', 'Настройка склада.', '9', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('10', 'Логи', 'Настройка логов.', '10', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('11', 'Кэш', 'Настройка кэша.', '11', '0');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('12', 'Настройка E-Mail', 'Настройка E-Mail.', '12', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('13', 'Скачивание', 'Настройка скачиваемых товаров.', '13', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('14', 'GZip Компрессия', 'Настройка GZip компрессии.', '14', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('15', 'Сессии', 'Session options', '15', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('112', 'HTML Редактор', 'Настройка HTML редактора.', '15', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('900', 'Партнёрская программа', 'Настройка партнёрской программы.', '17', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('16', 'Тех. обслуживание', 'Настройка режима Техническое обслуживание.', '19', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('40', 'Быстрое оформление', 'Быстрое оформление заказов.', '40', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('901', 'Ссылки', 'Настройки модуля ссылок.', '99', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('300', 'Обновление прайса', 'Настройки модуля быстрого обновления цен.', '300', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('12954', 'Wish List Settings', 'Settings for your Wish List', '25', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('26229', 'Page Cache Settings', 'Settings for the page cache contribution', '20', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('26230', 'Яндекс-Маркет', 'Конфигурирование Яндекс-Маркет', '99', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('401', 'Список категорий на главной странице', 'Настройки', '401', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('160', 'Установщик модулей', 'Настройки', '160', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('72', 'Order Editor', 'Configuration options for Order Editor', 72, 1);
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('735', 'Картинки атрибутов', 'Присвоение разным значениям атрибутов разных картинок', 20, 1);
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('736', 'Боксы', 'Включение/выключение боксов.', 20, 1);
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('1610', 'Products Specifications', 'Products Specifications configuration options', 1610, 1);

drop table if exists counter;
create table counter (
  startdate char(8) ,
  counter int(12) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into counter (startdate, counter) values ('20031126', '1087');
drop table if exists counter_history;
create table counter_history (
  month char(8) ,
  counter int(12) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists countries;
create table countries (
  countries_id int(11) not null auto_increment,
  countries_name varchar(64) not null ,
  countries_iso_code_2 char(2) not null ,
  countries_iso_code_3 char(3) not null ,
  address_format_id int(11) default '0' not null ,
  PRIMARY KEY (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('226', 'Узбекистан', 'UZ', 'UZB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('220', 'Украина', 'UA', 'UKR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('207', 'Таджикистан', 'TJ', 'TJK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('176', 'Российская Федерация', 'RU', 'RUS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('140', 'Молдавия', 'MD', 'MDA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('123', 'Литва', 'LT', 'LTU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('117', 'Латвия', 'LV', 'LVA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('115', 'Кыргызстан', 'KG', 'KGZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('109', 'Казахстан', 'KZ', 'KAZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('80', 'Грузия', 'GE', 'GEO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('67', 'Эстония', 'EE', 'EST', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('20', 'Белоруссия', 'BY', 'BLR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('15', 'Азербайджан', 'AZ', 'AZE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('11', 'Армения', 'AM', 'ARM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('216', 'Туркменистан', 'TM', 'TKM', '1');
drop table if exists coupon_email_track;
create table coupon_email_track (
  unique_id int(11) not null auto_increment,
  coupon_id int(11) default '0' not null ,
  customer_id_sent int(11) default '0' not null ,
  sent_firstname varchar(255) ,
  sent_lastname varchar(255) ,
  emailed_to varchar(255) ,
  date_sent datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (unique_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists coupon_gv_customer;
create table coupon_gv_customer (
  customer_id int(5) default '0' not null ,
  amount decimal(8,4) default '0.0000' not null ,
  PRIMARY KEY (customer_id),
  KEY customer_id (customer_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists coupon_gv_queue;
create table coupon_gv_queue (
  unique_id int(5) not null auto_increment,
  customer_id int(5) default '0' not null ,
  order_id int(5) default '0' not null ,
  amount decimal(8,4) default '0.0000' not null ,
  date_created datetime default '0000-00-00 00:00:00' not null ,
  ipaddr varchar(255) not null ,
  release_flag char(1) default 'N' not null ,
  PRIMARY KEY (unique_id),
  KEY uid (unique_id, customer_id, order_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists coupon_redeem_track;
create table coupon_redeem_track (
  unique_id int(11) not null auto_increment,
  coupon_id int(11) default '0' not null ,
  customer_id int(11) default '0' not null ,
  redeem_date datetime default '0000-00-00 00:00:00' not null ,
  redeem_ip varchar(255) not null ,
  order_id int(11) default '0' not null ,
  PRIMARY KEY (unique_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists coupons;
create table coupons (
  coupon_id int(11) not null auto_increment,
  coupon_type char(1) default 'F' not null ,
  coupon_code varchar(255) not null ,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists coupons_description;
create table coupons_description (
  coupon_id int(11) default '0' not null ,
  language_id int(11) default '0' not null ,
  coupon_name varchar(255) not null ,
  coupon_description text ,
  KEY coupon_id (coupon_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists currencies;
create table currencies (
  currencies_id int(11) not null auto_increment,
  title varchar(255) not null ,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into currencies (currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('1', 'Рубль', 'RUR', '', 'руб.', '.', ',', '0', '1.00000000', NULL);

drop table if exists customers;
create table customers (
  customers_id int(11) not null auto_increment,
  customers_gender char(1) not null ,
  customers_firstname varchar(255) not null ,
  customers_lastname varchar(255) not null ,
  customers_dob datetime default '0000-00-00 00:00:00' not null ,
  customers_email_address varchar(96) not null ,
  customers_default_address_id int(11) ,
  customers_telephone varchar(255) not null ,
  customers_fax varchar(255) ,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists customers_groups;
create table customers_groups (
  customers_groups_id int(11) not null auto_increment,
  customers_groups_name varchar(255) not null ,
  customers_groups_discount decimal(8,2) default '-0.00' not null ,
  customers_groups_price int(11) default '1' not null ,
  customers_groups_accumulated_limit decimal(15,4) default '0.0000' not null ,
  color_bar varchar(255) default '#ffffff' not null ,
  group_payment_allowed varchar(255) not null ,
  group_shipment_allowed varchar(255) not null ,
  customers_groups_min_price int(11) default '0' not null ,
  PRIMARY KEY (customers_groups_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into customers_groups (customers_groups_id, customers_groups_name, customers_groups_discount, customers_groups_price, customers_groups_accumulated_limit, color_bar, group_payment_allowed, group_shipment_allowed, customers_groups_min_price) values ('1', 'Покупатели', '-0.00', '1', '0.0000', '#ffffff', '', '', '0');
insert into customers_groups (customers_groups_id, customers_groups_name, customers_groups_discount, customers_groups_price, customers_groups_accumulated_limit, color_bar, group_payment_allowed, group_shipment_allowed, customers_groups_min_price) values ('2', 'Оптовые покупатели', '-20.00', '1', '0.0000', '#ffffff', '', '', '0');
drop table if exists customers_groups_orders_status;
create table customers_groups_orders_status (
  customers_groups_id int(11) default '0' not null ,
  orders_status_id int(11) default '0' not null 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists customers_info;
create table customers_info (
  customers_info_id int(11) default '0' not null ,
  customers_info_date_of_last_logon datetime ,
  customers_info_number_of_logons int(5) ,
  customers_info_date_account_created datetime ,
  customers_info_date_account_last_modified datetime ,
  global_product_notifications int(1) default '0' ,
  PRIMARY KEY (customers_info_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists customers_to_extra_fields;
create table customers_to_extra_fields (
  customers_id int(11) default '0' not null ,
  fields_id int(11) default '0' not null ,
  value text 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists customers_wishlist;
create table customers_wishlist (
  products_id tinytext ,
  customers_id int(13) default '0' not null 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists customers_wishlist_attributes;
create table customers_wishlist_attributes (
  customers_wishlist_attributes_id int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  products_id tinytext ,
  products_options_id int(11) default '0' not null ,
  products_options_value_id int(11) default '0' not null ,
  PRIMARY KEY (customers_wishlist_attributes_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists extra_fields_info;
create table extra_fields_info (
  fields_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  fields_name varchar(255) not null 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into faqdesk_categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified, catagory_status) values ('2', NULL, '0', '0', '2005-06-22 17:58:57', NULL, '1');
drop table if exists faqdesk_categories_description;
create table faqdesk_categories_description (
  categories_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  categories_name varchar(255) not null ,
  categories_heading_title varchar(64) ,
  categories_description text ,
  PRIMARY KEY (categories_id, language_id),
  KEY idx_categories_name (categories_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into faqdesk_categories_description (categories_id, language_id, categories_name, categories_heading_title, categories_description) values ('2', '1', 'Тест', NULL, 'Описание');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1', 'Вопросов на одной странице', 'MAX_DISPLAY_FAQDESK_SEARCH_RESULTS', '20', 'Сколько вопросов показывать на одной странице?', '1', '1', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('2', 'Ссылок на страницы', 'MAX_DISPLAY_FAQDESK_PAGE_LINKS', '5', 'Количество ссылок на другие страницы.', '1', '2', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('3', 'Показывать вопрос', 'FAQDESK_QUESTION', '1', 'Показывать вопрос при просмотре faq? (0=не показывать; 1-4=порядок вывода данного поля)', '1', '3', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('4', 'Показывать краткий ответ', 'FAQDESK_SHORT_ANSWER', '2', 'Показывать краткий ответ при просмотре faq? (0=не показывать; 1-4=порядок вывода данного поля)', '1', '4', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('5', 'Показывать расширенный ответ', 'FAQDESK_LONG_ANSWER', '3', 'Показывать расширенный ответ при просмотре faq? (0=не показывать; 1-4=порядок вывода данного поля)', '1', '5', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('6', 'Показывать дату', 'FAQDESK_DATE_AVAILABLE', '4', 'Показывать дату при просмотре faq? (0=не показывать; 1-4=порядок вывода данного поля)', '1', '6', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('7', 'Расположение навигации Следующая/Предыдущая страница', 'FAQDESK_PREV_NEXT_BAR_LOCATION', '3', 'Расположение навигации Следующая/Предыдущая страница<br><br>1 - верх<br>2 - низ<br>3 - (верх+низ)', '1', '12', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('8', 'Вопросов на главной странице', 'MAX_DISPLAY_FAQDESK_FAQS', '3', 'Сколько вопросов показывать на главной странице?', '2', '1', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('9', 'Вопросов в боксе свежие вопросы в FAQ', 'LATEST_DISPLAY_FAQDESK_FAQS', '5', 'Сколько вопросов показывать в боксе последние новости?', '2', '2', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('10', 'Показывать бокс свежие вопросы в FAQ', 'DISPLAY_LATEST_FAQS_BOX', '1', 'Показывать бокс свежие вопросы в FAQ? (0=не показывать; 1=показывать)', '2', '3', '2004-01-02 14:34:06', '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('11', 'Показывать бокс FAQ', 'DISPLAY_FAQS_CATAGORY_BOX', '1', 'Показывать бокс FAQ? (0=не показывать; 1=показывать)', '2', '4', '2004-01-02 14:34:32', '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('12', 'Показывать счётчик просмотров', 'DISPLAY_FAQDESK_VIEWCOUNT', '1', 'Показывать счётчик количества просмотров faq? (0=не показывать; 1=показывать)', '2', '5', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('13', 'Показывать ссылку подробнее', 'DISPLAY_FAQDESK_READMORE', '1', 'Показывать ссылку подробнее? (0=не показывать; 1=показывать)', '2', '6', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('14', 'Показывать короткий ответ', 'DISPLAY_FAQDESK_SHORT_ANSWER', '1', 'Показывать короткий ответ на вопрос? (0=не показывать; 1=показывать)', '2', '7', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('15', 'Показывать вопрос', 'DISPLAY_FAQDESK_QUESTION', '1', 'Показывать вопрос? (0=не показывать; 1=показывать)', '2', '8', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('16', 'Показывать дату', 'DISPLAY_FAQDESK_DATE', '1', 'Показывать дату? (0=не показывать; 1=показывать)', '2', '9', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('17', 'Показывать картинку 1', 'DISPLAY_FAQDESK_IMAGE', '1', 'Показывать картинку 1 вопроса? (0=не показывать; 1=показывать)', '2', '10', NULL, '2003-03-03 11:59:47', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('18', 'Показывать картинку 2', 'DISPLAY_FAQDESK_IMAGE_TWO', '1', 'Показывать картинку 2 вопроса? (0=не показывать; 1=показывать)', '2', '11', '2003-03-03 12:08:55', '2003-03-03 11:59:47', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('19', 'Показывать картинку 3', 'DISPLAY_FAQDESK_IMAGE_THREE', '1', 'Показывать картинку 3 вопроса? (0=не показывать; 1=показывать)', '2', '12', '2003-03-03 12:09:16', '2003-03-03 11:59:47', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('20', 'Показывать отзывы', 'DISPLAY_FAQDESK_REVIEWS', '1', 'Показывать отзывы? (0=не показывать; 1=показывать)', '3', '1', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('21', 'Максимальное количество новых отзывов', 'MAX_DISPLAY_NEW_REVIEWS', '10', 'Максимальное количество выводимых новых отзывов.', '3', '2', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('22', 'Показывать вопрос', 'STICKY_QUESTION', '1', 'Показывать вопрос? (0=не показывать; 1=показывать)', '4', '1', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('23', 'Показывать короткий ответ', 'STICKY_SHORT_ANSWER', '1', 'Показывать короткий ответ? (0=не показывать; 1=показывать)', '4', '2', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('24', 'Показывать расширенный ответ', 'STICKY_LONG_ANSWER', '1', 'Показывать расширенный ответ? (0=не показывать; 1=показывать)', '4', '3', '2003-03-02 00:49:34', '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('25', 'Показывать счётчик просмотров', 'STICKY_FAQDESK_VIEWCOUNT', '1', 'Показывать счётчик количества просмотров faq? (0=не показывать; 1=показывать)', '4', '4', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('26', 'Показывать ссылку подробнее', 'STICKY_FAQDESK_READMORE', '1', 'Показывать ссылку подробнее? (0=не показывать; 1=показывать)', '4', '5', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('27', 'Показывать дату', 'STICKY_DATE_ADDED', '1', 'Показывать дату? (0=не показывать; 1=показывать) (0=disable; 1=enable)', '4', '6', '2003-03-02 00:49:54', '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('28', 'Показывать URL ссылку', 'STICKY_EXTRA_URL', '1', 'Показывать URL ссылку? (0=не показывать; 1=показывать)', '4', '7', '2003-03-02 00:50:28', '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('29', 'Показывать картинку', 'STICKY_IMAGE', '1', 'Показывать картинку 1 вопроса? (0=не показывать; 1=показывать)', '4', '8', '2003-03-02 00:50:14', '2003-03-02 00:47:21', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('30', 'Показывать картинку 2', 'STICKY_IMAGE_TWO', '1', 'Показывать картинку 2 вопроса? (0=не показывать; 1=показывать)', '4', '9', NULL, '2003-03-03 23:10:34', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('31', 'Показывать картинку 3', 'STICKY_IMAGE_THREE', '1', 'Показывать картинку 3 вопроса? (0=не показывать; 1=показывать)', '4', '10', NULL, '2003-03-03 23:10:34', NULL, NULL);
insert into faqdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('32', 'Разрешить описания категорий', 'ALLOW_CATEGORY_DESCRIPTIONS', '1', 'Разрешить добавление описаний для категорий? (true=разрешить; false=запретить)', '5', '1', '2003-03-03 23:10:34', '2003-03-03 23:10:34', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
drop table if exists faqdesk_configuration_group;
create table faqdesk_configuration_group (
  configuration_group_id int(11) not null auto_increment,
  configuration_group_key varchar(255) not null ,
  configuration_group_title varchar(64) not null ,
  configuration_group_description varchar(255) not null ,
  sort_order int(5) ,
  visible int(1) default '1' ,
  PRIMARY KEY (configuration_group_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into faqdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('1', 'FAQDESK_LISTING_DB', 'Настройка вывода', 'Настройка вывода FAQ', '1', '1');
insert into faqdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('2', 'FAQDESK_SETTINGS_DB', 'Общие настройки', 'Настройки главное страницы', '1', '1');
insert into faqdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('3', 'FAQDESK_REVIEWS_DB', 'Настройка отзывов', 'Настройка отзывов', '1', '1');
insert into faqdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('4', 'FAQDESK_STICKY_DB', 'Настройка \"горячих\" вопросов', 'Настройка \"горячих\" вопросов', '1', '1');
insert into faqdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('5', 'FAQDESK_OTHER_DB', 'Другие настройки', 'Другие настройки', '1', '1');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into faqdesk_description (faqdesk_id, language_id, faqdesk_question, faqdesk_answer_long, faqdesk_answer_short, faqdesk_extra_url, faqdesk_extra_viewed, faqdesk_image_text, faqdesk_image_text_two, faqdesk_image_text_three) values ('2', '1', 'Вопрос!', 'Расширенный ответ', 'Краткий ответ', '', '0', '', '', '');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists faqdesk_reviews_description;
create table faqdesk_reviews_description (
  reviews_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  reviews_text text ,
  PRIMARY KEY (reviews_id, languages_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists faqdesk_to_categories;
create table faqdesk_to_categories (
  faqdesk_id int(11) default '0' not null ,
  categories_id int(11) default '0' not null ,
  PRIMARY KEY (faqdesk_id, categories_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into featured (featured_id, products_id, featured_date_added, featured_last_modified, expires_date, date_status_change, status) values ('1', '1', '2004-08-12 17:15:19', NULL, '0000-00-00 00:00:00', NULL, '1');
drop table if exists geo_zones;
create table geo_zones (
  geo_zone_id int(11) not null auto_increment,
  geo_zone_name varchar(255) not null ,
  geo_zone_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (geo_zone_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) values ('1', 'Florida', 'Florida local sales tax zone', NULL, '2003-07-17 10:29:23');
drop table if exists languages;
create table languages (
  languages_id int(11) not null auto_increment,
  name varchar(255) not null ,
  code char(2) not null ,
  image varchar(64) ,
  directory varchar(255) ,
  sort_order int(3) ,
  PRIMARY KEY (languages_id),
  KEY IDX_LANGUAGES_NAME (name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into languages (languages_id, name, code, image, directory, sort_order) values ('1', 'Русский', 'ru', 'icon.gif', 'russian', '1');
insert into languages (languages_id, name, code, image, directory, sort_order) values ('2', 'English', 'en', 'icon.gif', 'english', '2');
drop table if exists latest_news;
create table latest_news (
  news_id int(11) not null auto_increment,
  headline varchar(255) not null ,
  content text ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  status tinyint(1) default '0' not null ,
  PRIMARY KEY (news_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into link_categories (link_categories_id, link_categories_image, link_categories_sort_order, link_categories_date_added, link_categories_last_modified, link_categories_status) values ('1', NULL, '1', '2004-11-02 12:43:25', NULL, '1');
drop table if exists link_categories_description;
create table link_categories_description (
  link_categories_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  link_categories_name varchar(255) not null ,
  link_categories_description text ,
  PRIMARY KEY (link_categories_id, language_id),
  KEY idx_link_categories_name (link_categories_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into link_categories_description (link_categories_id, language_id, link_categories_name, link_categories_description) values ('1', '1', 'Категория', 'Описание категории');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into links (links_id, links_url, links_reciprocal_url, links_image_url, links_contact_name, links_contact_email, links_date_added, links_last_modified, links_status, links_clicked, links_rating) values ('1', 'http://forum.oscommerce.ru', 'http://test.loc', '', 'Александр Меновщиков', 'orders@kypi.ru', '2004-11-02 12:45:04', NULL, '2', '1', '0');
drop table if exists links_description;
create table links_description (
  links_id int(11) not null auto_increment,
  language_id int(11) default '1' not null ,
  links_title varchar(64) not null ,
  links_description text ,
  PRIMARY KEY (links_id, language_id),
  KEY links_title (links_title)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into links_description (links_id, language_id, links_title, links_description) values ('1', '1', 'Форум osCommerce по-русски', 'Форум поддержки пользователей osCommerce!');
drop table if exists links_status;
create table links_status (
  links_status_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  links_status_name varchar(255) not null ,
  PRIMARY KEY (links_status_id, language_id),
  KEY idx_links_status_name (links_status_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into links_status (links_status_id, language_id, links_status_name) values ('1', '1', 'Ожидает проверки');
insert into links_status (links_status_id, language_id, links_status_name) values ('2', '1', 'Проверена');
insert into links_status (links_status_id, language_id, links_status_name) values ('3', '1', 'Неактивна');
insert into links_status (links_status_id, language_id, links_status_name) values ('1', '2', 'Pending');
insert into links_status (links_status_id, language_id, links_status_name) values ('2', '2', 'Checked');
insert into links_status (links_status_id, language_id, links_status_name) values ('3', '2', 'Inactive');
drop table if exists links_to_link_categories;
create table links_to_link_categories (
  links_id int(11) default '0' not null ,
  link_categories_id int(11) default '0' not null ,
  PRIMARY KEY (links_id, link_categories_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists manufacturers;
create table manufacturers (
  manufacturers_id int(11) not null auto_increment,
  manufacturers_image varchar(64) ,
  date_added datetime ,
  last_modified datetime ,
  PRIMARY KEY (manufacturers_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('5', '1', 'Пример2', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('4', '1', 'Пример1', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('6', '1', 'Пример3', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('7', '1', 'Пример4', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('8', '1', 'Пример5', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('9', '1', 'Пример6', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('4', '2', 'Пример1', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('5', '2', 'Пример2', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('6', '2', 'Пример3', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('7', '2', 'Пример4', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('8', '2', 'Пример5', '', '', '', '', '', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_description, manufacturers_meta_title, manufacturers_meta_keywords, manufacturers_meta_description, manufacturers_url, url_clicked, date_last_click) values ('9', '2', 'Пример6', '', '', '', '', '', '0', NULL);
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into newsdesk_categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified, catagory_status) values ('2', NULL, '0', '0', '2005-06-22 17:57:23', NULL, '1');
drop table if exists newsdesk_categories_description;
create table newsdesk_categories_description (
  categories_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  categories_name varchar(255) not null ,
  PRIMARY KEY (categories_id, language_id),
  KEY idx_categories_name (categories_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into newsdesk_categories_description (categories_id, language_id, categories_name) values ('2', '1', 'Тест');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1', 'Новостей на одной странице', 'MAX_DISPLAY_NEWSDESK_SEARCH_RESULTS', '20', 'Сколько новостей показывать на одной странице?', '1', '1', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('2', 'Ссылок на страницы', 'MAX_DISPLAY_NEWSDESK_PAGE_LINKS', '5', 'Количество ссылок на другие страницы.', '1', '2', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('3', 'Показывать поле заголовок', 'NEWSDESK_ARTICLE_NAME', '1', 'Показывать поле заголовок при просмотре новостей? (0=не показывать; 1=показывать)', '1', '3', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('4', 'Показывать поле кратко', 'NEWSDESK_ARTICLE_SHORTTEXT', '1', 'Показывать поле кратко при просмотре новостей? (0=не показывать; 1=показывать)', '1', '4', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('5', 'Показывать поле содержание', 'NEWSDESK_ARTICLE_DESCRIPTION', '1', 'Показывать поле содержание при просмотре новостей? (0=не показывать; 1=показывать)', '1', '5', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('6', 'Показывать дату', 'NEWSDESK_DATE_AVAILABLE', '1', 'Показывать дату при просмотре новостей? (0=не показывать; 1=показывать)', '1', '6', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('7', 'Показывать URL ссылку', 'NEWSDESK_ARTICLE_URL', '1', 'Показывать URL ссылку при просмотре новостей? (0=не показывать; 1=показывать)', '1', '7', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('8', 'Показывать статус', 'NEWSDESK_STATUS', '1', 'Показывать статус при просмотре новостей? (0=не показывать; 1=показывать)', '1', '8', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('9', 'Показывать картинку', 'NEWSDESK_IMAGE', '1', 'Показывать картинку 1 при просмотре новостей? (0=не показывать; 1=показывать)', '1', '9', '2003-03-03 23:06:46', '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('10', 'Показывать картинку 2', 'NEWSDESK_IMAGE_TWO', '1', 'Показывать картинку 2 при просмотре новостей? (0=не показывать; 1=показывать)', '1', '10', '2003-03-03 23:06:46', '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('11', 'Показывать картинку 3', 'NEWSDESK_IMAGE_THREE', '1', 'Показывать картинку 3 при просмотре новостей? (0=не показывать; 1=показывать)', '1', '11', '2003-03-03 23:06:46', '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('12', 'Расположение навигации Следующая/Предыдущая страница', 'NEWSDESK_PREV_NEXT_BAR_LOCATION', '3', 'Расположение навигации Следующая/Предыдущая страница<br><br>top - верх<br>bottom - низ<br>both - (верх+низ)', '1', '12', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('14', 'Новостей на главной странице', 'MAX_DISPLAY_NEWSDESK_NEWS', '3', 'Сколько новостей показывать на главной странице?', '2', '1', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('15', 'Новостей в боксе последние новости', 'LATEST_DISPLAY_NEWSDESK_NEWS', '5', 'Сколько новостей показывать в боксе последние новости?', '2', '2', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('16', 'Показывать бокс последние новости', 'DISPLAY_LATEST_NEWS_BOX', '1', 'Показывать бокс свежие новости? (0=не показывать; 1=показывать)', '2', '3', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('17', 'Показывать бокс категории новостей', 'DISPLAY_NEWS_CATAGORY_BOX', '1', 'Показывать бокс категории новостей? (0=не показывать; 1=показывать)', '2', '4', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('18', 'Показывать счётчик просмотров', 'DISPLAY_NEWSDESK_VIEWCOUNT', '1', 'Показывать счётчик количества просмотров новостей? (0=не показывать; 1=показывать)', '2', '5', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('19', 'Показывать ссылку подробнее', 'DISPLAY_NEWSDESK_READMORE', '1', 'Показывать ссылку подробнее? (0=не показывать; 1=показывать)', '2', '6', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('20', 'Показывать краткое содержание новости', 'DISPLAY_NEWSDESK_SUMMARY', '1', 'Показывать краткое содержание новости? (0=не показывать; 1=показывать)', '2', '7', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('21', 'Показывать заголовок новости', 'DISPLAY_NEWSDESK_HEADLINE', '1', 'Показывать заголовок новости? (0=не показывать; 1=показывать)', '2', '8', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('22', 'Показывать дату', 'DISPLAY_NEWSDESK_DATE', '1', 'Показывать дату добавления новости? (0=не показывать; 1=показывать)', '2', '9', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('23', 'Показывать картинку 1', 'DISPLAY_NEWSDESK_IMAGE', '1', 'Показывать картинку 1 новости? (0=не показывать; 1=показывать)', '2', '10', NULL, '2003-03-03 11:59:47', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('24', 'Показывать картинку 2', 'DISPLAY_NEWSDESK_IMAGE_TWO', '1', 'Показывать картинку 2 новости? (0=не показывать; 1=показывать)', '2', '11', '2003-03-03 12:08:55', '2003-03-03 11:59:47', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('25', 'Показывать картинку 3', 'DISPLAY_NEWSDESK_IMAGE_THREE', '1', 'Показывать картинку 3 новости? (0=не показывать; 1=показывать)', '2', '12', '2003-03-03 12:09:16', '2003-03-03 11:59:47', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('26', 'Показывать отзывы', 'DISPLAY_NEWSDESK_REVIEWS', '1', 'Показывать отзывы? (0=не показывать; 1=показывать)', '3', '1', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('27', 'Максимальное количество новых отзывов', 'MAX_DISPLAY_NEW_REVIEWS', '10', 'Максимальное количество выводимых новых отзывов.', '3', '2', NULL, '2003-02-16 02:08:36', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('28', 'Показывать поле заголовок', 'STICKY_ARTICLE_NAME', '1', 'Показывать заголовок новости? (0=не показывать; 1=показывать)', '4', '1', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('29', 'Показывать поле кратко', 'STICKY_ARTICLE_SHORTTEXT', '1', 'Показывать поле кратко? (0=не показывать; 1=показывать)', '4', '2', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('30', 'Показывать содержание', 'STICKY_ARTICLE_DESCRIPTION', '1', 'Показывать содержание новости? (0=не показывать; 1=показывать)', '4', '3', '2003-03-02 00:49:34', '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('31', 'Показывать счётчик просмотров', 'STICKY_NEWSDESK_VIEWCOUNT', '1', 'Показывать счётчик просмотров новости? (0=не показывать; 1=показывать)', '4', '4', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('32', 'Показывать ссылку подробнее', 'STICKY_NEWSDESK_READMORE', '1', 'Показывать ссылку подробнее? (0=не показывать; 1=показывать)', '4', '5', NULL, '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('33', 'Показывать дату', 'STICKY_DATE_ADDED', '1', 'Показывать дату добавления новости? (0=не показывать; 1=показывать)', '4', '6', '2003-03-02 00:49:54', '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('34', 'Показывать URL ссылку', 'STICKY_ARTICLE_URL', '1', 'Показывать URL ссылку новости? (0=не показывать; 1=показывать)', '4', '7', '2003-03-02 00:50:28', '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('35', 'Показывать картинку', 'STICKY_IMAGE', '1', 'Показывать картинку 1 новости? (0=не показывать; 1=показывать)', '4', '8', '2003-03-02 00:50:14', '2003-03-02 00:47:21', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('36', 'Показывать картинку 2', 'STICKY_IMAGE_TWO', '1', 'Показывать картинку 2 новости? (0=не показывать; 1=показывать)', '4', '9', NULL, '2003-03-03 23:10:34', NULL, NULL);
insert into newsdesk_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('37', 'Показывать картинку 3', 'STICKY_IMAGE_THREE', '1', 'Показывать картинку 3 новости? (0=не показывать; 1=показывать)', '4', '10', NULL, '2003-03-03 23:10:34', NULL, NULL);
drop table if exists newsdesk_configuration_group;
create table newsdesk_configuration_group (
  configuration_group_id int(11) not null auto_increment,
  configuration_group_key varchar(255) not null ,
  configuration_group_title varchar(64) not null ,
  configuration_group_description varchar(255) not null ,
  sort_order int(5) ,
  visible int(1) default '1' ,
  PRIMARY KEY (configuration_group_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into newsdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('1', 'NEWSDESK_LISTING_DB', 'Настройка вывода', 'Настройка вывода новостей на странице', '1', '1');
insert into newsdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('2', 'NEWSDESK_SETTINGS_DB', 'Общие настройки', 'Общие настройки модуля', '1', '1');
insert into newsdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('3', 'NEWSDESK_REVIEWS_DB', 'Настройка отзывов', 'Настройка отзывов', '1', '1');
insert into newsdesk_configuration_group (configuration_group_id, configuration_group_key, configuration_group_title, configuration_group_description, sort_order, visible) values ('4', 'NEWSDESK_STICKY_DB', 'Настройка \"горячих\" новостей', 'Настройка \"горячих\" новостей', '1', '1');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into newsdesk_description (newsdesk_id, language_id, newsdesk_article_name, newsdesk_article_description, newsdesk_article_shorttext, newsdesk_article_url, newsdesk_article_viewed, newsdesk_image_text, newsdesk_image_text_two, newsdesk_image_text_three) values ('2', '1', 'Пример новости!', 'Подробно', 'Кратко', '', '0', '', '', '');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists newsdesk_reviews_description;
create table newsdesk_reviews_description (
  reviews_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  reviews_text text ,
  PRIMARY KEY (reviews_id, languages_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists newsdesk_to_categories;
create table newsdesk_to_categories (
  newsdesk_id int(11) default '0' not null ,
  categories_id int(11) default '0' not null ,
  PRIMARY KEY (newsdesk_id, categories_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists orders;
create table orders (
  orders_id int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  customers_groups_id int(11) default '0' not null ,
  customers_name varchar(64) not null ,
  customers_company varchar(255) ,
  customers_street_address varchar(64) not null ,
  customers_suburb varchar(255) ,
  customers_city varchar(255) not null ,
  customers_postcode varchar(10) not null ,
  customers_state varchar(255) ,
  customers_country varchar(255) not null ,
  customers_telephone varchar(255) not null ,
  customers_email_address varchar(96) not null ,
  customers_address_format_id int(5) default '0' not null ,
  delivery_name varchar(64) not null ,
  delivery_company varchar(255) ,
  delivery_street_address varchar(64) not null ,
  delivery_suburb varchar(255) ,
  delivery_city varchar(255) not null ,
  delivery_postcode varchar(10) not null ,
  delivery_state varchar(255) ,
  delivery_country varchar(255) not null ,
  delivery_address_format_id int(5) default '0' not null ,
  billing_name varchar(64) not null ,
  billing_company varchar(255) ,
  billing_street_address varchar(64) not null ,
  billing_suburb varchar(255) ,
  billing_city varchar(255) not null ,
  billing_postcode varchar(10) not null ,
  billing_state varchar(255) ,
  billing_country varchar(255) not null ,
  billing_address_format_id int(5) default '0' not null ,
  payment_method varchar(255) not null ,
  payment_info text ,
  cc_type varchar(20) ,
  cc_owner varchar(64) ,
  cc_number varchar(255) ,
  cc_expires varchar(4) ,
  last_modified datetime ,
  date_purchased datetime ,
  orders_status int(5) default '0' not null ,
  orders_date_finished datetime ,
  currency char(3) ,
  currency_value decimal(14,6) ,
  customers_referer_url varchar(255) ,
  customers_fax varchar(255) not null ,
  shipping_module varchar(255) ,
  PRIMARY KEY (orders_id),
  KEY idx_orders_customers_id (customers_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists orders_products_attributes;
create table orders_products_attributes (
  orders_products_attributes_id int(11) not null auto_increment,
  orders_id int(11) default '0' not null ,
  orders_products_id int(11) default '0' not null ,
  products_options varchar(255) not null ,
  products_options_values text not null ,
  options_values_price decimal(15,4) default '0.0000' not null ,
  price_prefix char(1) not null ,
  PRIMARY KEY (orders_products_attributes_id),
  KEY idx_orders_products_att_orders_id (orders_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists orders_status;
create table orders_status (
  orders_status_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  orders_status_name varchar(255) not null ,
  PRIMARY KEY (orders_status_id, language_id),
  KEY idx_orders_status_name (orders_status_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into orders_status (orders_status_id, language_id, orders_status_name) values ('1', '1', 'Ожидает проверки');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('2', '1', 'Ждём оплаты');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('3', '1', 'Выполняется');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('4', '1', 'Доставляется');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('5', '1', 'Доставлен');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('6', '1', 'Отменён');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists orders_total;
create table orders_total (
  orders_total_id int(10) unsigned not null auto_increment,
  orders_id int(11) default '0' not null ,
  title varchar(255) not null ,
  text varchar(255) not null ,
  value decimal(15,4) default '0.0000' not null ,
  class varchar(255) not null ,
  sort_order int(11) default '0' not null ,
  PRIMARY KEY (orders_total_id),
  KEY idx_orders_total_orders_id (orders_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('2', '2', 'Shipping and returns', 'Put here your shipping and returns', '1');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('3', '1', 'Безопасность', '<b>Секретность, которую мы гарантируем.</b><br><br>

Вся конфиденциальная  информация, которой мы обмениваемся со своими клиентами, содержащая такие данные, как например, 
персональную и финансовую информацию, сведения о кредитных карточках и другие данные предусматривающие строго ограниченный 
доступ, в обязательном порядке передаются в зашифрованном виде, с использованием протокола SSL, гарантирующего максимальную 
секретность и безопасность.<br>
Мы гарантируем секретность всей конфиденциальной информации поступающей от клиентов. Мы так же гарантируем, что эта информация 
не будет доступна или передана кому либо другому, включая частных лиц и организации. <br>
<br>
 Безопасность обеспеченная сервером SSL.<br><br>
Мы применяем 128-битовую кодировку информации на сервере SSL, в соответствии со стандартами USA. Это наивысший стандарт, 
применяемый для обеспечения шифрования информации в Интернет. Примечание: Правительство Соединенных Штатов ограничивает 
продажу таких систем шифрования за пределы США.
Наш сервер размещен в США, и благодаря нашим Американским партнерам, мы смогли обеспечить Вашу Интернет безопасность на самом 
высоком мировом уровне.<br>
<br>
Сервер SSL.<br>
Протокол SSL (Secure Sockets Layer) кодирует все данные передающиеся через Интернет между клиентом и сервером. Эта система гарантирует 
передачу информации только между клиентами подключенными друг к другу через этот протокол, и  доступ к данным или перехват и 
использование информации третьими лицами невозможен.<br>', '0');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('2', '1', 'Доставка и возврат', 'Для выполнения вашего заказа, нам необходимо минимальное 
  время на его обработку.<br> Как правило, минимальное время составляет 24 часа, а 
  в некоторых случаях оно может увеличиться из за того, что заказ поступил например 
  ночью или в выходные и праздничные дни.<br>

  Поэтому, мы просим Вас делать свои заказы заблаговременно.<br> Дайте нам пожалуйста 
  приблизительно 1-4 рабочих дня, чтобы мы могли подготовить и отправить, а Вы 
  могли получить Ваш заказ в кротчайший срок.</p>
  <br>
  Приобретение и гарантия возврата:<br>
  Благодарим Вас за покупки в нашем интернет магазине. Следующая информация оговаривает 
  условия приобретений и гарантии возврата.<br>
  <br>
  Оплата:<br>

  Для всех приобретений, сделанных на нашем сайте, оплата может быть произведена 
  с помощью системы WebMoney, либо банковским переводом на наш счет.<br>
  <br>
  Обмен товара или денежное возмещение:<br>
  Вы можете отказаться от поставленного нами товара, в случае, если доставленный 
  товар не соответствует тому, что вы заказывали и товар может быть возвращен 
  непосредственно в момент доставки. Товар должен быть возвращен в своей оригинальной упаковке с сопровождающими посылку документами. <br>
  Если у вас есть любые вопросы, пожалуйста, свяжитесь с нашим отделом обслуживания', '0');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('3', '2', 'Privacy', 'Put here your Privacy info', '1');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('4', '1', 'Условия и гарантии', 'Условия предоставления услуг. (Online agreement.)<br><br>

ИНТЕРНЕТ МАГАЗИН <b>Название магазина</b><br>
   Нижеизложенное является условиями соглашения между Название магазина (в дальнейшем \"Компания\") и покупателем (\"Покупатель\") о приобретении товаров или услуг, через Интернет Сайт Компании (\"Сайт\"). Если Вы не соглашаетесь с этими условиями, Вы не сможете приобрести наши товары и услуги, поэтому просмотрите пожалуйста внимательно эти условия до совершения покупок:<br><br>
1. Введение.<br> Покупатель соглашается с условиями, оговоренными в этом Соглашении сторон (\"Соглашение\"), со всем, что касается товаров, услуг и информации предоставляемых через Сайт. Это Соглашение представляет собой договор между Компанией и Покупателем, и заменяет любые предшествующие или иные соглашения, договора и гарантии, и оговаривает все, что касается товаров, услуг и информации предоставленных посредством Сайта. Покупатель соглашается просмотреть и признать это Соглашение до покупки товаров или услуг на Сайте.<br><br>
2. Информация для Платежа.<br>Покупатель понимает и гарантирует, что поданная им информация о кредитной карточке истинная, правильная и полная. Оплата товаров и услуг осуществленная Покупателем, будет принята компанией кредитной карточки Покупателя и Покупатель обязан заплатить стоимость приобретения товаров и услуг, а так же стоимость доставки товаров в сумме, предъявленной на момент оплаты, включая все прилагаемые налоги. Покупатель должен быть ответственным за все оплаты, проведенные с использованием пароля Покупателя. Покупатель соглашается держать его или ее пароль конфиденциально и уведомлять Компанию в пределах 24 часов о любом несанкционированном использовании пароля или нарушении этого Соглашения. Компания не защищает Покупателя от несанкционированного использования пароля Покупателя. Максимальная стоимость одной сделки реализовалной между Покупателем и Компанией не может превысить сумму равную $10,000 США.<br><br>
3. Авторское Право.<br> Содержание Сайта защищено авторскими правами, включая прилагаемые торговые марки и прочее, (включая, но, не ограничиваясь интеллектуальной собственностью). Организация, сбор, компиляция, магнитный перевод, цифровое преобразование и другие действия, связанные с использованием материалов, а так же копирование, перераспределение, использование или публикация Покупателем полного содержания или любой части Сайта, запрещено.<br><br>

4. Редактирование, удаление и модификация.<br> Компания резервирует за собой эксклюзивное право на редактирование, удаление или установку на Сайте любой информации, а так же удаление или установку любых товаров и услуг для продажи. Компания может модифицировать это Соглашение, или цены на товары и услуги, с уведомлением об этом Покупателя, если это оговорено в Соглашении о предоставлении Услуг, и может прекратить функционирование или модифицировать любые или все разделы Сайта по своему собственному усмотрению и без предварительного уведомления. Модификация этого Соглашения будет считаться действительной после публикации его на Сайте, и относиться к сделкам, заключенным после даты публикации.<br><br>
5. Право отказа. <br>Компания резервирует за собой право по своему собственному усмотрению, прекратить продажу товаров и предоставление услуг, а также регулировать доступ к покупке любых товаров или услуг.<br><br>
6. Возмещение.<br> Покупатель соглашается возмещать, защищать и поддерживать позицию Компании и ее поставщиков, партнеров и лицензиаров в безопасности от любой ответственности, убытков, претензий и расходов, включая разумные адвокатские гонорары, связанные с нарушением Покупателем этого Контракта или использованием Сайта.<br><br>
7. Ограничение передачи прав другому лицу.<br> Право Покупателя использовать Услугу, является его личным правом и не подлежит передаче другому лицу или организации и регулируется пределами и условиями установленным Компанией или Компанией кредитной карточки Покупателя.<br><br>
8. Ограниченная ответственность.<br> ПРЕДОСТАВЛЯЕМЫЕ ТОВАРЫ И УСЛУГИ, СОДЕРЖАНИЕ, А ТАК ЖЕ УСЛУГИ ПРЕДОСТАВЛЯЕМЫЕ ЧЕРЕЗ ДРУГИЕ УСЛУГИ ПРЕДУСМОТРЕНЫ \"КАК ЕСТЬ\" И \"КАК ДОСТУПНО\" И ВСЕ ГАРАНТИИ, ЯВНЫЕ ИЛИ НЕЯВНЫЕ, ОТРИЦАЕМЫ (ВКЛЮЧАЯ, НО НЕ ОГРАНИЧИВАЯСЬ ОТКАЗОМ ОТ ЛЮБЫХ НЕЯВНЫХ ГАРАНТИЙ КОММЕРЧЕСКОЙ ЦЕННОСТИ И ПРИГОДНОСТИ ДЛЯ КОНКРЕТНОЙ ЦЕЛИ). ЕДИНСТВЕННАЯ И ЦЕЛАЯ МАКСИМАЛЬНАЯ ОТВЕТСТВЕННОСТЬ КОМПАНИИ ПО ЛЮБОЙ ПРИЧИНЕ ПЕРЕД ПОКУПАТЕЛЕМ ЕДИНАЯ И ЕДИНСТВЕННАЯ КОМПЕНСАЦИЯ ПО ЛЮБОЙ ПРИЧИНЕ, БУДЕТ ОГРАНИЧЕНА СУММОЙ УПЛАЧЕННОЙ КЛИЕНТОМ ДЛЯ ПРИОБРЕТЕННЫХ КОНКРЕТНЫХ ТОВАРОВ ИЛИ УСЛУГ. КОМПАНИЯ И ЛЮБЫЕ ИЗ ЕЕ ПАРТНЕРОВ, ДИЛЕРОВ ИЛИ ПОСТАВЩИКОВ НЕ ОТВЕТСТВЕННЫ ЗА ЛЮБОЙ КОСВЕННЫЙ, СПЕЦИАЛЬНЫЙ, СЛУЧАЙНЫЙ, ИЛИ ПОСЛЕДУЮЩИЙ УЩЕРБ, (ВКЛЮЧАЯ УЩЕРБ И УБЫТКИ В БИЗНЕСЕ, УМЕНЬШЕНИЕ ДОХОДА, СУДЕБНЫЕ ДЕЛА, ИЛИ ПОДОБНЫЕ РАСХОДЫ УБЫТКИ И ЗАТРАТЫ), НЕЗАВИСИМО ОТ ТОГО, ЧТО ОНИ БАЗИРОВАЛИСЬ НА НАРУШЕНИИ КОНТРАКТА, НАРУШЕНИИ ГАРАНТИИ, НЕБРЕЖНОСТИ (ВКЛЮЧАЯ ХАЛАТНОСТЬ), В РЕЗУЛЬТАТЕ ИСПОЛЬЗОВАНИЯ ПРОДУКТА ИЛИ УСЛУГИ ИЛИ ИНЫМ СПОСОБОМ, ДАЖЕ ЕСЛИ ПРЕДВАРИТЕЛЬНО БЫЛО СООБЩЕНО О ВОЗМОЖНОСТИ ТАКОГО УЩЕРБА. ОГРАНИЧЕНИЯ УЩЕРБА ИЗЛОЖЕННЫЕ ВЫШЕ - ФУНДАМЕНТАЛЬНЫЕ ЭЛЕМЕНТЫ ОСНОВЫ СДЕЛКИ МЕЖДУ КОМПАНИЕЙ И ПОКУПАТЕЛЕМ. ЭТОТ САЙТ, ТОВАРЫ И УСЛУГИ НЕ ДОЛЖНЫ РАССМАТРИВАТЬСЯ БЕЗ ТАКИХ ОГРАНИЧЕНИЙ. НЕКОТОРЫЕ ГОСУДАРСТВЕННЫЕ ЗАКОНЫ МОГУТ БЫТЬ ПРИМЕНЕНЫ ОТНОСИТЕЛЬНО ОГРАНИЧЕНИЯ ОТВЕТСТВЕННОСТИ. ЛЮБЫЕ ВОЗМОЖНЫЕ СУДЕБНЫЕ РАЗБИРАТЕЛЬСТВА ОСУЩЕСТВЛЯЮТСЯ В СУДЕ РОССИЙСКОЙ ФЕДЕРАЦИИ.<br><br>

9. Использование Информации.<br> Компания резервирует право, и Покупатель уполномочивает Компанию, на использование по назначению всей информации относительно использования Покупателем Сайта и всей информации предоставленной Покупателем, согласно действующим законам.<br><br>
10. Прочее.<br> Это Соглашение должно рассматриваться в том виде, как оно опубликовано Название магазина, и должно применяться и толковаться в соответствии с законами Российской Федерации. Любые действия Покупателя, касающийся его претензий должны производиться в течение шести месяцев (6) после любого приобретения осуществленного на Сайте или покупатель навсегда отказываться от своих претензий. Все действия должны производиться в рамках ограничений, изложенных в Разделе 8. Содержание этого Соглашения должно быть изложено и понято таким образом, что его смысл одинаково равнозначен для обеих сторон. Если любая из частей этого Соглашения будет признана неправильной или неосуществимой, эта часть должна быть приведена в соответствие с законом таким образом, чтобы отразить исходные намерения и интересы обеих сторон. Остальные части должны оставаться в полной силе и действии. В случае, если что-либо связанное с Сайтом или Компанией, вступает в конфликт или противоречие с этим Соглашением, это Соглашение является приоритетным. Неудача Компании в осуществлении любого предоставления этого Соглашения Покупателю не должна считаться освобождением от такого предоставления или освобождением от права осуществлять такое предоставление.', '0');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('4', '2', 'Conditions of Use', 'Put here your Conditions of Use information.', '1');
insert into pages_description (pages_id, language_id, pages_name, pages_description, pages_viewed) values ('5', '1', 'Сертификаты', '<b>Как купить сертификат?</b><br/>
Сертификаты покупаются так же, как и обычный товар, т.е. Вам необходимо положить сертификат в корзину и оформить заказ, всё! После того как мы получим оплату, Ваш сертификат будет активизирован и Вы сможете совершать покупки с помощью своего сертификата, либо подарить свой сертификат своим близким или знакомым. После активизации сертификата, Вы получите уведомление на свой Email адрес.<br/>
<br/>
<b>Как отправить сертификат кому-либо ещё?</b><br/>
Вам будет предложено отправить оставшуюся сумму на сертификате после оформления заказа, необходимо будте заполнить предложенную форму и нажать кнопку \"Продолжить\".<br/>
<br/>
<b>Зачем нужен сертификат?</b><br/>
Сертификат может быть использован для полной или частичной оплаты заказа (в зависимости от суммы сертификата), оформленного в нашем интернет-магазине, причём остаток средств на сертификате не сгорает, оставшиеся деньги можно использовать в дальнеишем для совершения покупок в нашем интернет-магазине, кроме того, Вы можете подарить свой сертификат своим близким и знакомым.<br/>
<br/>
<b>Как использовать сертификат при оформлении заказа?</b><br/>
В процессе оформления заказа в нашем интернет-магазине Вам будет предложено воспользоваться сертификатом.<br/>
<br/>
<b>Что делать, если возникают проблемы, вопросы при использовании сертификатов?</b><br/>
Если у Вас появились проблемы, либо вопросы при использовании сертификатов, используйте ссылку Свяжитесь с нами в боксе Информация. Мы ответим на все Ваши вопросы в короткие сроки.<br/>
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists phesis_poll_check;
create table phesis_poll_check (
  ip varchar(20) not null ,
  time varchar(14) not null ,
  pollID int(10) default '0' not null 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into phesis_poll_config (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, last_modified, date_added) values ('1', 'Какой опрос показывать', 'DISPLAY_POLL_HOW', '2', 'Какие опросы показывать в боксе.<br>0 = Случайный<br>1 = Самый последний<br>2 = Самый популярный<br>3 = Указанный ниже опрос в поле ID Опроса', '2001-12-08 18:22:30', '2001-12-07 16:56:23');
insert into phesis_poll_config (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, last_modified, date_added) values ('2', 'ID Опроса', 'DISPLAY_POLL_ID', '', 'Если Вы в переменной Показывать опрос указали 3, то здесь необходимо указать ID код опроса, который будет показан.', '2001-12-08 18:22:30', '2001-12-07 16:56:23');
insert into phesis_poll_config (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, last_modified, date_added) values ('3', 'Разрешить отзывы', 'SHOW_POLL_COMMENTS', '1', 'Разрешить оставлять отзывы к опросу?<br>0 = Запретить<br>1 = Разрешить', '2003-04-06 16:19:43', '2001-12-07 16:58:09');
insert into phesis_poll_config (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, last_modified, date_added) values ('4', 'Показывать бокс опросов даже если нет опросов', 'SHOW_NOPOLL', '0', 'Показывать бокс опросов, даже если ни одного опроса на данный момент не проводится.<br>0 = Не показывать<br>1 = Показывать', '2004-09-08 14:41:20', '2001-12-07 19:36:33');
insert into phesis_poll_config (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, last_modified, date_added) values ('5', 'Разрешить голосовать несколько раз', 'POLL_SPAM', '0', 'Разрешить голосовать одному человеку несколько раз в одном и том же опросе.<br>0 = Не разрешать (рекомендуется)<br>1 = разрешить', '2001-12-07 20:20:26', '2001-12-07 20:20:26');
insert into phesis_poll_config (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, last_modified, date_added) values ('6', 'Количество отзывов на странице', 'MAX_DISPLAY_NEW_COMMENTS', '10', 'Максимальное количество отзывов на странице', '2001-12-07 20:20:26', '2001-12-07 20:20:26');
drop table if exists phesis_poll_data;
create table phesis_poll_data (
  pollID int(11) default '0' not null ,
  optionText varchar(255) not null ,
  optionCount int(11) default '0' not null ,
  voteID int(11) default '0' not null ,
  language_id int(11) default '1' not null 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', 'Не знаю', '0', '3', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', 'Копыта', '0', '2', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', 'Рога', '0', '1', '1');
insert into phesis_poll_data (pollID, optionText, optionCount, voteID, language_id) values ('4', 'Что лучше - рога или копыта?', '0', '0', '1');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
  products_weight decimal(5,3) default '0.000' not null ,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists products_attributes_download;
create table products_attributes_download (
  products_attributes_id int(11) default '0' not null ,
  products_attributes_filename varchar(255) not null ,
  products_attributes_maxdays int(2) default '0' ,
  products_attributes_maxcount int(2) default '0' ,
  PRIMARY KEY (products_attributes_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into products_description (products_id, language_id, products_name, products_description, products_tab_1, products_tab_2, products_tab_3, products_tab_4, products_tab_5, products_tab_6, products_url, products_viewed, products_head_title_tag, products_head_desc_tag, products_head_keywords_tag, products_info) values ('1', '1', 'Рога оленя', 'Рога оленя<br>
Самые лучшие, самые нужные, самые дешёвые.', '', '', '', '', '', '', '', '2', 'Рога оленя, здесь title тэг для товара', 'description', 'keywords', 'Краткое описание рогов.');
insert into products_description (products_id, language_id, products_name, products_description, products_tab_1, products_tab_2, products_tab_3, products_tab_4, products_tab_5, products_tab_6, products_url, products_viewed, products_head_title_tag, products_head_desc_tag, products_head_keywords_tag, products_info) values ('2', '1', 'Рога лося', 'Описание', '', '', '', '', '', '', '', '5', '', '', '', 'Дешевле не найдёте, лосиные рога всего за 20$.');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists products_notifications;
create table products_notifications (
  products_id int(11) default '0' not null ,
  customers_id int(11) default '0' not null ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (products_id, customers_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists products_options;
create table products_options (
  products_options_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  products_options_name varchar(255) not null ,
  products_options_sort_order int(4) default '0' not null ,
  products_options_type int(5) default '0' not null ,
  products_options_length smallint(2) default '32' not null ,
  products_options_comment varchar(255) ,
  products_options_images_enabled varchar(5) NOT NULL default 'false',
  PRIMARY KEY (products_options_id, language_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment,products_options_images_enabled) values ('1', '1', 'Размер', '0', '0', '32', NULL,'false');
insert into products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment,products_options_images_enabled) values ('1', '2', 'Size', '0', '0', '32', NULL,'false');
drop table if exists products_options_values;
create table products_options_values (
  products_options_values_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  products_options_values_name varchar(255) not null ,
  products_options_values_thumbnail varchar(255) NOT NULL default '',
  PRIMARY KEY (products_options_values_id, language_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into products_options_values (products_options_values_id, language_id, products_options_values_name,products_options_values_thumbnail) values ('3', '1', 'Маленькие','');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name,products_options_values_thumbnail) values ('2', '1', 'Средние','');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name,products_options_values_thumbnail) values ('1', '1', 'Большие','');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('16', '1', '3');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('15', '1', '2');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('14', '1', '1');
drop table if exists products_prop_options;
create table products_prop_options (
  products_options_id int(11) default '1' not null ,
  categories_options_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  products_options_name varchar(255) not null ,
  PRIMARY KEY (products_options_id, language_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists products_prop_options_values;
create table products_prop_options_values (
  products_options_values_id int(11) default '1' not null ,
  categories_options_values_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  products_options_values_name varchar(255) not null ,
  PRIMARY KEY (products_options_values_id, language_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists products_prop_options_values_to_products_prop_options;
create table products_prop_options_values_to_products_prop_options (
  products_options_values_to_products_options_id int(11) not null auto_increment,
  products_options_id int(11) default '0' not null ,
  products_options_values_id int(11) default '0' not null ,
  PRIMARY KEY (products_options_values_to_products_options_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists products_properties;
create table products_properties (
  products_attributes_id int(11) not null auto_increment,
  products_id int(11) default '0' not null ,
  categories_id int(11) default '0' not null ,
  options_id int(11) default '0' not null ,
  options_values_id int(11) default '0' not null ,
  sort_order tinyint(4) default '0' ,
  PRIMARY KEY (products_attributes_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists products_to_categories;
create table products_to_categories (
  products_id int(11) default '0' not null ,
  categories_id int(11) default '0' not null ,
  PRIMARY KEY (products_id, categories_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into products_to_categories (products_id, categories_id) values ('1', '28');
insert into products_to_categories (products_id, categories_id) values ('2', '28');
drop table if exists products_to_products_extra_fields;
create table products_to_products_extra_fields (
  products_id int(11) default '0' not null ,
  products_extra_fields_id int(11) default '0' not null ,
  products_extra_fields_value varchar(255) ,
  PRIMARY KEY (products_id, products_extra_fields_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists products_xsell;
create table products_xsell (
  ID int(10) not null auto_increment,
  products_id int(10) unsigned default '1' not null ,
  xsell_id int(10) unsigned default '1' not null ,
  sort_order int(10) unsigned default '1' not null ,
  PRIMARY KEY (ID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists reviews_description;
create table reviews_description (
  reviews_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  reviews_text text ,
  PRIMARY KEY (reviews_id, languages_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists scart;
create table scart (
  scartid int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  dateadded varchar(8) not null ,
  PRIMARY KEY (scartid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists search_queries;
create table search_queries (
  search_id int(11) not null auto_increment,
  search_text tinytext ,
  PRIMARY KEY (search_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists search_queries_sorted;
create table search_queries_sorted (
  search_id smallint(6) not null auto_increment,
  search_text tinytext ,
  search_count int(11) default '0' not null ,
  PRIMARY KEY (search_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists searchword_swap;
create table searchword_swap (
  sws_id mediumint(11) not null auto_increment,
  sws_word varchar(100) not null ,
  sws_replacement varchar(100) not null ,
  PRIMARY KEY (sws_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists sessions;
create table sessions (
  sesskey varchar(255) not null ,
  expiry int(11) unsigned default '0' not null ,
  value text ,
  PRIMARY KEY (sesskey)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists ship2pay;
create table ship2pay (
  s2p_id int(11) not null auto_increment,
  shipment varchar(100) not null ,
  payments_allowed varchar(250) not null ,
  zones_id int(11) default '0' not null ,
  status tinyint(4) default '0' not null ,
  PRIMARY KEY (s2p_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS persons;
CREATE TABLE persons (
  orders_id int(11) NOT NULL default '0',
  name varchar(255) default NULL,
  address varchar(255) default NULL,
  KEY orders_id(orders_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists special_product;
create table special_product (
  special_product_id int(11) unsigned NOT NULL auto_increment,
  special_id int(11) unsigned NOT NULL default '0',
  product_id int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (special_product_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists tax_class;
create table tax_class (
  tax_class_id int(11) not null auto_increment,
  tax_class_title varchar(255) not null ,
  tax_class_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (tax_class_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) values ('1', '1', '1', '1', '7.0000', 'FL TAX 7.0%', '2003-07-17 10:29:23', '2003-07-17 10:29:23');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into topics (topics_id, topics_image, parent_id, sort_order, date_added, last_modified) values ('2', NULL, '0', '0', '2005-06-22 17:54:37', NULL);
drop table if exists topics_description;
create table topics_description (
  topics_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  topics_name varchar(255) not null ,
  topics_heading_title varchar(64) ,
  topics_description text ,
  PRIMARY KEY (topics_id, language_id),
  KEY idx_topics_name (topics_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into topics_description (topics_id, language_id, topics_name, topics_heading_title, topics_description) values ('2', '1', 'Тест', '', '');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

drop table if exists zones;
create table zones (
  zone_id int(11) not null auto_increment,
  zone_country_id int(11) default '0' not null ,
  zone_code varchar(255) not null ,
  zone_name varchar(255) not null ,
  PRIMARY KEY (zone_id),
  KEY idx_zones_country_id (zone_country_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('298', '109', 'Акмолинская область', 'Акмолинская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('299', '109', 'Актюбинская область', 'Актюбинская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('300', '109', 'Алматинская область', 'Алматинская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('301', '109', 'Атырауская область', 'Атырауская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('302', '109', 'Восточно-Казахстанская область', 'Восточно-Казахстанская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('303', '109', 'Жамбылская область', 'Жамбылская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('304', '109', 'Западно-Казахстанская область', 'Западно-Казахстанская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('305', '109', 'Карагандинская область', 'Карагандинская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('306', '109', 'Кзылординская область', 'Кзылординская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('307', '109', 'Костанайская область', 'Костанайская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('308', '109', 'Мангистауская область', 'Мангистауская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('309', '109', 'Павлодарская область', 'Павлодарская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('310', '109', 'Северо-Казахстанская область', 'Северо-Казахстанская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('311', '109', 'Южно-Казахстанская область', 'Южно-Казахстанская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('312', '115', 'Баткенская область', 'Баткенская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('313', '115', 'Джалал-Абадская область', 'Джалал-Абадская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('314', '115', 'Иссык-Кульская область', 'Иссык-Кульская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('315', '115', 'Таласская область', 'Таласская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('316', '115', 'Нарынская область', 'Нарынская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('317', '115', 'Ошская область', 'Ошская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('318', '115', 'Чуйская область', 'Чуйская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('184', '176', 'Адыгея республика', 'Адыгея республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('185', '176', 'Башкортостан республика', 'Башкортостан республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('186', '176', 'Бурятия республика', 'Бурятия республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('187', '176', 'Алтай республика', 'Алтай республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('188', '176', 'Дагестан республика', 'Дагестан республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('189', '176', 'Ингушетия республика', 'Ингушетия республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('190', '176', 'Кабардино-Балкарская республика', 'Кабардино-Балкарская республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('191', '176', 'Калмыкия республика', 'Калмыкия республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('192', '176', 'Карачаево-Черкесская республика', 'Карачаево-Черкесская республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('193', '176', 'Карелия республика', 'Карелия республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('194', '176', 'Коми республика', 'Коми республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('195', '176', 'Марий Эл республика', 'Марий Эл республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('196', '176', 'Мордовия республика', 'Мордовия республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('197', '176', 'Саха (Якутия) республика', 'Саха (Якутия) республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('198', '176', 'Северная Осетия-Алания республика', 'Северная Осетия-Алания республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('199', '176', 'Татарстан республика', 'Татарстан республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('200', '176', 'Тыва республика', 'Тыва республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('201', '176', 'Удмуртская республика', 'Удмуртская республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('202', '176', 'Хакасия республика', 'Хакасия республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('203', '176', 'Чеченская республика', 'Чеченская республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('204', '176', 'Чувашская республика', 'Чувашская республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('205', '176', 'Алтайский край', 'Алтайский край');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('206', '176', 'Краснодарский край', 'Краснодарский край');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('207', '176', 'Красноярский край', 'Красноярский край');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('208', '176', 'Приморский край', 'Приморский край');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('209', '176', 'Ставропольский край', 'Ставропольский край');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('210', '176', 'Хабаровский край', 'Хабаровский край');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('211', '176', 'Амурская область', 'Амурская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('212', '176', 'Архангельская область', 'Архангельская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('213', '176', 'Астраханская область', 'Астраханская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('214', '176', 'Белгородская область', 'Белгородская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('215', '176', 'Брянская область', 'Брянская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('216', '176', 'Владимирская область', 'Владимирская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('217', '176', 'Волгоградская область', 'Волгоградская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('218', '176', 'Вологодская область', 'Вологодская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('219', '176', 'Воронежская область', 'Воронежская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('220', '176', 'Ивановская область', 'Ивановская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('221', '176', 'Иркутская область', 'Иркутская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('222', '176', 'Калининградская область', 'Калининградская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('223', '176', 'Калужская область', 'Калужская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('224', '176', 'Камчатский край', 'Камчатский край');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('225', '176', 'Кемеровская область', 'Кемеровская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('226', '176', 'Кировская область', 'Кировская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('227', '176', 'Костромская область', 'Костромская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('228', '176', 'Курганская область', 'Курганская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('229', '176', 'Курская область', 'Курская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('230', '176', 'Ленинградская область', 'Ленинградская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('231', '176', 'Липецкая область', 'Липецкая область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('232', '176', 'Магаданская область', 'Магаданская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('233', '176', 'Московская область', 'Московская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('234', '176', 'Мурманская область', 'Мурманская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('235', '176', 'Нижегородская область', 'Нижегородская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('236', '176', 'Новгородская область', 'Новгородская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('237', '176', 'Новосибирская область', 'Новосибирская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('238', '176', 'Омская область', 'Омская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('239', '176', 'Оренбургская область', 'Оренбургская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('240', '176', 'Орловская область', 'Орловская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('241', '176', 'Пензенская область', 'Пензенская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('242', '176', 'Пермский край', 'Пермский край');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('243', '176', 'Псковская область', 'Псковская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('244', '176', 'Ростовская область', 'Ростовская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('245', '176', 'Рязанская область', 'Рязанская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('246', '176', 'Самарская область', 'Самарская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('247', '176', 'Саратовская область', 'Саратовская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('248', '176', 'Сахалинская область', 'Сахалинская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('249', '176', 'Свердловская область', 'Свердловская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('250', '176', 'Смоленская область', 'Смоленская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('251', '176', 'Тамбовская область', 'Тамбовская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('252', '176', 'Тверская область', 'Тверская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('253', '176', 'Томская область', 'Томская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('254', '176', 'Тульская область', 'Тульская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('255', '176', 'Тюменская область', 'Тюменская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('256', '176', 'Ульяновская область', 'Ульяновская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('257', '176', 'Челябинская область', 'Челябинская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('258', '176', 'Забайкальский край', 'Забайкальский край');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('259', '176', 'Ярославская область', 'Ярославская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('260', '176', 'Москва', 'Москва');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('261', '176', 'Санкт-Петербург', 'Санкт-Петербург');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('262', '176', 'Еврейская автономная область', 'Еврейская автономная область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('270', '176', 'Чукотский автономный округ', 'Чукотский автономный округ');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('319', '207', 'Мухтори-Кухистони-Бадахшони', 'Мухтори-Кухистони-Бадахшони');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('320', '207', 'Хатлонская область', 'Хатлонская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('321', '207', 'Ленинабадская область', 'Ленинабадская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('322', '216', 'Ахал', 'Ахал');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('323', '216', 'Балкан', 'Балкан');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('324', '216', 'Дашховуз', 'Дашховуз');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('325', '216', 'Лебап', 'Лебап');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('326', '216', 'Мары', 'Мары');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('273', '220', 'Республика Крым', 'Республика Крым');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('274', '220', 'Винницкая область', 'Винницкая область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('275', '220', 'Волынская область', 'Волынская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('276', '220', 'Днепропетровская область', 'Днепропетровская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('277', '220', 'Донецкая область', 'Донецкая область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('278', '220', 'Житомирская область', 'Житомирская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('279', '220', 'Закарпатская область', 'Закарпатская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('280', '220', 'Запорожская область', 'Запорожская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('281', '220', 'Ивано-Франковская область', 'Ивано-Франковская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('282', '220', 'Киевская область', 'Киевская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('283', '220', 'Кировоградская область', 'Кировоградская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('284', '220', 'Луганская область', 'Луганская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('285', '220', 'Львовская область', 'Львовская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('286', '220', 'Николаевская область', 'Николаевская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('287', '220', 'Одесская область', 'Одесская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('288', '220', 'Полтавская область', 'Полтавская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('289', '220', 'Ровенская область', 'Ровенская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('290', '220', 'Сумская область', 'Сумская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('291', '220', 'Тернопольская область', 'Тернопольская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('292', '220', 'Харьковская область', 'Харьковская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('293', '220', 'Херсонская область', 'Херсонская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('294', '220', 'Хмельницкая область', 'Хмельницкая область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('295', '220', 'Черкасская область', 'Черкасская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('296', '220', 'Черниговская область', 'Черниговская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('297', '220', 'Черновицкая область', 'Черновицкая область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('327', '226', 'Андижанский', 'Андижанский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('328', '226', 'Бухарский', 'Бухарский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('329', '226', 'Джизакский', 'Джизакский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('330', '226', 'Каракалпакия', 'Каракалпакия');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('331', '226', 'Кашкадарьинский', 'Кашкадарьинский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('332', '226', 'Навоийский', 'Навоийский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('333', '226', 'Наманганский', 'Наманганский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('334', '226', 'Самаркандский', 'Самаркандский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('335', '226', 'Сурхандарьинский', 'Сурхандарьинский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('336', '226', 'Сырдарьинский', 'Сырдарьинский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('337', '226', 'Ташкентский', 'Ташкентский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('338', '226', 'Ферганский', 'Ферганский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('339', '226', 'Хорезмский', 'Хорезмский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('340', '15', 'Апшеронский район', 'Апшеронский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('341', '15', 'Агдамский район', 'Агдамский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('342', '15', 'Агдашский район', 'Агдашский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('343', '15', 'Агджабединский район', 'Агджабединский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('344', '15', 'Акстафинский район', 'Акстафинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('345', '15', 'Агсуинский район', 'Агсуинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('346', '15', 'Астаринский район', 'Астаринский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('347', '15', 'Балакенский район', 'Балакенский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('348', '15', 'Бейлаганский район', 'Бейлаганский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('349', '15', 'Бардинский район', 'Бардинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('350', '15', 'Билясуварский район', 'Билясуварский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('351', '15', 'Джебраильский район', 'Джебраильский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('352', '15', 'Джалилабадский район', 'Джалилабадский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('353', '15', 'Дашкесанский район', 'Дашкесанский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('354', '15', 'Дивичинский район', 'Дивичинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('355', '15', 'Физулинский район', 'Физулинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('356', '15', 'Кедабекский район', 'Кедабекский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('357', '15', 'Геранбойский район', 'Геранбойский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('358', '15', 'Геокчайский район', 'Геокчайский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('359', '15', 'Гаджигабульский район', 'Гаджигабульский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('360', '15', 'Хачмазский район', 'Хачмазский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('361', '15', 'Ханларский район', 'Ханларский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('362', '15', 'Хызынский район', 'Хызынский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('363', '15', 'Ходжавендский район', 'Ходжавендский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('364', '15', 'Ходжалинский район', 'Ходжалинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('365', '15', 'Имишлинский район', 'Имишлинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('366', '15', 'Исмаиллинский район', 'Исмаиллинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('367', '15', 'Кельбаджарский район', 'Кельбаджарский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('368', '15', 'Кюрдамирский район', 'Кюрдамирский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('369', '15', 'Гахский район', 'Гахский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('370', '15', 'Газахский район', 'Газахский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('371', '15', 'Габалинский район', 'Габалинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('372', '15', 'Гобустанский район', 'Гобустанский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('373', '15', 'Губинский район', 'Губинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('374', '15', 'Губадлинский район', 'Губадлинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('375', '15', 'Гусарский район', 'Гусарский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('376', '15', 'Лачинский район', 'Лачинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('377', '15', 'Ленкоранский район', 'Ленкоранский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('378', '15', 'Лерикский район', 'Лерикский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('379', '15', 'Масаллинский район', 'Масаллинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('380', '15', 'Нефтчалинский район', 'Нефтчалинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('381', '15', 'Огузский район', 'Огузский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('382', '15', 'Саатлинский район', 'Саатлинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('383', '15', 'Сабирабадский район', 'Сабирабадский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('384', '15', 'Сальянский район', 'Сальянский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('385', '15', 'Самухский район', 'Самухский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('386', '15', 'Сиязаньский район', 'Сиязаньский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('387', '15', 'Шемахинский район', 'Шемахинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('388', '15', 'Шемкирский район', 'Шемкирский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('389', '15', 'Шекинский район', 'Шекинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('390', '15', 'Шушинский район', 'Шушинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('391', '15', 'Тертерский район', 'Тертерский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('392', '15', 'Товузский район', 'Товузский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('393', '15', 'Уджарский район', 'Уджарский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('394', '15', 'Ярдымлинский район', 'Ярдымлинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('395', '15', 'Евлахский район', 'Евлахский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('396', '15', 'Закатальский район', 'Закатальский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('397', '15', 'Зангеланский район', 'Зангеланский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('398', '15', 'Зардабский район', 'Зардабский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('399', '15', 'Нахичеванская Автономная Республика', 'Нахичеванская Автономная Республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('400', '15', 'Бабекский район', 'Бабекский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('401', '15', 'Джульфинский район', 'Джульфинский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('402', '15', 'Ордубадский район', 'Ордубадский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('403', '15', 'Садаракский район', 'Садаракский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('404', '15', 'Шахбузский район', 'Шахбузский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('405', '15', 'Шарурский район', 'Шарурский район');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('406', '67', 'Харьюский уезд', 'Харьюский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('407', '67', 'Хийумааский уезд', 'Хийумааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('408', '67', 'Ида-Вирумааский уезд', 'Ида-Вирумааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('409', '67', 'Ярвамаамааский уезд', 'Ярвамаамааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('410', '67', 'Йыгевамааский уезд', 'Йыгевамааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('411', '67', 'Ляэнемааский уезд', 'Ляэнемааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('412', '67', 'Ляэне-Вирумааский уезд', 'Ляэне-Вирумааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('413', '67', 'Пылвамааский уезд', 'Пылвамааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('414', '67', 'Пярнумааский уезд', 'Пярнумааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('415', '67', 'Рапламааский уезд', 'Рапламааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('416', '67', 'Сааремааский уезд', 'Сааремааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('417', '67', 'Тартумааский уезд', 'Тартумааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('418', '67', 'Валгамааский уезд', 'Валгамааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('419', '67', 'Вильяндимааский уезд', 'Вильяндимааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('420', '67', 'Вырумааский уезд', 'Вырумааский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('421', '20', 'Витебская область', 'Витебская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('422', '20', 'Могилевская область', 'Могилевская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('423', '20', 'Минская область', 'Минская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('424', '20', 'Гродненская область', 'Гродненская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('425', '20', 'Гомельская область', 'Гомельская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('426', '20', 'Брестская область', 'Брестская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('427', '11', 'Область Арагацотн', 'Область Арагацотн');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('428', '11', 'Араратская область', 'Араратская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('429', '11', 'Армавирская область', 'Армавирская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('430', '11', 'Гегаркуникская область', 'Гегаркуникская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('431', '11', 'Ереван', 'Ереван');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('432', '11', 'Лорийская область', 'Лорийская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('433', '11', 'Котайкская область', 'Котайкская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('434', '11', 'Ширакская область', 'Ширакская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('435', '11', 'Сюникская область', 'Сюникская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('436', '11', 'Область Вайоц Дзор', 'Область Вайоц Дзор');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('437', '11', 'Тавушская область', 'Тавушская область');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('438', '80', 'Гурия', 'Гурия');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('439', '80', 'Имерети', 'Имерети');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('440', '80', 'Кахети', 'Кахети');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('441', '80', 'Квемо-Картли', 'Квемо-Картли');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('442', '80', 'Мцхета-Тианети', 'Мцхета-Тианети');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('443', '80', 'Рача-Лечхуми - Квемо Сванети', 'Рача-Лечхуми - Квемо Сванети');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('444', '80', 'Самегрело - Земо-Сванети', 'Самегрело - Земо-Сванети');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('445', '80', 'Самцхе-Джавахети', 'Самцхе-Джавахети');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('446', '80', 'Тбилиси', 'Тбилиси');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('447', '80', 'Шида - Картли', 'Шида - Картли');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('448', '80', 'Аджарская автономная республика', 'Аджарская автономная республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('449', '80', 'Абхазская автономная республика', 'Абхазская автономная республика');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('450', '80', 'Республика Южная Осетия', 'Республика Южная Осетия');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('451', '140', 'Балти', 'Балти');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('452', '140', 'Единет', 'Единет');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('453', '140', 'Кагул', 'Кагул');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('454', '140', 'Кишенёв', 'Кишенёв');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('455', '140', 'Лапушна', 'Лапушна');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('456', '140', 'Оргей', 'Оргей');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('457', '140', 'Сорока', 'Сорока');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('458', '140', 'Тараклия', 'Тараклия');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('459', '140', 'Тигина', 'Тигина');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('460', '140', 'Унгены', 'Унгены');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('461', '123', 'Алитусский уезд', 'Алитусский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('462', '123', 'Каунасский уезд', 'Каунасский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('463', '123', 'Kлайпедский уезд', 'Kлайпедский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('464', '123', 'Maриямпольский уезд', 'Maриямпольский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('465', '123', 'Панявежский уезд', 'Панявежский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('466', '123', 'Шяуляйский уезд', 'Шяуляйский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('467', '123', 'Таурагский уезд', 'Таурагский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('468', '123', 'Tяльшяйский уезд', 'Tяльшяйский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('469', '123', 'Утянский уезд', 'Утянский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('470', '123', 'Вильнюсский уезд', 'Вильнюсский уезд');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('471', '117', 'Айзкраульский', 'Айзкраульский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('472', '117', 'Алуксненский', 'Алуксненский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('473', '117', 'Балвский', 'Балвский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('474', '117', 'Баускский', 'Баускский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('475', '117', 'Валкаский', 'Валкаский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('476', '117', 'Валмиерский', 'Валмиерский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('477', '117', 'Вентспилсский', 'Вентспилсский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('478', '117', 'Гулбенеский', 'Гулбенеский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('479', '117', 'Даугавпилсский', 'Даугавпилсский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('480', '117', 'Добелеский', 'Добелеский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('481', '117', 'Екабпилсский', 'Екабпилсский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('482', '117', 'Елгавский', 'Елгавский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('483', '117', 'Краславский', 'Краславский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('484', '117', 'Кулдигский', 'Кулдигский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('485', '117', 'Лиепайский', 'Лиепайский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('486', '117', 'Лимбажский', 'Лимбажский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('487', '117', 'Лудзский', 'Лудзский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('488', '117', 'Мадонский', 'Мадонский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('489', '117', 'Огреский', 'Огреский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('490', '117', 'Прейльский', 'Прейльский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('491', '117', 'Резекнеский', 'Резекнеский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('492', '117', 'Рижский', 'Рижский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('493', '117', 'Салдусский', 'Салдусский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('494', '117', 'Талсинский', 'Талсинский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('495', '117', 'Тукумсский', 'Тукумсский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('496', '117', 'Цесиский', 'Цесиский');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('497', '117', 'Вентспилс', 'Вентспилс');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('498', '117', 'Даугавпилс', 'Даугавпилс');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('499', '117', 'Елгава', 'Елгава');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('500', '117', 'Лиепая', 'Лиепая');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('501', '117', 'Резекне', 'Резекне');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('502', '117', 'Рига', 'Рига');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('503', '117', 'Юрмала', 'Юрмала');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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
  `products_column_name` varchar(255) NOT NULL,
  `column_justify` set('Left','Center','Right') NOT NULL DEFAULT 'Left',
  `filter_class` set('none','exact','multiple','range','reverse','start','partial','like') NOT NULL DEFAULT 'none',
  `filter_display` set('pulldown','multi','checkbox','radio','links','text','image','multiimage') NOT NULL DEFAULT 'pulldown',
  `filter_show_all` set('True','False') NOT NULL DEFAULT 'True',
  `enter_values` set('pulldown','multi','checkbox','radio','links','text','image','multiimage') NOT NULL DEFAULT 'text',
  PRIMARY KEY (`specifications_id`),
  KEY `specification_group_id` (`specification_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;


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
  `specification_name` varchar(255) NOT NULL DEFAULT '',
  `specification_description` varchar(128) NOT NULL,
  `specification_prefix` varchar(128) NOT NULL DEFAULT '',
  `specification_suffix` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`specification_description_id`,`language_id`),
  KEY `specifications_id` (`specifications_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

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

DROP TABLE IF EXISTS email_batch;
CREATE TABLE email_batch (
  id int(5) unsigned NOT NULL auto_increment,
  charset varchar(20) default NULL,
  send char(2) default NULL,
  to_name varchar(50) NOT NULL default '',
  to_address varchar(255) NOT NULL default '',
  subject varchar(100) NOT NULL default '',
  text text NOT NULL,
  from_name varchar(50) default NULL,
  from_address varchar(50) default NULL,
  last_updated datetime default NULL,
  created datetime default NULL,
  hold char(2) default NULL,
  ip varchar(15) default NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY email_id (id),
  KEY email_id_2 (id),
  KEY send (send),
  KEY hold (hold)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS email_batch_a;
CREATE TABLE email_batch_a (
  id int(5) unsigned NOT NULL default '0',
  charset varchar(20) default NULL,
  send char(2) default NULL,
  to_name varchar(50) NOT NULL default '',
  to_address varchar(255) NOT NULL default '',
  subject varchar(100) NOT NULL default '',
  text text NOT NULL,
  from_name varchar(50) default NULL,
  from_address varchar(50) default NULL,
  last_updated datetime default NULL,
  created datetime default NULL,
  hold char(2) default NULL,
  ip varchar(15) default NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY email_id (id),
  KEY email_id_2 (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Use Email Queue', 'USE_EMAIL_QUEUE', 'false', 'Process the emails via the Email Queue', '12', '11', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Hold Email Queue', 'HOLD_EMAIL_QUEUE', 'false', 'Hold all emails in the Email Queue', '12', '12', '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Site Time Zone', 'SITE_TIME_ZONE', '', 'Site time zone', 1, 999, '2009-04-24 15:29:10', '2008-07-17 10:29:22', NULL, 'tep_cfg_pull_down_timezone_list(');

drop table if exists spsr_zones;
create table spsr_zones (
  id int(11) not null auto_increment,
  zone_id int(11) default '0' not null ,
  spsr_zone_id int(11) default '0' not null,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

insert into spsr_zones (id, zone_id, spsr_zone_id) values ('1', '184', '53');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('2', '185', '55');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('3', '186', '56');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('4', '187', '54');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('5', '188', '57');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('6', '189', '101');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('7', '190', '19');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('8', '191', '58');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('9', '192', '24');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('10', '193', '59');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('11', '194', '60');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('12', '195', '61');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('13', '196', '62');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('14', '197', '63');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('15', '198', '64');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('16', '199', '65');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('17', '200', '66');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('18', '201', '84');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('19', '202', '67');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('20', '203', '92');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('21', '204', '94');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('22', '205', '3');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('23', '206', '30');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('24', '207', '31');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('25', '208', '51');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('26', '209', '75');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('27', '210', '89');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('28', '211', '0');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('29', '212', '6');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('30', '213', '7');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('31', '214', '8');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('32', '215', '10');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('33', '216', '11');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('34', '217', '12');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('35', '218', '13');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('36', '219', '14');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('37', '220', '17');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('38', '221', '18');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('39', '222', '21');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('40', '223', '22');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('41', '224', '23');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('42', '225', '25');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('43', '226', '27');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('44', '227', '29');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('45', '228', '32');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('46', '229', '33');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('47', '230', '35');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('48', '231', '36');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('49', '232', '38');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('50', '233', '40');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('51', '234', '41');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('52', '235', '43');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('53', '236', '44');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('54', '237', '45');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('55', '238', '46');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('56', '239', '47');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('57', '240', '48');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('58', '241', '49');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('59', '242', '50');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('60', '243', '52');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('61', '244', '68');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('62', '245', '69');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('63', '246', '70');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('64', '247', '71');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('65', '248', '72');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('66', '249', '73');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('67', '250', '74');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('68', '251', '76');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('69', '252', '79');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('70', '253', '80');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('71', '254', '81');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('72', '255', '83');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('73', '256', '87');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('74', '257', '91');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('75', '258', '0');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('76', '259', '100');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('77', '260', '0');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('78', '261', '0');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('79', '262', '16');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('80', '263', '0');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('81', '266', '42');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('82', '267', '0');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('83', '268', '88');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('84', '269', '90');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('85', '270', '95');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('86', '271', '97');
insert into spsr_zones (id, zone_id, spsr_zone_id) values ('87', '272', '99');