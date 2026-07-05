<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Banana_Addons\Elementor\Helper;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Banae_Flip_Box_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		$widget->start_controls_section(
			'flip_box_section_content',
			[
				'label' => esc_html__( 'Front', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'media_element',
			[
				'label' => esc_html__( 'Media', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'none' => [
						'title' => esc_html__( 'None', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-ban',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-image-bold',
					],
					'icon' => [
						'title' => esc_html__( 'Icon', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-star',
					],
				],
				'default' => 'icon',
			]
		);

		$widget->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'media_element' => 'image',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Actually its `image_size`
				'default' => 'thumbnail',
				'condition' => [
					'media_element' => 'image',
				],
			]
		);

		$widget->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-images',
					'library' => 'fa-solid',
				],
				'condition' => [
					'media_element' => 'icon',
				],
			]
		);

		$widget->add_control(
			'title_text_a',
			[
				'label' => esc_html__( 'Title', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'This is the heading', 'banana-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter your title', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'description_text_a',
			[
				'label' => esc_html__( 'Description', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'banana-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter your description', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				],
				'rows' => 10,
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'section_side_b_content',
			[
				'label' => esc_html__( 'Back', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'title_text_b',
			[
				'label' => esc_html__( 'Title', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'This is the heading', 'banana-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter your title', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);

		$widget->add_control(
			'description_text_b',
			[
				'label' => esc_html__( 'Description', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'banana-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter your description', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				],
				'rows' => 10,
			]
		);

		$widget->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Click Here', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'link_type',
			[
				'label' => esc_html__( 'Apply Link On', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'box' => esc_html__( 'Whole Box', 'banana-addons-for-elementor' ),
					'button' => esc_html__( 'Button Only', 'banana-addons-for-elementor' ),
				],
				'default' => 'button',
				'condition' => [
					'link[url]!' => '',
				],
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'section_box_settings',
			[
				'label' => esc_html__( 'Settings', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'title_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => Helper::banae_title_tags(),
				'default' => 'h3',
				'toggle' => false,
			]
		);

		$widget->add_control(
			'description_tag',
			[
				'label' => esc_html__( 'Description HTML Tag', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => Helper::banae_title_tags(),
				'default' => 'div',
				'toggle' => false,
			]
		);

		$widget->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Height', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vh', 'custom' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'em' => [
						'min' => 10,
						'max' => 100,
					],
					'rem' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 200,
					],
					'em' => [
						'max' => 20,
					],
					'rem' => [
						'max' => 20,
					],
				],
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__layer, {{WRAPPER}} .banae-flip-box__layer__overlay' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$widget->add_control(
			'flip_effect',
			[
				'label' => esc_html__( 'Flip Effect', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'flip',
				'options' => [
					'flip' => 'Flip',
					'slide' => 'Slide',
					'push' => 'Push',
					'zoom-in' => 'Zoom In',
					'zoom-out' => 'Zoom Out',
					'fade' => 'Fade',
				],
				'prefix_class' => 'banae-flip-box--effect-',
			]
		);

		$widget->add_control(
			'flip_direction',
			[
				'label' => esc_html__( 'Flip Direction', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'up',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
					'up' => [
						'title' => esc_html__( 'Top', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'down' => [
						'title' => esc_html__( 'Bottom', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => false,
				'condition' => [
					'flip_effect!' => [
						'fade',
						'zoom-in',
						'zoom-out',
					],
				],
				'prefix_class' => 'banae-flip-box--direction-',
			]
		);

		$widget->add_control(
			'flip_3d',
			[
				'label' => esc_html__( '3D Depth', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'Off', 'banana-addons-for-elementor' ),
				'return_value' => 'banae-flip-box--3d',
				'default' => '',
				'prefix_class' => '',
				'condition' => [
					'flip_effect' => 'flip',
				],
			]
		);

		$widget->end_controls_section();

		//Common Style Tab
		$widget->start_controls_section(
			'section_common_style',
			[
				'label' => esc_html__( 'Common', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'common_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 8,
					'right' => 8,
					'bottom' => 8,
					'left' => 8,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box .banae-flip-box__layer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'common_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-flip-box .banae-flip-box__layer',
			]
		);

		$widget->end_controls_section();

		//Front Style Tab
		$widget->start_controls_section(
			'section_style_a',
			[
				'label' => esc_html__( 'Front', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_a',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .banae-flip-box__front',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => '#cdf051',
					],
				],
			]
		);

		$widget->add_control(
			'background_overlay_a',
			[
				'label' => esc_html__( 'Background Overlay', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#52a21c',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__front .banae-flip-box__layer__overlay' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'background_a_image[id]!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'background_overlay_a_filters',
				'selector' => '{{WRAPPER}} .banae-flip-box__front .banae-flip-box__layer__overlay',
				'condition' => [
					'background_overlay_a!' => '',
				],
			]
		);

		$widget->add_control(
			'background_overlay_a_blend_mode',
			[
				'label' => esc_html__( 'Blend Mode', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'color-burn' => 'Color Burn',
					'hue' => 'Hue',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'exclusion' => 'Exclusion',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__front .banae-flip-box__layer__overlay' => 'mix-blend-mode: {{VALUE}}',
				],
				'condition' => [
					'background_overlay_a!' => '',
				],
			]
		);

		$widget->add_responsive_control(
			'padding_a',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__front .banae-flip-box__layer__overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'alignment_a',
			[
				'label' => esc_html__( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__front .banae-flip-box__layer__overlay' => 'text-align: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'vertical_position_a',
			[
				'label' => esc_html__( 'Vertical Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__front .banae-flip-box__layer__overlay' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_a',
				'selector' => '{{WRAPPER}} .banae-flip-box__front',
				'separator' => 'before',
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_a',
				'selector' => '{{WRAPPER}} .banae-flip-box__front',
			]
		);

		$widget->add_control(
			'heading_image_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Image', 'banana-addons-for-elementor' ),
				'condition' => [
					'media_element' => 'image',
				],
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'image_spacing',
			[
				'label' => esc_html__( 'Gap', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 10,
					],
					'rem' => [
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'media_element' => 'image',
				],
			]
		);

		$widget->add_control(
			'image_width',
			[
				'label' => esc_html__( 'Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__image img' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'media_element' => 'image',
				],
			]
		);

		$widget->add_control(
			'image_opacity',
			[
				'label' => esc_html__( 'Opacity', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__image' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'media_element' => 'image',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .banae-flip-box__image img',
				'condition' => [
					'media_element' => 'image',
				],
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 200,
					],
					'em' => [
						'max' => 20,
					],
					'rem' => [
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__image img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'media_element' => 'image',
				],
			]
		);

		$widget->add_control(
			'heading_icon_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Icon', 'banana-addons-for-elementor' ),
				'condition' => [
					'media_element' => 'icon',
				],
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'icon_view',
			[
				'label' => esc_html__( 'View', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'banana-addons-for-elementor' ),
					'stacked' => esc_html__( 'Stacked', 'banana-addons-for-elementor' ),
					'framed' => esc_html__( 'Framed', 'banana-addons-for-elementor' ),
				],
				'default' => 'default',
				'condition' => [
					'media_element' => 'icon',
				],
			]
		);

		$widget->add_control(
			'icon_shape',
			[
				'label' => esc_html__( 'Shape', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => esc_html__( 'Circle', 'banana-addons-for-elementor' ),
					'square' => esc_html__( 'Square', 'banana-addons-for-elementor' ),
				],
				'default' => 'circle',
				'condition' => [
					'icon_view!' => 'default',
					'media_element' => 'icon',
				],
			]
		);

		$widget->add_control(
			'icon_spacing',
			[
				'label' => esc_html__( 'Gap', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 10,
					],
					'rem' => [
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-icon-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'media_element' => 'icon',
				],
			]
		);

		$widget->add_control(
			'icon_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1d2327',
				'selectors' => [
					'{{WRAPPER}} .banae-view-default .elementor-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .banae-flip-box .elementor-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .banae-flip-box .elementor-icon path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .banae-view-stacked .elementor-icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .banae-view-stacked .elementor-icon svg' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .banae-view-stacked .elementor-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .banae-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}}',
					'{{WRAPPER}} .banae-view-framed .elementor-icon svg, {{WRAPPER}} .elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}}; border-color: {{VALUE}}',
					'{{WRAPPER}} .banae-view-framed .elementor-icon svg path, {{WRAPPER}} .elementor-view-default .elementor-icon svg path' => 'fill: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'media_element' => 'icon',
				],
			]
		);

		$widget->add_control(
			'icon_secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'condition' => [
					'media_element' => 'icon',
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .banae-view-framed .elementor-icon svg' => 'stroke: {{VALUE}};',
					'{{WRAPPER}} .banae-view-stacked .elementor-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .banae-view-stacked .elementor-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
					'em' => [
						'min' => 0.6,
						'max' => 30,
					],
					'rem' => [
						'min' => 0.6,
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'media_element' => 'icon',
				],
			]
		);

		$widget->add_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'condition' => [
					'media_element' => 'icon',
					'icon_view!' => 'default',
				],
			]
		);

		$widget->add_control(
			'icon_rotate',
			[
				'label' => esc_html__( 'Icon Rotate', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg', 'grad', 'rad', 'turn' ],
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .elementor-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'media_element' => 'icon',
				],
			]
		);

		$widget->add_control(
			'icon_border_width',
			[
				'label' => esc_html__( 'Border Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'max' => 20,
					],
					'em' => [
						'max' => 2,
					],
					'rem' => [
						'max' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'media_element' => 'icon',
					'icon_view' => 'framed',
				],
			]
		);

		$widget->add_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'media_element' => 'icon',
					'icon_view!' => 'default',
				],
			]
		);

		$widget->add_control(
			'heading_title_style_a',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Title', 'banana-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'title_text_a!' => '',
				],
			]
		);

		$widget->add_control(
			'title_spacing_a',
			[
				'label' => esc_html__( 'Gap', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 10,
					],
					'rem' => [
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__front .banae-flip-box__layer__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'description_text_a!' => '',
					'title_text_a!' => '',
				],
			]
		);

		$widget->add_control(
			'title_color_a',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1d2327',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__front .banae-flip-box__layer__title' => 'color: {{VALUE}}',

				],
				'condition' => [
					'title_text_a!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography_a',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .banae-flip-box__front .banae-flip-box__layer__title',
				'condition' => [
					'title_text_a!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .banae-flip-box__front .banae-flip-box__layer__title',
			]
		);

		$widget->add_control(
			'heading_description_style_a',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Description', 'banana-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'description_text_a!' => '',
				],
			]
		);

		$widget->add_control(
			'description_color_a',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1d2327',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__front .banae-flip-box__layer__description' => 'color: {{VALUE}}',

				],
				'condition' => [
					'description_text_a!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography_a',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .banae-flip-box__front .banae-flip-box__layer__description',
				'condition' => [
					'description_text_a!' => '',
				],
			]
		);

		$widget->end_controls_section();

		//Back Style Tab
		$widget->start_controls_section(
			'section_style_b',
			[
				'label' => esc_html__( 'Back', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_b',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .banae-flip-box__back',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => '#335705',
					],
				],
			]
		);

		$widget->add_control(
			'background_overlay_b',
			[
				'label' => esc_html__( 'Background Overlay', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#335705',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__overlay' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'background_b_image[id]!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'background_overlay_b_filters',
				'selector' => '{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__overlay',
				'condition' => [
					'background_overlay_b!' => '',
				],
			]
		);

		$widget->add_control(
			'background_overlay_b_blend_mode',
			[
				'label' => esc_html__( 'Blend Mode', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'color-burn' => 'Color Burn',
					'hue' => 'Hue',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'exclusion' => 'Exclusion',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__overlay' => 'mix-blend-mode: {{VALUE}}',
				],
				'condition' => [
					'background_overlay_b!' => '',
				],
			]
		);

		$widget->add_responsive_control(
			'padding_b',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'alignment_b',
			[
				'label' => esc_html__( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__overlay' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .banae-flip-box__button' => 'margin-{{VALUE}}: 0',
				],
			]
		);

		$widget->add_control(
			'vertical_position_b',
			[
				'label' => esc_html__( 'Vertical Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__overlay' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_b',
				'selector' => '{{WRAPPER}} .banae-flip-box__back',
				'separator' => 'before',
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_b',
				'selector' => '{{WRAPPER}} .banae-flip-box__back',
			]
		);

		$widget->add_control(
			'heading_title_style_b',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Title', 'banana-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'title_text_b!' => '',
				],
			]
		);

		$widget->add_control(
			'title_spacing_b',
			[
				'label' => esc_html__( 'Gap', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 10,
					],
					'rem' => [
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'title_text_b!' => '',
				],
			]
		);

		$widget->add_control(
			'title_color_b',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__title' => 'color: {{VALUE}}',

				],
				'condition' => [
					'title_text_b!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography_b',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__title',
				'condition' => [
					'title_text_b!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke_b',
				'selector' => '{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__title',
			]
		);

		$widget->add_control(
			'heading_description_style_b',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Description', 'banana-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'description_text_b!' => '',
				],
			]
		);

		$widget->add_control(
			'description_spacing_b',
			[
				'label' => esc_html__( 'Gap', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 10,
					],
					'rem' => [
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'description_text_b!' => '',
					'button_text!' => '',
				],
			]
		);

		$widget->add_control(
			'description_color_b',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__description' => 'color: {{VALUE}}',

				],
				'condition' => [
					'description_text_b!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography_b',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .banae-flip-box__back .banae-flip-box__layer__description',
				'condition' => [
					'description_text_b!' => '',
				],
			]
		);

		$widget->add_control(
			'heading_button',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Button', 'banana-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->add_control(
			'button_size',
			[
				'label' => esc_html__( 'Size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => [
					'xs' => esc_html__( 'Extra Small', 'banana-addons-for-elementor' ),
					'sm' => esc_html__( 'Small', 'banana-addons-for-elementor' ),
					'md' => esc_html__( 'Medium', 'banana-addons-for-elementor' ),
					'lg' => esc_html__( 'Large', 'banana-addons-for-elementor' ),
					'xl' => esc_html__( 'Extra Large', 'banana-addons-for-elementor' ),
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .banae-flip-box__button',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->start_controls_tabs( 'button_tabs' );

		$widget->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__button' => 'color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .banae-flip-box__button',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->add_control(
			'button_border_color',
			[
				'label' => esc_html__( 'Border Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__button' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'hover',
			[
				'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ),
				'condition' => [
					'button_text!' => '',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->add_control(
			'button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__button:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .banae-flip-box__button:hover',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->add_control(
			'button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 's', 'ms', 'custom' ],
				'default' => [
					'unit' => 'ms',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__button' => 'transition-duration: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->add_control(
			'button_border_width',
			[
				'label' => esc_html__( 'Border Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'max' => 20,
					],
					'em' => [
						'max' => 2,
					],
					'rem' => [
						'max' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 10,
					],
					'rem' => [
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-flip-box__button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$widget->end_controls_section();
	}
}