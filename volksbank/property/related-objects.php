<?php
$terms = get_the_terms( $post->ID , 'location', 'string');
$terms2 = get_the_terms( $post->ID , 'offertype', 'string');
$terms3 = get_the_terms( $post->ID , 'proptype', 'string');
if( empty($terms) || empty($terms2) || empty($terms3) ) {  } else {
$term_ids = wp_list_pluck($terms,'term_id');
$term_ids2 = wp_list_pluck($terms2,'term_id');
$term_ids3 = wp_list_pluck($terms3,'term_id');
$second_query = new WP_Query( array(
      'post_type' => 'property',
      'tax_query' => array(
	  'relation' => 'AND',
                    array(
                        'taxonomy' => 'location',
                        'field' => 'id',
                        'terms' => $term_ids,
                        'operator'=> 'IN' 
                     ),
					 array(
                        'taxonomy' => 'offertype',
                        'field' => 'id',
                        'terms' => $term_ids2,
                        'operator'=> 'IN' 
                     ),
					 array(
                        'taxonomy' => 'proptype',
                        'field' => 'id',
                        'terms' => $term_ids3,
                        'operator'=> 'IN' 
                     )),
      'posts_per_page' => 3,
      'orderby' => 'rand',
      'post__not_in'=>array($post->ID)
   ) );

if($second_query->have_posts()) { ?>
		
<div class="related-title"><?php echo __('Related objects', 'bobox'); ?></div>
<div class="prop-related">
<?php    while ($second_query->have_posts() ) : $second_query->the_post(); ?>
<div class="col-ohc">
<div class="propbox">
<div class="prop-headline">
<h4><a href="<?php the_permalink() ?>" title="<?php printf(__('View details', 'bobox'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
</div>
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
      <?php } ?>
      <?php if (get_post_meta($post->ID, '_boP_prop-size5', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Sales area','bobox'); ?>:</td>
             <td ><?php echo get_post_meta($post->ID, '_boP_prop-size5', true) ?>m&sup2;</td>
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

<a class="boxbutton" href="<?php echo get_permalink(); ?>"><?php echo __('View offer', 'bobox'); ?></a>
<div class="clear"> </div>
</div><!-- eof data -->          
</div></div>
 <?php endwhile; wp_reset_query(); }?>
 <div class="clear"></div>
 <?php } ?>
    </div>