<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Banana_Addons\Elementor\Helper;
use Elementor\Widget_Base;
use Elementor\Plugin;

class Banae_Hover_Link extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_hover_link';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Hover Link', 'banana-addons-for-elementor' );
	}

	public function get_custom_help_url() {
		return 'https://bananaaddons.com/docs/elementor/widgets/hover-link/';
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-editor-link';
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
		return [ 'button', 'link', 'hover', 'animation' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [
			'banae-hover-link-style',
		];
	}

	protected function is_dynamic_content(): bool {
		return false;
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
		Banae_Hover_Link_Controls::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Include the selected style file
		$style_file = 'widgets/hover-link/partials/' . esc_attr( $settings['banae_hover_link_animation_style'] );
		?>

<div class="banae-hover-link">

    <?php
			// Load the template file
			Helper::get_banae_template_part( $style_file, [
				'settings' => $settings,
			] );
			?>

</div>

<?php
	}
}