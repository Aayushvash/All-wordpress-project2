<?php 
/*
* @package     Property
* @author      Sabine Brings - brings-online.com
* @version     1.0
*/
?>
<div class="pl">
<div class="carousel"
data-cycle-fx=carousel
data-cycle-timeout=5000
data-cycle-speed=300
data-cycle-prev=".carousel-prev"
data-cycle-next=".carousel-next"
data-cycle-pause-on-hover="true"
data-cycle-carousel-fluid=true
data-cycle-swipe=true
data-cycle-slides=">div" >

<?php
$loop = new WP_Query( array( 'post_type' => 'property',  'orderby' => 'date', 'order' => 'DESC') );
while ( $loop->have_posts() ) : $loop->the_post(); 
$so = get_post_meta($post->ID, 'bor_prop-sale', true); 
if($so == 'Verkauft' || $so == 'Vermietet') { } else { ?>
<div class="propbox">
<?php if (has_post_thumbnail() )  { ?>
<div class="propthumb">
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('View details', 'bobox'), the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail('prop-box-thumb'); ?> </a>
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
      <?php }  elseif (get_post_meta($post->ID, '_boP_prop-size5', true)) { ?>
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

</div><!-- eof data -->        
</div><!-- eof box -->

<?php } endwhile; wp_reset_query(); ?>
			

 </div><!-- eof carousel --> 
    
<div class="carousel-prev"><i class="icon-angle-double-left"></i></div>
<div class="carousel-next"><i class="icon-angle-double-right"></i></div>
<script type="text/javascript">
jQuery( '.carousel' ).cycle();
</script> 
</div>