<?php 
/*
* @package     Property
* @author      Sabine Brings - brings-online.com
* @version     1.0
*/
?>
<div id="top-home2">
<?php 
$data = get_option('bo_options');
$effect = AdminPageFramework::getOption( 'bo_options', array( 'home1', 'slider_effect'), 'fade' );
$pause = AdminPageFramework::getOption( 'bo_options', array( 'home1', 'slider_pause'), '3500' );
$speed = AdminPageFramework::getOption( 'bo_options', array( 'home1', 'slider_speed'), '500' );
$img = isset( $data['homeS2']['home_slider2'] ) ? $data['homeS2']['home_slider2'] : null; 

?>	
<div class="slideshow" 
    data-cycle-fx="<?php echo $effect; ?>"
    data-cycle-speed="<?php echo $speed; ?>"
    data-cycle-timeout="<?php echo $pause; ?>"
    data-cycle-manual-fx="fadeOut"
    data-cycle-manual-speed="300"
    data-cycle-auto-height=container
    data-cycle-loader=wait
    data-cycle-pager="#pager2"
    data-cycle-swipe=true
    data-cycle-slides=">div">
 
 <?php 
foreach ((array)$img as $result) {
	extract($result);
   	if($url != '') {  ?>
    <div class="slider-item"><img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" />
    <div class="slider-caption"><?php echo $caption; ?></div></div>
 <?php } }?>
   
</div><!-- eof slideshow -->

</div><!-- eof homebox -->
<?php 
if(count($img) == 1) { } else { ?>
<div class="pager-bullets" id="pager2"></div>
<?php } ?>
<script type="text/javascript">
jQuery( '.slideshow' ).cycle();
</script>