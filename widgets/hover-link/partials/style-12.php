<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$banae_hover_link_text = esc_html( $settings['banae_hover_link_text'] );

$banae_hover_link_url = esc_url( $settings['banae_hover_link_url']['url'] );
$target = $settings['banae_hover_link_url']['is_external'] ? ' target="_blank"' : '';
$nofollow = $settings['banae_hover_link_url']['nofollow'] ? ' rel="nofollow"' : '';

?>

<link-hover class="banae_content__item">
    <a href="<?php echo esc_url( $banae_hover_link_url ); ?>" class="banae-link banae-link--style-12"
        data-text="<?php echo esc_html( $banae_hover_link_text ); ?>" <?php echo esc_attr( $target ); ?>
        <?php echo esc_attr( $nofollow ); ?>>
        <span><?php echo esc_html( $banae_hover_link_text ); ?></span>
    </a>
</link-hover>