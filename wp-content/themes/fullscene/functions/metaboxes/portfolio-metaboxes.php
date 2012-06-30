<?php

function pt_add_portfolio_metabox() {
add_meta_box( 'portfolio_item_settengs', __('Portfolio Item Settings', 'premitheme'), 'pt_portfolio_metabox_inner', 'portfolio', 'normal' , 'high' );
add_meta_box( 'portfolio_bg_settings', __('Custom Fullscreen Background', 'premitheme'), 'pt_portfolio_bg_metabox_inner', 'portfolio', 'normal' , 'high' );
}
add_action( 'add_meta_boxes', 'pt_add_portfolio_metabox' );

add_action( 'save_post', 'pt_portfolio_metabox_save' );
add_action( 'save_post', 'pt_portfolio_bg_metabox_save' );



//-----------------------------//
// DYNAMIC IMAGE UPLOAD ROW
//-----------------------------//
function Print_folio_image_fileds($cnt, $prevImgUrl = null) {
if ($prevImgUrl === null){
    $a = '';
}else{
    $a = $prevImgUrl;
}
return 
'<div class="dynamicField">
	<input type="text" name="prevImg['.$cnt.']" value="'.$a.'">
	<input type="button" name="upload_image_button" class="upload_img button" value="'. __('Upload', 'premitheme') .'" />
	<input type="button" name="remove" class="remove button" value="&times;" />
</div>';}

//========================================//
// RENDER METABOXS
//========================================//
//-----------------------------//
// PORTFOLIO ITEM SETTINGS
//-----------------------------//
function pt_portfolio_metabox_inner( $post ) {
	global $post, $post_vals, $folioImgWidth;
	$prevImages = get_post_meta($post->ID,"prevImg",true);
	$post_vals = get_post_custom( $post->ID );
	$folioDate = isset( $post_vals['folioDate'] ) ? esc_attr( $post_vals['folioDate'][0] ) : '';
	$clientName = isset( $post_vals['clientName'] ) ? esc_attr( $post_vals['clientName'][0] ) : '';
	$clientLabel = isset( $post_vals['clientLabel'] ) ? esc_attr( $post_vals['clientLabel'][0] ) : __('Client' ,'premitheme');
	$liveUrl = isset( $post_vals['liveUrl'] ) ? esc_attr( $post_vals['liveUrl'][0] ) : '';
	$liveLabel = isset( $post_vals['liveLabel'] ) ? esc_attr( $post_vals['liveLabel'][0] ) : __('Visit Website' ,'premitheme');
	$skillsLabel = isset( $post_vals['skillsLabel'] ) ? esc_attr( $post_vals['skillsLabel'][0] ) : __('Skills' ,'premitheme');
	$prevVidEmbed = isset( $post_vals['prevVidEmbed'] ) ? esc_attr( $post_vals['prevVidEmbed'][0] ) : '';
	$prevVidUrl = isset( $post_vals['prevVidUrl'] ) ? esc_attr( $post_vals['prevVidUrl'][0] ) : '';
	$prevHeight = isset( $post_vals['prevHeight'] ) ? esc_attr( $post_vals['prevHeight'][0] ) : '';
	
	wp_nonce_field( 'folio_meta_box_nonce', 'folio-meta-box-nonce' ); 
	?>
	
	<div class="section first">
		<label for="folioDate"><strong><?php _e( 'Completion Date', 'premitheme' ); ?></strong></label>
		<input type="text" id="folioDate" name="folioDate" value="<?php echo $folioDate; ?>" class="medium">
		<p><?php _e( 'e.g. "Sep 2011"', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<label for="clientName"><strong><?php _e( 'Client Name', 'premitheme' ); ?></strong></label>
		<input type="text" id="clientName" name="clientName" value="<?php echo $clientName; ?>">
		
		<div class="sep"></div>
		
		<label for="clientLabel"><strong><?php _e( 'Client Label', 'premitheme' ); ?></strong></label>
		<input type="text" id="clientLabel" name="clientLabel" value="<?php echo $clientLabel; ?>">
	</div>
	
	<div class="section">
		<label for="liveUrl"><strong><?php _e( 'Project URL (if applicable)', 'premitheme' ); ?></strong></label>
		<input type="text" id="liveUrl" name="liveUrl" value="<?php echo $liveUrl; ?>">
		
		<div class="sep"></div>
		
		<label for="liveLabel"><strong><?php _e( 'Project Button\'s Text', 'premitheme' ); ?></strong></label>
		<input type="text" id="liveLabel" name="liveLabel" value="<?php echo $liveLabel; ?>">
	</div>
	
	<div class="section">
		<label for="skillsLabel"><strong><?php _e( 'Skills Label', 'premitheme' ); ?></strong></label>
		<input type="text" id="skillsLabel" name="skillsLabel" value="<?php echo $skillsLabel; ?>">
	</div>
	
	<div class="section">
		<label for="prevHeight"><strong><?php _e( 'Preview Image(s) Height', 'premitheme' ); ?></strong></label>
		<input type="text" id="prevHeight" name="prevHeight" value="<?php echo $prevHeight; ?>" class="small">px
		<p><?php _e( 'You <strong>MUST</strong> set height if multiple images being used.', 'premitheme' ); ?></p>
	</div>
	
	<div class="section">
		<div id="prevImgs">
			<label for="prevImg"><strong><?php _e('Preview Image(s)', 'premitheme');?></strong></label>
			<?php
			$c = 1;
			if (count($prevImages) > 0){
				foreach((array)$prevImages as $prevImgUrl ){
					echo Print_folio_image_fileds($c,$prevImgUrl);
					$c = $c +1;
				}
			
			}?>
		</div>
		<span id="here"></span>
		<input type="button" name="add" class="add button" value="<?php _e('+ Add Preview Image', 'premitheme');?>" />
		<p><?php printf( __( "All images MUSTN'T be less than <strong>%s width</strong> with no max/min height", "premitheme" ), $folioImgWidth ); ?></p>
		
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
	                $('#prevImgs').append('<?php echo implode('',explode("\n",Print_folio_image_fileds('count'))); ?>'.replace(/count/g, count));
	                return false;
	            });
	            $(".remove").live('click', function() {
	                $(this).parent().remove();
	            });
	        });
	    </script>
	</div>
	
	<div class="section">
		<label for="prevVidEmbed"><strong><?php _e( 'Remotely Hosted Video Embed Code (Use instead of the next field below for more controlled video embedding).', 'premitheme' ); ?></strong></label>
		<textarea id="prevVidEmbed" name="prevVidEmbed" cols="50" rows="4"><?php echo $prevVidEmbed; ?></textarea>
		<p><?php _e( 'Enter the embed code of remotely-hosted video. Overrides the next fields. <strong>Tip:</strong> add <code>wmode="transparent"</code> attribute to the iframe of embed code to prevent z-index issue with You Tube videos.', 'premitheme');?></p>
	</div>
	
	<div class="section">
		<label for="prevVidUrl"><strong><?php _e( 'Preview Video URL', 'premitheme' ); ?></strong></label>
		<input type="text" id="prevVidUrl" name="prevVidUrl" value="<?php echo $prevVidUrl; ?>">
		<p><?php _e( 'Overrides any preview images. Only remotely-hosted videos supported (i.e. youtube, vimeo &hellip; etc). Always use the full absolute URL including "http://".', 'premitheme' ); ?> <a href="http://codex.wordpress.org/Embeds" target="_blank"><?php _e( 'List of supported video hosts', 'premitheme'); ?></a></p>
	</div>
	
	
	
	<?php 
}



//-----------------------------//
// BG IMAGE METABOX
//-----------------------------//
function pt_portfolio_bg_metabox_inner( $post ) {
	global $post, $post_vals;
	$post_vals = get_post_custom( $post->ID );
	$singularBgImg = isset( $post_vals['singularBgImg'] ) ? esc_attr( $post_vals['singularBgImg'][0] ) : "";
	wp_nonce_field( 'portfolio_bg_meta_box_nonce', 'portfolio-bg-meta-box-nonce' );
	
	?>
	
	<div class="section first">
		<label for="singularBgImg"><strong><?php _e( 'Custom Fullscreen Background Image ', 'premitheme' ); ?></strong></label>
		<input type="text" id="singularBgImg" name="singularBgImg" value="<?php echo $singularBgImg; ?>">
		<input type="button" name="upload_image_button" class="upload_img button" value="<?php _e( 'Upload', 'premitheme' ); ?>" />
		<p><?php _e( 'Specify an image to be fullscreen BG for this portfolio item', 'premitheme' ); ?></p>
	</div>
		
	<?php 
}



//========================================//
// SAVE METABOXS
//========================================//
//-----------------------------//
// PORTFOLIO ITEM SETTINGS
//-----------------------------//
function pt_portfolio_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['folio-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['folio-meta-box-nonce'], 'folio_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
	if (isset($_POST['prevImg'])){
        $prevImages = $_POST['prevImg'];
        update_post_meta($post_id,'prevImg',$prevImages);
    }else{
        delete_post_meta($post_id,'prevImg');
    }
    
	if( isset( $_POST['prevVidUrl'] ) )  
		update_post_meta( $post_id, 'prevVidUrl', esc_attr( $_POST['prevVidUrl'] ) );
	if( isset( $_POST['prevVidEmbed'] ) )  
		update_post_meta( $post_id, 'prevVidEmbed', esc_attr( $_POST['prevVidEmbed'] ) );
	if( isset( $_POST['folioDate'] ) )  
		update_post_meta( $post_id, 'folioDate', esc_attr( $_POST['folioDate'] ) );
	if( isset( $_POST['clientName'] ) )  
		update_post_meta( $post_id, 'clientName', esc_attr( $_POST['clientName'] ) );
  if( isset( $_POST['clientLabel'] ) )  
		update_post_meta( $post_id, 'clientLabel', esc_attr( $_POST['clientLabel'] ) );
	if( isset( $_POST['liveUrl'] ) )  
		update_post_meta( $post_id, 'liveUrl', esc_attr( $_POST['liveUrl'] ) );
	if( isset( $_POST['liveLabel'] ) )  
		update_post_meta( $post_id, 'liveLabel', esc_attr( $_POST['liveLabel'] ) );
	if( isset( $_POST['skillsLabel'] ) )  
		update_post_meta( $post_id, 'skillsLabel', esc_attr( $_POST['skillsLabel'] ) );
	if( isset( $_POST['prevHeight'] ) )  
		update_post_meta( $post_id, 'prevHeight', esc_attr( $_POST['prevHeight'] ) );
}



//-----------------------------//
// BG IMAGE SAVE
//-----------------------------//
function pt_portfolio_bg_metabox_save( $post_id )  {  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['portfolio-bg-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['portfolio-bg-meta-box-nonce'], 'portfolio_bg_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
    
    if( isset( $_POST['singularBgImg'] ) )  
        update_post_meta( $post_id, 'singularBgImg', esc_attr( $_POST['singularBgImg'] ) );
}
