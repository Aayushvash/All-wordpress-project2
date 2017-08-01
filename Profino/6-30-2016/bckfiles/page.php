<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
			<div class="inner-page">                        	<div class="centering">                                	<h2><?php the_title(); ?></h2>                                        <div class="bert">                                        	<div class="jun">                       		                           <?php the_post_thumbnail(); ?>                                                        <div class="title">                                                        	                                                                <div class="right">                                                              	                                                                        <?php the_content(); ?>                                                                </div>                                                        </div>                                                 </div>                                        </div>                                                    </div>		</div>                        
    <?php endwhile; endif; ?>
    
    
<?php get_footer(); ?>