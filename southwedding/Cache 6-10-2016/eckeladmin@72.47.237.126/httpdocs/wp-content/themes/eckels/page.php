<?php get_header();/** * Template Name: default page */ ?>
<!--  / left container \ -->

<div id="banner-wrap"> <!-- banner block -->
  <div class="bannerinner-block">
    <ul class="slides">
      <li>
        <div class="caption"> </div>
		
	<?php	if ( has_post_thumbnail() ) {
    the_post_thumbnail('slider_image');
} 
	else {	?>
		<img src="<?php bloginfo('template_url'); ?>/images/about-banner.jpg" alt="" />
        
<?php	} ?>
	  	  
	  </li>
    </ul>
    
  </div>
  <!-- finish innerbaner block --> </div>
<!-- finish banner wrap --> <!-- begin content -->
<div id="content-wrap"> <!-- begin centerwrap -->
  <div id="center-wrap"> <!-- caption block -->
    <div class="caption-block">
      <div class="centering">
        <?php if (have_posts()) : while (have_posts()) : the_post(); $subtitle= get_field('subtitle'); ?>
        <h2>
          <?php the_title(); ?>
        </h2>
        <h3>
          <?php if($subtitle!='') { ?>
          <sub><?php echo $subtitle; ?></sub>
          <?php } ?>
          <div class="clear"></div>
          <span><img src="<?php echo get_template_directory_uri();?>/images/chakr.jpg"></span> </h3>
        <?php endwhile; endif; ?>
      </div>
    </div>
    <!-- finish cation block --> <!--  main block -->
    <div class="main-block">
      <div class="centering">
        <div class="center">
			<?php the_content(); ?>
          <div class="left-con">  
            <?php echo $left; ?>
          </div>
          <div class="right-con">
            <?php the_field('right_box'); ?>
			</div>
		
		
	
		
		
        </div>
      </div>
    </div>
    <!--finish  main block --> <!-- maincont-block -->
    <div class="maincont-block">
      <div class="centering">
        <div class="center">
          <ul>
            <?php if(have_rows('three_boxes')): while(have_rows('three_boxes')) : the_row();                     $image=get_sub_field('image');                    $title=get_sub_field('title');                    $sub_title=get_sub_field('sub_title');                    $content=get_sub_field('content');                    ?>
            <li>
              <div class="box1"> <a href="#"><img src="<?php echo $image['sizes']['three-boxes-image']?>" > </a>
                <h2><?php echo $title; ?></h2>
                <h3><?php echo $sub_title; ?></h3>
                <p><?php echo $content; ?></p>
              </div>
            </li>
            <?php  endwhile; else :  endif; ?>
          </ul>
        </div>
      </div>
    </div>
    <!-- finish maincont-block --> </div>
  <!-- center-wrap --> </div>
<!-- contant wrap --> <!--  \ left container / -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>