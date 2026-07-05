<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

class Banae_Page_Title {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		// Content Section
		$widget->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_responsive_control(
			'title_align',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .banae-page-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'use_custom_title',
			[
				'label' => __( 'Use Custom Title', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
			]
		);

		$widget->add_control(
			'custom_title_text',
			[
				'label' => __( 'Custom Title', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => get_bloginfo( 'name' ),
				'condition' => [
					'use_custom_title' => 'yes',
				],
			]
		);

		$widget->add_control(
			'custom_link',
			[
				'label' => esc_html__( 'Custom Link', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
				'condition' => [
					'use_custom_title' => 'yes',
				],
			]
		);


		$widget->add_control(
			'heading_tag',
			[
				'label' => __( 'HTML Tag', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
			]
		);

		$widget->add_control(
			'title_link',
			[
				'label' => __( 'Link to Homepage', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'use_custom_title!' => 'yes',
				],
			]
		);

		$widget->end_controls_section();

		// Style Section
		$widget->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .banae-page-title a, {{WRAPPER}} .banae-page-title' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-page-title',
			]
		);

		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'label' => __( 'Text Shadow', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-page-title',
			]
		);

		$widget->end_controls_section();
	}
}