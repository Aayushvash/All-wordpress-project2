<?php get_header();?>
<?php
$args = array(
	'page_id'=>53
);
query_posts($args);
if (have_posts()) : while (have_posts()) : the_post();
?>
<div id="banner-wrap">
    <!-- banner block -->
	<div class="bannerinner-block">
		<div class="banner">
			<?php the_post_thumbnail('slider_image');?> 
		</div>
	</div>       
</div>
<?php endwhile; wp_reset_query();?>
<?php endif; ?>

<div class="fourbox-block">
	
    	<div class="centering">
        
		  <div class="centers">
		
                <ul class="reless nav">
                
					<?php query_posts(array('post_type'=>'anechoic box','order'=>'ASC','posts_per_page'=>4));
                    $i=1;
                        if(have_posts()):while(have_posts()):the_post();
                    
                    $id = get_the_id();
                    ?>               
						
                        <li class="tp-<?php echo $i; ?>"> <a class="current1" href="<?php the_permalink(); echo '#eckoustic' ?>"><?php the_title(); ?></a><cite></cite></li>
					                     
                    
                    <?php $i++; endwhile; wp_reset_query(); endif; ?>
                    
                </ul>
		   </div>
        
      </div>
		
	</div>	


<?php
$args = array(
	'page_id'=>53
);
query_posts($args);
if (have_posts()) : while (have_posts()) : the_post();
?>
<div class="caption-block">
    <h2><?php the_title(); ?></h2>
</div>
<div class="product-block">
	<div class="productlayin">
		<div class="prodcenter">
			<?php the_content(); ?>
		</div>
	</div>
</div>
<?php endwhile; wp_reset_query();?>
<?php endif; ?>
<!-- baner wrap -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
<div id="banner-wrap">

	<!-- banner block -->
	<div class="bannerinner-block">
	<div id="eckoustic"></div>
		<div class="banner">
			<?php the_post_thumbnail('slider_image');?>                                    	
		</div>
		<div class="sidebarBox">
			<div class="sid-img scrollingBox">
				<a href=" http://64.131.77.249/eckel/calculation-form/"><img src="<?php echo get_template_directory_uri();?>/images/ab-but.png"></a>
			</div>
		</div>
	</div>       
	<!--finish banner block -->
</div>			
<!-- finsh banner wrap -->
<div id="content-wrap">
	<div id="center-wrap">
		<div class="caption-block">
			<h2><?php the_field('title'); ?> </h2>
		</div>
		<div class="hemianichoic-block">
			<div class="centering">
				<div class="company-block">
					<div class="companycontent">
						<?php the_content(); ?>
					</div>		
				</div>
				<div class="hemileft">
					<?php the_field('left_box'); ?>
				</div>
				<div class="hemiright">
					<?php the_field('right_box'); ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="hemichoicbox-block">
			<div class="centering">
				<ul class="reless1 tabs-menu">
					<?php $i=1; if(have_rows('sub_design')): while(have_rows('sub_design')) : the_row();
					$chm= get_sub_field('left_title');

					?>
					<li ><a id="ks<?php echo $i; ?>" class="" rel="" href="#tab-<?php echo $i; ?>"><?php echo $chm;  ?></a><cite></cite></li>
						<?php $i++; endwhile; else :  endif; ?>
				</ul> 
			</div>	
		</div>
		<div class="clear"></div>
		<div class="tab2">
		<div class="centering">
		
			<?php $i=1; 
			if(have_rows('sub_design')): 
			while(have_rows('sub_design')) : the_row();
			$left_box = get_sub_field('left_box');
						?>
			<div id="tab-<?php echo $i; ?>" class="text2 resFil tab-content">	
					
				<?php echo do_shortcode($left_box); ?>
				<!--end chember design -->		


			</div>
			
			<?php  $i++; endwhile;  wp_reset_query(); endif; ?>
		
			
			
		</div>
		</div>
	</div>
	
	
</div>
<?php endwhile; wp_reset_query(); ?>
<?php endif; ?>

<?php get_footer();?>