<?php
/**
 * The template for displaying all single posts.
 *
 * @package onepagescroll
 */

get_header(); ?>

  <!--- sidebar ends -->
  <section class="content_wrap blog_content_wrap">
  <?php get_template_part( 'blog', 'header' ); ?>
    <div class="posts-container">
      <div class="breadcrumb-box">
            <?php onepagescroll_breadcrumb_trail(array("before"=>"","show_browse"=>false));?>
        </div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php onepagescroll_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
</section>

<?php get_sidebar("blog");?>
<?php get_footer(); ?>