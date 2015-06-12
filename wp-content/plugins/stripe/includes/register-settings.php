<?php

/**
 * Register all settings needed for the Settings API.
 *
 * @package    SC
 * @subpackage Includes
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *  Main function to register all of the plugin settings
 *
 * @since 1.0.0
 */
function sc_register_settings() {
	
	global $sc_options;
	
	$sc_options = array();
	
	$sc_settings = array(

		/* Default Settings */

		'default' => array(
			'note' => array(
				'id'   => 'settings_note',
				'name' => '',
				'desc' => sprintf( '<a href="%s" target="_blank">%s</a>', sc_ga_campaign_url( SC_WEBSITE_BASE_URL . 'docs/shortcodes/stripe-checkout/', 'stripe_checkout', 'settings', 'docs' ), __( 'See shortcode options and examples', 'sc' ) ) . ' ' .
				          __( 'for', 'sc' ) . ' ' . Stripe_Checkout::get_plugin_title() . '<br/>' .
				          '<p class="description">' . __( 'Shortcode attributes take precedence and will always override site-wide default settings.', 'sc' ) . '</p>',
				'type' => 'section'
			),
			'name' => array(
				'id'   => 'name',
				'name' => __( 'Site Name', 'sc' ),
				'desc' => __( 'The name of your store or website. Defaults to Site Name.' , 'sc' ),
				'type' => 'text',
				'size' => 'regular-text'
			),
			'currency' => array(
				'id'   => 'currency',
				'name' => __( 'Currency Code', 'sc' ),
				'desc' => __( 'Specify a currency using it\'s ', 'sc' ) .
							sprintf( '<a href="%s" target="_blank">%s</a>', 'https://support.stripe.com/questions/which-currencies-does-stripe-support', __( '3-letter ISO Code', 'sc' ) ) . '. ' .
							__( 'Defaults to USD.', 'sc' ),
				'type' => 'text',
				'size' => 'regular-text'
			),
			'image_url' => array(
				'id'   => 'image_url',
				'name' => __( 'Image URL', 'sc' ),
				'desc' => __( 'A URL pointing to a square image of your brand or product. The recommended minimum size is 128x128px.' , 'sc' ),
				'type' => 'text',
				'size' => 'regular-text'
			),
			'checkout_button_label' => array(
				'id'   => 'checkout_button_label',
				'name' => __( 'Checkout Button Label', 'sc' ),
				'desc' => __( 'The label of the payment button in the checkout form. You can use {{amount}} to display the amount.' , 'sc' ),
				'type' => 'text',
				'size' => 'regular-text'
			),
			'payment_button_label' => array(
				'id'   => 'payment_button_label',
				'name' => __( 'Payment Button Label', 'sc' ),
				'desc' => __( 'Text to display on the default blue button that users click to initiate a checkout process.' , 'sc' ),
				'type' => 'text',
				'size' => 'regular-text'
			),
			'success_redirect_url' => array(
				'id'   => 'success_redirect_url',
				'name' => __( 'Success Redirect URL', 'sc' ),
				'desc' => __( 'The URL that the user should be redirected to after a successful payment.' , 'sc' ),
				'type' => 'text',
				'size' => 'regular-text'
			),
			'disable_success_message' => array(
				'id'   => 'disable_success_message',
				'name' => __( 'Disable Success Message', 'sc' ),
				'desc' => __( 'Disable default success message.', 'sc' ) . '<br/>' .
				          '<p class="description">' . __( 'Useful if you are redirecting to your own success page.', 'sc' ) . '</p>',
				'type' => 'checkbox'
			),
			'failure_redirect_url' => array(
				'id'   => 'failure_redirect_url',
				'name' => __( 'Failure Redirect URL', 'sc' ),
				'desc' => __( 'The URL that the user should be redirected to after a failed payment.' , 'sc' ),
				'type' => 'text',
				'size' => 'regular-text'
			),
			'billing' => array(
				'id'   => 'billing',
				'name' => __( 'Enable Billing Address', 'sc' ),
				'desc' => __( 'Require the user to enter their billing address during checkout.', 'sc' ) . 
						( class_exists( 'Stripe_Checkout_Pro' ) ? '<br/><p class="description">' . __( 'See below if you also need to require a shipping address.', 'sc' ) . '</p>' : '' ),
				'type' => 'checkbox'
			),
			'verify_zip' => array(
				'id'   => 'verify_zip',
				'name' => __( 'Verify Zip Code', 'sc' ),
				'desc' => __( 'Verifies the zip code of the card.', 'sc' ),
				'type' => 'checkbox'
			),
			'enable_remember' => array(
				'id'   => 'enable_remember',
				'name' => __( 'Enable "Remember Me"', 'sc' ),
				'desc' => __( 'Adds a "Remember Me" option to the checkout form to allow the user to store their credit card for future use with other sites using Stripe. ', 'sc' ) .
				          sprintf( '<a href="%s" target="_blank">%s</a>', 'https://stripe.com/checkout/info', __( 'See how it works', 'sc' ) ),
				'type' => 'checkbox'
			),
			'use_bitcoin' => array(
				'id'   => 'use_bitcoin',
				'name' => __( 'Enable Bitcoin', 'sc' ),
				'desc' => sprintf( __( 'Enable accepting <a href="%s" target="_blank">Bitcoin</a> as a payment option.', 'sc' ), 'https://stripe.com/docs/guides/bitcoin' ),
				'type' => 'checkbox'
			),
			'alipay' => array(
				'id'      => 'alipay',
				'name'    => __( 'Enable Alipay (beta)', 'sc' ),
				'desc'    => sprintf( __( 'Enable accepting <a href="%s" target="_blank">Alipay</a> as a payment option.', 'sc' ), 'https://stripe.com/docs/guides/alipay-beta' ),
				'type'    => 'select',
				'options' => array(
					'false' => __( 'Disabled', 'sc' ),
					'true'  => __( 'Enabled', 'sc' ),
					'auto'  => __( 'Auto-detect', 'sc' )
				)
			),
			'alipay_reusable' => array(
				'id'   => 'alipay_reusable',
				'name' => __( 'Enable Alipay Reusable', 'sc' ),
				'desc' => __( 'Enable reusable access to the customer’s account when using Alipay.', 'sc' ),
				'type' => 'checkbox'
			),
			'locale' => array( 
				'id'   => 'locale',
				'name' => __( 'Set Auto Locale', 'sc' ),
				'desc' => __( "This option will render a localized Checkout UI, based upon the language preferences of the user's web browser.", 'sc' ),
				'type' => 'checkbox'
			),
			'disable_css' => array(
				'id'   => 'disable_css',
				'name' => __( 'Disable Plugin CSS', 'sc' ),
				'desc' => __( 'If this option is checked, this plugin\'s CSS file will not be referenced.', 'sc' ),
				'type' => 'checkbox'
			),
			'always_enqueue' => array(
				'id'   => 'always_enqueue',
				'name' => __( 'Always Enqueue Scripts & Styles', 'sc' ),
				'desc' => __( 'Enqueue this plugin\'s scripts and styles on every post and page.', 'sc' ) . '<br/>' .
				          '<p class="description">' . __( 'Useful if using shortcodes in widgets or other non-standard locations.', 'sc' ) . '</p>',
				'type' => 'checkbox'
			),
			'uninstall_save_settings' => array(
				'id'   => 'uninstall_save_settings',
				'name' => __( 'Save Settings', 'sc' ),
				'desc' => __( 'Save your settings when uninstalling this plugin.', 'sc' ) . '<br/>' .
				          '<p class="description">' . __( 'Useful when upgrading or re-installing.', 'sc' ) . '</p>',
				'type' => 'checkbox'
			)
		),
		
		/* Keys settings */

		'keys' => array(
			'enable_live_key' => array(
				'id'   => 'enable_live_key',
				'name' => __( 'Test or Live Mode', 'sc' ),
				'desc' => '<p class="description">' . __( 'Toggle between using your Test or Live API keys.', 'sc' ) . '</p>',
				'type' => 'toggle_control'
			),
			'note' => array(
				'id'   => 'api_key_note',
				'name' => '',
				'desc' => sprintf( '<a href="%s" target="_blank">%s</a>', 'https://dashboard.stripe.com/account/apikeys', __( 'Find your Stripe API keys here', 'sc' ) ),
				'type' => 'section'
			),
			'test_secret_key' => array(
				'id'   => 'test_secret_key',
				'name' => __( 'Test Secret Key', 'sc' ),
				'desc' => '',
				'type' => 'text',
				'size' => 'regular-text'
			),
			'test_publish_key' => array(
				'id'   => 'test_publish_key',
				'name' => __( 'Test Publishable Key', 'sc' ),
				'desc' => '',
				'type' => 'text',
				'size' => 'regular-text'
			),
			'live_secret_key' => array(
				'id'   => 'live_secret_key',
				'name' => __( 'Live Secret Key', 'sc' ),
				'desc' => '',
				'type' => 'text',
				'size' => 'regular-text'
			),
			'live_publish_key' => array(
				'id'   => 'live_publish_key',
				'name' => __( 'Live Publishable Key', 'sc' ),
				'desc' => '',
				'type' => 'text',
				'size' => 'regular-text'
			)
		)
	);
	
	$sc_settings = apply_filters( 'sc_settings', $sc_settings );
	
	$sc_settings_title = '';
	
	foreach( $sc_settings as $setting => $option ) {
		
		if( false == get_option( 'sc_settings_' . $setting ) ) {
			add_option( 'sc_settings_' . $setting );
		}
		
		add_settings_section(
			'sc_settings_' . $setting,
			apply_filters( 'sc_settings_' . $setting . '_title', $sc_settings_title ),
			'__return_false',
			'sc_settings_' . $setting
		);
		
		foreach ( $sc_settings[$setting] as $option ) {
			add_settings_field(
				'sc_settings_' . $setting . '[' . $option['id'] . ']',
				$option['name'],
				function_exists( 'sc_' . $option['type'] . '_callback' ) ? 'sc_' . $option['type'] . '_callback' : 'sc_missing_callback',
				'sc_settings_' . $setting,
				'sc_settings_' . $setting,
				sc_get_settings_field_args( $option, $setting )
			);
		}
		
		register_setting( 'sc_settings_' . $setting, 'sc_settings_' . $setting, 'sc_settings_sanitize' );
		
		$sc_options = array_merge( $sc_options, is_array( get_option( 'sc_settings_' . $setting ) ) ? get_option( 'sc_settings_' . $setting ) : array() );
	}
	
	update_option( 'sc_settings_master', $sc_options );
	
}
add_action( 'admin_init', 'sc_register_settings' );


/*
 * Return generic add_settings_field $args parameter array.
 *
 * @since     1.0.0
 *
 * @param   string  $option   Single settings option key.
 * @param   string  $section  Section of settings apge.
 * @return  array             $args parameter to use with add_settings_field call.
 */
function sc_get_settings_field_args( $option, $section ) {
	$settings_args = array(
		'id'      => $option['id'],
		'desc'    => $option['desc'],
		'name'    => $option['name'],
		'section' => $section,
		'size'    => isset( $option['size'] ) ? $option['size'] : null,
		'options' => isset( $option['options'] ) ? $option['options'] : '',
		'std'     => isset( $option['std'] ) ? $option['std'] : '',
		'product' => isset( $option['product'] ) ? $option['product'] : ''
	);

	// Link label to input using 'label_for' argument if text, textarea, password, select, or variations of.
	// Just add to existing settings args array if needed.
	if ( in_array( $option['type'], array( 'text', 'select', 'textarea', 'password', 'number' ) ) ) {
		$settings_args = array_merge( $settings_args, array( 'label_for' => 'sc_settings_' . $section . '[' . $option['id'] . ']' ) );
	}

	return $settings_args;
}


function sc_toggle_control_callback( $args ) {
	global $sc_options;
	
	$checked = ( isset( $sc_options[$args['id']] ) ? checked( 1, $sc_options[$args['id']], false ) : '' );
	
	$html = '<div class="sc-toggle-switch-wrap">
			<label class="switch-light switch-candy switch-candy-blue" onclick="">
				<input type="checkbox" id="sc_settings_' . $args['section'] . '[' . $args['id'] . ']" name="sc_settings_' . $args['section'] . '[' . $args['id'] . ']" value="1" ' . $checked . '/>
				<span>
				  <span>' . __( 'Test', 'sc' ) . '</span>
				  <span>' . __( 'Live', 'sc' ) . '</span>
				</span>
				<a></a>
			</label></div>';
	
	echo $html;
}

/**
 * Textbox callback function
 * Valid built-in size CSS class values:
 * small-text, regular-text, large-text
 * 
 * @since 1.0.0
 * 
 */
function sc_text_callback( $args ) {
	global $sc_options;

	if ( isset( $sc_options[ $args['id'] ] ) ) {
		$value = $sc_options[ $args['id'] ];
	} else {
		$value = isset( $args['std'] ) ? $args['std'] : '';
	}
	
	$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : '';
	$html = "\n" . '<input type="text" class="' . $size . '" id="sc_settings_' . $args['section'] . '[' . $args['id'] . ']" name="sc_settings_' . $args['section'] . '[' . $args['id'] . ']" value="' . trim( esc_attr( $value ) ) . '"/>' . "\n";

	// Render and style description text underneath if it exists.
	if ( ! empty( $args['desc'] ) ) {
		$html .= '<p class="description">' . $args['desc'] . '</p>' . "\n";
	}

	echo $html;
}

/*
 * Single checkbox callback function
 * 
 * @since 1.0.0
 * 
 */
function sc_checkbox_callback( $args ) {
	global $sc_options;
	

	$checked = ( isset( $sc_options[$args['id']] ) ? checked( 1, $sc_options[$args['id']], false ) : '' );

	$html = "\n" . '<input type="checkbox" id="sc_settings_' . $args['section'] . '[' . $args['id'] . ']" name="sc_settings_' . $args['section'] . '[' . $args['id'] . ']" value="1" ' . $checked . '/>' . "\n";

	// Render description text directly to the right in a label if it exists.
	if ( ! empty( $args['desc'] ) )
		$html .= '<label for="sc_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>' . "\n";

	echo $html;
}


/*
 * Section callback function
 * 
 * @since 1.0.0
 * 
 */
function sc_section_callback( $args ) {
	$html = '';
	
	if ( ! empty( $args['desc'] ) ) {
		$html .= $args['desc'];
	}

	echo $html;
}

/*
 * Select box callback function
 */
function sc_select_callback( $args ) {
	global $sc_options;

	// Return empty string if no options.
	if ( empty( $args['options'] ) ) {
		echo '';
		return;
	}

	$html = "\n" . '<select id="sc_settings_' . $args['section'] . '[' . $args['id'] . ']" name="sc_settings_' . $args['section'] . '[' . $args['id'] . ']"/>' . "\n";

	foreach ( $args['options'] as $option => $name ) :
		$selected = isset( $sc_options[$args['id']] ) ? selected( $option, $sc_options[$args['id']], false ) : '';
		$html .= '<option value="' . $option . '" ' . $selected . '>' . $name . '</option>' . "\n";
	endforeach;

	$html .= '</select>' . "\n";

	// Render and style description text underneath if it exists.
	if ( ! empty( $args['desc'] ) )
		$html .= '<p class="description">' . $args['desc'] . '</p>' . "\n";

	echo $html;
}

/*
 * Function we can use to sanitize the input data and return it when saving options
 * 
 * @since 1.0.0
 * 
 */
function sc_settings_sanitize( $input ) {
	
	// Clean up the API keys
	if ( isset( $_POST['sc_settings_keys'] ) ) {
		foreach( $input as $k => $v ) {
			
			// Trim first
			$key = trim( $v );
			
			// Now search for a space
			$space = strpos( $key, ' ' );
			
			if( $space !== false ) {
				$key = substr( $key, 0, $space );
			}
			
			// Just trimming again to remove any possible leftover spaces from the string replace
			$input[$k] = trim( $key );
		}
	}
	
	return $input;
}

/**
 * Radio button callback function
 *
 * @since 1.1.1
 */
function sc_radio_callback( $args ) {
	global $sc_options;

	foreach ( $args['options'] as $key => $option ) {
		$checked = false;
	

		if ( isset( $sc_options[ $args['id'] ] ) && $sc_options[ $args['id'] ] == $key )
			$checked = true;
		elseif( isset( $args['std'] ) && $args['std'] == $key && ! isset( $sc_options[ $args['id'] ] ) )
			$checked = true;

		echo '<input name="sc_settings_' . $args['section'] . '[' . $args['id'] . ']" id="sc_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']" type="radio" value="' . $key . '" ' . checked(true, $checked, false) . '/>&nbsp;';
		echo '<label for="sc_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>';
	}

	echo '<p class="description">' . $args['desc'] . '</p>';
}

/*
 *  Default callback function if correct one does not exist
 * 
 * @since 1.0.0
 * 
 */
function sc_missing_callback( $args ) {
	printf( __( 'The callback function used for the <strong>%s</strong> setting is missing.', 'sc' ), $args['id'] );
}

/*
 * Set the default settings when first installed
 * 
 * @since 1.0.0
 * 
 */
function sc_set_defaults() {
	if( ! get_option( 'sc_has_run' ) ) {
		$defaults = get_option( 'sc_settings_default' );
		$defaults['enable_remember'] = 1;
		$defaults['uninstall_save_settings'] = 1;
		$defaults['always_enqueue'] = 1;

		update_option( 'sc_settings_default', $defaults );
		
		add_option( 'sc_has_run', 1 );
	}
}

/*
 * Update the global settings
 * 
 * @since 1.1.1
 */
function sc_get_settings() {
	
	$sc_options = get_option( 'sc_settings_master' );
	
	if( isset( $sc_options['currency'] ) ) {
		$sc_options['currency'] = strtoupper( $sc_options['currency'] );
	}

	return $sc_options;
}
