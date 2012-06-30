<?php

function pt_add_post_metabox() {
add_meta_box( 'linkf_settings', __('"Link" Format Settings', 'premitheme'), 'pt_linkf_metabox_inner', 'post', 'normal' , 'high' );
add_meta_box( 'videof_settings', __('"Video" Format Settings', 'premitheme'), 'pt_videof_metabox_inner', 'post', 'normal' , 'high' );
add_meta_box( 'audiof_settings', __('"Audio" Format Settings', 'premitheme'), 'pt_audiof_metabox_inner', 'post', 'normal' , 'high' );
add_meta_box( 'quotef_settings', __('"Quote" Format Settings', 'premitheme'), 'pt_quotef_metabox_inner', 'post', 'normal' , 'high' );
add_meta_box( 'galleryf_settings', __('"Gallery" Format Settings', 'premitheme'), 'pt_galleryf_metabox_inner', 'post', 'normal' , 'high' );
add_meta_box( 'post_bg_settings', __('Custom Fullscreen Background', 'premitheme'), 'pt_post_bg_metabox_inner', 'post', 'normal' , 'high' );
}
add_action( 'add_meta_boxes', 'pt_add_post_metabox' );


add_action( 'save_post', 'pt_linkf_metabox_save' );
add_action( 'save_post', 'pt_videof_metabox_save' );
add_action( 'save_post', 'pt_audiof_metabox_save' );
add_action( 'save_post', 'pt_quotef_metabox_save' );
add_action( 'save_post', 'pt_galleryf_metabox_save' );
add_action( 'save_post', 'pt_post_bg_metabox_save' );



//-----------------------------//
// DYNAMIC IMAGE UPLOAD ROW
//-----------------------------//
function Print_gallery_image_fileds($cnt, $gallImgUrl = null) {
if ($gallImgUrl === null){
    $a = '';
}else{
    $a = $gallImgUrl;
}
return 
'<div class="dynamicField">
	<input type="text" name="gallImg['.$cnt.']" value="'.$a.'">
	<input type="button" name="upload_image_button" class="upload_img button" value="'. __('Upload', 'premitheme') .'" />
	<input type="button" name="remove" class="remove button" value="&times;" />
</div>';}


//========================================//
// RENDER METABOXS
//========================================//
//-----------------------------//
// LINK POST FORMAT
//-----------------------------//
function pt_linkf_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$linkURL = isset( $post_vals['linkURL'] ) ? esc_attr( $post_vals['linkURL'][0] ) : '';
	wp_nonce_field( 'link_meta_box_nonce', 'link-meta-box-nonce' ); 
	?>
	
	<div class="section first">
		<label for="linkURL"><strong><?php _e( 'Link URL', 'premitheme' ); ?></strong></label>
		<input type="text" id="linkURL" name="linkURL" value="<?php echo $linkURL; ?>">
		<p><?php _e( 'Insert the full absolute URL including "http://"', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}


//-----------------------------//
// VIDEO POST FORMAT
//-----------------------------//
function pt_videof_metabox_inner( $post ) {
	global $post;
	$post_vals = get_post_custom( $post->ID );
	$videoEmbed = isset( $post_vals['videoEmbed'] ) ? esc_attr( $post_vals['videoEmbed'][0] ) : '';
	$videoURL = isset( $post_vals['videoURL'] ) ? esc_attr( $post_vals['videoURL'][0] ) : '';
	$m4vPath = isset( $post_vals['m4vPath'] ) ? esc_attr( $post_vals['m4vPath'][0] ) : '';
	$ogvPath = isset( $post_vals['ogvPath'] ) ? esc_attr( $post_vals['ogvPath'][0] ) : '';
	$videoPoster = isset( $post_vals['videoPoster'] ) ? esc_attr( $post_vals['videoPoster'][0] ) : '';
	$videoHeight = isset( $post_vals['videoHeight'] ) ? esc_attr( $post_vals['videoHeight'][0] ) : '';
	wp_nonce_field( 'video_meta_box_nonce', 'video-meta-box-nonce' ); 
	?>
	
	<div class="section first">
		<label for="videoEmbed"><strong><?php _e( 'Remotely Hosted Video Embed Code (Use instead of the next field below for more controlled video embedding).', 'premitheme' ); ?></strong></label>
		<textarea id="videoEmbed" name="videoEmbed" cols="50" rows="4"><?php echo $videoEmbed; ?></textarea>
		<p><?php _e( 'Enter the embed code of remotely-hosted video. Overrides the next fields. <strong>Tip:</strong> add <code>wmode="transparent"</code> attribute to the iframe of embed code to prevent z-index issue with You Tube videos.', 'premitheme');?></p>
	</div>
	
	<div class="section">
		<label for="videoURL"><strong><?php _e( 'Remotely Hosted Video URL (For easy embed, if not using embed code above).', 'premitheme' ); ?></strong></label>
		<input type="text" id="videoURL" name="videoURL" value="<?php echo $videoURL; ?>">
		<p><?php _e( 'Only remotely-hosted videos supported (i.e. youtube, vimeo &hellip; etc).', 'premitheme');?><a href="http://codex.wordpress.org/Embeds" target="_blank"><?php _e( 'List of supported video hosts', 'premitheme'); ?></a>. <?php _e('Always use the full absolute URL including "http://". Overrides the next fields.', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="m4vPath"><strong><?php _e( 'Self-hosted M4V Video File', 'premitheme' ); ?></strong></label>
		<input type="text" id="m4vPath" name="m4vPath" value="<?php echo $m4vPath; ?>">
		<input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>" />
		<p><?php _e( 'MUST be provided. After uploading, copy/paste the file\'s URL manually.', 'premitheme' ); ?></p>
		
		<div class="sep"></div>
		
		<label for="ogvPath"><strong><?php _e( 'Self-hosted OGV/OGG Video File', 'premitheme' ); ?></strong></label>
		<input type="text" id="ogvPath" name="ogvPath" value="<?php echo $ogvPath; ?>">
		<input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>" />
		<p><?php _e( 'MUST be provided, for better browser support. After uploading, copy/paste the file\'s URL manually.', 'premitheme' ); ?></p>
		
		<div class="sep"></div>
		
		<label for="videoPoster"><strong><?php _e( 'Self-hosted Video Poster Image', 'premitheme' ); ?></strong></label>
		<input type="text" id="videoPoster" name="videoPoster" value="<?php echo $videoPoster; ?>">
		<input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>" />
		<p><?php _e( 'MUST be provided, to be shown before play.', 'premitheme' ); ?></p>
		
		<div class="sep"></div>
		
		<label for="videoHeight"><strong><?php _e( 'Self-hosted Video Height', 'premitheme' ); ?></strong></label>
		<input type="text" id="videoHeight" name="videoHeight" value="<?php echo $videoHeight; ?>" class="small"> px
		<p><?php _e( 'MUST be provided, according to 649px width. Could be decimal number.', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}



//-----------------------------//
// AUDIO POST FORMAT
//-----------------------------//
function pt_audiof_metabox_inner( $post ) {
	global $post;
	$post_vals = get_post_custom( $post->ID );
	$mp3Path = isset( $post_vals['mp3Path'] ) ? esc_attr( $post_vals['mp3Path'][0] ) : '';
	$ogaPath = isset( $post_vals['ogaPath'] ) ? esc_attr( $post_vals['ogaPath'][0] ) : '';
	wp_nonce_field( 'audio_meta_box_nonce', 'audio-meta-box-nonce' ); 
	?>
	
	<div class="section first">
		<label for="mp3Path"><strong><?php _e( 'Self-hosted MP3 Audio File', 'premitheme' ); ?></strong></label>
		<input type="text" id="mp3Path" name="mp3Path" value="<?php echo $mp3Path; ?>">
		<input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>" />
		<p><?php _e( 'Required.', 'premitheme' ); ?></p>
		
		<div class="sep"></div>
		
		<label for="ogaPath"><strong><?php _e( 'Self-hosted OGA/OGG Audio File', 'premitheme' ); ?></strong></label>
		<input type="text" id="ogaPath" name="ogaPath" value="<?php echo $ogaPath; ?>">
		<input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>" />
		<p><?php _e( 'Required, for better browser support.', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}



//-----------------------------//
// QUOTE POST FORMAT
//-----------------------------//
function pt_quotef_metabox_inner( $post ) {
	global $post;
	$post_vals = get_post_custom( $post->ID );
	$quoteText = isset( $post_vals['quoteText'] ) ? esc_attr( $post_vals['quoteText'][0] ) : '';
	wp_nonce_field( 'quote_meta_box_nonce', 'quote-meta-box-nonce' ); 
	?>
	
	<div class="section first">
		<label for="quoteText"><strong><?php _e( 'Quote Text', 'premitheme' ); ?></strong></label>
		<textarea id="quoteText" name="quoteText" cols="50" rows="4"><?php echo $quoteText; ?></textarea>
		<p><?php _e( 'Insert the quote text here', 'premitheme' ); ?></p>
	</div>
	
	<?php 
}


//-----------------------------//
// GALLERY POST FORMAT
//-----------------------------//
function pt_galleryf_metabox_inner( $post ) {
	global $post;
	$gallImages = get_post_meta($post->ID,"gallImg",true);
	$post_vals = get_post_custom( $post->ID );
	$galleryHeight = isset( $post_vals['galleryHeight'] ) ? esc_attr( $post_vals['galleryHeight'][0] ) : '';
	wp_nonce_field( 'gallery_meta_box_nonce', 'gallery-meta-box-nonce' );
	?>
	
	<div class="section first">
		<label for="galleryHeight"><strong><?php _e( 'Gallery Slider Height', 'premitheme' ); ?></strong></label>
		<input type="text" id="galleryHeight" name="galleryHeight" value="<?php echo $galleryHeight; ?>" class="small">px
		<p><?php _e( 'Gallery slider height is a <strong>required</strong>. please insert height in pixels. e.g. 300', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<div id="gallImgs">
			<label for="prevImg"><strong><?php _e('Gallery Slides', 'premitheme');?></strong></label>
			<?php
			$c = 1;
			if (count($gallImages) > 0){
				foreach((array)$gallImages as $gallImgUrl ){
					echo Print_gallery_image_fileds($c,$gallImgUrl);
					$c = $c +1;
				}
			
			}?>
		</div>
		<span id="here"></span>
		<input type="button" name="add" class="add button" value="<?php _e('+ Add Slide Image', 'premitheme');?>" />
		
		<script>
	        var $ =jQuery.noConflict();
	            $(document).ready(function() {
	            
	            if ( $('.dynamicField:first input:first').val() == '' ){
	            	$('.dynamicField:first .remove').hide();
	            }
	            
	            
	            $('.dynamicField:first').find('input:first').change(function() {
	            	if ( $('.dynamicField:first input:first').val() == '' ){
	            		$('.dynamicField:first .remove').hide();
	            	}
	            	else {
	            		$('.dynamicField:first .remove').show();
	            	}
	            });
	            
	            $('.dynamicField:first').find('.upload_img').click(function() {
	            	if ( $('.dynamicField:first input:first').val() == '' ){
	            		$('.dynamicField:first .remove').show();
	            	}
	            });
	            
	            
	            var count = <?php echo $c; ?>;
	            $(".add").click(function() {
	                count = count + 1;
	                $('#gallImgs').append('<?php echo implode('',explode("\n",Print_gallery_image_fileds('count'))); ?>'.replace(/count/g, count));
	                return false;
	            });
	            $(".remove").live('click', function() {
	                $(this).parent().remove();
	            });
	        });
	    </script>
	</div>
	
	<?php 
}



//-----------------------------//
// BG IMAGE METABOX
//-----------------------------//
function pt_post_bg_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$singularBgImg = isset( $post_vals['singularBgImg'] ) ? esc_attr( $post_vals['singularBgImg'][0] ) : "";
	wp_nonce_field( 'post_bg_meta_box_nonce', 'post-bg-meta-box-nonce' );
	
	?>
	
	<div class="section first">
		<label for="singularBgImg"><strong><?php _e( 'Custom Fullscreen Background Image ', 'premitheme' ); ?></strong></label>
		<input type="text" id="singularBgImg" name="singularBgImg" value="<?php echo $singularBgImg; ?>">
		<input type="button" name="upload_image_button" class="upload_img button" value="<?php _e( 'Upload', 'premitheme' ); ?>" />
		<p><?php _e( 'Specify an image to be fullscreen BG for this blog post', 'premitheme' ); ?></p>
	</div>
		
	<?php 
}



//========================================//
// SAVE METABOXS
//========================================//
//-----------------------------//
// LINK POST FORMAT
//-----------------------------//
function pt_linkf_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['link-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['link-meta-box-nonce'], 'link_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['linkURL'] ) )  
        update_post_meta( $post_id, 'linkURL', esc_attr( $_POST['linkURL'] ) );
}


//-----------------------------//
// VIDEO POST FORMAT
//-----------------------------//
function pt_videof_metabox_save( $post_id )  {  
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
	if( !isset( $_POST['video-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['video-meta-box-nonce'], 'video_meta_box_nonce' ) ) return; 
	if( !current_user_can( 'edit_post' ) ) return;  
	
	if( isset( $_POST['videoEmbed'] ) )  
		update_post_meta( $post_id, 'videoEmbed', esc_attr( $_POST['videoEmbed'] ) );
	if( isset( $_POST['videoURL'] ) )  
		update_post_meta( $post_id, 'videoURL', esc_attr( $_POST['videoURL'] ) );
	if( isset( $_POST['m4vPath'] ) )  
		update_post_meta( $post_id, 'm4vPath', esc_attr( $_POST['m4vPath'] ) );
	if( isset( $_POST['ogvPath'] ) )  
		update_post_meta( $post_id, 'ogvPath', esc_attr( $_POST['ogvPath'] ) );
	if( isset( $_POST['videoPoster'] ) )  
		update_post_meta( $post_id, 'videoPoster', esc_attr( $_POST['videoPoster'] ) );
	if( isset( $_POST['videoHeight'] ) )  
		update_post_meta( $post_id, 'videoHeight', esc_attr( $_POST['videoHeight'] ) );
}



//-----------------------------//
// AUDIO POST FORMAT
//-----------------------------//
function pt_audiof_metabox_save( $post_id )  {  
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
	if( !isset( $_POST['audio-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['audio-meta-box-nonce'], 'audio_meta_box_nonce' ) ) return; 
	if( !current_user_can( 'edit_post' ) ) return;  
	
	if( isset( $_POST['mp3Path'] ) )  
		update_post_meta( $post_id, 'mp3Path', esc_attr( $_POST['mp3Path'] ) );
	if( isset( $_POST['ogaPath'] ) )  
		update_post_meta( $post_id, 'ogaPath', esc_attr( $_POST['ogaPath'] ) );
}


//-----------------------------//
// QUOTE POST FORMAT
//-----------------------------//
function pt_quotef_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['quote-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['quote-meta-box-nonce'], 'quote_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['quoteText'] ) )  
        update_post_meta( $post_id, 'quoteText', esc_attr( $_POST['quoteText'] ) );
}


//-----------------------------//
// GALLERY POST FORMAT
//-----------------------------//
function pt_galleryf_metabox_save( $post_id )  {  
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
	if( !isset( $_POST['gallery-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['gallery-meta-box-nonce'], 'gallery_meta_box_nonce' ) ) return; 
	if( !current_user_can( 'edit_post' ) ) return;  
	
	if( isset( $_POST['galleryHeight'] ) )  
		update_post_meta( $post_id, 'galleryHeight', esc_attr( $_POST['galleryHeight'] ) );
	
	if (isset($_POST['gallImg'])){
        $gallImages = $_POST['gallImg'];
        update_post_meta($post_id,'gallImg',$gallImages);
    }else{
        delete_post_meta($post_id,'gallImg');
    }
}



//-----------------------------//
// BG IMAGE SAVE
//-----------------------------//
function pt_post_bg_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['post-bg-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['post-bg-meta-box-nonce'], 'post_bg_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['singularBgImg'] ) )  
        update_post_meta( $post_id, 'singularBgImg', esc_attr( $_POST['singularBgImg'] ) );
}

