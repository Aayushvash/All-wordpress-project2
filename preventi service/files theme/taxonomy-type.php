<?php
get_header(); ?>
<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
global $wp_query;
$term = $wp_query->get_queried_object();
$title = $term->name;
$termId = $term->term_id;
?>
<!-- begin subpage block -->

        		<article class="subpage-block" style="background: url(<?php  echo get_field('header_image', 'type_'.$termId); ?>) no-repeat 100%/cover;">
                
                	<div class="centring">
                    
                    	<div class="head"><h3><?php echo $title; ?></h3></div>
                        
                        <div class="np desktopview">
                        
                        	<ul>
                            
                            	<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
                                <li><?php echo $title; ?></li>
                            
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
								 <li><?php echo $title; ?></li>
							</ul>       
						</div>
					</div>	
				</article>

				<!-- begin content block -->
				<article class="content-block register">

					<div class="centring">
                    
                    	<div class="leftbox register">
                        
							
								<h2><?php echo get_field('add_title', 'type_'.$termId);  ?></h2>                         
								<?php  echo get_field('add_text', 'type_'.$termId); ?>
							
                                                     
                            <div class="courses">
								            <?php 	if (have_posts()) : ?>                    
								<h3 class="curName"><?php echo $title; ?></h3>
								 <?php while (have_posts()) : the_post(); ?>  
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
								<?php endwhile; wp_reset_query(); ?>
                                <div class="clear"></div>
                                
                                <span class="top"><a href="javascript:void(0);">Terug naar boven</a></span>
								
								<?php endif;  ?>
                            
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