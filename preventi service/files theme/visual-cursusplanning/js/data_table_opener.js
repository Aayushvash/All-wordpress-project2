jQuery(document).ready(function(e)
{
	var $ = jQuery;
	$('.vs_info_popover').parent().mouseenter(function()
	{
		var contents=$(this).find('p').html();
		if(content.length>0)
		{
			$(this).find('.vs_info_popover').show();
		}
	}).mouseleave(function()
	{
		$(this).find('.vs_info_popover').hide();		
	});
	$('button.openInfo').click(function(e)
	{
		e.preventDefault();
		var btn=$(this);
		var tr=btn.parents('tr:first');
		var openRow=tr.next('tr');
		if(openRow.hasClass('opened'))
		{
			openRow.hide();
			openRow.removeClass('opened');
			openRow.addClass('hidden');
			btn.html('Openen');
		}
		else
		{
			openRow.addClass('opened');
			openRow.removeClass('hidden');
			openRow.show();
			btn.html('Sluiten');
		}
	});
});