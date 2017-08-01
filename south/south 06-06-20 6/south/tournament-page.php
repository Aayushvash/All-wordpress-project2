<?php get_header(); 
/*Template name: Tournament Page */

 $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
<div id="banner-wrap" class="inner-banner">
       <img alt="" src="<?php echo $feat_image;  wp_reset_query();?>" />
	</div>


</div>
<!--  content -->
<div id="content" class="content-block">
<!-- finish  header --> 
	<div class="centring">
		<!--  / left container \ -->
	
		<div id="leftCntr">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
			
				<h1><?php the_title(); ?></h1>
				
				<div class="entry">
					<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
			
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
				</div>
			
			</div>
			
			<?php endwhile; endif; ?>
			
		</div>
		<!--  \ left container / -->
		<div id="rightCntr">
		<?php if ( is_active_sidebar( 'tournament_sidebar' ) ) : ?>

		<?php dynamic_sidebar( 'tournament_sidebar' ); ?> 

		<?php endif; ?>
		</div>
		
	<div class="clear"></div>
	</div>

<?php get_footer(); ?>

