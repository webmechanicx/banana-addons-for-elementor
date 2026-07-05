<?php

use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Banae_Smart_PayPal_Button extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_smart_paypal_button';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Smart PayPal Button', 'banana-addons-for-elementor' );
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
		return [ 'paypal', 'payment', 'button', 'checkout', 'smart' ];
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
			$env = $settings['environment'] === 'sandbox' ? 'sandbox' : 'www';

			// preparing paypal live or sandbox url
			$url = sprintf( 'https://%s.paypal.com/sdk/js?client-id=%s&currency=%s&intent=capture', $env, esc_attr( $settings['client_id'] ), esc_attr( $settings['currency'] ) );

			wp_register_script( 'banae-paypal-sdk', $url, [], null, true );

		}

		return [ 'jquery', 'banae-paypal-sdk', 'banae-smart-paypal-button-script' ];

	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'banae-smart-paypal-button-style' ];
	}

	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Smart_PayPal_Button::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['client_id'] ) ) {
			echo '<div style="color:red;">Please enter your PayPal Client ID in the widget settings.</div>';
			return;
		}

		$env = $settings['environment'] === 'sandbox' ? 'sandbox' : 'production';
		$client_id = esc_js( $settings['client_id'] );
		$return_url = ! empty( $settings['return_url']['url'] ) ? esc_url( $settings['return_url']['url'] ) : '';
		$cancel_url = ! empty( $settings['cancel_url']['url'] ) ? esc_url( $settings['cancel_url']['url'] ) : '';

		// setup config data
		$config_data = [
			'env' => $env,
			'amount' => esc_js( $settings['amount'] ),
			'currency' => esc_js( $settings['currency'] ),
			'item_name' => esc_js( $settings['item_name'] ),
			'return_url' => $return_url,
			'return_url' => $cancel_url,
		];

		$unique_id = 'banae-paypal-button-' . uniqid();
		?>
<div class="paypal-button-container" data-config='<?php echo wp_json_encode( $config_data ); ?>'>
    <div id="<?php echo esc_attr( $unique_id ); ?>"></div>
</div>

<?php
	}
}