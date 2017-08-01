<?php 
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
<script type="text/javascript">
function goTo(page) {
	var url="index.php";
	hu=window.location.search.substring(1);
	query=hu.replace(/page=[0-9][0-9]/g,"");
	query=query.replace(/page=[0-9]/g,"");
    url=url+"?page="+page+"&"+query;
    url=url.replace(/&&/g,'&');
	document.location.href = url;
	return false;
}
</script>
<?php if($_GET['edit'])
{
	$boatid=$_GET['edit'];
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL;?>/boats inventory/js/stepcarousel.js"></script>
<style type="text/css">
.stepcarousel{
position: relative; /*leave this value alone*/
border: 10px solid black;
overflow: scroll; /*leave this value alone*/
width: 600px; /*Width of Carousel Viewer itself*/
height: 420px; /*Height should enough to fit largest content's height*/
}
.stepcarousel .belt{
position: absolute; /*leave this value alone*/
left: 0;
top: 0;
}
.stepcarousel .panel{
float: left; /*leave this value alone*/
overflow: hidden; /*clip content that go outside dimensions of holding panel DIV*/
margin: 10px; /*margin around each panel*/
width: 583px; /*Width of each panel holding each content. If removed, widths should be individually defined on each content DIV then. */
}
</style>
<script type="text/javascript">
	stepcarousel.setup({
	galleryid: 'mygallery', //id of carousel DIV
	beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
	panelclass: 'panel', //class of panel DIVs each holding content
	autostep: {enable:true, moveby:1, pause:3000},
	panelbehavior: {speed:500, wraparound:false, wrapbehavior:'slide', persist:true},
	defaultbuttons: {enable: true, moveby: 1, leftnav: ['<?php echo WP_PLUGIN_URL;?>/boats inventory/images/leftnav.gif', -5, 180], rightnav: ['<?php echo WP_PLUGIN_URL;?>/boats inventory/images/rightnav.gif', -20, 180]},
	statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
	contenttype: ['inline'] //content setting ['inline'] or ['ajax', 'path_to_external_file']
})
</script>

<input  style="width:100px; cursor:pointer;" type="button" name="btnBack" value="Return Back" onclick="history.go(-1);" /></p>
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
?>
<iframe src="<?php echo $video['VideoURL'];?>" width="100%" height="392px" scrolling="no"></iframe>


<?php 
//Convert common currencies from codes to symbols
$boat['PriceCurrency']=str_replace("GBP","&pound;",$boat['PriceCurrency']);
$boat['PriceCurrency']=str_replace("USD","&#36",$boat['PriceCurrency']);
$boat['PriceCurrency']=str_replace("EUR","&euro;",$boat['PriceCurrency']);
$boat['Price'] = number_format($boat['Price']);
if ($boat['TaxStatus'] == "Not Paid"){
	$boat['Price'] .= " ex Vat";
} else if ($boat['TaxStatus'] == "Paid"){
	$boat['Price'] .= " inc Vat";
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
<?php echo '
<div>'.$boat["Year"].'&nbsp;&nbsp;'.$boat["Make"].'</div>
<div>'.$boat["Model"].'</div>
<br/><br/>
<div><b>Dealer Info:<b><br>'.$boat["Company"].'<br>'.$boat["OfficeID"].'&nbsp;'.$boat["BrokerName"].'<br>'.$boat["LocationCity"].','.$boat["LocationState"].'&nbsp;'.$boat["LocationCountry"].'<br>'.$boat["BrokerTel"].'</div>


<div id="mygallery" class="stepcarousel">
	<div class="belt">';?>
		<?php 
			$Query = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id";
			$imagedata = mysql_query($Query); 
			while($image = mysql_fetch_array($imagedata)) {?>
			<div class="panel"><img src="<?php echo $image['ImageURL'] ?>" /></div>
		<?php }?>
<?php	echo '</div>
</div>            
	<div id="description">
						<h1 class="boat-title">';?><?php echo $boat['Make'] . " " . $boat['Model']; ?><?php echo '</h1>	
						<p>';?><?php echo $boat['Description'] ?><?php echo '</p>
						<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js#appId=228358150539054&amp;xfbml=1"></script>
						<fb:like href="';?><?php echo $url; ?><?php echo '" send="true" width="470" show_faces="true" font=""></fb:like>
						<br/><br/>
						<div id="essentials">
							<ul class="essentials">';?>
								<li><strong>Price: </strong><?php if ($boat['Price'] != "1"){ echo $boat['PriceCurrency'].' '; ?><?php echo $boat['Price']; 
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
	<!--END BASIC DETAILS-->
<?php    
?>
<input  style="width:100px; cursor:pointer;" type="button" name="btnBack" value="Return Back" onclick="history.go(-1);" /></p>
<?php }
else
{	
	
	
	$Query = "SELECT * FROM `".$table_prefix."bv_boatdetails` WHERE BoatID > 0";
					
if (@$_POST['make'] && $_POST['make'] != ""){
	$SearchMake = $_POST['make'];
	$Query.= " AND Make ='$SearchMake'";
}
if (@$_POST["type"] && $_POST["type"] != ""){
	$SearchType = $_POST["type"];
	$Query.= " AND Category ='$SearchType'";
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
if (@$_POST["location"] && $_POST["location"] != ""){
	$SearchLocation = $_POST["location"];
	$Query.= " AND LocationCountry ='$SearchLocation'";
}
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
 //echo $Query;
	$QueryResult=mysql_fetch_array(mysql_query($Query));	
	
?>
<div id="emailTemplate">
<div id="container">

	<form name="sortandfilter" class="" action="<?php echo $searchurl;?>" method="post">
	<div id="sidebar" class="sidebar-search" style="height:327px;">
	
		<!-- START SEARCH BOX -->
		<h4>SEARCH BOATS FOR SALE</h4>
				<div class="option">
					<strong>I want to search for</strong><br/>
						<select name="type" id="Type">
						<?php if (!$_POST['type'] || $_POST['type'] == ""){?>
		              		<option value="" selected="selected">All Boats</option>					
		              	<?php }else{ ?>
							<option value="" >All Boats</option>
						<?php }
						$Querysearch = "SELECT DISTINCT Category FROM `".$table_prefix."bv_boatdetails` ORDER BY Category";
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
            		<strong>Manufacturer</strong><br/>
					<select name="make" id="Make">
						<?php if (!$_POST['make'] || $_POST['make'] == ""){?>
		              		<option value="" selected="selected">All Manufacturers</option>
						<?php }else{ ?>
							<option value="" >All Manufacturers</option>
						<?php }
						$Querysearch = "SELECT DISTINCT Make FROM `".$table_prefix."bv_boatdetails` ORDER BY Make";
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
            		<strong>Min Price ($)</strong><br/>
            		<?php if (@$_POST['minprice']){ 
            			echo "<input name=\"minprice\" type=\"text\" value=\"" . $_POST['minprice'] . "\"/>&nbsp;&nbsp;";
            		} else {
            			echo "<input name=\"minprice\" type=\"text\"/>&nbsp;&nbsp;";
            		}?>
            	</div>
            	<div class="option">
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
						<? } else if ($_POST['currency'] == "USD"){ ?>
							<option value="">-</option>
							<option value="GBP">GBP</option>
							<option value="EUR">Euro</option>
							<option value="USD" selected="selected">USD</option>
						<? } ?>
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
            	<div class="option">
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
				</div>
            	<div class="option">
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
            	</div>
            	<input type="submit" class="button" name="SimpleSearch" value="Search" />
				
				
				 
        <!-- END SEARCH BOX -->
        
	</div>
	</form> 
	<div id="boat-content">
	
		<!-- START PAGE NUMBERS -->
		<div id="page-numbers">				
			<?php					
			$result=mysql_query($Query);
			$all_result=mysql_num_rows($result);
					
			// calculate total number of pages needed
			$pages=ceil($all_result/$results_per_page);
					
			if (isset($_GET['page'])){
				$offset=$results_per_page*($_GET['page']-1);
			}else{
				$offset=0;
			}
					
			$Query.= " LIMIT $offset, $results_per_page";
					
			$get_first_result=mysql_query($Query);
			// list page navgation ([1] 2 3 4 5)
				echo $all_result . " results found... ";
				$pageNo=1;
					    
				if (isset($_GET['page'])){
					$currentpage = $_GET['page'];
				}else{
					$currentpage = 1;
				}
					    
				if ($currentpage != 1){
					$previous = $currentpage - 1;
					echo "<a href=\"javascript:goTo(".$previous.");\">&lt;&lt;</a>&nbsp;";
				}
					    
				while($pages) {
					if ($pageNo==$currentpage) {
						echo "<a href=\"javascript:goTo(".$pageNo.");\"><b>[".$pageNo."]</b></a>&nbsp;\n";
					} else {
					    echo "<a href=\"javascript:goTo(".$pageNo.");\">".$pageNo."</a>&nbsp;\n";
					}
					$pages--;
					$pageNo++;
				}

				$lastpage=ceil($all_result/$results_per_page);
				
				if ($currentpage != $lastpage){
					$next = $currentpage + 1;
					echo "<a href=\"javascript:goTo(".$next.");\">&gt;&gt;</a>&nbsp;";
				}

				?>
				<form name="sortandfilterSort" class="" action="<?php echo $searchurl;?>" method="post">
				<div id="sort">
					Sort By: 
					<select name="sort" onchange="javascript:document.sortandfilter.submit()">
						<option value="lengthdesc" <?php if (@$_POST['sort'] == "lengthdesc") { echo "selected=\"selected\"";}?>>Length (high to low)</option>
						<option value="lengthasc" <?php if (@$_POST['sort'] == "lengthasc") { echo "selected=\"selected\"";}?>>Length (low to high)</option>
						<option value="pricedesc" <?php if (@$_POST['sort'] == "pricedesc") { echo "selected=\"selected\"";}?>>Price (high to low)</option>
						<option value="priceasc" <?php if (@$_POST['sort'] == "priceasc") { echo "selected=\"selected\"";}?>>Price (low to high)</option>		
						<option value="yeardesc" <?php if (@$_POST['sort'] == "year