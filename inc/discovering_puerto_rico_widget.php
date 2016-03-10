<?php

class sidebar_recentposts_widget extends WP_Widget {
 
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'sidebar_recentposts_widget', // Base ID
            'Discovering Puerto Rico', // Name
            array( 'description' => __( 'Discovering Puerto Rico Posts', 'text_domain' ), ) // Args
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
        $title = apply_filters( 'widget_title', $instance['title'] );
		$no_of_posts =  $instance['no_of_posts'] ;
		$show_date   =  $instance['show_date'] ;
		$exclude   =  $instance['exclude'] ;
		
 
       // echo $before_widget;
        if ( ! empty( $title ) )
		{
			//echo '<div class="heading"><h2>'.$title.'</h2></div>';
			echo $before_title . $title . $after_title;
			
			}
     
	 $exclude_ids = explode(',',$exclude);
	 $_args= array( 
        'numberposts' => $no_of_posts, 
        'orderby' => 'DESC',
		'post_type' => 'post', 
		'post__not_in' => $exclude_ids
    );
	// $postslist = get_posts('numberposts='.$no_of_posts.'&orderby=DESC');
	 $postslist = get_posts($_args);	 
	 echo '<div class="thumb clearfix"><ul>';
	// print_r($postslist);
	 if($postslist)
 	foreach ($postslist as $post) :
   // setup_postdata($post); 
	 $imgSmall=(wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'small'));
	
	?>
    <li>
                    	<img src="<?php bloginfo("template_url"); ?>/img/img-tag.png" alt="" class="tag" />
                        <div class="img">
                        <a class="thumbnail" href="<?php echo $post->guid; ?>">
			              <img src="<?php if($imgSmall[0]!=''){echo $imgSmall[0];} else{ echo 'http://www.icoquito.com/wp-content/themes/iCoquito2/images/icoquitotalk.png';}  ?>">
            			</a>
                        </div>
                        <span><a href="<?php echo $post->guid; ?>"><?php echo truncateStringWords($post->post_title,30);?></a></span>
                    </li>
     
      
 <?php endforeach; 
		 echo '</ul></div>';
	//  echo $after_widget;
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
        <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    
  
         <p>
        <label for="<?php echo $this->get_field_name( 'no_of_posts' ); ?>"><?php _e( 'No of Posts:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" type="text" value="<?php echo esc_attr( $no_of_posts); ?>" />
        </p>
           <p>
        <label for="<?php echo $this->get_field_name( 'exclude' ); ?>"><?php _e( 'Exclude Posts:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" type="text" value="<?php echo esc_attr( $exclude); ?>" />
        </p>
 <?php /*?>       
         <p>
        <label for="<?php echo $this->get_field_name( 'show_date' ); ?>"><?php _e( 'Show date:' ); ?></label>
        <input type="checkbox" id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>"
         <?php if($show_date==1){echo 'checked="checked"';}?>  value="1"  />
        </p><?php */?>
        
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
       	$instance['exclude'] = ( !empty( $new_instance['exclude'] ) ) ? strip_tags( $new_instance['exclude'] ) : '';		
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['no_of_posts'] = ( !empty( $new_instance['no_of_posts'] ) ) ? strip_tags( $new_instance['no_of_posts'] ) : '';
		$instance['show_date'] = ( !empty( $new_instance['show_date'] ) ) ? strip_tags( $new_instance['show_date'] ) : '';
		
		
        return $instance;
    }
 
}
add_action( 'widgets_init',  register_widget( 'sidebar_recentposts_widget' ) );

?>