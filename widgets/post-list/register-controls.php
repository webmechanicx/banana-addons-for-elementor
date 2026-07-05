<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

class Banae_Post_List {

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
				'label' => __( 'Query', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'post_type',
			[
				'label' => __( 'Post Type', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => [
					'post' => __( 'Posts', 'banana-addons-for-elementor' ),
					'page' => __( 'Pages', 'banana-addons-for-elementor' ),
					'product' => __( 'Products', 'banana-addons-for-elementor' ),
				],
			]
		);

		$widget->add_control(
			'post_count',
			[
				'label' => __( 'Number of Posts', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
			]
		);

		$widget->add_control(
			'order',
			[
				'label' => __( 'Order', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'ASC' => __( 'Ascending', 'banana-addons-for-elementor' ),
					'DESC' => __( 'Descending', 'banana-addons-for-elementor' ),
				],
			]
		);

		$widget->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => __( 'Date', 'banana-addons-for-elementor' ),
					'title' => __( 'Title', 'banana-addons-for-elementor' ),
					'rand' => __( 'Random', 'banana-addons-for-elementor' ),
					'menu_order' => __( 'Menu Order', 'banana-addons-for-elementor' ),
				],
			]
		);

		$widget->end_controls_section();

		// Layout Section
		$widget->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'layout_style',
			[
				'label' => __( 'Layout Style', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'list-view' => [
						'title' => __( 'List', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-post-list',
					],
					'grid-view' => [
						'title' => __( 'Grid', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-posts-grid',
					],
				],
				'default' => 'list-view',
				'toggle' => true,
			]
		);

		$widget->end_controls_section();

		// Post Settings
		$widget->start_controls_section(
			'section_elements',
			[
				'label' => __( 'Settings', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'show_image',
			[
				'label' => __( 'Show Featured Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$widget->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium',
				'condition' => [
					'show_image' => 'yes'
				],
			]
		);

		$widget->add_control(
			'show_excerpt',
			[
				'label' => __( 'Show Excerpt', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'excerpt_length',
			[
				'label' => __( 'Excerpt Length (words)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 20,
				'condition' => [ 'show_excerpt' => 'yes' ],
			]
		);

		$widget->add_control(
			'show_meta',
			[
				'label' => __( 'Show Post Meta (Author, Date)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'show_readmore',
			[
				'label' => __( 'Show Read More', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'read_more_text',
			[
				'label' => __( 'Read More Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'banana-addons-for-elementor' ),
				'condition' => [
					'show_readmore' => 'yes'
				],
			]
		);

		$widget->end_controls_section();

		// Container Style Tabs
		$widget->start_controls_section(
			'container_style_section',
			[
				'label' => __( 'Container', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'container_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-post-card',
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'container_border',
				'selector' => '{{WRAPPER}} .banae-post-card',
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'container_box_shadow',
				'selector' => '{{WRAPPER}} .banae-post-card',
			]
		);

		$widget->add_responsive_control(
			'post_item_container_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 20,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'post_item_container_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 10,
					'right' => 10,
					'bottom' => 10,
					'left' => 10,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'post_item_container_radius',
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
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-list-item .banae-post-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'post_item_container_box_shadow',
				'selector' => '{{WRAPPER}} .banae-post-list-item',
			]
		);

		$widget->end_controls_section();


		// Feature Image Style Tabs
		$widget->start_controls_section(
			'feature_image_style_section',
			[
				'label' => __( 'Feature Image', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'feature_image_width',
			[
				'label' => esc_html__( 'Width', 'banana-addons-for-elementor' ),
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
					'size' => "auto",
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-card img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'feature_image_height',
			[
				'label' => esc_html__( 'Height', 'banana-addons-for-elementor' ),
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
					'size' => "auto",
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-card img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'feature_image_position',
			[
				'label' => esc_html__( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Top', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'end' => [
						'title' => esc_html__( 'Bottom', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'stretch',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .banae-post-card' => 'align-items: {{VALUE}};',
				],
			]
		);

		$widget->add_responsive_control(
			'feature_image_padding',
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
					'{{WRAPPER}} .banae-post-card img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'feature_image_margin',
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
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-card img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'feature_image_border_radius',
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
					'{{WRAPPER}} .banae-post-list-item .banae-post-card img, {{WRAPPER}} .banae-post-list-item .banae-post-card banae-post-img-top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'feature_image_css_filters',
				'selector' => '{{WRAPPER}} .banae-post-list-item .banae-post-card img, {{WRAPPER}} .banae-post-list-item .banae-post-img-top',
			]
		);

		$widget->end_controls_section();

		// Title Style Tabs
		$widget->start_controls_section(
			'title_style_section',
			[
				'label' => __( 'Title', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-post-list-item h3',
			]
		);

		$widget->add_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-list-item h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$widget->start_controls_tabs(
			'title_style_tabs',
		);

		$widget->start_controls_tab(
			'title_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'title_normal_color',
			[
				'label' => __( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-post-list-item h3 a' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'title_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'title_hover_color',
			[
				'label' => __( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-post-list-item h3 a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();


		$widget->end_controls_section();

		// Content Style Tabs
		$widget->start_controls_section(
			'content_style_section',
			[
				'label' => __( 'Content', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-post-excerpt',
			]
		);

		$widget->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-post-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_responsive_control(
			'excerpt_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 20,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'content_body_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 20,
					'right' => 20,
					'bottom' => 20,
					'left' => 20,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-list-item .banae-post-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Meta Style Tabs
		$widget->start_controls_section(
			'meta_style_section',
			[
				'label' => __( 'Meta', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-post-meta',
			]
		);

		$widget->add_control(
			'meta_color',
			[
				'label' => __( 'Meta Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-post-meta' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'meta_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 15,
					'right' => 0,
					'bottom' => 15,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Button Style Tabs
		$widget->start_controls_section(
			'readmore_style_section',
			[
				'label' => __( 'Read More', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_readmore' => 'yes'
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .banae-post-readmore',
			]
		);

		$widget->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Icon', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);

		$widget->add_control(
			'button_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$widget->add_control(
			'button_icon_left_gap',
			[
				'label' => esc_html__( 'Icon Gap', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'condition' => [
					'button_icon[value]!' => '',
					'button_icon_align' => 'left',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-card-body .banae-post-readmore i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'button_icon_right_gap',
			[
				'label' => esc_html__( 'Icon Gap', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'condition' => [
					'button_icon[value]!' => '',
					'button_icon_align' => 'right',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-card-body .banae-post-readmore i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'button_bottom_gap',
			[
				'label' => esc_html__( 'Bottom Gap', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-card-body .banae-post-readmore' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 8,
					'right' => 20,
					'bottom' => 8,
					'left' => 20,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-post-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'button_radius',
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
					'{{WRAPPER}} .banae-post-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .banae-post-readmore',
			]
		);

		$widget->start_controls_tabs(
			'button_style_tabs'
		);

		$widget->start_controls_tab(
			'button_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_normal_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-post-readmore',
			]
		);

		$widget->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-post-readmore' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_normal_border',
				'selector' => '{{WRAPPER}} .banae-post-readmore',
			]
		);

		$widget->end_controls_tab();

		// hover style tab
		$widget->start_controls_tab(
			'button_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-post-readmore:hover, {{WRAPPER}} .banae-post-readmore:focus',
			]
		);

		$widget->add_control(
			'button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-post-readmore:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .banae-post-readmore:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'selector' => '{{WRAPPER}} .banae-post-readmore:hover, {{WRAPPER}} .banae-post-readmore:focus',
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();


		$widget->end_controls_section();

	}

}