<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div class="banae-admin-widget-filter">
    <div class="banae-admin-widget-filter__left">
        <!-- Radio Buttons -->
        <div class="banae-filter-widget__label">
            <label for="">Sort by:</label>
        </div>
        <div class="banae-filter-widget__input">
            <input type="radio" id="all" name="filter" value="all" checked>
            <label for="all">All</label>
        </div>
        <div class="banae-filter-widget__input">
            <input type="radio" id="free" name="filter" value="free">
            <label for="free">Free</label>
        </div>
        <div class="banae-filter-widget__input">
            <input type="radio" id="pro" name="filter" value="pro">
            <label for="pro">Pro</label>
        </div>
    </div>
    <div class="banae-admin-widget-filter__right">
        <!-- Radio Group -->
        <div class="banae-filter-widget__input">
            <input type="radio" name="action" id="checkAll">
            <label for="checkAll">Enable All</label>
        </div>
        <div class="banae-filter-widget__input">
            <input type="radio" name="action" id="uncheckAll">
            <label for="uncheckAll">Disable All</label>
        </div>
    </div>
</div>
<?php if ( $banae_widget_options ) : ?>
<ul class="banae-cards">
    <?php foreach ( $banae_widget_options as $key => $label ) : ?>
    <li class="banae-card" data-type="<?php echo esc_html( $label['tags'] ); ?>">
        <div class="banae-card__img">
            <div class="banae-img__cover" style="background-color:<?php echo esc_attr( $label['background'] ); ?>;">
                <span class="banae-card__badge badge-<?php echo esc_attr( $label['tags'] ); ?>"
                    style="background-color:<?php echo esc_attr( $label['background'] ); ?>;"><?php echo esc_html( ucfirst( $label['tags'] ) ); ?></span>
                <img src="<?php echo esc_html( BANANA_ADDONS_ASSETS ) . 'admin/img/screenshots/' . esc_html( $label['screenshot'] ); ?>"
                    alt="<?php echo esc_html( $label['title'] ); ?>" />
            </div>
        </div>
        <div class="banae-card__text flow">
            <div class="banae-card-header">
                <h4><?php echo isset( $label['title'] ) ? esc_html( $label['title'] ) : esc_html( $label ); ?></h4>
                <label class="banae-switch-wrapper">
                    <input type="checkbox" name="<?php echo esc_attr( $key ); ?>" value="1"
                        <?php ucfirst( $label['tags'] ) === BANANA_ADDONS_VERSION_TYPE ? checked( ! empty( $options[ $key ] ) ) : ''; ?>
                        <?php echo ucfirst( $label['tags'] ) === BANANA_ADDONS_VERSION_TYPE ? '' : 'disabled'; ?>>
                    <span class="banae-slider banae-round"
                        title="<?php echo ucfirst( $label['tags'] ) !== BANANA_ADDONS_VERSION_TYPE ? esc_attr( __( "Available only in Pro Version!", 'banana-addons-for-elementor' ) ) : ''; ?>"></span>
                </label>
            </div>
            <div class=" banae-card-body">
                <p><?php echo isset( $label['description'] ) ? esc_html( $label['description'] ) : esc_html( $label ); ?>
                </p>
            </div>
            <div class="banae-card-footer">
                <a class="button" href="<?php echo esc_attr( $label['doc_link'] ); ?>" target="_blank">Documentation</a>
                <a class="button" href="<?php echo esc_attr( $label['demo_link'] ); ?>" target="_blank">Demo</a>
            </div>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>