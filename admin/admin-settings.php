<?php
namespace Banana_Addons\Elementor\Admin;

/**
 * Admin Settings Page
 * 
 * @package Banana_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Banana_Addons\Elementor\Helper;
use Banana_Addons\Elementor\Addons_Manager;
use Banana_Addons\Elementor\Extensions_Manager;

class Admin_Settings {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'banae_register_admin_pages' ] );
		//add_action( 'admin_head', [ $this, 'modify_menu_highlight' ] ); // invalid wp standard
		//add_action( 'admin_head', [ $this, 'banae_add_custom_styles' ] ); // invalid wp standard
		add_action( 'admin_print_scripts', [ $this, 'banae_change_menu_highlight' ] );
		add_action( 'admin_print_styles', [ $this, 'banae_add_custom_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'banae_widget_admin_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'banae_add_admin_styles' ] );
		add_action( 'wp_ajax_banae_widget_save_settings', [ $this, 'banae_widget_save_settings_ajax' ] );

		add_filter( 'plugin_action_links_' . BANANA_ADDONS_PLUGIN_BASE, [ $this, 'plugin_action_links' ] );

		add_filter( 'plugin_row_meta', [ $this, 'banae_add_row_meta' ], 10, 3 );
	}

	/**
	 * Register Admin Pages
	 * 
	 * @return void
	 */
	public function banae_register_admin_pages() {
		// Main menu page (settings page)
		add_menu_page(
			__( 'Banana Addons', 'banana-addons-for-elementor' ), // Page title
			__( 'Banana Addons', 'banana-addons-for-elementor' ), // Menu title 
			'manage_options', // Capability required to access the page
			'banana-addons-for-elementor', // Menu slug
			[ $this, 'banae_all_addons' ], // Callback function to display page content
			BANANA_ADDONS_ASSETS . 'admin/img/banana-icon.svg', // custom icon instead of dashicons
			59
		);

		// First submenu uses SAME slug as parent to hide repetition
		add_submenu_page(
			'banana-addons-for-elementor',
			'Dashboard',
			'Dashboard',
			'manage_options',
			'banana-addons-for-elementor',
			[ $this, 'banae_all_addons' ],
		);

		// Widgets
		add_submenu_page(
			'banana-addons-for-elementor',	//The slug name for the parent menu
			esc_html__( 'Widgets', 'banana-addons-for-elementor' ),	// Page title
			esc_html__( 'Widgets', 'banana-addons-for-elementor' ), // Menu title
			'manage_options',
			'admin.php?page=banana-addons-for-elementor&tab=widgets',
		);

		// Extensions
		add_submenu_page(
			'banana-addons-for-elementor',	//The slug name for the parent menu
			esc_html__( 'Extensions', 'banana-addons-for-elementor' ),	// Page title
			esc_html__( 'Extensions', 'banana-addons-for-elementor' ), // Menu title
			'manage_options',
			'admin.php?page=banana-addons-for-elementor&tab=extensions',
		);

		// API Keys
		add_submenu_page(
			'banana-addons-for-elementor',	//The slug name for the parent menu
			esc_html__( 'API Keys', 'banana-addons-for-elementor' ),	// Page title
			esc_html__( 'API Keys', 'banana-addons-for-elementor' ), // Menu title
			'manage_options',
			'admin.php?page=banana-addons-for-elementor&tab=api-key',
		);

		// Theme Builder
		add_submenu_page(
			'banana-addons-for-elementor',	//The slug name for the parent menu
			esc_html__( 'Theme Builder', 'banana-addons-for-elementor' ),	// Page title
			esc_html__( 'Theme Builder', 'banana-addons-for-elementor' ), // Menu title
			'manage_options',
			'edit.php?post_type=banana_template',
		);
	}

	/**
	 * Set active sidebar menu based on active tab 
	 * 
	 * @return void
	 */
	public function banae_change_menu_highlight() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'banana-addons-for-elementor' && isset( $_GET['tab'] ) ) {
			
			$current_tab = ( $_GET['tab'] === 'api-key' ) ? 'API Keys' : sanitize_text_field( wp_unslash( $_GET['tab'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$current_tab = ucfirst( $current_tab );

			echo '<script type="text/javascript">\n';
			echo "jQuery(document).ready(function($) {";
			echo '$("#toplevel_page_banana-addons-for-elementor .wp-submenu-wrap").find("li").removeClass("current");';
			echo '$("#toplevel_page_banana-addons-for-elementor .wp-submenu-wrap li:contains("'.esc_html( $current_tab ) .'")").addClass("current");';
			echo '});';
			echo '</script>';

		}
	}

	/**
	 * All addons page
	 * 
	 * @return void
	 */
	public function banae_all_addons() {

		// get widget settings
		$options = get_option( 'banae_widget_settings', [] );

		// get widget settings
		$extension_options = get_option( 'banae_extension_settings', [] );

		// get all addons or widgets and extensions
		$banae_widget_options = Addons_Manager::$default_widgets;
		$banae_extension_options = Extensions_Manager::$default_extensions;

		// load admin template
		Helper::get_banae_template_part( 'admin/template', [
			'Helper' => Helper::class,
			'options' => $options,
			'extension_options' => $extension_options,
			'banae_widget_options' => $banae_widget_options,
			'banae_extension_options' => $banae_extension_options
		] );
	}

	/**
	 * Admin settings ajax function
	 * 
	 * @return void
	 */
	public function banae_widget_save_settings_ajax() {

		$frmPost = $_POST; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		// Current API Setting Fields
		$api_fields = [ 'google_map_api_key', 'mailchimp_api_key', 'stripe_public_key', 'stripe_secret_key' ];

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( [ 'message' => 'Not allowed' ] );
		}

		check_ajax_referer( 'banae_widget_settings_nonce', 'security' );

		// get all widgets from addons-manager
		$widget_list = Addons_Manager::$default_widgets;

		// get all extensions from extensions-manager
		$extension_list = Extensions_Manager::$default_extensions;

		// check if not empty
		if ( $widget_list ) {
			$new_options = [];

			// iterate through widgets and access $_POST by key
			foreach ( $widget_list as $key => $widget ) {
				//$value = sanitize_text_field( $frmPost[ $key ] );
				$new_options[ $key ] = isset( $frmPost[ $key ] ) ? 1 : 0;
			}

			// update addons setting in db
			update_option( 'banae_widget_settings', $new_options );
		}

		// check if extensions not empty
		if ( $extension_list ) {
			$new_options = [];

			// iterate through extensions and access $_POST by key
			foreach ( $extension_list as $key => $extension ) {
				//$value = sanitize_text_field( $frmPost[ $key ] );
				$new_options[ $key ] = isset( $frmPost[ $key ] ) ? 1 : 0;
			}

			// update addons setting in db
			update_option( 'banae_extension_settings', $new_options );
		}

		// update all api fields
		foreach ( $api_fields as $value ) {

			$index_key = 'banae_' . $value; // define option_key_name
			$value = sanitize_text_field( $frmPost[ $value ] );

			// update api setting in db
			update_option( $index_key, $value );
		}

		// render response message
		wp_send_json_success( [ 'message' => 'Settings saved successfully!' ] );

	}

	/**
	 * Plugin action links.
	 *
	 * Adds action links to the plugin list table
	 *
	 * Fired by `plugin_action_links` filter.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $links An array of plugin action links.
	 *
	 * @return array An array of plugin action links.
	 */
	public function plugin_action_links( $links ) {
		//$go_pro_text = sprintf( esc_html__( 'Go Pro - %s', 'banana-addons-for-elementor' ), 'Banana Addons' );
		//$links['banae_go_pro'] = sprintf( '<a href="%1$s" target="_blank" class="banana-pro-upgrade">%2$s</a>', 'https://bananaaddons.com/pricing/', $go_pro_text );
		/* translators: %s: Plugin name. */
		$go_pro_label = esc_html__( 'Go Pro - %s', 'banana-addons-for-elementor' );
		$go_pro_text = sprintf( $go_pro_label, 'Banana Addons' );

		$links['banae_go_pro'] = sprintf( '<a href="%1$s" target="_blank" class="banana-pro-upgrade">%2$s</a>', 'https://bananaaddons.com/pricing/', $go_pro_text );

		return $links;
	}

	/**
	 * Add custom styles for admin
	 * 
	 * @return void
	 */
	public function banae_add_custom_styles() {
		echo '<style>
        #toplevel_page_banana-addons-for-elementor .wp-menu-image img {
            width: 18px !important;
            height: 18px !important;
            object-fit: contain;
            /*filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(86deg) brightness(118%) contrast(119%);*/
			filter: brightness(0) saturate(100%) invert(81%) sepia(98%) saturate(461%) hue-rotate(2deg) brightness(95%) contrast(103%);
        }
		.banae_go_pro a {color: #63a81d;font-weight: 600;}
		.banae_go_pro a:hover {color: #77c627;}
        </style>';
	}

	/**
	 * Add admin-ui styles
	 * 
	 * @return void
	 */
	public function banae_add_admin_styles() {

		// dependency plugin Styles
		wp_enqueue_style( 'banae-jquery-toast-plugin-style', BANANA_ADDONS_ASSETS . 'vendor/jquery-toast-plugin/css/jquery.toast.min.css' );

		// Main Plugin Styles
		wp_enqueue_style( 'banae-admin-ui-style', BANANA_ADDONS_ASSETS . 'admin/css/admin-ui.min.css' );

	}

	/**
	 * Add admin-ui scripts
	 * 
	 * @param mixed $hook
	 * 
	 * @return void
	 */
	public function banae_widget_admin_scripts( $hook ) {

		// matching plugin url
		if ( $hook !== 'toplevel_page_banana-addons-for-elementor' ) {
			return;
		}

		wp_enqueue_script(
			'banae-jquery-toast-plugin-js',
			BANANA_ADDONS_ASSETS . 'vendor/jquery-toast-plugin/js/jquery.toast.min.js',
			[ 'jquery' ],
			false,
			true
		);

		wp_enqueue_script(
			'banae-widget-admin-script',
			BANANA_ADDONS_ASSETS . 'admin/js/admin.min.js',
			[ 'jquery' ],
			false,
			true
		);

		wp_localize_script( 'banae-widget-admin-script', 'banae_widget_ajax', [
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'banae_widget_settings_nonce' ),
		] );
	}

	/**
	 * Add custom link to plugin row meta
	 * 
	 * @param mixed $plugin_meta
	 * @param mixed $plugin_file
	 * @param mixed $plugin_data
	 * 
	 * @return mixed
	 */
	public function banae_add_row_meta( $plugin_meta, $plugin_file, $plugin_data ) {
		// Check if the current row corresponds to your plugin
		// plugin's actual file path relative to the plugins directory.
		if ( 'banana-addons-for-elementor/banana-addons-for-elementor.php' === $plugin_file ) {
			// Add a link after the version number.
			// append a new entry to the main meta array.

			// Add a custom link for documentation
			$plugin_meta[] = sprintf(
				'<a href="%s" target="_blank">%s</a>',
				esc_url( 'https://bananaaddons.com/docs/' ),
				esc_html__( 'Docs', 'banana-addons-for-elementor' )
			);

			// Add a custom link for support
			$plugin_meta[] = sprintf(
				'<a href="%s" target="_blank">%s</a>',
				esc_url( 'https://bananaaddons.com/support/' ),
				esc_html__( 'Support', 'banana-addons-for-elementor' )
			);
		}

		return $plugin_meta;
	}
}

new Admin_Settings();