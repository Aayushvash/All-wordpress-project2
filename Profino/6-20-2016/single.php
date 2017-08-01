<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
get_header();

?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="single-blog">
<div id="four" class="agenda-bar">
            
            	<div class="centering">
                
                	<h5 class="high"><span>highlights</span> <?php echo get_field('highlight'); ?></h5>
                    
                    <div class="bert">
                    
                    	<div class="jun">
                       	<?php $ban = get_field('banner_image_img'); ?>

						<?php if($ban){ ?>
						<img src="<?php echo $ban['sizes']['post-large-ban'];  ?>" alt="" />
						<?php } else { ?>							
                           <?php the_post_thumbnail('post-large-ban'); ?>
						<?php } ?>
                            
                            <div class="title">
                                <div class="right">
                                    <em><?php the_title(); ?> </em>
									<em><?php the_field('sub_title'); ?> </em>
                                    <h3><?php the_field('custom_date') ?></h3>
                                    <?php the_content(); ?>
                                
                                </div> 
								
								<div class="right-right">
								<div class="nor">
								<h5>weitere News</h5>
									 <?php

									$args = array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 4);

									$loop = new WP_Query( $args );

									$i = 1;

									while ( $loop->have_posts() ) : $loop->the_post();

								?>
									<div class="box1">
									<?php the_post_thumbnail('post-medium') ?>
									<div class="ext">
									<h3>
									<?php the_field('custom_date'); ?>
									</h3>
									
									<span>
									<?php the_title(); ?>
									</span> <span>
									<?php the_field('sub_title'); ?>
									</span>
									</div>
									<div class="overlay">
									<h4>
									<?php the_field('custom_date'); ?>
									</h4>
									<span>
									<?php the_title(); ?>
									</span> <span>
									<?php the_field('sub_title'); ?>
									</span>
									<p><?php // echo substr(strip_tags($loop->post_content), 0, 70);?>
									<?php $content = get_the_content();
      $content = strip_tags($content);
      echo substr($content, 0, 50);
?>…....<a href="<?php the_permalink(); ?>">mehr</a> </p>
									
									</div>
									</div>
									<?php  endwhile; wp_reset_query(); ?>
								</div>
								
								
								</div>
                            <div class="clear"></div>
                            </div>
                         
                        </div>
                    
                    </div>
                    
                
                </div>
            
            </div>
		</div>

<?php // comments_template(); ?>

    

    <?php endwhile; else: ?>

    


    <?php endif; ?>





<?php get_footer(); ?>