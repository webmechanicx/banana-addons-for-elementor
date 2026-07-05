<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Group_Control_Image_Size;

class Banae_Testimonial_Carousel extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_testimonial_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Testimonial Carousel', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-carousel';
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
		return [ 'testimonial', 'carousel', 'animated' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'swiper', 'banae-testimonial-carousel-style' ];
	}

	/**
	 * Enqueue dependend scripts
	 * 
	 * Retrieve the list of script dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_script_depends() {
		return [ 'swiper', 'banae-testimonial-carousel-script' ];
	}

	/**
	 * Register widget content controls
	 */
	protected function register_controls() {
		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Testimonial_Carousel::add_register_controls( $this );
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		$autoplay = esc_attr( $settings['autoplay'] );
		$autoplay_speed = esc_attr( $settings['autoplay_speed'] );
		$show_nav = esc_attr( $settings['show_navigation'] );
		$show_pagination = esc_attr( $settings['show_pagination'] );
		$slides_per_view = esc_attr( $settings['slides_per_view'] );
		$space_between_slides = esc_attr( $settings['space_between_slides'] );
		$slides_in_320_breakpoints = ! empty( $settings['slides_in_320_breakpoints'] ) ? esc_attr( $settings['slides_in_320_breakpoints'] ) : 1;
		$slides_in_768_breakpoints = ! empty( $settings['slides_in_768_breakpoints'] ) ? esc_attr( $settings['slides_in_768_breakpoints'] ) : 1;
		$slides_in_1024_breakpoints = ! empty( $settings['slides_in_1024_breakpoints'] ) ? esc_attr( $settings['slides_in_1024_breakpoints'] ) : 1;
		$widget_id = uniqid();

		$config = [
			'autoplay' => $autoplay,
			'autoplay_speed' => $autoplay_speed,
			'show_nav' => $show_nav,
			'show_pagination' => $show_pagination,
			'slides_per_view' => $slides_per_view,
			'space_between_slides' => $space_between_slides,
			'break_points' => [ 'small' => $slides_in_320_breakpoints, 'medium' => $slides_in_768_breakpoints, 'large' => $slides_in_1024_breakpoints ],
			'wrapper_id' => sprintf( 'banae-testimonial-carousel-%1$s', $widget_id ),
		];

		?>

<div class="banae-testimonial-carousel-wrapper" id="banae-testimonial-carousel-<?php echo esc_attr( $widget_id ); ?>"
    data-config='<?php echo wp_json_encode( $config ); ?>'>
    <div class="swiper banae-testimonial-carousel-swiper">
        <div class="swiper-wrapper">
            <?php if ( ! empty( $settings['testimonial_list'] ) && ( $settings['testimonial_list'] ) ) : ?>
            <?php foreach ( $settings['testimonial_list'] as $item ) : ?>

            <div class="swiper-slide">

                <div class="banae-testimonial-carousel__content">
                    <?php echo wp_kses_post( $item['customer_testimonial'] ); ?>
                </div>

                <div class="banae-testimonial-carousel__customer">

                    <?php if ( ! empty( $item['customer_image']['url'] ) ) : ?>
                    <figure class="banae-testimonial-carousel__customer-thumb">
                        <?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'customer_image', 'customer_image' ) ); ?>
                    </figure>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['testimonial_show_meta'] ) && $settings['testimonial_show_meta'] === 'yes' ) : ?>
                    <div class="banae-testimonial-carousel__customer-meta">
                        <div class="banae-testimonial-carousel__customer-name">
                            <?php echo wp_kses_post( $item['customer_name'] ); ?>
                        </div>
                        <div class="banae-testimonial-carousel__customer-position">
                            <?php echo wp_kses_post( $item['customer_position'] ); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>

            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>

    <?php if ( $show_nav === 'yes' ) : ?>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <?php endif; ?>

    <?php if ( $show_pagination === 'yes' ) : ?>
    <div class="swiper-pagination"></div>
    <?php endif; ?>
</div>

<?php
	}

}