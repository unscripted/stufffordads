<?php
/*
Template Name: Portfolio Page - Fullscreen - All Items
*/

?>
<?php get_header();?>
  
  <?php the_post();
  
  if(of_get_option("fullscreen_folio_delay")){ $sliderDelay = of_get_option("fullscreen_folio_delay"); } else { $sliderDelay = '5000'; }
  if(of_get_option("fullscreen_folio_effect")){ $sliderAnimation = of_get_option("fullscreen_folio_effect"); } else { $sliderAnimation = '1'; }
    
  global $post;
	$tmp_post = $post;
	
	$args = array(
    'posts_per_page' => -1,
    'post_type' => 'portfolio',
    'orderby' => 'post_date'
  );
	
	$myposts = get_posts($args);
	
	$slides = array();
  
  foreach( $myposts as $post ) : setup_postdata($post); 
    
    if ( has_post_thumbnail()):
      $folioThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
      $slideImgPath = $folioThumbnail[0];
    else:
      $slideImgPath = get_template_directory_uri().'/images/no-image-800x600.png';
    endif;
    
    $slideImg =  pt_get_image_path($slideImgPath);
    
    $slideLink =  get_permalink();
    $slideTitle =  get_the_title();
    $slideExcerpt = get_the_excerpt();
    
    $folio_cats =  get_the_terms( get_the_ID(), 'portfolio_cats' );
    $cat_name = '';
    $cats_names = array();
    if( !empty($folio_cats) ):
      foreach( $folio_cats as $folio_cat ):
        $cats_names[] = $folio_cat->name;
      endforeach; 
      $cat_name = join( ', ', $cats_names );
    endif;
    
    if( $slideTitle ){ $entryTitle = '<h2><a href="'.$slideLink.'"><span>'.$slideTitle.'</span></a></h2>'; } else { $entryTitle = ''; }
    if( $slideExcerpt ){ $entryExcerpt = '<div class="scroll-pane"><p>'.$slideExcerpt.'</p></div>'; } else { $entryExcerpt = ''; }
    if( $cat_name ){ $entryCats = '<h3><span>'.$cat_name.'</span></h3>'; } else { $entryCats = ''; }
            
    $slides[] = "{ image: '".$slideImg."', title: '".$entryTitle.$entryExcerpt.$entryCats."', url: '".$slideLink."', thumb: '".PT_FUNCTIONS."/timthumb.php?src=".$slideImg."&amp;h=60&amp;w=100&amp;zc=1&amp;q=100' }";
    
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
      vertical_center  : 0,         // Centers image vertically. When turned off, the images resize/display from the top of the page
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
  	
  	<!--Slide captions displayed here-->
    <div id="slidecaption"></div>
  	
  	<div id="thumb-tray" class="load-item">
  		<div id="thumb-back"><span></span></div>
  		<div id="thumb-forward"><span></span></div>
  	</div>
  	
  </section><!-- #content -->
  
  <div id="slideshow-overlay"></div>

<?php get_footer();?>