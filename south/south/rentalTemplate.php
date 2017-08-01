<?php 
get_header();
/* Template Name: Rental Page Template */
?>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="<?php bloginfo('template_url'); ?>/js/jquery-ui.js"></script>
 <script type="text/javascript">
 jQuery(document).ready(function(){
	 jQuery( "#datepicker" ).datepicker();
	 
	 jQuery('.dipartureBox .dbox2 li').each(function(){
		 jQuery(this).find('span').click(function(){
			 jQuery(this).addClass('active');
			 jQuery(this).parent('li').siblings().find('.active').removeClass('active');
			 
		 })
	 })
	 
	 		jQuery('.sortproduct').click(function(e) {
				e.preventDefault();
		  var dat = jQuery('.date').val();
		  var mr = jQuery('.mlink.active p').text();
		  
				jQuery.ajax({
					type: "POST",
					url: "<?php bloginfo('template_url'); ?>/rental-ajax.php?date="+dat+"&mr="+mr,
					cache: false,
					beforeSend:function(){
						// show gif here, eg:
						jQuery('#myresult').html('<img class="loader" src="<?php bloginfo('template_url'); ?>/images/loader.gif" class="loader" alt="" />');
					},
					success: function(html){ 
							
							jQuery("#myresult").html(html);
						
					}
				});
    }); 
 });
 </script>
 <?php  $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
<div id="banner-wrap" class="inner-banner">
       <img alt="" src="<?php echo $feat_image;  ?>" />
	</div>


</div>
<!--  content -->
<div id="content" class="content-block">
<!-- finish  header --> 
	<div class="centring">
		<!--  / left container \ -->
	
		<div id="fullCntr">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
				
				<div class="entry">
					<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
			
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
				</div>
			
     <?php endwhile; endif; ?>
	 
	 <div class="dipartureBox">
	 
		 <div class="dbox dbox1">
		    <span class="number">1</span>
			<h2>Departure date</h2>
			<input type="text" id="datepicker" class="date" />
		 </div>
		 <div class="dbox dbox2">
		    <span class="number">2</span>
			<h2>Select time of day</h2>
			<ul>
				<li>
				<span class="link mlink active">Morning<p style="display:none">10am-2pm</p></span>
					<h2>Morning</h2>
					<p>10am-2pm</p>
				</li>
				<li>
				<span class="link mlink">Afternoon<p style="display:none">1pm-5pm</p></span>
					<h2>Afternoon</h2>
					<p>1pm-5pm</p>
				</li>
				<li>
				<span class="link mlink">AllDay<p style="display:none">9am-5pm</p></span>
					<h2>All Day</h2>
					<p>9am-5pm</p>
				</li>
			</ul>
		 </div>
		 <div class="dbox dbox3">
		    <span class="number">3</span>
			<h2>Find Boats</h2>
			<h3 class="sortproduct">Search<span>Availability</span></h3>
		 </div>
	 <div class="clear"></div>
	 
	 </div>
	 <div class="clear"></div>
	 
	    <div class="avaText"><?php the_field('extra_text'); ?></div>
		
		<div class="listingBox">
			<div id="myresult">
				<ul>
					<?php $i=1; 
					query_posts('post_type=rental&showposts=-1');
					if (have_posts()) : while (have_posts()) : the_post(); ?>
						<li class="<?php if($i%3==0){ echo "last"; } ?>">
							<div class="image">
								<h2><?php the_title(); ?></h2>
								<a href="<?php echo get_permalink().'?date='.date("m/d/y").'&time=10am-2pm'; ?>"><?php the_post_thumbnail('rental-img'); ?></a>
							</div>
							<span class="info">Max Passengers: <?php the_field('passenger'); ?><span><?php the_field('power'); ?></span><?php the_field('length'); ?></span>
							<div class="detailInfo">
								<a href="<?php echo get_permalink().'?date='.date("m/d/y").'&time=10am-2pm'; ?>">More Details</a>
								<p>$<?php the_field('4_hours'); ?></p>
							</div>
						</li>
					<?php $i++; endwhile; endif; ?>
				</ul>
			</div>
		</div>
			
		</div>
		<!--  \ left container / -->
		
			
		
	<div class="clear"></div>
	</div>
	
	
<?php get_footer(); ?>
