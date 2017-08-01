<?php /*
Template Name: Startseite-3
*
* @file           homepage3.php
 * @package       Property
 * @author        Sabine Brings
 * @version        1.0
 */
?>

<?php get_header(); ?>


<div class="col-940 animated fadeInDown">
<?php get_template_part('home-images-full'); ?>
</div>

<div class="separator"></div>
<h2><?php get_template_part('slogan1'); ?></h2>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <div class="col-ttc ct">    
  <div class="page-content">
  <?php the_content(); ?>
  </div>
  </div>
  <?php endwhile; endif; ?>


<div class="col-otc ct cr">
<div id="sidebar">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Homepage Sidebar','bobox')) ) : ?> <?php endif; ?>
</div>
</div>

<div class="clear"></div>
<div class="col-940 animated fadeInDown">
<div class="separator"></div>
<?php get_template_part('infobox-horz');  ?>
<div class="separator"></div>
</div>

<h2><?php get_template_part('slogan2'); ?></h2>
<div class="col-940 animated fadeInDown">
<?php get_template_part('list_properties_home'); ?>
</div>

<?php get_footer(); ?>
