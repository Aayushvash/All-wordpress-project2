<?php
/**
 Template name: Product page
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
		
		<div class="productBox">
		
			<div class="centerBar">
			<div class="leftpart">
			<?php if ( is_active_sidebar( 'product-left-sidebar' ) ) : ?>

				<?php dynamic_sidebar( 'product-left-sidebar' ); ?>

	             <?php endif; ?>
			</div>
			<div class="centerPart">
			
			<?php if ( have_posts() ) : ?>
                      <?php while (have_posts()) : the_post(); ?>
                      <div class="textBox">
					  
					  <?php if(get_field('title_2')) { ?><h2><?php echo get_field('title_2'); ?></h2> <?php } ?>
                      
                      <?php the_content(); ?>
					  
                      </div>
					  
					  <div class="logoBar">
					  <?php if( have_rows('add_custom_content') ): ?>

	<ul>

	<?php $s=1; while( have_rows('add_custom_content') ): the_row(); 

		// vars
		$image = get_sub_field('add_image_');
		
		$link = get_sub_field('image_link');

		?>

					<li class="<?php if($s%3==0) { echo "last"; } ?>">

						<a href="<?php echo $link; ?>"><img src="<?php echo $image['sizes']['blog-img5']; ?>"></a>
						
						<a class="moreinfo" href="<?php echo $link; ?>">More info +</a>

					</li>

	<?php $s++; endwhile; ?>

	</ul>

<?php endif; ?>
					  </div>
                       <?php endwhile;  else:  endif; ?>
					  
						<div class="clear"></div>

			
			</div>
			<div class="rightpart">
			<?php if ( is_active_sidebar( 'product-right-sidebar' ) ) : ?>

				<?php dynamic_sidebar( 'product-right-sidebar' ); ?>

	             <?php endif; ?>
			</div>
			
			</div>
		
		</div>
	   

<?php get_footer(); ?>
