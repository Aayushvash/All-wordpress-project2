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
					<?php custom_breadcrumbs(); ?>
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
									<em><?php //the_field('sub_title'); ?> </em>
                                    <h3><?php the_field('detail_page_custom_title_below_main_title_left_side') ?></h3>
                                    <?php the_content(); ?>
                                
                                </div> 
								
								<div class="right-right">
								<div class="nor">
								<?php global $post; 
									$idd = $post->ID;
								?>
								<h5>weitere Highlights</h5>
									 <?php

									$args = array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 4, 'post__not_in'=> array( $idd ) );

									$loop = new WP_Query( $args );

									$i = 1;

									while ( $loop->have_posts() ) : $loop->the_post();

								?>
									<div class="box1 boxs<?php echo $i; ?>">
									<a href="<?php the_permalink(); ?>">
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
									<?php // the_title(); ?>
									</span> <span>
									<?php the_field('sub_title'); ?>
									</span>
									<p><?php // echo substr(strip_tags($loop->post_content), 0, 70);?>
									<span><?php $content = get_field('teaser');
											//$content = strip_tags($content);
											$content1 = substr($content, 0, 70);
											if($content1){
												echo $content1;
												echo '...';
											}
											
										?></span></p>
									
									</div>
									</a>
									</div>
									<?php $i++; endwhile;  wp_reset_query(); ?>
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