<?php 
/**
 * Template Name: Page Composer
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.1
**/
?>

<?php get_header(); ?>
	
    
    <section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">
        
        <?php
        // Enable/Disable sidebar based on the field selection
		if ( get_field( 'page_sidebar' ) == 'page_sidebar_on' ):
		?>
		<div class="grids">
			<div class="grid-8">
		<?php endif; ?>
            
        <?php 
		
		/* Homepage Builder */ 
		while( has_sub_field( "page_composer" ) ):
		
			
            /* Posts Slider */ 
            if( get_row_layout() == "hp_posts_slider" ):
				
				get_template_part ( 'composer/posts', 'slider' );
				
				
			
			/* Custom Slider */ 
			elseif( get_row_layout() == "custom_slider" ):
				
				get_template_part ( 'composer/custom', 'slider' );
				
				
				
			/* Featured Posts */ 
			elseif( get_row_layout() == "hp_featured_posts" ):
				
				get_template_part ( 'composer/featured', 'posts' );



            /* Latest posts by Category */ 
            elseif( get_row_layout() == "latest_by_category" ):
			
				get_template_part ( 'composer/category', 'posts' );
				
			
			
			/* Latest posts by Format */ 
			elseif( get_row_layout() == "latest_by_format" ):
			
				get_template_part ( 'composer/format', 'posts' );
			
			
			
			/* Latest Reviews */ 
			elseif( get_row_layout() == "latest_reviews" ):
			
				get_template_part ( 'composer/latest', 'reviews' );
				

			
			/* Latest Posts */ 
            elseif( get_row_layout() == "latest_posts" ):
				
				get_template_part ( 'composer/latest', 'posts' );
				
			
			
			/* Static Image */ 
            elseif( get_row_layout() == "image_advertising" ):
				
				get_template_part ( 'composer/static', 'image' );
				
				
			
			/* Code Box */ 
            elseif( get_row_layout() == "code_advertising" ):
				
				get_template_part ( 'composer/code', 'box' );
			
			
			
			/* Title or Text */ 
            elseif( get_row_layout() == "title_or_text" ):
				
				get_template_part ( 'composer/title', 'text' );
				
			endif;
            
		endwhile;
		?>
        
        <?php
			  // Enable/Disable sidebar based on the field selection
			  if ( get_field( 'page_sidebar' ) == 'page_sidebar_on' ):
			  ?>
			  </div><!-- .grid-8 -->
		  
			  <div class="grid-4">
				  <?php get_sidebar(); ?>
			  </div>
		  </div><!-- .grids -->
		  <?php endif; ?>
            
		</div>
    </section>
    
<?php get_footer(); ?>