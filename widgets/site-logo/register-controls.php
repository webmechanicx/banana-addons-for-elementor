<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;

class Banae_Site_Logo {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {
		/**
		 * Content Tab
		 */
		$widget->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'use_site_logo',
			[
				'label' => __( 'Use Site Logo', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'default' => 'yes',
				'description' => __( 'Use WordPress customizer site logo or upload custom logo.', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'custom_logo',
			[
				'label' => __( 'Custom Logo', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'use_site_logo!' => 'yes',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'logo_size',
				'default' => 'full',
				'separator' => 'none',
			]
		);

		$widget->add_control(
			'link_to_home',
			[
				'label' => __( 'Link to Homepage', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'fallback_logo',
			[
				'label' => __( 'Fallback Logo', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'description' => __( 'Displayed if no site logo or custom logo found.', 'banana-addons-for-elementor' ),
			]
		);

		$widget->end_controls_section();

		/**
		 * Style Tab
		 */
		$widget->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'logo_align',
			[
				'label' => __( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .banae-site-logo' => 'text-align: {{VALUE}};',
				],
			]
		);

		$widget->add_responsive_control(
			'logo_width',
			[
				'label' => __( 'Logo Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 20, 'max' => 500 ],
					'%' => [ 'min' => 10, 'max' => 100 ],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-site-logo img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'logo_max_height',
			[
				'label' => __( 'Max Height', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 20, 'max' => 500 ],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-site-logo img' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'logo_border',
				'selector' => '{{WRAPPER}} .banae-site-logo img',
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'logo_box_shadow',
				'selector' => '{{WRAPPER}} .banae-site-logo img',
			]
		);

		$widget->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-site-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$widget->add_control(
			'site_logo_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-site-logo img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'site_logo_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-site-logo img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();
	}
}