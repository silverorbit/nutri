<div id="footer">
<div class="container">
<div class="page-footer page-footer-collapse">
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
    <div class="clear"></div>
</div></div>
<?php
wp_footer();
?>
</body>
</html>