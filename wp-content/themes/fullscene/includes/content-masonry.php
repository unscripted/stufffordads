<?php

$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$titleAtt = sprintf( __('View all posts by %s', 'premitheme'), $author );
$imgAtt = array( 'title' => trim(strip_tags( $post->post_title )) );

?>
<li id="post-<?php the_ID();?>" <?php post_class('entry-wrapper blog-masonry block-bg');?>>
  
  <?php if ( has_post_thumbnail()): ?>
  
  <a class="entry-thumb" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
    <?php the_post_thumbnail('masonry-thumb', $imgAtt); ?>
  </a>
  
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