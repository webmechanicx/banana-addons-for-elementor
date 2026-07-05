<?php
if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;

class Banae_Logo_Carousel extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_logo_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Logo Carousel', 'banana-addons-for-elementor' );
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
		return [ 'logo', 'carousel', 'animated' ];
	}

	/**
	 * Enqueue dependend scripts
	 * 
	 * Retrieve the list of script dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_script_depends() {
		return [ 'swiper', 'banae-logo-carousel-script' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'swiper', 'banae-logo-carousel-style' ];
	}

	/**
	 * Register widget content controls
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'logos_section',
			[
				'label' => __( 'Logos', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::SECTION,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'logo_image',
			[
				'label' => __( 'Logo Image', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Link', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);


		$this->add_control(
			'logos',
			[
				'label' => __( 'Logos', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [],
				'title_field' => '{{{ logo_image.url ? "Logo" : "Logo Item" }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'settings_section',
			[
				'label' => __( 'Settings', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed (ms)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_navigation',
			[
				'label' => __( 'Show Navigation Arrows', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label' => __( 'Show Pagination Dots', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'banana-addons-for-elementor' ),
				'label_off' => __( 'No', 'banana-addons-for-elementor' ),
				'default' => 'no',
			]
		);

		$this->add_control(
			'layout_style',
			[
				'label' => esc_html__( 'Layout', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => esc_html__( 'Horizontal', 'banana-addons-for-elementor' ),
					'vertical' => esc_html__( 'Vertical', 'banana-addons-for-elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-vertical' => 'height: 300px;',
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'slides_per_view_desktop',
			[
				'label' => esc_html__( 'Slide Per View (Desktop)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'step' => 1,
				'default' => 4,
			]
		);

		$this->add_control(
			'slides_per_view_tab',
			[
				'label' => esc_html__( 'Slide Per View (Tablet)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'step' => 1,
				'default' => 3,
			]
		);

		$this->add_control(
			'slides_per_view_mobile',
			[
				'label' => esc_html__( 'Slide Per View (Mobile)', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'step' => 1,
				'default' => 2,
			]
		);

		$this->add_control(
			'space_between_logos',
			[
				'label' => esc_html__( 'Space Between Logo', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 5,
				'default' => 0,
			]
		);

		$this->end_controls_section();

		// Slider Control Style Tab
		$this->start_controls_section(
			'logo_slider_control_style_section',
			[
				'label' => esc_html__( 'Slider Control', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'logo_slider_control_color',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-logo-carousel-swiper .swiper-button-prev, {{WRAPPER}} .banae-logo-carousel-swiper .swiper-button-next' => 'background-color: {{VALUE}}',
				],
				'default' => 'transparent',
			]
		);

		$this->add_control(
			'logo_slider_control_foreground_color',
			[
				'label' => esc_html__( 'Foreground Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-logo-carousel-swiper .swiper-button-prev::after, {{WRAPPER}} .banae-logo-carousel-swiper .swiper-button-next::after' => 'color: {{VALUE}}',
				],
				'default' => '#000000',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .banae-logo-carousel-swiper .swiper-button-prev, {{WRAPPER}} .banae-logo-carousel-swiper .swiper-button-next',
			]
		);

		$this->add_control(
			'logo_slider_control_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 2,
					'right' => 2,
					'bottom' => 2,
					'left' => 2,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-logo-carousel-swiper .swiper-button-prev, {{WRAPPER}} .banae-logo-carousel-swiper .swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Pagination Control Style Tab
		$this->start_controls_section(
			'logo_pagination_control_style_section',
			[
				'label' => esc_html__( 'Pagination Control', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'logo_pagination_width',
			[
				'label' => esc_html__( 'Width', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 8,
				'step' => 1,
				'default' => 8,
				'selectors' => [
					'{{WRAPPER}} .banae-logo-carousel-swiper .swiper-pagination-bullet' => 'width: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'logo_pagination_height',
			[
				'label' => esc_html__( 'Height', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 8,
				'step' => 1,
				'default' => 8,
				'selectors' => [
					'{{WRAPPER}} .banae-logo-carousel-swiper .swiper-pagination-bullet' => 'height: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'logo_pagination_control_color',
			[
				'label' => esc_html__( 'Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-logo-carousel-swiper .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
				'default' => '#cccccc',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'logo_pagination_control_border',
				'fields_options' => [
					'border' => [
						'label' => esc_html__( 'Border', 'banana-addons-for-elementor' ),
					],
				],
				'selector' => '{{WRAPPER}} .banae-logo-carousel-swiper .swiper-pagination-bullet',
			]
		);

		$this->add_control(
			'logo_pagination_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'logo_pagination_control_active_color',
			[
				'label' => esc_html__( 'Acive Background Color', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banae-logo-carousel-swiper .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
				'default' => '#000000',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'logo_pagination_control_active_border',
				'fields_options' => [
					'border' => [
						'label' => esc_html__( 'Active Border', 'banana-addons-for-elementor' ),
					],
				],
				'selector' => '{{WRAPPER}} .banae-logo-carousel-swiper .swiper-pagination-bullet-active',
			]
		);

		$this->add_control(
			'logo_pagination_after_active_border_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'logo_pagination_control_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 50,
					'right' => 50,
					'bottom' => 50,
					'left' => 50,
					'unit' => '%',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-logo-carousel-swiper .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Dimensions Style Tab
		$this->start_controls_section(
			'logo_dimensions_style_section',
			[
				'label' => esc_html__( 'Dimensions', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'logo_wrapper_slide_padding',
			[
				'label' => esc_html__( 'Slick Slide Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 10,
					'right' => 10,
					'bottom' => 10,
					'left' => 10,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-logo-carousel-swiper .swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'logo_dimensions_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'logo_slide_padding',
			[
				'label' => esc_html__( 'Logo Padding', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-logo-carousel-wrapper .banae-logo-carousel-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'logo_radius',
			[
				'label' => esc_html__( 'Border Radius', 'banana-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 4,
					'right' => 4,
					'bottom' => 4,
					'left' => 4,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .banae-logo-carousel-wrapper .banae-logo-carousel-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Tab
		$this->start_controls_section(
			'logo_style_section',
			[
				'label' => esc_html__( 'Logo Styles', 'banana-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'banana-addons-for-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'logo_custom_css_filters',
				'selector' => '{{WRAPPER}} .banae-logo-carousel-swiper .banae-logo-carousel-item img',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'logo_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-logo-carousel-swiper .banae-logo-carousel-item',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'logo_border',
				'selector' => '{{WRAPPER}} .banae-logo-carousel-swiper .banae-logo-carousel-item',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'logo_box_shadow',
				'selector' => '{{WRAPPER}} .banae-logo-carousel-swiper .banae-logo-carousel-item',
			]
		);

		$this->end_controls_tab();

		// logo hover style tab
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'banana-addons-for-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'logo_hover_custom_css_filters',
				'selector' => '{{WRAPPER}} .banae-logo-carousel-swiper .banae-logo-carousel-item:hover img',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'logo_hover_logo_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image', 'video' ],
				'selector' => '{{WRAPPER}} .banae-logo-carousel-swiper .banae-logo-carousel-item:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'logo_hover_border',
				'selector' => '{{WRAPPER}} .banae-logo-carousel-swiper .banae-logo-carousel-item:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'logo_hover_box_shadow',
				'selector' => '{{WRAPPER}} .banae-logo-carousel-swiper .banae-logo-carousel-item:hover',
			]
		);

		$this->end_controls_tab();


		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$autoplay = esc_attr( $settings['autoplay'] );
		$autoplay = $autoplay === 'yes' ? 'yes' : 'no';
		$autoplay_speed = esc_attr( $settings['autoplay_speed'] );
		$show_nav = esc_attr( $settings['show_navigation'] );
		$show_pagination = esc_attr( $settings['show_pagination'] );
		$layout_style = esc_attr( $settings['layout_style'] );
		$slides_per_view_desktop = esc_attr( $settings['slides_per_view_desktop'] );
		$slides_per_view_tab = esc_attr( $settings['slides_per_view_tab'] );
		$slides_per_view_mobile = esc_attr( $settings['slides_per_view_mobile'] );
		$space_between_logos = esc_attr( $settings['space_between_logos'] );
		$widget_id = uniqid();

		if ( empty( $settings['logos'] ) )
			return;

		$config = [
			'autoplay' => $autoplay,
			'autoplay_speed' => $autoplay_speed,
			'show_nav' => $show_nav,
			'show_pagination' => $show_pagination,
			'layout_style' => $layout_style,
			'slides_per_view_desktop' => $slides_per_view_desktop,
			'slides_per_view_tab' => $slides_per_view_tab,
			'slides_per_view_mobile' => $slides_per_view_mobile,
			'space_between_logos' => $space_between_logos,
			'wrapper_id' => sprintf( 'banae-logo-carousel-%1$s', $widget_id ),
		];

		?>
<div class="banae-logo-carousel-wrapper" id="banae-logo-carousel-<?php echo esc_attr( $widget_id ); ?>"
    data-config='<?php echo wp_json_encode( $config ); ?>'>
    <div class="swiper banae-logo-carousel-swiper">
        <div class="swiper-wrapper">
            <?php foreach ( $settings['logos'] as $item ) : ?>
            <div class="swiper-slide">
                <div class="banae-logo-carousel-item">
                    <?php if ( ! empty( $item['website_link']['url'] ) ) :
									$link_url = $item['website_link']['url'];
									$link_target = $item['website_link']['is_external'] ? ' target="_blank"' : '';
									$link_nofollow = $item['website_link']['nofollow'] ? ' rel="nofollow"' : '';
									?>
                    <a class="banae-slide-link" href="<?php echo esc_url( $link_url ); ?>"
                        <?php echo esc_attr( $link_target ) . esc_attr( $link_nofollow ); ?>>
                        <img src="<?php echo esc_url( $item['logo_image']['url'] ); ?>" alt="Logo">
                    </a>
                    <?php else : ?>
                    <img src="<?php echo esc_url( $item['logo_image']['url'] ); ?>" alt="Logo">
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if ( $show_nav === 'yes' ) : ?>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <?php endif; ?>

        <?php if ( $show_pagination === 'yes' ) : ?>
        <div class="swiper-pagination"></div>
        <?php endif; ?>
    </div>
</div>
<?php
	}
}