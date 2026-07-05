<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

class Banae_Avatar_Group_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		$widget->start_controls_section(
			'banae_avatar_group_tooltips_section',
			[
				'label' => esc_html__( 'Tooltips', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'banae_avatar_show_tooltips',
			[
				'label' => esc_html__( 'Show Tooltips?', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'banae_avatar_group_content_section',
			[
				'label' => esc_html__( 'Content', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'banae_avatar_group_name',
			[
				'label' => esc_html__( 'Name', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Name', 'banana-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'banae_avatar_image',
			[
				'label' => esc_html__( 'Choose Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

		$repeater->add_control(
			'banae_avatar_image_width',
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
					'unit' => 'rem',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-avatar-group {{CURRENT_ITEM}}.banae-avatar img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'banae_avatar_image_height',
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
					'unit' => 'rem',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-avatar-group {{CURRENT_ITEM}}.banae-avatar img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'banae_avatar_img_index',
			[
				'label' => esc_html__( 'Z-index', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 0,
				'selectors' => [
					'{{WRAPPER}} .banae-avatar-group {{CURRENT_ITEM}}.banae-avatar' => 'z-index: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'banae_avatar_list',
			[
				'label' => esc_html__( 'Avatar List', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'banae_avatar_group_name' => esc_html__( 'Person Name #1', 'banana-addons-for-elementor' ),
						'banae_avatar_image' => '',
					],
					[
						'banae_avatar_group_name' => esc_html__( 'Person Name #2', 'banana-addons-for-elementor' ),
						'banae_avatar_image' => '',
					],
					[
						'banae_avatar_group_name' => esc_html__( 'Person Name #3', 'banana-addons-for-elementor' ),
						'banae_avatar_image' => '',
					],
					[
						'banae_avatar_group_name' => esc_html__( 'Person Name #4', 'banana-addons-for-elementor' ),
						'banae_avatar_image' => '',
					],
					[
						'banae_avatar_group_name' => esc_html__( 'Person Name #5', 'banana-addons-for-elementor' ),
						'banae_avatar_image' => '',
					],
				],
				'title_field' => '{{{ banae_avatar_group_name }}}',
			]
		);

		$widget->end_controls_section();

		// Container Style Tab
		$widget->start_controls_section(
			'banae_avatar_group_position_style_section',
			[
				'label' => esc_html__( 'Container', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'banae_avatar_group_position',
			[
				'label' => esc_html__( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .banae-avatar-group' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_section();

		// Content Style Tab
		$widget->start_controls_section(
			'banae_avatar_group_style_section',
			[
				'label' => esc_html__( 'Image', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'banae-avatar-img-gap',
			[
				'label' => esc_html__( 'Image Gaps', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => -100,
						'max' => 100,
						'step' => .5,
					],
					'rem' => [
						'min' => -100,
						'max' => 100,
						'step' => .5,
					],
				],
				'default' => [
					'unit' => 'rem',
					'size' => -1.5,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-avatar-group .banae-avatar:not(:first-child)' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .banae-avatar-group .banae-avatar img',
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .banae-avatar-group .banae-avatar img',
			]
		);

		$widget->end_controls_section();

		// Tooltips Style Tab
		$widget->start_controls_section(
			'banae_avatar_tooltips_style_section',
			[
				'label' => esc_html__( 'Tooltips', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'banae_avatar_show_tooltips' => 'yes',
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'banae_avatar_group_name_typography',
				'selector' => '{{WRAPPER}} .banae-avatar-group .banae-avatar-name',
			]
		);

		$widget->add_control(
			'banae_avatar_tooltips_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-avatar-group .banae-avatar-name' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .banae-avatar-group .banae-avatar-name::before' => 'border-color: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'banae_avatar_tooltips_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-avatar-group .banae-avatar-name' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->end_controls_section();
	}
}