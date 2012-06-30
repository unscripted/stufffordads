<?php

$blogCatOption = get_post_meta($post->ID, 'recentPostsCat', TRUE);

global $post;
$tmp_post = $post;

if( $blogCatOption && $blogCatOption != 'all' ):
	$args = array(
	   'posts_per_page' => 3,
	   'order' => 'DESC',
	   'orderby' => 'post_date',
	   'cat' => $blogCatOption
	);
else:
	$args = array(
	   'posts_per_page' => 3,
	   'order' => 'DESC',
	   'orderby' => 'post_date'
	);
endif;

$myposts = get_posts($args);
if( !empty($myposts) ): ?>

<ul class="recent-posts block-bg">
	<?php foreach( $myposts as $post ) : setup_postdata($post); ?>
	
	<li <?php post_class('recent-post-wrap');?>>
			<?php if ( of_get_option('recent_thumbs') == "1" ): ?>
			<a class="blog-overlay" href="<?php the_permalink(); ?>">
  			<?php
  			if ( has_post_thumbnail()):
  			the_post_thumbnail('recent-thumb');
  			else:?>
  			<img src="<?php echo get_template_directory_uri();?>/images/no-image-279x100.png" alt="No Image"/>
  			<?php endif;?>
  			<span class="more-hover"></span>
      </a>
      <?php endif; ?>
      
      <div class="entry-meta">
				<span title="<?php echo get_the_time(); ?>"><?php echo get_the_date(); ?></span>
        <?php if( of_get_option('posts_comments') != '0' || of_get_option('posts_comments') == '' ): ?>
          <?php if( comments_open() ): ?>
          <span><span>/</span><?php comments_popup_link( __( 'Leave comment', 'premitheme' ), __( '1 comment', 'premitheme' ), __('% comments', 'premitheme'), 'comments-link' ); ?></span>
          <?php endif; ?>
        <?php endif; ?>
			</div>
      
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			
			<div class="recent-post-content">
				<?php the_excerpt(); ?>
			</div>
			
	</li>
	
	<?php endforeach; ?>
	<?php $post = $tmp_post;
	wp_reset_query(); ?>
	
	<li class="clear"></li>
</ul><!-- .recent-posts-row -->

<div class="clear"></div>

<?php endif; ?>