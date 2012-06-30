<?php

$videoEmbed = get_post_meta($post->ID, 'videoEmbed', TRUE);
$videoURL = get_post_meta($post->ID, 'videoURL', TRUE);
$m4vPath = get_post_meta($post->ID, 'm4vPath', TRUE);
$ogvPath = get_post_meta($post->ID, 'ogvPath', TRUE);
$videoPoster = get_post_meta($post->ID, 'videoPoster', TRUE);
$videoHeight = get_post_meta($post->ID, 'videoHeight', TRUE);
$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$titleAtt = sprintf( __('View all posts by %s', 'premitheme'), $author );

?>
<article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper blog-normal block-bg');?>>
  
  <?php if ( $videoEmbed ):
    
    $embedDecode = htmlspecialchars_decode($videoEmbed); ?>
    
    <div class="entry-media">
      <?php echo stripslashes( $embedDecode ); ?>
    </div>
  
  <?php elseif ( $videoURL ):
  
    $embed_code = wp_oembed_get($videoURL, array('width'=>710)); ?>
  
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
            width: "710px",
            height: "<?php echo $videoHeight; ?>px",
            cssClass: "jp-video-649"
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
              <div class="jp-current-time"></div>
              <div class="jp-duration"></div>
              <div class="jp-volume-bar">
                  <div class="jp-volume-bar-value"></div>
              </div>
            </div><!-- .jp-interface -->
          </div><!-- .jp-gui -->
        </div><!-- .jp-type-single -->
      </div><!-- .jp-video-wrapper -->
    </div><!-- .entry-media -->
  
  <?php endif; ?>
  
  <div class="entry-info">
    <div class="sticky-badge" title="Sticky Post"></div>
    
    <div class="entry-meta">
      <span><?php printf( __('Posted in %s','premitheme' ), get_the_category_list(', ') );?></span>
      <span><span>/</span><?php printf( __('By %s', 'premitheme'), '<a href="'. $author_url .'" title="'. $titleAtt .'">'. $author .'</a>' );?></span>
      <?php if( of_get_option('posts_comments') != '0' || of_get_option('posts_comments') == '' ): ?>
        <?php if( comments_open() ): ?>
        <span><span>/</span><?php comments_popup_link( __( 'Leave comment', 'premitheme' ), __( '1 comment', 'premitheme' ), __('% comments', 'premitheme'), 'comments-link' ); ?></span>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
    <div class="entry-content">
      <?php the_excerpt(); ?>
    </div>
  </div><!-- .entry-info -->
  
  <div class="entry-date">
    <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_time(); ?>"><span><?php echo get_the_date('d'); ?></span><small><?php echo get_the_date('M'); ?></small></a>
  </div><!-- .entry-date -->
  
  <div class="clear"></div>
  
</article>