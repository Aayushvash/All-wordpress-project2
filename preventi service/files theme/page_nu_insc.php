<?php
/**
 Template name: Nu Inschrijven
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
				<article class="content-block register">

					<div class="centring">
                    
                    	<div class="leftbox register">
                        
                            							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>  
                                <h2><?php if(get_field('title_2')){ echo get_field('title_2'); }else{ the_title(); } ?></h2>                         
                                <?php the_content(); ?>
                            <?php endwhile; wp_reset_query(); endif;  ?>
                            
                            <div class="select-course">
                            
                            	<form>
                                
                                	<h4>Kies uw gewenste cursus:</h4>
									<?php $terms = get_terms('type'); ?>
                                    <select name="cursus" id="cursus">
                                      <option value="selectCur">Selecteer cursus</option>
									  <?php foreach($terms as $term){ ?>
                                      <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                                      <?php } ?>
                                    </select>
                                
                                </form>
                            
                            </div>
                            
                            <div class="courses">
								<?php $cid = get_field('select_cursus'); 
								$quantityTermObject = get_term_by( 'id', absint( $cid ), 'type' );
								$quantityTermName = $quantityTermObject->name; 
								$quantityslug = $quantityTermObject->slug; 
								?>	
                                
									<div id="mycursus">
									<div id="selectCur" class="cursus">
									<h3 class="curName"><a href="<?php echo get_term_link( $cid, 'type'); ?>"><?php echo $quantityTermName; ?></a></h3>
										<?php query_posts(array('post_type'=>'nuinschrijven','taxonomy'=>'type','term'=>$quantityslug,'showposts'=>-1));
										if (have_posts()) : while (have_posts()) : the_post(); ?>  
										<div class="course-list">
										
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('img4'); ?></a>
											<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
											<p><?php echo get_the_excerpt(); ?>...&nbsp;<a href="<?php the_permalink(); ?>" class="read-more">&gt; Meer lezen</a></p>
											<?php $tags = get_the_terms(get_the_ID(),'tags');  ?>
											<ul>
												<?php foreach($tags as $term){ ?>
											  <li><a href="<?php echo get_term_link( $term, 'tags'); ?> "><?php echo $term->name; ?></a></li>
											  <?php } ?>                                   
											</ul>
										
										</div>
										<?php endwhile; wp_reset_query(); endif;  ?>
                                     </div>										
									<?php $terms = get_terms('type'); foreach($terms as $term){ ?>
									<div id="<?php echo $term->slug; ?>" class="cursus" style="display:none; ">
									<h3 class="curName"><a href="<?php echo get_term_link( $term, 'type'); ?>"><?php echo $term->name; ?></a></h3>
										<?php query_posts(array('post_type'=>'nuinschrijven','taxonomy'=>'type','term'=>$term->slug,'showposts'=>-1));
										if (have_posts()) : while (have_posts()) : the_post(); ?>  
										<div class="course-list">
										
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('img4'); ?></a>
											<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
											<p><?php echo get_the_excerpt(); ?>...&nbsp;<a href="<?php the_permalink(); ?>" class="read-more">&gt; Meer lezen</a></p>
											<?php $tags = get_the_terms(get_the_ID(),'tags');  ?>
											<ul>
												<?php foreach($tags as $term){ ?>
											  <li><a href="<?php echo get_term_link( $term, 'tags'); ?> "><?php echo $term->name; ?></a></li>
											  <?php } ?>                                   
											</ul>
										
										</div>
										<?php endwhile; wp_reset_query(); endif;  ?> 
										</div>
									<?php } ?>
									</div>
                                <div class="clear"></div>
                                
                                <span class="top"><a href="javascript:void(0);">Terug naar boven</a></span>
                            
                            </div>
                            
                            
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