<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>

			
</div>
			<!-- finish center wrap -->	
		
		</div>
		<!-- finish content -->
		
		<!-- begin footer -->
		<div id="footer-wrap">

            <!-- begin footer block -->
            <article class="footer-block">

                <div class="centring">
                
				 <div class="one">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer_sidebar1') ) : ?> <?php endif; ?>
					</div>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer_sidebar2') ) : ?> <?php endif; ?>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer_sidebar3') ) : ?> <?php endif; ?>
                    
                    <div class="clear"></div>
                    
                    <div class="message">
                    
                    	<div class="number">
                        
                        	<span class="phone">Bel : <?php echo get_theme_option('phone'); ?></span>
                        
                        </div>
                        
                        <div class="number">
                        
                        	<span class="mail phone">Email :<?php echo get_theme_option('email'); ?></span>
                        
                        </div>
                        
                        <div class="number">
                        
                        	<span class="fax phone">Fax : <?php echo get_theme_option('fax'); ?></span>
                        
                        </div>
                    
                    </div>
					
					<a class="toparrow" href="javascript:void(0);"><img src="<?php bloginfo('template_url'); ?>/images/top-arrow1@2x.png"  width="11" height="7" alt=""/></a>
                
                </div>

            </article>
            <!-- finish footer block -->
            
             <!-- begin copyright block -->
            <article class="copyright-block">
            
            	<div class="centring">
                
                	<span><?php echo get_theme_option('copyright'); ?></span>
                    <span class="out"><?php echo get_theme_option('bottom1'); ?></span>
                    <a href="<?php echo get_theme_option('bottomLink'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/copyright-logo@2x.png" width="97" height="13" alt=""/></a>
                
                </div>
            
            </article>
             <!-- finish copyright block -->

		</div>
		<!-- finish footer -->
		
	</div>
	<!-- finish page wrap -->
	
</div>
<!-- finish section -->

		<?php wp_footer(); ?>
		
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/owl.carousel.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/selectyze.jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?v=3.5&amp;sensor=true" type="text/javascript"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/js/retina.js" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.mmenu.min.all.js"></script>
	
<script type="text/javascript">
// When the window has finished loading create our google map below
jQuery('#menu').mmenu({
  navbar: {
    title: "NAVIGATIE"
  }
});
google.maps.event.addDomListener(window, 'load', init);

function init() {

	// Basic options for a simple Google Map

	// For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions

	var mapOptions = {

		// How zoomed in you want the map to start at (always required)

		zoom: 16,

		scrollwheel: false,

		// The latitude and longitude to center the map (always required)

		center: new google.maps.LatLng(53.041180, 4.844859), // New York

		// How you would like to style the map. 

		// This is where you would paste any style found on Snazzy Maps.

		styles:  [{"featureType":"landscape","stylers":[{"saturation":-70},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-180},{"lightness":61},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-70},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-67},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-70},{"lightness":20},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#bababa"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-15},{"saturation":-67}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#cfd6e2"},{"lightness":-10},{"saturation":-67}]}]

	};

	// Get the HTML DOM element that will contain your map 

	// We are using a div with id="map" seen below in the <body>

	var mapElement = document.getElementById('map');

	// Create the Google Map using our element and options defined above

	var map = new google.maps.Map(mapElement, mapOptions);

	

	// Let's also add a marker while we're at it

	marker = new google.maps.Marker({

			map:map,

			// draggable:true,

			// animation: google.maps.Animation.DROP,

			position: new google.maps.LatLng(53.041180, 4.844859),

			icon: '<?php bloginfo('template_url'); ?>/images/pin.png' // null = default icon

			

	  });

	  

}	

	jQuery(document).ready(function(){
		jQuery('#cursus').change(function(){
			var sortBy = jQuery(this).val();						
			jQuery('#mycursus .cursus').each(function(){
				var curId = jQuery(this).attr('id');
				if(curId==sortBy){
					jQuery(this).show();
					jQuery(this).siblings().hide();
				}
			});	
		});
	});
	
	jQuery(document).ready(function(){
		jQuery('.tabBox .tabLink li').each(function(){
			jQuery(this).click(function(){
				var tl = jQuery(this).attr('rel');
				jQuery(this).addClass('active');			
				jQuery(this).siblings().removeClass('active');			
				jQuery('.tabBox .tabText .tabdetail').each(function(){
					var tt = jQuery(this).attr('id');
					if(tt==tl){
						jQuery(this).show();
						jQuery(this).siblings().hide();
					}
				});	
			});
		});
	});
	
	
		

		jQuery('.mm-panels').append('<div class="subscribe"><?php echo get_theme_option('nuins'); ?></div>');
	
	jQuery(document).ready(function(){
var fh = jQuery('.contentContainer .stepContentView').eq(0).height();
			
			jQuery('.contentContainer .stepContentView').each(function(){
			jQuery(this).parents('.stepContent').height(fh);
			jQuery(this).find('#next').click(function(){
			var sh = jQuery(this).parents('.stepContentView').next().height();
			jQuery(this).parents('.stepContent').height(sh);	
			});
			jQuery(this).find('#prev').click(function(){
			var sh = jQuery(this).parents('.stepContentView').prev().height();
			jQuery(this).parents('.stepContent').height(sh);	
			});
			});
       });
 </script>
</body>
</html>
