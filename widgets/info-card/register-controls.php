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

class Banae_Info_Card_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		$widget->start_controls_section(
			'infocard_section_media',
			[
				'label' => __( 'Icon & Image', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'media_type',
			[
				'label' => __( 'Media Type', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'icon' => [
						'title' => __( 'Icon', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-star',
					],
					'image' => [
						'title' => __( 'Image', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-image',
					]
				],
				'default' => 'image',
				'toggle' => false,
				'style_transfer' => true,
			]
		);

		$widget->add_control(
			'image',
			[
				'label' => __( 'Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'media_type' => 'image'
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
				'default' => 'medium_large',
				'separator' => 'none',
				'exclude' => [
					'full',
					'custom',
					'large',
					'shop_catalog',
					'shop_single',
					'shop_thumbnail'
				],
				'condition' => [
					'media_type' => 'image'
				]
			]
		);

		$widget->add_control(
			'selected_icon',
			[
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'label_block' => true,
				'default' => [
					'value' => 'fas fa-image',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
				'condition' => [
					'media_type' => 'icon'
				]
			]
		);

		$widget->add_responsive_control(
			'media_direction',
			[
				'label' => __( 'Media direction', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
				],
				'default' => 'top',
				'toggle' => false,
				'style_transfer' => true,
				'prefix_class' => 'banae-info-card-media-dir%s-',
			]
		);

		$widget->add_responsive_control(
			'media_v_align',
			[
				'label' => __( 'Vertical Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __( 'Center', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
				'condition' => [
					'media_direction' => 'left',
				],
				'style_transfer' => true,
				'selectors_dictionary' => [
					'top' => ' -webkit-align-self: flex-start; -ms-flex-item-align: flex-start; align-self: flex-start;',
					'center' => ' -webkit-align-self: center; -ms-flex-item-align: center; align-self: center;',
					'bottom' => ' -webkit-align-self: flex-end; -ms-flex-item-align: end; align-self: flex-end;',
				],
				'selectors' => [
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}}.banae-info-card-media-dir-widescreen-left .banae-info-card-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}}.banae-info-card-media-dir-left .banae-info-card-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}}.banae-info-card-media-dir-laptop-left .banae-info-card-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}}.banae-info-card-media-dir-tablet_extra-left .banae-info-card-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}}.banae-info-card-media-dir-tablet-left .banae-info-card-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}}.banae-info-card-media-dir-mobile_extra-left .banae-info-card-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}}.banae-info-card-media-dir-mobile-left .banae-info-card-figure' => '{{VALUE}};',

					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}}.banae-info-card-media-dir-left .banae-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}}.banae-info-card-media-dir-left .banae-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}}.banae-info-card-media-dir-laptop-left .banae-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}}.banae-info-card-media-dir-tablet_extra-left .banae-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}}.banae-info-card-media-dir-tablet-left .banae-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}}.banae-info-card-media-dir-mobile_extra-left .banae-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}}.banae-info-card-media-dir-mobile-left .banae-info-box-icon' => '{{VALUE}};',
				]
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'infocard_section_title',
			[
				'label' => __( 'Title & Description', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'title',
			[
				'label' => __( 'Title', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Card Title', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Enter Card Title', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_control(
			'description',
			[
				'label' => __( 'Description', 'banana-addons-for-elementor' ),
				//'description' => banae_get_allowed_html_desc( 'intermediate' ),
				'description' => 'intermediate',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Description goes here', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Enter description', 'banana-addons-for-elementor' ),
				'rows' => 5,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_control(
			'title_tag',
			[
				'label' => __( 'HTML Tag', 'banana-addons-for-elementor' ),
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
					'justify' => [
						'title' => __( 'Justify', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'condition' => [
					'media_direction' => 'top',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);

		$widget->end_controls_section();


		$widget->start_controls_section(
			'infocard_section_button',
			[
				'label' => __( 'Button', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'button_text',
			[
				'label' => __( 'Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Button Text', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Type button text here', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$widget->add_control(
			'button_link',
			[
				'label' => __( 'Link', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '#',
				]
			]
		);


		$widget->add_control(
			'button_selected_icon',
			[
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'button_icon',
				'label_block' => true,
			]
		);

		$widget->add_control(
			'button_icon_position',
			[
				'label' => __( 'Icon Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'before' => [
						'title' => __( 'Before', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => __( 'After', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'after',
				'toggle' => false,
				'condition' => [ 'button_selected_icon[value]!' => '' ],
				'style_transfer' => true,
			]
		);

		$widget->add_control(
			'button_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10
				],
				'condition' => [ 'button_selected_icon[value]!' => '' ],
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-btn-icon-before .banae-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .banae-info-card-btn-icon-after .banae-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Media style controls
		$widget->start_controls_section(
			'infocard_section_media_style',
			[
				'label' => __( 'Icon & Image', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-figure--icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'media_type' => 'icon'
				]
			]
		);

		$widget->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-figure--icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'media_type' => 'icon'
				]
			]
		);

		$widget->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-figure--icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'media_type' => 'icon'
				]
			]
		);

		$widget->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 400,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-figure--image' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'media_type' => 'image'
				]
			]
		);

		$widget->add_responsive_control(
			'image_height',
			[
				'label' => __( 'Height', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 400,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-figure--image' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'media_type' => 'image'
				]
			]
		);

		$widget->add_control(
			'offset_toggle',
			[
				'label' => __( 'Offset', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'banana-addons-for-elementor' ),
				'label_on' => __( 'Custom', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
			]
		);

		$widget->start_popover();

		$widget->add_responsive_control(
			'media_offset_x',
			[
				'label' => __( 'Offset Left', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'condition' => [
					'offset_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--banae-info-card-media-offset-x: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$widget->add_responsive_control(
			'media_offset_y',
			[
				'label' => __( 'Offset Top', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'condition' => [
					'offset_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--banae-info-card-media-offset-y: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$widget->end_popover();

		$widget->add_responsive_control(
			'media_spacing',
			[
				'label' => __( 'Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}}.banae-info-card-media-dir-widescreen-top .banae-info-card-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}}.banae-info-card-media-dir-top .banae-info-card-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}}.banae-info-card-media-dir-laptop-top .banae-info-card-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}}.banae-info-card-media-dir-tablet_extra-top .banae-info-card-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}}.banae-info-card-media-dir-tablet-top .banae-info-card-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}}.banae-info-card-media-dir-mobile_extra-top .banae-info-card-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}}.banae-info-card-media-dir-mobile-top .banae-info-card-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}}.banae-info-card-media-dir-widescreen-left .banae-info-card-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}}.banae-info-card-media-dir-left .banae-info-card-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}}.banae-info-card-media-dir-laptop-left .banae-info-card-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}}.banae-info-card-media-dir-tablet_extra-left .banae-info-card-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}}.banae-info-card-media-dir-tablet-left .banae-info-card-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}}.banae-info-card-media-dir-mobile_extra-left .banae-info-card-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}}.banae-info-card-media-dir-mobile-left .banae-info-card-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$widget->add_responsive_control(
			'media_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-figure--image img, {{WRAPPER}} .banae-info-card-figure--icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'icon_margin',
			[
				'label' => __( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-figure' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'media_border',
				'selector' => '{{WRAPPER}} .banae-info-card-figure--image img, {{WRAPPER}} .banae-info-card-figure--icon',
			]
		);

		$widget->add_responsive_control(
			'media_border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-figure--image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .banae-info-card-figure--icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'media_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .banae-info-card-figure--image img, {{WRAPPER}} .banae-info-card-figure--icon'
			]
		);

		$widget->add_control(
			'icon_bg_rotate',
			[
				'label' => __( 'Icon Rotate', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--banae-info-card-media-rotate: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'media_type' => 'icon'
				]
			]
		);

		$widget->end_controls_section();


		// widget title style controls
		$widget->start_controls_section(
			'infocard_section_title_style',
			[
				'label' => __( 'Title & Description', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Box Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'title_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Title', 'banana-addons-for-elementor' ),
				'separator' => 'before'
			]
		);

		$widget->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-title' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-info-card-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$widget->add_control(
			'description_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Description', 'banana-addons-for-elementor' ),
				'separator' => 'before'
			]
		);

		$widget->add_responsive_control(
			'description_spacing',
			[
				'label' => __( 'Bottom Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'description_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-info-card-text' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Typography', 'banana-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .banae-info-card-text',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$widget->end_controls_section();

		// Button Style tab
		$widget->start_controls_section(
			'infocard_section_style_button',
			[
				'label' => __( 'Button', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .banae-infocard-btn',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
			]
		);

		$widget->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 8,
					'right' => 8,
					'bottom' => 8,
					'left' => 8,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-infocard-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .banae-infocard-btn',
			]
		);

		$widget->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-infocard-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		//Button Inner Style Tabs
		$widget->start_controls_tabs(
			'button_style_tabs'
		);

		$widget->start_controls_tab(
			'button_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .banae-infocard-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'button_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-infocard-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .banae-infocard-btn',
			]
		);

		$widget->end_controls_tab();

		// Button Hover Tab
		$widget->start_controls_tab(
			'button_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'link_hover_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-infocard-btn:hover, {{WRAPPER}} .banae-infocard-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'button_hover_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-infocard-btn:hover, {{WRAPPER}} .banae-infocard-btn:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-infocard-btn:hover, {{WRAPPER}} .banae-infocard-btn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .banae-infocard-btn:hover, {{WRAPPER}} .banae-infocard-btn:focus',
			]
		);

		$widget->end_controls_tabs();

		$widget->end_controls_section();
	}
}