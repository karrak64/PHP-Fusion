<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: profile.php
| Author: Frederick MC Chan (Hien)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
add_to_head("<link href='".THEMES."templates/global/css/profile.css' rel='stylesheet'/>\n");
if (!function_exists('render_userprofile')) {
	function render_userprofile($info) {
		// Basic User Information
		$basic_info = isset($info['core_field']) ? $info['core_field'] : array(); //$info['item']['core']; // Basic information.
		//User Fields Module Information
		$field_info = $info['user_field'];
		$user_info = '';
		$user_avatar = '';
		$user_name = '';
		foreach ($basic_info as $field_id => $data) {
			if ($field_id == 'profile_user_avatar') {
				$xxx['user_avatar'] = $data['value'];
				$xxx['user_status'] = $data['status'];
				$user_avatar = display_avatar($xxx, '50px', '', FALSE, '');
			} elseif ($field_id == 'profile_user_name') {
				$user_name = "<div id='".$field_id."' style='padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ccc;'>".$data['value']."</div>\n";
			} else {
				$user_info .= "<div id='".$field_id."' class='p-b-5'><span class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>".$data['title']."</span><div class='profile_text overflow-hide'>".$data['value']."</div></div>\n";
			}
		}
		$user_field = '';
		foreach ($field_info as $field_cat_id => $category_data) {
			$user_field .= $category_data['title'];
			if (isset($category_data['fields'])) {
				foreach ($category_data['fields'] as $field_id => $field_data) {
					$user_field .= "<div id='".$field_id."' class='p-b-5'><span class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>".$field_data['title']."</span><div class='profile_text overflow-hide'>".$field_data['value']."</div></div>\n";
				}
			}
		}
		echo "<section id='user-profile' class='row m-b-20'>\n";
		echo "<div class='col-xs-12 col-sm-3 col-md-3 col-lg-2'>\n";
		// page navigation
		echo "<ul class='profile_link_nav m-t-20'>";
		foreach ($info['section'] as $page_section) {
			echo "<li ".($page_section['active'] ? "class='active'" : '')."><a href='".$page_section['link']."'>".$page_section['name']."</a></li>\n";
		}
		echo "</ul>\n";
		echo "</div>\n";
		echo "<div class='col-xs-12 col-sm-9 col-md-9 col-lg-10'>\n";
		// basic information
		echo $user_name;
		echo "<div class='clearfix m-t-10'>\n";
		echo "<div class='pull-left m-r-10'>\n";
		echo $user_avatar;
		echo "</div>\n";
		echo "<div class='overflow-hide'>\n";
		echo $user_info;
		echo $user_field;
		/* if (!isset($_GET['profiles']) or isset($_GET['profiles']) && $_GET['profiles'] == 1) {
			//echo opencollapse('uf_module');
			//echo "<span class='display-inline-block' style='width:100%'><span class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>&nbsp;</span><a ".collapse_header_link('uf_module', '0', '0', '').">Show Full Information</a></span>\n";
			//echo "<div ".collapse_footer_link('uf_module','0', '0').">\n";

			//echo "</div>\n";
			//echo closecollapse();
		} */
		//echo $ext_info;
		// photo gallery
		echo "</div>\n</div>\n";
		echo "</div>\n";
		echo "</section>\n";
	}
}
if (!function_exists('render_userform')) {
	function render_userform($info) {
		// page navigation
		$nav = "<ul class='profile_link_nav m-t-20'>";
		foreach ($info['section'] as $page_section) {
			$nav .= "<li ".($page_section['active'] ? "class='active'" : '')."><a href='".$page_section['link']."'>".$page_section['name']."</a></li>\n";
		}
		$nav .= "</ul>\n";
		echo "<div id='register_form'>\n";
		echo "<div class='row'>\n";
		if (!$info['register']) {
			echo "<div class='col-xs-12 col-sm-3 col-md-3 col-lg-2'>\n";
			echo $nav;
			echo "</div>\n<div class='col-xs-12 col-sm-9 col-md-9 col-lg-10 p-t-20 p-b-20'>\n";
		} else {
			echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 p-t-20 p-b-20'>\n";
		}
		echo $info['openform'];
		if (isset($info['basic_field'])) echo $info['basic_field'];
		echo $info['user_field'];
		echo isset($info['validate']) ? $info['validate'] : '';
		echo isset($info['terms']) ? $info['terms'] : '';
		echo $info['button'];
		echo $info['closeform'];
		echo "</div>\n</div>\n";
		echo "</div>\n";
	}
}



?>