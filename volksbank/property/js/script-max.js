
jQuery(document).ready(function($) {

var ww = document.body.clientWidth;

$(document).ready(function() {
	$(".nav li a").each(function() {
		if ($(this).next().length > 0) {
			
		};
	})
	
	$(".toggleMenu").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("active");
		$(".nav").toggle();
	});
	adjustMenu();
})

$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 641) {
		$(".toggleMenu").css("display", "inline-block");
		if (!$(".toggleMenu").hasClass("active")) {
			$(".nav").hide();
		} else {
			$(".nav").show();
		}
		$(".nav li").unbind('mouseenter mouseleave');
		$(".nav li a.parent").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			$(this).parent("li").toggleClass("hover");
		});
	} 
	else if (ww >= 641) {
		$(".toggleMenu").css("display", "none");
		$(".nav").show();
		$(".nav li").removeClass("hover");
		$(".nav li a").unbind('click');
		$(".nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	$(this).toggleClass('hover');
		});
	}
}

}); 



// ===========  toggle - accordion

jQuery(document).ready(function($) {
	
$('.toggle-more').hide();
$('.toggle-box .toggle-more:first').show();
$(".toggle-headline:first i").toggleClass("icon-up-dir");
$('.toggle-headline').click(function() {
$(this).next(".toggle-more").toggle(), 
$(this).children("i").toggleClass("icon-up-dir")	
  });


$(".panel").hide();
$(".panel:first").show();
$(".tab-box ul.tabber li:first-child a").addClass('active');
$(".tab-box ul.tabber li a ").click(function(){
var activeTab = $(this).attr("href"); 
$(".tab-box ul.tabber li a").removeClass("active"); 
$(this).addClass("active"); 
$(".panel").hide(); 
$(activeTab).show(); 
return false;
});


});
