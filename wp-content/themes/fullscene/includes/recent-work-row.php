<?php

$folioCatOption = get_post_meta($post->ID, 'recentWorkCat', TRUE);

$args = array(
    'hide_empty'    => 1,
    'hierarchical'  => 0,
    'parent'        => 0,
    'taxonomy' => 'portfolio_cats');
    
$folioCats = get_categories($args);
$recentWorkOrder = of_get_option('recent_work_order');
if( $recentWorkOrder ){ $orderOption = $recentWorkOrder; } else { $orderOption = 'post_date'; }
global $post;
$tmp_post = $post;

if( $folioCatOption && $folioCatOption != 'all' ):
	$args = array(
		'posts_per_page' => 3,
		'order' => 'DESC',
		'orderby' => $orderOption,
		'post_type' => 'portfolio',
		'tax_query' => array(
		    array(
		      'taxonomy' => 'portfolio_cats',
		      'field' => 'id',
		      'terms' => array($folioCatOption),
		      'operator' => 'IN'
		    )
	   )
  );
else:
	$args = array(
    'posts_per_page' => 3,
		'order' => 'DESC',
		'orderby' => $orderOption,
		'post_type' => 'portfolio'
	);
endif;

$myposts = get_posts($args);
if( !empty($myposts) ): ?>

<ul class="recent-work-row">
	<?php foreach( $myposts as $post ) : setup_postdata($post);
	
	$itemDate = get_post_meta($post->ID, 'folioDate', TRUE);
  $imgAtt = array( 'title' => trim(strip_tags( $post->post_title )) );
	$folio_cats =  get_the_terms( get_the_ID(), 'portfolio_cats' );
	$cat_name = '';
	$cats_names = array();
	if( !empty($folio_cats) ):
		foreach( $folio_cats as $folio_cat ):
			$cats_names[] = $folio_cat->name;
		endforeach; 
		$cat_name = join( ', ', $cats_names );
	endif; ?>
	
	<li class="folio-item block-bg">
    <a class="folio-overlay" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <span class="more-hover"></span>
      
      <?php
      if ( has_post_thumbnail()):
      the_post_thumbnail('folio-grid', $imgAtt);
      else:?>
      <img src="<?php echo get_template_directory_uri();?>/images/no-image-320x200.png" alt="No Image"/>
      <?php endif;?>
      
      <div class="folio-title">
        <h2><?php the_title(); ?></h2>
        <?php if( count($folioCats) > 1 ){ ?><h3><?php echo $cat_name; ?></h3><?php } ?>
        <?php if( $itemDate ){ ?><h4><?php echo $itemDate; ?></h4> <?php } ?>
      </div>
    </a>
  </li>
	
	<?php endforeach; ?>
	<?php $post = $tmp_post;
	wp_reset_query(); ?>
	<li class="clear"></li>
</ul><!-- .home-carousel -->

<div class="clear"></div>

<?php endif; ?>
