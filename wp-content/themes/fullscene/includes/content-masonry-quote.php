<?php

$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$titleAtt = sprintf( __('View all posts by %s', 'premitheme'), $author );
$quoteText = get_post_meta($post->ID, 'quoteText', TRUE);

?>
<li id="post-<?php the_ID();?>" <?php post_class('entry-wrapper blog-masonry block-bg');?>>
  
  <div class="entry-quote">
    <h2><?php echo $quoteText; ?></h2>
  </div><!-- .entry-quote -->
  
  <div class="sticky-badge" title="Sticky Post"></div>
  
  <div class="entry-content">
    <p><?php the_excerpt(); ?></p>
  </div>
  
  <div class="entry-meta">
    <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_time(); ?>"><?php echo get_the_date(); ?></a>
  </div><!-- .entry-meta -->
  
  <div class="clear"></div>
  
</li>