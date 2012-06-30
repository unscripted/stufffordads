<?php
$crop = of_get_option('crop_location');
$homeSliderOrder = of_get_option('slider_order');
$sliderSetOption =  get_post_meta($post->ID, 'sliderSet', TRUE);
$sliderHeight = get_post_meta($post->ID, 'sliderHeight', TRUE);
if( $homeSliderOrder != '' ) $orderOption = $homeSliderOrder; else $orderOption = 'post_date';
if( get_post_meta($post->ID, 'sliderHeight', TRUE) ) $sliderHeight = get_post_meta($post->ID, 'sliderHeight', TRUE); else $sliderHeight = '300';
?>
	
<div id="home-slider" class="block-bg" style="height: <?php echo $sliderHeight; ?>px;">
	<?php
	global $post;
	$tmp_post = $post;
	
	if( $sliderSetOption && $sliderSetOption != 'all' ):
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
	else:
  	$args = array(
  	   'posts_per_page' => -1,
  	   'order' => 'DESC',
  	   'orderby' => $orderOption,
  	   'post_type' => 'slides'
  	);
	endif;
	
	$myposts = get_posts($args);
						
	foreach( $myposts as $post ) : setup_postdata($post);
	
	$nivoImgPath =  get_post_meta($post->ID, 'nivoImgURL', TRUE);
	$nivoImg =  pt_get_image_path($nivoImgPath);
	$nivoLink =  get_post_meta($post->ID, 'nivoLink', TRUE);
	$nivoCaption1 =  get_post_meta($post->ID, 'nivoCaption1', TRUE);
	$nivoCaption2 =  get_post_meta($post->ID, 'nivoCaption2', TRUE);
	
	if( $nivoCaption1 != '' ){ $caption1 = '<h2><span>'.$nivoCaption1.'</span></h2>'; } else { $caption1 = ''; }
	if( $nivoCaption2 != '' ){ $caption2 = '<h3><span>'.$nivoCaption2.'</span></h3>'; } else { $caption2 = ''; }
	
	if( $nivoLink != '' ):
		echo '<a href="'.$nivoLink.'" style="width: 978px; height: '.$sliderHeight.'px;">';
		if($nivoImgPath){
		  echo '<img title="'.$caption1.$caption2.'" src="'.PT_FUNCTIONS.'/timthumb.php?src='.$nivoImg.'&amp;h='.$sliderHeight.'&amp;w=978&amp;zc=1&amp;q=100&amp;a='.$crop.'" alt=""/>';
		} else {
		  echo '<img title="'.$caption1.$caption2.'" src="'.PT_FUNCTIONS.'/timthumb.php?src='.get_template_directory_uri().'/images/no-image-800x600.png&amp;h='.$sliderHeight.'&amp;w=978&amp;zc=1&amp;q=100&amp;a='.$crop.'" alt=""/>';
		}
		echo '</a>';
	else:
		if($nivoImgPath){
		  echo '<img title="'.$caption1.$caption2.'" src="'.PT_FUNCTIONS.'/timthumb.php?src='.$nivoImg.'&amp;h='.$sliderHeight.'&amp;w=978&amp;zc=1&amp;q=100&amp;a='.$crop.'" alt=""/>';
		} else {
		  echo '<img title="'.$caption1.$caption2.'" src="'.PT_FUNCTIONS.'/timthumb.php?src='.get_template_directory_uri().'/images/no-image-800x600.png&amp;h='.$sliderHeight.'&amp;w=978&amp;zc=1&amp;q=100&amp;a='.$crop.'" alt=""/>';
		}
	endif;
	
	endforeach;
	$post = $tmp_post;
	wp_reset_query(); ?>
	
</div>