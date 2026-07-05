<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Banana_Addons\Elementor\Helper;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

class Banae_Image_Masking_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		// Shape Source Section
		$widget->start_controls_section(
			'banae_image_content_section',
			[
				'label' => esc_html__( 'Image Source', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'banae_image_source',
			[
				'label' => esc_html__( 'Choose Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'exclude' => [ 'custom' ],
				'separator' => 'none',
			]
		);

		$widget->end_controls_section();

		// Masking Shape Source Section
		$widget->start_controls_section(
			'banae_masking_content_section',
			[
				'label' => esc_html__( 'Shape Mask', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'banae_shape_masking',
			[
				'label' => esc_html__( 'Choose Masking', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::VISUAL_CHOICE,
				'label_block' => true,
				'options' => Helper::banae_masking_shape_list(),
				'default' => 'shape-1',
				'columns' => 4,
				'selectors' => [
					'{{WRAPPER}} .banae-image-masking__image-thumb img' => 'border-radius: 0px;-webkit-mask-image: url(' . BANANA_ADDONS_ASSETS . 'img/masking/' . '{{VALUE}}.svg); mask-image: url(' . BANANA_ADDONS_ASSETS . 'img/masking/' . '{{VALUE}}.svg);'
				],
			]
		);

		$widget->end_controls_section();

		// Masking Shape Style Section
		$widget->start_controls_section(
			'banae_image_masking_style_section',
			[
				'label' => esc_html__( 'Style', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'banae_mask_shape_position',
			[
				'label' => __( 'Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'label_block' => true,
				'options' => [
					'top' => __( 'Top', 'banana-addons-for-elementor' ),
					'center' => __( 'Center', 'banana-addons-for-elementor' ),
					'left' => __( 'Left', 'banana-addons-for-elementor' ),
					'right' => __( 'Right', 'banana-addons-for-elementor' ),
					'bottom' => __( 'Bottom', 'banana-addons-for-elementor' ),
					'custom' => __( 'Custom', 'banana-addons-for-elementor' )
				],
				'selectors' => [
					'{{WRAPPER}} .banae-image-masking__image-thumb img' => '-webkit-mask-position: {{VALUE}};mask-position: {{VALUE}};'
				],
			]
		);

		$widget->add_control(
			'banae_mask_shape_position_x_offset',
			[
				'label' => __( 'Offset X', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500
					],
					'%' => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .banae-image-masking__image-thumb img' => '-webkit-mask-position-y: {{SIZE}}{{UNIT}};mask-position-y: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'banae_mask_shape_position' => 'custom',
				]
			]
		);

		$widget->add_control(
			'banae_mask_shape_position_y_offset',
			[
				'label' => __( 'Y Offset', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500
					],
					'%' => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .banae-image-masking__image-thumb img' => '-webkit-mask-position-x: {{SIZE}}{{UNIT}};mask-position-x: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'banae_mask_shape_position' => 'custom'
				]
			]
		);

		$widget->add_control(
			'banae_mask_shape_size',
			[
				'label' => __( 'Size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'auto' => __( 'Auto', 'banana-addons-for-elementor' ),
					'contain' => __( 'Contain', 'banana-addons-for-elementor' ),
					'cover' => __( 'Cover', 'banana-addons-for-elementor' ),
					'custom' => __( 'Custom', 'banana-addons-for-elementor' )
				],
				'selectors' => [
					'{{WRAPPER}} .banae-image-masking__image-thumb img' => '-webkit-mask-size: {{VALUE}};mask-size: {{VALUE}};'
				],
				'default' => 'custom',
			]
		);

		$widget->add_control(
			'banae_mask_shape_custome_size',
			[
				'label' => __( 'Mask Size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 600
					],
					'%' => [
						'min' => 0,
						'max' => 100
					]
				],
				'default' => [
					'size' => 100,
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-image-masking__image-thumb img' => '-webkit-mask-size: {{SIZE}}{{UNIT}};mask-size: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'banae_mask_shape_size' => 'custom'
				]
			]
		);

		$widget->add_control(
			'banae_mask_shape_repeat',
			[
				'label' => __( 'Repeat', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no-repeat',
				'label_block' => true,
				'options' => [
					'no-repeat' => __( 'No repeat', 'banana-addons-for-elementor' ),
					'repeat' => __( 'Repeat', 'banana-addons-for-elementor' )
				],
				'selectors' => [
					'{{WRAPPER}} .banae-image-masking__image-thumb img' => '-webkit-mask-repeat: {{VALUE}};mask-repeat: {{VALUE}};'
				],
			]
		);

		$widget->end_controls_section();

		// Wrapper Link Section
		$widget->start_controls_section(
			'banae_section_image_link',
			[
				'label' => __( 'Wrapper Link', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'banae_image_link',
			[
				'label' => esc_html__( 'Link', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->end_controls_section();
	}
}