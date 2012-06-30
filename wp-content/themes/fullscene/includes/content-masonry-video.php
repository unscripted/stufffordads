<?php

$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$titleAtt = sprintf( __('View all posts by %s', 'premitheme'), $author );
$videoEmbed = get_post_meta($post->ID, 'videoEmbed', TRUE);
$videoURL = get_post_meta($post->ID, 'videoURL', TRUE);
$m4vPath = get_post_meta($post->ID, 'm4vPath', TRUE);
$ogvPath = get_post_meta($post->ID, 'ogvPath', TRUE);
$videoPoster = get_post_meta($post->ID, 'videoPoster', TRUE);
$videoHeight = get_post_meta($post->ID, 'videoHeight', TRUE);

?>
<li id="post-<?php the_ID();?>" <?php post_class('entry-wrapper blog-masonry block-bg');?>>
  
  <?php if ( $videoEmbed ):
    
    $embedDecode = htmlspecialchars_decode($videoEmbed); ?>
    
    <div class="entry-media">
      <?php echo stripslashes( $embedDecode ); ?>
    </div>
  
  <?php elseif ( $videoURL ):
  
    $embed_code = wp_oembed_get($videoURL, array('width'=>320)); ?>
  
    <div class="entry-media">
      <?php echo $embed_code; ?>
    </div>
  
  <?php elseif ( $ogvPath && $m4vPath ): ?>
  
    <script type="text/javascript">
      jQuery(document).ready(function(){
        jQuery("#jquery-jplayer-<?php the_ID(); ?>").jPlayer({
          ready: function () {
            jQuery(this).jPlayer("setMedia", {
              m4v: "<?php echo $m4vPath; ?>",
              ogv: "<?php echo $ogvPath; ?>",
              poster: "<?php echo $videoPoster; ?>"
            });
          },
          swfPath: "<?php echo PT_JS; ?>",
          solution:"flash,html",
          supplied: "m4v, ogv, all",
          cssSelectorAncestor: "#jp-gui-<?php the_ID(); ?>",
          size: {
            width: "320px",
            height: "<?php echo $videoHeight; ?>px",
            cssClass: "jp-video-320"
          }
        })
        .bind(jQuery.jPlayer.event.play, function() { // Bind an event handler to the instance's play event.
          jQuery(this).jPlayer("pauseOthers"); // pause all players except this one.
        });
      });
    </script>
  
    <div class="entry-media">
      <div class="jp-video-wrapper">
        <div class="jp-type-single">
          <div id="jquery-jplayer-<?php the_ID(); ?>" class="jp-jplayer" style="height: <?php echo $videoHeight; ?>px;"></div>
          <div id="jp-gui-<?php the_ID(); ?>" class="jp-gui">
            <div class="jp-video-play"></div>
            <div class="jp-interface">
              <ul class="jp-controls">
                <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
              </ul>
              <div class="jp-progress">
                <div class="jp-seek-bar">
                  <div class="jp-play-bar"></div>
                </div>
              </div>
              <div class="jp-volume-bar">
                  <div class="jp-volume-bar-value"></div>
              </div>
            </div><!-- .jp-interface -->
          </div><!-- .jp-gui -->
        </div><!-- .jp-type-single -->
      </div><!-- .jp-video-wrapper -->
    </div><!-- .entry-media -->
  
  <?php endif; ?>
  
  <div class="sticky-badge" title="Sticky Post"></div>
  
  <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
  
  <div class="entry-content">
    <p><?php the_excerpt(); ?></p>
  </div>
  
  <div class="entry-meta">
    <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_time(); ?>"><?php echo get_the_date(); ?></a>
  </div><!-- .entry-meta -->
  
  <div class="clear"></div>
  
</li>