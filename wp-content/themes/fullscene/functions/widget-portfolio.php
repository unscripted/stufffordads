<?php

add_action( 'widgets_init', 'pt_portfolio_widget' );

function pt_portfolio_widget() {
	register_widget( 'Portfolio_Widget' );
}


class Portfolio_Widget extends WP_Widget {
	
	function Portfolio_Widget() {
		global $themename;
		
		$widget_ops = array( 'classname' => 'widget-portfolio', 'description' => __('Show your recent work', 'premitheme') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'portfolio-widget' ); //default width = 250
		$this->WP_Widget( 'portfolio-widget', $themename.' - '.__('Recent Work (Portfolio)', 'premitheme'), $widget_ops, $control_ops );
		
		function pt_enqueue_folio_wid_scripts() {
		  wp_register_script('jcarousel', get_template_directory_uri() . '/js/jquery.jcarousel.min.js', 'jquery', '0.2.8', TRUE );
		  wp_enqueue_script( 'easing' );
		  wp_enqueue_script('jcarousel');
		}
				
		if ( is_active_widget(false, false, $this->id_base) ){
      add_action( 'wp_enqueue_scripts', 'pt_enqueue_folio_wid_scripts' );
    }
	}


/*-------------------------------/
	UPDATE & SAVE SETTINGS
/-------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		
		return $instance;
	}
	
	
/*-------------------------------/
	RENDER WIDGET
/-------------------------------*/
	function widget($args, $instance) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$category = $instance['category'];
		$count = $instance['count'];
		
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title; ?>
		
		<ul class="jcarousel-skin-folio-wid">
		<?php
		global $post;
		$tmp_post = $post;
		
		if($count == '') $count = '-1';
		
		if($category != 'all'):
  		$args = array(
  			'posts_per_page' => $count,
  			'post_type' => 'portfolio',
  			'tax_query' => array(
  		    array(
  		      'taxonomy' => 'portfolio_cats',
  		      'field' => 'id',
  		      'terms' => array($category),
  		      'operator' => 'IN'
  		    )
  			)
  		);
    else:
    	$args = array(
  			'posts_per_page' => $count,
  			'post_type' => 'portfolio'
  		);
    endif;
		
		$myposts = get_posts($args);
		
		foreach( $myposts as $post ) : setup_postdata($post);
		
		$imgAtt = array( 'title' => trim(strip_tags( $post->post_title )) ); 
		
		$folio_cats =  get_the_terms( get_the_ID(), 'portfolio_cats' );
    $cat_name = '';
    $cats_names = array();
    if( !empty($folio_cats) ):
      foreach( $folio_cats as $folio_cat ):
        $cats_names[] = $folio_cat->name;
      endforeach; 
      $cat_name = join( ', ', $cats_names );
    endif;
		?>
		
			<li>
				<a href="<?php the_permalink();?>">
					<div class="folio-wid-thumb">
  					<?php if ( has_post_thumbnail()):
              the_post_thumbnail('folio-wid', $imgAtt);
            else:?>
              <img src="<?php echo get_template_directory_uri();?>/images/no-image-211x142.png" alt="No Image"/>
            <?php endif;?>
          </div>
					
					<div class="folio-wid-overlay">
  					<h6 title="<?php echo get_the_title(); ?>"><?php the_title(); ?></h6>
  					<span><?php echo $cat_name; ?></span>
					</div>
					
					<div class="clear"></div>
				</a>
			</li>
			
		<?php 
		endforeach;
		$post = $tmp_post; ?>
		</ul>
		
		<?php echo $after_widget;
	}
	
	
/*-------------------------------/
	WIDGET SETTINGS
/-------------------------------*/
	function form($instance) {
		$defaults = array( 'title' => 'Recent Work', 'category' => 'all', 'count' => '5');
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$folioCats = get_categories('taxonomy=portfolio_cats');
		
		?>
		
		<p>
			<label><?php _e('Title', 'premitheme');?>:
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
			</label>
		</p>
		
		<p>
			<label><?php _e('Portfolio Category', 'premitheme');?>:
			<select class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
  			<option value="all" <?php selected( 'all', $instance['category'] ); ?>><?php _e('Show all', 'premitheme');?></option>
  			<?php foreach ( $folioCats as $folio_cat ): ?>
  			 <option value="<?php echo $folio_cat->cat_ID; ?>" <?php selected( $folio_cat->cat_ID, $instance['category'] ); ?>><?php echo $folio_cat->cat_name; ?></option>
  		  <?php endforeach; ?>
			</select>
			</label>
		</p>
		
		<p>
			<label><?php _e('No. of items (leave empty to show all)', 'premitheme');?>:
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" type="text" size="3"/>
			</label>
		</p>
		
		<?php		
	}
}
