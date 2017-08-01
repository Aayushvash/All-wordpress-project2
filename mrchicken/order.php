<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: Order1
 */
 
 include 'PHPMailerAutoload.php';
 
get_header();
$thispageid= 111;
 ?>

 <script src="<?php bloginfo('template_url'); ?>/js/jquery.datepick.js"></script>
 <style>
 .datepick-popup {
	z-index: 99999 !Important;
 }
 </style>


<script type="text/javascript">



jQuery(function(){

	jQuery("#menuform").submit(function(){
		
		return OrderValidation();
		//return false;
	});
});

function OrderValidation()
{
	if (document.getElementById('quantity011915').value < 5 && document.getElementById('quantity011915').value !='') 
	{
		//message += "Phone Number:\n";
		alert("Please enter Minimum 5 Dozen  Biscuits Items");
		return false;
	}
	if (document.getElementById('quantity011925').value < 5 && document.getElementById('quantity011925').value !='') 
	{
		//message += "Phone Number:\n";
		alert("Please enter Minimum 5 Dozen  Corn Muffins Items");
		return false;
	}
	 
	if (document.getElementById('quantity011935').value < 5 && document.getElementById('quantity011935').value !='') 
	{
		//message += "Phone Number:\n";
		alert("Please enter Minimum 5 Dozen  Dinner Rolls Items");
		return false;
	}
   
	var returnvalue=true;
	jQuery(".calculateprice").each(function(){		
		var qty = jQuery(this).val();
		if(jQuery.trim(qty) == "")  {
			qty=0;
		} else {
			qty=jQuery.trim(qty)*1;
		}
		if(jQuery(this).data("type")=="combined" && qty > 0 ) {
			
			var rel = jQuery(this).data("relparent");
			var dish3 = jQuery(this).data("dish3");
			var dish5 = jQuery(this).data("dish5");
			var dish10 = jQuery(this).data("dish10");
		//	console.log("Found product"  + rel);
			
			if(jQuery.trim(dish3) == "")  {
				dish3=0;
			} else {
				dish3=jQuery.trim(dish3)*1;
			}
			if(jQuery.trim(dish5) == "")  {
				dish5=0;
			} else {
				dish5=jQuery.trim(dish5)*1;
			}
			if(jQuery.trim(dish10) == "")  {
				dish10=0;
			} else {
				dish10=jQuery.trim(dish10)*1;
			}			
			var dishall = dish3 + dish5 + dish10;
			var totalitem3 = 0, totalitem5=0, totalitem10=0;
			jQuery(this).parent().parent().parent().find(".my" + rel).each(function(){
				if(jQuery(this).data("rel")== rel && jQuery(this).val()!= "") {
					if (jQuery(this).data("title").search(/10lbs/i) >=0 ) {
						totalitem10 += jQuery.trim(jQuery(this).val()) * 1;
						console.log("Total 10 " + totalitem10);
					} else if (jQuery(this).data("title").search(/5lbs/i) >=0 ) {
						totalitem5 += jQuery.trim(jQuery(this).val()) * 1;
						console.log("Total 5 " + totalitem5);
					} else {
						totalitem3 += jQuery.trim(jQuery(this).val()) * 1;
						console.log("Total 3 " + totalitem3);
					}
				}
			});
			
			
			var totalcount3=dish3* qty;
			var totalcount5=dish5* qty;
			var totalcount10=dish10* qty;
			console.log("Rel : " + rel + " : " + totalcount3 + ":" + totalcount5  + ":" + totalcount10);
			if(totalcount3 < totalitem3) {
				alert("Please select only " + (totalcount3) +  " 3lbs option for your Tranditional Party Packs");
				returnvalue= false;
			}else if (totalcount3 > totalitem3) {
				alert("You need to select " + ( (totalcount3)-totalitem3  ) + " more 3lbs options for Tranditional Party Packs");				
				returnvalue= false;
			}
			
			if(totalcount5 < totalitem5) {
				alert("Please select only " + (totalcount5) +  " 5lbs option for your Tranditional Party Packs");
				returnvalue= false;
			}else if (totalcount5 > totalitem5) {
				alert("You need to select " + ( (totalcount5)-totalitem5  ) + " more 5lbs options for Tranditional Party Packs");				
				returnvalue= false;
			}
			
			if(totalcount10 < totalitem10) {
				alert("Please select only " + (totalcount10) +  " 10lbs option for your Tranditional Party Packs");
				returnvalue= false;
			}else if (totalcount10 > totalitem10) {
				alert("You need to select " + (  (totalcount10)-totalitem10  ) + " more 10lbs options for Tranditional Party Packs");				
				returnvalue= false;
			}
			
		}
	});
	
	return returnvalue;
}

<!--san-->
function bis() {		
	return true;
}

<!--san-->
function orderConfirmation()
{



	caterDate = new Date(Date.parse(jQuery('#date').val()));
	var currentDate = new Date();
	
	var timePieces = jQuery('#timer').val().split(" ");
	var caterTime = timePieces[0];
	
	time2Pieces = caterTime.split(":");
	
	if(timePieces[1] == 'PM') {
		time2Pieces[0] = parseInt(time2Pieces) + 12;
	}
	
	var caterHour = time2Pieces[0];
	var caterMinute = time2Pieces[1];
	
	caterDate.setHours(caterHour);
	caterDate.setMinutes(caterMinute);
	
	if(currentDate.getTime() > caterDate.getTime()) {
		alert('Can\'t schedule a catering date in the past!');
		return false;
	}
	
	if((caterDate.getTime() / 1000) - (currentDate.getTime() / 1000) < 172800) {
		alert('Your order is less than 48 hours from pick-up and has not been submitted.  Please call 216-409-3517 to place your order and confirm availability.');
		return false;
	}


    var location = document.getElementById('location').value; //alert(location);
	var first = document.getElementById('first').value; //alert(first);
	var last = document.getElementById('last').value;//alert(last);
	var address = document.getElementById('address').value;//alert(address);
	var city = document.getElementById('city').value;//alert(city);
	var state = document.getElementById('state').value;//alert(state);
	var zip = document.getElementById('zip').value;//alert(zip);
	var phone = document.getElementById('phone').value;//alert(phone);
	var email = document.getElementById('email').value;//alert(email);
	var email2 = document.getElementById('email2').value;//alert(email2);
	var date = document.getElementById('date').value;//alert(date);
	var timer = document.getElementById('timer').value;//alert(timer);
	var notes = document.getElementById('notes').value;//alert(notes);
	
	
	
	
	
	if(first=='' || last=='' || address=='' || city=='' || state=='' || zip=='' || phone=='' || email=='' || email2=='' || date=='' || timer=='' || notes=='' || location=='')
	{
		alert("Please fill all fields");
		return false;
	}
	else
	{
		
		if(email!=email2 && email!='')
		{
			alert('email and email retype is same');
			return false;
		}
		else
		{
			var atpos=email.indexOf("@");
			var dotpos=email.lastIndexOf(".");
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
			{
				alert("Not a valid e-mail address");
				return false;
			}
		}
		return true;
	}
	
	
	
	
}
</script>
<section id="content-wrap">
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom.js"></script>
<script type="text/javascript">
	jQuery(function(){
		jQuery(".calculateprice").change(function(){
			var morethanfive = ['quantity011935','quantity011925','quantity011915'];
			var price = jQuery(this).data("price");
			var qty = jQuery(this).val();
			
			price = jQuery.trim(price) * 1;
			if(jQuery.trim(qty) == "")  {
				qty=0;
			} else {
				qty=jQuery.trim(qty)*1;
			}
			
			if (jQuery.inArray(jQuery(this).attr("id") , morethanfive)!= -1 && qty < 5 && qty>0) {
				alert("Please enter at least 5 quantity for this item");
				return false;
			}
			if(!isNaN((price*qty))) {
				jQuery(this).parent().parent().find(".ptot").html( "$" + (price*qty).toFixed(2));
			} else {
				jQuery(this).val("");
			}
			
			var total =0;
			jQuery(".calculateprice").each(function(){
				var price = jQuery(this).data("price");
				var qty = jQuery(this).val();
				price = jQuery.trim(price) * 1;
				qty=jQuery.trim(qty)*1;
				total += price * qty;
			});
			if(total > 0 ) {
				jQuery(".carttotalshortview").html("<h2>Order Total: $" +  total.toFixed(2) +"</h2>");
			} else {
				jQuery(".carttotalshortview").html("");
			}
		});
		jQuery(".calculateprice").change();
		
		jQuery(".confirmorder").click(function(){
			jQuery(".cartview").hide();
			jQuery(".orderform").fadeIn();			
			return false;
		});
		
		jQuery(".backtocartview").click(function(){
			jQuery(".orderform").hide();			
			jQuery(".cartview").fadeIn();
			return false;
		});
		
		jQuery(".cartcalculateprice").change(function(){
			var morethanfive = ['quantity011935','quantity011925','quantity011915'];
			var price = jQuery(this).data("price");
			var qty = jQuery(this).val();
			price = jQuery.trim(price) * 1;
			if(jQuery.trim(qty) == "")  {
				qty=0;
			} else {
				qty=jQuery.trim(qty)*1;
			}
			
			if (jQuery.inArray(jQuery(this).attr("id") , morethanfive)!= -1 && qty < 5 && qty>0) {
				alert("Please enter at least 5 quantity for this item");
				return false;
			}
			if(!isNaN((price*qty))) {
				jQuery(this).parent().parent().find(".subtot").html( "$" + (price*qty).toFixed(2));
			} else {
				jQuery(this).val("");
			}
			
			
			var total =0;
			jQuery(".cartcalculateprice").each(function(){
				var price = jQuery(this).data("price");
				var qty = jQuery(this).val();
				price = jQuery.trim(price) * 1;
				qty=jQuery.trim(qty)*1;
				total += price * qty;
			});
			if(total > 0 ) {
				jQuery(".carttotal").html("$ " +  total.toFixed(2) +"");
				jQuery(".hiddencarttotal").val(total.toFixed(2));
			} else {
				jQuery(".carttotal").html("");
				jQuery(".hiddencarttotal").val(0);
			}
			
		});
		
		
		jQuery(".updateorder").click(function(){
			jQuery(".cartcalculateprice").each(function(){
				jQuery(this).parent().find(".cartcalculatepricehidden").val(jQuery(this).val());
			});
			
		
		});
	});
</script> 

<section id="center-wrap">	
<?php 
if ($_SERVER['REQUEST_METHOD']=='POST') {	
	if(isset($_POST['carttotal']) && is_numeric($_POST['carttotal'])) {
		//Order is placed. Sent email to client.
		
		$data = array();
		if(isset($_SESSION['cart'])){
			$data= json_decode($_SESSION['cart'], true);
		}
		$cartview =(isset($_SESSION['cartview'])?$_SESSION['cartview']:array());
		
		// Create our mailer.
		$mailer = new PHPMailer();
		
		// SMTP
		$mailer->isSMTP();
		$mail->Host = 'd1.igvinc.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'mrchickc';
		$mail->Password = 'dUrS~8ha,.X0';
		
		// Email details.
		$mailer->isHTML(true);
		$mailer->Subject = 'Mr. Chicken Order : '. date("m-d-Y H:i:s");
		
		// From info.
		$mailer->From = 'catering@mrchickencater.com';
		$mailer->FromName = 'Mr. Chicken Catering';
		
		// Recipients.
		$mailer->addAddress($_POST['email']);
		$mailer->addBCC(get_option('mr_chicken_onlineorder'));
		

		// message
		$message = '
		<html>
		<head>
		<title></title>
		</head>
		<body>
		<h2>Contact Details</h2>
		<table>

		<tr><td>Name:</td><td>'.$_POST['first'].'&nbsp;'.$_POST['last'].'</td></tr>
		<tr><td>Address:</td><td>'.$_POST['address'].'</td></tr>
		<tr><td>City:</td><td>'.$_POST['city'].'</td></tr>
		<tr><td>State:</td><td>'.$_POST['state'].'</td></tr>
		<tr><td>Zip:</td><td>'.$_POST['zip'].'</td></tr>
		<tr><td>Phone:</td><td>'.$_POST['phone'].'</td></tr>
		<tr><td>Email:</td><td>'.$_POST['email'].'</td></tr>

		<tr><td>Location:</td><td>'.$_POST['location'].'</td></tr>
		<tr><td>Date:</td><td>'.$_POST['date'].'</td></tr>
		<tr><td>Time:</td><td>'.$_POST['timer'].'</td></tr>
		<tr><td>Notes:</td><td>'.$_POST['notes'].'</td></tr>
		</table>
		<p>Order Details</p>';
		
		$message .= '<table class="cartview">
		<tbody>
			<tr>
				<td>Item</td>
				<td>Price</td>
				<td>Quantity</td>
				<td>Sub Total</td>
			</tr>';
				$total = 0;
				foreach ($cartview as $k=>$v) {
					$message .= "<tr><td colspan=\"4\"><h2>". $k .'</h2></td></tr>';
					if(is_array($v)) {
						foreach($v as $k1=>$v1) {
							$message .= "<tr><td><h5>". $v1['name'] .'</h5></td>';
							$message .= '<td>$ '.$v1['price'] .'</td>';
							$qty = 0;
							if(isset($_POST['hitem'][$k1]['quantity']) && is_numeric($_POST['hitem'][$k1]['quantity'])) {
								$message .= '<td>'.$_POST['hitem'][$k1]['quantity'] .'</td>';
								$qty=$_POST['hitem'][$k1]['quantity'];
							}else {
								$message .= '<td>'.$v1['quantity'] .'</td>';
								$qty=$v1['quantity'];
							}
							$message .= '<td class="subtot">$ '.number_format($v1['price'] * $qty,2)  .'</td></tr>';
							
							
							if(count($v1) > 4) { //Combined product only
								foreach($v1 as $ck=>$cv) {
									if(is_numeric($ck) && is_numeric($cv['choice_quantity']) && (int)$cv['choice_quantity'] > 0 ){
										$message .=  "<tr><td>&nbsp;&nbsp; &raquo; ". $cv['choice_title'].'</td>';
										$message .=  '<td></td><td>'.$cv['choice_quantity'] .'</td>';
										$message .=  '<td></td></tr>';
									}
								}
							}
							
							$total += $v1['price'] * $qty;
						}
					}
				}
		
		$message .='<tr><td colspan="3" align="right"><h3>Total Amount : &nbsp;</h3>  </td> 
				<td><h3 class="carttotal"> $ '.number_format($total,2).'</h3></td></tr> 
				
				</table>
		</body>
		</html>
		';

		// Set our message.
		$mailer->Body = $message;
		
		// And off she goes.
		$mailer->send();
		
		unset($_SESSION['cart']);
		unset($_SESSION['cartview']);
		?>
			<article class="text-block inner cartviewwrapper">
<h1>Your Order</h1>
<h2>Your order has been successfully submitted.   We will be contacting you within 24 hours to confirm your order.  For orders needed in less than 24 hours, or if you have additional questions please call our Catering Hotline at 216-409-3517.  </h2>
 <div class="clear"></div>
        
    </article>
		<?php
		
		
	} else {
		$data = array();
		//print_r($_POST);
		foreach($_POST as $k =>$v) {
			if($k=="item" && is_array($v)) {
				foreach($v as $k1 =>$v1) {
					if(is_array($v1)) {
						if(trim($v1['quantity']) == "" || !is_numeric($v1['quantity'])) {
							continue;
						} else {
							$data[$k1]=$v1;
							if(!isset($cartview[$v1['title']])){
								$cartview[$v1['title']]= array();
							}
							$cartview[$v1['title']][$k1] = $v1;
						}
					}
				}
			}
		}
		if(count($data) == 0 ) {
			wp_redirect(get_permalink($thispageid));
		}
		$Json = json_encode($data);
		$_SESSION['cart'] = $Json;
		$_SESSION['cartview'] = $cartview;
	?>
	<!-- after order -->	
<article class="text-block inner cartviewwrapper">
<h1>Your Order</h1>
<form onsubmit="return orderConfirmation()" name="frmContactDetail" class="contactdetails" action="" method="post">
	
  &nbsp;<table class="cartview">
		<tbody>
			<tr class="heading">
				<td>Item</td>
				<td>Price</td>
				<td>Quantity</td>
				<td>Sub Total</td>
			</tr>
			<?php 
				$total = 0;
				foreach ($cartview as $k=>$v) {
					echo '<tr class="table"><td colspan=\"4\"><h2>'. $k .'</h2></td></tr>';
					if(is_array($v)) {
						foreach($v as $k1=>$v1) {
							echo "<tr><td><h5>". $v1['name'] .'</h5></td>';
							echo '<td>$ '.$v1['price'] .'</td>';
							if(count($v1) > 4) { //Combined product only
								echo '<td>'.$v1['quantity'] .'
								<input type="hidden" id="quantity0'. $k1. '" name="item['. $k1. '][quantity]" value="'.$v1['quantity'] .'" class="cartcalculateprice" data-price="'.$v1['price'].'" />
								<input type="hidden" id="hquantity0'. $k1. '" name="hitem['. $k1. '][quantity]" value="'.$v1['quantity'] .'" class="cartcalculatepricehidden" data-price="'.$v1['price'].'" /></td>';
							} else {
								echo '<td>
								<input type="hidden" id="hquantity0'. $k1. '" name="hitem['. $k1. '][quantity]" value="'.$v1['quantity'] .'" class="cartcalculatepricehidden" data-price="'.$v1['price'].'" />
								<input type="text" id="quantity0'. $k1. '" name="item['. $k1. '][quantity]" value="'.$v1['quantity'] .'" class="cartcalculateprice" data-price="'.$v1['price'].'" size="4"/></td>';
							}
							
							echo '<td class="subtot">$ '.number_format($v1['price'] * $v1['quantity'],2)  .'</td></tr>';
							
							if(count($v1) > 4) { //Combined product only
								foreach($v1 as $ck=>$cv) {
									if(is_numeric($ck) && is_numeric($cv['choice_quantity']) && (int)$cv['choice_quantity'] > 0 ){
										echo "<tr><td>&nbsp;&nbsp; &raquo; ". $cv['choice_title'].'</td>';
										echo '<td><a href="'.get_permalink($thispageid).'">(Edit On Menu Page)</a></td><td>'.$cv['choice_quantity'] .'</td>';
										echo '<td></td></tr>';
									}
								}
							}
						
							$total += $v1['price'] * $v1['quantity'] ;
						}
					}
				}
			?>
			
			<?php 
			
			$tot= ($total + );
			$delcharge =  $tot*10/100;
			$totalp = $tot + $delcharge;
			?>
			<tr class="total"><td colspan="3" align="right"><h3>Delevery Charge : &nbsp;</h3>  </td> 
				<td><h3 class="carttotal"> $ <?php echo ($delcharge); ?></h3></td></tr> 
			<tr class="total"><td colspan="3" align="right"><h3>Total Amount : &nbsp;</h3>  </td> 
				<td><h3 class="carttotal"> $ <?php echo $totalp//number_format($total,2);?></h3></td></tr> 
				<input type="hidden" name="carttotal" value="<?php echo number_format($total,2); ?>" class="hiddencarttotal"/>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr class="conform">
	 <td><a href="<?php echo get_permalink($thispageid); ?>" class="submitbtn">Change Order</a></td>
    <td><a href="#" class="updateorder submitbtn">Update Order</a></td>
   	<td><a class="confirmorder submitbtn" href="#confirm">Continue</a></td>

  </tr>
 </tbody> 
</table>  


<p style="display:none;" class="text orderform"><span style="font-weight:bold;">When would you like your order ready by?</span><i> Note: Orders less than 48 hours please call our number to confirm we can have it prepared in time. </i><br>216-409-3517</p>
    
    <table style="display:none;" class="orderform">
    <tbody><tr>
    <td class="formrt">Date:</td>
    <td><input type="text" id="date" value="" class="" name="date"></td>
    </tr>
    <tr>
    <td class="formrt">Time: </td>
    <td>	<select style="padding: 2px; width: 150px;;" name="timer" id="timer">
       <?php
		$Time = '08:00:00';
		$TimeLength = 15;
			for($t=0; $t<=95; $t++){
				$timestamp = strtotime("$Time");
				$etime = strtotime("+$TimeLength minutes", $timestamp);
				$Time = date('h:i A', $etime);
				echo '<option value="'.$Time.'">'.$Time.'</option>';
			}
		?>
									
                                </select></td>
    </tr>
    	
    <tr>
    <td valign="top" class="formrt">Special Notes:</td>
    <td><textarea id="notes" name="notes"></textarea></td>
    </tr>
    </tbody></table>

<table style="display:none;" class="orderform">
    <tbody><tr>
    <td colspan="2"></td>
    </tr>
    <tr>
         <td class="format">Location:</td>
         <td> <select name="location" id="location">
         	<option value=""> --- select location for order --</option>
			<option value="Ashtabula">Ashtabula – 1746 West Prospect Rd</option>
			<option value="MapleHeights">Maple Heights – 5424 Northfield Rd</option>
			<option value="Northfield">Northfield Village – 10710 Northfield Rd</option>
			<option value="Painesville">Painesville – 1188 Mentor Ave</option>
			<option value="Parma–PleasantValley">Parma – 1150 W. Pleasant Valley Rd</option>
			<option value="Parma–Snow">Parma – 11680 Snow Road </option>
			<option value="Parma–Pearl">Parma – 5451 Pearl Road </option>
			<option value="Solon">Solon – 6382 SOM Center Rd</option>
			<option value="Twinsburg">Twinsburg – 9010 Darrow Rd</option>
			<option value="Willoughby">Willoughby – 35901 Euclid Ave</option> 
		</td>
	</tr>
    <tr>
    <td class="formrt">First Name</td>
    <td><input type="text" value="" id="first" name="first"></td>
    </tr>
    <tr>
    <td class="formrt">Last Name</td>
    <td><input type="text" value="" id="last" name="last"></td>
    </tr>
    <tr>
    <td class="formrt">Address</td>
    <td><input type="text" value="" id="address" name="address"></td>
    </tr>
    <tr>
    <td class="formrt">City</td>
    <td><input type="text" value="" id="city" name="city"></td>
    </tr>
    <tr>
    <td class="formrt">State</td>
    <td><input type="text" value="" id="state" name="state"></td>
    </tr>
    <tr>
    <td class="formrt">Zipcode</td>
    <td><input type="text" value="" id="zip" name="zip"></td>
    </tr>
    <tr>
    <td class="formrt">Phone</td>
    <td><input type="text" value="" id="phone" name="phone"></td>
    </tr>
    <tr>
    <td class="formrt">Email</td>
    <td><input type="text" value="" id="email" name="email"></td>
    </tr>
    <tr>
    <td class="formrt">Retype Email</td>
    <td><input type="text" value="" id="email2" name="email2"></td>
    </tr>
    <tr>
    <td colspan="2">	
		<input type="submit" value="Confirm Order" name="frmConfirmOrder">	<div style="text-align:left"><a class="backtocartview" href="#cartview">View Order</a></div>    
    </td>
    </tr>
    </tbody></table>	
  
</form>


        <div class="clear"></div>
        
    </article>
	<?php } //Cart View ends. ?>
<?php } else { 
	$data = array();
if(isset($_SESSION['cart'])){
	$data= json_decode($_SESSION['cart'], true);
}

?>	
	<!-- end afer order -->	
	<form action="" name="frmOrder" id="menuform" method="post">
        <!-- begin sandwich block -->
		
		<div class="clear"></div>
	<?php for($i=1; $i<=2; $i++){  ?>
		<script type="text/javascript">
			$(document).ready(function() {
			//Default Action
				$(".tab_content<?php echo $i;?>").hide(); //Hide all content
				$("ul.tabs<?php echo $i;?> li:first").addClass("active").show(); //Activate first tab
				$(".tab_content<?php echo $i;?>:first").show(); //Show first tab content
				
				//On Click Event
				$("ul.tabs<?php echo $i;?> li").click(function() {
					$("ul.tabs<?php echo $i;?> li").removeClass("active"); //Remove any "active" class
					$(this).addClass("active"); //Add "active" class to selected tab
					$(".tab_content<?php echo $i;?>").hide(); //Hide all tab content
					var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
					$(activeTab).fadeIn(); //Fade in the active content
					<?php
						if($i === 1) {
								echo 'window.scrollTo(0, 0);';
						}
					?>
					return false;
				});
			});
		</script>
        <!-- begin sandwich block -->
        <article class="sandwich-block  <?php echo (($i==2)?'ordersand':''); ?>">
        <div class="centering">
		
			<aside class="link" style="">

                <ul class="tabs<?php echo $i;?>">
					<?php query_posts('post_type=onlineorder&showposts=100&meta_key=group_selection&meta_value=Group'.$i.'&orderby=date&order=ASC'); ?>
					<?php 
                    $counter=1;
                    while (have_posts()) : the_post(); ?>
                    <li><a href="#<?php echo (($i==1)?'tabber':'tab').$counter ?>"><?php the_title(); ?></a></li>
                    <?php if($counter==10){$counter=1;}else {$counter++; }endwhile; wp_reset_query(); ?>
                </ul>

            </aside>
		
			<?php if($i==1){ ?>
				 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="post" id="post-<?php the_ID(); ?>">    
                    
                
				
				
				
                <div class="entry">
                    <?php the_content('<p class="serif">' . __('Read the rest of this page &raquo;', 'kubrick') . '</p>'); ?>    
                    <?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'kubrick') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>    
                </div>
            </div>
            <?php endwhile; endif; ?> 
			
			<?php } ?>
			
			
			<?php query_posts('post_type=onlineorder&showposts=100&meta_key=group_selection&meta_value=Group'.$i.'&orderby=date&order=ASC'); ?>
            <?php 
            $counter=1;
            while (have_posts()) : the_post(); ?>
        	<div id="<?php echo (($i==1)?'tabber':'tab').$counter ?>" class="tab_content<?php echo $i;?> details">				
                <div class="thumb"> 
                <h2><?php the_title(); ?></h2>               	
                    <?php if ( has_post_thumbnail() ) { ?>
            		<?php the_post_thumbnail('full', array('width' => 454)); ?>
					<?php } else { ?>
                    &nbsp;
                    <?php } ?>                    
                </div>                
                <aside class="list list1">
                    <div class="order">                    
                    	                    
						<?php if(get_field('combined_package')): ?>
                        <ul> 
                        <?php 
                        $counted = 1;
                        while(has_sub_field('combined_package')): ?>
                        <?php 
                        $final3 = get_the_ID(); 
                        $final3.=$counted; 
                        ?>
                        <li>
                        <?php 
                        $title=get_sub_field('package_title'); 
							if(($title)!="") { ?>
								<h4><?php the_sub_field('package_title'); ?> <span>$<?php $PackagePrice = get_sub_field('package_price'); the_sub_field('package_price'); ?></span></h4>
							<?php } ?>
                        <p>
							
                            <span class="ptot"> $0.00</span>
                            <span class="right">
							<input name="item[<?php echo $final3; ?>][quantity]" id="quantity<?php echo $final3;?>" value="<?php echo (isset($data[$final3]['quantity'])?$data[$final3]['quantity']:""); ?>" data-relparent="<?php echo $final3; ?>"
							data-dish3="<?php the_sub_field('3lb_side_dishes'); ?>" 
							data-dish5="<?php the_sub_field('5lb_side_dishes'); ?>" 
							data-dish10="<?php the_sub_field('10lb_side_dishes'); ?>" 
							data-type="combined" type="text" data-price="<?php the_sub_field('package_price'); ?>" class="calculateprice"  /> Qty.</span>
                            <?php $subtitle=get_sub_field('package_name'); if(($subtitle)!="") { ?><?php the_sub_field('package_name'); ?> $<?php the_sub_field('package_price'); ?><?php } ?>                         
							<input name="item[<?php echo $final3; ?>][title]" type="hidden" value="<?php the_title(); ?>" >
							<input name="item[<?php echo $final3; ?>][price]" type="hidden" value="<?php echo $PackagePrice; ?>">
                            <input name="item[<?php echo $final3; ?>][name]" type="hidden" value="<?php echo $title; ?>" >
							
						</p>
                        <?php if(get_sub_field('package_include')): ?>	
                        <ul>
                        <?php 
                        while(has_sub_field('package_include')): ?>
							<li>
								<?php the_sub_field('list'); ?>
							</li>
                        <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>
                        <?php if(get_sub_field('side_dishes')): ?>	
                        <ul>
                        <?php 
                        $counted1 = 1;
                        while(has_sub_field('side_dishes')): ?>
                        <?php 
                        $final2 = get_the_ID(); 
                        $final2.=$counted; 
                        $final2.=$counted1; 
                        ?>
							<li>
								<input name="item[<?php echo $final3; ?>][<?php echo $final2; ?>][choice_quantity]" id="quantity0<?php echo $final2; ?>"
									value="<?php echo (isset($data[$final3][$final2]['choice_quantity'])?$data[$final3][$final2]['choice_quantity']:""); ?>"
									type="text" data-rel="<?php echo $final3; ?>"
									data-title="<?php the_sub_field('side_dishes_title'); ?>" 
									class="my<?php echo $final3; ?>"
									/>
								<input name="item[<?php echo $final3; ?>][<?php echo $final2; ?>][choice_title]" type="hidden" value="<?php the_sub_field('side_dishes_title'); ?>">
								<?php the_sub_field('side_dishes_title'); ?>
							</li>
                        <?php $counted1++; endwhile; ?>
                        </ul>
                        <?php endif; ?>
                        </li>
                        <?php $counted++; endwhile; ?>
                        </ul>
                        <?php endif; ?>
                        
                        <input type="submit" class="submitbtn" name="btnSubmit" value="Checkout" onclick="return bis()" />
                    
                    
						<?php if(get_field('product')): ?>
                        <ul>
                        <?php 
                        $count=1;
                        while(has_sub_field('product')): ?>
                        <li>
                        <?php $title=get_sub_field('product_name'); if(($title)!="") { ?><h4><?php the_sub_field('product_name'); ?></h4><?php } ?>
                        <?php if(get_sub_field('price_and_quantity')): ?>	
                        <ul>
                        <span class="total">Total</span>
                        <?php 
                        $count1=1;
                        while(has_sub_field('price_and_quantity')): ?>
                        <?php 
                        $final = get_the_ID(); 
                        $final.= $count; 
                        $final.= $count1; 
                        ?>
                        <li>
                            <span class="left">
                                <?php the_sub_field('product_quantity'); ?> $<?php the_sub_field('product_price'); ?>
                            </span>
                            <span class="ptot"> $0.00</span>
                            <span class="right">
								<input name="item[<?php echo $final; ?>][title]" type="hidden" value="<?php the_title(); ?>" >
								<input name="item[<?php echo $final; ?>][price]" type="hidden" value="<?php the_sub_field('product_price'); ?>" >
                                <input name="item[<?php echo $final; ?>][quantity]" id="quantity0<?php echo $final; ?>" value="<?php echo (isset($data[$final]['quantity'])?$data[$final]['quantity']:""); ?>" type="text" data-type="product" data-price="<?php the_sub_field('product_price'); ?>" class="calculateprice"  /> Qty.
								<input name="item[<?php echo $final; ?>][name]" type="hidden" value="<?php echo $title; ?> <?php the_sub_field('product_quantity'); ?>" >
						   </span>    
                        </li>
                        <?php $count1++; endwhile; ?>
                        </ul>
                        <?php endif; ?>
                        </li>
                        <?php $count++; endwhile; ?>
                        </ul>
                        <?php endif; ?>
                    
						<?php if(get_field('dishes')): ?>
                        <ul>
                        <?php 
                        $dishcount=1;
                        while(has_sub_field('dishes')): ?>
                        <li>
                        <?php $title=get_sub_field('dishes_name'); if(($title)!="") { ?><h4><?php the_sub_field('dishes_name'); ?> $<?php $DishPrice = get_sub_field('dishes_price'); the_sub_field('dishes_price'); ?></h4><?php } ?>
                        <?php if(get_sub_field('dishes_title')): ?>	
                        <ul>
                        <span class="total">Total</span>	
                        <?php 
                        $dishcount1=1;
                        while(has_sub_field('dishes_title')): ?>
                        <?php 
                        $final1 = get_the_ID(); 
                        $final1.= $dishcount; 
                        $final1.= $dishcount1; 
                        ?>
                        <li>
                            <span class="left">
                                <?php the_sub_field('dish'); ?>
                            </span>
                            <span class="ptot"> $0.00</span>
                            <span class="right">
								<input name="item[<?php echo $final1; ?>][title]" type="hidden" value="<?php the_title(); ?>" >
								<input name="item[<?php echo $final1; ?>][price]" type="hidden" value="<?php echo $DishPrice; ?>" >
								<input name="item[<?php echo $final1; ?>][name]" type="hidden" value="<?php echo $title; ?> <?php the_sub_field('dish'); ?>" >						  
                                <input name="item[<?php echo $final1; ?>][quantity]" id="quantity0<?php echo $final1; ?>" value="<?php echo (isset($data[$final1]['quantity'])?$data[$final1]['quantity']:""); ?>" type="text" data-type="dish" data-price="<?php echo $DishPrice; ?>" class="calculateprice"  /> Qty.
                            </span>    
                        </li>
                        <?php $dishcount1++; endwhile; ?>
                        </ul>
                        <?php endif; ?>
                        </li>
                        <?php $dishcount++; endwhile; ?>
                        </ul>
                        <?php endif; ?>
                    
                    </div>

                </aside>

            	<div class="clear"></div>

            </div>
            <?php if($counter==10){$counter=1;}else {$counter++; }endwhile; wp_reset_query(); ?>

            
            </div>
            <div class="clear"></div>

        </article>
        <!-- finish sandwich block -->
	<?php } ?>
	
      <!--  <input type="hidden" name="hdnCheck" value="checked" />
		
        <input type="submit" class="submitbtn" name="btnSubmit" value="Checkout"  onclick="return bis()" />-->
            
        <div class="clear"></div>
		</form>    
<?php } ?>	
	</section>
	
</section>
<!-- finish content -->
<script type="text/javascript">
	jQuery(function($){
    $('#date').datepick();
});
</script>
 <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/jquery.datepick.css">
<?php get_footer(); ?>