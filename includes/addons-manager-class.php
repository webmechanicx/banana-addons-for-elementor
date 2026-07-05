<?php
/**
 * 
 * Plugin Addons Manager Class
 * 
 * @package Banana_Addons
 */

namespace Banana_Addons\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Addons_Manager {

	/**
	 * 
	 * the default widgets array
	 * 
	 * @static
	 * 
	 * @return array
	 */
	public static $default_widgets = [];

	/**
	 * 
	 * Static property to hold widgets from db
	 * 
	 * @static
	 * 
	 */
	public static $is_widget_activated = [];

	/**
	 * 
	 * the dependency widgets array
	 * 
	 * @static
	 * 
	 * @return array
	 */
	public static $dependency_widgets = [];

	/**
	 * Initialize
	 */
	public static function init() {

		self::widget_manager();

		// Register Widgets
		add_action( 'elementor/widgets/register', [ __CLASS__, 'register_widgets' ] );

	}

	/**
	 * widget_manager to prepare and add static data
	 * 
	 * @return void
	 */
	protected static function widget_manager() {

		// get all widgets
		self::$default_widgets = self::get_banana_widgets();

		// get widget settings from db
		self::$is_widget_activated = get_option( 'banae_widget_settings', [] );

		// checking if widget actived
		if ( self::$is_widget_activated ) {
			foreach ( self::$is_widget_activated as $key => $value ) {
				if ( isset( self::$default_widgets[ $key ]['dependency'] ) ) {
					self::$dependency_widgets[ $key ] = self::$default_widgets[ $key ]['dependency'];
				}
			}
		}

	}

	/**
	 * 
	 * Get Widgets name from config.json file
	 * 
	 * @return array
	 */
	protected static function get_banana_widgets() {

		// set widgets config file
		$widgetData = BANANA_ADDONS_WIDGETS . '/config.json';

		// Check if the file exists
		if ( file_exists( $widgetData ) ) {
			// Read the config.json file content
			$json_config = file_get_contents( $widgetData );

			// Decode the JSON content into a PHP array or object
			// true for associative array, false for object
			$data = json_decode( $json_config, true );

			// the $data array/object
			if ( $data ) {
				// returing the first index that contains data
				return $data[0];
			}

			// return empty array
			return [];

		} else {
			echo "config.json file is missing.";
		}
	}

	/**
	 * Register all our widgets
	 * 
	 * @return void
	 */
	public static function register_widgets( $widgets_manager ) {

		// iterate through each default widgets
		foreach ( self::$default_widgets as $key => $widget ) {

			// check if the current widget is enable
			if ( isset( self::$is_widget_activated[ $key ] ) && ! empty( self::$is_widget_activated[ $key ] ) && ucfirst( $widget['tags'] ) === BANANA_ADDONS_VERSION_TYPE ) {

				// set the widget file with PATH
				$widget_class = BANANA_ADDONS_WIDGETS . $key . '/widget-' . $key . '.php';
				//$register_class = '\\' . 'Widget_' . str_replace( '-', '_', ucwords( $key, '-' ) ); // may conflict so removed
				$register_class = '\\' . 'Banae_' . str_replace( '-', '_', ucwords( $key, '-' ) );

				// check if file exist
				if ( file_exists( $widget_class ) ) {
					require_once $widget_class;
					$widgets_manager->register( new $register_class() );
				}
			}

		}

	}

}

Addons_Manager::init();