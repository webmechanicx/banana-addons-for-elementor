<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$banae_hover_link_text = esc_html( $settings['banae_hover_link_text'] );

$banae_hover_link_url = esc_url( $settings['banae_hover_link_url']['url'] );
$target = $settings['banae_hover_link_url']['is_external'] ? ' target="_blank"' : '';
$nofollow = $settings['banae_hover_link_url']['nofollow'] ? ' rel="nofollow"' : '';

?>

<link-hover class="banae_content__item">
    <a href="<?php echo esc_url( $banae_hover_link_url ); ?>" class="banae-link banae-link--style-2"
        <?php echo esc_attr( $target ); ?> <?php echo esc_attr( $nofollow ); ?>>
        <span><?php echo esc_html( $banae_hover_link_text ); ?></span>
        <svg class="banae_link__graphic banae_link__graphic--stroke banae_link__graphic--scribble" width="100%"
            height="9" viewBox="0 0 101 9">
            <path
                d="M.426 1.973C4.144 1.567 17.77-.514 21.443 1.48 24.296 3.026 24.844 4.627 27.5 7c3.075 2.748 6.642-4.141 10.066-4.688 7.517-1.2 13.237 5.425 17.59 2.745C58.5 3 60.464-1.786 66 2c1.996 1.365 3.174 3.737 5.286 4.41 5.423 1.727 25.34-7.981 29.14-1.294"
                pathLength="1" />
        </svg>
    </a>
</link-hover>