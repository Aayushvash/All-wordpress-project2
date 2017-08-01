<?php /*
Template Name: Leistungen
*
* @file           page-services.php
 * @package       Property
 * @author        Sabine Brings
 * @version       1.0
 */

?>

<?php get_header(); ?>


<div id="content">


<div class="col-940">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2 class="pagetitle"><?php the_title(); ?></h2>
		
	<?php the_content(); ?>
	<?php endwhile; endif; ?>

</div>
<?php
$data = get_option('bo_options');
$orderby = AdminPageFramework::getOption( 'bo_options', array( 'services', 'serv_post_order'), 'date' );
$order = AdminPageFramework::getOption( 'bo_options', array( 'services', 'serv_post_sort'), 'DESC' );
?>
    
<div class="service-list">
<?php 
function offer_excerpt_length($length) { return 36;}
add_filter('excerpt_length', 'offer_excerpt_length');
function list_more($more) {
return ''; }
add_filter('excerpt_more', 'list_more');
query_posts( array( 'post_type' => 'services', 'posts_per_page' => -1, 'orderby' => $orderby, 'order' => $order) );
if (have_posts()) : while (have_posts()) : the_post(); 
?>

<div class="col-ohc">
<div class="service-list-box">
<h3><span><a href="<?php the_permalink(); ?>" title="Mehr über <?php the_title(); ?>"><?php the_title(); ?></a></span></h3>
<?php  the_excerpt();?>

<a class="more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?> - hier weiterlesen">
<?php if (get_post_meta($post->ID, '_boT_more-text', true)) { echo get_post_meta($post->ID, '_boT_more-text', true); }
else { echo AdminPageFramework::getOption( 'bo_options', array( 'services', 'bo_more_text'), 'Hier mehr erfahren' ); }?></a>
<div class="clear"></div>
</div>
</div>

<?php endwhile; endif;
remove_filter('excerpt_length', 'offer_excerpt_length'); 
remove_filter('excerpt_more', 'list_more');
wp_reset_query();?>
<div class="clear"></div>
</div>

</div><!-- eof page-entry -->
</div><!-- eof content -->


<?php get_footer(); ?>
