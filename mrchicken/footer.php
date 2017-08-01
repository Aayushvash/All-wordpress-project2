<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 */

?>

		<?php

        if ( is_front_page() || $post->ID == 742 ) { ?>

        <!-- begin footer -->

        <footer id="footer-wrap">

    

            <!-- begin footer block -->

            <article class="footer-block">

                <aside class="inner">

                    

                    <aside class="menus">

                        

                        <ul>

                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Intro Sidebar') ) : ?>

                            <?php endif; ?>

                        </ul>

                                        

                    </aside>

                    

                    <aside class="footer">

                    

                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Sidebar') ) : ?>

                        <?php endif; ?>

                    

                    </aside>
                    
                    <img class="mr" src="<?php bloginfo('template_url'); ?>/images/mr.png" alt="" />

                
                    <div class="clear"></div>

                

                </aside>

            </article>

            <!-- finish footer block -->

    

            <!-- begin copyright block -->

            <article class="copyright-block">

                <aside class="inner">

                    

					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Copyright Sidebar') ) : ?>

                    <?php endif; ?>

                

                </aside>

            </article>

            <!-- finish copyright block -->

    

            <div class="clear"></div>

    

        </footer>

        <!-- finish footer -->

		<?php } else { ?>        

        <!-- begin footer -->

        <footer id="footer-wrap">

    

            <!-- begin footer block -->

            <article class="footer-block">

                <aside class="inner inner1">

                    

                    <aside class="footer">

                    

                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Sidebar') ) : ?>

                        <?php endif; ?>

                    

                    </aside>

                <img class="mr" src="<?php bloginfo('template_url'); ?>/images/mr.png" alt="" />

                    <div class="clear"></div>

                

                </aside>

            </article>

            <!-- finish footer block -->

    

            <!-- begin copyright block -->

            <article class="copyright-block">

                <aside class="inner">

                    

					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Copyright Sidebar') ) : ?>

                    <?php endif; ?>

                

                </aside>

            </article>

            <!-- finish copyright block -->

    

            <div class="clear"></div>

    

        </footer>

        <!-- finish footer -->

        <?php } ?>

        	

	</section>

	<!-- finish page wrap -->

	

</section>

<!-- finish section -->



<?php wp_footer(); ?>



<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.backstretch.js"></script>



<script type="text/javascript">

	var j = jQuery.noConflict();
	
	j(document).ready(function() {
		//j("#banner-wrap").backstretch([

	//	"<?php bloginfo('template_url'); ?>/images/banner.jpg",

	//	"<?php bloginfo('template_url'); ?>/images/plated-dinner-banner.jpg",
		
	//	"<?php bloginfo('template_url'); ?>/images/banner4.jpg"
		
		// for special promotions "http://mrchickencater.com/wp-content/themes/mr-chicken/images/superbowl-banner4.jpg"
    	
		//"http://mrchickencater.com/wp-content/uploads/2014/05/fathersday-banner.jpg", 
	
       //   "http://mrchickencater.com/wp-content/uploads/2014/06/free-cookies-July4.jpg", 
    	    			
          //"http://mrchickencater.com/wp-content/uploads/2014/08/MrC-Slider-PicnicPacks.jpg",
          
         // "http://mrchickencater.com/wp-content/uploads/2014/08/wednesday-special-2.jpg",
          
         // "http://mrchickencater.com/wp-content/uploads/2014/03/offer.jpg"
			 
			 
		//], {

		//fade: 750,

		//duration: 4000

		//});
	});
	
	});
	

</script>

</body>

</html>
