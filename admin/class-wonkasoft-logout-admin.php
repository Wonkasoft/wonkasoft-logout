<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Wonkasoft_Logout
 * @subpackage Wonkasoft_Logout/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wonkasoft_Logout
 * @subpackage Wonkasoft_Logout/admin
 * @author     Wonkasoft <support@wonkasoft.com>
 */
class Wonkasoft_Logout_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wonkasoft_Logout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wonkasoft_Logout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wonkasoft-logout-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wonkasoft_Logout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wonkasoft_Logout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wonkasoft-logout-admin.js', array( 'jquery' ), $this->version, false );

	}

	// Active the Admin / Settings page
	public function wonkasoft_logout_display_admin_page() {
		add_options_page(
			'Wonkasoft Logout',
			'Wonkasoft Logout',
			'manage_options',
			'wonkasoft_logout_show_settings_page',
			array( $this,'wonkasoft_logout_show_settings_page' )
		);


		add_settings_section( 
			'wonkasoft_logout', 
			'For Logout Redirect', 
			null, 
			'wonkasoft_logout_show_settings_page'
		);

		add_settings_field(
			'wonkasoft_logout_url',
			'Logout Redirect URL',
			'wonkasoft_logout_url',
			'wonkasoft_logout_show_settings_page',
			'wonkasoft_logout'
		);

	    register_setting( 
	    	'wonkasoft_logout_settings', 
	    	'wonkasoft_logout_url' 
	    ); 

		add_settings_section( 
			'wonkasoft_login', 
			'For Login Redirect', 
			null, 
			'wonkasoft_logout_show_settings_page'
		);

		add_settings_field(
			'wonkasoft_login_url',
			'Login Redirect URL',
			'wonkasoft_login_url',
			'wonkasoft_logout_show_settings_page',
			'wonkasoft_login'
		);

	    register_setting( 
	    	'wonkasoft_logout_settings', 
	    	'wonkasoft_login_url'
	    ); 

		function wonkasoft_logout_url( $args ) {

			$logout_value = ( get_option( 'wonkasoft_logout_url' ) ) ? esc_attr( get_option( 'wonkasoft_logout_url' ) ): '';
			echo '<input id="wonkasoft_logout_url" name="wonkasoft_logout_url" class="wonkasoft-input wonkasoft-logout-url" placeholder="redirect url here..." value="' . $logout_value . '" />';

		}

		function wonkasoft_login_url( $args ) {

			$login_value = ( get_option( 'wonkasoft_login_url' ) ) ? esc_attr( get_option( 'wonkasoft_login_url' ) ): '';
			echo '<input id="wonkasoft_login_url" name="wonkasoft_login_url" class="wonkasoft-input wonkasoft-login-url" placeholder="redirect url here..." value="' . $login_value . '" />';

		}
	}

	// To display the setting page for Wonkasoft Logout
	public function wonkasoft_logout_show_settings_page() {
		include plugin_dir_path( __FILE__ ) . 'partials/wonkasoft-logout-admin-display.php';
	}

	// Create the action links on the plugins page
	public function wonkasoft_logout_add_action_links() {
		include plugin_dir_path( __FILE__ ) . 'partials/wonkasoft-logout-add-action-links.php';
	}

	public function wonkasoft_logout_redirector() {

		$logout_value = ( get_option( 'wonkasoft_logout_url' ) ) ? esc_attr( get_option( 'wonkasoft_logout_url' ) ): '';
		$login_value = ( get_option( 'wonkasoft_login_url' ) ) ? esc_attr( get_option( 'wonkasoft_login_url' ) ): '';

		if ( $logout_value !== '' ) {
			
			add_action( 'admin_menu','auto_redirect_after_logout' );
			
		}

		function auto_redirect_after_logout(){

			$logout = ( strpos( $logout, 'http' ) ) ? $logout: home_url() . $logout;
			var_dump($logout);
			wp_redirect( $logout );
			exit();
		}

		add_action('wp_login','auto_redirect_after_login');

		function auto_redirect_after_login(){
		 wp_redirect( home_url() .'/' );
		 exit();
		}
	}

}
