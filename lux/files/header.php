<!DOCTYPE html>



<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>



<head>







<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />



<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">



   



<title>



<?php if (is_front_page()) { ?> LUX ist intelligente Energie  <?php  } else { wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); } ?>



</title>



<link rel=”shortcut icon” href=”<?php bloginfo(’url’); ?>/favicon.ico” type=”image/x-icon” />



<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />



<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fonts/fonts.css" type="text/css" media="screen" />



<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/print.css" media="print" />







<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/font-awesome/css/font-awesome.min.css">







<!--[if IE 7]>

 <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/font-awesome/css/font-awesome-ie7.min.css">

<![endif]-->







<!--[if lt IE 9]>



    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>



<![endif]--> 



<script defer src="<?php bloginfo('template_url'); ?>/js/respond.src.js"></script>



<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>







<?php wp_head(); ?>



<script type="text/javascript">

  if (navigator.appVersion.indexOf("MSIE 7.") != -1)  alert('Bitte aktualisieren Sie Ihren Browser.');

</script>



<script defer src="<?php bloginfo('template_url'); ?>/js/modernizr.js"></script>



<script defer src="<?php bloginfo('template_url'); ?>/js/responsive.nav.js"></script>







<?php if(is_front_page()){?>



<!-- FlexSlider -->



<script defer src="<?php bloginfo('template_url'); ?>/js/jquery.flexslider-min.js"></script>



<script type="text/javascript">



$(window).load(function(){



  $('.flexslider').flexslider({



    animation: "slide",



    start: function(slider){



      $('body').removeClass('loading');



    }



  });



});



</script>



<?php } ?>







<?php if(is_archive()||is_search()) {?>



<script src="<?php bloginfo('template_url'); ?>/js/jquery.masonry.min.js"></script>



<script src="<?php bloginfo('template_url'); ?>/js/jquery.infinitescroll.min.js"></script>



<script type="text/javascript">



  $(function(){



    



    var $container = $('#articlesList');



    



    $container.imagesLoaded(function(){



      $container.masonry({



        itemSelector: '.article',



		isAnimated: true,



		  // set columnWidth a fraction of the container width



		  columnWidth: function( containerWidth ) {



			return containerWidth / 3;



		  }		



      });



    });



    



    $container.infinitescroll({



      navSelector  : '#page-nav',    // selector for the paged navigation 



      nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)



      itemSelector : '.article',     // selector for all items you'll retrieve



      loading: {



          finishedMsg: 'No more pages to load.',



          img: 'http://i.imgur.com/6RMhx.gif'



        }



      },



      // trigger Masonry as a callback



      function( newElements ) {



        // hide new items while they are loading



        var $newElems = $( newElements ).css({ opacity: 0 });



        // ensure that images load before adding to masonry layout



        $newElems.imagesLoaded(function(){



          // show elems now they're ready



          $newElems.animate({ opacity: 1 });



          $container.masonry( 'appended', $newElems, true ); 



        });



      }



    );



    



  });



</script>



<?php } ?>







</head>



<script type="text/javascript">
function createCookie(name,value,days) {
if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
}
else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
var nameEQ = name + "=";
var ca = document.cookie.split(';');
for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
}
return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}


function show_popup()
{
	if (!readCookie('alreadyShown')) {
		window.open('leserumfrage.html','leserumfrage','menubar=0,scrollbars=0,resizable=0,toolbar=0,status=0,width=800,height=580');
		createCookie('alreadyShown', true)
	}
}
</script>





<body <?php body_class(); ?> <?php if(is_front_page() ) { echo 'onload="show_popup()"'; } ?>>







<!--  layout -->



<div id="main">



<div id="layout">







    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('top_ad_banner') ) : ?><?php endif; ?>



    



    <!--  header -->



    <div id="header">



        <div class="centering">



            



            <!-- logo -->



            <div class="logo">



                <a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>">



                    <img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" />



                </a>



            </div>



            <!-- logo -->



            



            <!-- menubar -->



            <nav id="nav" class="menubar" role="navigation">



                <?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'primary' ) ); ?>



                <?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'mobile' ) ); ?>



                <?php get_search_form();?>	



                <a class="close-btn" id="nav-close-btn" href="#top">Return to Content</a>



            </nav>



            <!-- menubar -->



            



            <a class="nav-btn" id="nav-open-btn" href="#nav">Book Navigation</a>



            



            <div class="clear"></div>



        </div>



    </div>



    <!-- header --> 



    



    <!-- content -->



    <div id="content"<?php if(is_front_page()) { ?> class="mainPage"<?php } ?>>    



            