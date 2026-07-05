<?php
//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
class Banae_Embed_Content extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae-embed-content';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Embed Content', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-table-of-contents';
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
		return [ 'embed', 'oembed', 'thirdparty', 'iframe' ];
	}

	/**
	 * Enqueue dependend scripts
	 * 
	 * @return string[]
	 */
	public function get_script_depends() {
		return [];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content', [
				'label' => __( 'Embed', 'banana-addons-for-elementor' ),
			]
		);


		$this->add_control(
			'embed_url', [
				'label' => __( 'URL to embed', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'https://',
				'label_block' => true,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$url = isset( $settings['embed_url'] ) ? trim( $settings['embed_url'] ) : '';
		if ( empty( $url ) ) {
			echo '<div class="elementor-oembed-placeholder">' . esc_html__( 'No URL provided', 'banana-addons-for-elementor' ) . '</div>';
			return;
		}

		// Sanitize URL
		$sanitized_url = esc_url_raw( $url );
		if ( ! $sanitized_url ) {
			echo '<div class="banae-embed-content-placeholder">' . esc_html__( 'Invalid URL', 'banana-addons-for-elementor' ) . '</div>';
			return;
		}

		// Prepare dimensions
		$width = ! empty( $settings['width'] ) ? $settings['width'] : '100%';
		$height = ! empty( $settings['height'] ) ? intval( $settings['height'] ) : 400;
		$align = ( ! empty( $settings['align'] ) ) ? $settings['align'] : 'center';

		//set style attributes
		$style = sprintf( 'style="width:%s;height:%s;text-align:%s"', $width, $height, $align );

		// WordPress oEmbed class
		$WP_oEmbed = new WP_oEmbed();

		// check if provider can respond with embed or provider if supported
		$provider = $WP_oEmbed->get_provider( $sanitized_url, [ 'discover' => false ] );

		// checking with respond
		if ( ! $provider ) {
			return '<div class="banae-embed-content-elementor"><p style="color:red;">' . esc_html__( 'This provider is not supported.', 'banana-addons-for-elementor' ) . '</p>';
		}

		// get embedable html
		$embed = $WP_oEmbed->get_html( $sanitized_url );


		// Final HTML
		$output = sprintf( '<div class="banae-embed-content-elementor">%s</div>', $embed );

		echo wp_kses_post( $output );
	}

}