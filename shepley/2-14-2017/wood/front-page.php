<?php get_header(); ?>

   <!--  / banner \ -->
		<div id="banner">
			
            <?php echo do_shortcode('[rev_slider homeslider]'); ?>

		</div>
		<!--  \ banner / -->
       
	   <div class="borderBox">
	  
	   <img src="<?php bloginfo('template_directory'); ?>/images/blogo.png"/>
	   </div>
	   
<div class="homeWidget">
<div class="centerBar">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home-product-page') ) : ?> <?php endif; ?>
</div>
</div>
    

    
<?php get_footer(); ?>