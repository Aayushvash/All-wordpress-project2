<?php
/**
 * The archive
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.1
**/
global $ti_option;
?>

<?php get_header(); ?>

	<section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">

		<?php if (have_posts()) : ?>
            
            <header class="entry-header">
                <h1 class="entry-title page-title">
                    <span>
					<?php single_term_title(); ?> 
						
						<?php if (is_category()) { ?>
                        <?php single_cat_title(); ?>
                        
                        <?php } elseif(is_tag()) { ?>
                        <?php single_tag_title(); ?>
                
                        <?php } elseif (is_day()) { ?>
                        <?php the_time('F jS, Y'); ?>
                
                        <?php } elseif (is_month()) { ?>
                        <?php the_time('F, Y'); ?>
                
                        <?php } elseif (is_year()) { ?>
                        <?php the_time('Y'); ?>
                        
                        <?php } elseif ( get_post_format() ) { ?>
                        <?php echo get_post_format(); ?>
                        
                        <?php } elseif (is_author()) { ?>
                        <?php _e ( 'Author Archive', 'themetext' ); ?>
        
                        <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                        <?php } ?>
                    </span>
                </h1>
            </header>
            
			
            <div class="grids">
                <div class="grid-12">
                    
                   
                    <div class="grids <?php echo $posts_layout; ?> entries">
					<div class="enhance-listing">	
						<?php if(have_posts()):while(have_posts()):the_post(); 
							 $check = get_field('enhances_listings');  ?>
								  <?php if($check[0]=='List') { 
							$img = get_field('enhance_image');	?> 
							 
								<article class="grid-4">
									<div class="listing-block" >	
									<div class="image" style="background:url('<?php echo $img; ?>') no-repeat center top; background-size:cover;"></div>	
											<img style="display:none;" src="<?php echo get_template_directory_uri(); ?>/images/en1.jpg" alt=""></img> 		
									 
									  <div class="center">
										<h2><?php the_title(); ?></h2> 
										<a href="<?php the_permalink(); ?>">Click For More Info</a>				  
									  </div>
									 </div>
								</article>
								<?php }  ?>
						<?php endwhile; endif;  ?>
					</div>
					
					<div class="clear"></div>
					<div class="list-block">
						<?php  
							 if(have_posts()):while(have_posts()):the_post(); 
							$check = get_field('enhances_listings'); 
								?>
							<div class="grid-4 " style="<?php if($check[0]=='List') { echo 'display:none;';  } ?>" > 
							
							<h2><?php the_title(); ?><a target="_blank" href="<?php the_field('website'); ?>">View Website</a></h2> 
							</div>
						
						<?php endwhile; endif;   ?>

					</div>
					<?php 
				/*	
					global $post;
$supervisor_tags = get_the_terms($post->ID, 'vvcategories');

echo "<h2>Supervisors:</h2>";

foreach ($supervisor_tags as $tag){
    $term_meta = get_option('taxonomy_' . $tag->term_id);
    echo "<p>Name: " . $tag->name . " - Job Title: " . $term_meta['jobtitle'] . "</p>";
}
					

//Get the correct taxonomy ID by slug
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

//Get Taxonomy Meta
$saved_data = get_tax_meta($term->term_id,'vvcategories_id');
echo $saved_data; 


$directores = get_the_terms( $post->ID, 'vvcategories' ); 
$director = $directores[0];

// print object from first director
print_r($director);

// or get the director name
echo $director->term_meta[vvcategories_id]; */

?>


					
					
		
               
            </div><!-- .grids -->
            <?php endif; ?>
    
		</div>
    </section><!-- #content -->

<?php get_footer(); ?>