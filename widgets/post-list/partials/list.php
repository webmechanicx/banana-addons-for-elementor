<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$layout_style = esc_attr( $settings['layout_style'] ) ?? '';

if ( $query->have_posts() ) {
	?>
<div class="banae-post-list__wrapper banae-<?php echo esc_attr( $layout_style ); ?>">
    <div class="banae-post-row">
        <?php
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
        <div class="banae-post-list-item banae-col-12 banae-col-md-6 banae-col-lg-4">
            <div class="banae-post-card">

                <?php if ( 'yes' === $settings['show_image'] && has_post_thumbnail() ) : ?>
                <?php echo get_the_post_thumbnail( get_the_ID(), $thumbnail_size, array( 'class' => 'banae-post-img-top' ) ); ?>
                <?php endif; ?>

                <div class="banae-post-card-body">

                    <h3 class="banae-post-title">
                        <a
                            href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                    </h3>

                    <?php if ( 'yes' === $settings['show_meta'] ) : ?>
                    <div class="banae-post-meta"><?php echo get_the_date() . ' | ' . get_the_author(); ?></div>
                    <?php endif; ?>

                    <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                    <p class="banae-post-excerpt">
                        <?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), esc_attr( $settings['excerpt_length'] ) ) ); ?>
                    </p>
                    <?php endif; ?>

                    <?php if ( 'yes' === $settings['show_readmore'] ) : ?>
                    <a class="banae-post-readmore" href="<?php echo esc_url( get_permalink() ); ?>">

                        <?php if ( ! empty($settings['button_icon']['value']) && 'left' === $settings['button_icon_align'] ) : ?>
                        <i class="<?php echo esc_attr( $settings['button_icon']['value'] ); ?>"></i>
                        <?php endif; ?>

                        <?php echo esc_html( $settings['read_more_text'] ); ?>

                        <?php if ( ! empty($settings['button_icon']['value']) && 'right' === $settings['button_icon_align'] ) : ?>
                        <i class="<?php echo esc_attr( $settings['button_icon']['value'] ); ?>"></i>
                        <?php endif; ?>

                    </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <?php
			}
			?>

    </div>
</div>
<?php
	wp_reset_postdata();

}