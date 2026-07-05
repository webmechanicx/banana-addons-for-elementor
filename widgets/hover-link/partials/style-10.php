<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$banae_hover_link_text = esc_html( $settings['banae_hover_link_text'] );

$banae_hover_link_url = esc_url( $settings['banae_hover_link_url']['url'] );
$target = $settings['banae_hover_link_url']['is_external'] ? ' target="_blank"' : '';
$nofollow = $settings['banae_hover_link_url']['nofollow'] ? ' rel="nofollow"' : '';

?>

<link-hover class="banae_content__item">
    <a href="<?php echo esc_url( $banae_hover_link_url ); ?>" class="banae-link banae-link--style-10"
        <?php echo esc_attr( $target ); ?> <?php echo esc_attr( $nofollow ); ?>>
        <span><?php echo esc_html( $banae_hover_link_text ); ?></span>
        <svg class="banae_link__graphic banae_link__graphic--slide" width="300%" height="100%" viewBox="0 0 1200 60"
            preserveAspectRatio="none">
            <path
                d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0">
            </path>
        </svg>
    </a>
</link-hover>