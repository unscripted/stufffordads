<?php

$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$titleAtt = sprintf( __('View all posts by %s', 'premitheme'), $author );
$mp3Path = get_post_meta($post->ID, 'mp3Path', TRUE);
$ogaPath = get_post_meta($post->ID, 'ogaPath', TRUE);

?>
<li id="post-<?php the_ID();?>" <?php post_class('entry-wrapper blog-masonry block-bg');?>>
  
  <?php if ( $mp3Path && $ogaPath ): ?>
  
  <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery("#jquery-jplayer-<?php the_ID(); ?>").jPlayer({
        ready: function () {
          jQuery(this).jPlayer("setMedia", {
            mp3: "<?php echo $mp3Path; ?>",
            oga: "<?php echo $ogaPath; ?>",
          });
        },
        swfPath: "<?php echo PT_JS; ?>",
        supplied: "mp3, oga",
        cssSelectorAncestor: "#jp-gui-<?php the_ID(); ?>",
      })
      .bind(jQuery.jPlayer.event.play, function() { // Bind an event handler to the instance's play event.
        jQuery(this).jPlayer("pauseOthers"); // pause all players except this one.
      });
    });
  </script>
  
  <div class="entry-media">
    <div class="jp-audio-wrapper">
      <div class="jp-type-single">
        <div id="jquery-jplayer-<?php the_ID(); ?>" class="jp-jplayer"></div>
        <div id="jp-gui-<?php the_ID(); ?>" class="jp-gui">
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