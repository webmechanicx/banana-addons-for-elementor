<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Banana_Addons\Elementor\Helper;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;

class Banae_PayPal_Button {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		// PayPal Settings
		$widget->start_controls_section(
			'banae_paypal_content_section',
			[
				'label' => __( 'PayPal Settings', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'environment',
			[
				'label' => __( 'Environment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sandbox',
				'options' => [
					'sandbox' => __( 'Sandbox (Test Mode)', 'banana-addons-for-elementor' ),
					'live' => __( 'Live', 'banana-addons-for-elementor' ),
				],
			]
		);

		$widget->add_control(
			'paypal_email',
			[
				'label' => __( 'PayPal Business Email', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'your-paypal-email@example.com', 'banana-addons-for-elementor' ),
				'default' => '',
				'label_block' => true,
			]
		);

		$widget->add_control(
			'payment_type',
			[
				'label' => __( 'Payment Type', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '_xclick',
				'options' => [
					'_xclick' => 'Checkout',
					'_donations' => 'Donations',
					'_xclick-subscriptions' => 'Subscriptions',
				],
			]
		);

		$widget->add_control(
			'item_name',
			[
				'label' => __( 'Item Name', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Product Purchase', 'banana-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$widget->add_control(
			'amount',
			[
				'label' => __( 'Amount', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$widget->add_control(
			'currency',
			[
				'label' => __( 'Currency', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'USD',
				'options' => Helper::get_currency(),
			]
		);

		$widget->add_control(
			'billing_cycle',
			[
				'label' => esc_html__( 'Billing Cycle', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'months',
				'options' => [
					'days' => esc_html__( 'Daily', 'banana-addons-for-elementor' ),
					'weeks' => esc_html__( 'Weekly', 'banana-addons-for-elementor' ),
					'months' => esc_html__( 'Monthly', 'banana-addons-for-elementor' ),
					'years' => esc_html__( 'Yearly', 'banana-addons-for-elementor' ),
				],
				'condition' => [
					'payment_type' => '_xclick-subscriptions',
				],
			]
		);

		$widget->add_control(
			'auto_renewal',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Auto Renewal', 'banana-addons-for-elementor' ),
				'default' => 'yes',
				'label_off' => esc_html__( 'Off', 'banana-addons-for-elementor' ),
				'label_on' => esc_html__( 'On', 'banana-addons-for-elementor' ),
				'condition' => [
					'payment_type' => '_xclick-subscriptions',
				],
			]
		);

		$widget->add_control(
			'quantity',
			[
				'label' => esc_html__( 'Quantity', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
				'condition' => [
					'payment_type' => '_xclick',
				],
			]
		);

		$widget->add_control(
			'shipping_price',
			[
				'label' => esc_html__( 'Shipping Price', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'payment_type' => '_xclick',
				],
			]
		);

		$widget->add_control(
			'tax_type',
			[
				'label' => esc_html__( 'Tax', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'None', 'banana-addons-for-elementor' ),
					'percentage' => esc_html__( 'Percentage', 'banana-addons-for-elementor' ),
				],
				'condition' => [
					'payment_type' => '_xclick',
				],
			]
		);

		$widget->add_control(
			'tax_rate',
			[
				'label' => esc_html__( 'Tax Percentage', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '0',
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'payment_type' => '_xclick',
					'tax_type' => 'percentage',
				],
			]
		);

		$widget->add_control(
			'return_url',
			[
				'label' => __( 'Return URL (Success)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://example.com/thank-you', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'cancel_url',
			[
				'label' => __( 'Cancel URL', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://example.com/cancelled', 'banana-addons-for-elementor' ),
			]
		);

		$widget->end_controls_section();

		// Button Settings
		$widget->start_controls_section(
			'banae_paypal_button_content_section',
			[
				'label' => __( 'Button Settings', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Pay with PayPal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'button_icon',
			[
				'label' => __( 'Button Icon', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-paypal',
					'library' => 'fa-brands',
				],
			]
		);

		$widget->add_responsive_control(
			'align',
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
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .banae-paypal-button__wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_section();

		// Style Section
		$widget->start_controls_section(
			'banae_paypal_button_style_section',
			[
				'label' => __( 'Button Style', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'button_margin',
			[
				'label' => esc_html__( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .banae-paypal-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .banae-paypal-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .banae-paypal-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'button_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Button action style tabs
		$widget->start_controls_tabs(
			'button_style_tabs'
		);

		// button normal tab
		$widget->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'button_normal_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-paypal-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'button_normal_text_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-paypal-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_tab();

		// button hover tab
		$widget->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'button_hover_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-paypal-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'button_hover_text_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-paypal-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();


		$widget->end_controls_section();
	}
}