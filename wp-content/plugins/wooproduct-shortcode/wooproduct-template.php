<div class="wooproduct<?php echo $class; ?>" style="<?php echo $style; ?>">
<ul style="list-style: none;">
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>">

		<?php

			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */

			do_action( 'woocommerce_before_shop_loop_item_title' );

		?>

		<p class="product_title"><?php the_title(); ?></p>

		<?php

			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */

			do_action( 'woocommerce_after_shop_loop_item_title' );

		?>

	</a>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</li>
</ul>
</div>