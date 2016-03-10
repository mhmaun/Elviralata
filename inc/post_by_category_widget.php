
<?php

class home_category_posts_widget extends WP_Widget {
 
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'home_category_posts_widget', // Base ID
            'Posts by Category', // Name
            array( 'description' => __( 'Posts by category for Home Page', 'text_domain' ), ) // Args
        );
    }
 
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
		$title =  $instance['title'] ;
	    $no_of_posts =  $instance['no_of_posts'] ;
		$show_date   =  $instance['show_date'] ;
		$cat=$instance["cat"];
		$exclude   =  $instance['exclude'] ;
		$post_type   =  $instance['post_type'] ;
		
	 $exclude_ids = explode(',',$exclude);
	 	 $_newargs= array(
		 'posts_per_page' => $no_of_posts,  
        'numberposts' => $no_of_posts, 
        'orderby' => 'DESC',
		'post_type' => $post_type,
		'post__not_in' => $exclude_ids
    );
	if($post_type=='post')
	$_newargs['cat']=$cat;

	
	$the_query1 = new WP_Query($_newargs);	
	 
	if($title!='')
	 echo '<div class="span4"><h3>'.$title.'</h3><ul>';
	else
	 echo '<div class="span4"><h3>'.get_cat_name($cat).'</h3><ul>';
	// print_r($postslist);
	 if( $the_query1->have_posts() )
 		while ( $the_query1->have_posts() ) { 
		$the_query1->the_post();
	
	?>
    <li><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title();?></a></li>
      
 <?php $k++;	if($k==10) break;} 
		 echo '</ul></div>';
    }
 
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( ' ', 'text_domain' );
        }
	if ( isset( $instance[ 'exclude' ] ) ) {
            $exclude = $instance[ 'exclude' ];
        }
        else {
            $exclude = __( '', 'text_domain' );
        }
		if ( isset( $instance[ 'no_of_posts' ] ) ) {
            $no_of_posts = $instance[ 'no_of_posts' ];
        }
        else {
            $no_of_posts = __( '2', 'text_domain' );
        }
		$post_type='';
		if ( isset( $instance[ 'post_type' ] ) ) {
            $post_type = $instance[ 'post_type' ];
        }
		/*echo '<pre>';
		print_r($instance);
		echo '</pre>';	*/	
        ?>
  
        
          <p>
Posts   <input type="radio" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>"
         <?php if($post_type=='post'){echo 'checked="checked"';}?>   value="post"  />
         
Pages  <input type="radio" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>"
         <?php if($post_type=="page"){echo 'checked="checked"';}?>  value="page"  />
        </p>
 <p>
        <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" placeholder="Enter Tilte" value="<?php echo esc_attr( $title ); ?>" />
        </p>
       
    <p>
			<label>
				<?php _e( 'Category' ); ?>:
				<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ) ); ?>
			</label>
		</p>
  
         <p>
        <label for="<?php echo $this->get_field_name( 'no_of_posts' ); ?>"><?php _e( 'No of Posts:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" type="text" value="<?php echo esc_attr( $no_of_posts); ?>" />
        </p>
          <p>
        <label for="<?php echo $this->get_field_name( 'exclude' ); ?>"><?php _e( 'Exclude Posts:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" type="text" value="<?php echo esc_attr( $exclude); ?>" />
        </p>
        
        
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
		
       	$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['post_type'] = ( !empty( $new_instance['post_type'] ) ) ? strip_tags( $new_instance['post_type'] ) : '';
       	$instance['exclude'] = ( !empty( $new_instance['exclude'] ) ) ? strip_tags( $new_instance['exclude'] ) : '';				
		$instance['cat'] = ( !empty( $new_instance['cat'] ) ) ? strip_tags( $new_instance['cat'] ) : '';
		$instance['no_of_posts'] = ( !empty( $new_instance['no_of_posts'] ) ) ? strip_tags( $new_instance['no_of_posts'] ) : '';

		
		
        return $instance;
    }
 
}
add_action( 'widgets_init',  register_widget( 'home_category_posts_widget' ) );

?>