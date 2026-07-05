<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class Banae_Code_Highlighter {

	/**
	 * The main widget controls registration method
	 * 
	 * @param mixed $widget
	 * 
	 * @return void
	 */
	public static function add_register_controls( $widget ) {

		$widget->start_controls_section(
			'browser_content_section',
			[
				'label' => __( 'Browser Wrapper', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$widget->add_control(
			'show_browser_wrapper',
			[
				'label' => esc_html__( 'Show Browser Wrapper', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$widget->add_control(
			'browser_search_text',
			[
				'label' => __( 'Text on Search bar', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'sample.js',
				'condition' => [
					'show_browser_wrapper' => 'yes',
				],
			]
		);

		$widget->end_controls_section();

		$widget->start_controls_section(
			'content_section',
			[
				'label' => __( 'Code Settings', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// Language Selection
		$widget->add_control(
			'language',
			[
				'label' => __( 'Language', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'default' => 'javascript',
				'options' => [
					'markup' => 'Markup',
					'html' => 'HTML',
					'css' => 'CSS',
					'sass' => 'Sass (Sass)',
					'scss' => 'Sass (Scss)',
					'less' => 'Less',
					'javascript' => 'JavaScript',
					'typescript' => 'TypeScript',
					'jsx' => 'React JSX',
					'tsx' => 'React TSX',
					'php' => 'PHP',
					'ruby' => 'Ruby',
					'json' => 'JSON + Web App Manifest',
					'http' => 'HTTP',
					'xml' => 'XML',
					'svg' => 'SVG',
					'rust' => 'Rust',
					'csharp' => 'C#',
					'dart' => 'Dart',
					'git' => 'Git',
					'java' => 'Java',
					'sql' => 'SQL',
					'go' => 'Go',
					'kotlin' => 'Kotlin + Kotlin Script',
					'julia' => 'Julia',
					'python' => 'Python',
					'swift' => 'Swift',
					'bash' => 'Bash + Shell',
					'scala' => 'Scala',
					'haskell' => 'Haskell',
					'perl' => 'Perl',
					'objectivec' => 'Objective-C',
					'visual-basic,' => 'Visual Basic + VBA',
					'r' => 'R',
					'c' => 'C',
					'cpp' => 'C++',
					'aspnet' => 'ASP.NET (C#)',
				],
			]
		);

		// Theme Selection
		$widget->add_control(
			'theme',
			[
				'label' => __( 'Theme', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Solid', 'banana-addons-for-elementor' ),
					'dark' => __( 'Dark', 'banana-addons-for-elementor' ),
					'okaidia' => __( 'Okaidia', 'banana-addons-for-elementor' ),
					'solarizedlight' => __( 'Solarizedlight', 'banana-addons-for-elementor' ),
					'tomorrow' => __( 'Tomorrow', 'banana-addons-for-elementor' ),
					'twilight' => __( 'Twilight', 'banana-addons-for-elementor' ),
				],
			]
		);

		// Code Content
		$widget->add_control(
			'code_content',
			[
				'label' => __( 'Code', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CODE,
				'language' => 'javascript',
				'default' => 'console.log( \'Code is Poetry\' );',
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::TEXT_CATEGORY,
					],
				],
			]
		);

		// Line Numbers Toggle
		$widget->add_control(
			'line_numbers',
			[
				'label' => __( 'Show Line Numbers', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'banana-addons-for-elementor' ),
			]
		);

		// Highlight Lines
		$widget->add_control(
			'highlight_lines',
			[
				'label' => __( 'Highlight Lines (comma separated)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'e.g. 1,3,5',
			]
		);


		// Line Numbers Toggle
		$widget->add_control(
			'copy_to_clipboard',
			[
				'label' => __( 'Show Clip Board', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'banana-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'banana-addons-for-elementor' ),
			]
		);

		// Word Wrap
		$widget->add_control(
			'word_wrap',
			[
				'label' => __( 'Word Wrap', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'on' => [
						'title' => __( 'On', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-check',
					],
					'off' => [
						'title' => __( 'Off', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-close',
					],
				],
				'default' => 'off',
			]
		);

		// Font Size
		$widget->add_control(
			'font_size',
			[
				'label' => __( 'Font Size (px)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 10, 'max' => 30 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
			]
		);

		// Height
		$widget->add_control(
			'height',
			[
				'label' => __( 'Code Box Height (px)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 100, 'max' => 1000 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
			]
		);

		$widget->end_controls_section();

		// Style Tab - Wrapper
		$widget->start_controls_section(
			'wrapper_style_section',
			[
				'label' => esc_html__( 'Browser Wrapper', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_browser_wrapper' => 'yes',
				]
			]
		);

		$widget->add_control(
			'wrapper_background_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-code-highlighter-container' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wrapper_border',
				'selector' => '{{WRAPPER}} .banae-browser-template__wrapper',
			]
		);

		$widget->add_control(
			'wrapper_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .banae-browser-template__wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .banae-browser-template__wrapper',
			]
		);

		$widget->add_responsive_control(
			'wrapper_margin',
			[
				'label' => __( 'Margin', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .banae-browser-template__wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Browser Bar Style Section 
		$widget->start_controls_section(
			'browser_bar_style_section',
			[
				'label' => esc_html__( 'Browser Bar', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'browser_bar_background',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-browser-template__top-bar' => 'background-color: {{VALUE}}',
				],
			]
		);

		$widget->add_responsive_control(
			'browser_bar_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 7,
					'right' => 10,
					'bottom' => 7,
					'left' => 10,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-browser-template__top-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Browser Search Style Section 
		$widget->start_controls_section(
			'browser_search_style_section',
			[
				'label' => esc_html__( 'Browser Search', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'browser_search_background',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-browser-template__address' => 'background-color: {{VALUE}}',
				],
			]
		);

		$widget->add_control(
			'browser_search_text_color',
			[
				'label' => esc_html__( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-browser-template__address' => 'color: {{VALUE}}',
				],
			]
		);

		$widget->add_responsive_control(
			'browser_search_padding',
			[
				'label' => __( 'Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-browser-template__address' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		// Code Highlighter Style Section 
		$widget->start_controls_section(
			'code_area_style_section',
			[
				'label' => esc_html__( 'Code Area', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'code_area_background_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prismjs-default pre[class*="language-"]' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .prismjs-dark pre[class*="language-"]' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .prismjs-okaidia pre[class*="language-"]' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .prismjs-solarizedlight pre[class*="language-"]' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .prismjs-tomorrow pre[class*="language-"]' => 'background-color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'code_area_border',
				'selector' => '{{WRAPPER}} .banae-code-highlighter-container pre[class*="language-"]',
				'condition' => [
					'show_browser_wrapper!' => 'yes',
				],
			]
		);

		$widget->add_control(
			'code_area_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .prismjs-default pre[class*="language-"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .prismjs-dark pre[class*="language-"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .prismjs-okaidia pre[class*="language-"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .prismjs-solarizedlight pre[class*="language-"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .prismjs-tomorrow pre[class*="language-"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_browser_wrapper!' => 'yes',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'code_area_box_shadow',
				'selectors' => [
					'{{WRAPPER}} .prismjs-default pre[class*="language-"]',
					'{{WRAPPER}} .prismjs-dark pre[class*="language-"]',
					'{{WRAPPER}} .prismjs-okaidia pre[class*="language-"]',
					'{{WRAPPER}} .prismjs-solarizedlight pre[class*="language-"]',
					'{{WRAPPER}} .prismjs-tomorrow pre[class*="language-"]',
				],
				'condition' => [
					'show_browser_wrapper!' => 'yes',
				],
			]
		);

		$widget->end_controls_section();
	}
}