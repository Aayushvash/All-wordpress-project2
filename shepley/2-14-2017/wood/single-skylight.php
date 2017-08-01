<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>


	   
	   <?php if(get_field('add_shortcode')) { ?>
	   <div class="innerSlider">
         <?php echo do_shortcode(get_field('add_shortcode')); ?>
		 
		  <div class="borderBox">
	  
	  <img src="<?php bloginfo('template_directory'); ?>/images/blogo.png"/>
	   
	   </div>
	   
	   <div class="titleBox"><h2><?php the_title(); ?></h2></div>
		 </div>
	  <?php }else { ?>
	    <div class="borderBox">
	  
	  <img src="<?php bloginfo('template_directory'); ?>/images/blogo.png"/>
	   
	   </div>
	   
	   <div class="titleBox"><h2><?php the_title(); ?></h2></div>
	   <!--  / banner \ -->
		<div id="banner" class="innerBanner">
			
            <?php the_post_thumbnail(); ?>

		</div>
		<!--  \ banner / -->
	   <?php } ?>
		
		
			<div class="centerBar">
		
			<div class="fullwidth">
			
			<?php if ( have_posts() ) : ?>
                      <?php while (have_posts()) : the_post(); ?>

					  <div class="textBox">
					  
					
                      
                      <?php the_content(); ?>
					  
                      </div>
					  
                       <?php endwhile;  else:  endif; ?>
					  
						<div class="clear"></div>

			
			</div>
			
			
			</div>
		
		
	   

<?php get_footer(); ?>
