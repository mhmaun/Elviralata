
<?php

class custom_category_post_widget extends WP_Widget {
 
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'custom_category_post_widget', // Base ID
            'Custom Category Posts ', // Name
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
		$exclude   =  $instance['exclude'] ;
		$cat=$instance["cat"];
		

	$html_1='';
	$html_2='';
	
	 echo '<div class="heading"><h2>'.get_cat_name($cat).'</h2></div><div class="row-fluid">';

	$exclude_ids = explode(',',$exclude);
	$the_query = new WP_Query( 
    array( 
        'numberposts' => $no_of_posts, 
        'orderby' => 'DESC',
		'post_type' => 'post', 
        'cat' => $cat,
		'post__not_in' => $exclude_ids
    )
); 


$k=1;	
	
	if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
				if($k % 2!=0)
    	$html_1 .='<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
                        <p>'.get_the_excerpt(20).'</p>';
		else
		$html_2 .='<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
				<p>'.get_the_excerpt(20).'</p>';

      $k++;
	}
} else {
	$html_1 .='no posts found';
} 
		wp_reset_postdata();
		echo '<div class="span5">'.$html_1.'</div>';
		echo '<div class="span5 pull-right">'.$html_2.'</div>';
		 echo '</div>';
    }
 
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
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
        <label for="<?php echo $this->get_field_name( 'no_of_posts' ); ?>"><?php _e( 'No of Posts 2:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" type="text" value="<?php echo esc_attr( $no_of_posts); ?>" />
        </p>
          <p>
        <label for="<?php echo $this->get_field_name( 'exclude' ); ?>"><?php _e( 'Exclude Posts:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" type="text" value="<?php echo esc_attr( $exclude); ?>" />
        </p>
        
        
 <?php /*?>        <p>
        <label for="<?php echo $this->get_field_name( 'show_date' ); ?>"><?php _e( 'Show date:' ); ?></label>
        <input type="checkbox" id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>"
         <?php if($show_date==1){echo 'checked="checked"';}?>  value="1"  />
        </p><?php */?>
        
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
		
       	$instance['exclude'] = ( !empty( $new_instance['exclude'] ) ) ? strip_tags( $new_instance['exclude'] ) : '';
		$instance['cat'] = ( !empty( $new_instance['cat'] ) ) ? strip_tags( $new_instance['cat'] ) : '';
		$instance['no_of_posts'] = ( !empty( $new_instance['no_of_posts'] ) ) ? strip_tags( $new_instance['no_of_posts'] ) : '';
		$instance['show_date'] = ( !empty( $new_instance['show_date'] ) ) ? strip_tags( $new_instance['show_date'] ) : '';
		
		
        return $instance;
    }
 
}
add_action( 'widgets_init',  register_widget( 'custom_category_post_widget' ) );

?>