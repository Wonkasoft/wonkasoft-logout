<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Wonkasoft_Logout
 * @subpackage Wonkasoft_Logout/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wonkasoft_Logout
 * @subpackage Wonkasoft_Logout/includes
 * @author     Wonkasoft <support@wonkasoft.com>
 */
class Wonkasoft_Logout_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wonkasoft-logout',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
