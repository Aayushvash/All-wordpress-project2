<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
<!--  / left container \ -->
<section id="content-wrap">		<article class="text-block">

		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        
			<h1><?php the_title(); ?></h1>
            
            <div class="image">
            	
                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('cam-thumb2'); ?></a>
                
            </div>
            
            <div class="entry">
            
            	<p><?php echo substr(strip_tags(get_the_content(__('Read more', 'kubrick')),"<span>"),0,400)."..."; ?></p>
              
                	
            </div>
            
		</div>
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'kubrick')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'kubrick')) ?></div>
		</div>
		<?php else : ?>

		<h2 class="center"><?php _e('Not Found', 'kubrick'); ?></h2>
		<p class="center"><?php _e('Sorry, but you are looking for something that isn&#8217;t here.', 'kubrick'); ?></p>

		<?php endif; ?>

    </article></section>

<?php get_footer(); ?>
