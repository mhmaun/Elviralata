<?php 
get_header();
 ?> 
 
	<div id="articleLeftContainer">
    
    	<div class="bottomMenu"><?php dynamic_sidebar( 'under-menu-widget-area' ); ?></div>
    
   	  <div id="PostContain">
      					
				<h1 class="page-title"><?php printf( __( 'Category Archives: %s', 'elviralata' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
      
       						<?php if (have_posts()) : ?>
                            
								<?php while (have_posts()) : the_post(); ?>
                           			<div class="serchPostContain">
                           			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                            <?php the_title(); ?></a></h2>
                                      <div class="articleCont">
									  	<?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt,35); ?>
                                      	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                            Read More...</a>
                                      </div>
                                        
                                        <?php /*?><div class="totalComments">
                                        <?php if ( comments_open() && ! post_password_required() ) : ?>
                                            <div class="comments-link">
                                                <?php comments_popup_link( '<span class="leave-reply">' . __( 'Reply', 'twentyeleven' ) . '</span>', _x( '1 Comment', 'comments number', 'twentyeleven' ), _x( '% Comments', 'comments number', 'twentyeleven' ) ); ?>
                                            </div>
                                        <?php endif; ?> 
                                     </div><?php */?><!--End total comments-->
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