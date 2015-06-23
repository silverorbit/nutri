<?php
/**
 * Front page template for theme
 */

get_header();
?>
<div class="main_wrap">

  
  <section class="content_wrap blog_content_wrap">
    <?php if ( get_header_image() ): ?>
  	<section class="header-image">
		<img src="<?php echo( get_header_image() ); ?>" alt="<?php echo get_bloginfo( 'title', 'display' ); ?>" />
	</section>
	<?php endif; ?>
    <?php get_template_part( 'blog', 'header' ); ?>
    
    <div class="posts-container">
    
      <div class="breadcrumb-box">
            <?php onepagescroll_breadcrumb_trail(array("before"=>"","show_browse"=>false));?>
        </div>
        
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php onepagescroll_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
        </div>
  </section>
  <!--- content_wrap ends -->
   <?php get_sidebar("blog");?>
    
  <!--- sidebar ends -->
</div>
<?php
get_footer();