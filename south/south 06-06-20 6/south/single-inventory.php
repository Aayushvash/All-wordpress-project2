<?php get_header();?>
<div id="banner-wrap" class="inner-brand">
        <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/inventory.jpg" />
		<div class="centring2">
			<div class="bran-logo"><h1><?php the_title(); ?></h1></div>
		</div>
		
	</div>
</div>
<!--  content -->
<div id="content" class="content-block">
<!-- finish  header --> 
	<div class="centring3">
		<!--  / left container \ -->
	
		<div id="fullwidth">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
			
				
				
				<div class="entry">
					<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
			
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
				</div>
			
			</div>
			
			<?php endwhile; endif; ?>
			
		</div>
		<!--  \ left container / -->
		
			
		
	<div class="clear"></div>
	</div>




<?php get_footer(); ?>
<script>
jQuery(document).ready(function(){	
var tts = jQuery('.bannerBar .head h1 cite').text();
jQuery('.gform_body li#field_3_7 input').attr('value',tts);
jQuery('.gform_body li#field_3_7 input').attr('readonly', 'readonly');
	
	
});

</script>