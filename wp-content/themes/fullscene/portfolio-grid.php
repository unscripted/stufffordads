<?php
/*
Template Name: Portfolio Page - Grid - All Items
*/

$args = array(
    'hide_empty'    => 1,
    'hierarchical'  => 0,
    'parent'        => 0,
    'taxonomy' => 'portfolio_cats'
  );
    
$folioCats = get_categories($args);

?>
<?php get_header();?>
  
  <section id="content">
      
      <?php the_post(); ?>
      
      <div id="page-title">
        <?php if( of_get_option('filtering_on') == '' || of_get_option('filtering_on') != '0' ): ?>
          <?php if( !empty( $folioCats )): ?>
        
          <ul id="filtering-links">
            <li data-filter="*" class="filter current">
              <a href="#" title="<?php _e('Show All', 'premitheme'); ?>"><?php _e('All', 'premitheme');?></a>
            </li>
          
            <?php foreach( $folioCats as $folioFilter ): ?>
            <li data-filter=".<?php echo $folioFilter->slug ?>" class="filter">
              <a href="#" title="<?php printf( __('Show %s Only', 'premitheme'), $folioFilter->cat_name ); ?>"><?php echo $folioFilter->cat_name ?></a>
            </li>
            <?php endforeach; ?>
            <li class="clear"></li>
          </ul>
        
          <?php endif; ?>
        <?php endif; ?>
        
        <h1 class="entry-title"><?php the_title(); ?></h1>
      </div>
      
      <?php if(trim($post->post_content) != '' ): ?>
      
      <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper block-bg');?>>
        <div class="entry-content">
          <?php the_content(); ?>
          <?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
          <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta">', '</div>' ); ?>
        </div>
      </article>
      
      <?php endif; ?>
        
      <ul id="folio-items">
      
      <?php
      if( of_get_option('folio_perpage') ):
        $perPage = of_get_option('folio_perpage');
      else:
        $perPage = '-1';
      endif;
      
      if ( get_query_var('paged') ) {
        $paged = get_query_var('paged');
      } else if ( get_query_var('page') ) {
        $paged = get_query_var('page');
      } else {
        $paged = 1;
      }
      
      $args = array(
        'paged' => $paged,
        'posts_per_page' => $perPage,
        'post_type' => 'portfolio'
      );
      
      $wp_query = new WP_Query();
      $wp_query->query($args);
      while ($wp_query->have_posts()) : $wp_query->the_post();
      
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
      endif;
      ?>
        
        <li class="<?php if( !empty($folio_cats) ){ foreach( $folio_cats as $filter_class ){ echo $filter_class->slug.' '; } } ?>all folio-item block-bg">
          <a class="folio-overlay" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <span class="more-hover"></span>
            
            <?php
            if ( has_post_thumbnail()):
              the_post_thumbnail('folio-grid', $imgAtt);
            else: ?>
              <img src="<?php echo get_template_directory_uri();?>/images/no-image-320x200.png" alt="No Image"/>
            <?php endif;?>
            
            <div class="folio-title">
              <h2><?php the_title(); ?></h2>
              <?php if( count($folioCats) > 1 ){ ?><h3><?php echo $cat_name; ?></h3><?php } ?>
              <?php if( $itemDate ){ ?><h4><?php echo $itemDate; ?></h4> <?php } ?>
            </div>
          </a>
        </li>
        
      <?php endwhile;
      wp_reset_query(); ?>
      <li class="clear"></li>
    </ul>
    
    <?php
    // Pagination
    if(function_exists('wp_pagenavi')): wp_pagenavi();
    elseif (function_exists('wp_corenavi')): wp_corenavi();
    else: pt_content_nav('nav_below');
    endif;
    ?>
      
  </section><!-- #content -->
    
<?php get_footer();?>