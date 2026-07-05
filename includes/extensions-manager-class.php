<?php
/**
 * 
 * Plugin Extensions Manager Class
 * 
 * @package Banana_Addons
 */

namespace Banana_Addons\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Banana_Addons\Elementor\Extensions as Features;

class Extensions_Manager {

	/**
	 * 
	 * the default extensions array
	 * 
	 * @static
	 * 
	 * @return array
	 */
	public static $default_extensions = [];

	/**
	 * 
	 * Static property to hold extensions from db
	 * 
	 * @static
	 * 
	 */
	public static $is_extension_activated = [];

	/**
	 * 
	 * the dependency extensions array
	 * 
	 * @static
	 * 
	 * @return array
	 */
	public static $dependency_extensions = [];

	/**
	 * Initialize
	 */
	public static function init() {

		// load extension classes
		self::extension_manager();

		// Register Extensions
		self::register_extensions();
	}

	/**
	 * extension_manager to prepare and add static data
	 * 
	 * @return void
	 */
	protected static function extension_manager() {

		// get all extensions
		self::$default_extensions = self::get_banana_extensions();

		// get widget settings from db
		self::$is_extension_activated = get_option( 'banae_extension_settings', [] );

		// checking if widget actived
		if ( self::$is_extension_activated ) {
			foreach ( self::$is_extension_activated as $key => $value ) {
				if ( isset( self::$default_extensions[ $key ]['dependency'] ) ) {
					self::$dependency_extensions[ $key ] = self::$default_extensions[ $key ]['dependency'];
				}
			}
		}

	}

	/**
	 * 
	 * Get extensions name from config.json file
	 * 
	 * @return array
	 */
	protected static function get_banana_extensions() {

		// set extensions config file
		$extensionData = BANANA_ADDONS_EXTENSIONS . '/config.json';

		// Check if the file exists
		if ( file_exists( $extensionData ) ) {
			// Read the config.json file content
			$json_config = file_get_contents( $extensionData );

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
	 * Enable extensions or features
	 * 
	 * @param string $extension_key
	 * 
	 * @return void
	 */
	protected static function enable_extension( $extension_key ) {

		switch ( $extension_key ) {

			case 'wrapper-link':
				add_action( 'elementor/element/container/section_layout/after_section_end', [ Features\Wrapper_Link::class, 'add_controls_section' ], 1 );
				add_action( 'elementor/element/column/section_advanced/after_section_end', [ Features\Wrapper_Link::class, 'add_controls_section' ], 1 );
				add_action( 'elementor/element/section/section_advanced/after_section_end', [ Features\Wrapper_Link::class, 'add_controls_section' ], 1 );
				add_action( 'elementor/element/common/_section_style/after_section_end', [ Features\Wrapper_Link::class, 'add_controls_section' ], 1 );
				add_action( 'elementor/frontend/before_render', [ Features\Wrapper_Link::class, 'before_section_render' ], 1 );
				break;

			case 'equal-height':
				add_action( 'elementor/element/container/section_layout/after_section_end', [ Features\Equal_Height::class, 'add_controls_section' ], 1 );
				add_action( 'elementor/element/section/section_advanced/after_section_end', [ Features\Equal_Height::class, 'add_controls_section' ], 1 );
				add_action( 'elementor/frontend/before_register_scripts', [ Features\Equal_Height::class, 'register_scripts' ] );
				add_action( 'elementor/preview/enqueue_scripts', [ Features\Equal_Height::class, 'enqueue_preview_scripts' ] );
				add_action( 'elementor/frontend/after_register_scripts', [ Features\Equal_Height::class, 'enqueue_preview_scripts' ] );
				break;

			case 'banana-clone':
				add_action( 'admin_action_banae_clone_post', [ Features\Banana_Clone::class, 'banae_clone_post' ] );
				add_filter( 'post_row_actions', [ Features\Banana_Clone::class, 'add_clone_link' ], 10, 2 );
				add_filter( 'page_row_actions', [ Features\Banana_Clone::class, 'add_clone_link' ], 10, 2 );
				break;
		}
	}

	/**
	 * Register all our extensions
	 * 
	 * @return void
	 */
	public static function register_extensions() {

		// iterate through each default extensions
		foreach ( self::$default_extensions as $key => $extension ) {

			// check if the current extension is enable
			if ( isset( self::$is_extension_activated[ $key ] ) && ! empty( self::$is_extension_activated[ $key ] ) && ucfirst( $extension['tags'] ) === BANANA_ADDONS_VERSION_TYPE ) {

				// set the extension file with PATH
				$extension_class = BANANA_ADDONS_EXTENSIONS . '/' . $key . '.php';

				// check if file exist
				if ( file_exists( $extension_class ) ) {

					require_once $extension_class;

					//enable the extension
					self::enable_extension( $key );
				}
			}

		}

	}
}

Extensions_Manager::init();