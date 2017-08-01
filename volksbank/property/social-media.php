<?php 
$data = get_option('bo_options');
$google = isset( $data['social']['bo_social_google'] ) ? $data['social']['bo_social_google'] : null; 
$fb = isset( $data['social']['bo_social_fb'] ) ? $data['social']['bo_social_fb'] : null; 
$twitter = isset( $data['social']['bo_social_twitter'] ) ? $data['social']['bo_social_twitter'] : null; 
$yt = isset( $data['social']['bo_social_yt'] ) ? $data['social']['bo_social_yt'] : null; 
$linkedin = isset( $data['social']['bo_social_linkedin'] ) ? $data['social']['bo_social_linkedin'] : null; 
$xing = isset( $data['social']['bo_social_xing'] ) ? $data['social']['bo_social_xing'] : null; 
$pint = isset( $data['social']['bo_social_pint'] ) ? $data['social']['bo_social_pint'] : null; 
$rss = isset( $data['social']['bo_social_pint'] ) ? $data['social']['bo_social_rss'] : null; 
$mail = isset( $data['social']['bo_social_mail'] ) ? $data['social']['bo_social_mail'] : null; 
?>
<div class="smicons">

<?php if($google != '') { ?><a href="<?php echo $google; ?>"><span><i class="icon-gplus-1"></i></span></a><?php } ?>
<?php if($fb != '') { ?><a href="<?php echo $fb; ?>"><span><i class="icon-facebook-1"></i></span></a><?php } ?>
<?php if($twitter != '') { ?><a href="<?php echo $twitter; ?>"><span><i class="icon-twitter-1"> </i></span></a><?php } ?>
<?php if($yt != '') { ?><a href="<?php echo $yt; ?>"><span><i class="icon-youtube"></i></span></a><?php } ?>
<?php if($linkedin != '') { ?><a href="<?php echo $linkedin; ?>"><span><i class="icon-linkedin-1"></i></span></a><?php } ?>
<?php if($xing != '') { ?><a href="<?php echo $xing; ?>"><span><i class="icon-xing"></i> </span></a><?php } ?>
<?php if($rss != '') { ?><a href="<?php echo $rss; ?>"><span><i class="icon-rss"></i></span></a><?php } ?>
<?php if($mail != '') { ?><a href="<?php echo $mail; ?>"><span><i class="icon-mail"></i></span></a><?php } ?>

<div class="clear"></div>
</div>






