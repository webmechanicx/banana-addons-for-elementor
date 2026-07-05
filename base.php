<?php
/**
 * 
 * Plugin Base Class
 * 
 * @package Banana_Addons
 */

namespace Banana_Addons\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Banana Addons for Elementor Class
 *
 * The main class that initiates and runs the plugin.
 */
final class Base {

	/**
	 * Instance
	 *
	 * @access private
	 * @static
	 *
	 * @var Base The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Base An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		// Load Textdomain
		add_action( 'init', [ $this, 'i18n' ] );

		// loading all necessary classes
		$this->load_classes();

		// initiate hooks
		$this->register_hooks();

	}

	/**
	 * 
	 * Loading necessary classes
	 * 
	 */
	public function load_classes() {
		include_once BANANA_ADDONS_DIR_PATH . 'includes/helper-class.php';
		include_once BANANA_ADDONS_DIR_PATH . 'includes/addons-manager-class.php';
		include_once BANANA_ADDONS_DIR_PATH . 'includes/extensions-manager-class.php';
		include_once BANANA_ADDONS_DIR_PATH . 'includes/assets-manager-class.php';
		require_once BANANA_ADDONS_DIR_PATH . 'includes/theme-builder/theme-builder-class.php';

		if ( is_admin() ) {
			include_once BANANA_ADDONS_DIR_PATH . 'admin/admin-settings.php';
		}
	}

	public function register_hooks() {

		// Add Body Class 
		add_filter( 'body_class', [ $this, 'add_body_classes' ] );

		// Registering Custom Widget Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_addons_category' ] );

		// Register widget's dependency scripts
		add_action( 'elementor/frontend/after_register_scripts', [ new Assets_Manager, 'frontend_register' ] );

		// Elementor Editor Styles
		add_action( 'elementor/editor/after_enqueue_styles', [ new Assets_Manager, 'editor_enqueue' ] );

		// Load Admin Main script
		add_action( 'admin_enqueue_scripts', [ new Assets_Manager, 'admin_enqueue_scripts' ] );

	}

	/**
	 * 
	 * Register Custom Banana Addons Elementor category
	 *
	 * @param \Elementor\Elements_Manager $elements_manager The Elementor elements manager.
	 * 
	 * @return void
	 */
	public function register_addons_category( $elements_manager ) {

		$elements_manager->add_category(
			'banana-addons-category',
			[
				'title' => __( 'Banana Addons', 'banana-addons-for-elementor' ),
				'icon' => 'font',
			]
		);
	}

	/**
	 *
	 * Add Body Class banana-addons-for-elementor
	 * 
	 * @param array $classes Body classes.
	 * 
	 * @return array Modified body classes.
	 */
	public function add_body_classes( $classes ) {
		$classes[] = 'banana-addons-for-elementor';

		return $classes;
	}

	/**
	 * Load Textdomain
	 *
	 * @return void
	 */
	public function i18n() {
		load_plugin_textdomain( 'banana-addons-for-elementor', false, dirname( plugin_basename( BANANA_ADDONS__FILE__ ) ) . '/i18n/' );
	}

}