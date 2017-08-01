<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="keywords" content="key, words"/>	
	<meta name="description" content="Website description"/>
	<meta name="robots" content="noindex, nofollow"/><!-- change into index, follow -->
	<meta name="format-detection" content="telephone=no" />
	
    <!-- Mobile Specific Metas ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
	
	<?php wp_head(); ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body <?php body_class(); ?>>

<!-- begin section -->
<div id="section">
	
	<!-- begin page-wrap -->
	<div id="page-wrap">
		
		<!-- begin header -->
		<div id="header-wrap">
			<!-- begin top-block -->
			<div class="top-block">
				<div class="centering">
					<div class="left">
					<?php $logo = of_get_option('website_logo');?>
					<?php $url = of_get_option('website_logo_url');?>
					
						<a href="<?php echo $url;?>" style="background:url('<?php echo $logo;?>') no-repeat right center;"><?php echo of_get_option('website_logo_text');?></a>		
						
					</div>
					<div class="right">
						<ul>
							<li><a href="<?php the_permalink(122);?>" class="primaryBtn">aanmelden</a></li>
							<li><a href="<?php the_permalink(120);?>" class="primaryBtn">inloggen</a></li>
							
							<li>	
								 <?php get_search_form(); ?>		
								
							</li>
							
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- finish top-block -->
			<!-- begin bottom-block -->
			<div class="bottom-block">
				<div class="centering">
					<div class="left logo">
						<!--<a href="#"><img src="images/logo.png" alt=""/></a>-->
						<?php dynamic_sidebar('logo_sidebar');?>
					</div>
					<div class="mobile-menu" onclick="myFunction(this)">
					<div class="bar1"></div>
					<div class="bar2"></div>
					<div class="bar3"></div>
					</div>
					<div class="right nav">									
					<?php 
						$args = array('theme_location'=>'primary','menu'=>'Top-Menu','container_class'=>'right nav','container'=>'ul');					
					wp_nav_menu ($args);
					?>

						
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- finish bottom-block -->
		</div>
		<!-- finish header -->