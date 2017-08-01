<?php


/**



 * @package WordPress



 * @subpackage Default_Theme



 */



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>







<head profile="http://gmpg.org/xfn/11">

<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/stylesheets/fonts.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/fonts/fonts.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/responsive.css" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!-- Shepley Wood Products Container Tag; Do not remove or alter code in any way. Generated: 1/12/2017 -->


<!-- Placement: Paste this code as high in the <head> of the page as possible. -->  

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N9VQLBB');</script>
<!-- End Google Tag Manager -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47419312-1', 'shepleywood.com');
  ga('send', 'pageview');

</script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script src="http://www.smartsite.tv/remote/smart.php?oid=w6zzB7N3" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.accordion.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript">

$(document).ready(function()

{

	$(".infoBar p:last").addClass("last");

});

</script>


<script type="text/javascript">

            $(function() {

				$('#st-accordion').accordion();

				

            });

 </script>



<script src="<?php bloginfo('template_directory'); ?>/js/tinynav.min.js"></script>
<script type="text/javascript">
	$(function () {
		$('#menu-header-menu').tinyNav({
			active: 'selected',
			header: 'Navigation' 
		});
	});
</script>

<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.mmenu.all.css" />


<?php wp_head(); ?>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.mmenu.min.all.js"></script>
<script type="text/javascript">
	jQuery(function() {
			jQuery('nav#nav').mmenu({
				extensions	: [ 'effect-slide-menu', 'pageshadow' ],
				searchfield	: false,
				counters	: false,
				navbar 		: {
					title		: 'Menu'
				},
				navbars		: [
					{
						position	: 'top',
						content		: [
							'prev',
							'title',
							'close'
						]
					}
				]
			});
		});
</script>
<meta name="google-site-verification" content="lef2Orlt4xa6KxDnNQS1p1Cvv20z7pngXMHVnKI1dTQ" />
</head>







<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N9VQLBB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!--  / wrapper \ -->



<div id="wrapper">



	



	<!--  / layout \ -->



	<div id="layout">



    



    <!--  / header \ -->



		<div id="header">


<div class="centerBar2">




			<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img alt="Logo" src="<?php echo get_template_directory_uri(); ?>/images/logo2.png" /></a></div>

          
<div class="headerRight">


            <!--  / social bar \ -->

			<div class="socialBar">


				<?php if ( is_active_sidebar( 'top-header-social-media-widget' ) ) : ?>

				<?php dynamic_sidebar( 'top-header-social-media-widget' ); ?>

	             <?php endif; ?>


                 

			</div>

	<!--  \ social / -->
<div class="clear"></div>

				<!--  / menu bar \ -->

			<div class="menuBar">
				<div class="javaimage"><?php if ( is_active_sidebar( 'java-video-application-image-widget' ) ) : ?>

				<?php dynamic_sidebar( 'java-video-application-image-widget' ); ?>

	             <?php endif; ?></div>            
				
				<div class="mobilemenu"><a href="#nav"></a></div>
				
				<nav id="nav">
					<?php wp_nav_menu(array('theme_location'=>'primary')); ?>
				</nav>

			</div>


			<!--  \ menu bar / -->

</div>
<div class="menuBar">
					
				<div id="nav">
					<?php wp_nav_menu(array('theme_location'=>'primary')); ?>
				</div>
</div>
<div class="clear"></div>
		</div>

	</div>


		<!--  \ header / -->