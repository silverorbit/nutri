<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package onepagescroll
 */

?>

<section class="sidebar sidebar_collapse">
    <div class="logo-container text-center">
      <?php 
	  if ( of_get_option('logo','')!="" ) { ?>
        <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(of_get_option('logo')); ?>" class="site-logo" alt="<?php bloginfo('name'); ?>" /></a>
        <?php 
		} else{
			?>
			<div class="name-box">
						<a href="<?php echo esc_url(home_url('/')); ?>">
                        <h2 id="site-title" class="site-title"><?php bloginfo('name'); ?></h2>
                        </a>
						<span class="site-description"><?php  bloginfo('description');?></span>
                 
					</div>
                 <?php }?>
    </div>

    <nav id="main_nav" class="main_nav">
            <?php

	 if ( is_active_sidebar( 'blog' ) ){
	 dynamic_sidebar( 'blog' );
	 }
	 elseif( is_active_sidebar( 'default_sidebar' ) ) {
	 dynamic_sidebar('default_sidebar');
	 }
	 ?>
    </nav>
    <div class="side-footer side-footer-collapse">
      <ul class="socialmedia">
        <?php 
				
				for($i=0;$i<9; $i++){
					$social_icon  = of_get_option('social_icon_'.$i);
					$social_link  = of_get_option('social_link_'.$i);
					$social_title = of_get_option('social_title_'.$i);
					if($social_link !=""){
					echo '<li><a href="'.esc_url($social_link).'" target="_blank" data-toggle="tooltip" title="'.esc_attr($social_title).'"><i class="fa-2x '.esc_attr($social_icon).'"></i></a></li>';
					}
					}
					?>
      </ul>
      <p class="copyright">&copy; <?php echo date("Y");?>, <?php printf(__('Powered by <a href="%s">WordPress</a>. Designed by <a href="%s">HooThemes</a>.','onepagescroll'),esc_url('http://wordpress.org/'),esc_url('http://www.hoothemes.com/'));?></p>
    </div>
  </section>