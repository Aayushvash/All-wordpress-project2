<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>
<?php $url = get_field('header_image');
$page_for_posts = get_option( 'page_for_posts' );
$url2 = wp_get_attachment_url( get_post_thumbnail_id($page_for_posts) );
$cid = get_the_ID();
 ?>
      	<!-- begin blog block -->
        		<article class="blog-block" <?php if($url){ ?>style="background: url(<?php echo $url; ?>) no-repeat top center;" <?php }else { ?>style="background: url(<?php echo $url2; ?>) no-repeat top center;"<?php } ?>>
                
                	<div class="centring">
                    
                    	<div class="head"><h3><?php the_title(); ?></h3></div>
                        
                        <div class="np desktopview">
                        
                        	<ul>
                            
                            	<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
                                <li><a href="<?php echo get_permalink($page_for_posts); ?>"><?php echo get_the_title($page_for_posts); ?></a></li>
                                <li><?php the_title(); ?></li>
                            
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
                                <li><a href="<?php echo get_permalink($page_for_posts); ?>"><?php echo get_the_title($page_for_posts); ?></a></li>
                                <li><?php the_title(); ?></li>
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
<div class="img-block single">

	<div class="imageBox">
					   <?php the_post_thumbnail('blog-img1'); ?>
					   <span class="bottom-bg"></span>
					</div>

<div class="blog-part">                                

<ul>
<li class="clock"><?php the_time('d F Y') ?></li>
<li class="user"><?php the_author() ?></li>
<li class="folder"><?php the_category(', ') ?></li>
</ul>

<span class="blog-icon"><?php if(get_field('add_pdf')){ ?><a href="<?php the_field('add_pdf'); ?>" target="_blank">&nbsp;</a><?php } ?></span>

<h4 class="desktopview"><?php the_title(); ?></h4>

</div>

<h4 class="singleTitle mobileview"><?php the_title(); ?></h4>
                           	
<?php the_content(); ?>
</div>
<?php endwhile; ?>
    
            <div class="social-block">
                                                       
                            	<p>Vond u dit bericht leuk? Deel het met uw vrienden!</p>
                                
   
                                <?php echo do_shortcode('[addtoany]'); ?>
                            </div>
                            
                            <div class="post-block">
                                                       
                            	<span class="prev"><?php previous_post_link('%link','Vorig bericht'); ?></span>                              
                                
                                <a href="<?php echo get_permalink($page_for_posts); ?>">
									<ul>
										<li><span class="s-btn"></span></li>                           
										<li><span class="s-btn"></span></li>                           
										<li><span class="s-btn"></span></li>                           
									</ul>
                                </a>
								
                                <span class="next"><?php next_post_link('%link','Volgend bericht'); ?></span>
                                
                            </div>
    
    <?php else :  endif; ?>


                            

</div>
<!-- finish leftbox -->

<!-- begin rightbox -->                   
<div class="rightbox blog">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('blog_details_right_sidebar') ) : ?> <?php endif; ?>

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

