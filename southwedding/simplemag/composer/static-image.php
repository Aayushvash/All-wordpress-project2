<?php 
/**
 * Static Image
 * Page Composer Section
 *
 * @package SimpleMag
 * @since 	SimpleMag 2.0
**/
?>

<section class="home-section advertising">
	
    <?php if( get_sub_field( 'static_main_title' ) ): ?>
        <header class="section-header">
            <h2 class="title"><span><?php the_sub_field( 'static_main_title' ); ?></span></h2>
            <?php if( get_sub_field( 'static_sub_title' ) ): ?>
            <span class="sub-title"><?php the_sub_field( 'static_sub_title' ); ?></span>
            <?php endif; ?>
        </header>
    <?php endif; ?>
    
    
    <?php
		$image_url = get_sub_field( 'ad_banner_url' );
		$image_link = get_sub_field( 'ad_banner_link' );
		
		if ( $image_url != '' ) {
			if ( get_sub_field( 'static_image_mode' ) == 'static_image_regular' ) {
				// Get the file name and put it into the alt attr.
				$info = pathinfo( $image_url );
				$regular_alt = basename( $image_url, '.' . $info['extension'] );
				$image_alt = $regular_alt;
				$image_banner = '';
			} else {
				$image_alt = __( 'Advertisement', 'themetext' );
				$image_banner = ' rel="nofollow" target="_blank"';
			}
		}
    	
		// Output the image
		if ( $image_url != '' ) {
			if ( $image_link != '' ) { echo '<a href="' . $image_link . '"' . $image_banner .'>'; }
				echo '<img src="' . $image_url . '" alt="' . $image_alt . '" />';
			if ( $image_link != '' ) { echo '</a>'; }
		}
		
	?>
     
</section><!-- Static Image -->