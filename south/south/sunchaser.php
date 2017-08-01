<?php get_header();  /*
Template Name: Sunchaser Page Template 
*/  $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>

	<div id="banner-wrap" class="inner-brand">
        <img alt="" src="<?php echo $feat_image;  wp_reset_query();?>" />
		<div class="bran-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/bran-logo.png"></img></div>
	</div>
</div>
<!--  content -->
<div id="content" class="content-block">
<!-- finish  header --> 
	<div class="centring">
	
	<!-- begin family block -->
				<div class="family-block">
				
					<?php
				wp_reset_query();

                    $taxonomy = 'sunchaser_category';

                    $tax_terms = get_terms($taxonomy);

				 $k=1; $i=1;

                    foreach ($tax_terms as $tax_term) {   ?>
				
					<div class="box-block <?php echo $right;   ?>">	
					<div class="image">
					<img src="<?php the_field('category_image', $tax_term); ?>" />
					</div>
					
                	<div class="text">
						<div class="data">
							<a href="javascript:void(0)" class="names"><h1><?php   echo $tax_term->name;?></h1></a>
							<div class="menus">	
							<ul>
<?php	query_posts(array('post_type'=>'sunchaser', 'orderby' => 'term_order', 'order' => 'ASC',  'taxonomy' => 'sunchaser_category', 'showposts' => -1,'field' => 'slug','term'=>$tax_term->slug ));  if(have_posts()):while(have_posts()):the_post(); ?>	
									<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

						
				<?php $i++; endwhile; ?>
					<?php  else :  endif;  wp_reset_postdata();  ?>	
							</ul>					
							</div>
						</div>
						 <div class="clear"></div>
					</div>
					</div>	
					<div class="<?php echo $class;   ?>"></div>
					<?php $i++; $k++; } ?>
					
				</div>
				<!-- finish family block -->
	<div class="clear"></div>
	</div>
<?php get_footer();  ?>
