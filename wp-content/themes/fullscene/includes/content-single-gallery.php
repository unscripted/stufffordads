<?php

$crop = of_get_option('crop_location');
$galleryHeight =  get_post_meta($post->ID, 'galleryHeight', TRUE);
$gallImages = get_post_meta($post->ID, 'gallImg', TRUE);
$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$titleAtt = sprintf( __('View all posts by %s', 'premitheme'), $author );

?>
  
  <div class="entry-thumb">
    <script type="text/javascript">
      jQuery(window).load(function() {
        jQuery('#post-gallery-<?php the_ID(); ?>').nivoSlider({
        directionNav: false,
        directionNavHide: false,
        effect: 'fade',
        controlNav: true
        });
        
        var paginationWidth = jQuery('.nivo-controlNav').width();
      
        var negativeMargin = paginationWidth / 2;
      
        jQuery('.nivo-controlNav').css({ marginLeft: -negativeMargin });
      });
    </script>
    <div id="post-gallery-<?php the_ID(); ?>" class="nivo-post-gallery" style="height: <?php echo $galleryHeight; ?>px;">
      <?php if (count($gallImages) > 0): ?>
      <?php foreach((array)$gallImages as $gallImg ):
      
      $gallImgUrl = pt_get_image_path($gallImg);
      
        echo '<a title="'.get_the_title().'" href="'.$gallImgUrl.'" rel="prettyPhoto[group-'.get_the_ID().']"><img src="'.PT_FUNCTIONS.'/timthumb.php?src='.$gallImgUrl.'&amp;h='.$galleryHeight.'&amp;w=710&amp;zc=1&amp;q=100&amp;a='.$crop.'" alt=""/></a>';
      endforeach; 
      endif; ?>
    </div>
  </div><!-- .entry-thumb -->
  
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
  
  <h1 class="entry-title"><?php the_title(); ?></h1>
  
  <?php if( of_get_option('sharing_on') == '' || of_get_option('sharing_on') != '0' ): ?>
  <?php get_template_part('includes/sharing-btns'); ?>
  <?php endif; ?>
  
  <div class="entry-content">
    <?php the_content(); ?>
    <?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
  </div><!-- .entry-content -->