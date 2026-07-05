<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;

class Banae_Facebook_Feed {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		$widget->start_controls_section(
			'facebook_settings_section',
			[
				'label' => __( 'Facebook Settings', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'facebook_page_id',
			[
				'label' => esc_html__( 'Page ID', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
				'description' => '<a href="https://lookup-id.com/" target="_blank">Find Page ID</a>',
			]
		);

		$widget->add_control(
			'facebook_access_token',
			[
				'label' => esc_html__( 'Access Token', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
				'description' => '<a href="https://developers.facebook.com/apps/" target="_blank">Get Access Token.</a>',
			]
		);

		$widget->end_controls_section();

		// Content Section
		$widget->start_controls_section(
			'facebook_feed_content_section',
			[
				'label' => __( 'Content', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_responsive_control(
			'facebook_feed_counts',
			[
				'label' => esc_html__( 'Feed Counts', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 3,
				'max' => 100,
				'step' => 1,
				'default' => 10,
			]
		);

		$widget->add_responsive_control(
			'facebook_feed_columns',
			[
				'label' => esc_html__( 'Feed Columns', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 3,
			]
		);

		$widget->add_responsive_control(
			'facebook_feed_columns_gap',
			[
				'label' => esc_html__( 'Columns Gap', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
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
					'unit' => 'px',
					'size' => 38,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-facebook-feed__wrapper' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'facebook_feed_rows_gap',
			[
				'label' => esc_html__( 'Rows Gap', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
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
					'unit' => 'px',
					'size' => 38,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-facebook-feed__wrapper' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'has_feed_image_link',
			[
				'label' => esc_html__( 'Enable Image Link', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$widget->add_responsive_control(
			'show_feed_full_content',
			[
				'label' => esc_html__( 'Show Full Content', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$widget->add_responsive_control(
			'facebook_feed_excerpt',
			[
				'label' => esc_html__( 'Feed Excerpts', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 10,
				'max' => 100,
				'step' => 1,
				'default' => 20,
				'condition' => [
					'show_feed_full_content!' => 'yes'
				],
			]
		);

		$widget->end_controls_section();

		// Visibility Section
		$widget->start_controls_section(
			'facebook_feed_visibility_section',
			[
				'label' => __( 'Visibility', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'show_feed_thumbnail',
			[
				'label' => esc_html__( 'Show Thumbnail', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'show_feed_title',
			[
				'label' => esc_html__( 'Show Title', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'show_feed_content',
			[
				'label' => esc_html__( 'Show Content', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'show_feed_footer',
			[
				'label' => esc_html__( 'Show Footer', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'show_feed_user_info',
			[
				'label' => esc_html__( 'Show User Info', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_feed_footer' => 'yes'
				],
			]
		);

		$widget->add_control(
			'show_feed_reactions',
			[
				'label' => esc_html__( 'Show Reactions', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_feed_footer' => 'yes'
				],
			]
		);

		$widget->end_controls_section();

		// Feed Container Style Tab Section
		$widget->start_controls_section(
			'facebook_feed_container_style_section',
			[
				'label' => __( 'Container', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'feed_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-facebook-feed__card',
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Background', 'banana-addons-for-elementor' ),
						'default' => 'classic',
					],
					'color' => [
						'default' => '#fff',
					],
				],
			]
		);

		$widget->add_responsive_control(
			'facebook_feed_padding',
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
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-facebook-feed__card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'facebook_feed_border',
				'selector' => '{{WRAPPER}} .banae-facebook-feed__card',
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'facebook_feed_box_shadow',
				'selector' => '{{WRAPPER}} .banae-facebook-feed__card',
			]
		);

		$widget->add_control(
			'facebook_feed_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .banae-facebook-feed__card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Image Style Section
		$widget->start_controls_section(
			'facebook_feed_style_section',
			[
				'label' => __( 'Thumbnail', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_feed_thumbnail' => 'yes'
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'feed_img_css_filters',
				'selector' => '{{WRAPPER}} .banae-facebook-feed-img__top',
			]
		);

		$widget->add_control(
			'feed_image_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .banae-facebook-feed-img__top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Feed Content Style Tab Section
		$widget->start_controls_section(
			'facebook_feed_content_style_section',
			[
				'label' => __( 'Content', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'facebook_feed_title_heading',
			[
				'label' => esc_html__( 'Title', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'facebook_feed_title_typography',
				'selector' => '{{WRAPPER}} .banae-facebook-feed__card-title',
			]
		);

		$widget->add_control(
			'facebook_feed_title_color',
			[
				'label' => esc_html__( 'Title Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-facebook-feed__card-title' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'facebook_feed_body_heading',
			[
				'label' => esc_html__( 'Body', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feed_content_typography',
				'selector' => '{{WRAPPER}} .banae-facebook-feed__card-body,{{WRAPPER}} .banae-facebook-feed__card-body p',
			]
		);

		$widget->add_control(
			'feed_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-facebook-feed__card-body,{{WRAPPER}} .banae-facebook-feed__card-body p' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->end_controls_section();


		// Feed Footer Style Tab Section
		$widget->start_controls_section(
			'facebook_feed_footer_style_section',
			[
				'label' => __( 'Footer', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_feed_footer' => 'yes'
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feed_footer_typography',
				'selector' => '{{WRAPPER}} .banae-feed-user__info h5,{{WRAPPER}} .banae-feed-user__info .created_at',
			]
		);

		$widget->add_control(
			'feed_footer_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-feed-user__info h5,{{WRAPPER}} .banae-feed-user__info .created_at' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'feed_footer_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-facebook-feed__card-footer',
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Background', 'banana-addons-for-elementor' ),
						'default' => 'classic',
					],
					'color' => [
						'default' => 'rgba(0, 0, 0, .03)',
					],
				],
			]
		);

		$widget->add_responsive_control(
			'facebook_feed_footer_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => .75,
					'right' => 1.25,
					'bottom' => .75,
					'left' => 1.25,
					'unit' => 'rem',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-facebook-feed__card .banae-facebook-feed__card-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'facebook_feed_footer_margin',
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
					'{{WRAPPER}} .banae-facebook-feed__card .banae-facebook-feed__card-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'facebook_feed_border',
				'selector' => '{{WRAPPER}} .banae-facebook-feed__card-footer',
				'fields_options' => [
					'border' => [
						'default' => 'solid', // Set default border style to solid
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '0',
							'bottom' => '0',
							'left' => '0',
							'unit' => 'px',
						],
					],
					'color' => [
						'default' => 'rgba(0, 0, 0, 0.125)', // Set default border color to black
					],
				],
			]
		);

		$widget->add_control(
			'feed_footer_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .banae-facebook-feed__card-footer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Feed Reaction Style Tab Section
		$widget->start_controls_section(
			'facebook_feed_reaction_style_section',
			[
				'label' => __( 'Reaction', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_feed_reactions' => 'yes'
				],
			]
		);

		$widget->add_control(
			'feed_reaction_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-feed-engagement__meta' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->end_controls_section();

	}

}