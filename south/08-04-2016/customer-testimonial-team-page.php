<?php get_header(); /*Template name: customer Testimonial Team page */ ?>

<!-- begin banner -->
		<div id="banner-wrap">
        
			<!-- banner block -->
            <div class="banner-block bg2">
			 <?php if (has_post_thumbnail('default-thumb')) {
				the_post_thumbnail('default-thumb');
				} else {  ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/banner3.jpg" alt="" />

				<?php } ?>  
			
            
            	
              
            </div>
            <!-- finish banner block -->
        </div>
        <!-- finish banner wrap -->
		
		
		
		        
       	<!-- begin content -->
		<div id="content-wrap">    
            
            <!-- begin centerwrap -->
			<div id="center-wrap">
				<div class="centering">
                
                    <!-- begin world block -->
                    <div class="world-block">
                        
                        <h2><?php the_title(); ?></h2>
                        
						
						<?php query_posts(array('post_type'=> 'words-post','posts_per_page'=> -1, 'order'=> 'ASC')); $i=1;
							if (have_posts()) : while (have_posts()) : the_post(); 	
							if( $i % 2 == 0 )
										$class = 'bg';
										else
										$class = '';
							
							?>
								
								
								<?php //  print_r($comment); ?>
								
   					<div class="world <?php echo $class; ?>">
								<div class="left">
								

								<a href="#">  <?php if (has_post_thumbnail('word-thumb')) {
				the_post_thumbnail('word-thumb');
				} else {  ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/ttp.png" alt="" />

				<?php } ?>  </a>

								</div>
								<div class="right">
								

								<h3><?php the_title(); ?> <span><?php the_time('F jS, Y') ?></span></h3>
								<?php the_content(); ?>
								

								</div> 

							

							</div>
						
		
						<?php
						//format comments
						
						$i++; endwhile; endif;
						?>
                         
          
        
                    </div>
                    <!-- finish world block -->
        
                    <!-- contact block -->
                    <div class="contact-block">
					<div class="comment">
								
								<?php comments_template( '', true ); ?>
                                
                                	
                                   
                                </div>
					
                    	
                       
                        
                    </div>
                    <!-- finish contact block -->

                </div>
            </div>
			<!-- finish center wrap -->
            
		</div>
		<!-- finish content -->
			
		
 
<?php get_footer(); ?>