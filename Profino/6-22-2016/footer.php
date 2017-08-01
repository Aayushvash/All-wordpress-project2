<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 */

?>

<div class="clear"></div>
</div>

<!--  \ content / --> 

<!-- start footer -->

<div id="footer-part"> 
  
  <!-- start profile bar -->
  
  <div class="profile-bar">
    <div class="centering">
      <div class="mid">
        <div class="left">
          <div class="logo"> <a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>">
            <?php if ( of_get_option('footer_logo') ) { ?>
            <img src="<?php echo of_get_option('footer_logo'); ?>" alt="<?php bloginfo('name'); ?>" />
            <?php } else { ?>
            <img src="<?php bloginfo('template_url'); ?>/images/footer-logo.png" alt="<?php bloginfo('name'); ?>" />
            <?php } ?>
            </a> </div>
          <p>Die erste Onlinemesse für Makler</p>
        </div>
        <div class="right">
          <p>Jetzt kostenlos für den profino Newsletter anmelden!</p>
          <?php echo do_shortcode('[contact-form-7 id="137" title="Jetzt kostenlos für den profino Newsletter anmelden!"]'); ?> </div>
      </div>
    </div>
  </div>
  
  <!-- finish profile-bar -->
  
  <div class="centering"> 
    
    <!-- start photo bar -->
    
    <div class="photo-bar">
      <?php // dynamic_sidebar('photo-bar'); ?>
	  <ul><?php

								$args = array( 'post_type' => 'bottom_image', 'post_status' => 'publish', 'posts_per_page' => 8);

								$loop = new WP_Query( $args );

								$i = 1;

								while ( $loop->have_posts() ) : $loop->the_post();
								$link = get_field('bottom_link');

							?>
							
                        <li><a href="<?php echo $link; ?>"><?php the_post_thumbnail('bottom_image'); ?></a></li>
						<?php endwhile; ?>
                           
                    </ul>   
    </div>
    
    <!-- finish photo bar --> 
    
    <!-- start footer bar -->
    
    <div class="footer-bar animatedParent">
      <ul>
        <li class="left animated fadeIn slow go"><a href="<?php echo of_get_option('fb_link'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img1.png" alt="" /></a></li>
        <li class="left animated fadeIn slow go" ><a href="<?php echo of_get_option('twitter_link'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img2.png" alt="" /></a></li>
        <li class="left animated fadeIn slow go" ><a href="<?php echo of_get_option('tumbler_link'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img3.png" alt="" /></a></li>
        <li class="left animated fadeIn slow go" ><a href="<?php echo of_get_option('Google_plus_link'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img4.png" alt="" /></a></li>
        <li class="left animated fadeIn slow go" ><a href="<?php echo of_get_option('Youtube_link'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img5.png" alt="" /></a></li>
      </ul>
      <div class="copyright">
        <p><?php echo of_get_option('copyright_text'); ?></p>
      </div>
    </div>
    
    <!-- finish footer bar --> 
    
  </div>
  
  <!-- end footer --> 
  
</div>

<!--  \ footer / -->

</div>

<!--  \ layout / -->

</div>

<!--  \ wrapper / --> 

 <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.js" type="text/javascript"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.nav.js" type="text/javascript"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/custom-form-elements.js" type="text/javascript"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/source/jquery.fancybox.js" type="text/javascript"></script> 

<script src="<?php echo get_template_directory_uri(); ?>/js/scrollme.js" type="text/javascript"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js" type="text/javascript"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/css3-animate-it.js" type="text/javascript"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.film_roll.js" type="text/javascript"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.parallax-1.1.3.js" type="text/javascript"></script>  
 
<script>

$ = jQuery.noConflict(true);

$("document").ready(function($){
	$( "a.hhp" ).click(function() {
		$('#nav #menu-item-4 a').trigger('click');
		
  
});

    var nav = $('.nav-bar');



    $(window).scroll(function () {

        if ($(this).scrollTop() > 550) {

            nav.addClass("fixed");

        } else {

            nav.removeClass("fixed");

        }

    });
	
	if ($(window).width() < 960) {
  $('.all-bar').parallax("50%", 0.1);
  $('.wird-bar').parallax("50%", 0.1);
}
else {
   $('.all-bar').parallax("50%", 0.2);
   $('.wird-bar').parallax("50%", 0.2);
}
	
	$('.header-bar').parallax("50%", 0.6);
	
	
	
	$('.ger-bar').parallax("50%", 0.1);

});



		$(document).ready(function() {

			$('#nav').onePageNav();

			$('#video').fancybox({

					openEffect : 'none',

					closeEffect : 'none',

					prevEffect : 'none',

					nextEffect : 'none'



					

				});

				$('.grp1').click(function(){
					
					$('.bert .title .left').html($(this).find('.inner').html());
					$('.bert .title .right h3').html($(this).find('.inner2 h3').html());
					$('.bert .title .right em').html($(this).find('.inner2 p').html());
					$('.bert .title .right .show').html($(this).find('.inner2 span').html()).show();
					
				})
				
				
							
				


		});

		

		$('.hamburger').click(function(){
                        $('.hamburger .bar').toggleClass('crs');
			$('.nav-bar ul li').slideToggle();

		})
		
		
		
		
    var oTop = $('.ger-bar').offset().top - window.innerHeight;
    $(window).scroll(function(){

        var pTop = $(this).scrollTop();
        //console.log( pTop + ' - ' + oTop );   //just for your debugging
        if( pTop > oTop ){
            start_count();
        }
    });


function start_count(){
   $('.counter').each(function() {
		  var $this = $(this),
			  countTo = $this.attr('data-count');
		  
		  $({ countNum: $this.text()}).animate({
			countNum: countTo
		  },
		
		  {
		
			duration: 4000,
			easing:'linear',
			step: function() {
			  $this.text(Math.floor(this.countNum));
			},
			complete: function() {
			  $this.text(this.countNum);
			  //alert('finished');
			}
		
		  });  
		  
		  
		
		});
}

$(document).ready(function() {
	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
	
	
  fr = new FilmRoll({
    container: '#film_roll',	
    height: 150,
	scroll:false
  });

	
});

	</script>
        
	
	<?php wp_footer(); ?>
</body>


</html>