<?php
/**
 * @package onepagescroll
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<?php the_post_thumbnail(); ?>
	<?php endif; ?>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php onepagescroll_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			/*the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'onepagescroll' ), 
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );*/
			the_excerpt();
		?>
	</div><!-- .entry-content -->

	
		<?php onepagescroll_entry_footer(); ?>
	
</article><!-- #post-## -->
