
$(document).ready(function () {
    
      var owl = $("#owl-aussteller");

      owl.owlCarousel({

      items : 3, //10 items above 1000px browser width
      itemsDesktop : [1000,3], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0;
      //itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
      
      });

      // Custom Navigation Events
      $(".next").click(function(){
        owl.trigger('owl.next');
      })
      $(".prev").click(function(){
        owl.trigger('owl.prev');
      })
      $(".play").click(function(){
        owl.trigger('owl.play',1000);
      })
      $(".stop").click(function(){
        owl.trigger('owl.stop');
      })


    $(".agenda-bar .bert .jun .title").hover(function () {
        $('.agenda-bar .bert .jun .title .right .show').toggleClass('sh');

    });
    $('.slider-bar a.be').click(function (e) {

        e.preventDefault();
        $('.slider-bar .now').slideToggle("slow", "swing", function () {
            if ($('.slider-bar .now').css('display') == 'block') {
                $('.slider-bar a.be').addClass('be-h');
            } else {
                $('.slider-bar a.be').removeClass('be-h');
            }

        });
    });
    $('.slider2-bar a.were').click(function (e) {

        e.preventDefault();
        $('.slider2-bar .sign').slideToggle("slow", "swing", function () {
            if ($('.slider2-bar .sign').css('display') == 'block') {
                $('.slider2-bar a.were').addClass('were-h');
            } else {
                $('.slider2-bar a.were').removeClass('were-h');
            }

        });
        // alert($('.slider2-bar .sign').css('display'));



    });
});
jQuery(document).ready(function () {


    $('.slider-bar .film_roll_child li').hover(function () {
        alert();
        $(this).find(".text").show();
        //  $('.flexslider').flexslider("pause");

        $(this).css('position', 'static');
    });
    $('.slider-bar .film_roll_child li .text a.close').click(function (e) {

        $('.flexslider').flexslider("play");
        $('.slider-bar .film_roll_child li .text').hide('fast');
        e.preventDefault();
    });
    


    $('.slider-bar li li').click(function () {

        $(this).find(".text").show();
        $('.flexslider').flexslider("pause");
        $(this).css('position', 'static');
    });
    $('.slider-bar li li .text a.close').click(function (e) {

        $('.flexslider').flexslider("play");
        $('.slider-bar li li .text').hide('fast');
        e.preventDefault();
    });
});
//var jump=function(e)
//{
//   if (e){
//       e.preventDefault();
//       var target = $(this).attr("href");
//   }else{
//       var target = location.hash;
//   }
//
//   $('html,body').animate(
//   {
//       scrollTop: $(target).offset().top - 60
//   },1000,function()
//   {
//       location.hash = target;
//   });
//
//}
//
//$('html, body').hide();
//
//$(document).ready(function()
//{
//    $('.menu-main-menu-container .menu li a[href^=#]').bind("click", jump);
//
//    if (location.hash){
//        setTimeout(function(){
//            $('html, body').scrollTop(0).show();
//            jump();
//        }, 0);
//    }else{
//        $('html, body').show();
//    }
//});































	