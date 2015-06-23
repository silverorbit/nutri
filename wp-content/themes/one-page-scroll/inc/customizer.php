<?php
/**
 * onepagescroll Theme Customizer
 *
 * @package onepagescroll
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function onepagescroll_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'refresh';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'refresh';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';
	

}
add_action( 'customize_register', 'onepagescroll_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function onepagescroll_customize_preview_js() {
	wp_enqueue_script( 
		  'onepagescroll_customizer',			//Give the script an ID
		  get_template_directory_uri().'/js/customizer.js',//Point to file
		  array( 'jquery' ),	//Define dependencies
		  '',						//Define a version (optional) 
		  true						//Put script in footer?
	);

}
add_action( 'customize_controls_enqueue_scripts', 'onepagescroll_customize_preview_js' );
