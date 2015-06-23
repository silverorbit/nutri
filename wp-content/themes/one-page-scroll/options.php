<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {

	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	if( is_child_theme() ){	
		$themename = str_replace("_child","",$themename ) ;
		}
	return $themename;
}


/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {


    $imagepath =  get_template_directory_uri() . '/images/';
	 
	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);
   $blog_background = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat-y',
		'position' => 'top left',
		'attachment'=>'fixed');
   

	$section_num = absint(of_get_option( 'section_num', 4 ));

	$options = array();

	$options[] = array(
		'name' => __('Basic Settings', 'onepagescroll'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Upload Logo', 'onepagescroll'),
		'id' => 'logo',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Favicon', 'onepagescroll'),
		'desc' => sprintf(__('An icon associated with a URL that is variously displayed, as in a browser\'s address bar or next to the site name in a bookmark list. Learn more about <a href="%s" target="_blank">Favicon</a>', 'onepagescroll'),esc_url("http://en.wikipedia.org/wiki/Favicon")),
		'id' => 'favicon',
		'type' => 'upload');
	

	
	$options[] = array(
		'name' => __('Custom CSS', 'onepagescroll'),
		'desc' => __('The following css code will add to the header before the closing &lt;/head&gt; tag.', 'onepagescroll'),
		'id' => 'custom_css',
		'std' => 'body{margin:0px;}',
		'type' => 'css');
	
		
     $options[] = array(
		'name' => __('Home Page', 'onepagescroll'),
		'type' => 'heading');
	 
	 $options[] = array(
		'name' => __('Enable Featured Homepage', 'onepagescroll'),
		'desc' => sprintf(__('Active featured homepage Layout.  The standardized way of creating Static Front Pages: <a href="%s" target="_blank">Creating a Static Front Page</a>', 'onepagescroll'),esc_url('http://codex.wordpress.org/Creating_a_Static_Front_Page')),
		'id' => 'enable_home_page',
		'std' => '1',
		'type' => 'checkbox');
	 
	 
	  // background video
	    $options[] = array(	'desc' => '<div class="options-section"><h3 class="groupTitle">'.__('HTML5 Video Background Options', 'onepagescroll').'</h3>', 'class' => 'toggle_option_group group_close','type' => 'info');
	    $options[] = array('name' => __('mp4 video url', 'onepagescroll'),'id' => 'mp4_video_url','type' => 'text','std'=>'' ,"desc"=>__('For Android devices, Internet Explorer 9, Safari','onepagescroll'));
		$options[] = array('name' => __('ogv video url', 'onepagescroll'),'id' => 'ogv_video_url','type' => 'text','std'=>'',"desc"=>__('For Google Chrome, Mozilla Firefox, Opera ','onepagescroll'));
		$options[] = array('name' => __('webm video url', 'onepagescroll'),'id' => 'webm_video_url','type' => 'text','std'=>'',"desc"=>__('For Google Chrome, Mozilla Firefox, Opera ','onepagescroll'));
		$options[] = array('name' => __('poster', 'onepagescroll'),'id' => 'poster_url','type' => 'upload','std'=>'',"desc"=>__('Displaying the image for browsers that don\'t support the HTML5 Video element.','onepagescroll'));
		$options[] = array(	'name' => __('Video Loop', 'onepagescroll'),	'id' => 'video_loop','std' => '1','class' => 'mini','options' => array('1'=>'yes','0'=>'no'),	'type' => 'select');
		$options[] = array(	'name' => __('Autoplay', 'onepagescroll'),	'id' => 'autoplay','std' => '1','class' => 'mini','options' => array('1'=>'yes','0'=>'no'),	'type' => 'select');
		
		$options[] = array(	'name' => __('Video Volume', 'onepagescroll'),	'id' => 'video_volume','std' => '0.8','class' => 'mini','options' => array('0.001'=>'0','0.1'=>'0.1','0.2'=>'0.2','0.3'=>'0.3','0.4'=>'0.4','0.5'=>'0.5','0.6'=>'0.6','0.7'=>'0.7','0.8'=>'0.8','0.9'=>'0.9','1.0'=>'1.0'),	'type' => 'select');
		
		$video_background_section = array('0'=>__('No video background', 'onepagescroll'));
		if( is_numeric( $section_num ) ){
		for($i=1; $i <= $section_num; $i++){
			$video_background_section[$i] = sprintf(__('Section %d','onepagescroll'),$i);
			}
		}
		$options[] = array('name' => __('Video Background Section', 'onepagescroll'),'std' => '1','id' => 'video_background_section',
		'type' => 'select','class' => 'mini', 'options'=>$video_background_section);
       $options[] = array('desc' => '</div>','class' => 'toggle_title','type' => 'info');
		//
		
		// home page sidebar menu options
		$options[] = array(	'desc' =>'<div class="options-section"><h3 class="groupTitle">'.__('Home Page Sidebar Menu options', 'onepagescroll').'</h3>',	'class' => 'toggle_option_group group_close','type' => 'info');
        
		$options[] = array('name' => __('Sidebar Width', 'onepagescroll'),'id' => 'sidebar_width','type' => 'text','std'=>'280' ,"desc"=>__('Use a number without "px", default is 280. ex: 280','onepagescroll'));
		
		$options[] = array(	'name' => __('Menu Status ( Desktop )', 'onepagescroll'),'id' => 'menu_status_desktop','std' => 'open','class' => 'mini','options' => array('open'=>'open','close'=>'close'),'type' => 'select');

		$options[] = array(	'name' => __('Menu Status ( Tablet )', 'onepagescroll'),'id' => 'menu_status_tablet','std' => 'close','class' => 'mini','options' => array('open'=>'open','close'=>'close'),'type' => 'select');
	
		$options[] = array(	'name' => __('Menu Status ( Mobile )', 'onepagescroll'),'id' => 'menu_status_mobile','std' => 'close','class' => 'mini','options' => array('open'=>'open','close'=>'close'),'type' => 'select');
		
		
		$options[] = array('desc' => __('</div>', 'onepagescroll'),	'class' => 'toggle_title','type' => 'info');
		
		// end page sidebar menu options
 
	
	 $options[] = array(
		'name' => __('Number of Sections', 'onepagescroll'),
		'desc' => __('Select number of sections', 'onepagescroll'),
		'id' => 'section_num',
		'type' => 'select',
		'class' => 'mini',
		'std' => '4',
		'options' => array_combine(range(1,4), range(1,4)) );
	 $options[] = array('name' => __('Scrolling Delay', 'onepagescroll'),'class'=>'mini','id' => 'scrollspeed','type' => 'text','std'=>'750','desc'=> '');
		
	 
	 $section_menu_title         = array("SECTION ONE","SECTION TWO","SECTION THREE","SECTION FOUR");
	 $section_id                 = array("section-one","section-two","section-three","section-four");
	 $section_content_color      = array("#ffffff","#ffffff","#ffffff","#ffffff");
	 $section_css_class          = array("","","","");
	 
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
								 'Lorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.<br><div class="section-title">EXILIO A prandio MAGUS WEB Design</div><div class="center">
<a href="#section-two" target="_self" rel="nofollow"><button>View our Themes</button></a></div>',
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
	   $section_content_typography_std = array(
										 array( 'size' => '16px', 'face' => 'Open Sans, sans-serif', 'color' => '#ffffff','style'=>300),
										  array( 'size' => '16px', 'face' => 'Open Sans, sans-serif', 'color' => '#ffffff','style'=>300),
										  array( 'size' => '16px', 'face' => 'Open Sans, sans-serif', 'color' => '#ffffff','style'=>300),
										  array( 'size' => '16px', 'face' => 'Open Sans, sans-serif', 'color' => '#ffffff','style'=>300)
										  );
	 
	 $section_background = array(
	     array(
		'color' => '#ffcc33',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'fixed' ),
		 array(
		'color' => '#1ed87d',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'fixed' ),
		 array(
		'color' => '#ff415c',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'fixed' ),
		 array(
		'color' => '#178cc6',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'fixed' )
		 );

	 
	 		for($i=0; $i < $section_num; $i++){
		
		if(!isset($section_title[$i])){$section_title[$i] = "";}
		if(!isset($section_id[$i])){$section_id[$i] = "";}
		if(!isset($section_background[$i])){$section_background[$i] = array('color' => '',
		'image' => '',
		'repeat' => '',
		'position' => '',
		'attachment'=>'');}
		if(!isset($section_css_class[$i])){$section_css_class[$i] = "";}
		if(!isset($section_title[$i])){$section_title[$i] = "";}
		if(!isset($section_sub_title[$i])){$section_sub_title[$i] = "";}
		if(!isset($section_content[$i])){$section_content[$i] = "";}
		if(!isset($section_title_color[$i])){$section_title_color[$i] = "";}
		if(!isset($section_title_border_color[$i])){$section_title_border_color[$i] = "";}
		if(!isset($section_content_typography_std[$i])){$section_content_typography_std[$i] = "";}
		
		$options[] = array(	'desc' => '<div class="options-section"><h3 class="groupTitle">'.sprintf(__('Section %d','onepagescroll'),($i+1)).'</h3>', 'class' => 'toggle_option_group group_close','type' => 'info');
		
		$options[] = array('name' => __('Section ID', 'onepagescroll'),'id' => 'section_id_'.$i.'','type' => 'text','std'=>$section_id[$i],'desc'=> __('Add anchor tag to jump to specific section on one page without having any space or symbol. This section id will be related with the menu link, it should be call on wp appearance menu by using # after site url. It is usually all lowercase and contains only letters, numbers, and hyphens.', 'onepagescroll'));
		
		$options[] = array('name' => __('Section Title', 'onepagescroll'),'id' => 'section_title_'.$i.'','type' => 'text','std'=>$section_title[$i]);
		$options[] = array('name' => __('Section Sub-Title', 'onepagescroll'),'id' => 'section_sub_title_'.$i.'','type' => 'text','std'=>$section_sub_title[$i]);
		
		
		$options[] = array( 'name' => __('Section Title Typography', 'onepagescroll'),
			'id' => 'section_title_typography_'.$i,
			'std' => array( 'size' => '24px', 'face' => 'Open Sans, sans-serif', 'color' => '#333333'),
			'type' => 'typography',
			'options' => array(
			'faces' =>  onepagescroll_options_typography_get_os_fonts(),
			'styles' => false )
			  );
		
		$options[] = array( 'name' => __('Section Sub-Title Typography', 'onepagescroll'),
			'id' => 'section_sub_title_typography_'.$i,
			'std' => array( 'size' => '30px', 'face' => 'Open Sans, sans-serif', 'color' => '#ffffff'),
			'type' => 'typography',
			'options' => array(
			'faces' =>  onepagescroll_options_typography_get_os_fonts(),
			'styles' => false )
			  );
		
		
		$options[] = array( 'name' => __('Section Content Typography', 'onepagescroll'),
			'id' => 'section_content_typography_'.$i,
			'std' => $section_content_typography_std[$i],
			'type' => 'typography',
			'options' => array(
			'faces' =>  onepagescroll_options_typography_get_os_fonts(),
			'styles' => false )
			  );
		
		$options[] = array('name' =>  __('Section Background', 'onepagescroll'),'id' => 'section_background_'.$i.'','std' => $section_background[$i],'type' => 'background' );
		
	   $options[] = array('name' => __('Section Css Class', 'onepagescroll'),'id' => 'section_css_class_'.$i.'','type' => 'text','std'=>$section_css_class[$i]);
	   
	   
	   $options[] = array('name' => __('Section Content', 'onepagescroll'),'id' => 'section_content_'.$i,'std' => $section_content[$i],'type' => 'editor');
	   $options[] = array('desc' => '</div>','class' => 'toggle_title','type' => 'info');
	
		}
		

// FOOTER
	    $options[] = array('name' => __('Footer', 'onepagescroll'),'type' => 'heading');
	
	    $social_icons = array('fa fa-facebook'=>'facebook',
						  'fa fa-flickr'=>'flickr',
						  'fa fa-google-plus'=>'google plus',
						  'fa fa-linkedin'=>'linkedin',
						  'fa fa-pinterest'=>'pinterest',
						  'fa fa-twitter'=>'twitter',
						  'fa fa-tumblr'=>'tumblr',
						  'fa fa-digg'=>'digg',
						  'fa fa-rss'=>'rss',
						 
						  );
        for($i=0;$i<9;$i++){
			
	    $options[] = array("name" => sprintf(__('Social Icon #%s', 'onepagescroll'),($i+1)),	"id" => "social_icon_".$i,"std" => "","class" => 'mini',"type" => "select",	"options" => $social_icons );
		$options[] = array('name' => sprintf(__('Social Title #%s', 'onepagescroll'),($i+1)),'id' => 'social_title_'.$i,"class" => 'mini','type' => 'text');	
		$options[] = array('name' => sprintf(__('Social Link #%s', 'onepagescroll'),($i+1)),'id' => 'social_link_'.$i,'type' => 'text');	
		}

//Typography
		
		$options[] = array('name' => __('Typography', 'onepagescroll'),'type' => 'heading');

	    $options[] = array('name' => __('Content Link Color', 'onepagescroll'),'id' => 'content_link_color','type' => 'color','std'=>'#a29c9a');
		$options[] = array('name' => __('Content Link Mouseover Color', 'onepagescroll'),'id' => 'content_link_hover_color','type' => 'color','std'=>'#fe8a02');
		
		$options[] = array( 'name' => __('Page Menu Typography', 'onepagescroll'),

			'desc' => __('Homepage and Pages Menu Typography.', 'onepagescroll'),
			'id' => 'page_menu_typography',
			'std' => array( 'size' => '14px', 'face' => 'Open Sans, sans-serif', 'color' => '#c2d5eb'),
			'type' => 'typography',
			'options' => array(
			'faces' => onepagescroll_options_typography_get_os_fonts(),
			'styles' => false )
			  );
		$options[] = array('name' => __('Page Menu Active Color', 'onepagescroll'),'id' => 'home_nav_menu_hover_color' ,'std' => '#ffffff','type'=> 'color');
		
		$options[] = array( 'name' => __('Blog Menu Typography', 'onepagescroll'),

			'desc' => __('Blog Menu Typography.', 'onepagescroll'),
			'id' => 'blog_menu_typography',
			'std' => array( 'size' => '14px', 'face' => 'Open Sans, sans-serif', 'color' => '#666666'),
			'type' => 'typography',
			'options' => array(
			'faces' => onepagescroll_options_typography_get_os_fonts(),
			'styles' => false )
			  );
		
		$options[] = array('name' => __('Blog Menu Active Color', 'onepagescroll'),'id' => 'blog_menu_hover_color' ,'std' => '#eeee22','type'=> 'color');
		
		$options[] = array( 'name' => __('Homepage Side Nav Menu Typography', 'onepagescroll'),

			'id' => 'homepage_side_nav_menu_typography',
			'std' => array( 'size' => '14px', 'face' => 'Open Sans, sans-serif', 'color' => '#666666'),
			'type' => 'typography',
			'options' => array(
			'faces' => onepagescroll_options_typography_get_os_fonts(),
			'styles' => false )
			  );
	     $options[] = array('name' => __('Side Nav Menu Active Color', 'onepagescroll'),'id' => 'home_side_nav_menu_active_color' ,'std' => '#ffcc33','type'=> 'color');

		 
		 $options[] = array( 'name' => __('Pages & Posts Content Typography', 'onepagescroll'),

			'id' => 'page_post_content_typography',
			'std' => array( 'size' => '13px', 'face' => 'Open Sans, sans-serif', 'color' => '#555555'),
			'type' => 'typography',
			'options' => array(
			'faces' => onepagescroll_options_typography_get_os_fonts(),
			'styles' => false )
			  );


	return $options;
}