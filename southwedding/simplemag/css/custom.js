$(document).ready(function(e) {
	  
		$('.owl-carousel').owlCarousel({

                loop: true,

                margin: 0,

                responsiveClass: true,

                responsive: {

                  0: {

                    items: 1,

                    nav: true

                  },

                  600: {

                    items: 2,

                    nav: true

                  },

				  

				  1024: {

                    items: 4,

					nav: true

					

                  },

				  

                  1100: {

                    items: 5,

                    nav: true,

                    loop: false,

                    margin: 0

                  }

                }

        });

	

	

});





           