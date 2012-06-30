<?php

$calloutMessage =  get_post_meta($post->ID, 'calloutMes', TRUE);

if ( $calloutMessage ): 
  $Message = htmlspecialchars_decode($calloutMessage); 
						
	$messageShorcode = do_shortcode($Message);
  ?>
  
  <div class="callout-mes">
    <h2><?php echo $messageShorcode; ?></h2>
  </div>

<?php endif; ?>