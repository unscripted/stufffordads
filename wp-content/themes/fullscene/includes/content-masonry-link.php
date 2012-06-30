<?php

$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$titleAtt = sprintf( __('View all posts by %s', 'premitheme'), $author );
$linkURL = get_post_meta($post->ID, 'linkURL', TRUE);

?>
<li id="post-<?php the_ID();?>" <?php post_class('entry-wrapper blog-masonry block-bg');?>>
  
  <div class="entry-link">
    <h2><a href="<?php echo $linkURL; ?>" target="_blank"><?php the_title(); ?> <?php _e('[Link]', 'premitheme');?></a></h2>
  </div><!-- .entry-link -->
  
  <div class="sticky-badge" title="Sticky Post"></div>
  
  <div class="entry-content">
    <p><?php the_excerpt(); ?></p>
  </div>
  
  <div class="entry-meta">
    <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_time(); ?>"><?php echo get_the_date(); ?></a>
  </div><!-- .entry-meta -->
  
  <div class="clear"></div>
  
</li>