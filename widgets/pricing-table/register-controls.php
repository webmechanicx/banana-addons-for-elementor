<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Banana_Addons\Elementor\Helper;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

class Banae_Pricing_Table {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		// Media Content Section
		$widget->start_controls_section(
			'pricing_media_section_content',
			[ 'label' => __( 'Media', 'banana-addons-for-elementor' ) ]
		);

		$widget->add_control(
			'show_media',
			[
				'label' => esc_html__( 'Show Media', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$widget->add_control( 'media_type', [
			'label' => __( 'Media Type', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'icon' => [
					'title' => __( 'Icon', 'banana-addons-for-elementor' ),
					'icon' => 'eicon-star',
				],
				'image' => [
					'title' => __( 'Image', 'banana-addons-for-elementor' ),
					'icon' => 'eicon-image-bold',
				],
			],
			'default' => 'icon',
			'toggle' => true,
			'condition' => [
				'show_media' => 'yes',
			],
		] );

		$widget->add_control( 'icon', [
			'label' => __( 'Select Icon', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::ICONS,
			'default' => [ 'value' => 'fas fa-star', 'library' => 'fa-solid' ],
			'condition' => [
				'show_media' => 'yes',
				'media_type' => 'icon'
			],
		] );

		$widget->add_control( 'image', [
			'label' => __( 'Select Image', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src()
			],
			'condition' => [
				'show_media' => 'yes',
				'media_type' => 'image'
			],
		] );

		$widget->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium',
				'condition' => [
					'show_media' => 'yes',
					'media_type' => 'image'
				],
			]
		);

		$widget->end_controls_section();

		// Content Section
		$widget->start_controls_section(
			'pricing_table_section_content',
			[ 'label' => __( 'Heading', 'banana-addons-for-elementor' ) ]
		);

		$widget->add_control( 'pricing_alignment', [
			'label' => __( 'Text Alignment', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left' => [ 'title' => __( 'Left', 'banana-addons-for-elementor' ), 'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => __( 'Center', 'banana-addons-for-elementor' ), 'icon' => 'eicon-text-align-center' ],
				'right' => [ 'title' => __( 'Right', 'banana-addons-for-elementor' ), 'icon' => 'eicon-text-align-right' ],
			],
			'default' => 'center',
			'selectors' => [
				'{{WRAPPER}} .banae-pricing-table' => 'text-align: {{VALUE}};',
				'{{WRAPPER}} .banae-pricing-table .banae-pricing__inner' => 'justify-content: {{VALUE}};',
				'{{WRAPPER}} .banae-pricing-table .banae-pricing-features li' => 'justify-content: {{VALUE}};',
				'{{WRAPPER}} .banae-pricing-table .banae-pricing-media' => 'text-align: {{VALUE}};',
			],
		] );

		$widget->add_control( 'heading', [
			'label' => __( 'Heading', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::TEXT,
			'default' => __( 'Basic Plan', 'banana-addons-for-elementor' ),
			'label_block' => true,
		] );

		$widget->add_control( 'heading_tag', [
			'label' => __( 'Heading Tag', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'h3',
			'options' => Helper::banae_title_tags(),
		] );

		$widget->add_control( 'subheading', [
			'label' => __( 'Sub Heading', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::TEXT,
			'default' => __( 'Perfect for Starters', 'banana-addons-for-elementor' ),
			'label_block' => true,
		] );

		$widget->end_controls_section();

		// Features Repeater Content Section
		$widget->start_controls_section(
			'features_section_content',
			[ 'label' => __( 'Features', 'banana-addons-for-elementor' ) ]
		);

		$repeater = new Repeater();

		$repeater->add_control( 'feature_icon', [
			'label' => __( 'Icon', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::ICONS,
			'default' => [
				'value' => 'fas fa-check',
				'library' => 'fa-solid'
			],
		] );

		$repeater->add_control( 'feature_text', [
			'label' => __( 'Text', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::TEXT,
			'default' => __( 'Feature item', 'banana-addons-for-elementor' ),
			'label_block' => true,
		] );

		$widget->add_control( 'features', [
			'label' => __( 'Feature List', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $repeater->get_controls(),
			'default' => [
				[ 'feature_text' => __( '1 User Access', 'banana-addons-for-elementor' ) ],
				[ 'feature_text' => __( '5GB Storage', 'banana-addons-for-elementor' ) ],
				[ 'feature_text' => __( 'Basic Support', 'banana-addons-for-elementor' ) ],
			],
			'title_field' => '{{{ feature_text }}}',
		] );

		$widget->end_controls_section();

		// Price Content Section
		$widget->start_controls_section(
			'price_section_content',
			[ 'label' => __( 'Price', 'banana-addons-for-elementor' ) ]
		);

		$widget->add_control( 'price_display_position', [
			'label' => __( 'Display Position', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'top' => [ 'title' => __( 'Top', 'banana-addons-for-elementor' ), 'icon' => 'eicon-v-align-top' ],
				'bottom' => [ 'title' => __( 'Bottom', 'banana-addons-for-elementor' ), 'icon' => 'eicon-v-align-bottom' ],
			],
			'default' => 'top',
			'toggle' => true,
		] );

		$widget->add_control( 'price', [
			'label' => __( 'Price', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::TEXT,
			'default' => '29',
		] );

		$widget->add_control( 'currency', [
			'label' => __( 'Currency', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::SELECT,
			'default' => '$',
			'options' => [
				'' => esc_html__( 'None', 'banana-addons-for-elementor' ),
				'$' => '$',
				'€' => '€',
				'£' => '£',
				'৳' => '৳',
				'₹' => '₹',
				'¥' => '¥',
				'custom' => esc_html__( 'Custom', 'banana-addons-for-elementor' ),
			],
		] );

		$widget->add_control(
			'currency_symbol_custom',
			[
				'label' => esc_html__( 'Custom Symbol', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'ai' => [
					'active' => false,
				],
				'condition' => [
					'currency' => 'custom',
				],
			]
		);

		$widget->add_control( 'currency_position', [
			'label' => __( 'Currency Position', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'top' => [ 'title' => __( 'Top', 'banana-addons-for-elementor' ), 'icon' => 'eicon-v-align-top' ],
				'bottom' => [ 'title' => __( 'Bottom', 'banana-addons-for-elementor' ), 'icon' => 'eicon-v-align-bottom' ],
			],
			'default' => 'top',
			'toggle' => true,
		] );

		$widget->add_control(
			'price_duration',
			[
				'label' => esc_html__( 'Duration', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'ai' => [
					'active' => false,
				],
				'default' => 'Per Month',
			]
		);

		$widget->end_controls_section();

		// Ribbon Section
		$widget->start_controls_section(
			'features_ribbon_section_content',
			[ 'label' => __( 'Ribbon', 'banana-addons-for-elementor' ) ]
		);

		$widget->add_control( 'show_ribbon', [
			'label' => __( 'Show Ribbon', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'Show', 'banana-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'banana-addons-for-elementor' ),
			'default' => 'no',
		] );

		$widget->add_control( 'ribbon_text', [
			'label' => __( 'Ribbon Text', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::TEXT,
			'default' => __( 'Popular', 'banana-addons-for-elementor' ),
			'condition' => [
				'show_ribbon' => 'yes'
			],
		] );

		$widget->add_control( 'ribbon_position', [
			'label' => __( 'Ribbon Position', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'pt-top-left',
			'options' => [
				'pt-top-left' => __( 'Left', 'banana-addons-for-elementor' ),
				'pt-top-center' => __( 'Center', 'banana-addons-for-elementor' ),
				'pt-top-right' => __( 'Right', 'banana-addons-for-elementor' ),
			],
			'condition' => [ 'show_ribbon' => 'yes' ],
		] );

		$widget->add_control( 'show_highlighter', [
			'label' => __( 'Show Highlighter', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
		] );

		$widget->end_controls_section();

		// Button Section
		$widget->start_controls_section(
			'features_button_section_content',
			[ 'label' => __( 'Button', 'banana-addons-for-elementor' ) ]
		);

		$widget->add_control( 'button_text', [
			'label' => __( 'Button Text', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::TEXT,
			'default' => __( 'Subscribe', 'banana-addons-for-elementor' ),
		] );

		$widget->add_control( 'button_link', [
			'label' => __( 'Button Link', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::URL,
			'placeholder' => 'https://your-link.com',
		] );

		$widget->end_controls_section();

		// Footer Section
		$widget->start_controls_section(
			'footer_section_content',
			[ 'label' => __( 'Footer', 'banana-addons-for-elementor' ) ]
		);

		$widget->add_control( 'footer_text', [
			'label' => __( 'Footer Text', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::TEXTAREA,
			'default' => 'Footer Note',
		] );

		$widget->end_controls_section();

		// Container 
		$widget->start_controls_section( 'container_style_table', [
			'label' => __( 'Container', 'banana-addons-for-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE,
		] );

		$widget->add_responsive_control( 'container_padding', [
			'label' => __( 'Padding', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'selectors' => [
				'{{WRAPPER}} .banae-pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$widget->add_group_control( Group_Control_Background::get_type(), [
			'name' => 'container_background',
			'types' => [ 'classic', 'gradient' ],
			'exclude' => [ 'image', 'video' ],
			'selector' => '{{WRAPPER}} .banae-pricing-table',
		] );

		$widget->add_group_control( Group_Control_Border::get_type(), [
			'name' => 'container_border',
			'selector' => '{{WRAPPER}} .banae-pricing-table',
		] );

		$widget->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name' => 'container_shadow',
			'selector' => '{{WRAPPER}} .banae-pricing-table',
		] );

		$widget->add_control(
			'container_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
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
					'{{WRAPPER}} .banae-pricing-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Media and Icon
		$widget->start_controls_section( 'media_style_heading', [
			'label' => __( 'Media', 'banana-addons-for-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE,
			'condition' => [
				'show_media' => 'yes',
			],
		] );

		$widget->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Image Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-table .banae-pricing-media img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .banae-pricing-table .banae-pricing-media svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_media' => 'yes',
					'media_type' => 'image'
				],
			]
		);

		$widget->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-table .banae-pricing-media i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .banae-pricing-table .banae-pricing-media span' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_media' => 'yes',
					'media_type' => 'icon'
				],
			]
		);

		$widget->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-table .banae-pricing-media i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .banae-pricing-table .banae-pricing-media span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_media' => 'yes',
					'media_type' => 'icon'
				],
			]
		);

		$widget->add_responsive_control(
			'media_margin',
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
					'{{WRAPPER}} .banae-pricing-table .banae-pricing-media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_media' => 'yes',
				],
			]
		);

		$widget->end_controls_section();

		// Heading
		$widget->start_controls_section( 'style_heading', [
			'label' => __( 'Heading', 'banana-addons-for-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE,
		] );

		$widget->add_control(
			'section_heading_name',
			[
				'label' => esc_html__( 'Heading', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$widget->add_control( 'heading_color', [
			'label' => __( 'Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .banae-pricing-heading' => 'color: {{VALUE}};' ],
		] );

		$widget->add_group_control( Group_Control_Typography::get_type(), [
			'name' => 'heading_typography',
			'selector' => '{{WRAPPER}} .banae-pricing-heading',
		] );

		$widget->add_control(
			'section_sub_heading_name',
			[
				'label' => esc_html__( 'Sub Heading', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_control( 'subheading_color', [
			'label' => __( 'Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .banae-pricing-subheading' => 'color: {{VALUE}};' ],
		] );

		$widget->add_group_control( Group_Control_Typography::get_type(), [
			'name' => 'subheading_typography',
			'selector' => '{{WRAPPER}} .banae-pricing-subheading',
		] );

		$widget->add_control(
			'heading_padding_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$widget->add_responsive_control(
			'heading_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 20,
					'right' => 0,
					'bottom' => 20,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-table-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Features Style Section
		$widget->start_controls_section( 'style_features', [
			'label' => __( 'Features', 'banana-addons-for-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE,
		] );

		$widget->add_control( 'features_color', [
			'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .banae-pricing-features li' => 'color: {{VALUE}};' ],
		] );

		$widget->add_group_control( Group_Control_Typography::get_type(), [
			'name' => 'features_typography',
			'selector' => '{{WRAPPER}} .banae-pricing-features li',
		] );

		$widget->add_responsive_control(
			'features_text_align',
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
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-features li' => 'justify-content: {{VALUE}} !important;',
				],
			]
		);

		$widget->add_control(
			'headning_name_icon',
			[
				'label' => esc_html__( 'Icon', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_control( 'features_icon_color', [
			'label' => __( 'Icon Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .banae-pricing-features li i' => 'color: {{VALUE}};' ],
		] );

		$widget->add_responsive_control(
			'icon_font_size',
			[
				'label' => esc_html__( 'Size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 1,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-features li i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'icon_space',
			[
				'label' => esc_html__( 'Gap Between Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-features li i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'features_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 40,
					'right' => 0,
					'bottom' => 40,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-table .banae-pricing-features' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Price Style Section
		$widget->start_controls_section( 'style_price', [
			'label' => __( 'Price', 'banana-addons-for-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE,
		] );

		$widget->add_control(
			'currency_heading_style',
			[
				'label' => esc_html__( 'Currency', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$widget->add_control( 'currency_color', [
			'label' => __( 'Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .banae-pricing__inner .banae-currency' => 'color: {{VALUE}};' ],
			'default' => '#27c421',
		] );

		$widget->add_group_control( Group_Control_Typography::get_type(), [
			'name' => 'currency_typography',
			'selector' => '{{WRAPPER}} .banae-pricing__inner .banae-currency',
		] );

		$widget->add_control(
			'price_heading_style',
			[
				'label' => esc_html__( 'Price', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_control( 'price_color', [
			'label' => __( 'Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .banae-pricing__inner .banae-amount' => 'color: {{VALUE}};' ],
			'default' => '#27c421',
		] );

		$widget->add_group_control( Group_Control_Typography::get_type(), [
			'name' => 'price_typography',
			'selector' => '{{WRAPPER}} .banae-pricing__inner .banae-amount',
		] );

		$widget->add_control(
			'duration_heading_style',
			[
				'label' => esc_html__( 'Duration', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_control( 'duration_color', [
			'label' => __( 'Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .banae-pricing__wrapper .banae-duration' => 'color: {{VALUE}};' ],
		] );

		$widget->add_group_control( Group_Control_Typography::get_type(), [
			'name' => 'duration_typography',
			'selector' => '{{WRAPPER}} .banae-pricing__wrapper .banae-duration',
		] );

		$widget->add_control(
			'pricing_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .banae-pricing__wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Button
		$widget->start_controls_section( 'style_button', [
			'label' => __( 'Button', 'banana-addons-for-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE,
		] );

		$widget->add_group_control( Group_Control_Typography::get_type(), [
			'name' => 'button_typography',
			'selector' => '{{WRAPPER}} .banae-pricing-button',
		] );

		$widget->add_control(
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 14,
					'right' => 40,
					'bottom' => 14,
					'left' => 40,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-table .banae-pricing-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 6,
					'right' => 6,
					'bottom' => 6,
					'left' => 6,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-table .banae-pricing-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Button Normal Tabs
		$widget->start_controls_tabs(
			'button_style_tabs'
		);

		$widget->start_controls_tab(
			'buttn_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control( 'normal_button_bg', [
			'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .banae-pricing-button' => 'background-color: {{VALUE}};' ],
		] );

		$widget->add_control( 'normal_button_color', [
			'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .banae-pricing-button' => 'color: {{VALUE}};' ],
		] );

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'normal_button_border',
				'selector' => '{{WRAPPER}} .banae-pricing-button',
			]
		);


		$widget->end_controls_tab();

		// Button Hover Tabs
		$widget->start_controls_tab(
			'buttn_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control( 'hover_button_bg', [
			'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banae-pricing-button:hover' => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .banae-pricing-button:focus' => 'background-color: {{VALUE}};',
			],
		] );

		$widget->add_control( 'hover_button_color', [
			'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banae-pricing-button:hover' => 'color: {{VALUE}};',
				'{{WRAPPER}} .banae-pricing-button:focus' => 'color: {{VALUE}};',
			],
		] );

		$widget->add_control( 'hover_button_border_color', [
			'label' => __( 'Border Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banae-pricing-button:hover' => 'border-color: {{VALUE}};',
				'{{WRAPPER}} .banae-pricing-button:focus' => 'border-color: {{VALUE}};',
			],
		] );

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->end_controls_section();

		// Ribbon Style
		$widget->start_controls_section( 'ribbon_style_section', [
			'label' => __( 'Ribbon', 'banana-addons-for-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE,
			'condition' => [
				'show_ribbon' => 'yes',
			]
		] );

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ribbon_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-pricing-table .banae-pt-ribbon',
				'default' => '#27C421',
				'condition' => [
					'show_ribbon' => 'yes',
				]
			]
		);

		$widget->add_group_control( Group_Control_Typography::get_type(), [
			'name' => 'ribbon_typography',
			'selector' => '{{WRAPPER}} .banae-pricing-table .banae-pt-ribbon',
		] );

		$widget->add_control(
			'ribbon_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-table .banae-pt-ribbon' => 'color: {{VALUE}};',
				],
				'default' => '#ffffff',
				'condition' => [
					'show_ribbon' => 'yes',
				]
			]
		);

		$widget->end_controls_section();

		// Footer
		$widget->start_controls_section( 'style_footer', [
			'label' => __( 'Footer Text', 'banana-addons-for-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE,
		] );

		$widget->add_group_control( Group_Control_Typography::get_type(), [
			'name' => 'footer_typography',
			'selector' => '{{WRAPPER}} .banae-pricing-footer',
		] );

		$widget->add_control( 'footer_color', [
			'label' => __( 'Color', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .banae-pricing-footer' => 'color: {{VALUE}};' ],
		] );

		$widget->add_control(
			'footer_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 15,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Highlighted Color
		$widget->start_controls_section( 'highlighted_style_section', [
			'label' => __( 'Highlight Area', 'banana-addons-for-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE,
			'condition' => [
				'show_highlighter' => 'yes',
			]
		] );

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'highlighter_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-pricing-table.banae-pt-highlight',
				'default' => '#f7faff',
				'condition' => [
					'show_highlighter' => 'yes',
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'highlighted_border',
				'selector' => '{{WRAPPER}} .banae-pricing-table.banae-pt-highlight',
				'condition' => [
					'show_highlighter' => 'yes',
				]
			]
		);

		$widget->add_control(
			'highlighted_border_color',
			[
				'label' => esc_html__( 'Border Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-pricing-table.banae-pt-highlight' => 'border-color: {{VALUE}} !important;',
				],
				'default' => '#27C421',
				'condition' => [
					'show_highlighter' => 'yes',
				]
			]
		);

		$widget->end_controls_section();
	}
}