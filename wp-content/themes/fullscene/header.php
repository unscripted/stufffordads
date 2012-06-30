<?php

//--- TITLE FORMATTING ---//
global $page, $paged, $post, $posts;
$site_name = get_bloginfo( 'name', 'display' );
$site_description = get_bloginfo( 'description', 'display' );
if ( is_front_page() ){ $pt_site_title = $site_name.' | '.$site_description; }
else { $pt_site_title = wp_title( '|', false, 'right' ).' '.$site_name; }


//--- FACEBOOK FEATURED IMAGE ---//
if( is_singular() ):
  if ( has_post_thumbnail() ):
    $postThumbID = get_post_thumbnail_id( $post->ID );
    $attachments = wp_get_attachment_image_src( $postThumbID, 'full' );
    $thumbSrc = $attachments[0];
  else:
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if( isset($matches [1] [0]) ){
      $first_img = $matches [1] [0];
    }
    if(empty($first_img)){ //Defines a default image
      $first_img = "";
    }
    $thumbSrc = $first_img;
  endif;
endif;

?>
<!DOCTYPE HTML>
<html class="no-js modern" <?php language_attributes();?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type');?>; charset=<?php bloginfo('charset');?>" />

<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:image" content="<?php echo $thumbSrc; ?>" />

<!-- PAGE TITLE -->
<title><?php echo $pt_site_title;?></title>

<?php if( of_get_option('favicon') ){ ?>
<!-- FAVICON -->
<link rel="shortcut icon" href="<?php echo of_get_option('favicon');?>" type="image/x-icon" />
<?php } ?>

<?php if( of_get_option('apple_icon') ){ ?>
<!-- APPLE TOUCH DEVICES ICON -->
<link rel="apple-touch-icon" href="<?php echo of_get_option('apple_icon');?>"/>
<?php } ?>

<!-- MAIN STYLESHEET -->
<link rel="stylesheet" title="style"  type="text/css" href="<?php bloginfo('stylesheet_url');?>" media="screen" />

<!-- PINGBACK -->
<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />

<!-- HTML5/CSS3 SUPPORT FOR OLD IE BROWSERS -->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php if( is_page_template('contact.php') ): ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php endif; ?>

<!-- WP HEAD -->
<?php wp_head();?>
</head>

<body <?php body_class(); ?>>
  
  <?php if ( (of_get_option('fixed_header') == '' || of_get_option('fixed_header') == '1') && (!is_page_template('portfolio-fullscreen.php') && !is_page_template('portfolio-fullscreen-cat.php') && !is_page_template('home-fullscreen.php')) ): ?>
  <div id="page-loader"><span></span></div>
  <?php endif; ?>
  
  <div id="toTop"><span>Top</span></div>
  <div id="topbar">
  	<div id="socialbar">
	  <!-- SOCIAL LINKS -->
      
      <ul class="social-wrapper">
        <?php if( of_get_option('show_social') == '' || of_get_option('show_social') != '0' ): ?>
        <?php if( of_get_option('social_aim') ){ ?>
          <li class="aim social-link"><a href="aim:goim?screenname=<?php echo of_get_option('social_aim');?>" title="AIM">AIM</a></li>
        <?php } if( of_get_option('social_delicious') ){ ?>
          <li class="delicious social-link"><a href="<?php echo of_get_option('social_delicious');?>" title="Delicious" target="_blank">Delicious</a></li>
        <?php } if( of_get_option('social_deviant') ){ ?>
          <li class="deviant social-link"><a href="<?php echo of_get_option('social_deviant');?>" title="DeviantArt" target="_blank">DeviantArt</a></li>
        <?php } if( of_get_option('social_digg') ){ ?>
          <li class="digg social-link"><a href="<?php echo of_get_option('social_digg');?>" title="Digg" target="_blank">Digg</a></li>
        <?php } if( of_get_option('social_dribbble') ){ ?>
          <li class="dribbble social-link"><a href="<?php echo of_get_option('social_dribbble');?>" title="Dribbble" target="_blank">Dribbble</a></li>
        <?php } if( of_get_option('social_facebook') ){ ?>
          <li class="facebook social-link"><a href="<?php echo of_get_option('social_facebook');?>" title="Facebook" target="_blank">Facebook</a></li>
        <?php } if( of_get_option('social_flickr') ){ ?>
          <li class="flickr social-link"><a href="<?php echo of_get_option('social_flickr');?>" title="Flickr" target="_blank">Flickr</a></li>
        <?php } if( of_get_option('social_forrst') ){ ?>
          <li class="forrst social-link"><a href="<?php echo of_get_option('social_forrst');?>" title="Forrst" target="_blank">Forrst</a></li>
        <?php } if( of_get_option('social_gplus') ){ ?>
          <li class="gplus social-link"><a href="<?php echo of_get_option('social_gplus');?>" title="Google+" target="_blank">Google+</a></li>
        <?php } if( of_get_option('social_gtalk') ){ ?>
          <li class="gtalk social-link"><a href="gtalk:chat?jid=<?php echo of_get_option('social_gtalk');?>" title="GTalk">GTalk</a></li>
        <?php } if( of_get_option('social_lastfm') ){ ?>
          <li class="lastfm social-link"><a href="<?php echo of_get_option('social_lastfm');?>" title="Last FM" target="_blank">Last FM</a></li>
        <?php } if( of_get_option('social_linkedin') ){ ?>
          <li class="linkedin social-link"><a href="<?php echo of_get_option('social_linkedin');?>" title="LinkedIn" target="_blank">LinkedIn</a></li>
        <?php } if( of_get_option('social_myspace') ){ ?>
          <li class="myspace social-link"><a href="<?php echo of_get_option('social_myspace');?>" title="Myspace" target="_blank">Myspace</a></li>
        <?php } if( of_get_option('social_orkut') ){ ?>
          <li class="orkut social-link"><a href="<?php echo of_get_option('social_orkut');?>" title="Orkut" target="_blank">Orkut</a></li>
        <?php } if( of_get_option('social_reddit') ){ ?>
          <li class="reddit social-link"><a href="<?php echo of_get_option('social_reddit');?>" title="Reddit" target="_blank">Reddit</a></li>
        <?php } if( of_get_option('social_skype') ){ ?>
          <li class="skype social-link"><a href="skype:<?php echo of_get_option('social_skype');?>?chat" title="Skype">Skype</a></li>
        <?php } if( of_get_option('social_tumblr') ){ ?>
          <li class="tumblr social-link"><a href="<?php echo of_get_option('social_tumblr');?>" title="Tumblr" target="_blank">Tumblr</a></li>
        <?php } if( of_get_option('social_twitter') ){ ?>
          <li class="twitter social-link"><a href="<?php echo of_get_option('social_twitter');?>" title="Twitter" target="_blank">Twitter</a></li>
        <?php } if( of_get_option('social_vimeo') ){ ?>
          <li class="vimeo social-link"><a href="<?php echo of_get_option('social_vimeo');?>" title="Vimeo" target="_blank">Vimeo</a></li>
        <?php } if( of_get_option('social_wp') ){ ?>
          <li class="wp social-link"><a href="<?php echo of_get_option('social_wp');?>" title="WordPress.com" target="_blank">WordPress</a></li>
        <?php } if( of_get_option('social_yahoo') ){ ?>
          <li class="yahoo social-link"><a href="ymsgr:sendim?<?php echo of_get_option('social_yahoo');?>" title="Yahoo!">Yahoo!</a></li>
        <?php } if( of_get_option('social_youtube') ){ ?>
          <li class="youtube social-link"><a href="<?php echo of_get_option('social_youtube');?>" title="YouTube" target="_blank">YouTube</a></li>
        <?php } if( of_get_option('social_rss') ){ ?>
          <li class="rss social-link"><a href="<?php echo of_get_option('social_rss');?>" title="RSS" target="_blank">RSS</a></li>
        <?php } ?>
        <?php endif; ?>
        
        <!-- SEARCH FIELD -->
        <?php if( of_get_option('show_search') == '' || of_get_option('show_search') != '0' ){ ?>
        <li class="header-search"><form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>"><input type="text" class="field" name="s" id="s" value="" /></form></li>
        <?php } ?>
        
        <li class="clear"></li>
      </ul>

    </div>
  </div>
    
  <div id="container" style="margin-top:196px">
    
    <header id="branding" class="block-bg">
      
      <!-- SITE LOGO -->
      <?php if( of_get_option('site_logo') ): ?>
      
      <a id="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        <img alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> logo" src="<?php echo of_get_option('site_logo'); ?>" />
      </a>
      
      <?php else: ?>
      
      <a id="logo" class="logo-ph" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
      
      <?php endif; ?>
      
      <!-- AD SPOT -->
      <div id="ad-leaderboard">(728x90)</div>
      <!-- <div id="ad-banner">(468x60)</div> -->
                  
      <!-- WP NAV MENU -->
      <nav>
      <?php if (has_nav_menu('header'))
        wp_nav_menu( array(
          'container' => '',
          'theme_location' => 'header',
          'walker' => new Arrow_Walker_Nav_Menu(),
          'menu_class' => 'main-menu',
          'fallback_cb' => 'false',
          'depth'           => 0
        ));
      ?>
      </nav>
      
    </header><!-- #branding -->
