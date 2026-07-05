<?php
/**
 * 
 * Plugin Theme Builder Class
 * 
 * @package Banana_Addons
 */
namespace Banana_Addons\Elementor\Theme_Builder;

use Banana_Addons\Elementor\Helper;

require_once __DIR__ . '/helper.php';

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Theme_Builder {

	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_filter( 'manage_banana_template_posts_columns', array( $this, 'setup_columns' ) );
		add_action( 'manage_banana_template_posts_custom_column', array( $this, 'render_columns' ), 10, 2 );

		// assets
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		add_action( 'wp_ajax_banana_create_template', array( $this, 'ajax_create_template' ) );
		add_action( 'restrict_manage_posts', array( $this, 'add_template_button' ) );
		add_action( 'wp_ajax_banana_get_template', array( $this, 'ajax_get_template' ) );
		add_filter( 'post_row_actions', array( $this, 'add_elementor_action' ), 10, 2 );

		// for tab setup:
		add_filter( 'views_edit-banana_template', array( $this, 'theme_builder_admin_tabs' ) );
		add_action( 'pre_get_posts', array( $this, 'filter_templates_by_type' ) );

		// Thirdparty theme loading
		add_action( 'wp', [ $this, 'load_theme_support' ] );
	}

	public function register_post_type() {
		register_post_type(
			'banana_template',
			array(
				'labels' => array(
					'name' => __( 'Banana Templates', 'banana-addons-for-elementor' ),
					'singular_name' => __( 'Banana Template', 'banana-addons-for-elementor' ),
					'add_new' => __( 'Add New', 'banana-addons-for-elementor' ),
					'add_new_item' => __( 'Add New Template', 'banana-addons-for-elementor' ),
					'edit_item' => __( 'Edit Template', 'banana-addons-for-elementor' ),
					'new_item' => __( 'New Template', 'banana-addons-for-elementor' ),
					'view_item' => __( 'View Template', 'banana-addons-for-elementor' ),
					'search_items' => __( 'Search Templates', 'banana-addons-for-elementor' ),
				),
				'public' => true,
				'has_archive' => true,
				'show_in_menu' => false,
				'show_in_nav_menus' => false,
				'capability_type' => 'page',
				'show_in_rest' => true,
				'exclude_from_search' => true,
				'hierarchical' => false,
				'supports' => array( 'title', 'elementor', 'editor' ),
				'rewrite' => array( 'slug' => 'banana-templates' ),
			)
		);
	}

	public function ajax_create_template() {

		check_ajax_referer( 'banana_template_nonce', 'nonce' );

		$post_id = isset($_POST['post_id']) ? sanitize_text_field( wp_unslash( $_POST['post_id'] ) ) : '';
		$title = isset($_POST['title']) ? sanitize_text_field( wp_unslash( $_POST['title'] ) ) : '';
		$type = isset($_POST['type']) ? sanitize_text_field( wp_unslash( $_POST['type'] ) ) : '';
		$conditions = isset($_POST['conditions']) ? sanitize_text_field( wp_unslash( $_POST['conditions'] ) ) : '';

		if ( $post_id ) {

			wp_update_post( array(
				'ID' => $post_id,
				'post_title' => $title
			) );

		} else {

			$post_id = wp_insert_post( array(
				'post_title' => $title,
				'post_type' => 'banana_template',
				'post_status' => 'publish'
			) );

		}

		if ( $post_id ) {

			update_post_meta( $post_id, '_banana_template_type', $type );
			update_post_meta( $post_id, '_banana_template_conditions', $conditions );
			update_post_meta( $post_id, '_wp_page_template', 'elementor_canvas' );

			wp_send_json_success();
		}

		wp_send_json_error();
	}

	public function ajax_get_template() {

		check_ajax_referer( 'banana_template_nonce', 'nonce' );

		$post_id = isset($_POST['post_id']) ? sanitize_text_field( wp_unslash( $_POST['post_id'] ) ) : '';

		$post = get_post( $post_id );

		if ( ! $post ) {
			wp_send_json_error();
		}

		$type = get_post_meta( $post_id, '_banana_template_type', true );
		$conditions = get_post_meta( $post_id, '_banana_template_conditions', true );

		wp_send_json_success( array(
			'title' => $post->post_title,
			'type' => $type,
			'condition' => $conditions
		) );
	}

	public function setup_columns( $columns ) {
		$columns = array(
			'cb' => $columns['cb'],
			'title' => __( 'Title', 'banana-addons-for-elementor' ),
			'type' => __( 'Type', 'banana-addons-for-elementor' ),
			'conditions' => __( 'Conditions', 'banana-addons-for-elementor' ),
			'date' => __( 'Date', 'banana-addons-for-elementor' ),
			'author' => __( 'Author', 'banana-addons-for-elementor' ),
		);
		return $columns;
	}

	public function render_columns( $column, $post_id ) {
		switch ( $column ) {
			case 'type':
				$type = get_post_meta( $post_id, '_banana_template_type', true );
				echo $type ? esc_html( ucfirst( $type ) ) : '—';
				break;
			case 'conditions':
				$conditions = get_post_meta( $post_id, '_banana_template_conditions', true );
				echo $conditions ? esc_html( $conditions ) : '—';
				break;
			case 'date':
				$date = get_post_meta( $post_id, '_banana_template_type', true );
				echo $date ? esc_html( ucfirst( $date ) ) : '—';
				break;
			case 'author':
				$author = get_post_meta( $post_id, '_banana_template_type', true );
				echo $author ? esc_html( ucfirst( $author ) ) : '—';
				break;
		}
	}

	public function theme_builder_admin_tabs() {
		global $post_type;

		$screen = get_current_screen();
		
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reading a query arg only to determine the active admin tab. No data is modified.
		if ( $post_type !== 'banana_template' || $screen->post_type !== 'banana_template' ) {
			return;
		}

		$current = 'all';
		
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reading a query arg only to determine the active admin tab. No data is modified.
		if ( isset( $_GET['template_type'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$current = sanitize_text_field( wp_unslash( $_GET['template_type'] ) );
		}

		$tabs = array(
			'all' => 'All',
			'header' => 'Header',
			'footer' => 'Footer',
			'single' => 'Single',
			'archive' => 'Archive',
		);

		echo '<div class="nav-tab-wrapper" style="margin-bottom:15px;">';

		foreach ( $tabs as $key => $label ) {

			$url = admin_url( 'edit.php?post_type=banana_template' );

			if ( $key !== 'all' ) {
				$url = add_query_arg( 'template_type', $key, $url );
			}

			$class = ( $current === $key ) ? 'nav-tab nav-tab-active' : 'nav-tab';

			echo '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $class ) . '">' . esc_attr( $label ) . '</a>';
		}

		echo '</div>';
	}

	public function filter_templates_by_type( $query ) {

		if ( ! is_admin() ) {
			return;
		}

		global $pagenow;

		if ( $pagenow !== 'edit.php' ) {
			return;
		}
		
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reading a query arg only to determine the active admin tab. No data is modified.
		if ( $query->get( 'post_type' ) !== 'banana_template' ) {
			return;
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reading a query arg only to determine the active admin tab. No data is modified.
		if ( empty( $_GET['template_type'] ) || sanitize_text_field( wp_unslash( $_GET['template_type'] ) ) === 'all' ) {
			return;
		}
		
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$query->set( 'meta_query', array(
			array(
				'key' => '_banana_template_type',
				'value' => sanitize_text_field( wp_unslash( $_GET['template_type'] ) ), // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			)
		) );
	}

	public function add_template_button() {

		global $post_type;

		if ( $post_type !== 'banana_template' ) {
			return;
		}

		// load template partials
		Helper::get_banae_template_part( 'includes/theme-builder/partials/modal' );
	}

	public function add_elementor_action( $actions, $post ) {

		if ( $post->post_type !== 'banana_template' ) {
			return $actions;
		}

		$url = admin_url( 'post.php?post=' . $post->ID . '&action=elementor' );

		$actions['edit_with_elementor'] = '<a href="' . esc_url( $url ) . '">' . __( 'Edit with Elementor', 'banana-addons-for-elementor' ) . '</a>';

		return $actions;
	}

	public function enqueue_admin_scripts( $hook ) {

		global $post_type;

		$screen = get_current_screen();

		if ( $post_type !== 'banana_template' || $screen->post_type !== 'banana_template' ) {
			return;
		}

		wp_enqueue_script(
			'banae-jquery-toast-plugin-js',
			BANANA_ADDONS_ASSETS . 'vendor/jquery-toast-plugin/js/jquery.toast.min.js',
			[ 'jquery' ],
			BANANA_ADDONS_VERSION,
			false
		);

		wp_enqueue_script(
			'banana-pro-theme-builder-js',
			BANANA_ADDONS_ASSETS . 'admin/js/theme-builder.min.js',
			array( 'jquery', 'banae-jquery-toast-plugin-js' ),
			BANANA_ADDONS_VERSION,
			true
		);

		wp_localize_script(
			'banana-pro-theme-builder-js',
			'banana_ajax',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'banana_template_nonce' ),
			)
		);

		wp_enqueue_style(
			'banana-pro-theme-builder-css',
			BANANA_ADDONS_ASSETS . 'admin/css/theme-builder.min.css',
			BANANA_ADDONS_VERSION
		);
	}

	public function load_theme_support() {

		$theme = get_template();

		$file = __DIR__ . "/themes/class-$theme.php";

		if ( file_exists( $file ) ) {

			require_once $file;

			$class = 'Banana_Theme_' . ucfirst( $theme );

			new $class;

		} else {

			require_once __DIR__ . '/themes/class-generic.php';

			new Themes\Banana_Theme_Generic();
		}
	}
}

new Theme_Builder();