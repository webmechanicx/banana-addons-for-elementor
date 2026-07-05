<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

class Banae_progress_bar_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {
		// Section: Skills List
		$widget->start_controls_section(
			'banae_section_progress_bars',
			[
				'label' => __( 'Progress', 'banana-addons-for-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'progress_item_name',
			[
				'label' => __( 'Item Name', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'JavaScript', 'banana-addons-for-elementor' ),
			]
		);

		$repeater->add_control(
			'progress_item_percent',
			[
				'label' => __( 'Progress (%)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 80,
				],
			]
		);

		$repeater->add_control(
			'bar_color',
			[
				'label' => __( 'Bar Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#2575fc',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banae-bar-inner' => 'background: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .circular-bar .circle' => 'stroke: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'bar_background',
			[
				'label' => __( 'Bar Background', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banae-progress-bar' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .circular-bar .circle-bg' => 'stroke: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'title_color',
			[
				'label' => __( 'Skill Title Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banae-progress-bar-title' => 'color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'percent_color',
			[
				'label' => __( 'Percentage Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#555',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banae-percent' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'bar_style',
			[
				'label' => __( 'Progress Style', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'bar-style-1' => __( 'Style 1', 'banana-addons-for-elementor' ),
					'bar-style-2' => __( 'Style 2', 'banana-addons-for-elementor' ),
					'bar-style-3' => __( 'Style 3', 'banana-addons-for-elementor' ),
				],
				'default' => 'bar-style-1',
			]
		);

		$widget->add_control(
			'animation_speed',
			[
				'label' => __( 'Animation Speed (ms)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 100, 'max' => 5000, 'step' => 100 ],
				],
				'default' => [
					'size' => 800,
				],
			]
		);

		$widget->add_control(
			'bar_height',
			[
				'label' => __( 'Bar Height (px)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 2,
				'max' => 100,
				'step' => 1,
				'default' => 14,
				'selectors' => [
					'{{WRAPPER}} .banae-progress-bar' => 'height: {{SIZE}}px;',
				],
			]
		);

		$widget->add_control(
			'progress_items',
			[
				'label' => __( 'Progress Items', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [],
				'title_field' => '{{{ progress_item_name }}}',
			]
		);

		$widget->end_controls_section();

		// Style Tab
		$widget->start_controls_section(
			'banae_progress_style_section',
			[
				'label' => __( 'Bar Styles', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Progress Title Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-progress-bar-title',
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'percent_typography',
				'label' => __( 'Percentage Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-percent',
			]
		);

		$widget->add_control(
			'tooltip_color',
			[
				'label' => esc_html__( 'Percent Hightlighter Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-bar-style-2 .banae-percent' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .banae-bar-style-2 .banae-percent::before' => 'border-top-color: {{VALUE}}',
				],
				'condition' => [
					'bar_style' => 'bar-style-2',
				],
				'default' => '#2575fc',
			]
		);

		$widget->add_control(
			'bar_gap_space',
			[
				'label' => esc_html__( 'Bar Gap Space', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-progress-bar-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'bar_border_radius',
			[
				'label' => esc_html__( 'Bar Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 10,
					'right' => 10,
					'bottom' => 10,
					'left' => 10,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-progress-bar-item .banae-progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'inner_bar_style_section',
			[
				'label' => esc_html__( 'Inner Bar Style', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'inner_bar_border_radius',
			[
				'label' => esc_html__( 'Inner Bar Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 10,
					'right' => 10,
					'bottom' => 10,
					'left' => 10,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-progress-bar-item .banae-progress-bar .banae-bar-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();
	}

}