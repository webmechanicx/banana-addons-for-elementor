<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Banae_Dual_Button_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		// Primary Button
		$widget->start_controls_section(
			'banae_button_primary_content',
			[
				'label' => esc_html__( 'Primary Button', 'banana-addons-for-elementor' ),
			]
		);
		$widget->add_control(
			'banae_button_primary_text',
			[
				'label' => esc_html__( 'Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Button', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'banae_button_primary_link',
			[
				'label' => esc_html__( 'Link', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html( 'https://wpmet.com' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);


		$widget->add_control(
			'banae_button_primary_icons',
			[
				'label' => __( 'Icon', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'banae_button_primary_icon',
				'default' => [
					'value' => '',
				],
			]
		);

		$widget->add_control(
			'banae_dual_button_primary_icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'before',
				'options' => [
					'before' => [
						'title' => esc_html__( 'Before', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => esc_html__( 'After', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_primary_icon_font_size',
			[
				'label' => esc_html__( 'Icon font size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__primary > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .banae-dual-btn__primary > svg' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_primary_icon_before_spacing',
			[
				'label' => esc_html__( 'Icon Spacing Before', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'default' => [
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__primary > i' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .banae-dual-btn__primary > svg' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'banae_dual_button_primary_icon_position' => 'before',
				]
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_primary_icon_after_spacing',
			[
				'label' => esc_html__( 'Icon Spacing After', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'default' => [
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__primary > i' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .banae-dual-btn__primary > svg' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'banae_dual_button_primary_icon_position' => 'after',
				]
			]
		);

		$widget->end_controls_section();

		// Second Button Section
		$widget->start_controls_section(
			'banae_button_secondary_content',
			[
				'label' => esc_html__( 'Secondary Button', 'banana-addons-for-elementor' ),
			]
		);
		$widget->add_control(
			'banae_button_secondary_text',
			[
				'label' => esc_html__( 'Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Button', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'banae_button_secondary_link',
			[
				'label' => esc_html__( 'Link', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://sample-link.com', 'banana-addons-for-elementor' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'banae_button_secondary_icons',
			[
				'label' => __( 'Icon', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'banae_button_secondary_icon',
				'default' => [
					'value' => '',
				],
			]
		);

		$widget->add_control(
			'banae_dual_button_secondary_icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'before',
				'options' => [
					'before' => [
						'title' => esc_html__( 'Before', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => esc_html__( 'After', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_secondary_icon_font_size',
			[
				'label' => esc_html__( 'Icon font size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__secondary > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .banae-dual-btn__secondary > svg' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_secondary_icon_before_spacing',
			[
				'label' => esc_html__( 'Icon Spacing Before', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'default' => [
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__secondary > i' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .banae-dual-btn__secondary > svg' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'banae_dual_button_secondary_icon_position' => 'before',
				]
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_secondary_icon_after_spacing',
			[
				'label' => esc_html__( 'Icon Spacing After', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'default' => [
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__secondary > i' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .banae-dual-btn__secondary > svg' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'banae_dual_button_secondary_icon_position' => 'after',
				]
			]
		);

		$widget->end_controls_section();

		// Center Text Section
		$widget->start_controls_section(
			'banae_dual_button_content_sction',
			[
				'label' => esc_html__( 'Center Text', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'banae_show_button_center_text',
			[
				'label' => esc_html__( 'Show Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$widget->add_control(
			'banae_button_center_text',
			[
				'label' => esc_html__( 'Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Or', 'banana-addons-for-elementor' ),
				'condition' => [
					' banae_show_button_center_text' => 'yes',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_align',
			[
				'label' => esc_html__( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-button-text__middle' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_section();

		// Primary Button Style tab
		$widget->start_controls_section(
			'banae_dual_button_common_style_section',
			[
				'label' => esc_html__( 'Common', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_gap',
			[
				'label' => __( 'Space Between Buttons', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'(desktop+){{WRAPPER}} .banae-dual-btn__primary' => 'margin-right: calc({{banae_dual_button_gap.SIZE}}{{UNIT}}/2);',
					'(desktop+){{WRAPPER}} .banae-dual-btn__secondary' => 'margin-left: calc({{banae_dual_button_gap.SIZE}}{{UNIT}}/2);',

					'(tablet){{WRAPPER}} .banae-dual-btn__primary' => 'margin-right: calc({{banae_dual_button_gap_tablet.SIZE || banae_dual_button_gap.SIZE}}{{UNIT}}/2); margin-bottom: 0;',
					'(tablet){{WRAPPER}} .banae-dual-btn__secondary' => 'margin-left: calc({{banae_dual_button_gap_tablet.SIZE || banae_dual_button_gap.SIZE}}{{UNIT}}/2); margin-top: 0;',

					'(mobile){{WRAPPER}} .banae-dual-btn__primary' => 'margin-right: calc({{banae_dual_button_gap_mobile.SIZE || banae_dual_button_gap_tablet.SIZE || banae_dual_button_gap.SIZE}}{{UNIT}}/2); margin-bottom: 0;',
					'(mobile){{WRAPPER}} .banae-dual-btn__secondary' => 'margin-left: calc({{banae_dual_button_gap_mobile.SIZE || banae_dual_button_gap_tablet.SIZE || banae_dual_button_gap.SIZE}}{{UNIT}}/2); margin-top: 0;',
				],
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_align_x',
			[
				'label' => __( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					]
				],
				'toggle' => true,
				'prefix_class' => 'banae-dual-button-%s-align-'
			]
		);

		$widget->end_controls_section();

		// Primary Button Style tab
		$widget->start_controls_section(
			'banae_dual_button_primary_style_section',
			[
				'label' => esc_html__( 'Primary Button', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'banae_dual_button_primary_typography',
				'label' => esc_html__( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-dual-btn__primary',
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_primary_align',
			[
				'label' => esc_html__( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__primary' => 'text-align: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'banae_dual_button_primary_shadow',
				'label' => esc_html__( 'Box Shadow', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-dual-btn__primary',
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'banae_dual_button_primary_border',
				'label' => esc_html__( 'Border', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-dual-btn__primary',
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_primary_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_primary_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->start_controls_tabs( 'banae_dual_button_primary_style_tabs' );

		// Normal style
		$widget->start_controls_tab(
			'banae_dual_button_primary_normal',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'banae_dual_button_primary_background',
				'label' => esc_html__( 'Background', 'banana-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-dual-btn__primary',
			]
		);

		$widget->add_control(
			'banae_dual_button_primary_color',
			[
				'label' => esc_html__( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__primary' => 'color: {{VALUE}};',
					'{{WRAPPER}} .banae-dual-btn__primary svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_tab();

		// Primary Button Hover style
		$widget->start_controls_tab(
			'banae_dual_button_primary_style_hover',
			[
				'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'banae_dual_button_primary_hover_bg',
				'label' => esc_html__( 'Background', 'banana-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-dual-btn__primary:hover',
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'banae_dual_button_primary_hover_color',
			[
				'label' => esc_html__( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__primary:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .banae-dual-btn__primary:hover svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->end_controls_section();

		// Secondary Button Style Section
		$widget->start_controls_section(
			'banae_dual_button_secondary_style_section',
			[
				'label' => esc_html__( 'Secondary Button', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'banae_dual_button_secondary_typography',
				'label' => esc_html__( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-dual-btn__secondary',
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_secondary_align',
			[
				'label' => esc_html__( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__secondary' => 'text-align: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'banae_dual_button_secondary_shadow',
				'label' => esc_html__( 'Box Shadow', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-dual-btn__secondary',
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'banae_dual_button_secondary_border',
				'label' => esc_html__( 'Border', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-dual-btn__secondary',
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_secondary_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__secondary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_secondary_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->start_controls_tabs( 'banae_dual_button_secondary_style' );

		// Secondary Button Normal style
		$widget->start_controls_tab(
			'banae_dual_button_secondary_normal_style',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'banae_dual_button_secondary_bg',
				'label' => esc_html__( 'Background', 'banana-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-dual-btn__secondary',
			]
		);

		$widget->add_control(
			'banae_dual_button_secondary_color',
			[
				'label' => esc_html__( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__secondary' => 'color: {{VALUE}};',
					'{{WRAPPER}} .banae-dual-btn__secondary svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_tab();

		// Secondary Button Hover style
		$widget->start_controls_tab(
			'banae_dual_button_secondary_hover_style',
			[
				'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'banae_dual_button_secondary_hover_bg',
				'label' => esc_html__( 'Background', 'banana-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-dual-btn__secondary:hover',
			]
		);

		$widget->add_control(
			'banae_dual_button_secondary_hover_color',
			[
				'label' => esc_html__( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .banae-dual-btn__secondary:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .banae-dual-btn__secondary:hover svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->end_controls_section();

		// Center Text style
		$widget->start_controls_section(
			'banae_dual_button_center_text_style_section',
			[
				'label' => esc_html__( 'Center Text', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					' banae_show_button_center_text' => 'yes',
				]
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_center_text_width',
			[
				'label' => esc_html__( 'Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 140,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-button__wrapper .banae-button-text__middle' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_center_text_height',
			[
				'label' => esc_html__( 'Height', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 140,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-button__wrapper .banae-button-text__middle' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'banae_dual_button_center_text_bg',
				'label' => esc_html__( 'Background', 'banana-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-dual-button__wrapper .banae-button-text__middle',
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'banae_dual_button_center_text_color',
			[
				'label' => esc_html__( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .banae-dual-button__wrapper .banae-button-text__middle' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'banae_dual_button_center_text_typography',
				'label' => esc_html__( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-dual-button__wrapper .banae-button-text__middle',
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'banae_dual_button_center_text_border',
				'label' => esc_html__( 'Border', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-dual-button__wrapper .banae-button-text__middle',
				'separator' => 'before',
			]
		);

		$widget->add_responsive_control(
			'banae_dual_button_center_text_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-dual-button__wrapper .banae-button-text__middle' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'banae_dual_button_center_text_shadow',
				'label' => esc_html__( 'Box Shadow', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-dual-button__wrapper .banae-button-text__middle',
			]
		);

		$widget->end_controls_section();
	}
}