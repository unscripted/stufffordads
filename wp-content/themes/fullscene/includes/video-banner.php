<?php

$videoEmbed =  get_post_meta($post->ID, 'videoBannerEmbed', TRUE);
$videoURL =  get_post_meta($post->ID, 'videoBannerURL', TRUE);

if ( $videoEmbed ):
    
  $embedDecode = htmlspecialchars_decode($videoEmbed); ?>
  
  <div class="video-banner block-bg">
    <?php echo stripslashes( $embedDecode ); ?>
  </div>

<?php elseif ( $videoURL ):

  $embed_code = wp_oembed_get($videoURL, array('width'=>978)); ?>
  
  <div class="video-banner block-bg">
    <?php echo $embed_code; ?>
  </div>

<?php endif; ?>