<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Elementor\Widget_Base;
use Elementor\Plugin;
use Banana_Addons\Elementor\Helper;

class Banae_Facebook_Feed extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_facebook_feed';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Facebook Feed', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-facebook';
	}

	/**
	 * Get widget keywords for search
	 * 
	 * @return string[]
	 */
	public function get_keywords() {
		return [ 'social', 'media', 'feed', 'post' ];
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
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'banae-facebook-feed-style' ];
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
	 * Register controls
	 */
	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Facebook_Feed::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		//Helper::facebook_feed_render($this->get_id(), $settings, $this);
		//Helper::display_json_data($this->get_id(), $settings, $this);
		$feed = Helper::get_facebook_feed( $this->get_id(), $settings, $this );


		Helper::get_banae_template_part( 'widgets/facebook-feed/partials/layout', $args = array( 'settings' => $settings, 'facebook_feed_data' => $feed ) );

	}

}