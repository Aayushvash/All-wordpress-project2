<?php get_header();?>
<?php
$args = array(
	'page_id'=>59
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

<div class="fourbox-block reclayin-block">
                      
                      	<div class="centering">
                      
                          <div class="center">
                          
                             <ul class="reless nav">
							 <?php query_posts(array('post_type'=>'Acoustic Panel','order'=>'ASC','post_per_page'=>3));
									$i=1;
								if(have_posts()):while(have_posts()):the_post();
								$id=get_the_id();		
							 ?>
                             
                               <li class="fg-<?php echo $i; ?>"><a class="current2" href="<?php the_permalink(); echo '#eckoustic'?>"><?php the_title(); ?></a><cite></cite></li>
                               
                               <?php $i++; endwhile; wp_reset_query(); endif; ?>
                             </ul>
                             
                          </div>
                          
                        </div>
                          
                       </div>



<?php
$args = array(
	'page_id'=>59
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
<div class="caption-block">
    <h2><?php the_title(); ?></h2>
</div>
<div class="APLSprod-block">
    <div class="centering">
        <div class="aplscenter">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<div class="APLSprod-block">
    <div class="centering">
		<div class="aplscenter">
			<?php the_field('design'); ?>
        </div>
	</div>
</div>
<div class="typicalper">
	<div class="centering">
		<?php the_field('design_common'); ?>
	</div>
</div>

<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>