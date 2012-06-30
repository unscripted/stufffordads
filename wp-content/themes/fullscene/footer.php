    <div class="clear"></div>
    
    <!-- FOOTER WIDGETS AREA -->
    <?php if (!is_page_template('home-fullscreen.php') &&
              !is_page_template('portfolio-fullscreen.php') &&
              !is_page_template('portfolio-fullscreen-cat.php'))
              
              get_sidebar('footer');
    ?>
    
    <footer id="ending" class="block-bg">
      
      <?php if (is_page_template('home-fullscreen.php') || is_page_template('portfolio-fullscreen.php') || is_page_template('portfolio-fullscreen-cat.php')): ?>
      
      <!--Time Bar-->
    	<div id="progress-back" class="load-item">
    		<div id="progress-bar"></div>
    	</div>
      
      <!--Slide counter-->
      <div id="slidecounter">
				<span class="slidenumber"></span> / <span class="totalslides"></span>
			</div>
			
			<!--Play/Pause button-->
    	<a id="play-button"></a>
    	
    	<!--Thumb Tray button-->
      <a id="tray-button"></a>
      
      <!--Arrow Navigation-->
    	<a id="prevslide" class="load-item"></a>
    	<a id="nextslide" class="load-item"></a>
      
      <?php else: ?>
      
      <!-- COPYRIGHT NOTE -->
      <div id="copyright">
        <?php if( of_get_option('footer_note') ): echo of_get_option('footer_note'); else: ?>
        &copy; 2011, Premium WordPress theme by <a href="http://premitheme.com">premitheme</a>. Sold exclusively on <a href="http://themeforest.net/user/premitheme/portfolio?WT.ac=item_portfolio&WT.seg_1=item_portfolio&WT.z_author=premitheme&ref=premitheme">ThemeForest.net</a>
        <?php endif; ?>
      </div>
      
      <!-- FOOTER WP NAV MENU -->
      <?php if (has_nav_menu('footer')): ?>
      <div id="footer-nav">
        <?php wp_nav_menu( array(
          'container' => '',
          'theme_location' => 'footer',
          'menu_class' => 'footer-menu',
          'fallback_cb' => 'false',
          'before'     => '<span>/</span>',
          'depth'           => 1
        )); ?>
      </div>
      <?php endif; ?>
      <?php endif; ?>
      
      <div class="clear"></div>
      
    </footer><!-- #ending -->
  </div>

<!-- WP FOOTER -->
<?php wp_footer();?>
</body>
</html>