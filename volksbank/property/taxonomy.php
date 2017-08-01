<?php get_header(); ?>


<div id="content">


<?php
if(is_tax('offertype') || is_tax('proptype') || is_tax('rooms') || is_tax('location') || is_tax('size') || is_tax('keyword')) { ?>

<div id="properties">
<div class="opentaxsearch"><?php echo __('Open Search Form', 'bobox'); ?> </div>

<div class="tax-search-wrapper">
<?php 
if (function_exists('_qmt_init')) {
the_widget('Taxonomy_Drill_Down_Widget', array(
    'title' => '',
    'mode' => 'dropdowns',
    'taxonomies' => array( 'proptype', 'keyword', 'location') // list of taxonomy names
   // 'taxonomies' => array( 'offertype','proptype', 'rooms', 'keyword', 'location', 'size' )  list of taxonomy names
));
}
?>
</div>


<?php $post = $posts[0];  
 	
if (have_posts()) { ?> 
		<?php $category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="category-description">' . $category_description . '</div>'; ?>




<div class="plfull">
<?php 

function prop_list_length($length) {return 35;}
add_filter('excerpt_length', 'prop_list_length'); 
function prop_list_more($more) { return ' <a class="more" href="'. get_permalink($post->ID) .'"> &nbsp;&raquo;&raquo;</a>';}
add_filter('excerpt_more', 'prop_list_more'); ?>

<?php	while (have_posts()) : the_post(); 
$pt = get_post_type($post->ID); 
if($pt == 'property') { ?>
<div class="col-otc">
<div class="propbox">
<?php if(get_post_meta($post->ID, 'bor_prop-new', true)) { ?> 
<div class="newobj"><?php echo get_post_meta($post->ID, 'bor_prop-new', true); ?></div> <?php } ?>
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
      <?php } 
	    elseif (get_post_meta($post->ID, '_boP_prop-size5', true)) { ?>
      <tr>
    <td class="keys"><?php echo __('Sales area','bobox'); ?>:</td>
    <td><?php echo get_post_meta($post->ID, '_boP_prop-size5', true) ?> m&sup2;</td>
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
				
<?php } endwhile; ?>
			
<div class="clear"> </div>
 
                
<?php 
remove_filter('excerpt_length', 'prop_list_length'); 
remove_filter('excerpt_more', 'prop_list_more');
 
} else { echo '<h2>' . __('This category has currently no entries', 'bobox') .'</h2>'; }
 
 
 ?> 
             
          </div><!-- eof proplist -->


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

<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('.opentaxsearch').click(function() {
	jQuery('.tax-search-wrapper').show();
	jQuery('.opentaxsearch').hide();  })
});
</script>

      

<? }  ?>

<?php if(is_tax('service-category')) { ?>

<div class="col-940">
<?php  $taxtype_title = get_the_term_list( $post->ID, 'service-category', '', ', ', ''); 
			 if ( ! empty( $taxtype_title ) )
			echo '<h2 class="pagetitle">';
			echo  $taxtype_title; 
			echo  '</h2>';
			if ( empty($taxtype_title )) {  echo '<h2 class="pagetitle">'. __('This category has currently no entries','bobox') . '</h2>'; }
 ?>
 </div>
 
 <div class="service-list">
<?php 

function offer_excerpt_length($length) { return 36;}
add_filter('excerpt_length', 'offer_excerpt_length');
function list_more($more) {
return ''; }
add_filter('excerpt_more', 'list_more');

while (have_posts()) : the_post(); ?>
  
  <div class="col-ohc">
  <div class="service-list-box">
  <h3><span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></span></h3>
  <?php  the_excerpt();?>
  <a class="more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?> ">
<?php if (get_post_meta($post->ID, '_boT_more-text', true)) { echo get_post_meta($post->ID, '_boT_more-text', true); }
elseif( get_option('bo_more_text')) { echo get_option('bo_more_text'); } else { echo __('Read more','bobox'); }?></a>
   <div class="clear"></div>
   </div>
  </div>
 
<?php endwhile; 
remove_filter('excerpt_length', 'offer_excerpt_length'); 
remove_filter('excerpt_more', 'list_more');
wp_reset_query();?>
 <div class="clear"></div>
</div>

<?php } ?>

   

   

</div><!-- eof content -->


<?php get_footer(); ?>