<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;

class Banae_Smart_PayPal_Button {

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
			'section_paypal',
			[
				'label' => __( 'PayPal Settings', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'client_id',
			[
				'label' => __( 'PayPal Client ID', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your PayPal Client ID', 'banana-addons-for-elementor' ),
				'description' => __( 'You can get this from https://developer.paypal.com/dashboard/applications', 'banana-addons-for-elementor' ),
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
			'item_name',
			[
				'label' => __( 'Item Name', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Sample Product', 'banana-addons-for-elementor' ),
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
				'options' => [
					'USD' => 'USD',
					'EUR' => 'EUR',
					'GBP' => 'GBP',
					'AUD' => 'AUD',
					'CAD' => 'CAD',
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

		// Button Display Settings
		$widget->start_controls_section(
			'section_button',
			[
				'label' => __( 'Button Display', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'button_alignment',
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
					'{{WRAPPER}} .paypal-smart-button-container' => 'text-align: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_section();
	}
}