<?php

/**
 * The bootstrap file for Wonkasoft Logout
 *
 * This Plugin will allow you to direct where the user will go after either logging in or logging out of an account on the site.
 *
 * @link              https://wonkasoft.com
 * @since             1.0.0
 * @package           Wonkasoft_Logout
 *
 * @wordpress-plugin
 * Plugin Name:       Wonkasoft Logout
 * Plugin URI:        https://wonkasoft.com/wonkasoft-logout
 * Description:       This Plugin will allow you to direct where the user will go after either logging in or logging out of an account on the site.
 * Version:           1.0.0
 * Author:            Wonkasoft
 * Author URI:        https://wonkasoft.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wonkasoft-logout
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version and paths.
 * 
 */
define( 'WONKASOFT_LOGOUT_PATH', plugin_dir_path( __FILE__ ) );
define( 'WONKASOFT_LOGOUT_NAME', plugin_basename(dirname( __FILE__ ) ) );
define( 'WONKASOFT_LOGOUT_BASENAME', plugin_basename( __FILE__ ) );
define( 'WONKASOFT_LOGOUT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wonkasoft-logout-activator.php
 */
function activate_wonkasoft_logout() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wonkasoft-logout-activator.php';
	Wonkasoft_Logout_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wonkasoft-logout-deactivator.php
 */
function deactivate_wonkasoft_logout() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wonkasoft-logout-deactivator.php';
	Wonkasoft_Logout_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wonkasoft_logout' );
register_deactivation_hook( __FILE__, 'deactivate_wonkasoft_logout' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wonkasoft-logout.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wonkasoft_logout() {

	$plugin = new Wonkasoft_Logout();
	$plugin->run();

}
run_wonkasoft_logout();
