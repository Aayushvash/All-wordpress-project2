<?php
/**
 Template name: Contact
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

								<!-- begin contact block -->
				<article class="contact-block">

					<div class="centring">
                    
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>  
							<h2><?php if(get_field('title_2')){ echo get_field('title_2'); }else{ the_title(); } ?></h2>                         
							<?php the_content(); ?>
						<?php endwhile; wp_reset_query(); endif;  ?>
                    
                    </div>

				</article>
				<!-- finish contact block -->
                
                <!-- begin address block -->
                <article class="address-block">
				
						<?php 
						$rows = get_field('add_contant');
						if($rows)
						{ $i=1;
							foreach($rows as $row)
							{ 
							$w=$row['image']['width'];
							$h=$row['image']['height'];
							?>
								<div class="one <?php if($i==2){ echo "active"; } ?>">
									<img alt="" src="<?php echo $row['image']['url']; ?>" width="<?php echo floor($w/2); ?>" height="<?php echo floor($h/2); ?>"/>                      
									<h5><?php echo $row['title']; ?></h5>            
									<?php echo $row['text']; ?>
									<img class="icon" alt="" src="<?php bloginfo('template_url'); ?>/images/icon.png"  /> 
								</div>
							<?php $i++; } 
						} ?>              
                    
                    <div class="map">
                    
                        <div id="map"></div>
                        
                    </div>
                
                </article>
                <!-- finish address block -->
                
                <!-- begin signup block -->
                <article class="signup-block">
                
                	<div class="centring">
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('newsletter_sidebar') ) : ?> <?php endif; ?>
                    	
                    
                    </div>
                
                </article>
                <!-- finish signup block -->
	<div id="inline1" style="max-width:700px;display: none;">
<?php echo do_shortcode('[contact-form-7 id="160" title="Call back Service"]'); ?>
	</div>
<?php get_footer(); ?>
