<?php 
$data = get_option('bo_options'); 
$sb = isset( $data['homeB']['bo_show_box'] ) ? $data['homeB']['bo_show_box'] : null;
if($sb == 'yes') { ?>
<div id="infoboxen">
<?php
$ib = isset( $data['home2'] ) ? $data['home2'] : null;
$ic = AdminPageFramework::getOption( 'bo_options', array( 'colors3', 'bo_icon_color'), '#999999' ); 
foreach ((array)$ib as $result) { extract((array)$result);
	if($bo_box_headline != '') { ?>

<div class="col-otc">
<div class="boxcontent">
<?php echo do_shortcode($bo_box_icon); ?>
<h3><a  href="<?php echo $bo_box_link; ?>"><?php echo $bo_box_headline; ?></a></h3>
<p><?php echo do_shortcode($bo_box_text); ?></p>
<a class="boxbutton" href="<?php echo $bo_box_link; ?>"><?php if($bo_box_link_text !='') { echo $bo_box_link_text; } else { echo 'Hier erfahren Sie mehr &rarr;';} ?></a>
<div class="clear"></div>
</div></div>
<?php } }?>

<div class="clear"></div>
</div>
<?php } ?>
