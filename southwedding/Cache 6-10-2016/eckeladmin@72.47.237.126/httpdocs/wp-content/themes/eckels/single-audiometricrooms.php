<?php get_header();?>
<?php
$args = array(
	'page_id'=>56
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

<div class="fourbox-block audiometric-block">
	<div class="center">
		<div class="centering">
            <ul class="reless nav">
				<?php query_posts(array('post_type'=>'audiometricrooms','order'=>'ASC','post_per_page'=>2));
						$i=1; if(have_posts()):while(have_posts()):the_post();
						$id = get_the_id(); ?>
					<li class="ag-<?php echo $i; ?>"><a class="current3" href="<?php the_permalink(); echo '#eckoustic' ?>"><?php the_title(); ?></a><cite></cite></li>
								
					<?php $i++; endwhile; wp_reset_query(); endif; ?>	
			</ul>
        </div>
	</div>
</div>
<?php
$args = array(
	'page_id'=>56
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
 <div class="audiometrics-block">
	<div class="center">
		<div class="centering">
			<ul class="reless3">
			<?php $i=1;  if( have_rows('subrepetar') ): while( have_rows('subrepetar') ): the_row(); ?> 
				<li class="aab-<?php echo $i; ?>"><a  href="#abg-<?php echo $i; ?>"><?php the_sub_field('title'); ?></a></li>
			<?php $i++; endwhile; endif;?>
			</ul>
		</div>
	</div>	
</div>
<div class="tab5">
<?php $i=1;	if( have_rows('subrepetar') ): while( have_rows('subrepetar') ): the_row(); ?>
	<div id="abg-<?php echo $i; ?>" class="text5 resFil">
		<div class="APLSprod-block">
			<div class="aplscenter">
				<div class="caption-block">
					<?php the_sub_field('description'); ?>
				</div>
			</div>
		</div>
	
		<div class="APLSprod-block">
			<div class="centering">
				<div class="aplscenter">
					<?php the_sub_field('description2'); ?>
				</div> 
			</div>
		</div>
	</div>
<?php $i++;  endwhile; endif;?>
</div>

<!--cam lock Design-->  
<?php 
$desc = get_field('common_description');
 ?>
 
 <?php if($desc) { ?>
<div class="camlock-block">
    <div class="centering">
        <div class="left">
			<div class="caption-block">
				<?php if($desc) { ?>
				<?php echo $desc; ?>
				<?php } ?>
			</div>	 
		</div>
		<div class="right">
            <?php $imag2 = get_field('image_right');?>
			<?php if($imag2){ ?>
            <img src="<?php echo $imag2['sizes']['right_image']; ?>" />
			<?php } ?>
        </div>
<?php //endwhile; endif; ?>
	</div>
</div>
 <?php } ?>
 
<!--Finish cam lock Design--> 
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>