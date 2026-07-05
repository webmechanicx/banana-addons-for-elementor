<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php
if ( isset( $settings['progress_items'] ) ) :
	foreach ( $settings['progress_items'] as $item ) :
		$percent = $item['progress_item_percent']['size'];

		?>
<div class="banae-progress-bar-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
    <h4 class="banae-progress-bar-title"><?php echo esc_html( $item['progress_item_name'] ); ?> </h4>
    <div class="<?php echo esc_html( $bar_class ); ?>" data-percent="<?php echo esc_html( $percent ); ?>">

        <div class="banae-bar-inner" data-target="<?php echo esc_html( $percent ); ?>">
            <span class="banae-percent"><?php echo esc_html( $percent ); ?>%</span>
        </div>

    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>