<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php $data = get_option('bo_options');
$seo = isset( $data['seo']['bo_theme_seo'] ) ? $data['seo']['bo_theme_seo'] : null; ?>
<title><?php if($seo == 'yes') { bop_meta_title(); } else { wp_title( '|', true, 'right' ); bloginfo('name'); } ?></title>
<?php if($seo == 'yes') { ?>
<meta name="description" content="<?php bop_meta_description(); ?>" />
<meta name="keywords" content="<?php bop_meta_keywords(); ?>" />
<?php } ?>


<?php $data = get_option('bo_options');
$ti144 = isset( $data['basis3']['bo_touch_icon_144']) ? $data['basis3']['bo_touch_icon_144'] : null;
$ti114 = isset( $data['basis3']['bo_touch_icon_114']) ? $data['basis3']['bo_touch_icon_114'] : null;
$ti72 = isset( $data['basis3']['bo_touch_icon_72']) ? $data['basis3']['bo_touch_icon_72'] : null;
$ti57 = isset( $data['basis3']['bo_touch_icon_57']) ? $data['basis3']['bo_touch_icon_57'] : null;
$ti16 = isset( $data['basis3']['bo_favicon']) ? $data['basis3']['bo_favicon'] : null; ?> 
<?php if( $ti144 != '' ) { ?>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $ti144; ?>">
<?php } ?>
<?php if( $ti114 != '' ) { ?>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $ti114; ?>">
<?php } ?>
<?php if( $ti72 != '' ) { ?>
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $ti72; ?>">
<?php } ?>
<?php if( $ti57 != '' ) { ?>
<link rel="apple-touch-icon" href="<?php echo $ti57; ?>"> 
<?php } ?>
<?php 
if( $ti16 != '' ) { ?>
<link rel="Shortcut Icon" type="image/x-icon" href="<?php echo $ti16; ?>" />  
<?php } ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="header" >
<div id="headercontent">

<div class="topmenu">

<?php
$mainargs = array(
  'container'       => '',
  'menu'            => '', 
  'menu_class'      => 'topmenu',  
  'menu_id'         => '',
  'depth'			=> 1,
  'theme_location'  => 'top-menu');
wp_nav_menu($mainargs); ?>

</div>

<span class="maker"><?php dynamic_sidebar('Makler Logo');?> </span>
<span class="ivd"></span>

<div class="col-md-9 cb">
<div class="logo">

<?php $data = get_option('bo_options');
$logoimg = isset( $data['basis1']['bo_logo_image']['url'] ) ? $data['basis1']['bo_logo_image']['url'] : null; 
$logoimgalt = isset( $data['basis1']['bo_logo_image']['alt'] ) ? $data['basis1']['bo_logo_image']['alt'] : null; 
$logotitle = isset( $data['basis2']['logotitle'] ) ? $data['basis2']['logotitle'] : null; 
$logosubtitle = isset( $data['basis2']['logosubtitle'] ) ? $data['basis2']['logosubtitle'] : null; 
if($logoimg != '') { ?>
<a href="<?php echo home_url( '/' ); ?>" title="<?php echo __('Startseite','bobox'); ?>"><img src="<?php echo $logoimg ?>" alt="<?php echo $logoimgalt?>" /></a>
<?php } 
elseif($logotitle != '') { ?>
<div class="logotitle"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo __('Startseite','bobox'); ?>"><?php echo $logotitle ?></a></div>	
<div class="logosubtitle"><?php echo $logosubtitle ?></div>	
<?php }
else { ?>
<div class="logotitle"><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></div>
<div class="logosubtitle"><?php bloginfo('description'); ?></div>
<?php } ?>
</div>
<!-- eof logo -->
</div>
</div><!-- eof headercontent -->
</div><!-- eof header -->
<div id="wrapper">
<div id="page">

<div class="col-full ct">
<div id="main-menu">
<a class="toggleMenu" href="#"> <span>&#8801;</span><span style="
    float: right;
    font-size: 31px;color:#eee;margin-right: 12px;
    text-transform: uppercase;">menu</span></a>
<?php 
$mainargs = array(
  'container'       => '',
  'menu'            => '', 
  'menu_class'      => 'nav', 
  'menu_id'         => 'topmenu',
  'before'     => '',
  'after'      => '',
  'depth'           => 2,
  'fallback_cb'     => '',
  'theme_location'  => 'main-menu');
wp_nav_menu($mainargs); ?>
</div>

</div>