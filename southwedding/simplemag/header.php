<?php
/**
 * The Header for the theme
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.4
**/
global $ti_option; // Fetch options stored in $ti_option;
?><!DOCTYPE html>
<!--[if lt IE 9]><html <?php language_attributes(); ?> class="oldie"><![endif]-->
<!--[if (gte IE 9) | !(IE)]><!--><html <?php language_attributes(); ?> class="modern"><!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php
	if( ! is_home() ):
	  wp_title( '|', true, 'right' );
	endif;
	bloginfo( 'name' );
  ?></title>

<!-- Always force latest IE rendering engine & Chrome Frame -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<!-- Meta Viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php 
// Get the favicon
if ( $ti_option['site_favicon'] != '' ) { 
	$site_favicon = $ti_option['site_favicon'];
} else { 
	$site_favicon = get_template_directory_uri() . '/images/favicon.ico';
}
?>
<link rel="shortcut icon" href="<?php echo $site_favicon; ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/font.css" type="text/css">
<?php 
// Get the retina favicon
if ( $ti_option['site_retina_favicon'] != '' ) { 
	$retina_favicon = $ti_option['site_retina_favicon'];
} else { 
	$retina_favicon = get_template_directory_uri() . '/images/retina-favicon.png';
}
?>
<link rel="apple-touch-icon-precomposed" href="<?php echo $retina_favicon; ?>" />

<?php wp_head(); ?>
<script type='text/javascript'>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
  (function() {
    var gads = document.createElement('script');
    gads.async = true;
    gads.type = 'text/javascript';
    var useSSL = 'https:' == document.location.protocol;
    gads.src = (useSSL ? 'https:' : 'http:') +
      '//www.googletagservices.com/tag/js/gpt.js';
    var node = document.getElementsByTagName('script')[0];
    node.parentNode.insertBefore(gads, node);
  })();
</script>

<script type='text/javascript'>
  googletag.cmd.push(function() {
    googletag.defineSlot('/37193707/SNEW1', [300, 250], 'div-gpt-ad-1453059781036-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>
</head>

<?php 
if ( is_page() ) { $page_slug = 'page-'.$post->post_name; } else { $page_slug = ''; }
if ( get_field( 'page_sidebar' ) == 'page_sidebar_on' || get_field('category_slider', 'category_' . get_query_var('cat') ) == 'cat_slider_on' && get_field('category_slider_position', 'category_' . get_query_var('cat') ) == 'cat_slider_above' && get_field( 'category_sidebar', 'category_' . get_query_var('cat') ) == 'cat_sidebar_on' ) { $with_sidebar = 'with-sidebar'; } else { $with_sidebar = ''; } ?>
<body <?php body_class( $with_sidebar, $page_slug ); ?>>

<div id="outer-wrap">
    <div id="inner-wrap">

    <div id="pageslide">
        <a id="close-pageslide" href="#top"><i class="icon-remove-sign"></i></a>
    </div><!-- Sidebar in Mobile View -->

    <header id="masthead" role="banner" class="clearfix">
        
		<div class="top-strip <?php echo $ti_option['site_top_strip_color']; if ( $ti_option['site_top_strip'] == 0 ) { echo ' hide-strip'; } ?>">
            <div class="wrapper clearfix">
            	
                <?php get_search_form(); ?>
                
                <?php 
				// Social Profiles
				if( $ti_option['top_social_profiles'] == 1 ) {
					get_template_part ( 'inc/social', 'profiles' ); 
				}
				?>
                
                <a id="open-pageslide" href="#pageslide"><i class="icon-menu"></i></a>
                
                <?php
                // Pages Menu
				if ( has_nav_menu( 'secondary_menu' ) ) :
					wp_nav_menu( array (
						'theme_location' => 'secondary_menu',
						'container' => 'nav',
						'container_class' => 'secondary-menu',
						'menu_id' => 'secondary-nav',
						'depth' => 2,
						'fallback_cb' => false
					 ));
				 else:
					echo '<div class="alignleft no-margin message warning"><i class="icon-warning-sign"></i>' . __( 'Define your site secondary menu', 'themetext' ) . '</div>';
				 endif;
                ?>
            </div><!-- .wrapper -->
        </div><!-- .top-strip -->
        
        
        <div class="wrapper">
        	
            <div id="branding" class="animated">
                <!-- Logo -->
				<?php 
                // Get the logo
                if ( $ti_option['site_logo'] != '' ) { 
                    $site_logo = $ti_option['site_logo'];
                } else { 
                    $site_logo = get_template_directory_uri() . '/images/logo.png';
                }
                ?>
                <a class="logo" href="<?php echo home_url( '/' ); ?>">
                    <img usemap="#Map" src="<?php echo $site_logo; ?>" alt="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>" title="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>" />
                </a>
                <map name="Map">
  <area shape="rect" coords="900,26,1147,305" href="http://southernneweddings.com/southern-new-england-weddings-2016/">
  <area shape="rect" coords="9,6,897,305" href="http://southernneweddings.com/">
</map>
                <!-- End Logo -->
                
                <?php 
                // Show or Hide site tagline under the logo based on Theme Options
                if( $ti_option['site_tagline'] == 1 ) {
                ?>
                <span class="tagline">
                    <?php bloginfo( 'description' ); ?>
                </span>
                <?php } ?>
            </div>
            
            <?php
            // Main Menu
			if ( has_nav_menu( 'main_menu' ) ) :
				wp_nav_menu( array (
					'theme_location' => 'main_menu',
					'container' => 'nav',
					'container_class' => 'animated main-menu',
					'menu_id' => 'main-nav',
					'depth' => 2,
					'fallback_cb' => false,
					'walker' => new TI_Menu()
				 ));
			 else:
			 	echo '<div class="message warning"><i class="icon-warning-sign"></i>' . __( 'Define your site main menu', 'themetext' ) . '</div>';
			 endif;
            ?>
    
        </div><!-- .wrapper -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-16245068-39', 'auto');
  ga('send', 'pageview');

</script>     
    </header><!-- #masthead -->