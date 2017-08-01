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

<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/images/favicon_profino.ico">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/source/jquery.fancybox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animations-ie-fix.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animations.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css" type="text/css" media="screen" />


<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '695560460508160');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=695560460508160&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<?php wp_head(); ?>
<?php if ( !is_user_logged_in() ){ ?>
			<style>
            #wpadminbar{ display:none; }
			html {
				margin-top: 0 !important;
			}
            </style>
		<?php } ?>
</head>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KRVGQT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KRVGQT');</script> 
<!-- End Google Tag Manager -->
<body <?php body_class(); ?>  id="home">



<!-- start template -->

<div id="template">

	<!--  / layout \ -->

	<div id="layout">

        <!-- start header -->

		<div id="header-part">

			<!-- header bar -->
			<?php if ( is_front_page()){ ?>
				<div class="header-bar header-barp">        

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
				<div style="display:none;" class="header-bar header-barp mobile">        
					<div class="centering">
						<div class="cantain">			

							<?php // echo do_shortcode('[rev_slider alias="slider1"]');?>                 

							<div class="image">
								<img src="<?php bloginfo('template_url');?>/images/bg3m.png" / >
							</div>
							<div class="right scrollme ">
								<h2 class="animateme right"><?php echo of_get_option('sl_left'); ?></h2>
								<div class="animateme">
									<?php echo of_get_option('sl_right'); ?>

									<a href="<?php echo of_get_option('sl_right_link'); ?>" class="link"><?php echo of_get_option('sl_right_link_text'); ?></a>
								</div>
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