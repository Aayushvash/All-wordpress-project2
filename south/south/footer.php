            <div class="clear"></div>
            
		</div>
		<!--  content -->
        
		<!--  footer -->
		<div id="footer">
        
            <?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'footer' ) ); ?>
            
		</div>
		<!--  footer -->

	</div>
	<!--  layout -->
	</div>
<!--  wrapper -->

<?php wp_footer(); ?>



<script type="text/javascript">
jQuery(document).ready(function(e) {
	
	 
	 
    jQuery('.names').click(function(e) {
		jQuery(this).next('.menus').slideToggle();
		jQuery(this).toggleClass('transform')
    });
	
	jQuery('.frmUpload').submit(function() {		
			var url = "<?php bloginfo('template_url'); ?>/mailSend.php"; 
			jQuery.ajax({
				type: "POST",
				url: url,
				data: jQuery(".frmUpload").serialize(), 
				success: function(data)
					{
					  jQuery(".success").html(data);
					}
			});
			return false; 
		});
		
		jQuery('.frmlogin').submit(function() {		
			var url = "<?php bloginfo('template_url'); ?>/maillogin.php"; 
			jQuery.ajax({
				type: "POST",
				url: url,
				data: jQuery(".frmlogin").serialize(), 
				success: function(data)
					{
					  jQuery(".afterLogBox").html(data);
					}
			});
			return false; 
		});
		
		jQuery('.frmforgot').submit(function() {		
			var url = "<?php bloginfo('template_url'); ?>/mailForgot.php"; 
			jQuery.ajax({
				type: "POST",
				url: url,
				data: jQuery(".frmforgot").serialize(), 
				success: function(data)
					{
					  jQuery(".fsucess").html(data);
					}
			});
			return false; 
		});
		
});


	
jQuery(document).ready(function() {
	jQuery(".list a").click(function(event) {
		event.preventDefault();
		jQuery(this).parent().addClass("current");
		jQuery(this).parent().siblings().removeClass("current");
		var tab = jQuery(this).attr("href");
		jQuery(".tab-content").not(tab).css("display", "none");
		jQuery(tab).fadeIn();
	});
	
jQuery(".list li .custab1").trigger( "click" );	

jQuery('.checkBlock .checkout').click(function(){
	
		var accsum = 0;	
		jQuery('.accessoriesBlock li.active').each(function(){
		var aprice =  jQuery(this).find('.aprice').text();
		accsum += Number(aprice);
		});
		jQuery('.finalBlock .grtandBock li .acc').text(accsum);
		var dsum = 0;	
		jQuery('.damageBlock li.active').each(function(){
		var dprice =  jQuery(this).find('.dprice').text();
		dsum += Number(dprice);
		});
		jQuery('.finalBlock .grtandBock li .damage').text(dsum);
		var p1 = jQuery('.finalBlock .grtandBock li .price').text();
		var c1 = jQuery('.finalBlock .grtandBock li .acc').text();
		var d1 = jQuery('.finalBlock .grtandBock li .damage').text();
		var s1 = jQuery('.finalBlock .grtandBock li .sales').text();
		var t1 = parseInt(p1)+parseInt(c1)+parseInt(d1)+parseInt(s1);
	    jQuery('.finalBlock .grtandBock li .grandTotal').text(t1);
		
		jQuery('.rental-Detail-Block').slideUp('fade');
		jQuery('.finalBlock').slideDown('fade');
	});	
		
});
jQuery(document).ready(function() {
	
	jQuery(".various1").fancybox({
            'titlePosition'     : 'inside',
            'transitionIn'      : 'none',
            'transitionOut'     : 'none'
        });
		
});	

jQuery(window).load(function(){
		  
	  jQuery('#carousel2').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
		prevText: ">",          
		nextText: "<",   
		 minItems: 1,
		maxItems: 3,
        itemWidth: 128,
        itemMargin: 0,
        asNavFor: '#slider2'
      });

      jQuery('#slider2').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel2",
        start: function(slider){
          jQuery('body').removeClass('loading');
        }
      });
      
	  
	  jQuery('.flexslider2').flexslider({
        animation: "slide",
		slideshow: true, 
		controlNav: false, 
		directionNav: true,
		prevText: "", 
		nextText: "",  
        start: function(slider){
          jQuery('body').removeClass('loading');
        }
      });
    });

</script>



</body>
</html>
