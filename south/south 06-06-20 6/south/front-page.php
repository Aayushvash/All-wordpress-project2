<?php get_header(); ?>

	<div id="banner-wrap">
      <?php $slider_shortcode=get_field('slider_shortcode'); echo do_shortcode(''.$slider_shortcode.''); ?>  
	</div>


</div>
		<!-- finish  header --> 

		<!--  content -->
		<div id="content">
			<!-- boxes --->
				<div class="box">
					<div class="centring">
					<?php if(have_rows('home_box')): while (have_rows('home_box')) : the_row(); 
						$img = get_sub_field('image');
						$logo = get_sub_field('logo');
						$link = get_sub_field('link');
							?>
					<div class="home_box">
					<a class="brand-link" href="<?php echo $link; ?>"><img src="<?php echo $img['sizes']['home-brand-img']; ?>" alt="" />
					<span><img src="<?php echo $logo; ?>" alt="" /></span></a>
					
					<div class="overlay"></div>
					<a href="<?php echo $link; ?>" class="inv-link">View Inventory</a>
					</div>
					
					<?php endwhile; endif;  ?>
								
					 <?php // if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('home_sidebar') ) : ?>
					<?php // endif; ?>
								
					 </div>
					 <div class="clear"></div>
				 </div>
			<!-- finish boxes --->	
			
			<!-- start rental --->	
			<div class="centring">				
				<div class="rental">
				
				<?php if(have_rows('rental_image')): while (have_rows('rental_image')) : the_row(); 
						$img = get_sub_field('overlay_image');
						$logo = get_sub_field('origianal_image');
						$link = get_sub_field('link');
						$title = get_sub_field('title');
							?>
				<div class="image">
				<a  href="<?php echo $link; ?>"><img class="over-lay" src="<?php echo $img; ?>" alt="" />
					<img class="orgi-img" src="<?php echo $logo; ?>" alt="" /></a>
					
					<h1><?php echo $title; ?></h1>
				
				</div>
						<?php endwhile; endif; ?>
									
						 <?php // if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('home_rental') ) : ?>
						<?php // endif; ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="post text" id="post-<?php the_ID(); ?>">
    
    	<h2><?php the_title(); ?></h2>
        
        <div class="entry">
            <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
    
            <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
    
        </div>
    
    </div>
    
	<?php endwhile; endif; ?>
						 
						 <div class="clear"></div>
				</div>				
			<!-- finish rental --->	
			
			<!-- start service --->			
				<div class="service">
				
				<?php if(have_rows('service_image')): while (have_rows('service_image')) : the_row(); 
						$img = get_sub_field('overlay_image');
						$logo = get_sub_field('origianal_image');
						$link = get_sub_field('link');
						$title = get_sub_field('title');
							?>
				<div class="image">
				<a  href="<?php echo $link; ?>"><img class="over-lay" src="<?php echo $img; ?>" alt="" />
					<img class="orgi-img" src="<?php echo $logo; ?>" alt="" /></a>
					
					<h1><?php echo $title; ?></h1>
				
				</div>
						<?php endwhile; endif; ?>
						
									
						 <?php  if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('home_service') ) : ?>
						<?php  endif; ?>
									
						
						 <div class="clear"></div>
				</div>				
			<!-- finish service --->	
			</div>
			
				 


<?php get_footer();  ?>
