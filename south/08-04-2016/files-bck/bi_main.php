<?php
ob_start();
/*
 Plugin Name: Boats Inventory
 Plugin URI: http://www.dreamsoftinfotech.com/
 Description: This Plugin specialy design for handle inventory system of new and used boad.
 Version: 1.0.0
 Author: Boats Inventory
 Author URI: http://www.dreamsoftinfotech.com/
 */
// Global Parameters
ob_start();
$siteurl = get_option('siteurl');
$inventoryLimit=12;
global $wpdb,$user,$siteurl,$inventoryLimit;
$table_prefix=$wpdb->prefix;
// Activation/Deactivation Process
require_once('paging_functions.php'); //Get Paging file
register_activation_hook(__FILE__,'boatInventoryInstall');
register_deactivation_hook(__FILE__ ,'boatInventoryUninstall');
$timpath=get_bloginfo('url').'/wp-content/plugins/boats inventory/timthumb/timthumb.php';
// Instalation Process
function boatInventoryInstall()
{
	global $wpdb;
	$table_prefix=$wpdb->prefix;
	$structure1 = "CREATE TABLE IF NOT EXISTS `".$table_prefix."bv_boatdetails` (
  `BoatID` int(10) NOT NULL,
  `Added` date NOT NULL,
  `NewUsed` char(4) CHARACTER SET utf8 NOT NULL,
  `Make` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Model` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Length` float NOT NULL,
  `LengthUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `LOA` float NOT NULL,
  `LOAUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `LWL` float NOT NULL,
  `LWLUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Year` year(4) NOT NULL,
  `Price` int(11) NOT NULL,
  `PriceCurrency` char(3) CHARACTER SET utf8 NOT NULL,
  `TaxStatus` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Fuel` varchar(15) CHARACTER SET utf8 NOT NULL,
  `HullMaterial` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Keel` varchar(15) CHARACTER SET utf8 NOT NULL,
  `Designer` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Builder` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Status` varchar(15) CHARACTER SET utf8 NOT NULL,
  `Coop` char(5) CHARACTER SET utf8 NOT NULL,
  `Category` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Class` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Description` text CHARACTER SET utf8 NOT NULL,
  `LocationCountry` char(2) CHARACTER SET utf8 NOT NULL,
  `LocationCity` varchar(40) CHARACTER SET utf8 NOT NULL,
  `LocationState` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Company` varchar(30) CHARACTER SET utf8 NOT NULL,
  `OfficeID` smallint(6) NOT NULL,
  `BrokerName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `BrokerEmail` varchar(40) CHARACTER SET utf8 NOT NULL,
  `BrokerTel` varchar(20) CHARACTER SET utf8 NOT NULL,
  `BrokerFax` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Beam` float NOT NULL,
  `BeamUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `BridgeClearance` float NOT NULL,
  `BridgeClearanceUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `MinDraft` float NOT NULL,
  `MinDraftUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `MaxDraft` float NOT NULL,
  `MaxDraftUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `CabinHeadroom` float NOT NULL,
  `CabinHeadroomUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Freeboard` float NOT NULL,
  `FreeboardUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `DryWeight` float NOT NULL,
  `DryWeightUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Ballast` float NOT NULL,
  `BallastUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Displacement` float NOT NULL,
  `DisplacementUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `CruisingSpeed` smallint(6) NOT NULL,
  `CruisingSpeedUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `MaxSpeed` smallint(6) NOT NULL,
  `MaxSpeedUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `FuelTankCap` smallint(6) NOT NULL,
  `FuelTankCapUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `FuelTankNo` tinyint(4) NOT NULL,
  `WaterTankCap` smallint(6) NOT NULL,
  `WaterTankCapUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `WaterTankNo` tinyint(4) NOT NULL,
  `HoldingTankCap` smallint(6) NOT NULL,
  `HoldingTankCapUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `HoldingTankNo` tinyint(4) NOT NULL,
  `SingleBerthNo` tinyint(4) NOT NULL,
  `DoubleBerthNo` tinyint(4) NOT NULL,
  `TwinBerthNo` tinyint(4) NOT NULL,
  `CabinNo` tinyint(4) NOT NULL,
  `BathroomNo` tinyint(4) NOT NULL,
  `HeadNo` tinyint(4) NOT NULL,
  `DispalyStatus` varchar(10) CHARACTER SET utf8 NOT NULL,
  `share_commision` varchar(10) CHARACTER SET utf8 NOT NULL,
  `exclusive_contract` varchar(10) CHARACTER SET utf8 NOT NULL,
  `stockNo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `boatClass` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`BoatID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$structure2 = "CREATE TABLE IF NOT EXISTS `".$table_prefix."bv_descriptions` (
  `BoatID` int(11) NOT NULL,
  `AddTitle` varchar(150) CHARACTER SET utf8 NOT NULL,
  `AddDescription` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$structure3 = "CREATE TABLE IF NOT EXISTS `".$table_prefix."bv_engines` (
  `BoatID` int(11) NOT NULL,
  `EngineMake` varchar(100) CHARACTER SET utf8 NOT NULL,
  `EngineModel` varchar(100) CHARACTER SET utf8 NOT NULL,
  `EngineYear` year(4) NOT NULL,
  `EngineFuel` varchar(20) CHARACTER SET utf8 NOT NULL,
  `EngineNo` char(2) CHARACTER SET utf8 NOT NULL,
  `DriveType` varchar(30) CHARACTER SET utf8 NOT NULL,
  `TotalPower` smallint(6) NOT NULL,
  `TotalPowerUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `PropellerType` varchar(30) CHARACTER SET utf8 NOT NULL,
  `EngineHours` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$structure4 = "CREATE TABLE IF NOT EXISTS `".$table_prefix."bv_features` (
  `BoatID` int(11) NOT NULL,
  `Feature` varchar(100) CHARACTER SET utf8 NOT NULL,
  `FeatureDetails` varchar(250) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$structure5 = "CREATE TABLE IF NOT EXISTS `".$table_prefix."bv_images` (
  `BoatID` int(11) NOT NULL,
  `ImageURL` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ImageRanking` char(2) CHARACTER SET utf8 NOT NULL,
  `ImageTitle` varchar(150) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$structure6 = "CREATE TABLE IF NOT EXISTS `".$table_prefix."bv_videos` (
  `BoatID` int(11) NOT NULL,
  `VideoURL` varchar(150) CHARACTER SET utf8 NOT NULL,
  `VideoTitle` varchar(150) CHARACTER SET utf8 NOT NULL,
  `VideoThumb` varchar(100) CHARACTER SET utf8 NOT NULL,
  `VideoEmbed` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	$structure7 = "CREATE TABLE IF NOT EXISTS `".$table_prefix."bv_pluginsettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1";
	$structure8 = "CREATE TABLE IF NOT EXISTS `".$table_prefix."bv_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(55) NOT NULL,
  `comment` text NOT NULL,
  `BoatID` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4"; 
	$wpdb->query($structure1);
	$wpdb->query($structure2);
	$wpdb->query($structure3);
	$wpdb->query($structure4);
	$wpdb->query($structure5);
	$wpdb->query($structure6);
	$wpdb->query($structure7);
	$wpdb->query($structure8);
	
	wp_schedule_event(time() - 3500, 'minutes_4', 'bi_boatfetchhook');
	update_option ( 'bi_schedularSettings', '' );
	boatfetchingcrone();
}
add_action('bi_boatfetchhook', 'boatfetchingcrone');

/**
 * Function to fetch the boat information using wordpress scheduler task. 
 */
function boatfetchingcrone(){	
	
	$curl = curl_init ();
	curl_setopt ( $curl, CURLOPT_URL, plugin_dir_url( __FILE__ ) . 'scheduler.php'  ); // input
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
	$status = curl_exec ( $curl );
	curl_close ( $curl );
	
	$cacheFolder = dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR;
	$flog = fopen ( $cacheFolder . uniqid(). '.txt', "a+" );
	fwrite ( $flog, "[" . date ( "Y-m-d H:i:s" ) . '] :' . $status . "\r\n" );
	fclose ( $flog );
}
add_filter('cron_schedules', 'new_interval');
// add once 10 minute interval to wp schedules
function new_interval($interval) {
	$interval['minutes_4'] = array('interval' => 4*60, 'display' => 'Once 4 minutes');
	return $interval;
}

// Uninstalation Process
function boatInventoryUninstall()
{
	global $wpdb;
	$table_prefix=$wpdb->prefix;
	$wpdb->query("DROP TABLE `".$table_prefix."bv_boatdetails`");
	$wpdb->query("DROP TABLE `".$table_prefix."bv_descriptions`");
	$wpdb->query("DROP TABLE `".$table_prefix."bv_engines`");
	$wpdb->query("DROP TABLE `".$table_prefix."bv_features`");
	$wpdb->query("DROP TABLE `".$table_prefix."bv_images`");
	$wpdb->query("DROP TABLE `".$table_prefix."bv_videos`");
	$wpdb->query("DROP TABLE `".$table_prefix."bv_pluginsettings`");

	wp_clear_scheduled_hook('boatfetchingCron');
	wp_clear_scheduled_hook('boatfetchingcrone');
	wp_clear_scheduled_hook('bi_boatfetchhook');
}


function inventoryRegistrationInit()
{
	add_action("admin_menu", "boatInventoryRegistrationMenus");
}
add_action("init", "inventoryRegistrationInit");
function boatInventoryRegistrationMenus()
{
	global $wpdb,$user;
	$table_prefix=$wpdb->prefix;
	$icon_url=WP_PLUGIN_URL.'/boats inventory/images/accept2.png';
	//For user role setup
	$current_user = wp_get_current_user();
	$role=$current_user->roles[0];
	$showrole='administrator';
	//For user role setup
	//admin setup
	add_menu_page( "boatInventory", "Boat Inventory", '', "boatInventory/", array (&$this, 'show_menu'), $icon_url );//main menu setup
	//sub menus setup
	add_submenu_page("boatInventory/","Inventory Listing","Inventory Listing",$showrole,"boatInventoryListing","boatInventoryListing");
	add_submenu_page("boatInventory/", "Inventory Settings", "Inventory Settings", $showrole, "boatInventorySettings", "boatInventorySettings");
	add_submenu_page("boatInventory/", "Manufacture's Tags", "Manufacture's Tags", $showrole, "manufactureTags", "manufactureTags");
	add_submenu_page("boatInventory/", "Data Import", "Data Import", $showrole, "boatInventoryImport", "boatInventoryImport");
	add_submenu_page("boatInventory/", "Inventory Comments", "Inventory Comments", $showrole, "boatInventoryComment", "boatInventoryComment");
}
function boatInventoryComment()
{require_once("bi_boatComments.php");}
function boatInventoryListing()
{require_once("bi_boatListing.php");}
function boatInventorySettings()
{
	require_once("bi_boatSettings.php");
	
}
function boatInventoryImport()
{
	require_once("bi_boatImport.php");
}
function manufactureTags()
{
	require_once("bi_manufactureTags.php");
}
add_filter('the_content', 'boatInventoryCheckpat');
function boatInventoryCheckpat($content)
{

	global $wpdb,$user,$siteurl;
	$current_user = wp_get_current_user();
	$role=$current_user->roles[0];
	$current_user_id=$current_user->ID;

	$pattern = '#\[bi_boats_listing id=[0-9]+]#';
	preg_match_all($pattern, $content, $matches);
	foreach ($matches[0] as $match)
	{
		$idTemp=explode('id=',$match);
		$TBid=explode(']',$idTemp[1]);
		$rpl=frontendBoatsListing($TBid[0]);
		$content= preg_replace($pattern, $rpl, $content);
	}

	$pattern = '#\[bi_boats_listing]#';
	preg_match_all($pattern, $content, $matches);
	foreach ($matches[0] as $match)
	{
		$rpl=frontendBoatsListing();
		$content= preg_replace($pattern, $rpl, $content);
	}

	$pattern1 = '#\[bi_boats_listing_new]#';
	preg_match_all($pattern1, $content, $matches1);
	foreach ($matches1[0] as $match1)
	{
		$rpl1=frontendBoatsListingNew();
		$content= preg_replace($pattern1, $rpl1, $content);
	}

	$pattern2 = '#\[biBoatsByManufactures id="[A-Za-z0-9][^+]+"]#';
	preg_match_all($pattern2, $content, $matches2);
	foreach ($matches2[0] as $match2)
	{
		$idMTemp=explode('id="',$match2);
		$TMid=explode('"]',$idMTemp[1]);
		$rpl2=frontendManufacturesBoatListing($TMid['0']);
		$content= preg_replace($pattern2, $rpl2, $content);
	}
	$pattern3 = '#\[biBoatsByManufacturesNew id="[A-Za-z0-9][^+]+"]#';
	preg_match_all($pattern3, $content, $matches3);
	foreach ($matches3[0] as $match3)
	{
		$idMTemp3=explode('id="',$match3);
		$TMid3=explode('"]',$idMTemp3[1]);
		$rpl3=frontendManufacturesBoatListing($TMid3['0'],'New');
		$content= preg_replace($pattern3, $rpl3, $content);
	}

	$pattern4 = '#\[biBoatsByManufacturesUsed id="[A-Za-z0-9][^+]+"]#';
	preg_match_all($pattern4, $content, $matches4);
	foreach ($matches4[0] as $match4)
	{
		$idMTemp4=explode('id="',$match4);
		$TMid4=explode('"]',$idMTemp4[1]);
		$rpl4=frontendManufacturesBoatListing($TMid4['0'],'Used');
		$content= preg_replace($pattern4, $rpl4, $content);
	}

	$pattern5 = '#\[bi_boats_search_result]#';
	preg_match_all($pattern5, $content, $matches5);
	foreach ($matches5[0] as $match5)
	{
		$rpl5=frontendBoatSearchResult();
		$content= preg_replace($pattern5, $rpl5, $content);
	}

	$pattern6 = '#\[bi_boats_featured_new]#';
	preg_match_all($pattern6, $content, $matches6);
	foreach ($matches6[0] as $match6)
	{
		$rpl6=featuredBoatsData('','New');
		$content= preg_replace($pattern6, $rpl6, $content);
	}

	$pattern7 = '#\[bi_boats_featured_used]#';
	preg_match_all($pattern7, $content, $matches7);
	foreach ($matches7[0] as $match7)
	{
		$rpl7=featuredBoatsData('','Used');
		$content= preg_replace($pattern7, $rpl7, $content);
	}

	//-- location - New
	$pattern8 = '#\[bi_boats_location_new location="[A-Za-z0-9][^+]+"]#';
	preg_match_all($pattern8, $content, $matches8);
	foreach ($matches8[0] as $match8)
	{
		$location1=explode('location="',$match8);
		$location2=explode('"]',$location1[1]);
		$rpl8=frontendBoatsListingNew($location2['0']);
		$content= preg_replace($pattern8, $rpl8, $content);
	}

	//-- location - Used
	$pattern9 = '#\[bi_boats_location_used location="[A-Za-z0-9][^+]+"]#';
	preg_match_all($pattern9, $content, $matches9);
	foreach ($matches9[0] as $match9)
	{
		$location1=explode('location="',$match9);
		$location2=explode('"]',$location1[1]);
		$rpl9=frontendBoatsListing('',$location2['0']);
		$content= preg_replace($pattern9, $rpl9, $content);
	}

	//-- location - Manufactures
	$pattern10 = '#\[bi_boats_location_manufacture id="[A-Za-z0-9][^+]+" location="[A-Za-z0-9][^+]+"]#';
	preg_match_all($pattern10, $content, $matches10);
	foreach ($matches10[0] as $match10)
	{
		$location1=explode('location="',$match10);
		$location2=explode('"]',$location1[1]);
		$idMTemp3=explode('id="',$match10);
		$TMid3=explode('" ',$idMTemp3[1]);
		$rpl10=frontendManufacturesBoatListing($TMid3['0'],'',$location2['0']);
		$content= preg_replace($pattern10, $rpl10, $content);
	}

	//-- location - Manufactures - new
	$pattern10 = '#\[bi_boats_location_manufacture_new id="[A-Za-z0-9][^+]+" location="[A-Za-z0-9][^+]+"]#';
	preg_match_all($pattern10, $content, $matches10);
	foreach ($matches10[0] as $match10)
	{
		$location1=explode('location="',$match10);
		$location2=explode('"]',$location1[1]);
		$idMTemp3=explode('id="',$match10);
		$TMid3=explode('" ',$idMTemp3[1]);
		$rpl10=frontendManufacturesBoatListing($TMid3['0'],'New',$location2['0']);
		$content= preg_replace($pattern10, $rpl10, $content);
	}

	//-- location - Manufactures -used
	$pattern10 = '#\[bi_boats_location_manufacture_used id="[A-Za-z0-9][^+]+" location="[A-Za-z0-9][^+]+"]#';
	preg_match_all($pattern10, $content, $matches10);
	foreach ($matches10[0] as $match10)
	{
		$location1=explode('location="',$match10);
		$location2=explode('"]',$location1[1]);
		$idMTemp3=explode('id="',$match10);
		$TMid3=explode('" ',$idMTemp3[1]);
		$rpl10=frontendManufacturesBoatListing($TMid3['0'],'Used',$location2['0']);
		$content= preg_replace($pattern10, $rpl10, $content);
	}

	//-- location - partyID
	$pattern11 = '#\[bi_boats_location_parytid partyid="[A-Za-z0-9][^+]+"]#';
	preg_match_all($pattern11, $content, $matches11);
	foreach ($matches11[0] as $match11)
	{
		$location1=explode('partyid="',$match11);
		$location2=explode('"]',$location1[1]);
		$rpl11=frontendBoatsListing('','',$location2['0']);
		$content= preg_replace($pattern11, $rpl11, $content);
	}
	//---[bi_boats_brokerage]
	$pattern12 = '#\[bi_boats_brokerage]#';
	preg_match_all($pattern12, $content, $matches12);
	foreach ($matches12[0] as $match12)
	{
		$brokerageData=brokerageBoatsData();
		$content= preg_replace($pattern12, $brokerageData, $content);
	}

	$pattern13 = '#\[bi_boats_listing_brokerage]#';
	preg_match_all($pattern13, $content, $matches13);
	foreach ($matches13[0] as $match13)
	{
		$brokerage=frontendBoatsListingBrokerage();
		$content= preg_replace($pattern13, $brokerage, $content);
	}

	return $content;
}
function frontendBoatsListingNew($locationCity='')
{
	require_once("frontendBoatListingUsed.php");
}
function frontendBoatsListingBrokerage()
{
	require_once("frontendBoatsListingBrokerage.php");
}
function frontendBoatsListing($Bid='',$locationCity='',$partyID='')
{
	//$_GET['edit']=$Bid;
	require("frontendBoatListing.php");
}
function frontendManufacturesBoatListing($TMid='',$NewUsed='',$locationCity='')
{
	require("frontendManufacturesBoatListing.php");
}
function frontendBoatSearchResult()
{
	require_once("frontendSearchResult.php");
}
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'inventory', array(
		'public' => true,
		'has_archive' => true,
		'show_in_admin_bar' => false,
		'show_ui' => true,

	)
	);
}
//------ Featured Inventory boats --------//
add_action("widgets_init", 'widget_FeaturedInventory_init');
function widget_FeaturedInventory_init() {
	register_widget('biFeaturedInventoryWidget');
}
class biFeaturedInventoryWidget extends WP_Widget
{
	function biFeaturedInventoryWidget() {
		$widget_ops = array('description' => __('biFeaturedInventoryWidget', 'biFeaturedInventoryWidget'));
		$this->WP_Widget('featured-inventory-biwidget', __('Featured Inventory', 'biFeaturedInventoryWidget'), $widget_ops);
	}
	function form($instance){
		
		/*if($_SERVER['REQUEST_METHOD']=='POST'){
			$data=array(
				'option1'=>'','option2'=>''
			);
			if (isset($_REQUEST['featured-inventory-biwidget_option1'])){
				$data['option1'] = esc_attr($_POST['featured-inventory-biwidget_option1']);
			}
			if (isset($_REQUEST['featured-inventory-biwidget_option2'])){
				$data['option2'] = esc_attr($_POST['featured-inventory-biwidget_option2']);			
			}
			update_option('biFeaturedInventoryWidget', $data);
		}
		
		$data = @get_option('biFeaturedInventoryWidget');
		*/
		//print_r($instance);
		?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>">Featured box's Title:
	<input name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" value="<?php echo esc_attr($instance[ 'title' ]); ?>" style="width: 100%;" /> </label>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'boatnumber' ); ?>">Boat's comma seperated Id's(i.e 1,2,3):
	<input name="<?php echo $this->get_field_name( 'boatnumber' ); ?>" type="text" id="<?php echo $this->get_field_id( 'boatnumber' ); ?>" value="<?php echo esc_attr($instance[ 'boatnumber' ]); ?>" style="width: 100%;" /> </label>
</p>
		<?php
		
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['boatnumber'] = strip_tags( $new_instance['boatnumber'] );
		return $instance;
	}
	
	function widget($args,$instance)
	{
		echo $args['before_widget'];
		$data=get_option('biFeaturedInventoryWidget');
		echo $args['before_title'] . $instance['title'] . $args['after_title'];
		featuredBoatsData($instance['boatnumber']);
		echo $args['after_widget'];
	}
	function biwidget($args,$instance)
	{
		echo $args['before_widget'];
		$data=get_option('biFeaturedInventorySearch');
		echo $args['before_title'] . $instance['title'] . $args['after_title'];
		featuredSearchData($instance['boatnumber']);
		echo $args['after_widget'];
	}
	/* function register()
	 {
	 wp_register_sidebar_widget('Featured Inventory Boats', 'widget');
	 wp_register_widget_control('Featured Inventory Boats', 'control');
	 }*/
}

function featuredBoatsData($data='',$boatType='')
{
	global $wpdb,$user,$siteurl,$timpath;
	$table_prefix=$wpdb->prefix;
	?>
<div id="featured" class="flexslider carousel">
	<ul class="slides">
	<?php
	echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/boats inventory/css/biMainCss.css" />' . "\n";
	require_once("HtAccessURL.php");
	if ( get_option('permalink_structure') ) {
		define(HTACCESS,'ON');
		$mainPath=get_site_url().'/';
	} else {
		define(HTACCESS,'OFF');
		$mainPath=get_permalink();
	}
	$data = explode(",", $data);
	$data = "'". implode("','", $data) ."'";
	$queryBoat = "SELECT * FROM `".$table_prefix."bv_boatdetails` where BoatID in (".$data.")";
	//$queryBoat = "SELECT * FROM `".$table_prefix."bv_boatdetails` where BoatID>0 ";
	if($boatType!='') {
		$queryBoat.= " AND NewUsed='$boatType'";
	}
	//echo $queryBoat;
	$resultBoat = $wpdb->get_results($queryBoat);
	shuffle($resultBoat);
	$itr=0;
	if(!empty($resultBoat))
	{
		foreach($resultBoat as $tempBoat)
		{
			$itr++;
			if($itr>=100){break;}
			$id=$tempBoat->BoatID;
			$Query = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id";
			$imagedata = $wpdb->get_results($Query);
?>
		<li class="homefeatured">
			<div class="featuredInventoryDiv">
				<a title="<?php echo $tempBoat->Model;?>" href="<?php echo $mainPath.HtAccessURL('inventory',$tempBoat->Make.':'.$tempBoat->Model.':'.$tempBoat->BoatID);?>">
					<img border="0" alt="<?php echo $tempBoat->Model;?>" src="<?php echo $imagedata[0]->ImageURL; ?>"
					class="homefeatureimg"> </a>
				<p class="homefeaturedtext">
					<a title="<?php echo $tempBoat->Model;?>"
						href="<?php echo $mainPath.HtAccessURL('inventory',$tempBoat->Make.':'.$tempBoat->Model.':'.$tempBoat->BoatID);?>"> <?php echo $tempBoat->Model;?> </a>
				</p>
				<ul>
					<li><h1>Make:</h1> <?php echo $tempBoat->Make;?></li>
					<li><h1>Model:</h1> <?php echo $tempBoat->Model;?></li>
					<li><h1>Year:</h1> <?php echo $tempBoat->Year;?></li>
					<li><h1>Price:</h1> <?php
					if($tempBoat->Status=="Sale Pending") //If Boat status is Sale pending
					echo "Sale Pending";
					else
					{
						if ($tempBoat->Price != "1") {
							$PriceCurrency=str_replace("USD","&#36;",$tempBoat->PriceCurrency);
							echo $PriceCurrency . $tempBoat->Price;
						} else {
							echo "Contact us for price";
						}
					}
					?>
					</li>
					<li><a href="<?php echo $mainPath.HtAccessURL('inventory',$tempBoat->Make.':'.$tempBoat->Model.':'.$tempBoat->BoatID);?>"> Click here for more details </a>
					</li>
				</ul>


			</div>
		</li>

		<?php }
	}
	else
	{
		echo 'No record(s) found.';
	}
	echo '</ul></div>';
}
function brokerageBoatsData()
{
	global $wpdb,$user,$siteurl,$timpath;
	$table_prefix=$wpdb->prefix;
	?>
		<div id="featured" class="brokerageboats">
			<ul class="homefeatured">
			<?php
			echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/boats inventory/css/biMainCss.css" />' . "\n";
			require_once("HtAccessURL.php");
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
			//$queryBoat = "SELECT * FROM `".$table_prefix."bv_boatdetails` where BoatID in (".$data.")";
			$queryBoat = "SELECT * FROM `".$table_prefix."bv_boatdetails` where BoatID > 0 AND share_commision='true' AND exclusive_contract	='true'";
			$resultBoat=$wpdb->get_results($queryBoat);
			shuffle($resultBoat);
			$itr=0;
			if(!empty($resultBoat))
			{
				foreach($resultBoat as $tempBoat)
				{
					$itr++;
					if($itr>=5){break;}
					$id=$tempBoat->BoatID;
					$Query = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id";
					$imagedata = $wpdb->get_results($Query);
					?>
				<li class="homefeatured">
					<div class="featuredInventoryDiv">
						<a title="<?php echo $tempBoat->Model;?>"
							href="<?php echo $mainPath.HtAccessURL('inventory',$tempBoat->Make.':'.$tempBoat->Model.':'.$tempBoat->BoatID);?>"> <img
							alt="<?php echo $tempBoat->Model;?>" src="<?php echo $timpath; ?>?src=<?php echo $imagedata[0]->ImageURL; ?>&w=90&h=60&zc=1&q=100" class="homefeatureimg">
						</a>
						<p class="homefeaturedtext">
							<a title="<?php echo $tempBoat->Model;?>"
								href="<?php echo $mainPath.HtAccessURL('inventory',$tempBoat->Make.':'.$tempBoat->Model.':'.$tempBoat->BoatID);?>"> <?php echo $tempBoat->Model;?> </a>

						</p>
						<ul>
							<li><h1>Make:</h1> <?php echo $tempBoat->Make;?></li>
							<li><h1>Model:</h1> <?php echo $tempBoat->Model;?></li>
							<li><h1>Year:</h1> <?php echo $tempBoat->Year;?></li>
							<li><h1>Price:</h1> <?php 
							if($tempBoat->Status=="Sale Pending") //If Boat status is Sale pending
							echo "Sale Pending";
							else
							{
								if ($tempBoat->Price != "1") {
									$PriceCurrency=str_replace("USD","&#36;",$tempBoat->PriceCurrency);
									echo $PriceCurrency . $tempBoat->Price;
								} else {
									echo "Contact us for price";
								}
							}
							?>
							</li>
							<li><a href="<?php echo $mainPath.HtAccessURL('inventory',$tempBoat->Make.':'.$tempBoat->Model.':'.$tempBoat->BoatID);?>"> Click here for more details </a>
							</li>
						</ul>


					</div>
				</li>

				<?php }
			}
			else
			{
				echo 'No record(s) found.';
			}
			echo '</ul></div>';
}
?>
<?php
//------ Featured Search --------//
add_action("widgets_init", 'biFeaturedInventorySearch_init');
function biFeaturedInventorySearch_init() {
	register_widget('biFeaturedInventorySearch');
}
class biFeaturedInventorySearch extends WP_Widget
{
	function biFeaturedInventorySearch() {
		$widget_ops = array('description' => __('biFeaturedInventorySearch', 'biFeaturedInventorySearch'));
		$this->WP_Widget('widget', __('Featured Inventory Search', 'biFeaturedInventorySearch'), $widget_ops);
	}
	function form($instance){
		$data = @get_option('biFeaturedInventorySearch');
		?>
				<p>
					<label>Featured Search Title:<input name="widget_name_option1" type="text" value="<?php echo $data['option1']; ?>" style="width: 100%;" /> </label>
				</p>
				<p>
					<label>Search Results Page Path:<input name="widget_name_option2" type="text" value="<?php echo $data['option2']; ?>" style="width: 100%;" /> </label>
				</p>
				<?php
				if (isset($_POST['widget_name_option1'])){
					$data['option1'] = esc_attr($_POST['widget_name_option1']);
					$data['option2'] = esc_attr($_POST['widget_name_option2']);
					update_option('biFeaturedInventorySearch', $data);
				}
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}
	function widget($args,$instance)
	{
		echo $args['before_widget'];
		$data=get_option('biFeaturedInventorySearch');
		echo $args['before_title'] . $data['option1'] . $args['after_title'];
		featuredSearchData($data['option2']);
		echo $args['after_widget'];
	}
	/*function register()
	 {
	 wp_register_sidebar_widget('Featured Inventory Search',  'widget');
	 wp_register_widget_control('Featured Inventory Search', 'control');
	 }*/
}
function featuredSearchData($data)
{
	global $wpdb,$user,$siteurl;
	$table_prefix=$wpdb->prefix;
	?>
				<form name="frmNoPage" id="frmNoPage" class="fromlisting" action="<?php echo get_option('home'); ?>/?page_id=380" >
					<div id="sidebar" class="sidebar-search" style="margin-top: 6px">
						<div class="option">
<input type="hidden" name="page_id" value="380" />
							<label>Type</label>

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
							<div class="selectopt">
								<select name="NewUsed" class="turnintodropdown" id="NewUsed">

									<option value="">All Boats</option>

									<option value="New" <?php if ($_POST['NewUsed'] =='New'){?> selected="selected" <?php } ?>>New</option>

									<option value="Used" <?php if ($_POST['NewUsed'] =='Used'){?> selected="selected" <?php } ?>>Used</option>

								</select>
							</div>
						</div>

						<div class="option hidetitle">

							<strong>Make</strong><br />

							<div class="selectopt">
								<select name="make" class="turnintodropdown" id="Make">

								<?php if (!$_POST['make'] || $_POST['make'] == ""){?>

									<option value="" selected="selected">All Manufacturers</option>

									<?php }else{ ?>

									<option value="">All Manufacturers</option>

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
						</div>

						<div class="option hidetitle">

							<strong>Model</strong><br />

							<div class="selectopt">

								<select name="Model" class="turnintodropdown" id="Model">

								<?php if (!$_POST['Model'] || $_POST['Model'] == ""){?>

									<option value="" selected="selected">All Model</option>

									<?php }else{ ?>

									<option value="">All Model</option>

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
						</div>
						
						<div class="option hidetitle">

							<strong>Class</strong><br />

							<div class="selectopt">

								<select name="class" class="turnintodropdown" id="boatClass">

								<?php if (!$_POST['class'] || $_POST['class'] == ""){?>

									<option value="" selected="selected">All Class</option>

									<?php }else{ ?>

									<option value="">All Class</option>

									<?php }

									$Querysearch = "SELECT DISTINCT boatClass FROM `".$table_prefix."bv_boatdetails` WHERE (Status = 'Active') ORDER BY boatClass";

									$result = mysql_query($Querysearch);

									while ( $row=mysql_fetch_array($result)) {

										$SearchModel = $row["boatClass"];

										if ($_POST['class'] == $SearchModel){

											echo "<option value=\"" . $SearchModel . "\" selected=\"selected\">" . $SearchModel . "</option>";

										} else if ($SearchModel != ""){

											echo "<option value=\"" . $SearchModel . "\">" . $SearchModel . "</option>";

										}

									}?>

								</select>

							</div>
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

						<div class="option hidetitle">



							<strong>Min Length (ft)</strong><br />

							<?php if (@$_POST['minlength']){

								echo "<input name=\"minlength\" type=\"text\" value=\"" . $_POST['minlength'] . "\" />&nbsp;&nbsp;";

							} else {

								echo "<input name=\"minlength\" type=\"text\" placeholder=\"Min Length (ft)\" />&nbsp;&nbsp;";

							}?>

						</div>

						<div class="option hidetitle">

							<strong>Max Length (ft)</strong><br />

							<?php if (@$_POST['maxlength']){

								echo "<input name=\"maxlength\" type=\"text\" value=\"" . $_POST['maxlength'] . "\"/>&nbsp;&nbsp;";

							} else {

								echo "<input name=\"maxlength\" type=\"text\" placeholder=\"Max Length (ft)\" />&nbsp;&nbsp;";

							}?>

						</div>

						<div class="option hidetitle">

							<strong>Year (ex. 2003-2007)</strong><br />

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



							<input type="text" name="Year" id="Year" size="3" placeholder="Year 2003" value="<?php echo $_POST['Year'];?>" /> <input type="text" name="Year2" id="Year2" size="3" placeholder="2007" value="<?php echo $_POST['Year2'];?>" />

						</div>

						<div class="option minsearch hidetitle">

							<strong>Min Price ($)</strong><br />

							<?php if (@$_POST['minprice']){

								echo "<input name=\"minprice\" type=\"text\" value=\"" . $_POST['minprice'] . "\"/>&nbsp;&nbsp;";

							} else {

								echo "<input name=\"minprice\" type=\"text\" placeholder=\"Min Price ($)\" />&nbsp;&nbsp;";

							}?>

						</div>

						<div class="option minsearch1 hidetitle">

							<strong>Max Price ($)</strong><br />

							<?php if (@$_POST['maxprice']){

								echo "<input name=\"maxprice\" type=\"text\" value=\"" . $_POST['maxprice'] . "\"/>&nbsp;&nbsp;";

							} else {

								echo "<input name=\"maxprice\" type=\"text\" placeholder=\"Max Price ($)\" />&nbsp;&nbsp;";

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

						<div class="option location hidetitle">

							<strong>Search by Location</strong><br />

							<div class="selectopt">
								<select name="location" id="Location">

								<?php if (!$_POST['location'] || $_POST['location'] == ""){?>

									<option value="" selected="selected">Anywhere</option>

									<?php }else{ ?>

									<option value="">Anywhere</option>

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

									<option value="47684" <?php if($_POST['location']=='47684'){echo "selected=\"selected\"";}?>>Singleton Marine Group of Atlanta</option>

									<option value="47686" <?php if($_POST['location']=='47686'){echo "selected=\"selected\"";}?>>SMG Blue Creek Marina Lake Martin</option>

									<option value="47688" <?php if($_POST['location']=='47688'){echo "selected=\"selected\"";}?>>SMG Boat Liquidation Center</option>

									<option value="47690" <?php if($_POST['location']=='47690'){echo "selected=\"selected\"";}?>>SMG Keowee North Marine Lake Keowee</option>

									<option value="47692" <?php if($_POST['location']=='47692'){echo "selected=\"selected\"";}?>>SMG Lako Oconee</option>

									<option value="28803" <?php if($_POST['location']=='28803'){echo "selected=\"selected\"";}?>>SMG Yacht Center at Holiday Marina</option>

								</select>
							</div>

						</div>

						<!-- <input type="hidden"  name="page" value="<?php echo $page;?>"/>-->

						<input type="submit" class="button" name="SimpleSearch" value="Search" />
					</div>

				</form>
				<?php }
				//---- Rating System ----//
				function bi_rating()
				{}

				function similarSearchData()
				{
					global $wpdb,$user,$siteurl,$timpath;
					if(!explode(',',$data)){$data=0;}
					$table_prefix=$wpdb->prefix;
					require_once("HtAccessURL.php");
					if(isset($Bid) && $Bid!='')
					{
						$_GET['edit']=$Bid;
					}else{
						$Bid=$_GET['edit'];
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
					if(!isset($Bid) || $Bid=='')
					{
						$temparr1=@explode('inventory/',$_SERVER['REQUEST_URI']);
						$temparr2=@explode('-',$temparr1['1']);
						$tempIndex=count($temparr2)-1;
						$temparr=@explode('/',$temparr2[$tempIndex]);
						$Bid=@trim($temparr['0']);
					}
					?>
				<div>
					<ul class="homefeatured">
					<?php
					//$queryBoat = "SELECT * FROM `".$table_prefix."bv_boatdetails` where BoatID in (".$data.")";
					/*$queryBoat = "SELECT * FROM `".$table_prefix."bv_boatdetails` where Make=(SELECT Make FROM `".$table_prefix."bv_boatdetails` where BoatID=$Bid) AND Model=(SELECT Model FROM `".$table_prefix."bv_boatdetails` where BoatID=$Bid) AND BoatID!=$Bid limit 0,4";
					 $resultBoat=$wpdb->get_results($queryBoat);
					 if(empty($resultBoat))
					 {
					 $queryBoat = "SELECT * FROM `".$table_prefix."bv_boatdetails` where Make=(SELECT Make FROM `".$table_prefix."bv_boatdetails` where BoatID=$Bid) AND Year=(SELECT Year FROM `".$table_prefix."bv_boatdetails` where BoatID=$Bid) AND BoatID!=$Bid limit 0,4";
					 $resultBoat=$wpdb->get_results($queryBoat);
					 }*/
					$queryBoat = "SELECT * FROM `".$table_prefix."bv_boatdetails` where boatClass=(SELECT boatClass FROM `".$table_prefix."bv_boatdetails` where BoatID=$Bid) AND BoatID!=$Bid limit 0,100";
					$resultBoat=$wpdb->get_results($queryBoat);
					//print_r($resultBoat);
					if(!empty($resultBoat))
					{
						foreach($resultBoat as $tempBoat)
						{
							$id=$tempBoat->BoatID;
							$Query = "SELECT * FROM `".$table_prefix."bv_images` WHERE BoatID=$id";
							$imagedata = $wpdb->get_results($Query);
							?>
						<li class="homefeatured">
							<div class="featuredInventoryDiv">
								<a title="<?php echo $tempBoat->Model;?>"
									href="<?php echo $mainPath.HtAccessURL('inventory',$tempBoat->Make.':'.$tempBoat->Model.':'.$tempBoat->BoatID);?>"> <img
									alt="<?php echo $tempBoat->Model;?>" src="<?php echo $imagedata[0]->ImageURL; ?>"
									class="homefeatureimg"> </a>
								<p class="homefeaturedtext">
									<a title="<?php echo $tempBoat->Model;?>"
										href="<?php echo $mainPath.HtAccessURL('inventory',$tempBoat->Make.':'.$tempBoat->Model.':'.$tempBoat->BoatID);?>"> <?php echo $tempBoat->Model;?> </a>

								</p>
								<ul>
									<li><h1>Make:</h1> <?php echo $tempBoat->Make;?></li>
									<li><h1>Model:</h1> <?php echo $tempBoat->Model;?></li>
									<li><h1>Year:</h1> <?php echo $tempBoat->Year;?></li>
									<li><h1>Price:</h1> <?php
									if($tempBoat->Status=="Sale Pending") //If Boat status is Sale pending
									echo "Sale Pending";
									else
									{
										if ($tempBoat->Price != "1") {
											$PriceCurrency=str_replace("USD","&#36;",$tempBoat->PriceCurrency);
											echo $PriceCurrency . $tempBoat->Price;
										} else {
											echo "Contact us for price";
										}
									}
									?>
									</li>
									<!--<li><a href="<?php echo $mainPath.HtAccessURL('inventory',$tempBoat->Make.':'.$tempBoat->Model.':'.$tempBoat->BoatID);?>">
				Click here for more details
				</a></li>-->
								</ul>


							</div>
						</li>

						<?php }
					}
					else
					{
						echo 'No record(s) found.';
					}
					echo "</ul></div>";
				}
				function searchByStockNo($data)
				{
					?>
						<form name="frmNoPage" class="" action="<?php echo $data;?>" method="post">
							<div id="sidebar" class="sidebar-search" style="margin-top: 6px">
								<div class="option">
									<strong>Stock Number</strong><br /> <input type="text" name="stockNo" id="stockNo" value="<?php echo $_POST['stockNo'];?>" />
								</div>
								<p class="buttonStockP">
									<input type="hidden" name="featuredSearch" value="1" /> <input type="submit" class="buttonStock" name="SimpleSearch" value="Search" />
								</p>
							</div>
						</form>
						<?php
				}?>