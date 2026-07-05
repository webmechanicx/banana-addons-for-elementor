<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

class Banae_Review_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		// Review Content Section
		$widget->start_controls_section(
			'banae_review_content_section',
			[
				'label' => __( 'Review Content', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'client_image',
			[
				'label' => __( 'Client Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

		$widget->add_control(
			'client_name',
			[
				'label' => __( 'Name', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'John Doe', 'banana-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$widget->add_control(
			'client_designation',
			[
				'label' => __( 'Designation', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'CEO, Company', 'banana-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$widget->add_control(
			'review_comment',
			[
				'label' => __( 'Review Comment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'This is an amazing service. Highly recommended!', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'review_show_num_star',
			[
				'label' => esc_html__( 'Show Stars with number', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$widget->add_control(
			'review_star_rating',
			[
				'label' => esc_html__( 'Star Rating', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0.0,
				'max' => 5.0,
				'step' => 0.1,
				'default' => 5,
			]
		);

		$widget->end_controls_section();

		// Container Style Section
		$widget->start_controls_section(
			'banae_review_container_style_section',
			[
				'label' => __( 'Container', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'review_container_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-review-widget__wrapper',
			]
		);

		$widget->add_control(
			'review_text_align',
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
					'{{WRAPPER}} .banae-review-widget__wrapper' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .banae-review-widget__wrapper.banae-align-top .banae-review__content' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .banae-review-widget__wrapper.banae-align-left .banae-review__content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$widget->add_responsive_control(
			'review_container_margin',
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
					'{{WRAPPER}} .banae-review-widget__wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$widget->add_responsive_control(
			'review_container_padding',
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
					'{{WRAPPER}} .banae-review-widget__wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'review_container_border',
				'selector' => '{{WRAPPER}} .banae-review-widget__wrapper',
				'separator' => 'before',
			]
		);

		$widget->add_responsive_control(
			'review_container_radius',
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
					'{{WRAPPER}} .banae-review-widget__wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'review_container_box_shadow',
				'selector' => '{{WRAPPER}} .banae-review-widget__wrapper',
			]
		);

		$widget->end_controls_section();

		// Image Style Section
		$widget->start_controls_section(
			'banae_image_style_section',
			[
				'label' => __( 'Image', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'review_image_alignment',
			[
				'label' => __( 'Image Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
				],
				'default' => 'top',
				'toggle' => true,
			]
		);

		$widget->add_responsive_control(
			'review_image_size',
			[
				'label' => __( 'Size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 80,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-review-widget__wrapper img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'review_image_padding',
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
					'{{WRAPPER}} .banae-review-widget__wrapper .banae-review-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'review_image_border',
				'label' => __( 'Border', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-review-widget__wrapper .banae-review-image img',
			]
		);

		$widget->add_control(
			'review_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 50,
					'right' => 50,
					'bottom' => 50,
					'left' => 50,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-review-widget__wrapper .banae-review-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'review_image_offset',
			[
				'label' => __( 'Offset Y', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'default' => [
					'size' => 0,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-review-widget__wrapper .banae-review-image img' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'review_image_left_gaps',
			[
				'label' => __( 'Right Gaps', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-review-widget__wrapper.banae-align-left .banae-review-image' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'review_image_alignment' => 'left',
				],
			]
		);

		/*
		$widget->add_responsive_control(
			'review_image_top_gaps',
			[
				'label' => __( 'Bottom Gaps', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-review-widget__wrapper.banae-align-top .banae-review-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'review_image_alignment' => 'top',
				],
			]
		);
		*/

		$widget->end_controls_section();

		// Header Meta Style Section
		$widget->start_controls_section(
			'banae_review_meta_style_section',
			[
				'label' => __( 'Review Meta', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'review_review_meta_gap',
			[
				'label' => __( 'Header Meta Gaps', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-review-widget__wrapper .banae-review__meta' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'review_client_name_typography',
				'label' => esc_html__( 'Client Name', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-review__meta .banae-review-name',
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'review_client_name_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-review__meta .banae-review-name' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'review_client_position_typography',
				'label' => esc_html__( 'Client Designation', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-review__meta .banae-review-designation',
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'review_client_position_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-review__meta .banae-review-designation' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->end_controls_section();

		// Header Meta Star Style Section
		$widget->start_controls_section(
			'banae_review_star_style_section',
			[
				'label' => __( 'Review Star', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'review_num_star_bg_color',
			[
				'label' => esc_html__( 'Stars & Number Background', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-review__meta .banae-review__num-star' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'review_show_num_star' => 'yes',
				]
			]
		);

		$widget->add_control(
			'review_num_star_text_color',
			[
				'label' => esc_html__( 'Stars & Number Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-review__meta .banae-review__num-star' => 'color: {{VALUE}}',
				],
				'condition' => [
					'review_show_num_star' => 'yes',
				]
			]
		);

		$widget->add_control(
			'review_star_color',
			[
				'label' => esc_html__( 'Star Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-review__meta .banae-review__stars .banae-star-icon' => 'color: {{VALUE}}',
				],
				'default' => '#FFD700',
			]
		);

		$widget->end_controls_section();

		// Review Comment Style Section
		$widget->start_controls_section(
			'banae_review_comment_style_section',
			[
				'label' => __( 'Review Comment', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'review_comment_typography',
				'selector' => '{{WRAPPER}} .banae-review-widget__wrapper .banae-review-comment',
			]
		);

		$widget->add_control(
			'review_comment_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-review-widget__wrapper .banae-review-comment' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_responsive_control(
			'review_review_comment_gap',
			[
				'label' => __( 'Review Comment Gaps', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-review-widget__wrapper .banae-review-comment' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

	}
}