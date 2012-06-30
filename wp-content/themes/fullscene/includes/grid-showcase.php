<?php

$gridNavCat = get_post_meta($post->ID, 'gridNavCat', TRUE);
$gridNavAll = get_post_meta($post->ID, 'gridNavAll', TRUE);
$gridNavRows = get_post_meta($post->ID, 'gridNavRows', TRUE);
$gridNavLabel = get_post_meta($post->ID, 'gridNavLabel', TRUE);

if( $gridNavLabel && $gridNavLabel != '' ) $gridlabel = $gridNavLabel; else $gridlabel = __('Recent Work', 'premitheme');

if( $gridNavRows == '3' ){
  $gridHeight = '627px';
  if( $gridNavAll && $gridNavAll == 'unlimited' ){
    $postsNum = -1;
  } else {
    $postsNum = 18;
  }
} elseif( $gridNavRows == '2' ){
  $gridHeight = '418px';
  if( $gridNavAll && $gridNavAll == 'unlimited' ){
    $postsNum = -1;
  } else {
    $postsNum = 12;
  }
} elseif( $gridNavRows == '1' ){
  $gridHeight = '209px';
  if( $gridNavAll && $gridNavAll == 'unlimited' ){
    $postsNum = -1;
  } else {
    $postsNum = 6;
  }
} else {
  $gridHeight = '627px';
  $postsNum = 18;
}

$args = array(
    'hide_empty'    => 1,
    'hierarchical'  => 0,
    'parent'        => 0,
    'taxonomy' => 'portfolio_cats');
    
$folioCats = get_categories($args);
$homeGridOrder = of_get_option('grid_showcase_order');
if( $homeGridOrder ){ $orderOption = $homeGridOrder; } else { $orderOption = 'post_date'; }
global $post;
$tmp_post = $post;

if( $gridNavCat && $gridNavCat != 'all' ):
	$args = array(
		'posts_per_page' => $postsNum,
		'order' => 'DESC',
		'orderby' => $orderOption,
		'post_type' => 'portfolio',
		'tax_query' => array(
		    array(
		      'taxonomy' => 'portfolio_cats',
		      'field' => 'id',
		      'terms' => array($gridNavCat),
		      'operator' => 'IN'
		    )
	   )
  );
else:
	$args = array(
    'posts_per_page' => $postsNum,
		'order' => 'DESC',
		'orderby' => $orderOption,
		'post_type' => 'portfolio'
	);
endif;

$myposts = get_posts($args);
if( !empty($myposts) ): ?>

<div id="tj_container" class="tj_container" style="height:<?php echo $gridHeight; ?>;">
	<div class="gridnav-label"><h3><?php echo $gridlabel; ?></h3></div>
	<div class="tj_nav">
		<span id="tj_prev" class="tj_prev">Previous</span>
		<span id="tj_next" class="tj_next">Next</span>
	</div>
	<div class="tj_wrapper">
		<ul class="tj_gallery recent-work">
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
			
			<li>
        <div  class="folio-item block-bg">
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
        </div>
      </li>
			
			<?php endforeach; ?>
			<?php $post = $tmp_post;
			wp_reset_query(); ?>
		</ul>
		<div class="clear"></div>
	</div>
</div>

<?php endif; ?>
