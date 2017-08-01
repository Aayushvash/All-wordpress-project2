<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<!-- begin banner -->
<section id="banner-wrap">

<!--<!-- center block -->
    <article class="center-block">
        
   <!--    <h2><?php // echo get_theme_option('bannertext'); ?></h2>  --> 
    
		
    </article>
    <!-- center block -->
	<?php if ( function_exists( 'soliloquy_slider' ) ) soliloquy_slider( 'home-slider' ); ?>
	

</section>
<!-- finish banner -->

<?php get_footer(); ?>
