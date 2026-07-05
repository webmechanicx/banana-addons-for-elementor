<?php
namespace Banana_Addons\Elementor\Theme_Builder\Themes;

class Banana_Theme_Astra {

	public function __construct() {
		// remove Astra header
		remove_action( 'astra_header', 'astra_header_markup' );

		// remove Astra footer
		remove_action( 'astra_footer', 'astra_footer_markup' );

		// add our header
		add_action( 'astra_header', 'banana_render_header' );

		// add our footer
		add_action( 'astra_footer', 'banana_render_footer' );
	}
}