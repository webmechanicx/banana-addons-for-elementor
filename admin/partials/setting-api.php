<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div class="banae-api-settings__container">
    <div class="banae-column">
        <div class="banae-form-group">
            <div class="banae-admin-label">
                <label
                    class="banae-form-label"><?php esc_attr_e( 'Google Map API Key', 'banana-addons-for-elementor' ); ?></label>
            </div>
            <div class="banae-admin-input">
                <input type="text" id="google-map-api-key"
                    placeholder="<?php esc_attr_e( 'Google Map API Key', 'banana-addons-for-elementor' ); ?>"
                    name="google_map_api_key"
                    value="<?php echo esc_attr( get_option( 'banae_google_map_api_key' ) ); ?>">
            </div>
        </div>
        <div class="banae-form-group">
            <div class="banae-admin-label">
                <label
                    class="banae-form-label"><?php esc_attr_e( 'MailChimp API Key', 'banana-addons-for-elementor' ); ?></label>
            </div>
            <div class="banae-admin-input">
                <input type="text" id="mailchimp-api-key"
                    placeholder="<?php esc_attr_e( 'MailChimp API Key', 'banana-addons-for-elementor' ); ?>"
                    name="mailchimp_api_key" value="<?php echo esc_attr( get_option( 'banae_mailchimp_api_key' ) ); ?>">
            </div>
        </div>
    </div><!-- ./banae-column -->

    <div class="banae-column">
        <div class="banae-form-group">
            <div class="banae-admin-label">
                <label
                    class="banae-form-label"><?php esc_attr_e( 'Stripe Public Key', 'banana-addons-for-elementor' ); ?></label>
            </div>
            <div class="banae-admin-input">
                <input type="text" id="stripe-public-key"
                    placeholder="<?php esc_attr_e( 'Stripe Public Key', 'banana-addons-for-elementor' ); ?>"
                    name="stripe_public_key" value="<?php echo esc_attr( get_option( 'banae_stripe_public_key' ) ); ?>">
            </div>
        </div>
        <div class="banae-form-group">
            <div class="banae-admin-label">
                <label
                    class="banae-form-label"><?php esc_attr_e( 'Stripe Secret Key', 'banana-addons-for-elementor' ); ?></label>
            </div>
            <div class="banae-admin-input">
                <input type="text" id="stripe-secret-key"
                    placeholder="<?php esc_attr_e( 'Stripe Secret Key', 'banana-addons-for-elementor' ); ?>"
                    name="stripe_secret_key" value="<?php echo esc_attr( get_option( 'banae_stripe_secret_key' ) ); ?>">
            </div>
        </div>
    </div><!-- ./banae-column -->

</div>