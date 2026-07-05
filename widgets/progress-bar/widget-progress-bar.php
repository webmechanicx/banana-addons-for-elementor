<?php

use Banana_Addons\Elementor\Helper;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Banae_Progress_Bar extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_progress_bar';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Progress Bar', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-skill-bar';
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
		return [ 'skill', 'progress', 'bar' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'banae-progress-bar-style' ];
	}

	/**
	 * Enqueue dependend scripts
	 * 
	 * Retrieve the list of script dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_script_depends() {
		return [ 'jQuery', 'banae-progress-bar-script' ];
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
		Banae_Progress_Bar_Controls::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$bar_class = 'banae-progress-bar banae-' . esc_attr( $settings['bar_style'] );
		?>
<div class="banae-progress-bar-wrapper">
    <?php

			// Include the selected style file
			$style_file = 'widgets/progress-bar/partials/' . esc_attr( $settings['bar_style'] );

			// Load the template file
			Helper::get_banae_template_part( $style_file, [
				'settings' => $settings,
				'bar_class' => $bar_class,
			] );

			?>
</div>
<?php
	}
}