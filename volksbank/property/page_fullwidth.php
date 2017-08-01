<?php /*
Template Name: Seite ohne Sidebar
* @file           page-fullwidth.php
 * @package       Property
 * @author        Sabine Brings
 * @version       1.0
 */

?>


<?php get_header(); ?>

	<div id="content">
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

<div class="col-940">

<div class="page-entry">
    
   
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
    	
        <h2 class="pagetitle"><?php the_title(); ?></h2>
	
    			<?php the_content(); ?>
	<?php endwhile; endif; ?>
	
</div>
</div><!-- eof col -->

</div><!-- eof content -->

<?php get_footer(); ?>
