jQuery.noConflict();
(function($) {



  $(".folio-item img").bind("load", function () { 
  	$(this)
  	.css({ opacity: 0, visibility: 'visible' })
  	.animate({ opacity: 1 }, 400)
    .queue(function(n) {
      $(this).parent().find(".more-hover").css({ visibility: 'visible' });
    n();});
  }).each(function() {
    if(this.complete) {  
     	$(this)
     	.css({ opacity: 0, visibility: 'visible' })
    	.animate({ opacity: 1 }, 400)
      .queue(function(n) {
        $(this).parent().find(".more-hover").css({ visibility: 'visible' });
      n();});
    }
  });
  
  $(".entry-wrapper .entry-thumb > img").bind("load", function () { 
  	$(this)
  	.css({ opacity: 0, visibility: 'visible' })
  	.animate({ opacity: 1 }, 400)
  }).each(function() {
    if(this.complete) {  
     	$(this)
     	.css({ opacity: 0, visibility: 'visible' })
    	.animate({ opacity: 1 }, 400)
    }
  });
  
  
  
/* <<<<< DOCUMENT READY >>>>> */

$(document).ready(function(){

/*----------------------------------------------------*/
// DETECT IF JS IS ENABELED
/*----------------------------------------------------*/

	$('html').removeClass('no-js');
	
/*----------------------------------------------------*/
// CHECK IE VERSION & ADD CLASSES
/*----------------------------------------------------*/
	
	if (jQuery.browser.msie && jQuery.browser.version == '8.0' ) {
		$('html').removeClass('modern');
		$('html').addClass('ie8');
	}
	
	if (jQuery.browser.msie && jQuery.browser.version == '9.0' ) {
		$('html').addClass('ie9');
	}
	
/*----------------------------------------------------*/
// REMOVE SOME IMAGES' WIDTH & HEIGHT ATTRIBUTES
/*----------------------------------------------------*/

	$('.entry-thumb img').removeAttr('width').removeAttr('height');

/*----------------------------------------------------*/
// SUPERFISH MENU
/*----------------------------------------------------*/

    $(".main-menu").superfish({
	    delay: 400,
	    hoverClass: 'hover-menu-item',
	    autoArrows: false,
	    animation: { opacity:'show', height:'show' },
		speed: 200
    }); 

/*----------------------------------------------------*/
// SMOOTH BACK TO TOP / BACK TO TP BUTTON
/*----------------------------------------------------*/

	$('a[href=#main_container]').click(function(){
			$('html, body').animate({ scrollTop:0 }, 'slow', 'easeOutQuart' );
		return false;
	});
	
	$("#toTop").topButton({
    position: 500,
    fadeSpeed: 1000,
    scrollSpeed: 1000
	});

/*----------------------------------------------------*/
// HOVERS & OVERLAYS
/*----------------------------------------------------*/

	/*/// BLOG THUMBS OVERLAY ///*/
	$(".blog-posts a.entry-thumb").live({
	mouseenter:
		function(){
			
			$(this).stop().addClass('blog-hover');
			
			$(this).find("img").stop()
			.css({ opacity: 1 })
			.animate({ opacity: 0.5 }, 250);
			
		},
	mouseleave:
		function(){
			
			$(this).find("img").stop().animate({ opacity: 1 }, 250);
			
		}
	});
	
	
	/*/// PORTFOLIO WIDGET OVERLAY ///*/
	$(".jcarousel-skin-folio-wid li").live({
	mouseenter:
		function(){
			
			$(this).find(".folio-wid-overlay")
			.css({ opacity: 0 }).stop()
			.animate({ opacity: 1 }, { duration: 250, queue: false });
			
		},
	mouseleave:
		function(){
			
			$(this).find(".folio-wid-overlay").stop().animate({ opacity: 0 }, { duration: 250, queue: false });
			
		}
	});
	
	
	/*/// PORTFOLIO THUMBS OVERLAY ///*/
	$(".folio-overlay").live({
	mouseenter:
		function(){
			
			$(this).stop().parent().addClass('folio-hover');
			
			$(this).find(".more-hover").stop()
			.css({ bottom: "30px" })
			.animate({ bottom: "15" }, 250);
			
			$(this).find(".folio-title").stop()
			.css({ opacity: 0, visibility: 'visible' })
			.animate({ opacity: 1 }, 250);
			
			$(this).find("img").stop()
			.css({ opacity: 1 })
			.animate({ opacity: 0.5 }, 250);
			
		},
	mouseleave:
		function(){
			
			$(this).find(".more-hover").stop().animate({ bottom: "30px" }, 250);
			$(this).find(".folio-title").stop().animate({ opacity: 0 }, 250).queue(function(n) {
			  $(this).css({ visibility: 'hidden' });
			n();});;
			$(this).find("img").stop().animate({ opacity: 1 }, 250);
			
		}
	});



/*----------------------------------------------------*/
// EQUAL HEIGHT COLUMNS
/*----------------------------------------------------*/

    equalHeight('.single-portfolio #folio-wrapper > section');
    

}); // END $(document).ready


/*----------------------------------------------------*/
// CUSTOM FUNCTIONS
/*----------------------------------------------------*/

// EQUAL HEIGHTS FUNCTION //

var maxHeight = 0;
function equalHeight(column) {
    
    column = $(column);
    
    column.each(function() {       
        
        if($(this).height() > maxHeight) {
            maxHeight = $(this).height();
        }
    });
    
    column.height(maxHeight);
}

/*----------------------------------------------------*/
// CLEAR FORM FIELDS ON FOCUS
/*----------------------------------------------------*/

$(function() {
	$('input:text, textarea').each(function() {
	var field = $(this);
	var default_value = field.val();
	field.focus(function() {
	if (field.val() == default_value) {
	field.val('');
	}
	});
	field.blur(function() {
	if (field.val() == '') {
	field.val(default_value);
	}
	});
	});
});

/*----------------------------------------------------*/
// HEADER SEARCh FIELD EFFECT
/*----------------------------------------------------*/

$("#branding .header-search").animate({ width: '25px'}, 800, 'easeInOutExpo');
$("#branding input:text").animate({ width: '25px', paddingLeft: '0', paddingRight: '0' }, 800, 'easeInOutExpo');
$("#branding input:text").focus(function() {
  $(this).animate({ width: '100px', paddingLeft: '10px', paddingRight: '25px' }, 800, 'easeInOutExpo');
  $(this).parent().parent().animate({ width: '135px'}, 800, 'easeInOutExpo');
});
$("#branding input:text").blur(function() {
  if( $(this).val() == '' ){
    $(this).animate({ width: '25px', paddingLeft: '0', paddingRight: '0' }, 800, 'easeInOutExpo');
    $(this).parent().parent().animate({ width: '25px'}, 800, 'easeInOutExpo');
  }
});

/*----------------------------------------------------*/
// CLEARING TAGS WIDGET FLOAT
/*----------------------------------------------------*/

$(".widget_tag_cloud").append('<div class="clear"></div>');



})(jQuery);