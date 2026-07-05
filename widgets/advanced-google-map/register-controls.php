<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

class Banae_Advanced_Google_Map_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {
		$widget->start_controls_section(
			'banae_advanced_section_map',
			[
				'label' => __( 'Map Settings', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'latitude',
			[
				'label' => __( 'Latitude', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '40.730610',
			]
		);

		$widget->add_control(
			'longitude',
			[
				'label' => __( 'Longitude', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '-73.935242',
			]
		);

		$widget->add_control(
			'zoom',
			[
				'label' => __( 'Zoom Level', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'default' => [
					'size' => 12,
				],
			]
		);

		$widget->add_control(
			'map_style',
			[
				'label' => __( 'Map Theme', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => [
					'standard' => __( 'Standard', 'banana-addons-for-elementor' ),
					'silver' => __( 'Silver', 'banana-addons-for-elementor' ),
					'retro' => __( 'Retro', 'banana-addons-for-elementor' ),
					'dark' => __( 'Dark', 'banana-addons-for-elementor' ),
					'night' => __( 'Night', 'banana-addons-for-elementor' ),
					'aubergine' => __( 'Aubergine', 'banana-addons-for-elementor' ),
				],
			]
		);

		$widget->add_control(
			'marker_label',
			[
				'label' => __( 'Marker Label', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'My Location',
			]
		);

		$widget->end_controls_section();
	}
}