<?php
/**
 * The archive
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.1
**/
?>

<?php get_header(); ?>

	<section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">

		<?php if (have_posts()) : ?>
            
            <header class="entry-header">
                <h1 class="entry-title page-title">
                    <span>
						<?php if (is_category()) { ?>
                        <?php single_cat_title(); ?>
                        
                        <?php } elseif(is_tag()) { ?>
                        <?php single_tag_title(); ?>
                
                        <?php } elseif (is_day()) { ?>
                        <?php the_time('F jS, Y'); ?>
                
                        <?php } elseif (is_month()) { ?>
                        <?php the_time('F, Y'); ?>
                
                        <?php } elseif (is_year()) { ?>
                        <?php the_time('Y'); ?>
                        
                        <?php } elseif ( get_post_format() ) { ?>
                        <?php echo get_post_format(); ?>
                        
                        <?php } elseif (is_author()) { ?>
                        <?php _e ( 'Author Archive', 'themetext' ); ?>
        
                        <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                        <?php } ?>
                    </span>
                </h1>
            </header>
            
            
            <?php 
			// Slider with "Full Width" option selected
			if( ! get_field('category_slider', 'category_' . get_query_var('cat') ) || get_field('category_slider', 'category_' . get_query_var('cat') ) == 'cat_slider_on' && get_field('category_slider_position', 'category_' . get_query_var('cat') ) == 'cat_slider_full' ) {
				get_template_part( 'inc/category', 'slider' );
			} ?>
                    
            
			<?php
            // Enable/Disable sidebar based on the field selection
            if ( ! get_field( 'category_sidebar', 'category_' . get_query_var('cat') ) || get_field( 'category_sidebar', 'category_' . get_query_var('cat') ) == 'cat_sidebar_on' ):
            ?>
            <div class="grids">
                <div class="grid-8">
                <?php endif; ?>
        			
                    
                    <?php 
					// Slider with "Above The Content" option selected
					if( ! get_field('category_slider', 'category_' . get_query_var('cat') ) || get_field('category_slider', 'category_' . get_query_var('cat') ) == 'cat_slider_on' && get_field('category_slider_position', 'category_' . get_query_var('cat') ) == 'cat_slider_above' ) {
            			get_template_part( 'inc/category', 'slider' );
					} ?>
                    
                    
                    <?php 
						if ( get_field ( 'category_posts_layout', 'category_' . get_query_var('cat') ) == 'classic-layout' ) {
							$posts_layout = 'classic-layout';
						} else {
							$posts_layout = 'masonry-layout';
						}
					?>
                    
                    <div class="grids <?php echo $posts_layout; ?> entries">
                    <?php 
					while (have_posts()) : the_post();
                
                        get_template_part( 'content', 'post' );
                        
                    endwhile; ?>
                    </div>
                    
					<?php ti_pagination(); ?>
                        
				<?php else:
                
					// Enable/Disable sidebar based on the field selection
					if ( ! get_field( 'category_sidebar', 'category_' . get_query_var('cat') ) || get_field( 'category_sidebar', 'category_' . get_query_var('cat') ) == 'cat_sidebar_on' ):
					?>
					<div class="grids">
					<div class="grid-8">
					<?php endif; ?>
                    
						<p class="message"><?php _e( 'Sorry, no posts were found', 'themetext' ); ?></p>
                        
                <?php endif;
					
                // Enable/Disable sidebar based on the field selection
                if ( ! get_field( 'category_sidebar', 'category_' . get_query_var('cat') ) || get_field( 'category_sidebar', 'category_' . get_query_var('cat') ) == 'cat_sidebar_on' ):
                ?>
                </div><!-- .grid-8 -->
            
                <div class="grid-4">
                    <?php get_sidebar(); ?>
                </div>
            </div><!-- .grids -->
            <?php endif; ?>
    
		</div>
    </section><!-- #content -->

<?php get_footer(); ?>
