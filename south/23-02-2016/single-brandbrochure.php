<?php get_header(); $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>

	<div id="banner-wrap" class="inner-brand">
        <img alt="" src="<?php echo $feat_image;  wp_reset_query();?>" />
		<div class="bran-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/bran-logo.png"></img></div>
	</div>
</div>
<!--  content -->

<div id="content" class="content-block">
<!-- finish  header --> 
	<div class="centring">
		<!--  / left container \ -->
	
		<div id="leftCntr">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
			
				<h1><?php the_field('sub_title'); ?></h1>
				
				<div class="entry">
					<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
			
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
				</div>
			
			</div>
			
			<?php endwhile; endif; ?>
			 <div class="list">
						<?php
                                $i=1 ; if( have_rows('brouchrer_repeater') ):	
                                while ( have_rows('brouchrer_repeater') ) : the_row(); 
                                $tab_title = get_sub_field('title');
                                ?>
                                <li ><a class="custab<?php echo $i ;?>" id=""  href="#tab<?php echo $i ;?>"><?php echo $tab_title; ?></a></li>
                                <?php $i++;  endwhile; endif;?> 
                            
                            
                                                  
                        </div>
			
			
			
			<!-- spacifications -->
			<div class="default spacifications">
			 
			 <?php
                            $i=1 ; if( have_rows('brouchrer_repeater') ):	
                            while ( have_rows('brouchrer_repeater') ) : the_row(); 
                            $tab_content = get_sub_field('content');
                            ?>  <div class="tab">
                                <div id="tab<?php echo $i ;?>" class="tab-content">
                                    <?php echo $tab_content; ?> 
                                </div>   
                            </div>
							<?php $i++;  endwhile; endif;?>
				
			</div>
			<!-- finish spacifications -->
			<!-- photo gallery --->
			<div class="photo-gallery">
			<?php the_field('wonder_plugin_shortcode'); ?>
			
			</div>
			<!-- finish photo-gallery -->
			<div class="clear"></div>
			
			<div class ="links">
			<ul>


				<li class="print"><a href="#" onclick="myFunction()" >print this page</a></li>
				<li class="request"><a href="#">request a  quote</a></li>
				<li class ="inv"><a href="#inline2" class="various1" >Inventory</a></li>
			</ul>
			
			</div>
			
			
			
			
		</div>
		<!--  \ left container / -->
		
			<?php get_sidebar(); ?>
		
	<div class="clear"></div>
	</div>
	<div style="display: none;" class="down-form">
    <div id="inline2" style="width:1000px;height:auto;overflow:auto;">
        
       <p>We’re sorry, but we are all sold out of this boat. Tell us who you are and what you're looking for and we will contact you shortly to get you out on the water!</p>
         <?php // $request_more_info_form_shortcode = get_field('request_more_info_form_shortcode'); ?>
		 <?php  echo do_shortcode('[gravityform id="1" title="false" description="false"]'); ?>
    
        <?php // echo do_shortcode($request_more_info_form_shortcode); ?>  
		</div> 
    
    </div>
	
<script>
function myFunction() {
    window.print();
}
</script>
<?php get_footer(); ?>