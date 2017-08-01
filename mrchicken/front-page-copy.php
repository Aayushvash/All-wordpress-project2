<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: Front Page Copy
 */

get_header(); ?>

<!-- begin banner -->
<!--<section id="banner-wrap">

    <!-- center block -->
    <!--<article class="center-block">
        
        <h2><?php echo get_theme_option('bannertext'); ?></h2>
		
    </article>-->
    <!-- center block -->
	
	
<!--
</section>-->
<!-- finish banner -->
<style>
.soliloquy-container {
	max-width: 100% !important;
	width: 100% !important;
	max-height: 509px;
	overflow: hidden;
}

.soliloquy-container img {
	width: 100%;
}

.menus {
	z-index: 5;
}

.soliloquy-caption {
	top: 35%;
	text-align: center;
}

.soliloquy-caption-inside {
	max-width: 940px;
	margin-left: auto !important;
	margin-right: auto !important;
	text-align: left;
	background: none !important;
}

.soliloquy-caption h2 {
	font-size: 36px;
	line-height: 47px;
	background: url('/wp-content/themes/mr-chicken/images/heading-shadow.png') center no-repeat;
	text-align: left;
	max-width: 450px;
}

.soliloquy-caption h2 .color {
	font-size: 48px;
	font-family: 'open_sansbold';
	font-weight: normal;
	color: #FCB636;
}

</style>

<?php
if ( function_exists( 'soliloquy_slider' ) ) soliloquy_slider( '734' );
?>
	


<?php get_footer(); ?>
