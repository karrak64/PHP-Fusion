<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------*
| Filename: includes/weblinks_setup.php
| Author: PHP-Fusion Development Team
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (isset($_POST['uninstall'])) {
	$result = dbquery("DROP TABLE IF EXISTS ".$db_prefix."weblink_cats");
	$result = dbquery("DROP TABLE IF EXISTS ".$db_prefix."weblinks");
	$result = dbquery("DELETE FROM ".$db_prefix."admin WHERE admin_rights='WC'");
	$result = dbquery("DELETE FROM ".$db_prefix."admin WHERE admin_rights='W'");
	$result = dbquery("DELETE FROM ".$db_prefix."site_links WHERE link_url='weblinks.php'");
	$result = dbquery("DELETE FROM ".$db_prefix."site_links WHERE link_url='submit.php?stype=l'");
} else {
	$result = dbquery("DROP TABLE IF EXISTS ".$db_prefix."weblink_cats");
	$result = dbquery("DROP TABLE IF EXISTS ".$db_prefix."weblinks");
	$result = dbquery("CREATE TABLE ".$db_prefix."weblink_cats (
			weblink_cat_id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
			weblink_cat_parent MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
			weblink_cat_name VARCHAR(100) NOT NULL DEFAULT '',
			weblink_cat_description TEXT NOT NULL,
			weblink_cat_sorting VARCHAR(50) NOT NULL DEFAULT 'weblink_name ASC',
			weblink_cat_language VARCHAR(50) NOT NULL DEFAULT '".$_POST['localeset']."',
			PRIMARY KEY(weblink_cat_id)
			) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci");
	if (!$result) {
		$fail = TRUE;
	}

	$result = dbquery("CREATE TABLE ".$db_prefix."weblinks (
			weblink_id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
			weblink_name VARCHAR(100) NOT NULL DEFAULT '',
			weblink_description TEXT NOT NULL,
			weblink_url VARCHAR(200) NOT NULL DEFAULT '',
			weblink_cat MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
			weblink_datestamp INT(10) UNSIGNED NOT NULL DEFAULT '0',
			weblink_visibility TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
			weblink_count SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
			PRIMARY KEY(weblink_id),
			KEY weblink_datestamp (weblink_datestamp),
			KEY weblink_count (weblink_count)
			) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci");
	if (!$result) {
		$fail = TRUE;
	}
	$result = dbquery("INSERT INTO ".$db_prefix."admin (admin_rights, admin_image, admin_title, admin_link, admin_page) VALUES ('WC', 'wl_cats.gif', '".$locale['109']."', 'weblink_cats.php', '1')");
	$result = dbquery("INSERT INTO ".$db_prefix."admin (admin_rights, admin_image, admin_title, admin_link, admin_page) VALUES ('W', 'wl.gif', '".$locale['110']."', 'weblinks.php', '1')");

	// links
	$enabled_languages = explode('.', $settings['enabled_languages']);
	for ($i = 0; $i < sizeof($enabled_languages); $i++) {
		include LOCALE.$enabled_languages[$i]."/setup.php";
		$result = dbquery("INSERT INTO ".$db_prefix."site_links (link_name, link_url, link_visibility, link_position, link_window, link_order, link_language) VALUES ('".$locale['137']."', 'weblinks.php', '0', '2', '0', '6', '".$enabled_languages[$i]."')");
		if (!$result) $fail = TRUE;
		$result = dbquery("INSERT INTO ".$db_prefix."site_links (link_name, link_url, link_visibility, link_position, link_window, link_order, link_language) VALUES ('".$locale['140']."', 'submit.php?stype=l', '101', '1', '0', '12', '".$enabled_languages[$i]."')");
		if (!$result) $fail = TRUE;
	}
}
?>