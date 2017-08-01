<?php
/**
 Template name: Skylight Page
 */

get_header();
?>
	   <?php if(get_field('add_shortcode')) { ?>
	   <div class="innerSlider">
         <?php echo do_shortcode(get_field('add_shortcode')); ?>
		 
		  <div class="borderBox">
	  
	  <img src="<?php bloginfo('template_directory'); ?>/images/blogo.png"/>
	   
	   </div>
	   
	   <div class="titleBox"><h2><?php the_title(); ?></h2></div>
		 </div>
	  <?php }else { ?>
	  	<div id="banner" class="innerBanner">
			
            <?php the_post_thumbnail(); ?>

		</div>
		<!--  \ banner / -->
	  
	    <div class="borderBox">
	  
	  <img src="<?php bloginfo('template_directory'); ?>/images/blogo.png"/>
	   
	   </div>
	   
	   <div class="titleBox"><h2><?php the_title(); ?></h2></div>
	 
	   <?php } ?>

 <!--  / banner \ -->
		
	   
	  
		
		<div class="skylightBox">
		
			<div class="centerBar">
			
				<ul>

				<?php $s=1;
				query_posts('post_type=skylight&showposts=-1');
				if ( have_posts() ) : ?>
				<?php while (have_posts()) : the_post(); ?>

					<li class="<?php if($s%4==0) { echo "last"; } ?>">

						<a href="<?php if(get_field('external_link')) { echo get_field('external_link'); }else { the_permalink(); } ?>"><?php the_post_thumbnail('s-img'); ?></a>
						<h2><?php the_title(); ?></h2>
						<a class="moreinfo" href="<?php if(get_field('external_link')) { echo get_field('external_link'); }else { the_permalink(); } ?>">More info +</a>

					</li>

					<?php if($s%4==0) { echo "<div class='clear'></div>"; } ?>
					
				<?php $s++; endwhile;  else:  endif; ?>


				</ul>
			
			
			</div>
		
		</div>
	   

<?php get_footer(); ?>
