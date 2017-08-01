<?php get_header(); ?>

 <div id="properties" style="display:none;">

<?php
if (function_exists('_qmt_init')) {
the_widget('Taxonomy_Drill_Down_Widget', array(
    'title' => '',
    'mode' => 'dropdowns',
    'taxonomies' => array( 'proptype', 'keyword', 'location' ) ,
	'orderby' => 'title',
	'order' => 'asc'
	//'taxonomies' => array( 'offertype','proptype', 'rooms', 'keyword', 'location', 'size' ) 
));
}
?>

</div><!-- eof properties -->


<div id="content">
    <div class="col-ttc">
    
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="page-entry mr">
    <h2 class="pagetitle"><?php the_title(); ?></h2>
        
<?php the_content(); ?>

        </div>
    <?php endwhile; endif; ?>
  
  </div><!-- eof col ttc -->


<div class="col-otc cr">
<?php get_template_part('sidebar_page'); ?>
</div>

<div class="clear"></div>
</div><!-- eof content -->
<?php get_footer(); ?>
