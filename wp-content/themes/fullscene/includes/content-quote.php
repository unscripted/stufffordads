<?php

$quoteText = get_post_meta($post->ID, 'quoteText', TRUE);
$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$titleAtt = sprintf( __('View all posts by %s', 'premitheme'), $author );

?>
<article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper blog-normal block-bg');?>>
  
  <div class="entry-quote">
    <h2><?php echo $quoteText; ?></h2>
  </div><!-- .entry-quote -->
  
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
    
    <div class="entry-content">
      <?php the_excerpt(); ?>
    </div>
  </div><!-- .entry-info -->
  
  <div class="entry-date">
    <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_time(); ?>"><span><?php echo get_the_date('d'); ?></span><small><?php echo get_the_date('M'); ?></small></a>
  </div><!-- .entry-date -->
  
  <div class="clear"></div>
  
</article>