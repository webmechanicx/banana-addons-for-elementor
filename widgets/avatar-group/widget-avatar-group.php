<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

use Banana_Addons\Elementor\Helper;
use Elementor\Widget_Base;
use Elementor\Plugin;

class Banae_Avatar_Group extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_avatar_group';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Avatar Group', 'banana-addons-for-elementor' );
	}

	public function get_custom_help_url() {
		return 'https://bananaaddons.com/docs/elementor/widgets/avatar-group/';
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-person';
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
		return [ 'avatar', 'team', 'group', 'photo' ];
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
			'banae-avatar-group-style',
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
		Banae_Avatar_Group_Controls::add_register_controls( $this );

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		?>

<div class="banae-avatar-group__wrapper">
    <div class="banae-avatar-group">

        <?php if ( ! empty( $settings['banae_avatar_list'] ) ) : ?>

        <?php foreach ( $settings['banae_avatar_list'] as $item ) : ?>

        <div class="banae-avatar elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
            <?php if ( ! empty( $settings['banae_avatar_show_tooltips'] ) && $settings['banae_avatar_show_tooltips'] === 'yes' ) : ?>
            <span class="banae-avatar-name"><?php echo esc_html( $item['banae_avatar_group_name'] ); ?></span>
            <?php endif; ?>
            <img src="<?php echo esc_attr( $item['banae_avatar_image']['url'] ); ?>"
                alt="<?php echo esc_html( $item['banae_avatar_group_name'] ); ?>">
        </div>

        <?php endforeach; ?>

        <?php endif; ?>

    </div>

</div>

<?php
	}

}