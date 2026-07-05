<?php

use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Banae_Testimonial extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_testimonial';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Testimonial', 'banana-addons-for-elementor' );
	}

	public function get_custom_help_url() {
		return 'https://bananaaddons.com/docs/elementor/widgets/testimonial/';
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-testimonial';
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
		return [ 'testimonial', 'review', 'feedback' ];
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
			'banae-testimonial-style',
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
		Banae_Testimonial_Controls::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$link = false;

		if ( ! empty( $settings['testimonial_link']['url'] ) ) {
			$link = true;
			$this->add_link_attributes( 'testimonial_link', $settings['testimonial_link'] );
			$this->add_render_attribute( 'testimonial_link', 'class', 'banae-testimonial__link' );
		}

		?>

<?php
		if ( $link ) {
			echo '<a ' . esc_attr( $this->get_render_attribute_string( 'testimonial_link' ) ) . '>';
		}
		?>

<div class="banae-testimonial__content">
    <?php echo wp_kses_post( $settings['testimonial'] ); ?>
</div>

<div class="banae-testimonial__customer">
    <?php if ( ! empty( $settings['image']['url'] ) ) : ?>
    <figure class="banae-testimonial__customer-thumb">
        <?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) ); ?>
    </figure>
    <?php endif; ?>

    <div class="banae-testimonial__customer-meta">
        <div class="banae-testimonial__customer-name"><?php echo wp_kses_post( $settings['name'] ); ?></div>
        <div class="banae-testimonial__customer-position">
            <?php echo wp_kses_post( $settings['position'] ); ?>
        </div>
    </div>
</div>

<?php
		if ( $link ) {
			echo '</a>';
		}
		?>

<?php
	}
}