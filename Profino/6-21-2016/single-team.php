<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
get_header();

?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="four" class="slider-bar single-bar">
            
            	<div class="centering">
                
                	<h2>weiterbildungsteam</h2>
                    
                   <div class="text">
				  
						<div class="mid">
						  <div class="left">
							<?php the_post_thumbnail(); ?>
						  </div>
						  <div class="right">
							<h3>
							  <?php  the_field('name_title');?>
							  <em>&raquo;<?php  the_field('dseignation');?>&laquo;</em></h3>
							<div class="clear"></div>
						  </div>
						</div>
						<div class="content">
								<div class="text-left">
									<p>
									  <?php  the_content(); ?>
									</p>
								</div>
								<div class="text-right">
								<?php if(have_rows('right_side_option')): while(have_rows('right_side_option')): the_row();
										$head = get_sub_field('heading');
				
									?>
								<h3><?php echo $head;  ?></h3>
								<ul>
									<?php if(have_rows('options')): while(have_rows('options')): the_row();
										$tit = get_sub_field('title');
										$link = get_sub_field('link');
											 
				
									?>
									<li><a href="<?php echo $link; ?>"><?php echo $tit; ?></a></li>	
									<?php endwhile; endif; ?>	
								</ul>
								<?php endwhile; endif; ?>
								
								</div>
						</div>
						<div class="clear"></div>
							<ul class="social">
							  <li><a href="<?php the_field('facebook'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img1.png" alt="" /></a></li>
							  <li><a href="<?php the_field('twitter'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img2.png" alt="" /></a></li>
							  <li><a href="<?php the_field('gogle_plus'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img4.png" alt="" /></a></li>
							  <li style="display:none;"><a href="<?php the_field('email'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/message_img.png" alt="" /></a></li>
							</ul>
                    </div>
                    
                
                </div>
				 <div class="now">      
        <?php echo do_shortcode('[contact-form-7 id="175" title="Single Team"]');  ?> </div>
            
            </div>

<?php // comments_template(); ?>

    

    <?php endwhile; else: ?>

    


    <?php endif; ?>





<?php get_footer(); ?>