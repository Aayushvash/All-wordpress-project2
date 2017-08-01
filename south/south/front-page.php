<?php get_header(); ?>

	<div id="banner-wrap">
      <?php $slider_shortcode=get_field('slider_shortcode'); echo do_shortcode(''.$slider_shortcode.''); ?>  
	</div>


</div>
		<!-- finish  header --> 

		<!--  content -->
		<div id="content">
			<!-- boxes --->
				<div class="box">
					<div class="centring">	
								
					 <?php if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('home_sidebar') ) : ?>
					<?php endif; ?>
								
					 </div>
					 <div class="clear"></div>
				 </div>
			<!-- finish boxes --->	
			
			<!-- start rental --->	
			<div class="centring">				
				<div class="rental">
						
									
						 <?php if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('home_rental') ) : ?>
						<?php endif; ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="post text" id="post-<?php the_ID(); ?>">
    
    	<h2><?php the_title(); ?></h2>
        
        <div class="entry">
            <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
    
            <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
    
        </div>
    
    </div>
    
	<?php endwhile; endif; ?>
						 
						 <div class="clear"></div>
				</div>				
			<!-- finish rental --->	
			
			<!-- start service --->			
				<div class="service">
						
									
						 <?php if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('home_service') ) : ?>
						<?php endif; ?>
									
						
						 <div class="clear"></div>
				</div>				
			<!-- finish service --->	
			</div>
			
				 


<?php get_footer();  ?>
