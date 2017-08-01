<?php 
/**
 * Template Name: Venues subcategories
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.2
**/ 
global $ti_option;
?>

<?php get_header(); ?>
	<style>
		.vendorlist img {max-width: 97%; height: auto;}
		.vendorlist .grid-6 {display: none; margin-left:0 !important;}
		.vendorlist .grid-6#cape-cod-venues, .vendorlist .grid-6#connecticut-venues, .vendorlist .grid-6#maine-venues, .vendorlist .grid-6#massachusetts-venues, .vendorlist .grid-6#metro-boston-venues, .vendorlist .grid-6#nantucket-venues, .vendorlist .grid-6#new-hampshire-venues, .vendorlist .grid-6#newport-venues, .vendorlist .grid-6#providence-venues, .vendorlist .grid-6#rhode-island-venues, .vendorlist .grid-6#vermont-venues { display: block;}
	</style>
	<section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">
			<?php
			// Enable/Disable sidebar based on the field selection
		//	if ( ! get_field( 'page_sidebar' ) || get_field( 'page_sidebar' ) == 'page_sidebar_on' ):
			?>
            <div class="grids">
                <div class="grid-12 vendorlist">
					<header class="entry-header">
						<h1 class="entry-title page-title inner">
							<span>Locations</span>
						</h1>
						<div class="clear"></div>
					</header>
						
							
						<?php

// List of image links

$terms = apply_filters( 'taxonomy-images-get-terms', '', array( 'taxonomy' => 'vvcategories' ) );

foreach( (array) $terms as $term) {
	echo '<div class="grid-6" id="'.$term->slug.'"><a href="' . esc_attr( get_term_link( $term ) ) . '" title="' . sprintf( __( "View all posts in %s" ), $term->name ) . '" ' . '>' . wp_get_attachment_image( $term->image_id, '' ) . '</a></div>';
	}



?>
						
					<div class="clear"></div>	
					
				
				
                </div><!-- .grid-8 -->
            
			 
			 </div>
            
        
        </div>
    </section><!-- #content -->

<?php get_footer(); ?>