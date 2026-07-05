<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Banae_Hover_Link_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {
		$widget->start_controls_section(
			'banae_hover_link_section_title',
			array(
				'label' => __( 'Link Content', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			)
		);

		$widget->add_control(
			'banae_hover_link_animation_style',
			array(
				'label' => __( 'Animation Style', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => __( 'Style-1', 'banana-addons-for-elementor' ),
					'style-2' => __( 'Style-2', 'banana-addons-for-elementor' ),
					'style-3' => __( 'Style-3', 'banana-addons-for-elementor' ),
					'style-4' => __( 'Style-4', 'banana-addons-for-elementor' ),
					'style-5' => __( 'Style-5', 'banana-addons-for-elementor' ),
					'style-6' => __( 'Style-6', 'banana-addons-for-elementor' ),
					'style-7' => __( 'Style-7', 'banana-addons-for-elementor' ),
					'style-8' => __( 'Style-8', 'banana-addons-for-elementor' ),
					'style-9' => __( 'Style-9', 'banana-addons-for-elementor' ),
					'style-10' => __( 'Style-10', 'banana-addons-for-elementor' ),
					'style-11' => __( 'Style-11', 'banana-addons-for-elementor' ),
					'style-12' => __( 'Style-12', 'banana-addons-for-elementor' ),
					'style-13' => __( 'Style-13', 'banana-addons-for-elementor' ),
					'style-14' => __( 'Style-14', 'banana-addons-for-elementor' ),
					'style-15' => __( 'Style-15', 'banana-addons-for-elementor' ),
					'style-16' => __( 'Style-16', 'banana-addons-for-elementor' ),
					'style-17' => __( 'Style-17', 'banana-addons-for-elementor' ),
					'style-18' => __( 'Style-18', 'banana-addons-for-elementor' ),
					'style-19' => __( 'Style-19', 'banana-addons-for-elementor' ),
					'style-20' => __( 'Style-20', 'banana-addons-for-elementor' ),
					//'style-21' => __( 'Style-21', 'banana-addons-for-elementor' ),
				),
			)
		);

		$widget->add_control(
			'banae_hover_link_text',
			array(
				'label' => __( 'Title', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Animated Link', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Type Link Title', 'banana-addons-for-elementor' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$widget->add_responsive_control(
			'banae_hover_link_align',
			[
				'label' => __( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
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
					]
				],
				'default' => 'left',
				'toggle' => true,
				'selectors_dictionary' => [
					'left' => 'justify-content: flex-start',
					'center' => 'justify-content: center',
					'right' => 'justify-content: flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .banae_content__item' => '{{VALUE}}'
				]
			]
		);

		$widget->add_control(
			'banae_hover_link_url',
			array(
				'label' => __( 'Link', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://sample-link.com', 'banana-addons-for-elementor' ),
				'show_external' => true,
				'default' => array(
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				),
			)
		);

		$widget->end_controls_section();

		// Hover Link Style Tab
		$widget->start_controls_section(
			'banae_hover_link_style_section',
			array(
				'label' => __( 'Link', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name' => 'banae_hover_link_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae_content__item .banae-link',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			)
		);

		$widget->add_responsive_control(
			'banae_hover_link_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .banae_content__item .banae-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$widget->add_responsive_control(
			'banae_hover_link_padding',
			array(
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors' => array(
					'{{WRAPPER}} .banae_content__item .banae-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator' => 'after',
			)
		);

		// Style Normal Tab
		$widget->start_controls_tabs(
			'banae_hover_link_style_tabs'
		);

		$widget->start_controls_tab(
			'banae_hover_link_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'banae_hover_link_color',
			array(
				'label' => __( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .banae_content__item .banae-link' => 'color: {{VALUE}};',
				),
			)
		);

		$widget->end_controls_tab();

		// Style Hover Tab
		$widget->start_controls_tab(
			'banae_hover_link_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'banae_hover_link_hover_color',
			array(
				'label' => __( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .banae_content__item .banae-link:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->end_controls_section();
	}
}