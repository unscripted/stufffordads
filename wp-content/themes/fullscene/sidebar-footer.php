<?php
// Check if any of the areas have widgets
	if (   ! is_active_sidebar( 'sidebar-4'  )
		&& ! is_active_sidebar( 'sidebar-5' )
		&& ! is_active_sidebar( 'sidebar-6'  )
		&& ! is_active_sidebar( 'sidebar-7'  )
	)
		return;
// If we get this far, we have widgets. Let do this.
?>
<section id="footer-widgets" <?php premi_footer_sidebar_class(); ?>>
		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
		<div id="footer-first" class="widget-area">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		</div><!-- #footer-first -->
		<?php endif; ?>
	
		<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
		<div id="footer-second" class="widget-area">
			<?php dynamic_sidebar( 'sidebar-5' ); ?>
		</div><!-- #footer-second -->
		<?php endif; ?>
	
		<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
		<div id="footer-third" class="widget-area">
			<?php dynamic_sidebar( 'sidebar-6' ); ?>
		</div><!-- #footer-third -->
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'sidebar-7' ) ) : ?>
		<div id="footer-fourth" class="widget-area">
			<?php dynamic_sidebar( 'sidebar-7' ); ?>
		</div><!-- #footer-fourth -->
		<?php endif; ?>
		
		<div class="clear"></div>
</section><!-- footer-widgets -->