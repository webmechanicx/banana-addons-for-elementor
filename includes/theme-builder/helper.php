<?php

/**
 * Find template by type
 */
function get_banana_tb_template( $type ) {

	$args = [
		'post_type' => 'banana_template',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'meta_query' => [
			[
				'key' => '_banana_template_type',
				'value' => $type
			]
		]
	];

	$query = new WP_Query( $args );

	if ( ! $query->have_posts() ) {
		return false;
	}

	foreach ( $query->posts as $post ) {

		$condition = get_post_meta( $post->ID, '_banana_template_conditions', true );

		if ( banana_match_condition( $condition ) ) {
			return $post->ID;
		}
	}

	return false;
}

/**
 * Alias function for theme compatibility
 */
function banana_find_template( $type ) {
	return get_banana_tb_template( $type );
}

function banana_match_condition( $condition ) {

	switch ( $condition ) {

		case 'entire_site':
			return true;

		case 'singular':
			return is_singular();

		case 'archive':
			return is_archive();

		default:
			return false;
	}
}

function banana_render_header() {

	if ( is_admin() ) {
		return;
	}

	$template_id = get_banana_tb_template( 'header' );

	if ( ! $template_id ) {
		return;
	}

	$content = \Elementor\Plugin::instance()
		->frontend
		->get_builder_content_for_display( $template_id );

	// Elementor already sanitizes and generates this HTML.
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo wp_kses_post( $content );

}
add_action( 'wp_body_open', 'banana_render_header', 5 );


function banana_render_footer() {

	if ( is_admin() ) {
		return;
	}

	$template_id = get_banana_tb_template( 'footer' );

	if ( ! $template_id ) {
		return;
	}

	$content = \Elementor\Plugin::instance()
		->frontend
		->get_builder_content_for_display( $template_id );

	// Elementor already sanitizes and generates this HTML.
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo wp_kses_post( $content );

}
add_action( 'wp_footer', 'banana_render_footer', 5 );


function banana_single_template( $template ) {

	if ( is_admin() || ! is_singular() ) {
		return $template;
	}

	$template_id = get_banana_tb_template( 'single' );

	if ( ! $template_id ) {
		return $template;
	}

	set_query_var( 'banana_single_template_id', $template_id );

	return BANANA_ADDONS_DIR_PATH . 'includes/theme-builder/templates/single.php';
}

add_filter( 'template_include', 'banana_single_template', 99 );

function banana_archive_template( $template ) {

	if ( is_admin() || ! is_archive() ) {
		return $template;
	}

	$template_id = get_banana_tb_template( 'archive' );

	if ( ! $template_id ) {
		return $template;
	}

	set_query_var( 'banana_archive_template_id', $template_id );

	return BANANA_ADDONS_DIR_PATH . 'includes/theme-builder/templates/archive.php';
}

add_filter( 'template_include', 'banana_archive_template', 99 );