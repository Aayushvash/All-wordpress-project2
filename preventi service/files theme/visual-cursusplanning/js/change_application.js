jQuery(document).ready(function(e)
{
    var $ = jQuery;
	$('a.cursistOption').click(function(e)
	{
		e.preventDefault();
		var href=$(this).attr('href');
		if(href=='delete')
		{
			var json = $(this).attr('id');
			var data = $.parseJSON(json);
			var answer = confirm('Weet u zeker dat u '+data.CURSIST.RELATIE.NAAM+' uit de cursus wilt uitschrijven?');
			var tr=$(this).parents('tr:first');
			var table=tr.parents('table:first');
			var parentTr=tr.parents('tr:first');
			var parentTable=table.parents('table.vs_pretty:last');
			if(answer==true)
			{
				//$.post(planningAjaxUrl+"WijzigInschrijving",{PLNKID:data.PLNKID,RID:data.CURSIST.RID},function(data)
				
				$.post(document.ready,{'visual_cursusplanning_ajax':'wijzigInschrijving',PLNKID:data.PLNKID,RID:data.CURSIST.RID},function(data)
				{
					if(table.find('tr').length>1)
					{
						tr.fadeOut(500,function()
						{
							tr.remove();
						});
					}
					else if(parentTable.children('tbody').children('tr').length>2)
					{
						parentTr.prev('tr').fadeOut(500,function()
						{
							$(this).remove();
						});
						parentTr.fadeOut(500,function()
						{
							parentTr.remove();
						});
					}
					else
					{
						parentTable.fadeOut(500,function()
						{
							$(this).remove();
						});
					}
				});
			}
		}
	});
});