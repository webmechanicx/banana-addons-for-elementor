<?php
namespace Banana_Addons\Elementor\Theme_Builder\Themes;

class Banana_Theme_OceanWP {

	public function __construct() {
		remove_action( 'ocean_header', 'oceanwp_header_template' );
		remove_action( 'ocean_footer', 'oceanwp_footer_template' );

		add_action( 'ocean_header', 'banana_render_header' );
		add_action( 'ocean_footer', 'banana_render_footer' );
	}
}