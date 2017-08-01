<?php get_header(); ?> 

<div class="centering">

    <div class="breadcrumbs">
        <?php if(function_exists('bcn_display')){bcn_display();}?>
    </div>

    <!-- left -->
    <div id="left">
                
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="articleDetail" id="post-<?php the_ID(); ?>">     
            <div class="entry">
                <h1 class="title"><?php the_title(); ?></h1>
                <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
                <div class="clear"></div>
            </div>
        </div>

		<?php while(has_sub_field('text_content_box')): ?> 
        <div class="textBar">
            <?php the_sub_field('content_text_box'); ?>
            <div class="clear"></div>
        </div>
        <?php endwhile; ?>   
                
        <?php endwhile; endif; ?>

    </div>
    <!-- left -->
    	
    <?php get_sidebar(); ?>
	
    <div class="clear"></div>
            	
</div>

<?php get_footer(); ?>

