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
                    
                    	<div class="head">    <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
    <?php /* If this is a category archive */ if (is_category()) { ?>
    <h3 class="pagetitle"><?php single_cat_title(); ?></h3>
    <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
    <h3 class="pagetitle"><?php single_tag_title(); ?></h3>
    <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
    <h3 class="pagetitle"><?php the_time('F jS, Y'); ?></h3>
    <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
    <h3 class="pagetitle"><?php the_time('F, Y'); ?></h3>
    <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
    <h3 class="pagetitle"><?php the_time('Y'); ?></h3>
    <?php /* If this is an author archive */ } elseif (is_author()) { ?>
    <h3 class="pagetitle">Author Archive</h3>
    <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    <h3 class="pagetitle">Blog Archives</h3>
    <?php } ?></div>
                        
                        <div class="np">
                        
                        	<ul>
                            
                            	<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
                                <li><?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
    <?php /* If this is a category archive */ if (is_category()) { ?>
    <?php single_cat_title(); ?>
    <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
    <?php single_tag_title(); ?>
    <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
    <?php the_time('F jS, Y'); ?>
    <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
     <?php the_time('F, Y'); ?>
    <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
    <?php the_time('Y'); ?>
    <?php /* If this is an author archive */ } elseif (is_author()) { ?>
    Author Archive
    <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    Blog Archives
    <?php } ?></li>
                            
                            </ul>
                        
                        </div>
                    
                    </div>
            <div class="overlay"></div>
            	</article>
            	<!-- finish blog block -->

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

