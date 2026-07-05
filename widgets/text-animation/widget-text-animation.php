<?php
if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Banana_Addons\Elementor\Helper;
use Elementor\Group_Control_Typography;
class Banae_Text_Animation extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_text_animate';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Text Animation';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-animation';
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
	 * Get widget keywords for search
	 * 
	 * @return string[]
	 */
	public function get_keywords() {
		return [ 'banana', 'fancy', 'animate', 'animation' ];
	}

	/**
	 * Enqueue dependend scripts
	 * 
	 * @return string[]
	 */
	public function get_script_depends() {
		return [ 'banae-text-animate-script' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * @return string[]
	 */

	public function get_style_depends() {
		return [ 'banae-text-animate-style', 'banae-vendor-animate-style' ];
	}

	/**
	 * Register widget controls.
	 * 
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		// CONTENT TAB -> Content Section (important: TAB_CONTENT)
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'before_text',
			[
				'label' => __( 'Before Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => "Before Text",
				'placeholder' => __( 'Enter the before text', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'animated_text',
			[
				'label' => __( 'Animated Text (separate phrases with | )', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => "Hello world!|This is animated text|Elementor widget",
				'placeholder' => __( 'Enter the text or phrases separated by |', 'banana-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'after_text',
			[
				'label' => __( 'After Text', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => "After Text",
				'placeholder' => __( 'Enter the after text', 'banana-addons-for-elementor' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'animation_type',
			[
				'label' => __( 'Animation Type', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'bounce' => __( 'Bounce', 'banana-addons-for-elementor' ),
					'flash' => __( 'Flash', 'banana-addons-for-elementor' ),
					'pulse' => __( 'Pulse', 'banana-addons-for-elementor' ),
					'rubberBand' => __( 'Rubber Band', 'banana-addons-for-elementor' ),
					'shakeX' => __( 'ShakeX', 'banana-addons-for-elementor' ),
					'shakeY' => __( 'ShakeY', 'banana-addons-for-elementor' ),
					'headShake' => __( 'Head Shake', 'banana-addons-for-elementor' ),
					'swing' => __( 'Swing', 'banana-addons-for-elementor' ),
					'tada' => __( 'Tada', 'banana-addons-for-elementor' ),
					'wobble' => __( 'Wobble', 'banana-addons-for-elementor' ),
					'jello' => __( 'Jello', 'banana-addons-for-elementor' ),
					'heartBeat' => __( 'Heart Beat', 'banana-addons-for-elementor' ),
					'fadeIn' => __( 'fadeIn', 'banana-addons-for-elementor' ),
					'fadeInDown' => __( 'fadeInDown', 'banana-addons-for-elementor' ),
					'fadeInUp' => __( 'fadeInUp', 'banana-addons-for-elementor' ),
					'zoomIn' => __( 'zoomIn', 'banana-addons-for-elementor' ),
					'slideInDown' => __( 'slideInDown', 'banana-addons-for-elementor' ),
					'slideInLeft' => __( 'slideInLeft', 'banana-addons-for-elementor' ),
					'slideInRight' => __( 'slideInRight', 'banana-addons-for-elementor' ),
					'slideInUp' => __( 'slideInUp', 'banana-addons-for-elementor' ),
					'flip' => __( 'Flip', 'banana-addons-for-elementor' ),
					'flipInX' => __( 'flipInX', 'banana-addons-for-elementor' ),
					'flipInY' => __( 'flipInY', 'banana-addons-for-elementor' ),
					'lightSpeedInRight' => __( 'lightSpeedInRight', 'banana-addons-for-elementor' ),
					'rotateIn' => __( 'rotateIn', 'banana-addons-for-elementor' ),
					'jackInTheBox' => __( 'jackInTheBox', 'banana-addons-for-elementor' ),
				],
				'default' => 'bounce',
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => __( 'Loop animation', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => __( 'Speed (ms)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 50,
				'max' => 5000,
				'step' => 50,
				'default' => 1000,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'banana-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .hck-wrapper' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __( 'HTML Tag', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => Helper::banae_title_tags(),
				'toggle' => false,
			]
		);

		$this->end_controls_section();

		// STYLE tab: Before Text Style controls
		$this->start_controls_section(
			'before_text_style_section',
			[
				'label' => __( 'Before Text', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'before_text_typography',
				'selector' => '{{WRAPPER}} .hck-before-text',
			]
		);

		$this->add_control(
			'before_text_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hck-before-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE tab: Animation Text Style controls
		$this->start_controls_section(
			'animated_text_style_section',
			[
				'label' => __( 'Animated Text', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'animated_text_typography',
				'selector' => '{{WRAPPER}} .hck-text',
			]
		);


		$this->add_control(
			'animate_text_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hck-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE tab: After Text Style controls
		$this->start_controls_section(
			'after_text_style_section',
			[
				'label' => __( 'After Text', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'after_text_typography',
				'selector' => '{{WRAPPER}} .hck-after-text',
			]
		);


		$this->add_control(
			'after_text_color',
			[
				'label' => __( 'Text Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hck-after-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$phrases_raw = $settings['animated_text'];
		$before_text = $settings['before_text'];
		$after_text = $settings['after_text'];
		$title_tag = $settings['title_tag'] ? $settings['title_tag'] : '';
		//$open_tag = sprintf( '<%s>', tag_escape( $title_tag ) );
		//$close_tag = sprintf( '</%s>', tag_escape( $title_tag ) );
		$phrases = array_map( 'trim', explode( '|', $phrases_raw ) );
		$uniq_id = 'hck-' . uniqid();

		$data = [
			'type' => $settings['animation_type'],
			'loop' => ( $settings['loop'] === 'yes' ) ? 'true' : 'false',
			'speed' => intval( $settings['speed'] ),
		];

		?>
<div class="hck-wrapper" id="<?php echo esc_attr( $uniq_id ); ?>" data-elta='<?php echo wp_json_encode( $data ); ?>'
    data-phrases='<?php echo wp_json_encode( array_values( $phrases ) ); ?>'>
    <?php echo sprintf( '<%s>', tag_escape( $title_tag ) ); ?>
    <span class="hck-before-text"><?php echo esc_html( $before_text ); ?></span>
    <span class="hck-text" aria-hidden="true">
        <?php
				// For typing we will render an empty span and pass phrases via data attribute.
				// But show fallback first phrase.
				echo esc_html( $phrases[0] );
				?>
    </span>
    <span class="hck-after-text"><?php echo esc_html( $after_text ); ?></span>
    <?php echo sprintf( '</%s>', tag_escape( $title_tag ) ); ?>
</div>
<!--
		<script>
			
			(function () {
				var el = document.getElementById('<?php //echo esc_js( $uniq_id ); ?>');
				if (!el) return;
				// attach the phrases data as separate attribute
				el.dataset.phrases = <?php //echo wp_json_encode( array_values( $phrases ) ); ?>;
			})();*/
		</script>
		-->
<?php

	}
}