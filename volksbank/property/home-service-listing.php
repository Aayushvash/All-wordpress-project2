<?php 
function home_excerpt_length($length) { return 36; }
add_filter('excerpt_length', 'home_excerpt_length');
function home_list_more($more) {
return ''; }
add_filter('excerpt_more', 'home_list_more');

$loop = new WP_Query( array( 'post_type' => array('services', 'page', 'post'), 'meta_key' => '_boT_home-service-active', 'meta_value' => 'yes', 'orderby' => 'date', 'order' => 'DESC') );
while ( $loop->have_posts() ) : $loop->the_post(); ?>
 		
<div class="col-otc">        
<div class="homebox">
<h3><span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> - hier weiterlesen"><?php the_title(); ?></a></span></h3>
<?php the_excerpt(); ?>
<a class="more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?> - hier weiterlesen">
<?php if (get_post_meta($post->ID, '_boT_more-text', true)) { echo get_post_meta($post->ID, '_boT_more-text', true); }
elseif( get_option('bo_more_text')) { echo get_option('bo_more_text'); } else { echo 'Hier weiterlesen &raquo;'; }?></a>
</div>        
	</div>

<?php 
endwhile; 
remove_filter('excerpt_length', 'home_excerpt_length');
remove_filter('excerpt_more', 'home_list_more'); ?>	

<?php wp_reset_query(); ?> 

<div class="clear"></div>