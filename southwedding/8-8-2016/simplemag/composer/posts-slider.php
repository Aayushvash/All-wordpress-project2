<?php 
/**
 * Homepage Slider
 * Page Composer Section
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.1
**/
global $ti_option;

/** 
 * Add posts to slider only if the 'Add To Slider' 
 * custom field checkbox was checked on the Post edit page
**/
$slides_num = get_sub_field( 'slides_to_show' );

$ti_posts_slider = new WP_Query(
	array(
		'post_type' => 'post',
		'meta_key' => 'homepage_slider_add',
		'meta_value' => '1',
		'posts_per_page' => $slides_num
	)
);
?>

<section>
	
    <?php if ( $ti_posts_slider->have_posts() ) : ?>
    
        <div class="flexslider posts-slider loading">
            <ul class="slides">
            
            <?php while ( $ti_posts_slider->have_posts() ) : $ti_posts_slider->the_post(); ?>
            
                <li>
                	<figure>
					<?php if ( has_post_thumbnail() ) { ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'big-size' ); ?>
                        </a>
                    <?php } else { ?>
                        <img class="alter" src="<?php echo get_template_directory_uri(); ?>/images/pixel.gif" alt="<?php the_title(); ?>" />
                    <?php } ?>
                    </figure>
                    
                    <header class="entry-header">
                        <div class="entry-meta">
							<?php if( $ti_option['site_author_name'] == 1 ) { ?>
                            <span class="entry-author">
                                <?php _e( 'By','themetext' ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author"><?php the_author_meta( 'display_name' ); ?></a>
                            </span>
                            <?php } ?>
                           	<span class="entry-category"><?php the_category(', '); ?></span>
                           	<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                        </div>
                            
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <a class="read-more" href="<?php the_permalink() ?>"><?php _e( 'Read More', 'themetext' ); ?></a>
                    </header>
                    
                </li>
                
            <?php endwhile; ?>
            
            </ul>
        </div>
    
    <?php else: ?>
        
        <div class="grids entries">
            <p class="grid-12 message">
                <?php _e( 'Sorrry, there are no posts in the slider', 'themetext' ); ?>
            </p>
        </div>
         
    <?php endif; ?>
	
	<?php wp_reset_query(); ?>

</section><!-- Slider -->