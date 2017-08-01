<?php ob_start(); ?>

<style type="text/css">

.nextInven{ background:#FF0000!important}

</style>

<?php error_reporting(0);



global $wpdb,$user,$siteurl;



if(isset($Bid) && $Bid!='')

{

	$_GET['edit']=$Bid;

}

if ( get_option('permalink_structure') ) 

{ 

	define(HTACCESS,'ON'); 

	$mainPath=get_site_url().'/';

}

else

{

	define(HTACCESS,'OFF');

	$mainPath=get_permalink();

}

?>





<link href="<?php echo plugins_url('css/biMainCss.css', __FILE__);?>" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('css/jquery.ad-gallery.css', __FILE__);?>">

<?php require("HtAccessURL.php");

$table_prefix=$wpdb->prefix;

$current_user = wp_get_current_user();

$role=$current_user->roles[0];

$current_user_id=$current_user->ID;

/* ------------------- state csv upload------------------- */

/*function selfURL() { $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; } function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }

*/

$title='Boats Listing';

$results_per_page=12;

//$thispage=selfURL();

function currency($from_Currency, $to_Currency, $amount) {

 

        $amount = urlencode($amount);

        $from_Currency = urlencode($from_Currency);

        $to_Currency = urlencode($to_Currency);

        $url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";

        $ch = curl_init();

        $timeout = 0;

        curl_setopt ($ch, CURLOPT_URL, $url);

        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");

        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $rawdata = curl_exec($ch);

        curl_close($ch);

       

        $data = explode('bld>', $rawdata);

        $data = explode($to_Currency, $data[1]);

 

        return round($data[0], 2);

		}	

	

?>	

<script type="text/javascript" src="<?php echo plugins_url('js/jquery.min.js', __FILE__);?>"></script>

<script type="text/javascript" src="<?php echo plugins_url('js/jquery.ad-gallery.js', __FILE__);?>"></script>

<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>

<script type="text/javascript">

function goTo(page) { 

	/*var url="index.php";

	hu=window.location.search.substring(1);

	query=hu.replace(/page=[0-9][0-9]/g,"");

	query=query.replace(/page=[0-9]/g,"");

    url=url+"?page="+page+"&"+query;

    url=url.replace(/&&/g,'&');

	document.location.href = url;

	return false;*/

	document.getElementById('noPage').value=page;

	document.getElementById('frmNoPage').submit();

	

}

function sortBy(value)

 {

	document.getElementById('frmNoPage').submit();

 }

$(document).ready(function() {

	$("#liTab li").click(function() {

	  $("#liTab li").removeClass('selected');

	  $(this).addClass('selected');

	  if($(this).attr("id")=='LiThree')

	  {

	  	$("#tabLiOne").css('display','none');

		$("#tabLiTwo").css('display','none');

		$("#tabLiThree").css('display','');

	  }

	  else if($(this).attr("id")=='LiTwo')

	  {

	  	$("#tabLiOne").css('display','none');

		$("#tabLiTwo").css('display','');

		$("#tabLiThree").css('display','none');

	  }

	  else

	  {

	  	$("#tabLiOne").css('display','');

		$("#tabLiTwo").css('display','none');

		$("#tabLiThree").css('display','none');

	  }

	});

});

$(document).ready(function() {

       // var cont_left = $("#container").position().left;

        $(".center img").hover(function() {

            // hover in

			var path=$(this).parent('li').attr('defaultSrc');

			var defaultPath=$(this).parent().parent().parent().siblings('.left').children("a").children("img").attr("src");

			$(this).parent().parent().parent().siblings('.left').children("a").children("img").attr("src", path);

			$(this).parent().parent().parent().siblings('.left').children("a").children("img").attr("defaultSrc", defaultPath);

          

        }, function(defaultPath) {

		var Path=$(this).parent().parent().parent().siblings('.left').children("a").children("img").attr("defaultSrc");

		$(this).parent().parent().parent().siblings('.left').children("a").children("img").attr("src", Path);

		$(this).parent().parent().parent().siblings('.left').children("a").children("img").removeAttr("defaultSrc");

          

        });

        

       

    });

</script>

<script type="text/javascript">

$(document).ready(function(){

	

	//how much items per page to show

	var show_per_page = 12 // get Limit  

	//getting the amount of elements inside content div

	var number_of_items = $('#boat-content').children().size();

	//calculate the number of pages we are going to have

	var number_of_pages = Math.ceil(number_of_items/show_per_page);

	

	//set the value of our hidden input fields

	$('#current_boat_page').val(0);

	$('#show_per_page').val(show_per_page);

	$('#number_of_page').val(number_of_pages);

	//now when we got all we need for the navigation let's make it '

	

	/* 

	what are we going to have in the navigation?

		- link to previous page

		- links to specific pages

		- link to next page

	*/

	var navigation_html = '<a class="nextPreviousPaginationPrev" href="javascript:previous();">Prev</a>';

	var current_link = 0; 

	var i=1;

	while(number_of_pages > current_link){

		if(current_link > 10)

		  { if(i==1) navigation_html += '<a class="nextPreviousPagination">...&nbsp;&nbsp;</a>'; i++;  }

	    else if(current_link == 10)

		  navigation_html += '<a class="nextPreviousPagination lst" href="javascript:nextPaging('+number_of_pages+','+current_link+');" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';

		  

		 else

		navigation_html += '<a class="nextPreviousPagination" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';

		 

		current_link++;

	}

	navigation_html += '<a class="nextPreviousPaginationNext" href="javascript:next();">Next</a>';

	

	$('.page_navigation').html(navigation_html);

	

	//add active_page class to the first page link

	$('.page_navigation .nextPreviousPagination:first').addClass('nextPreviousPaginationActive');

	

	//hide all the elements inside content div

	$('#boat-content').children().css('display', 'none');

	

	//and show the first n (show_per_page) elements

	$('#boat-content').children().slice(0, show_per_page).css('display', 'block');

	

});

function previous(){

	

	new_page = parseInt($('#current_boat_page').val()) - 1;

	//if there is an item before the current active link run the function

	if($('.nextPreviousPaginationActive').prev('a.nextPreviousPagination').length > 0){

	 if($('.nextPreviousPaginationActive').prev('a.prv').length > 0)	

		{ total_pages=$('#number_of_page').val(); prevPaging(total_pages,new_page); }

	 else go_to_page(new_page);

	}

	

}



function next(){

	new_page = parseInt($('#current_boat_page').val()) + 1;

	//if there is an item after the current active link run the function

	if($('.nextPreviousPaginationActive').next('a.nextPreviousPagination').length > 0){

	    if($('.nextPreviousPaginationActive').next('a.lst').length > 0)	

		{ total_pages=$('#number_of_page').val(); nextPaging(total_pages,new_page); }

		else go_to_page(new_page);

	}

	

}

function nextPaging(number_of_pages,current_link)

{

	    var new_page=current_link;

		var navigation_html = '<a class="nextPreviousPaginationPrev" href="javascript:previous();">Prev</a>';

		var i=1;

		var x=current_link+10; 

		

		while(number_of_pages > current_link){

		if(current_link > x)

		  { if(i==1) navigation_html += '<a class="nextPreviousPagination">...&nbsp;&nbsp;</a>'; i++;  }

	    else if(current_link == x && current_link !=(number_of_pages-1))

		  navigation_html += '<a class="nextPreviousPagination lst" href="javascript:nextPaging('+number_of_pages+','+current_link+');" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';

		else if(current_link == new_page)

		  navigation_html += '<a class="nextPreviousPagination prv" href="javascript:prevPaging('+number_of_pages+','+current_link+');" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';  

		 else

		 {

		 navigation_html += '<a class="nextPreviousPagination" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';

		 }

			current_link++;

		}

		navigation_html += '<a class="nextPreviousPaginationNext" href="javascript:next();">Next</a>';

		

		$('.page_navigation').html(navigation_html);

		

		//add active_page class to the first page link

		$('.page_navigation .nextPreviousPagination:first').addClass('nextPreviousPaginationActive');

		

		go_to_page(new_page); //Send 

			

}



function prevPaging(number_of_pages,current_link)

{

	    var new_page=current_link;

		var navigation_html = '<a class="nextPreviousPaginationPrev" href="javascript:previous();">Prev</a>';

		var i=1;

		var n_current_link=current_link-10; 

		var x=n_current_link+10; 

		if(x > number_of_pages) var j=1;

		while(number_of_pages > n_current_link){

		if(n_current_link > x)

		  { if(i==1) navigation_html += '<a class="nextPreviousPagination">...&nbsp;&nbsp;</a>'; i++;  }

	    else if(n_current_link == x && n_current_link !=(number_of_pages-1)) 

		  navigation_html += '<a class="nextPreviousPagination lst" href="javascript:nextPaging('+number_of_pages+','+n_current_link+');" longdesc="' + n_current_link +'">'+ (n_current_link + 1) +'</a>';

		else if((n_current_link == (new_page-10)) & (new_page-10)!=0)

		  navigation_html += '<a class="nextPreviousPagination prv" href="javascript:prevPaging('+number_of_pages+','+n_current_link+');" longdesc="' + n_current_link +'">'+ (n_current_link + 1) +'</a>';  

		 else

		 {

		 if(j==1) { navigation_html += '<a class="nextPreviousPagination">...&nbsp;&nbsp;</a>'; j++; }

		 navigation_html += '<a class="nextPreviousPagination" href="javascript:go_to_page(' + n_current_link +')" longdesc="' + n_current_link +'">'+ (n_current_link + 1) +'</a>';

		 }

			n_current_link++;

		}

		navigation_html += '<a class="nextPreviousPaginationNext" href="javascript:next();">Next</a>';

		

		$('.page_navigation').html(navigation_html);

		

		//add active_page class to the first page link

		$('.page_navigation .nextPreviousPagination:first').addClass('nextPreviousPaginationActive');

		

		go_to_page(new_page); //Send 

			

}



function go_to_page(page_num){ 

	//get the number of items shown per page

	var show_per_page = parseInt($('#show_per_page').val());

	

	//get the element number where to start the slice from

	start_from = page_num * show_per_page;

	

	//get the element number where to end the slice

	end_on = start_from + show_per_page;

	

	//hide all children elements of content div, get specific items and show them

	$('#boat-content').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');

	

	/*get the page link that has longdesc attribute of the current page and add active_page class to it

	and remove that class from previously active page link*/

	$('.nextPreviousPagination[longdesc=' + page_num +']').addClass('nextPreviousPaginationActive').siblings('.nextPreviousPaginationActive').removeClass('nextPreviousPaginationActive');

	//$('.nextPreviousPagination[longdesc=' + page_num +']').html('['+ page_num+1 +']');

	//update the current page input field

	$('#current_boat_page').val(page_num);

}

  

</script>

<script>



	$(document).ready(function(e) {

       $('.click li.list').click(function(e) {

       	

		$('#boat-content').addClass('data');

		 

       });

	    $('.click li.grid').click(function(e) {

       	

		$('#boat-content').removeClass('data');

		 

       });

    });



</script>



<?php if($_GET['edit'])

{

	$boatid=$_GET['edit'];

?>





<script type="text/javascript">

  $(function() { 

  

    var galleries = $('.ad-gallery').adGallery({

	slideshow: {

    enable: true,

    autostart: true,

    speed: 5000,

    start_label: 'Start',

    stop_label: 'Stop',

    // Should the slideshow stop if the user scrolls the thumb list?

    stop_on_scroll: true, 

    // Wrap around the countdown

    countdown_prefix: '(', 

    countdown_sufix: ')',

    onStart: function() {

      // Do something wild when the slideshow starts

    },

    onStop: function() {

      // Do something wild when the slideshow stops

    }

  }

	});

    $('#switch-effect').change(

      function() {

        galleries[0].settings.effect = $(this).val();

        return false;

      }

    );

    $('#toggle-slideshow').click(

      function() {

        galleries[0].slideshow.toggle();

        return false;

      }

    );

    $('#toggle-description').click(

      function() {

        if(!galleries[0].settings.description_wrapper) {

          galleries[0].settings.description_wrapper = $('#descriptions');

        } else {

          galleries[0].settings.description_wrapper = false;

        }

        return false;

      }

    );

  });

</script>

<?php

$id =$_GET['edit'];

$Query = "SELECT * FROM `".$table_prefix."bv_boatdetails` WHERE BoatID = $id";

$singleboat = mysql_query($Query); 

$boat = @mysql_fetch_array($singleboat);



//Get Engine Details from Database

$Query = "SELECT * FROM `".$table_prefix."bv_engines` WHERE BoatID=$id";

$enginedata = mysql_query($Query); 

$engine = @mysql_fetch_array($enginedata);



//Get Video Details from Database

$Query = "SELECT * FROM `".$table_prefix."bv_videos` WHERE BoatID=$id";

$videodata = mysql_query($Query); 

$video = @mysql_fetch_array($videodata);



//Replace incorrect YouTube URLs to ensure that they play correctly

$video['VideoURL']=str_replace("/watch?v=","/v/",$video['VideoURL']);

$video['VideoURL']=str_replace("youtu.be/","www.youtube.com/v/",$video['VideoURL']);



$vedioExplode=explode('vidbrochure.com',$video['VideoURL']);

if($vedioExplode[1] &&($vedioExplode[1]!=''))

{ 

	$vedioExplode1=explode('bid=',$vedioExplode[1]);

	$vedioExplode2=explode('&',$vedioExplode1[1]);

	$video['VideoURL']=$vedioExplode2[0];

}else{$video['VideoURL']='';}



?>



<?php 

//Convert common currencies from codes to symbols

$boat['PriceCurrency']=str_replace("GBP","&pound;",$boat['PriceCurrency']);

$boat['PriceCurrency']=str_replace("USD","&#36",$boat['PriceCurrency']);

$boat['PriceCurrency']=str_replace("EUR","&euro;",$boat['PriceCurrency']);

$boat['Price'] = number_format($boat['Price']);

if ($boat['TaxStatus'] == "Not Paid"){

	if($boat['DispalyStatus']!='true')

	{

		$boat['Price'] .= " ex Vat";

	}

} else if ($boat['TaxStatus'] == "Paid"){

	if($boat['DispalyStatus']!='true')

	{

		$boat['Price'] .= " inc Vat";

	}

}



//Correct spellings and switch American spellings to UK

$boat['HullMaterial']=str_replace("Fiberglass","GRP",$boat['HullMaterial']);

$boat['LengthUnit']=str_replace("meter","metres",$boat['LengthUnit']);	

$boat['BeamUnit']=str_replace("meter","metres",$boat['BeamUnit']);	

$boat['DisplacementUnit']=str_replace("kilogram","kilograms",$boat['DisplacementUnit']);

$boat['DisplacementUnit']=str_replace("pound","lbs",$boat['DisplacementUnit']);	

$boat['MinDraftUnit']=str_replace("meter","metres",$boat['MinDraftUnit']);

$boat['MaxDraftUnit']=str_replace("meter","metres",$boat['MaxDraftUnit']);

$boat['BallastUnit']=str_replace("kilogram","kilograms",$boat['BallastUnit']);

$boat['BallastUnit']=str_replace("pound","lbs",$boat['BallastUnit']);	

$engine['EngineFuel']=str_replace("diesel","Diesel",$engine['EngineFuel']);

$engine['EngineFuel']=str_replace("petrol","Petrol",$engine['EngineFuel']);

$boat['FuelTankCapUnit']=str_replace("gallon","gallons",$boat['FuelTankCapUnit']);

$boat['FuelTankCapUnit']=str_replace("liter","litres",$boat['FuelTankCapUnit']);	

$boat['WaterTankCapUnit']=str_replace("gallon","gallons",$boat['WaterTankCapUnit']);

$boat['WaterTankCapUnit']=str_replace("liter","litres",$boat['WaterTankCapUnit']);	

$boat['HoldingTankCapUnit']=str_replace("gallon","gallons",$boat['HoldingTankCapUnit']);

$boat['HoldingTankCapUnit']=str_replace("liter","litres",$boat['HoldingTankCapUnit']);					

function convert_feet($measurement)

{

	$feet = (int)$measurement;

	$inches = $measurement - $feet;

	$inches = $inches * 12;

	$inches = round($inches);

	$measurement = $feet . "' " . $inches . "\"";

	return $measurement;

}

//Convert measurements in feet to display correctly

if ($boat['LengthUnit'] == "feet"){ 

	$result = convert_feet($boat['Length']);

	$boat['Length'] = $result;

} else {

	$boat['Length'] .= $boat['LengthUnit'];

}

if ($boat['BeamUnit'] == "feet"){ 

	$result = convert_feet($boat['Beam']);

	$boat['Beam'] = $result;

} else {

	$boat['Beam'] .= $boat['BeamUnit'];

}

if ($boat['MinDraftUnit'] == "feet"){ 

	$result = convert_feet($boat['MinDraft']);

	$boat['MinDraft'] = $result;

} else {

	$boat['MinDraft'] .= $boat['MinDraftUnit'];

}

if ($boat['MaxDraftUnit'] == "feet"){ 

	$result = convert_feet($boat['MaxDraft']);

	$boat['MaxDraft'] = $result;

} else {

	$boat['MaxDraft'] .= $boat['MaxDraftUnit'];

}



?>

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="50" height="50" id="FlashID" title="sdfsdf" style="display:none">

  <param name="movie" value="Slicing template/stylesheets/sdfsdf" />

  <param name="quality" value="high" />

  <param name="wmode" value="opaque" />

  <param name="swfversion" value="6.0.65.0" />

  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->

  <param name="expressinstall" value="Scripts/expressInstall.swf" />

  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->

  <!--[if !IE]>-->

  <object type="application/x-shockwave-flash" data="Slicing template/stylesheets/sdfsdf" width="50" height="50">

    <!--<![endif]-->

    <param name="quality" value="high" />

    <param name="wmode" value="opaque" />

    <param name="swfversion" value="6.0.65.0" />

    <param name="expressinstall" value="Scripts/expressInstall.swf" />

    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->

    <!--[if !IE]>-->

  </object>

  <!--<![endif]-->

</object>

<script type="text/javascript">

$(document).ready(function() {

	$("#input_7_4").val('<?php echo $boat['BoatID'] . " - " . $boat['Make'] . " " . $boat['Model']." ".$boat["Year"]."-".$boat['stockNo']; ?>');

	

	});

</script>

<div id="wrapper">

	

	<!--  / layout \ -->

	<div id="layout">



		<!--  / banner \ -->

		<div id="banner">

        	

			<!--  / banner bar \ -->

			<div class="bannerBar">

            	

                <div class="head">

                	

                    <h1><?php echo $boat["Year"];?> <?php echo $boat["Make"];?> <span><?php echo $boat["Model"];?></span>

					<span class="stockNoHead">Stock Number:&nbsp;&nbsp;<?php echo $boat["stockNo"];?></span>

					<!-- Lockerz Share BEGIN -->

					<div class="a2a_kit a2a_default_style">

					<a class="a2a_dd" href="http://www.addtoany.com/share_save" style="font-size:10px">Share</a>

					<span class="a2a_divider"></span>

					<a class="a2a_button_facebook"></a>

					<a class="a2a_button_twitter"></a>

					<a class="a2a_button_email"></a>

					<a class="a2a_button_digg"></a>

					<a class="a2a_button_delicious"></a>

					</div>

					<script type="text/javascript" src="http://static.addtoany.com/menu/page.js"></script>

					<!-- Lockerz Share END -->

					</h1>

                    

                    <h2><?php echo '1-877-889-2628';//echo $boat["BrokerTel"];?> <a href="#LiOne">Contact</a></h2>

                    

                </div>

            	<div id="gallery" class="ad-gallery">

                <div class="left">

                  <div class="ad-image-wrapper">

                      </div>

                    <?php 

                    $Query = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id";

                    $imagedata = mysql_query($Query); ?>

				</div>

                

                <div class="right">

                	

                    <span class="price">

					<?php 

					if($boat['Status']=="Sale Pending") //If Boat status is Sale pending

					  echo "Sale Pending";

					else

					{ 

					 if ($boat['DispalyStatus'] != "true" && $boat['Price']>0){ echo $boat['PriceCurrency']; ?> <?php echo $boat['Price']; 

								} else { echo "Contact us for price"; }

					}

					?>[gravityform id="5" title="false" description="false"]</span>

								<?php if(function_exists('the_ratings')) { the_ratings(); } ?>

		<div class="clear"></div>

		<span class="stockNo">Length:&nbsp;&nbsp;<?php echo $boat['Length']; ?></span>

		<div class="clear"></div>

		<span class="stockNo">Beam:&nbsp;&nbsp;<?php if ($boat['Beam'] != "0"){ echo $boat['Beam']; } ?></span>

		<div class="clear"></div>

		<span class="stockNo">Draft:&nbsp;&nbsp;<?php echo $boat['MaxDraft'];?> <?php echo $boat['MaxDraftUnit'];?></span>

		<div class="clear"></div>

		<span class="stockNo">Weight:&nbsp;&nbsp;<?php echo $boat['DryWeight'];?> <?php echo $boat['DryWeightUnit'];?></span>	

		<div class="clear"></div>

		<span class="stockNo">Fuel Capacity:&nbsp;&nbsp;<?php echo $boat['FuelTankCap'];?> <?php echo $boat['FuelTankCapUnit'];?></span>

		<div class="clear"></div>

		<span class="stockNo">Seating Capacity:&nbsp;&nbsp;<?php echo $boat['seatingCapacity'];?></span>			

                    

                    <address>

                        Dealer Info:

                        <?php echo '<br>'.$boat["Company"].'<br>'.$boat["OfficeID"].'&nbsp;'.$boat["BrokerName"].'<br>'.$boat["LocationCity"].','.$boat["LocationState"].'&nbsp;'.$boat["LocationCountry"].'<br>'.$boat["BrokerTel"];?>

                        <br />

                        <!--<span>Actual Location: Lake Lanier - Buford, GA</span>-->

                    </address>

                

                </div>

                

                <div class="clear"></div>

                

                <div class="galley">

                	

                    <div class="ad-nav">

                    <div class="ad-thumbs">

                    <ul class="ad-thumb-list">

                    <?php  $coutImgtag=0;

						while($image = mysql_fetch_array($imagedata)) {?>

                    	<li><a href="<?php echo $image['ImageURL']; ?>"><img src="<?php echo $image['ImageURL']; ?>" alt="" width="80" height="50" class="image<?php echo $coutImgtag;?>" /></a></li>

					<?php 

					$coutImgtag++;

					}?>

					</ul>

                    </div>

                    </div>

                

                </div>

			</div>

			</div>

			<!--  \ banner bar / -->



		</div>

		<!--  \ banner / -->

		

		<!--  / content \ -->

		<div id="content">



			<!--  / center side\ -->

			<div id="centerSide">



				<!--  / fotm bar \ -->

				<div class="fotmBar">

                	

                    <div class="link">

                    	

                        <ul>

                        	<li class="selected"><a href="#">Contact Dealer</a></li>

                        	<li><a href="#">Loan Calculator</a></li>

                        	<li><a href="#">Trade Appraisal</a></li>

                        </ul>

                        

                    </div>

                    

                    <div class="form" id="tabLiOne">

                    	

                       

                     <?php echo do_shortcode("[gravityform id=7 name=contact ajax=true]"); ?>

                                                            

                    </div>

					<div id="tabLiTwo" class="calc" style="display:none">

                    	

                        <?php echo do_shortcode("[payment]"); ?>

                    

                    </div>

					<div id="tabLiThree" style="display:none">

                    	

                        <?php echo do_shortcode("[gravityform id=3 ajax=true]"); ?>    

                    

                    </div>



				</div>

				<!--  \ fotm bar / -->



				<!--  / text bar \ -->

				<div class="textBar">

                	

                    <?php echo $boat['Description'] ?>

                    

                    <div class="left">

                    	

                        <ul>

                        	<li>Specifications</li>

                        	<li>Length:  <?php echo $boat['Length']; ?> <?php echo $boat['LengthUnit']; ?></li>

                        	<li>Beam : <?php if ($boat['Beam'] != "0"){ echo $boat['Beam']; } ?></li>

                        	<li>Capacity, Fuel : <?php echo $boat['FuelTankCap'];?> <?php echo $boat['FuelTankCapUnit'];?></li>

                        	<li>Bridge Clearance w/Arch or Tower :<?php echo $boat['BridgeClearance'];?> <?php echo $boat['BridgeClearanceUnit'];?></li>

                        	<li>Capacity Fresh Water: <?php echo $boat['WaterTankCap'];?> <?php echo $boat['WaterTankCapUnit'];?></li>

                        	<li>Draft Drive Up : <?php echo $boat['MinDraft'];?> <?php echo $boat['MinDraftUnit'];?></li>

                        	<li>Draft, Drive Down: <?php echo $boat['MaxDraft'];?> <?php echo $boat['MaxDraftUnit'];?></li>

                        	<li>Dry Weight: <?php echo $boat['DryWeight'];?> <?php echo $boat['DryWeightUnit'];?></li>

                        </ul>

                        

                    </div>

                    

                    <div class="right" style="display:none">

                    	<?php if($video['VideoURL'] && $video['VideoURL']!=''){?>

                        <a href="#">

                        <object width="100%" height="100%" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" 

                        classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">

                        <param value="http://www.vidbrochure.com/commercial.swf?commercialid=<?php echo $video['VideoURL'];?>&amp;domainid=vidbrochure" name="movie">

                        <param value="high" name="quality"><param value="transparent" name="wmode">

                        <embed width="585" height="380" wmode="transparent" type="application/x-shockwave-flash" 

                        pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" 

                        src="http://www.vidbrochure.com/commercial.swf?commercialid=<?php echo $video['VideoURL'];?>&amp;domainid=vidbrochure">

                        </object></a>

						<?php }?>

                    

                    </div>

                    

				</div>

				<!--  \ text bar / -->



			</div>

			<!--  \ center side/ -->



		</div>

		<!--  \ content / -->

		

		<!--  / footer \ -->

		<div id="footer">



            <!--  / footer bar \ -->

            <div class="footerBar">

            	

         

                	<div class="left">

               				<h2>Construction</h2>

							<ul>

								<li>Builder: <?php echo $boat['Builder']; ?></li>

								<li>Designer: <?php echo $boat['Designer']; ?></li>

								<li>Construction: <?php echo $boat['HullMaterial']; ?></li>

							</ul>

							<h2>Measurements</h2>

							<ul>

								<li>Length: <?php echo $boat['Length']; ?></li>

								<li>Beam: <?php if ($boat['Beam'] != "0"){ echo $boat['Beam']; } ?></li>

								<li>Displacement: <?php if ($boat['Displacement'] != "0"){ echo $boat['Displacement'] . " ". $boat['DisplacementUnit']; } ?></li>

								<li>Min Draft: <?php if ($boat['MinDraft'] != "0"){ echo $boat['MinDraft']; } ?></li>

								<li>Max Draft: <?php if ($boat['MaxDraft'] != "0"){ echo $boat['MaxDraft']; } ?></li>

								<li>Ballast: <?php if ($boat['Ballast'] != "0"){ echo $boat['Ballast'] . " ". $boat['BallastUnit']; } ?></li>

							</ul>

						</div>

						<div class="center">

							<h2>Engines</h2>

							<ul>

								<li>Number of Engines: <?php echo $engine['EngineNo'] ?></li>

								<li>Engine(s) Make: <?php echo $engine['EngineMake'] ?></li>

								<li>Engine Model: <?php echo $engine['EngineModel'] ?></li>

								<li>Engine Year: <?php if ($engine['EngineYear'] != "0000"){ echo $engine['EngineYear']; }?></li>

								<li>Engine Fuel Type: <?php echo ($engine['EngineFuel'])?></li>

								<li>Engine Propeller Type: <?php echo ($engine['PropellerType'])?></li>

								<li>Engine Hours: <?php if ($engine['EngineHours'] != "0"){ echo $engine['EngineHours']; }?></li>

							</ul>

							<h2>Tankage</h2>

							<ul>

								<li>Fuel: <?php if ($boat['FuelTankNo'] != "0"){ echo $boat['FuelTankNo'] . " x " . $boat['FuelTankCap'] . " " . $boat['FuelTankCapUnit']; } ?></li>

								<li>Water: <?php if ($boat['WaterTankNo'] != "0"){ echo $boat['WaterTankNo'] . " x " . $boat['WaterTankCap'] . " " . $boat['WaterTankCapUnit']; } ?></li>

								<li>Holding: <?php if ($boat['HoldingTankNo'] != "0"){ echo $boat['HoldingTankNo'] . " x " . $boat['HoldingTankCap'] . " " . $boat['HoldingTankCapUnit']; } ?></li>

							</ul>

						</div>

	</div>

	<div id="descriptions">

						<?php 

						$Query = "SELECT * FROM `".$table_prefix."bv_descriptions` WHERE BoatID=$id";

						$textdata = mysql_query($Query); 

						while($text = mysql_fetch_array($textdata)) {

							if ($text['AddTitle'] != "customContactInformation" && $text['AddTitle'] != "Disclaimer"){

								echo "<h4>" . $text['AddTitle'] . "</h4>";

								$text['AddDescription']=str_replace("Ã¢","'",$text['AddDescription']);

								echo "<p>" . $text['AddDescription'] . "</p>";

							}

						}

						$Query = "SELECT * FROM `".$table_prefix."bv_features` WHERE BoatID=$id";

						$featuredata = mysql_query($Query); 

						while($feature = mysql_fetch_array($featuredata)) {

							$feature['FeatureData']=str_replace("Ã¢","'",$feature['FeatureData']);

							echo "<li>" . $feature['FeatureData'] . "</li>";

						}

						$Query = "SELECT * FROM `".$table_prefix."bv_descriptions` WHERE BoatID=$id";

						$textdata = mysql_query($Query); 

						while($text = mysql_fetch_array($textdata)) {

							if ($text['AddTitle'] == "customContactInformation" || $text['AddTitle'] == "Disclaimer"){

								$text['AddTitle']=str_replace("customContactInformation","Additional Contact Information",$text['AddTitle']);

								echo "<h4>" . $text['AddTitle'] . "</h4>";

								$text['AddDescription']=str_replace("Ã¢","'",$text['AddDescription']);

								echo "<p>" . $text['AddDescription'] . "</p>";

							}

						}?>



            </div>

            <!--  \ footer bar / -->





		</div>

		<!--  \ footer / -->

		

	</div>

	<!--  \ layout / -->

	

</div>

<?php //include('comments.php');?>

<?php }

else

{	



$Query = "SELECT * FROM `".$table_prefix."bv_boatdetails` WHERE BoatID > 0 ";



if (@$_POST['Model'] && $_POST['Model'] != ""){

	$SearchModel = $_POST['Model'];

	$Query.= " AND Model ='$SearchModel' ";

}

if (@$_POST['make'] && $_POST['make'] != ""){

	$SearchMake = $_POST['make'];

	$Query.= " AND Make ='$SearchMake' ";

}

if (@$_POST["type"] && $_POST["type"] != ""){

	$SearchType = $_POST["type"];

	$Query.= " AND Category ='$SearchType'";

}

if (@$_POST['NewUsed'] && $_POST['NewUsed'] != ""){

	$SearchNewUsed = $_POST['NewUsed'];

	$Query.= " AND NewUsed ='$SearchNewUsed'";

}

else

{   $_POST['NewUsed']='New';

	$Query.= " AND NewUsed ='New'";

}

if (@$_POST["minprice"] && $_POST["minprice"] != ""){

	$SearchMinPrice = $_POST["minprice"];

	$Query.= " AND Price >='$SearchMinPrice' ";

}

if (@$_POST["maxprice"] && $_POST["maxprice"] != ""){

	$SearchMaxPrice = $_POST["maxprice"];

	$Query.= " AND Price <='$SearchMaxPrice' ";

}

if (@$_POST["minlength"] && $_POST["minlength"] != ""){

	$SearchMinLength = $_POST["minlength"];

	$Query.= " AND Length >='$SearchMinLength'";

}

if (@$_POST["maxlength"] && $_POST["maxlength"] != ""){

	$SearchMaxLength = $_POST["maxlength"];

	$Query.= " AND Length <='$SearchMaxLength'";

}

if(isset($locationCity) && $locationCity!='')

{

	$Query.= " AND LocationCity ='$locationCity'";

}

if (@$_POST["location"] && $_POST["location"] != ""){

	$SearchLocation1 = $_POST["location"];

	$Query.= " AND OfficeID ='$SearchLocation1' ";

}

if (@$_POST["Year"] && $_POST["Year"] != ""){

	$SearchLocation = $_POST["Year"];

	$Query.= " AND Year ='$SearchLocation'";

}

$Query.= " AND (Status = 'Active' OR Status = 'Sale Pending') ";

if (@$_POST["sort"] && $_POST["sort"] != ""){

	$SortListings = $_POST["sort"];

	if ($SortListings == "lengthdesc"){ $SortListings = "Length DESC"; }

	if ($SortListings == "lengthasc"){ $SortListings = "Length ASC"; }

	if ($SortListings == "pricedesc"){ $SortListings = "Price DESC"; }

	if ($SortListings == "priceasc"){ $SortListings = "Price ASC"; }

	if ($SortListings == "yeardesc"){ $SortListings = "Year DESC"; }

	if ($SortListings == "yearasc"){ $SortListings = "Year ASC"; }

	if ($SortListings == "makedesc"){ $SortListings = "Make DESC"; }

	if ($SortListings == "makeasc"){ $SortListings = "Make ASC"; }

	$Query.= " ORDER BY $SortListings";

	} else { $_POST["sort"]='lengthasc';

	$Query.= " ORDER BY Length ASC";

	} 

 //echo $Query;

$QueryNav=$Query;

	$QueryResult=mysql_fetch_array(mysql_query($Query));	

	

?>

<div id="wrapper">

	

	<!--  / layout \ -->

	<div id="layout">

		

		<!--  / content \ -->

		<div id="content">



			<!--  / center side\ -->

			<div id="centerSide">

			<form name="frmNoPage" id="frmNoPage" class="" action="<?php echo $searchurl;?>" method="post">

	

    		<div id="sidebar" class="sidebar-search mysearchnew" style="height:327px;">

	

		<!-- START SEARCH BOX -->

		

				<div class="option">

					<strong>Type</strong><br/>

						<!--<select name="type" id="Type">

						<?php if (!$_POST['type'] || $_POST['type'] == ""){?>

		              		<option value="" selected="selected">All Boats</option>					

		              	<?php }else{ ?>

							<option value="" >All Boats</option>

						<?php }

						$Querysearch = "SELECT DISTINCT Category FROM `".$table_prefix."bv_boatdetails` WHERE (Status = 'Active') ORDER BY Category";

						$result = mysql_query($Querysearch);

						while ( $row=mysql_fetch_array($result)) {			

							$SearchType = $row["Category"];

							if ($_POST['type'] == $SearchType){

								echo "<option value=\"" . $SearchType . "\" selected=\"selected\">" . $SearchType . "</option>";

							} else if ($SearchType != ""){	 

              					echo "<option value=\"" . $SearchType . "\">" . $SearchType . "</option>";

							}

						}?>

            		</select> --> 

                      <select name="NewUsed" id="NewUsed" class="styled">

                      <option value="" >All Boats</option>

                      <option value="New" <?php if ($_POST['NewUsed'] =='New'){?> selected="selected" <?php } ?>>New</option>

                      <option value="Used" <?php if ($_POST['NewUsed'] =='Used'){?> selected="selected" <?php } ?>>Used</option>

                    </select>            

            	</div>

            	<div class="option">

            		<strong>Make</strong><br/>

					<select name="make" id="Make" class="styled">

						<?php if (!$_POST['make'] || $_POST['make'] == ""){?>

		              		<option value="" selected="selected">All Manufacturers</option>

						<?php }else{ ?>

							<option value="" >All Manufacturers</option>

						<?php }

						$Querysearch = "SELECT DISTINCT Make FROM `".$table_prefix."bv_boatdetails` WHERE (Status = 'Active') ORDER BY Make";

						$result = mysql_query($Querysearch);

						while ( $row=mysql_fetch_array($result)) {

							$SearchMake = $row["Make"];  

							if ($_POST['make'] == $SearchMake){ 

								echo "<option value=\"" . $SearchMake . "\" selected=\"selected\">" . $SearchMake . "</option>";

							} else if ($SearchMake != ""){	 

              					echo "<option value=\"" . $SearchMake . "\">" . $SearchMake . "</option>";

							}

						}?>

            		</select>            

            	</div>

                <div class="option">

            		<strong>Model</strong><br/>

					<select name="Model" id="Model" class="styled">

						<?php if (!$_POST['Model'] || $_POST['Model'] == ""){?>

		              		<option value="" selected="selected">All Model</option>

						<?php }else{ ?>

							<option value="" >All Model</option>

						<?php }

						$Querysearch = "SELECT DISTINCT Model FROM `".$table_prefix."bv_boatdetails` WHERE (Status = 'Active') ORDER BY Model";

						$result = mysql_query($Querysearch);

						while ( $row=mysql_fetch_array($result)) {

							$SearchModel = $row["Model"];  

							if ($_POST['Model'] == $SearchModel){ 

								echo "<option value=\"" . $SearchModel . "\" selected=\"selected\">" . $SearchModel . "</option>";

							} else if ($SearchModel != ""){	 

              					echo "<option value=\"" . $SearchModel . "\">" . $SearchModel . "</option>";

							}

						}?>

            		</select>            

            	</div>

            	<div class="option minsearch">

            		<strong>Min Price ($)</strong><br/>

            		<?php if (@$_POST['minprice']){ 

            			echo "<input name=\"minprice\" type=\"text\" value=\"" . $_POST['minprice'] . "\"/>&nbsp;&nbsp;";

            		} else {

            			echo "<input name=\"minprice\" type=\"text\"/>&nbsp;&nbsp;";

            		}?>

            	</div>

            	<div class="option minsearch1">

            		<strong>Max Price ($)</strong><br/>

            		<?php if (@$_POST['maxprice']){ 

            			echo "<input name=\"maxprice\" type=\"text\" value=\"" . $_POST['maxprice'] . "\"/>&nbsp;&nbsp;";

            		} else {

            			echo "<input name=\"maxprice\" type=\"text\"/>&nbsp;&nbsp;";

            		}?>

            	</div>

                <div class="option">

            		<strong>Location</strong><br/>

				  <select name="location" id="Location" class="styled">

						<?php if (!$_POST['location'] || $_POST['location'] == ""){?>

		              		<option value="" selected="selected">Anywhere</option>

						<?php }else{ ?>

							<option value="" >Anywhere</option>

						<?php }

						/*$Querysearch = "SELECT DISTINCT LocationCity, LocationState FROM `".$table_prefix."bv_boatdetails` Where NewUsed='New' AND Status='Active' ORDER BY LocationCity ";

						$result = mysql_query($Querysearch);

						while ( $row = mysql_fetch_array( $result ) ) {

							$SearchLocation = $row["LocationCity"].'~'.$row["LocationState"]; 

							$SearchLocationText= $row["LocationCity"].'&nbsp;'.$row["LocationState"];

							if ($_POST['location'] == $SearchLocation){ 

							echo "<option value=\"" . $SearchLocation . "\" selected=\"selected\">" . $SearchLocationText . "</option>";							

							} else if ($SearchLocation != ""){	 

              				echo "<option value=\"" . $SearchLocation . "\">" . $SearchLocationText . "</option>";

							}

						}*/?>

						<!--<option value="34490" <?php if($_POST['location']=='34490'){echo "selected=\"selected\"";}?>>

						Singleton Marine Group of Atlanta</option>

						<option value="36119" <?php if($_POST['location']=='36119'){echo "selected=\"selected\"";}?>>

						SMG Blue Creek Marina Lake Martin</option>

						<option value="36116" <?php if($_POST['location']=='36116'){echo "selected=\"selected\"";}?>>

						SMG Boat Liquidation Center</option>

						<option value="36114" <?php if($_POST['location']=='36114'){echo "selected=\"selected\"";}?>>

						SMG Keowee North Marine Lake Keowee</option>

						<option value="36113" <?php if($_POST['location']=='36113'){echo "selected=\"selected\"";}?>>

						SMG Lako Oconee</option>

						<option value="28803" <?php if($_POST['location']=='28803'){echo "selected=\"selected\"";}?>>

						SMG Yacht Center at Holiday Marina</option>-->

                        <option value="47684" <?php if($_POST['location']=='47684'){echo "selected=\"selected\"";}?>>

						Singleton Marine Group of Atlanta</option>

						<option value="47686" <?php if($_POST['location']=='47686'){echo "selected=\"selected\"";}?>>

						SMG Blue Creek Marina Lake Martin</option>

						<option value="47688" <?php if($_POST['location']=='47688'){echo "selected=\"selected\"";}?>>

						SMG Boat Liquidation Center</option>

						<option value="47690" <?php if($_POST['location']=='47690'){echo "selected=\"selected\"";}?>>

						SMG Keowee North Marine Lake Keowee</option>

						<option value="47692" <?php if($_POST['location']=='47692'){echo "selected=\"selected\"";}?>>

						SMG Lako Oconee</option>

						<option value="28803" <?php if($_POST['location']=='28803'){echo "selected=\"selected\"";}?>>

						SMG Yacht Center at Holiday Marina</option>

            		</select>            

            	</div>

            	<!--<div class="option">

            		<strong>Currency</strong><br/>

					<select name="currency" style="width: 55px">

						<?php if (!$_POST['currency'] || $_POST['currency'] == ""){?>

		              		<option value="" selected="selected">-</option>

		              		<option value="GBP">GBP</option>

							<option value="EUR">Euro</option>

							<option value="USD">USD</option>

						<?php }else if ($_POST['currency'] == "GBP"){ ?>

							<option value="" >-</option>

							<option value="GBP" selected="selected">GBP</option>

							<option value="EUR">Euro</option>

							<option value="USD">USD</option>

						<?php }else if ($_POST['currency'] == "EUR"){ ?>

							<option value="">-</option>

							<option value="GBP">GBP</option>

							<option value="EUR" selected="selected">Euro</option>

						<?php } else if ($_POST['currency'] == "USD"){ ?>

							<option value="">-</option>

							<option value="GBP">GBP</option>

							<option value="EUR">Euro</option>

							<option value="USD" selected="selected">USD</option>

						<?php } ?>

					</select>					

				</div>-->

            	<div class="option">



            		<strong>Min Length (ft)</strong><br/>

            		<?php if (@$_POST['minlength']){ 

            			echo "<input name=\"minlength\" type=\"text\" value=\"" . $_POST['minlength'] . "\"/>&nbsp;&nbsp;";

            		} else {

            			echo "<input name=\"minlength\" type=\"text\"/>&nbsp;&nbsp;";

            		}?>

            	</div>

            	<div class="option">

            		<strong>Max Length (ft)</strong><br/>

            		<?php if (@$_POST['maxlength']){ 

            			echo "<input name=\"maxlength\" type=\"text\" value=\"" . $_POST['maxlength'] . "\"/>&nbsp;&nbsp;";

            		} else {

            			echo "<input name=\"maxlength\" type=\"text\"/>&nbsp;&nbsp;";

            		}?>

            	</div>

            	<?php /*?><div class="option">

            		<strong>Units</strong><br/>

					<select name="units" style="width: 55px">

						<?php if (!$_POST['units'] || $_POST['units'] == ""){?>

		              		<option value="" selected="selected">-</option>

		              		<option value="feet">Feet</option>

							<option value="metres">Metres</option>

						<?php }else if ($_POST['units'] == "feet"){ ?>

							<option value="" >-</option>

							<option value="feet" selected="selected">Feet</option>

							<option value="metres">Metres</option>

						<?php }else if ($_POST['units'] == "metres"){ ?>

							<option value="">-</option>

							<option value="feet">Feet</option>

							<option value="metres" selected="selected">Metres</option>

						<?php } ?>

					</select>					

				</div><?php */?>

            	

            	<div class="option">

            		<strong>In This Year</strong><br/>

				 <?php /*?> <select name="Year" id="Year">

						<?php if (!$_POST['Year'] || $_POST['Year'] == ""){?>

		              		<option value="" selected="selected">Year</option>

						<?php }else{ ?>

							<option value="" >Year</option>

						<?php }

						$Querysearch = "SELECT DISTINCT Year FROM `".$table_prefix."bv_boatdetails` ORDER BY Year desc";

						$result = mysql_query($Querysearch);

						while ( $row = mysql_fetch_array( $result ) ) {

							$SearchLocation = $row["Year"]; 

							require("countries.php");

							if ($_POST['Year'] == $SearchLocation){ 

							echo "<option value=\"" . $SearchLocation . "\" selected=\"selected\">" . $SearchLocation . "</option>";							

							} else if ($SearchLocation != ""){	 

              				echo "<option value=\"" . $SearchLocation . "\">" . $SearchLocation . "</option>";

							}

						}?>

            		</select><?php */?>   

					

					<input type="text" name="Year" id="Year" value="<?php echo $_POST['Year'];?>" />         

            	</div>

				

                

                <?php // searchByStockNo('http://singletonmarinegroup.com/inventory-search-result/'); ?>

                

               <!-- <input type="hidden"  name="page" value="<?php echo $page;?>"/>-->

            	<input type="submit" class="button" name="SimpleSearch" value="Search" />

		

        <!-- END SEARCH BOX -->

        

	</div>

    

    	<!-- This is form sidebar for page new inventory -->

        

        	<div class="slidebrand">

            

            	 <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('inventorypage') ) : ?> <?php endif; ?>	

            

            </div>

            

            <!-- This is form sidebar for page new inventory -->

    

<!--</form>

			

<form name="frmNoPage" action="" method="post">-->

<div class="clear"></div>



<div class="mynewin">



<input type='hidden' id='current_boat_page' />

<input type='hidden' id='show_per_page' />       

<input type='hidden' id='number_of_page' />

<div class="pagina">

		<?php		

        $dotTrue='1';		

        $result=mysql_query($Query);

        $all_result=mysql_num_rows($result);

      //  echo '<span>'.$all_result . " results found... </span>";

            

        //$get_first_result=mysql_query($Query);

        // list page navgation ([1] 2 3 4 5)

        

        ?>

    <div class="paginations center mylist">

         <div class='page_navigation'> </div>

    </div>     

</div>   



	<div class="click">

    

    	<ul>

         <li class="grid"><a href="#"></a></li>

         <li class="list"><a href="#"></a></li>

        </ul>

    

    </div>

	 

   <input type="hidden" name="page" id="noPage" value="<?php echo $noPage;?>" />             

   <!--</form>             

			  <form name="sortandfilterSort" class="" action="" method="post">-->

				<!--<div id="sort">

					Sort By: 

					<select name="sort" onchange="sortBy();">

                       <option value="lengthdesc" <?php /* if (@$_POST['sort'] == "lengthdesc") { echo "selected=\"selected\"";}?>>Length (high to low)</option>

						<option value="lengthasc" <?php if (@$_POST['sort'] == "lengthasc") { echo "selected=\"selected\"";}?>>Length (low to high)</option>

						<option value="pricedesc" <?php if (@$_POST['sort'] == "pricedesc") { echo "selected=\"selected\"";}?>>Price (high to low)</option>

						<option value="priceasc" <?php if (@$_POST['sort'] == "priceasc") { echo "selected=\"selected\"";}?>>Price (low to high)</option>		

						<option value="yeardesc" <?php if (@$_POST['sort'] == "yeardesc") { echo "selected=\"selected\"";}?>>Year (newer to older)</option>

						<option value="yearasc" <?php if (@$_POST['sort'] == "yearasc") { echo "selected=\"selected\"";}?>>Year (older to newer)</option>

						<option value="makedesc" <?php if (@$_POST['sort'] == "makedesc") { echo "selected=\"selected\"";}?>>Make (Z to A)</option>

						<option value="makeasc" <?php if (@$_POST['sort'] == "makeasc") { echo "selected=\"selected\"";} */ ?>>Make (A to Z)</option>

					</select>

				</div>-->

               <!-- <input type="hidden" name="page" id="noPage" value="<?php echo $noPage;?>" />  --> 

			  </form>



				<!--  / gallery bar \ -->

				<div class="galleryBar newlist">

                	<?php $timpath=get_bloginfo('url').'/wp-content/plugins/boats inventory/timthumb/timthumb.php'; ?>

                     <ul id="boat-content">

                    	<?php if ($all_result < 1){ 

						echo "<li style=\"line-height:20px\">There are no boats in our database that match your search today, however if you contact us and let us know what you are looking for, we would be glad to help.</li>";

					} else { $data_p = mysql_query($Query); 

						while($info = mysql_fetch_array($data_p)) { $i; ?>

                    	<li <?php if($i == 2 ) { echo 'Class="margin"';} ?>>

                            <div class="left">

                           <?php

						    

						     //Grab first image from listing

							$id = $info['BoatID'];

							//-- For total image count --//

							$QueryboatImgCount1 = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id ORDER BY ImageRanking";

							$QueryboatImgCount = mysql_query($QueryboatImgCount1); 

							$totaleImg=@mysql_num_rows($QueryboatImgCount);

							

							$Queryboat = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id ORDER BY ImageRanking limit 0,1";

							$imagedata = mysql_query($Queryboat); 

							while($image = mysql_fetch_array($imagedata)) {?>

								<a href="<?php echo $mainPath.HtAccessURL('inventory',$info['Make'].':'.$info['Model'].':'.$info['BoatID']);?>" />

                                	<img src="<?php echo $timpath; ?>?src=<?php echo $image['ImageURL'];?>&w=337&h=246&zc=1&q=100" alt="<?php echo $info['Make'] .'&nbsp;'. $info['Model'];?>" />

                                </a>

                                <?php }?>

                                <div class="details">

                                	

                                <h2><a href="<?php echo $mainPath.HtAccessURL('inventory',$info['Make'].':'.$info['Model'].':'.$info['BoatID']);?>" />

								<?php echo $info['Year'].'&nbsp;'.$info['Make'].'&nbsp;'.$info['Model'];?>

								</a> </h2>

                                

                                <span class="stockListing"><label>Stock Number:</label><?php echo $info['stockNo'];?></span> / 

                                

                                <span class="price">

                                <?php 

								if (@$_POST["currency"] && $_POST["currency"] != $info['PriceCurrency']){

								$fromcurrency = $info['PriceCurrency'];

								$tocurrency = $_POST['currency'];

								$price = $info['Price'];

								$Price = number_format(currency($fromcurrency,$tocurrency,$price));

								$PriceCurrency=str_replace("GBP","&pound;",$tocurrency);

								$PriceCurrency=str_replace("USD","&#36;",$tocurrency);

								$PriceCurrency=str_replace("AUD","AUD &#36;",$tocurrency); 

								$PriceCurrency=str_replace("NZD","NZD &#36;",$tocurrency); 

								$PriceCurrency=str_replace("EUR","&#8364;",$tocurrency);

								} else {

								$Price = number_format($info['Price']);

								$PriceCurrency=str_replace("GBP","&pound;",$info['PriceCurrency']);

								$PriceCurrency=str_replace("USD","&#36;",$info['PriceCurrency']);

								$PriceCurrency=str_replace("AUD","AUD &#36;",$info['PriceCurrency']); 

								$PriceCurrency=str_replace("NZD","NZD &#36;",$info['PriceCurrency']); 

								$PriceCurrency=str_replace("EUR","&#8364;",$info['PriceCurrency']);

								}

								$PriceCurrency=str_replace("GBP","&pound;",$PriceCurrency);

								$PriceCurrency=str_replace("USD","&#36;",$PriceCurrency);

								if($info['Status']=="Sale Pending") //If Boat status is Sale pending

					              echo "Sale Pending";

								else

								{  

								if ($info['DispalyStatus'] != "true" && $Price>0) {

									echo $PriceCurrency . $Price;

								} else {

									echo "Contact us for price";

								}

								}?>

                                </span>

                                    

                                </div>

                            </div>

                            

                            <!--<div class="center">

                                <div class="mydiv">

                                <h2>

								<a href="<?php /* echo $mainPath.HtAccessURL('inventory',$info['Make'].':'.$info['Model'].':'.$info['BoatID']);?>" />

								<?php echo $info['Year'].'&nbsp;'.$info['Make'].'&nbsp;'.$info['Model'];?>

								</a><br/>

								<span class="stockListing"><label>Stock Number:</label><?php echo $info['stockNo'];?></span>

								<div class="clear"></div>						

                                    <span class="stockListing"><label>Length:</label><?php echo $info['Length']; ?></span>

                                    <div class="clear"></div>

                                    <span class="stockListing"><label>Weight:</label><?php echo $info['DryWeight'];?> <?php echo $info['DryWeightUnit'];?></span>	

                                    <div class="clear"></div>

                                    <span class="stockListing"><label>Fuel Capacity:</label><?php echo $info['FuelTankCap'];?> <?php echo $info['FuelTankCapUnit'];?></span>

                                    <div class="clear"></div>

                                    <span class="stockListing"><label>Seating Capacity:</label><?php echo $info['seatingCapacity'];?></span>

								</h2>

                                

                                <ul>

                                <?php 

								$Queryboat = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id ORDER BY ImageRanking limit 1,10";

								$imagedata = mysql_query($Queryboat); 

								while($image = mysql_fetch_array($imagedata)) {?>

                                    <li defaultSrc="<?php echo $timpath; ?>?src=<?php echo $image['ImageURL'];?>&w=337&h=226&zc=1&q=100"><img src="<?php echo $timpath; ?>?src=<?php echo $image['ImageURL'];?>&w=85&h=70&zc=1&q=100" alt="<?php echo $info['Make'] .'&nbsp;'. $info['Model'];?>" /></li>

                                   <?php } */?>

                                </ul>

                            	</div>

                            </div>-->

                            

                            <!--<div class="right">

                                

                                <span class="price">

                                <?php /*

								if (@$_POST["currency"] && $_POST["currency"] != $info['PriceCurrency']){

								$fromcurrency = $info['PriceCurrency'];

								$tocurrency = $_POST['currency'];

								$price = $info['Price'];

								$Price = number_format(currency($fromcurrency,$tocurrency,$price));

								$PriceCurrency=str_replace("GBP","&pound;",$tocurrency);

								$PriceCurrency=str_replace("USD","&#36;",$tocurrency);

								$PriceCurrency=str_replace("AUD","AUD &#36;",$tocurrency); 

								$PriceCurrency=str_replace("NZD","NZD &#36;",$tocurrency); 

								$PriceCurrency=str_replace("EUR","&#8364;",$tocurrency);

								} else {

								$Price = number_format($info['Price']);

								$PriceCurrency=str_replace("GBP","&pound;",$info['PriceCurrency']);

								$PriceCurrency=str_replace("USD","&#36;",$info['PriceCurrency']);

								$PriceCurrency=str_replace("AUD","AUD &#36;",$info['PriceCurrency']); 

								$PriceCurrency=str_replace("NZD","NZD &#36;",$info['PriceCurrency']); 

								$PriceCurrency=str_replace("EUR","&#8364;",$info['PriceCurrency']);

								}

								$PriceCurrency=str_replace("GBP","&pound;",$PriceCurrency);

								$PriceCurrency=str_replace("USD","&#36;",$PriceCurrency);

								if($info['Status']=="Sale Pending") //If Boat status is Sale pending

					              echo "Sale Pending";

								else

								{  

								if ($info['DispalyStatus'] != "true" && $Price>0) {

									echo $PriceCurrency . $Price;

								} else {

									echo "Contact us for price";

								}

								}?>

                                </span>

                                

                                <ul>

                                    <li class="photo"><a href="<?php echo $mainPath.HtAccessURL('inventory',$info['Make'].':'.$info['Model'].':'.$info['BoatID']);?>"><?php echo $totaleImg;?> Photos</a></li>

                                    <li class="view">

                                    	<a href="<?php echo $mainPath.HtAccessURL('inventory',$info['Make'].':'.$info['Model'].':'.$info['BoatID']);?>" />View Detail</a>

                                    </li>

                                    <li class="contact"><a href="<?php echo $mainPath.HtAccessURL('inventory',$info['Make'].':'.$info['Model'].':'.$info['BoatID']); */ ?>#liTab">Contact</a></li>

                                </ul>

                            

                            </div>-->

						</li>

                        <?php 

						 $i++; if($i == 3 ) { $i = 0; }	}

						}?>

                    </ul>

                     

				</div>

				<!--  \ gallery bar / -->

                  <!-- <div class="pagina">

                        <?php // echo '<span>'.$all_result . " results found... </span>"; ?>

                    <div class="paginations center">

                         <div class='page_navigation'></div>

                    </div>     

                </div> -->

			</div>

			<!--  \ center side/ -->

            

            </div>



		</div>

		<!--  \ content / -->

		



		

	</div>

	<!--  \ layout / -->

	

</div>





<?php } ?>

<script type="text/javascript">

swfobject.registerObject("FlashID");

</script>

