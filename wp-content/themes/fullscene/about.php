<?php
/*
Template name: About Page
*/
?>
<?php get_header(); ?>    
    
    <section id="content">
    
      <?php while ( have_posts() ) : the_post(); ?>
      
      <div id="page-title">
        
        <h1 class="entry-title"><?php the_title(); ?></h1>
        
      </div>
      
      <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper block-bg');?>>

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
        
        <?php
				if( of_get_option('show_team') == '' || of_get_option('show_team') != '0' ):
				
				// SHOW TEAM MEMBARS IF HAVE ANY
				global $post;
				$tmp_post = $post;
				$myposts = get_posts('numberposts=-1&order=DESC&orderby=post_date&post_type=team');
				if( !empty($myposts) ): ?>
				
				<div id="work-team">
					<h2 id="team-title"><?php if( of_get_option('team_label') ) echo of_get_option('team_label'); else _e('Recent Work', 'premitheme'); ?></h2>
					<ul>
						<?php
						$crop = of_get_option('crop_location');
						
						foreach( $myposts as $post ) : setup_postdata($post);
						
						$memberRole = get_post_meta($post->ID, 'memberRole', TRUE);
						$memberBio = get_post_meta($post->ID, 'memberBio', TRUE);
						$memberTwitter = get_post_meta($post->ID, 'memberTwitter', TRUE);
						$memberWeb = get_post_meta($post->ID, 'memberWeb', TRUE);
						$memberPhotoPath = get_post_meta($post->ID, 'memberImgURL', TRUE);
						$memberPhoto = pt_get_image_path( $memberPhotoPath );
						
						$bioContent = htmlspecialchars_decode($memberBio);
						
						$bioShorcode = do_shortcode($bioContent);
						
						?>
						
						<li <?php post_class('team-member-wrap');?>>
							<div class="team-member-photo"><?php echo '<img title="'.get_the_title().'" src="'.PT_FUNCTIONS.'/timthumb.php?src='.$memberPhoto.'&amp;h=180&amp;w=180&amp;zc=1&amp;q=100&amp;a='.$crop.'" alt=""/>'; ?></div>
							<h3 class="team-member-name"><?php the_title(); ?></h3>
							<h4 class="team-member-role"><?php echo $memberRole; ?></h4>
							<div class="team-member-bio">
								<p><?php echo wpautop($bioShorcode); ?></p>
							</div>
							<ul class="team-member-links">
								<?php if($memberTwitter){ ?><li class="team-member-twitter"><a href="<?php echo $memberTwitter; ?>">Follow me</a></li><?php } ?>
								<?php if($memberWeb){ ?><li class="team-member-web"><span>&middot;</span><a href="<?php echo $memberWeb; ?>">Visit website</a></li><?php } ?>
							</ul>
						</li>
						
						<?php endforeach; ?>
						<?php $post = $tmp_post;
						wp_reset_query(); ?>
						<li class="clear"></li>
					</ul>
				</div>
				<?php endif; endif;?>
        
      </article>
      
      <?php endwhile; ?>
    
    </section><!-- #content -->
    
<?php get_footer(); ?>