<?php
add_action('wp_head', 'pt_theme_style_settings');
function pt_theme_style_settings() {
	$accent_color = of_get_option('cus_accent_color');
	
	if( of_get_option('cus_font_stylesheet') && of_get_option('cus_font_family') ):
	  echo of_get_option('cus_font_stylesheet');
	endif; ?>
	
	<style type="text/css">
		<?php if( of_get_option('use_full_bg') == "0" ): ?>
  		<?php if( of_get_option('bg_img') ): ?>
  		body { background-image: url(<?php echo of_get_option('bg_img');?>); }
  		<?php endif; ?>
  		
  		<?php if( of_get_option('bg_x_pos') && of_get_option('bg_y_pos') ): ?>
  		body { background-position: <?php echo of_get_option('bg_x_pos');?> <?php echo of_get_option('bg_y_pos');?>; }
  		<?php endif; ?>
  		
  		<?php if( of_get_option('bg_att') != '0' ): ?>
  		body { background-attachment: <?php echo of_get_option('bg_att');?>; }
  		<?php endif; ?>
  		
  		<?php if( of_get_option('bg_repeat') != '0' ): ?>
  		body { background-repeat: <?php echo of_get_option('bg_repeat');?>; }
  		<?php endif; ?>
  		
  		<?php if( of_get_option('bg_color') ): ?>
  		body { background-color: <?php echo of_get_option('bg_color');?>; }
  		<?php endif; ?>
		<?php endif; ?>
		
		<?php if( of_get_option('description_color') ): ?>
		.callout-mes h2 { color: <?php echo of_get_option('description_color');?>; }
		<?php endif; ?>
		
		<?php if( $accent_color ): ?>
		a:hover,
		.main-menu li.current-menu-item > a,
		.current-menu-ancestor > a,
		.current-menu-parent > a,
		.entry-wrapper:hover .entry-date a,
		.entry-title a:hover,
		#filtering-links li.filter.current a,
		#filtering-links li.filter:hover a,
		.folio-grid .folio-item .folio-title h3,
		.folio-masonry .folio-item .folio-title h3,
		.home-composition .folio-item .folio-title h3,
		#folio-sidebar aside .folio-cat,
		.team-member-wrap h4,
		#pagination .page-numbers.current,
		#related-posts ul li:hover h6,
		#comments .comment-date a:hover,
		aside.widget.widget-posts-thumbs a:hover h2,
		aside.widget.widget_calendar #wp-calendar tbody a,
		.priceFeatured .labelPrice,
		#slidecaption h2 a:hover,
		.callout-mes h2 a {
		color: <?php echo $accent_color; ?>;
		}
		
		.callout-mes h2 a:hover {
		border-bottom: 1px dotted <?php echo $accent_color; ?>;
		}
		
		.gallery a:hover,
		#home-slider .nivo-caption h3 span,
		#related-posts ul li:hover img,
		aside.widget.widget-posts-thumbs a:hover .wid_thumb,
		aside.widget.widget_calendar #today,
		#slidecaption h3 span {
		background-color: <?php echo $accent_color; ?>;
		}
		
		.gallery a:hover,
		#content input[type="text"]:focus,
		#content textarea:focus,
		#footer-widgets input[type="text"]:focus,
		#footer-widgets textarea:focus,
		#sidebar input[type="text"]:focus,
		#sidebar textarea:focus,
		.recent-posts .recent-post-wrap:hover img.attachment-recent-thumb,
		#related-posts ul li:hover img,
		aside.widget.widget-flickr .flickr_badge_image a:hover,
		aside.widget.widget_tag_cloud .tagcloud > a:hover,
		aside.widget.widget-posts-thumbs a:hover .wid_thumb {
		border: 1px solid <?php echo $accent_color; ?>;
		}
		
		#content input[type="text"]:focus,
		#content textarea:focus,
		#footer-widgets input[type="text"]:focus,
		#footer-widgets textarea:focus,
		#sidebar input[type="text"]:focus,
		#sidebar textarea:focus {
		-webkit-box-shadow: 0 2px 5px rgba(0,0,0,0.15), inset 1px 1px 0 <?php echo $accent_color; ?>, inset -1px -1px 0 <?php echo $accent_color; ?>;
		-moz-box-shadow: 0 2px 5px rgba(0,0,0,0.15), inset 1px 1px 0 <?php echo $accent_color; ?>, inset -1px -1px 0 <?php echo $accent_color; ?>;
		box-shadow: 0 2px 5px rgba(0,0,0,0.15), inset 1px 1px 0 <?php echo $accent_color; ?>, inset -1px -1px 0 <?php echo $accent_color; ?>;
		}
		
		#folio-sidebar aside .live-btn:hover,
		.recent-posts .recent-post-wrap:hover img.attachment-recent-thumb,
		.recent-work-row .recent-button:hover,
		.recent-posts .recent-button:hover,
		#home-slider .nivo-controlNav a.nivo-control.active,
		#comments .comment-author-name,
		#comments .comment-content footer a:hover,
		#comments #respond #cancel-comment-reply-link:hover,
		aside.widget.widget-flickr .flickr_badge_image a:hover,
		.highlightedText,
		.dropcap,
		.priceFeatured .labelTitle,
		#progress-bar,
		.jspDrag.jspHover,
		.jspDrag.jspActive {
		background: <?php echo $accent_color; ?>;
		}
		
		aside.widget h3.widget-title {
		border-left: 3px solid <?php echo $accent_color; ?>;
		}
		
		.priceFeatured .labelPrice {
		border-bottom: 3px solid <?php echo $accent_color; ?>;
		}
		<?php endif; ?>
		
		
		<?php
		if( is_singular() ){
		  global $wp_query;
		  $postid = $wp_query->post->ID;
		  $singularBgImg = get_post_meta($postid, 'singularBgImg', TRUE);
		}
		
		if( ( is_singular() && $singularBgImg ) || of_get_option("bg_img") ):
		?>
		#sidebar,
		#footer-widgets,
		#page-title,
		.gridnav-label,
		#pagination {
		background: #f5f5f5;
		background: rgba(245,245,245,0.95);
		}
		
		.dark-skin #sidebar,
		.dark-skin #footer-widgets,
		.dark-skin #page-title,
		.dark-skin .gridnav-label,
		.dark-skin #pagination {
		background: #222;
		background: rgba(34,34,34,0.87);
		}
		
		.tj_nav span {
		background-color: #f5f5f5;
		filter: alpha(opacity=95);
		opacity: 0.95;
		}
		
		.dark-skin .tj_nav span {
		background-color: #222;
		filter: alpha(opacity=87);
		opacity: 0.87;
		}
		
		#filtering-links li.filter.current a,
		#filtering-links li.filter:hover a {
		background-color: #efefef;
		}
		
		.dark-skin #filtering-links li.filter.current a,
		.dark-skin #filtering-links li.filter:hover a {
		background-color: #222;
		}
		<?php endif; ?>
		
		
		<?php if( of_get_option('cus_font_stylesheet') && of_get_option('cus_font_family') ): ?>
		  h1,
		  h2,
		  h3,
		  h4,
		  h5,
		  .entry-title,
		  .entry-title a,
		  .entry-wrapper .entry-date a,
		  .labelTitle {
		  <?php echo of_get_option('cus_font_family'); ?>
		  }
		<?php endif; ?>

		
		<?php if( of_get_option('custom_css') ){
		echo of_get_option('custom_css');
		} ?>
	</style>

<?php }