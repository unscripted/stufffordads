<?php get_header(); ?>    
    
    <section id="content">
    
      <?php while ( have_posts() ) : the_post(); ?>
      
      <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper block-bg');?>>
        
        <?php get_template_part( 'includes/content-single', get_post_format() ); ?>
        
        <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta">', '</div>' ); ?>
        
        <div class="entry-meta">
          <?php echo get_the_tag_list( '<span class="tags-list"><strong>Tags:</strong><span> ', '</span><span>/</span><span>', '</span></span>' ); ?>
        </div>
        
        <div class="clear"></div>
        
        <?php if( of_get_option('show_related') == '' || of_get_option('show_related') != '0' ):
            
        //----------------------//
        // RELATED POSTS
        //----------------------//
        
          $tags = wp_get_post_tags($post->ID);  
          if ($tags):  
          $tag_ids = array();  
          
          foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
                  
          $args=array(  
            'tag__in' => $tag_ids,  
            'post__not_in' => array($post->ID),  
            'showposts'=>3,
            'ignore_sticky_posts'=>1,
            'tax_query' => array(
              'relation' => 'AND',
              array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => 'post-format-status',
                'operator' => 'NOT IN'
              ),
              array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => 'post-format-aside',
                'operator' => 'NOT IN'
              )
            )
          );  
            
          $my_query = new wp_query($args);  
          if( $my_query->have_posts() ):
          ?>
          
          <div id="related-posts">
            <div class="hdivider"><hr/></div>
            <h3><?php _e('Related Posts', 'premitheme');?></h3>
            <ul>
            
            <?php while ($my_query->have_posts()): $my_query->the_post(); ?>
              
            <li>
              <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <div class="related-thumb">
                <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail('blog-related-thumb'); ?>
                <?php else: ?>
                  <img src="<?php echo get_template_directory_uri();?>/images/no-image-199x90.png" alt="No Image"/>
                <?php endif; ?>
                </div>
                <h6 class="related-title"><?php the_title(); ?></h6>
              </a>
            </li>  
              
            <?php endwhile; ?>
            
            </ul>
            <div class="clear"></div>
          </div>
          
          <?php endif; ?>
          <?php endif; ?>
        <?php wp_reset_query(); // END RELATED POSTS ?>
        <?php endif; ?>
        
      </article>
      
      <?php endwhile; ?>
      
      <?php
      
      //----------------------//
      // COMMENTS
      //----------------------//
      
      if( of_get_option('posts_comments') != '0' || of_get_option('posts_comments') == '' )
      
      comments_template( '', true );
      
      ?>
    
    </section><!-- #content -->
    
    <?php get_sidebar(); ?>
    
<?php get_footer(); ?>