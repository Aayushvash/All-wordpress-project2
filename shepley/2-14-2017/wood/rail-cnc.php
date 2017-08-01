<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
  * Template Name: Rail CNC Page
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
                        
                        <div class="featured">
                        
							<?php the_post_thumbnail(); ?>
                        
                        </div>
                        
                    	<div class="text-mid1">
                
                        	<div class="text-left">
                            	
                                <div class="about">
                                	<div class="about-top">
                                    	<div class="about-bottom">
                                        
											<?php the_content(); ?>
                    					
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
                            
                            <div class="right-gallery">
                            	
                                <?php $short =  get_field('gallery_short_code'); ?>
       	 						<?php echo do_shortcode($short); ?>
                            
                            </div>
                            
                        </div>
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