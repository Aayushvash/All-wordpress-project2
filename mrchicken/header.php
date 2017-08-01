<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 */

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>



<head profile="http://gmpg.org/xfn/11">



<!-- Mobile Specific Metas ================================================== -->

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">



<!--[if lte IE 9]>

<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

<![endif]-->

        

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />




<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>



<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />



<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/fonts/stylesheet.css" />



<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/respond.src.js"></script>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/tinynav.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#menu-main-menu').tinyNav({
			active: 'selected',
			header: 'Navigation' 
		});
	});
</script>

    

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 



<?php wp_head(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40249509-1', 'mrchickencater.com');
  ga('send', 'pageview');

</script>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-40249509-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; 

ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';

var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
</head>



<body <?php body_class(); ?>>



<!-- begin section -->

<section id="section">

	

	<!-- begin page-wrap -->

	<section id="page-wrap">

		

		<!-- begin header -->

		<header id="header-wrap">
        
        <article class="bg">
        	
            <div class="top">

			
    
                <h3>CATERING HOTLINE<span><?php echo get_theme_option('hotline'); ?></span></h3>
    
                
    
                <div class="clear"></div>
    
                
    
                <div class="logo"><a href="<?php echo get_option('home'); ?>/"><img src="<?php bloginfo('template_url'); ?>/images/logo1.png" alt="" /></a></div>
            
            
            </div>
        
        </article>

            

            

            

            <!-- begin nav -->

			<nav class="nav-block">
            	
                <aside class="middle">



					<?php wp_nav_menu( array('container' =>false, 'echo' => true, 'theme_location' => 'mainnav', 'before' => '', 'after' => '', 'link_before' => '<span>', 'link_after' => '</span>', 'depth' => 0) ); ?>
                

                

                <div class="link">

                    

                    <?php wp_nav_menu( array('container' =>false, 'echo' => true, 'theme_location' => 'highlight', 'before' => '', 'after' => '', 'link_before' => '<span>', 'link_after' => '</span>', 'depth' => 0) ); ?>

				

                </div> 
                
                
                </aside>   

                

			</nav>

			<!-- finish nav -->



		</header>

		<!-- finish header -->        

        