<?php

use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Banae_Image_Masking extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_image_masking';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Image Masking', 'banana-addons-for-elementor' );
	}

	public function get_custom_help_url() {
		return 'https://bananaaddons.com/docs/elementor/widgets/image-masking/';
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image';
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
		return [ 'image', 'shape', 'masking' ];
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
			'banae-image-masking-style',
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
		Banae_Image_Masking_Controls::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$link = false;

		if ( ! empty( $settings['banae_image_link']['url'] ) ) {
			$link = true;
			$this->add_link_attributes( 'banae_image_link', $settings['banae_image_link'] );
			$this->add_render_attribute( 'banae_image_link', 'class', 'banae-image-masking__link' );
		}

		?>

<?php
		if ( $link ) {
			echo '<a ' . esc_attr( $this->get_render_attribute_string( 'banae_image_link' ) ) . '>';
		}
		?>

<div class="banae-image-masking__image">
    <?php if ( ! empty( $settings['banae_image_source']['url'] ) ) : ?>
    <figure class="banae-image-masking__image-thumb">
        <?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'banae_image_source' ) ); ?>
    </figure>
    <?php endif; ?>
</div>

<?php
		if ( $link ) {
			echo '</a>';
		}
		?>

<?php
	}
}