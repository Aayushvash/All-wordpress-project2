<!-- frontendBoatListing -->
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
<?php if($_POST['btnContact'])
{
$title     = $_POST['title'];
$name     = $_POST['name'];
$phone    = $_POST['phone'];
$sAddress    = $_POST['sAddress'];
$city    = $_POST['city'];
$state    = $_POST['state'];
$zCode    = $_POST['zCode'];
$email    = $_POST['email'];
$interested    = $_POST['interested'];
$comments = $_POST['comments'];
$url = $_POST['url'];
$error_msg = "";
$msg = "";
if($name){
	$msg .= "Name: \t $name \n";
}
if($phone){
	$msg .= "Phone: \t $phone \n";
}
if($sAddress){
	$msg .= "Street Address: \t $sAddress \n";
}
if($city){
	$msg .= "City: \t $city \n";
}
if($state){
	$msg .= "State: \t $state \n";
}
if($zCode){
	$msg .= "Zip Code: \t $zCode \n";
}
if(!$email){
	$error_msg .= "Your email \n";
}
if($email){
	if(!preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\._\-]+\.[a-zA-Z]{2,4}/", $email)){
		echo "\n<br>That is not a valid email address.  Please <a href=\"javascript:history.back()\">return</a> to the previous page and try again.\n<br>";
		exit;
	}			
	$msg .= "Email: \t $email \n";
}
if($interested){
	$msg .= "Interested In: \t $interested \n";
}
if($comments){
	$msg .= "Comments: \t $comments \n";
}
$url.="&sent=yes";
$sender_email="";
if(!isset($name)){
	if($name == ""){
		$sender_name="Web Customer";
	}
}else{
	$sender_name=$name;
}
if(!isset($email)){
	if($email == ""){
		$sender_email="jensen.d@gmail.com";
	}
}else{
	$sender_email=$email;
}
if($error_msg != ""){
	echo "You didn't fill in these required fields:<br>"
	.nl2br($error_msg) .'<br>Please <a href="javascript:history.back()">return</a> to the previous page and try again.';
	
}else{
$mailheaders  = "MIME-Version: 1.0\r\n";
$mailheaders .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$mailheaders .= "From: $sender_name <$sender_email>\r\n";
$mailheaders .= "Reply-To: $sender_email <$sender_email>\r\n"; 
@mail("jensen.d@gmail.com","BWWS Test Enquiry",stripslashes($msg), $mailheaders);
}
}
?>
<link href="<?php echo plugins_url('css/biMainCss.css', __FILE__);?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('css/jquery.ad-gallery.css', __FILE__);?>">
<?php require_once("HtAccessURL.php");
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
<!--<script type="text/javascript" src="<?php echo plugins_url('js/jquery.min.js', __FILE__);?>"></script>-->
<script type="text/javascript" src="<?php echo plugins_url('js/jquery.ad-gallery.js', __FILE__);?>"></script>
<script src="<?php echo plugins_url('js/swfobject_modified.js', __FILE__);?>"></script>

<?php if($_GET['edit'])
{
	$boatid=$_GET['edit'];
?>
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
	document.frmNoPage.submit();
	
}
jQuery(document).ready(function() {
	jQuery("#liTab li").click(function() {
	  jQuery("#liTab li").removeClass('selected');
	 jQuery(this).addClass('selected');
	  if(jQuery(this).attr("id")=='LiThree')
	  {
	  	jQuery("#tabLiOne").css('display','none');
		jQuery("#tabLiTwo").css('display','none');
		jQuery("#tabLiFour").css('display','none');
		jQuery("#tabLiFive").css('display','none');
		jQuery("#tabLiThree").css('display','');
	  }
	  else if(jQuery(this).attr("id")=='LiTwo')
	  {
	  	jQuery("#tabLiOne").css('display','none');
		jQuery("#tabLiTwo").css('display','');
		jQuery("#tabLiThree").css('display','none');
		jQuery("#tabLiFour").css('display','none');
		jQuery("#tabLiFive").css('display','none');
	  }
	  else if(jQuery(this).attr("id")=='LiFour')
	  {
	  	jQuery("#tabLiOne").css('display','none');
		jQuery("#tabLiTwo").css('display','none');
		jQuery("#tabLiThree").css('display','none');
		jQuery("#tabLiFour").css('display','');
		jQuery("#tabLiFive").css('display','none');
	  }
	  else if(jQuery(this).attr("id")=='LiFive')
	  {
	  	jQuery("#tabLiOne").css('display','none');
		jQuery("#tabLiTwo").css('display','none');
		jQuery("#tabLiThree").css('display','none');
		jQuery("#tabLiFour").css('display','none');
		jQuery("#tabLiFive").css('display','');
	  }
	  else
	  {
	  jQuery("#tabLiOne").css('display','');
		jQuery("#tabLiTwo").css('display','none');
		jQuery("#tabLiThree").css('display','none');
		jQuery("#tabLiFour").css('display','none');
		jQuery("#tabLiFive").css('display','none');
	  }
	});
});
$(document).ready(function() {
	//alert('hello');
       // var cont_left = $("#container").position().left;
       $(".center img").hover(function() {
            // hover in
			var path=$(this).attr('src');
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
  jQuery(function() { 
  
    var galleries =jQuery('.ad-gallery').adGallery({
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
   jQuery('#switch-effect').change(
      function() {
        galleries[0].settings.effect =jQuery(this).val();
        return false;
      }
    );
   jQuery('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
   jQuery('#toggle-description').click(
      function() {
        if(!galleries[0].settings.description_wrapper) {
          galleries[0].settings.description_wrapper =jQuery('#descriptions');
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
	if($boat['DispalyStatus']!='true' && $boat['Price']!=0 && $boat['Price']!=1)
	{
		$boat['Price'] .= " ex Vat";
	}
} else if ($boat['TaxStatus'] == "Paid"){
	if($boat['DispalyStatus']!='true' && $boat['Price']!=0 && $boat['Price']!=1)
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
<script type="text/javascript">
$(document).ready(function() {
	$("#input_6_13").val('<?php echo $boat['BrokerName']; ?>');
	$("#input_6_14").val('<?php echo $boat['Make'] . " " . $boat['Model']." ".$boat["Year"]; ?>');
	$("#input_6_15").val('<?php echo $boat['BoatID']; ?>');
	
	});
</script>
<div id="wrapper">
	
	<!--  / layout \ -->
	<div id="layout">
		<!--  / banner \ -->
		<div id="banner">
        	
			<!--  / banner bar \ -->
			<div class="bannerBar">
            	
                
            	<div id="gallery" class="ad-gallery">
                <div class="left">
				<div class="head">
                	
                    <h1><cite><?php echo $boat["Year"];?> <?php echo $boat["Make"];?> <?php echo $boat["Model"];?></cite>
					
					<span class="stockNoHead"><?php if ($boat['Name'] != "") echo "Boat Name: ".$boat["Name"];?></span>
					<span class="price" style="text-align: center"><?php if ($boat['DispalyStatus'] != "true" && $boat['Price']!=0 && $boat['Price']!=1){ echo $boat['PriceCurrency']; ?> <?php echo $boat['Price']; 
								} else { echo "for complete info"; }?></span>
					<span class="stockNoHead">Stock:#<?php echo $boat["BoatID"];?></span>	
					<div class="a2a_kit a2a_default_style">
					<a class="a2a_dd" href="http://www.addtoany.com/share_save" style="font-size:10px">Share</a>
					<span class="a2a_divider"></span>
					<a class="a2a_button_facebook"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/fc.png"></img></a>
					<span class="a2a_divider"></span>
					<a class="a2a_button_twitter"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/tc.png"></img></a>
					<span class="a2a_divider"></span>
					<a class="a2a_button_google_plus_share"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gc.png"></img></a>
					<span class="a2a_divider"></span>
					<a class="a2a_button_linkedin"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/ic.png"></img></a>
					<a style="display:none;" class="a2a_button_delicious"></a>
					</div>
					<script type="text/javascript" src="http://static.addtoany.com/menu/page.js"></script>
					</h1>
                </div>
                  <div class="ad-image-wrapper">
                      </div>
					  
					  
					  
                    <?php 
                    $Query = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id";
                    $imagedata = mysql_query($Query); ?>
					
					<div class="galley">
                	
                    <div class="ad-nav">
                    <div class="ad-thumbs">
                    <ul class="ad-thumb-list">
                    <?php  $coutImgtag=0;
						while($image = mysql_fetch_array($imagedata)) {?>
                    	<li><a class="tps<?php echo $coutImgtag;?>" href="<?php echo $image['ImageURL']; ?>"><img src="<?php echo $image['ImageURL']; ?>" alt="" width="80" height="50" class="image<?php echo $coutImgtag;?> " /></a></li>
					<?php 
					$coutImgtag++;
					}?>
					</ul>
                    </div>
					
					<div style="" class="tmp">
					<div style="visibility:hidden; height:0px;" class="ad-thumbsty">
					  <?php 
                    $Query = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id";
                    $imagedata = mysql_query($Query); ?>
                    <ul class="ad-thumb-list">
                    <?php  $coutImgtag=0;
						while($image = mysql_fetch_array($imagedata)) {?>
                    	<li>
						
						
						<a class="example-image-link tps<?php echo $coutImgtag; ?>" href="<?php echo $image['ImageURL']; ?>" data-lightbox="example-set" data-title=""><img class="example-image" src="<?php echo $image['ImageURL']; ?>" alt="" width="80" height="50" class="image<?php echo $coutImgtag;?>" /></a></li>
					<?php 
					$coutImgtag++;
					}?>
					</ul>
					 
					
                    </div>
					</div>
					
					 
					
                    </div>
                
                </div>
				<div class="clear"></div>
				
				<div class="right">
                	
                   
                						
								
				<span class="stockNoHead">Stock:#<?php echo $boat["BoatID"];?></span>
				 <?php echo $boat['Description'] ?>
				 <!-- Lockerz Share BEGIN -->
					
					<!-- Lockerz Share END -->
                </div>
				
				<div class="fotmBar">
                	
                    <div class="link">
                    	
                         <ul id="liTab">
                        	<li id="LiOne" class="selected"><a href="javascript:void(0);"><span>FEATURES</span></a></li>
                        	<li id="LiTwo"><a href="javascript:void(0);"><span>SPECS</span></a></li>
                        	<li id="LiThree"><a href="javascript:void(0);"><span>OPTIONS</span></a></li>
                            <li style="display:none;" id="LiFour"><a href="javascript:void(0);">OPTIONS</a></li>
                            <li style="display:none;" id="LiFive"><a href="javascript:void(0);">TRADE APPRAISAL</a></li>
                        </ul>
                        
                    </div>
                    
                    <div id="tabLiOne" class="form">
					<div class="one">
                        <h3>Construction</h3>
                        
                        <ul>
                            <li>Builder: <?php echo $boat['Builder']; ?></li>
                            <li>Designer: <?php echo $boat['Designer']; ?></li>
                            <li>Construction: <?php echo $boat['HullMaterial']; ?></li>
                        </ul>
                        
                        </div>
                        <div class="one">
                        
                        <h3>Measurements</h3>
                        
                        <ul>
                            <li>Length: <?php echo $boat['Length']; ?></li>
                            <li>Beam: <?php if ($boat['Beam'] != "0"){ echo $boat['Beam']; } ?></li>
                            <li>Displacement: <?php if ($boat['Displacement'] != "0"){ echo $boat['Displacement'] . " ". $boat['DisplacementUnit']; } ?></li>
                            <li>Min Draft: <?php if ($boat['MinDraft'] != "0"){ echo $boat['MinDraft']; } ?></li>
                            <li>Max Draft: <?php if ($boat['MaxDraft'] != "0"){ echo $boat['MaxDraft']; } ?></li>
                            <li>Ballast: <?php if ($boat['Ballast'] != "0"){ echo $boat['Ballast'] . " ". $boat['BallastUnit']; } ?></li>
                        </ul>
						</div>
                        <div class="one">
                        <h3>Engines</h3>
                        
                        <ul>
                            <li>Number of Engines: <?php echo $engine['EngineNo'] ?></li>
                            <li>Engine(s) Make: <?php echo $engine['EngineMake'] ?></li>
                            <li>Engine Model: <?php echo $engine['EngineModel'] ?></li>
                            <li>Engine Year: <?php if ($engine['EngineYear'] != "0000"){ echo $engine['EngineYear']; }?></li>
                            <li>Engine Fuel Type: <?php echo ($engine['EngineFuel'])?></li>
                            <li>Engine Propeller Type: <?php echo ($engine['PropellerType'])?></li>
                            <li>Engine Hours: <?php if ($engine['EngineHours'] != "0"){ echo $engine['EngineHours']; }?></li>
                        </ul>
                        </div>
                        <div class="one">
                        <h3>Tankage</h3>
                        
                        <ul>
                            <li>Fuel: <?php if ($boat['FuelTankNo'] != "0"){ echo $boat['FuelTankNo'] . " x " . $boat['FuelTankCap'] . " " . $boat['FuelTankCapUnit']; } ?></li>
                            <li>Water: <?php if ($boat['WaterTankNo'] != "0"){ echo $boat['WaterTankNo'] . " x " . $boat['WaterTankCap'] . " " . $boat['WaterTankCapUnit']; } ?></li>
                            <li>Holding: <?php if ($boat['HoldingTankNo'] != "0"){ echo $boat['HoldingTankNo'] . " x " . $boat['HoldingTankCap'] . " " . $boat['HoldingTankCapUnit']; } ?></li>
                        </ul>
                    	</div>
                    
                    	 <?php // echo $boat['Description'] ?>
                                                            
                    </div>
					<div id="tabLiTwo" class="specific" style="display:none">
                    	
                        <h3>Specifications</h3>
                        
                        <ul>                        	
                        	<li>Length:  <?php echo $boat['Length']; ?> <?php echo $boat['LengthUnit']; ?></li>
                        	<li>Beam : <?php if ($boat['Beam'] != "0"){ echo $boat['Beam']; } ?></li>
                        	<li>Capacity, Fuel : <?php echo $boat['FuelTankCap'];?> <?php echo $boat['FuelTankCapUnit'];?></li>
                        	<li>Bridge Clearance w/Arch or Tower :<?php echo $boat['BridgeClearance'];?> <?php echo $boat['BridgeClearanceUnit'];?></li>
                        	<li>Capacity Fresh Water: <?php echo $boat['WaterTankCap'];?> <?php echo $boat['WaterTankCapUnit'];?></li>
                        	<li>Draft Drive Up : <?php echo $boat['MinDraft'];?> <?php echo $boat['MinDraftUnit'];?></li>
                        	<li>Draft, Drive Down: <?php echo $boat['MaxDraft'];?> <?php echo $boat['MaxDraftUnit'];?></li>
                        	<li>Dry Weight: <?php echo $boat['DryWeight'];?> <?php echo $boat['DryWeightUnit'];?></li>
                        </ul>
                        
                        <div class="right">
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
					<div id="tabLiThree" class="specific" style="display:none">
                    	<div class="one">
                        <h3>Construction</h3>
                        
                        <ul>
                            <li>Builder: <?php echo $boat['Builder']; ?></li>
                            <li>Designer: <?php echo $boat['Designer']; ?></li>
                            <li>Construction: <?php echo $boat['HullMaterial']; ?></li>
                        </ul>
                        
                        </div>
                        
                    </div>
                    <div id="tabLiFour" class="calc"  >
                    	
                       <div style="display:none;" id="descriptions ">
                                <?php 
                                $Query = "SELECT * FROM `".$table_prefix."bv_descriptions` WHERE BoatID=$id";
                                $textdata = mysql_query($Query); 
                                
                                while($text = mysql_fetch_array($textdata)) {
                                    if ($text['AddTitle'] != "customContactInformation" && $text['AddTitle'] != "Disclaimer"){
                                        echo "<div class='first'>";
                                        echo "<h4>" . $text['AddTitle'] . "</h4>";
                                        $text['AddDescription']=str_replace("Ã¢","'",$text['AddDescription']);
                                        echo "<p>" . $text['AddDescription'] . "</p>";
                                        echo "</div>";
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
                                        echo "<div class='third'>";
                                        echo "<h4>" . $text['AddTitle'] . "</h4>";
                                        $text['AddDescription']=str_replace("Ã¢","'",$text['AddDescription']);
                                        $text['AddDescription']=str_replace("?","'",$text['AddDescription']);
                                        echo "<p>" . $text['AddDescription'] . "</p>";
                                        echo '</div>';
                                    }
                                }
                                
                                ?>
                    </div>
                    
                    </div>
                    <div id="tabLiFive" class="trade" style="display:none">
                    	
                        <?php echo do_shortcode("[gravityform id=2 ajax=true]"); ?>    
                    
                    </div>
				</div>
				
				</div>
                
                
				
				 <div class="form-right">
				 <h1>Call (937) 382-8701</h1>
				 <em>Request More Information</em>
					<?php echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true"]'); ?>
					 <div class="clear"></div>
				 </div>
                
                <div class="clear"></div>
                
                
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
				
                    
                    <div style="display:none; float: right;width: 20%;padding-top: 20px;"><h3>Sales Contact Information:</h3>
                        <p><?php echo $boat["BrokerName"].'<br>'.$boat["LocationCity"].','.$boat["LocationState"].'&nbsp;'.$boat["LocationCountry"].'<br>'.$boat["BrokerTel"];?>
                        <br />
                    <?php echo $boat["BrokerTel"];?></p>
                    </div>
				<!--  \ fotm bar / -->
				
			</div>
			<!--  \ center side/ -->
		</div>
		<!--  \ content / -->
		
		<!--  / footer \ -->
		<div id="footer">

            <!--<div id="descriptions">
                                <?php 
                                $Query = "SELECT * FROM `".$table_prefix."bv_descriptions` WHERE BoatID=$id";
                                $textdata = mysql_query($Query); 
                                
                                while($text = mysql_fetch_array($textdata)) {
                                    if ($text['AddTitle'] != "customContactInformation" && $text['AddTitle'] != "Disclaimer"){
                                        echo "<div class='first'>";
                                        echo "<h4>" . $text['AddTitle'] . "</h4>";
                                        $text['AddDescription']=str_replace("Ã¢","'",$text['AddDescription']);
                                        echo "<p>" . $text['AddDescription'] . "</p>";
                                        echo "</div>";
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
                                        echo "<div class='third'>";
                                        echo "<h4>" . $text['AddTitle'] . "</h4>";
                                        $text['AddDescription']=str_replace("Ã¢","'",$text['AddDescription']);
                                        $text['AddDescription']=str_replace("?","'",$text['AddDescription']);
                                        echo "<p>" . $text['AddDescription'] . "</p>";
                                        echo '</div>';
                                    }
                                }
                                
                                ?>
                    </div>-->
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
if (@$_POST['make'] && $_POST['make'] != ""){
	$SearchMake = $_POST['make'];
	$Query.= " AND Make ='$SearchMake'";
}
if (@$_POST["type"] && $_POST["type"] != ""){
	$SearchType = $_POST["type"];
	$Query.= " AND Category ='$SearchType'";
}
if (@$_POST["minprice"] && $_POST["minprice"] != ""){
	$SearchMinPrice = filter_var($_POST["minprice"], FILTER_SANITIZE_NUMBER_INT);					
	$Query.= " AND Price >='$SearchMinPrice' ";
}
if (@$_POST["maxprice"] && $_POST["maxprice"] != ""){
	$SearchMaxPrice = filter_var($_POST["maxprice"], FILTER_SANITIZE_NUMBER_INT);
	$Query.= " AND Price <='$SearchMaxPrice' ";
}
if (@$_POST["minlength"] && $_POST["minlength"] != ""){
	$SearchMinLength = filter_var($_POST["minlength"], FILTER_SANITIZE_NUMBER_INT);
	$Query.= " AND Length >='$SearchMinLength'";
}
if (@$_POST["maxlength"] && $_POST["maxlength"] != ""){
	$SearchMaxLength = filter_var($_POST["maxlength"], FILTER_SANITIZE_NUMBER_INT);
	//$SearchMaxLength = $_POST["maxlength"];
	$Query.= " AND Length <='$SearchMaxLength'";
}

if (@$_POST["location"] && $_POST["location"] != ""){
	$SearchLocation = $_POST["location"];
	$Query.= " AND LocationCountry ='$SearchLocation'";
}
if (@$_POST["Year"] && $_POST["Year"] != ""){
	$SearchLocation = $_POST["Year"];
	$Query.= " AND Year ='$SearchLocation'";
}
$Query.= " AND (Status = 'Active') ";
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
	} else {
	$Query.= " ORDER BY Length DESC";
	} 
// echo $Query;
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
<form name="frmNoPage" class="fromlisting" action="<?php echo $searchurl;?>" method="post">
	<div id="sidebar" class="sidebar-search" style="height:327px;">
	
		<!-- START SEARCH BOX -->
		<h4>SEARCH BOATS FOR SALE</h4>
				<div class="option">
					<strong>Type</strong><br/>
						<select name="type" id="Type">
						<?php if (!$_POST['type'] || $_POST['type'] == ""){?>
		              		<option value="" selected="selected">All Boats</option>					
		              	<?php }else{ ?>
							<option value="" >All Boats</option>
						<?php }
						$Querysearch = "SELECT DISTINCT Category FROM `".$table_prefix."bv_boatdetails` WHERE (Status = 'Active' OR Status = 'Sale Pending') ORDER BY Category";
						$result = mysql_query($Querysearch);
						while ( $row=mysql_fetch_array($result)) {			
							$SearchType = $row["Category"];
							if ($_POST['type'] == $SearchType){
								echo "<option value=\"" . $SearchType . "\" selected=\"selected\">" . $SearchType . "</option>";
							} else if ($SearchType != ""){	 
              					echo "<option value=\"" . $SearchType . "\">" . $SearchType . "</option>";
							}
						}?>
            		</select>            
            	</div>
            	<div class="option">
            		<strong>Make</strong><br/>
					<select name="make" id="Make">
						<?php if (!$_POST['make'] || $_POST['make'] == ""){?>
		              		<option value="" selected="selected">All Manufacturers</option>
						<?php }else{ ?>
							<option value="" >All Manufacturers</option>
						<?php }
						$Querysearch = "SELECT DISTINCT Make FROM `".$table_prefix."bv_boatdetails` WHERE (Status = 'Active' OR Status = 'Sale Pending') ORDER BY Make";
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
            	<?php /*?><div class="option">
            		<strong>In This Country</strong><br/>
				  <select name="location" id="Location">
						<?php if (!$_POST['location'] || $_POST['location'] == ""){?>
		              		<option value="" selected="selected">Anywhere</option>
						<?php }else{ ?>
							<option value="" >Anywhere</option>
						<?php }
						$Querysearch = "SELECT DISTINCT LocationCountry FROM `".$table_prefix."bv_boatdetails` ORDER BY LocationCountry";
						$result = mysql_query($Querysearch);
						while ( $row = mysql_fetch_array( $result ) ) {
							$SearchLocation = $row["LocationCountry"]; 
							require("countries.php");
							if ($_POST['location'] == $SearchLocation){ 
							echo "<option value=\"" . $SearchLocation . "\" selected=\"selected\">" . $SearchLocationText . "</option>";							
							} else if ($SearchLocation != ""){	 
              				echo "<option value=\"" . $SearchLocation . "\">" . $SearchLocationText . "</option>";
							}
						}?>
            		</select>            
            	</div><?php */?>
            	<div class="option">
            		<strong>In This Year</strong><br/>
			<?php /*?>	  <select name="Year" id="Year">
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
            		</select>      <?php */?>     
					<input type="text" name="Year" id="Year" value="<?php echo $_POST['Year'];?>" />
					 
            	</div>
               <!-- <input type="hidden"  name="page" value="<?php echo $page;?>"/>-->
            	<input type="submit" class="button" name="SimpleSearch" value="Search" />
				
				
				 
        <!-- END SEARCH BOX -->
        
	</div>
    
<!--</form>
<form name="frmNoPage" action="" method="post">-->
<?php		echo '<div class="pagina">';
			$dotTrue='1';		
			$result=mysql_query($Query);
			$all_result=mysql_num_rows($result);
					
			// calculate total number of pages needed
			$pages=ceil($all_result/$results_per_page);
			if(isset($_POST['page']))
			{
				$noPage=$_POST['page'];
			}
			if (isset($noPage)&& $noPage!=''){
				$offset=$results_per_page*($noPage-1);
			}else{
				$offset=0;
			}
				
			$Query.= " LIMIT $offset, $results_per_page";
					
			$get_first_result=mysql_query($Query);
			// list page navgation ([1] 2 3 4 5)
				echo '<span>'.$all_result . " results found... </span>";
				$pageNo=1;
					    
				if (isset($noPage)){
					$currentpage = $noPage;
				}else{
					$currentpage = 1;
				}
				
					    
				if ($currentpage != 1){
					$previous = $currentpage - 1;
					echo "<a href=\"javascript:goTo(".$previous.");\" class=\"nextPreviousPaginationPrev\">&lt;&lt;</a>&nbsp;";
				}
				$lastpage=ceil($all_result/$results_per_page);
				$tPages=$pages;
				while($pages) 
				{
					if($tPages<10)
					{
						if ($pageNo==$currentpage) 
						{
							echo "<a href=\"javascript:goTo(".$pageNo.");\" class=\"nextPreviousPaginationActive\"><b>[".$pageNo."]</b></a>&nbsp;\n";
						} 
						else 
						{
							echo "<a href=\"javascript:goTo(".$pageNo.");\" class=\"nextPreviousPagination\">".$pageNo."</a>&nbsp;\n";
						}
					}
					else
					{
					
					//echo $pages."(".$currentpage.",".($currentpage-1).",".($currentpage+1).','.$lastpage.','.($lastpage-1).',1,2)';
						if(in_array($pageNo,array($currentpage,$currentpage-1,$currentpage+1,$currentpage+2,$currentpage-2,$lastpage,$lastpage-1,1,2)))
						{		$dotTrue='1';				
							if ($pageNo==$currentpage) 
							{
								echo "<a href=\"javascript:goTo(".$pageNo.");\" class=\"nextPreviousPaginationActive\"><b>[".$pageNo."]</b></a>&nbsp;\n";
							} 
							else 
							{
								echo "<a href=\"javascript:goTo(".$pageNo.");\" class=\"nextPreviousPagination\">".$pageNo."</a>&nbsp;\n";
							}
						}
						else
						{
							if($dotTrue=='1')
							{
								echo '<a class="nextPreviousPagination">...&nbsp;&nbsp;</a>';
							}	 
							$dotTrue='0';
						}
					}
					$pages--;
					$pageNo++;
				}
				
				
				if ($currentpage != $lastpage){
					$next = $currentpage + 1;
					echo "<a href=\"javascript:goTo(".$next.");\" class=\"nextPreviousPaginationNext\">&gt;&gt;</a>&nbsp;";
				}
				echo '</div>';
				?>
   <input type="hidden" name="page" id="noPage" value="<?php echo $noPage;?>" />             
  <!-- </form>             
			  <form name="sortandfilterSort" class="" action="" method="post">-->
				<div id="sort">
					Sort By: 
					<select name="sort" onchange="javascript:document.frmNoPage.submit()">
						<option value="lengthdesc" <?php if (@$_POST['sort'] == "lengthdesc") { echo "selected=\"selected\"";}?>>Length (high to low)</option>
						<option value="lengthasc" <?php if (@$_POST['sort'] == "lengthasc") { echo "selected=\"selected\"";}?>>Length (low to high)</option>
						<option value="pricedesc" <?php if (@$_POST['sort'] == "pricedesc") { echo "selected=\"selected\"";}?>>Price (high to low)</option>
						<option value="priceasc" <?php if (@$_POST['sort'] == "priceasc") { echo "selected=\"selected\"";}?>>Price (low to high)</option>		
						<option value="yeardesc" <?php if (@$_POST['sort'] == "yeardesc") { echo "selected=\"selected\"";}?>>Year (newer to older)</option>
						<option value="yearasc" <?php if (@$_POST['sort'] == "yearasc") { echo "selected=\"selected\"";}?>>Year (older to newer)</option>
					</select>
				</div>
                <!--<input type="hidden" name="page" id="noPage" value="<?php echo $noPage;?>" /> -->  
			  </form>
				<!--  / gallery bar \ -->
				<div class="listgrid">                	                    <a href="javascript:void()" class="grid">Grid</a>                                        <a href="javascript:void()" class="list">List</a>                                    </div> 
                <!-- <input type="hidden" name="page" id="noPage" value="<?php echo $noPage;?>" />  --> 
               <script type="text/javascript">                	jQuery("a.grid").click(function() {					jQuery(".galleryBar ul#boat-content").addClass("gridview");					jQuery(".galleryBar ul#boat-content").removeClass("listview");					});					jQuery("a.list").click(function() {					jQuery(".galleryBar ul#boat-content").addClass("listview");					jQuery(".galleryBar ul#boat-content").removeClass("gridview");					});                </script>	
				<div class="galleryBar">
				<?php
					$timpath=get_bloginfo('url').'/wp-content/plugins/boats inventory/timthumb/timthumb.php';


				?>
                	
                    <ul id="boat-content">
                    	<?php if ($all_result < 1){ 
						echo "<li style=\"line-height:20px\">There are no boats in our database that match your search today, however if you contact us and let us know what you are looking for, we would be glad to help.</li>";
					} else { $data_p = mysql_query($Query); 
						while($info = mysql_fetch_array($data_p)) { ?>
                    	<li>
                            <div class="left">
                           <?php     //Grab first image from listing
							$id = $info['BoatID'];
							//-- For total image count --//
							$QueryboatImgCount1 = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id ORDER BY ImageRanking";
							$QueryboatImgCount = mysql_query($QueryboatImgCount1); 
							$totaleImg=@mysql_num_rows($QueryboatImgCount);
							
							$Queryboat = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id ORDER BY ImageRanking limit 0,1";
							$imagedata = mysql_query($Queryboat); 
							while($image = mysql_fetch_array($imagedata)) {?>
								<a href="<?php echo $mainPath.HtAccessURL('inventory',$info['Make'].':'.$info['Model'].':'.$info['BoatID']);?>" />
                                	<img src="<?php echo $timpath; ?>?src=<?php echo $image['ImageURL'];?>&w=330&h=245&zc=1&q=100" alt="<?php echo $info['Make'] .'&nbsp;'. $info['Model'];?>" />
                                </a>
                                <?php }?>
                            </div>
                            
                            <div class="center">
                                
                                <h2>
								<a href="<?php echo $mainPath.HtAccessURL('inventory',$info['Make'].':'.$info['Model'].':'.$info['BoatID']);?>" />
								<?php echo $info['Year'].'&nbsp;'.$info['Make'].'&nbsp;'.$info['Model'];?>
								</a><br/>
								<span class="stockListing"><label>Boat ID:</label><?php echo $info['BoatID'];?></span>
								<span class="stockListing"><?php if ($info['Name'] != "") echo " &nbsp; Boat Name: ".$info["Name"];?></span>
								<span class="stockListing"><label> &nbsp; LOA:</label><?php echo $info['LOA']." ft.";?></span>
								<span class="stockListing"><label> &nbsp; Location:</label><?php echo $info['LocationCity'].", ".$info['LocationState'];?></span>
								<div class="clear"></div>	
								</h2>
                                
                                <ul>
                                <?php 
								$Queryboat = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id ORDER BY ImageRanking limit 1,10";
								$imagedata = mysql_query($Queryboat); 
								while($image = mysql_fetch_array($imagedata)) {?>
                                    <li><img src="<?php echo $image['ImageURL'];?>" alt="<?php echo $info['Make'] .'&nbsp;'. $info['Model'];?>" /></li>
                                   <?php }?>
                                </ul>
                            
                            </div>
                            
                            <div class="right">
                                
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
								if ($info['DispalyStatus'] != "true" && $Price>0) {
									echo $PriceCurrency . $Price;
								} else {
									echo "Contact for complete info";
								}?>
                                </span>
                                
                                <ul>
                                    <li class="photo"><a href="<?php echo $mainPath.HtAccessURL('inventory',$info['Make'].':'.$info['Model'].':'.$info['BoatID']);?>"><?php echo $totaleImg;?> Photos</a></li>
                                    <li class="view">
                                    	<a href="<?php echo $mainPath.HtAccessURL('inventory',$info['Make'].':'.$info['Model'].':'.$info['BoatID']);?>" />View Detail</a>
                                    </li>
                                    <li class="contact"><a href="<?php echo $mainPath.HtAccessURL('inventory',$info['Make'].':'.$info['Model'].':'.$info['BoatID']);?>">Contact</a></li>
                                </ul>
                            
                            </div>
						</li>
                        <?php 
							}
						}?>
                    </ul>
                     
				</div>
				<!--  \ gallery bar / -->
<?php
			echo '<div class="pagina gap">';
			$dotTrue='1';		
			$result=mysql_query($QueryNav);
			$all_result=mysql_num_rows($result);
					
			// calculate total number of pages needed
			$pages=ceil($all_result/$results_per_page);
			if(isset($_POST['page']))
			{
				$noPage=$_POST['page'];
			}
			if (isset($noPage)&& $noPage!=''){
				$offset=$results_per_page*($noPage-1);
			}else{
				$offset=0;
			}
				
			$Query.= " LIMIT $offset, $results_per_page";
					
			$get_first_result=mysql_query($QueryNav);
			// list page navgation ([1] 2 3 4 5)
				echo '<span>'.$all_result . " results found... </span>";
				$pageNo=1;
					    
				if (isset($noPage)){
					$currentpage = $noPage;
				}else{
					$currentpage = 1;
				}
				
					    
				if ($currentpage != 1){
					$previous = $currentpage - 1;
					echo "<a href=\"javascript:goTo(".$previous.");\" class=\"nextPreviousPaginationPrev\">&lt;&lt;</a>&nbsp;";
				}
				$lastpage=ceil($all_result/$results_per_page);
				$tPages=$pages;
				while($pages) 
				{
					if($tPages<10)
					{
						if ($pageNo==$currentpage) 
						{
							echo "<a href=\"javascript:goTo(".$pageNo.");\" class=\"nextPreviousPaginationActive\"><b>[".$pageNo."]</b></a>&nbsp;\n";
						} 
						else 
						{
							echo "<a href=\"javascript:goTo(".$pageNo.");\" class=\"nextPreviousPagination\">".$pageNo."</a>&nbsp;\n";
						}
					}
					else
					{
					
					//echo $pages."(".$currentpage.",".($currentpage-1).",".($currentpage+1).','.$lastpage.','.($lastpage-1).',1,2)';
						if(in_array($pageNo,array($currentpage,$currentpage-1,$currentpage+1,$currentpage+2,$currentpage-2,$lastpage,$lastpage-1,1,2)))
						{		$dotTrue='1';				
							if ($pageNo==$currentpage) 
							{
								echo "<a href=\"javascript:goTo(".$pageNo.");\" class=\"nextPreviousPaginationActive\"><b>[".$pageNo."]</b></a>&nbsp;\n";
							} 
							else 
							{
								echo "<a href=\"javascript:goTo(".$pageNo.");\" class=\"nextPreviousPagination\">".$pageNo."</a>&nbsp;\n";
							}
						}
						else
						{
							if($dotTrue=='1')
							{
								echo '<a class="nextPreviousPagination">...&nbsp;&nbsp;</a>';
							}	 
							$dotTrue='0';
						}
					}
					$pages--;
					$pageNo++;
				}
				
				
				if ($currentpage != $lastpage){
					$next = $currentpage + 1;
					echo "<a href=\"javascript:goTo(".$next.");\" class=\"nextPreviousPaginationNext\">&gt;&gt;</a>&nbsp;";
				}
				echo '</div>';
				?>
			</div>
			<!--  \ center side/ -->
		</div>
		<!--  \ content / -->
		
		
	</div>
	<!--  \ layout / -->
	
</div>
<?php } ?>
<script type="text/javascript" >
jQuery(document).ready(function() {
	jQuery('.ad-thumbs ul li').each(function(u) {  
		jQuery(this).find('a.tps'+u+'').on( "click", function() {
				jQuery('.ad-thumbsty ul li').each(function() {		
				jQuery(this).find('a.tps'+u+'').trigger( "click" );
			}); 
		});
		
	});
	
});
</script>

<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/lightbox.min.js"></script>

<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/lightbox.css" rel="stylesheet" type="text/css"> 
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script>