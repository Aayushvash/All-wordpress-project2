// custom javascript

$(document).ready(function(e) {
	
	$("#grandtotal").val(0);
    var selected=$("div.order > ul >li >ul");
	selected.css({'display':'none'});
	$("div.order > ul >li > p").css({'display':'none'});
	$("div.order > ul li >h4").on("click", function(){
		
		$(this).siblings("ul").slideToggle(700);
		$(this).siblings("p").slideToggle(700);
			
	});
	
	// only positive numbers are allowed
	$("div.order").find(".quantity").keyup(function(){
		 this.value = this.value.replace(/[^0-9]+$/,'');
	});
	
	$(".choice_type").each(function (){
	//	alert($(this).val());
		boxdata=$(this).val();
		if(boxdata.toLowerCase().indexOf("(3lbs)") >= 0){ 
							var boxType="3lb";
							$(this).siblings(".quantity3").addClass("three_lb");
							 }
							 
		
		if(boxdata.toLowerCase().indexOf("(5lbs)") >= 0){ 
							var boxType="5lbs";
							$(this).siblings(".quantity3").addClass("five_lb");
							}
		
		if(boxdata.toLowerCase().indexOf("(10lbs)") >= 0){
			
							 var boxType="10lbs";
							$(this).siblings(".quantity3").addClass("ten_lb");
							}
		
		});
		
							
	
	$("#center-wrap").on("blur keyup keypress change",".quantity, .quantity1, .quantity2, .quantity3", function(){
//	alert("hello");	
	
		var myClass =$(this).attr("class");
//		alert(myClass);
		if(myClass == "quantity2"){
					var quantity=parseInt(this.value = this.value.replace(/[^0-9\.]/g,''),10); 
					if(isNaN(quantity)){
						//	alert("kkkk");
								$(this).closest("li").find(".amount").val("");	
									
								
										var cat_amount=0;
										$(this).closest("ul").find(".amount").each(function(){
											var amnt=parseFloat($(this).val(),10);
											if(!isNaN(amnt)){
													//	alert(amnt);
														cat_amount= cat_amount + amnt;
														
											}
											});
							//				alert(cat_amount);
											$(this).closest("ul").parent().find(".cat_amount").val(cat_amount);
						
						
						}
			//		alert($(this).closest("li").find(".price").text());
					var price=parseFloat($(this).closest("li").find(".price").text(),10);
	//					alert(quantity);alert(price);
					var amount=price*quantity;
	//					alert(amount);
						if(!isNaN(amount)){
						//	alert(amount);
				//			alert($(this).val());
							if(!isNaN(amount)){
							//	alert("kk1111kk");
									$(this).closest("li").find(".amount").val(amount);	
									
								
										var cat_amount=0;
										$(this).closest("ul").find(".amount").each(function(){
											var amnt=parseFloat($(this).val(),10);
											if(!isNaN(amnt)){
													//	alert(amnt);
														cat_amount= cat_amount + amnt;
														
											}
											});
									//		alert(cat_amount);
											$(this).closest("ul").parent().find(".cat_amount").val(cat_amount);
							}
							
						//	alert("skiped");
						}
		}
		
		if(myClass == "quantity"){
					var quantity=parseInt(this.value = this.value.replace(/[^0-9\.]/g,''),10);
			//		alert($(this).closest("li").find(".price").text());
					var price=parseFloat($(this).closest("li").find(".price").text(),10);
			//			alert(quantity);alert(price);
			
						
					
			
					var amount=price*quantity;
		//				alert(amount);
						if(!isNaN(amount)){
							$(this).closest("li").find(".amount").val(amount);
							$(this).closest("li").find(".cat_amount").val(amount);
							
							
						}
			//				alert(ten_lb1);
						var three_lb1=parseInt($(this).closest("li").find(".3lb_side_dishes").val(),10);
						var five_lb1=parseInt($(this).closest("li").find(".5lb_side_dishes").val(),10);
						var ten_lb1=parseInt($(this).closest("li").find(".10lb_side_dishes").val(),10);
						
						if(isNaN(three_lb1)){ var three_lb1=0;};
						if(isNaN(five_lb1)){ var five_lb1=0;};
						if(isNaN(ten_lb1)){ var ten_lb1=0;};
				//		alert(ten_lb1);
						//now get valid choice as per selected quantity
						var valid_3lb=quantity*three_lb1;
						var valid_5lb=quantity*five_lb1;
						var valid_10lb=quantity*ten_lb1;
				//		alert(valid_3lb);alert(valid_5lb);alert(valid_10lb);
						var cat_nm=$(this).closest("li").find("input[name='cat_h4_name[]']").val();
			//			alert(cat_nm);
						var totChoice3=0;
						var totChoice5=0;
						var totChoice10=0;
						
						$(this).closest("li").find(".three_lb").each(function() {
						
							
								var choiceVal=parseInt(this.value = this.value.replace(/[^0-9\.]/g,''),10);
									
								if(!isNaN(choiceVal)){
									
									totChoice3=totChoice3 + choiceVal;								
								}
								
						});//alert(totChoice3);
						$(this).closest("li").find(".five_lb").each(function() {
						
							
								var choiceVal=parseInt(this.value = this.value.replace(/[^0-9\.]/g,''),10);
									
								if(!isNaN(choiceVal)){
									
									totChoice5=totChoice5 + choiceVal;								
								}
								
						});
						$(this).closest("li").find(".ten_lb").each(function() {
						
							
								var choiceVal=parseInt(this.value = this.value.replace(/[^0-9\.]/g,''),10);
									
								if(!isNaN(choiceVal)){
									
									totChoice10=totChoice10 + choiceVal;								
								}
								
						});
						
			//			alert(totChoice3);alert(totChoice5);alert(totChoice10);
			//			alert(valid_3lb);alert(totChoice5);alert(valid_10lb);
						
						if(	totChoice3 != valid_3lb || totChoice5 != valid_5lb || totChoice10 != valid_10lb){ 
								
		//						alert("ok11");
				//				$("#message").first("span").text("There are errors with "+ cat_nm + " party order. Please Correct before submitting.");
					//			$("#is_valid").val("false");
								$(this).closest("li").find(".is_choice_valid").val("false");
								
								}
						if(totChoice3 == valid_3lb && totChoice5 == valid_5lb && totChoice10 == valid_10lb){ 
								$("#message").first("span").text("");
								$("#is_valid").val("true");
								
								
								}
						
						
						
		}
		
		
		
		if(myClass == "quantity1"){	
		//			alert("1")
					var quantity=parseInt(this.value = this.value.replace(/[^0-9\.]/g,''),10);
		//			alert($(this).closest("ul").siblings("h4").find(".price").text());
					var price=parseFloat($(this).closest("ul").siblings("h4").find(".price").text(),10);
		//				alert(quantity);alert(price);
					var amount=price*quantity;
		//				alert(amount);
						if(!isNaN(amount)){
								$(this).closest("li").find(".amount").val(amount);
							//	alert(amount);
						}
						
						
							var cat_amount=0;
					$(this).closest("ul").find(".amount").each(function(){
						var amnt=parseFloat($(this).val(),10);
						if(!isNaN(amnt)){
								//	alert(amnt);
									cat_amount= cat_amount + amnt;
									
						}
						});
						//alert(cat_amount);
						$(this).closest("ul").parent().find(".cat_amount").val(cat_amount);
			
			}
			
			
		if(myClass == "quantity3 three_lb"){	
			//		alert("hello3")
					var totChoice=0;
					var cat_nm=$(this).closest("ul").parent("li").find("input[name='cat_h4_name[]']").val();//alert(cat_nm);
					$(this).closest("ul").find(".three_lb").each(function() {
						
							
							var choiceVal=parseInt(this.value = this.value.replace(/[^0-9\.]/g,''),10);
					//		alert(choiceVal);
							if(!isNaN(choiceVal)){
							totChoice=totChoice + choiceVal;
							
							}
                    });
					
				
					
					
					
							
					// max choice for pack
					var threelb=parseInt($(this).closest("ul").prev("ul").find(".3lb_side_dishes").val(),10);
					var quant_sel=parseInt($(this).closest("ul").parent("li").find(".quantity").val(),10); // alert(quant_sel)
					
					valid_3lb=quant_sel*threelb;	
					
			//		alert(threelb);
			//		alert(valid_3lb);
			//		alert(totChoice);
					
					if(	totChoice != valid_3lb){ 
							
							
				//			$("#message").first("span").text("There are errors with "+ cat_nm +" party order. Please Correct before submitting.");
				//			$("#is_valid").val("false");
							
							}
					if(	totChoice == valid_3lb){ 
							$("#message").first("span").text("");
							$("#is_valid").val("true");
							
							
							}
					
					
					
			}	
			
			if(myClass == "quantity3 five_lb"){	
			//		alert("hello3")
					var totChoice=0;
					var cat_nm=$(this).closest("ul").parent("li").find("input[name='cat_h4_name[]']").val();//alert(cat_nm);
					$(this).closest("ul").find(".five_lb").each(function() {
						
						
							var choiceVal=parseInt(this.value = this.value.replace(/[^0-9\.]/g,''),10);
					//	alert(choiceVal);
							if(!isNaN(choiceVal)){
									totChoice=totChoice + choiceVal;
							
							}
                    });
			//			alert(totChoice);
					/*if(!isNaN(totChoice)){
							$(this).closest("ul").find(".choice_5").val(totChoice);
						}*/
					
				//	alert(totChoice);							
					// max choice for pack
					var fivelb=parseInt($(this).closest("ul").prev("ul").find(".5lb_side_dishes").val(),10);
					var quant_sel=parseInt($(this).closest("ul").parent("li").find(".quantity").val(),10); 
					// alert(quant_sel)
					valid_5lb=fivelb*quant_sel;
					
	//			alert(totChoice),alert(valid_5lb);
					if(	totChoice != valid_5lb){ 
							
							
			//				$("#message").first("span").text("There are errors with "+ cat_nm +" party order. Please Correct before submitting.");
			//				$("#is_valid").val("false");
							
							}
					if(	totChoice == valid_5lb){ 
							$("#message").first("span").text("");
							$("#is_valid").val("true");
							
							
							}
			}	
			
			
			if(myClass == "quantity3 ten_lb"){	
			//		alert("hello3")
					var totChoice=0;
					var cat_nm=$(this).closest("ul").parent("li").find("input[name='cat_h4_name[]']").val();//alert(cat_nm);
					$(this).closest("ul").find(".ten_lb").each(function() {						
						
							var choiceVal=parseInt(this.value = this.value.replace(/[^0-9\.]/g,''),10);
					//	alert(choiceVal);
							if(!isNaN(choiceVal)){
							totChoice=totChoice + choiceVal;
							
							}
                    });
					
									
					// max choice for pack
					var tenlb=parseInt($(this).closest("ul").prev("ul").find(".10lb_side_dishes").val(),10);
					var quant_sel=parseInt($(this).closest("ul").parent("li").find(".quantity").val(),10); 
					
					valid_10lb=tenlb*quant_sel;
					
		//				alert(valid_10lb),alert(totChoice);
					
					if(	totChoice != valid_10lb){ 
							
							
			//					$("#message").first("span").text("There are errors with "+ cat_nm +" party order. Please Correct before submitting.");
			//					$("#is_valid").val("false");
														
							}
					if(	totChoice == valid_10lb){ 
							$("#message").first("span").text("");
							$("#is_valid").val("true");
							
							
							}
			}	
			
	
		
			
		
		
		
		
		
		
		
	});

		// caclucate no of element in each categary
		var totalElem=0;
		$(".order").find(".cat_elem").each(function(){
			
		var subCatLen= $(this).parent("li").find('input[type="text"]').length;
			//	alert(subCatLen);
				$(this).val(subCatLen);	
				totalElem=totalElem+subCatLen;
			
			
		});	
	//	alert(totalElem);



$("#order_it").on("submit", function(){
	
	
	$(".quantity").each(function() {
		
		var quan_sel=parseInt($(this).val(),10);	//alert(quan_sel);		
		if(!isNaN(quan_sel) && quan_sel > 0){
		
			var three_lb1= parseInt($(this).closest("li").find(".3lb_side_dishes").val(),10);
			var five_lb1= parseInt($(this).closest("li").find(".5lb_side_dishes").val(),10);
			var ten_lb1= parseInt($(this).closest("li").find(".10lb_side_dishes").val(),10);
		//	alert(three_lb1);alert(five_lb1);alert(ten_lb1);
						if(isNaN(three_lb1)){ var three_lb1=0;};
						if(isNaN(five_lb1)){ var five_lb1=0;};
						if(isNaN(ten_lb1)){ var ten_lb1=0;}; // alert("h2");
				//		alert(ten_lb1);	
						//now get valid choice as per selected quantity
						var valid_3lb=quan_sel*three_lb1;
						var valid_5lb=quan_sel*five_lb1;
						var valid_10lb=quan_sel*ten_lb1;
			//			alert(valid_3lb);
			//			alert(valid_5lb);
			//			alert(valid_10lb);
						var cat_nm=$(this).closest("li").find("input[name='cat_h4_name[]']").val();
			//			alert(cat_nm);
						var totChoice3=0;
						var totChoice5=0;
						var totChoice10=0;
						
						$(this).closest("li").find(".three_lb").each(function() {
						
							
								var choiceVal=parseInt(this.value = this.value.replace(/[^0-9\.]/g,''),10);
									
								if(!isNaN(choiceVal)){
									
									totChoice3=totChoice3 + choiceVal;								
								}
								
						});	//alert(totChoice3);
						$(this).closest("li").find(".five_lb").each(function() {
						
							
								var choiceVal=parseInt(this.value = this.value.replace(/[^0-9\.]/g,''),10);
									
								if(!isNaN(choiceVal)){
									
									totChoice5=totChoice5 + choiceVal;								
								}
								
						});
						$(this).closest("li").find(".ten_lb").each(function() {
						
							
								var choiceVal=parseInt(this.value = this.value.replace(/[^0-9\.]/g,''),10);
									
								if(!isNaN(choiceVal)){
									
									totChoice10=totChoice10 + choiceVal;								
								}
								
						});
			//			alert(cat_nm);
			//			alert(totChoice3);
			//			alert(totChoice5);
		//				alert(totChoice10);
			//			alert(valid_3lb);alert(totChoice5);alert(valid_10lb);
						var sideDish="";
						if(	totChoice3 != valid_3lb){sideDish=valid_3lb+" (3lbs)" ;}
						if(	totChoice5 != valid_5lb){sideDish=valid_5lb+" (5lbs)" ;}
						if(	totChoice10 != valid_10lb){sideDish=valid_10lb+" (10lbs)" ;}
						
							if(totChoice5 != valid_5lb && totChoice10 != valid_10lb){
								 sideDish5=valid_5lb+" (5lbs)" ;
								 sideDish10=" and "+valid_10lb+" (10lbs)" ;
								 sideDish=sideDish5+sideDish10;
								
				//				alert("ok11");
								$("#message").first("span").text("There are errors with "+ cat_nm + " party order. Please choose "+sideDish+" Side Dish Choices before submitting.");
								$("#is_valid").val("false");
								$(this).closest("li").find(".is_choice_valid").val("false");
								 return false;
								}
						
						
						if(	totChoice3 != valid_3lb || totChoice5 != valid_5lb || totChoice10 != valid_10lb){ 
								
				//				alert("ok11");
								$("#message").first("span").text("There are errors with "+ cat_nm + " party order. Please choose "+sideDish+" Side Dish Choices before submitting.");
								$("#is_valid").val("false");
								$(this).closest("li").find(".is_choice_valid").val("false");
								 return false;
								}
					
								
						if(totChoice3 == valid_3lb && totChoice5 == valid_5lb && totChoice10 == valid_10lb){ 
								$("#message").first("span").text("");
								$("#is_valid").val("true");
								
								
								}
			
			
			}
        
    });
	
		var grandTotal=0;
	//	$(".amount").each(function() {
		$(".amount").each(function() {
            amount=parseFloat($(this).val(),10);
			
			if(!isNaN(amount)){
	//		alert(amount);	
				
			grandTotal=grandTotal + amount ;
	//		alert(grandTotal);
			}
			$("#grandtotal").val(grandTotal);
				
        });
	
	
	
	
		
	var notEmpty=$('input.quantity[value!=""]').length;
	var notEmpty1=$('input.quantity1[value!=""]').length;
	var notEmpty2=$('input.quantity2[value!=""]').length;
	var notEmpty3=$('input.quantity3[value!=""]').length;
	if(notEmpty==0 && notEmpty1==0 && notEmpty2==0 && notEmpty3==0){
		$("#message").first("span").text("Please choose order before submitting.");
		return false
		}
	//	alert("ok");
	var is_valid=$("#is_valid").val();
	if(is_valid == "true"){  return true}
	else{ 
//	$("#message").first("span").text("There are errors with  party order. Please Correct before submitting.");
	return false
	}
	
	
	
	
});	



	

//document ready closed	
});


	
