<?php

$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$titleAtt = sprintf( __('View all posts by %s', 'premitheme'), $author );

?>
  
  <div class="entry-meta">
    <span title="<?php echo get_the_time(); ?>"><?php echo get_the_date(); ?></span>
    <span><span>/</span><?php printf( __('Posted in %s','premitheme' ), get_the_category_list(', ') );?></span>
    <span><span>/</span><?php printf( __('By %s', 'premitheme'), '<a href="'. $author_url .'" title="'. $titleAtt .'">'. $author .'</a>' );?></span>
    <?php if( of_get_option('posts_comments') != '0' || of_get_option('posts_comments') == '' ): ?>
      <?php if( comments_open() ): ?>
      <span><span>/</span><?php comments_popup_link( __( 'Leave comment', 'premitheme' ), __( '1 comment', 'premitheme' ), __('% comments', 'premitheme'), 'comments-link' ); ?></span>
      <?php endif; ?>
    <?php endif; ?>
  </div><!-- .entry-meta -->
  
  <?php if( of_get_option('sharing_on') == '' || of_get_option('sharing_on') != '0' ): ?>
  <?php get_template_part('includes/sharing-btns'); ?>
  <?php endif; ?>
  
  <div class="author-avatar">
    <?php echo get_avatar( get_the_author_meta( 'user_email' ), 40); ?>
  </div><!-- .author-avatar -->
  
  <div class="entry-content">
    <?php the_content(); ?>
    <?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
  </div><!-- .entry-content -->