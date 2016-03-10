<?php 
get_header();
 ?> 
 
	<div id="articleLeftContainer">
    
    	<div class="bottomMenu"><?php dynamic_sidebar( 'under-menu-widget-area' ); ?></div>
    
   	  <div id="PostContain">
      	
        <?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="page-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'elviralata' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'elviralata' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'elviralata' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
					else :
						_e( 'Archives', 'elviralata' );
					endif;
				?></h1>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */ while (have_posts()) : the_post(); ?>
                           			<div class="serchPostContain">
                           			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                            <?php the_title(); ?></a></h2>
                                      <div class="articleCont">
									  	<?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt,35); ?>
                                      	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                            Read More...</a>
                                      </div>
                             	</div><!--End Single Post Contain-->
                            <?php endwhile; ?> 

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>				
				       
      </div><!--End Post Contain-->         
        
         <div class="articleBottomArea"><?php dynamic_sidebar( 'article-bottom-widget-area' ); ?></div>  	
    </div><!--End left Container-->
    <div id="leftRightseparetor"></div>
    <div id="articleRightContainer">
        <?php	get_sidebar(); ?>
  	</div><!--End Right Container--> 
 

                
     
<?php get_footer(); ?>