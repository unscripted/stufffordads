<?php
/*
Template name: Home Page - Composition
*/

$section1 = get_post_meta($post->ID, 'firstSection', TRUE);
$section2 = get_post_meta($post->ID, 'secondSection', TRUE);
$section3 = get_post_meta($post->ID, 'thirdSection', TRUE);
$section4 = get_post_meta($post->ID, 'fourthSection', TRUE);
$section5 = get_post_meta($post->ID, 'fifthSection', TRUE);
$section6 = get_post_meta($post->ID, 'sixthSection', TRUE);

?>
<?php get_header(); ?>    
    
    <section id="content">
      
      <?php while ( have_posts() ) : the_post(); ?>
      
        <?php if( $section1 && $section1 != '0' ): ?>
          <?php if( $section1 == 'custom' ): ?>
            <?php // SHOW CONTENT IF NOT EMPTY
      			if(trim($post->post_content) != '' ): ?>
      			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper block-bg');?>>
        			<div class="entry-content">
        				<?php the_content(); ?>
        				
        				<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
        				
        				<div class="footer-entry-meta">
        				<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link">', '</span>' ); ?>
        				</div>
        			</div>
      			</article>
      			<?php endif; ?>
      		<?php else: ?>
      		  <?php get_template_part( 'includes/'.$section1 ); ?>
          <?php endif; ?>
        <?php endif; ?>
        
        <?php if( $section2 && $section2 != '0' ): ?>
          <?php if( $section2 == 'custom' ): ?>
            <?php // SHOW CONTENT IF NOT EMPTY
      			if(trim($post->post_content) != '' ): ?>
      			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper block-bg');?>>
        			<div class="entry-content">
        				<?php the_content(); ?>
        				
        				<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
        				
        				<div class="footer-entry-meta">
        				<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link">', '</span>' ); ?>
        				</div>
        			</div>
      			</article>
      			<?php endif; ?>
      		<?php else: ?>
      		  <?php get_template_part( 'includes/'.$section2 ); ?>
          <?php endif; ?>
        <?php endif; ?>
        
        <?php if( $section3 && $section3 != '0' ): ?>
          <?php if( $section3 == 'custom' ): ?>
            <?php // SHOW CONTENT IF NOT EMPTY
      			if(trim($post->post_content) != '' ): ?>
      			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper block-bg');?>>
        			<div class="entry-content">
        				<?php the_content(); ?>
        				
        				<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
        				
        				<div class="footer-entry-meta">
        				<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link">', '</span>' ); ?>
        				</div>
        			</div>
      			</article>
      			<?php endif; ?>
      		<?php else: ?>
      		  <?php get_template_part( 'includes/'.$section3 ); ?>
          <?php endif; ?>
        <?php endif; ?>
        
        <?php if( $section4 && $section4 != '0' ): ?>
          <?php if( $section4 == 'custom' ): ?>
            <?php // SHOW CONTENT IF NOT EMPTY
      			if(trim($post->post_content) != '' ): ?>
      			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper block-bg');?>>
        			<div class="entry-content">
        				<?php the_content(); ?>
        				
        				<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
        				
        				<div class="footer-entry-meta">
        				<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link">', '</span>' ); ?>
        				</div>
        			</div>
      			</article>
      			<?php endif; ?>
      		<?php else: ?>
      		  <?php get_template_part( 'includes/'.$section4 ); ?>
          <?php endif; ?>
        <?php endif; ?>
        
        <?php if( $section5 && $section5 != '0' ): ?>
          <?php if( $section5 == 'custom' ): ?>
            <?php // SHOW CONTENT IF NOT EMPTY
      			if(trim($post->post_content) != '' ): ?>
      			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper block-bg');?>>
        			<div class="entry-content">
        				<?php the_content(); ?>
        				
        				<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
        				
        				<div class="footer-entry-meta">
        				<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link">', '</span>' ); ?>
        				</div>
        			</div>
      			</article>
      			<?php endif; ?>
      		<?php else: ?>
      		  <?php get_template_part( 'includes/'.$section5 ); ?>
          <?php endif; ?>
        <?php endif; ?>
        
        <?php if( $section6 && $section6 != '0' ): ?>
          <?php if( $section6 == 'custom' ): ?>
            <?php // SHOW CONTENT IF NOT EMPTY
      			if(trim($post->post_content) != '' ): ?>
      			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper block-bg');?>>
        			<div class="entry-content">
        				<?php the_content(); ?>
        				
        				<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
        				
        				<div class="footer-entry-meta">
        				<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link">', '</span>' ); ?>
        				</div>
        			</div>
      			</article>
      			<?php endif; ?>
      		<?php else: ?>
      		  <?php get_template_part( 'includes/'.$section6 ); ?>
          <?php endif; ?>
        <?php endif; ?>
        
      <?php endwhile; ?>
    
    </section><!-- #content -->
    
<?php get_footer(); ?>