<?php
/**
 * Plugin shortcode functions
 *
 * @package SC
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Function to process the [stripe] shortcode
 * 
 * @since 1.0.0
 */
function sc_stripe_shortcode( $attr, $content = null ) {
	
	global $sc_options;

	// Variable to hold each form's data-sc-id attribute.
	static $sc_id = 0;

	// Increment variable for each iteration.
	$sc_id++;

	extract( shortcode_atts( array(
					'name'                  => ( ! empty( $sc_options['name'] ) ? $sc_options['name'] : get_bloginfo( 'title' ) ),
					'description'           => '',
					'amount'                => '',
					'image_url'             => ( ! empty( $sc_options['image_url'] ) ? $sc_options['image_url'] : '' ),
					'currency'              => ( ! empty( $sc_options['currency'] ) ? $sc_options['currency'] : 'USD' ),
					'checkout_button_label' => ( ! empty( $sc_options['checkout_button_label'] ) ? $sc_options['checkout_button_label'] : '' ),
					'billing'               => ( ! empty( $sc_options['billing'] ) ? 'true' : 'false' ),    // true or false
					'payment_button_label'  => ( ! empty( $sc_options['payment_button_label'] ) ? $sc_options['payment_button_label'] : __( 'Pay with Card', 'sc' ) ),
					'enable_remember'       => ( ! empty( $sc_options['enable_remember'] ) ? 'true' : 'false' ),    // true or false
					'bitcoin'               => ( ! empty( $sc_options['use_bitcoin'] ) ? 'true' : 'false' ),    // true or false
					'success_redirect_url'  => ( ! empty( $sc_options['success_redirect_url'] ) ? $sc_options['success_redirect_url'] : get_permalink() ),
					'failure_redirect_url'  => ( ! empty( $sc_options['failure_redirect_url'] ) ? $sc_options['failure_redirect_url'] : get_permalink() ),
					'prefill_email'         => 'false',
					'verify_zip'            => ( ! empty( $sc_options['verify_zip'] ) ? 'true' : 'false' ),
					'test_mode'             => 'false',
					'id'                    => null,
					'alipay'                => ( ! empty( $sc_options['alipay'] ) ? $sc_options['alipay'] : 'false' ), // true, false or auto
					'alipay_reusable'       => ( ! empty( $sc_options['alipay_reusable'] ) ? 'true' : 'false' ), // true or false
					'locale'                => ( ! empty( $sc_options['locale'] ) ? 'auto' : '' ), // empty or auto
					'payment_details_placement' => 'above',
				), $attr, 'stripe' ) );

	// Generate custom form id attribute if one not specified.
	// Rename var for clarity.
	$form_id = $id;
	if ( $form_id === null || empty( $form_id ) ) {
		$form_id = 'sc_checkout_form_' . $sc_id;
	}
	
	$test_mode = ( isset( $_GET['test_mode'] ) ? 'true' : $test_mode );
	
	// Check if in test mode or live mode
	if( ! empty( $sc_options['enable_live_key'] ) && $sc_options['enable_live_key'] == 1 && $test_mode != 'true' ) {
		$data_key = ( ! empty( $sc_options['live_publish_key'] ) ? $sc_options['live_publish_key'] : '' );
		
		if( empty( $sc_options['live_secret_key'] ) ) {
			$data_key = '';
		}
	} else {
		$data_key = ( ! empty( $sc_options['test_publish_key'] ) ? $sc_options['test_publish_key'] : '' );
		
		if( empty( $sc_options['test_secret_key'] ) ) {
			$data_key = '';
		}
	}
	
	if( empty( $data_key ) ) {
		
		if( current_user_can( 'manage_options' ) ) {
			return '<h6>' . __( 'You must enter your API keys before the Stripe button will show up here.', 'sc' ) . '</h6>';
		}
		
		return '';
	}
	
	if( ! empty( $prefill_email ) && $prefill_email !== 'false' ) {
		// Get current logged in user email
		if( is_user_logged_in() ) {
			$prefill_email = get_userdata( get_current_user_id() )->user_email;
		} else { 
			$prefill_email = 'false';
		}
	}

	// Populate <form> tag including "id" and data-sc-id attributes.
	$html  =
		'<form method="POST" action="" class="sc-checkout-form" ' .
		'id="' . esc_attr( $form_id ) . '" ' .
		'data-sc-id="' . $sc_id . '">';
	
	$html .=
		'<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="' . $data_key . '" ' .
		( ! empty( $image_url ) ? 'data-image="' . $image_url . '" ' : '' ) .
		( ! empty( $name ) ? 'data-name="' . $name . '" ' : '' ) .
		( ! empty( $description ) ? 'data-description="' . $description . '" ' : '' ) .
		( ! empty( $amount ) ? 'data-amount="' . $amount . '" ' : '' ) .
		( ! empty( $currency ) ? 'data-currency="' . $currency . '" ' : '' ) .
		( ! empty( $checkout_button_label ) ? 'data-panel-label="' . $checkout_button_label . '" ' : '' ) .
		( ! empty( $verify_zip ) ? 'data-zip-code="' . $verify_zip . '" ' : '' ) .
		( ! empty( $prefill_email ) && 'false' != $prefill_email ? 'data-email="' . $prefill_email . '" ' : '' ) .
		( ! empty( $payment_button_label ) ? 'data-label="' . $payment_button_label . '" ' : '' ) .
		( ! empty( $enable_remember ) ? 'data-allow-remember-me="' . $enable_remember . '" ' : 'data-allow-remember-me="true" ' ) .
		( ! empty( $bitcoin ) ? 'data-bitcoin="' . $bitcoin . '" ' : '' ) .
		( ! empty( $billing ) ? 'data-billing-address="' . $billing . '" ' : 'data-billing-address="false" ' ) .
		( ! empty( $alipay ) ? 'data-alipay="' . $alipay . '" ' : '' ) .
		( ! empty( $alipay_reusable ) ? 'data-alipay-reusable="' . $alipay_reusable . '" ' : '' ) .
		( ! empty( $locale ) ? 'data-locale="' . $locale . '" ' : '' ) .
		'></script>';
	
	$html .= '<input type="hidden" name="sc-name" value="' . esc_attr( $name ) . '" />';
	$html .= '<input type="hidden" name="sc-description" value="' . esc_attr( $description ) . '" />';
	$html .= '<input type="hidden" name="sc-amount" class="sc_amount" value="' . esc_attr( $amount ) . '" />';
	$html .= '<input type="hidden" name="sc-redirect" value="' . esc_attr( ( ! empty( $success_redirect_url ) ? $success_redirect_url : get_permalink() ) ) . '" />';
	$html .= '<input type="hidden" name="sc-redirect-fail" value="' . esc_attr( ( ! empty( $failure_redirect_url ) ? $failure_redirect_url : get_permalink() ) ) . '" />';
	$html .= '<input type="hidden" name="sc-currency" value="' .esc_attr( $currency ) . '" />';
	$html .= '<input type="hidden" name="sc-details-placement" value="' . ( $payment_details_placement == 'below' ? 'below' : 'above' ) . '" />';
	
	
	if( $test_mode == 'true' ) {
		$html .= '<input type="hidden" name="sc_test_mode" value="true" />';
	}
	
	// Add a filter here to allow developers to hook into the form
	$filter_html = '';
	$html .= apply_filters( 'sc_before_payment_button', $filter_html );

	$html .= '</form>';

	//Stripe minimum amount allowed.
	$stripe_minimum_amount = 50;

	if( ( empty( $amount ) || $amount < $stripe_minimum_amount ) || ! isset( $amount ) ) {

		if( current_user_can( 'manage_options' ) ) {
			$html =  '<h6>';
			$html .= __( 'Stripe checkout requires an amount of ', 'sc' ) . $stripe_minimum_amount;
			$html .= ' (' . sc_stripe_to_formatted_amount( $stripe_minimum_amount, $currency ) . ' ' . $currency . ')';
			$html .= __( ' or larger.', 'sc' );
			$html .= '</h6>';

			return $html;
		}
		
		return '';
		
	} else if( ! isset( $_GET['charge'] ) ) {
		return $html;
	}
	
	return '';
	
}
add_shortcode( 'stripe', 'sc_stripe_shortcode' );
