jQuery(document).ready(function($) {

// section full screen

$(".homepage_content_wrap section.section").each(function(){
											  
  $(this).css({'min-height':$(window).height()});						  
											  
  });

// Parallax Scrolling

	jQuery('.sidebar .main_nav').onePageNav({
		changeHash: false,
		filter: ".menu-item a[href^='#']",
		scrollSpeed:parseInt(onepagescroll_params.scrollspeed),
		currentClass:"active"
	});

/* ------------------------------------------------------------------------ */
/* Preserving aspect ratio for embedded iframes														*/
/* ------------------------------------------------------------------------ */
$('.entry-content embed,.entry-content iframe').each(function(){
										
		var width  = $(this).attr('width');	
		var height = $(this).attr('height');
		if($.isNumeric(width) && $.isNumeric(height)){
			if(width > $(this).width()){
				var new_height = (height/width)*$(this).width();
				$(this).css({'height':new_height});
				}
			
			}				
    });
/* ------------------------------------------------------------------------ */
/* sidebar height														*/
/* ------------------------------------------------------------------------ */

if( $('.page-container').length){
	var adminbarHeight = 0;
	if( $("body.admin-bar").length){
		if( $(window).width() < 765) {
				adminbarHeight = 46;
				
			} else {
				adminbarHeight = 32;
			}
	  }
	  
$('.page-container').css({'min-height':$(window).height()-$('header').outerHeight()-$('#footer').outerHeight()-adminbarHeight-20});
}

if( $('section.sidebar').length){
	var adminbarHeight = 0;
	if( $("body.admin-bar").length){
		if( $(window).width() < 765) {
				adminbarHeight = 46;
				
			} else {
				adminbarHeight = 32;
			}
	  }
	  
$('section.sidebar').css({'min-height':$(window).height()});
}



$(".sidebar").on("click",".close-menu,#panel-cog",function(){
			if($(this).parents(".sidebar").hasClass("hide-sidebar")){
				$(this).parents(".sidebar").removeClass("hide-sidebar");
				$('#panel-cog i').removeClass('fa-chevron-right').addClass('fa-chevron-left');
				$('.homepage_content_wrap').css({'margin-left':onepagescroll_params.sidebar_width+"px" });
				}
				else{
				$(this).parents(".sidebar").addClass("hide-sidebar");	
				$('#panel-cog i').removeClass('fa-chevron-left').addClass('fa-chevron-right');
				$('.homepage_content_wrap').css({'margin-left':'0px'});
					}
       })


/* ------------------------------------------------------------------------ */
/* prettyPhoto														*/
/* ------------------------------------------------------------------------ */

$('.gallery-item .gallery-icon > a').prettyPhoto();

 /* ------------------------------------------------------------------------ */
/*  smooth scrolling  btn       	  								  	    */
/* ------------------------------------------------------------------------ */

  jQuery("a[href^='#']").on('click', function(e){
 
				var scrollTop = jQuery(window).scrollTop(); 
				e.preventDefault();
		 		var id = jQuery(this).attr('href');
				if(typeof jQuery(id).offset() !== 'undefined'){
				var goTo = jQuery(id).offset().top;
				jQuery("html, body").animate({ scrollTop: goTo }, 1000);
				}

			});	
  
/* ------------------------------------------------------------------------ */
/* site nav toggle															*/
/* ------------------------------------------------------------------------ */

  jQuery(".site-nav-toggle").click(function(){
    jQuery(".site-nav").toggle();
   });
  
  /*----------------------------------------------------*/
// video background
/*----------------------------------------------------*/  

  if( typeof background_video !== 'undefined'  ){
  var	loop = false;
  if( background_video.loop == 'true' )
	  loop = true;
	  
   var autoplay = true;
  if( background_video.autoplay == '' || background_video.autoplay == '0' )
   autoplay = false;
	  
  $(background_video.container).prepend('<div class="video-background"></div>');
				$('.video-background').videobackground({
					videoSource: [[background_video.mp4_video_url, 'video/mp4'],
						[background_video.webm_video_url, 'video/webm'], 
						[background_video.ogv_video_url, 'video/ogg']], 
					controlPosition: background_video.container,
					poster: background_video.poster_url,
					loop:loop,
					autoplay:autoplay,
					volume: parseFloat(background_video.volume),
					resizeTo: 'container',
					loadedCallback: function() {
						$(this).videobackground('mute');
					}
				});
		}
		
		

 });
