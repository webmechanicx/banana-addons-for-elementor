<?php
namespace Banana_Addons\Elementor\Theme_Builder\Themes;

class Banana_Theme_Generic {

	public function __construct() {
		add_action( 'wp_body_open', 'banana_render_header', 5 );
		add_action( 'wp_footer', 'banana_render_footer', 5 );
	}
}