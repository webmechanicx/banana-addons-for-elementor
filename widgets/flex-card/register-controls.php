<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Banana_Addons\Elementor\Helper;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;

class Banae_Flex_Card_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		// Card Content Tab
		$widget->start_controls_section(
			'banae_card_image',
			[
				'label' => esc_html__( 'Feature Image', 'banana-addons-for-elementor' )
			]
		);

		$widget->add_control(
			'card_image',
			[
				'label' => __( 'Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
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
				'condition' => [
					'card_image[url]!' => ''
				]
			]
		);

		$widget->add_responsive_control(
			'image_position',
			[
				'label' => __( 'Image Position', 'banana-addons-for-elementor' ),
				'description' => __( 'You can adjust the image width and height from <mark>Style</mark> tab to get your expected design.', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
				'desktop_default' => 'top',
				'tablet_default' => 'top',
				'mobile_default' => 'top',
				'prefix_class' => 'banae-flex-card-media-dir%s-',
				'style_transfer' => true,
				'selectors' => [
					'{{WRAPPER}} .banae-flex-card-wrapper' => '{{VALUE}};',
				],
				'selectors_dictionary' => [
					'left' => '-webkit-box-orient: horizontal; -webkit-box-direction: normal; -ms-flex-direction: row; flex-direction: row;',
					'top' => '-webkit-box-orient: vertical; -webkit-box-direction: normal; -ms-flex-direction: column; flex-direction: column;',
					'right' => '-webkit-box-orient: horizontal; -webkit-box-direction: reverse; -ms-flex-direction: row-reverse; flex-direction: row-reverse;'
				]
			]
		);

		$widget->add_control(
			'card_apply_image_mask',
			[
				'label' => __( 'Apply Image Mask', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$widget->add_control(
			'card_mask_shape_mask_shape',
			[
				'label' => __( 'Mask Shape', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::VISUAL_CHOICE,
				'options' => Helper::banae_masking_shape_list(),
				'default' => 'shape-1',
				//'toggle' => false,
				'label_block' => true,
				'columns' => 4,
				'selectors' => [
					'{{WRAPPER}} .banae-card-thumb img' => '-webkit-mask-image: url(' . BANANA_ADDONS_ASSETS . 'img/masking/' . '{{VALUE}}.svg); mask-image: url(' . BANANA_ADDONS_ASSETS . 'img/masking/' . '{{VALUE}}.svg);'
				],
				'condition' => [
					'card_apply_image_mask' => 'yes'
				]
			]
		);

		$widget->add_control(
			'card_mask_shape_position',
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
					'{{WRAPPER}} .banae-card-thumb img' => '-webkit-mask-position: {{VALUE}};mask-position: {{VALUE}};'
				],
				'condition' => [
					'card_apply_image_mask' => 'yes'
				]
			]
		);

		$widget->add_control(
			'card_mask_shape_position_x_offset',
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
					'{{WRAPPER}} .banae-card-thumb img' => '-webkit-mask-position-y: {{SIZE}}{{UNIT}};mask-position-y: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'card_apply_image_mask' => 'yes',
					'card_mask_shape_position' => 'custom'
				]
			]
		);

		$widget->add_control(
			'card_mask_shape_position_y_offset',
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
					'{{WRAPPER}} .banae-card-thumb img' => '-webkit-mask-position-x: {{SIZE}}{{UNIT}};mask-position-x: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'card_apply_image_mask' => 'yes',
					'card_mask_shape_position' => 'custom'
				]
			]
		);

		$widget->add_control(
			'card_mask_shape_size',
			[
				'label' => __( 'Size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'auto',
				'label_block' => true,
				'options' => [
					'auto' => __( 'Auto', 'banana-addons-for-elementor' ),
					'contain' => __( 'Contain', 'banana-addons-for-elementor' ),
					'cover' => __( 'Cover', 'banana-addons-for-elementor' ),
					'custom' => __( 'Custom', 'banana-addons-for-elementor' )
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-thumb img' => '-webkit-mask-size: {{VALUE}};mask-size: {{VALUE}};'
				],
				'condition' => [
					'card_apply_image_mask' => 'yes'
				]
			]
		);

		$widget->add_control(
			'card_mask_shape_custome_size',
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
				'selectors' => [
					'{{WRAPPER}} .banae-card-thumb img' => '-webkit-mask-size: {{SIZE}}{{UNIT}};mask-size: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'card_apply_image_mask' => 'yes',
					'card_mask_shape_size' => 'custom'
				]
			]
		);

		$widget->add_control(
			'card_mask_shape_repeat',
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
					'{{WRAPPER}} .banae-card-thumb img' => '-webkit-mask-repeat: {{VALUE}};mask-repeat: {{VALUE}};'
				],
				'condition' => [
					'card_apply_image_mask' => 'yes'
				]
			]
		);

		$widget->end_controls_section();

		// Card Badge Section
		$widget->start_controls_section(
			'banae_card_badge',
			[
				'label' => esc_html__( 'Badge', 'banana-addons-for-elementor' )
			]
		);

		$widget->add_control(
			'card_badge_switcher',
			[
				'label' => __( 'Enable Badge', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'card_badge',
			[
				'label' => esc_html__( 'Badge Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default' => esc_html__( 'Card Badge', 'banana-addons-for-elementor' ),
				'condition' => [
					'card_badge_switcher' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->end_controls_section();

		// Card Content Section
		$widget->start_controls_section(
			'banae_card_content',
			[
				'label' => esc_html__( 'Content', 'banana-addons-for-elementor' )
			]
		);

		$widget->add_control(
			'card_title',
			[
				'label' => esc_html__( 'Title', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default' => esc_html__( 'Card Title', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_control(
			'card_title_html_tag',
			[
				'label' => __( 'Title HTML Tag', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'after',
				'options' => Helper::banae_title_tags(),
				'default' => 'h3',
			]
		);

		$widget->add_control(
			'card_title_link',
			[
				'label' => __( 'Title URL', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://sample-link.com', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true
				]
			]
		);

		$widget->add_control(
			'card_sub_heading',
			[
				'label' => esc_html__( 'Sub Heading', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Sub Heading', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_control(
			'card_description',
			[
				'label' => esc_html__( 'Description', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Basic description', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->end_controls_section();

		// Card Action Button Section
		$widget->start_controls_section(
			'card_button_button_section',
			[
				'label' => esc_html__( 'Button', 'banana-addons-for-elementor' )
			]
		);

		$widget->add_control(
			'card_button_text',
			[
				'label' => esc_html__( 'Caption', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Read More', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_control(
			'card_button_link',
			[
				'label' => __( 'URL', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://sample-link.com', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'default' => [
					'url' => '#',
					'is_external' => true
				]
			]
		);

		$widget->add_control(
			'card_button_link_icon',
			[
				'label' => __( 'Icon', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'card_button_text!' => ''
				]
			]
		);

		$widget->add_control(
			'card_button_link_icon_position',
			[
				'label' => __( 'Icon Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'icon_pos_left' => [
						'title' => __( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left'
					],
					'icon_pos_right' => [
						'title' => __( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right'
					]
				],
				'default' => 'icon_pos_right',
				'toggle' => false,
				'condition' => [
					'card_button_link_icon[value]!' => '',
					'card_button_text!' => ''
				]
			]
		);

		$widget->end_controls_section();


		// Card Layout Section
		$widget->start_controls_section(
			'card_layout',
			[
				'label' => esc_html__( 'Layout', 'banana-addons-for-elementor' )
			]
		);

		$widget->add_control(
			'card_layout_type',
			[
				'label' => __( 'Layout', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'banana-addons-for-elementor' ),
					'text_overlay' => __( 'Text Overlay', 'banana-addons-for-elementor' )
				]
			]
		);

		$widget->end_controls_section();

		// Card Image Styling Section

		$widget->start_controls_section(
			'banae_section_card_styles_image',
			[
				'label' => esc_html__( 'Feature Image', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'card_image[url]!' => ''
				]
			]
		);

		$widget->add_responsive_control(
			'banae_section_card_image_width',
			[
				'label' => __( 'Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500
					]
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-thumb img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .banae-flex-card-wrapper' => '--banae-flex-card-image-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'card_layout_type' => 'default'
				]
			]
		);

		$widget->add_responsive_control(
			'banae_section_card_image_height',
			[
				'label' => __( 'Height', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500
					]
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-thumb img' => 'height: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'card_layout_type' => 'default'
				]
			]
		);

		$widget->add_responsive_control(
			'card_image_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-thumb img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'card_layout_type' => 'default'
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_image_border',
				'selector' => '{{WRAPPER}} .banae-card-thumb img',
				'condition' => [
					'card_layout_type' => 'default'
				]
			]
		);

		$widget->add_responsive_control(
			'card_image_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'card_layout_type' => 'default'
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_image_box_shadow',
				'selector' => '{{WRAPPER}} .banae-card-thumb img',
				'condition' => [
					'card_layout_type' => 'default'
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'card_image_filter',
				'selector' => '{{WRAPPER}} .banae-card-thumb img',
			]
		);

		$widget->add_control(
			'card_image_animation_heading',
			[
				'label' => __( 'Animation', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$widget->add_control(
			'card_image_zoom_animation',
			[
				'label' => __( 'Zoom Animation', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'ON', 'banana-addons-for-elementor' ),
				'label_off' => __( 'OFF', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes'
			]
		);

		$widget->end_controls_section();


		// Card Badge Style Section
		$widget->start_controls_section(
			'banae_card_badge_style_section',
			[
				'label' => esc_html__( 'Badge', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$badge_align = is_rtl() ? 'right' : 'left';

		$widget->add_responsive_control(
			'banae_card_badge_offset_left',
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
				'default' => [
					'unit' => '%',
					'size' => 10
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-badge' => $badge_align . ': {{SIZE}}{{UNIT}};'
				]
			]
		);

		$widget->add_responsive_control(
			'banae_card_badge_offset_top',
			[
				'label' => __( 'Offset Y', 'banana-addons-for-elementor' ),
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
				'default' => [
					'unit' => '%',
					'size' => 5
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-badge' => 'top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$widget->add_control(
			'banae_card_badge_background',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .banae-card-badge' => 'background: {{VALUE}};'
				]
			]
		);

		$widget->add_control(
			'banae_card_badge_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .banae-card-badge' => 'color: {{VALUE}};'
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'banae_card_badge_typography',
				'selector' => '{{WRAPPER}} .banae-card-badge'
			]
		);

		$widget->add_responsive_control(
			'card_badge_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '6',
					'right' => '10',
					'bottom' => '6',
					'left' => '10',
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_badge_border',
				'selector' => '{{WRAPPER}} .banae-card-badge'
			]
		);

		$widget->add_responsive_control(
			'card_badge_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '8',
					'right' => '8',
					'bottom' => '8',
					'left' => '8',
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_badge_box_shadow',
				'selector' => '{{WRAPPER}} .banae-card-badge'
			]
		);

		$widget->end_controls_section();


		// Card content Styling Section
		$widget->start_controls_section(
			'banae_section_card_styles_content',
			[
				'label' => esc_html__( 'Content', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$text_align = is_rtl() ? 'right' : 'left';

		$widget->add_control(
			'card_content_alignment',
			[
				'label' => __( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left'
					],
					'center' => [
						'title' => __( 'center', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center'
					],
					'right' => [
						'title' => __( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right'
					]
				],
				'default' => $text_align,
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .banae-flex-card-wrapper .banae-card-body' => 'text-align: {{VALUE}};',
				],
			]
		);

		$widget->add_responsive_control(
			'card_content_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '30',
					'right' => '30',
					'bottom' => '30',
					'left' => '30',
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_content_border',
				'selector' => '{{WRAPPER}} .banae-card-body'
			]
		);

		$widget->add_responsive_control(
			'card_content_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$widget->end_controls_section();


		// Card Content Styling Section
		$widget->start_controls_section(
			'banae_card_title_styles_section',
			[
				'label' => esc_html__( 'Title', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'card_title!' => ''
				]
			]
		);

		$widget->add_control(
			'banae_title_color',
			[
				'label' => __( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-title' => 'color: {{VALUE}};'
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'card_title_typography',
				'selector' => '{{WRAPPER}} .banae-card-body .banae-card-title'
			]
		);

		$widget->add_responsive_control(
			'card_title_margin',
			[
				'label' => __( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '15',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$widget->end_controls_section();

		// Card Sub Heading Style
		$widget->start_controls_section(
			'banae_card_sub_heading_styles_section',
			[
				'label' => esc_html__( 'Sub Heading', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'card_sub_heading!' => ''
				]
			]
		);

		$widget->add_control(
			'banae_sub_heading_color',
			[
				'label' => __( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-sub-heading' => 'color: {{VALUE}};'
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'card_sub_heading_typography',
				'selector' => '{{WRAPPER}} .banae-card-body .banae-card-sub-heading'
			]
		);

		$widget->add_responsive_control(
			'card_sub_heading_margin',
			[
				'label' => __( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-sub-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$widget->end_controls_section();

		// description style
		$widget->start_controls_section(
			'banae_card_description_styles_section',
			[
				'label' => esc_html__( 'Description', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'card_description!' => ''
				]
			]
		);
		$widget->add_control(
			'banae_description_color',
			[
				'label' => __( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-description' => 'color: {{VALUE}};'
				]
			]
		);
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'card_description_typography',
				'selector' => '{{WRAPPER}} .banae-card-body .banae-card-description'
			]
		);

		$widget->add_responsive_control(
			'card_description_margin',
			[
				'label' => __( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$widget->end_controls_section();


		// Card Button Style Section
		$widget->start_controls_section(
			'banae_card_button_styles_section',
			[
				'label' => esc_html__( 'Button', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'card_button_text!' => ''
				]
			]
		);

		$widget->add_responsive_control(
			'card_button_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-action .icon_pos_right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .banae-card-body .banae-card-action .icon_pos_left' => 'margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'card_button_typography',
				'selector' => '{{WRAPPER}} .banae-card-body .banae-card-action'
			]
		);

		$widget->add_responsive_control(
			'card_button_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => '10',
					'right' => '30',
					'bottom' => '10',
					'left' => '30',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$widget->add_responsive_control(
			'card_button_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$widget->add_responsive_control(
			'card_button_offset',
			[
				'label' => __( 'Offset', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 0
				],
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-action' => 'margin-top: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'card_layout_type' => 'default'
				]
			]
		);

		$widget->start_controls_tabs( 'card_button_tabs' );

		$widget->start_controls_tab( 'card_button_normal', [ 'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ) ] );

		$widget->add_control(
			'card_button_normal_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-action' => 'color: {{VALUE}};'
				]
			]
		);

		$widget->add_control(
			'card_button_normal_bg',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-action' => 'background-color: {{VALUE}};'
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_button_normal_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid'
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1'
						]
					],
					'color' => [
						'default' => '#222222'
					]
				],
				'selector' => '{{WRAPPER}} .banae-card-body .banae-card-action'
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_button_normal_box_shadow',
				'selector' => '{{WRAPPER}} .banae-card-body .banae-card-action'
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab( 'card_button_hover', [ 'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ) ] );

		$widget->add_control(
			'card_button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-action:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$widget->add_control(
			'card_button_hover_bg',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .banae-card-body .banae-card-action:hover' => 'background-color: {{VALUE}};'
				]
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_button_hover_border',
				'selector' => '{{WRAPPER}} .banae-card-body .banae-card-action:hover'
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .banae-card-body .banae-card-action:hover'
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();

		$widget->end_controls_section();

	}
}