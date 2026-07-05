<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Elementor\Controls_Manager;

class Banae_Stripe_Button {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {
		$widget->start_controls_section(
			'banae_stripe_content_section',
			[
				'label' => __( 'Stripe Settings', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'publishable_key',
			[
				'label' => __( 'Publishable Key', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'pk_live_123456...', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'button_id',
			[
				'label' => __( 'Button ID', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'buy_btn_ABC123XYZ', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'alignment',
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
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .banae-stripe-button__wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_section();
	}
}