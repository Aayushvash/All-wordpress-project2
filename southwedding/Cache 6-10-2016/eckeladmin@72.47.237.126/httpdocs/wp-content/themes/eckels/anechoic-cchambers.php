<?php 
/* template name:- Anechoic Chambers */ 
get_header();

 ?>
		<!-- baner wrap -->
        <div id="banner-wrap">
        
        	<!-- banner block -->
            <div class="bannerinner-block">
				
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
            <!-- begin content -->
         <div id="center-wrap">
         
		 <!-- fourbox-block -->
	<div class="fourbox-block">
	
    	<div class="centering">
        
		  <div class="centers">
		
                <ul class="reless nav">
                
					<?php query_posts(array('post_type'=>'anechoic box','order'=>'ASC','posts_per_page'=>4));
                    $i=1;
                        if(have_posts()):while(have_posts()):the_post();
                    
                    $id = get_the_id();
                    ?>
                     
                        <li class="tp-<?php echo $i; ?>"> <a class="current1" href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
                        
                    
                    <?php $i++; endwhile; endif; wp_reset_query(); ?>
                    
                </ul>
		   </div>
        
      </div>
		
	</div>	
	<!--finish fourbox-block -->
	
	<div class="clear"></div>
		 
		 
             <!-- acc block -->
			<div class="acc-block">
            
					<div class="centering">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                    
                        <h2><?php the_title(); ?></h2>
                        
                    </div>
                    <?php endwhile; endif;  wp_reset_query(); ?>
			</div>
		    <!-- end caption block -->
            
            
		<!-- company-block -->
		<div class="company-block">
            
            <div class="centering">
            
				<div class="companycontent">
                
				<?php the_content(); ?>
                
				</div>
                
			</div>	
            	
		</div>
		<!-- company-block -->
    
</div>

	
		</div>
		<div class="clear"></div>
		
<?php get_footer(); ?>
