<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

       
	   <div class="borderBox">
	  
	   <img src="<?php bloginfo('template_directory'); ?>/images/blogo.png"/>
	   
	   </div>
	   
	   <div class="titleBox"><h2><?php single_cat_title(); ?></h2></div>
	   
	   <!--  / banner \ -->
		<div id="banner" class="innerBanner">
			
            <img src="<?php echo get_theme_option('burl'); ?>"/>

		</div>
		<!--  \ banner / -->
		
		<div class="blogBox">
		
			<div class="centerBar">
			
			<div class="leftBlog">
			<?php if ( have_posts() ) : ?>
                      <?php while (have_posts()) : the_post(); ?>
                      <div class="blogLoop">
					  <div class="dateBox"><?php the_time('F') ?><span><?php the_time('d') ?></span></div>
					  
					  <?php   if ( has_post_thumbnail() ) { ?>
						  <div class="imageBox">
						  	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-img2'); ?></a>
							</div>
							<?php }  ?>
					  
					  
					  <div class="blogText <?php   if ( !has_post_thumbnail() ) { echo "fullBlog";} ?>">
					  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                      
                      <?php the_excerpt(); ?>
					  <a class="more" href="<?php the_permalink(); ?>">KEEP READING</a>
					 </div>
                      </div>
                       <?php endwhile; ?>
                      <?php else: ?>
                      <h3>Sorry, No Post Found</h3>
                      <?php endif; ?>
					  
						<div class="clear"></div>
						<div class="pagination">
						<?php if(function_exists('wp_paginate')) {
						wp_paginate();
						} ?>
						</div>
						<div class="clear"></div>
			
			</div>
			<div class="rightBlog">
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>

				<?php dynamic_sidebar( 'blog-sidebar' ); ?>

	             <?php endif; ?>
			</div>
			
			</div>
		
		</div>
	   

<?php get_footer(); ?>
