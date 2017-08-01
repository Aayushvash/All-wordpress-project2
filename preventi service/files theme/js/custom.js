 jQuery(document).ready(function(){
	 
	 jQuery('.fancybox').fancybox(); 
    jQuery('.nav-block li').each(function(){
        jQuery(this).children('ul').before('<span class="submenu"></span>');
        
    });
    
    jQuery('.nav-block ul li .submenu').click(function(e) {

        jQuery(this).next('ul').slideToggle();  
        jQuery(this).toggleClass('submenu-hide');
    
    });
	
	jQuery('.menubox ul li').each(function(){
		jQuery(this).has("ul").append('<span></span>');
		jQuery(this).find('span').click(function(){
			jQuery(this).toggleClass('active');
			jQuery(this).siblings('.sub-menu').slideToggle();
			jQuery(this).parent().siblings().find('.sub-menu').slideUp();
			jQuery(this).parent().siblings().find('span').removerClass('active');
		});
	});
	
	jQuery('.mobiletabBox .tabText').each(function(){
		jQuery(this).find('.title').click(function(){
			jQuery(this).toggleClass('active');
			jQuery(this).siblings('.tabdetail').slideToggle();
			jQuery(this).parent().siblings().find('.tabdetail').slideUp();
			jQuery(this).siblings().removerClass('active');
		});
	})
	

	
	jQuery('.footer-block .widget_nav_menu .list  h4').click(function(){
		jQuery(this).toggleClass('active');
		jQuery(this).siblings().slideToggle();
	});
	
	jQuery('.banner-block .list .one').each(function(){
		jQuery(this).find('h4').click(function(){
			jQuery(this).toggleClass('active');
		jQuery(this).siblings('.termBox').slideToggle();
		jQuery(this).parent().siblings().children('.termBox').slideUp();
		jQuery(this).parent().siblings().removerClass('active');
			
		});
		
	})
	
	
	
	 
	 jQuery('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 3,
                    nav: true
                  },
                  600: {
                    items: 3,
                    nav: false
                  },
				  
				   700: {
                    items: 3,
                    nav: false
                  },
				  
                  1000: {
                    items: 4,
                    nav: true,
                    loop: true,
                    margin: 20
                  }
                }
        });
		
		// Ausgabe lesen Scroll Top	
jQuery('.toparrow').click(function(){
	jQuery("body, html").animate({scrollTop:0}, '500');
});
jQuery('.top a').click(function(){
	jQuery("body, html").animate({scrollTop:0}, '500');
});

jQuery('.survey-block .rating ul li.gray-star').each(function(){
	
	jQuery(this).click(function(){
		var va = jQuery(this).index();
		jQuery(this).addClass('active');
		jQuery(this).prevAll().addClass('active');
		jQuery(this).nextAll().removeClass('active');
		jQuery('.survey-block .starfield .wpcf7-text').attr('value',va);
		//alert(va);
	});
});

jQuery('.pagination .tBD').each(function(){
	
	jQuery(this).click(function(){
		jQuery(this).find('.button').trigger('click');
	});
});

	
	  });
	  
jQuery(window).load(function() {
  jQuery('.flexslider').flexslider({
    animation: "fade"
  });
});

jQuery(window).load(function() {
  jQuery('.newsSlider').flexslider({
    animation: "slide"
  });
});

jQuery(window).load(function() {
	if(jQuery(window).width()<767){
  jQuery('.customer').flexslider({
    animation: "slide",
    controlNav: false
  });
	}
});

var w = jQuery(window).width();
	if(w>767){		
		jQuery(window).scroll(function(){
			var sticky = jQuery('.nav-block'),
			scroll = jQuery(window).scrollTop();
				if (scroll >= 155) {
				sticky.addClass('fixed');
				jQuery('#banner-wrap').css('margin-top','58px');
				jQuery('#content-wrap').css('margin-top','58px');
				jQuery('.home #content-wrap').css('margin-top','0px');
				
			}
			else {
				sticky.removeClass('fixed');
				jQuery('#banner-wrap').css('margin-top','0px');
				jQuery('#content-wrap').css('margin-top','0px');
			}
		});
	}
	
	jQuery('#cursus').Selectyze({
		theme : 'skype'
	});
