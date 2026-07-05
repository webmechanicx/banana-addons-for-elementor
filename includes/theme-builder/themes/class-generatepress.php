<?php
namespace Banana_Addons\Elementor\Theme_Builder\Themes;

class Banana_Theme_GeneratePress {

	public function __construct() {
		remove_action( 'generate_header', 'generate_construct_header' );
		remove_action( 'generate_footer', 'generate_construct_footer' );

		add_action( 'generate_header', 'banana_render_header' );
		add_action( 'generate_footer', 'banana_render_footer' );
	}
}