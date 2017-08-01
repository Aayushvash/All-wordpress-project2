// mini slider
jQuery(document).ready(function () {
		jQuery("#slideImg").rotate();
		jQuery('.nav-block .srch').click(function() {
			jQuery('.nav-block .srch').addClass('active');
                        //jQuery('.nav-block .mega-menu-wrap .mega-align-bottom-left').toggleClass('space');
			
			
		});
		
				
		jQuery('.head-click, #banner-wrap, #footer-wrap').click(function() { 
		
		jQuery('.nav-block .srch').removeClass('active');
		//jQuery('.nav-block .mega-menu-wrap .mega-align-bottom-left').removeClass('space');
		
		
		});
		
		
	});

// JavaScript Document
jQuery(window).scroll(function(){	
	
	var aTop = jQuery('#header-wrap').height();
	if(jQuery(this).scrollTop()> 50){
		jQuery('#header-wrap').addClass('top');
	}else{ 
		jQuery('#header-wrap').removeClass('top');
	}
        
});



jQuery(document).ready(function(){
	if(jQuery(window).width()<768){
		jQuery('.nav-block a.mobile').click(function(e){
			e.preventDefault();
			jQuery('.nav-block ul').slideToggle();
		
		});
		
		jQuery('.mega-menu-wrap  li.mega-menu-item-22 .mega-sub-menu').siblings('a.mega-menu-link').attr('href','#');
		
	}
	//jQuery('.want-block .name').each(function(){
		//jQuery(this).find('input[type="text"]').click(function(e){			
		
			jQuery(this).siblings('label').css({"font-size": "11px", "top": "8px"});
			
		//});
	//});
	
	
	/* want block */
	
	jQuery('.want-block .name').each(function(){
	
			jQuery(this).find('input').click(function(e){			
				
			jQuery(this).parents('.name').children('label').addClass('up');
			
	    });
		
		/* jQuery('.want').click(function(){
			jQuery('.name').find('.up').removeClass('up');
			
		}); */
		
	});
	/* contact block */
	
	jQuery('.contact-block .name').each(function(){
	
			jQuery(this).find('input,textarea').click(function(e){	
			jQuery(this).parents('.name').children('label').addClass('up');
			
	    });
	});
	
	/* jQuery('.contact-block .left').click(function(){			
			jQuery('.name').find('.up').removeClass('up');
	}); */
	
	
	
});

jQuery(document).ready(function(){
	jQuery('.latest-block .row .col-sm-4 .photo').mouseenter(function(){
		
	jQuery('.latest-block .row .col-sm-4 .photo span').css("background-color", "transparent");	
	});
	
	jQuery('.latest-block .row .col-sm-4 .photo').mouseleave(function(){
		
	jQuery('.latest-block .row .col-sm-4 .photo span').css("background-color", "rgba(255,91,91,0.8)");	
	});
	 
	
jQuery(function(){ 
start_count();
function start_count(){
		
   jQuery('.counter').each(function() {
	   
	   
		  var $this = jQuery(this),
			  countTo = $this.attr('data-count');	  
					  
		  jQuery({ countNum: $this.text()}).animate({
			 
			countNum: countTo
		  },
		
		  {		
			duration: 2000,
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

});
	
});

jQuery(function(){
	
	jQuery('.category-block .container a.cat-link').click(function(){
		jQuery('.catlink').slideToggle();
	});	
});


jQuery(document).ready(function(){
	
	jQuery('.category-block .container a.cat-link').click(function(){								
			jQuery('.cat-link').toggleClass('slide');			
	});
});	





