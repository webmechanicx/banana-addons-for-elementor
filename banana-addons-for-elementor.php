<?php
/**
 * Plugin Name: Banana Addons for Elementor
 * Plugin URI:  https://bananaaddons.com/
 * Description: <a href="https://bananaaddons.com/">Banana Addons for Elementor</a> provides 35+ free widgets for the <a href="https://wordpress.org/plugins/elementor/">Elementor</a> page builder, including Info Card, Flip Box, Advanced Heading, Testimonial, and more. It also includes additional features such as Wrapper Link to extend Elementor's default functionality.
 * Version:     1.0.0
 * Author:      Farhadur Rahim
 * Author URI:  https://farhadurrahim.com/
 * Elementor tested up to: 3.20.1
 * Elementor Pro tested up to: 3.32.2
 * Requires Plugins: elementor
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: banana-addons-for-elementor
 * Domain Path: /i18n/
 * 
 * @package Banana_Addons
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2026 Banana Addons <https://bananaaddons.com>
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BANANA_ADDONS_VERSION', '1.0.0' );
define( 'BANANA_ADDONS_VERSION_TYPE', 'Free' );
define( 'BANANA_ADDONS__FILE__', __FILE__ );
define( 'BANANA_ADDONS_PLUGIN_BASE', plugin_basename( BANANA_ADDONS__FILE__ ) );
define( 'BANANA_ADDONS_DIR_PATH', plugin_dir_path( BANANA_ADDONS__FILE__ ) );
define( 'BANANA_ADDONS_DIR_URL', plugin_dir_url( BANANA_ADDONS__FILE__ ) );
define( 'BANANA_ADDONS_ASSETS', trailingslashit( BANANA_ADDONS_DIR_URL . 'dist/assets' ) );
define( 'BANANA_ADDONS_ASSETS_DIR', trailingslashit( 'dist/assets' ) );
define( 'BANANA_ADDONS_WIDGETS', trailingslashit( BANANA_ADDONS_DIR_PATH . 'widgets' ) );
define( 'BANANA_ADDONS_EXTENSIONS', trailingslashit( BANANA_ADDONS_DIR_PATH . 'extensions' ) );

define( 'BANANA_ADDONS_MINIMUM_ELEMENTOR_VERSION', '3.20.1' );
define( 'BANANA_ADDONS_MINIMUM_PHP_VERSION', '7.4' );


/**
 * The beginning of the plugin starts here.
 *
 * @return void
 */
function banae_load_plugin() {

	if ( version_compare( PHP_VERSION, BANANA_ADDONS_MINIMUM_PHP_VERSION, '<' ) ) {
		add_action( 'admin_notices', 'banae_required_php_version_conflict_notice' );
		return;
	}

	// Check if Elementor installed and activated
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'banae_elementor_missing_notice' );
		return;
	}

	// Check for required Elementor version
	if ( ! version_compare( ELEMENTOR_VERSION, BANANA_ADDONS_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
		add_action( 'admin_notices', 'banae_required_elementor_version_conflict_notice' );
		return;
	}

	// require the base class
	require_once BANANA_ADDONS_DIR_PATH . 'base.php';
	\Banana_Addons\Elementor\Base::instance();
}

add_action( 'plugins_loaded', 'banae_load_plugin' );

/**
 * Admin notice for required php version
 *
 * @return void
 */
function banae_required_php_version_conflict_notice() {
	$notice = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
		esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'banana-addons-for-elementor' ),
		'<strong>' . esc_html__( 'Banana Addons', 'banana-addons-for-elementor' ) . '</strong>',
		'<strong>' . esc_html__( 'PHP', 'banana-addons-for-elementor' ) . '</strong>',
		BANANA_ADDONS_MINIMUM_PHP_VERSION
	);

	printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', esc_html( $notice ) );
}

/**
 * Admin notice for elementor if missing
 *
 * @return void
 */
function banae_elementor_missing_notice() {

	if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
		$notice_title = __( 'Activate Elementor', 'banana-addons-for-elementor' );
		$notice_url = wp_nonce_url( 'plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php' );
	} else {
		$notice_title = __( 'Install Elementor', 'banana-addons-for-elementor' );
		$notice_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
	}

	/* translators: 1: Plugin name, 2: Elementor plugin name, 3: Elementor installation link */
	$notice_text = __( '%1$s requires %2$s to be installed and activated to function properly. %3$s', 'banana-addons-for-elementor' );

	$notice = sprintf(
		$notice_text,
		'<strong>' . esc_html__( 'Banana Addons', 'banana-addons-for-elementor' ) . '</strong>',
		'<strong>' . esc_html__( 'Elementor', 'banana-addons-for-elementor' ) . '</strong>',
		'<a href="' . esc_url( $notice_url ) . '">' . esc_html( $notice_title ) . '</a>'
	);

	printf(
		'<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>',
		wp_kses_post( $notice )
	);
}

/**
 * Admin notice for required elementor version
 *
 * @return void
 */
function banae_required_elementor_version_conflict_notice() {

	$notice_title = __( 'Update Elementor', 'banana-addons-for-elementor' );
	$notice_url = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=elementor/elementor.php' ), 'upgrade-plugin_elementor/elementor.php' );

	$notice = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
		esc_html__( '"%1$s" requires "%2$s" version %4$s or greater. %3$s', 'banana-addons-for-elementor' ),
		'<strong>' . esc_html__( 'Banana Addons Elementor', 'banana-addons-for-elementor' ) . '</strong>',
		'<strong>' . esc_html__( 'Elementor', 'banana-addons-for-elementor' ) . '</strong>',
		'<a href="' . esc_url( $notice_url ) . '">' . $notice_title . '</a>',
		BANANA_ADDONS_MINIMUM_ELEMENTOR_VERSION
	);

	printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', esc_html( $notice ) );
}

/**
 * Register actions that run on activation
 *
 * @return void
 */
/*
function banae_register_activation_hook() {

	if ( ! get_option( 'banana_addons_licenses_option', "" ) ) {
		wp_redirect( admin_url( 'admin.php?page=banana-addons-for-elementor' ) );
	}
}

register_activation_hook( BANANA_ADDONS__FILE__, 'banae_register_activation_hook' );
*/

/**
 * Remove all admin notices on plugin settings/dashboard page
 *
 * @return void
 */
function banae_remove_all_admin_notices(): void {

	$screen = get_current_screen();

	if ( $screen->id === 'toplevel_page_banana-addons-for-elementor' ) {
		remove_all_actions( 'admin_notices' );
		remove_all_actions( 'all_admin_notices' );
	}

}
add_action( 'admin_head', 'banae_remove_all_admin_notices' );