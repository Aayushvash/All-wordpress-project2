<?php 
/*
* @package     Property
* @author      Sabine Brings - brings-online.com
* @version     1.0
*/
?>
<div class="animated fadeInRight">
<div class="featured-properties">
<?php 
$data = get_option('bo_options');
$effect = AdminPageFramework::getOption( 'bo_options', array( 'home1', 'slider_effect'), 'fade' );
$pause = AdminPageFramework::getOption( 'bo_options', array( 'home1', 'slider_pause'), '3500' );
$speed = AdminPageFramework::getOption( 'bo_options', array( 'home1', 'slider_speed'), '500' );
?>	

<div class="cycleprops" 
    data-cycle-fx="<?php echo $effect; ?>"
    data-cycle-speed="<?php echo $speed; ?>"
    data-cycle-timeout="<?php echo $pause; ?>"
    data-cycle-pause-on-hover="true"
    data-cycle-manual-speed="200"
	data-cycle-manual-fx="scrollHorz"
    data-cycle-swipe="true"
    data-cycle-pager="#pager"
	data-cycle-pager-template="<a href='#'><img src='{{children.0.src}}' width=100 height=65></a>"
    data-cycle-prev=".cycle-prev"
    data-cycle-next=".cycle-next"
    data-cycle-slides=">a">
<?php 
function prop_excerpt_length($length) { return 25;}
add_filter('excerpt_length', 'prop_excerpt_length'); 
function prop_excerpt_more($more) { return '';}
add_filter('excerpt_more', 'prop_excerpt_more');
function bo_get_image_id($image_url) {
global $wpdb;
$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
return $attachment[0]; 
}
$loop = new WP_Query( array( 'post_type' => 'property',  'orderby' => 'date', 'order' => 'DESC', 'meta_key' => '_boT_top-image-active', 'meta_value' => 'yes') );
while ( $loop->have_posts() ) : 
$loop->the_post();
$image_url = get_post_meta($post->ID, '_boT_top-image', true );
$image_id = bo_get_image_id($image_url);
$image_thumb = wp_get_attachment_image_src($image_id, 'prop-featured');    ?>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="cycle-item">
 <img src="<?php echo $image_thumb[0]; ?>" alt="<?php the_title(); ?>" />
<div class="cycle-content">
<h2><?php the_title(); ?></h2>
<?php if(get_post_meta($post->ID, '_boT_top-shorttext', true )) { ?>
<p><?php echo get_post_meta($post->ID, '_boT_top-shorttext', true ); ?></p>
<?php } ?>
<ul class="featured">
<li><?php echo strip_tags(get_the_term_list( $post->ID, 'location', '', ' - ', ''));  ?>&nbsp; | &nbsp;<?php echo strip_tags(get_the_term_list( $post->ID, 'proptype', '', ' - ', ''));  ?></li>
<li><?php if (get_post_meta($post->ID, '_boP_prop-size', true)) { ?> <?php echo __('Wohnfläche','bobox'); ?>: <?php echo get_post_meta($post->ID, '_boP_prop-size', true) ?>m&sup2; <?php } ?></li>
<li><?php if (get_post_meta( $post->ID, '_boP_prop-rooms', true)) { ?><?php echo __('Rooms', 'bobox'); ?>: <?php echo get_post_meta( $post->ID, '_boP_prop-rooms', true);  ?> <?php } ?></li>
<li>
<?php if (get_post_meta($post->ID, '_boP_prop-price', true)) { ?>
<?php echo get_post_meta($post->ID, '_boP_prop-price', true); if (get_option('bo_currency')) { echo '&nbsp;'; echo get_option('bo_currency'); } else { echo ' EUR'; } ?> 
<?php } elseif (get_post_meta($post->ID, '_boP_prop-price2', true)) { ?>
<?php echo get_post_meta($post->ID, '_boP_prop-price2', true); if (get_option('bo_currency')) { echo '&nbsp;'; echo get_option('bo_currency'); } else { echo ' EUR'; } ?> 
<?php }  elseif (get_post_meta($post->ID, '_boP_prop-price4', true)) { ?>
<?php echo get_post_meta($post->ID, '_boP_prop-price4', true); if (get_option('bo_currency')) { echo '&nbsp;'; echo get_option('bo_currency'); } else { echo ' EUR'; } ?> 
<?php } ?>
</li></ul>
 
</div>    <!-- eof cycle content -->            
</a><!-- eof prop-cycle-item -->

<?php endwhile; 
remove_filter('excerpt_length', 'prop_excerpt_length'); 
remove_filter('excerpt_more', 'prop_excerpt_more'); ?>
<?php wp_reset_query(); ?> 
</div><!-- eof cycleprop-slideshow -->

<div id="pager"></div>
<script type="text/javascript">
jQuery( '.cycleprops' ).cycle();
</script>
</div>
</div>



