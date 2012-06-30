<?php

$crop = of_get_option('crop_location');
$imgUrl =  get_post_meta($post->ID, 'fixedImgURL', TRUE);
$imgPath =  pt_get_image_path($imgUrl);
$imgHeight =  get_post_meta($post->ID, 'fixedImgHeight', TRUE);
$imgLink =  get_post_meta($post->ID, 'fixedImgLink', TRUE);

if( $imgUrl ):

  echo '<div class="fixed-image-banner block-bg">';
  if( $imgLink ) echo '<a href="'.$imgLink.'">';
  echo '<img src="'.PT_FUNCTIONS.'/timthumb.php?src='.$imgPath.'&amp;h='.$imgHeight.'&amp;w=978&amp;zc=1&amp;q=100&amp;a='.$crop.'" alt=""/>';
  if( $imgLink ) echo '</a>';
  echo '</div>';

endif;