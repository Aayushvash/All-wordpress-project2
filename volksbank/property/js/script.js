jQuery(document).ready(function(e){var n=document.body.clientWidth;e(document).ready(function(){e(".nav li a").each(function(){e(this).next().length>0}),e(".toggleMenu").click(function(n){n.preventDefault(),e(this).toggleClass("active"),e(".nav").toggle()}),i()}),e(window).bind("resize orientationchange",function(){n=document.body.clientWidth,i()});var i=function(){641>n?(e(".toggleMenu").css("display","inline-block"),e(".toggleMenu").hasClass("active")?e(".nav").show():e(".nav").hide(),e(".nav li").unbind("mouseenter mouseleave"),e(".nav li a.parent").unbind("click").bind("click",function(n){n.preventDefault(),e(this).parent("li").toggleClass("hover")})):n>=641&&(e(".toggleMenu").css("display","none"),e(".nav").show(),e(".nav li").removeClass("hover"),e(".nav li a").unbind("click"),e(".nav li").unbind("mouseenter mouseleave").bind("mouseenter mouseleave",function(){e(this).toggleClass("hover")}))}}),jQuery(document).ready(function(e){e(".toggle-more").hide(),e(".toggle-box .toggle-more:first").show(),e(".toggle-headline:first i").toggleClass("icon-up-dir"),e(".toggle-headline").click(function(){e(this).next(".toggle-more").toggle(),e(this).children("i").toggleClass("icon-up-dir")}),e(".panel").hide(),e(".panel:first").show(),e(".tab-box ul.tabber li:first-child a").addClass("active"),e(".tab-box ul.tabber li a ").click(function(){var n=e(this).attr("href");return e(".tab-box ul.tabber li a").removeClass("active"),e(this).addClass("active"),e(".panel").hide(),e(n).show(),!1})});