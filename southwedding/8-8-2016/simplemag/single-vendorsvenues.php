<?php 
/**
 * The Template for displaying all single blog posts
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
global $ti_option;
?>

<?php get_header(); ?>
<link rel="fancybox" href="<?php bloginfo('template_url'); ?>/css/jquery.fancybox.css" type="text/css" media="screen" />
		
    <section id="content" role="main" class="clearfix animated">

	<?php 
    if ( have_posts() ) :
      while ( have_posts() ) : the_post(); 
    ?>
           
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                      
        
        <div class="wrapper">
			
            <div class="grids single-vendor ">
			<header class="entry-header">
                <h1 class="entry-title page-title inner"> 
                    <span><?php the_title(); ?></span>
                </h1>
            </header>
				<div class="grid-4">
				<div class="full-box"> 
					<div class="logo-box">
					<?php the_post_thumbnail(); ?>
					
					</div>
					<div class="center">
					<span><?php the_field('location'); ?></span>
					<span>Phone:<?php the_field('phone'); ?></span>					
					<span>Email:<?php the_field('email'); ?></span>
					<span><a href="<?php the_field('website'); ?>"><?php the_field('website'); ?></a></span>								  
					</div>	
				</div>	
					
				</div>
			
                <div class="grid-8">
					<div class="single-text">
					<?php the_content(); ?>
					
					<!-- AddToAny BEGIN -->
					<!-- AddToAny BEGIN -->
					<div class="share-this">
						<span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st_youtube_large' displayText='Youtube Subscribe' st_username='sharethis'></span>
						<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_pinterest_large' displayText='Pinterest'></span>
						<span class='st_instagram_large' displayText='Instagram Badge' st_username='sharethis'></span>
					</div>
					<!-- AddToAny END -->

					<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
					<script type="text/javascript">stLight.options({publisher: "683e785d-7f73-433e-86a2-ac6805e9fbf0", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

					
					</div>
                    </div><!-- .grid-8 -->
			 <div class="grid-12">
			 <div class="owl-carousel">
					<?php 

					$images = get_field('slider_option');

					if( $images ): ?>

					<?php foreach( $images as $image ): ?>
					
						<div class="grid-4">
						<a class="fancybox" href="<?php echo $image['sizes']['big-size']; ?>" data-fancybox-group="gallery" title="<?php echo $image['caption']; ?>" ><img src="<?php echo $image['sizes']['menu-size']; ?>" alt="<?php echo $image['alt']; ?>" /></a>
															
						
						</div>
					
					<?php endforeach; ?>

					<?php endif; ?>
			 </div>
			 </div>
			 
				<?php $post_objects = get_field('related_posts');

				if( $post_objects ): ?>
			 
			 <header class="entry-header">
                <h1 class="entry-title page-title inner">
                    <span>our featured posts</span>
                </h1>
            </header>
			
			<div class="grids entries">	

				<?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
				<article class="grid-4">
				<figure class="entry-image">
				<a href="<?php the_permalink(); ?>">
				<?php 
				if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'medium-size' );
				} elseif( first_post_image() ) { // Set the first image from the editor
				echo '<img src="' . first_post_image() . '" class="wp-post-image" />';
				} ?>
				</a>
				</figure>

				<header class="entry-header">
				<div class="entry-meta">
				<span class="entry-category"><?php the_category(', '); ?></span>
				<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
				</div>

				<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				</header>

				<?php if( get_sub_field( 'featured_excerpt' ) == 'enable' ) { ?>
				<div class="entry-summary">
				<?php the_excerpt(); ?>
				</div>
				<?php } ?>
				</article>
				<?php endforeach; ?>

				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			 
			 </div>
				<?php endif;

				?>
                
                  
                </div><!-- .grids -->
               
            
            </div><!-- .wrapper -->
        </article>
              
        <?php endwhile; endif; ?>
		
		
				

    </section><!-- #content -->
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.fancybox.js"></script> 
	
	<script>
jQuery(document).ready(function(e) { 

jQuery('.fancybox').fancybox();
	  
		jQuery('.owl-carousel').owlCarousel({

                loop: true,

                margin: 0,

                responsiveClass: true,

                responsive: {

                  0: {

                    items: 1,

                    nav: true

                  },

                  600: {

                    items: 2,

                    nav: true

                  },

				  

				  1024: {

                    items: 3,

					nav: true

					

                  },

				  

                  1100: {

                    items: 3,

                    nav: true,

                    loop: false,

                    margin: 0

                  }

                }
				
				
				
				
        });

	

	

});

</script>

   
    
<?php get_footer(); ?>