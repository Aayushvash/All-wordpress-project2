<?php
/**
 Template name: Enquete
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
                    
                    	<div class="leftbox left">
                        
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>  
                                <h2><?php if(get_field('title_2')){ echo get_field('title_2'); }else{ the_title(); } ?></h2>                         
                                <?php the_content(); ?>
                            <?php endwhile; wp_reset_query(); endif;  ?>
                            
                            <div class="survey-block">
                            
                                <img src="<?php bloginfo('template_url'); ?>/images/message-direct@2x.png" width="32" height="27" alt="" />
                                
                                <h4>Enquete formulier</h4>
                                
                                <?php echo do_shortcode('[contact-form-7 id="125" title="Enquete formulier"]'); ?>
                            
                            </div>
                            
                    	</div>
                    
                    	<div class="rightbox right">
                        
                           <div class="recentpost-block enquete">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('enquete_right_sidebar') ) : ?> <?php endif; ?>
                            	                
                                
                                
                                                                
                            </div>
                    
                    	</div>
                    
                    </div>

				</article>
				<!-- finish content block -->
                
            <!-- begin customer block -->
                <article class="customer-block">
                
                	<div class="centring">
                    
                    	<h2>Wat onze klanten zeggen</h2>
                        
                        <p class="sub">Onze klanten aan het woord</p>
                    
                        <div class="flexslider">
                        
                            <ul class="slides">
                               <?php
							   query_posts('post_type=testimonial&&showposts=-1');
							    if (have_posts()) : while (have_posts()) : the_post(); ?> 
                                <li>
                                     <div class="forbg">                            
										<div class="right">                                
											<div class="text">                              
												  <p class="flex-caption"><?php echo get_the_content(); ?></p>
												  <span><?php the_title(); ?>  <span class="small">(<?php the_field('desination'); ?>)</span></span>                                                                      
											</div>                                 
										</div>
									</div>
									<div class="left">
									
<div class="image"><?php the_post_thumbnail('testimonial'); ?></div>

									<div class="titleBox mobileview">
									 <span><?php the_title(); ?>  <span class="small">(<?php the_field('desination'); ?>)</span></span>  
									</div>
									</div>
                                    
                                </li>
                              <?php endwhile; wp_reset_query(); endif; ?>
                            </ul>
                             <div class="clear"></div>
                        </div>  
                    
                    </div>
                
                </article>
                <!-- finish customer block -->
                
                <!-- begin signup block -->
                <article class="signup-block">
                
                	<div class="centring">
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('newsletter_sidebar') ) : ?> <?php endif; ?>
                    	
                    
                    </div>
                
                </article>
                <!-- finish signup block -->

<?php get_footer(); ?>