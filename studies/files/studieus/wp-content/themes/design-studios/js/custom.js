//custom code js...
function myFunction(x) {
    x.classList.toggle("change");
}
jQuery(window).load(function() {
	
	jQuery('.flexslider').flexslider({
    animation: "slide",
	start: function(){
		jQuery('.flexslider').removeClass('loader');
	}
  });
});


jQuery(function(){
	//alert();
	jQuery('.social a.comment').click(function() {
		//alert();
		
		jQuery('.comment_section_bar.hide').slideToggle();
		
	})
	
	jQuery('.mobile-menu').click(function() {
		//alert();
		
		jQuery('.right.nav').slideToggle();
		
	})
	
	
	
	jQuery('#wpmem_reg .form label[for="user_login"]').text('Gebruikersnaam');
	jQuery('#wpmem_reg .form input[name="user_login"]').attr('placeholder','Loes');
	jQuery('#wpmem_reg .form').find('label[for="user_login"]').append('<span class="req">*</span>');
	jQuery('#wpmem_reg .form label[for="user_email"]').text('E-Mail');	
	jQuery('#wpmem_reg .form input[name="user_email"]').attr('placeholder','l.dejong@studieus.nl');
	jQuery('#wpmem_reg .form').find('label[for="user_email"]').append('<span class="req">*</span>');
	jQuery('.signin .button_div .buttons').val('AANMELDEN');
	jQuery('.regi-bar .button_div .buttons').val('AANMELDEN');
	jQuery('.login-block .log-from .form label[for="log"]').text('Gebruikersnaam');
});

jQuery(function(){
	jQuery('.logged-in .signin').find('.log-btn').css('display','none');
	
	jQuery('.searchform input[type="text"]').attr('placeholder','Zoeken');
	
	
	
});
