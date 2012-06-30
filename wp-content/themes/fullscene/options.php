<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	global $shortname;
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $shortname;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $shortname;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories('hide_empty=0');
	$options_categories[''] = __('Select a category', 'premitheme');
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = __('Select a page', 'premitheme');
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
			
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/images/radio/';
		
	$options = array();
	


	// GENERAL SETTINGS
	//================================//
	
	$options[] = array( "name" => __("General Settings", "premitheme"),
						"type" => "heading");
	
	$options[] = array( "name" => __("Site Logo", "premitheme"),
						"desc" => __("Upload/Select image to be used as site logo. PNG, JPG or GIF images are allowed", "premitheme"),
						"id" => "site_logo",
						"type" => "upload");
	
	$options[] = array( "name" => __("Favicon", "premitheme"),
						"desc" => __("Upload/Select (ico) image 16x16 px to be used as favicon", "premitheme"),
						"id" => "favicon",
						"type" => "upload");
	
	$options[] = array( "name" => __("Apple Touch Devices Icon", "premitheme"),
						"desc" => __("Upload/Select (png) image to be used as webclip icon for apple touch devices. MUST be 57x57 px", "premitheme"),
						"id" => "apple_icon",
						"type" => "upload");
	
	$options[] = array( "name" => __("Fixed Header/Footer Position (and page loading animations)", "premitheme"),
						"desc" => __("Turn on/off fixed positioning for the header/footer and page loading animatins,", "premitheme"),
						"id" => "fixed_header",
						"std" => "1",
						"type" => "checkbox");
	
  $options[] = array( "name" => __("Global Sidebar Position", "premitheme"),
						"desc" => __("Select left/right sidebar position.", "premitheme"),
						"id" => "sidebar_position",
						"std" => "right",
						"type" => "images",
						"options" => array(
							'right' => $imagepath . 'right.png',
							'left' => $imagepath . 'left.png',
							)
						);
	
	$options[] = array( "name" => __("Global Blog Posts Comments On/Off", "premitheme"),
						"desc" => __("Turn on/off the comments for blog posts", "premitheme"),
						"id" => "posts_comments",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Global Pages Comments On/Off", "premitheme"),
						"desc" => __("Turn on/off the comments for pages", "premitheme"),
						"id" => "pages_comments",
						"std" => "0",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Header Search Field", "premitheme"),
						"desc" => __("Turn on/off the search field in the header section", "premitheme"),
						"id" => "show_search",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("\"TimThumb\" Crop Location", "premitheme"),
						"desc" => __("Select the area of image that will be cropped by \"TimThumb\", the image resizing plugin. This affects slider, portfolio previews, image shortcode, slider shortcode and gallery post format images, and doesn't affect some other images like thumbnails (featured images in general).", "premitheme"),
						"id" => "crop_location",
						"std" => "c",
						"type" => "select",
						"class" => "mini",
						"options" => array(
								"t" => __("Top", "premitheme"),
								"c" => __("Center", "premitheme"),
								"b" => __("Bottom", "premitheme"),
								)
						);
	
	$options[] = array( "name" => __("Old IE Warning Message", "premitheme"),
						"desc" => __("Turn on/off warning message for IE 8 or older versions,", "premitheme"),
						"id" => "ie_warning",
						"std" => "1",
						"type" => "checkbox");
							
	$options[] = array( "name" => __("Footer Copyright Note", "premitheme"),
						"desc" => __("Type your copy right note here. You can use some html tags like &lt;a href=\"\"&gt;&lt;/a&gt; and &lt;span class=\"\"&gt;&lt;/span&gt;", "premitheme"),
						"id" => "footer_note",
						"std" => "",
						"type" => "textarea");
	
	$options[] = array( "name" => __("Tracking Code", "premitheme"),
						"desc" => __("Paste your Google Analytics code here", "premitheme"),
						"id" => "tracking_code",
						"std" => "",
						"type" => "textarea");
	
	

	// HOME SETTINGS
	//================================//
	
	$options[] = array( "name" => __("Home Settings", "premitheme"),
						"type" => "heading");
	
	$options[] = array( "name" => __("Fullscreen Slider Options", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Slide Delay", "premitheme"),
						"desc" => __("Enter slide animation delay time in milliseconds. e.g. 3500.", "premitheme"),
						"id" => "fullscreen_home_delay",
						"std" => "3500",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array( "name" => __("Animation Effect", "premitheme"),
						"desc" => __("Select animation effect", "premitheme"),
						"id" => "fullscreen_home_effect",
						"std" => "1",
						"type" => "select",
						"class" => "mini",
						"options" => array(
								"1" => __("Fade", "premitheme"),
								"3" => __("Slide", "premitheme"),
								"6" => __("Carousel", "premitheme"),
								)
						);
	
	$options[] = array( "name" => __("Items Order", "premitheme"),
						"desc" => __("Change the order of the slider items by date or random order", "premitheme"),
						"id" => "fullscreen_home_order",
						"std" => "post_date",
						"class" => "mini",
						"type" => "select",
								"options" => array(
								"post_date" => __("By Date", "premitheme"),
								"rand" => __("Random", "premitheme")
								)
						);
	
	$options[] = array( "name" => __("Nivo Slider Options", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Slide Delay", "premitheme"),
						"desc" => __("Enter slide animation delay time in milliseconds. e.g. 3500. Enter 0 to disable auto play", "premitheme"),
						"id" => "slider_delay",
						"std" => "3500",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array( "name" => __("Animation Effect", "premitheme"),
						"desc" => __("Select animation effect", "premitheme"),
						"id" => "slider_effect",
						"std" => "random",
						"type" => "select",
						"class" => "mini",
						"options" => array(
								"random" => __("Random", "premitheme"),
								"fade" => __("Fade", "premitheme"),
								"fold" => __("Fold", "premitheme"),
								"sliceDown" => __("Slice Down", "premitheme"),
								"sliceDownLeft" => __("Slice Down Left", "premitheme"),
								"sliceUp" => __("Slice Up", "premitheme"),
								"sliceUpLeft" => __("Slice Up Left", "premitheme"),
								"sliceUpDown" => __("Slice Up Down", "premitheme"),
								"sliceUpDownLeft" => __("Slice Up Down Left", "premitheme"),
								"slideInRight" => __("Slide In Right", "premitheme"),
								"slideInLeft" => __("Slide In Left", "premitheme"),
								"boxRandom" => __("Box Random", "premitheme"),
								"boxRain" => __("Box Rain", "premitheme"),
								"boxRainReverse" => __("Box Rain Reverse", "premitheme"),
								"boxRainGrow" => __("Box Rain Grow", "premitheme"),
								"boxRainGrowReverse" => __("Box Rain Grow Reverse", "premitheme")
								)
						);
	
	$options[] = array( "name" => __("Items Order", "premitheme"),
						"desc" => __("Change the order of the slider items by date or random order", "premitheme"),
						"id" => "slider_order",
						"std" => "post_date",
						"class" => "mini",
						"type" => "select",
								"options" => array(
								"post_date" => __("By Date", "premitheme"),
								"rand" => __("Random", "premitheme")
								)
						);
	
	$options[] = array( "name" => __("Recent Work (Grid Navigation) Options", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Animation Effect", "premitheme"),
						"desc" => __("Select animation effect", "premitheme"),
						"id" => "grid_showcase_effect",
						"std" => "sequpdown",
						"class" => "mini",
						"type" => "select",
								"options" => array(
								"showhide" => __("Show Hide", "premitheme"),
								"sequpdown" => __("Sequential Up/Down","premitheme"),
								"seqfade" => __("Sequential Fade", "premitheme"),
								"disperse" => __("Disperse", "premitheme"),
								"rows" => __("Rows Move", "premitheme")
								)
						);
	
	$options[] = array( "name" => __("Items Order", "premitheme"),
						"desc" => __("Change the order of the grid showcase items by date or random order", "premitheme"),
						"id" => "grid_showcase_order",
						"std" => "post_date",
						"class" => "mini",
						"type" => "select",
								"options" => array(
								"post_date" => __("By Date", "premitheme"),
								"rand" => __("Random", "premitheme")
								)
						);
		
	$options[] = array( "name" => __("Recent Work (Row) Options", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Items Order", "premitheme"),
						"desc" => __("Change the order of recent work items by date or random order", "premitheme"),
						"id" => "recent_work_order",
						"std" => "post_date",
						"class" => "mini",
						"type" => "select",
								"options" => array(
								"post_date" => __("By Date", "premitheme"),
								"rand" => __("Random", "premitheme")
								)
						);
  
  $options[] = array( "name" => __("Recent Posts Options", "premitheme"),
						"desc" => "",
						"type" => "info");
  
  $options[] = array( "name" => __("Recent Posts Featured Image", "premitheme"),
						"desc" => __("Turn on/off featured images for home recent posts.", "premitheme"),
						"id" => "recent_thumbs",
						"std" => "0",
						"type" => "checkbox");
	
	

	// BLOG SETTINGS
	//================================//
	
	$options[] = array( "name" => __("Blog Settings", "premitheme"),
						"type" => "heading");
		
	$options[] = array( "name" => __("Related Posts", "premitheme"),
						"desc" => __("Turn on/off related posts in single post pages", "premitheme"),
						"id" => "show_related",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Sharing Buttons", "premitheme"),
						"desc" => __("Turn on/off sharing buttons in single post pages", "premitheme"),
						"id" => "sharing_on",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("AddThis Username", "premitheme"),
						"desc" => __("If you have AddThis account, enter you username", "premitheme"),
						"id" => "addthis_user",
						"std" => "",
						"class" => "mini",
						"type" => "text");
	


	// PORTFOLIO SETTINGS
	//================================//
	
	$options[] = array( "name" => __("Portfolio Settings", "premitheme"),
						"type" => "heading");
	
	$options[] = array( "name" => __("General", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Portfolio Parent Page", "premitheme"),
						"desc" => __("Select the parent portfolio page. This is necessary for some background functionality", "premitheme"),
						"id" => "folio_parent",
						"type" => "select",
						"options" => $options_pages);
	
	$options[] = array( "name" => __("Items per Page", "premitheme"),
						"desc" => __("Enter the number of portfolio items to be show per page. Leave it empty to show all items and disable portfolio pagination", "premitheme"),
						"id" => "folio_perpage",
						"std" => "",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array( "name" => __("Portfolio Permalinks Base", "premitheme"),
						"desc" => __('Customize the slug for portfolio items permalinks. This is useful if your portfolio items are something like music, products, books ...etc. e.g. "products", "music" ...etc without quotes, lowercase, <strong>AND YOU MUSTN\'T</strong> set the same value for this slug and portfolio page\'s slug to avoid permalinks and pagination issues.', "premitheme"),
						"id" => "folio_slug",
						"std" => "portfolio-items",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array( "name" => __("Filtering", "premitheme"),
						"desc" => __("Turn on/off portfolio filtering feature", "premitheme"),
						"id" => "filtering_on",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Similar Items", "premitheme"),
						"desc" => __("Turn on/off similar items in single portfolio pages", "premitheme"),
						"id" => "show_similar",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Sharing Buttons", "premitheme"),
						"desc" => __("Turn on/off sharing buttons in single portfolio pages", "premitheme"),
						"id" => "folio_sharing",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Portfolio RSS Feeds", "premitheme"),
						"desc" => __("Turn on/off portfolio items from showing up in the main RSS feeds", "premitheme"),
						"id" => "folio_rss",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Fullscreen Portfolio", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Slide Delay", "premitheme"),
						"desc" => __("Enter slide animation delay time in milliseconds. e.g. 3500.", "premitheme"),
						"id" => "fullscreen_folio_delay",
						"std" => "3500",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array( "name" => __("Animation Effect", "premitheme"),
						"desc" => __("Select animation effect", "premitheme"),
						"id" => "fullscreen_folio_effect",
						"std" => "1",
						"type" => "select",
						"class" => "mini",
						"options" => array(
								"1" => __("Fade", "premitheme"),
								"3" => __("Slide", "premitheme"),
								"6" => __("Carousel", "premitheme"),
								)
						);
	
	
	
	// TEAM SETTINGS
	//================================//
	
	$options[] = array( "name" => __("Team Settings", "premitheme"),
						"type" => "heading");
	
	$options[] = array( "name" => __("Team Section", "premitheme"),
						"desc" => __("Turn on/off team section in \"About Us\" template", "premitheme"),
						"id" => "show_team",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Team Section Label", "premitheme"),
						"desc" => __("Change the text for team section heading", "premitheme"),
						"id" => "team_label",
						"std" => __("Meet the team", "premitheme"),
						"type" => "text");
	
	
	
	// CONTACT SETTINGS
	//================================//
	
	$options[] = array( "name" => __("Contact Settings", "premitheme"),
						"type" => "heading");
	
	$options[] = array( "name" => __("General Contact Information", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Contact Address", "premitheme"),
						"desc" => __("Enter your contact address. You can add &lt;br/&gt; to break the address into multiple lines", "premitheme"),
						"id" => "contact_address",
						"std" => "",
						"type" => "textarea");
	
	$options[] = array( "name" => __("Phone Number", "premitheme"),
						"desc" => __("Enter your phone number", "premitheme"),
						"id" => "contact_phone",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => __("Fax Number", "premitheme"),
						"desc" => __("Enter your fax number", "premitheme"),
						"id" => "contact_fax",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => __("Contact Form Settings", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Contact Form Email Address (Never be published)", "premitheme"),
						"desc" => __("Enter your email address that you want the contact form to send emails to. Leave it empty to use the admin email address instead", "premitheme"),
						"id" => "contact_email",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => __("Contact Form Subject", "premitheme"),
						"desc" => __("Enter short subject for the received emails", "premitheme"),
						"id" => "contact_subject",
						"std" => "FullScene",
						"type" => "text");
	
	$options[] = array( "name" => __("Use Simple Form Security Question", "premitheme"),
						"desc" => __("Turn on/off the simple form security question.", "premitheme"),
						"id" => "use_security",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Contact Form Security Question (math calculation)", "premitheme"),
						"desc" => __("Enter a math calculation to validate that the sender is human (not robot)", "premitheme"),
						"id" => "security_question",
						"std" => "What is 2+3?",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Contact Form Security Answer (the result)", "premitheme"),
						"desc" => __("Enter the result for the calculation above. Note that the sender should use the exact answer (case sensitive)", "premitheme"),
						"id" => "security_answer",
						"std" => "5",
						"class" => "mini hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Google Map Settings", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Google Map Address", "premitheme"),
						"desc" => __("Just enter an address (e.g. \"Melbourne, Australia\" but with details, not map embed code or map link.", "premitheme"),
						"id" => "google_map",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => __("Google Map Latitude (if not using address)", "premitheme"),
						"desc" => '',
						"id" => "google_lat",
						"std" => "",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array( "name" => __("Google Map Longitude (if not using address)", "premitheme"),
						"desc" => '',
						"id" => "google_lng",
						"std" => "",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array( "name" => __("Google Map Zoom Factor", "premitheme"),
						"desc" => __("Increase/decrease google map zoom.", "premitheme"),
						"id" => "map_zoom",
						"std" => "14",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array( "name" => __("Social Links Settings", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Social Links", "premitheme"),
						"desc" => __("Turn on/off social links in the header and footer", "premitheme"),
						"id" => "show_social",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("AIM", "premitheme"),
						"desc" => __("Enter your AIM username", "premitheme"),
						"id" => "social_aim",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Delicious", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_delicious",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("DeviantArt", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_deviant",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Digg", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_digg",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Dribbble", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_dribbble",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Facebook", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_facebook",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Flickr", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_flickr",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Forrst", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_forrst",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Google Plus", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_gplus",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("GTalk", "premitheme"),
						"desc" => __("Enter your Gmail address (will not be used as email address)", "premitheme"),
						"id" => "social_gtalk",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Last FM", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_lastfm",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("LinkedIn", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_linkedin",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Myspace ", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_myspace",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Orkut", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_orkut",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Reddit", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_reddit",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("RSS", "premitheme"),
						"desc" => __("Enter your FeedBurner URL (http://feeds.feedburner.com/YOUR_URL)or any other feeds URL", "premitheme"),
						"id" => "social_rss",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Skype", "premitheme"),
						"desc" => __("Enter your Skype username", "premitheme"),
						"id" => "social_skype",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Tumblr", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_tumblr",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Twitter", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_twitter",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Vimeo", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_vimeo",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("WordPress.com", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_wp",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Yahoo", "premitheme"),
						"desc" => __("Enter your Yahoo username", "premitheme"),
						"id" => "social_yahoo",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("YouTube", "premitheme"),
						"desc" => __("Enter your profile URL", "premitheme"),
						"id" => "social_youtube",
						"std" => "",
						"class" => "hidden",
						"type" => "text");
	
	

	// STYLE SETTINGS
	//================================//
	
	$options[] = array( "name" => __("Style Settings", "premitheme"),
						"type" => "heading");
	
	$options[] = array( "name" => __("Custom Colors Settings", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Starter Skin Color", "premitheme"),
						"desc" => __("Select the light or dark skin color", "premitheme"),
						"id" => "skin_color",
						"std" => "light",
						"type" => "images",
						"options" => array(
							'light' => $imagepath . 'light.png',
							'dark' => $imagepath . 'dark.png',
							)
						);
	
	$options[] = array( "name" => __("Custom Accent Color", "premitheme"),
						"desc" => __("Select custom accent color", "premitheme"),
						"id" => "cus_accent_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => __("Site Description Color", "premitheme"),
						"desc" => __("Select custom color for site description/welcome message (if used)", "premitheme"),
						"id" => "description_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => __("Custom Background Settings", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Custom Background Image", "premitheme"),
						"desc" => __("Select/upload custom background image", "premitheme"),
						"id" => "bg_img",
						"type" => "upload");
	
	$options[] = array( "name" => __("Fullscreen Background", "premitheme"),
						"desc" => __("Turn on/off the fullscreen background option", "premitheme"),
						"id" => "use_full_bg",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Background X position", "premitheme"),
						"desc" => __("Enter \"left\", \"center\", \"right\" or value prefixed with \"px\" like \"200px\". All without quotes.", "premitheme"),
						"id" => "bg_x_pos",
						"class" => "mini hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Background Y position", "premitheme"),
						"desc" => __("Enter \"top\", \"center\", \"bottom\" or value prefixed with \"px\" like \"200px\". All without quotes.", "premitheme"),
						"id" => "bg_y_pos",
						"class" => "mini hidden",
						"type" => "text");
	
	$options[] = array( "name" => __("Background Image Repeat", "premitheme"),
						"desc" => __("Select background image repeat option.", "premitheme"),
						"id" => "bg_repeat",
						"std" => "0",
						"type" => "select",
						"class" => "mini hidden",
						"options" => array(
								"0" => __("Select...", "premitheme"),
								"no-repeat" => __("No repeat", "premitheme"),
								"repeat" => __("Repeat all (Tile)", "premitheme"),
								"repeat-x" => __("Repeat Horizontally", "premitheme"),
								"repeat-y" => __("Repeat Vertically", "premitheme")
								)
						);
	
	$options[] = array( "name" => __("Background Image Attachment", "premitheme"),
						"desc" => __("Select background image attachment, fixed or scrollable.", "premitheme"),
						"id" => "bg_att",
						"std" => "0",
						"type" => "select",
						"class" => "mini hidden",
						"options" => array(
								"0" => __("Select...", "premitheme"),
								"fixed" => __("Fixed", "premitheme"),
								"scroll" => __("Scrollable", "premitheme")
								)
						);
	
	$options[] = array( "name" => __("Custom Background Color", "premitheme"),
						"desc" => __("Select custom background color", "premitheme"),
						"id" => "bg_color",
						"std" => "",
						"class" => "hidden",
						"type" => "color");
	
	$options[] = array( "name" => __("Custom Font Settings", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Custom @Font-Face Stylesheet", "premitheme"),
						"desc" => __("Paste the entire <code>&lt;link&gt;</code> tag of Google web font's (or custom @font-face) stylesheet.", "premitheme"),
						"id" => "cus_font_stylesheet",
						"std" => "",
						"type" => "textarea");
	
	$options[] = array( "name" => __("Custom @Font-Face CSS Font Family", "premitheme"),
						"desc" => __("Paste the CSS rule for the font family. e.g. <code>font-family: 'Font Name';</code> ", "premitheme"),
						"id" => "cus_font_family",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => __("Custom CSS Settings", "premitheme"),
						"desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => __("Custom CSS", "premitheme"),
						"desc" => __("Need to style specific elements? paste your custom css here", "premitheme"),
						"id" => "custom_css",
						"std" => "",
						"type" => "textarea");
	
	return $options;
}