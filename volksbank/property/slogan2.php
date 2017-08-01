<?php
$data = get_option('bo_options');
$s2 = isset( $data['homeSl']['bo_slogan2'] ) ? $data['homeSl']['bo_slogan2'] : null; 
if($s2 !='') { ?>
<h2 class="slogan"><?php echo $s2; ?></h2>
<div class="separator"></div>
<?php } ?>

