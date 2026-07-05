<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;

class Banae_OpenStreet_Map {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		// === MAP SETTINGS ===
		$widget->start_controls_section(
			'openstreet_map_settings',
			[
				'label' => __( 'Map Settings', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'map_style',
			[
				'label' => __( 'Map Style', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => [
					'standard' => __( 'Standard', 'banana-addons-for-elementor' ),
					'light' => __( 'Light', 'banana-addons-for-elementor' ),
					'dark' => __( 'Dark', 'banana-addons-for-elementor' ),
					'drawing' => __( 'Drawing', 'banana-addons-for-elementor' ),
					'satellite' => __( 'Satellite (Esri)', 'banana-addons-for-elementor' ),
				],
			]
		);

		$widget->add_control(
			'map_height',
			[
				'label' => __( 'Map Height (px)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 400,
			]
		);

		$widget->add_control(
			'scroll_wheel',
			[
				'label' => __( 'Enable Scroll Zoom', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'zoom_level',
			[
				'label' => __( 'Zoom Level', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '' ],
				'range' => [
					'' => [ 'min' => 1, 'max' => 18, 'step' => 1 ],
				],
				'default' => [ 'size' => 10 ],
			]
		);

		$widget->add_control(
			'open_popups',
			[
				'label' => __( 'Popup Always Open?', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'global_marker_size',
			[
				'label' => __( 'Marker Size (px)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '' ],
				'range' => [
					'' => [ 'min' => 1, 'step' => 1 ],
				],
				'default' => [
					'size' => 16,
				],
				'separator' => 'before',
			]
		);

		$widget->end_controls_section();

		// === MARKERS SECTION ===
		$widget->start_controls_section(
			'markers_section',
			[
				'label' => __( 'Markers', 'banana-addons-for-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'marker_lat',
			[
				'label' => __( 'Latitude', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '23.8103',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'marker_lng',
			[
				'label' => __( 'Longitude', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '90.4125',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'marker_icon',
			[
				'label' => __( 'Marker Icon', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);

		$repeater->add_control(
			'marker_popup',
			[
				'label' => __( 'Popup Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Marker description here', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'markers',
			[
				'label' => __( 'Markers List', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ marker_popup }}}',
			]
		);

		$widget->end_controls_section();

		// Map Style Tabs Section
		$widget->start_controls_section(
			'popup_style_section',
			[
				'label' => __( 'Popup Style', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'popup_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .leaflet-popup-content-wrapper' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .leaflet-popup-tip' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'popup_typography',
				'selector' => '{{WRAPPER}} .leaflet-popup-content',
			]
		);

		$widget->add_control(
			'popup_text_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .leaflet-popup-content' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'popup_border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 50, 'step' => 1 ],
				],
				'selectors' => [
					'{{WRAPPER}} .leaflet-popup-content-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'popup_close_btn_color',
			[
				'label' => __( 'Close Button Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .leaflet-popup-close-button' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_section();

	}
}