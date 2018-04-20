<?php
/**
* The admin-specific functionality of the plugin.
*
* @link       https://wonkasoft.com
* @since      1.0.0
*
* @package    Wonkasoft_Logout
* @subpackage wonkasoft-logout/admin/partials
*/

/**
* The admin-specific functionality of the plugin.
*
* Defines the plugin name, version, and two examples hooks for how to
* enqueue the admin-specific stylesheet and JavaScript.
*
* @package    Wonkasoft_Logout
* @subpackage wonkasoft-logout/admin/partials
* @author     Wonkasoft <info@wonkasoft.com>
*/

add_filter( 'plugin_action_links_'. WONKASOFT_LOGOUT_BASENAME, 'wonkasoft_logout_add_settings_link_filter' , 10, 1);

function wonkasoft_logout_add_settings_link_filter( $links ) { 
	$links_addon = '<a href="admin.php?page=wonkasoft-logout-admin-display" target="_self">Settings</a>';
	array_unshift($links, $links_addon);
	$links[] = '<a href="https://paypal.me/Wonkasoft" target="blank"><img src="' . plugin_dir_url( "wonka-slide" ) . "wonkasoft-logout/admin/img/ws-slide-logo.svg" . '" style="width: 20px; height: 20px; display: inline-block;
    vertical-align: text-top; float: none;" /></a>';
 return $links; 
}

add_filter( 'plugin_row_meta', 'wonkasoft_logout_add_description_link_filter', 10, 2);

function wonkasoft_logout_add_description_link_filter( $links, $file ) {
	if ( strpos($file, 'wonka-slide.php') !== false ) {
		$links[] = '<a href="admin.php?page=wonkasoft-logout-admin-display" target="_self">Settings</a>';
		$links[] = '<a href="https://paypal.me/Wonkasoft" target="blank">Donate <img src="' . plugin_dir_url( "wonka-slide" ) . "wonkasoft-logout/admin/img/ws-slide-logo.svg" . '" style="width: 20px; height: 20px; display: inline-block;
    vertical-align: text-top;" /></a>';
	}
 return $links; 
}