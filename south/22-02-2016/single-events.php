<?php get_header();?>
<div id="banner-wrap" class="inner-banner">
        <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/blog-banner.jpg" />
		
	</div>
</div>
<!--  content -->
<div id="content" class="content-block">
<!-- finish  header --> 
	<div class="centring">
<!--  / left container \ -->


<!--  \ left container / -->
<div id="calender-block">

<?php if (have_posts()) : while (have_posts()) : the_post();   

	$format_in = 'Ym-d'; // the format your value is saved in (set in the field options)

$format_out = 'F d, Y'; // the format you want to end up with

$date = DateTime::createFromFormat($format_in, get_field('event_date',get_the_ID()));

	?>
    
    
	
      <h2><?php the_title(); ?>,
	 
	   <small><?php echo $date->format($format_out); ?></small>
	   </h2>
    <div class="blog-box" <?php // post_class() ?> id="post-<?php the_ID(); ?>">
    
      
	   
	 
	   <?php the_post_thumbnail(); ?>
	   
	  
        <div class="entry">
           <?php echo the_content();  ?>
        </div>
    
    </div>
    
    <?php endwhile; ?>
   
    
    <?php else : ?>
    
   
    
    <?php endif; ?>


</div>

<div id="calender-right">
<?php if ( is_active_sidebar( 'calender_sidebar' ) ) : ?>
	
		<?php dynamic_sidebar( 'calender_sidebar' ); ?>
	
<?php endif; ?>

	

</div>
</div>




<?php get_footer(); ?>