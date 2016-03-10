<?php 
get_header();
 ?> 
 
	<div id="articleLeftContainer">
    
    	<div class="bottomMenu"><?php dynamic_sidebar( 'under-menu-widget-area' ); ?></div>
    
   	  <div id="PostContain">
      					
				<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'elviralata' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'elviralata' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
            
                    
        </div><!--End Post Contain-->         
        
         <div class="articleBottomArea"><?php dynamic_sidebar( 'article-bottom-widget-area' ); ?></div>  	
    </div><!--End left Container-->
    <div id="leftRightseparetor"></div>
    <div id="articleRightContainer">
        <?php	get_sidebar(); ?>
  	</div><!--End Right Container--> 
 

                
     
<?php get_footer(); ?>