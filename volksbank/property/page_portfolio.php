<?php 
/*
Template Name: Referenzobjekte ohne Sidebar
* @file        page-portfolio.php
* @package     Property
* @author      Sabine Brings - brings-online.com
* @version     2.0
*/
?>

<?php get_header(); ?>


<div id="content">


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2 class="pagetitle"><?php the_title(); ?></h2>
		
	<?php the_content(); ?>
	<?php endwhile; endif; ?>


<div id="properties">
<div class="plfull">
<?php 
function prop_list_length($length) {return 35;}
add_filter('excerpt_length', 'prop_list_length'); 
function prop_list_more($more) { return ' <a class="more" href="'. get_permalink($post->ID) .'"> &nbsp;&raquo;&raquo;</a>';}
add_filter('excerpt_more', 'prop_list_more'); 

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
query_posts( array( 'post_type' => 'portfolio', 'posts_per_page' => '9', 'paged' => $paged) ); 
if (have_posts()) :	while (have_posts()) : the_post(); ?>


<div class="col-otc">
<div class="propbox">
<?php $os = get_post_meta($post->ID, 'bor_prop-sale', true); 
if ($os == 'sold') { ?><div class="sold"><?php echo __( 'Sold', 'bobox' ); ?></div> <?php } ?>
<?php if ($os == 'rented') { ?><div class="sold"><?php echo __( 'Rented', 'bobox' ); ?></div> <?php } if($os == '') {} ?>
<?php if (has_post_thumbnail() )  { ?>
<div class="propthumb">
<a href="<?php the_permalink() ?>" title="<?php printf(__('View details', 'bobox'), the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail('prop-box-thumb'); ?> </a>
</div>
<?php } ?>
<div class="propdata">  
<div class="prop-location">             
<?php echo get_the_term_list( $post->ID, 'location', '', ' - ', '');  ?>
&nbsp; | &nbsp;
<?php echo get_the_term_list( $post->ID, 'proptype', '', ' - ', '');  ?>
</div>  
<div class="propbox-separator"></div>
 <?php $data = get_option('bo_options'); 
$cur = AdminPageFramework::getOption( 'bo_options', array( 'basis4', 'bo_currency'), 'EUR' ); ?>        
       <table>
      <?php if (get_post_meta($post->ID, '_boP_prop-price', true)) { ?>
      <tr>
      <td class="keys"> <?php echo __('Purchase price', 'bobox'); ?>: </td>
      <td><?php echo get_post_meta($post->ID, '_boP_prop-price', true); echo '&nbsp;'; echo $cur; ?> </td>
      </tr>
      <?php } ?>
      <?php if (get_post_meta($post->ID, '_boP_prop-price2', true)) { ?>
      <tr>
      <td class="keys"> <?php echo __('Rent', 'bobox'); ?>: </td>
      <td ><?php echo get_post_meta($post->ID, '_boP_prop-price2', true); echo '&nbsp;'; echo $cur; ?> </td>
      </tr>
      <?php } ?>
      <?php if (get_post_meta($post->ID, '_boP_prop-size', true)) { ?>
      <tr>
      <td class="keys"><?php echo __('Living space','bobox'); ?>:</td>
      <td ><?php echo get_post_meta($post->ID, '_boP_prop-size', true) ?>m&sup2;</td>
      </tr>
      <?php } 
	  elseif (get_post_meta($post->ID, '_boP_prop-size2', true)) { ?>
      <tr>
      <td class="keys"><?php echo __('Total area','bobox'); ?>:</td>
      <td ><?php echo get_post_meta($post->ID, '_boP_prop-size2', true) ?>m&sup2;</td>
      </tr>
      <?php } ?>
      <?php if (get_post_meta( $post->ID, '_boP_prop-rooms', true)) { ?>
      <tr>
      <td class="keys"><?php echo __('Rooms', 'bobox'); ?>:</td>
      <td ><?php echo get_post_meta( $post->ID, '_boP_prop-rooms', true);  ?></td>
      </tr>
      <?php } ?>
      </table>
        
<div class="propbox-separator"></div>

<a class="boxbutton" href="<?php echo get_permalink(); ?>"><?php echo __('View details', 'bobox'); ?></a>
<div class="clear"> </div>
</div>        
         
</div><!-- eof box -->
</div><!-- eof col -->
				
<?php endwhile; ?>
			
<div class="clear"> </div>
 
                
<?php endif; 
remove_filter('excerpt_length', 'prop_list_length'); 
remove_filter('excerpt_more', 'prop_list_more');
 ?> 
             
         
</div><!-- eof proplist -->
</div><!-- eof properties -->


   <div class="post-nav">
<?php global $wp_query;
$big = 999999999; 
echo paginate_links( array(
'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
'format' => '?paged=%#%',
'current' => max( 1, get_query_var('paged') ),
'total' => $wp_query->max_num_pages
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
