<?php

use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Banae_PayPal_Button extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_paypal_button';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'PayPal Button', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-paypal-button';
	}

	/**
	 * Get widget keywords for search
	 * 
	 * @return string[]
	 */
	public function get_keywords() {
		return [ 'paypal', 'payment', 'button', 'checkout' ];
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
		return [ 'banae-paypal-button-style' ];
	}

	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_PayPal_Button::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$payment_type = esc_attr( $settings['payment_type'] );
		$shipping_price = esc_attr( $settings['shipping_price'] );
		$tax_rate = esc_attr( $settings['tax_rate'] );
		$quantity = esc_attr( $settings['quantity'] );
		$auto_renewal = esc_attr( $settings['auto_renewal'] );
		$billing_cycle = esc_attr( $settings['billing_cycle'] );

		$form_action = $settings['environment'] === 'sandbox'
			? 'https://www.sandbox.paypal.com/cgi-bin/webscr'
			: 'https://www.paypal.com/cgi-bin/webscr';

		?>
<div class="banae-paypal-button__wrapper">
    <form action="<?php echo esc_url( $form_action ); ?>" method="post" target="_blank">
        <input type="hidden" name="business" value="<?php echo esc_attr( $settings['paypal_email'] ); ?>">
        <input type="hidden" name="cmd" value="<?php echo esc_attr( $payment_type ); ?>">
        <input type="hidden" name="item_name" value="<?php echo esc_attr( $settings['item_name'] ); ?>">
        <input type="hidden" name="amount" value="<?php echo esc_attr( $settings['amount'] ); ?>">
        <input type="hidden" name="currency_code" value="<?php echo esc_attr( $settings['currency'] ); ?>">

        <?php if ( $payment_type === '_xclick' ) : ?>
        <input type="hidden" name="shipping" value="<?php esc_attr( $shipping_price ); ?>" />
        <input type="hidden" name="tax_rate" value="<?php esc_attr( $tax_rate ); ?>" />
        <input type="hidden" name="quantity" value="<?php esc_attr( $quantity ); ?>" />

        <?php elseif ( $payment_type === '_donations' ) : ?>
        <input type="hidden" name="src" value="<?php echo esc_attr( $auto_renewal ); ?>" />
        <input type="hidden" name="p3" value="1" />
        <input type="hidden" name="t3" value="<?php echo esc_attr( $billing_cycle ); ?>" />
        <input type="hidden" name="no-shipping" value="1" />
        <?php endif; ?>

        <?php if ( ! empty( $settings['return_url']['url'] ) ) : ?>
        <input type="hidden" name="return" value="<?php echo esc_url( $settings['return_url']['url'] ); ?>">
        <?php endif; ?>

        <?php if ( ! empty( $settings['cancel_url']['url'] ) ) : ?>
        <input type="hidden" name="cancel_return" value="<?php echo esc_url( $settings['cancel_url']['url'] ); ?>">
        <?php endif; ?>

        <button type="submit" class="banae-paypal-btn">
            <div class="banae-paypal-button__inner">
                <?php Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <span class="banae-btn-label"><?php echo esc_html( $settings['button_text'] ); ?></span>
            </div>
        </button>
    </form>
</div>
<?php
	}
}