<?php get_header();
/* template name:- Anechoic Chambers */ 
 ?>
<!-- baner wrap -->
        <div id="banner-wrap">
        
        	<!-- banner block -->
            <div class="bannerinner-block">
            
            	<div class="banner">
                
                   <?php the_post_thumbnail('slider_image');?>
                                    	
                </div>
                
            </div>       
        
        </div>
			<div class="sid-img">
			<a href=" http://64.131.77.249/eckel/calculation-form/"><img src="<?php echo get_template_directory_uri();?>/images/ab-but.png"></a>
			</div>
        <!-- finsh banner wrap -->

		<div id="content-wrap">
            <!-- begin content -->
            	<div id="center-wrap">
                	<!-- caption block -->
					<div class="caption-block">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="centering">
                        
                            <h2><?php the_title(); ?></h2>
                            
                        </div>
						<?php endwhile; endif; ?>
					</div>
		<!-- end caption block -->
		<!-- company content start here -->
		<div class="company-block">
            
            <div class="centering">
				<div class="companycontent">
				<?php the_content(); ?>
				</div>
			</div>		
		</div>
		<!-- end company content start here -->
	<!-- four box start here -->
	<div class="fourbox-block">
	
		<div class="centers">
		
			<ul class="reless">
			<?php query_posts(array('post_type'=>'anechoic box','order'=>'ASC','posts_per_page'=>4));
			$i=1;
				if(have_posts()):while(have_posts()):the_post();
			
			$id = get_the_id();
			?>
			 
				<li class="tp-<?php echo $i; ?>"> <a class="current1" href="#post-<?php echo $id; ?>"><?php the_title(); ?></a></li>
				
			
		<?php $i++; endwhile; endif; ?>
		</ul>
		</div>
		
	</div>	
		
	<!-- img start here	--> 
		<div id="banner-wrap">
       
	   <div class="tab">
	   
        	<!-- banner block 1 -->
			<?php query_posts(array('post_type'=>'anechoic box','order'=>'ASC','posts_per_page'=>4));
				if(have_posts()):while(have_posts()):the_post();
			$i=1;
			$id = get_the_id();
			?>
			
            <div id="post-<?php echo $id; ?>" class="text1 resFil">
			<div class="bannerinner-block">
            
            	<div class="banner">
                
                   <?php the_post_thumbnail('slider_image');?>
                                    	
                </div>
                
            </div>       
        
        
		<!-- anechoic title -->
		<div class="caption-block">
           
			<div class="centering">
			
			<h2><?php the_field('title'); ?> </h2>
				
			</div>
			
		</div>
		
		<!-- left and right content -->
		<div class="hemianichoic-block">
			<div class="centering">
			
			<div class="company-block">
            	<div class="companycontent">
				<?php the_content(); ?>
				</div>		
		    </div>
			
			
				<div class="hemileft">
					</p><?php the_field('left_box'); ?>
				</div>
				<div class="hemiright">
					<?php the_field('right_box'); ?>
				</div>
				<div class="clear"></div>
			</div>
		
		</div>
		
		<!-- two boxes -->
		
		<div class="hemichoicbox-block">
			<div class="centering">
				<ul>
					<li>Chamber Design</li>
					<li>Wedge Technology</li>
				</ul> 
			</div>
		
		</div>
		</div>
		<?php $i++; endwhile; endif; ?>
	
		</div>
		
		</div>
<?php get_footer(); ?>

