(function($){
	
  $.fn.topButton = function(options) {
 		var this_ = this;
 		
 		var settings = $.extend({
      'position': 300,
      'fadeSpeed': 800,
      'scrollSpeed': 800
 		}, options);
		
		var position = settings['position'];
		var fadeSpeed = settings['fadeSpeed'];
		var scrollSpeed = settings['scrollSpeed'];
					
		$(window).scroll(function() {
      var scrollPosition = $(window).scrollTop();
      
      if(scrollPosition >= position) {
        this_.fadeIn(fadeSpeed);
      } else {
        this_.fadeOut(fadeSpeed);
      }
    });
    
    this_.click(function(){
      $('html, body').animate({ scrollTop:0 }, scrollSpeed, 'easeOutQuart' );
    });
  };
  
})(jQuery);