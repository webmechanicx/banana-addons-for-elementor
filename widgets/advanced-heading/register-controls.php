<?php
if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Banana_Addons\Elementor\Helper;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Banae_Advanced_Heading_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		$widget->start_controls_section(
			'banae_advanced_heading_section_title',
			[
				'label' => __( 'Heading', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'advanced_heading_before',
			[
				'label' => __( 'Before Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Text Before', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Text Before', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_control(
			'advanced_heading_center',
			[
				'label' => __( 'Text Center', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Text Center', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Text Center', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_control(
			'advanced_heading_after',
			[
				'label' => __( 'Text After', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Text After', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Text After', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_control(
			'display_background_text',
			[
				'label' => __( 'Background Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
				'style_transfer' => true,
			]
		);

		$widget->add_control(
			'background_text',
			[
				'label' => __( 'Background Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Background Text', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Background Text', 'banana-addons-for-elementor' ),
				'condition' => [
					'display_background_text' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'banae_advanced_heading_section_link',
			[
				'label' => __( 'Link', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'advanced_heading_link',
			[
				'label' => __( 'Link', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://example.com/', 'banana-addons-for-elementor' ),
				'separator' => 'after',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'banae_advanced_heading_section_position',
			[
				'label' => __( 'Tag & Alignment', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'advanced_heading_title_tag',
			[
				'label' => __( 'HTML Tag', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => Helper::banae_title_tags(),
				'toggle' => false,
			]
		);

		$widget->add_responsive_control(
			'heading_align',
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
					]
				],
				'default' => 'left',
				'toggle' => false,
				'prefix_class' => 'banae-align-',
				'selectors_dictionary' => [
					'left' => 'justify-content: flex-start',
					'center' => 'justify-content: center',
					'right' => 'justify-content: flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-tag' => '{{VALUE}}'
				]
			]
		);

		$widget->add_responsive_control(
			'heading_position',
			[
				'label' => __( 'Layout', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'inline' => [
						'title' => __( 'Inline', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-ellipsis-h',
					],
					'block' => [
						'title' => __( 'Block', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-menu-bar',
					]
				],
				'toggle' => false,
				'selectors_dictionary' => [
					'inline' => 'flex-direction: row',
					'block' => 'flex-direction: column',
				],
				'default' => 'inline',
				'prefix_class' => 'banae-layout-',
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-wrap' => '{{VALUE}}',
				]
			]
		);

		$widget->end_controls_section();

		// Text Style Tab
		$widget->start_controls_section(
			'banae_advanced_heading_section_text_before',
			[
				'label' => __( 'Text Before', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'before_text_blend_mode',
			[
				'label' => __( 'Blend Mode', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'none',
				'options' => [
					'' => __( 'Normal', 'banana-addons-for-elementor' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'difference' => 'Difference',
					'exclusion' => 'Exclusion',
					'hue' => 'Hue',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-before' => 'mix-blend-mode: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'before_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ff7272',
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-before' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'before_text_gradient',
				'label' => esc_html__( 'Gradient Color', 'banana-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-advanced-heading-before',
				'fields_options' => [
					'background' => [
						'label' => 'Background Color'
					],
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'before_text_typography',
				'selector' => '{{WRAPPER}} .banae-advanced-heading-before',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'before_text_shadow',
				'label' => __( 'Text Shadow', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-advanced-heading-before',
			]
		);

		$widget->add_control(
			'hr_text_padding_before',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$widget->add_responsive_control(
			'before_text_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'before_text_spacing',
			[
				'label' => __( 'Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}.banae-layout-inline .banae-advanced-heading-before' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.banae-layout-block .banae-advanced-heading-before' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'hr_text_border_before',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'before_text_border',
				'selector' => '{{WRAPPER}} .banae-advanced-heading-before',
			]
		);

		$widget->add_control(
			'before_text_border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Text After Style section
		$widget->start_controls_section(
			'banae_advanced_heading_section_text_center',
			[
				'label' => __( 'Text Center', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'center_text_blend_mode',
			[
				'label' => __( 'Blend Mode', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'none',
				'options' => [
					'' => __( 'Normal', 'banana-addons-for-elementor' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'difference' => 'Difference',
					'exclusion' => 'Exclusion',
					'hue' => 'Hue',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-center' => 'mix-blend-mode: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'center_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#232323',
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-center' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'center_text_gradient',
				'label' => esc_html__( 'Gradient Color', 'banana-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-advanced-heading-center',
				'fields_options' => [
					'background' => [
						'label' => 'Background Color'
					],
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'center_text_typography',
				'selector' => '{{WRAPPER}} .banae-advanced-heading-center',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'center_text_shadow',
				'label' => __( 'Text Shadow', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-advanced-heading-center',
			]
		);

		$widget->add_control(
			'hr_center_text_padding_before',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$widget->add_responsive_control(
			'center_text_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-center' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'center_text_spacing',
			[
				'label' => __( 'Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}.banae-layout-inline .banae-advanced-heading-center' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.banae-layout-block .banae-advanced-heading-center' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'hr_center_text_border_before',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'center_text_border',
				'selector' => '{{WRAPPER}} .banae-advanced-heading-center',
			]
		);

		$widget->add_control(
			'center_text_border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-center' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'banae_advanced_heading_section_text_after',
			[
				'label' => __( 'Text After', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'after_text_blend_mode',
			[
				'label' => __( 'Blend Mode', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'none',
				'options' => [
					'' => __( 'Normal', 'banana-addons-for-elementor' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'difference' => 'Difference',
					'exclusion' => 'Exclusion',
					'hue' => 'Hue',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-after' => 'mix-blend-mode: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'after_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#232323',
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-after' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'after_text_gradient',
				'label' => esc_html__( 'Gradient Color', 'banana-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-advanced-heading-after',
				'fields_options' => [
					'background' => [
						'label' => 'Background Color'
					],
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'after_text_typography',
				'selector' => '{{WRAPPER}} .banae-advanced-heading-after',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'after_text_shadow',
				'label' => __( 'Text Shadow', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-advanced-heading-after',
			]
		);

		$widget->add_control(
			'hr_after_text_padding_before',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$widget->add_responsive_control(
			'after_text_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'after_text_spacing',
			[
				'label' => __( 'Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}.banae-layout-inline .banae-advanced-heading-after' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.banae-layout-block .banae-advanced-heading-after' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'hr_after_text_border_before',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'after_text_border',
				'selector' => '{{WRAPPER}} .banae-advanced-heading-after',
			]
		);

		$widget->add_control(
			'after_text_border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Background Text Style
		$widget->start_controls_section(
			'advanced_heading_section_style_background',
			[
				'label' => __( 'Background Text', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'warning_background_text',
			[
				'label' => false,
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( '<strong>Turn On</strong> Background Text under content tab', 'banana-addons-for-elementor' ),
				'condition' => [
					'display_background_text!' => 'yes',
				],
			]
		);

		$widget->add_control(
			'background_text_color',
			[
				'label' => __( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fceeee',
				'condition' => [
					'display_background_text' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-wrap:before' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'background_text_typography',
				'selector' => '{{WRAPPER}} .banae-advanced-heading-wrap:before',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'condition' => [
					'display_background_text' => 'yes',
				],
			]
		);

		$widget->add_control(
			'background_offset_toggle',
			[
				'label' => __( 'Offset', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'banana-addons-for-elementor' ),
				'label_on' => __( 'Custom', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'condition' => [
					'display_background_text' => 'yes',
				],
			]
		);

		$widget->start_popover();

		$widget->add_responsive_control(
			'background_horizontal_position',
			[
				'label' => __( 'Horizontal Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'condition' => [
					'background_offset_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-wrap:before' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'background_vertical_position',
			[
				'label' => __( 'Vertical Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 200,
					],
				],
				'condition' => [
					'background_offset_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-wrap:before' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->end_popover();

		$widget->end_controls_section();

		// Text Border Style
		$widget->start_controls_section(
			'advanced_heading_section_style_border',
			[
				'label' => __( 'Heading Border', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'border_type',
			[
				'label' => __( 'Border Type', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => __( 'None', 'banana-addons-for-elementor' ),
					'solid' => __( 'Solid', 'banana-addons-for-elementor' ),
					'double' => __( 'Double', 'banana-addons-for-elementor' ),
					'dotted' => __( 'Dotted', 'banana-addons-for-elementor' ),
					'dashed' => __( 'Dashed', 'banana-addons-for-elementor' ),
					'groove' => __( 'Groove', 'banana-addons-for-elementor' ),
				],
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-border:after' => 'border-bottom-style: {{VALUE}};',
				],
			]
		);

		$widget->add_responsive_control(
			'border_length',
			[
				'label' => __( 'Length', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 800,
					],
				],
				'condition' => [
					'border_type!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-border:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'border_width',
			[
				'label' => __( 'Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 3
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'border_type!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-border:after' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'border_color',
			[
				'label' => __( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_type!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-border:after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'border_radius',
			[
				'label' => __( 'Border radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'condition' => [
					'border_type!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-border:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$widget->add_control(
			'border_offset_toggle',
			[
				'label' => __( 'Offset', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'banana-addons-for-elementor' ),
				'label_on' => __( 'Custom', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'condition' => [
					'border_type!' => 'none',
				],
			]
		);

		$widget->start_popover();

		$widget->add_responsive_control(
			'border_horizontal_position',
			[
				'label' => __( 'Horizontal Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => -20,
						'max' => 100,
					],
				],
				'condition' => [
					'border_offset_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-border:after' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'border_vertical_position',
			[
				'label' => __( 'Vertical Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'condition' => [
					'border_offset_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .banae-advanced-heading-border:after' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->end_popover();

		$widget->end_controls_section();

	}
}