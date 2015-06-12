<?php
/*
  Plugin Name: WooProduct Shortcode
  Description: A shortcode for dropping single WooCommerce products into posts and pages that can be formatted to fit nicely into your content.
  Author: wpBiz.co
  Author URI: http://wpbiz.co
  Plugin URI: http://wpbiz.co
  Version: 0.2
  Requires at least: 3.0.0
  Tested up to: 3.9

 */

/*
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


class WooProductShortcode {

	function __construct(){

		add_action( 'admin_init', array( $this, 'wooproduct_check_plugin') );
		add_shortcode( 'wooproduct', array( $this, 'wooproduct_shortcode') );

		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
	}

/**
	 * Display a single product without excess formatting
	 */
	function wooproduct_shortcode( $atts ) {
	  	if (empty($atts)) return;


	  	$args = array(
	    	'post_type' => 'product',
	    	'posts_per_page' => 1,
	    	'no_found_rows' => 1,
	    	'post_status' => 'publish'
	  	);

	  	if(isset($atts['sku'])){
	  		$atts['sku'] = strip_tags($atts['sku']);
	    	$args['meta_query'][] = array(
	      		'key' => '_sku',
	      		'value' => $atts['sku'],
	      		'compare' => '='
	    	);
	    	//echo 'Checking SKU '.$atts['sku'];
	  	}

	  	if(isset($atts['id'])){
	  		$atts['id'] = strip_tags($atts['id']);
	    	$args['p'] = $atts['id'];
	  	}

	  	if (isset($atts['style'])){
	  	   $style = $atts['style'];
  	   } else { // default style
  	      //$style = 'float: right; width: 200px; margin-left: 10px;';
  	   		$style = '';
  	   }

  	   if (isset($atts['class'])){
	  	   $class = ' '.$atts['class'];
  	   } else { // default class
  	      $class = '';
  	   }

	  	ob_start();

		$products = new WP_Query( $args );

		if ( $products->have_posts() ) :

			while ( $products->have_posts() ) : $products->the_post(); 

				include ('wooproduct-template.php');

			endwhile; // end of the loop.

		endif;

		wp_reset_postdata();

		return '<div class="woocommerce">' . ob_get_clean() . '</div>';
	}

	function wooproduct_layout($product){

	}

	function wooproduct_notice_missingwc() {
	    ?>
	    <div class="error">
	        <p><?php _e( 'WooProduct Shortcode requires WooCommerce to be active.', 'wooproduct' ); ?></p>
	    </div>
	    <?php
	}
	function wooproduct_check_plugin() {
	  // this plugin requires WooCommerce to be active
	   If (!is_plugin_active('woocommerce/woocommerce.php')) {
	         //WooCommerce is not active, let the admin know
	         add_action( 'admin_notices', 'wooproduct_notice_missingwc' );
	         
	   }

	}

	public function register_plugin_styles() {
		wp_register_style( 'wooproduct-shortcode', plugins_url( 'wooproduct-shortcode/css/wooproduct-shortcode.css' ) );
		wp_enqueue_style( 'wooproduct-shortcode' );
	}

}

$wooproduct_shortcode = new WooProductShortcode();

?>