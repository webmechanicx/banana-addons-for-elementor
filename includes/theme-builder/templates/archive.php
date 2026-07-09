<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

//$template_id = banana_find_template( 'archive' ); //avoid duplicate query
$template_id = absint( get_query_var('banana_archive_template_id') );

if ( $template_id && class_exists( '\Elementor\Plugin' ) ) {
	
		$content = \Elementor\Plugin::instance()
			->frontend
			->get_builder_content_for_display( $template_id );

		// Elementor already sanitizes and generates this HTML.
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo wp_kses_post( $content );

} else {

	// fallback to default loop
	if ( have_posts() ) :

		echo '<div class="banana-default-archive">';

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		endwhile;

		the_posts_pagination();

		echo '</div>';

	else :

		echo '<p>No posts found.</p>';

	endif;
}

get_footer();