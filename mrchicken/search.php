<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<!--  / np box \ -->
<div class="npBox">

    <?php if(function_exists('bcn_display'))
    {
    bcn_display();
    }?>
    
</div>
<!--  \ np box / -->
        
<!--  / left container \ -->
<div id="leftCntr">
	
    <!--  / campan box \ -->
    <div class="campanBox">
    	
        <h1 class="pagetitle"><?php _e('Search Results', 'kubrick'); ?></h1>
        
		<ul>
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
			<li <?php post_class(); ?>>            
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('cam-thumb2'); ?></a>
			</li>
			<?php endwhile; ?>
			<?php else : ?>
			<h2 class="center"><?php _e('No posts found. Try a different search?', 'kubrick'); ?></h2>
			<?php get_search_form(); ?>
			<?php endif; ?>
		</ul>
	
    </div>
    <!--  \ campan box / -->
        
</div>
<!--  \ left container / -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
