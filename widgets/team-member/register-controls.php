<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Banana_Addons\Elementor\Helper;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;

class Banae_Team_Member_Controls {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {
		$widget->start_controls_section(
			'team_member_section_info',
			[
				'label' => __( 'Information', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->start_controls_tabs( 'team_member_tabs_photo' );

		$widget->start_controls_tab(
			'team_member_tab_photo_normal',
			[
				'label' => __( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'image',
			[
				'label' => __( 'Member Photo', 'banana-addons-for-elementor' ),
				'show_label' => false,
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'team_member_tab_photo_hover',
			[
				'label' => __( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'image2',
			[
				'label' => __( 'Photo 2', 'banana-addons-for-elementor' ),
				'show_label' => false,
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'extra_hover_cls',
			[
				'label' => __( 'Extra class added', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'on',
				'prefix_class' => 'banae-team-member-hover-image-',
				'condition' => [
					'image2[url]!' => '',
				],
			]
		);

		$widget->end_controls_tab();
		$widget->end_controls_tabs();

		$widget->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$widget->add_control(
			'apply_image_masking',
			[
				'label' => esc_html__( 'Apply Image Mask', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$widget->add_control(
			'member_image_masking',
			[
				'label' => esc_html__( 'Choose Masking', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::VISUAL_CHOICE,
				'label_block' => true,
				'options' => Helper::banae_masking_shape_list(),
				'default' => 'shape-1',
				'columns' => 4,
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-figure img' => '-webkit-mask-image: url(' . BANANA_ADDONS_ASSETS . 'img/masking/' . '{{VALUE}}.svg); mask-image: url(' . BANANA_ADDONS_ASSETS . 'img/masking/' . '{{VALUE}}.svg);'
				],
				'condition' => [ 'apply_image_masking' => 'yes' ],
			]
		);

		$widget->add_control(
			'member_mask_shape_position',
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
					'{{WRAPPER}} .banae-team-member-figure img' => '-webkit-mask-position: {{VALUE}};mask-position: {{VALUE}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes'
				]
			]
		);

		$widget->add_control(
			'member_mask_shape_position_x_offset',
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
					'{{WRAPPER}} .banae-team-member-figure img' => '-webkit-mask-position-y: {{SIZE}}{{UNIT}};mask-position-y: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes',
					'member_mask_shape_position' => 'custom'
				]
			]
		);

		$widget->add_control(
			'member_mask_shape_position_y_offset',
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
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-figure img' => '-webkit-mask-position-x: {{SIZE}}{{UNIT}};mask-position-x: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes',
					'member_mask_shape_position' => 'custom'
				]
			]
		);

		$widget->add_control(
			'member_mask_shape_size',
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
					'{{WRAPPER}} .banae-team-member-figure img' => '-webkit-mask-size: {{VALUE}};mask-size: {{VALUE}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes'
				]
			]
		);

		$widget->add_control(
			'member_mask_shape_custome_size',
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
					'{{WRAPPER}} .banae-team-member-figure img' => '-webkit-mask-size: {{SIZE}}{{UNIT}};mask-size: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes',
					'member_mask_shape_size' => 'custom'
				]
			]
		);

		$widget->add_control(
			'member_mask_shape_repeat',
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
					'{{WRAPPER}} .banae-team-member-figure img' => '-webkit-mask-repeat: {{VALUE}};mask-repeat: {{VALUE}};'
				],
				'condition' => [
					'apply_image_masking' => 'yes'
				]
			]
		);

		$widget->add_control(
			'title',
			[
				'label' => __( 'Name', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'Member Name',
				'placeholder' => __( 'Enter Member Name', 'banana-addons-for-elementor' ),
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'job_title',
			[
				'label' => __( 'Job Title', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Web Developer', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Enter Job Title', 'banana-addons-for-elementor' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'bio',
			[
				'label' => __( 'Short Bio', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter member bio', 'banana-addons-for-elementor' ),
				'rows' => 5,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'title_tag',
			[
				'label' => __( 'Title HTML Tag', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'h1' => [
						'title' => __( 'H1', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-editor-h1',
					],
					'h2' => [
						'title' => __( 'H2', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-editor-h2',
					],
					'h3' => [
						'title' => __( 'H3', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-editor-h3',
					],
					'h4' => [
						'title' => __( 'H4', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-editor-h4',
					],
					'h5' => [
						'title' => __( 'H5', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-editor-h5',
					],
					'h6' => [
						'title' => __( 'H6', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-editor-h6',
					],
				],
				'default' => 'h2',
				'toggle' => false,
				'separator' => 'before',
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
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_section();

		// Social Links
		$widget->start_controls_section(
			'team_member_section_social',
			[
				'label' => __( 'Social Links', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'show_profiles',
			[
				'label' => __( 'Show Social Links', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
				'style_transfer' => true,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label' => esc_html__( 'Select Icon', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-facebook',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'link', [
				'label' => __( 'Profile Link', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Enter social profile link', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'autocomplete' => false,
				'show_external' => false,
				'dynamic' => [
					'active' => true,
				],
				'default' => [ 'url' => 'https://sample-link.com' ],
			]
		);

		$repeater->add_control(
			'customize',
			[
				'label' => __( 'Want To Customize?', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'style_transfer' => true,
			]
		);

		$repeater->start_controls_tabs(
			'team_member_tab_icon_colors',
			[
				'condition' => [ 'customize' => 'yes' ],
			]
		);
		$repeater->start_controls_tab(
			'team_member_tab_icon_normal',
			[
				'label' => __( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$repeater->add_control(
			'color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-links > {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
				'condition' => [ 'customize' => 'yes' ],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-links > {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 'customize' => 'yes' ],
				'style_transfer' => true,
			]
		);

		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'links_border',
				'selector' => '{{WRAPPER}} .banae-team-member-links > {{CURRENT_ITEM}}',
				'condition' => [ 'customize' => 'yes' ],
			]
		);

		$repeater->add_control(
			'links_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-links > {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'customize' => 'yes' ],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'team_member_tab_icon_hover',
			[
				'label' => __( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$repeater->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .banae-team-member-links > {{CURRENT_ITEM}}:focus' => 'color: {{VALUE}}',
				],
				'condition' => [ 'customize' => 'yes' ],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'hover_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .banae-team-member-links > {{CURRENT_ITEM}}:focus' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 'customize' => 'yes' ],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'hover_border_color',
			[
				'label' => __( 'Border Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .banae-team-member-links > {{CURRENT_ITEM}}:focus' => 'border-color: {{VALUE}}',
				],
				'condition' => [ 'customize' => 'yes' ],
				'style_transfer' => true,
			]
		);

		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$widget->add_control(
			'profiles',
			[
				'show_label' => false,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				//'title_field' => '<# print(link.url.match(/(?:https?:\/\/)?(?:www\.)?([^\/@]+)(?:[\/@]|$)/i)?.[1]) #>',
				'title_field' => '{{{ link.url.match(/(?:https?:\/\/)?(?:www\.)?([^\/@]+)(?:[\/@]|$)/i)?.[1] }}}',
				'default' => [
					[
						'link' => [ 'url' => 'https://facebook.com/' ],
						'social_icon' => 'facebook',
					],
					[
						'link' => [ 'url' => 'https://twitter.com/' ],
						'social_icon' => 'twitter',
					],
					[
						'link' => [ 'url' => 'https://linkedin.com/' ],
						'social_icon' => 'linkedin',
					],
				],
			]
		);

		$widget->end_controls_section();

		// Details
		$widget->start_controls_section(
			'team_member_section_button',
			[
				'label' => __( 'Details Button', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'show_details_button',
			[
				'label' => __( 'Show Button', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => '',
				'style_transfer' => true,
			]
		);

		$widget->add_control(
			'button_position',
			[
				'label' => __( 'Position', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after',
				'style_transfer' => true,
				'options' => [
					'before' => __( 'Before Social Links', 'banana-addons-for-elementor' ),
					'after' => __( 'After Social Links', 'banana-addons-for-elementor' ),
				],
				'condition' => [
					'show_details_button' => 'yes',
				],
			]
		);

		$widget->add_control(
			'button_text',
			[
				'label' => __( 'Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Show Details', 'banana-addons-for-elementor' ),
				'placeholder' => __( 'Type button text here', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'show_details_button' => 'yes',
				],
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
				],
				'condition' => [
					'show_details_button' => 'yes',
				],
			]
		);

		$widget->end_controls_section();

		// Style Tabs
		$widget->start_controls_section(
			'team_member_section_style_image',
			[
				'label' => __( 'Member Photo', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'image_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-figure img' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .banae-team-member-figure img',
			]
		);

		$widget->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .banae-team-member-figure img',
			]
		);

		$widget->start_controls_tabs(
			'_tabs_img_effects', [
				'condition' => [
					'image2[url]' => '',
				],
			]
		);

		$widget->start_controls_tab(
			'team_member_tab_img_effects_normal',
			[
				'label' => __( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'img_opacity',
			[
				'label' => __( 'Opacity', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-figure img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'img_css_filters',
				'selector' => '{{WRAPPER}} .banae-team-member-figure img',
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'team_member_tab_img_effects_hover',
			[
				'label' => __( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'img_hover_opacity',
			[
				'label' => __( 'Opacity', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-figure:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'img_hover_css_filters',
				'selector' => '{{WRAPPER}} .banae-team-member-figure:hover img',
			]
		);

		$widget->add_control(
			'img_hover_transition',
			[
				'label' => __( 'Transition Duration', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => .2,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-figure img' => 'transition-duration: {{SIZE}}s;',
				],
			]
		);

		$widget->end_controls_tab();
		$widget->end_controls_tabs();

		$widget->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'%' => [
						'min' => 20,
						'max' => 100,
					],
					'px' => [
						'min' => 100,
						'max' => 700,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-figure' => 'width: {{SIZE}}{{UNIT}};',
				],
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
						'min' => 100,
						'max' => 700,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-figure' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'image_spacing',
			[
				'label' => __( 'Bottom Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$widget->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// content style
		$widget->start_controls_section(
			'team_member_section_style_content',
			[
				'label' => __( 'Name, Job Title & Bio', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'hr_heading_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Name', 'banana-addons-for-elementor' ),
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-name' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .banae-team-member-name',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .banae-team-member-name',
			]
		);

		$widget->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'hr_heading_job_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Job Title', 'banana-addons-for-elementor' ),
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'job_title_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-position' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_title_typography',
				'selector' => '{{WRAPPER}} .banae-team-member-position',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'job_title_text_shadow',
				'selector' => '{{WRAPPER}} .banae-team-member-position',
			]
		);

		$widget->add_responsive_control(
			'job_title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'hr_heading_bio',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Short Bio', 'banana-addons-for-elementor' ),
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'bio_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-bio' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'bio_typography',
				'selector' => '{{WRAPPER}} .banae-team-member-bio',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'bio_text_shadow',
				'selector' => '{{WRAPPER}} .banae-team-member-bio',
			]
		);

		$widget->add_responsive_control(
			'bio_spacing',
			[
				'label' => __( 'Bottom Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-bio' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Social Style
		$widget->start_controls_section(
			'team_member_section_style_social',
			[
				'label' => __( 'Social Links', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'links_icon_size',
			[
				'label' => __( 'Icon Size', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-links > a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'links_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-links > a' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'links_spacing',
			[
				'label' => __( 'Right Spacing', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .banae-team-member-links > a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Button Style
		$widget->start_controls_section(
			'team_member_section_style_button',
			[
				'label' => __( 'Details Button', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_responsive_control(
			'button_margin',
			[
				'label' => __( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-tm-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-tm-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .banae-tm-btn',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .banae-tm-btn',
			]
		);

		$widget->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-tm-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .banae-tm-btn',
			]
		);

		$widget->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$widget->start_controls_tabs( '_tabs_button' );
		$widget->start_controls_tab(
			'_tab_button_normal',
			[
				'label' => __( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'button_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .banae-tm-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'button_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-tm-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'_tab_button_hover',
			[
				'label' => __( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$widget->add_control(
			'button_hover_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-tm-btn:hover, {{WRAPPER}} .banae-tm-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'button_hover_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-tm-btn:hover, {{WRAPPER}} .banae-tm-btn:focus' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .banae-tm-btn:hover, {{WRAPPER}} .banae-tm-btn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$widget->end_controls_tab();
		$widget->end_controls_tabs();

		$widget->end_controls_section();

	}

}