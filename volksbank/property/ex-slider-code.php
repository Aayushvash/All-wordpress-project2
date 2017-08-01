<?php 
$data = get_option('bo_options');
$exsc = isset( $data['homeEXS']['bo_ex_slider_plugin'] ) ? $data['homeEXS']['bo_ex_slider_plugin'] : null; 
if($exsc !='') { ?> 
<div class="top-home-wrap">
<?php echo do_shortcode($exsc); ?>
</div>
<?php } ?>