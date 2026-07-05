<?php

use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Banae_Page_Title extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_page_title';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Page Title', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-editor-h1';
	}

	/**
	 * Get widget categories.
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
		return [ 'title', 'site', 'blog', 'website', 'heading' ];
	}

	/**
	 * Enqueue dependend scripts
	 * 
	 * Retrieve the list of script dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_script_depends() {
		return [];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ '' ];
	}

	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Page_Title::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$title = ( $settings['use_custom_title'] === 'yes' && ! empty( $settings['custom_title_text'] ) )
			? $settings['custom_title_text']
			: get_the_title();

		$tag = $settings['heading_tag'];
		$link_open = '';
		$link_close = '';

		if ( ! empty( $settings['title_link'] ) && $settings['title_link'] === 'yes' ) {
			$link_open = '<a href="' . esc_url( get_the_permalink() ) . '">';
			$link_close = '</a>';
		} elseif ( ! empty( $settings['custom_link']['url'] ) && $settings['use_custom_title'] === 'yes' ) {
			$link_open = '<a href="' . esc_url( $settings['custom_link']['url'] ) . '">';
			$link_close = '</a>';
		}

		echo sprintf(
			'<%1$s class="banae-page-title">%2$s%3$s%4$s</%1$s>',
			esc_attr( $tag ),
			esc_attr( $link_open ),
			esc_html( $title ),
			esc_attr( $link_close )
		);
	}
}