jQuery.noConflict();
(function($) {

$(document).ready(function() {

// POST FORMAT RADIO BUTTONS
var linkFormat = $("#post-format-link");
var videoFormat = $("#post-format-video");
var audioFormat = $("#post-format-audio");
var quoteFormat = $("#post-format-quote");
var galleryFormat = $("#post-format-gallery");


// POST FORMAT METABOXES
var linkMetabox = $("#linkf_settings");
var videoMetabox = $("#videof_settings");
var audioMetabox = $("#audiof_settings");
var quoteMetabox = $("#quotef_settings");
var galleryMetabox = $("#galleryf_settings");


// FOLIO CATEGORY METABOX
var folioCatMetabox = $("#folio_cat_settings");

// HOME COMPOSITION METABOXS
var compositionMetaboxes = $("#content_sections_settings, #callout_mes_settings, #slider_set_settings, #video_banner_settings, #fixed_image_settings, #recent_work_settings, #recent_posts_settings, #grid_nav_settings");

var compositionSubMetaboxes = $("#callout_mes_settings, #slider_set_settings, #video_banner_settings, #fixed_image_settings, #recent_work_settings, #recent_posts_settings, #grid_nav_settings");

var contentSectionsMetabox = $("#content_sections_settings");
var calloutMesMetabox = $("#callout_mes_settings");
var sliderSetMetabox = $("#slider_set_settings");
var videoBannerMetabox = $("#video_banner_settings");
var fixedImgMetabox = $("#fixed_image_settings");
var recentWorkMetabox = $("#recent_work_settings");
var recentPostsMetabox = $("#recent_posts_settings");
var gridNavMetabox = $("#grid_nav_settings");

var sectionsMenus = $("#firstSection, #secondSection, #thirdSection, #fourthSection, #fifthSection, #sixthSection");

var sectionOneMenu = $("#firstSection");
var sectionTwoMenu = $("#secondSection");
var sectionThreeMenu = $("#thirdSection");
var sectionFourMenu = $("#fourthSection");
var sectionFiveMenu = $("#fifthSection");
var sectionSixMenu = $("#sixthSection");

// PAGE TEMPLATE SELECT MNEU
var pageTemplate = $("#page_template");


// HIDE ALL METABOXES ON LOAD
var allMetaboxes = $("#linkf_settings, #videof_settings, #audiof_settings, #quotef_settings, #galleryf_settings");
allMetaboxes.css({ display: 'none' });
folioCatMetabox.css({ display: 'none' });
compositionMetaboxes.css({ display: 'none' });


// SHOW X METABOX IF X READIO IS CHECKED ON LOAD
if(linkFormat.is(':checked')){
linkMetabox.css({ display: 'block' });
}

if(videoFormat.is(':checked')){
videoMetabox.css({ display: 'block' });
}

if(audioFormat.is(':checked')){
audioMetabox.css({ display: 'block' });
}

if(quoteFormat.is(':checked')){
quoteMetabox.css({ display: 'block' });
}

if(galleryFormat.is(':checked')){
galleryMetabox.css({ display: 'block' });
}

if( pageTemplate.val() == 'portfolio-grid-cat.php' || pageTemplate.val() == 'portfolio-masonry-cat.php' || pageTemplate.val() == 'portfolio-fullscreen-cat.php'){
folioCatMetabox.css({ display: 'block' });
}

if( pageTemplate.val() == 'home-composition.php'){
contentSectionsMetabox.css({ display: 'block' });
}

if( pageTemplate.val() == 'home-fullscreen.php'){
sliderSetMetabox.css({ display: 'block' });
}

pageTemplate.change(function() {
  if( pageTemplate.val() != 'home-composition.php'){
    compositionSubMetaboxes.css({ display: 'none' });
  }
});

sectionsMenus.each(function() {
  if( pageTemplate.val() == 'home-composition.php' ) {
    if( $(this).val() == "callout-message" ) {
      calloutMesMetabox.css({ display: 'block' });
    }
    else if ( $(this).val() == "nivo-slider" ) {
      sliderSetMetabox.css({ display: 'block' });
    }
    else if ( $(this).val() == "fixed-image" ) {
      fixedImgMetabox.css({ display: 'block' });
    }
    else if ( $(this).val() == "video-banner" ) {
      videoBannerMetabox.css({ display: 'block' });
    }
    else if ( $(this).val() == "recent-work-row" || $(this).val() == "recent-work-desc" ) {
      recentWorkMetabox.css({ display: 'block' });
    }
    else if ( $(this).val() == "recent-posts-row" || $(this).val() == "recent-posts-desc" ) {
      recentPostsMetabox.css({ display: 'block' });
    }
    else if ( $(this).val() == "grid-showcase" ) {
      calloutMesMetabox.css({ display: 'block' });
    }
  }
});


//ON RADIO BUTTONS CHANGE
var radioSet = jQuery('#post-formats-select input');

radioSet.change( function() {
	if($(this).val() == 'link') {
		allMetaboxes.css({ display: 'none' });
		linkMetabox.css({ display: 'block' });
	}
	else if($(this).val() == 'video') {
		allMetaboxes.css({ display: 'none' });
		videoMetabox.css({ display: 'block' });
	}
	else if($(this).val() == 'audio') {
		allMetaboxes.css({ display: 'none' });
		audioMetabox.css({ display: 'block' });
	}
	else if($(this).val() == 'quote') {
		allMetaboxes.css({ display: 'none' });
		quoteMetabox.css({ display: 'block' });
	}
	else if($(this).val() == 'gallery') {
		allMetaboxes.css({ display: 'none' });
		galleryMetabox.css({ display: 'block' });
	}
	else {
		allMetaboxes.css({ display: 'none' });
	}
});


//ON PAGE TEMPLATE SELECT MENU CHANGE
pageTemplate.change( function() {
	if( pageTemplate.val() == 'portfolio-grid-cat.php' ||
      pageTemplate.val() == 'portfolio-masonry-cat.php' ||
      pageTemplate.val() == 'portfolio-fullscreen-cat.php' ){
		folioCatMetabox.css({ display: 'block' });
	}
	else if( pageTemplate.val() == 'home-composition.php' ){
	 contentSectionsMetabox.css({ display: 'block' });
	}
	else if( pageTemplate.val() == 'home-fullscreen.php' ){
	 sliderSetMetabox.css({ display: 'block' });
	}
	else {
		folioCatMetabox.css({ display: 'none' });
		contentSectionsMetabox.css({ display: 'none' });
	}
});


//ON CONTENT SECTIONS SELECT MENUS CHANGE
sectionsMenus.each(function() {
  $(this).change( function() {
  	compositionSubMetaboxes.css({ display: 'none' });
  	
  	if( sectionOneMenu.val() != "0" ) {
  	  if( sectionOneMenu.val() == "callout-message" ) {
  	    calloutMesMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionOneMenu.val() == "nivo-slider" ) {
  	    sliderSetMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionOneMenu.val() == "fixed-image" ) {
  	    fixedImgMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionOneMenu.val() == "video-banner" ) {
  	    videoBannerMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionOneMenu.val() == "recent-work-row" || sectionOneMenu.val() == "recent-work-desc" ) {
  	    recentWorkMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionOneMenu.val() == "recent-posts-row" || sectionOneMenu.val() == "recent-posts-row" ) {
  	    recentPostsMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionOneMenu.val() == "grid-showcase" ) {
  	    calloutMesMetabox.css({ display: 'block' });
  	  }
  	}
  	
  	if( sectionTwoMenu.val() != "0" ) {
  	  if( sectionTwoMenu.val() == "callout-message" ) {
  	    calloutMesMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionTwoMenu.val() == "nivo-slider" ) {
  	    sliderSetMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionTwoMenu.val() == "fixed-image" ) {
  	    fixedImgMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionTwoMenu.val() == "video-banner" ) {
  	    videoBannerMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionTwoMenu.val() == "recent-work-row" || sectionTwoMenu.val() == "recent-work-desc" ) {
  	    recentWorkMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionTwoMenu.val() == "recent-posts-row" || sectionTwoMenu.val() == "recent-posts-desc" ) {
  	    recentPostsMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionTwoMenu.val() == "grid-showcase" ) {
  	    gridNavMetabox.css({ display: 'block' });
  	  }
  	}
  	
  	if( sectionThreeMenu.val() != "0" ) {
  	  if( sectionThreeMenu.val() == "callout-message" ) {
  	    calloutMesMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionThreeMenu.val() == "nivo-slider" ) {
  	    sliderSetMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionThreeMenu.val() == "fixed-image" ) {
  	    fixedImgMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionThreeMenu.val() == "video-banner" ) {
  	    videoBannerMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionThreeMenu.val() == "recent-work-row" || sectionThreeMenu.val() == "recent-work-desc" ) {
  	    recentWorkMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionThreeMenu.val() == "recent-posts-row" || sectionThreeMenu.val() == "recent-posts-desc" ) {
  	    recentPostsMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionThreeMenu.val() == "grid-showcase" ) {
  	    gridNavMetabox.css({ display: 'block' });
  	  }
  	}
  	
  	if( sectionFourMenu.val() != "0" ) {
  	  if( sectionFourMenu.val() == "callout-message" ) {
  	    calloutMesMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionFourMenu.val() == "nivo-slider" ) {
  	    sliderSetMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionFourMenu.val() == "fixed-image" ) {
  	    fixedImgMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionFourMenu.val() == "video-banner" ) {
  	    videoBannerMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionFourMenu.val() == "recent-work-row" || sectionFourMenu.val() == "recent-work-desc" ) {
  	    recentWorkMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionFourMenu.val() == "recent-posts-row" || sectionFourMenu.val() == "recent-posts-row" ) {
  	    recentPostsMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionFourMenu.val() == "grid-showcase" ) {
  	    gridNavMetabox.css({ display: 'block' });
  	  }
  	}
  	
  	if( sectionFiveMenu.val() != "0" ) {
  	  if( sectionFiveMenu.val() == "callout-message" ) {
  	    calloutMesMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionFiveMenu.val() == "nivo-slider" ) {
  	    sliderSetMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionFiveMenu.val() == "fixed-image" ) {
  	    fixedImgMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionFiveMenu.val() == "video-banner" ) {
  	    videoBannerMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionFiveMenu.val() == "recent-work-row" || sectionFiveMenu.val() == "recent-work-desc" ) {
  	    recentWorkMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionFiveMenu.val() == "recent-posts-row" || sectionFiveMenu.val() == "recent-posts-row" ) {
  	    recentPostsMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionFiveMenu.val() == "grid-showcase" ) {
  	    gridNavMetabox.css({ display: 'block' });
  	  }
  	}
  	
  	if( sectionSixMenu.val() != "0" ) {
  	  if( sectionSixMenu.val() == "callout-message" ) {
  	    calloutMesMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionSixMenu.val() == "nivo-slider" ) {
  	    sliderSetMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionSixMenu.val() == "fixed-image" ) {
  	    fixedImgMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionSixMenu.val() == "video-banner" ) {
  	    videoBannerMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionSixMenu.val() == "recent-work-row" || sectionSixMenu.val() == "recent-work-desc" ) {
  	    recentWorkMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionSixMenu.val() == "recent-posts-row" || sectionSixMenu.val() == "recent-posts-row" ) {
  	    recentPostsMetabox.css({ display: 'block' });
  	  }
  	  else if ( sectionSixMenu.val() == "grid-showcase" ) {
  	    gridNavMetabox.css({ display: 'block' });
  	  }
  	}
  });
});


});

})(jQuery);