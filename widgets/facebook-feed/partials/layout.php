<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<div class="banae-facebook-feed__wrapper"
    style="grid-template-columns: repeat(<?php echo esc_attr( $settings['facebook_feed_columns'] ?? 3 ); ?>, 1fr);">

    <?php

	$feed_data = ( isset( $facebook_feed_data['data'] ) && $facebook_feed_data['data'] ) ? $facebook_feed_data['data'] : [];

	if ( isset( $facebook_feed_data['error'] ) ) {

		echo sprintf( '<div class="banae-alert banae-error">%1$s</div>', esc_attr( $facebook_feed_data['error']['message'] ) );
		return '';
	}

	// Calculate column width (100% / number of columns)
	//$column_width = ( ! empty( $settings['facebook_feed_columns'] ) ) ? 100 / esc_attr( $settings['facebook_feed_columns'] ) : 100 / 3;

	foreach ( $feed_data as $item ) {
		$page_url = "https://facebook.com/{$item['from']['id']}";
		$user_name = $item['from']['name'] ?? '';
		$user_avatar_url = $item['from']['picture']['data']['url'] ?? '';
		$image = $item['full_picture'] ?? '';
		$title = $item['attachments']['data'][0]['title'] ?? 'No Title';
		$message = $item['message'] ?? '';
		$link = $item['permalink_url'] ?? '#';
		//$created = date( "F j, Y", strtotime( $item['created_time'] ) );
        $created = gmdate( 'F j, Y', strtotime( $item['created_time'] ) );

		$comment_count = $item['comments']['summary']['total_count'] ?? 0;
		$reaction_count = $item['reactions']['summary']['total_count'] ?? 0;
		$share_count = $item['shares']['count'] ?? 0;

		// some settings
		$has_image_link = $settings['has_feed_image_link'] ?? '';

		// check whether full content
		if ( $settings['show_feed_full_content'] !== 'yes' ) {
			$message = wp_trim_words( $message, $settings['facebook_feed_excerpt'], '...' );
		}

		// Extract #hash tags from content
		$has_hash_tag = ( $message ) ? preg_match_all( '/#(\w+)/', $message, $matches ) : [];

		if ( $has_hash_tag ) {

			//$pattern = '/#\w+\b/i'; 
			$pattern = '/#(\w+)/u';

			// Replace each hashtag with a clickable link
			$replacement = '<a href="https://facebook.com/hashtag/$1" target="_blank">#$1</a>';
			$message = preg_replace( $pattern, $replacement, $message );
		}

		?>

    <div class="banae-facebook-feed__card">

        <?php if ( $settings['show_feed_thumbnail'] === 'yes' ) : ?>

        <?php if ( $has_image_link === 'yes' ) : ?>
        <a href="<?php echo esc_url( $link ); ?>" target="_blank">
            <?php endif; ?>

            <img class="banae-facebook-feed-img__top" src="<?php echo esc_attr( $image ); ?>" alt="Post image">

            <?php if ( $has_image_link === 'yes' ) : ?>
        </a>
        <?php endif; ?>

        <?php endif; ?>

        <div class="banae-facebook-feed__card-body">

            <?php if ( $settings['show_feed_title'] === 'yes' ) : ?>
            <h4 class="banae-facebook-feed__card-title"><?php echo esc_html( $title ); ?></h4>
            <?php endif; ?>

            <?php if ( $settings['show_feed_content'] === 'yes' ) : ?>
            <p><?php echo wp_kses_post( $message ); ?></p>
            <?php endif; ?>

        </div>

        <?php if ( $settings['show_feed_footer'] === 'yes' ) : ?>
        <div class="banae-facebook-feed__card-footer">
            <div class="banae-feed-card-meta">

                <?php if ( $settings['show_feed_user_info'] === 'yes' ) : ?>
                <div class="banae-feed-user">
                    <img src="<?php echo esc_url( $user_avatar_url ); ?>" alt="user">
                    <div class="banae-feed-user__info">
                        <h5><?php echo esc_html( $user_name ); ?></h5>
                        <small class="created_at"><?php echo esc_html( $created ); ?></small>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $settings['show_feed_reactions'] === 'yes' ) : ?>
                <ul class="banae-feed-engagement__meta">
                    <li>
                        <span class="far fa-heart"></span>
                        <span><?php echo esc_html( $reaction_count ); ?></span>
                    </li>
                    <li>
                        <span class="far fa-comment"></span>
                        <span><?php echo esc_html( $comment_count ); ?></span>
                    </li>
                </ul>
                <?php endif; ?>

            </div>
        </div>
        <?php endif; ?>

    </div>

    <?php
	}

	?>

</div>