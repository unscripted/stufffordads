<?php get_header();?>
	
	<section id="content">
		<?php if ( have_posts() ) : ?>
			
			<div id="page-title">
        <h1><?php printf( __( 'Search Results for: %s', 'premitheme' ), get_search_query() ); ?></h1>
      </div>
			
			<?php while ( have_posts() ) : the_post(); ?>
			
			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper block-bg');?>>
				<h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
				
				<div class="entry-content">
          <?php the_excerpt(); ?>
        </div>
				
				<div class="entry-meta">
          <span title="<?php echo get_the_time(); ?>"><?php echo get_the_date(); ?></span>
        </div>
			</article>
			
			<?php endwhile;
			
			// PAGINATION
			if(function_exists('wp_pagenavi')): wp_pagenavi();
			elseif (function_exists('wp_corenavi')): wp_corenavi();
			else: pt_content_nav('nav_below');
			endif; ?>
			
		<?php else: ?>
			
			<article id="post-0" class="entry-wrapper block-bg">
				<h2 class="entry-title"><?php _e('Nothing found', 'premitheme'); ?></h2>
				
				<div class="entry-content">
					<p><?php _e('Sorry, no posts were found.', 'premitheme'); ?></p>
				</div>
				
				<?php get_search_form(); ?>
			</article>
			
		<?php endif; ?>
	</section><!-- #content -->
    
    <?php get_sidebar(); ?>
    
<?php get_footer(); ?>