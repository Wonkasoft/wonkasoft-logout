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

		/**
		 * This will check for Wonkasoft Tools Menu, if not found it will make it.
		 */
		if ( empty ( $GLOBALS['admin_page_hooks']['wonkasoft_menu'] ) ) {
			
			global $wonkasoft_logout_page;
			$wonkasoft_logout_page = 'wonkasoft_menu';
			add_menu_page(
				'Wonkasoft',
				'Wonkasoft Tools',
				'manage_options',
				'wonkasoft_menu',
				array( $this,'wonkasoft_logout_settings_page' ),
				plugins_url( "/img/wonka-logo-2.svg", __FILE__ ),
				100
			);

			add_submenu_page(
				'wonkasoft_menu',
				'Wonkasoft Logout',
				'Wonkasoft Logout',
				'manage_options',
				'wonkasoft_menu',
				array( $this,'wonkasoft_logout_settings_page' )
			);

		} else {

			/**
			 * This creates option page in the settings tab of admin menu
			 */
			global $wonkasoft_logout_page;
			$wonkasoft_logout_page = 'wonkasoft_logout_settings_page';
			add_submenu_page(
				'wonkasoft_menu',
				'Wonkasoft Logout',
				'Wonkasoft Logout',
				'manage_options',
				'wonkasoft_logout_settings_page',
				array( $this,'wonkasoft_logout_settings_page' )
			);

		}

		/**
		 * This creates settings area that is displayed on options page
		 */

		add_settings_section( 
			'wonkasoft_logout', 
			'For Logout Redirect', 
			null, 
			'wonkasoft_logout_settings_page'
		);

		/**
		 * This creates settings field that is displayed on options page
		 */

		add_settings_field(
			'wonkasoft_logout_url',
			'Logout Redirect URL',
			'wonkasoft_logout_url',
			'wonkasoft_logout_settings_page',
			'wonkasoft_logout'
		);

		/**
		 * This registers settings field above that is displayed on options page
		 */

	    register_setting( 
	    	'wonkasoft_logout_settings', 
	    	'wonkasoft_logout_url' 
	    ); 

	    /**
		 * This creates settings area that is displayed on options page
		 */
		
		add_settings_section( 
			'wonkasoft_login', 
			'For Login Redirect', 
			null, 
			'wonkasoft_logout_settings_page'
		);

		/**
		 * This creates settings field that is displayed on options page
		 */

		add_settings_field(
			'wonkasoft_login_url',
			'Login Redirect URL',
			'wonkasoft_login_url',
			'wonkasoft_logout_settings_page',
			'wonkasoft_login'
		);

		/**
		 * This registers settings field above that is displayed on options page
		 */

	    register_setting( 
	    	'wonkasoft_logout_settings', 
	    	'wonkasoft_login_url'
	    ); 

	    /**
	     * 
	     * [wonkasoft_logout_url for parsing the input field that is on the settings page for the logout redirect.]
	     * @param  [array] $args [This array contains the args for the field wonkasoft_logout_url]
	     *
	     * @since 1.0.0
	     */
		function wonkasoft_logout_url( $args ) {

			$logout_value = ( get_option( 'wonkasoft_logout_url' ) ) ? esc_attr( get_option( 'wonkasoft_logout_url' ) ): '';
			$dropdown_args = array(
				'depth' => 0,
				'selected' => $logout_value,
				'name' => 'wonkasoft_logout_url',
				'id' => 'wonkasoft_logout_url',
				'class' => 'wonkasoft-logout-page-select',
				'show_option_none' => 'Select a page to redirect',
				'option_none_value' => '',
			);
			wp_dropdown_pages( $dropdown_args );

		}

		/**
	     * 
	     * [wonkasoft_login_url for parsing the input field that is on the settings page for the logout redirect.]
	     * @param  [array] $args [This array contains the args for the field wonkasoft_login_url]
	     *
	     * @since 1.0.0
	     */
		function wonkasoft_login_url( $args ) {

			$login_value = ( get_option( 'wonkasoft_login_url' ) ) ? esc_attr( get_option( 'wonkasoft_login_url' ) ): '';
			$dropdown_args = array(
				'depth' => 0,
				'selected' => $login_value,
				'name' => 'wonkasoft_login_url',
				'id' => 'wonkasoft_login_url',
				'class' => 'wonkasoft-logout-page-select',
				'show_option_none' => 'Select a page to redirect',
				'option_none_value' => '',
			);
			wp_dropdown_pages( $dropdown_args );

		}
	}

	/**
	 * [wonkasoft_logout_settings_page This function displays the admin settings page]
	 *
	 * @since 1.0.0
	 */
	public function wonkasoft_logout_settings_page() {
		include plugin_dir_path( __FILE__ ) . 'partials/wonkasoft-logout-admin-display.php';
	}

	/**
	 * [wonkasoft_logout_add_action_links For displaying action links on the plugins page]
	 *
	 * @since 1.0.0
	 */
	public function wonkasoft_logout_add_action_links() {
		include plugin_dir_path( __FILE__ ) . 'partials/wonkasoft-logout-add-action-links.php';
	}

	/**
	 * [wonkasoft_logout_redirector this function adds the redirect url]
	 *
	 * @since 1.0.0
	 */
	public function wonkasoft_logout_redirector() {

		/**
		 * [$logout_value This grabs the value for this setting that is stored in the db]
		 * @var [int] page_id
		 */
		$logout_value = ( get_option( 'wonkasoft_logout_url' ) ) ? esc_attr( get_option( 'wonkasoft_logout_url' ) ): '';

		/**
		 * This check if page is set for redirect.
		 */
		if ( $logout_value !== '' ) {

			$logout = get_permalink( $logout_value );
			wp_redirect( $logout );
			exit();
		}

	}

	/**
	 * [wonkasoft_login_redirector this function adds the redirect url]
	 *
	 * @since 1.0.0
	 */
	public function wonkasoft_login_redirector() {

		/**
		 * [$login_value This grabs the value for this setting that is stored in the db]
		 * @var [int] page_id
		 */
		$login_value = ( get_option( 'wonkasoft_login_url' ) ) ? esc_attr( get_option( 'wonkasoft_login_url' ) ): '';

		/**
		 * This check if page is set for redirect.
		 */
		if ( $login_value !== '' ) {

			$login = get_permalink( $login_value );
			wp_redirect( $login );
			exit();
		}

	}

}
