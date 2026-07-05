<?php

use Banana_Addons\Elementor\Helper;
use Elementor\Plugin;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Banae_Post_List extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_post_list';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Post List', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post-list';
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
		return [ 'post', 'list', 'grid' ];
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
		return [ 'jquery', 'banae-post-list-script' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'banae-post-list-style' ];
	}

	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Post_List::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$thumbnail_size = ( ! empty( $settings['thumbnail_size'] ) ) ? $settings['thumbnail_size'] : 'medium';

		$args = [
			'post_type' => $settings['post_type'],
			'posts_per_page' => $settings['post_count'],
			'order' => $settings['order'],
			'orderby' => $settings['orderby'],
		];

		$query = new \WP_Query( $args );

		if ( ! $query->have_posts() ) {
			echo sprintf( '<p>%s</p>', esc_attr( __( 'No posts found.', 'banana-addons-for-elementor' ) ) );
		}

		Helper::get_banae_template_part( 'widgets/post-list/partials/list', [ 'settings' => $settings, 'query' => $query, 'thumbnail_size' => $thumbnail_size ] );

	}
}