
$(document).ready(function () {

    $('#owl-aussteller').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            900: {
                items: 1
            },
            1000: {
                items: 3
            }
        }

    })
    $('#owl-weiterbil').owlCarousel({
        loop: true,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            360: {
                items: 1
            },
            600: {
                items: 1
            },
            900: {
                items: 1
            },
            1000: {
                items: 4
            }
        }

    })



    // Custom Navigation Events
    $(".next").click(function () {
        owl.trigger('owl-next');
    })
    $(".prev").click(function () {
        owl.trigger('owl-prev');
    })
    $(".play").click(function () {
        owl.trigger('owl.play', 1000);
    })
    $(".stop").click(function () {
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































	