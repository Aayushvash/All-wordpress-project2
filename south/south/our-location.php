<?php get_header();  /*
Template Name: Our Loaction Template 
*/  $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>

	<div id="banner-wrap" class="inner-banner">
        <img alt="" src="<?php echo $feat_image;  wp_reset_query();?>" />
	</div>
</div>
<!--  content -->
<div id="content" class="content-block">
<!-- finish  header --> 
	<div class="centring">
		
	<h1><?php the_title(); ?></h1>
	<!--  / left location \ -->
		<div id="loaction">
		 <?php
                            // check if the repeater field has rows of data
                            if( have_rows('our_loactions') ):
                            // loop through the rows of data
                            while ( have_rows('our_loactions') ) : the_row();
                            $title=get_sub_field('title');	
							$address = get_sub_field('address');	
							$phone = get_sub_field('phone');	
							$map = get_sub_field('map_code');	
                            ?>
			<div class="map">
				<div class="left">
			<?php the_sub_field('map_code'); ?>
				
				</div>
				<div class="right">
				<h5><?php the_sub_field('title'); ?></h5>
				<?php the_sub_field('address'); ?>
				<a href="tel:<?php the_sub_field('phone'); ?>"><span><?php the_sub_field('phone'); ?></span></a>
				</div>		
			
			</div>
			<?php endwhile; else :  endif;
                            wp_reset_query();  ?>
			
		</div>
		<!--  \ left location  / -->
	<div class="clear"></div>
	</div>
<?php get_footer();  ?>
