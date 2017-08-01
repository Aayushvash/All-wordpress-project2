<?php
/**
 Template name: Page with Sidebar
 */

get_header();
?>

       
	   <div class="borderBox">
	  
	  <img src="<?php bloginfo('template_directory'); ?>/images/blogo.png"/>
	   
	   </div>
	   
	   <div class="titleBox"><h2><?php the_title(); ?></h2></div>
	   
	   <!--  / banner \ -->
		<div id="banner" class="innerBanner">
			
            <?php the_post_thumbnail(); ?>

		</div>
		<!--  \ banner / -->
		
		<div class="pageSidebarBox">
		
			<div class="centerBar">
			<div class="leftpart">
			<?php if ( is_active_sidebar( 'page-left-sidebar' ) ) : ?>

				<?php dynamic_sidebar( 'page-left-sidebar' ); ?>

	             <?php endif; ?>
			</div>
			<div class="centerPart">
			
			<?php if ( have_posts() ) : ?>
                      <?php while (have_posts()) : the_post(); ?>
                      <div class="textBox">
					  
					  <?php if(get_field('title_2')) { ?><h2><?php echo get_field('title_2'); ?></h2> <?php } ?>
                      
                      <?php the_content(); ?>
					  
                      </div>
					  
		
                       <?php endwhile;  else:  endif; ?>
					  
						<div class="clear"></div>

			
			</div>
			<div class="rightpart">
			<?php if ( is_active_sidebar( 'page-right-sidebar' ) ) : ?>

				<?php dynamic_sidebar( 'page-right-sidebar' ); ?>

	             <?php endif; ?>
			</div>
			
			</div>
		
		</div>
	   

<?php get_footer(); ?>
