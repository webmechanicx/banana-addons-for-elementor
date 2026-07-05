<?php
if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

use Elementor\Plugin;
use Elementor\Widget_Base;

class Banae_Code_Highlighter extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banae_code_highlighter';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Code Highlighter', 'banana-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-code';
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
		return [ 'code', 'programming', 'syntax' ];
	}

	/**
	 * Enqueue dependend styles
	 * 
	 * Retrieve the list of style dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'banae-prism-style', 'banae-prism-dark-style', 'banae-code-highlighter-style' ];
	}

	/**
	 * Enqueue dependend scripts
	 * 
	 * Retrieve the list of script dependencies the widget requires.
	 * 
	 * @return string[]
	 */
	public function get_script_depends() {
		//return [ 'jquery', 'banae-prism-script', 'banae-code-highlighter-script' ];

		//$base_url = 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.23.0';
		$base_url = BANANA_ADDONS_ASSETS . 'vendor/prismjs';

		wp_register_script( 'prismjs_core', $base_url . '/components/prism-core.min.js', [], '1.23.0', true );
		wp_register_script( 'prismjs_loader', $base_url . '/plugins/autoloader/prism-autoloader.min.js', [ 'prismjs_core' ], '1.23.0', true );
		wp_register_script( 'prismjs_normalize', $base_url . '/plugins/normalize-whitespace/prism-normalize-whitespace.min.js', [ 'prismjs_core' ], '1.23.0', true );
		wp_register_script( 'prismjs_line_numbers', $base_url . '/plugins/line-numbers/prism-line-numbers.min.js', [ 'prismjs_normalize' ], '1.23.0', true );
		wp_register_script( 'prismjs_line_highlight', $base_url . '/plugins/line-highlight/prism-line-highlight.min.js', [ 'prismjs_normalize' ], '1.23.0', true );
		wp_register_script( 'prismjs_toolbar', $base_url . '/plugins/toolbar/prism-toolbar.min.js', [ 'prismjs_normalize' ], '1.23.0', true );
		wp_register_script( 'prismjs_copy_to_clipboard', $base_url . '/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js', [ 'prismjs_toolbar' ], '1.23.0', true );

		$depends = [
			'jquery' => true,
			'prismjs_core' => true,
			'prismjs_loader' => true,
			'prismjs_normalize' => true,
			'highlight_handler' => true,
			'prismjs_line_numbers' => true,
			'prismjs_line_highlight' => true,
			'prismjs_copy_to_clipboard' => true,
			'banae-code-highlighter-script' => true,
		];

		if ( ! Plugin::$instance->preview->is_preview_mode() ) {
			$settings = $this->get_settings_for_display();

			if ( ! $settings['line_numbers'] ) {
				unset( $depends['prismjs_line_numbers'] );
			}

			if ( ! $settings['highlight_lines'] ) {
				unset( $depends['prismjs_line_highlight'] );
			}

			if ( ! $settings['copy_to_clipboard'] ) {
				unset( $depends['prismjs_copy_to_clipboard'] );
			}
		}

		return array_keys( $depends );

	}

	protected function register_controls() {
		// Instantiate the control class
		require_once 'register-controls.php';

		// Call to the register controls method
		Banae_Code_Highlighter::add_register_controls( $this );
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$language = $settings['language'];
		$theme = $settings['theme'];
		$code = $settings['code_content'];
		$line_numbers = $settings['line_numbers'] === 'yes' ? 'line-numbers' : '';
		$highlight_lines = $settings['highlight_lines'];
		$browser_search_text = $settings['browser_search_text'];
		$wrap = $settings['word_wrap'] === 'on' ? 'white-space: pre-wrap;' : 'white-space: pre;';
		$font_size = $settings['font_size']['size'] . 'px';
		$height = $settings['height']['size'] . 'px';

		// defined classes
		$wrapper = sprintf( 'banae-code-highlighter-container prismjs-%s copy-to-clipboard', esc_attr( $theme ) );

		// add render attributes
		$this->add_render_attribute( 'wrapper', 'class', $wrapper );
		$this->add_render_attribute( 'pre_lang', 'class', $line_numbers );
		$this->add_render_attribute( 'pre_lang', 'data-line', $highlight_lines );
		$this->add_render_attribute( 'code_block', 'class', sprintf( 'language-%1$s', $language ) );
		//echo '<button class="copy-code-btn">' . __( 'Copy', 'banana-addons-for-elementor' ) . '</button>';
		?>

<?php if ( ! empty( $settings['show_browser_wrapper'] ) && $settings['show_browser_wrapper'] === 'yes' ) : ?>
<div class="banae-browser-template__wrapper">
    <div class="banae-browser-template__top-bar">
        <ul class="banae-browser-template__buttons">
            <li class="banae-browser-template__buttons_item"></li>
            <li class="banae-browser-template__buttons_item"></li>
            <li class="banae-browser-template__buttons_item"></li>
        </ul>

        <div class="banae-browser-template__address">
            <?php echo esc_html( $browser_search_text ); ?>
        </div>
    </div>
    <?php endif; ?>

    <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
        <pre <?php $this->print_render_attribute_string( 'pre_lang' ); ?>>
															<code <?php $this->print_render_attribute_string( 'code_block' ); ?>> <?php echo esc_html( $code ); ?></code>
														</pre>
    </div>

    <?php if ( ! empty( $settings['show_browser_wrapper'] ) && $settings['show_browser_wrapper'] === 'yes' ) : ?>
</div>
<?php endif; ?>

<?php

	}

	protected function content_template() {
		?>
<# var wrapper='banae-code-highlighter-container prismjs-' + settings.theme + ' copy-to-clipboard' ; var
    line_numbers=settings.line_numbers==='yes' ? 'line-numbers' : '' ; // add render attributes
    view.addRenderAttribute( 'wrapper' , 'class' , wrapper ); view.addRenderAttribute( 'pre_lang' , 'class' ,
    line_numbers ); view.addRenderAttribute( 'pre_lang' , 'data-line' , settings.highlight_lines );
    view.addRenderAttribute( 'code_block' , 'class' , 'language-' + settings.language ); #>

    <# if ( settings?.show_browser_wrapper==='yes' ) { #>
        <div class="banae-browser-template__wrapper">
            <div class="banae-browser-template__top-bar">
                <ul class="banae-browser-template__buttons">
                    <li class="banae-browser-template__buttons_item"></li>
                    <li class="banae-browser-template__buttons_item"></li>
                    <li class="banae-browser-template__buttons_item"></li>
                </ul>

                <div class="banae-browser-template__address">
                    bananaaddons.com
                </div>
            </div>
            <# } #>

                <div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
                    <pre {{{ view.getRenderAttributeString( 'pre_lang' ) }}}>
															<code {{{ view.getRenderAttributeString( 'code_block' ) }}}>{{ settings.code_content }}</code>
														</pre>
                </div>

                <# if ( settings?.show_browser_wrapper==='yes' ) { #>
        </div>
        <# } #>

            <?php
	}
}