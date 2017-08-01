</div><!-- eof page -->
</div><!-- eof wrapper -->

<div id="footer">
<div id="footercontent">


<div class="footermenu">
<?php 
/* $mainargs = array(
  'container'       => '',
  'menu'            => '', 
  'menu_class'      => 'footer-menu',  
  'menu_id'         => '',
  'depth'			=> 1,
  'theme_location'  => 'footer-menu');
wp_nav_menu($mainargs); */ ?>
<div class="inner">
<?php //echo comicpress_copyright(); ?>  <?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>
</div>
</div>
<div class="footerright">
		<div class="inner">
			<?php  dynamic_sidebar('footer Logo'); ?>
		</div>
		<span class="maker social"><?php dynamic_sidebar('Makler Logo');?> </span>
	</div>
</div>


<div class="clear"></div>
</div><!-- eof footer content -->

<div class="bottomline"></div>
</div><!-- eof footer -->

<?php 
$pt = get_post_type($post->ID); 
if(is_tax(array('offertype', 'proptype','location','rooms','size','keyword')) || $pt == 'property') { ?>
<script type="text/javascript">
jQuery('#main-menu ul li').filter('.immo').addClass('current-menu-item');
jQuery('#main-menu ul li').filter('.blog').removeClass('current_page_parent');
        </script>
<?php } 
if(is_tax(array('offertype', 'proptype','location','rooms','size','keyword')) || $pt == 'portfolio') { ?>
<script type="text/javascript">
jQuery('#main-menu ul li').filter('.referenz').addClass('current-menu-item');
jQuery('#main-menu ul li').filter('.blog').removeClass('current_page_parent');
        </script>        
<?php }
if($pt == 'services' || is_search()) { ?>
<script type="text/javascript">
jQuery('#main-menu ul li').filter('.blog').removeClass('current_page_parent');
        </script>
<?php } ?>


<?php wp_footer(); ?>
<script type="text/javascript">
jQuery( document ).ready(function() {
	
 jQuery('.psbutton').attr('value','Suche');
 jQuery('.taxonomy-drilldown-reset.pslink').text('Zurücksetzen');
jQuery('.widget_taxonomy-drill-down li:nth-child(1) label').text('Objekttyp:');
 jQuery('.widget_taxonomy-drill-down li:nth-child(2) label').text('Ort:');
 jQuery('.widget_taxonomy-drill-down li:nth-child(2) label').css({"position":"relative","left":"55px"});
 
 jQuery('.rights1 .es_shortcode_form .es_button input').attr('value','Anmelden');


 jQuery('.widget_taxonomy-drill-down select').each(function(){
    jQuery(this).removeAttr('onchange');
 })

 var input = jQuery('.taxonomy-drilldown-button noscript').html();
 input = input.replace("&lt;", '<');
 input = input.replace("&gt;", '>');
 jQuery('.taxonomy-drilldown-button noscript').remove();
 jQuery('.taxonomy-drilldown-button').prepend(input);
 jQuery(document).find('.taxonomy-drilldown-button input.psbutton').val("Suche");
 

 //jQuery('.slider-item').cycle({
 //   speed: 2000,
 //   manualSpeed: 0
//});
 
 
});


</script>

</body>
</html>
