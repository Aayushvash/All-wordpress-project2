<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<?php wp_head(); ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body <?php body_class(); ?>>

<!--  wrapper -->
<div id="wrapper">
	
	<!--  layout -->
	<div id="layout">

		<!--  header -->
		<div id="header">
			<div class="bg-top">
			
				<div class="centring">					
					
						<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png"></a></div>
						
					
						<div class="top-right">
						<?php if(get_theme_option('phone')){ ?>
						Toll Free: <a class="tel" href="tel:<?php echo get_theme_option('phone'); ?>"><?php echo get_theme_option('phone'); ?></a> <?php } ?> 
						<?php if(get_theme_option('add')){ ?><span><?php echo get_theme_option('add'); ?></span><?php } ?>
						<?php if(get_theme_option('face')){ ?>
						<a class="fb" href="<?php echo get_theme_option('face'); ?>"></a>
						<?php } ?>
						
						</div>
						
							<!--  nav -->
						<div class="nav-block">
							<?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'primary' ) ); ?>	
						</div>
						<!--  nav -->
						<div class="clear"></div>					
									
					
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>

		