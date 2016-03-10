<?php 
get_header();
 ?> 
 
	<div id="articleLeftContainer">
    
    	<div class="bottomMenu"><?php dynamic_sidebar( 'under-menu-widget-area' ); ?></div>
    
   	  <div id="PostContain">
      					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'elviralata' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
      
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