<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Banae_Call_To_Action {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		$widget->start_controls_section(
			'main_image_content_section',
			[
				'label' => esc_html__( 'Image', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'skin',
			[
				'label' => esc_html__( 'Skin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'classic' => esc_html__( 'Classic', 'banana-addons-for-elementor' ),
					'cover' => esc_html__( 'Cover', 'banana-addons-for-elementor' ),
				],
				'render_type' => 'template',
				'prefix_class' => 'banae-cta--skin-',
				'default' => 'classic',
			]
		);

		$widget->add_responsive_control(
			'layout',
			[
				'label' => esc_html__( 'Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'above' => [
						'title' => esc_html__( 'Above', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
					'below' => [
						'title' => esc_html__( 'Below', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'banae-cta-%s-layout-image-',
				'condition' => [
					'skin!' => 'cover',
				],
			]
		);

		$widget->add_control(
			'cta_bg_image',
			[
				'label' => esc_html__( 'Choose Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'cta_bg_image', // Actually its `image_size`
				'label' => esc_html__( 'Image Resolution', 'banana-addons-for-elementor' ),
				'default' => 'large',
				'condition' => [
					'cta_bg_image[id]!' => '',
				],
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'cta_media_content_section',
			[
				'label' => esc_html__( 'Content', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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
				'default' => 'none',
			]
		);

		$widget->add_control(
			'graphic_image',
			[
				'label' => esc_html__( 'Choose Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'media_element' => 'image',
				],
				'show_label' => false,
			]
		);

		$widget->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'graphic_image',
				'default' => 'thumbnail',
				'condition' => [
					'media_element' => 'image',
					'graphic_image[id]!' => '',
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
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' => [
					'media_element' => 'icon',
				],
			]
		);

		$widget->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'This is the heading', 'banana-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter your title', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'title_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
				],
				'default' => 'h2',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$widget->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'banana-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter your description', 'banana-addons-for-elementor' ),
				'separator' => 'before',
				'rows' => 5,
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'banae_button_content_section',
			[
				'label' => esc_html__( 'Button', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,

			]
		);

		$widget->add_control(
			'show_button',
			[
				'label' => esc_html__( 'Show Button', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'button',
			[
				'label' => esc_html__( 'Button Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Click Here', 'banana-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'show_button' => 'yes',
				]
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
				'condition' => [
					'show_button' => 'yes',
				]
			]
		);

		$widget->add_control(
			'link_type',
			[
				'label' => esc_html__( 'Apply Link On', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'container' => esc_html__( 'Container Only', 'banana-addons-for-elementor' ),
					'button' => esc_html__( 'Button Only', 'banana-addons-for-elementor' ),
				],
				'default' => 'button',
				'condition' => [
					'show_button' => 'yes',
					'link[url]!' => '',
				],
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'cta_ribbon_content_section',
			[
				'label' => esc_html__( 'Ribbon', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'ribbon_title',
			[
				'label' => esc_html__( 'Title', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'assets' => [
					'styles' => [
						[
							'name' => 'e-ribbon',
							'conditions' => [
								'terms' => [
									[
										'name' => 'ribbon_title',
										'operator' => '!==',
										'value' => '',
									],
								],
							],
						],
					],
				],
			]
		);

		$widget->add_control(
			'ribbon_horizontal_position',
			[
				'label' => esc_html__( 'Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
					'ribbon_title!' => '',
				],
			]
		);

		$widget->end_controls_section();

		// Style Tabs
		$widget->start_controls_section(
			'cta_box_style_section',
			[
				'label' => esc_html__( 'Container', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'min-height',
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
				'selectors' => [
					'{{WRAPPER}} .banae-cta__content' => 'min-height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$widget->add_responsive_control(
			'alignment',
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
					'{{WRAPPER}} .banae-cta__content' => 'text-align: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'vertical_position',
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
				'prefix_class' => 'banae-cta--valign-',
			]
		);

		$widget->add_responsive_control(
			'padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .banae-cta__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$widget->add_control(
			'heading_cta_bg_image_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Image', 'banana-addons-for-elementor' ),
				'condition' => [
					'cta_bg_image[url]!' => '',
					'skin' => 'classic',
				],
				'separator' => 'before',
			]
		);

		$widget->add_responsive_control(
			'image_min_width',
			[
				'label' => esc_html__( 'Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
					'em' => [
						'max' => 50,
					],
					'rem' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-cta__bg-wrapper' => 'min-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'skin' => 'classic',
					'layout!' => 'above',
				],
			]
		);

		$widget->add_responsive_control(
			'image_min_height',
			[
				'label' => esc_html__( 'Height', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vh', 'custom' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
					'em' => [
						'max' => 50,
					],
					'rem' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-cta__bg-wrapper' => 'min-height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'media_element_style',
			[
				'label' => esc_html__( 'Media', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'media_element!' => [
						'none',
						'',
					],
				],
			]
		);

		$widget->add_control(
			'graphic_image_spacing',
			[
				'label' => esc_html__( 'Spacing', 'banana-addons-for-elementor' ),
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
					'{{WRAPPER}} .banae-cta__image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'media_element' => 'image',
				],
			]
		);

		$widget->add_control(
			'graphic_image_width',
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
					'{{WRAPPER}} .banae-cta__image img' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'media_element' => 'image',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'graphic_image_border',
				'selector' => '{{WRAPPER}} .banae-cta__image img',
				'condition' => [
					'media_element' => 'image',
				],
			]
		);

		$widget->add_control(
			'graphic_image_border_radius',
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
					'{{WRAPPER}} .banae-cta__image img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'media_element' => 'image',
				],
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
				'label' => esc_html__( 'Spacing', 'banana-addons-for-elementor' ),
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
					'{{WRAPPER}} .elementor-icon-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-view-stacked .elementor-icon svg' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}};',
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
				'default' => '',
				'condition' => [
					'media_element' => 'icon',
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-view-framed .elementor-icon svg' => 'stroke: {{VALUE}};',
					'{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-view-stacked .elementor-icon svg' => 'fill: {{VALUE}};',
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
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
					'em' => [
						'min' => 0,
						'max' => 5,
					],
					'rem' => [
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

		$widget->end_controls_section();

		$widget->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'title',
							'operator' => '!==',
							'value' => '',
						],
						[
							'name' => 'description',
							'operator' => '!==',
							'value' => '',
						],
					],
				],
			]
		);

		$widget->add_control(
			'heading_style_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Title', 'banana-addons-for-elementor' ),
				'condition' => [
					'title!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .banae-cta__title',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .banae-cta__title',
			]
		);

		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .banae-cta__title',
			]
		);

		$widget->add_responsive_control(
			'title_spacing',
			[
				'label' => esc_html__( 'Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .banae-cta__title:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$widget->add_control(
			'heading_style_description',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Description', 'banana-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'description!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .banae-cta__description',
				'condition' => [
					'description!' => '',
				],
			]
		);

		$widget->add_responsive_control(
			'description_spacing',
			[
				'label' => esc_html__( 'Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .banae-cta__description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'description!' => '',
				],
			]
		);

		$widget->add_control(
			'heading_content_colors',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Colors', 'banana-addons-for-elementor' ),
				'separator' => 'before',
			]
		);

		$widget->start_controls_tabs( 'color_tabs' );

		$widget->start_controls_tab( 'colors_normal',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta__content' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$widget->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta__title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$widget->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Description Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta__description' => 'color: {{VALUE}}',
				],
				'condition' => [
					'description!' => '',
				],
			]
		);

		/*
		$widget->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Button Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta__button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'show_button' => 'yes',
					'button!' => '',
				],
			]
		);*/

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'colors_hover',
			[
				'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'content_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta:hover .banae-cta__content' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$widget->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Title Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta:hover .banae-cta__title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$widget->add_control(
			'description_color_hover',
			[
				'label' => esc_html__( 'Description Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta:hover .banae-cta__description' => 'color: {{VALUE}}',
				],
				'condition' => [
					'description!' => '',
				],
			]
		);

		/*
		$widget->add_control(
			'button_color_hover',
			[
				'label' => esc_html__( 'Button Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta:hover .banae-cta__button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'show_button' => 'yes',
					'button!' => '',
				],
			]
		);*/

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->end_controls_section();

		$widget->start_controls_section(
			'button_style',
			[
				'label' => esc_html__( 'Button', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_button' => 'yes',
					'button!' => '',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .banae-cta__button',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
			]
		);

		/*
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'button_text_shadow',
				'selector' => '{{WRAPPER}} .banae-cta__button',
			]
		);*/

		$widget->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .banae-cta__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$widget->add_responsive_control(
			'button_offset_y',
			[
				'label' => esc_html__( 'Offset Y', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 5,
					],
					'em' => [
						'max' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-cta__button' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

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
						'max' => 5,
					],
					'rem' => [
						'max' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-cta__button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 4,
					'right' => 4,
					'bottom' => 4,
					'left' => 4,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-cta__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->start_controls_tabs( 'button_tabs' );

		$widget->start_controls_tab( 'button_normal',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta__button' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta__button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'button_border_color',
			[
				'label' => esc_html__( 'Border Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta__button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .banae-cta__button',
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'button-hover',
			[
				'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta__button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta__button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta__button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .banae-cta__button:hover',
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->end_controls_section();

		$widget->start_controls_section(
			'section_ribbon_style',
			[
				'label' => esc_html__( 'Ribbon', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'ribbon_title!' => '',
				],
			]
		);

		$widget->add_control(
			'ribbon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-ribbon-inner' => 'background-color: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'ribbon_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-ribbon-inner' => 'color: {{VALUE}}',
				],
			]
		);

		$ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

		$widget->add_responsive_control(
			'ribbon_distance',
			[
				'label' => esc_html__( 'Distance', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 50,
					],
					'em' => [
						'max' => 5,
					],
					'em' => [
						'max' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-ribbon-inner' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ribbon_typography',
				'selector' => '{{WRAPPER}} .banae-ribbon-inner',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .banae-ribbon-inner',
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'hover_effects',
			[
				'label' => esc_html__( 'Hover Effects', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'background_hover_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Background', 'banana-addons-for-elementor' ),
				'condition' => [
					'skin' => 'cover',
				],
			]
		);

		$widget->add_control(
			'transformation',
			[
				'label' => esc_html__( 'Hover Animation', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => 'None',
					'zoom-in' => 'Zoom In',
					'zoom-out' => 'Zoom Out',
					'move-left' => 'Move Left',
					'move-right' => 'Move Right',
					'move-up' => 'Move Up',
					'move-down' => 'Move Down',
				],
				'default' => 'zoom-in',
				'prefix_class' => 'elementor-bg-transform elementor-bg-transform-',
			]
		);

		$widget->start_controls_tabs( 'bg_effects_tabs' );

		$widget->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'overlay_color',
			[
				'label' => esc_html__( 'Overlay Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta:not(:hover) .banae-cta__bg-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'bg_filters',
				'selector' => '{{WRAPPER}} .banae-cta__bg',
			]
		);

		$widget->add_control(
			'overlay_blend_mode',
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
					'{{WRAPPER}} .banae-cta__bg-overlay' => 'mix-blend-mode: {{VALUE}}',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'overlay_color_hover',
			[
				'label' => esc_html__( 'Overlay Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-cta:hover .banae-cta__bg-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'bg_filters_hover',
				'selector' => '{{WRAPPER}} .banae-cta:hover .banae-cta__bg',
			]
		);

		$widget->add_control(
			'effect_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'banana-addons-for-elementor' ) . ' (ms)',
				'type' => Controls_Manager::SLIDER,
				'render_type' => 'template',
				'default' => [
					'size' => 1500,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3000,
						'step' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-cta .banae-cta__bg, {{WRAPPER}} .banae-cta .banae-cta__bg-overlay' => 'transition-duration: {{SIZE}}ms',
				],
				'separator' => 'before',
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->end_controls_section();

	}
}