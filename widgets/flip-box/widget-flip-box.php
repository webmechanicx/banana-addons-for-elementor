<?php
/**
 * Flip Box widget class
 *
 * @package Banana_Addons
 */

use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Banae_Flip_Box extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_flip_box';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Flip Box', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-flip-box';
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
		return [ 'flip', 'card', 'animated' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'banae-flip-box-style' ];
	}

	/**
	 * Dynamic Content.
	 *
	 * @return boolean
	 */
	protected function is_dynamic_content(): bool {
		return false;
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
		Banae_Flip_Box_Controls::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$wrapper_tag = 'div';
		$button_tag = 'a';
		$title_tag = Utils::validate_html_tag( $settings['title_tag'] );
		$description_tag = Utils::validate_html_tag( $settings['description_tag'] );
		$migration_allowed = Icons_Manager::is_migration_allowed();

		$this->add_render_attribute( 'button', 'class', [
			'banae-flip-box__button',
			'banana-button',
			'elementor-size-' . $settings['button_size'],
		] );

		$this->add_render_attribute( 'wrapper', 'class', 'banae-flip-box__layer banae-flip-box__back' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$link_element = 'button';

			if ( 'box' === $settings['link_click'] ) {
				$wrapper_tag = 'a';
				$button_tag = 'span';
				$link_element = 'wrapper';
			}

			$this->add_link_attributes( $link_element, $settings['link'] );
		}

		if ( 'icon' === $settings['media_element'] ) {
			$this->add_render_attribute( 'icon-wrapper', 'class', 'banae-icon-wrapper' );
			$this->add_render_attribute( 'icon-wrapper', 'class', 'banae-view-' . $settings['icon_view'] );
			if ( 'default' != $settings['icon_view'] ) {
				$this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-shape-' . $settings['icon_shape'] );
			}

			if ( ! isset( $settings['icon'] ) && ! $migration_allowed ) {
				// add old default
				$settings['icon'] = 'fa fa-star';
			}

			if ( ! empty( $settings['icon'] ) ) {
				$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			}
		}

		$has_icon = ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon'] );
		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && $migration_allowed;

		?>
<div class="banae-flip-box" tabindex="0">
    <div class="banae-flip-box__layer banae-flip-box__front">
        <div class="banae-flip-box__layer__overlay">
            <div class="banae-flip-box__layer__inner">
                <?php if ( 'image' === $settings['media_element'] && ! empty( $settings['image']['url'] ) ) : ?>
                <div class="banae-flip-box__image">
                    <?php Group_Control_Image_Size::print_attachment_image_html( $settings ); ?>
                </div>
                <?php elseif ( 'icon' === $settings['media_element'] && $has_icon ) : ?>
                <div <?php $this->print_render_attribute_string( 'icon-wrapper' ); ?>>
                    <div class="elementor-icon">
                        <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( ! empty( $settings['title_text_a'] ) ) : ?>
                <<?php Utils::print_validated_html_tag( $title_tag ); ?> class="banae-flip-box__layer__title">
                    <?php echo wp_kses_post( $settings['title_text_a'] ); ?>
                </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                <?php endif; ?>

                <?php if ( ! empty( $settings['description_text_a'] ) ) : ?>
                <<?php Utils::print_validated_html_tag( $description_tag ); ?>
                    class="banae-flip-box__layer__description">
                    <?php echo wp_kses_post( $settings['description_text_a'] ); ?>
                </<?php Utils::print_validated_html_tag( $description_tag ); ?>>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>
        <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
        <div class="banae-flip-box__layer__overlay">
            <div class="banae-flip-box__layer__inner">
                <?php if ( ! empty( $settings['title_text_b'] ) ) : ?>
                <<?php Utils::print_validated_html_tag( $title_tag ); ?> class="banae-flip-box__layer__title">
                    <?php echo wp_kses_post( $settings['title_text_b'] ); ?>
                </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                <?php endif; ?>

                <?php if ( ! empty( $settings['description_text_b'] ) ) : ?>
                <<?php Utils::print_validated_html_tag( $description_tag ); ?>
                    class="banae-flip-box__layer__description">
                    <?php echo wp_kses_post( $settings['description_text_b'] ); ?>
                </<?php Utils::print_validated_html_tag( $description_tag ); ?>>
                <?php endif; ?>

                <?php if ( ! empty( $settings['button_text'] ) ) : ?>
                <<?php Utils::print_validated_html_tag( $button_tag ); ?>
                    <?php $this->print_render_attribute_string( 'button' ); ?>>
                    <?php echo wp_kses_post( $settings['button_text'] ); ?>
                </<?php Utils::print_validated_html_tag( $button_tag ); ?>>
                <?php endif; ?>
            </div>
        </div>
    </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
</div>
<?php
	}

	/**
	 * Render Flip Box widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */
	protected function content_template() {
		?>
<# var btnClasses='banae-flip-box__button banana-button elementor-size-' + settings.button_size;
    if( 'image'===settings.media_element && '' !==settings.image.url ) { var image={ id: settings.image.id, url:
    settings.image.url, size: settings.image_size, dimension: settings.image_custom_dimension, model:
    view.getEditModel() }; var imageUrl=elementor.imagesManager.getImageUrl( image ); } var wrapperTag='div' ,
    buttonTag='a' , titleTag=elementor.helpers.validateHTMLTag( settings.title_tag ),
    descriptionTag=elementor.helpers.validateHTMLTag( settings.description_tag ); if ( 'box'===settings.link_click ) {
    wrapperTag='a' ; buttonTag='span' ; } if ( 'icon'===settings.media_element ) { var
    iconWrapperClasses='banae-icon-wrapper' ; iconWrapperClasses +=' banae-view-' + settings.icon_view; if ( 'default'
    !==settings.icon_view ) { iconWrapperClasses +=' elementor-shape-' + settings.icon_shape; } } var
    hasIcon=settings.icon || settings.selected_icon, iconHTML=elementor.helpers.renderIcon( view,
    settings.selected_icon, { 'aria-hidden' : true }, 'i' , 'object' ),
    migrated=elementor.helpers.isIconMigrated(settings, 'selected_icon' ); #>

    <div class="banae-flip-box" tabindex="0">
        <div class="banae-flip-box__layer banae-flip-box__front">
            <div class="banae-flip-box__layer__overlay">
                <div class="banae-flip-box__layer__inner">
                    <# if ( 'image'===settings.media_element && '' !==settings.image.url ) { #>
                        <div class="banae-flip-box__image">
                            <img src="{{ imageUrl }}">
                        </div>
                        <# } else if ( 'icon'===settings.media_element && hasIcon ) { #>
                            <div class="{{ iconWrapperClasses }}">
                                <div class="elementor-icon">
                                    <i class="{{ settings.icon }}"></i>
                                </div>
                            </div>
                            <# } #>

                                <# if ( settings.title_text_a ) { #>
                                    <{{ titleTag }} class="banae-flip-box__layer__title">{{ settings.title_text_a }}
                                    </{{ titleTag }}>
                                    <# } #>

                                        <# if ( settings.description_text_a ) { #>
                                            <{{ descriptionTag }} class="banae-flip-box__layer__description">{{
														settings.description_text_a }}</{{ descriptionTag }}>
                                            <# } #>
                </div>
            </div>
        </div>
        <{{ wrapperTag }} class="banae-flip-box__layer banae-flip-box__back">
            <div class="banae-flip-box__layer__overlay">
                <div class="banae-flip-box__layer__inner">
                    <# if ( settings.title_text_b ) { #>
                        <{{ titleTag }} class="banae-flip-box__layer__title">{{ settings.title_text_b }}</{{ titleTag
									}}>
                        <# } #>

                            <# if ( settings.description_text_b ) { #>
                                <{{ descriptionTag }} class="banae-flip-box__layer__description">{{
											settings.description_text_b }}</{{ descriptionTag }}>
                                <# } #>

                                    <# if ( settings.button_text ) { #>
                                        <{{ buttonTag }} href="#" class="{{ btnClasses }}">{{ settings.button_text }}
                                        </{{ buttonTag }}>
                                        <# } #>
                </div>
            </div>
        </{{ wrapperTag }}>
    </div>
    <?php
	}
}