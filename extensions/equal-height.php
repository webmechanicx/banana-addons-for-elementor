<?php
/**
 * Equal Height extension class
 *
 * @package Banana_Addons
 */
namespace Banana_Addons\Elementor\Extensions;

use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Element_Section;

defined( 'ABSPATH' ) || die();

class Equal_Height {

	private static $instance = null;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Enqueue preview scripts for the extension
	 * 
	 * @return void
	 */
	public static function enqueue_preview_scripts() {
		wp_enqueue_script( 'banae-vendor-equal-height' );
		wp_enqueue_script( 'banana-equal-height' );
	}

	/**
	 * Register extension's dependency scripts
	 * 
	 * @return void
	 */
	public static function register_scripts() {

		// Equal Height
		wp_register_script(
			'banana-equal-height',
			BANANA_ADDONS_ASSETS . 'extensions/equal-height/js/equal-height.min.js',
			[ 'jquery', 'banae-vendor-equal-height' ],
			BANANA_ADDONS_VERSION,
			true
		);
	}

	/**
	 * Add controls section for the extension
	 *
	 * @param Element_Base $element The Elementor element to which the controls will be added.
	 */
	public static function add_controls_section( Element_Base $element ) {

		$tabs = Controls_Manager::TAB_ADVANCED;

		if ( 'section' === $element->get_name() || 'column' === $element->get_name() || 'container' === $element->get_name() ) {
			$tabs = Controls_Manager::TAB_LAYOUT;
		}

		$element->start_controls_section(
			'_section_banae_equal_height',
			[
				'label' => __( 'Equal Height', 'banana-addons-for-elementor' ) . '<i class="icofont-banana"></i>',
				'tab' => $tabs,
			]
		);

		$element->add_control(
			'banae_equal_height',
			[
				'label' => __( 'Enable Equal Height', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => '',
				'prefix_class' => 'banae-equal-height-',
				'render_type' => 'template',
			]
		);

		$element->end_controls_section();
	}

}