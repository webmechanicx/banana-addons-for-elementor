<?php
/**
 * 
 * Plugin Assets Manager Class
 * 
 * Manages and loads all plugin scripts and styles efficiently 
 * from a single, organized class.
 * 
 * @package Banana_Addons
 */

namespace Banana_Addons\Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Banana_Addons\Elementor\Addons_Manager;
use Banana_Addons\Elementor\Extensions_Manager;

class Assets_Manager {

	/**
	 * Enqeue admin side styles and scripts
	 * 
	 */
	public static function admin_enqueue_scripts() {

		// Icon Styles
		wp_enqueue_style( 'banae-admin-fonticon-style', BANANA_ADDONS_ASSETS . 'css/icofont.min.css' );

	}

	/**
	 * Register frontend assets.
	 *
	 * Frontend assets handler to load widgets assets on demand.
	 *
	 * @return void
	 */
	public static function frontend_register() {

		// Main Plugin Styles
		wp_enqueue_style( 'banana-addons-main-style', BANANA_ADDONS_ASSETS . 'css/banana-addons.min.css', false, BANANA_ADDONS_VERSION, 'all' );

		// Register Addons Specific Scripts and Styles
		wp_register_script( 'banana-addons-dist', BANANA_ADDONS_ASSETS . 'js/banana-addons.min.js', array( 'jquery' ), BANANA_ADDONS_VERSION, false );
		wp_enqueue_script( 'banana-addons-dist' );

		// prepare to register dependencies
		foreach ( Addons_Manager::$dependency_widgets as $key => $dependencies ) {

			// get version type for the widget
			$version_type = Addons_Manager::$default_widgets ? Addons_Manager::$default_widgets[ $key ]['tags'] : BANANA_ADDONS_VERSION_TYPE;

			// iterate through each dependencies
			foreach ( $dependencies as $k => $assets ) {

				// iterate through each assets
				foreach ( $assets as $id => $asset_path ) {

					// check if asset is css
					if ( $k === 'style' && ucfirst( $version_type ) === BANANA_ADDONS_VERSION_TYPE ) {
						// register widget's static css assets
						wp_register_style( $id, BANANA_ADDONS_ASSETS . $asset_path, array(), BANANA_ADDONS_VERSION );
					}

					// check if asset is script
					if ( $k === 'script' && ucfirst( $version_type ) === BANANA_ADDONS_VERSION_TYPE ) {

						// setup exception
						if ( $key === 'pdf-viewer' ) {
							// PDF.js from assets/vendor.
							wp_register_script( 'pdfjs-dist', BANANA_ADDONS_ASSETS . 'vendor/pdfjs/js/pdf.min.js', array(), BANANA_ADDONS_VERSION, true );

							// inline viewer script will depend on pdfjs-dist and jquery
							wp_register_script( 'banae-pdf-viewer-script', BANANA_ADDONS_ASSETS . 'widgets/pdf-viewer/js/pdf-viewer.min.js', array( 'jquery' ), BANANA_ADDONS_VERSION, true );

							//wp_enqueue_script( 'pdfjs-dist' );
							//wp_enqueue_script( 'banae-pdf-viewer-script' );

							// Provide pdf.workerSrc to pdfjs
							$worker_url = BANANA_ADDONS_ASSETS . 'vendor/pdfjs/js/pdf.worker.min.js';
							$inline = "if (window['pdfjsLib']) { window['pdfjsLib'].GlobalWorkerOptions.workerSrc = '" . esc_js( $worker_url ) . "'; }";
							wp_add_inline_script( 'pdfjs-dist', $inline );

						} else {
							// register widget's static js assets
							wp_register_script( $id, BANANA_ADDONS_ASSETS . $asset_path, array(), BANANA_ADDONS_VERSION, true );
						}

					}

				}
			}
		}

		// Register extension's dependency scripts
		self::extensions_frontend_register();
	}

	/**
	 * Register extensions frontend assets.
	 *
	 * Frontend assets handler to load extention assets on demand.
	 *
	 * @return void
	 */
	public static function extensions_frontend_register() {

		// Register extension assets
		foreach ( Extensions_Manager::$dependency_extensions as $key => $dependencies ) {
			// get version type for the extention
			$version_type = Extensions_Manager::$default_extensions ? Extensions_Manager::$default_extensions[ $key ]['tags'] : BANANA_ADDONS_VERSION_TYPE;

			// iterate through each dependencies
			foreach ( $dependencies as $k => $assets ) {

				// iterate through each assets
				foreach ( $assets as $id => $asset_path ) {

					if ( 'style' === $k && ucfirst( $version_type ) === BANANA_ADDONS_VERSION_TYPE ) {
						// register extention's static css assets
						wp_register_style( $id, BANANA_ADDONS_ASSETS . $asset_path, array(), BANANA_ADDONS_VERSION );

					} elseif ( 'script' === $k && ucfirst( $version_type ) === BANANA_ADDONS_VERSION_TYPE ) {
						// register extention's static js assets
						wp_register_script( $id, BANANA_ADDONS_ASSETS . $asset_path, array( 'jquery' ), BANANA_ADDONS_VERSION, true );
					}

				}
			}
		}
	}

	/**
	 * Enqueue editor assets
	 *
	 * @return void
	 */
	public static function editor_enqueue() {

		// Icon Styles
		wp_enqueue_style( 'banae-admin-fonticon-style', BANANA_ADDONS_ASSETS . 'css/icofont.min.css' );

		// Editor Styles
		wp_register_style( 'banae-editor-style', BANANA_ADDONS_ASSETS . 'admin/css/editor-style.min.css', array(), BANANA_ADDONS_VERSION );
		wp_enqueue_style( 'banae-editor-style' );

	}

}