<?php
/**
 * onepagescroll functions and definitions
 *
 * @package onepagescroll
 */

require get_template_directory() . '/admin/options-framework.php';
require_once get_template_directory() . '/options.php';
function onepagescroll_prefix_options_menu_filter( $menu ) {
	$menu['mode'] = 'menu';
	$menu['page_title'] = __( 'Theme Options', 'onepagescroll');
	$menu['menu_title'] = __( 'Theme Options', 'onepagescroll');
	$menu['menu_slug'] = 'onepagescroll-options';
	return $menu;
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */


if ( ! function_exists( 'onepagescroll_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 */
function onepagescroll_setup() {
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 860; /* pixels */
	}

	load_theme_textdomain( 'onepagescroll', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_editor_style("editor-style.css");
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( "title-tag" );
	//set_post_thumbnail_size( 860, 645, array( 'center', 'center' ) );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'home_page_sidebar_menu' => __( 'Featured Homepage Sidebar Menu ( Affected on Featured Homepage )', 'onepagescroll' ),
	) );
	
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'onepagescroll' ),
	) );


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', onepagescroll_supported_post_formats() );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'onepagescroll_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // onepagescroll_setup
add_action( 'after_setup_theme', 'onepagescroll_setup' );

function onepagescroll_supported_post_formats(){
    // Core formats as example
    // $formats = array( 'quote', 'link', 'chat', 'image', 'gallery', 'audio', 'video' );
    $default = array( 'link', 'image', 'quote' );
    $formats = wp_parse_args( $default, (array)apply_filters( 'theme_formats', array() ) );
    
    return $formats;
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function onepagescroll_widgets_init() {
	register_sidebar(array(
			'name' => __('Default Blog Sidebar', 'onepagescroll'),
			'description' =>  __('Default blog sidebar, display when Blog Sidebar is not been activated.', 'onepagescroll'),
			'id'   => 'default_sidebar',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h2 class="widget-title">', 
			'after_title' => '</h2>' 
			));

		register_sidebar(array(
			'name' => __('Blog Sidebar', 'onepagescroll'),
			'id'   => 'blog',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h2 class="widget-title">', 
			'after_title' => '</h2>' 
			));
}
add_action( 'widgets_init', 'onepagescroll_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function onepagescroll_scripts() {
	global $is_IE;
	$theme_info = wp_get_theme();
	wp_enqueue_style( 'onepagescroll-Open-Sans', esc_url('//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,700'), false, '', false);
	wp_enqueue_style( 'onepagescroll-font-awesome',  get_template_directory_uri() .'/css/font-awesome.min.css', false, '4.2.0', false);
	wp_enqueue_style( 'onepagescroll-bootstrap',  get_template_directory_uri() .'/css/bootstrap.css', false, '4.0.3', false);
	wp_enqueue_style( 'onepagescroll-prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', false, '3.1.5', false);
	
	$video_background_section    = absint(of_get_option('video_background_section', 0));
	
	wp_enqueue_style( 'onepagescroll-main', get_stylesheet_uri(), array(), $theme_info->get( 'Version' ) );
	wp_enqueue_style( 'onepagescroll-fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css' );
	wp_enqueue_script( 'onepagescroll-bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array( 'jquery' ), '3.0.3', false );
	wp_enqueue_script( 'onepagescroll-respond', get_template_directory_uri().'/js/respond.min.js', array( 'jquery' ), '1.4.2', false );
	wp_enqueue_script( 'onepagescroll-modernizr', get_template_directory_uri().'/js/modernizr.custom.js', array( 'jquery' ), '2.8.2', false );
	wp_enqueue_script( 'onepagescroll-nav', get_template_directory_uri().'/js/jquery.nav.js', array( 'jquery' ), '3.0.0', false );
	
	if( $video_background_section > 0 && (is_home() || is_front_page()) )
	wp_enqueue_script( 'onepagescroll-videobackground', get_template_directory_uri().'/js/jquery.videobackground.js', array( 'jquery' ),'', true );

	wp_enqueue_script( 'onepagescroll-prettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array( 'jquery' ), '3.1.5', true );
	wp_enqueue_script( 'onepagescroll-main', get_template_directory_uri().'/js/common.js', array( 'jquery','jquery-ui-core' ), $theme_info->get( 'Version' ), true );
	
	if( $is_IE ) {
	wp_enqueue_script( 'onepagescroll-html5', get_template_directory_uri().'/js/html5.js', array( 'jquery' ), '3.7.2', false );
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	$sidebar_width        = absint( of_get_option( 'sidebar_width','280'));
	  if( !is_numeric($sidebar_width) || $sidebar_width <=0 ){
		  $sidebar_width = 280;
		  }
	
	 $onepagescroll_custom_css = '';
	 $sectionNum               = absint(of_get_option('section_num', 4));
	 $section_id               = array("section-one","section-two","section-three","section-four");
	 
	  $section_background = array(
	     array(
		'color' => '#ffcc44',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'fixed' ),
		 array(
		'color' => '#ff415b',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'fixed' ),
		 array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'fixed' ),
		 array(
		'color' => '#2a8fbd',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'fixed' )
		 );
	  $section_content_typography_std = array(
										 array( 'size' => '16px', 'face' => 'Open Sans, sans-serif', 'color' => '#ffffff','style'=>300),
										  array( 'size' => '16px', 'face' => 'Open Sans, sans-serif', 'color' => '#ffffff','style'=>300),
										  array( 'size' => '16px', 'face' => 'Open Sans, sans-serif', 'color' => '#333333','style'=>300),
										  array( 'size' => '16px', 'face' => 'Open Sans, sans-serif', 'color' => '#ffffff','style'=>300)
										  );
	  
	if(  $sectionNum > 0 ) { 
		    for( $i=0; $i<$sectionNum; $i++ ){ 
			if(!isset($section_id[$i])){$section_id[$i] = "";}
			if(!isset($section_background[$i])){$section_background[$i] = "";}
			
			if(!isset($section_content_typography_std[$i])){$section_content_typography_std[$i] = array( 'size' => '16px', 'face' => 'Open Sans, sans-serif', 'color' => '#ffffff','style'=>300);}
			
			 $section_background_       = of_get_option( 'section_background_'.$i,$section_background[$i]);
             $background                = onepagescroll_get_background( $section_background_ );
			
			$menu_id      =  esc_attr( of_get_option('section_id_'.$i, $section_id[$i] ) );
		    if( $menu_id =='' )
			  $menu_id    =  'section-'.($i+1);
			  
			   $onepagescroll_custom_css      .= 'section#'.$menu_id.'{'.$background.'}';
			   
			  $section_title_typography       = of_get_option("section_title_typography_".$i,array( 'size' => '30px', 'face' => 'Open Sans, sans-serif', 'color' => '#333333','style'=>400));
			  $onepagescroll_custom_css      .= onepagescroll_options_typography_font_styles($section_title_typography,'section#'.$menu_id.' .section-title h3' );
			  
			  $section_sub_title_typography   = of_get_option("section_sub_title_typography_".$i,array( 'size' => '36px', 'face' => 'Open Sans, sans-serif', 'color' => '#ffffff','style'=>700));
			  $onepagescroll_custom_css      .= onepagescroll_options_typography_font_styles($section_sub_title_typography ,'section#'.$menu_id.' h3.section-sub-title');
			  
			  $section_content_typography     = of_get_option("section_content_typography_".$i,$section_content_typography_std[$i]);
			  $onepagescroll_custom_css      .= onepagescroll_options_typography_font_styles($section_content_typography,'section#'.$menu_id.' .section-content,section#'.$menu_id.' .section-content p' );
			  
	
			  
			}
	}

	 $content_link_color         =  esc_attr( of_get_option( 'content_link_color','#a29c9a'));
	 $content_link_hover_color   =  esc_attr( of_get_option( 'content_link_hover_color','#fe8a02'));
     $onepagescroll_custom_css  .= '.entry-content a{color:'.$content_link_color.'}';
	 $onepagescroll_custom_css  .= '.entry-content a:hover{color:'.$content_link_hover_color.'}';
	 
	 $page_menu_typography      = of_get_option("page_menu_typography",array( 'size' => '14px', 'face' => 'Open Sans, sans-serif', 'color' => '#c2d5eb','style'=>300));
     $onepagescroll_custom_css .= onepagescroll_options_typography_font_styles($page_menu_typography ,'.page  .site-nav > ul > li > a');
	 
	
	 $page_nav_menu_hover_color   =  esc_attr( of_get_option( 'home_nav_menu_hover_color','#fe8a02'));
	 $onepagescroll_custom_css   .= '
	 .page nav.site-nav > ul > li.current-post-ancestor > a,
	 .page nav.site-nav > ul > li.current-menu-parent > a,
	 .page nav.site-nav > ul > li.current-menu-item > a,
	 .page nav.site-nav > ul > li.current_page_item > a,
	 .page nav.site-nav > ul > li a:hover{color:'.$page_nav_menu_hover_color.'}';
	 
	  $blog_menu_typography     = of_get_option("blog_menu_typography",array( 'size' => '14px', 'face' => 'Open Sans, sans-serif', 'color' => '#666666','style'=>300));
     $onepagescroll_custom_css .= onepagescroll_options_typography_font_styles($blog_menu_typography ,'.blog header.blog-header .site-nav > ul > li > a');
	 
	 $blog_menu_hover_color   =  esc_attr( of_get_option( 'blog_menu_hover_color','#eeee22'));
	 $onepagescroll_custom_css   .= '
	 .blog header.blog-header nav > ul > li.current-post-ancestor > a,
	 .blog header.blog-header nav > ul > li.current-menu-parent > a,
	 .blog header.blog-header nav > ul > li.current-menu-item > a,
	 .blog header.blog-header nav > ul > li.current_page_item > a,
	 .blog header.blog-header nav > ul > li a:hover,
	 .nav .cur > a,
	 .blog header.blog-header .main_nav li.current a{color:'.$blog_menu_hover_color.'}';
	 
	  $homepage_side_nav_menu_typography      = of_get_option("homepage_side_nav_menu_typography",array( 'size' => '14px', 'face' => 'Open Sans, sans-serif', 'color' => '#666666','style'=>400));
     $onepagescroll_custom_css .= onepagescroll_options_typography_font_styles($homepage_side_nav_menu_typography ,'.home ul.home_page_sidebar_menu > li > a');
	 
	 $home_side_nav_menu_active_color   =  esc_attr( of_get_option( 'home_side_nav_menu_active_color','#ffcc33'));
     $onepagescroll_custom_css  .= '.home ul.home_page_sidebar_menu > li.active > a{color:'.$home_side_nav_menu_active_color.'}';
	 
	 
	 $page_post_content_typography = of_get_option("page_post_content_typography",array( 'size' => '13px', 'face' => 'Open Sans, sans-serif', 'color' => '#555555','style'=>400));
	 $onepagescroll_custom_css    .= onepagescroll_options_typography_font_styles($page_post_content_typography ,'.entry-content');
	 
	 
	  $onepagescroll_custom_css   .= ".sidebar{width: ".($sidebar_width)."px;}";
	 $onepagescroll_custom_css   .= ".content_wrap{margin-left: ".$sidebar_width."px;}";
	 $onepagescroll_custom_css   .= ".sidebar.hide-sidebar{left: -".($sidebar_width)."px;}";
	 
	 $onepagescroll_custom_css   .= ".main_nav li span{
	 transform: translate(".($sidebar_width)."px,0);
	-ms-transform: translate(".($sidebar_width)."px,0); 
	-webkit-transform: translate(".($sidebar_width)."px,0); 
	 }";
	 
	 
	 $onepagescroll_custom_css  .=  of_get_option("custom_css");

	// Escap whole output string
	 $onepagescroll_custom_css = wp_filter_nohtml_kses( $onepagescroll_custom_css );
	 
	$onepagescroll_custom_css = str_replace( '&gt;', '>',$onepagescroll_custom_css );
	 
	wp_add_inline_style( 'onepagescroll-main', $onepagescroll_custom_css );
	
	$scrollspeed          = absint(of_get_option( "scrollspeed" ,750));

	wp_localize_script( 'onepagescroll-main', 'onepagescroll_params', array(
			'ajaxurl'        => admin_url('admin-ajax.php'),
			'themeurl' => get_template_directory_uri(),
			'scrollspeed'  => $scrollspeed,
			'sidebar_width' => $sidebar_width
		)  );

	
}

 function onepagescroll_admin_scripts(){
	 if(isset($_GET['page']) && $_GET['page'] == 'onepagescroll-options'){
	$theme_info = wp_get_theme();
	wp_enqueue_script( 'onepagescroll-admin', get_template_directory_uri().'/js/admin.js', array( 'jquery' ), $theme_info->get( 'Version' ), true );
	wp_enqueue_style('onepagescroll-admin',  get_template_directory_uri() .'/css/admin.css', false,  $theme_info->get( 'Version' ), false);
	 }
  }
  
add_action( 'wp_enqueue_scripts', 'onepagescroll_scripts' );
add_action( 'admin_enqueue_scripts', 'onepagescroll_admin_scripts' );

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );

/**
 * Mobile Detect Library
 **/
 if(!class_exists("Mobile_Detect"))
load_template( trailingslashit( get_template_directory() ) . 'inc/Mobile_Detect.php' );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/breadcrumb-trail.php';

add_filter( 'optionsframework_menu', 'onepagescroll_prefix_options_menu_filter' );

