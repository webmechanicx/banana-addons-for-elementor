<?php

use Banana_Addons\Elementor\Helper;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Banae_Animated_Heading_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		$widget->start_controls_section(
			'banae_section_content', [
				'label' => __( 'Content', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$widget->add_control(
			'before_text', [
				'label' => __( 'Before Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'We are', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'animated_words_list',
			[
				'label' => esc_html__( 'Animated Words', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'word_text',
						'label' => esc_html__( 'Word', 'banana-addons-for-elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Word Title', 'banana-addons-for-elementor' ),
						'label_block' => true,
					],
					[
						'name' => 'word_color',
						'label' => esc_html__( 'Color', 'banana-addons-for-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
							//'{{WRAPPER}} .banae-animated-words-wrapper b' => 'color: {{VALUE}}'
						],
						'frontend_available' => true,
						'render_type' => 'template'
					]
				],
				'default' => [
					[
						'word_text' => esc_html__( 'pizza', 'banana-addons-for-elementor' ),
					],
					[
						'word_text' => esc_html__( 'sushi', 'banana-addons-for-elementor' ),
					],
					[
						'word_text' => esc_html__( 'steak', 'banana-addons-for-elementor' ),
					],
				],
				'title_field' => '{{{ word_text }}}',
			]
		);

		$widget->add_control(
			'heading_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => Helper::banae_title_tags(),
				'default' => 'h2',
				'toggle' => false,
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
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .banae-animated-headline' => 'text-align: {{VALUE}};'
				]
			]
		);

		$widget->add_control( 'animation_type', [
			'label' => __( 'Animation Type', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::SELECT,
			'options' => [
				'rotate-1' => 'rotate-1',
				'rotate-2' => 'rotate-2',
				'rotate-3' => 'rotate-3',
				'scale' => 'scale',
				'clip' => 'clip',
				'loading-bar' => 'loading-bar',
				'slide' => 'slide',
				'zoom' => 'zoom',
				'push' => 'push',
				'type' => 'type',
			],
			'default' => 'rotate-1',
		] );

		$widget->add_control(
			'loading_bar_color',
			[
				'label' => esc_html__( 'Bar Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-animated-headline.loading-bar .banae-animated-words-wrapper::after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'animation_type' => [ 'loading-bar' ],
				],
				'default' => '#0096a7',
				'frontend_available' => true,
				'render_type' => 'template'
			]
		);

		$widget->add_control(
			'cursor_color',
			[
				'label' => esc_html__( 'Cursor Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-animated-headline.type .banae-animated-words-wrapper::after, {{WRAPPER}} .banae-animated-headline.clip .banae-animated-words-wrapper::after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'animation_type' => [ 'type', 'clip' ],
				],
				'default' => '#333333',
				'frontend_available' => true,
				'render_type' => 'template'
			]
		);

		$widget->add_control(
			'cursor_width',
			[
				'label' => esc_html__( 'Cursor Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .banae-animated-headline.type .banae-animated-words-wrapper::after, {{WRAPPER}} .banae-animated-headline.clip .banae-animated-words-wrapper::after' => 'width: {{VALUE}}px;',
				],
				'condition' => [
					'animation_type' => [ 'type', 'clip' ],
				],
				'default' => '2px',
				'frontend_available' => true,
				'render_type' => 'template'
			]
		);

		$widget->add_control(
			'animationDelay',
			[
				'label' => esc_html__( 'Animation Delay', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 500,
				'step' => 1,
				'default' => 2500,
			]
		);

		$widget->add_control(
			'barAnimationDelay',
			[
				'label' => esc_html__( 'Bar Animation Delay', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 500,
				'step' => 1,
				'default' => 3800,
				'condition' => [
					'animation_type' => 'loading-bar',
				],
			]
		);

		//letters effect
		$widget->add_control(
			'lettersDelay',
			[
				'label' => esc_html__( 'Letters Animation Delay', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 50,
				'step' => 10,
				'default' => 50,
				'condition' => [
					'animation_type' => [ 'rotate-2', 'rotate-3', 'scale' ],
				],
			]
		);

		//type effect
		$widget->add_control(
			'typeLettersDelay',
			[
				'label' => esc_html__( 'Type Letters Delay', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 150,
				'step' => 10,
				'default' => 150,
				'condition' => [
					'animation_type' => 'type',
				],
			]
		);

		$widget->add_control(
			'selectionDuration',
			[
				'label' => esc_html__( 'Selection Duration', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 500,
				'step' => 10,
				'default' => 500,
				'condition' => [
					'animation_type' => 'type',
				],
			]
		);

		//clip effect
		$widget->add_control(
			'revealDuration',
			[
				'label' => esc_html__( 'Reveal Duration', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 600,
				'step' => 10,
				'default' => 600,
				'condition' => [
					'animation_type' => 'clip',
				],
			]
		);

		$widget->add_control(
			'revealAnimationDelay',
			[
				'label' => esc_html__( 'Reveal Animation Delay', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1500,
				'step' => 100,
				'default' => 1500,
				'condition' => [
					'animation_type' => 'clip',
				],
			]
		);


		$widget->end_controls_section();

		// Style Tab - Before Text Style
		$widget->start_controls_section(
			'banae_ani_heading_style_section',
			[
				'label' => esc_html__( 'Before Text', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'banae_ani_heading_before_text_typography',
				'selector' => '{{WRAPPER}} .banae-animated-headline .banae-animated-headline-pre_text',
			]
		);

		$widget->add_control(
			'banae_ani_heading_before_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-animated-headline .banae-animated-headline-pre_text' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->end_controls_section();

		// Style Tab - Animated Words Style
		$widget->start_controls_section(
			'banae_ani_heading_animated_words_style_section',
			[
				'label' => esc_html__( 'Animated Words', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'banae_ani_heading_animated_words_typography',
				'selector' => '{{WRAPPER}} .banae-animated-headline .banae-animated-words-wrapper',
			]
		);

		$widget->end_controls_section();
	}
}