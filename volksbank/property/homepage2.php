<?php /*
Template Name: Startseite-1
*
* @file           homepage2.php
 * @package       Property
 * @author        Sabine Brings
 * @version       1.0
 */
?>

<?php get_header(); ?>


<div class="col-940">
<?php get_template_part('home-featured-objects'); ?>
</div>

<div class="col-940">
<?php get_template_part('infobox-horz');  ?>
<div class="separator"></div>
</div>

<h2><?php get_template_part('slogan1'); ?></h2>


  <div class="col-ttc">    
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class="page-content">
    			<?php the_content(); ?>
                </div>
	<?php endwhile; endif; ?>
	</div>
    
    

<div class="col-otc cr">
<div id="sidebar">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Homepage Sidebar','bobox')) ) : ?> <?php endif; ?>
</div>
</div>
<div class="clear"></div>


<?php get_footer(); ?>
