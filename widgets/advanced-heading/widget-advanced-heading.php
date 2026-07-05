<?php

use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Banae_Advanced_Heading extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_advanced_heading';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Advanced Heading', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-e-heading';
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
		return [ 'heading', 'headline', 'animated' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'banae-advanced-heading-style' ];
	}

	/**
	 * Dynamic Content.
	 *
	 * @return boolean
	 */
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
		Banae_Advanced_Heading_Controls::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$title_tag = wp_kses_post( $settings['advanced_heading_title_tag'] );
		$title_url = wp_kses_post( $settings['advanced_heading_link']['url'] );
		$is_external = wp_kses_post( $settings['advanced_heading_link']['is_external'] );
		$nofollow = wp_kses_post( $settings['advanced_heading_link']['nofollow'] );

		// opening and close title tags markup
		$open_tag = sprintf( '<%1$s class="%2$s">', $title_tag, "banae-advanced-heading-tag" );
		$close_tag = sprintf( '</%1$s>', $title_tag );

		// assign link attributes
		$link_attributes = sprintf( 'href="%1$s"%2$s%3$s', $title_url, ( $is_external ) ? ' target="_blank"' : '', ( $nofollow ) ? ' rel="nofollow"' : '' );

		?>

<?php echo esc_attr( $open_tag ); ?>

<?php if ( ! empty( $settings['link']['url'] ) ) : ?>

<a <?php echo esc_attr( $link_attributes ); ?>>
    <div class="banae-advanced-heading-wrap"
        data-background-text="<?php echo wp_kses_post( $settings['background_text'] ); ?>">
        <span
            class="banae-advanced-heading-before"><?php echo wp_kses_post( $settings['advanced_heading_before'] ); ?></span>
        <span
            class="banae-advanced-heading-center"><?php echo wp_kses_post( $settings['advanced_heading_center'] ); ?></span>
        <span
            class="banae-advanced-heading-after"><?php echo wp_kses_post( $settings['advanced_heading_after'] ); ?></span>
        <span class="banae-advanced-heading-border"></span>
    </div>
</a>

<?php else : ?>

<div class="banae-advanced-heading-wrap"
    data-background-text="<?php echo wp_kses_post( $settings['background_text'] ); ?>">
    <span
        class="banae-advanced-heading-before"><?php echo wp_kses_post( $settings['advanced_heading_before'] ); ?></span>
    <span
        class="banae-advanced-heading-center"><?php echo wp_kses_post( $settings['advanced_heading_center'] ); ?></span>
    <span class="banae-advanced-heading-after"><?php echo wp_kses_post( $settings['advanced_heading_after'] ); ?></span>
    <span class="banae-advanced-heading-border"></span>
</div>

<?php endif; ?>
<?php echo esc_attr( $close_tag ); ?>

<?php
	}
}