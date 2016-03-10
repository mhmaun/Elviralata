<?php 
get_header();
 ?> 
 
	<div id="articleLeftContainer">
    
    	<div class="bottomMenu"><?php dynamic_sidebar( 'under-menu-widget-area' ); ?></div>
    
   	  				<div id="PostContain">      
      
       						<?php if (have_posts()) : ?>
								<?php while (have_posts()) : the_post(); ?>
                                  
                           			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                            <?php the_title(); ?></a></h2>
                           			    <div class="postInfo">Date: <?php the_time('d F Y') ?> |  Posted by: <?php the_author_posts_link(); ?>  |  In: <?php the_category(', ') ?> </div>                       			                                	
                                                                             
                                          
                                                                               
                                      <div class="singleArticleCont"><?php the_content(); ?></div>
                                        
                                        <?php /*?><div class="totalComments">
                                        <?php if ( comments_open() && ! post_password_required() ) : ?>
                                            <div class="comments-link">
                                                <?php comments_popup_link( '<span class="leave-reply">' . __( 'Reply', 'twentyeleven' ) . '</span>', _x( '1 Comment', 'comments number', 'twentyeleven' ), _x( '% Comments', 'comments number', 'twentyeleven' ) ); ?>
                                            </div>
                                        <?php endif; ?> 
                                     </div><!--End total comments--><?php */?>
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