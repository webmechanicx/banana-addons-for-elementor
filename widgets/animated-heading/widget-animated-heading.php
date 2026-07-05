<?php

use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Banae_Animated_Heading extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_animated_heading';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Animated Heading';
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-animated-headline';
	}

	/**
	 * Get widget keywords for search
	 * 
	 * @return string[]
	 */
	public function get_keywords() {
		return [ 'headline', 'heading', 'animation', 'title', 'text' ];
	}

	/**
	 * Get widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'banana-addons-category' ];
	}

	/**
	 * Enqueue dependend scripts
	 * 
	 * Retrieve the list of script dependencies the widget requires.
	 * 
	 * @return array Widget script dependencies
	 */
	public function get_script_depends() {

		return [ 'jQuery', 'banae-animated-heading-script' ];

	}

	/**
	 * Get style dependencies.
	 *
	 * Retrieve the list of style dependencies the widget requires.
	 *
	 * @return array Widget style dependencies.
	 */
	public function get_style_depends(): array {
		return [ 'banae-animated-heading-style' ];
	}

	protected function register_controls() {

		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Animated_Heading_Controls::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$before_text = isset( $settings['before_text'] ) ? esc_html( $settings['before_text'] ) : '';
		$words_raw = isset( $settings['animated_words_list'] ) ? $settings['animated_words_list'] : [];
		$tag = isset( $settings['heading_tag'] ) ? esc_attr( $settings['heading_tag'] ) : 'h2';
		$data_set = array(
			'animationDelay' => esc_attr( $settings['animationDelay'] ),
			'barAnimationDelay' => esc_attr( $settings['barAnimationDelay'] ),
			'lettersDelay' => esc_attr( $settings['lettersDelay'] ),
			'typeLettersDelay' => esc_attr( $settings['typeLettersDelay'] ),
			'selectionDuration' => esc_attr( $settings['selectionDuration'] ),
			'revealDuration' => esc_attr( $settings['revealDuration'] ),
			'revealAnimationDelay' => esc_attr( $settings['revealAnimationDelay'] ),
		);

		// unique id to allow multiple widgets in a page
		$uid = 'banae-animated-' . uniqid();

		//animation_type based class swither
		if ( isset( $settings['animation_type'] ) && $settings['animation_type'] === 'rotate-2' ) {

			$animation_type = sprintf( 'letters %1$s', esc_attr( $settings['animation_type'] ) );

		} elseif ( isset( $settings['animation_type'] ) && $settings['animation_type'] === 'rotate-3' ) {

			$animation_type = sprintf( 'letters %1$s', esc_attr( $settings['animation_type'] ) );

		} elseif ( isset( $settings['animation_type'] ) && $settings['animation_type'] === 'scale' ) {

			$animation_type = sprintf( 'letters %1$s', esc_attr( $settings['animation_type'] ) );

		} elseif ( isset( $settings['animation_type'] ) && $settings['animation_type'] === 'type' ) {

			$animation_type = sprintf( 'letters %1$s', esc_attr( $settings['animation_type'] ) );

		} else {

			$animation_type = sprintf( '%1$s', esc_attr( $settings['animation_type'] ) );
		}

		// opening and close tags markup
		$open_tag = sprintf( '<%1$s class="banae-animated-headline %2$s">', $tag, $animation_type );
		$close_tag = sprintf( '</%1$s>', $tag );

		?>
<div class="banae-animated-wrap" id="<?php echo esc_attr( $uid ); ?>"
    data-duration='<?php echo wp_json_encode( $data_set ); ?>'>
    <?php echo esc_attr( $open_tag ); ?>
    <span class="banae-animated-headline-pre_text"><?php echo wp_kses_post( $before_text ); ?></span>
    <span class="banae-animated-words-wrapper">
        <?php
				if ( $words_raw ) {
					foreach ( $words_raw as $index => $item ) {

						echo ( $index == 0 ) ? '<b class="is-visible elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">' . esc_html( $item['word_text'] ) . '</b>' : '<b class="elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">' . esc_html( $item['word_text'] ) . '</b>';
					}
				}
				?>
    </span>
    <?php echo esc_attr( $close_tag ); ?>
</div>
<?php
	}

}