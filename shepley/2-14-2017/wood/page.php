<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<style>
.page-template-default .textBox ul { width: 100%; overflow: hidden; }
.page-template-default .textBox li { padding: 0 10px; width: 100%; overflow: hidden; position: relative; }
.page-template-default .textBox li::before { width: 5px; height: 5px; position: absolute; left: 0; top: 5px; content: ''; border-radius: 50px; background-color: #000; }
.page-template-default .textBox li ul { padding-left: 30px; }

</style>
	   
	   <?php if(get_field('add_shortcode')) { ?>
	   <div class="innerSlider">
         <?php echo do_shortcode(get_field('add_shortcode')); ?>
		 
		  <div class="borderBox">
	  
	  <img src="<?php bloginfo('template_directory'); ?>/images/blogo.png"/>
	   
	   </div>
	   
	   <div class="titleBox"><h2><?php the_title(); ?></h2></div>
		 </div>
	  <?php }else { ?>
	    <div class="borderBox">
	  
	  <img src="<?php bloginfo('template_directory'); ?>/images/blogo.png"/>
	   
	   </div>
	   
	   <div class="titleBox"><h2><?php the_title(); ?></h2></div>
	   <!--  / banner \ -->
		<div id="banner" class="innerBanner">
			
            <?php the_post_thumbnail(); ?>

		</div>
		<!--  \ banner / -->
	   <?php } ?>
		
		
			<div class="centerBar">
		
			<div class="fullwidth">
			
			<?php if ( have_posts() ) : ?>
                      <?php while (have_posts()) : the_post(); ?>
					  <?php if(get_field('leftteam') or get_field('right_teams') or get_field('bottom_teams')){  ?>
						<div class="meetTeamBox">

							<div class="mleft">
<?php if( have_rows('leftteam') ): ?>
	<ul>
	<?php $s=1; while( have_rows('leftteam') ): the_row(); 
		$title = get_sub_field('title');
		$link = get_sub_field('link');
		?>
					<li class="lteam_<?php echo $s; ?>">
						<div class="text">
						<span><?php echo $title; ?></span>											
						</div>
						<a class="emailLink" href="<?php echo $link; ?>">More info +</a>
					</li>
	<?php $s++; endwhile; ?>
		</ul>
<?php endif; ?>
							</div>
							
							<div class="mcenter">
							   <img src="<?php echo get_field('center_image'); ?>">
							</div>
							
							<div class="mright">
							<?php if( have_rows('right_teams') ): ?>
	<ul>
	<?php $s=1; while( have_rows('right_teams') ): the_row(); 
		$title = get_sub_field('title');
		$link = get_sub_field('link');
		?>
					<li class="rteam_<?php echo $s; ?>">
						<div class="text">
						<span><?php echo $title; ?></span>											
						</div>
						<a class="emailLink" href="<?php echo $link; ?>">More info +</a>
					</li>
	<?php $s++; endwhile; ?>
		</ul>
<?php endif; ?>
							</div>
							
							<div class="clear"></div>
							
							<div class="mbottom">
														<?php if( have_rows('bottom_teams') ): ?>
	<ul>
	<?php $s=1; while( have_rows('bottom_teams') ): the_row(); 
		$title = get_sub_field('title');
		$link = get_sub_field('link');
		?>
					<li class="beam_<?php echo $s; if($s%5==0) {  echo " last"; } ?>">
						<div class="text">
						<span><?php echo $title; ?></span>											
						</div>
						<a class="emailLink" href="<?php echo $link; ?>">More info +</a>
					</li>
	<?php $s++; endwhile; ?>
		</ul>
<?php endif; ?>
							</div>

						</div>

					  <?php } else { ?>
					  <div class="textBox">
					  
                      
                      <?php the_content(); ?>
					  
                      </div>
					  <?php } ?>
                       <?php endwhile;  else:  endif; ?>
					  
						<div class="clear"></div>

			
			</div>
			
			
			</div>
		
		
	   

<?php get_footer(); ?>
