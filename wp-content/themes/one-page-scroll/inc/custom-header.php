<?php
/**
 *
 * @package onepagescroll
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses onepagescroll_header_style()
 * @uses onepagescroll_admin_header_style()
 * @uses onepagescroll_admin_header_image()
 */
function onepagescroll_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'onepagescroll_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1690,
		'height'                 => 250,
//		'flex-height'            => true,
		'wp-head-callback'       => 'onepagescroll_header_style',
		'admin-head-callback'    => 'onepagescroll_admin_header_style',
		'admin-preview-callback' => 'onepagescroll_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'onepagescroll_custom_header_setup' );

if ( ! function_exists( 'onepagescroll_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see onepagescroll_custom_header_setup().
 */
function onepagescroll_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.page .logo-container h2,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title,
		.page .logo-container h2,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // onepagescroll_header_style

if ( ! function_exists( 'onepagescroll_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see onepagescroll_custom_header_setup().
 */
function onepagescroll_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
	</style>
<?php
}
endif; // onepagescroll_admin_header_style

