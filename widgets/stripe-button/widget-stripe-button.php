<?php

use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Banae_Stripe_Button extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_stripe_button';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Stripe Buy Button', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-stripe-button';
	}

	/**
	 * Get widget keywords for search
	 * 
	 * @return string[]
	 */
	public function get_keywords() {
		return [ 'stripe', 'payment', 'button', 'checkout' ];
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

		if ( ! Plugin::$instance->preview->is_preview_mode() ) {

			$settings = $this->get_settings_for_display();

			wp_register_script( 'banae-stripe-buy-button', 'https://js.stripe.com/v3/buy-button.js', [], null, true );

		}

		return [ 'banae-stripe-buy-button' ];

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

	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Stripe_Button::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$publishable_key = esc_attr( $settings['publishable_key'] );
		$button_id = esc_attr( $settings['button_id'] );
		$custom_text = esc_html( $settings['custom_text'] );

		if ( ! $publishable_key || ! $button_id ) {
			echo '<div style="color:red;">Please provide your Public Key and Button ID.</div>';
			return;
		}
		?>

<div class="banae-stripe-button__wrapper">
    <stripe-buy-button buy-button-id="<?php echo esc_attr( $button_id ); ?>"
        publishable-key="<?php echo esc_attr( $publishable_key ); ?>">
    </stripe-buy-button>
</div>

<?php
	}
}