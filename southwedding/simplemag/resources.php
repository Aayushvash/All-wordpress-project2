<?php 
/**
 * Template Name: Resources
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.2
**/ 
global $ti_option;
?>

<?php get_header(); ?>
	
	<section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">
			<?php
			// Enable/Disable sidebar based on the field selection
		//	if ( ! get_field( 'page_sidebar' ) || get_field( 'page_sidebar' ) == 'page_sidebar_on' ):
			?>
            <div class="grids">
                <div class="grid-12">
					
						<?php
			

                    $taxonomy = 'vvcategories';

                    $tax_terms = get_terms($taxonomy);

					

				 $i=1;

                    foreach ($tax_terms as $tax_term) { ?>
					
					<header class="entry-header">
						<h1 class="entry-title page-title inner">
							<span><a href="<?php echo get_term_link($tax_term);  ?>"><?php echo $tax_term->name; ?></a></span>
						</h1>
						<div class="clear"></div>
					</header>
				<div class="enhance-listing">
		<div class="owl-carousel">				
		 <?php	query_posts(array('post_type'=>'vendorsvenues', 'orderby' => 'term_order', 'order' => 'Desc',  'taxonomy' => 'vvcategories', 'showposts' => -1,'field' => 'slug','term'=>$tax_term->slug ));  if(have_posts()):while(have_posts()):the_post(); 
		 $check = get_field('enhances_listings'); 
		 
		 ?>
		 <?php if($check[0]=='List') { 
		$img = get_field('enhance_image');	?> 
		 <div class="item">
			<div class="grid-4">
				<div class="listing-block" >	
				<div class="image" style="background:url('<?php echo $img; ?>') no-repeat center top; background-size:cover;"></div>	
						<img style="display:none;" src="<?php echo get_template_directory_uri(); ?>/images/en1.jpg" alt=""></img> 		
				 
				  <div class="center">
					<h2><?php the_title(); ?></h2> 
					<a href="<?php the_permalink(); ?>">Click For More Info</a>				  
				  </div>
				 </div>
			</div>
		 </div>
			<?php }  ?>
			<?php endwhile; endif;  ?>
			</div>
			</div>
			
				<div class="list-block">
					<?php  
						query_posts(array('post_type'=>'vendorsvenues', 'orderby' => 'term_order', 'order' => 'Desc',  'taxonomy' => 'vvcategories', 'showposts' => -1,'field' => 'slug','term'=>$tax_term->slug ));  if(have_posts()):while(have_posts()):the_post(); 
						$check = get_field('enhances_listings'); 
							?>
					<div class="grid-4 " style="<?php if($check[0]=='List') { echo 'display:none;';  } ?>" > 
					
					<h2><?php the_title(); ?><a target="_blank" href="<?php the_field('website'); ?>">View Website</a></h2> 
					</div>
					
					<?php endwhile; endif;   ?>
					
					
					
					
					

					</div>
					<?php } ?>
							
						
					<div class="clear"></div>	
					
				
				
                </div><!-- .grid-8 -->
            
                <div style="display:none;" class="grid-4">
                    <?php get_sidebar(); ?>
                </div>
            </div><!-- .grids -->
			 <header class="entry-header">
                <h1 class="entry-title page-title inner">
                    <span>our featured posts</span>
                </h1>
            </header>
			
			<div class="grids entries">
			 
					<?php query_posts('post_type=post&showposts=3');
			if (have_posts()) : while (have_posts()) : the_post();
			
			?>
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
					

					<?php endwhile; endif; wp_reset_query();?>
			 
			 </div>
            
        
        </div>
    </section><!-- #content -->
<script>
jQuery(document).ready(function(e) {

	  
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

                    items: 1,

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