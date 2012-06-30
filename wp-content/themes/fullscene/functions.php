<?php
/*----------------------------------------/
  CONTENT WIDTH
/----------------------------------------*/
if ( ! isset( $content_width ) )
  $content_width = 670;
  
  
  
/*----------------------------------------/
  DEFINE PATHS
/----------------------------------------*/
define('PT_FUNCTIONS', get_template_directory_uri() . '/functions');
define('PT_FRAMEWORK', TEMPLATEPATH . '/functions');
define('PT_SHORTCODES', PT_FUNCTIONS . '/shortcodes');
define('PT_PLUGINS', PT_FRAMEWORK . '/plugins');
define('PT_JS', get_template_directory_uri() . '/js');
define('PT_CSS', get_stylesheet_directory_uri() . '/css');
define('PT_INDEX', get_stylesheet_directory_uri());
define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');




/*----------------------------------------/
  THEME VARIABLES
/----------------------------------------*/
$themename = "FullScene";
$shortname = "fs";
$folioImgWidth = __('978px', 'premitheme');
$sliderImgWidth = __('978px', 'premitheme');
$memberImgWidth = __('180x180 px', 'premitheme');




/*----------------------------------------/
  THEME SETUP
/----------------------------------------*/
if ( ! function_exists( 'pt_theme_setup' ) ):
function pt_theme_setup() {
  
  //------ Translation text domain ------//
  load_theme_textdomain( 'premitheme', TEMPLATEPATH.'/languages' );

  $locale = get_locale();
  $locale_file = TEMPLATEPATH."/languages/$locale.php";
  if ( is_readable($locale_file) )
  require_once($locale_file);
  
  
  //------ Featured Images (post thumbnail) ------//
  add_theme_support( 'post-thumbnails' );
  
  
  //------ Add default posts and comments RSS feed links to <head> section ------//
  add_theme_support( 'automatic-feed-links' );
  
  
  //------ WP menus ------//
  register_nav_menu( 'header', __( 'Main Navigation', 'premitheme' ) );
  register_nav_menu( 'footer', __( 'Footer Navigation', 'premitheme' ) );
  
  
  //------ Post Formats ------//
  add_theme_support( 'post-formats', array( 'link', 'video', 'audio', 'quote', 'gallery', 'aside', 'status' ) );
  
  
  //------ Sets the post excerpt length ------//
  function pt_excerpt_length( $length ) {
    if(is_search()){
      return 30; // Number of words
    } else {
      return 20; // Number of words
    }
  }
  add_filter( 'excerpt_length', 'pt_excerpt_length' );
  
  
  //------ "Read more" link ------//
  function pt_post_more_link() {
  return '<a class="more-link" href="'. esc_url( get_permalink() ) . '">' . __( 'Read more &raquo;', 'premitheme' ) . '</a>';
  }
  
  function pt_portfolio_more_link() {
  return '<br /><a class="more-link" href="'. esc_url( get_permalink() ) . '">' . __( 'Details +', 'premitheme' ) . '</a>';
  }
  
  
  //----- Replaces "[...]" with just "..." ------//
  function pt_excerpt_more( $more ) {
    
    if( get_post_type() == 'portfolio' ){
      return ' &hellip; '.pt_portfolio_more_link();
    } else {
      return ' &hellip; '.pt_post_more_link();
    }
  }
  add_filter( 'excerpt_more', 'pt_excerpt_more' );
    
}
endif;

add_action( 'after_setup_theme', 'pt_theme_setup' );




/*----------------------------------------/
  PLUGINS
/----------------------------------------*/

//------ UPDATES NOTIFIER ------//
require_once(PT_FRAMEWORK . '/update-notifier.php');


//------ YOUTUBE IFRAME EMBED ------//
require_once(PT_FRAMEWORK . '/plugins/iframe-embed/embed.php');


//------ TWITTER FUNCTION ------//
require_once(PT_FRAMEWORK . '/twitter-feeds-function.php');


//------ THEME OPTIONS PANEL ------//
require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');


//------ SHORTCODES ------//
require_once(PT_FRAMEWORK . '/shortcodes/shortcodes_func.php');
require_once(PT_FRAMEWORK . '/shortcodes/shortcodes.php');


//------ WIDGETS ------//
require_once(PT_FRAMEWORK . '/widget-video.php');
require_once(PT_FRAMEWORK . '/widget-twitter.php');
require_once(PT_FRAMEWORK . '/widget-flickr.php');
require_once(PT_FRAMEWORK . '/widget-posts-thumb.php');
require_once(PT_FRAMEWORK . '/widget-portfolio.php');


//------ CUSTOM POST TYPES ------//
require_once(PT_FRAMEWORK . '/post-types/slides-post-type.php');
require_once(PT_FRAMEWORK . '/post-types/portfolio-post-type.php');
require_once(PT_FRAMEWORK . '/post-types/team-post-type.php');


//------ CUSTOM METABOXES ------//
require_once(PT_FRAMEWORK . '/metaboxes/post-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/slides-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/portfolio-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/team-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/page-metaboxes.php');


//------ PAGINATION ------//
require_once(PT_FRAMEWORK . '/pagination.php');


//------ SIDEBARS ------//
require_once(PT_FRAMEWORK . '/sidebars.php');





/*----------------------------------------/
  ADD CLASS NAME FOR PARENT MENU ITEMS
/----------------------------------------*/
class Arrow_Walker_Nav_Menu extends Walker_Nav_Menu {
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (!empty($children_elements[$element->$id_field])) { 
            $element->classes[] = 'parent-menu-item'; //enter any classname you like here!
        }
        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}




/*----------------------------------------/
  COMMENTS LIST STRUCTURE
/----------------------------------------*/
if ( ! function_exists( 'pt_comment' ) ) :

function pt_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
  ?>
  <li class="pingback">
    <p><?php _e( '<span>Pingback:</span>', 'premitheme' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'premitheme' ), '<span class="edit-link">', '</span>' ); ?></p>
    
  <?php break; 
  default :
  ?>
  
  <li id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-wrapper'); ?>>
    <header class="comment-meta">
      <div class="comment-avatar">
        <?php echo get_avatar( $comment, 60 ); ?>
      </div>
      
      <div class="comment-author-name"><?php comment_author_link(); ?> <span><?php _e('Says', 'premitheme'); ?></span></div>
      
      <div class="clear"></div>
    </header><!-- .comment-meta -->
    
    <div class="comment-content">
      <?php comment_text(); ?>
      
      <?php if ( $comment->comment_approved == '0' ) : ?>
      <p><em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'premitheme'); ?></em></p>
      <?php endif; ?>
      
      <footer>
        
        <?php
        printf( __( '<span class="comment-date">On <a href="%1$s">%2$s</a></span>', 'premitheme' ),
        esc_url( get_comment_link( $comment->comment_ID ) ),
        sprintf( __( '%1$s at %2$s', 'premitheme' ), get_comment_date(), get_comment_time() )
        );
        ?>
        
        <span><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'premitheme'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
        <?php edit_comment_link( __('Edit', 'premitheme' ), '<span class="edit-link">', '</span>' ); ?>
      </footer>
    </div><!-- .comment-content -->

  <?php break;
  endswitch;
}
endif;




/*----------------------------------------------/
  FUNCTION TO CHECK IF POST HAS SHORTCODE
/----------------------------------------------*/
function has_shortcode($shortcode = '') {  
    
    if ( have_posts() ){
      $postID = get_the_ID();
      $post_to_check = get_post($postID);  
    
      // false because we have to search through the post content first  
      $found = false;  
    
      // if no short code was provided, return false  
      if (!$shortcode) {  
          return $found;  
      }  
      // check the post content for the shortcode  
      if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {  
          // we have found the short code  
          $found = true;  
      }
    
      // return our final results  
      return $found; 
    } 
}




/*----------------------------------------------/
  ENQUEUE SCRIPTS
/----------------------------------------------*/

//------ FRONT END ------//
function pt_enqueue_scripts() {

if ( !is_admin() ):
  //wp_deregister_script( 'jquery' );
  //wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js', '1.6.4', FALSE);
  wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), '1.4.8', FALSE );
  wp_register_script('topbutton', get_template_directory_uri() . '/js/topbutton.js', array('jquery', 'easing'), '1.0', TRUE );
  wp_register_script('jplayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js', array('jquery'), '2.1.0', TRUE );
  wp_register_script('reveal', get_template_directory_uri() . '/js/jquery.reveal.js', array('jquery'), '1.0', FALSE );
  wp_register_script('easing', get_template_directory_uri() . '/js/jquery.easing.min.js', array('jquery'), '1.3', FALSE );
  wp_register_script('backstretch', get_template_directory_uri() . '/js/jquery.backstretch.min.js', array('jquery'), '1.2.5', FALSE );
  wp_register_script('supersized', get_template_directory_uri() . '/js/supersized.3.2.6.min.js', array('jquery'), '3.2.6', FALSE );
  wp_register_script('supersized_shutter_home', get_template_directory_uri() . '/js/supersized.shutter.home.js', array('jquery'), '1.1', FALSE );
  wp_register_script('supersized_shutter_folio', get_template_directory_uri() . '/js/supersized.shutter.folio.js', array('jquery'), '1.1', FALSE );
  wp_register_script('mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel.js', array('jquery'), '1.1', FALSE );
  wp_register_script('mwheelintent', get_template_directory_uri() . '/js/mwheelIntent.js', array('jquery'), '1.1', FALSE );
  wp_register_script('jscrollpane', get_template_directory_uri() . '/js/jquery.jscrollpane.min.js', array('jquery'), '1.1', FALSE );
  wp_register_script('accordion', get_template_directory_uri() . '/js/jquery-ui-1.8.16.accordion.min.js', array('jquery'), '1.8.16', FALSE );
  wp_register_script('nivo', get_template_directory_uri() . '/js/jquery.nivo.slider.pack.js', array('jquery'), '2.6.1', FALSE );
  wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '2.1.0', TRUE );
  wp_register_script('masonry', get_template_directory_uri() . '/js/jquery.masonry.min.js', array('jquery'), '2.1.01', TRUE );
  wp_register_script('prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), '3.1.3', TRUE );
  wp_register_script('gridnav', get_template_directory_uri() . '/js/jquery.gridnav.js', array('jquery'), FALSE, FALSE );
  wp_register_script('validate', 'http://ajax.microsoft.com/ajax/jQuery.Validate/1.8.1/jQuery.Validate.min.js', array('jquery'), '1.8.1', TRUE);
  wp_register_script('gmap', get_template_directory_uri() . '/js/jquery.gmap.min.js', array('jquery'), '2.1', FALSE );
  wp_register_script('pt-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0', TRUE );
  

  wp_enqueue_script('jquery');
  wp_enqueue_script('superfish');
  wp_enqueue_script('prettyphoto');
  wp_enqueue_script( 'easing' );
  wp_enqueue_script( 'topbutton' );
  wp_enqueue_script('pt-custom');
  
  
  if( is_singular() ){
    global $wp_query;
    $postid = $wp_query->post->ID;
    $singularBgImg = get_post_meta($postid, 'singularBgImg', TRUE);
  }
  
  if( ( of_get_option("bg_img") && ( of_get_option("use_full_bg") == "" || of_get_option("use_full_bg") != "0" ) ) ||
  ( is_singular() && $singularBgImg ) ){
    wp_enqueue_script( 'backstretch' );
  }
  
  if( has_shortcode('slider') ||
  is_page_template('home-composition.php') ||
  is_home() ||
  is_archive() ||
  is_search() ||
  ( is_single() && get_post_format() == 'gallery' ) ||
  ( is_single() && get_post_type() == 'portfolio' ) ||
  is_page_template('blog-masonry.php') ){
    wp_enqueue_script( 'nivo' );
  }
  
  if( has_shortcode('audio') ||
  is_home() ||
  is_archive() ||
  is_search() ||
  ( is_single() && get_post_format() == 'audio' ) ||
  ( is_single() && get_post_format() == 'video' ) ||
  is_page_template('blog-masonry.php') ){
    wp_enqueue_script( 'jplayer' );
  }
  
  if( is_page_template('blog-masonry.php') ){
    wp_enqueue_script( 'masonry' );
  }
  
  if( is_page_template('home-composition.php') ){
    wp_enqueue_script( 'mousewheel' );
    wp_enqueue_script( 'gridnav' );
  }
  
  if( is_page_template('home-fullscreen.php') ){
    wp_enqueue_script( 'supersized' );
    wp_enqueue_script( 'supersized_shutter_home' );
  }
  
  if( is_page_template('portfolio-fullscreen.php') || is_page_template('portfolio-fullscreen-cat.php') ){
    wp_enqueue_script( 'supersized' );
    wp_enqueue_script( 'supersized_shutter_folio' );
    wp_enqueue_script( 'mousewheel' );
    wp_enqueue_script( 'mwheelintent' );
    wp_enqueue_script( 'jscrollpane' );
  }
  
  if( has_shortcode('tabs') ){
    wp_enqueue_script('jquery-ui-tabs');
  }
  
  if( has_shortcode('accordion') ){
    wp_enqueue_script( 'accordion' );
  }
  
  if( has_shortcode('popup') ){
    wp_enqueue_script( 'reveal' );
  }
  
  if( is_page_template('contact.php') ){
    wp_enqueue_script( 'validate' );
    wp_enqueue_script( 'gmap' );
  }
  
  if( is_page_template('portfolio-grid.php') || is_page_template('portfolio-masonry.php') || is_page_template('portfolio-grid-cat.php') || is_page_template('portfolio-masonry-cat.php') ){
    wp_enqueue_script( 'isotope' );
  }
    
  if ( is_singular() && get_option( 'thread_comments' ) ){
    wp_enqueue_script( 'comment-reply' );
  }
endif;
}    
add_action('wp_enqueue_scripts', 'pt_enqueue_scripts');


//------ ADMIN ------//

function pt_metabox_scripts() {
  wp_register_script('my-upload', PT_FUNCTIONS.'/js/my_upload.js', array('jquery','media-upload','thickbox'));
  wp_register_script('metaboxes', PT_FUNCTIONS.'/js/metaboxes_scripts.js', 'jquery');
  wp_register_script('clone-field', PT_FUNCTIONS.'/js/jquery.dynamicField-1.0.js', 'jquery');
    
    
  wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
  wp_enqueue_script('my-upload');
  wp_enqueue_script('metaboxes');
  wp_enqueue_script('clone-field');
}    
add_action('admin_print_scripts-post-new.php', 'pt_metabox_scripts');
add_action('admin_print_scripts-post.php', 'pt_metabox_scripts');




/*----------------------------------------------/
  ENQUEUE STYLES 
/----------------------------------------------*/
function pt_enqueue_styles() {

if ( !is_admin() ):
  wp_register_style('prettyphoto', get_template_directory_uri() . '/css/prettyPhoto.css' );
  wp_register_style('nivo', get_template_directory_uri() . '/css/nivo-slider.css' );
  wp_register_style('gridnav', get_template_directory_uri() . '/css/gridNavigation.css' );
  wp_register_style('gridnav_dark', get_template_directory_uri() . '/css/gridNavigation-dark.css' );
  wp_register_style('supersized', get_template_directory_uri() . '/css/supersized.css' );
  wp_register_style('supersized_dark', get_template_directory_uri() . '/css/supersized-dark.css' );
  wp_register_style('supersized_shutter_home', get_template_directory_uri() . '/css/supersized-shutter-home.css' );
  wp_register_style('supersized_shutter_home_dark', get_template_directory_uri() . '/css/supersized-shutter-home-dark.css' );
  wp_register_style('supersized_shutter_folio', get_template_directory_uri() . '/css/supersized-shutter-folio.css' );
  wp_register_style('supersized_shutter_folio_dark', get_template_directory_uri() . '/css/supersized-shutter-folio-dark.css' );
  wp_register_style('jscrollpane', get_template_directory_uri() . '/css/jquery.jscrollpane.css' );
  wp_register_style('jscrollpane_dark', get_template_directory_uri() . '/css/jquery.jscrollpane-dark.css' );
  wp_register_style('reveal', get_template_directory_uri() . '/css/reveal.css' );
  wp_register_style('dark', get_template_directory_uri() . '/css/dark.css' );
  wp_register_style('light', get_template_directory_uri() . '/css/light.css' );
  //wp_register_style('brown', get_template_directory_uri() . '/css/brown.css' );
  //wp_register_style('navy', get_template_directory_uri() . '/css/navy.css' );
    

  if( has_shortcode('image') ||
    has_shortcode('slider') ||
    ( is_single() && get_post_type() == 'portfolio' ) ||
    ( is_single() && get_post_format() == 'gallery' ) ||
    is_home() ||
    is_archive() ||
    is_search() ){
  wp_enqueue_style( 'prettyphoto' );
  }
  
  if( has_shortcode('slider') ||
    is_page_template('home-composition.php') ||
    is_home() ||
    is_archive() ||
    is_search() ||
    ( is_single() && get_post_format() == 'gallery' ) ||
    ( is_single() && get_post_type() == 'portfolio' ) ||
    is_page_template('blog-masonry.php') ){
  wp_enqueue_style( 'nivo' );
  }
  
  if( is_page_template('home-fullscreen.php') ){
    if( of_get_option('skin_color') == 'dark' ){
      wp_enqueue_style( 'supersized_dark' );
      wp_enqueue_style( 'supersized_shutter_home_dark' );
    } else {
      wp_enqueue_style( 'supersized' );
      wp_enqueue_style( 'supersized_shutter_home' );
    }
  }
  
  if( is_page_template('portfolio-fullscreen.php') || is_page_template('portfolio-fullscreen-cat.php') ){
    if( of_get_option('skin_color') == 'dark' ){
      wp_enqueue_style( 'jscrollpane_dark' );
      wp_enqueue_style( 'supersized_dark' );
      wp_enqueue_style( 'supersized_shutter_folio_dark' );
    } else {
      wp_enqueue_style( 'jscrollpane' );
      wp_enqueue_style( 'supersized' );
      wp_enqueue_style( 'supersized_shutter_folio' );
    }
  }
    
  if( has_shortcode('popup') ){
  wp_enqueue_style( 'reveal' );
  }
  
  if( is_page_template('home-composition.php') ){
    if( of_get_option('skin_color') == 'dark' ){
    wp_enqueue_style( 'gridnav_dark' );
    } else {
    wp_enqueue_style( 'gridnav' );
    }
  }
    
  if( of_get_option('skin_color') == 'dark' ){
  wp_enqueue_style('dark');
  }
//  elseif( of_get_option('skin_color') == 'navy' ){
//  wp_enqueue_style('navy');
//  }
//  elseif( of_get_option('skin_color') == 'brown' ){
//  wp_enqueue_style('brown');
//  }
  else {
  wp_enqueue_style('light');
  }
  
endif;
}
add_action('wp_print_styles', 'pt_enqueue_styles');


//------ ADMIN ------//

function pt_metabox_styles() {
    
    wp_register_style('metaboxes', PT_FUNCTIONS.'/css/metaboxes_styles.css');
    
    
    wp_enqueue_style('thickbox');
    wp_enqueue_style('metaboxes');
}
add_action('admin_print_styles-post-new.php', 'pt_metabox_styles');
add_action('admin_print_styles-post.php', 'pt_metabox_styles');



//------ THEME-OPTIONS-RELATED SCRIPTS ------//
function optionsframework_custom_scripts() { ?>
<script type="text/javascript">
jQuery(document).ready(function() {

  var socialFields = jQuery("#section-social_twitter, #section-social_facebook, #section-social_myspace, #section-social_deviant, #section-social_flickr, #section-social_linkedin, #section-social_vimeo, #section-social_youtube, #section-social_rss, #section-social_skype, #section-social_aim, #section-social_yahoo, #section-social_gtalk, #section-social_gplus, #section-social_dribbble, #section-social_digg, #section-social_delicious, #section-social_forrst, #section-social_orkut, #section-social_tumblr, #section-social_wp, #section-social_lastfm, #section-social_reddit");
  
  var description = jQuery("#section-site_description");  
  
  jQuery('#show_social').parent().click(function() {
      jQuery(socialFields).slideToggle(400);
  });
  
  jQuery('#show_description').parent().click(function() {
      jQuery(description).slideToggle(400);
  });
  
  jQuery('#recent_posts').parent().click(function() {
      jQuery("#section-recent_posts_label").slideToggle(400);
  });
  
  jQuery('#use_security').parent().click(function() {
  		jQuery("#section-security_question").slideToggle(400);
  		jQuery("#section-security_answer").slideToggle(400);
	});
	
	jQuery('#use_full_bg').parent().click(function() {
			jQuery("#section-bg_x_pos").slideToggle(400);
			jQuery("#section-bg_y_pos").slideToggle(400);
			jQuery("#section-bg_repeat").slideToggle(400);
			jQuery("#section-bg_att").slideToggle(400);
			jQuery("#section-bg_color").slideToggle(400);
	});
  
  if (jQuery('#show_social:checked').val() !== undefined) {
    jQuery(socialFields).show();
  }
  
  if (jQuery('#show_description:checked').val() !== undefined) {
    jQuery(description).show();
  }
  
  if (jQuery('#recent_posts:checked').val() !== undefined) {
    jQuery("#section-recent_posts_label").show();
  }
  
  if (jQuery('#use_security:checked').val() !== undefined) {
		jQuery("#section-security_question").show();
		jQuery("#section-security_answer").show();
	}
	
	if (jQuery('#use_full_bg:checked').val() == undefined) {
		jQuery("#section-bg_x_pos").show();
		jQuery("#section-bg_y_pos").show();
		jQuery("#section-bg_repeat").show();
		jQuery("#section-bg_att").show();
		jQuery("#section-bg_color").show();
	}
  
  
});
</script>
<?php
}
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');




/*----------------------------------------------/
  HEAD STYLES & SCRIPTS
/----------------------------------------------*/
require_once(PT_FRAMEWORK . '/head-styles.php');
require_once(PT_FRAMEWORK . '/head-scripts.php');




/*----------------------------------------/
  CUSTOM IMAGE SIZES
/----------------------------------------*/
add_image_size('blog-standard-thumb', 710, 9999);
add_image_size('page-standard-thumb', 710, 200, TRUE);
add_image_size('page-fullwidth-thumb', 978, 200, TRUE);
add_image_size('blog-related-thumb', 199, 90, TRUE);
add_image_size('folio-related-thumb', 209, 90, TRUE);
add_image_size('masonry-thumb', 320, 9999);
add_image_size('folio-grid', 320, 200, TRUE);
add_image_size('recent-thumb', 276, 100, TRUE);
add_image_size('folio-wid', 211, 142, TRUE);
add_image_size('wid-thumb', 50, 50, TRUE);
add_image_size('100x100', 100, 100, TRUE);




/*----------------------------------------/
  EXCLUDE / INCLUDE TO SEARCH QUERY
/----------------------------------------*/
function pt_search_query($query) {
  if( !is_admin() ){
    if ($query->is_search) {
      $query->set('post_type', array('post', 'page', 'portfolio'));
    }
    return $query;
  }
}

add_filter('pre_get_posts','pt_search_query');




/*----------------------------------------/
  RELATIVE TIME FUNCTION ( FOR TWITTER )
/----------------------------------------*/
define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);

function relativeTime($time)
{
  $delta = strtotime('+0 hours') - $time;
  if ($delta < 2 * MINUTE) {
    return "1 min ago";
  }
  if ($delta < 45 * MINUTE) {
    return floor($delta / MINUTE) . " min ago";
  }
  if ($delta < 90 * MINUTE) {
    return "1 hour ago";
  }
  if ($delta < 24 * HOUR) {
    return floor($delta / HOUR) . " hours ago";
  }
  if ($delta < 48 * HOUR) {
    return "yesterday";
  }
  if ($delta < 30 * DAY) {
    return floor($delta / DAY) . " days ago";
  }
  if ($delta < 12 * MONTH) {
    $months = floor($delta / DAY / 30);
    return $months <= 1 ? "1 month ago" : $months . " months ago";
  } else {
    $years = floor($delta / DAY / 365);
    return $years <= 1 ? "1 year ago" : $years . " years ago";
  }
}




/*----------------------------------------------------/
  TRUNCATE LONG TEXT STRINGS ( LIKE LONG TITLES )
/----------------------------------------------------*/
function truncate_text($string, $count, $ellipsis = TRUE){
  $words = explode(' ', $string);
  if (count($words) > $count){
    array_splice($words, $count);
    $string = implode(' ', $words);
    if (is_string($ellipsis)){
      $string .= $ellipsis;
    }
    elseif ($ellipsis){
      $string .= ' &hellip;';
    }
  }
  return $string;
}




/*----------------------------------------------------/
  GET IMAGE PATH WITH MULTISITE SUPPORT
/----------------------------------------------------*/

function pt_get_image_path($imgPath, $post_id = null) {
  if ($post_id == null && !is_search()) {
    global $post;
    $post_id = $post->ID;
  }
  $theImageSrc = $imgPath;
  global $blog_id;
  if (isset($blog_id) && $blog_id > 0) {
    $imageParts = explode('/files/', $theImageSrc);
    if (isset($imageParts[1])) {
      $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
    }
  }
  return $theImageSrc;
}




/*----------------------------------------------------/
  GET ATTACHMENT ID ACCORDING TO ITS SRC
/----------------------------------------------------*/
function pt_get_attachment_id_by_src($image_src) {

  global $wpdb;
  $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
  $id = $wpdb->get_var($query);
  return $id;

}




/*----------------------------------------------------/
  INCLUDE PORTFOLIO ITEMS IN MAIN RSS FEEDS
/----------------------------------------------------*/
if( of_get_option('folio_rss') == '' || of_get_option('folio_rss') != '0' ):
  function myfeed_request($qv) {
    if (isset($qv['feed']) && !isset($qv['post_type']))
      $qv['post_type'] = array('post', 'portfolio');
    return $qv;
  }
  add_filter('request', 'myfeed_request');
endif;



 
/*----------------------------------------------------/
  ADD LIGHTBOX SUPPORT FOR WP GALLERIES & LIKED ATTACHMENTS
/----------------------------------------------------*/

add_filter( 'wp_get_attachment_link', 'gallery_prettyPhoto');

function gallery_prettyPhoto ($content) {
  return str_replace("<a", "<a rel=\"prettyPhoto[slides]\"", $content);
}




/*----------------------------------------------------/
  ADDITIONAL BODY CLASSES
/----------------------------------------------------*/

function pt_body_classes( $classes ) {

  if ( is_page_template('home-fullscreen.php') )
    $classes[] = 'home-temp home-fullscreen';
  
  if ( is_page_template('home-composition.php') )
    $classes[] = 'home-temp home-composition';
  
  if ( is_page_template('archives.php') )
    $classes[] = 'archives-temp';
  
  if ( is_page_template('contact.php') )
    $classes[] = 'contact-temp';
  
  if ( is_page_template('about.php') )
    $classes[] = 'about-temp';
  
  if ( is_page_template('portfolio-fullscreen.php') || is_page_template('portfolio-fullscreen-cat.php') )
    $classes[] = 'folio-temp folio-fullscreen';
  
  if ( is_page_template('portfolio-masonry.php') || is_page_template('portfolio-masonry-cat.php') )
    $classes[] = 'folio-temp folio-masonry';
  
  if ( is_page_template('portfolio-grid.php') || is_page_template('portfolio-grid-cat.php') )
    $classes[] = 'folio-temp folio-grid';
  
  if ( is_page_template('fullwidth.php') )
    $classes[] = 'full-width';
  
  if ( is_page_template('blog-masonry.php') )
    $classes[] = 'blog-posts blog-masonry';
  
  if ( is_home() || ( is_archive() && get_post_type() == 'post' ) )
    $classes[] = 'blog-posts';
  
  
  if ( of_get_option('sidebar_position') == 'left' )
    $classes[] = 'left-sidebar';
  
  
  if ( of_get_option('ie_warning') == '' || of_get_option('ie_warning') != '0' )
    $classes[] = 'ie-warning';
  
  
  if ( (of_get_option('fixed_header') == '' || of_get_option('fixed_header') == '1') && (!is_page_template('portfolio-fullscreen.php') && !is_page_template('portfolio-fullscreen-cat.php') && !is_page_template('home-fullscreen.php')) )
  	$classes[] = 'fixed-header';
  
  
  if ( of_get_option('skin_color') == 'dark' ){
    $classes[] = 'dark-skin'; }
  elseif ( of_get_option('skin_color') == 'navy' ){
    $classes[] = 'navy-skin'; }
  elseif ( of_get_option('skin_color') == 'brown' ){
    $classes[] = 'brown-skin'; }
  else {
    $classes[] = 'light-skin'; }
  
  return $classes;
}
add_filter( 'body_class', 'pt_body_classes' );
