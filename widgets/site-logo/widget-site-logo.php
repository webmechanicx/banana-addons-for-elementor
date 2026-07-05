<?php

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Banae_Site_Logo extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_site_logo';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Site Logo', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-site-logo';
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
		return [ 'logo', 'site', 'brand', 'identity', 'image' ];
	}

	protected function is_dynamic_content(): bool {
		return false;
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
		return [];
	}

	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Site_Logo::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$logo_id = null;
		$logo_url = '';

		if ( 'yes' === $settings['use_site_logo'] ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			if ( $custom_logo_id ) {
				$logo_id = $custom_logo_id;
			}
		} else {
			if ( ! empty( $settings['custom_logo']['id'] ) ) {
				$logo_id = $settings['custom_logo']['id'];
			}
		}

		if ( $logo_id ) {
			$logo_url = Group_Control_Image_Size::get_attachment_image_src( $logo_id, 'logo_size', $settings );
		}

		if ( empty( $logo_url ) && ! empty( $settings['fallback_logo']['url'] ) ) {
			$logo_url = $settings['fallback_logo']['url'];
		}

		if ( empty( $logo_url ) ) {
			return; // no logo to display
		}

		$this->add_render_attribute( 'wrapper', 'class', 'banae-site-logo' );

		$img_html = sprintf(
			'<img src="%s" alt="%s" class="elementor-animation-%s" />',
			esc_url( $logo_url ),
			esc_attr( get_bloginfo( 'name' ) ),
			esc_attr( $settings['hover_animation'] )
		);

		if ( 'yes' === $settings['link_to_home'] ) {
			$img_html = sprintf(
				'<a href="%s">%s</a>',
				esc_url( home_url( '/' ) ),
				$img_html
			);
		}

		echo '<div ' . esc_attr( $this->get_render_attribute_string( 'wrapper' ) ) . '>' . esc_attr( $img_html ) . '</div>';
	}
}