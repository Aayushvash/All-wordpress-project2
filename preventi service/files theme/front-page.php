<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<div class="centring">
                        
                    <div class="leftbox">
                    
                        <!-- begin service block -->
                        <article class="service-block">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>  
                                <h2><?php if(get_field('title_2')){ echo get_field('title_2'); }else{ the_title(); } ?></h2>                         
                                <?php the_content(); ?>
                            <?php endwhile; wp_reset_query(); endif;  ?>
<div class="clear"></div>							
                        </article>
                        <!-- finish service block -->
                    
                    </div>
                        
                    <div class="rightbox">
                    
                        <!-- begin service block -->
                        <article class="service-block">
                    
                            <div class="resquest">
                            
<img src="<?php bloginfo('template_url'); ?>/images/resqusest-img@2x.png" alt="" width="54" height="54" />
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home_right_sidebar') ) : ?> <?php endif; ?>
                                
                            </div>
                        
                        </article>
                        <!-- finish service block -->
                
                    </div>
                        
                    </div>
                
                <!-- begin average block -->
                <article class="average-block">
                
                	<div class="centring">
                    
                        <ul>
							<?php 
                            $rows = get_field('percentage_text');
                            if($rows){
                            foreach($rows as $row){ 
                            $number = $row['number'];
                            $text = $row['text'];
                            ?>
                              <li><h2><?php echo $number; ?></h2><?php echo $text; ?></li>
                            <?php }
                            }?>         
                        </ul>
                    
                    </div>
                
                </article>
                <!-- finish average block -->
                
                <!-- begin news block -->
                <article class="news-block">
                
                	<div class="centring">
                    
                    	<h2>Bekijk het laatste nieuws</h2>
                        
                        <p class="sub">Wij houden u regelmatig op de hoogte van de onwikkelingen rond om veiligheidstrainingen</p>
                        
                        <div class="full desktopview">
                         <?php 
							   query_posts('post_type=post&showposts=3');
							    if (have_posts()) : while (have_posts()) : the_post(); ?>  
                        	<div class="one">
                            
                            	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-img2'); ?></a>
                                
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                
                                <span><?php the_time('d F Y') ?></span>
                                
                                <p> <?php echo get_the_excerpt(); ?>...</p>
                                
                                <a href="<?php the_permalink(); ?>" class="btn2">Lees verder</a>
                            
                            </div>
                            
                             <?php endwhile; wp_reset_query(); endif;  ?>   
                        
                        </div>
						
						<div class="newsSlider mobileview">
							<ul class="slides">
										<?php
										query_posts('post_type=post&showposts=3');
										if (have_posts()) : while (have_posts()) : the_post(); ?> 
											<li>
												<div class="full">										
													<div class="one">
														<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-img2'); ?></a>
														<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
														<span><?php the_time('d F Y') ?></span>
														<p> <?php echo get_the_excerpt(); ?>...</p>
														<a href="<?php the_permalink(); ?>" class="btn2">Lees verder</a>
													</div>
												</div>
											</li>
										<?php endwhile; wp_reset_query(); endif;  ?>  
							</ul>
						</div>
                        
                        <div class="btn-full"><a href="?page_id=11" class="btn">BEKIJK ALLE BERICHTEN</a></div>
                        
                    </div>
                
                </article>
                <!-- finish news block -->
                
                <!-- begin client block -->
                <article class="client-block">
                
                	<div class="centring">
                    
                    	<div class="left">
                        	
                           <h2>Onze klanten</h2> 
                           
                           <p>Vele bedrijven gingen u voor,<br>waar wacht u nog op?</p>
                        
                        </div>
                        
                        <div class="right">
                        
                        	<div class="owl-carousel">
                            
                                <?php
							   query_posts('post_type=klanten&&showposts=-1');
							    if (have_posts()) : while (have_posts()) : the_post(); ?>     
                                <div class="item">
                                <?php if(get_field('add_link')) { ?>
                                <a href="<?php echo get_field('add_link'); ?>"> <?php the_post_thumbnail(); ?></a>
                                <?php }else { ?>
                                    <?php the_post_thumbnail(); } ?>
                                </div>
                            <?php endwhile; wp_reset_query(); endif; ?>     

                    	</div>
                    
                  	</div>
                    
                  </div>
                <div class="clear"></div>
                </article>
                <!-- finish client block -->
                
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