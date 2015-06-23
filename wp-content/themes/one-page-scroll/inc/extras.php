<?php
/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
 if ( ! function_exists( '_wp_render_title_tag' ) ) {	
function onepagescroll_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'onepagescroll' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'onepagescroll_wp_title', 10, 2 );
}

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function onepagescroll_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'onepagescroll_slug_render_title' );
}

function onepagescroll_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'onepagescroll_setup_author' );
global $wp_embed;
add_filter( 'the_excerpt', array( $wp_embed, 'autoembed' ), 9 );


function onepagescroll_add_link_pages( $content ){
	$pages = wp_link_pages( 
		array( 
			'before' => '<div>' . __( 'Page: ', 'onepagescroll' ),
			'after' => '</div>',
			'echo' => false ) 
	);
	if ( $pages == '' ){
		return $content;
	}
	return $content . $pages;
}
add_filter( 'the_content', 'onepagescroll_add_link_pages' );

/*
*  page navigation
*
*/
function onepagescroll_native_pagenavi($echo,$wp_query){
    if(!$wp_query){global $wp_query;}
    global $wp_rewrite;      
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
    'base' => @add_query_arg('paged','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'prev_text' => '&laquo; ',
    'next_text' => ' &raquo;'
    );
 
    if( $wp_rewrite->using_permalinks() )
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
 
    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array('s'=>get_query_var('s'));
    if($echo == "echo"){
    echo '<div class="page_navi">'.paginate_links($pagination).'</div>'; 
	}else
	{
	
	return '<div class="page_navi">'.paginate_links($pagination).'</div>';
	}
}


/*
*  Custom comments list
*
*/
   
  function onepagescroll_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ;?>">
     <div id="comment-<?php comment_ID(); ?>">
	 
	 <div class="comment-avatar"><?php echo get_avatar($comment,'52','' ); ?></div>
			<div class="comment-info">
			<div class="reply-quote">
             <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
			</div>
      <div class="comment-author vcard">
        
			<span class="fnfn"><?php printf(__('<cite> %s </cite><span class="says">says:</span>','onepagescroll'), get_comment_author_link()) ;?></span>
								<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">
<?php printf(__('%1$s at %2$s','onepagescroll'), get_comment_date(), get_comment_time()) ;?></a>
<?php edit_comment_link(__('(Edit)','onepagescroll'),'  ','') ;?></span>
				<span class="comment-meta">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">-#<?php echo $depth?></a>				</span>

      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.','onepagescroll') ;?></em>
         <br />
      <?php endif; ?>

     

      <?php comment_text() ;?>
</div>
   <div class="clear"></div>
     </div>
<?php
        }
		
/*
*  title filter
*
*/

function onepagescroll_the_title( $title ) {
if ( $title == '' ) {
  return  __('Untitled','onepagescroll');
  } else {
  return $title;
  }
}
add_filter( 'the_title', 'onepagescroll_the_title' );


/**
 * admin sidebar
 */
 
add_action( 'optionsframework_sidebar','onepagescroll_options_panel_sidebar' );

function onepagescroll_options_panel_sidebar() { ?>
	<div id="optionsframework-sidebar">
		<div class="metabox-holder">
	    	<div class="postbox">
	    		<h3><?php _e( 'Quick Links', 'onepagescroll' ); ?></h3>
      			<div class="inside"> 
		          <ul>
                  <li><a href="<?php echo esc_url( 'http://www.hoothemes.com/themes/one-page-scroll.html' ); ?>" target="_blank"><?php _e( 'Upgrade to Pro', 'onepagescroll' ); ?></a></li>
                  <li><a href="<?php echo esc_url( 'http://www.hoothemes.com/one-page-scroll-wordpress-theme-manual.html' ); ?>" target="_blank"><?php _e( 'Tutorials', 'onepagescroll' ); ?></a></li>
                  </ul>
      			</div>
	    	</div>
	  	</div>
	</div>
    <div class="clear"></div>
<?php
}


/*	
*	get background 
*	---------------------------------------------------------------------
*/
function onepagescroll_get_background($args){
$background = "";
 if (is_array($args)) {
	if (isset($args['image']) && $args['image']!="") {
	$background .=  "background:url(".esc_attr($args['image']). ")  ".esc_attr($args['repeat'])." ".esc_attr($args['position'])." ".esc_attr($args['attachment']).";";
	}

	if(isset($args['color']) && $args['color'] !=""){
	$background .= "background-color:".esc_attr($args['color']).";";
	}
	}
return $background;
}

// allow script & iframe tag within posts
function onepagescroll_allow_post_tags( $allowedposttags ){
    $allowedposttags['script'] = array(
        'type' => true,
        'src' => true,
        'height' => true,
        'width' => true,
    );
    $allowedposttags['iframe'] = array(
        'src' => true,
        'width' => true,
        'height' => true,
        'class' => true,
        'frameborder' => true,
        'webkitAllowFullScreen' => true,
        'mozallowfullscreen' => true,
        'allowFullScreen' => true
    );
	
	$allowedposttags["embed"] = array(
	   "src" => true,
	   "type" => true,
	   "allowfullscreen" => true,
	   "allowscriptaccess" => true,
	   "height" => true,
	   "width" => true
	  );
	
    return $allowedposttags;
}
add_filter('wp_kses_allowed_html','onepagescroll_allow_post_tags', 1);


 /**
 * onepagescroll favicon
 */

function onepagescroll_favicon()
	{
	    $url =  of_get_option('favicon');
	
		$icon_link = "";
		if($url)
		{
			$type = "image/x-icon";
			if(strpos($url,'.png' )) $type = "image/png";
			if(strpos($url,'.gif' )) $type = "image/gif";
		
			$icon_link = '<link rel="icon" href="'.esc_url($url).'" type="'.$type.'">';
		}
		
		echo $icon_link;
	}
	
	 add_action( 'wp_head', 'onepagescroll_favicon' );


//** fonts **//

/**

* Returns an array of system fonts

* Feel free to edit this, update the font fallbacks, etc.

*/



function onepagescroll_options_typography_get_os_fonts() {

  // OS Font Defaults

  $os_faces = array(
       'Open Sans, sans-serif' => 'Open Sans',
      'Arial, sans-serif' => 'Arial',

      '"Avant Garde", sans-serif' => 'Avant Garde',

      'Cambria, Georgia, serif' => 'Cambria',

      'Copse, sans-serif' => 'Copse',

      'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',

      'Georgia, serif' => 'Georgia',

      '"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',

      'Tahoma, Geneva, sans-serif' => 'Tahoma'

  );

  return $os_faces;

}

/*

* Returns a typography option in a format that can be outputted as inline CSS

*/

 

function onepagescroll_options_typography_font_styles($option, $selectors) {

         $output = $selectors . ' {';
      if(isset($option['color']))
      $output .= ' color:' . esc_attr( $option['color'] ) .'; ';
      if(isset($option['face']))
      $output .= 'font-family:' . esc_attr( $option['face']) . '; ';
      if(isset($option['style']))
      $output .= 'font-weight:' . esc_attr( $option['style']) . '; ';
      if(isset($option['size']))
      $output .= 'font-size:' . esc_attr( $option['size'] ). '; ';

      $output .= '}';

      $output .= "\n";

      return $output;

}

function onepagescroll_options_typography_font_styles2($option) {

      $output = '';
      if(isset($option['color']))
      $output .= ' color:' . esc_attr( $option['color']) .'; ';
       if(isset($option['face']))
      $output .= 'font-family:' .esc_attr( $option['face'] ). '; ';
       if(isset($option['style']))
      $output .= 'font-weight:' . esc_attr( $option['style']) . '; ';
       if(isset($option['size']))
      $output .= 'font-size:' .esc_attr(  $option['size']) . '; ';


      return $output;

}