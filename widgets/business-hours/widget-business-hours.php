<?php

use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Banae_Business_Hours extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_business_hours';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Business Hours', 'banana-addons-for-elementor' );
	}

	public function get_custom_help_url() {
		return 'https://bananaaddons.com/docs/elementor/widgets/business-hours/';
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
		return [ 'time', 'business', 'hours', 'office' ];
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
			'banae-business-hours-style',
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
		Banae_Business_Hours_Controls::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$show_title = $settings['show_title'] === 'yes' ? true : false;
		?>
<div class="banae-business-hours__main">
    <ul class="banae-business-hours-inner">

        <?php if ( $show_title ) : ?>
        <li class="banae-business__title">
            <h3><?php echo esc_html( $settings['banae_business_title'] ); ?></h3>
        </li>
        <?php endif; ?>

        <?php foreach ( $settings['banae_open_business_hours'] as $item ) : ?>
        <li class="banae-day__item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
            <?php if ( ! empty( $item['banae_business_day'] ) ) : ?>
            <span class="banae-business-day"><?php echo esc_html( $item['banae_business_day'] ); ?></span>
            <?php endif;
						if ( ! empty( $item['banae_business_time'] ) ) : ?>
            <span class="banae-business-time"><?php echo esc_html( $item['banae_business_time'] ); ?></span>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php
	}
}