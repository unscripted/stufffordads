<?php
/*
Template name: Archives Page
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
          $attr = array( 'title' => trim(strip_tags( $post->post_title )) );
          the_post_thumbnail('page-standard-thumb', $attr); ?>
        </div>
        
        <?php endif; ?>
        
        <?php if(trim($post->post_content) != '' ): ?>
        <div class="entry-content">
          <?php the_content(); ?>
          <?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
        </div>
        
        <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta">', '</div>' ); ?>
        
        <div class="clear"></div>
        <?php endif; ?>
				
				<div id="last-posts">
					<span></span>
					<h2><?php _e('Last 30 posts on the blog', 'premitheme');?></h2>
					<ol>
						<?php wp_get_archives( 'type=postbypost&limit=30' ); ?>
					</ol>
				</div>
				
				<div id="archives-by">
					
					<div id="by-month">
						<span></span>
						<h2><?php _e('Monthly Archives', 'premitheme');?></h2>
						<ul>
							<?php wp_get_archives( 'type=monthly&limit=12&show_post_count=1' ); ?>
						</ul>
					</div>
					
					<div id="by-category">
						<span></span>
						<h2><?php _e('Categories', 'premitheme');?></h2>
						<ul>
							<?php wp_list_categories( 'title_li=&show_count=1' ); ?>
						</ul>
					</div>
					
					<div id="by-author">
						<span></span>
						<h2><?php _e('Authors', 'premitheme');?></h2>
						<ul>
							<?php wp_list_authors( 'optioncount=1' ); ?>
						</ul>
					</div>
					
					<div id="by-tag">
						<span></span>
						<h2><?php _e('Tag Cloud', 'premitheme');?></h2>
						<?php wp_tag_cloud(); ?> 
					</div>
					
					<div class="clear"></div>
				</div>
        
        <div class="clear"></div>
      </article>
            
      <?php endwhile; ?>
    
    </section><!-- #content -->
    
    <?php get_sidebar(); ?>
    
<?php get_footer(); ?>