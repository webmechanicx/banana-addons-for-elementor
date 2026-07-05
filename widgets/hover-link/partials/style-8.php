<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$banae_hover_link_text = esc_html( $settings['banae_hover_link_text'] );

$banae_hover_link_url = esc_url( $settings['banae_hover_link_url']['url'] );
$target = $settings['banae_hover_link_url']['is_external'] ? ' target="_blank"' : '';
$nofollow = $settings['banae_hover_link_url']['nofollow'] ? ' rel="nofollow"' : '';

?>
<link-hover class="banae_content__item">
    <a href="<?php echo esc_url( $banae_hover_link_url ); ?>" class="banae-link banae-link--style-8"
        <?php echo esc_attr( $target ); ?> <?php echo esc_attr( $nofollow ); ?>>
        <span><?php echo esc_html( $banae_hover_link_text ); ?></span>
        <svg class="banae_link__graphic banae_link__graphic--stroke banae_link__graphic--arc" width="100%" height="18"
            viewBox="0 0 59 18">
            <path d="M.945.149C12.3 16.142 43.573 22.572 58.785 10.842" pathLength="1" />
        </svg>
    </a>
</link-hover>