<?php

use Banana_Addons\Elementor\Helper;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Banae_Team_Member extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_team_member';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Team Member', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-user-circle-o';
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
		return [ 'team', 'profile', 'member', 'staff' ];
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
			'banae-team-member-style',
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
		Banae_Team_Member_Controls::add_register_controls( $this );

	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$button_position = ! empty( $settings['button_position'] ) ? $settings['button_position'] : 'after';
		$show_button = false;

		// check if button should be shown
		if ( ! empty( $settings['show_details_button'] ) && $settings['show_details_button'] === 'yes' ) {
			$show_button = true;
		}

		// Add inline editing attributes and render attributes
		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'banae-team-member-name' );

		$this->add_inline_editing_attributes( 'job_title', 'basic' );
		$this->add_render_attribute( 'job_title', 'class', 'banae-team-member-position' );

		$this->add_inline_editing_attributes( 'bio', 'intermediate' );
		$this->add_render_attribute( 'bio', 'class', 'banae-team-member-bio' );
		?>

<?php if ( $settings['image']['url'] || $settings['image']['id'] ) : ?>
<figure class="banae-team-member-figure">
    <?php

				echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) );

				if ( $settings['image2']['url'] || $settings['image2']['id'] ) {
					echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image2' ) );
				}

				?>
</figure>
<?php endif; ?>

<div class="banae-team-member-body">
    <?php if ( $settings['title'] ) :
				printf( '<%1$s %2$s>%3$s</%1$s>',
					esc_attr( $settings['title_tag'], 'h2' ),
					esc_attr( $this->get_render_attribute_string( 'title' ) ),
					wp_kses_post( $settings['title'] )
				);
			endif; ?>

    <?php if ( $settings['job_title'] ) : ?>
    <div <?php $this->print_render_attribute_string( 'job_title' ); ?>>
        <?php echo wp_kses_post( $settings['job_title'] ); ?>
    </div>
    <?php endif; ?>

    <?php if ( $settings['bio'] ) : ?>
    <div <?php $this->print_render_attribute_string( 'bio' ); ?>>
        <p><?php echo wp_kses_post( $settings['bio'] ); ?></p>
    </div>
    <?php endif; ?>

    <?php
			if ( $show_button && $button_position === 'before' ) {
				Helper::render_button( $settings );
			}
			?>

    <?php if ( $settings['show_profiles'] && is_array( $settings['profiles'] ) ) : ?>
    <div class="banae-team-member-links">
        <?php

					foreach ( $settings['profiles'] as $profile ) :
						$icon = isset( $profile['social_icon']['value'] ) ? $profile['social_icon']['value'] : '';
						$url = isset( $profile['link']['url'] ) ? $profile['link']['url'] : '';

						printf( '<a target="_blank" rel="noopener" href="%s" class="elementor-repeater-item-%s"><i class="%s" aria-hidden="true"></i></a>',
							esc_url( $url ),
							esc_attr( $profile['_id'] ),
							esc_attr( $icon )
						);
					endforeach; ?>
    </div>
    <?php endif; ?>

    <?php
			if ( $show_button && $button_position === 'after' ) {
				Helper::render_button( $settings );
			}
			?>
</div>
<?php
	}
}