<div id="top-home">
<?php 
$data = get_option('bo_options');
$effect = AdminPageFramework::getOption( 'bo_options', array( 'home1', 'slider_effect'), 'fade' );
$pause = AdminPageFramework::getOption( 'bo_options', array( 'home1', 'slider_pause'), '3500' );
$speed = AdminPageFramework::getOption( 'bo_options', array( 'home1', 'slider_speed'), '500' );
$img = isset( $data['homeS']['home_slider'] ) ? $data['homeS']['home_slider'] : null; 
?>	
<div class="slideshow" 
    data-cycle-fx="<?php echo $effect; ?>"
    data-cycle-speed="<?php echo $speed; ?>"
    data-cycle-timeout="<?php echo $pause; ?>"
    data-cycle-manual-fx="scrollHorz"
    data-cycle-manual-speed="300"
    data-cycle-auto-height=container
    data-cycle-loader=wait
    data-cycle-pager="#pager2"
data-cycle-pager-template="<a href=#> </a>"
    data-cycle-swipe=true
    data-cycle-slides=">div">
 
 <?php 
foreach ((array)$img as $result) {
	extract($result);
   	if($url != '') {  ?>
    <div class="slider-item"><a href="<?php echo $link; ?>"><img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" /></a>
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