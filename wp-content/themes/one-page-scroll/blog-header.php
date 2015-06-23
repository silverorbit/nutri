<header class="navbar navbar-onex blog-header">
 <div class="nav navbar-header">
<button type="button" class="navbar-toggle site-nav-toggle" data-toggle="collapse" data-target="#navbar-collapse">
      				<span class="sr-only"><?php _e('Toggle navigation','onepagescroll');?></span>
      				<span class="icon-bar"></span>
      				<span class="icon-bar"></span>
     				<span class="icon-bar"></span>
   				</button>
                
		 <nav class="site-nav main-menu navbar-nav" id="navbar-collapse" role="navigation">
			<?php wp_nav_menu(array('theme_location'=>'primary','depth'=>0,'fallback_cb' =>false,'container'=>'','container_class'=>'main-menu','menu_id'=>'menu-main','menu_class'=>'main-nav','link_before' => '<span>', 'link_after' => '</span>','items_wrap'=> '<ul id="%1$s" class="%2$s">%3$s</ul>'));?>
		</nav>
	</div>

</header>