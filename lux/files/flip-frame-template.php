<?php 
/*
*Template Name: Flip Template
*
*/

?>
<?php get_header(); ?> 
<?php $pageHeight = get_field('page_height'); ?>
<?php if($pageHeight) { ?>
<style>
 #content{height:<?php echo get_field('page_height'); ?>px !important}
</style>	
<?php } ?>
<div class="centering">
                
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
           <div class="entry">
              <h1 class="title"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('full'); }  ?></h1>
                <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
                <div class="clear"></div>
            </div>
        
		<?php while(has_sub_field('text_content_box')): ?> 
        <div class="textBar">
            <?php the_sub_field('content_text_box'); ?>
            <div class="clear"></div>
        </div>
        <?php endwhile; ?>   
                
        <?php endwhile; endif; ?>

    <div class="clear"></div>
     
     <!---Flip Page Start-->
   
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.quickflip.source.js" type="text/javascript"></script>
    
    <script type="text/javascript">
    $(function() {
        $('.quickFlip').quickFlip({closeSpeed : 100});
    });
    </script>
    <script>	
        jQuery(document).ready(function($) {
    
            $('#tabs .tabscontent>div').not('div:first').hide();
            $('#tabs ul li:first,#tabs .tabscontent>div:first').addClass('active');
    
            $('#tabs ul li a').click(function(){
    
                var currentTab = $(this).parent();
                if(!currentTab.hasClass('active')){
                    $('#tabs ul li').removeClass('active');				
    
                    $('#tabs .tabscontent>div').slideUp('fast').removeClass('active');
    
                    var currentcontent = $($(this).attr('href'));
                    currentcontent.slideDown('fast', function() {
                        currentTab.addClass('active');
                        currentcontent.addClass('active');
                    });
                }
                return false;							
            });
        });
    </script>

      <?php 
	  $args = array('post_type' => 'flip_feature','post_status'=>'publish','posts_per_page'=>-1);
	  $flip = new WP_Query( $args );
	  ?>
      <?php if ($flip->have_posts()) : ?>
	  <div id="tabs" class="tabs">
           <ul>
              <?php  $i=0; while ($flip->have_posts()) : $flip->the_post(); $i++; ?>
                   
                   <li><a href="#tab-<?php echo $i; ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('full'); }  ?></a></li>
              
              <?php endwhile;  ?>
            </ul>
           <div class="tabscontent">
                    <?php  $i=0; while ($flip->have_posts()) : $flip->the_post(); $i++; ?> 
                    <div id="tab-<?php echo $i; ?>">
                        <div class="content">
                            <?php if(get_field('add_flip_frame')): ?>
                            <div class="quickFlip">
                              <?php $j=0; while(has_sub_field('add_flip_frame')): $j++; ?>
                                 <div class="<?php echo $j==1?'blackPanel':'redPanel'; ?>">
                                  <a href="javascript:void(0);" class="quickFlipCta"><img src="<?php the_sub_field('frame_image'); ?>" alt="" /></a>
                                  <a href="javascript:void(0);" class="quickFlipCta text"><img src="<?php the_sub_field('frame_title_image'); ?>" alt="" /></a>
                                  <div class="quickFlipCta"><?php the_sub_field('frame_content'); ?></div>
                                 </div> 
                              <?php endwhile; unset($j); ?>
                            </div>  
                            <?php endif; ?>
                        </div>
                    </div>
                   <?php endwhile;  ?>  
            </div>
                
        </div>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>
     
     <!---Flip Page End-->
            	
</div>

<?php get_footer(); ?>

