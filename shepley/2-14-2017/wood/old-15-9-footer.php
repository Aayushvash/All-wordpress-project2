<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 */

?>



  <!--  / address \ -->

    <div id="address">

        <div id="addresstop">

            <div id="addressbottom">

            

            	<div class="centerBar">
				
				<div class="newsBox">
				<h3>Shepformation... The Shepley Newletter</h3>
				<?php 
				query_posts('post_type=post&showposts=2');
				echo "<ul>";
				if (have_posts()) :  while (have_posts()) : the_post(); ?>
						<li>
							<div class="image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-img'); ?></a></div>
							<div class="text">
								<h2><?php the_title(); ?></h2>
								<p><?php echo substr(get_the_excerpt(),0, 50); ?></p>
								<div class="clear"></div>
								<a class="more" href="<?php the_permalink(); ?>">Read More</a>
							</div>
						</li>
					<?php endwhile;  endif; wp_reset_query(); ?>
					</ul>
				</div>

                <!--  / subscribe bar \ -->

                    <div class="subscribeBar">

                     <?php if ( is_active_sidebar( 'subscribe-newsletter-widget' ) ) : ?>

					<?php dynamic_sidebar( 'subscribe-newsletter-widget' ); ?>

                     <?php endif; ?>

                    </div>

                    <!--  \ subscribe bar / -->
					

                	<!--  / info bar \ -->

                    <div class="infoBar">

                        

                       
<div class="box box1">
<h2>Central Location:</h2>
<?php if ( is_active_sidebar( 'footer-address' ) ) : ?>

<?php dynamic_sidebar( 'footer-address' ); ?>

<?php endif; ?>

</div>
<div class="box box2">
<?php if ( is_active_sidebar( 'footer-address2' ) ) : ?>

<?php dynamic_sidebar( 'footer-address2' ); ?>

<?php endif; ?>

</div>


                        

                    </div>

                    <!--  \ info bar / -->

                    

                    

                

                </div>

            	

            </div>

        </div>

    </div>

    <!--  \ address / -->

    

    <!--  / footer \ -->

    <div id="footer">

        

        <!--  / copyright \ -->

		<div class="centerBar">



			<!--  / copyright bar \ -->

			<div class="copyrightBar">

				

             <?php wp_nav_menu(array('theme_location'=>'footer')); ?>               

               <p><?php echo get_theme_option('copyright'); ?></p>

				

			</div>

			<!--  \ copyright bar / -->

            

		</div>

		<!--  \ copyright / -->

        

    </div>

    <!--  \ footer / -->

</div>

</div>

<!--  \ wrapper / -->		



		<?php wp_footer(); ?>
		
		

</body>

</html>

