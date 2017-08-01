<?php 
/*
Template Name: Newsletter Page
*/
get_header(); ?> 


<div class="centering">

    <div class="breadcrumbs">
        <?php if(function_exists('bcn_display')){bcn_display();}?>
    </div>
    
    <!-- left -->
    <div id="left" class="gewinnspielPage">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="articleDetail">    
            
            <?php the_post_thumbnail('page-img'); ?>	
            
            <?php if(get_field('sub_heading')) {?>
            <h1><?php the_field('sub_heading'); ?></h1>
			<?php } else { ?>
            <h1><?php the_title(); ?></h1>
            <?php }?>        
                
            <div class="entry">
                <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
                <div class="clear"></div>
            </div>
            
        </div>
        <?php endwhile; endif; ?>

		<?php while(has_sub_field('text_content_box')): ?> 
        <div class="textBar">
            <?php the_sub_field('content_text_box'); ?>
            <div class="clear"></div>
        </div>
        <?php endwhile; ?>   
        
    </div>
    <!-- left container -->
            	
    <?php get_sidebar('newsletter'); ?>

	<div class="clear"></div>
</div>

<?php get_footer(); ?>