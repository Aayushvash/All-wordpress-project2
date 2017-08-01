var visual_filters = ['planning_wizard_public_title','planning_wizard_closed_title','planning_wizard_settings_indicator_process_text','planning_wizard_settings_indicator_confirmed_fail','planning_wizard_settings_indicator_confirmed_success'];
var string_filters = new Object();
var string_filters_load = false;
jQuery(document).ready(function(e)
{
    var $ = jQuery;
	init_filters(visual_filters);
	
	var ajax_check_mail;
    var ok;
	var last_step;
    $('.stepContent .contentContainer .stepContentView').width($('.planningContainer').width());
	
	var last_active_element=false;
	var last_active_element_parent_no=false;
	var tab_timeout=false;
    $(window).bind('keyup',function(e)
    {
        if(e.keyCode==9)
        {
			clearTimeout(tab_timeout);
			var active_step_no=$('.planningContainer').find('.step.active').index()
			var this_active_element_parent_no=$(document.activeElement).parents('.stepContentView').index();
			if(this_active_element_parent_no != last_active_element_parent_no)
			{
				last_active_element.focus();
				changeStep(active_step_no);
			}
        }
    });
    $(window).keydown(function(e)
    {
        if(e.keyCode==9)
        {
			tab_timeout=setTimeout(function()
			{
				localStorage.removeItem('course_data');
				window.location.reload();
			},1000);
			if($(document.activeElement).prop('tagName')=='INPUT' && $(document.activeElement).attr('type')!='submit')
			{
				last_active_element=$(document.activeElement);
				last_active_element_parent_no=last_active_element.parents('.stepContentView').index();
			}
			
        }
    });
	/*
	$(window).focusin(function(e)
	{
		if($(document.activeElement).attr('name')=='prev')
		{
			e.preventDefault();
		}
	});*/
	
	colorize();
    var currentStep=0;
    var user=getUser();
	make_step_buttons();
	function make_step_buttons(toStart)
	{
		if(toStart==undefined)
		{
			toStart=true;
		}
		var user=getUser();
		//Count the steps and make the buttons to it
		$(function()
		{
			if(user.data.ID)
			{
				$('.stepContent .contentContainer .stepContentView:eq(3)').hide();
			}
			else
			{
				$('.stepContent .contentContainer .stepContentView:eq(3)').show();
			}
			$('.stepButtons .steps .step').not(':first').remove();
			var count=$('.stepContent .contentContainer .stepContentView:visible').length;
			for(i=1;i<count;i++)
			{
				var clone=$('.stepButtons .steps .step:first').clone(true,true);
				clone.find('.centeredStr').html(i+1);
				$('.stepButtons .steps').append(clone);
			}
			
			var cW=$('.stepButtons').width();
			console.log(cW);
			var l=$('.stepButtons .steps .step').length;
			var w=$('.stepButtons .steps .step').width();
			var m=cW-l*w;
			//alert(cW+'-'+l+'*'+w+'='+m);
			m=m/(l-1);
			//alert(m+'/('+l+'-'+1+')='+m);
			m=m/2;
			//alert(m+'/'+2+'='+m);
			$('.stepContent .contentContainer').width(cW*l);
			$('.stepButtons .steps .step').each(function(i)
			{
				if(i==0)
				{
					$(this).css({'margin':0,'margin-right':m});
				}
				if(i>0 &! (i==$('.stepButtons .steps .step').length-1))
				{
					$(this).css({'margin-left':m,'margin-right':m});
				}
				if(i==$('.stepButtons .steps .step').length-1)
				{
					$(this).css({'margin':0,'margin-left':m});
				}
			});
			//Check the current step (after page refresh)
			//changeStep($('.stepContent').scrollLeft()/cW);
			if(toStart==true)
			{
				$('.stepContent').scrollLeft(0);
				$('.planningContainer').hide();
			}
			//changeStep(0);
		});
	}
	
	
    //Step click action
    $('.stepButtons .steps .step').click(function(e)
    {
        e.preventDefault();
        var newStep=$(this).index();
        var oldStep=$('.stepButtons .steps .step.active').index();
        if(newStep>oldStep)
        {
            return false;
        }
        changeStep($(this).index());
    });
    //Next button
    $('input[name=next]').click(function(e)
    {
        e.preventDefault();
        if($('.stepButtons .steps .step.active').next().length>0)
        {
            changeStep($('.stepButtons .steps .step.active').next().index());
        }
		else if($('.stepButtons .steps .step.active').index()>0)
		{
			$(this).css({'opacity':0});
			$('.planningContainer').find('input[name=confirm]').trigger('click');
		}
    });
    //Previous button
    $('input[name=prev]').click(function(e)
    {
        e.preventDefault();
        if($('.stepButtons .steps .step.active').prev().length>0)
        {
            changeStep($('.stepButtons .steps .step.active').prev().index());
        }
    });
    function changeStep(to)
    {
		last_step=parseInt($('.stepButtons .steps .step.active').find('.centeredStr').html());
        $('.planningContainer *:animated').stop(false,true,true);
        var diff=to-currentStep;
		var count=$('.stepContent .contentContainer .stepContentView:visible').length;
		var funcNo=to+1;
		if(funcNo==4 && count==4)
		{
			funcNo=5;
		}
        if(to>currentStep || (currentStep==0 && to==0))
        {
            moveForward(to,diff);
            currentStep=to;
            eval('step'+(funcNo.toString())+'()');
        }
        else if(to<currentStep)
        {
            diff=diff*-1;
            currentStep=to;
            moveBackward(to,diff);
            eval('step'+(funcNo.toString())+'()');
        }
		else
		{
			//Just reset the step
			$('.stepContent').scrollLeft($('.stepContent .contentContainer .stepContentView').width()*to);
		}
         
    }
    function moveForward(step,diff)
    {
        var speed=diff*250;
        makeInActive(step-1,'r',function()
        {
            //line animation
            var left=$('.stepButtons .steps .step:eq('+step+')').position().left+parseFloat($('.stepButtons .steps .step:eq(2)').css('margin-left'));
            $('.stepButtons .background .slider').animate({'left':left},speed,'linear',function()
            {
                makeActive(step,'r');
            });
        });
		console.log('left scroll: '+$('.stepContent .contentContainer .stepContentView').width()*step);
        $('.stepContent').animate({'scrollLeft':$('.stepContent .contentContainer .stepContentView').width()*step},speed+500);
    }
    function moveBackward(step,diff)
    {
        var speed=diff*250;
        makeInActive(step-1,'l',function()
        {
            //line animation
            var left=$('.stepButtons .steps .step:eq('+step+')').position().left+parseFloat($('.stepButtons .steps .step:eq(2)').css('margin-left'));
            if(step==0)
            {
                left=0;
            }
            $('.stepButtons .background .slider').animate({'left':left},speed,'linear',function()
            {
                makeActive(step,'l');
            });
        });
        $('.stepContent').animate({'scrollLeft':$('.stepContent .contentContainer .stepContentView').width()*step},speed+500);
    }
    function makeActive(step,dir,callBack)
    {
        if(dir=='r')
        {
            $('.stepButtons .steps .step:eq('+step+') .bgColor').animate({'width':'100%'},250,'linear',function()
            {               
                $(this).parent().addClass('active');
                if(callBack)
                {
                    callBack();
                }
            });
        }
        if(dir=='l')
        {
            $('.stepButtons .steps .step:eq('+step+') .bgColor').css({'margin-left':'100%'});
            $('.stepButtons .steps .step:eq('+step+') .bgColor').animate({'width':'100%','margin-left':0},250,'linear',function()
            {               
                $(this).parent().addClass('active');
                if(callBack)
                {
                    callBack();
                }
            });
        }
    }
    function makeInActive(step,dir,callBack)
    {
        if(dir=='r')
        {
            $('.stepButtons .steps .step.active .bgColor').animate({'width':'0%','margin-left':'100%'},250,'linear',function()
            {
                $(this).parent().removeClass('active');
                $(this).css({'margin-left':0});
                if(callBack)
                {
                    callBack();
                }
            });
        }
        if(dir=='l')
        {
            $('.stepButtons .steps .step.active .bgColor').animate({'width':'0%'},250,'linear',function()
            {
                $(this).parent().removeClass('active');
                if(callBack)
                {
                    callBack();
                }
            });
        }
    }
     
     
    //Load the data
	//alert();
	$('input#refresh').click(function(e)
	{
		e.preventDefault();
		localStorage.removeItem('course_data');
		window.location.reload();
	});
	if(window.location.hash.length>0)
	{
		localStorage.removeItem('course_data');
	}
	//localStorage.removeItem('course_data');
	if(localStorage.getItem('course_data')!=undefined)
	{
		var d=new Date();
		var data=localStorage.getItem('course_data');
		data=$.parseJSON(data);
		var oldUser=data.user;
		var cD=data.data;
		var oD=new Date(data.datetime);
		var d=d.getTime()-oD.getTime();
		var m= Math.round(((d % 86400000) % 3600000) / 60000);
		var u=getUser();
		if(JSON.stringify(u)!=JSON.stringify(oldUser))
		{
			localStorage.removeItem('course_data');
		}
		else if(m>=59)
		{
			localStorage.removeItem('course_data');
		}
		else
		{			
			$('.loadingIndicator').fadeOut(500,function()
			{
				//Move on
				$(this).remove();
				$('.planningContainer').show().animate({'opacity':1});
				placeAct(cD);
				hash_checker();
			});	
		}
	}
	if(localStorage.getItem('course_data')==undefined)
	{
		$.get(document.location,{'visual_cursusplanning_ajax':'getDates','action':'getMax'},function(data)
		{
			if(data==0 || data.length==0)
			{
				$('.loadingIndicator').html('Er zijn momenteel geen cursussen beschikbaar.');
				return false;
			}
			var planCount=parseInt(data);
			var currCount=0;
			loadCourses(0);
			function loadCourses(skip)
			{
				getAtTheSameTime=1;
				$.ajax(
				{
					url:document.location,
					data:{'visual_cursusplanning_ajax':'getDates','action':'getDates','skip':skip,'first':getAtTheSameTime},
					async:true,
					success: function(data)
					{
						var str=data;
						data=$.parseJSON(data);
						currCount=data.count;
						var perc=currCount/planCount*100;
						 
						perc=Math.floor(perc);
						var curPerc=$('loadingIndicator .statusBarContainer .status #percentage').html();
						if(curPerc==undefined || perc>parseInt(curPerc))
						{
							$('.status #percentage').html(perc);
							$('.loadBar').stop(true,true,false).animate({'width':perc+'%'},500);
						}
						if(currCount==planCount)
						{
							$('.loadingIndicator').fadeOut(500,function()
							{
								var u=getUser();
								//Save the data to localstorage
								var d=new Date();
								localStorage.setItem('course_data', JSON.stringify({'datetime':d,'data':data,'user':u}));
								//Move on
								$(this).remove();
								$('.planningContainer').show().animate({'opacity':1});
								placeAct(data);
								hash_checker();
							});
						}
						else
						{
							loadCourses(currCount);
						}
					}
				});
			}
		});
	}
    
	function hash_checker()
	{
		//WINDOW HASH
		var step=0;
		if(window.location.hash.length>0)
		{
			var str=window.location.hash.substr(1);
			var object=JSON.parse('{"' + decodeURI(str).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
			if(object.actcode)
			{
				step1();
				step=1;
				
				if(object.plnkid)
				{
					var plnkid = object.plnkid;
					plnkid=plnkid.split('vrij:');
					var vrij=false;
					if(plnkid[1])
					{
						plnkid=plnkid[1];
						vrij=true;
					}
					else
					{
						plnkid=plnkid[0];
					}
				}
				
				var v=$('.planningContainer').find('select[name=act]').find('option#'+object.actcode).val();
				if(vrij==true)
				{
					v=$('.planningContainer').find('select[name=act]').find('optgroup#vgp').find('option#'+object.actcode).val();
				}
				
				$('.planningContainer').find('select[name=act]').val(v);
				$('.planningContainer').find('select[name=act]').trigger('change');
			}
			if(object.plnkid)
			{
				step2();
				step=2;
				var plnkid = object.plnkid;
				plnkid=plnkid.split('vrij:');
				var vrij=false;
				if(plnkid[1])
				{
					plnkid=plnkid[1];
					vrij=true;
				}
				else
				{
					plnkid=plnkid[0];
				}
				$('.planningContainer').find('select[name=plankop]').val(plnkid);
				$('.planningContainer').find('select[name=plankop]').trigger('change');
			}
			if(object.cursisten)
			{
				
				var cursisten=object.cursisten.split(',');
				var c=cursisten.length;
				$('.planningContainer').find('select[name=aantalCursisten]').val(c);
				$('.planningContainer').find('select[name=aantalCursisten]').trigger('change');				
				
				var student_search = setInterval(function()
				{
					var curistenContainer=$('.bestaandeCursisten').find('.cursistenA');
					curistenContainer.find('.exists').each(function()
					{
						var elm=$(this);
						var this_rid=$(this).find('input[type=hidden]:first').val();
						if(!isNaN(this_rid))
						{
							clearInterval(student_search);
							for(i in cursisten)
							{
								var rid=cursisten[i];
								if(rid==this_rid)
								{
									elm.find('input#in').attr('checked','checked');
									elm.find('input#in').trigger('change');
									delete cursisten[i];
								}
							}
						}
					});	
				},300);
			}
			window.location.href="#";
		}
		changeStep(step);
		makeActive(step,'r');
	}
     
    /*All of the step functions*/
    function step1()
    {
		if(last_step>1)
		{
			return;
		}
        loadActInfo($('select[name=act]').val());
        $('select[name=act]').change(function()
        {
            loadActInfo($(this).val());
        });
    }
    function step2()
    {
		if(last_step>2)
		{
			return;
		}
        var act=$('select[name=act]').val();
        act=$.parseJSON(act);
        var sel=$('.stepContentView:eq(1)').find('select[name=plankop]');
        sel.empty();
        for(i in act.PLANKOPPEN)
        {
            var row=act.PLANKOPPEN[i];
            sel.append("<option value='"+row.PLNKID+"'>"+row.STARTDATUM+"</option>");
        }
        selectDate(sel.val());
        sel.unbind('change').change(function(e)
        {
            selectDate(sel.val());           
        });
    }
    function step3()
    {
		if(last_step>3)
		{
			return;
		}
		$('.loading_students').hide();
        var act=$('select[name=act]').val();
        act=$.parseJSON(act);
        var plnkid=$('.stepContentView:eq(1)').find('select[name=plankop]').val();
        var sCV=$('.stepContentView:eq(2)');
        if(plnkid==undefined)
        {
            setTimeout(function()
            {
                changeStep(1);
            },1000);
        }
        else
        {
			//Reset everything from last time
			sCV.find('.cursisten').find('.cursist').find('input[type=text]').val('');
			sCV.find('.cursisten').find('.cursist').find('input[type=date]').val('');
			sCV.find('.cursisten').find('.cursist').find('input[type=email]').val('');
			sCV.find('.cursisten').find('.cursist').find('textarea').html('');
			sCV.find('.cursisten').find('.cursist').find('input[type=checkbox]').removeAttr('checked');
			sCV.find('.cursisten').find('.cursist').find('select').val( sCV.find('.cursisten').find('.cursist').find('select').find('option:first').val());
			
            var cs=sCV.find('.cursisten');
            cs.find(':input').removeAttr('disabled','disabled');
            var bC=sCV.find('.bestaandeCursisten');
            var cC=bC.find('.cursistenA');
            cs.hide();
            //Check if there has been chosen to already have an account
            var lD=sCV.find('.loginDiv');
            var lQ=sCV.find('.loginQuestion');
            lD.hide();
            lQ.show();
            $('input[name=gotAccount]').removeAttr('checked').unbind('change').change(function()
            {
                if($('input[name=gotAccount]:checked').val()=='J')
                {
                    lD.show();
                    cs.hide();
                }
                else
                {
                    lD.hide();
                    cs.show();
                }               
            });
			$('input[name=gotAccount]').not(':first').attr('checked','checked').trigger('change');
            var plnk=act.PLANKOPPEN['p'+plnkid];
            var vrij=plnk.VRIJ;
            //Vul de aantalkeuze
            var sel=sCV.find('select[name=aantalCursisten]');
            var val=sel.val();
            sel.empty();
            for(i=1;i<=vrij;i++)
            {
                sel.append("<option value='"+i+"'>"+i+"</option>");
            }
            //Als de oude waarde <= het aantal vrije plaatsen, set je die opnieuw
            if(val<=vrij && val!=undefined)
            {
                sel.val(val);
            }
            //Laat het juiste cursistformulier zien
            sCV.find('.cursist').hide();
            sCV.find('.cursist').removeClass('disabled');
            var cursistId='default';
            if(sCV.find('.cursist#'+act.ACTCODE).length>0)
            {
                cursistId=act.ACTCODE;
            }
            var cursistDiv=sCV.find('.cursist#'+cursistId);
            cursistDiv.addClass('active').show();
			if(cursistDiv.hasClass('no-data'))
			{
				//Haal de cursistdiv weg als hij niet nodig is.
				cursistDiv.hide();
			}
            sCV.find('.cursist').not('.active').find(':input').val(''); 
            //Check of er bestaande cursisten zijn:
            if(lD.find('fieldset.loginForm').length==0)
            {
				//Doe dit alleen als je ook cursistgegevens moet weergeven
				if(!cursistDiv.hasClass('no-data'))
				{
					//Hij is al ingelogd, dus het inlogscherm hoeft niet te worden laten zien.
					$('.loading_students').show();
					lQ.hide();
					cs.show();
					var sendPlnk = new Object;
					sendPlnk.PLNKID = plnk.PLNKID;
					sendPlnk.CURSISTEN = plnk.CURSISTEN;
					sendPlnk.INGESCHREVEN = plnk.INGESCHREVEN;
					sendPlnk.WIJZIGDAGEN = plnk.WIJZIGDAGEN;
					sendPlnk.ACTCODE = plnk.ACTCODE;
					
					$.post(document.location,{'visual_cursusplanning_ajax':'getCursistenLijst','plnk':sendPlnk},function(data)
					{
						data=$.parseJSON(data);
						if(data.length>0)
						{
							bC.show();
							cC.empty();
							for(i in data)
							{
								var clone=sCV.find('.cursist#'+cursistId+':first').clone(true,true);
								clone.removeClass('active').removeClass('disabled');
								cC.append(clone);
								clone.find('.exists').show();
								var row=data[i];
								clone.find('*').each(function()
								{
									var elm=$(this);
									var nameAttr=elm.attr('name');
									if(nameAttr!=undefined)
									{
										elm.val('');
										nameAttr=nameAttr.replace('cursist[','');
										nameAttr=nameAttr.replace('][]','');
										if(row[nameAttr])
										{
											var val=row[nameAttr];
											if(val.length>0 || val>0)
											{
												if(elm.attr('type')=='date')
												{
													var date=new Date(val*1000);
													var d=date.getDay();
													d=d+1;
													if(d<10)
													{
														d='0'+d.toString();
													}
													var m=date.getMonth();
													m=m+1;
													if(m<10)
													{
														m='0'+m.toString();
													}
													var Y=date.getFullYear();
													val=d+'-'+m+'-'+Y;
												}
												elm.val(val);
											}
										}
									}
									else
									{
										var id=$(this).attr('id');
										if(row[id])
										{
											elm.html('');
											var val=row[id];
											if(val.length>0)
											{
												elm.html(val);
											}
										}
									}
								});
								 
								//Als de cursist ingeschreven is, laat de uitschrijfknop zien en verberg de input velden
								if(row.INGESCHREVEN=='J')
								{
									clone.find(':input').attr('disabled','disabled');
									clone.find('.exists:eq(0)').hide();
									clone.find('.notExists').hide();
									clone.find('.exists:eq(1)').show();
									//Als 
									if(row.WIJZIGDAGEN <= 0)
									{
										clone.find('.uitschrijven:eq(0)').hide();
										clone.find('.uitschrijven:eq(1)').show();
									}
									else
									{
										//'Dag' of 'Dagen'
										if(row.WIJZIGDAGEN==1)
										{
											clone.find('span.meer').hide();
										}
										else
										{
											clone.find('span.meer').show();
										}
										clone.find('.uitschrijven:eq(0)').show();
										clone.find('.uitschrijven:eq(1)').hide();
										//Verwijder uit cursus
										clone.find('a#dFC').attr('rel',row.ID);
										clone.find('a#dFC').unbind('click').click(function(e)
										{
											e.preventDefault();
											var ID=$(this).attr('rel');
											var container=$(this).parents('.cursist');
											$.post(document.ready,{'visual_cursusplanning_ajax':'wijzigInschrijving',PLNKID:plnkid,RID:ID},function(data)
											{
												refreshPlanning(plnkid);
												container.fadeOut(500,function()
												{
													$(this).remove();
												});
											});
										});
									}
								}
								else
								{
									clone.find('.exists:eq(0)').show();
									clone.find('.notExists').show();
									clone.find('.exists:eq(1)').hide();
								}
								//Zet de laatste cursusdatum neer
								clone.find('.last_date_box').hide();
								if(row.LAST_COURSE_DATE)
								{
									clone.find('.last_date_box').show();
									clone.find('.last_date_future').hide();
									clone.find('.last_date_history').hide();
									var lCD=clone.find('.last_date_'+row.LAST_COURSE_DATE.type);
									lCD.show();
									lCD.find('.last_date').html(row.LAST_COURSE_DATE.str);								
								}
								//Zet alle velden op disabled, zodat ze niet gecheckt of meegenomen worden
								clone.find(':input').not('.addCursist').attr('disabled','disabled');
								 
								//Check eerst of er nog plek is voor een volgende
								clone.find('input.addCursist').unbind('click').click(function()
								{
									var clone=$(this).parents('.cursist');
									var id=clone.attr('id');
									var newC=cs.find('.cursist').find('.cursist#'+id+':not(.disabled)').length;
									var excC=bC.find('input.addCursist:checked').length;
									var curC=newC+excC;
									var count=$('select[name=aantalCursisten]').val();
									if(curC>count)
									{
										return false;
									}
								});
								//Refresh date-fields
								$('[type="date"]').visual_datepicker();
								
								clone.find('input.addCursist').unbind('change').change(function()
								{
									var clone=$(this).parents('.cursist');
									var id=clone.attr('id');
									//Cursist is aangevinkt
									if($(this).is(":checked"))
									{
										var last;
										//Zoek de laatste nieuwe cursist op
										sCV.find('.cursisten').find('.cursist#'+id+':not(.disabled)').each(function()
										{
											last=$(this);
										});
										if(last!=undefined)
										{
											//Laat de laatste nieuwe cursist disablen
											last.addClass('disabled').find(':input').attr('disabled','disabled');
										}
										//Check opnieuw verplichte velden
										clone.find('.mandatory').unbind('keyup.mandatory_check').unbind('change.mandatory_check').bind('keyup.mandatory_check change.mandatory_check',function()
										{
											checkMandatory(sCV);
										});
										//Enable alle inputs in de bestaande cursist die zojuist is aangevinkt
										clone.find(':input').removeAttr('disabled');
										//Zeg dat hij meedoet
										clone.find('.not').hide();
									}
									else
									{
										sCV.find('.cursisten').find('.cursist.disabled#'+id+':first').removeClass('disabled').find(':input').removeAttr('disabled');    
										clone.find('.mandatory').unbind('keyup.mandatory_check').unbind('change.mandatory_check');
										clone.find(':input').not('.addCursist').attr('disabled','disabled');
										//Zeg dat hij niet meedoet
										clone.find('.not').show();
									}
									//Haal "Nieuwe cursisten" weg als er geen nieuwe in te vullen zijn
									if(sCV.find('.cursisten').find('.cursist#'+id+':not(.disabled)').length==0)
									{
										sCV.find('.cursus .wzTitle:first').hide();										
									}
									else
									{
										sCV.find('.cursus .wzTitle:first').show();		
									}
									//Pak de eerstvolgende input die leeg is en focussss
									clone.parent().find(':input').each(function()
									{
										if($(this).val().length==0)
										{
											$(this).focus();
											return false;
										}
									});
									checkMandatory(sCV);
								});
								//Verander de velden als het een cursist is
								
								if(user.data.relatie)
								{
									if(user.data.relatie.HOOFDRID!=null)
									{
										sCV.find('.wzTitle:first').html(__visual('cursusplanning_student_my_data_title',"Mijn gegevens"));
										sCV.find('.cursisten').hide();
										sCV.find('.bestaandeCursisten').find('.wzTitle').remove();
										sCV.find('.bestaandeCursisten').find('.addCursist').attr('checked','checked').trigger('change');
										sCV.find('.bestaandeCursisten').find('.addCursist').parent().hide();
										sCV.find('select[name=aantalCursisten]').parent().hide();
									}
								}
								mail_checker($(this),sCV);
								
								//sCV.find('.bestaandeCursisten').find('input[type=email]').attr('disabled','disabled');
							}
						}
						else
						{
							bC.hide();
						}
							
						$('.loading_students').hide();
					});
				}
            }
            else
            {
				$('form#loginform').submit(function(e)
				{
					e.preventDefault();
					var data=$(this).serialize();
					$.post(document.location,{data:data,'visual_action':'visual_connect_ajax_login'},function(data)
					{
						data=$.parseJSON(data);
						if(data.error)
						{
							$('.message').html(data.error);
						}
						else
						{
                        	user=getUser();
							$('fieldset.loginForm').remove();
							make_step_buttons(false);
							$('.stepButtons .steps .step:eq(2)').addClass('active');
							moveForward(2,1);
							step3();
							return false;
						}
					});
				});
				/*
                var checkLogin=setInterval(function()
                {
                    var isLogged=sCV.find('.message').html();
                    if(isLogged=='true')
                    {
                        clearInterval(checkLogin);
                        $('fieldset.loginForm').remove();
                        step3();
                        return false;
                    }
                },250);*/
            }
            //Laat het juiste aantal cursistenformulieren zien
            sel.change(function()
            {
                var id=cursistDiv.attr('id');
                var currentCount=sCV.find('.cursisten').find('.cursist#'+id).length;
                var selected=parseInt($(this).val());
                var diff=selected-currentCount;
                if(diff>0)
                {
                    //Er moeten een paar cursistenformulieren bij
                    for(i=1;i<=diff;i++)
                    {
                        sCV.find('.cursisten').find('.cursist#'+id+':first').clone(true,true).insertAfter(sCV.find('.cursisten').find('.cursist#'+id+':last'));
                        sCV.find('.cursisten').find('.cursist#'+id+':last').find('input[type=text]').val('');
                        sCV.find('.cursisten').find('.cursist#'+id+':last').find('input[type=date]').val('');
                        sCV.find('.cursisten').find('.cursist#'+id+':last').find('input[type=email]').val('');
                        sCV.find('.cursisten').find('.cursist#'+id+':last').find('textarea').html('');
                        sCV.find('.cursisten').find('.cursist#'+id+':last').find('input[type=checkbox]').removeAttr('checked');
                        sCV.find('.cursisten').find('.cursist#'+id+':last').find('select').val( sCV.find('.cursisten').find('.cursist#'+id+':last').find('select').find('option:first').val());
                        //sCV.find('.cursisten').find('.cursist#'+id+':last').find(':input').removeAttr('disabled');
                        //sCV.find('.cursisten').find('.cursist#'+id+':last').removeClass('disabled');
                    }
                }
                else if(diff<0)
                {
                    //Er moeten een paar formulieren af
                    for(i=diff;i<0;i++)
                    {
                        sCV.find('.cursisten').find('.cursist#'+id+':last').remove();
                    }
                }
                //Het zou kunnen dat er bestaande cursisten zijn aangevinkt, disable dan de plaatsen voor nieuwelingen
                sCV.find('.cursisten').find('.cursist#'+id).find(':input').removeAttr('disabled');
                sCV.find('.cursisten').find('.cursist#'+id).removeClass('disabled');
                for(i=1;i<=sCV.find('input.addCursist:checked').length;i++)
                {
                    var last;
                    sCV.find('.cursisten').find('.cursist#'+id+':not(.disabled)').each(function()
                    {
                        last=$(this);
                    });
                    last.addClass('disabled').find(':input').attr('disabled','disabled');
					//Haal de mandatory events weg van nieuwe cursisten (als je een fout email-adres hebt getypt in een cursist die je toch besluit niet te gebruiken, moet er ook niet op gecheckt worden)
					last.find('.mandatory').unbind('keyup.mandatory_check').unbind('change.mandatory_check').attr('disabled','disabled');
					//Haal "Nieuwe cursisten" weg als er geen nieuwe in te vullen zijn
					if(sCV.find('.cursisten').find('.cursist#'+id+':not(.disabled)').length==0)
					{
						sCV.find('.cursus .wzTitle:first').hide();										
					}
					else
					{
						sCV.find('.cursus .wzTitle:first').show();		
					}

                }
				//Refresh date-fields
				$('[type="date"]').visual_datepicker();
                //Als er meer zijn aangevinkt dan gekozen aantal deelnemers, vink je wat uit
                for(i=selected;i<=sCV.find('input.addCursist:checked').length;i++)
                {
                    var last;
                    bC.find('.cursist#'+id).each(function()
                    {
                        if($(this).find('input.addCursist:checked').length>1)
                        {
                            last=$(this);
                        }
                    });
                    last.find('input.addCursist').removeAttr('checked');                    
                }
                checkMandatory(sCV);
            });
            if(cursistDiv.find('.mandatory').length>0)
            {
                //Er zitten verplichte velden in het cursistveld, disable de next-knop
                ok=false;
            }
            else
            {
                ok=true;        
            }
            checkMandatory(sCV,ok);
            cursistDiv.find('.mandatory').unbind('keyup.mandatory_check').unbind('change.mandatory_check').bind('keyup.mandatory_check change.mandatory_check',function()
            {
                checkMandatory(sCV);
            });
			//Check email on blur
			mail_checker(sCV.find('input[type=email]'),sCV,false,true);
			
            //Haal het hele cursistenscherm weg als cusistDiv leeg is (dus een relatie met een aantal wordt ingeschreven)
            if(cursistDiv.html() == undefined || cursistDiv.html().length==0)
            {
                cursistDiv.parents('.cursus').hide();
            }
            else
            {
                cursistDiv.parents('.cursus').show();
            }
        }
    }
    function step4()
    {
        var act=$('select[name=act]').val();
        act=$.parseJSON(act);
        var plnkid=$('.stepContentView:eq(1)').find('select[name=plankop]').val();
        var sCV=$('.stepContentView:eq(3)');
        if(plnkid==undefined)
        {
            setTimeout(function()
            {
                changeStep(1);
            },1000);
        }
        else
        {
            //als de gebruiker is ingelogd, verwijder dan gegevensinvoer en andersom
            if(user.data.ID)
            {                 
                sCV.find('.notLogged').remove();
				if(user.data.relatie==undefined)
				{
					$('.planningContainer').html("Er is een probleem opgetreden met de koppeling naar de back-office.<br />Ingelogd als administrator?");
					return false;
				}
                if(user.data.relatie.ISBEDRIJF=='J')
                {
                    $('.zelfCursistVraag').remove();
                }
            }
            else
            {
                sCV.find('.logged').remove();
            }
            checkMandatory(sCV);
            sCV.find('.mandatory').unbind('keyup change').bind('keyup change',function()
            {
                checkMandatory(sCV);
            });
			mail_checker(sCV.find('input[type=email]'),sCV,function(ok)
			{
				if(ok==false)
				{
					if($('input#zelfCursist:checked').val()=='J')
					{
						ok=true;
					}
				}
				return ok;
			});
            //Enable de 'ik ben zelf cursist'-knop wanneer een particulier zich aanmeldt
            var hI=$('.hiddenInput#zelfCursist');
            hI.hide();
            $('input#zelfCursist').removeAttr('disabled');
            sCV.find('input#bedrijfsnaam').unbind('keyup').keyup(function()
            {
                if($(this).hasClass('mandatory'))
                {
                    checkMandatory(sCV);
                }
                if($(this).val().length>0)
                {
                    $('input#zelfCursist').attr('disabled','disabled');
                    sCV.find('input#name').removeAttr('disabled');
                    hI.hide();
                }
                else
                {
                    $('input#zelfCursist').removeAttr('disabled');
                    selfCheck();
                }
            });
            //'Ik ben zelf cursist' actie
            sCV.find('input#zelfCursist').unbind('change').change(function()
            {
				sCV.find('input[type=email]').trigger('keyup');
                selfCheck();
            });
            if(typeof selfCheck != 'function')
            {
                function selfCheck()
                {
                    var val=sCV.find('input#zelfCursist:checked').val();
                    if(val=='J')
                    {
                        var self=hI.find('select').val();
                        hI.find('select').empty();
                        sCV.find('input#name').attr('disabled','disabled');
                        var count=0;
                        /*var cursistDiv=*/sCV.prev().find('input#NAAM').each(function(i)
                        {
                            if($(this).val().length>0)
                            {
                                hI.find('select').append("<option value='"+count+"'>"+(i+1)+") "+$(this).val()+"</option>");
                                count++;
                            }
                        });
                        if(self!=undefined && hI.find('select').find('option[value='+self+']').length>0)
                        {
                            hI.find('select').val(self);
                        }
                        if(count>1)
                        {
                            //Er zijn meer cursisten dan 1, dus je moet kiezen
                            hI.show();
                            myself(hI.find('select').val());
                            hI.find('select').unbind('change').change(function()
                            {
                                myself($(this).val());
                            });
                        }
                        else if(count==1)
                        {
                            //Er is 1 cursist, dus je weet al wie het is
                            hI.hide();
                            myself(hI.find('select').val());
                        }
                        else
                        {
                            //Er zijn geen cursistnamen bekend, dit was dus blijkbaar niet nodig in het formulier
                            hI.hide();
                            sCV.find('input#name').val('').removeAttr('disabled');
                        }
                    }
                    else
                    {
                        hI.hide();
                        sCV.find('input#name').removeAttr('disabled');
                    }
                    checkMandatory(sCV);
                }
                function myself(val)
                {
                    var name=hI.find('select').find('option:eq('+val+')').html();
					var p=name.split(') ');
					delete p[0];
					name=p.join(') ').substr(2);
                    sCV.find('input#name').val(name);
                }
            }
            selfCheck();
        }
        /*
        function checkMandatory(sCV)
        {
            sCV.find('.mandatory').each(function()
            {
                var mT=$(this);
                if(mT.val().length==0 && mT.attr('disabled')!='disabled')
                {
                    ok=false;
                    return false;
                }
                else
                {
                    ok=true;
                }
            });
			
			if(sCV.find(':input').is(':invalid').length>0)
			{
				ok=false;
			}
			
            if(ok==true)
            {
                sCV.find('input[name=next]').removeAttr('disabled');
            }
            else
            {
                sCV.find('input[name=next]').attr('disabled','disabled');
            }
        }*/
    }
    function step5()
    {
        var act=$('select[name=act]').val();
        act=$.parseJSON(act);
        var plnkid=$('.stepContentView:eq(1)').find('select[name=plankop]').val();
        var sCV=$('.stepContentView:eq(4)');
        var par=sCV.parent();
        var form=sCV.find('form.sendData');
        form.empty().hide();
        par.find(':input').each(function(index)
        {
			if($(this).parents('.stepContentView').index()<4)
			{
				if($(this).val()!=null)
				{
					if($(this).attr('type')!='button' && $(this).attr('type')!='submit' && $(this).val().length>0 && $(this).attr('disabled')!='disabled')
					{					
						var oriVal=$(this).val();
						
						if($(this).prop('tagName')=='SELECT' && $(this).parents('.stepContentView').index()>1 && $(this).attr('name')!='cursistNaamKeuze')
						{
							var opt=$(this).find('option[value='+oriVal+']').html();
							oriVal=oriVal+'=='+opt;
							form.append("<input type='hidden' name='"+$(this).attr('name')+"' value='"+oriVal+"' />");
						}
						else
						{
							$(this).clone().val(oriVal).appendTo(form);
						}
					}
				}	
			}
        });
        var sendData=form.serialize();
        //$.post(planningAjaxUrl+'ProcessWizard',{'sendData':sendData,'confirm':false},function(data)
		$.post(document.location,{'visual_cursusplanning_ajax':'processWizard','sendData':sendData,'confirm':false},function(data)
        {
			var id="default";
			if(sCV.find('table#CURSISTEN.'+act.ACTCODE).length>0)
			{
				id=act.ACTCODE;
			}
			
			sCV.find('table#CURSISTEN').each(function()
			{
				$(this).hide();
			});
			sCV.find('table#CURSISTEN.'+id).show();
			
            if($('.json').length>0)
            {
                $('.json').html(data);
            }
            data=$.parseJSON(data);
            confirmContainer($('.returnData'),data);
        });
        sCV.find('input[name=confirm]').unbind('click').click(function(e)
        {
			var confirm_btn=$(this);
            confirm_btn.hide();
            $('.indicator').html(__visual('planning_wizard_settings_indicator_process_text','Een ogenblik geduld aub...'));
			
			if(sCV.find('input[name=visual_ideal_bank]').length>0)
			{
				var b=sCV.find('input[name=visual_ideal_bank]:checked').val();
				sendData=sendData+"&visual_ideal_bank="+b;
			}
			
			$.post(document.location,{'visual_cursusplanning_ajax':'processWizard','sendData':sendData,'confirm':true},function(data)
            {
				if(data=="PAY")
				{
					window.location.reload();
					return;
				}
				localStorage.removeItem('course_data');
                if(data.substr(0,4)=='TRUE')
                {
                    $('.indicator').html(__visual('planning_wizard_settings_indicator_confirmed_success','We hebben uw inschrijving in goede orde ontvangen. U zal ook een mail ontvangen met deze bevestiging.'));
                    window.location.href=addParameter(document.location, 'status', 'complete');					                     
                }
                else if(data=='FALSE')
                {
                    $('.indicator').html(__visual('planning_wizard_settings_indicator_confirmed_fail','Onze excuses, er is helaas iets mis gegaan bij de inschrijving. Neem indien mogelijk telefonisch contact met ons op.'));
                }
                else
                {
					$('.indicator').empty();
					confirm_btn.show();
                    if($('.json').length>0)
                    {
                        $('.json').html(data);
                    }
                    else
                    {
                        console.log(data);
                    }
					if(data.indexOf("Er is al een account")==-1)
					{
						$('.indicator').html(__visual('planning_wizard_settings_indicator_confirmed_fail','Onze excuses, er is helaas iets mis gegaan bij de inschrijving. Neem indien mogelijk telefonisch contact met ons op.'));
					}
					else
					{
						$('.indicator').html(data);
					}
                }               
            });
        });
    }	
	function confirmContainer(container,data)
	{
		container.find('*').each(function(index)
		{
			var id=$(this).attr('id');
			if(id!=undefined)
			{
				id='data.'+id;
				if(eval(id))
				{
					var value=eval(id);
					if( typeof value === 'string' )
					{
						//het is een <td id='x'></td> waar een string in moet
						if(id=='data.AANHEF')
						{
							value=value.substr(0,1)+value.substr(1).toLowerCase();
						}
						$(this).html(value);
					}
					else if(value[0])
					{
						//Het is een <table id='x'></table> waar een array in moet
						console.log("LoopTable: "+JSON.stringify(value));
						makeLoopTable($(this),value);
					}
					else
					{
						//Het is een <table id='x'></table> waar een complete dictionary in gaat
						console.log("DictTable: "+JSON.stringify(value));
						confirmContainer($(this),value);
					}
				}
			}
		});
	}
	function makeLoopTable(table,data)
	{
		table.children('tbody').children('tr').not(':first').remove();
		for(i in data)
		{
			var row=data[i];
			console.log("Loopdata for "+i+": "+JSON.stringify(data[i]));
			var tr=table.children('tbody').children('tr:first');
			if(i>0)
			{
				var clone=tr.clone(true,true);
				tr.after(clone);
				tr=clone;
				/*
				table.children('tbody').children('tr:first').clone(true,true).insertAfter(table.children('tbody').children('tr:last'));
				tr=table.children('tbody').children('tr:last');*/
			}
			//console.log("<tr> = "+tr.html());
			confirmContainer(tr,row);
			/*
			setTimeout(function()
			{
				confirmContainer(tr,row);
			},500);*/
		}
	}
	
	function checkMandatory(sCV,ok)
	{
		if(ok==undefined)
		{
			ok=true;
		}
		/*
		var id=cursistDiv.attr('id');
		sCV.find('.cursist#'+id).each(function()
		{
			$(this).find('.mandatory').each(function()
			{
				var mT=$(this);
				if(mT.attr('disabled')!='disabled')
				{
					if(mT.val().length==0)
					{
						ok=false;
						return false;
					}
					else
					{
						ok=true;
					}
				}
			});
		});*/
		if(ok==true)
		{
			sCV.find('.mandatory').each(function()
			{
				var mT=$(this);
				if(mT.attr('disabled')!='disabled')
				{
					if(mT.is(':visible'))
					{
						if(mT.val().length==0)
						{
							ok=false;
							console.log({'empty_name':mT.attr('name'),'id':mT.attr('id')});
							return false;
						}
					}
				}
			});
		}
		sCV.find(':input').each(function()
		{
			if($(this).attr('disabled')!='disabled')
			{
				if($(this).attr('invalid')=='invalid')
				{
					ok=false;
					console.log({'name':$(this).attr('name'),'id':$(this).attr('id'),'fault_val':$(this).val()});
					return false;
				}
			}
		});
		if(ok==true)
		{
			sCV.find('input[name=next]').removeAttr('disabled');
			return false;
		}
		else
		{
			sCV.find('input[name=next]').attr('disabled','disabled');
			return false;
		}
	}
	function mail_checker(email,sCV,execption_function,unbind)
	{
		if(unbind!=undefined && unbind==true)
		{
			email.unbind('keyup.mail_check');
		}
		email.bind('keyup.mail_check',function(e)
		{
			if(e.keyCode!=13)
			{
				email=$(this);
				var ok=true;
				//Check if email is valid and if it exists
				if(ajax_check_mail!=false && ajax_check_mail!=undefined)
				{
					ajax_check_mail.abort();
				}
				//$.get(document.location,{'visual_cursusplanning_ajax':
				var check_mail=email.val().toLowerCase();
				ajax_check_mail=$.ajax(
				{
					url:document.location,
					//async:false,
					data:{'visual_action':'visual_check_email','email':check_mail,'in_visual':true},
					type:'GET',
					success: function(data)
					{					
						if(data==1)
						{
							ok=true;
							
							//Search for same email-addresses
							$('.planningContainer').find('input[type=email]').each(function()
							{
								//console.log($(this).attr('name')+' '+$(this).attr('id')+' '+$(this).val());
								if(!($(this).attr('name')==email.attr('name') && $(this).attr('id')==email.attr('id') && $(this).offset().top==email.offset().top) && $(this).val().toLowerCase()==email.val().toLowerCase() && email.attr('invalid')!='invalid')
								{
									ok=false;
									if(execption_function!=undefined && execption_function!=false)
									{
										ok=execption_function(ok);
									}
									if(ok==false)
									{
										alert(__visual('cursusplanning_email_already_used_in_form',"U heeft dit emailadres al gebruikt tijdens uw inschrijving"));
										return false;
									}
								}
							});
						}
						else if(data!=0)
						{
							ok=false;
							data=$.parseJSON(data);
							if(data.error)
							{
								alert('Het email-adres '+email.val()+' komt al voor in onze database');
							}
						}
						else
						{
							ok=false;
						}
						if(ok==true)
						{
							email.removeAttr('invalid');
						}
						else
						{
							email.attr('invalid','invalid');
						}
						checkMandatory(sCV,ok);
					}
				});				
			}
		});
	}
	
	function loadActInfo(act)
	{
		data=$.parseJSON(act);
		var sCV=$('.stepContentView:eq(0)');
		if(data==null || data.PLANKOPPEN.length==0)
		{
			sCV.find('input[name=next]').attr('disabled','disabled');   
			sCV.find('.cursus').find('.wzError').html("Voor deze cursus zijn momenteel geen datums gepland");           
		}
		else
		{
			sCV.find('input[name=next]').removeAttr('disabled');
			sCV.find('.cursus').find('.wzError').empty();
		}
		sCV.find('.cursus').find('.wzText').html(urldecode(data.WEBNOTITIE));
		sCV.find('.cursus').find('.wzTitle').html(data.OMSCHRIJVING);
	}
	function selectDate(plnkid)
	{
		var act=$('select[name=act]').val();
        act=$.parseJSON(act);
		var sCV=$('.stepContentView:eq(1)');
		var c=sCV.find('.dateInfo');
		var wzText=c.find('.wzText');
		//console.log(plnkid);
		//console.log(act.PLANKOPPEN);
		var plnk=act.PLANKOPPEN['p'+plnkid];
		var title=act.OMSCHRIJVING+' op '+plnk.STARTDATUM;
		sCV.find('.wzTitle').html(title);
		//Check of deze cursus uit meerdere dagen bestaat en geef dit dan aan
		var dayStr="";
		 
		//Check eerst of er plandates zijn. Bij een simpele cursus zijn die er namelijk niet.
		if(typeof(plnk.PLANDATES)!='undefined')
		{
			//check of het er meer dan 1 zijn.
			if(plnk.PLANDATES.length>1)
			{
				dayStr="<p>Deze cursus bestaat uit de volgende onderdelen:</p>";
			}
			else
			{
				dayStr="<p>Deze cursus bestaat uit het onderdeel:</p>";
			}
			 
			//Vul de plandates
			wzText.find('table').show();
			wzText.find('table').find('tr.clone').remove();
			for(i in plnk.PLANDATES)
			{
				var row=plnk.PLANDATES[i];
				var tr=wzText.find('table').find('tr:nth-child(2)');
				if(i>0)
				{
					tr.clone(true,true).addClass('clone').appendTo(wzText.find('table'));
					tr=wzText.find('table').find('tr:last');
				}
				for(key in row)
				{
					var val=row[key];
					if(tr.find('#'+key).length>0)
					{
						tr.find('#'+key).html(val);
					}                   
				}
			}
		}
		else
		{
			wzText.find('table').hide();
		}
		wzText.find('#dayStr').html(dayStr);
		//Vul overige gegevens
		for(key in plnk)
		{
			var val=plnk[key];
			if(wzText.find('#'+key).length>0)
			{
				wzText.find('#'+key).html(val);
			}
		}
		//Kleur vrij rood als het 0 is
		if(plnk.VRIJ==0)
		{
			wzText.find('span#VRIJ').css({'color':'#F00'});
			sCV.find('input[name=next]').attr('disabled','disabled');   
		}
		else
		{
			wzText.find('span#VRIJ').css({'color':'inherit'});
			sCV.find('input[name=next]').removeAttr('disabled');
		}
	}
    function refreshPlanning(plnkid)
    {
        $.get(document.location,{'visual_cursusplanning_ajax':'refreshPlanning',plnkid:plnkid},function(data)
        {
			//$('body').html(data);
            data=$.parseJSON(data);
            //Reset the act select
			var actIndex=false;
			$('select[name=act]').find('option').each(function(index)
			{
				if($(this).is(':selected'))
				{
					actIndex=index;
				}
			});
            placeAct(data);
			var u=getUser();
			//Save the data to localstorage
			var d=new Date();
			localStorage.setItem('course_data', JSON.stringify({'datetime':d,'data':data,'user':u}));
			
            $('.planningContainer').find('select[name=act]').find('option:eq('+actIndex+')').attr('selected','selected');
			last_step=1;
            step2();
        });
    }
    function placeAct(data)
    {
		if(data.count)
		{
			delete data.count;
		}
		var sel=$('.planningContainer').find('select[name=act]');
		var lookForType=false;
		sel.empty();
		if(data.vrijgepland)
		{
			lookForType=true;
			sel.html("<optgroup id='opb' label='"+__visual('planning_wizard_public_title','Openbaar')+"'></optgroup><optgroup id='vgp' label='"+__visual('planning_wizard_closed_title','Vrijgepland')+"'></optgroup>");
		}
		for(type in data)
		{
			var row=data[type];
			for(actcode in row)
			{
				var actRow=row[actcode];
				if(lookForType==true)
				{
					//console.log(type+' '+actRow.OMSCHRIJVING);
					if(type=='openbaar')
					{
						var group=sel.find('#opb');
						group.append("<option id='"+actRow.ACTCODE+"' value='"+JSON.stringify(actRow)+"'>"+actRow.OMSCHRIJVING+"</option>");
					}
					else
					{
						var group=sel.find('#vgp');
						group.append("<option id='"+actRow.ACTCODE+"' value='"+JSON.stringify(actRow)+"'>"+actRow.OMSCHRIJVING+" (vrijgepland)</option>");
					}
				}
				else
				{
					sel.append("<option id='"+actRow.ACTCODE+"' value='"+JSON.stringify(actRow)+"'>"+actRow.OMSCHRIJVING+"</option>");
				}
			}
		}
    }
    function getUser()
    {
		if($('.planningContainer').length==0)
		{
			return false;
		}
        var usr;
        $.ajax({
            url:document.location,
            data:{'visual_action':'visual_get_user_data'},
            async:false,
			type:'GET',
            success: function(data)
            {
                usr=$.parseJSON(data);
                if(usr.error)
                {
                    usr=false;
                }
				if(usr.caps)
				{
					if(usr.caps.administrator && usr.caps.administrator==true)
					{
						alert("U kunt dit systeem niet gebruiken als administrator, aangezien deze niet aan een Visual relatie is gekoppeld.");
						$('.planningContainer').remove();
						return false;
					}
				}
            }
        });
        return usr;
    }
    function urldecode(str)
    {
        return decodeURIComponent((str+'').replace(/\+/g, '%20'));
    }
	function init_filters(filters)
	{
		$.ajax(document.location,
		{
			data:{'visual_action':'visual_get_string_filters','filters':filters},
			async:false,
			cache:false,
			error: function()
			{
				alert('Probleem bij het ophalen van text-filters');
				return false;
			},
			success: function(data)
			{
				string_filters=$.parseJSON(data);
			}
		});
	}
	function __visual(filter,str)
	{
		if(string_filters[filter]!=undefined && string_filters[filter]!=false)
		{
			return string_filters[filter];
		}
		else
		{
			return str;
		}
	}
	function colorize()
	{		
		/*
		A) check if the hidden div.colorsettings is empty or not
		B) if empty, find the color for an A-tag (watch it, it can be rgb(), rgba() or # and you have to figure out a gradient in a JS-function)
		C) save the color to the default colorsettings
		D) use the color
		*/
		//Find the color
		var c="#000";
		if($('.primary_color_setting').length>0)
		{
			c=$('.primary_color_setting').attr('id');
		}
		else
		{
			$('.stepContent').after('<a href="#" id="linktest"></a>');
			c=$('a#linktest').css('color');
			$('a#linktest').remove();
		}		
		var g=get_gradient(c);
		$("<style type='text/css'> .stepButtons .steps .step.active .cell .centeredStr{ color:"+c+" !important} .stepButtons .steps .step .bgColor, .stepButtons .background .line .lineContainer .slider {background-color:"+c+" !important} .loadingIndicator .loadBarContainer .loadBar{"+g+"}</style>").appendTo("head");
	}
	function get_gradient(color)
	{
		if(color==undefined)
		{
			color="#CCC";
		}
		if(color.substring(0,4)=='rgb(')
		{
			color=color.replace('rgb','rgba');
			color=color.replace(')',',1)');
		}
		else if(color.substr(0,5)=='rgba(')
		{
			var p=color.split(',');
			p[3]='1)';
			color=p.join(',');
		}
		else if(color.substr(0,1)=='#')
		{
			if(color.length==4)
			{
				color='#'+color[1]+color[1]+color[2]+color[2]+color[3]+color[3];
			}
			var h=[color[1]+color[2],color[3]+color[4],color[5]+color[6]];
			var d=new Array();
			for(i in h)
			{
				var hex=h[i];
				var dec=hexdec(hex);
				d[i]=dec;
			}
			d[3]=1;
			color='rgba('+d.join(',')+')';
		}
		var p=color.split(',');
		p[3]='0.5)';
		var color2=p.join(',');
		
		
		var css = [
		"background: "+color+";",
		"background: -moz-linear-gradient(left, "+color2+" 0%, "+color+" 100%);",
		"background: -webkit-gradient(left top, right top, color-stop(0%, "+color2+"), color-stop(100%, "+color+"));",
		"background: -webkit-linear-gradient(left, "+color2+" 0%, "+color+" 100%);",
		"background: -o-linear-gradient(left, "+color2+" 0%, "+color+" 100%);",
		"background: -ms-linear-gradient(left, "+color2+" 0%, "+color+" 100%);",
		"background: linear-gradient(to right, "+color2+" 0%, "+color+" 100%);"
		];
		return css.join('');
	}
	function hexdec(hex_string)
	{
		//  discuss at: http://phpjs.org/functions/hexdec/
		// original by: Philippe Baumann
		//   example 1: hexdec('that');
		//   returns 1: 10
		//   example 2: hexdec('a0');
		//   returns 2: 160
		
		hex_string = (hex_string + '').replace(/[^a-f0-9]/gi, '');
		return parseInt(hex_string, 16);
	}
	function addParameter(url, param, value)
	{
		// Using a positive lookahead (?=\=) to find the
		// given parameter, preceded by a ? or &, and followed
		// by a = with a value after than (using a non-greedy selector)
		// and then followed by a & or the end of the string
		var val = new RegExp('(\\?|\\&)' + param + '=.*?(?=(&|$))'),
			parts = url.toString().split('#'),
			url = parts[0],
			hash = parts[1]
			qstring = /\?.+$/,
			newURL = url;
	
		// Check if the parameter exists
		if (val.test(url))
		{
			// if it does, replace it, using the captured group
			// to determine & or ? at the beginning
			newURL = url.replace(val, '$1' + param + '=' + value);
		}
		else if (qstring.test(url))
		{
			// otherwise, if there is a query string at all
			// add the param to the end of it
			newURL = url + '&' + param + '=' + value;
		}
		else
		{
			// if there's no query string, add one
			newURL = url + '?' + param + '=' + value;
		}
	
		if (hash)
		{
			newURL += '#' + hash;
		}
	
		return newURL;
	}
});