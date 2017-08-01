jQuery(document).ready(function(){
	var heh = jQuery( window ).height();
//	alert(heh);
	var ff = jQuery('.footer-block').height();
	var ppc = (heh-ff);
	
//	alert(ppc);
	
	jQuery('.fullwidthbanner-container').css('style', ppc);
	
	
});

jQuery(document).ready(function(){
	
	jQuery('h2').wrapInner('<span></span>');
	jQuery('.header-block .nav a.toggle').click(function(e) {

        e.preventDefault();

        jQuery('.header-block .nav ul#menu-main-menu').slideToggle();
        
        jQuery('.header-block .nav ul#menu-main-menu ul').css('display', 'none' );
        
       
    });
    
    
    jQuery('.header-block .nav ul#menu-main-menu li').each(function(){

        jQuery(this).children('ul').before('<span class="sub"></span>');
        
    });
    
    jQuery('.header-block .nav ul#menu-main-menu li .sub').click(function(e) {

        jQuery(this).next('.header-block .nav ul#menu-main-menu ul').slideToggle();
        
        jQuery(this).toggleClass('submenu-hide');
    
    });

	


jQuery(window).load(function() {
	
	
		
			jQuery("#status").delay(8000).fadeOut("slow");
			// will fade out the whole DIV that covers the website.
			jQuery("#preloader").delay(9000).fadeOut("slow");
		
		 
	jQuery('#carousel').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: true,
		itemWidth: 210,
		itemMargin: 5,
		asNavFor: '#slider',
	});
	jQuery('#slider').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: true,
		slideshow: true,
		sync: "#carousel"
	});
	
     var $container = jQuery('.boxrap'); 
    $container.isotope({ 
        filter: '*', 
        animationOptions: { 
            duration: 750, 
            easing: 'linear', 
            queue: false, 
        } 
    }); 
  
    jQuery('.category-block .category ul li').click(function(){ 
	
	jQuery('.category-block .category ul li').removeClass('current');
		//jQuery(this).parent('li').removeClass('current-list');
        jQuery(this).addClass('current');
      //  jQuery(this).parent('li').addClass('current-list');
	
        var selector = jQuery(this).find('a').attr('data-filter');  
        $container.isotope({ 
            filter: selector, 
            animationOptions: { 
                duration: 750, 
                easing: 'linear', 
                queue: false, 
            } 
        }); 
      return false; 
    });  
	
});

// JavaScript Document
/* function Preloader(v) {

   window.addEventListener('load', function() {
       var video = document.querySelector(v);
       var container = video.parentNode;
       var preloader = document.createElement('div');
       var vWidth = window.getComputedStyle(video, null).getPropertyValue('width');
       var vHeight = window.getComputedStyle(video, null).getPropertyValue('height');

       container.style.position = 'relative';
       video.style.position = 'absolute';
       preloader.style.position = 'absolute';
       preloader.style.width = vWidth;
       preloader.style.height = vHeight;
       preloader.style.backgroundColor = '#000';
       preloader.innerHTML = '<img src="images/preloader.gif">';

       container.appendChild(preloader);

       function checkLoad() {
            if (video.readyState === 4) {
                container.removeChild(preloader);
            } else {
                setTimeout(checkLoad, 100);
            }
       }

       checkLoad();

   });

} */
 
 

	jQuery('.fancybox-buttons').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',

		prevEffect : 'none',
		nextEffect : 'none',

		closeBtn  : false,

		helpers : {
			title : {
				type : 'inside'
			},
			buttons	: {}
		},

		afterLoad : function() {
			this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
		}
	});
	var stickyNavTop1 = jQuery('.sid-img').offset().top;
	jQuery(window).scroll(function() {
		if (jQuery(window).scrollTop() > stickyNavTop1) {
			jQuery( ".scrollingBox" ).css({
				"position": "fixed",
				"bottom": "76px"
			});
		} else {
			jQuery( ".scrollingBox" ).css({
				"position": "static"
			});
		}
	});
		
});

jQuery(document).ready(function() {
   /*  jQuery(".reless a").click(function(event) {
        event.preventDefault();
       jQuery(this).parent().addClass("current1");
        jQuery(this).parent().siblings().removeClass("current1");
        var tab = jQuery(this).attr("href");
        jQuery(".text1").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
    }); */
	
	jQuery('.reless li.tp-1 a').trigger('click');
	
	
});


jQuery(document).ready(function() {
	/* jQuery('.hemichoicbox-block .reless1 a').click(function(){
		jQuery(this).addClass("active");
		jQuery(this).siblings("li").removeClass("active");
		 /* var tab2 = jQuery(this).attr("rel");
        jQuery(".text2.resFil").not(tab2).css("display", "none");
        jQuery(tab2).fadeIn(); */
   
		
	/* }); */
	jQuery('.tabs-menu a#ks1').trigger('click'); 
	jQuery(".tabs-menu a").click(function(event) {
        event.preventDefault();
        jQuery(this).parent().addClass("current");
        jQuery(this).parent().siblings().removeClass("current");
        var tab = jQuery(this).attr("href");
        jQuery(".tab-content").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
    });
	
}); 


jQuery(document).ready(function() {
    /* jQuery(".reless a").click(function(event) {
        event.preventDefault();
       jQuery(this).parent().addClass("current2");
        jQuery(this).parent().siblings().removeClass("current2");
        var tab3 = jQuery(this).attr("href");
        jQuery(".text3").not(tab3).css("display", "none");
        jQuery(tab3).fadeIn();
    }); */
	
	jQuery('.reless li.fg-1 a').trigger('click');
	
});




jQuery(document).ready(function() {
    /* jQuery(".reless a").click(function(event) {
        event.preventDefault();
       jQuery(this).parent().addClass("current3");
        jQuery(this).parent().siblings().removeClass("current3");
        var tab4 = jQuery(this).attr("href");
        jQuery(".text4").not(tab4).css("display", "none");
        jQuery(tab4).fadeIn();
    }); */
	
	jQuery('.relesss li.ag-1 a').trigger('click');
	
});

jQuery(document).ready(function() {
	
    jQuery(".reless3 li a").click(function(event) {
	
        event.preventDefault();
       jQuery(this).parent().addClass("current4");
        jQuery(this).parent().siblings().removeClass("current4");
        var tab5 = jQuery(this).attr("href");
		
        jQuery(".text5").not(tab5).css("display", "none");
        jQuery(tab5).fadeIn();
    });
	
	jQuery('.reless3 li.aab-1 a').trigger('click');
	jQuery('.fourbox-block .nav').addClass('hello');
	//jQuery('.fourbox-block .nav').removeClass('sticky');
	//var stickyNavTop = jQuery('.single .fourbox-block .nav').offset().top;
	var stickyNav = function(){
		var hhv = jQuery('.banner').height();
		
	var scrollTop = jQuery(window).scrollTop();
		if (scrollTop > hhv) { 
			jQuery('.single .fourbox-block .nav').addClass('sticky');
		} else {
			jQuery('.single .fourbox-block .nav').removeClass('sticky'); 
		}
	}; 
	//stickyNav();
	jQuery(window).scroll(function() {
		stickyNav();
	});
	
});