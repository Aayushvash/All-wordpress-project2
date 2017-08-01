<?php get_header();?>
<div id="banner-wrap" class="inner-banner">
        <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/gall-main.jpg" />
		
	</div>
</div>
<!--  content -->
<div id="content" class="content-block single-gallery">
<!-- finish  header --> 
	<div class="centring">
<!--  / left container \ -->
<?php  wp_reset_query(); if (have_posts()) : ?>

    

    <?php while (have_posts()) : the_post(); ?>
	<h1><?php the_title(); ?></h1>
	  <?php the_content('Read the rest of this entry &raquo;'); ?>
		<div id="inner-gallery">
		<?php   if( have_rows('images') ): // loop through the rows of data
					while ( have_rows('images') ) : the_row();
					$image=get_sub_field('image');	
					$details =get_sub_field('details'); 
						?>
			<div class="left-side">
  	    	    <img src="<?php echo $image['sizes']['gallery-thumb']; ?>" />
				
				<div class="text">
					<?php echo $details; ?>
				</div>

			</div>
			<?php  endwhile; else :  endif;
			?>
			<div class="clear"></div>
		</div>
		 <?php endwhile; else :  endif; ?>

<div class="clear"></div>
	</div>


<!--  \ left container / -->



</div>




<?php get_footer(); ?>