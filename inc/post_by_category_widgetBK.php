
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
       $no_of_posts =  $instance['no_of_posts'] ;
		$show_date   =  $instance['show_date'] ;
		$cat=$instance["cat"];
		$exclude   =  $instance['exclude'] ;
		
	 $exclude_ids = explode(',',$exclude);
	 	 $_newargs= array( 
        'numberposts' => $no_of_posts, 
        'orderby' => 'DESC',
		'post_type' => 'post',
		'cat' => $cat, 
		'post__not_in' => $exclude_ids
    );
	$postslist = get_posts($_newargs);	 
	// $postslist = get_posts('numberposts='.$no_of_posts.'&orderby=DESC&cat='.$cat);
	 echo '<div class="span4"><h3>'.get_cat_name($cat).'</h3><ul>';
	// print_r($postslist);
	 if($postslist)
 	foreach ($postslist as $post) :
	
	?>
    <li><a href="<?php echo $post->guid; ?>"><?php echo $post->post_title;?></a></li>
      
 <?php endforeach; 
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
            $title = __( 'New title', 'text_domain' );
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
		$show_date='';
		if ( isset( $instance[ 'show_date' ] ) ) {
            $show_date = $instance[ 'show_date' ];
        }
        ?>
       
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
        
    <?php /*?>     <p>
        <label for="<?php echo $this->get_field_name( 'show_date' ); ?>"><?php _e( 'Show date:' ); ?></label>
        <input type="checkbox" id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>"
         <?php if($show_date==1){echo 'checked="checked"';}?>  value="1"  />
        </p><?php */?>
        
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
		
       	//$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
       	$instance['exclude'] = ( !empty( $new_instance['exclude'] ) ) ? strip_tags( $new_instance['exclude'] ) : '';				
		$instance['cat'] = ( !empty( $new_instance['cat'] ) ) ? strip_tags( $new_instance['cat'] ) : '';
		$instance['no_of_posts'] = ( !empty( $new_instance['no_of_posts'] ) ) ? strip_tags( $new_instance['no_of_posts'] ) : '';
		$instance['show_date'] = ( !empty( $new_instance['show_date'] ) ) ? strip_tags( $new_instance['show_date'] ) : '';
		
		
        return $instance;
    }
 
}
add_action( 'widgets_init',  register_widget( 'home_category_posts_widget' ) );

?>