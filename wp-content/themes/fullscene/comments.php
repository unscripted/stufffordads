<div id="comments" class="block-bg">
<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Sorry, You can not access this page directly!');

if ( post_password_required() ) : ?>
	<p class="password_needed"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'premitheme' ); ?></p>
</div><!-- #comments -->
<?php return;
endif;
?>

<?php if ( have_comments() ) : ?>
	
	<h3><?php
	printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'premitheme' ), number_format_i18n( get_comments_number() ) );
	?></h3>

	<ul id="comment-list">
		<?php wp_list_comments( array( 'callback' => 'pt_comment' ) ); 
		// To modify pt_comment go to pt_comment() in functions.php 
		?>
	</ul>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<div id="comment_nav_below">
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'premitheme' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'premitheme' ) ); ?></div>
	</div>
	<?php endif; ?>
	
	<?php if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed for this post.', 'premitheme' ); ?></p>
	<?php endif; ?>
	
<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed for this post.', 'premitheme' ); ?></p>
<?php endif; ?>

<?php comment_form( array( 'title_reply' => __('Leave a comment', 'premitheme') ) ); ?>

</div><!-- #comments -->
