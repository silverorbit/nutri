<div class="main_wrap">
<?php
      
      $menu_status_desktop  = esc_attr( of_get_option( 'menu_status_desktop','open'));
	  $menu_status_tablet   = esc_attr( of_get_option( 'menu_status_tablet','close'));
	  $menu_status_mobile   = esc_attr( of_get_option( 'menu_status_mobile','close'));
	  
	   $menu_status  = $menu_status_desktop;
	   $detect       = new Mobile_Detect;
	  if( $detect->isTablet() ){
		 $menu_status = $menu_status_tablet;
	   }
	  if( $detect->isMobile() && !$detect->isTablet() ){
		 $menu_status = $menu_status_mobile;
	  }
	  $class_menu    = '';
	  $swap_icon     = 'fa fa-chevron-left';
	  $content_style = '';
	  if( $menu_status == 'close' ){
	  $class_menu    = 'hide-sidebar'; 
	  $swap_icon     = 'fa fa-chevron-right';
	  $content_style = 'margin-left:0;';
	  }
?>
  <section class="sidebar visible sidebar_collapse <?php echo $class_menu; ?>">
  <section id="panel-cog">
			<i class="<?php echo $swap_icon; ?>"></i>
		</section>
    <div class="logo-container">
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
                 <?php  if( $detect->isMobile() && !$detect->isTablet() ){?>
                 <div class="close-menu"><i class="fa fa-bars"></i></div>
                 <?php }?>
					</div>
                 <?php }?>
    </div>
    <?php
	global $allowedposttags;
	$allowedposttags = onepagescroll_allow_post_tags( $allowedposttags );
	$sectionNum      = absint(of_get_option('section_num', 4));
	$video_background_section    = absint(of_get_option('video_background_section', 0));
	     $mp4_video_url          = esc_url(of_get_option( 'mp4_video_url' ));
		$ogv_video_url           = esc_url(of_get_option( 'ogv_video_url' ));
		$webm_video_url          = esc_url(of_get_option( 'webm_video_url' ));
		$poster_url              = esc_url( of_get_option( 'poster_url' ));
		$video_loop              = absint(of_get_option( 'video_loop',1 ));
		$video_volume            = esc_attr(of_get_option( 'video_volume',0.8 ));
		$default_volum           = absint(of_get_option('default_volum',10));
		$autoplay                = absint(of_get_option('autoplay',1));
	
	  $section_title     = array(
							 'Start a Magical Web Design Journey',
							 "Rationes ad Elige HooThemes",
							 "Hec igitur omnia et dux free online elit",
							 "SECTION FOUR"
							 );
	  $section_sub_title = array(
								 'Impressive Design & Responsive Layout'
								 );
	  $section_content   = array(
								 'Lorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.<br><div class="section-title">EXILIO A prandio MAGUS WEB Design</div>',
								 '<ul>
          <li>
            <h4>Impressive Design</h4>
            <ul>
              <li>
                <h3>HTML/CSS Design</h3>
                Elegans Lorem Ratio amoena, fons et oculorum captans iconibus conferre haec omnia melius consilium vestri website.
              </li>
              <li>
                <h5>Web Design</h5>
                Hic ex nostra Customers / Clients
              </li>
              <li>
                <h5>PHP Coding</h5>
               Sit at Quid aiunt argumenta nostra
              </li>
            </ul>
          </li>
          <li>
            <h4>SEO</h4>
            <ul>
              <li>
                <h5>Sed efficaciae Pane</h5>
               Dat tibi nostra propositum, potestatem vestri website
              </li>
              <li>
                <h5>Lorem ipsum dolor</h5>
                Tendimus omnes lemma pasco penitus popularis esse compatitur etiam Rimor VIII, IX, X, Aluminium, Incendia, Safari etc.
              </li>
            </ul>
          </li>
          
        </ul>',
		'<div class=" col-sm-6 col-md-4 ">
  <div class="text-center "><i class="fa fa-pie-chart fa-5x"> </i>
    <h3>FEATURE ONE</h3>
    <div>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.</p>
      <a href="http://">Read More&gt;&gt;</a></div>
  </div>
  <div class="clear"></div>
</div>
<div class="col-sm-6 col-md-4 ">
  <div class="text-center "><i class="fa fa-line-chart fa-5x"> </i>
    <h3>FEATURE TWO</h3>
    <div>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.</p>
      <a href="http://">Read More&gt;&gt;</a></div>
  </div>
  <div class="clear"></div>
</div>
<div class="col-sm-6 col-md-4 ">
  <div class="text-center "><i class="fa fa-comments-o fa-5x"> </i>
    <h3>FEATURE THREE</h3>
    <div>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.</p>
      <a href="http://">Read More&gt;&gt;</a></div>
  </div>
  <div class="clear"></div>
</div>
',
'Lorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.'
								 
								 );
	  $section_id    = array("section-one","section-two","section-three","section-four");
	?>
    <nav id="main_nav" class="main_nav">
      
      
      <?php
	  
	  if ( has_nav_menu( "home_page_sidebar_menu" ) ) {
 wp_nav_menu(array('theme_location'=>'home_page_sidebar_menu','depth'=>1,'fallback_cb' =>false,'container'=>'','menu_id'=>'home_page_sidebar_menu','menu_class'=>'home_page_sidebar_menu','link_before' => '', 'link_after' => '<span></span>','items_wrap'=> '<ul id="%1$s" class="%2$s">%3$s</ul>'));
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
      <div class="copyright">&copy; <?php echo date("Y");?>, <?php printf(__('Powered by <a href="%s">WordPress</a>. Designed by <a href="%s">HooThemes</a>.','onepagescroll'),esc_url('http://wordpress.org/'),esc_url('http://www.hoothemes.com/'));?></div>
    </div>
  </section>
  <!--- sidebar ends -->
  <section class="content_wrap homepage_content_wrap" style=" <?php echo $content_style;?>">
  	<?php if ( get_header_image() ): ?>
	<section class="header-image">
		<img src="<?php echo( get_header_image() ); ?>" alt="<?php echo get_bloginfo( 'title', 'display' ); ?>" />
	</section>
	<?php endif; ?>
        <?php
	  if(  $sectionNum > 0 ) { 
		    for( $i=0; $i<$sectionNum; $i++ ){
			if(!isset($section_title[$i])){$section_title[$i] = "";}
			if(!isset($section_sub_title[$i])){$section_sub_title[$i] = "";}
			if(!isset($section_content[$i])){$section_content[$i] = "";}
			
			$title        =  esc_attr( of_get_option('section_title_'.$i, $section_title[$i]));
			$sub_title    =  esc_attr( of_get_option('section_sub_title_'.$i, $section_sub_title[$i]));
            $class        =  esc_attr( of_get_option('section_css_class_'.$i, ''));
            $content	  =  of_get_option('section_content_'.$i, $section_content[$i]);
		    $menu_id      =  esc_attr( of_get_option('section_id_'.$i, $section_id[$i] ) );
		    if( $menu_id =='' )
			  $menu_id    =  'section-'.($i+1);
			  
		  // video background
		$background_video = '';
		if( $video_background_section > 0 && $video_background_section == ($i+1) ){
				
				
		 if( $video_loop == 1 ){
		$video_loop = "true";
		}
		else{
		$video_loop = "false";	
			}
	    $class .= " section-video-background";
		$background_video   = array("mp4_video_url"=>$mp4_video_url,"webm_video_url"=>$webm_video_url,"ogv_video_url"=>$ogv_video_url,"loop"=>$video_loop,"volume"=>$video_volume,"poster_url"=>$poster_url,"container"=>'.onepagescroll-section-'.($i+1),"volume"=>$video_volume,"autoplay"=>$autoplay);
	    wp_localize_script( 'onepagescroll-videobackground', 'background_video',$background_video);
	    $background = "";
				}
			?>
    <section id="<?php echo $menu_id;?>" class="section onepagescroll-section-<?php echo ($i+1);?> section-<?php echo $menu_id;?> <?php echo $class;?>">
    <div class="section-content-wrap">
      <div class="section-title">
      <?php if ( $title !='' ): ?>
        <h3><?php echo $title;?></h3>
        <?php endif; ?>
        <?php if ( $sub_title !='' ): ?>
        <h3 class="section-sub-title"><?php echo $sub_title;?></h3>
        <?php endif; ?>
      </div>
  
      <div class="section-content">
        <?php echo do_shortcode( wp_kses( $content , $allowedposttags ) );?>
        <div class="clear"></div>
      </div>
       </div>
    </section>
    <?php }
	  }?>
  </section>
  <!--- content_wrap ends -->
</div>