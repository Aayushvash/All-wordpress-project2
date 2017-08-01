<?php  get_header (); wp_reset_query();  /*Template Name: Gallery Page Template*/  $feat_image = wp_get_attachment_url( get_post_thumbnail_id() );?>

	<div id="banner-wrap" class="inner-banner">
        <img alt="" src="<?php echo $feat_image;?>" />
		
	</div>
</div>
<!--  content -->
<div id="content" class="content-block">
<!-- finish  header --> 
	<div class="centring">
	
	<!-- begin Gallery block -->
		
	<h1><?php the_title(); ?></h1>
	<?php	
	      query_posts(array( 'post_type'=>'photo_gallery','order'=>'ASC')); ?>
		  <?php $i=1; if (have_posts()) : while (have_posts()) : the_post();  ?>
	 
				<div class="gallery-block">
				
				
					<div class="gallery-left">
					<div id="slider<?php echo $i; ?>" class="flexslider">
          <ul class="slides">
		  <?php   if( have_rows('images') ): // loop through the rows of data
			while ( have_rows('images') ) : the_row();
			$image=get_sub_field('image');	
				?>
            <li>
  	    	    <img src="<?php echo $image['sizes']['gallery-thumb']; ?>" />
  	    		</li>
			
			<?php  endwhile; else :  endif;
			?>
  	    		
          </ul>
		  
		  
		  
        </div>
					
					</div>
					
					<div class ="gallery-right">
					<h1>  <?php the_title(); ?></h1>	
							
							<?php the_content(); ?>
							<!--<a class="more" href="<?php the_permalink();?>"> See more </a>-->

<div id="carousel<?php echo $i; ?>" class="flexslider">
          <ul class="slides">
		  <?php  if( have_rows('images') ): // loop through the rows of data
			while ( have_rows('images') ) : the_row();
			$image=get_sub_field('image');	
				?>
            <li>
  	    	    <img src="<?php echo $image['sizes']['small-thumb']; ?>" />
  	    		</li>
			
			<?php  endwhile; else :  endif;   ?>
		 
            
          </ul>
        </div>					
					
					
					<div class="clear"></div>
					</div>
				
					
				<div class="clear"></div>
<script type="text/javascript">
				jQuery(window).load(function(){
	jQuery('#carousel<?php echo $i; ?>').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
		prevText: ">",          
		nextText: "<",   
		 minItems: 1,
		maxItems: 3,
        itemWidth: 128,
        itemMargin: 0,
        asNavFor: '#slider<?php echo $i; ?>'
      });

      jQuery('#slider<?php echo $i; ?>').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel<?php echo $i; ?>",
        start: function(slider){
          jQuery('body').removeClass('loading');
        }
      });
	  
	  	 
    });
				</script>
				
				</div>
				
				
				<?php $i++; endwhile;   endif;  ?>
				<!-- finish Gallery block -->
	<div class="clear"></div>
	</div>
<?php get_footer();  ?>
