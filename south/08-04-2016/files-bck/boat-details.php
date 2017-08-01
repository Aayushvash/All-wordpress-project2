<?php 
//This document displays the individual boat spec
ini_set('max_execution_time', '60');

//Include database class
require("classes/db.class.php");
$db = new db();

//Include details php file
require("includes/get-details.php");

//Contact form redirect code
function curPageURL() {
$pageURL = 'http';
if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
$url = curPageURL();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title><?php echo $boat['Make'] . " " . $boat['Model']; ?> boat for sale</title>
<meta name="keywords" content="<?php echo $boat['Make']; ?>, <?php echo $boat['Model']; ?>, <?php echo $boat['LocationCountry']; ?>, boat for sale, used boat, brokerage, yacht" />
<meta name="description" content="<?php strip_tags ($boat['Description']); ?>" />
<link href="includes/brokerage-boats.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script type="text/javascript" src="galleria/galleria-1.2.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css" />
<script type="text/javascript" src="shadowbox/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init({ language: 'en', players: ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'] });
</script>
<!-- Facebook Opengraph -->
<meta property="og:title" content="<?php echo $boat['Make'] . " " . $boat['Model']; ?> for sale" />
<meta property="og:type" content="product" />
<meta property="og:url" content="<?php echo $url; ?>" />
<meta property="og:image" content="http://www.boatwizardwebsolutions.co.uk/used-boats-for-sale/for-sale.gif" />
<meta property="og:description" content="View this boat for sale. Includes price information, photos, downloadable PDF brochure, videos (where available) and more!" />
<meta property="og:site_name" content="Broker Name" />
<meta property="fb:admins" content="100002748181602" />
<meta property="fb:app_id" content="228358150539054" />
    <div id="fb-root"></div>
<script type="text/javascript">
  window.fbAsyncInit = function() {
    FB.init({appId: '228358150539054', status: true, cookie: true, xfbml: true});
                };
window.setTimeout(function() {
    FB.Canvas.setAutoResize();
  }, 250);
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +
      'http://connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
</script>
</head>

<body id="used">
<div id="container">
		<div id="sidebar" style="height:600px;">
		
			<!-- START CONTACT FORM -->
			<h4>QUICK CONTACT FORM</h4>
			<?php 
			if ($_GET['sent']){
			echo "<p class=\"top-para\">THANK YOU</p><p>Your enquiry has been sent sucessfully and a member of our team will be in contact as soon as possible</p>";
			}else{?>

			<p>Please use the contact details above or fill in this quick contact form if you have any questions about this boat. </p>
			<p>* Email address is a required field.</p>
			<form style="width:265px; text-align:left" action="/contact-form.php" method="post">
				<input type="hidden" name="url" value="<?php echo $url;?>"/>
				<div id="option">												
					Name:<br/> 
					<input type="text" name="name" style="width: 200px;" />				
				</div>
				<div id="option">							
					Email: <br/>
					<input type="text" name="email" style="width: 200px" />
				</div>
				<div id="option">	
					Phone: <br/>
					<input type="text" name="phone" style="width: 200px;" />
				</div>
				<div id="option">	
					Subject: <br/>
					<input type="text" name="interested" style="width: 260px;" value="<?php echo $boat['BoatID'] . " - " . $boat['Make'] . " " . $boat['Model']; ?>" />
				</div>
				<div id="option">
					Enquiry:<br/>
					<textarea name="comments" style="height: 100px; width: 260px;" cols="20"></textarea>
				</div>
				<br/>
				<input type="submit" name="Submit0" value="Submit" style="width: 100px;" />		
			</form>
			
			<?php } ?>
			<!-- END CONTACT FORM -->
			
		</div>
			<div id="boat-content">
				<a href="javascript:history.back(1);">&lt; Back to Previous Page</a>
				
				<!-- START IMAGE GALLERY -->
				<?php $boatid = $_GET['BoatID'];?>
				<div id="image-gallery">
					<div id="gallery">
						<?php 
						$Query = "SELECT * FROM images WHERE BoatID=$id";
						$imagedata = $db->db_query($Query); 
						while($image = $db->db_rs($imagedata)) {?>
						<img src="<?php echo $image['ImageURL'] ?>" /><br/>
						<?php }?>
					</div>
					<script type="text/javascript">
						Galleria.loadTheme('galleria/themes/twelve/galleria.twelve.min.js');
						$("#gallery").galleria({
						width: 583,
						height: 350
						});
					</script>
				</div>
				<!-- END IMAGE GALLERY -->
				
				<!--START BASIC DETAILS-->
					<div id="description">
						<h1 class="boat-title"><?php echo $boat['Make'] . " " . $boat['Model']; ?></h1>	
						<p><?php echo $boat['Description'] ?></p>
						<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js#appId=228358150539054&amp;xfbml=1"></script>
						<fb:like href="<?php echo $url; ?>" send="true" width="470" show_faces="true" font=""></fb:like>
						<br/><br/>
						<div class="details-buttons">
							<a href="pdffullspec.php?BoatID=<?php echo $boat['BoatID']; ?>" target="_blank">Print Details</a>
							<?php if ($video['VideoURL']){
								echo "<a rel=\"shadowbox;width=700;height=400;\" href=\"" . $video['VideoURL'] . "\">View Video</a>";
							}?>
						</div>
						<div id="essentials">
							<ul class="essentials">
								<li><strong>Price: </strong><?php if ($boat['Price'] != "1"){ echo $boat['PriceCurrency']; ?><?php echo $boat['Price']; 
								} else { echo "Contact us for price"; }?></li>
								<li><strong>Model Year:</strong> <?php echo $boat['Year']; ?></li>
								<li><strong>Boat Ref:</strong> <?php echo $boat['BoatID']; ?></li>
								<li><strong>Location:</strong> <?php echo $boat['LocationCity'] . ", " . $boat['LocationCountry']; ?></li>
							</ul>
						</div>
					</div>
					<div id="full-specs">
						<div class="column1">
							<span class="heading">Construction</span>
							<ul class="specs">
								<li>Builder: <?php echo $boat['Builder']; ?></li>
								<li>Designer: <?php echo $boat['Designer']; ?></li>
								<li>Construction: <?php echo $boat['HullMaterial']; ?></li>
							</ul>
							<span class="heading">Measurements</span>
							<ul class="specs">
								<li>Length: <?php echo $boat['Length']; ?></li>
								<li>Beam: <?php if ($boat['Beam'] != "0"){ echo $boat['Beam']; } ?></li>
								<li>Displacement: <?php if ($boat['Displacement'] != "0"){ echo $boat['Displacement'] . " ". $boat['DisplacementUnit']; } ?></li>
								<li>Min Draft: <?php if ($boat['MinDraft'] != "0"){ echo $boat['MinDraft']; } ?></li>
								<li>Max Draft: <?php if ($boat['MaxDraft'] != "0"){ echo $boat['MaxDraft']; } ?></li>
								<li>Ballast: <?php if ($boat['Ballast'] != "0"){ echo $boat['Ballast'] . " ". $boat['BallastUnit']; } ?></li>
							</ul>
						</div>
						<div class="column2">
							<span class="heading">Engines</span>
							<ul class="specs">
								<li>Number of Engines: <?php echo $engine['EngineNo'] ?></li>
								<li>Engine(s) Make: <?php echo $engine['EngineMake'] ?></li>
								<li>Engine Model: <?php echo $engine['EngineModel'] ?></li>
								<li>Engine Year: <?php if ($engine['EngineYear'] != "0000"){ echo $engine['EngineYear']; }?></li>
								<li>Engine Fuel Type: <?php echo ($engine['EngineFuel'])?></li>
								<li>Engine Propeller Type: <?php echo ($engine['PropellerType'])?></li>
								<li>Engine Hours: <?php if ($engine['EngineHours'] != "0"){ echo $engine['EngineHours']; }?></li>
							</ul>
							<span class="heading">Tankage</span>
							<ul class="specs">
								<li>Fuel: <?php if ($boat['FuelTankNo'] != "0"){ echo $boat['FuelTankNo'] . " x " . $boat['FuelTankCap'] . " " . $boat['FuelTankCapUnit']; } ?></li>
								<li>Water: <?php if ($boat['WaterTankNo'] != "0"){ echo $boat['WaterTankNo'] . " x " . $boat['WaterTankCap'] . " " . $boat['WaterTankCapUnit']; } ?></li>
								<li>Holding: <?php if ($boat['HoldingTankNo'] != "0"){ echo $boat['HoldingTankNo'] . " x " . $boat['HoldingTankCap'] . " " . $boat['HoldingTankCapUnit']; } ?></li>
							</ul>
						</div>
					</div>
					<div id="descriptions">
						<?php 
						$Query = "SELECT * FROM descriptions WHERE BoatID=$id";
						$textdata = $db->db_query($Query); 
						while($text = $db->db_rs($textdata)) {
							if ($text['AddTitle'] != "customContactInformation" && $text['AddTitle'] != "Disclaimer"){
								echo "<h4>" . $text['AddTitle'] . "</h4>";
								$text['AddDescription']=str_replace("Ã¢","'",$text['AddDescription']);
								echo "<p>" . $text['AddDescription'] . "</p>";
							}
						}
						$Query = "SELECT * FROM features WHERE BoatID=$id";
						$featuredata = $db->db_query($Query); 
						while($feature = $db->db_rs($featuredata)) {
							$feature['FeatureData']=str_replace("Ã¢","'",$feature['FeatureData']);
							echo "<li>" . $feature['FeatureData'] . "</li>";
						}
						$Query = "SELECT * FROM descriptions WHERE BoatID=$id";
						$textdata = $db->db_query($Query); 
						while($text = $db->db_rs($textdata)) {
							if ($text['AddTitle'] == "customContactInformation" || $text['AddTitle'] == "Disclaimer"){
								$text['AddTitle']=str_replace("customContactInformation","Additional Contact Information",$text['AddTitle']);
								echo "<h4>" . $text['AddTitle'] . "</h4>";
								$text['AddDescription']=str_replace("Ã¢","'",$text['AddDescription']);
								echo "<p>" . $text['AddDescription'] . "</p>";
							}
						}?>
					</div>
				<!--END BASIC DETAILS-->
				
			</div>
		</div>

</body>
</html>