<?php 
/**
 * Custom Slider
 * Page Composer Section
 *
 * @package SimpleMag
 * @since 	SimpleMag 2.0
**/
?>

<section>
	
    <?php if( get_sub_field( 'custom_add_new_slide' ) ) { ?>
    
	<div class="flexslider posts-slider loading">
    	<ul class="slides">
    
		<?php while( has_sub_field('custom_add_new_slide' ) ){ ?>
        
        	<li>
            
                <figure>
                
                <?php if ( get_sub_field( 'custom_slide_image' ) ) { ?>
                    <a href="<?php the_sub_field( 'custom_slide_url' ) ?>">
                    	<?php
							$attachment_id = get_sub_field( 'custom_slide_image' );
							$image_size = 'big-size';
							$slide_image = wp_get_attachment_image_src( $attachment_id, $image_size );
                       	?>
                       	<img src="<?php echo $slide_image[0]; ?>" width="<?php echo $slide_image[1]; ?>" height="<?php echo $slide_image[2]; ?>" class="attachment-big-size wp-post-image" alt="<?php the_sub_field( 'custom_slide_title' ); ?>" />
                    </a>
                <?php } else { ?>
                    <img class="alter" src="<?php echo get_template_directory_uri(); ?>/images/pixel.gif" alt="<?php the_title(); ?>" />
                <?php } ?>
                
                </figure>
                
                <header class="entry-header">
                
                    <h2 class="entry-title">
                        <a href="<?php the_sub_field( 'custom_slide_url' ); ?>"><?php the_sub_field( 'custom_slide_title' ); ?></a>
                    </h2>
                    
                    <?php if ( get_sub_field( 'custom_button_text' ) ) { ?>
                    	<a class="read-more" href="<?php the_sub_field( 'custom_slide_url' ); ?>"><?php the_sub_field( 'custom_button_text' ); ?></a>
                    <?php } ?>
                    
                </header>
                    
            </li>
                        
		<?php } ?>
 		
        </ul>
     </div>
     
	<?php } ?>

</section><!-- Custom Slider -->