<?php 
/*
* @package     Property
* @author      Sabine Brings - brings-online.com
* @version     2.0
*/
?>
<?php get_header(); ?>

<div id="content">
   
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

 
<div class="col-ohc">
<div class="page-entry">
<h2 class="pagetitle"><?php the_title(); ?></h2>
<div class="tabber">
<div id="tabContainer">
<ul id="tabitems"><li><a href="#tab1"><?php echo __('Description', 'bobox'); ?></a></li><li><a href="#tab2"><?php echo __('Details', 'bobox'); ?></a></li><li><a href="#tab4" class="maptab"><?php echo __('Location ', 'bobox'); ?></a></li></ul>
<div id="tab1" class="tabtext">
<div class="prop-description">
<div class="single-propdata"> 
<?php $data = get_option('bo_options'); 
$cur = AdminPageFramework::getOption( 'bo_options', array( 'basis4', 'bo_currency'), 'EUR' );
echo get_the_term_list( $post->ID, 'location', '', ' - ', '');  ?>
&nbsp; | &nbsp;
<?php echo get_the_term_list( $post->ID, 'proptype', '', ' - ', '');  ?>
&nbsp; | &nbsp;
<?php if (get_post_meta($post->ID, '_boP_prop-price', true)) { ?>
<?php echo get_post_meta($post->ID, '_boP_prop-price', true); echo '&nbsp;'; echo $cur; ?> 
<?php } elseif (get_post_meta($post->ID, '_boP_prop-price2', true)) { ?>
<?php echo get_post_meta($post->ID, '_boP_prop-price2', true); echo '&nbsp;'; echo $cur; ?> 
<?php } ?>
&nbsp; | &nbsp;
<?php if (get_post_meta($post->ID, '_boP_prop-size', true)) { ?>
<?php echo get_post_meta($post->ID, '_boP_prop-size', true) ?>m&sup2;&nbsp; 
<?php } elseif (get_post_meta($post->ID, '_boP_prop-size2', true)) { ?>
<?php echo get_post_meta($post->ID, '_boP_prop-size2', true) ?> m&sup2;&nbsp; 
<?php } ?>
&nbsp; | &nbsp;
<?php if (get_post_meta( $post->ID, '_boP_prop-rooms', true)) { ?>
<?php echo get_post_meta( $post->ID, '_boP_prop-rooms', true);  ?> Zimmer&nbsp; 
<?php } ?>
</div>
<?php the_content(); ?>
</div>
</div><!-- eof tab -->

<div id="tab2" class="tabtext">
<div class="prop-all-data">
<?php get_template_part('data-properties'); ?>
</div>
</div><!-- eof tab -->

<div id="tab4" class="tabtext">
<?php if (get_post_meta($post->ID, '_boP_prop-address', true)) { ?>
<div class="list-address">
<p><strong><?php echo __('Address', 'bobox'); ?></strong><br />
<?php echo get_post_meta($post->ID, '_boP_prop-address', true) ?></p></div>
<?php } ?>
<div class="map">
<?php echo get_post_meta($post->ID, '_boP_prop-geolink', true) ?>
</div></div><!-- eof tab -->
</div>
</div><!-- eof tabber -->

<script type="text/javascript">
jQuery(document).ready(function($) {
$(".tabtext").hide();
$(".tabtext:first").show();
$("#tabContainer ul#tabitems li:first-child a").addClass('active');
$("#tabContainer ul#tabitems li a").click(function(){
      var activeTab = $(this).attr("href"); 
     $("#tabContainer ul li a").removeClass("active"); 
     $(this).addClass("active"); 
     $(".tabtext").hide(); 
     $(activeTab).show(); 
return false;
});
$('.maptab').click(function(){
$('.map').html( $('.map').html() ); 
});	
});
 </script>

</div><!-- eof page entry -->
<?php endwhile; endif; ?>
</div>

<div class="col-ohc cr" >
<div id="sidebar">
<div class="prop-image">
<div class="zoomimg" style="display:none; font-size:11px;"><?php echo __('Click to enlarge images', 'bobox'); ?></div>
<div class="cycleprops-single" 
    data-cycle-fx="fade"
    data-cycle-loader="wait"
    data-cycle-timeout=3500
    data-cycle-speed="300"
    data-cycle-pause-on-hover="true"
    data-cycle-pager="#pager2"
    data-cycle-pager-template="<img src='{{firstChild.src}}' width=80 height=55>"
    data-cycle-slides=">a">
<?php 
$data = get_post_meta($post->ID,"image_data",true);
$newdata = get_post_meta($post->ID,"new_image_data",true);
function bo_get_image_id($image_url) {
global $wpdb;
$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
return $attachment[0]; 
}
if($newdata != '') {
foreach((array)$newdata as $img ){
extract($img);
$image_url = $url;
$image_id = bo_get_image_id($image_url);
$image_thumb = wp_get_attachment_image_src($image_id, 'prop-single-thumb');   
if($url != '') { 
?>
<a href="<?php echo $url; ?>" rel="gallery" class="thickbox" title="<?php echo $caption; ?>"><img src="<?php echo $image_thumb[0]; ?>" title="<?php echo $caption; ?>" alt="<?php echo $alt; ?>" /></a>
<?php } } } 
if($data != '') { ?>
<?php
  $c = 0;
  if (count($data) > 0){
    foreach((array)$data as $i ){
      if (isset($i['i']) || isset($i['d'])){ 
	 $image_url = $i['i'];
$image_id = bo_get_image_id($image_url);
$image_thumb = wp_get_attachment_image_src($image_id, 'prop-single-thumb');    ?>  
	  
<a href="<?php echo $i['i']; ?>" rel="gallery" class="thickbox" title="<?php echo $i['d']; ?>"><img src="<?php echo $image_thumb[0]; ?>" title="<?php echo $i['d']; ?>" alt="<?php echo $i['d']; ?>" /></a>
      <?php
        }
    }
  } }  if(empty($data) && $url == '') { ?> 
            <?php the_post_thumbnail('prop-single-thumb'); ?> 
          <?php } ?>

</div>
</div>
<div class="small-thumb">
<?php 
$data = get_post_meta($post->ID,"image_data",true);
$newdata = get_post_meta($post->ID,"new_image_data",true);
function boo_get_image_id($image_url) {
global $wpdb;
$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
return $attachment[0]; 
}
if($newdata != '') {
foreach((array)$newdata as $img ){
extract($img);
$image_url = $url;
$image_id = boo_get_image_id($image_url);
$image_thumb = wp_get_attachment_image_src($image_id, 'prop-single-small-thumb');   
if($url != '') { 
?>
<a href="<?php echo $url; ?>" rel="gallery" class="thickbox" title="<?php  echo $caption; ?>"><img src="<?php echo $image_thumb[0]; ?>" title="<?php  echo $caption; ?>" alt="<?php //echo $alt; ?>" /></a>
<?php } } } 
if($data != '') { ?>
<?php
  $c = 0;
  if (count($data) > 0){
    foreach((array)$data as $i ){
      if (isset($i['i']) || isset($i['d'])){ 
	 $image_url = $i['i'];
$image_id = boo_get_image_id($image_url);
$image_thumb = wp_get_attachment_image_src($image_id, 'prop-single-small-thumb'); 
$image_thumb2 = wp_get_attachment_image_src($image_id, 'big-thumb'); 
   ?>  
	  
<a href="<?php echo $image_thumb2[0]; ?>" rel="gallery" class="thickbox" title="<?php echo $i['d']; ?>"><img src="<?php echo $image_thumb[0]; ?>" title="<?php echo $i['d']; ?>" alt="<?php // echo $i['d']; ?>" /></a>
      <?php
        }
    }
  } }  if(empty($data) && $url == '') { ?> 
            <?php // the_post_thumbnail('prop-single-small-thumb'); ?> 
          <?php } ?>


</div>

<?php if(empty($data) && $url == '') { } else { ?>
<div class="cycle-single-pager">
<div class="pager-bullets" id=pager2></div>
</div>
<?php }  ?>

<script type="text/javascript">
jQuery( '.cycleprops-single' ).cycle();
jQuery('.thickbox').mouseenter(function() {
jQuery('.zoomimg').show(); });
jQuery('.thickbox').mouseleave(function() {
jQuery('.zoomimg').hide();
	});
</script>

<div class="clear"></div>
<div class="prop-info">
<ul>
<?php if(get_post_meta($post->ID, '_boP_prop-pdf',true)) { ?>
<li><i class="icon-download"></i><a class="expose" href="<?php echo get_post_meta($post->ID, '_boP_prop-pdf',true); ?>" title="<?php echo __('Download object information', 'bobox'); ?>" target="_blank"><?php echo __('Download object information', 'bobox'); ?></a></li>
<?php } ?>
<?php if(get_post_meta($post->ID, '_boP_prop-ausweis',true)) { ?>
<li><i class="icon-download"></i><a href="<?php echo get_post_meta($post->ID, '_boP_prop-ausweis',true); ?>" title="<?php echo __('Energy certificate', 'bobox'); ?>"><?php echo __('Energy certificate', 'bobox'); ?></a></li>
<?php } ?>
<li><i class="icon-print"></i><a href="javascript:window.print()"><?php echo __('Print object information', 'bobox'); ?></a></li>
<li><i class="icon-mail"></i><a title="Informationen zur Immobilie via eMail versenden" href="mailto:?subject=Link%20zum%20Immobilienangebot:%20<?php the_title(); ?>&amp;body=%0AHier%20finden%20Sie%20Informationen%20zu%20folgendem%20Angebot:%0A%0A%2B%2B%2B%20<?php the_title(); ?>%20%2B%2B%2B%0A<?php the_permalink(); ?>"><?php echo __('Send this offer by email', 'bobox'); ?></a></li>
<li class="list-requestbutton">
<?php 
$data = get_option('bo_options');
$loc = strip_tags( get_the_term_list( $wp_query->post->ID, 'location', '', ', ', '' ) );
$typ = strip_tags( get_the_term_list( $wp_query->post->ID, 'proptype', '', ', ', '' ) );
$action = isset( $data['contact1']['bo_contact_page_url'] ) ? $data['contact1']['bo_contact_page_url'] : null;
$req = isset( $data['contact1']['bo_object_request_button_text'] ) ? $data['contact1']['bo_object_request_button_text'] : null;
?>
       <form method="post" action="<?php echo $action; ?>">
       <input type="submit" name="request" id="request" value="<?php if($req != '') { echo $req; } else { echo 'Send an inquiry';}?>"  />
       <input type="hidden" value="<?php the_title(); ?>" name="object-title" id="object-title" />
       <input type="hidden" value="<?php the_ID(); ?>" name="object-ID" id="object-ID" />
       <input type="hidden" value="<?php echo get_post_meta($post->ID, '_boP_prop-size', true); ?>" name="object-size" id="object-size" />
       <input type="hidden" value="<?php echo get_post_meta($post->ID, '_boP_prop-rooms', true); ?>" name="object-rooms" id="object-rooms" />
        <input type="hidden" value="<?php echo get_post_meta($post->ID, '_boP_prop-id', true); ?>" name="object-item" id="object-item" />
       <input type="hidden" value="<?php echo get_post_thumbnail_id($post->ID); ?>" name="object-img" id="object-img" />
       <input type="hidden" value="<?php the_permalink(); ?>" name="object-link" id="object-link" />
       <input type="hidden" value="<?php echo $loc; ?>" name="object-location" id="object-location" />
       <input type="hidden" value="<?php echo $typ; ?>" name="object-typ" id="object-typ" />
              </form>
<i class="icon-right"></i><div class="clear"></div>	</li>
</ul>
</div><!-- eof prop-infos -->
<?php get_template_part('related-objects'); ?>
</div><!-- eof sidebar -->
</div><!-- eof col -->
<div class="clear"></div>
</div><!-- eof content -->
<?php my_theme_scripts(); ?>
<?php my_theme_styles(); ?>
    
<?php get_footer(); ?>
