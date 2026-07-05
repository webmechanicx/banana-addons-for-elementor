<?php
if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
class Banae_Pdf_Viewer extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae-pdf-viewer';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Pdf Viewer';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-document-file';
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
		return [ 'banana', 'pdf', 'pdf viewer' ];
	}

	/**
	 * Enqueue dependend scripts
	 * 
	 * Retrieve the list of script dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_script_depends() {

		return [ 'pdfjs-dist', 'banae-pdf-viewer-script' ];

	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'banae-pdf-viewer-style' ];
	}

	/**
	 * Register widget controls.
	 * 
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section( 'content_section', [
			'label' => __( 'Content', 'banana-addons-for-elementor' ),
			'tab' => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control(
			'pdf_url',
			[
				'label' => __( 'Select PDF File', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'media_types' => [ 'application/pdf' ],
				'label_block' => true,
				'default' => [],
			]
		);

		$this->add_control( 'height', [
			'label' => __( 'Viewer Height (px)', 'banana-addons-for-elementor' ),
			'type' => Controls_Manager::NUMBER,
			'default' => 600,
		] );

		$this->add_control(
			'show_toolbar',
			[
				'label' => __( 'Show Toolbar', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'true',
				'default' => 'true', // ensure default is true
			]
		);

		$this->end_controls_section();

		// STYLE tab: PDF Canvas Style controls
		$this->start_controls_section(
			'banae_pdf_toolbar_section',
			[
				'label' => __( 'Canvas Toolbar', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'banae_pdf_toolbar_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-pv-toolbar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'banae_pdf_toolbar_text_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-pv-toolbar' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE tab: PDF Canvas Background Style controls
		$this->start_controls_section(
			'banae_pdf_wrapper_section',
			[
				'label' => __( 'Canvas Background', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'banae_pdf_canvas_bg_color',
			[
				'label' => __( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-pdf-canvas-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE tab: PDF Canvas Background Style controls
		$this->start_controls_section(
			'banae_pdf_wrapper_scrollbar_section',
			[
				'label' => __( 'Canvas Scrollbar', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'banae_pdf_canvas_scrollbar_color',
			[
				'label' => __( 'Scrollbar Tracker Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#232323',
				'selectors' => [
					'{{WRAPPER}} .banae-pdf-canvas-wrap' => '--banana-scrollbar-track-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'banae_pdf_canvas_scrollbar_thumb_color',
			[
				'label' => __( 'Scrollbar Thumb Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#535353',
				'selectors' => [
					'{{WRAPPER}} .banae-pdf-canvas-wrap' => '--banana-scrollbar-thumb-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$pdf_url = esc_url( $settings['pdf_url']['url'] );
		$height = intval( $settings['height'] );
		$show_toolbar = ( $settings['show_toolbar'] ) ? 'true' : 'false';

		if ( ! $pdf_url ) {
			echo '<div class="banae-pdf-widget-error">' . esc_html__( 'Please enter a PDF URL in the widget settings.', 'banana-addons-for-elementor' ) . '</div>';
			return;
		}

		$wrapper_id = 'banae-pdf-viewer-' . uniqid();
		?>
<div class="banana-pdf-viewer" id="<?php echo esc_attr( $wrapper_id ); ?>"
    data-pdf-url="<?php echo esc_attr( $pdf_url ); ?>" data-show-toolbar="<?php echo esc_attr( $show_toolbar ); ?>">
    <div class="banae-pv-toolbar" aria-hidden="true">
        <div>
            <button class="banae-pv-btn" data-action="prev">&#10094;</button>
            <span class="banae-pv-page-info">1 / 1</span>
            <button class="banae-pv-btn" data-action="next">&#10095;</button>
        </div>
        <div>
            <button class="banae-pv-btn" data-action="zoom_out">&minus;</button>
            <button class="banae-pv-btn" data-action="zoom_in">&plus;</button>
        </div>

        <div>
            <button class="banae-pv-btn" data-action="fullscreen">&#10063;</button>
            <a class="banae-pv-btn" data-action="download" href="javascript:;" target="_blank">&darr;</a>
        </div>

    </div>
    <div class="banae-pdf-canvas-wrap" style="height:<?php echo esc_attr( $height ); ?>px;">
        <canvas class="banae-pdf-canvas"></canvas>
    </div>
</div>

<?php

	}

}