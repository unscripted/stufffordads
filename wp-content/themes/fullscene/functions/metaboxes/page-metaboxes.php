<?php

function pt_add_page_metabox() {
add_meta_box( 'folio_cat_settings', __('Portfolio Category Settings', 'premitheme'), 'pt_folio_cat_metabox_inner', 'page', 'normal' , 'high' );
add_meta_box( 'content_sections_settings', __('Content Sections Settings', 'premitheme'), 'pt_content_sections_metabox_inner', 'page', 'normal' , 'high' );
add_meta_box( 'callout_mes_settings', __('Callout Message Settings', 'premitheme'), 'pt_callout_mes_metabox_inner', 'page', 'normal' , 'high' );
add_meta_box( 'slider_set_settings', __('Slider Set Settings', 'premitheme'), 'pt_slider_set_metabox_inner', 'page', 'normal' , 'high' );
add_meta_box( 'video_banner_settings', __('Video Banner Settings', 'premitheme'), 'pt_video_banner_metabox_inner', 'page', 'normal' , 'high' );
add_meta_box( 'fixed_image_settings', __('Fixed Image Banner Settings', 'premitheme'), 'pt_fixed_image_metabox_inner', 'page', 'normal' , 'high' );
add_meta_box( 'grid_nav_settings', __('Recent Work (Grid Navigation) Settings', 'premitheme'), 'pt_grid_nav_metabox_inner', 'page', 'normal' , 'high' );
add_meta_box( 'recent_work_settings', __('Recent Work (Fixed Row) Settings', 'premitheme'), 'pt_recent_work_metabox_inner', 'page', 'normal' , 'high' );
add_meta_box( 'recent_posts_settings', __('Recent Posts Settings', 'premitheme'), 'pt_recent_posts_metabox_inner', 'page', 'normal' , 'high' );
add_meta_box( 'page_bg_settings', __('Custom Fullscreen Background', 'premitheme'), 'pt_page_bg_metabox_inner', 'page', 'normal' , 'high' );
}
add_action( 'add_meta_boxes', 'pt_add_page_metabox' );


add_action( 'save_post', 'pt_folio_cat_metabox_save' );
add_action( 'save_post', 'pt_content_sections_metabox_save' );
add_action( 'save_post', 'pt_callout_mes_metabox_save' );
add_action( 'save_post', 'pt_slider_set_metabox_save' );
add_action( 'save_post', 'pt_video_banner_metabox_save' );
add_action( 'save_post', 'pt_fixed_image_metabox_save' );
add_action( 'save_post', 'pt_grid_nav_metabox_save' );
add_action( 'save_post', 'pt_recent_work_metabox_save' );
add_action( 'save_post', 'pt_recent_posts_metabox_save' );
add_action( 'save_post', 'pt_page_bg_metabox_save' );




//========================================//
// RENDER METABOXS
//========================================//
//-----------------------------//
// PORTFOLIO CATEGORY METABOX
//-----------------------------//
function pt_folio_cat_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$folioCat = isset( $post_vals['folioCat'] ) ? esc_attr( $post_vals['folioCat'][0] ) : '0';
	wp_nonce_field( 'folio_cat_meta_box_nonce', 'folio-cat-meta-box-nonce' );
	
	$folio_cats = get_categories('taxonomy=portfolio_cats');
	
	?>
	
	<div class="section first">
		<label for="folioCat"><strong><?php _e( 'Portfolio Category', 'premitheme' ); ?></strong></label>
		<select id="folioCat" name="folioCat">
		
			<option value="0">Please select &hellip;</option>
		
		<?php foreach ( $folio_cats as $folio_cat ): ?>
			<option value="<?php echo $folio_cat->cat_ID; ?>" <?php selected( $folio_cat->cat_ID, $folioCat ); ?>><?php echo $folio_cat->cat_name; ?></option>
		<?php endforeach; ?>
		
		</select>
		<p><?php _e( 'Select portfolio category to display its items', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}



//-----------------------------//
// CONTENT SECTIONS METABOX
//-----------------------------//
function pt_content_sections_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$firstSection = isset( $post_vals['firstSection'] ) ? esc_attr( $post_vals['firstSection'][0] ) : '0';
	$secondSection = isset( $post_vals['secondSection'] ) ? esc_attr( $post_vals['secondSection'][0] ) : '0';
	$thirdSection = isset( $post_vals['thirdSection'] ) ? esc_attr( $post_vals['thirdSection'][0] ) : '0';
	$fourthSection = isset( $post_vals['fourthSection'] ) ? esc_attr( $post_vals['fourthSection'][0] ) : '0';
	$fifthSection = isset( $post_vals['fifthSection'] ) ? esc_attr( $post_vals['fifthSection'][0] ) : '0';
	$sixthSection = isset( $post_vals['sixthSection'] ) ? esc_attr( $post_vals['sixthSection'][0] ) : '0';
	wp_nonce_field( 'content_sections_meta_box_nonce', 'content-sections-meta-box-nonce' );
	
	?>
	
	<div class="section first">
		<h4>Set any number of sections (from one to six) to use any type of content, then customize the content type below.</h4>
		
		<label for="firstSection"><strong><?php _e( 'First Section', 'premitheme' ); ?></strong></label>
		<select id="firstSection" name="firstSection">
		
			<option value="0" <?php selected( '0', $firstSection ); ?>>Please select &hellip;</option>
			<option value="callout-message" <?php selected( 'callout-message', $firstSection ); ?>>Callout Message</option>
			<option value="nivo-slider" <?php selected( 'nivo-slider', $firstSection ); ?>>Nivo Slider</option>
			<option value="fixed-image" <?php selected( 'fixed-image', $firstSection ); ?>>Fixed Image Banner</option>
			<option value="video-banner" <?php selected( 'video-banner', $firstSection ); ?>>Video Banner</option>
			<option value="recent-work-row" <?php selected( 'recent-work-row', $firstSection ); ?>>Recent Work</option>
			<option value="recent-work-desc" <?php selected( 'recent-work-desc', $firstSection ); ?>>Recent Work with Description</option>
			<option value="grid-showcase" <?php selected( 'grid-showcase', $firstSection ); ?>>Recent Work Grid</option>
			<option value="recent-posts-row" <?php selected( 'recent-posts-row', $firstSection ); ?>>Recent Posts</option>
			<option value="recent-posts-desc" <?php selected( 'recent-posts-desc', $firstSection ); ?>>Recent Posts with Description</option>
			<option value="custom" <?php selected( 'custom', $firstSection ); ?>>Custom Content</option>
		
		</select>
		<p><?php _e( 'Select content type', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="secondSection"><strong><?php _e( 'Second Section', 'premitheme' ); ?></strong></label>
		<select id="secondSection" name="secondSection">
		
			<option value="0" <?php selected( '0', $secondSection ); ?>>Please select &hellip;</option>
			<option value="callout-message" <?php selected( 'callout-message', $secondSection ); ?>>Callout Message</option>
			<option value="nivo-slider" <?php selected( 'nivo-slider', $secondSection ); ?>>Nivo Slider</option>
			<option value="fixed-image" <?php selected( 'fixed-image', $secondSection ); ?>>Fixed Image Banner</option>
			<option value="video-banner" <?php selected( 'video-banner', $secondSection ); ?>>Video Banner</option>
			<option value="recent-work-row" <?php selected( 'recent-work-row', $secondSection ); ?>>Recent Work</option>
			<option value="recent-work-desc" <?php selected( 'recent-work-desc', $secondSection ); ?>>Recent Work with Description</option>
			<option value="grid-showcase" <?php selected( 'grid-showcase', $secondSection ); ?>>Recent Work Grid</option>
			<option value="recent-posts-row" <?php selected( 'recent-posts-row', $secondSection ); ?>>Recent Posts</option>
			<option value="recent-posts-desc" <?php selected( 'recent-posts-desc', $secondSection ); ?>>Recent Posts with Description</option>
			<option value="custom" <?php selected( 'custom', $secondSection ); ?>>Custom Content</option>
		
		</select>
		<p><?php _e( 'Select content type', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="thirdSection"><strong><?php _e( 'Third Section', 'premitheme' ); ?></strong></label>
		<select id="thirdSection" name="thirdSection">
		
			<option value="0" <?php selected( '0', $thirdSection ); ?>>Please select &hellip;</option>
			<option value="callout-message" <?php selected( 'callout-message', $thirdSection ); ?>>Callout Message</option>
			<option value="nivo-slider" <?php selected( 'nivo-slider', $thirdSection ); ?>>Nivo Slider</option>
			<option value="fixed-image" <?php selected( 'fixed-image', $thirdSection ); ?>>Fixed Image Banner</option>
			<option value="video-banner" <?php selected( 'video-banner', $thirdSection ); ?>>Video Banner</option>
			<option value="recent-work-row" <?php selected( 'recent-work-row', $thirdSection ); ?>>Recent Work</option>
			<option value="recent-work-desc" <?php selected( 'recent-work-desc', $thirdSection ); ?>>Recent Work with Description</option>
			<option value="grid-showcase" <?php selected( 'grid-showcase', $thirdSection ); ?>>Recent Work Grid</option>
			<option value="recent-posts-row" <?php selected( 'recent-posts-row', $thirdSection ); ?>>Recent Posts</option>
			<option value="recent-posts-desc" <?php selected( 'recent-posts-desc', $thirdSection ); ?>>Recent Posts with Description</option>
			<option value="custom" <?php selected( 'custom', $thirdSection ); ?>>Custom Content</option>
		
		</select>
		<p><?php _e( 'Select content type', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="fourthSection"><strong><?php _e( 'Fourth Section', 'premitheme' ); ?></strong></label>
		<select id="fourthSection" name="fourthSection">
		
			<option value="0" <?php selected( '0', $fourthSection ); ?>>Please select &hellip;</option>
			<option value="callout-message" <?php selected( 'callout-message', $fourthSection ); ?>>Callout Message</option>
			<option value="nivo-slider" <?php selected( 'nivo-slider', $fourthSection ); ?>>Nivo Slider</option>
			<option value="fixed-image" <?php selected( 'fixed-image', $fourthSection ); ?>>Fixed Image Banner</option>
			<option value="video-banner" <?php selected( 'video-banner', $fourthSection ); ?>>Video Banner</option>
			<option value="recent-work-row" <?php selected( 'recent-work-row', $fourthSection ); ?>>Recent Work</option>
			<option value="recent-work-desc" <?php selected( 'recent-work-desc', $fourthSection ); ?>>Recent Work with Description</option>
			<option value="grid-showcase" <?php selected( 'grid-showcase', $fourthSection ); ?>>Recent Work Grid</option>
			<option value="recent-posts-row" <?php selected( 'recent-posts-row', $fourthSection ); ?>>Recent Posts</option>
			<option value="recent-posts-desc" <?php selected( 'recent-posts-desc', $fourthSection ); ?>>Recent Posts with Description</option>
			<option value="custom" <?php selected( 'custom', $fourthSection ); ?>>Custom Content</option>
		
		</select>
		<p><?php _e( 'Select content type', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="fifthSection"><strong><?php _e( 'Fifth Section', 'premitheme' ); ?></strong></label>
		<select id="fifthSection" name="fifthSection">
		
			<option value="0" <?php selected( '0', $fifthSection ); ?>>Please select &hellip;</option>
			<option value="callout-message" <?php selected( 'callout-message', $fifthSection ); ?>>Callout Message</option>
			<option value="nivo-slider" <?php selected( 'nivo-slider', $fifthSection ); ?>>Nivo Slider</option>
			<option value="fixed-image" <?php selected( 'fixed-image', $fifthSection ); ?>>Fixed Image Banner</option>
			<option value="video-banner" <?php selected( 'video-banner', $fifthSection ); ?>>Video Banner</option>
			<option value="recent-work-row" <?php selected( 'recent-work-row', $fifthSection ); ?>>Recent Work</option>
			<option value="recent-work-desc" <?php selected( 'recent-work-desc', $fifthSection ); ?>>Recent Work with Description</option>
			<option value="grid-showcase" <?php selected( 'grid-showcase', $fifthSection ); ?>>Recent Work Grid</option>
			<option value="recent-posts-row" <?php selected( 'recent-posts-row', $fifthSection ); ?>>Recent Posts</option>
			<option value="recent-posts-desc" <?php selected( 'recent-posts-desc', $fifthSection ); ?>>Recent Posts with Description</option>
			<option value="custom" <?php selected( 'custom', $fifthSection ); ?>>Custom Content</option>
		
		</select>
		<p><?php _e( 'Select content type', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="sixthSection"><strong><?php _e( 'Sixth Section', 'premitheme' ); ?></strong></label>
		<select id="sixthSection" name="sixthSection">
		
			<option value="0" <?php selected( '0', $sixthSection ); ?>>Please select &hellip;</option>
			<option value="callout-message" <?php selected( 'callout-message', $sixthSection ); ?>>Callout Message</option>
			<option value="nivo-slider" <?php selected( 'nivo-slider', $sixthSection ); ?>>Nivo Slider</option>
			<option value="fixed-image" <?php selected( 'fixed-image', $sixthSection ); ?>>Fixed Image Banner</option>
			<option value="video-banner" <?php selected( 'video-banner', $sixthSection ); ?>>Video Banner</option>
			<option value="recent-work-row" <?php selected( 'recent-work-row', $sixthSection ); ?>>Recent Work</option>
			<option value="recent-work-desc" <?php selected( 'recent-work-desc', $sixthSection ); ?>>Recent Work with Description</option>
			<option value="grid-showcase" <?php selected( 'grid-showcase', $sixthSection ); ?>>Recent Work Grid</option>
			<option value="recent-posts-row" <?php selected( 'recent-posts-row', $sixthSection ); ?>>Recent Posts</option>
			<option value="recent-posts-desc" <?php selected( 'recent-posts-desc', $sixthSection ); ?>>Recent Posts with Description</option>
			<option value="custom" <?php selected( 'custom', $sixthSection ); ?>>Custom Content</option>
		
		</select>
		<p><?php _e( 'Select content type', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}



//-----------------------------//
// CALLOUT MESSAGE METABOX
//-----------------------------//
function pt_callout_mes_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$calloutMes = isset( $post_vals['calloutMes'] ) ? esc_attr( $post_vals['calloutMes'][0] ) : '';
	wp_nonce_field( 'callout_mes_meta_box_nonce', 'callout-mes-meta-box-nonce' );
	
	?>
	
	<div class="section first">
		<label for="calloutMes"><strong><?php _e( 'Callout Message', 'premitheme' ); ?></strong></label>
		<textarea id="calloutMes" name="calloutMes" cols="50" rows="4"><?php echo $calloutMes; ?></textarea>
	</div>
	
	<?php 
}



//-----------------------------//
// SLIDER SET METABOX
//-----------------------------//
function pt_slider_set_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$sliderSet = isset( $post_vals['sliderSet'] ) ? esc_attr( $post_vals['sliderSet'][0] ) : 'all';
	$sliderHeight = isset( $post_vals['sliderHeight'] ) ? esc_attr( $post_vals['sliderHeight'][0] ) : '300';
	wp_nonce_field( 'slider_set_meta_box_nonce', 'slider-set-meta-box-nonce' );
	
	$slider_sets = get_categories('taxonomy=slider_sets');
	
	?>
	
	<div class="section first">
		<label for="sliderSet"><strong><?php _e( 'Slider Set', 'premitheme' ); ?></strong></label>
		<select class="medium" id="sliderSet" name="sliderSet">
		
			<option value="all" <?php selected( 'all', $sliderSet ); ?>>All Slides</option>
		
		<?php foreach ( $slider_sets as $slider_set ): ?>
			<option value="<?php echo $slider_set->cat_ID; ?>" <?php selected( $slider_set->cat_ID, $sliderSet ); ?>><?php echo $slider_set->cat_name; ?></option>
		<?php endforeach; ?>
		
		</select>
		<p><?php _e( 'Select slider set to display its slides', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="sliderHeight"><strong><?php _e( 'Image Height', 'premitheme' ); ?></strong></label>
		<input class="small" type="text" id="sliderHeight" name="sliderHeight" value="<?php echo $sliderHeight; ?>">px
		<p><?php _e( 'Enter the desired image\'s height', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}



//-----------------------------//
// VIDEO BANNER METABOX
//-----------------------------//
function pt_video_banner_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$videoBannerEmbed = isset( $post_vals['videoBannerEmbed'] ) ? esc_attr( $post_vals['videoBannerEmbed'][0] ) : '';
	$videoBannerURL = isset( $post_vals['videoBannerURL'] ) ? esc_attr( $post_vals['videoBannerURL'][0] ) : '';
	wp_nonce_field( 'video_banner_meta_box_nonce', 'video-banner-meta-box-nonce' );
	
	?>
	
	<div class="section first">
		<label for="videoBannerEmbed"><strong><?php _e( 'Remotely Hosted Video Embed Code (Use instead of the next field below for more controlled video embedding).', 'premitheme' ); ?></strong></label>
		<textarea id="videoBannerEmbed" name="videoBannerEmbed" cols="50" rows="4"><?php echo $videoBannerEmbed; ?></textarea>
		<p><?php _e( 'Enter the embed code of remotely-hosted video. Overrides the next field.', 'premitheme');?></p>
	</div>
	
	<div class="section">
		<label for="videoBannerURL"><strong><?php _e( 'Remotely Hosted Video URL (For easy embed, if not using embed code above).', 'premitheme' ); ?></strong></label>
		<input type="text" id="videoBannerURL" name="videoBannerURL" value="<?php echo $videoBannerURL; ?>">
		<p><?php _e( 'Enter just the URL of the video page (auto embed). Only remotely-hosted videos supported (i.e. youtube, vimeo &hellip; etc).', 'premitheme');?><a href="http://codex.wordpress.org/Embeds" target="_blank"><?php _e( 'List of supported video hosts', 'premitheme'); ?></a>. <?php _e('Always use the full absolute URL including "http://".', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}



//-----------------------------//
// FIXED IMAGE METABOX
//-----------------------------//
function pt_fixed_image_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$fixedImgURL = isset( $post_vals['fixedImgURL'] ) ? esc_attr( $post_vals['fixedImgURL'][0] ) : '';
	$fixedImgHeight = isset( $post_vals['fixedImgHeight'] ) ? esc_attr( $post_vals['fixedImgHeight'][0] ) : '';
	$fixedImgLink = isset( $post_vals['fixedImgLink'] ) ? esc_attr( $post_vals['fixedImgLink'][0] ) : '';
	wp_nonce_field( 'fixed_image_meta_box_nonce', 'fixed-image-meta-box-nonce' );
	
	?>
	
	<div class="section first">
		<label for="fixedImgURL"><strong><?php _e( 'Image URL', 'premitheme' ); ?></strong></label>
		<input type="text" id="fixedImgURL" name="fixedImgURL" value="<?php echo $fixedImgURL; ?>">
		<input type="button" name="upload_image_button" class="upload_img button" value="<?php _e( 'Upload', 'premitheme' ); ?>" />
		<p><?php _e( 'Image shouldn\'t be less than <strong>978px width</strong> with no height limitations. Always use the full absolute URL including "http://"', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="fixedImgHeight"><strong><?php _e( 'Image Height', 'premitheme' ); ?></strong></label>
		<input class="small" type="text" id="fixedImgHeight" name="fixedImgHeight" value="<?php echo $fixedImgHeight; ?>">px
		<p><?php _e( 'Enter the desired image\'s height', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="fixedImgLink"><strong><?php _e( 'Image Link (optional)', 'premitheme' ); ?></strong></label>
		<input type="text" id="fixedImgLink" name="fixedImgLink" value="<?php echo $fixedImgLink; ?>">
		<p><?php _e( 'Enter a link URL if you want the image to be hyperlinked to somewhere. Always use the full absolute URL including "http://"', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}



//-----------------------------//
// GRID NAV METABOX
//-----------------------------//
function pt_grid_nav_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$gridNavLabel = isset( $post_vals['gridNavLabel'] ) ? esc_attr( $post_vals['gridNavLabel'][0] ) : __('Recent Work' ,'premitheme');
	$gridNavCat = isset( $post_vals['gridNavCat'] ) ? esc_attr( $post_vals['gridNavCat'][0] ) : 'all';
	$gridNavRows = isset( $post_vals['gridNavRows'] ) ? esc_attr( $post_vals['gridNavRows'][0] ) : '3';
	$gridNavAll = isset( $post_vals['gridNavAll'] ) ? esc_attr( $post_vals['gridNavAll'][0] ) : 'unlimited';
	wp_nonce_field( 'grid_nav_meta_box_nonce', 'grid-nav-meta-box-nonce' );
	
	$folio_cats = get_categories('taxonomy=portfolio_cats');
	
	?>
	
	<div class="section first">
		<label for="gridNavLabel"><strong><?php _e( 'Recent Work Label', 'premitheme' ); ?></strong></label>
		<input type="text" id="gridNavLabel" name="gridNavLabel" value="<?php echo $gridNavLabel; ?>">
	</div>
	
	<div class="section">
		<label for="gridNavCat"><strong><?php _e( 'Portfolio Category', 'premitheme' ); ?></strong></label>
		<select class="medium" id="gridNavCat" name="gridNavCat">
		
			<option value="all" <?php selected( 'all', $gridNavCat ); ?>>All</option>
		
		<?php foreach ( $folio_cats as $folio_cat ): ?>
			<option value="<?php echo $folio_cat->cat_ID; ?>" <?php selected( $folio_cat->cat_ID, $gridNavCat ); ?>><?php echo $folio_cat->cat_name; ?></option>
		<?php endforeach; ?>
		
		</select>
		<p><?php _e( 'Select portfolio category to display its items', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="gridNavRows"><strong><?php _e( 'Grid Rows', 'premitheme' ); ?></strong></label>
		<select class="medium" id="gridNavRows" name="gridNavRows">
		
			<option value="3" <?php selected( '3', $gridNavRows ); ?>>3 Rows</option>
			<option value="2" <?php selected( '2', $gridNavRows ); ?>>2 Rows</option>
			<option value="1" <?php selected( '1', $gridNavRows ); ?>>1 Row</option>
		
		</select>
	</div>
	
	<div class="section">
		<label for="gridNavAll"><strong><?php _e( 'Grid Folds', 'premitheme' ); ?></strong></label>
		<select class="medium" id="gridNavAll" name="gridNavAll">
		
			<option value="unlimited" <?php selected( 'unlimited', $gridNavAll ); ?>>Unlimited (according to portfolio items)</option>
			<option value="2-folds" <?php selected( '2-folds', $gridNavAll ); ?>>2 Folds only</option>
		
		</select>
		<p><?php _e( 'Select portfolio category to display its items', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}



//-----------------------------//
// RECENT WORK METABOX
//-----------------------------//
function pt_recent_work_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$recentWorkLabel = isset( $post_vals['recentWorkLabel'] ) ? esc_attr( $post_vals['recentWorkLabel'][0] ) : __('Recent Work' ,'premitheme');
	$recentWorkDesc = isset( $post_vals['recentWorkDesc'] ) ? esc_attr( $post_vals['recentWorkDesc'][0] ) : __('Put some descriptive text here ...' ,'premitheme');
	$recentWorkLink = isset( $post_vals['recentWorkLink'] ) ? esc_attr( $post_vals['recentWorkLink'][0] ) : 'http://';
	$recentWorkCat = isset( $post_vals['recentWorkCat'] ) ? esc_attr( $post_vals['recentWorkCat'][0] ) : 'all';
	wp_nonce_field( 'recent_work_meta_box_nonce', 'recent-work-meta-box-nonce' );
	
	$folio_cats = get_categories('taxonomy=portfolio_cats');
	
	?>
	
	<div class="section first">
		<label for="recentWorkLabel"><strong><?php _e( 'Recent Work Label (For "Recent work with description" only)', 'premitheme' ); ?></strong></label>
		<input type="text" id="recentWorkLabel" name="recentWorkLabel" value="<?php echo $recentWorkLabel; ?>">
	</div>
	
	<div class="section">
		<label for="recentWorkDesc"><strong><?php _e( 'Recent Work Description (For "Recent work with description" only)', 'premitheme' ); ?></strong></label>
		<textarea id="recentWorkDesc" name="recentWorkDesc" cols="50" rows="4"><?php echo $recentWorkDesc; ?></textarea>
	</div>
	
	<div class="section">
		<label for="recentWorkLink"><strong><?php _e( '"View all" button URL (For "Recent work with description" only)', 'premitheme' ); ?></strong></label>
		<input type="text" id="recentWorkLink" name="recentWorkLink" value="<?php echo $recentWorkLink; ?>">
	</div>
	
	<div class="section">
		<label for="recentWorkCat"><strong><?php _e( 'Portfolio Category', 'premitheme' ); ?></strong></label>
		<select class="medium" id="recentWorkCat" name="recentWorkCat">
		
			<option value="all" <?php selected( 'all', $recentWorkCat ); ?>>All</option>
		
		<?php foreach ( $folio_cats as $folio_cat ): ?>
			<option value="<?php echo $folio_cat->cat_ID; ?>" <?php selected( $folio_cat->cat_ID, $recentWorkCat ); ?>><?php echo $folio_cat->cat_name; ?></option>
		<?php endforeach; ?>
		
		</select>
		<p><?php _e( 'Select portfolio category to display its items', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}



//-----------------------------//
// RECENT POSTS METABOX
//-----------------------------//
function pt_recent_posts_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$recentPostsLabel = isset( $post_vals['recentPostsLabel'] ) ? esc_attr( $post_vals['recentPostsLabel'][0] ) : __('Recent Posts' ,'premitheme');
	$recentPostsDesc = isset( $post_vals['recentPostsDesc'] ) ? esc_attr( $post_vals['recentPostsDesc'][0] ) : __('Put some descriptive text here ...' ,'premitheme');
	$recentPostsLink = isset( $post_vals['recentPostsLink'] ) ? esc_attr( $post_vals['recentPostsLink'][0] ) : 'http://';
	$recentPostsCat = isset( $post_vals['recentPostsCat'] ) ? esc_attr( $post_vals['recentPostsCat'][0] ) : 'all';
	wp_nonce_field( 'recent_posts_meta_box_nonce', 'recent-posts-meta-box-nonce' );
	
	$blog_cats = get_categories();
	
	?>
	
	<div class="section first">
		<label for="recentPostsLabel"><strong><?php _e( 'Recent Posts Label (For "Recent posts with description" only)', 'premitheme' ); ?></strong></label>
		<input type="text" id="recentPostsLabel" name="recentPostsLabel" value="<?php echo $recentPostsLabel; ?>">
	</div>
	
	<div class="section">
		<label for="recentPostsDesc"><strong><?php _e( 'Recent Posts Description (For "Recent posts with description" only)', 'premitheme' ); ?></strong></label>
		<textarea id="recentPostsDesc" name="recentPostsDesc" cols="50" rows="4"><?php echo $recentPostsDesc; ?></textarea>
	</div>
	
	<div class="section">
		<label for="recentPostsLink"><strong><?php _e( '"View all" button URL (For "Recent posts with description" only)', 'premitheme' ); ?></strong></label>
		<input type="text" id="recentPostsLink" name="recentPostsLink" value="<?php echo $recentPostsLink; ?>">
	</div>
	
	<div class="section">
		<label for="recentPostsCat"><strong><?php _e( 'Blog Category', 'premitheme' ); ?></strong></label>
		<select class="medium" id="recentPostsCat" name="recentPostsCat">
		
			<option value="all" <?php selected( 'all', $recentPostsCat ); ?>>All</option>
		
		<?php foreach ( $blog_cats as $blog_cat ): ?>
			<option value="<?php echo $blog_cat->cat_ID; ?>" <?php selected( $blog_cat->cat_ID, $recentPostsCat ); ?>><?php echo $blog_cat->cat_name; ?></option>
		<?php endforeach; ?>
		
		</select>
		<p><?php _e( 'Select portfolio category to display its items', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}



//-----------------------------//
// BG IMAGE METABOX
//-----------------------------//
function pt_page_bg_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$singularBgImg = isset( $post_vals['singularBgImg'] ) ? esc_attr( $post_vals['singularBgImg'][0] ) : "";
	wp_nonce_field( 'page_bg_meta_box_nonce', 'page-bg-meta-box-nonce' );
	
	?>
	
	<div class="section first">
		<label for="singularBgImg"><strong><?php _e( 'Custom Fullscreen Background Image ', 'premitheme' ); ?></strong></label>
		<input type="text" id="singularBgImg" name="singularBgImg" value="<?php echo $singularBgImg; ?>">
		<input type="button" name="upload_image_button" class="upload_img button" value="<?php _e( 'Upload', 'premitheme' ); ?>" />
		<p><?php _e( 'Specify an image to be fullscreen BG for this page', 'premitheme' ); ?></p>
	</div>
		
	<?php 
}



//========================================//
// SAVE METABOXS
//========================================//
//-----------------------------//
// PORTFOLIO CATEGORY SAVE
//-----------------------------//
function pt_folio_cat_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['folio-cat-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['folio-cat-meta-box-nonce'], 'folio_cat_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['folioCat'] ) )  
        update_post_meta( $post_id, 'folioCat', esc_attr( $_POST['folioCat'] ) );
}



//-----------------------------//
// CONTENT SECTIONS SAVE
//-----------------------------//
function pt_content_sections_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['content-sections-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['content-sections-meta-box-nonce'], 'content_sections_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['firstSection'] ) )  
        update_post_meta( $post_id, 'firstSection', esc_attr( $_POST['firstSection'] ) );
    if( isset( $_POST['secondSection'] ) )  
        update_post_meta( $post_id, 'secondSection', esc_attr( $_POST['secondSection'] ) );
    if( isset( $_POST['thirdSection'] ) )  
        update_post_meta( $post_id, 'thirdSection', esc_attr( $_POST['thirdSection'] ) );
    if( isset( $_POST['fourthSection'] ) )  
        update_post_meta( $post_id, 'fourthSection', esc_attr( $_POST['fourthSection'] ) );
    if( isset( $_POST['fifthSection'] ) )  
        update_post_meta( $post_id, 'fifthSection', esc_attr( $_POST['fifthSection'] ) );
    if( isset( $_POST['sixthSection'] ) )  
        update_post_meta( $post_id, 'sixthSection', esc_attr( $_POST['sixthSection'] ) );
}



//-----------------------------//
// CALLOUT MESSAGE SAVE
//-----------------------------//
function pt_callout_mes_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['callout-mes-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['callout-mes-meta-box-nonce'], 'callout_mes_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['calloutMes'] ) )  
        update_post_meta( $post_id, 'calloutMes', esc_attr( $_POST['calloutMes'] ) );
}



//-----------------------------//
// SLIDER SET SAVE
//-----------------------------//
function pt_slider_set_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['slider-set-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['slider-set-meta-box-nonce'], 'slider_set_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['sliderSet'] ) )  
        update_post_meta( $post_id, 'sliderSet', esc_attr( $_POST['sliderSet'] ) );
    if( isset( $_POST['sliderHeight'] ) )  
        update_post_meta( $post_id, 'sliderHeight', esc_attr( $_POST['sliderHeight'] ) );
}



//-----------------------------//
// VIDEO BANNER SAVE
//-----------------------------//
function pt_video_banner_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['video-banner-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['video-banner-meta-box-nonce'], 'video_banner_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['videoBannerEmbed'] ) )  
        update_post_meta( $post_id, 'videoBannerEmbed', esc_attr( $_POST['videoBannerEmbed'] ) );
    if( isset( $_POST['videoBannerURL'] ) )  
        update_post_meta( $post_id, 'videoBannerURL', esc_attr( $_POST['videoBannerURL'] ) );
}



//-----------------------------//
// FIXED IMAGE SAVE
//-----------------------------//
function pt_fixed_image_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['fixed-image-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['fixed-image-meta-box-nonce'], 'fixed_image_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['fixedImgURL'] ) )  
        update_post_meta( $post_id, 'fixedImgURL', esc_attr( $_POST['fixedImgURL'] ) );
    if( isset( $_POST['fixedImgHeight'] ) )  
        update_post_meta( $post_id, 'fixedImgHeight', esc_attr( $_POST['fixedImgHeight'] ) );
    if( isset( $_POST['fixedImgLink'] ) )  
        update_post_meta( $post_id, 'fixedImgLink', esc_attr( $_POST['fixedImgLink'] ) );
}



//-----------------------------//
// GRID NAV SAVE
//-----------------------------//
function pt_grid_nav_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['grid-nav-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['grid-nav-meta-box-nonce'], 'grid_nav_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['gridNavLabel'] ) )  
        update_post_meta( $post_id, 'gridNavLabel', esc_attr( $_POST['gridNavLabel'] ) );
    if( isset( $_POST['gridNavCat'] ) )  
        update_post_meta( $post_id, 'gridNavCat', esc_attr( $_POST['gridNavCat'] ) );
    if( isset( $_POST['gridNavRows'] ) )  
        update_post_meta( $post_id, 'gridNavRows', esc_attr( $_POST['gridNavRows'] ) );
    if( isset( $_POST['gridNavAll'] ) )  
        update_post_meta( $post_id, 'gridNavAll', esc_attr( $_POST['gridNavAll'] ) );
}



//-----------------------------//
// RECENT WORK SAVE
//-----------------------------//
function pt_recent_work_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['recent-work-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['recent-work-meta-box-nonce'], 'recent_work_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['recentWorkLabel'] ) )  
        update_post_meta( $post_id, 'recentWorkLabel', esc_attr( $_POST['recentWorkLabel'] ) );
    if( isset( $_POST['recentWorkDesc'] ) )  
        update_post_meta( $post_id, 'recentWorkDesc', esc_attr( $_POST['recentWorkDesc'] ) );
    if( isset( $_POST['recentWorkLink'] ) )  
        update_post_meta( $post_id, 'recentWorkLink', esc_attr( $_POST['recentWorkLink'] ) );
    if( isset( $_POST['recentWorkCat'] ) )  
        update_post_meta( $post_id, 'recentWorkCat', esc_attr( $_POST['recentWorkCat'] ) );
}



//-----------------------------//
// RECENT POSTS SAVE
//-----------------------------//
function pt_recent_posts_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['recent-posts-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['recent-posts-meta-box-nonce'], 'recent_posts_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['recentPostsLabel'] ) )  
        update_post_meta( $post_id, 'recentPostsLabel', esc_attr( $_POST['recentPostsLabel'] ) );
    if( isset( $_POST['recentPostsDesc'] ) )  
        update_post_meta( $post_id, 'recentPostsDesc', esc_attr( $_POST['recentPostsDesc'] ) );
    if( isset( $_POST['recentPostsLink'] ) )  
        update_post_meta( $post_id, 'recentPostsLink', esc_attr( $_POST['recentPostsLink'] ) );
    if( isset( $_POST['recentPostsCat'] ) )  
        update_post_meta( $post_id, 'recentPostsCat', esc_attr( $_POST['recentPostsCat'] ) );
}



//-----------------------------//
// BG IMAGE SAVE
//-----------------------------//
function pt_page_bg_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['page-bg-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['page-bg-meta-box-nonce'], 'page_bg_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['singularBgImg'] ) )  
        update_post_meta( $post_id, 'singularBgImg', esc_attr( $_POST['singularBgImg'] ) );
}

