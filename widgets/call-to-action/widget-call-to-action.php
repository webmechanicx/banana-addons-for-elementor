<?php
if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;

class Banae_Call_To_Action extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_call_to_action';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Call to Action', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image-rollover';
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
		return [ 'call to action', 'cta', 'button' ];
	}

	protected function is_dynamic_content(): bool {
		return false;
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends(): array {
		return [ 'banae-cta-style', 'banae-cta-transition-style' ];
	}

	protected function register_controls() {
		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Call_To_Action::add_register_controls( $this );
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		$wrapper_tag = 'div';
		$button_tag = 'a';
		$title_tag = Utils::validate_html_tag( $settings['title_tag'] );
		$cta_bg_image = '';
		$content_animation = $settings['content_animation'];
		$animation_class = '';
		$print_bg = true;
		$print_content = true;

		if ( ! empty( $settings['cta_bg_image']['id'] ) ) {
			$cta_bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['cta_bg_image']['id'], 'cta_bg_image', $settings );
		} elseif ( ! empty( $settings['cta_bg_image']['url'] ) ) {
			$cta_bg_image = $settings['cta_bg_image']['url'];
		}

		if ( empty( $cta_bg_image ) && 'classic' == $settings['skin'] ) {
			$print_bg = false;
		}

		if ( empty( $settings['title'] ) && empty( $settings['description'] ) && empty( $settings['button'] ) && 'none' == $settings['media_element'] ) {
			$print_content = false;
		}

		$this->add_render_attribute( 'wrapper', 'class', 'banae-cta' );

		$this->add_render_attribute(
			'background_image',
			[
				'style' => 'background-image: url(' . esc_url( $cta_bg_image ) . ');',
				'role' => 'img',
				'aria-label' => Control_Media::get_image_alt( $settings['cta_bg_image'] ),
			]
		);

		$this->add_render_attribute( 'title', 'class', [
			'banae-cta__title',
			'banae-cta__content-item',
		] );

		$this->add_render_attribute( 'description', 'class', [
			'banae-cta__description',
			'banae-cta__content-item',
		] );

		$this->add_render_attribute( 'button', 'class', [
			'banae-cta__button',
			'banana-button'
		] );

		$this->add_render_attribute( 'media_element', 'class', 'banae-cta__content-item' );

		if ( 'icon' === $settings['media_element'] ) {
			$this->add_render_attribute( 'media_element', 'class',
				[
					'elementor-icon-wrapper',
					'banae-cta__icon',
				]
			);

			$this->add_render_attribute( 'media_element', 'class', 'elementor-view-' . $settings['icon_view'] );

			if ( 'default' != $settings['icon_view'] ) {
				$this->add_render_attribute( 'media_element', 'class', 'elementor-shape-' . $settings['icon_shape'] );
			}

			if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
				// add old default
				$settings['icon'] = 'fa fa-star';
			}

			if ( ! empty( $settings['icon'] ) ) {
				$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			}

		} elseif ( 'image' === $settings['media_element'] && ! empty( $settings['graphic_image']['url'] ) ) {
			$this->add_render_attribute( 'media_element', 'class', 'banae-cta__image' );
		}

		if ( ! empty( $content_animation ) && 'cover' == $settings['skin'] ) {

			$animation_class = 'banana-animated-item--' . $content_animation;

			$this->add_render_attribute( 'title', 'class', $animation_class );

			$this->add_render_attribute( 'media_element', 'class', $animation_class );

			$this->add_render_attribute( 'description', 'class', $animation_class );

		}

		if ( ! empty( $settings['link']['url'] ) ) {
			$link_element = 'button';

			if ( 'container' === $settings['link_type'] ) {
				$wrapper_tag = 'a';
				$button_tag = 'span';
				$link_element = 'wrapper';
			}

			$this->add_link_attributes( $link_element, $settings['link'] );
		}

		$this->add_inline_editing_attributes( 'title' );
		$this->add_inline_editing_attributes( 'description' );
		$this->add_inline_editing_attributes( 'button' );

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );

		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		?>
<<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

    <?php if ( $print_bg ) : ?>
    <div class="banae-cta__bg-wrapper">
        <div class="banae-cta__bg elementor-bg" <?php $this->print_render_attribute_string( 'background_image' ); ?>>
        </div>
        <div class="banae-cta__bg-overlay"></div>
    </div>
    <?php endif; ?>

    <?php if ( $print_content ) : ?>
    <div class="banae-cta__content">

        <?php if ( 'image' === $settings['media_element'] && ! empty( $settings['graphic_image']['url'] ) ) : ?>
        <div <?php $this->print_render_attribute_string( 'media_element' ); ?>>
            <?php Group_Control_Image_Size::print_attachment_image_html( $settings, 'graphic_image' ); ?>
        </div>
        <?php endif; ?>

        <?php if ( 'icon' === $settings['media_element'] && ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon'] ) ) ) : ?>
        <div <?php $this->print_render_attribute_string( 'media_element' ); ?>>
            <div class="elementor-icon">
                <?php if ( $is_new || $migrated ) :
									Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
								else : ?>
                <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if ( ! empty( $settings['title'] ) ) : ?>
        <<?php Utils::print_validated_html_tag( $title_tag ); ?>
            <?php $this->print_render_attribute_string( 'title' ); ?>>
            <?php echo wp_kses_post( $settings['title'] ); ?>
        </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
        <?php endif; ?>

        <?php if ( ! empty( $settings['description'] ) ) : ?>
        <div <?php $this->print_render_attribute_string( 'description' ); ?>>
            <?php echo wp_kses_post( $settings['description'] ); ?>
        </div>
        <?php endif; ?>

        <?php if ( $settings['show_button'] === 'yes' && ! empty( $settings['button'] ) ) : ?>
        <div class="banae-cta__button-wrapper banae-cta__content-item <?php echo esc_attr( $animation_class ); ?>">
            <<?php Utils::print_validated_html_tag( $button_tag ); ?>
                <?php $this->print_render_attribute_string( 'button' ); ?>>
                <?php echo wp_kses_post( $settings['button'] ); ?>
            </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php
			if ( ! empty( $settings['ribbon_title'] ) ) :
				$this->add_render_attribute( 'ribbon-wrapper', 'class', 'banae-ribbon' );

				if ( ! empty( $settings['ribbon_horizontal_position'] ) ) :
					$this->add_render_attribute( 'ribbon-wrapper', 'class', 'banae-ribbon-' . $settings['ribbon_horizontal_position'] );
				endif;

				$this->add_render_attribute( 'ribbon_title', 'class', 'banae-ribbon-inner' );
				$this->add_inline_editing_attributes( 'ribbon_title' );
				?>
    <div <?php $this->print_render_attribute_string( 'ribbon-wrapper' ); ?>>
        <div <?php $this->print_render_attribute_string( 'ribbon_title' ); ?>>
            <?php echo wp_kses_post( $settings['ribbon_title'] ); ?>
        </div>
    </div>
    <?php endif; ?>
</<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
<?php
	}

	protected function content_template() {
		?>
<# var wrapperTag='div' , buttonTag='a' , titleTag=elementor.helpers.validateHTMLTag( settings.title_tag ),
    contentAnimation=settings.content_animation, animationClass, printBg=true, printContent=true,
    iconHTML=elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden' : true }, 'i' , 'object' ),
    migrated=elementor.helpers.isIconMigrated( settings, 'selected_icon' ); if ( 'container'===settings.link_type ) {
    wrapperTag='a' ; buttonTag='span' ; view.addRenderAttribute( 'wrapper' , 'href' , '#' ); } if ( ''
    !==settings.cta_bg_image.url ) { var cta_bg_image={ id: settings.cta_bg_image.id, url: settings.cta_bg_image.url,
    size: settings.cta_bg_image_size, dimension: settings.cta_bg_image_custom_dimension, model: view.getEditModel() };
    var bgImageUrl=elementor.imagesManager.getImageUrl( cta_bg_image ); } if ( ! cta_bg_image
    && 'classic'==settings.skin ) { printBg=false; } if ( ! settings.title && ! settings.description && !
    settings.button && 'none'==settings.media_element ) { printContent=false; } if ( 'icon'===settings.media_element ) {
    var iconWrapperClasses='elementor-icon-wrapper' ; iconWrapperClasses +=' banae-cta__image' ; iconWrapperClasses
    +=' elementor-view-' + settings.icon_view; if ( 'default' !==settings.icon_view ) { iconWrapperClasses
    +=' elementor-shape-' + settings.icon_shape; } view.addRenderAttribute( 'media_element' , 'class' ,
    iconWrapperClasses ); } else if ( 'image'===settings.media_element && '' !==settings.graphic_image.url ) { var
    image={ id: settings.graphic_image.id, url: settings.graphic_image.url, size: settings.graphic_image_size,
    dimension: settings.graphic_image_custom_dimension, model: view.getEditModel() }; var
    imageUrl=elementor.imagesManager.getImageUrl( image ); view.addRenderAttribute( 'media_element' , 'class'
    , 'banae-cta__image' ); } if ( contentAnimation && 'cover'===settings.skin ) { var
    animationClass='banana-animated-item--' + contentAnimation; view.addRenderAttribute( 'title' , 'class' ,
    animationClass ); view.addRenderAttribute( 'description' , 'class' , animationClass );
    view.addRenderAttribute( 'media_element' , 'class' , animationClass ); } view.addRenderAttribute( 'background_image'
    , { 'style' : 'background-image: url(' + bgImageUrl + ');' , 'role' : 'img' , 'aria-label' : '' , } );
    view.addRenderAttribute( 'title' , 'class' , [ 'banae-cta__title' , 'banae-cta__content-item' ] );
    view.addRenderAttribute( 'description' , 'class' , [ 'banae-cta__description' , 'banae-cta__content-item' ] );
    view.addRenderAttribute( 'button' , 'class' , [ 'banae-cta__button' , 'banana-button' ] );
    view.addRenderAttribute( 'media_element' , 'class' , [ 'banae-cta__content-item' ] );
    view.addInlineEditingAttributes( 'title' ); view.addInlineEditingAttributes( 'description' );
    view.addInlineEditingAttributes( 'button' ); #>

    <{{ wrapperTag }} class="banae-cta" {{{ view.getRenderAttributeString( 'wrapper' ) }}}>

        <# if ( printBg ) { #>
            <div class="banae-cta__bg-wrapper">
                <div class="banae-cta__bg elementor-bg" {{{ view.getRenderAttributeString( 'background_image' ) }}}>
                </div>
                <div class="banae-cta__bg-overlay"></div>
            </div>
            <# } #>
                <# if ( printContent ) { #>
                    <div class="banae-cta__content">

                        <# if ( 'image'===settings.media_element && '' !==settings.graphic_image.url ) { #>
                            <div {{{ view.getRenderAttributeString( 'media_element' ) }}}>
                                <img src="{{ imageUrl }}">
                            </div>
                            <# } #>

                                <# if ( 'icon'===settings.media_element && ( settings.icon || settings.selected_icon ) )
                                    { #>
                                    <div {{{ view.getRenderAttributeString( 'media_element' ) }}}>
                                        <div class="elementor-icon">
                                            <# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) {
                                                #>
                                                {{{ iconHTML.value }}}
                                                <# } else { #>
                                                    <i class="{{ settings.icon }}"></i>
                                                    <# } #>
                                        </div>
                                    </div>
                                    <# } #>

                                        <# if ( settings.title ) { #>
                                            <{{ titleTag }} {{{ view.getRenderAttributeString( 'title' ) }}}>{{
														settings.title }}</{{ titleTag }}>
                                            <# } #>

                                                <# if ( settings.description ) { #>
                                                    <div {{{ view.getRenderAttributeString( 'description' ) }}}>{{
																settings.description }}</div>
                                                    <# } #>

                                                        <# if ( settings.show_button==='yes' && settings.button ) { #>
                                                            <div
                                                                class="banae-cta__button-wrapper banae-cta__content-item {{ animationClass }}">
                                                                <{{ buttonTag }} href="#" {{{
																			view.getRenderAttributeString( 'button' ) }}}>{{
																			settings.button }}</{{ buttonTag }}>
                                                            </div>
                                                            <# } #>
                    </div>
                    <# } #>
                        <# if ( settings.ribbon_title ) { view.addRenderAttribute( 'ribbon' , 'class' , 'banae-ribbon'
                            ); if ( settings.ribbon_horizontal_position ) { view.addRenderAttribute( 'ribbon' , 'class'
                            , 'banae-ribbon-' + settings.ribbon_horizontal_position ); }
                            view.addRenderAttribute( 'ribbon_title' , 'class' , 'banae-ribbon-inner' );
                            view.addInlineEditingAttributes( 'ribbon_title' ); #>
                            <div {{{ view.getRenderAttributeString( 'ribbon' ) }}}>
                                <div {{{ view.getRenderAttributeString( 'ribbon_title' ) }}}>{{ settings.ribbon_title }}
                                </div>
                            </div>
                            <# } #>
    </{{ wrapperTag }}>
    <?php
	}

}