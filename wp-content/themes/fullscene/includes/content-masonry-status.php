<?php

$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$titleAtt = sprintf( __('View all posts by %s', 'premitheme'), $author );
$imgAtt = array( 'title' => trim(strip_tags( $post->post_title )) );

?>
<li id="post-<?php the_ID();?>" <?php post_class('entry-wrapper blog-masonry block-bg');?>>
  
  <div class="sticky-badge" title="Sticky Post"></div>
  
  <div class="author-avatar">
    <?php echo get_avatar( get_the_author_meta( 'user_email' ), 40); ?>
  </div>
  
  <div class="entry-content">
    <?php the_content(); ?>
  </div>
  
  <div class="entry-meta">
    <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_time(); ?>"><?php echo get_the_date(); ?></a>
  </div><!-- .entry-meta -->
  
  <div class="clear"></div>
  
</li>