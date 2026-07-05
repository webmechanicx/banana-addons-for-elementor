<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Banana_Addons\Elementor\Helper;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Banae_Business_Hours_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		$widget->start_controls_section(
			'banae_business_title_content_section',
			array(
				'label' => esc_html__( 'Content', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			)
		);

		$widget->add_control(
			'show_title',
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
			'banae_business_title',
			[
				'label' => esc_html__( 'Title', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'default' => esc_html__( 'Business Hours', 'banana-addons-for-elementor' ),
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);

		$widget->end_controls_section();

		// Business hours tab
		$widget->start_controls_section(
			'banae_business_hours_content_section',
			array(
				'label' => esc_html__( 'Day and Hour', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'banae_business_day',
			[
				'label' => esc_html__( 'Day', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Saturday', 'banana-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'banae_business_time',
			[
				'label' => esc_html__( 'Time', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( '9:00 AM - 6:00 PM', 'banana-addons-for-elementor' ),
			]
		);

		$repeater->add_responsive_control(
			'banae_business_background_color',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business-hours-inner {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$repeater->add_responsive_control(
			'banae_business_day_color',
			[
				'label' => esc_html__( 'Day Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#343434',
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business-hours-inner {{CURRENT_ITEM}} .banae-business-day' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$repeater->add_responsive_control(
			'banae_business_time_color',
			[
				'label' => esc_html__( 'Time Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#343434',
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business-hours-inner {{CURRENT_ITEM}} .banae-business-time' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'banae_open_business_hours',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ banae_business_day }}}',
				'default' => [
					[
						'banae_business_day' => esc_html__( 'Sunday', 'banana-addons-for-elementor' ),
						'banae_business_time' => esc_html__( 'Close', 'banana-addons-for-elementor' ),
					],

					[
						'banae_business_day' => esc_html__( 'Saturday', 'banana-addons-for-elementor' ),
						'banae_business_time' => esc_html__( '10:00 AM to 7:00 PM', 'banana-addons-for-elementor' ),
					],

					[
						'banae_business_day' => esc_html__( 'Monday', 'banana-addons-for-elementor' ),
						'banae_business_time' => esc_html__( '10:00 AM to 7:00 PM', 'banana-addons-for-elementor' ),
					],

					[
						'banae_business_day' => esc_html__( 'Tues Day', 'banana-addons-for-elementor' ),
						'banae_business_time' => esc_html__( '10:00 AM to 7:00 PM', 'banana-addons-for-elementor' ),
					],

					[
						'banae_business_day' => esc_html__( 'Wednesday', 'banana-addons-for-elementor' ),
						'banae_business_time' => esc_html__( '10:00 AM to 7:00 PM', 'banana-addons-for-elementor' ),
					],

					[
						'banae_business_day' => esc_html__( 'Thursday', 'banana-addons-for-elementor' ),
						'banae_business_time' => esc_html__( '10:00 AM to 7:00 PM', 'banana-addons-for-elementor' ),
					],

					[
						'banae_business_day' => esc_html__( 'Friday', 'banana-addons-for-elementor' ),
						'banae_business_time' => esc_html__( '10:00 AM to 7:00 PM', 'banana-addons-for-elementor' ),
					]
				],
			]
		);

		$widget->end_controls_section();

		// Style Title section
		$widget->start_controls_section(
			'banae_business_title_style_section',
			[
				'label' => esc_html__( 'Title', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'banae_business_title_typography',
				'selector' => '{{WRAPPER}} .banae-business-hours__main .banae-business__title h3',
			]
		);

		$widget->add_control(
			'banae_business_title_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business__title h3' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_responsive_control(
			'banae_business_title_align',
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
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business__title h3' => 'text-align: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'banae_business_title_background',
				'label' => esc_html__( 'Background', 'banana-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'video' ],
				'default' => '#A037FF',
				'selector' => '{{WRAPPER}} .banae-business-hours__main .banae-business__title',
				'separator' => 'before',
			]
		);

		$widget->add_responsive_control(
			'banae_business_title_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'default' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'unit' => 'px' ],
			]
		);

		$widget->add_responsive_control(
			'banae_business_title_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
				'default' => [ 'top' => 4, 'right' => 20, 'bottom' => 4, 'left' => 20, 'unit' => 'px' ],
			]
		);

		$widget->add_responsive_control(
			'banae_business_title_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business__title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'banae_business_title_border',
				'label' => esc_html__( 'Border', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-business-hours__main .banae-business__title:not(:last-child)',
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'banae_business_title_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-business-hours__main .banae-business__title',
			]
		);

		$widget->end_controls_section();

		// Style Item section
		$widget->start_controls_section(
			'banae_business_item_style_section',
			[
				'label' => esc_html__( 'Item', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'banae_business_item_background',
				'label' => esc_html__( 'Background', 'banana-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .banae-business-hours__main .banae-day__item',
			]
		);

		$widget->add_responsive_control(
			'banae_business_item_item_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-day__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'banae_business_item_border',
				'label' => esc_html__( 'Border', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-business-hours__main .banae-day__item:not(:last-child)',
			]
		);

		$widget->add_responsive_control(
			'banae_business_item_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-day__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$widget->add_responsive_control(
			'banae_business_item_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-day__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'banae_business_item_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-business-hours__main .banae-day__item',
			]
		);

		$widget->end_controls_section();

		// Style Business day section
		$widget->start_controls_section(
			'banae_business_day_style_section',
			[
				'label' => esc_html__( 'Day', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'banae_business_day_color',
			[
				'label' => esc_html__( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-day__item .banae-business-day' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'banae_business_day_typography',
				'selector' => '{{WRAPPER}} .banae-business-hours__main .banae-day__item .banae-business-day',
			]
		);

		$widget->add_responsive_control(
			'banae_business_day_align',
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
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business-day' => 'text-align: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_section();

		// Business Time Style section
		$widget->start_controls_section(
			'banae_business_time_style_section',
			[
				'label' => esc_html__( 'Time', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'banae_business_time_color',
			[
				'label' => esc_html__( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-day__item .banae-business-time' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'banae_business_time_typography',
				'selector' => '{{WRAPPER}} .banae-business-hours__main .banae-day__item .banae-business-time',
			]
		);

		$widget->add_responsive_control(
			'banae_business_time_align',
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
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business-time' => 'text-align: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_section();

		/*
		// Container Style section
		$widget->start_controls_section(
			'banae_business_container_style_section',
			[
				'label' => esc_html__( 'Container', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'banae_business_container_background',
				'label' => esc_html__( 'Background', 'banana-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .banae-business-hours__main .banae-business-hours-inner',
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'banae_business_container_border',
				'label' => esc_html__( 'Border', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-business-hours__main .banae-business-hours-inner',
				'separator' => 'before',
			]
		);

		$widget->add_responsive_control(
			'banae_business_container_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business-hours-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [ 'top' => 10, 'right' => 0, 'bottom' => 0, 'left' => 0, 'unit' => 'px' ]
			]
		);

		$widget->add_responsive_control(
			'banae_business_container_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business-hours-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'banae_business_container_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae-business-hours__main .banae-business-hours-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'banae_business_container_box_shadow',
				'label' => __( 'Box Shadow', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-business-hours__main ul',
				'separator' => 'before',
			]
		);

		$widget->end_controls_section();
		*/
	}

}