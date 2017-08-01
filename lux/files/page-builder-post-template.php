<?php 
/*
*Template Name Posts: Page Builder Template
*
*/

?>
<?php get_header(); ?> 
<?php $pageHeight = get_field('page_height'); ?>
<?php if($pageHeight) { ?>
<style>
 #content{height:<?php echo get_field('page_height'); ?>px !important}
</style>	
<?php } ?>

<div class="centering">
                
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
           <div class="entry">
               <!-- <h1 class="title"><?php the_title(); ?></h1>-->
                 <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
                <div class="clear"></div>
            </div>
            
		<?php while(has_sub_field('text_content_box')): ?> 
        <div class="textBar">
            <?php the_sub_field('content_text_box'); ?>
            <div class="clear"></div>
        </div>
        <?php endwhile; ?>   
                
        <?php endwhile; endif; ?>

    <div class="clear"></div>
            	
</div>

<?php get_footer(); ?>

