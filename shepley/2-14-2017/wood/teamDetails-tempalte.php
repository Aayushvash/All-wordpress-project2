<?php
/**
 Template name: Team Details Template
 */

get_header();
?>
 <!--  / banner \ -->
 <?php if(has_post_thumbnail()) { ?>
		<div id="banner" class="innerBanner">
			
            <?php the_post_thumbnail(); ?>

		</div>
		<?php } ?>
		<!--  \ banner / -->
       
	   <div class="borderBox">
	  
	   <img src="<?php bloginfo('template_directory'); ?>/images/blogo.png"/>
	   
	   </div>
	   
	   <div class="titleBox"><h2><?php the_title(); ?></h2></div>
	   
	  
		
		<div class="temDetailBox">
		
			<div class="centerBar">
			

				<?php if ( have_posts() ) : ?>
				<?php while (have_posts()) : the_post(); ?>

					<?php the_content(); ?>
								
				<?php endwhile;  else:  endif; ?>


			
			</div>
		
		</div>
	   

<?php get_footer(); ?>
