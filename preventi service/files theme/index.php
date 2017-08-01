<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); 
$page_for_posts = get_option( 'page_for_posts' );
$url = wp_get_attachment_url( get_post_thumbnail_id($page_for_posts) );
?>
      	<!-- begin blog block -->
        		<article class="blog-block" <?php if($url){ ?>style="background: url(<?php echo $url; ?>) no-repeat top center;" <?php } ?>>
                
                	<div class="centring">
                    
                    	<div class="head"><h3><?php echo get_the_title($page_for_posts); ?></h3></div>
                        
                        <div class="np desktopview">
                        
                        	<ul>
                            
                            	<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
                                <li><?php echo get_the_title($page_for_posts); ?></li>
                            
                            </ul>
                        
                        </div>
                    
                    </div>
            <div class="overlay"></div>
            	</article>
            	<!-- finish blog block -->
				
				<article class="bread-block mobileview">
					<div class="centring">
						<div class="np"> 
							<ul>
								<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
								<li><?php echo get_the_title($page_for_posts); ?></li>
							</ul>       
						</div>
					</div>	
				</article>

		<!-- begin content block -->
		<article class="content-block">

			<div class="centring">
			
			<!-- begin leftbox -->
			<div class="leftbox blog">
			
				<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
				<div class="img-block">
					<div class="imageBox">
					   <a  href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-img1'); ?></a>
					   <span class="bottom-bg"></span>
					</div>

					<div class="blog-part">                                

						<ul>
							<li class="clock"><?php the_time('d F Y') ?></li>
							<li class="user"><?php the_author() ?></li>
							<li class="folder"><?php the_category(', ') ?></li>
						</ul>
						<div class="desktopview">
							<span class="blog-icon"><?php if(get_field('add_pdf')){ ?><a href="<?php the_field('add_pdf'); ?>" target="_blank">&nbsp;</a><?php } ?></span>
							<h4><?php the_title(); ?></h4>
							<p><?php echo get_the_excerpt(); ?>[...]</p>
							<a href="<?php the_permalink(); ?>" class="btn3">Lees verder</a>
                        </div>
					</div> 

					<div class="clear"></div>

					<div class="blogDeatilsBar mobileview">
						<div class="blog-part">                                
							<span class="blog-icon"><?php if(get_field('add_pdf')){ ?><a href="<?php the_field('add_pdf'); ?>" target="_blank">&nbsp;</a><?php } ?></span>
							<h4><?php the_title(); ?></h4>
							<p><?php echo get_the_excerpt(); ?>[...]</p>
							<a href="<?php the_permalink(); ?>" class="btn3">Lees verder</a>
						</div> 
					</div>					

				</div>
				<?php endwhile; ?>

				<?php else : ?>

				<h2 class="center">Not Found</h2>

				<p class="center">Sorry, but you are looking for something that isn't here.</p>

				<?php get_search_form(); ?>

				<?php endif; ?>

				<div class="pagination">
					<?php
					if(function_exists('wp_paginate')) {
					   wp_paginate();
					}
					?> 
				</div>

			</div>
			<!-- finish leftbox -->

			<!-- begin rightbox -->                   
			<div class="rightbox blog">

			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('blog_right_sidebar') ) : ?> <?php endif; ?>

			</div>
			<!-- finish rightbox -->

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