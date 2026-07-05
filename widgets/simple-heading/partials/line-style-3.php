<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div class="<?php echo esc_attr( $wrapper_classes ); ?>">
    <?php echo esc_html( $title ); // WPCS: XSS ok - sanitised above where appropriate ?>
    <?php echo esc_html( $sub_title ); // WPCS: XSS ok - sanitised above where appropriate ?>
    <?php echo esc_html( $line_divider ); // WPCS: XSS ok - sanitised above where appropriate ?>
</div>