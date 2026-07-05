<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Icons_Manager;

class Banae_Dual_Button extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_dual_button';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Dual Button', 'banana-addons-for-elementor' );
	}

	public function get_custom_help_url() {
		return 'https://bananaaddons.com/docs/elementor/widgets/dual-button/';
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-clock-o';
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
		return [ 'button', 'dual' ];
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
			'banae-dual-button-style',
		];
	}

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
		Banae_Dual_Button_Controls::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Get icon values
		$first_button_icon = esc_attr( $settings['banae_button_primary_icons']['value'] );
		$second_button_icon = esc_attr( $settings['banae_button_secondary_icons']['value'] );

		// Add link attributes
		$this->add_link_attributes( 'first_button', $settings['banae_button_primary_link'] );
		$this->add_link_attributes( 'second_button', $settings['banae_button_secondary_link'] );

		// first button position icon
		if ( $settings['banae_dual_button_primary_icon_position'] === 'before' ) {
			$first_button_icon = sprintf( '<i class="%1$s" aria-hidden="true"></i> %2$s ', $first_button_icon, esc_html( $settings['banae_button_primary_text'] ) );
		} else {
			$first_button_icon = sprintf( '%1$s <i class="%2$s" aria-hidden="true"></i>', esc_html( $settings['banae_button_primary_text'] ), $first_button_icon );
		}

		// second button position icon
		if ( $settings['banae_dual_button_secondary_icon_position'] === 'before' ) {
			$second_button_icon = sprintf( '<i class="%1$s" aria-hidden="true"></i> %2$s ', $second_button_icon, esc_html( $settings['banae_button_secondary_text'] ) );
		} else {
			$second_button_icon = sprintf( '%1$s <i class="%2$s" aria-hidden="true"></i>', esc_html( $settings['banae_button_secondary_text'] ), $second_button_icon );
		}

		?>
<div class="banae-dual-button__wrapper">
    <div class="banae-dual__button">

        <a class="banae-dual-btn banae-dual-btn__primary"
            <?php echo esc_attr( $this->get_render_attribute_string( 'first_button' ) ); ?>>
            <?php echo wp_kses_post( $first_button_icon ); ?>
        </a>

        <?php
				// Show middle text
				if ( $settings['banae_show_button_center_text'] === 'yes' && ! empty( $settings['banae_button_center_text'] ) ) {
					echo "<span class='banae-button-text__middle'>" . esc_html( $settings['banae_button_center_text'] ) . "</span>";
				}
				?>

        <a class="banae-dual-btn banae-dual-btn__secondary"
            <?php echo esc_attr( $this->get_render_attribute_string( 'second_button' ) ); ?>>
            <?php echo wp_kses_post( $second_button_icon ); ?>
        </a>

    </div>
</div>
<?php
	}
}