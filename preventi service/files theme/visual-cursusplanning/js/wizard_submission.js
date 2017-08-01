jQuery(document).ready(function(e)
{
    var $ = jQuery;
	$.get(document.location,{'visual_cursusplanning_ajax':'get_wizard_url'},function(data)
	{
		var wizard_url=data;
		$('form.to_wizard').each(function()
		{
			var form=$(this);
			form.submit(function(e)
			{
				e.preventDefault();
				var data=form.serialize();
				var new_url=wizard_url+'#'+data;
				window.location.href=new_url;
			});
		});
	});
});