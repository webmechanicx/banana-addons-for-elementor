<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php if ( $banae_extension_options ) : ?>
<ul class="banae-cards">
    <?php foreach ( $banae_extension_options as $key => $label ) : ?>
    <li class="banae-card">
        <div class="banae-card__text flow">
            <div class="banae-card-header">
                <h4><?php echo isset( $label['title'] ) ? esc_html( $label['title'] ) : esc_html( $label ); ?><sup
                        class="label-sup">Free</sup>
                </h4>
                <label class="banae-switch-wrapper">
                    <input type="checkbox" name="<?php echo esc_attr( $key ); ?>" value="1"
                        <?php checked( ! empty( $options[ $key ] ) ); ?>>
                    <span class="banae-slider banae-round"></span>
                </label>
            </div>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>