<?php 
/* Template Name: login page */
get_header(); ?>


<div class="login-block">
<div class="centering">
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="log-bar" id="post-<?php the_ID(); ?>">
    
    	<h2><?php the_title(); ?></h2>
        
        <div class="log-from">
            <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
    
            <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
    
        </div>
    
    </div>
    
	<?php endwhile; endif; ?>
    
	<?php //edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
    
    <?php //comments_template(); ?>
	
	</div>
</div>


<?php //get_sidebar(); ?>

<?php get_footer(); ?>
