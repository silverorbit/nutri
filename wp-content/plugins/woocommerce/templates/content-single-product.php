<style>

.divtab {
  width:1500px;
  display: table;
  vertical-align:middle;

  font-family: "Trebuchet MS", Helvetica, sans-serif !important;

}
.divrow {
  
  display: table-row;

}

.divcol {
  
  display: table-cell;
  

}


</style>

<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="summary entry-summary">

	
	</div><!-- .summary -->
<style>

.product_title{

	/* text-align: left !important; */
	display: block;
	text-align: left !important;
	padding-left: 139px !important;
	padding-bottom: 5px !important;

}

div.images{

	display: block;
	width: 60%  !important;
	padding-top: 20px;
	
	padding-top: 20px !important;
	margin-left: 110px !important;

}

.price {

	display: block !important;
	margin-left: 140px !important;
	text-align: left;
	font-size: 18px !important;
	color: white !important;
}

.quantity {
	position: relative;
	display: block !important;
	vertical-align: top !important;
	padding-left: 20px !important;
	padding-top: 22px !important;

}

.single_add_to_cart_button {

	
	margin-top: 20px !important;
	margin-left: 140px !important;
}

button.single_add_to_cart_button{

	background-color: #23B34B !important;

}

.input-text.qty {


	font-size: 15px !important;
}

.onsale{
	position: relative;
	display:inline-block;


}

.tab-benefits_tab.active {

	background-color: #23B34B !important;

}
.tab-nutritional-facts_tab.active {

	background-color: #23B34B !important;

}

.description_tab.active{

	background-color: #23B34B !important;
}
.reviews_tab.active{

	background-color: #23B34B !important;
}

.additional_information_tab.active{

	background-color: #23B34B !important;
}


</style>

		<div class="divtab">

	<div class="divrow" >
		<div class="divcol" style="width:30%; ">
			
			<div class="divrow" >	
				<div>
					<?php
						/**
						 * woocommerce_before_single_product_summary hook
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20	
						 */
						// product image
						do_action( 'woocommerce_before_single_product_summary' );
					?>
				</div>	
				
				<div style="vertical-align: top !important;  ">
					<?php
						/**
						 * woocommerce_single_product_summary hook
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						//product name, price, and add to cart button
						do_action( 'woocommerce_single_product_summary' );
					?>
				</div>
			</div> <!--divrow end-->
		</div>
		<div class="divcol" style="width:80%; text-align: left; vertical-align: top !important; font-size: 125% !important; ">
			<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			// description of the products
			do_action( 'woocommerce_after_single_product_summary' );
			?>
		</div>
	</div>
	
</div>


	
	
	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

