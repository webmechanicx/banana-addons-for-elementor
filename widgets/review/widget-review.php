<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Banana_Addons\Elementor\Helper;
use Elementor\Widget_Base;
use Elementor\Plugin;

class Banae_Review extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_review';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Review', 'banana-addons-for-elementor' );
	}

	public function get_custom_help_url() {
		return 'https://bananaaddons.com/docs/elementor/widgets/review/';
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-review';
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
		return [ 'review', 'star', 'rating', 'testimonial' ];
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
			'banae-review-style',
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
		Banae_Review_Controls::add_register_controls( $this );

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$image = $settings['client_image']['url'];
		$name = esc_attr( $settings['client_name'] );
		$designation = esc_attr( $settings['client_designation'] );
		$comment = esc_html( $settings['review_comment'] );
		$alignment = esc_attr( $settings['review_image_alignment'] );
		$is_num_star = esc_attr( $settings['review_show_num_star'] );
		$rating = ( ! empty( $settings['review_star_rating'] ) ) ? esc_attr( $settings['review_star_rating'] ) : 0;
		?>

<div class="banae-review-widget__wrapper banae-align-<?php echo esc_attr( $alignment ); ?>">
    <?php if ( $alignment === 'top' ) : ?>
    <div class="banae-review-image">
        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $name ); ?>">
    </div>
    <?php endif; ?>

    <div class="banae-review__content">
        <?php if ( $alignment === 'left' ) : ?>
        <div class="banae-review-image">
            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $name ); ?>">
        </div>
        <?php endif; ?>

        <div class="banae-review__text">
            <div class="banae-review__meta">
                <h4 class="banae-review-name"><?php echo esc_html( $name ); ?></h4>
                <span class="banae-review-designation"><?php echo esc_html( $designation ); ?></span>
                <div class="banae-review__stars">

                    <?php if ( $is_num_star === 'yes' ) : ?>
                    <div class="banae-review__num-star">
                        <?php echo esc_html( $rating ); ?>
                        <i class="eicon-star banae-star-icon"></i>
                    </div>
                    <?php else : ?>

                    <?php
								for ( $i = 1; $i <= 5; $i++ ) {
									if ( $i <= $rating ) {
										echo '<i class="eicon-star banae-star-icon"></i>';
									} else {
										echo '<i class="eicon-star-o" style="color:#ccc;"></i>';
									}
								}
								?>

                    <?php endif; ?>
                </div>
            </div>

            <p class="banae-review-comment"><?php echo esc_html( $comment ); ?></p>
        </div>
    </div>
</div>

<?php
	}

}