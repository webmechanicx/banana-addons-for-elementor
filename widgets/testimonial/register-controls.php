<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Banana_Addons\Elementor\Helper;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Banae_Testimonial_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		$widget->start_controls_section(
			'banae_section_testimonial',
			[
				'label' => __( 'Testimonial', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'testimonial',
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
				'prefix_class' => 'banae-testimonial--',
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
				'prefix_class' => 'banae-testimonial--',
				'style_transfer' => true,
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'banae_customer_section',
			[
				'label' => __( 'Customer', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'image',
			[
				'label' => __( 'Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'exclude' => [ 'custom' ],
				'separator' => 'none',
			]
		);

		$widget->add_control(
			'name',
			[
				'label' => __( 'Name', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Your Customer Name', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Enter Customer Name', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_control(
			'position',
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
			'reviewer_image_masking',
			[
				'label' => esc_html__( 'Choose Masking', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::VISUAL_CHOICE,
				'label_block' => true,
				'options' => Helper::banae_masking_shape_list(),
				'default' => 'shape-1',
				'columns' => 4,
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial__customer-thumb img' => 'border-radius: 0px;-webkit-mask-image: url(' . BANANA_ADDONS_ASSETS . 'img/masking/' . '{{VALUE}}.svg); mask-image: url(' . BANANA_ADDONS_ASSETS . 'img/masking/' . '{{VALUE}}.svg);'
				],
				'condition' => [ 'apply_image_masking' => 'yes' ],
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
					'{{WRAPPER}} .banae-testimonial__customer-thumb img' => '-webkit-mask-position: {{VALUE}};mask-position: {{VALUE}};'
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
					'{{WRAPPER}} .banae-testimonial__customer-thumb img' => '-webkit-mask-position-y: {{SIZE}}{{UNIT}};mask-position-y: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} .banae-testimonial__customer-thumb img' => '-webkit-mask-position-x: {{SIZE}}{{UNIT}};mask-position-x: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} .banae-testimonial__customer-thumb img' => '-webkit-mask-size: {{VALUE}};mask-size: {{VALUE}};'
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
					'{{WRAPPER}} .banae-testimonial__customer-thumb img' => '-webkit-mask-size: {{SIZE}}{{UNIT}};mask-size: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} .banae-testimonial__customer-thumb img' => '-webkit-mask-repeat: {{VALUE}};mask-repeat: {{VALUE}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes'
				]
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'banae_section_testimonial_link',
			[
				'label' => __( 'Wrapper Link', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'testimonial_link',
			[
				'label' => esc_html__( 'Link', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
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
					'{{WRAPPER}} .banae-testimonial__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .banae-testimonial__content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'testimonial_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial__content' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'testimonial_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial__content' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .banae-testimonial__content:after' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonial_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-testimonial__content',
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
					'{{WRAPPER}} .banae-testimonial__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonial_box_shadow',
				'selector' => '{{WRAPPER}} .banae-testimonial__content',
			]
		);

		$widget->end_controls_section();

		// Reviewer Image Style Tab
		$widget->start_controls_section(
			'banae_section_style_image',
			[
				'label' => __( 'Image', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .banae-testimonial__customer-thumb' => '-webkit-flex: 0 0 {{SIZE}}{{UNIT}}; -ms-flex: 0 0 {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}}.banae-testimonial--left .banae-testimonial__customer-meta' => '-webkit-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); -ms-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); max-width: calc(100% - {{SIZE}}{{UNIT}});',

					'{{WRAPPER}}.banae-testimonial--right .banae-testimonial__customer-meta' => '-webkit-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); -ms-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); max-width: calc(100% - {{SIZE}}{{UNIT}});',

					'{{WRAPPER}}.banae-testimonial--left .banae-testimonial__content:after' => 'left: calc(({{SIZE}}{{UNIT}} / 2) - 18px);',

					'{{WRAPPER}}.banae-testimonial--right .banae-testimonial__content:after' => 'right: calc(({{SIZE}}{{UNIT}} / 2) - 18px);',
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
					'{{WRAPPER}} .banae-testimonial__customer-thumb' => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}}.banae-testimonial--left .banae-testimonial__customer-meta' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.banae-testimonial--right .banae-testimonial__customer-meta' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.banae-testimonial--center .banae-testimonial__customer-meta' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .banae-testimonial__customer-thumb img',
			]
		);

		$widget->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-testimonial__customer-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'selector' => '.banae-testimonial__customer-thumb img',
			]
		);

		$widget->end_controls_section();

		// Reviewer Meta Style Tab
		$widget->start_controls_section(
			'banae_section_style_reviewer',
			[
				'label' => __( 'Reviewer', 'banana-addons-for-elementor' ),
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
					'{{WRAPPER}} .banae-testimonial__customer-name' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-testimonial__customer-name',
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
					'{{WRAPPER}} .banae-testimonial__customer-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .banae-testimonial__customer-position' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-testimonial__customer-position',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$widget->end_controls_section();

	}
}