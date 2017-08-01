<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
  * Template Name: Nantucket
 */

get_header();
?>

       
	   <div class="borderBox" style="display:none;">
	  
	  <img src="<?php bloginfo('template_directory'); ?>/images/blogo.png"/>
	   
	   </div>
	   
	   
	   
	   <!--  / banner \ -->
		<div id="banner" class="innerBanner">
			
           <?php echo do_shortcode( '[rev_slider alias="nantucket"]' ); ?>

		</div>
		<!--  \ banner / -->
		
		<div class="pageSidebarBox">
		
			<div class="centerBar">
			<div class="centerPart">
			
			<?php if ( have_posts() ) : ?>
                      <?php while (have_posts()) : the_post(); ?>
                      <div class="textBox">
					  <h2 style="font-size:28px; text-transform: uppercase;"><?php the_title(); ?></h2>
					  <?php if(get_field('title_2')) { ?><h2><?php echo get_field('title_2'); ?></h2> <?php } ?>
                      
                      <?php the_content(); ?>
					  
                      </div>
					  
		
                       <?php endwhile;  else:  endif; ?>
					  
			<div id="ticker">
				<h1>We Support</h1>
				<?php echo do_shortcode( '[ditty_news_ticker id="4176"]' ); ?>
				<div class="clear" style="height:0"></div>
			</div>
						<div class="clear"></div>

			
			</div>
			<div class="rightpart">
			<?php if ( is_active_sidebar( 'nantucket-sidebar' ) ) : ?>
	<ul id="sidebar">
		<?php dynamic_sidebar( 'nantucket-sidebar' ); ?>
	</ul>
<?php endif; ?>
			</div>
			</div>
		
		</div>
	   

<?php get_footer(); ?>
