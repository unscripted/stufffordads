<?php

$crop = of_get_option('crop_location');
$itemDate = get_post_meta($post->ID, 'folioDate', TRUE);
$prevVidUrl = get_post_meta($post->ID, 'prevVidUrl', TRUE);
$prevVidEmbed = get_post_meta($post->ID, 'prevVidEmbed', TRUE);
$prevHeight = get_post_meta($post->ID, 'prevHeight', TRUE);
$clientName = get_post_meta($post->ID, 'clientName', TRUE);
$clientLabel = get_post_meta($post->ID, 'clientLabel', TRUE);
$liveUrl = get_post_meta($post->ID, 'liveUrl', TRUE);
$liveLabel = get_post_meta($post->ID, 'liveLabel', TRUE);
$skillsLabel = get_post_meta($post->ID, 'skillsLabel', TRUE);
$prevImages = get_post_meta($post->ID, 'prevImg', TRUE);

$folio_cats =  get_the_terms( get_the_ID(), 'portfolio_cats' ); 
$cat_name = '';
$cats_names = array();
if( !empty($folio_cats) ):
	foreach( $folio_cats as $folio_cat ):
		$cats_names[] = $folio_cat->name;
	endforeach; 
	$cat_name = join( ', ', $cats_names );
endif;

$folio_skills =  get_the_terms( get_the_ID(), 'portfolio_skills' ); 
if ( $folio_skills && ! is_wp_error( $folio_skills ) ):
	$skills_names = array();
	foreach( $folio_skills as $folio_skill ):
		$skills_names[] = $folio_skill->name;
	endforeach; 
endif;

?>

<?php get_header(); ?>

      <section id="content">
        
        <div id="page-title">
          
          <div id="folio-nav">
						
						<span title="<?php _e('Go to next project', 'premitheme'); ?>" class="nav-next"><?php next_post_link( '%link', 'Next', FALSE); ?></span>
						
						<?php if( of_get_option('folio_parent') != '' ): ?>
						<span title="<?php _e('View all projects', 'premitheme'); ?>" class="all-folio"><a href="<?php echo get_permalink( of_get_option('folio_parent') ); ?>">All</a></span>
						<?php endif; ?>
						
						<span title="<?php _e('Go to previous project', 'premitheme'); ?>" class="nav-prev"><?php previous_post_link( '%link', 'Prev', FALSE); ?></span>
						
						<div class="clear"></div>
					</div>
          
          <h1 class="entry-title"><?php the_title(); ?></h1>
          
        </div>
        
        <?php while ( have_posts() ) : the_post(); ?>
        
        <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper 2-col');?>>
          
          <div id="previews-wrapper">
            
            <?php if( $prevVidEmbed ) :
              $embed_code = htmlspecialchars_decode($prevVidEmbed);
  					?>
  					
  					<div id="vid-preview" class="block-bg"><?php echo stripslashes( $embed_code ); ?></div>
  					
  					<?php elseif( $prevVidUrl ):
              $embed_code = wp_oembed_get($prevVidUrl, array('width'=>978));
  					?>
  					
  					<div id="vid-preview" class="block-bg"><?php echo $embed_code; ?></div>
  					
  					<?php elseif (count($prevImages) > 0): ?>
  					
    					<?php if (count($prevImages) > 1): ?>
    					<div id="folio-nivo" class="block-bg" style="height: <?php echo $prevHeight; ?>px;">
    						<?php foreach((array)$prevImages as $prevImg ):
    							
    							$prevImgUrl = pt_get_image_path($prevImg);
    							
    							echo '<a title="" href="'.$prevImgUrl.'" rel="prettyPhoto[group-'.get_the_ID().']"><img src="'.PT_FUNCTIONS.'/timthumb.php?src='.$prevImgUrl.'&amp;h='.$prevHeight.'&amp;w=978&amp;zc=1&amp;q=100&amp;a='.$crop.'" alt=""/></a>';
    						endforeach; ?>
    					</div>
    					<?php else: ?>
    					<div id="img-preview" class="block-bg" style="height: <?php echo $prevHeight; ?>px;">
    						<?php foreach((array)$prevImages as $prevImg ):
    							
    							$prevImgUrl = pt_get_image_path($prevImg);
    							
    							echo '<a title="" href="'.$prevImgUrl.'" rel="prettyPhoto"><img src="'.PT_FUNCTIONS.'/timthumb.php?src='.$prevImgUrl.'&amp;h='.$prevHeight.'&amp;w=978&amp;zc=1&amp;q=100&amp;a='.$crop.'" alt=""/></a>';
    						endforeach; ?>
    					</div>
    					<?php endif; ?>
    					
  					<?php endif; ?>
  					
          </div>
          
          <div id="folio-content" class="block-bg">
            <div id="folio-sidebar">
              <?php if( $itemDate || $cat_name ): ?>
    					<aside>
    						<?php if( $itemDate ){ ?><h2 class="folio-date"><?php echo $itemDate; ?></h2><?php } ?>
    						<?php if( $cat_name ){ ?><h6 class="folio-cat"><?php echo $cat_name; ?></h6><?php } ?>
    					</aside>
    					<?php endif; ?>
              
              <?php if( $clientName ): ?>
    					<aside>
    				    <span></span>
    						<h6><?php echo $clientLabel; ?></h6>
    						<ul>
    							<li><?php echo $clientName; ?></li>
    						</ul>
    					</aside>
    					<?php endif; ?>
    					
    					<?php if( !empty($skills_names) ): ?>
    					<aside>
    						<span></span>
    						<h6><?php echo $skillsLabel; ?></h6>
    						<ul>
    							<?php foreach( $skills_names as $skillName ):?>
    							<li><?php echo $skillName; ?></li>
    							<?php endforeach; ?>
    						</ul>
    					</aside>
    					<?php endif; ?>
    					
    					<?php if( $liveUrl ): ?>
    					<aside>
    						<a class="live-btn" href="<?php echo $liveUrl; ?>" target="_blank"><?php echo $liveLabel; ?> <span>&raquo;</span></a>
    					</aside>
    					<?php endif; ?>
            </div>
            
            <div id="folio-description">
              <?php the_content(); ?>
    					
    					<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
    					
    					<?php if( of_get_option('folio_sharing') == '' || of_get_option('folio_sharing') != '0' ): ?>
    					 <?php get_template_part('includes/sharing-btns'); ?>
    					<?php endif; ?>
    				</div>
  					
  					<div class="clear"></div>
  					
  					<?php
      			if( of_get_option('show_similar') == '' || of_get_option('show_similar') != '0' ):
      			//----------------------//
      			// SIMILAR WORK
      			//----------------------//
      		    $cats = get_the_terms( get_the_ID(), 'portfolio_cats' ); 
      		    if ($cats):  
      		    $cat_ids = array();  
      		    foreach($cats as $individual_cat) $cat_ids[] = $individual_cat->term_id;  
      		      
      		    $args=array(  
      			    'post__not_in' => array($post->ID),  
      			    'showposts'=>4,
      			    'ignore_sticky_posts'=>1,
      			    'tax_query' => array(
      				    array(
      				      'taxonomy' => 'portfolio_cats',
      				      'field' => 'id',
      				      'terms' => $cat_ids,
      				      'operator' => 'IN'
      				    )
      				)
      		    );  
      		      
      		    $my_query = new wp_query($args);  
      		    if( $my_query->have_posts() ):
      		    ?>
      		    
      		    <div id="related-posts">
        		    <div class="hdivider"><hr/></div>
        		    <h3><?php _e('Similar Work', 'premitheme');?></h3>
        		    <ul>
        		    
        		    <?php while ($my_query->have_posts()):  
        		    $my_query->the_post(); ?>  
        		      
          		    <li>
          			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          				    <?php if ( has_post_thumbnail() ) : ?>
          				    <div class="related-thumb">
          				    <?php the_post_thumbnail('folio-related-thumb'); ?>
          				    </div>
          				    <?php else: ?>
          				    <div class="related-thumb">
          				    	<img src="<?php echo get_template_directory_uri();?>/images/no-image-209x90.png" alt="No Image"/>
          				    </div>
          				    <?php endif; ?>
          				    <h6 class="related-title"><?php the_title(); ?></h6>
          			    </a>
          		    </li>  
        		      
        		    <?php endwhile; ?>
        		    
        		    </ul>
        		    <div class="clear"></div>
      		    </div>
      		    
      		    <?php endif; endif;
      		    wp_reset_query();
      		    // END SIMILAR WORK
      		    endif;
      		    ?>

          </div>
          
        </article>
        
        <?php endwhile; ?>
      
      </section><!-- #content -->
    
<?php get_footer(); ?>