<?php
/**
 * Template Name: Album Page 
 */

get_header(); ?>
</div>
	<!--  \ layout / -->
 <!--  / content \ -->
<div id="content">
    	<div id="contentCn">

            <!--  / center side\ -->
            <div id="centerSide">
        
                <!--  / about bar \ -->
                <div class="aboutBar">
                
        			 <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                    <h2><?php the_title(); ?></h2>
                    
                    <div class="text">
                    <?php the_content(); ?>
                    
                    
                    </div>
        		 <?php endwhile; ?>
                     <?php endif; ?>
                </div>
                <!--  \ about bar / -->
        
            </div>
            <!--  \ center side/ -->
        
    	</div>    
	</div>
	<!--  \ content / -->
    <?php get_footer(); ?>
