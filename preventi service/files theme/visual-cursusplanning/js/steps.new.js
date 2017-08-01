/*Geef hier instellingen op*/
var settings=new Object();
settings.indicator=new Object();
//Geef hier aan wat er gemeld moet worden TIJDENS het inschrijven van de cursist(en)
settings.indicator.process='Een ogenblik geduld aub...';
//Geef hier aan wat er gemeld moet worden NA het inschrijven van de cursist(en)
settings.indicator.TRUE='We hebben uw inschrijving in goede orde ontvangen. U zal ook een mail ontvangen met deze bevestiging.';
//Geef hier aan wat er gemeld moet worden ALS HET INSCHRIJVEN FOUT is gegaan
settings.indicator.FALSE='Onze excuses, er is helaas iets mis gegaan bij de inschrijving. Neem indien mogelijk telefonisch contact met ons op.';
//Geef hier een bedanktpagina op
settings.pageAfterProcess='/bedankt';
(function($) {
$(document).ready(function(e)
{
	$(window).keydown(function(e)
	{
		if(e.keyCode==9)
		{
			if($(document.activeElement).prop('tagName')!='INPUT')
			{
				e.preventDefault();
			}
			else
			{
				//Check what kind the next input is
				var t = $(document.activeElement).nextAll('input').attr('type');
				if(t==undefined || t=='undefined')
				{
					e.preventDefault();
				}
			}
		}
	});
	var original_conclusion_html=false;
	var currentStep=0;
	var user=getUser();
	//Count the steps and make the buttons to it
	$(function()
	{
		var count=$('.stepContent .contentContainer .stepContentView').length;
		for(i=1;i<count;i++)
		{
			var clone=$('.stepButtons .steps .step:first').clone(true,true);
			clone.find('.centeredStr').html(i+1);
			$('.stepButtons .steps').append(clone);
		}
		var cW=$('.stepButtons').width();
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
		$('.stepContent').scrollLeft(0);
		$('.planningContainer').hide();
		//changeStep(0);
	});
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
	//Check if I should move to another step (launched from certain screen)
	$(function()
	{
		var hash = window.location.hash;
		if(hash.length>0)
		{
			hash=hash.split('#');
			var l=hash.length-1;
			for(i in hash)
			{
				var val=hash[i];
				if(i==1)
				{
					//Selecteer (en open) de activiteit
					var actCode=val;
					var eq;
					var sel=$('select[name=act]');
					sel.find('option').each(function(index)
					{
						var option=$(this);
						var act=option.val();
						act=$.parseJSON(act);
						if(act.ACTCODE==actCode)
						{
							eq=index;
							step1();
							option.attr('selected','selected');
							sel.trigger('change');
							//Als er maar 1 waarde in de hash zit, moet je door naar stap 2
							if(act.PLANKOPPEN!=null)
							{
								setTimeout(function()
								{
									changeStep(1);
								},500);
							}
						}
					});
				}
				if(i==2)
				{
					//Selecteer een datum
					var plnkid=val;
					setTimeout(function()
					{
						$('select[name=plankop]').val(plnkid);
						changeStep(2);
					},1500);
				}
				if(i==3)
				{
					var cursisten=val.split(',');
					var count=cursisten.length;
					var maxC;
					setTimeout(function()
					{
						maxC=parseInt($('select[name=aantalCursisten]').find('option:last').html());
						$('select[name=aantalCursisten]').val(count);
					},1600);
					setTimeout(function()
					{
						$('select[name=aantalCursisten]').trigger('change');
						$('.cursistenA').find('.cursist').each(function(index)
						{
							if(index<maxC)
							{
								for(i in cursisten)
								{
									var cID=cursisten[i];
									var ex=$(this).find('.exists:eq(0)');
									var id=ex.find('input[type=hidden]:eq(0)').val();
									if(id==cID && ex.find('input.addCursist:disabled').length==0)
									{
										ex.find('input.addCursist').trigger('click').attr('checked','checked');
									}
									else
									{
										//ex.find('input.addCursist').removeAttr('checked');
									}
								}
							}
						});
					},2000);
				}
			}
		}
		else
		{
			/*
			changeStep(0);
			makeActive(0,'r');*/
		}
	});
	function changeStep(to)
	{
		$('.planningContainer *:animated').stop(false,true,true);
		var diff=to-currentStep;
		if(to>currentStep || (currentStep==0 && to==0))
		{
			moveForward(to,diff);
			currentStep=to;
			eval('step'+((to+1).toString())+'()');
		}
		else if(to<currentStep)
		{
			diff=diff*-1;
			currentStep=to;
			moveBackward(to,diff);
			eval('step'+((to+1).toString())+'()');
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
	var courses=new Object();
	$.get(planningAjaxUrl+'GetDates',{'action':'getMax'},function(data)
	{
		if(data.length==0)
		{
			alert('Er ging iets mis met de verbinding naar ons systeem. Neem aub contact met ons op.');
			return false;
		}
		var planCount=parseInt(data);
		var currCount=0;
		loadCourses(0);
		function loadCourses(skip)
		{
			getAtTheSameTime=1;
			$.ajax(planningAjaxUrl+'GetDates',
			{
				data:{'action':'getDates','skip':skip,'first':getAtTheSameTime},
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
							$(this).remove();
							$('.planningContainer').show().animate({'opacity':1});
							placeAct(data);
							changeStep(0);
							makeActive(0,'r');
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
	
	
	/*All of the step functions*/
	function step1()
	{
		loadActInfo($('select[name=act]').val());
		$('select[name=act]').change(function()
		{
			loadActInfo($(this).val());
		});
		function loadActInfo(act)
		{
			data=$.parseJSON(act);
			var sCV=$('.stepContentView:eq(0)');
			if(data==null)
			{
				sCV.find('.cursus').find('.wzText').html("");
				sCV.find('.cursus').find('.wzTitle').html("");
				
				return false;
			}
			if(data.PLANKOPPEN.length==0)
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
	}
	function step2()
	{
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
		function selectDate(plnkid)
		{
			var sCV=$('.stepContentView:eq(1)');
			var c=sCV.find('.dateInfo');
			var wzText=c.find('.wzText');
			var plnk=act.PLANKOPPEN['p'+plnkid];
			var title=act.OMSCHRIJVING+' op '+plnk.STARTDATUM;
			c.find('.wzTitle').html(title);
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
	}
	function step3()
	{
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
			sCV.find('.cursist').not('.active').find(':input').val('');	
			//Check of er bestaande cursisten zijn:
			if(lD.find('fieldset.loginForm').length==0)
			{
				//Hij is al ingelogd, dus het inlogscherm hoeft niet te worden laten zien.
				lQ.hide();
				cs.show();
				$.get(planningAjaxUrl+"CursistenLijst",{'plnk':plnk},function(data)
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
									nameAttr=nameAttr.replace('cursist[','');
									nameAttr=nameAttr.replace('][]','');
									if(row[nameAttr])
									{
										var val=row[nameAttr];
										if(val.length>0 || val>0)
										{
											elm.val(val);
										}
									}
								}
								else
								{
									var id=$(this).attr('id');
									if(row[id])
									{
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
										$.post(planningAjaxUrl+'WijzigInschrijving',{PLNKID:plnkid,RID:ID},function(data)
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
							//Bestaande cursisten aanmelden met het vinkje
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
									//Laat de laatste nieuwe cursist disablen
									last.addClass('disabled').find(':input').attr('disabled','disabled');
									//Check opnieuw verplichte velden
									clone.find('.mandatory').unbind('keyup').unbind('change').bind('keyup change',function()
									{
										checkMandatory();
									});
									//Enable alle inputs in de bestaande cursist die zojuist is aangevinkt
									clone.find(':input').removeAttr('disabled');
								}
								else
								{
									sCV.find('.cursisten').find('.cursist.disabled#'+id+':first').removeClass('disabled').find(':input').removeAttr('disabled');	
									clone.find('.mandatory').unbind('keyup').unbind('change');
									clone.find(':input').not('.addCursist').attr('disabled','disabled');
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
								checkMandatory();
							});
						}
					}
					else
					{
						bC.hide();
					}
				});
			}
			else
			{
				var checkLogin=setInterval(function()
				{
					var isLogged=sCV.find('.message').html();
					if(isLogged=='true')
					{
						user=getUser();
						clearInterval(checkLogin);
						$('fieldset.loginForm').remove();
						step3();
						return false;
					}
				},250);
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
				}
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
				checkMandatory();
			});
			var ok;
			if(cursistDiv.find('.mandatory').length>0)
			{
				//Er zitten verplichte velden in het cursistveld, disable de next-knop
				ok=false;
			}
			else
			{
				ok=true;		
			}
			checkMandatory();
			cursistDiv.find('.mandatory').unbind('keyup').unbind('change').bind('keyup change',function()
			{
				checkMandatory();
			});
			//Haal het hele cursistenscherm weg als cusistDiv leeg is (dus een relatie met een aantal wordt ingeschreven)
			if(cursistDiv.html().length==0)
			{
				cursistDiv.parents('.cursus').hide();
			}
			else
			{
				cursistDiv.parents('.cursus').show();
			}
		}
		function checkMandatory()
		{
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
			if(user!=false)
			{
				
				sCV.find('.notLogged').remove();
				if(user.data.relatie.ISBEDRIJF=='J')
				{
					$('.zelfCursistVraag').remove();
				}
			}
			else
			{
				sCV.find('.logged').remove();
			}
			checkMandatory();
			sCV.find('.mandatory').unbind('keyup change').bind('keyup change',function()
			{
				checkMandatory();
			});
			//Enable de 'ik ben zelf cursist'-knop wanneer een particulier zich aanmeldt
			var hI=$('.hiddenInput#zelfCursist');
			hI.hide();
			$('input#zelfCursist').removeAttr('disabled');
			sCV.find('input#bedrijfsnaam').unbind('keyup').keyup(function()
			{
				if($(this).hasClass('mandatory'))
				{
					checkMandatory();
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
						var cursistDiv=sCV.prev().find('input#cursistNaam').each(function()
						{
							if($(this).val().length>0)
							{
								hI.find('select').append("<option value='"+count+"'>"+$(this).val()+"</option>");
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
					checkMandatory();
				}
				function myself(val)
				{
					var name=hI.find('select').find('option:eq('+val+')').html();
					sCV.find('input#name').val(name);
				}
			}
			selfCheck();
		}
		
		function checkMandatory()
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
			if(ok==true)
			{
				sCV.find('input[name=next]').removeAttr('disabled');
			}
			else
			{
				sCV.find('input[name=next]').attr('disabled','disabled');
			}
		}
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
			/*
			if($(this).val()!=null)
			{
				if($(this).attr('type')!='button' && $(this).attr('type')!='submit' && $(this).val().length>0 && $(this).attr('disabled')!='disabled')
				{
					var oriVal=$(this).val();
					$(this).clone().val(oriVal).appendTo(form);
				}
			}*/
			
			if($(this).attr('type')!='button' && $(this).attr('type')!='submit' && $(this).attr('disabled')!='disabled')
			{
				var oriVal=$(this).val();
				if(oriVal.length==0)
				{
					oriVal='-';
				}
				$(this).clone().val(oriVal).appendTo(form);
			}
		});
		var sendData=form.serialize();
		$.post(planningAjaxUrl+'ProcessWizard',{'sendData':sendData,'confirm':false},function(data)
		{
			if(original_conclusion_html==false)
			{
				original_conclusion_html=$('.returnData').clone(true,true);
			}
			else
			{
				$('.returnData').replaceWith(original_conclusion_html);
			}
			if($('.json').length>0)
			{
				$('.json').html(data);
			}
			data=$.parseJSON(data);
			confirmContainer($('.returnData'),data);
		});
		sCV.find('input[name=confirm]').unbind('click').click(function(e)
		{
			$(this).remove();
			$('.indicator').html(settings.indicator.process);
			$.post(planningAjaxUrl+'ProcessWizard',{'sendData':sendData,'confirm':true},function(data)
			{
				if(data.substr(0,4)=='TRUE')
				{
					refreshPlanning(plnkid);
					$('.indicator').html(settings.indicator.TRUE);
					
					//Refresh de loginfunctie
					var uP=data.substr(4);
					uP=$.parseJSON(uP);
					var u=uP.u;
					var p=uP.p;
					$.ajax(
					{
						url:ajaxUrl+"Login",
						data:{'USER':u,'PASSWORD':p},
						type:'POST',
						async:false,
						success: function(data)
						{
							setTimeout(function()
							{
								window.location.href=settings.pageAfterProcess;
							},5000);
						}
					});
					
				}
				else if(data=='FALSE')
				{
					$('.indicator').html(settings.indicator.FALSE);
				}
				else
				{
					if($('.json').length>0)
					{
						$('.json').html(data);
					}
					else
					{
						alert(data);
					}
					$('.indicator').html(settings.indicator.FALSE);
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
	function refreshPlanning(plnkid)
	{
		$.get(planningAjaxUrl+'RefreshPlanning',{plnkid:plnkid},function(data)
		{
			data=$.parseJSON(data);
			//Reset the act select
			var actIndex=$('select[name=act]').find('option').is(':selected').index();
			placeAct(data);
			$('.planningContainer').find('select[name=act]').find('option:eq('+actIndex+')').attr('selected','selected');
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
			sel.html("<optgroup id='opb' label='Openbaar'></optgroup><optgroup id='vgp' label='Vrijgepland'></optgroup>");
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
						group.append("<option value='"+JSON.stringify(actRow)+"'>"+actRow.OMSCHRIJVING+"</option>");
					}
					else
					{
						var group=sel.find('#vgp');
						group.append("<option value='"+JSON.stringify(actRow)+"'>"+actRow.OMSCHRIJVING+" (vrijgepland)</option>");
					}
				}
				else
				{
					sel.append("<option value='"+JSON.stringify(actRow)+"'>"+actRow.OMSCHRIJVING+"</option>");
				}
			}
		}
	}
	function getUser()
	{
		var usr;
		$.ajax({
			url:ajaxUrl+"GetUser",
			async:false,
			success: function(data)
			{
				usr=$.parseJSON(data);
				if(usr.error)
				{
					usr=false;
				}
			}
		});
		return usr;
	}
	function urldecode(str)
	{
		return decodeURIComponent((str+'').replace(/\+/g, '%20'));
	}
});
})(jQuery);