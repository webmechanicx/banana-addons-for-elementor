<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Banana_Addons\Elementor\Helper;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

class Banae_Simple_Heading extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_simple_heading';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Simple Heading';
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-t-letter';
	}

	/**
	 * Get widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'banana-addons-category' ];
	}

	/**
	 * Get widget keywords for search
	 * 
	 * @return string[]
	 */
	public function get_keywords() {
		return [ 'heading', 'title', 'hero', 'gradient', 'animated' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'banae-simple-heading-style' ];
	}

	/**
	 * Register widget controls.
	 * 
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Content
		$this->start_controls_section(
			'_title_section_content', [
				'label' => 'Content',
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control( 'title', [
			'label' => __( 'Title', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::TEXT,
			'default' => 'Hello Elementor',
			'placeholder' => 'Type your title',
			'label_block' => true,
		] );

		$this->add_control( 'sub_title', [
			'label' => __( 'Sub Title', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::TEXT,
			'placeholder' => 'Type your sub title',
			'default' => '',
			'label_block' => true,
		] );

		$this->add_control( 'html_tag', [
			'label' => __( 'HTML Tag', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::SELECT,
			'options' => [ 'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'h5' => 'H5', 'div' => 'div' ],
			'default' => 'h2'
		] );

		$this->add_control( 'link', [
			'label' => __( 'Link', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::URL,
			'placeholder' => 'https://sample-link.com'
		] );

		$this->add_control( 'alignment', [
			'label' => __( 'Alignment', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left' => [ 'title' => 'Left', 'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => 'Center', 'icon' => 'eicon-text-align-center' ],
				'right' => [ 'title' => 'Right', 'icon' => 'eicon-text-align-right' ]
			],
			'default' => 'left',
			'toggle' => true,
			'selectors' => [ '{{WRAPPER}} .banae-simple-heading-wrap' => 'text-align: {{VALUE}};' ],
			'frontend_available' => true,
			'render_type' => 'template'
		] );

		$this->add_control( 'style_variant', [
			'label' => __( 'Style Variant', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::SELECT,
			'options' => [
				'normal' => 'Normal',
				'line-style-1' => 'Line Style 1',
				'line-style-2' => 'Line Style 2',
				'line-style-3' => 'Line Style 3',
				'line-style-4' => 'Line Style 4',
				'line-style-5' => 'Line Style 5'
			],
			'default' => 'normal'
		] );


		$this->add_control(
			'line_thickness',
			[
				'label' => esc_html__( 'Line Thickness', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 100,
				'step' => 1,
				'default' => 4,
				'condition' => [
					'style_variant' => [ 'line-style-1', 'line-style-2', 'line-style-3', 'line-style-4', 'line-style-5' ]
				],
				'selectors' => [
					'{{WRAPPER}}' => '--line-thickness: {{VALUE}}px;',
				],
			]
		);

		$this->end_controls_section();

		// Extra Style controls
		$this->start_controls_section( '_extra_section_style', [
			'label' => 'Extra Style',
			'tab' => Controls_Manager::TAB_STYLE
		] );

		$this->add_control(
			'blend_mode',
			[
				'label' => __( 'Blend Mode', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'banana-addons-for-elementor' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'difference' => 'Difference',
					'exclusion' => 'Exclusion',
					'hue' => 'Hue',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .banae-simple-heading' => 'mix-blend-mode: {{VALUE}};',
					'{{WRAPPER}} .banae-simple-sub-heading' => 'mix-blend-mode: {{VALUE}};',
				],
				'separator' => 'none',
				'frontend_available' => true,
				'control_type' => 'content',
			]
		);

		$this->add_control( '_heading_line_color', [
			'label' => 'Line Color',
			'type' => Controls_Manager::COLOR,
			'condition' => [
				'style_variant' => [ 'line-style-3', 'line-style-4' ]
			],
			'selectors' => [ '{{WRAPPER}} .banae-simple-heading-border' => 'background-color: {{VALUE}};' ],
		] );

		$this->end_controls_section();

		// Title Style controls
		$this->start_controls_section( '_title_section_style', [
			'label' => 'Title Style',
			'tab' => Controls_Manager::TAB_STYLE
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name' => 'title_typo',
			'selector' => '{{WRAPPER}} .banae-simple-heading'
		] );

		$this->add_control( 'title_color_variant', [
			'label' => __( 'Color Variant', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::SELECT,
			'options' => [
				'classic' => 'Classic',
				'gradient' => 'Gradient',
			],
			'default' => 'classic'
		] );

		$this->add_control( 'text_color', [
			'label' => 'Classic Color',
			'type' => Controls_Manager::COLOR,
			'condition' => [ 'title_color_variant' => 'classic' ],
			'selectors' => [
				'{{WRAPPER}} .banae-simple-heading' => 'color: {{VALUE}};',
				'{{WRAPPER}} .banae-simple-heading:before' => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .banae-simple-heading:after' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Gradient Color', 'banana-addons-for-elementor' ),
				'types' => [ 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .banae-color-variant-gradient, {{WRAPPER}} .banae-simple-heading:before, {{WRAPPER}} .banae-simple-heading:after',
				'condition' => [ 'title_color_variant' => 'gradient' ],
				'fields_options' => [
					'background' => [
						'label' => 'Gradient Color'
					],
				],
			]
		);

		/*
		$this->add_control( 'underline_color', [
			'label' => 'Underline Color',
			'type' => Controls_Manager::COLOR,
			'condition' => [ 'style_variant' => 'underline' ]
		] );
		 */

		$this->end_controls_section();

		// Sub-title Style controls
		$this->start_controls_section( '_sub_title_section_style', [
			'label' => 'Sub Title Style',
			'tab' => Controls_Manager::TAB_STYLE
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name' => '_sub_title_typo',
			'selector' => '{{WRAPPER}} .banae-simple-sub-heading'
		] );

		$this->add_control( '_sub_color_variant', [
			'label' => __( 'Color Variant', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::SELECT,
			'options' => [
				'classic' => 'Classic',
				'gradient' => 'Gradient',
			],
			'default' => 'classic'
		] );

		$this->add_control( '_sub_text_color', [
			'label' => 'Classic Color',
			'type' => Controls_Manager::COLOR,
			'condition' => [ '_sub_color_variant' => 'classic' ],
			'selectors' => [ '{{WRAPPER}} .banae-simple-sub-heading' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_sub_title_background',
				'label' => esc_html__( 'Gradient Color', 'banana-addons-for-elementor' ),
				'types' => [ 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .banae-simple-sub-heading',
				'condition' => [ '_sub_color_variant' => 'gradient' ],
				'fields_options' => [
					'background' => [
						'label' => 'Gradient Color'
					],
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$title = $settings['title'];
		$sub_title = $settings['sub_title'];
		$tag = $settings['html_tag'];
		$link = $settings['link'];
		$style_variant = $settings['style_variant'];
		$title_color_variant = $settings['title_color_variant'];
		$_sub_color_variant = $settings['_sub_color_variant'];
		$alignment = $settings['alignment'];
		$sub_title_markup = '';
		$line_markup = '';

		// Prepare classes and inline styles
		$wrapper_classes = 'banae-simple-heading-wrap';
		$heading_classes = 'banae-simple-heading banae-simple-heading-' . esc_attr( $style_variant );

		// Link logic
		$open_tag = "<{$tag} class=\"$heading_classes\">";
		$close_tag = "</{$tag}>";

		if ( ! empty( $link['url'] ) ) {

			$a_attrs = ' href="' . esc_url( $link['url'] ) . '"';

			if ( ! empty( $link['is_external'] ) )
				$a_attrs .= ' target="_blank" rel="noopener"';

			$open_tag = "<{$tag} class=\"$heading_classes\"><a $a_attrs>";
			$close_tag = "</a></{$tag}>";
		}

		// Markup variations
		$title_markup = sprintf(
			'%1$s<span class="banae-color-variant-%2$s">%3$s</span>%4$s',
			$open_tag,
			esc_attr( $title_color_variant ),
			esc_html( $title ),
			$close_tag
		);

		// check if sub-title
		if ( $sub_title ) {
			$sub_title_markup = sprintf( '<p class="banae-simple-sub-heading banae-color-variant-%1$s">%2$s</p>', esc_attr( $_sub_color_variant ), esc_html( $sub_title ) );
		}

		// check if alignment
		$line_markup = sprintf( '<span class="banae-simple-heading-border line-style-%1$s"></span>', esc_attr( $alignment ) );

		//render partials
		Helper::get_banae_template_part( 'widgets/simple-heading/partials/' . $style_variant, [
			'wrapper_classes' => $wrapper_classes,
			'title' => $title_markup,
			'sub_title' => $sub_title_markup,
			'line_divider' => $line_markup,
		] );
	}

}