<?php
/**
 Template name: Inschrijven Template
 */

get_header(); ?>
<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
<!-- begin subpage block -->
        		<article class="subpage-block" style="background: url(<?php echo $url; ?>) no-repeat 100%/cover;">
                
                	<div class="centring">
                    
                    	<div class="head"><h3><?php the_title(); ?></h3></div>
                        
                        <div class="np desktopview">
                        
                        	<ul>
                            
                            	<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
                                <li><?php the_title(); ?></li>
                            
                            </ul>
                        
                        </div>
                    
                    </div>
            <div class="overlay"></div>
            	</article>
            	<!-- finish subpage block -->
				
				<article class="bread-block mobileview">
					<div class="centring">
						<div class="np"> 
							<ul>
								<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
								<li><?php the_title(); ?></li>
							</ul>       
						</div>
					</div>	
				</article>

				<!-- begin content block -->
				<article class="content-block">

					<div class="centring">
                    
                    	<div class="leftbox left visualBox">
                        
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>  
                                <h2><?php if(get_field('title_2')){ echo get_field('title_2'); }else{ the_title(); } ?></h2>                         
                                <?php the_content(); ?>
                            <?php endwhile; wp_reset_query(); endif;  ?>
                            
                    	</div>
                    
					<div class="rightbox register">

					     <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('curcus_right_sidebar') ) : ?> <?php endif; ?>

					</div>
                    
                    </div>

				</article>
				<!-- finish content block -->
            
                <!-- begin signup block -->
                <article class="signup-block">
                
                	<div class="centring">
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('newsletter_sidebar') ) : ?> <?php endif; ?>
                    	
                    
                    </div>
                
                </article>
                <!-- finish signup block -->

<?php get_footer(); ?>