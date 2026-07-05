<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Banana_Addons\Elementor\Helper;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Banae_Testimonial_Carousel {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		// Testimonial Carousal Content
		$widget->start_controls_section(
			'banae_section_testimonial',
			[
				'label' => __( 'Testimonial', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'align',
			[
				'label' => __( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
				'toggle' => false,
				'default' => 'left',
				'prefix_class' => 'banae-testimonial-carousel--',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);

		$widget->add_control(
			'testimonial_design',
			[
				'label' => __( 'Design', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'basic' => __( 'Default', 'banana-addons-for-elementor' ),
					'bubble' => __( 'Bubble', 'banana-addons-for-elementor' ),
				],
				'default' => 'basic',
				'prefix_class' => 'banae-testimonial-carousel--',
				'style_transfer' => true,
				'separator' => 'after',
			]
		);

		$widget->add_control(
			'testimonial_show_meta',
			[
				'label' => esc_html__( 'Show Customer Meta', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'customer_image',
			[
				'label' => __( 'Customer Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'customer_image',
				'default' => 'full',
				'exclude' => [ 'custom' ],
				'separator' => 'none',
			]
		);

		$repeater->add_control(
			'customer_name',
			[
				'label' => __( 'Customer Name', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Your Customer Name', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Enter Customer Name', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'customer_position',
			[
				'label' => __( 'Position', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Position, Company Name', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Enter Position, Company', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'customer_testimonial',
			[
				'label' => __( 'Testimonial', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				'placeholder' => __( 'Type testimonial', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_control(
			'testimonial_list',
			[
				'label' => esc_html__( 'Testimonial List', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'customer_name' => esc_html__( 'Name #1', 'banana-addons-for-elementor' ),
						'customer_position' => esc_html__( 'CEO, Banana Addons.', 'banana-addons-for-elementor' ),
						'customer_testimonial' => esc_html__( 'Sample Review.', 'banana-addons-for-elementor' ),
					],
					[
						'customer_name' => esc_html__( 'Name #1', 'banana-addons-for-elementor' ),
						'customer_position' => esc_html__( 'CEO, Banana Addons.', 'banana-addons-for-elementor' ),
						'customer_testimonial' => esc_html__( 'Sample Review.', 'banana-addons-for-elementor' ),
					],
				],
				'title_field' => '{{{ customer_name }}}',
			]
		);

		$widget->end_controls_section();

		// Slider Settings
		$widget->start_controls_section(
			'slider_settings_section',
			[
				'label' => __( 'Slider Settings', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::SECTION,
			]
		);

		$widget->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed (ms)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$widget->add_control(
			'slides_per_view',
			[
				'label' => esc_html__( 'Slide Per View', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 5,
			]
		);

		$widget->add_control(
			'space_between_slides',
			[
				'label' => esc_html__( 'Space Between Slides', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'step' => 5,
				'default' => 20,
			]
		);

		$widget->add_control(
			'slide_breakpoint_options',
			[
				'label' => esc_html__( 'Device Break Points', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'slides_in_320_breakpoints',
			[
				'label' => esc_html__( 'Slides in 320px Screen', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 1,
			]
		);

		$widget->add_control(
			'slides_in_768_breakpoints',
			[
				'label' => esc_html__( 'Slides in 768px Screen', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 1,
			]
		);

		$widget->add_control(
			'slides_in_1024_breakpoints',
			[
				'label' => esc_html__( 'Slides in 1024px Screen', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 1,
			]
		);

		$widget->end_controls_section();

		// Slider Navigation Section
		$widget->start_controls_section(
			'slider_controls_section',
			[
				'label' => __( 'Slider Navigation', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::SECTION,
			]
		);

		$widget->add_control(
			'show_navigation',
			[
				'label' => __( 'Show Navigation Arrows', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'show_pagination',
			[
				'label' => __( 'Show Pagination Dots', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'default' => 'no',
			]
		);

		$widget->end_controls_section();

		// Testimonial Customer
		$widget->start_controls_section(
			'banae_customer_section',
			[
				'label' => __( 'Image Masking', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'apply_image_masking',
			[
				'label' => esc_html__( 'Apply Image Mask', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$widget->add_control(
			'reviewer_mask_shape_position',
			[
				'label' => __( 'Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'label_block' => true,
				'options' => [
					'top' => __( 'Top', 'banana-addons-for-elementor' ),
					'center' => __( 'Center', 'banana-addons-for-elementor' ),
					'left' => __( 'Left', 'banana-addons-for-elementor' ),
					'right' => __( 'Right', 'banana-addons-for-elementor' ),
					'bottom' => __( 'Bottom', 'banana-addons-for-elementor' ),
					'custom' => __( 'Custom', 'banana-addons-for-elementor' )
				],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-thumb img' => '-webkit-mask-position: {{VALUE}};mask-position: {{VALUE}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes'
				]
			]
		);

		$widget->add_control(
			'reviewer_mask_shape_position_x_offset',
			[
				'label' => __( 'Offset X', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500
					],
					'%' => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-thumb img' => '-webkit-mask-position-y: {{SIZE}}{{UNIT}};mask-position-y: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes',
					'reviewer_mask_shape_position' => 'custom'
				]
			]
		);

		$widget->add_control(
			'reviewer_mask_shape_position_y_offset',
			[
				'label' => __( 'Y Offset', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500
					],
					'%' => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-thumb img' => '-webkit-mask-position-x: {{SIZE}}{{UNIT}};mask-position-x: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes',
					'reviewer_mask_shape_position' => 'custom'
				]
			]
		);

		$widget->add_control(
			'reviewer_mask_shape_size',
			[
				'label' => __( 'Size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'auto' => __( 'Auto', 'banana-addons-for-elementor' ),
					'contain' => __( 'Contain', 'banana-addons-for-elementor' ),
					'cover' => __( 'Cover', 'banana-addons-for-elementor' ),
					'custom' => __( 'Custom', 'banana-addons-for-elementor' )
				],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-thumb img' => '-webkit-mask-size: {{VALUE}};mask-size: {{VALUE}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes'
				],
				'default' => 'cover',
			]
		);

		$widget->add_control(
			'reviewer_mask_shape_custome_size',
			[
				'label' => __( 'Mask Size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 600
					],
					'%' => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-thumb img' => '-webkit-mask-size: {{SIZE}}{{UNIT}};mask-size: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes',
					'reviewer_mask_shape_size' => 'custom'
				]
			]
		);

		$widget->add_control(
			'reviewer_mask_shape_repeat',
			[
				'label' => __( 'Repeat', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no-repeat',
				'label_block' => true,
				'options' => [
					'no-repeat' => __( 'No repeat', 'banana-addons-for-elementor' ),
					'repeat' => __( 'Repeat', 'banana-addons-for-elementor' )
				],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-thumb img' => '-webkit-mask-repeat: {{VALUE}};mask-repeat: {{VALUE}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes'
				]
			]
		);

		$widget->add_control(
			'reviewer_image_masking',
			[
				'label' => esc_html__( 'Choose Masking', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::VISUAL_CHOICE,
				'label_block' => true,
				'options' => Helper::banae_masking_shape_list(),
				'default' => 'shape-1',
				'columns' => 4,
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-thumb img' => 'border-radius: 0px;-webkit-mask-image: url(' . BANANA_ADDONS_ASSETS . 'img/masking/' . '{{VALUE}}.svg); mask-image: url(' . BANANA_ADDONS_ASSETS . 'img/masking/' . '{{VALUE}}.svg);'
				],
				'condition' => [ 'apply_image_masking' => 'yes' ],
			]
		);

		$widget->end_controls_section();

		// Testimonial Slides Style Tab
		$widget->start_controls_section(
			'banae_testimonial_slides_section_style',
			[
				'label' => __( 'Slides', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'testimonial_slide_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel-wrapper .swiper-slide' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->add_responsive_control(
			'testimonial_slide_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel-wrapper .swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'testimonial_slide_border',
				'selector' => '{{WRAPPER}} .banae-testimonial-carousel-wrapper .swiper-slide',
			]
		);

		$widget->add_responsive_control(
			'testimonial_slide_border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel-wrapper .swiper-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonial_slide_box_shadow',
				'selector' => '{{WRAPPER}} .banae-testimonial-carousel-wrapper .swiper-slide',
			]
		);

		$widget->end_controls_section();

		// Testimonial Style Tab
		$widget->start_controls_section(
			'banae_testimonial_section_style',
			[
				'label' => __( 'Testimonial', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'testimonial_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'testimonial_spacing',
			[
				'label' => __( 'Bottom Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'testimonial_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__content' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'testimonial_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__content' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .banae-testimonial-carousel__content:after' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonial_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-testimonial-carousel__content',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$widget->add_responsive_control(
			'testimonial_border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonial_box_shadow',
				'selector' => '{{WRAPPER}} .banae-testimonial-carousel__content',
			]
		);

		$widget->end_controls_section();

		// Reviewer Meta Style Tab
		$widget->start_controls_section(
			'banae_section_style_reviewer',
			[
				'label' => __( 'Customer', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'testimonial_heading_name',
			[
				'label' => __( 'Name', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$widget->add_control(
			'name_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-name' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-testimonial-carousel__customer-name',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$widget->add_responsive_control(
			'name_spacing',
			[
				'label' => __( 'Bottom Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'label_heading_title',
			[
				'label' => __( 'Title', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-position' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-testimonial-carousel__customer-position',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$widget->add_control(
			'header_image_options',
			[
				'label' => esc_html__( 'Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 65,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-thumb' => '-webkit-flex: 0 0 {{SIZE}}{{UNIT}}; -ms-flex: 0 0 {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}}.banae-testimonial-carousel--left .banae-testimonial-carousel__customer-meta' => '-webkit-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); -ms-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); max-width: calc(100% - {{SIZE}}{{UNIT}});',

					'{{WRAPPER}}.banae-testimonial-carousel--right .banae-testimonial-carousel__customer-meta' => '-webkit-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); -ms-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); max-width: calc(100% - {{SIZE}}{{UNIT}});',

					'{{WRAPPER}}.banae-testimonial-carousel--left .banae-testimonial-carousel__content:after' => 'left: calc(({{SIZE}}{{UNIT}} / 2) - 18px);',

					'{{WRAPPER}}.banae-testimonial-carousel--right .banae-testimonial-carousel__content:after' => 'right: calc(({{SIZE}}{{UNIT}} / 2) - 18px);',
				],
			]
		);

		$widget->add_responsive_control(
			'image_height',
			[
				'label' => __( 'Height', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-thumb' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'image_spacing',
			[
				'label' => __( 'Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}}.banae-testimonial-carousel--left .banae-testimonial-carousel__customer-meta' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.banae-testimonial-carousel--right .banae-testimonial-carousel__customer-meta' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.banae-testimonial-carousel--center .banae-testimonial-carousel__customer-meta' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-thumb img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .banae-testimonial-carousel__customer-thumb img',
			]
		);

		$widget->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial-carousel__customer-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'selector' => '.banae-testimonial-carousel__customer-thumb img',
			]
		);

		$widget->end_controls_section();

		// Slider Navigation Style Tab
		$widget->start_controls_section(
			'testimonial_slider_control_style_section',
			[
				'label' => esc_html__( 'Slider Navigation', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'testimonial_slider_control_color',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'background-color: {{VALUE}}',
				],
				'default' => 'transparent',
			]
		);

		$widget->add_control(
			'testimonial_slider_control_foreground_color',
			[
				'label' => esc_html__( 'Foreground Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-prev::after, {{WRAPPER}} .swiper-button-next::after' => 'color: {{VALUE}}',
				],
				'default' => '#000000',
			]
		);

		$widget->add_responsive_control(
			'testimonial_slider_control_padding',
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
					'{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'slider_control_left_offset',
			[
				'label' => esc_html__( 'Left Control Offset', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						//'min' => -1000,
						//'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -8,
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'slider_control_right_offset',
			[
				'label' => esc_html__( 'Right Control Offset', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						//'min' => -1000,
						//'max' => 1000,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => -8,
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'slider_control_border',
				'selector' => '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next',
			]
		);

		$widget->add_control(
			'testimonial_slider_control_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 2,
					'right' => 2,
					'bottom' => 2,
					'left' => 2,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Pagination Navigation Style Tab
		$widget->start_controls_section(
			'testimonial_pagination_control_style_section',
			[
				'label' => esc_html__( 'Pagination Navigation', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'testimonial_pagination_width',
			[
				'label' => esc_html__( 'Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 8,
				'step' => 1,
				'default' => 8,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{VALUE}}px;',
				],
			]
		);

		$widget->add_responsive_control(
			'testimonial_pagination_height',
			[
				'label' => esc_html__( 'Height', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 8,
				'step' => 1,
				'default' => 8,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{VALUE}}px;',
				],
			]
		);

		$widget->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$widget->add_control(
			'testimonial_pagination_control_color',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
				'default' => '#cccccc',
			]
		);

		$widget->add_responsive_control(
			'pagination_control_top_offset',
			[
				'label' => esc_html__( 'Top Offset', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						//'min' => -1000,
						//'max' => 1000,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'testimonial_pagination_control_border',
				'fields_options' => [
					'border' => [
						'label' => esc_html__( 'Border', 'banana-addons-for-elementor' ),
					],
				],
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
			]
		);

		$widget->add_control(
			'testimonial_pagination_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$widget->add_control(
			'testimonial_pagination_control_active_color',
			[
				'label' => esc_html__( 'Acive Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
				'default' => '#000000',
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'testimonial_pagination_control_active_border',
				'fields_options' => [
					'border' => [
						'label' => esc_html__( 'Active Border', 'banana-addons-for-elementor' ),
					],
				],
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet-active',
			]
		);

		$widget->add_control(
			'testimonial_pagination_after_active_border_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$widget->add_control(
			'testimonial_pagination_control_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 50,
					'right' => 50,
					'bottom' => 50,
					'left' => 50,
					'unit' => '%',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

	}

}