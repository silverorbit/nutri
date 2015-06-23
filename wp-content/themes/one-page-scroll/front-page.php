<?php
/**
 * Front page template for theme
 */

get_header();
if ( get_option( 'show_on_front' ) == 'posts' ){

	load_template( get_home_template() );
	
} else {
	 $enable_home_page = absint(of_get_option('enable_home_page', '1'));
	if( $enable_home_page == 1 )
	get_template_part( 'content', 'featured' );
	else
	load_template( get_home_template() );
	
	
}
get_footer();
