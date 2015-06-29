


<script type="text/javascript" src="js/jquery.js" ></script>

<script type="text/javascript" src="js/uiblock.js" ></script>

<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SKT Nature One
 */
get_header(); 

?>

<?php if ( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && $wp_query->get_queried_object_id() == get_option( 'page_for_posts' ) ) : ?>

    <div class="content-area">
        <div class="middle-align content_sidebar">
            <div class="site-main" id="sitemain">
				<?php
                if ( have_posts() ) :
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
                        /*
                         * Include the post format-specific template for the content. If you want to
                         * use this in a child theme, then include a file called called content-___.php
                         * (where ___ is the post format) and that will be used instead.
                         */
                        get_template_part( 'content', get_post_format() );
                        
                    endwhile;
                    // Previous/next post navigation.
                    skt_natureone_pagination();
                    
                else :
                    // If no content, include the "No posts found" template.
                     get_template_part( 'no-results', 'index' );
                
                endif;
                ?>
            </div>
          
            <div class="clear"></div>
        </div>
    </div>

<?php endif; ?>


<?php

?>


<?php get_footer(); ?>





        </div><!-- main-container -->
 


    <style>    
        .add_to_cart_inline span, .add_to_cart_inline small {display:none}

        .product.woocommerce .amount {display:none}
     </style>

  <div class="product" id="load_content_overlay" style="position:relative; z-index: 5000; visibility:hidden; height: 120%; width: 30%;"> 
                  <style>

                            ul.products{float: left !important; width: 70% !important; top: 90px; left: 90px;  };
                            li.products{left: 70px;};
                     </style>
                <table  width="2000px"> 
                    <tr  >
                        <td width="30%" style="float:right; text-align: right;";>
                        <div class="nav menu" style="font-size: 20px; padding-right:120px; padding-bottom:10px;">
                         <a href="#"> Shakes </a>
                        </div>
                        <div class="nav menu" style="font-size: 20px;">
                         <a href="#"> Progressive Nutrition </a>
                        </div>
                        </td>

                       <td width="70%"; style="font-size: 14px !important; text-align: center;  ">
                      
                                      
                        
                        <?php
                            
                          //  echo do_shortcode('[woocommerce_products_carousel_all_in_one template="compact.css" all_items="10" show_only="newest" ordering="asc" categories="" show_title="true" show_tags="false" show_price="true" show_description="true" show_add_to_cart_button="true" show_more_button="true" show_more_items_button="true" image_source="thumbnail" image_height="100" image_width="100" items_to_show="4" slide_by="1" margin="5" loop="true" auto_play="true" stop_on_hover="true" auto_play_timeout="1200" nav="true" nav_speed="800" dots="true" dots_speed="800" lazy_load="false" mouse_drag="true" mouse_wheel="true" touch_drag="true" easing="linear"]');
                        
                          //  echo    do_shortcode('[wooproduct ID="4"]');
                             echo    do_shortcode('[products ids="9,12,16"]');
                             
                        ?>
                        
                        </td>
                      </tr>     
                </table>
    </div>

<script type="text/javascript">
    
    $(document).ready(function() { 

    $.blockUI.defaults.css.cursor = 'default';
    $.blockUI.defaults.overlayCSS.cursor = 'default';
    $.blockUI.defaults.bindEvents = 'false';
     $.blockUI.defaults.css.width = "90%";
     $.blockUI.defaults.css.height = "75%";
      $.blockUI.defaults.css.left = "30%";
    $.blockUI.defaults.css.border = 'none'; 
    $.blockUI.defaults.css.backgroundColor = "none";
  
        
        $('.menu-item-37').click(function() { 
             $("#load_content_overlay").css("visibility","visible");
           // $.blockUI({ message: $('#load_content_overlay')  ,css:{visibility: 'visible'}});
             $('#int-div').block({ message:  $('#load_content_overlay')  }); 

            return false;

            
        }); 
    
    /*
        $('.page-item-14').click(function() { 
        
            $('#int-div').block({ message: null }); 
            return false;

        }); 
    */

        $('.page-item-8').click(function() { 
            $('.site-main').block({ 
                message: '<h1>Processing</h1>', 
                css: { border: '3px solid #a00' } 
            }); 
        }); 
 
        $('#unblockButton').click(function() { 
            $('#content-area').unblock(); 
        }); 
 
        $('a.test').click(function() { 
            alert('link clicked'); 
            return false; 
        }); 
    }); 

</script>
