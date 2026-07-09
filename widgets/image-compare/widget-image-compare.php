<?php
if ( ! defined( 'ABSPATH' ) )
	exit;

use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Controls_Manager;

class Banae_Image_Compare extends Widget_Base {

	public function get_name() {
		return 'banae_image_compare';
	}

	public function get_title() {
		return 'Image Compare';
	}

	public function get_icon() {
		return 'eicon-image-before-after';
	}

	public function get_categories() {
		return [ 'banana-addons-category' ];
	}

	/**
	 * Enqueue dependend scripts
	 * 
	 * Retrieve the list of script dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_script_depends() {
		return [ 'jQuery', 'banae-vendor-event-move-script', 'banae-vendor-twentytwenty-script', 'banae-image-compare-script',];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'banae-vendor-twentytwenty-style', 'banae-image-compare-style' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'image_compare_content_section',
			[
				'label' => 'Content',
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'before_image',
			[
				'label' => __( 'Before Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [ 'url' => '' ],
			]
		);

		$this->add_control(
			'after_image',
			[
				'label' => __( 'After Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [ 'url' => '' ],
			]
		);

		$this->add_control(
			'orientation',
			[
				'label' => __( 'Orientation', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => 'Horizontal',
					'vertical' => 'Vertical',
				],
			]
		);

		$this->add_control(
			'start_percent',
			[
				'label' => __( 'Start Percentage', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 50,
				'min' => 0,
				'max' => 100,
			]
		);

		$this->add_control(
			'before_label',
			[
				'label' => __( 'Before Label (optional)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Before',
			]
		);

		$this->add_control(
			'after_label',
			[
				'label' => __( 'After Label (optional)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'After',
			]
		);

		$this->add_control(
			'slider_style',
			[
				'label' => __( 'Slider Style', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'banae-circle' => 'Circle',
					'banae-round' => 'Round',
				],
				'default' => 'banae-circle',
			]
		);

		$this->add_control(
			'slider_bg_color',
			[
				'label' => esc_html__( 'Slider Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-image-compare' => '--banae-slider-bg-color: {{VALUE}}',
				],
				'default' => '#ffffff',
			]
		);

		$this->add_control(
			'no_overlay',
			[
				'label' => __( 'No Overlay', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'no_overlay_bg_color',
			[
				'label' => esc_html__( 'Overlay Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-image-compare' => '--banae-overlay-bg-color: {{VALUE}}',
				],
				'default' => 'rgba(0,0,0,.5)',
				'condition' => [
					'no_overlay' => 'yes'
				]
			]
		);

		$this->add_control(
			'move_slider_on_hover',
			[
				'label' => __( 'Move Slider On Hover', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'move_with_handle_only',
			[
				'label' => __( 'Move Slider on Hover', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'click_to_move',
			[
				'label' => __( 'Click to Move', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'banana-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$before = esc_url( $settings['before_image']['url'] ?: '' );
		$after = esc_url( $settings['after_image']['url'] ?: '' );
		$orientation = esc_attr( $settings['orientation'] ?: 'horizontal' );
		$start_percent = floatval( $settings['start_percent'] );
		$before_label = esc_html( $settings['before_label'] );
		$after_label = esc_html( $settings['after_label'] );
		$slider_style = esc_attr( $settings['slider_style'] );
		$no_overlay = esc_attr( $settings['no_overlay'] );
		$move_slide = esc_attr( $settings['move_slider_on_hover'] );
		$move_with = esc_attr( $settings['move_with_handle_only'] );
		$click_to_move = esc_attr( $settings['click_to_move'] );

		// config data
		$config = [
			'before_label' => $before_label,
			'after_label' => $after_label,
			'orientation' => $orientation,
			'percent' => $start_percent,
			'no_overlay' => ( $no_overlay === "yes" ) ? true : false,
			'move_slider_on_hover' => ( $move_slide === "yes" ) ? true : false,
			'move_with_handle_only' => ( $move_with === "yes" ) ? true : false,
			'click_to_move' => ( $click_to_move === "yes" ) ? true : false,
		];

		// Unique id for instance
		$uid = 'banae-image-compare-' . uniqid();

		// addiional style
		$custom_css = sprintf(
			'#%1$s{
				--banae-before-text:"%2$s";
				--banae-after-text:"%3$s";
			}',
			esc_attr( $uid ),
			esc_html( $before_label ),
			esc_html( $after_label )
		);

		wp_add_inline_style(
			'banae-image-compare-style',
			$custom_css
		);

?>

<div id="<?php echo esc_attr( $uid ); ?>" class="banae-image-compare <?php echo esc_attr( $slider_style ); ?>"
    data-config='<?php echo wp_json_encode( $config ); ?>'>
    <?php if ( $before ) : ?>
    <img src="<?php echo esc_attr( $before ); ?>" alt="<?php echo esc_attr( $before_label ); ?>">
    <?php endif; ?>
    <?php if ( $after ) : ?>
    <img src="<?php echo esc_attr( $after ); ?>" alt="<?php echo esc_attr( $after_label ); ?>">
    <?php endif; ?>
</div>
<?php
	}
}