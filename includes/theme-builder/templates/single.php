<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$template_id = absint( get_query_var('banana_single_template_id') );

if ( $template_id && class_exists( '\Elementor\Plugin' ) ) {

	$content = \Elementor\Plugin::instance()
		->frontend
		->get_builder_content_for_display( $template_id );

	// Elementor already sanitizes and generates this HTML.
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo wp_kses_post( $content );

} else {

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
	else :
		echo '<p>No content found.</p>';
	endif;
}

get_footer();