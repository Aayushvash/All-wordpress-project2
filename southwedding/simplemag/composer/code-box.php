<?php 
/**
 * Code Box
 * Page Composer Section
 *
 * @package SimpleMag
 * @since 	SimpleMag 2.0
**/
?>

<section class="home-section advertising">
	
    <?php if( get_sub_field( 'code_main_title' ) ): ?>
    <header class="section-header">
        <h2 class="title"><span><?php the_sub_field( 'code_main_title' ); ?></span></h2>
        <?php if( get_sub_field( 'code_sub_title' ) ): ?>
        <span class="sub-title"><?php the_sub_field( 'code_sub_title' ); ?></span>
        <?php endif; ?>
    </header>
    <?php endif; ?>
    
   	<?php the_sub_field( 'ad_banner_code' ); ?>
		
</section><!-- Code Box -->