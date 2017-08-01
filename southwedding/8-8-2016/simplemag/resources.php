<?php 
/**
 * Template Name: Resources
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.2
**/ 
global $ti_option;
?>

<?php get_header(); ?>
	<style>
		.vendorlist img {max-width: 97%; height: auto;}
		.vendorlist .vendoritem {float: left; margin: 15px;}
		.vendorlist .vendoritem#cape-cod-venues, .vendorlist .vendoritem#connecticut-venues, .vendorlist .vendoritem#maine-venues, .vendorlist .vendoritem#massachusetts-venues, .vendorlist .vendoritem#metro-boston-venues, .vendorlist .vendoritem#nantucket-venues, .vendorlist .vendoritem#new-hampshire-venues, .vendorlist .vendoritem#newport-venues, .vendorlist .vendoritem#providence-venues, .vendorlist .vendoritem#rhode-island-venues, .vendorlist .vendoritem#vermont-venues { display: none;}
	</style>
	
	<section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">
			<?php
			// Enable/Disable sidebar based on the field selection
		//	if ( ! get_field( 'page_sidebar' ) || get_field( 'page_sidebar' ) == 'page_sidebar_on' ):
			?>
            <div class="grids">
                <div class="grid-8 vendorlist" >
					<header class="entry-header">
						<h1 class="entry-title page-title inner">
							<span>Categories</span>
						</h1>
						<div class="clear"></div>
					</header>
							<?php

// List of image links

$terms = apply_filters( 'taxonomy-images-get-terms', '', array( 'taxonomy' => 'vvcategories' ) );

foreach( (array) $terms as $term) {
	echo '<div class="vendoritem" id="'.$term->slug.'"><a href="' . esc_attr( get_term_link( $term ) ) . '" title="' . sprintf( __( "View all posts in %s" ), $term->name ) . '" ' . '>' . wp_get_attachment_image( $term->image_id, 'destacado-proyectos-home' ) . '</a></div>';
}

?>
					<div class="clear"></div>	
					
				
				
                </div><!-- .grid-8 -->
            
                
                <div class="grid-4">
	                <aside class="sidebar">
                    <?php dynamic_sidebar('Magazine'); ?>
	                </aside>
                </div>
            </div><!-- .grids -->
			 <header class="entry-header">
                <h1 class="entry-title page-title inner">
                    <span>our featured posts</span>
                </h1>
            </header>
			
			<div class="grids entries">
			 
					<?php query_posts('post_type=post&showposts=3'); $j=1;
			if (have_posts()) : while (have_posts()) : the_post();
			
			?>
					<article class="grid-4" id="resp<?php echo $j; ?>">
						<figure class="entry-image">
						<a href="<?php the_permalink(); ?>">
						<?php 
						if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'medium-size' );
						} elseif( first_post_image() ) { // Set the first image from the editor
						echo '<img src="' . first_post_image() . '" class="wp-post-image" />';
						} ?>
						</a>
						</figure>

						<header class="entry-header">
							<div class="entry-meta">
								<span class="entry-category"><?php the_category(', '); ?></span>
								<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
							</div>
							
							<h2 class="entry-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							
						</header>
						
						<?php if( get_sub_field( 'featured_excerpt' ) == 'enable' ) { ?>
							<div class="entry-summary">
							<?php the_excerpt(); ?>
							</div>
						<?php } ?>
					</article>
					

					<?php $j++; endwhile; endif; wp_reset_query();?>
			 
			 </div>
            
        
        </div>
            
    </section><!-- #content -->
<script>
jQuery(document).ready(function(e) {

		jQuery("#venues a").attr("href", "http://southernneweddings.com/resources/venues/")
	  
		jQuery('.owl-carousel').owlCarousel({

                loop: true,

                margin: 0,

                responsiveClass: true,

                responsive: {

                  0: {

                    items: 1,

                    nav: true

                  },

                  600: {

                    items: 1,

                    nav: true

                  },

				  

				  1024: {

                    items: 3,

					nav: true

					

                  },

				  

                  1100: {

                    items: 3,

                    nav: true,

                    loop: false,

                    margin: 0

                  }

                }
				
				
				
				
        });

	

	

});

</script>
<?php get_footer(); ?>