<?php get_header(); /*
Template Name: Event Page Template 
*/  ?>

	<div id="banner-wrap" class="inner-banner">
        <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/blog-banner.jpg" />
		
	</div>
</div>
<!--  content -->
<div id="content" class="content-block">
<!-- finish  header --> 
	<div class="centring">
	<div id="calender-left" class="gridview">

<?php  wp_reset_query(); if (have_posts()) : ?>
    
    <?php while (have_posts()) : the_post(); ?>
	<h1><?php the_title(); ?></h1>
	<div class="listgrid">
<a class="list" href="javascript:void()"></a>
<a class="grid" href="javascript:void()"></a>
</div>
	
	<div class="clear"></div>
    
    <div class="blog-box" <?php // post_class() ?> id="post-<?php the_ID(); ?>">
    
     <?php query_posts(array('post_type'=> 'events','showposts'=> -1,'meta_key'=> 'event_date',

'orderby'=> 'meta_value_num',

'order'=> 'ASC'));

$p= 1;

$ye=array();

$yeCheck=array();
 
if (have_posts()) : while (have_posts()) : the_post();   ?>

<?php

$ym = explode('-',get_field('event_date',get_the_ID()));

array_push($ye,$ym[0]);

$yeCheck[$ym[0]][]=get_the_ID();

$yea=array_unique($ye);

?>

<?php endwhile; endif; wp_reset_query();  // echo "<pre>"; print_r($yeCheck);   
//echo "<pre>"; print_r($yea); ?>
<ul>
<?php    foreach($yeCheck as $year => $pid){   //echo "<pre>";  ?>



<?php


wp_reset_postdata();
query_posts(array('post_type'=> 'events','post__in'=>$pid));

$k=0;  $i=1;

if (have_posts()) : while (have_posts()) : the_post();

if( $k % 2 == 0 )
             $class = 'rightmargin';
           else
             $class = ''; 
		
if( $i % 2 == 0 )
             $right = 'right-side';
           else
             $right = ''; 

?>



	<li class ="<?php  echo $class; ?> <?php  echo  $right; ?>">



		<?php 

$format_in = 'Ym-d'; // the format your value is saved in (set in the field options)

$format_out = 'd'; // the format you want to end up with
$format_m = 'd-M-y'; // the format you want to end up with

$format_o = 'M';

$date = DateTime::createFromFormat($format_in, get_field('event_date',get_the_ID()));



		?>						

		<div class="info">
		  <div class="day"> 
		<h1><?php echo $date->format($format_out); ?><span><?php echo $date->format($format_o); ?></span></h1>
	   </div>
	   <h2> <?php the_title(); ?> <br/>
	   <small><?php echo $date->format($format_m);  ?></small> </h2>
	   </div>
	   <?php the_post_thumbnail('event-thumb');  ?>



		

		<div class="text"> <?php $content = get_the_excerpt(); echo $content;  ?> 

		<a href="<?php echo get_the_permalink(); ?>" class="more" > Find out more </a>
</div>
		

<div class="clear"></div>
	</li>



 <?php $k++; $i++;   endwhile; endif; wp_reset_query();  ?>	





<?php  } ?>
</ul>

    <div class="clear"></div>
    </div>
    
    <?php   endwhile; ?>
    
    <div class="navigation">
        <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
        <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
    </div>
    
    <?php else : ?>
    
    <h2 class="center">Not Found</h2>
    
    <p class="center">Sorry, but you are looking for something that isn't here.</p>
    
	<?php get_search_form(); ?>
    
    <?php endif; ?>


</div>

	
	
<!--  / left container \ -->
<div id="calender-right">
<?php if ( is_active_sidebar( 'calender_sidebar' ) ) : ?>
	
		<?php dynamic_sidebar( 'calender_sidebar' ); ?>
	
<?php endif; ?>

	

</div>


<!--  \ left container / -->
</div>
	
				 


<?php get_footer();  ?>
 <script type="text/javascript">                	
 jQuery("a.grid").click(function() {					
 jQuery("#calender-left").addClass("gridview");					
 jQuery("#calender-left").removeClass("listview");					
 });					
 jQuery("a.list").click(function() {					
 jQuery("#calender-left").addClass("listview");					
 jQuery("#calender-left").removeClass("gridview");					
 });                
 </script>	
