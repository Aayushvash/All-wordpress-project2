    
            <div class="clear"></div>
        </div>
        <!--  content -->
    
        <?php if(is_front_page()){?>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('bottom_widget') ) : ?><?php endif; ?>
        <?php } ?>
        
        <!--  footer -->
        <div id="footer">
            
            <div id="top">
                <div class="centering">
                    
                    <!-- footer logo -->
                    <div class="footerLogo">
                        <a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>">
                            <img src="<?php bloginfo('template_url'); ?>/images/small-logo.png" alt="<?php bloginfo('name'); ?>" />
                        </a>
                    </div>
                    <!-- footer logo -->
    
                    <!-- footer menu -->
                    <div class="footerMenu">
                        <?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'footer' ) ); ?>
                    </div>
                    <!-- footer menu -->
                    
                    <div class="clear"></div>
                    
                </div>
            </div>
            
            <div id="bottom">
                <div class="centering">
                    
                    <!-- footer widgets -->	
                    <div class="footerArea">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_widget') ) : ?><?php endif; ?>
                        <a href="http://www.sv-onpact.de" target="blank" class="websiteBy"><img src="<?php bloginfo('template_url'); ?>/images/sv-logo.png" alt="" /></a>
                        <div class="clear"></div>
                    </div>
                    <!-- footer widgets -->	
                    
                    <div class="clear"></div>
                    
                </div>
            </div>
            
        </div>
        <!--  footer -->

	</div>
</div>
<!-- wrapper -->

<?php wp_footer(); ?>

</body>
</html>
