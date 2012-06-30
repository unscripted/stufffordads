<?php

$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$titleAtt = sprintf( __('View all posts by %s', 'premitheme'), $author );
$crop = of_get_option('crop_location');
$galleryHeight =  get_post_meta($post->ID, 'galleryHeight', TRUE);
$gallImages = get_post_meta($post->ID, 'gallImg', TRUE);

?>
<li id="post-<?php the_ID();?>" <?php post_class('entry-wrapper blog-masonry block-bg');?>>
  
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
      
      echo '<a title="'.get_the_title().'" href="'.$gallImgUrl.'" rel="prettyPhoto[group-'.get_the_ID().']"><img src="'.PT_FUNCTIONS.'/timthumb.php?src='.$gallImgUrl.'&amp;h='.$galleryHeight.'&amp;w=320&amp;zc=1&amp;q=100&amp;a='.$crop.'" alt=""/></a>';
      endforeach; 
      endif; ?>
    </div>
  </div><!-- .entry-thumb -->
  
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