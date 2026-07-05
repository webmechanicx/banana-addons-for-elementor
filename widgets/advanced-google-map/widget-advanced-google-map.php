<?php

use Banana_Addons\Elementor\Helper;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Banae_Advanced_Google_Map extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_advanced_google_map';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Advanced GMap', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-google-maps';
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
		return [ 'google', 'map', 'marker' ];
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

	/**
	 * Enqueue dependend scripts
	 * 
	 * Retrieve the list of script dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_script_depends() {
		return [ 'jQuery', 'banae-advanced-google-map-script', 'google-maps-api' ];
	}

	/**
	 * Register widget controls.
	 * 
	 * @access protected
	 */
	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Advanced_Google_Map_Controls::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$lat = esc_attr( $settings['latitude'] );
		$lng = esc_attr( $settings['longitude'] );
		$zoom = esc_attr( $settings['zoom']['size'] );
		$style = esc_attr( $settings['map_style'] );
		$marker_label = esc_attr( $settings['marker_label'] );
		// Load Google Maps API (Replace YOUR_API_KEY)
		wp_enqueue_script(
			'google-maps-api',
			'https://maps.googleapis.com/maps/api/js?key=AIzaSyBRjKVAdJ81CInQQAzy2qXMBcjcUVlAsdY',
			[],
			null,
			true
		);
		?>
<div class="banae-advanced-google-map-wrapper">
    <div class="banae-advanced-google-map" data-lat="<?php echo esc_attr( $lat ) ; ?>"
        data-lng="<?php echo esc_attr( $lng ); ?>" data-zoom="<?php echo esc_attr( $zoom ); ?>"
        data-style="<?php echo esc_attr( $style ); ?>" data-marker-label="<?php echo esc_attr( $marker_label ); ?>"
        style="width:100%;height:400px;">
    </div>
</div>
<?php
	}
}