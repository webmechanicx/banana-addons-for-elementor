<?php
/**
 * Banana_Clone extension class
 *
 * @package Banana_Addons
 */
namespace Banana_Addons\Elementor\Extensions;

defined( 'ABSPATH' ) || die();

use Elementor\Core\Files\CSS\Post as Post_CSS;

class Banana_Clone {

	/**
	 * Post status flags
	 * 
	 * @var array
	 */
	protected static $post_status_flags = [ 'private', 'draft' ];

	/**
	 * Check if current user and post author are same
	 *
	 * @param int $post_id
	 * @return boolean
	 */
	public static function is_match_author( $post_id ) {
		$author_id = get_post_field( 'post_author', $post_id );
		return ( get_current_user_id() == $author_id );
	}

	/**
	 * Add Clone link in post row actions
	 * 
	 * @param mixed $actions
	 * @param \WP_Post $post
	 * 
	 * @return array
	 */
	public static function add_clone_link( $actions, $post ) {

		// Check if current user can clone
		if ( current_user_can( 'edit_posts', $post->ID ) && post_type_supports( $post->post_type, 'elementor' ) ) {

			// prepare the link with _nonce
			$url = wp_nonce_url(
				add_query_arg(
					[
						'action' => 'banae_clone_post',
						'post_id' => $post->ID,
					],
					admin_url( 'admin.php' )
				),
				'banae_clone_post_' . $post->ID
			);

			// prepare action links
			$actions['clone_post'] = sprintf(
				'<a href="%1$s" title="%2$s"><span class="screen-reader-text">%2$s</span>%3$s</a>',
				esc_url( $url ),
				sprintf( 'Clone - %s', esc_attr( $post->post_title ) ),
				esc_html__( 'Banana Clone', 'banana-addons-for-elementor' )
			);

		}

		return $actions;
	}

	/**
	 * Clone post
	 *
	 * @param $old_post
	 * 
	 * @return int $post_id
	 */
	protected static function do_clone_post( $old_post ) {

		$cloned_data = [
			'post_status' => 'draft',
			'to_ping' => $old_post->to_ping,
			'post_type' => $old_post->post_type,
			'menu_order' => $old_post->menu_order,
			'post_author' => get_current_user_id(),
			'post_parent' => $old_post->post_parent,
			'ping_status' => $old_post->ping_status,
			'post_excerpt' => $old_post->post_excerpt,
			'post_content' => $old_post->post_content,
			'post_password' => $old_post->post_password,
			'comment_status' => $old_post->comment_status,
			'post_title' => sprintf( '%s - [Cloned #%d]', $old_post->post_title, $old_post->ID ),
		];

		// return new post id
		return wp_insert_post( $cloned_data );
	}

	/**
	 * Copy post meta entries to cloned post
	 *
	 * @param $post
	 * @param $new_post_id
	 */
	protected static function copy_meta_entries( $post, $new_post_id ) {

		global $wpdb;

		$meta = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id = %d",
				$post->ID
			)
		);

		if ( $meta ) {
			foreach ( $meta as $meta_info ) {
				add_post_meta(
					$new_post_id,
					$meta_info->meta_key,
					maybe_unserialize( $meta_info->meta_value )
				);
			}

			// Fix wrong template type issue
			$source_type = get_post_meta( $post->ID, '_elementor_template_type', true );
			delete_post_meta( $new_post_id, '_elementor_template_type' );
			update_post_meta( $new_post_id, '_elementor_template_type', $source_type );
		}
	}

	/**
	 * Clone or duplicate the current post
	 * 
	 * @return void
	 */
	public static function banae_clone_post() {

		$nonce = '';

		if ( isset( $_GET['_wpnonce'] ) ) {
			$nonce = sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) );
		}

		$post_id = isset( $_GET['post_id'] ) ? absint( wp_unslash( $_GET['post_id'] ) ) : 0;

		// check if not available
		if ( ! $post_id ) {
			wp_die( esc_html( __( 'No post to clone.', 'banana-addons-for-elementor' ) ) );
		}

		// check the permissions of current login user
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $nonce, 'banae_clone_post_' . $post_id ) ) {
			wp_die( esc_html( __( 'Security check failed', 'banana-addons-for-elementor' ) ) );
		}

		// get the current post
		$post = get_post( $post_id );

		if ( ! $post ) {
			wp_die( esc_html( __( 'Post not found', 'banana-addons-for-elementor' ) ) );
		}

		// retrive current post status, type and match author
		$post_status = get_post_status( $post_id );
		$post_type = get_post_type( $post_id );
		$match_author = self::is_match_author( $post_id );

		// check post status
		if ( ( in_array( $post_status, self::$post_status_flags ) ) && ! $match_author ) {
			wp_die( esc_html( __( 'Sorry, you are not allowed to clone this item.', 'banana-addons-for-elementor' ) ) );
		}

		// check if password protected post
		if ( post_password_required( $post_id ) && ! $match_author ) {
			wp_die( esc_html( __( 'Sorry, you are not allowed to clone this item.', 'banana-addons-for-elementor' ) ) );
		}

		// sanitize and escape current post
		$post = sanitize_post( $post, 'db' );
		$new_post_id = self::do_clone_post( $post );

		// check any error occurs
		if ( ! is_wp_error( $new_post_id ) ) {

			// Copy taxonomies
			$taxonomies = get_object_taxonomies( $post->post_type );
			if ( $taxonomies ) {
				foreach ( $taxonomies as $taxonomy ) {
					$terms = wp_get_object_terms( $post->ID, $taxonomy, [ 'fields' => 'slugs' ] );
					wp_set_object_terms( $new_post_id, $terms, $taxonomy, false );
				}
			}

			// copy meta data
			self::copy_meta_entries( $post, $new_post_id );

			// Generate/update the CSS file if needed
			$css = Post_CSS::create( $new_post_id );
			$css->update();

			// Enqueue the CSS on the front end
			$css->enqueue();

		}

		if ( $post_type === 'page' ) {
			$redirect = admin_url( 'edit.php?post_type=page' );
		} else {
			$redirect = admin_url( 'edit.php' );
		}

		// Redirect to post_type screen
		wp_safe_redirect( $redirect );
		exit;
	}

}