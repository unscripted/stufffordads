<?php
/*
Template Name: Home Page - Fullscreen Slideshow
*/

?>
<?php get_header();?>
  
  <?php the_post();
  
  if(of_get_option("fullscreen_home_delay")){ $sliderDelay = of_get_option("fullscreen_home_delay"); } else { $sliderDelay = '5000'; }
  if(of_get_option("fullscreen_home_effect")){ $sliderAnimation = of_get_option("fullscreen_home_effect"); } else { $sliderAnimation = '1'; }
  if( of_get_option('fullscreen_home_order') != '' ) $orderOption = of_get_option('fullscreen_home_order'); else $orderOption = 'post_date';
  
  $sliderSetOption =  get_post_meta($post->ID, 'sliderSet', TRUE);
  
  global $post;
	$tmp_post = $post;
	
	if( $sliderSetOption == 0 || $sliderSetOption == '' ):
  	$args = array(
  	   'posts_per_page' => -1,
  	   'order' => 'DESC',
  	   'orderby' => $orderOption,
  	   'post_type' => 'slides'
  	);
	else:
  	$args = array(
  	   'posts_per_page' => -1,
  	   'order' => 'DESC',
  	   'orderby' => $orderOption,
  	   'post_type' => 'slides',
  	   'tax_query' => array(
				    array(
				      'taxonomy' => 'slider_sets',
				      'field' => 'id',
				      'terms' => array($sliderSetOption),
				      'operator' => 'IN'
				    )
				)
  	);
	endif;
	
	$myposts = get_posts($args);
	
	$slides = array();
  
  foreach( $myposts as $post ) : setup_postdata($post); 

  $slideImgPath =  get_post_meta($post->ID, 'nivoImgURL', TRUE);
  if( !$slideImgPath ){ $slideImgPath = get_template_directory_uri().'/images/no-image-800x600.png';  }
  $slideImg =  pt_get_image_path($slideImgPath);
  $slideLink =  get_post_meta($post->ID, 'nivoLink', TRUE);
	$slideCaption1 =  get_post_meta($post->ID, 'nivoCaption1', TRUE);
	$slideCaption2 =  get_post_meta($post->ID, 'nivoCaption2', TRUE);
	
  if( $slideLink ):
  	if( $slideCaption1 ){ $caption1 = '<h2><a href="'.$slideLink.'"><span>'.$slideCaption1.'</span></a></h2>'; } else { $caption1 = '<a class="slideshow-overlay" href="'.$slideLink.'"></a>'; }
  	if( $slideCaption2 ){ $caption2 = '<h3><span>'.$slideCaption2.'</span></h3>'; } else { $caption2 = ''; }
  else:
    if( $slideCaption1 ){ $caption1 = '<span class="slideshow-overlay"></span><h2><span>'.$slideCaption1.'</span></h2>'; } else { $caption1 = '<span class="slideshow-overlay"></span>'; }
  	if( $slideCaption2 ){ $caption2 = '<h3><span>'.$slideCaption2.'</span></h3>'; } else { $caption2 = ''; }
  endif;
          
  $slides[] = "{ image: '".$slideImg."', title: '".$caption1.$caption2."', url: '".$slideLink."', thumb: '".PT_FUNCTIONS."/timthumb.php?src=".$slideImg."&amp;h=60&amp;w=100&amp;zc=1&amp;q=100' }";
  
  endforeach;
	$post = $tmp_post;
	wp_reset_query();
	
	$slide = join( ', ', $slides );
  
  ?>
  
  <script>
  
  jQuery(function($){
  	$.supersized({
  
      autoplay         : 1,         // Determines whether slideshow begins playing when page is loaded
      fit_landscape    : 0,         // Prevents the image from being cropped by locking it at 100% width
      fit_portrait     : 0,         // Prevents the image from being cropped by locking it at 100% height
      horizontal_center: 1,         // Centers image horizontally. When turned off, the images resize/display from the left of the page
      vertical_center  : 1,         // Centers image vertically. When turned off, the images resize/display from the top of the page
      image_protect    : 1,         // Disables right clicking and image dragging using Javascript
      performance      : 1,         // Uses image rendering options in Firefox and Internet Explorer to adjust image quality
      keyboard_nav     : 1,         // Allows control via keyboard
      pause_hover      : 0,         // Pauses slideshow while current image hovered over
      new_window       : 1,         // Slide links open in a new window/tab
      slide_interval   : <?php echo $sliderDelay; ?>,      // Length between transitions
      transition       : <?php echo $sliderAnimation; ?>,         // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
      transition_speed : 800,	    	// Speed of transition
      slide_links      : 'blank',	  // Individual links for each slide (Options: false, 'num', 'name', 'blank')
      slides           : [		      // Slideshow Images
          
      <?php echo $slide; ?>
      
      ]
  
    });
  });
  
  </script>
  
  <section id="content">
  	
  	<div id="slideshow-overlay"></div>
  	
  	<!--Slide captions displayed here-->
    <div id="slidecaption"></div>
  	
  	<div id="thumb-tray" class="load-item">
  		<div id="thumb-back"><span></span></div>
  		<div id="thumb-forward"><span></span></div>
  	</div>
  	
  </section><!-- #content -->

<?php get_footer();?>