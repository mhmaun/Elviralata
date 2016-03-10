<?php 
get_header();
 ?> 
 
	<div id="articleLeftContainer">
    
    	<div class="bottomMenu"><?php dynamic_sidebar( 'under-menu-widget-area' ); ?></div>
    
   	  <div id="PostContain">
      
      				<div id="home-top-widget-area"><?php dynamic_sidebar( 'home-top-widget-area' ); ?></div>
                    
       						<?php if (have_posts()) : ?>
								<?php while (have_posts()) : the_post(); ?>
                           			<div class="singlePostContain">
                           			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                            <?php the_title(); ?></a></h2>
                           			<div class="postInfo">Date: <?php the_time('d F Y') ?> |  Posted by: <?php the_author_posts_link(); ?>  |  In: <?php the_category(', ') ?> </div>
                           			                                	
                                        <div class="postImgCont">
                                          <?php $pimage = get_post_meta($post->ID, 'Image', TRUE);?>
                                            <?php if (has_post_thumbnail( $post->ID ) ): ?>                                              
                                                 <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                                                <a href="<?php the_permalink() ?>" rel="bookmark">
                                                <img class="custom-bg" src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $image[0];?>&h=360&w=620&zc=1&q=100 " height="360" width="620"></a> 
                                           
                                            <?php elseif(empty($pimage)): ?>
                                            	<?php if(!catch_that_image()==""): ?>
                                                 <a href="<?php the_permalink() ?>" rel="bookmark">
                                                 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo catch_that_image() ?>&h=360&w=620&zc=1&q=100 " height="360" width="620"></a> 
                                                  <?php endif; ?>                                                 
                                            <?php endif; ?> 
                                        </div> <!--end postImgCont-->
                                          
                                          
                                                                               
                                      <div class="articleCont"><?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt,35); ?></div>
                                        
                             	</div><!--End Single Post Contain-->
                            <?php endwhile; ?> 
                            <?php endif; ?>        
        </div><!--End Post Contain-->         
        
         <div class="articleBottomArea"><?php dynamic_sidebar( 'article-bottom-widget-area' ); ?></div>  	
    </div><!--End left Container-->
    <div id="leftRightseparetor"></div>
    <div id="articleRightContainer">
        <?php	get_sidebar(); ?>
  	</div><!--End Right Container--> 
 

                
     
<?php get_footer(); ?>