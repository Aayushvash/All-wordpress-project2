<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 */

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/source/jquery.fancybox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animations-ie-fix.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animations.css" type="text/css" media="screen" />


<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>  id="home">



<!-- start template -->

<div id="template">

	<!--  / layout \ -->

	<div id="layout">

        <!-- start header -->

		<div id="header-part">

			<!-- header bar -->
			<?php if ( is_front_page()){ ?>

                        <div class="header-bar">

          

            	<div class="cantain">
				

                	<?php // echo do_shortcode('[rev_slider alias="slider1"]');?>

                    

                   <div class="left  scrollme">

                    	<h2 class="animateme" data-when="enter"  data-from="1"  data-to="0"  data-translatey="100" ><?php echo of_get_option('sl_left'); ?></h2>

                    </div>
					 
					
					

                    <div class="middle ">

                    	<div class="new">

                        	<h3><?php echo of_get_option('sl_mid'); ?></h3>

                        </div>

                    </div>

                    <div class="right scrollme ">
						<div class="animateme" data-when="enter"  data-from="1"  data-to="0"  data-translatey="100">
                    	<?php echo of_get_option('sl_right'); ?>

                        <a href="<?php echo of_get_option('sl_right_link'); ?>" class="link"><?php echo of_get_option('sl_right_link_text'); ?></a>
						</div>

                    </div>            

                </div>

            </div>
			<?php } ?>

            <!-- finish header-bar --> 



            <!-- nav bar -->

            <div class="nav-bar">

                <div class="cantain">

                <div class="centering">

                    <div class="logo">
				<?php if ( is_front_page()){ ?>
                    <a class="hhp" href="#home" title="<?php bloginfo('name'); ?>">
					

                    	<?php if ( of_get_option('website_logo') ) { ?>

                        <img src="<?php echo of_get_option('website_logo'); ?>" alt="<?php bloginfo('name'); ?>" />

                        <?php } else { ?>

                        

                        <img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" />

                        <?php } ?>
						

                    </a>
				<?php } else { ?>
				
				<a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>">
					

                    	<?php if ( of_get_option('website_logo') ) { ?>

                        <img src="<?php echo of_get_option('website_logo'); ?>" alt="<?php bloginfo('name'); ?>" />

                        <?php } else { ?>

                        

                        <img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" />

                        <?php } ?>
				</a>
				
				
				<?php } ?>

                </div>

                

                   <div>

                   

                   
				<?php if ( is_front_page()){ ?>	
                       <button class="hamburger" style="float:right;"><span>Menu</span> <i class="bar"></i></button>
                	<?php 

					wp_nav_menu( array(

						'theme_location' => 'primary',

						'menu_id' => 'nav'

					) );

					?>  
				<?php } else { ?>
				<button class="hamburger" style="float:right;"><span>Menu</span> <i class="bar"></i></button>
				<?php 

					wp_nav_menu( array(

						'theme_location' => 'secondry',

						'menu_id' => 'nav'

					) );

					?>  
				
				
				<?php } ?>

                    </div> 

                </div>

              </div>

            </div>

            <!-- finish nav bar -->                       

		</div>

		<!-- end header -->

        

		<!-- start content -->

		<div id="content-part">