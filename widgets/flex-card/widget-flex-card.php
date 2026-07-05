<?php

use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Banae_Flex_Card extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_flex_card';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Flex Card', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-ehp-cta';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'banana-addons-category' ];
	}

	/**
	 * Get widget keywords for search
	 * 
	 * @return string[]
	 */
	public function get_keywords() {
		return [ 'card', 'info', 'badge', 'flex-box' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [
			'elementor-icons-fa-solid',
			'elementor-icons-fa-brands',
			'banae-flex-card-style',
		];
	}

	/**
	 * Enqueue dependend scripts
	 * 
	 * Retrieve the list of script dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_script_depends() {
		return [];
	}

	/**
	 * Register widget controls.
	 * 
	 * @access protected
	 */
	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Flex_Card_Controls::add_register_controls( $this );

	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'banae_card',
			[
				'class' => [
					'banae-flex-card-wrapper',
					esc_attr( $settings['card_content_alignment'] ),
					esc_attr( $settings['card_layout_type'] ),
					esc_attr( $settings['card_image_zoom_animation'] )
				]
			]
		);

		$this->add_render_attribute( 'card_title', 'class', 'banae-card-title' );
		$this->add_inline_editing_attributes( 'card_title', 'basic' );

		$this->add_render_attribute( 'card_sub_heading', 'class', 'banae-card-tag' );
		$this->add_inline_editing_attributes( 'card_sub_heading', 'basic' );

		$this->add_render_attribute( 'card_description', 'class', 'banae-card-description' );
		$this->add_inline_editing_attributes( 'card_description', 'basic' );

		$this->add_render_attribute( 'card_title_link', 'class', 'banae-card-link' );
		$this->add_inline_editing_attributes( 'card_button_text', 'none' );

		if ( $settings['card_title_link']['url'] ) {
			$this->add_render_attribute( 'card_title_link', 'href', esc_url( $settings['card_title_link']['url'] ) );
			if ( $settings['card_title_link']['is_external'] ) {
				$this->add_render_attribute( 'card_title_link', 'target', '_blank' );
			}
			if ( $settings['card_title_link']['nofollow'] ) {
				$this->add_render_attribute( 'card_title_link', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'card_button_link', 'class', 'banae-card-action' );
		if ( $settings['card_button_link']['url'] ) {
			$this->add_render_attribute( 'card_button_link', 'href', esc_url( $settings['card_button_link']['url'] ) );
			if ( $settings['card_button_link']['is_external'] ) {
				$this->add_render_attribute( 'card_button_link', 'target', '_blank' );
			}
			if ( $settings['card_button_link']['nofollow'] ) {
				$this->add_render_attribute( 'card_button_link', 'rel', 'nofollow' );
			}
		}

		?>

<div <?php $this->print_render_attribute_string( 'banae_card' ); ?>>
    <?php if ( $settings['card_image']['url'] || $settings['card_image']['id'] ) : ?>
    <div class="banae-card-thumb">
        <?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'card_image' ) ); ?>
    </div>
    <?php
			endif;

			if ( $settings['card_badge_switcher'] === 'yes' ) : ?>
    <div class="banae-card-badge">
        <?php echo esc_html( $settings['card_badge'] ); ?>
    </div>
    <?php
			endif;
			?>

    <div class="banae-card-body">
        <?php if ( $settings['card_title'] ) { ?>
        <a <?php $this->print_render_attribute_string( 'card_title_link' ); ?>>
            <<?php Utils::print_validated_html_tag( $settings['card_title_html_tag'] ); ?>
                <?php $this->print_render_attribute_string( 'card_title' ); ?>>
                <?php echo esc_html( $settings['card_title'] ); ?>
            </<?php Utils::print_validated_html_tag( $settings['card_title_html_tag'] ); ?>>
        </a>
        <?php
				}

				$settings['card_sub_heading'] ? printf( '<p ' . esc_attr( $this->get_render_attribute_string( 'card_sub_heading' ) ) . '>%s</p>', esc_html( $settings['card_sub_heading'] ) ) : '';

				$settings['card_description'] ? printf( '<div ' . esc_attr( $this->get_render_attribute_string( 'card_description' ) ) . '>%s</div>', esc_html( $settings['card_description'] ) ) : '';

				if ( ! empty( $settings['card_button_text'] ) ) : ?>
        <a <?php $this->print_render_attribute_string( 'card_button_link' ); ?>>
            <?php if ( 'icon_pos_left' === $settings['card_button_link_icon_position'] && ! empty( $settings['card_button_link_icon']['value'] ) ) { ?>
            <span class="<?php echo esc_attr( $settings['card_button_link_icon_position'] ); ?>">
                <i aria-hidden="true"
                    class="<?php echo esc_attr( $settings['card_button_link_icon']['value'] ); ?>"></i>
            </span>
            <?php
						}
						?>

            <span <?php $this->print_render_attribute_string( 'card_button_text' ); ?>>
                <?php echo esc_html( $settings['card_button_text'] ); ?>
            </span>

            <?php
						if ( 'icon_pos_right' === $settings['card_button_link_icon_position'] && ! empty( $settings['card_button_link_icon']['value'] ) ) { ?>
            <span class="<?php echo esc_attr( $settings['card_button_link_icon_position'] ); ?>">
                <i aria-hidden="true"
                    class="<?php echo esc_attr( $settings['card_button_link_icon']['value'] ); ?>"></i>
            </span>
            <?php } ?>
        </a>
        <?php endif; ?>
    </div>
</div>
<?php

	}

	/**
	 * Render card widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>
<# view.addRenderAttribute( 'banae_card' , { 'class' : [ 'banae-flex-card-wrapper' , settings.card_content_alignment,
    settings.card_layout_type, settings.card_image_zoom_animation ] } ); if ( settings.card_image.url ||
    settings.card_image.id ) { var image={ id: settings.card_image.id, url: settings.card_image.url, size:
    settings.thumbnail_size, dimension: settings.thumbnail_custom_dimension, class: 'banae-card-img' , model:
    view.getEditModel() }; var image_url=_.escape( elementor.imagesManager.getImageUrl( image ) ); }
    view.addRenderAttribute( 'card_title_link' , 'class' , 'banae-card-link' ); view.addRenderAttribute( 'card_title'
    , 'class' , 'banae-card-title' ); view.addInlineEditingAttributes( 'card_title' , 'basic' );
    view.addRenderAttribute( 'card_sub_heading' , 'class' , 'banae-card-tag' );
    view.addInlineEditingAttributes( 'card_sub_heading' , 'basic' ); view.addRenderAttribute( 'card_description'
    , 'class' , 'banae-card-description' ); view.addInlineEditingAttributes( 'card_description' , 'basic' );
    view.addRenderAttribute( 'card_button_link' , 'class' , 'banae-card-action' );
    view.addInlineEditingAttributes( 'card_button_text' , 'none' ); var target=settings.card_button_link.is_external
    ? ' target="_blank"' : '' ; var nofollow=settings.card_button_link.nofollow ? ' rel="nofollow"' : '' ; var
    iconHTML=elementor.helpers.renderIcon( view, settings.card_button_link_icon, { 'aria-hidden' : true }, 'i'
    , 'object' ); var titleHTMLTag=elementor.helpers.validateHTMLTag( settings.card_title_html_tag ); #>
    <div {{{ view.getRenderAttributeString( 'banae_card' ) }}}>
        <# if ( image_url ) { #>
            <div class="banae-card-thumb">
                <img src="{{{ image_url }}}">
            </div>
            <# } #>

                <# if( settings.card_badge_switcher==='yes' ) { #>
                    <div class="banae-card-badge">
                        {{{ _.escape( settings.card_badge ) }}}
                    </div>
                    <# } #>

                        <div class="banae-card-body">
                            <# if ( settings.card_title ) { #>
                                <a href="{{{ settings.card_title_link.url }}}" {{{
													view.getRenderAttributeString( 'card_title_link' ) }}}>
                                    <{{{ titleHTMLTag }}} {{{ view.getRenderAttributeString( 'card_title' ) }}}>
                                        {{{ settings.card_title }}}
                                    </{{{ titleHTMLTag }}}>
                                </a>
                                <# } #>

                                    <# if ( settings.card_sub_heading ) { #>
                                        <p {{{ view.getRenderAttributeString( 'card_sub_heading' ) }}}>
                                            {{{ settings.card_sub_heading }}}
                                        </p>
                                        <# } #>

                                            <# if ( settings.card_description ) { #>
                                                <p {{{ view.getRenderAttributeString( 'card_description' ) }}}>
                                                    {{{ settings.card_description }}}
                                                </p>
                                                <# } #>

                                                    <# if ( settings.card_button_text ) { #>
                                                        <a href="{{{ settings.card_button_link.url }}}" {{{
																			view.getRenderAttributeString( 'card_button_link' ) }}}{{{
																			target }}}{{{ nofollow }}}>
                                                            <# if
                                                                ( 'icon_pos_left'===settings.card_button_link_icon_position
                                                                && iconHTML.value ) { #>
                                                                <span
                                                                    class="{{{ _.escape( settings.card_button_link_icon_position ) }}}">
                                                                    <i aria-hidden="true"
                                                                        class="{{{ settings.card_button_link_icon.value }}}">
                                                                    </i>
                                                                </span>
                                                                <# } #>
                                                                    <span {{{
																						view.getRenderAttributeString( 'card_button_text'
																						) }}}>
                                                                        {{{ settings.card_button_text }}}
                                                                    </span>
                                                                    <# if
                                                                        ( 'icon_pos_right'===settings.card_button_link_icon_position
                                                                        && iconHTML.value ) { #>
                                                                        <span
                                                                            class="{{{ _.escape( settings.card_button_link_icon_position ) }}}">
                                                                            <i aria-hidden="true"
                                                                                class="{{{ settings.card_button_link_icon.value }}}">
                                                                            </i>
                                                                        </span>
                                                                        <# } #>
                                                        </a>
                                                        <# } #>
                        </div>
    </div>
    <?php
	}

}