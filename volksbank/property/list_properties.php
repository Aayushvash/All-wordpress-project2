<?php 
/*
* @package     Property
* @author      Sabine Brings - brings-online.com
* @version     2.0
*/
?>
<div class="plfull">
<?php 
function prop_list_length($length) {return 35;}
add_filter('excerpt_length', 'prop_list_length'); 
function prop_list_more($more) { return ' <a class="more" href="'. get_permalink($post->ID) .'"> &nbsp;&raquo;&raquo;</a>';}
add_filter('excerpt_more', 'prop_list_more'); ?>
<?php
/* $locations = get_terms( array(
				'taxonomy' => 'location',
				'hide_empty' => false,
			) );
		var_dump($locations);
		foreach($locations as $location){
			$loc = $location->slug;
			echo $loc .'<br/>';
		} */
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
query_posts( array( 
		'post_type' => 'property',
		'post_status' => 'publish',
		'posts_per_page' => '9',
		'orderby' => 'title',
		'order' => 'DESC', 
		'paged' => $paged
	) 
); 

if (have_posts()) :	while (have_posts()) : the_post();  ?>

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
<p class="text-prop">
<?php 
	$tt=$post->post_title;
	$content = strlen($tt);
	$thelength = 115;
    echo substr($tt, 0, $thelength); 
	if ($content > $thelength) echo "...";
	?>
	<?php

//$thetitle = $post->post_title; /* or you can use get_the_title() */
//$getlength = strlen($thetitle);
//$thelength = 25;
//echo substr($thetitle, 0, $thelength);
//if ($getlength > $thelength) echo "...";

?>



	
	
	
</p>
<div class="propbox-separator"></div>
<?php $data = get_option('bo_options'); 
$cur = AdminPageFramework::getOption( 'bo_options', array( 'basis4', 'bo_currency'), 'EUR' ); ?>         
	<div class="tabl-butt" >		
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
      </table></div>
        
<div class="propbox-separator"></div>

<a class="boxbutton" href="<?php echo get_permalink(); ?>"><?php echo __('View details', 'bobox'); ?></a>
<div class="clear"> </div>
</div>        
         
</div><!-- eof box -->
</div><!-- eof col -->
				
<?php  endwhile; ?>
			
<div class="clear"> </div>
 
<?php endif; 
remove_filter('excerpt_length', 'prop_list_length'); 
remove_filter('excerpt_more', 'prop_list_more');
 ?> 
             
          </div><!-- eof proplist -->