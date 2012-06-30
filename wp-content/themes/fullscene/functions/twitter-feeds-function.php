<?php

function twitter_hyperlinks($text) {
  // Props to Allen Shaw & webmancers.com
  // match protocol://address/path/file.extension?some=variable&another=asf%
  //$text = preg_replace("/\b([a-zA-Z]+:\/\/[a-z][a-z0-9\_\.\-]*[a-z]{2,6}[a-zA-Z0-9\/\*\-\?\&\%]*)\b/i","<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
  $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
  
  // match www.something.domain/path/file.extension?some=variable&another=asf%
  //$text = preg_replace("/\b(www\.[a-z][a-z0-9\_\.\-]*[a-z]{2,6}[a-zA-Z0-9\/\*\-\?\&\%]*)\b/i","<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
  $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);    
  
  // match name@address
  $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
  
  //mach #trendingtopics. Props to Michael Voigt
  $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
  return $text;
}

function twitter_users($text) {
  $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
  return $text;
}

function twitter_fetch_feeds($username, $count) {

  include_once(ABSPATH . WPINC . '/class-simplepie.php');
  
  $feed = new SimplePie();
  $feed->set_feed_url('http://www.twitter.com/statuses/user_timeline/'.$username.'.rss');  
  $feed->set_cache_location(PT_FRAMEWORK.'/cache');  
  $feed->enable_cache(true); //disable caching  
  $feed->set_cache_duration(1800); //The number of seconds to cache for. 60 is 1 minute, 600 is 10 minutes, 900 is 15 minutes, 1800 is 30 minutes.  
  $feed->set_timeout(50);  
  $success = $feed->init();  
  $feed->handle_content_type();
  
  if ($success): ?>
  
    <ul class="twitter-feeds-container">
    
    <?php foreach ($feed->get_items(0, $count) as $item):
            
            $msg = " ".substr(strstr($item->get_title(),': '), 2, strlen($item->get_title()))." ";
            $msg = twitter_hyperlinks($msg);
            $msg = twitter_users($msg);
            
            $unix_time = $item->data["date"]["parsed"];
            $pretty_time = relativeTime($unix_time);
            
            echo '<li class="twitter-feed">';
            echo $msg;
            echo '<span>'.$pretty_time.'</span></li>';
            echo '</li>';
            
          endforeach; ?>
    
    </ul>
    
    <?php echo '<a class="follow-link" href="http://twitter.com/'.$username.'" target="_blank">Follow me</a>'; ?>
  
  <?php else: ?>
  
    <ul class="twitter-feeds-container">
      <li>Sorry, no feed found.</li>
    </ul>
  
  <?php endif;
}