<?php
/*
Template name: Full-width Page
*/
?>
<?php get_header(); ?>    
    
    <section id="content">
    
      <?php while ( have_posts() ) : the_post(); ?>
      
      <div id="page-title">
        
        <h1 class="entry-title"><?php the_title(); ?></h1>
        
      </div>
      
      <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper page-normal block-bg');?>>

        <?php if ( has_post_thumbnail()): ?>
        
        <div class="entry-thumb">
        
          <?php
          $attr = array(
            'title' => trim(strip_tags( $post->post_title ))
          );
          
          the_post_thumbnail('page-fullwidth-thumb', $attr); ?>
        
        </div>
        
        <?php endif; ?>

        <div class="entry-content">
        
          <?php the_content(); ?>
          
          <?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
        
        </div>
        
        <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta">', '</div>' ); ?>
        
      </article>
      
      <?php
      
      //----------------------//
      // COMMENTS
      //----------------------//
      
      if( of_get_option('pages_comments') == '1' )
      
      comments_template( '', true );
      
      ?>
      
      <?php endwhile; ?>
    
    </section><!-- #content -->
    
<?php get_footer(); ?>