<?php
add_action('wp_head', 'pt_theme_head_scripts');
function pt_theme_head_scripts() { ?>

	<script type="text/javascript">
	jQuery.noConflict(); (function($) {
	

  $(document).ready(function() {
  	
  	<?php if( of_get_option("ie_warning") == "" || of_get_option("ie_warning") != "0" ): ?>
  	if (jQuery.browser.msie && ( jQuery.browser.version == '6.0' || jQuery.browser.version == '7.0' || jQuery.browser.version == '8.0' ) ) {
  		$('body').append('<div id="ie-warning">Internet Explorer is missing updates required to view this site properly. <a href="http://www.beautyoftheweb.com/#/download" target="_blank">Click here to update</a></div>');
  	}
  	<?php endif; ?>
  	
  	var items = jQuery('.entry-content a').filter(function() {
		if (jQuery(this).attr('href'))	
			return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
  	});
  	items.attr('rel','prettyPhoto[slides]');
  	items.attr('title','');
	
  	$("a[rel^='prettyPhoto']").prettyPhoto();
  });
  
  <?php if ( is_active_widget(false, false, 'portfolio-widget') ): ?>
    $(document).ready(function() {
			$('.widget-portfolio ul').jcarousel({
	    	animation: 600,
	    	easing: 'easeInOutExpo',
	    	wrap: 'circular',
	    	scroll: 1
	    });
		});
  <?php endif; ?>

	<?php if ( (of_get_option('fixed_header') == '' || of_get_option('fixed_header') == '1') && (!is_page_template('portfolio-fullscreen.php') && !is_page_template('portfolio-fullscreen-cat.php') && !is_page_template('home-fullscreen.php')) ): ?>
  	$(window).bind('load', function() {
      var topMargin = $("#branding").outerHeight() + 9;
      var bottomMargin = $("#ending").outerHeight();
      
      <?php if( of_get_option("ie_warning") == "" || of_get_option("ie_warning") != "0" ): ?>
      if (jQuery.browser.msie && ( jQuery.browser.version == '6.0' || jQuery.browser.version == '7.0' || jQuery.browser.version == '8.0' ) ) {
      	var topMargin = $("#branding").outerHeight() + 39;
      }
      <?php endif; ?>
      
      $("#page-loader")
      .animate({ top: '45%', opacity: 0 }, {duration: 200, easing: 'easeOutExpo'})
      .fadeOut(200)
      .queue(function(n) {
        $("#container")
        .animate({ marginTop: topMargin, marginBottom: bottomMargin }, {duration: 400, easing: 'easeOutExpo'})
        .find("#content, #sidebar")
        .animate({ opacity: 1 }, {duration: 400, easing: 'easeOutExpo'})
        .parent().find("#footer-widgets")
        .animate({ opacity: 1 }, {duration: 400, easing: 'easeOutExpo'});
      n();});
    });
  <?php endif; ?>
	
	<?php if( has_shortcode('tabs') ): ?>
		$(document).ready(function() {
			$( ".tabs" ).tabs({ fx: { opacity: 'toggle' } });
		});
	<?php endif; ?>
	
	
	<?php if( has_shortcode('accordion') ): ?>
		$(document).ready(function() {
			$( ".accordion" ).accordion({ collapsible: true, autoHeight: false });
		});
	<?php endif; ?>
	
	
	<?php if( is_page_template('contact.php') ): ?>
		$(document).ready(function(){
			$("#contactf").validate({
				errorElement: "p",
				errorPlacement: function(error, element) { error.appendTo( element.parent() ); }
			});
		});
		
		$(function() {
		    $("#contact-map").gMap({
		    <?php if ( of_get_option('google_map') ): ?>
		    	address: "<?php echo of_get_option('google_map'); ?>",
          markers: [{ address: "<?php echo of_get_option('google_map'); ?>" }],
        <?php elseif ( of_get_option('google_lat') && of_get_option('google_lng') ): ?>
          markers: [{ latitude: <?php echo of_get_option('google_lat'); ?>, longitude: <?php echo of_get_option('google_lng'); ?> }],
        <?php endif; ?>
          zoom: <?php if ( of_get_option('map_zoom') ) echo of_get_option('map_zoom'); else echo '14'; ?>
		    });
		});
	<?php endif; ?>

	
	<?php if ( is_page_template('portfolio-masonry.php') || is_page_template('portfolio-grid.php') || is_page_template('portfolio-grid-cat.php') || is_page_template('portfolio-masonry-cat.php') ): ?>
	  $(document).ready(function(){
        
      var $container = $('#folio-items');
      // initialize isotope
      $container.isotope({
        itemSelector : '.folio-item',
        animationEngine: 'best-available',
        animationOptions: { queue: false, duration: 800 },
        layoutMode: 'masonry'
      });
      
      // filter items when filter link is clicked
      $('#filtering-links li.filter').click(function(){
      
        $("#filtering-links li.filter").removeClass("current");
				$(this).addClass("current");
      
        var selector = $(this).attr('data-filter');
        $container.isotope({
          filter: selector
        });
        return false;
      });
      
	  });
	<?php endif; ?>
	
	
	<?php if ( is_page_template('blog-masonry.php') ): ?>
	  $(document).ready(function(){
      
      $('#masonry-posts-wrapper').masonry({
        itemSelector: '.entry-wrapper'
      });
      
	  });
	<?php endif; ?>
 
	
	<?php if( has_shortcode('slider') ): ?>
		$(window).load(function() {
		    $('.general-nivo').nivoSlider({
		    directionNav: false,
		    controlNav: true,
		    captionOpacity: 1,
		    startSlide: 0,
		    directionNavHide: false,
		    manualAdvance: false,
		    effect: 'fade',
		    pauseTime: 4000
		    });
		    
		    var paginationWidth = $('.nivo-controlNav').width();
      
        var negativeMargin = paginationWidth / 2;
      
        $('.nivo-controlNav').css({ marginLeft: -negativeMargin });
		});
	<?php endif; ?>
	
	
	<?php if( is_single() && get_post_type() == 'portfolio' ): ?>
		$(window).load(function() {
		    $('#folio-nivo').nivoSlider({
		    directionNav: false,
		    controlNav: true,
		    captionOpacity: 1,
		    startSlide: 0,
		    directionNavHide: false,
		    manualAdvance: false,
		    effect: 'fade',
		    pauseTime: 4000
		    });
		    
		    var paginationWidth = $('.nivo-controlNav').width();
      
        var negativeMargin = paginationWidth / 2;
      
        $('.nivo-controlNav').css({ marginLeft: -negativeMargin });
		});
	<?php endif; ?>
	
	
	<?php if( is_page_template('home-composition.php') ):
    	
  	if( of_get_option('slider_effect') != '' ){
  	$nivo_effect = of_get_option('slider_effect');
  	} else { $nivo_effect = 'random'; }
  	
  	if( of_get_option('slider_delay') != '' ){
  	$nivo_delay = of_get_option('slider_delay');
  	} else { $nivo_delay = '3500'; }
  	
  	if( of_get_option('grid_showcase_effect') != '' ){
  	$gridEffect = of_get_option('grid_showcase_effect');
  	} else { $gridEffect = 'disperse'; }
  	
  	global $wp_query;
    $postid = $wp_query->post->ID;
  	$gridNavRows = get_post_meta($postid, 'gridNavRows', TRUE);
  	
  	if( $gridNavRows == '3' ){
      $rows = 3;
    } elseif( $gridNavRows == '2' ){
      $rows = 2;
    } elseif( $gridNavRows == '1' ){
      $rows = 1;
    } else {
      $rows = 3;
    }
  	?>
  		$(window).load(function() {
  		    $('#home-slider').nivoSlider({
  		    directionNav: true,
  		    controlNav: false,
  		    captionOpacity: 1,
  		    startSlide: 0,
  		    directionNavHide: false,
  		    manualAdvance: false,
  		    effect: '<?php echo $nivo_effect; ?>',
  		    pauseTime: <?php echo $nivo_delay; ?>
  		    });
  		});
  		
  		$(function() {
  			$('#tj_container').gridnav({
  				rows	: <?php echo $rows; ?>,
  				type	: {
  					mode		: '<?php echo $gridEffect; ?>', 	// use def | fade | seqfade | updown | sequpdown | showhide | disperse | rows
  					speed		: 500,			// for fade, seqfade, updown, sequpdown, showhide, disperse, rows
  					easing		: 'jswing',			// for fade, seqfade, updown, sequpdown, showhide, disperse, rows	
  					factor		: 50,			// for seqfade, sequpdown, rows
  					reverse		: false			// for sequpdown
  				}
  			});
  		});
    		
	<?php endif; ?>
	
	
	<?php
	if( is_singular() ){
	  global $wp_query;
	  $postid = $wp_query->post->ID;
	  $singularBgImg = get_post_meta($postid, 'singularBgImg', TRUE);
	}
	
	
	if( !is_page_template("home-fullscreen.php") && !is_page_template("portfolio-fullscreen.php") && !is_page_template("portfolio-fullscreen-cat.php") ):
  	if( is_singular() && $singularBgImg ):
  	  $bgImgPath = $singularBgImg;
  	  $bgImage = pt_get_image_path( $bgImgPath ); ?>
  	  
  	$(document).ready(function(){  
  	  var winHeight = $(window).height();
  	  
  	  $("body").append('<div id="bg-overlay"></div>').find("#bg-overlay").css({ height: winHeight });
  
  	  $(window).resize(function() {
  	    var newHeight = $(window).height();
  	    $("#bg-overlay").css({ height: newHeight });
  	  });
  	  
  	  $.backstretch("<?php echo $bgImage; ?>");
  	});
  	  
  	<?php elseif( of_get_option("bg_img") && ( of_get_option("use_full_bg") == "" || of_get_option("use_full_bg") != "0" ) ):
      $bgImgPath = of_get_option("bg_img");
      $bgImage = pt_get_image_path( $bgImgPath ); ?>
    
    $(document).ready(function(){  
      var winHeight = $(window).height();
      
      $("body").append('<div id="bg-overlay"></div>').find("#bg-overlay").css({ height: winHeight });
      
      $(window).resize(function() {
        var newHeight = $(window).height();
        $("#bg-overlay").css({ height: newHeight });
      });
      
      $.backstretch("<?php echo $bgImage; ?>");
    });
      
  	<?php endif; ?>
//	<?php endif; ?>

		
	})(jQuery);
	</script>
	
	<?php if( of_get_option('tracking_code') ){
	echo of_get_option('tracking_code');
	} ?>

<?php }
