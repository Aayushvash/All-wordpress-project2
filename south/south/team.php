<?php get_header();  /* Template Name: Team Page Template */  $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>

	<div id="banner-wrap" class="inner-banner">
        <img alt="" src="<?php echo $feat_image;  wp_reset_query();?>" />
		
	</div>
</div>
<!--  content -->
<div id="content" class="content-block">
<!-- finish  header --> 
	<div class="centring">
		<h1><?php the_title(); ?></h1>
		<div class="text-left">
			<?php the_content(); ?>
		</div>
		<div class="text-right">
		
		<ul>
	<?php   if( have_rows('links') ): // loop through the rows of data
			while ( have_rows('links') ) : the_row();
			$title=get_sub_field('title');	
			$page_link=get_sub_field('page_link');	
				?>
            <li>
				<a href="<?php echo $page_link; ?>"><?php echo $title;  ?></a>  	    	   
  	    	</li>
			<?php  endwhile; else :  endif;	?>
		</ul>	
		</div>
		<div class="clear"></div>
	</div>
	<!-- begin team block -->
	<?php	
	      query_posts(array( 'post_type'=>'our_team','order'=>'ASC')); ?>
		  <?php $i=1; if (have_posts()) : while (have_posts()) : the_post(); 
if( $i % 2 == 0 )
             $right = 'right';
           else
             $right = ''; 
		  ?>
	<div class="team-block<?php echo $right; ?>">
		<div class="centring">		
			<div class="team">
				<div class="image">
				  <?php the_post_thumbnail('team-thumb'); ?>
				</div>
			 <div class="text">
				<?php the_content(); ?>			 
			 </div>		
			<div class="clear"></div>
			</div>
					
			<div class="clear"></div>
		</div>
	</div>
	<?php  $i++; endwhile; else :  endif;
			?>
	<!-- finish team block -->
<?php get_footer();  ?>
