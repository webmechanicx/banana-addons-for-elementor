<?php

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Banae_Pricing_Table extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_pricing_table';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Price Table', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-price-table';
	}

	/**
	 * Get widget keywords for search
	 * 
	 * @return string[]
	 */
	public function get_keywords() {
		return [ 'table', 'product', 'pricing', 'plan', 'button' ];
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'banana-addons-category' ];
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
		return [ 'banae-pricing-table-style' ];
	}

	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Pricing_Table::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$currency_symbol_custom = ( ! empty( $settings['currency_symbol_custom'] ) ) ? esc_attr( $settings['currency_symbol_custom'] ) : '';
		$tag = $settings['heading_tag'] ? $settings['heading_tag'] : 'h3';
		?>
<div class="banae-pricing-table<?php echo $settings['show_highlighter'] === 'yes' ? ' banae-pt-highlight' : ''; ?>">

    <?php if ( 'yes' === $settings['show_ribbon'] ) : ?>
    <div class="banae-pt-ribbon <?php echo esc_attr( $settings['ribbon_position'] ); ?>">
        <span><?php echo esc_html( $settings['ribbon_text'] ); ?></span>
    </div>
    <?php endif; ?>

    <?php if ( ! empty( $settings['show_media'] ) ) : ?>
    <div class="banae-pricing-media">

        <?php if ( $settings['media_type'] === 'icon' && ! empty( $settings['icon']['value'] ) ) : ?>

        <?php echo sprintf( '<i class="%s" "aria-hidden"="true"></i>', esc_attr( $settings['icon']['value'] ) ); ?>

        <?php elseif ( $settings['media_type'] === 'image' && ! empty( $settings['image']['url'] ) ) : ?>

        <?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) ); ?>

        <?php endif; ?>

    </div>
    <?php endif; ?>

    <?php if ( ! empty( $settings['heading'] ) || ! empty( $settings['subheading'] ) ) : ?>
    <div class="banae-pricing-table-heading">
        <?php if ( ! empty( $settings['heading'] ) ) : ?>
        <?php echo sprintf( '<%1$s class="banae-pricing-heading">%2$s</%1$s>', esc_attr( $tag ), esc_html( $settings['heading'] ) ); ?>
        <?php endif; ?>
        <?php if ( ! empty( $settings['subheading'] ) ) : ?>
        <p class="banae-pricing-subheading"><?php echo esc_html( $settings['subheading'] ); ?></p>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if ( ! empty( $settings['price_display_position'] ) && ( $settings['price_display_position'] === 'top' ) ) : ?>
    <div class="banae-pricing__wrapper">
        <div class="banae-pricing__inner">
            <span class="banae-currency">
                <?php echo ( $currency_symbol_custom ) ? esc_html( $currency_symbol_custom ) : esc_html( $settings['currency'] ); ?>
            </span>
            <span class="banae-amount"><?php echo esc_html( $settings['price'] ); ?></span>
        </div>
        <div class="banae-duration"><?php echo esc_html( $settings['price_duration'] ); ?></div>
    </div>
    <?php endif; ?>

    <?php if ( ! empty( $settings['features'] ) ) : ?>
    <ul class="banae-pricing-features">
        <?php foreach ( $settings['features'] as $feature ) : ?>
        <li>
            <i class="<?php echo esc_attr( $feature['feature_icon']['value'] ); ?>"></i>
            <span><?php echo esc_html( $feature['feature_text'] ); ?></span>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <?php if ( ! empty( $settings['price_display_position'] ) && ( $settings['price_display_position'] === 'bottom' ) ) : ?>
    <div class="banae-pricing__wrapper">
        <div class="banae-pricing__inner">
            <span class="banae-currency">
                <?php echo ( $currency_symbol_custom ) ? esc_html( $currency_symbol_custom ) : esc_html( $settings['currency'] ); ?>
            </span>
            <span class="banae-amount"><?php echo esc_html( $settings['price'] ); ?></span>
        </div>
        <div class="banae-duration"><?php echo esc_html( $settings['price_duration'] ); ?></div>
    </div>
    <?php endif; ?>

    <?php if ( ! empty( $settings['button_text'] ) ) : ?>
    <a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="banae-pricing-button">
        <?php echo esc_html( $settings['button_text'] ); ?>
    </a>
    <?php endif; ?>

    <?php if ( ! empty( $settings['footer_text'] ) ) : ?>
    <p class="banae-pricing-footer"><?php echo esc_html( $settings['footer_text'] ); ?></p>
    <?php endif; ?>
</div>
<?php
	}
}