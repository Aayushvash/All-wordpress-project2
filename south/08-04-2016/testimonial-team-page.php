<?php get_header(); /*Template name: Testimonial Team page */ ?>

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
                        
						
						<?php $args = array('post_type' => 'page');
							$post_obj = new WP_Query($args);
							while($post_obj->have_posts() ) : $post_obj->the_post();
						//display comments
							$comments = get_comments(array(
							'post_id' => $post->ID,
							'number' => '120' ));
			foreach($comments as $comment) {  $status = wp_get_comment_status( $comment_id );?>
								
								
								<?php //  print_r($comment); ?>
								<?php if ( $status == "approved" ) { ?>
   					<div class="world bg">
								<div class="left">
								<?php userphoto($posts[0]->comment_author); ?>

								<a href="#"><?php echo get_avatar( $comment ); ?></a>

								</div>
								<div class="right">
								

								<h3><?php echo comment_author(); ?> <span><?php echo comment_date(); ?></span></h3>
								<?php   echo '<p>'.$comment->comment_content.'</p>'; ?>	
								

								</div> 

							

							</div>
						<?php  } ?>
		
						<?php
						//format comments
						}
						endwhile; wp_reset_query();
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