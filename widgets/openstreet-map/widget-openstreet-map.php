<?php

use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Banae_OpenStreet_Map extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banana_openstreet_map';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Open Street Map', 'banana-addons-for-elementor' );
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
	 * Get widget keywords for search
	 * 
	 * @return string[]
	 */
	public function get_keywords() {
		return [ 'map', 'marker', 'open-street', 'leaflet' ];
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
	 * Enqueue dependend scripts
	 * 
	 * Retrieve the list of script dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_script_depends() {
		return [ 'jquery', 'leaflet-script', 'banae-openstreet-map-script' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'leaflet-style', 'banae-openstreet-map-style' ];
	}

	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_OpenStreet_Map::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$map_id = 'map_' . $this->get_id();
		?>

<div id="<?php echo esc_attr( $map_id ); ?>" class="banae-openstreet__map"
    style="height:<?php echo esc_attr( $settings['map_height'] ); ?>px"
    data-config='<?php echo wp_json_encode( $settings ); ?>'></div>
<?php
	}
}