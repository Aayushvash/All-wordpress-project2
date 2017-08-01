<?php
$data = get_option('bo_options');
$s1 = isset( $data['homeSl']['bo_slogan1'] ) ? $data['homeSl']['bo_slogan1'] : null; 
if($s1 !='') { ?> 
<h2 class="slogan"><?php echo $s1; ?></h2>
<div class="separator"></div>
<?php } ?>

