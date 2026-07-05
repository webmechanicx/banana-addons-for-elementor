<?php
namespace Banana_Addons\Elementor;

/**
 * A simple helper class providing reusable utility functions 
 * for cleaner, faster development.
 * 
 * @package Banana_Addons
 */
class Helper {
	/**
	 * Loads a template part from the plugin's directory.
	 *
	 * @param string $slug The slug name for the generic template part.
	 * @param array  $args Optional. An array of variables to pass to the template part.
	 * 
	 * @return void
	 */
	public static function get_banae_template_part( $slug, $args = array() ) {
		// Construct the file path.
		$template = BANANA_ADDONS_DIR_PATH . $slug . '.php';

		// Extract variables for use in the template part.
		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args );
		}

		// Include the template part.
		if ( file_exists( $template ) ) {
			include $template;
		}
	}

	/**
	 * Get the plugin slug
	 *
	 * @return string
	 */
	public static function get_slug() {
		return dirname( plugin_basename( BANANA_ADDONS__FILE__ ) );
	}

	/**
	 * Get hash from current url
	 * 
	 * @return void
	 */
	public static function get_active_hash() {

		// get the current tab
		$current_tab = '';

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reading a query arg only to determine the active admin tab. No data is modified.
		if ( isset( $_GET['tab'] ) && ! empty( sanitize_text_field( wp_unslash( $_GET['tab'] ) ) ) ) {
			// get the current tab
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$current_tab = sanitize_text_field( wp_unslash( $_GET['tab'] ) );
		}

		return htmlspecialchars( $current_tab );
	}

	/**
	 * Render button link
	 * 
	 * @param mixed $settings
	 * 
	 * @return string
	 */
	public static function render_button( $settings = [] ) {

		if ( empty( $settings ) && empty( $settings['button_text'] ) ) {
			return;
		}

		return printf( '<div class="banae-team-member-button"><a href="%1$s" class="%2$s">%3$s</a></div>',
			esc_url( $settings['button_link']['url'] ),
			'banae-tm-btn',
			sprintf( '<span>%1$s</span>', esc_html( $settings['button_text'] ) )
		);
	}

	/**
	 * Contain masking shape list
	 * 
	 * @param $args
	 * 
	 * @return array
	 */
	public static function banae_masking_shape_list( $args = [] ) {

		// set directory path
		$dir = BANANA_ADDONS_DIR_PATH . BANANA_ADDONS_ASSETS_DIR . 'img/masking/';

		$list = [];

		if ( ! is_dir( $dir ) ) {
			return $list;
		}

		// get all files in the directory
		$files = array_diff( scandir( $dir ), array( '.', '..' ) );

		foreach ( $files as $file ) {
			$path_parts = pathinfo( $file );
			if ( isset( $path_parts['filename'] ) && isset( $path_parts['extension'] ) && in_array( $path_parts['extension'], array( 'svg', 'png', 'jpg', 'jpeg' ), true ) ) {
				$list[ $path_parts['filename'] ] = [
					'title' => ucwords( str_replace( '-', ' ', $path_parts['filename'] ) ),
					'image' => BANANA_ADDONS_ASSETS . 'img/masking/' . $file,
				];
			}
		}

		return $list;
	}

	/**
	 * Title tags
	 * 
	 * @return array
	 */
	public static function banae_title_tags() {

		$title_tags = [
			'h1' => 'H1',
			'h2' => 'H2',
			'h3' => 'H3',
			'h4' => 'H4',
			'h5' => 'H5',
			'h6' => 'H6',
			'div' => 'div',
			'span' => 'span',
			'p' => 'p',
		];

		return $title_tags;
	}

	/**
	 * API call to facebook and response with feed
	 * 
	 * @param integer $id
	 * @param mixed $settings
	 * @param mixed $widget
	 * 
	 * @return mixed
	 */
	public static function get_facebook_feed( $id, $settings, $widget ) {
		$page_id = trim( $settings['facebook_page_id'] );
		$access_token = $settings['facebook_access_token'];
		$url_queries = sprintf( 'fields=status_type,created_time,shares,from{name,picture},message,story,full_picture,permalink_url,attachments.limit(1){type,media_type,title,description,unshimmed_url},comments.summary(total_count),reactions.summary(total_count)&limit=%d', $settings['facebook_feed_counts'] );
		$url = "https://graph.facebook.com/{$page_id}/posts?{$url_queries}&access_token={$access_token}";
		$data = wp_remote_get( $url );
		$facebook_feed_data = json_decode( wp_remote_retrieve_body( $data ), true );

		return $facebook_feed_data;
	}

	/**
	 * Render a currency symbol with position
	 * 
	 * @param mixed $settings
	 * @param string $symbol
	 * @param string $position
	 * 
	 * @return void
	 */
	public static function render_currency_symbol( $settings, $symbol, $position ) {
		$currency_position = $settings['currency_position'] ?? 'before';
		$position_setting = ! empty( $currency_position ) ? $currency_position : 'before';

		if ( ! empty( $symbol ) && $position === $position_setting ) {
			echo '<span class="banae-pricing-table__currency">' . esc_html( $symbol ) . '</span>';
		}
	}

	/**
	 * Get symbol of a currency
	 * 
	 * @param mixed $symbol_name
	 * 
	 * @return string
	 */
	public static function get_currency_symbol( $symbol_name ) {
		$symbols = [
			'dollar' => '&#36;',
			'euro' => '&#128;',
			'franc' => '&#8355;',
			'pound' => '&#163;',
			'ruble' => '&#8381;',
			'shekel' => '&#8362;',
			'baht' => '&#3647;',
			'yen' => '&#165;',
			'won' => '&#8361;',
			'guilder' => '&fnof;',
			'peso' => '&#8369;',
			'peseta' => '&#8359',
			'lira' => '&#8356;',
			'rupee' => '&#8360;',
			'indian_rupee' => '&#8377;',
			'real' => 'R$',
			'krona' => 'kr',
		];

		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

	/**
	 * Content truncate
	 * 
	 * @param mixed $text
	 * @param mixed $maxLength
	 * 
	 * @return string
	 */
	public static function banae_excerpt( $text, $maxLength = 50 ) {

		if ( strlen( $text ) > $maxLength ) {

			$truncatedText = substr( $text, 0, $maxLength );
			$lastSpace = strrpos( $truncatedText, ' ' );

			if ( $lastSpace !== false ) { // Ensure a space was found
				$truncatedText = substr( $truncatedText, 0, $lastSpace );
			}

			$truncatedText .= "..."; // Add ellipsis

		} else {

			$truncatedText = $text;

		}

		return $truncatedText;
	}

	/**
	 * Get all Currencies
	 * 
	 * @return array
	 */
	public static function get_currency() {
		return [
			'ALL' => 'Albania Lek (ALL)',
			'AFN' => 'Afghanistan Afghani (AFN)',
			'ARS' => 'Argentina Peso (ARS)',
			'AWG' => 'Aruba Guilder (AWG)',
			'AUD' => 'Australia (AUD)',
			'AZN' => 'Azerbaijan (AZN)',
			'BSD' => 'Bahamas Dollar (BSD)',
			'BBD' => 'Barbados Dollar (BBD)',
			'BDT' => 'Bangladeshi taka (BDT)',
			'BYR' => 'Belarus Ruble (BYR)',
			'BZD' => 'Belize Dollar (BZD)',
			'BMD' => 'Bermuda Dollar (BMD)',
			'BOB' => 'Bolivia Boliviano (BOB)',
			'BAM' => 'Bosnia (BAM)',
			'BWP' => 'Botswana Pula (BWP)',
			'BGN' => 'Bulgaria Lev (BGN)',
			'BRL' => 'Brazil Real (BRL)',
			'BND' => 'Brunei Darussalam (BND)',
			'KHR' => 'Cambodia Riel (KHR)',
			'CAD' => 'Canada (CAD)',
			'KYD' => 'Cayman Islands (KYD)',
			'CLP' => 'Chile Peso (CLP)',
			'CNY' => 'China Yuan (CNY)',
			'COP' => 'Colombia Peso (COP)',
			'CRC' => 'Costa Rica Colon (CRC)',
			'HRK' => 'Croatia Kuna (HRK)',
			'CUP' => 'Cuba Peso (CUP)',
			'CZK' => 'Czech Republic Koruna (CZK)',
			'DKK' => 'Denmark Krone (DKK)',
			'DOP' => 'Dominican Republic (DOP)',
			'XCD' => 'East Caribbean (XCD)',
			'EGP' => 'Egypt Pound (EGP)',
			'SVC' => 'El Salvador Colon (SVC)',
			'EEK' => 'Estonia Kroon (EEK)',
			'EUR' => 'Euro (EUR)',
			'FKP' => 'Falkland Islands (FKP)',
			'FJD' => 'Fiji Dollar (FJD)',
			'GHC' => 'Ghana Cedis (GHC)',
			'GIP' => 'Gibraltar Pound (GIP)',
			'GTQ' => 'Guatemala Quetzal (GTQ)',
			'GGP' => 'Guernsey Pound (GGP)',
			'GYD' => 'Guyana Dollar (GYD)',
			'HNL' => 'Honduras Lempira (HNL)',
			'HKD' => 'Hong Kong Dollar (HKD)',
			'HUF' => 'Hungary Forint (HUF)',
			'ISK' => 'Iceland Krona (ISK)',
			'INR' => 'India Rupee (INR)',
			'IDR' => 'Indonesia Rupiah (IDR)',
			'IRR' => 'Iran Rial (IRR)',
			'IMP' => 'Isle of Man Pound (IMP)',
			'ILS' => 'Israel Shekel (ILS)',
			'JMD' => 'Jamaica Dollar (JMD)',
			'JPY' => 'Japan Yen (JPY)',
			'JEP' => 'Jersey Pound (JEP)',
			'KZT' => 'Kazakhstan Tenge (KZT)',
			'KPW' => 'Korea (North) Won (KPW)',
			'KRW' => 'Korea (South) Won (KRW)',
			'KGS' => 'Kyrgyzstan Som (KGS)',
			'LAK' => 'Laos Kip (LAK)',
			'LVL' => 'Latvia Lat (LVL)',
			'LBP' => 'Lebanon Pound (LBP)',
			'LRD' => 'Liberia Dollar (LRD)',
			'LTL' => 'Lithuania Litas (LTL)',
			'MKD' => 'Macedonia Denar (MKD)',
			'MYR' => 'Malaysia Ringgit (MYR)',
			'MUR' => 'Mauritius Rupee (MUR)',
			'MXN' => 'Mexico Peso (MXN)',
			'MNT' => 'Mongolia Tughrik (MNT)',
			'MZN' => 'Mozambique Metical (MZN)',
			'NAD' => 'Namibia Dollar (NAD)',
			'NPR' => 'Nepal Rupee (NPR)',
			'ANG' => 'Netherlands (ANG)',
			'NZD' => 'New Zealand Dollar (NZD)',
			'NIO' => 'Nicaragua Cordoba (NIO)',
			'NGN' => 'Nigeria Naira (NGN)',
			'NOK' => 'Norway Krone (NOK)',
			'OMR' => 'Oman Rial (OMR)',
			'PKR' => 'Pakistan Rupee (PKR)',
			'PAB' => 'Panama Balboa (PAB)',
			'PYG' => 'Paraguay Guarani (PYG)',
			'PEN' => 'Peru Nuevo Sol (PEN)',
			'PHP' => 'Philippines Peso (PHP)',
			'PLN' => 'Poland Zloty (PLN)',
			'QAR' => 'Qatar Riyal (QAR)',
			'RON' => 'Romania New Leu (RON)',
			'RUB' => 'Russia Ruble (RUB)',
			'SHP' => 'Saint Helena Pound (SHP)',
			'SAR' => 'Saudi Arabia Riyal (SAR)',
			'RSD' => 'Serbia Dinar (RSD)',
			'SCR' => 'Seychelles Rupee (SCR)',
			'SGD' => 'Singapore Dollar (SGD)',
			'SBD' => 'Solomon Islands Dollar (SBD)',
			'SOS' => 'Somalia Shilling (SOS)',
			'ZAR' => 'South Africa Rand (ZAR)',
			'LKR' => 'Sri Lanka Rupee (LKR)',
			'SEK' => 'Sweden Krona (SEK)',
			'CHF' => 'Switzerland Franc (CHF)',
			'SRD' => 'Suriname Dollar (SRD)',
			'SYP' => 'Syria Pound (SYP)',
			'TWD' => 'Taiwan New Dollar (TWD)',
			'THB' => 'Thailand Baht (THB)',
			'TTD' => 'Trinidad Dollar (TTD)',
			'TRY' => 'Turkey Lira (TRY)',
			'TRL' => 'Turkey Lira (TRL)',
			'TVD' => 'Tuvalu Dollar (TVD)',
			'UAH' => 'Ukraine Hryvna (UAH)',
			'GBP' => 'United Kingdom (GBP)',
			'USD' => 'United States (USD)',
			'UYU' => 'Uruguay Peso (UYU)',
			'UZS' => 'Uzbekistan Som (UZS)',
			'VEF' => 'Venezuela Bolivar (VEF)',
			'VND' => 'Viet Nam Dong (VND)',
			'YER' => 'Yemen Rial (YER)',
			'ZWD' => 'Zimbabwe (ZWD)',
		];

	}

}