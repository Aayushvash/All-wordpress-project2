<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
get_header(); ?>

       <div class="borderBox">
	  
	      <img src="<?php bloginfo('template_directory'); ?>/images/blogo.png"/>
	   
	   </div>
	   
	   <div class="clear"></div>
	   
	   <div class="singleBox">
	   
		   <div class="centerBar">
		   
				<div class="singleLeft">

					<?php if ( is_active_sidebar( 'blog-single-sidebar' ) ) : ?>

					<?php dynamic_sidebar( 'blog-single-sidebar' ); ?>

					<?php endif; ?>

					
				</div>
			   
			   <div class="singleRight">
			   
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
						<div class="singleImage">
						<?php the_post_thumbnail('blog-img3'); ?>
						</div>
						
						<div class="datTitle">
							<div class="dateBox"><?php the_time('F') ?><span><?php the_time('d') ?></span></div>
							<h2><?php the_title(); ?></h2>
						</div>
						
						<div class="clear"></div>
						
						<div class="singlecontent">
						
						<?php the_content(); ?>
						
						</div>
					
					<?php endwhile; endif; ?>
			   
			   </div>
		   <div class="clear"></div>
		   </div>
	   
	   </div>


	<!--  \ content / -->
    <?php get_footer(); ?>