<?php 
/*
Template Name: Immobilienliste
* @file        page-properties.php
* @package     Property
* @author      Sabine Brings - brings-online.com
* @version     2.0
*/
?>

<?php get_header(); ?>


<div id="content">

<div id="properties">

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
<p class="postss">Zur Zeit haben wir insgesamt <?php

$count_posts = wp_count_posts('property');
 
echo $published_posts = $count_posts->publish;
?> Objekte für Sie zur Auswahl.</p>
<div class="prop">
<?php get_template_part('list_properties'); ?>
</div>
   <div class="post-nav">
<?php global $wp_query;
$big = 999999999; 
echo paginate_links( array(
'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
'format' => '?paged=%#%',
'current' => max( 1, get_query_var('paged') ),
'total' => $wp_query->max_num_pages,
'order' => 'asc'
) );
?>
<div class="clear"> </div>

</div><!-- eof post-nav -->       	
</div><!-- eof properties -->

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/chosen.js"></script>
<script type="text/javascript">
		jQuery(document).find(".widget_taxonomy-drill-down select option").each(function() {
		  var $this = jQuery(this);
		  $this.html( $this.html().split('&nbsp;').join('') );
		});
          jQuery(".widget_taxonomy-drill-down select").chosen();
                 </script>

          
</div><!-- eof content -->

<?php get_footer(); ?>
