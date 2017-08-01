<?php
/**
 * The template for displaying the footer.
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.1
**/
global $ti_option;
?>

    <footer id="footer" role="contentinfo" class="animated <?php echo $ti_option['site_footer_color']; ?>">
    
        <?php get_sidebar( 'footer' ); // Output the footer sidebars ?>
        
        <div class="copyright">
            <div class="wrapper">
            	<div class="grids">
                    <div class="grid-10">
                        <?php echo $ti_option['copyright_text']; ?>
                    </div>
                    <div class="grid-2">
                        <a href="#" class="back-top"><?php _e( 'Back to top', 'themetext' ); ?> <i class="icon-chevron-up"></i></a>
                    </div>
                </div>
            </div>
        </div>
            
    </footer><!-- #footer -->
    
    </div><!-- #inner-wrap -->
</div><!-- #outer-wrap -->
    
<?php wp_footer(); ?>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.rwdImageMaps.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/custom.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/owl.carousel.js"></script>
<script>
jQuery(document).ready(function(e) {
	jQuery('img[usemap]').rwdImageMaps();
});
</script>
</body>
</html>