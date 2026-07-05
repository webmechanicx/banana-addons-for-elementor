<?php
if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

class Banae_Info_Card extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_info_card';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Info Card', 'banana-addons-for-elementor' );
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
		return [ 'info', 'card', 'box', 'content' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'swiper', 'banae-info-card-style' ];
	}

	protected function is_dynamic_content(): bool {
		return false;
	}

	/**
	 * Register widget content controls
	 */
	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Info_Card_Controls::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'banae-info-card-title' );

		$this->add_inline_editing_attributes( 'description', 'intermediate' );
		$this->add_render_attribute( 'description', 'class', 'banae-info-card-text' );

		?>

<div class="banae-info-card-wrapper">

    <?php if ( $settings['media_type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) : ?>
    <figure class="banae-info-card-figure banae-info-card-figure--image">
        <?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) ); ?>
    </figure>
    <?php elseif ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
    <figure class="banae-info-card-figure banae-info-card-figure--icon">
        <?php Icons_Manager::render_icon( $settings['selected_icon'] ); ?>
    </figure>
    <?php endif; ?>

    <div class="banae-info-card-body">
        <?php
				if ( $settings['title'] ) :
					printf( '<%1$s %2$s>%3$s</%1$s>',
						esc_attr( $settings['title_tag'] ),
						esc_attr( $this->get_render_attribute_string( 'title' ) ),
						esc_html( $settings['title'] )
					);
				endif;
				?>

        <?php if ( $settings['description'] ) : ?>
        <div <?php $this->print_render_attribute_string( 'description' ); ?>>
            <p><?php echo esc_html( $settings['description'] ); ?></p>
        </div>
        <?php endif; ?>

        <?php if ( $settings['button_text'] ) : ?>
        <a class="banae-infocard-btn banae-info-card-btn-icon-<?php echo esc_attr( $settings['button_icon_position'] ); ?>"
            href="<?php echo esc_url( $settings['button_link']['url'] ); ?>"
            <?php if ( $settings['button_link']['is_external'] ) : ?> target="_blank" <?php endif; ?>
            <?php if ( $settings['button_link']['nofollow'] ) : ?> rel="nofollow" <?php endif; ?>>
            <?php echo esc_html( $settings['button_text'] ); ?>
        </a>
        <?php endif; ?>
    </div>

</div>
<?php
	}


}