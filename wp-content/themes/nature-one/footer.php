<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Nature One
 */
?>

 <div id="footer">
 		<div class="footer-top">
        	<div class="middle-align">
            	<div class="footer-column"><h3><?php _e('About Us','nature-one'); ?></h3>
                	<?php if( of_get_option('footertext', true) != '') 
							{ 
								if(of_get_option('footertext',true) == 1)
									 { 
									 	_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur egestas ornare elit ut molestie. Phasellus posuere interdum tellus, sit amet interdum lectus rutrum at. Nunc suscipit erat ut eros consequat, at bibendum sapien convallis. Donec ut gravida velit. Curabitur non ultrices lorem. Quisque aliquet leo felis, vitae posuere purus blandit vitae. Fusce vitae tincidunt enim, in efficitur justo. Morbi euismod orci non magna malesuada commodo.','nature-one');
										}
										else
										{
											echo esc_html(of_get_option('footertext', true));
										}
								 }; ?>
                </div><!-- footer-column -->
                <div class="footer-column" style="margin-right:0;"><h3><?php _e('Clients Testimonials','nature-one'); ?></h3>
                	<blockquote>
                    		<?php if(of_get_option('testtext',true) != 1){ 
									echo esc_html(of_get_option('testtext', true));
							} else { ?>
                            	<?php _e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur egestas ornare elit ut molestie. Phasellus posuere interdum tellus, sit amet interdum lectus rutrum at. Nunc suscipit erat ut eros consequat, at bibendum sapien convallis. Donec ut gravida velit. Curabitur non ultrices lorem. Quisque aliquet leo felis, vitae posuere purus blandit vitae.','nature-one'); ?>
                            <?php } ?>
                    </blockquote>
                </div><!-- footer-column --><div class="clear"></div>
            </div><!-- middle-align -->
        </div><!-- footer-top -->
       
</div><!-- footer -->
        </div><!-- main-container -->
  
<?php wp_footer(); ?>

</body>
</html>