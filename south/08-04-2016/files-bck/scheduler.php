<?php
/**
 * Configure and run the Task Scheduler to extract Boat's information from API URL. 
 * It is replacement of Import-xml.php a System/OS based Task Scheduler to perform the same task.
 */
define ( 'WP_USE_THEMES', false );
define ( 'DEBUG', false );

error_reporting(E_ALL);

/**
 * Loads the WordPress Environment and Template
 */
require (dirname ( __FILE__ ) . '/../../../wp-blog-header.php');
global $wpdb;

$cacheFolder = dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR;

if (! file_exists ( $cacheFolder )) {
	if (! mkdir ( $cacheFolder, 0777, true )) {
		// @error Fail to create Directory, make create cache yourself?
	}
}

require_once (ABSPATH . 'wp-content/plugins/boats inventory/HtAccessURL.php');

/**
 * Log the message in log.txt file.
 * 
 * @param unknown $msg        	
 */
function cLog($msg) {
	global $cacheFolder;
	if (DEBUG) {
		$flog = fopen ( $cacheFolder . 'log.txt', "a+" );
		fwrite ( $flog, "[" . date ( "Y-m-d H:i:s" ) . '] :' . $msg . "\r\n" );
		echo "[" . date ( "Y-m-d H:i:s" ) . '] :' . $msg . "\r\n";
		fclose ( $flog );
	}
}
function IsScriptLocked($script) {
	global $cacheFolder;
	if (file_exists ( $cacheFolder . "task." . $script ))
		return true;
	else
		return false;
}
function CreateScriptLock($script) {
	global $cacheFolder;
	if (IsScriptLocked ( $script )) {
		return false;
	} else {
		$filename = $cacheFolder . "task." . $script;
		$fh = fopen ( $filename, "w" );
		fwrite ( $fh, "1" );
		fclose ( $fh );
		chmod ( $filename, 0777 );
		return IsScriptLocked ( $script );
	}
}
function UnlockScript($script) {
	global $cacheFolder;
	$filename = $cacheFolder . "task." . $script;
	if (IsScriptLocked ( $script )) {
		if (@unlink ( $filename )) {
			return true;
		} else {
			Log::AddEvent ( array (
					"message" => "Fail to unlock the script $script " 
			), "high" );
			return false;
		}
	}
}
function DeleteXML() {
	global $cacheFolder;
	foreach ( glob ( $cacheFolder . "*.xml" ) as $filename ) {
		echo "$filename size " . filesize ( $filename ) . "\n";
		@unlink ( $filename );
	}
}
function ReadWebPage($url, $filepath) {
	$curl = curl_init ();
	$file = fopen ( $filepath, 'w' );
	curl_setopt ( $curl, CURLOPT_URL, $url ); // input
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $curl, CURLOPT_FILE, $file ); // output
	$status = curl_exec ( $curl );
	curl_close ( $curl );
	fclose ( $file );
}

function ResetCron($msg){
	global $Settings;
	cLog($msg);
	$DefaultSettings = array (
			'CurrentID' => uniqid (),
			'state' => 'readxml', // Possible State, readxml, parseXML ...
			'xmldata' => array (
					'currentXMLID' => - 1,
					'readXMLs' => array (),
					'parsedXMLs' => array (),
					'currentXMLFileNames' => array (),
					'XMLURLs' => array ()
			),
			'boatsData' => array (
					'uniqueIDs' => array (),
					'IDsparsed' => array ()
			)
	);
	$Settings = $DefaultSettings;
	DeleteXML ();
}

/**
 * Parse the XML File into the database.
 * 
 * @param unknown $filename        	
 * @return unknown
 */
function ParseXMLFile($filename, $xmlID) {
	global $wpdb, $Settings;
	$table_prefix = $wpdb->prefix;
	$xml = simplexml_load_file ( $filename, 'SimpleXMLElement', LIBXML_NOCDATA ) or  ResetCron ( "Unable to load XML file!" );
	$records = $xml->VehicleRemarketing;
	$iCtr =0;
	
	cLog("Starting File ". $filename );
	cLog("File has ". count($records) ." records");
	
	foreach ( $records as $record ) {
		if ($iCtr == 20) break;
		
		
		// Declare and empty variables
		$BoatID = $Added = $NewUsed = $Make = $Model = $Length = $LengthUnit = $LOA = $LOAUnit = $LWL = $LWLUnit = $Year = $Price = $PriceCurrency = $TaxStatus = $Fuel = $HullMaterial = $Keel = $Designer = $Builder = $Name = $Status = $Coop = $Category = $Class = $Description = $LocationCountry = $LocationCity = $LocationState = $Company = $OfficeID = $BrokerName = $BrokerEmail = $BrokerTel = $BrokerFax = $Beam = $BeamUnit = $BridgeClearance = $BridgeClearanceUnit = $MinDraft = $MinDraftUnit = $MaxDraft = $MaxDraftUnit = $CabinHeadroom = $CabinHeadroomUnit = $Freeboard = $FreeboardUnit = $DryWeight = $DryWeightUnit = $Ballast = $BallastUnit = $Displacement = $DisplacementUnit = $CruisingSpeed = $CruisingSpeedUnit = $MaxSpeed = $MaxSpeedUnit = $FuelTankCap = $FuelTankCapUnit = $FuelTankNo = $WaterTankCap = $WaterTankCapUnit = $WaterTankNo = $HoldingTankCap = $HoldingTankCapUnit = $HoldingTankNo = $SingleBerthNo = $DoubleBerthNo = $TwinBerthNo = $CabinNo = $BathroomNo = $HeadNo = $stockNo = $boatClass = "";
		
		// Populate Boat Details from XML
		$BoatID = $record->VehicleRemarketingHeader->DocumentIdentificationGroup->DocumentIdentification->DocumentID;
		$BoatID = (int)$BoatID ;
		
		cLog("Parsing BoatID" . $BoatID);
		
		
		
		$Added = $record->VehicleRemarketingBoatLineItem->ItemReceivedDate;
		$NewUsed = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->SaleClassCode;
		$Make = addslashes ( $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MakeString );
		$Model = trim ( addslashes ( $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Model ) );
		
		// Loop through Length Nodes
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatLengthGroup) {
			$processlengths = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatLengthGroup;
			foreach ( $processlengths as $processlength ) {
				if ($processlength->BoatLengthCode == "Nominal Length") {
					if ($processlength->BoatLengthMeasure) {
						$Length = $processlength->BoatLengthMeasure;
						$LengthUnit = $processlength->BoatLengthMeasure [0]->attributes ();
					}
				} else if ($processlength->BoatLengthCode == "Length At Water Line") {
					if ($processlength->BoatLengthMeasure) {
						$LWL = $processlength->BoatLengthMeasure;
						$LWLUnit = $processlength->BoatLengthMeasure [0]->attributes ();
					}
				} else if ($processlength->BoatLengthCode == "Length Overall") {
					if ($processlength->BoatLengthMeasure) {
						$LOA = $processlength->BoatLengthMeasure;
						$LOAUnit = $processlength->BoatLengthMeasure [0]->attributes ();
					}
				}
			}
		}
		
		// Loop through IDs
		if ($record->VehicleRemarketingBoatLineItem->Marketing) {
			$processIDs = $record->VehicleRemarketingBoatLineItem->Marketing;
			foreach ( $processIDs as $processID ) {
				if ($processID->PublicationID == "yw") {
					if ($processID->MarketingID) {
						$BoatID = $processID->MarketingID;
					}
				}
			}
		}
		$DispalyStatus = 'false';
		
		$DispalyStatus = $record->VehicleRemarketingBoatLineItem->PricingABIE->PriceHideIndicator;
		$Year = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->ModelYear;
		// $Price = $record->VehicleRemarketingBoatLineItem->PricingABIE->Price->ChargeAmount;
		
		$var = 0;
		if ($record->VehicleRemarketingBoatLineItem->PricingABIE->Price) {
			$Prices = $record->VehicleRemarketingBoatLineItem->PricingABIE->Price;
			
			foreach ( $Prices as $tempPrice ) {
				if ($tempPrice->PriceCode == 'Total') {
					$Price = $tempPrice->ChargeAmount;
					$var ++;
				}
			}
			if ($var == 0) {
				$Price = $record->VehicleRemarketingBoatLineItem->PricingABIE->Price->ChargeAmount;
			}
		}
		
		$PriceCurrency = 'USD'; // $record->VehicleRemarketingBoatLineItem->PricingABIE->Price->ChargeAmount[0]->attributes();
		$TaxStatus = $record->VehicleRemarketingBoatLineItem->Tax->TaxStatusCode;
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingEngineLineItem->VehicleRemarketingEngine->FuelTypeCode) {
			$Fuel = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingEngineLineItem->VehicleRemarketingEngine->FuelTypeCode;
		}
		
		$HullMaterial = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Hull->BoatHullMaterialCode;
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatKeelCode) {
			$Keel = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatKeelCode;
		}
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DesignerName) {
			$Designer = addslashes ( $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DesignerName );
		}
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BuilderName) {
			$Builder = addslashes ( $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BuilderName );
		}
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatName) {
			$Name = addslashes ( $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatName );
		}
		
		$Status = $record->VehicleRemarketingBoatLineItem->SalesStatus;
		// Encapsulated elements with a dash
		$Coop = $record->VehicleRemarketingBoatLineItem->{'Co-OpIndicator'};
		$Category = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatCategoryCode;
		$Class = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatClassGroup;
		$Description = addslashes ( utf8_decode ( $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->GeneralBoatDescription ) );
		$LocationCountry = $record->VehicleRemarketingBoatLineItem->Location->LocationAddress->CountryID;
		
		if ($record->VehicleRemarketingBoatLineItem->Location->LocationAddress->CityName) {
			$LocationCity = addslashes ( $record->VehicleRemarketingBoatLineItem->Location->LocationAddress->CityName );
		}
		
		// Encapsulated elements with a dash
		if ($record->VehicleRemarketingBoatLineItem->Location->LocationAddress->{'StateOrProvinceCountrySub-DivisionID'}) {
			$LocationState = $record->VehicleRemarketingBoatLineItem->Location->LocationAddress->{'StateOrProvinceCountrySub-DivisionID'};
		}
		
		$Company = addslashes ( $record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->CompanyName );
		$OfficeID = $record->VehicleRemarketingBoatLineItem->DealerParty->PartyID;
		
		if ($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->PersonName) {
			$BrokerName = addslashes ( $record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->PersonName );
		}
		
		$BrokerEmail = addslashes ( $record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->URICommunication->CompleteNumber );
		$BrokerTel = addslashes ( $record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->TelephoneCommunication->CompleteNumber );
		
		if ($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->FaxCommunication->CompleteNumber) {
			$BrokerFax = addslashes ( $record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->FaxCommunication->CompleteNumber );
		}
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BeamMeasure) {
			$Beam = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BeamMeasure;
			$BeamUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BeamMeasure [0]->attributes ();
		}
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BridgeClearanceMeasure) {
			$BridgeClearance = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BridgeClearanceMeasure;
			$BridgeClearanceUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BridgeClearanceMeasure [0]->attributes ();
		}
		
		// Loop through Draft Measure Nodes
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DraftMeasureGroup) {
			$processdrafts = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DraftMeasureGroup;
			foreach ( $processdrafts as $processdraft ) {
				if (( string ) $processdraft->BoatDraftCode == "Min Draft") {
					if ($processdraft->DraftMeasure) {
						$MinDraft = $processdraft->DraftMeasure;
						$MinDraftUnit = $processdraft->DraftMeasure [0]->attributes ();
					}
				} else if (( string ) $processdraft->BoatDraftCode == "Max Draft") {
					if ($processdraft->DraftMeasure) {
						$MaxDraft = $processdraft->DraftMeasure;
						$MaxDraftUnit = $processdraft->DraftMeasure [0]->attributes ();
					}
				}
			}
		}
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CabinHeadroomMeasure) {
			$CabinHeadroom = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CabinHeadroomMeasure;
			$CabinHeadroomUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CabinHeadroomMeasure [0]->attributes ();
		}
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->FreeboardMeasure) {
			$Freeboard = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->FreeboardMeasure;
			$FreeboardUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->FreeboardMeasure [0]->attributes ();
		}
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DryWeightMeasure) {
			$DryWeight = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DryWeightMeasure;
			$DryWeightUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DryWeightMeasure [0]->attributes ();
		}
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BallastWeightMeasure) {
			$Ballast = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BallastWeightMeasure;
			$BallastUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BallastWeightMeasure [0]->attributes ();
		}
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DisplacementMeasure) {
			$Displacement = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DisplacementMeasure;
			$DisplacementUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DisplacementMeasure [0]->attributes ();
		}
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CruisingSpeedMeasure) {
			$CruisingSpeed = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CruisingSpeedMeasure;
			$CruisingSpeedUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CruisingSpeedMeasure [0]->attributes ();
		}
		
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MaximumSpeedMeasure) {
			$MaxSpeed = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MaximumSpeedMeasure;
			$MaxSpeedUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MaximumSpeedMeasure [0]->attributes ();
		}
		
		// Loop through Tank Nodes
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Tank) {
			$processtanks = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Tank;
			foreach ( $processtanks as $processtank ) {
				if (( string ) $processtank->TankUsageCode == "Fuel") {
					if ($processtank->TankCapacityMeasure) {
						$FuelTankCap = $processtank->TankCapacityMeasure;
						$FuelTankCapUnit = $processtank->TankCapacityMeasure [0]->attributes ();
						if ($processtank->TankCountNumeric) {
							$FuelTankNo = $processtank->TankCountNumeric;
						} else {
							$FuelTankNo = 1;
						}
					}
				} else if (( string ) $processtank->TankUsageCode == "Water") {
					if ($processtank->TankCapacityMeasure) {
						$WaterTankCap = $processtank->TankCapacityMeasure;
						$WaterTankCapUnit = $processtank->TankCapacityMeasure [0]->attributes ();
						if ($processtank->TankCountNumeric) {
							$WaterTankNo = $processtank->TankCountNumeric;
						} else {
							$WaterTankNo = 1;
						}
					}
				} else if (( string ) $processtank->TankUsageCode == "Black Water") {
					if ($processtank->TankCapacityMeasure) {
						$HoldingTankCap = $processtank->TankCapacityMeasure;
						$HoldingTankCapUnit = $processtank->TankCapacityMeasure [0]->attributes ();
						if ($processtank->TankCountNumeric) {
							$HoldingTankNo = $processtank->TankCountNumeric;
						} else {
							$HoldingTankNo = 1;
						}
					}
				}
			}
		}
		
		// Loop through Accommodation Nodes
		if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Accommodation) {
			$processaccomms = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Accommodation;
			foreach ( $processaccomms as $processaccomm ) {
				if (( string ) $processaccomm->AccommodationTypeCode == "SingleBerth") {
					$SingleBerthNo = $processaccomm->AccommodationCountNumeric;
				} else if (( string ) $processaccomm->AccommodationTypeCode == "DoubleBerth") {
					$DoubleBerthNo = $processaccomm->AccommodationCountNumeric;
				} else if (( string ) $processaccomm->AccommodationTypeCode == "TwinBerth") {
					$TwinBerthNo = $processaccomm->AccommodationCountNumeric;
				} else if (( string ) $processaccomm->AccommodationTypeCode == "Cabin") {
					$CabinNo = $processaccomm->AccommodationCountNumeric;
				} else if (( string ) $processaccomm->AccommodationTypeCode == "Bathroom") {
					$BathroomNo = $processaccomm->AccommodationCountNumeric;
				} else if (( string ) $processaccomm->AccommodationTypeCode == "Head") {
					$HeadNo = $processaccomm->AccommodationCountNumeric;
				}
			}
		}
		
		// -- For stock no --// Newly added (VehicleRemarketingBoat)
		$stockNo = $record->VehicleRemarketingHeader->DocumentIdentificationGroup->DocumentIdentification->DocumentID;
		
		// -- End Stock no --//
		
		// -- For boat Class --// Newly added (boatClass)
		$arrayBoatClasses = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatClassGroup;
		$vartemp = 0;
		foreach ( $arrayBoatClasses as $arrayBoatClass ) {
			if ($arrayBoatClass->PrimaryBoatClassIndicator == 'true') {
				$boatClass = $arrayBoatClass->BoatClassCode;
			}
			$vartemp ++;
		}
		if ($vartemp == 0) {
			if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatClassGroup->PrimaryBoatClassIndicator == 'true') {
				$boatClass = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatClassGroup->BoatClassCode;
			} else {
				$boatClass = '';
			}
		}
		
		
		$BoatID= (int)$BoatID;		
		if(in_array($BoatID, $Settings['boatsData']['IDsparsed'])) continue; //Already done. Move Ahead.		
		cLog("Deleting " . $BoatID);
		// Delete Old Boat with this ID:
		cLog ("DELETE FROM `" . $table_prefix . "bv_boatdetails` where BoatID=$BoatID" );
		$wpdb->query ( "DELETE FROM `" . $table_prefix . "bv_boatdetails` where BoatID=$BoatID" );
		$wpdb->query ( "DELETE FROM `" . $table_prefix . "bv_descriptions` where BoatID=$BoatID" );
		$wpdb->query ( "DELETE FROM `" . $table_prefix . "bv_engines` where BoatID=$BoatID" );
		cLog("Deleting 2 " . $BoatID);
		$wpdb->query ( "DELETE FROM `" . $table_prefix . "bv_features` where BoatID=$BoatID" );
		$wpdb->query ( "DELETE FROM `" . $table_prefix . "bv_images` where BoatID=$BoatID" );
		$wpdb->query ( "DELETE FROM `" . $table_prefix . "bv_videos` where BoatID=$BoatID" );
		cLog("Deleting 3 " . $BoatID);
		
		$args = array (
				'posts_per_page' => - 1,
				'post_type' => 'inventory',
				'meta_key' =>'boatid',
				'meta_value'=> $BoatID
		);
		cLog("Deleting Args " . $BoatID . " ::" . print_r($args, true));
		$the_query = new WP_Query ( $args );
		if ( $the_query->have_posts() ){
			$deleteID =array();
			while ( $the_query->have_posts() ){		
				$the_query->the_post();				
				$deleteID[]=get_the_ID();
			}
			if(count($deleteID)>0){
				foreach($deleteID as $dID){
					cLog("Deleting Post ". $dID);
					wp_delete_post($dID, true);
				}
			}
		}
		//Deletion Code complete.		
		cLog("Deletion completed for boat " . $BoatID);
		
		
		
		// -- End boat Class --//
		// Insert Boat Details, used SET in order to make future addition of fields easier
		$insert = "insert INTO `" . $table_prefix . "bv_boatdetails`
		SET BoatID = '$BoatID',
		Added = '$Added',
		NewUsed = '$NewUsed',
		Make = '$Make',
		Model = '$Model',
		Length = '$Length',
		LengthUnit = '$LengthUnit',
		LOA = '$LOA',
		LOAUnit = '$LOAUnit',
		LWL = '$LWL',
		LWLUnit = '$LWLUnit',
		Year = '$Year',
		Price = '$Price',
		PriceCurrency = '$PriceCurrency',
		TaxStatus = '$TaxStatus',
		Fuel = '$Fuel',
		HullMaterial = '$HullMaterial',
		Keel = '$Keel',
		Designer = '$Designer',
		Builder = '$Builder',
		Name = '$Name',
		Status = '$Status',
		Coop = '$Coop',
		Category = '$Category',
		Class = '$Class',
		Description = '$Description',
		LocationCountry = '$LocationCountry',
		LocationCity = '$LocationCity',
		LocationState = '$LocationState',
		Company = '$Company',
		OfficeID = '$OfficeID',
		BrokerName = '$BrokerName',
		BrokerEmail = '$BrokerEmail',
		BrokerTel = '$BrokerTel',
		BrokerFax = '$BrokerFax',
		Beam = '$Beam',
		BeamUnit = '$BeamUnit',
		BridgeClearance = '$BridgeClearance',
		BridgeClearanceUnit = '$BridgeClearanceUnit',
		MinDraft = '$MinDraft',
		MinDraftUnit = '$MinDraftUnit',
		MaxDraft = '$MaxDraft',
		MaxDraftUnit = '$MaxDraftUnit',
		CabinHeadroom = '$CabinHeadroom',
		CabinHeadroomUnit = '$CabinHeadroomUnit',
		Freeboard = '$Freeboard',
		FreeboardUnit = '$FreeboardUnit',
		DryWeight = '$DryWeight',
		DryWeightUnit = '$DryWeightUnit',
		Ballast = '$Ballast',
		BallastUnit = '$BallastUnit',
		Displacement = '$Displacement',
		DisplacementUnit = '$DisplacementUnit',
		CruisingSpeed = '$CruisingSpeed',
		CruisingSpeedUnit = '$CruisingSpeedUnit',
		MaxSpeed = '$MaxSpeed',
		MaxSpeedUnit = '$MaxSpeedUnit',
		FuelTankCap = '$FuelTankCap',
		FuelTankCapUnit = '$FuelTankCapUnit',
		FuelTankNo = '$FuelTankNo',
		WaterTankCap = '$WaterTankCap',
		WaterTankCapUnit = '$WaterTankCapUnit',
		WaterTankNo = '$WaterTankNo',
		HoldingTankCap = '$HoldingTankCap',
		HoldingTankCapUnit = '$HoldingTankCapUnit',
		HoldingTankNo = '$HoldingTankNo',
		SingleBerthNo = '$SingleBerthNo',
		DoubleBerthNo = '$DoubleBerthNo',
		TwinBerthNo = '$TwinBerthNo',
		CabinNo = '$CabinNo',
		BathroomNo = '$BathroomNo',
		HeadNo = '$HeadNo',
		DispalyStatus = '$DispalyStatus',
		stockNo='$stockNo',
		boatClass='$boatClass'
		";
		$result = $wpdb->query ( $insert );
		
		if($result === false  || $wpdb->last_error != ""){
			//Error in insert
		}
		
		cLog ( "Inserted new Boat: " . print_r ( $BoatID, true ) );
		// $postName=$Make.'-'.$Model;
		if ($Model != '') {
			$postName = filterHTACCES_linktitle ( $Make ) . "-" . filterHTACCES_linktitle ( $Model ) . "-" . filterHTACCES_linktitle ( $BoatID );
		} else {
			$postName = filterHTACCES_linktitle ( $Make ) . "-" . filterHTACCES_linktitle ( $BoatID );
		}
		cLog("Post Creation started");
		$result = $wpdb->query ( "INSERT INTO `" . $table_prefix . "posts` (`ID` ,`post_author` ,`post_date` ,`post_date_gmt` ,`post_content` ,
				`post_title` ,`post_excerpt` ,`post_status` ,`comment_status` ,`ping_status` ,`post_password` ,`post_name` ,
				`to_ping` ,`pinged` ,`post_modified` ,`post_modified_gmt` ,`post_content_filtered` ,`post_parent` ,`guid` ,
				`menu_order` ,`post_type` ,`post_mime_type` ,`comment_count`)
				VALUES (NULL , '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '[bi_boats_listing id=$BoatID]', '$Make',
				'','publish', 'closed', 'closed', '','$postName', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00',
				'', '0', '', '0', 'inventory', '', '0')" );
		
		if($result === false || $wpdb->last_error != ""){
			cLog("Post creation failed");
			cLog(print_r($wpdb, true));
		}
		
		$postID = $wpdb->insert_id;
		cLog ( "Inserted new Boat POST : " . print_r ( $wpdb->insert_id, true ) );
		cLog( var_dump($result) );
		cLog(var_dump($result==true));
		update_post_meta ( ( int ) $postID, 'boatid', $BoatID ); // Use it to delete this post in future.
		
		if ($result == true && $record->VehicleRemarketingBoatLineItem->AdditionalDetailDescription) {
			// Populate Descriptions from XML
			// Loop through Descriptions Nodes
			// Declare and Clear Variables
			cLog(" Inserting DEtail Description");
			$processdescs = $record->VehicleRemarketingBoatLineItem->AdditionalDetailDescription;
			foreach ( $processdescs as $processdesc ) {
				$AddTitle = $AddDescription = "";
				$AddTitle = addslashes ( utf8_decode ( $processdesc->Title ) );
				$AddDescription = addslashes ( utf8_decode ( $processdesc->Description ) );
				$AddDescription = str_replace ( "<div>", "", $AddDescription );
				$AddDescription = str_replace ( "</div>", "", $AddDescription );
				// Insert Descriptions, used SET in order to make future addition of fields easier
				$insert = "INSERT INTO `" . $table_prefix . "bv_descriptions`
				SET BoatID = '$BoatID',
				AddTitle = '$AddTitle',
				AddDescription = '$AddDescription'
				";
				$wpdb->query ( $insert );
				if (! $result) {
					echo mysql_error ();
				}
			}
		}
		
		if ($result == true ) {
			// Populate Engines from XML
			// Loop through Engines Nodes
			// Declare and Clear Variables
			cLog(" Inserting Engine Details");
			$EngineMake = $EngineModel = $EngineYear = $EngineFuel = $EngineNo = $DriveType = $TotalPower = $TotalPowerUnit = $PropellerType = $EngineHours = "";
			$EngineNo = 0;
			
			if ($record->VehicleRemarketingBoatLineItem->VehicleRemarketingEngineLineItem) {
				$processengines = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingEngineLineItem;
				foreach ( $processengines as $processengine ) {
					$EngineMake = addslashes ( $processengine->VehicleRemarketingEngine->MakeString );
					$EngineModel = addslashes ( $processengine->VehicleRemarketingEngine->Model );
					$EngineYear = $processengine->VehicleRemarketingEngine->ModelYear;
					$EngineFuel = $processengine->VehicleRemarketingEngine->FuelTypeCode;
					$EngineNo ++;
					$DriveType = $processengine->VehicleRemarketingEngine->DriveTypeCode;
					$TotalPower = $processengine->VehicleRemarketingEngine->TotalEnginePowerQuantity;
					if ($processengine->VehicleRemarketingEngine->TotalEnginePowerQuantity) {
						$TotalPowerUnit = $processengine->VehicleRemarketingEngine->TotalEnginePowerQuantity [0]->attributes ();
					}
					$PropellerType = $processengine->VehicleRemarketingEngine->PropellerType;
					$EngineHours = $processengine->VehicleRemarketingEngine->TotalEngineHoursNumeric;
				}
			}
			// Insert Engines, used SET in order to make future addition of fields easier
			$insert = "INSERT INTO `" . $table_prefix . "bv_engines`
			SET BoatID = '$BoatID',
			EngineMake = '$EngineMake',
			EngineModel = '$EngineModel',
			EngineYear = '$EngineYear',
			EngineFuel = '$EngineFuel',
			EngineNo = '$EngineNo',
			DriveType = '$DriveType',
			TotalPower = '$TotalPower',
			TotalPowerUnit = '$TotalPowerUnit',
			PropellerType = '$PropellerType',
			EngineHours = '$EngineHours'
			";
			$wpdb->query ( $insert );
		}
		if ($result == true ) {
			// Populate Features from XML
			// Loop through Features Nodes
			cLog(" Inserting Featured Boat Data");
			if ($record->VehicleRemarketingBoatLineItem->FeatureGroupDataNode->FeatureDataNode) {
				$processfeatures = $record->VehicleRemarketingBoatLineItem->FeatureGroupDataNode->FeatureDataNode;
				foreach ( $processfeatures as $processfeature ) {
					$Feature = $FeatureDetails = "";
					$Feature = addslashes ( $processfeature->DataNodeID );
					if ($processfeature->FreeFormTextGroup->Description) {
						$FeatureDetails = addslashes ( utf8_decode ( $processfeature->FreeFormTextGroup->Description ) );
					}
					// Insert Features, used SET in order to make future addition of fields easier
					$insert = "INSERT INTO `" . $table_prefix . "bv_features`
					SET BoatID = '$BoatID',
					Feature = '$Feature',
					FeatureDetails = '$FeatureDetails'
					";
					$wpdb->query ( $insert );
				}
			}
		}
		if ($result == true ) {
			// Populate Images from XML
			// Loop through Images Nodes
			cLog(" Inserting Image Data");
			if ($record->VehicleRemarketingBoatLineItem->ImageAttachmentExtended) {
				$processimages = $record->VehicleRemarketingBoatLineItem->ImageAttachmentExtended;
				foreach ( $processimages as $processimage ) {
					$ImageURL = $ImageRanking = $ImageTitle = "";
					$ImageURL = addslashes ( $processimage->URI );
					$ImageRanking = addslashes ( $processimage->UsagePreference->PriorityRankingNumeric );
					if ($processimage->ImageAttachmentTitle) {
						$ImageTitle = addslashes ( utf8_decode ( $processimage->ImageAttachmentTitle ) );
					}
					// Insert Features, used SET in order to make future addition of fields easier
					$insert = "INSERT INTO `" . $table_prefix . "bv_images`
					SET BoatID = '$BoatID',
					ImageURL = '$ImageURL',
					ImageRanking = '$ImageRanking',
					ImageTitle = '$ImageTitle'
					";
					
					cLog("Image Insert: ". $insert);
					$wpdb->query ( $insert );
				}
			}
		}
		if ($result == true ) {
			// Populate Videos from XML
			// Loop through Videos Nodes
			cLog(" Inserting Additional Media");
			if ($record->VehicleRemarketingBoatLineItem->AdditionalMedia->MediaTypeString == "Video" || $record->VehicleRemarketingBoatLineItem->AdditionalMedia->MediaTypeString == "Embedded Video" || $record->VehicleRemarketingBoatLineItem->AdditionalMedia->MediaTypeString == "Video Brochure") {
				$processvideos = $record->VehicleRemarketingBoatLineItem->AdditionalMedia;
				foreach ( $processvideos as $processvideo ) {
					$VideoURL = $VideoTitle = $VideoThumb = $VideoEmbed = "";
					$VideoURL = addslashes ( $processvideo->MediaSourceURI );
					if ($processvideo->MediaAttachmentTitle) {
						$VideoTitle = addslashes ( utf8_decode ( $processvideo->MediaAttachmentTitle ) );
					}
					if ($processvideo->MediaThumbURI) {
						$VideoThumb = addslashes ( $processvideo->MediaThumbURI );
					}
					if ($processvideo->EmbeddedData->DataString) {
						$VideoEmbed = addslashes ( $processvideo->EmbeddedData->DataString );
					}
					// Insert Features, used SET in order to make future addition of fields easier
					$insert = "INSERT INTO `" . $table_prefix . "bv_videos`
					SET BoatID = '$BoatID',
					VideoURL = '$VideoURL',
					VideoTitle = '$VideoTitle',
					VideoThumb = '$VideoThumb',
					VideoEmbed = '$VideoEmbed'
					";
					$result = $wpdb->query ( $insert );
				}
			}
		}		
		$Settings['boatsData']['IDsparsed'][]= $BoatID;
		$iCtr++;
	}
	
	if(count($Settings['boatsData']['IDsparsed']) == count($records)) {
		$Settings ['xmldata'] ['currentXMLID'] = -1;
		$Settings ['boatsData']['IDsparsed'] = array();
		$Settings['xmldata']['parsedXMLs'][]= $xmlID;
		
	}
	
	return $result;
}

/**
 *
 * @var array All Setings related to working of Cron.
 */
cLog ( "Starting the Scheduler job" );
$Settings = array ();
$script = "taskmanager";
if (IsScriptLocked ( $script )) {
	exit ();
}
if (CreateScriptLock ( $script )) {
	cLog("Fetching the information");
	$Settings = get_option ( "bi_schedularSettings" );
	cLog ( print_r ( $Settings, true ) );
	$DefaultSettings = array (
			'CurrentID' => uniqid (),
			'state' => 'readxml', // Possible State, readxml, parseXML ...
			'xmldata' => array (
					'currentXMLID' => - 1,
					'readXMLs' => array (),
					'parsedXMLs' => array (),
					'currentXMLFileNames' => array (),
					'XMLURLs' => array () 
			),
			'boatsData' => array (
					'uniqueIDs' => array (),
					'IDsparsed' => array () 
			) 
	);
	if (! is_array ( $Settings )) {
		// default Setting
		//$Settings = $DefaultSettings;
		ResetCron("First Run");
	}
	$DoContinue = true;
	if ($Settings ['state'] == 'readxml') {
		$query = "select * from `" . $table_prefix . "bv_pluginsettings` where status='1'";
		$rsAPIXML = $wpdb->get_results ( $query, ARRAY_A );
		foreach ( $rsAPIXML as $rowAPIXML ) {
			$urls [$rowAPIXML ['id']] = trim ( $rowAPIXML ['api'] );
		}
		
		cLog ( print_r ( $urls, true ) );
		if (count ( $Settings ['xmldata'] ['XMLURLs'] ) > 0) {
			$newURL = array_diff ( $urls, $Settings ['xmldata'] ['XMLURLs'] );
			$removeURL = array_diff ( $Settings ['xmldata'] ['XMLURLs'], $urls );
			if (count ( $newURL ) > 0 || count ( $removeURL ) > 0) {
				// We have NEW/Deleted URL, reset to start again.
				cLog("Cron is reset as URL list changed");
				ResetCron("Change In API URL List");
				$DoContinue = false;
			}
		}
		
		$Settings ['xmldata'] ['XMLURLs'] = $urls;
		if ($DoContinue) {
			cLog("Checking Each XML File now");
			$ctr = 0;
			foreach ( $Settings ['xmldata'] ['XMLURLs'] as $xmlID => $xmlURL ) {
				if ($ctr == 2)
					break; // Number of file read in one go.
				if (! in_array ( $xmlID, $Settings ['xmldata'] ['readXMLs'] )) {
					$filePath = $cacheFolder . uniqid () . ".xml";
					$Settings ['xmldata']['currentXMLFileNames'] [$xmlID] = $filePath;
					ReadWebPage ( $xmlURL, $filePath  );
					$Settings ['xmldata'] ['readXMLs'] [] = $xmlID;
					$ctr ++;
				}
			}
			
			if (count ( $Settings ['xmldata'] ['XMLURLs'] ) == count ( $Settings ['xmldata'] ['readXMLs'] )) {
				$Settings ['state'] = 'parsexml';
			}
		}
	} else if ($Settings ['state'] == 'parsexml') {
		if ($Settings ['xmldata'] ['currentXMLID'] == -1) {
			foreach ( $Settings ['xmldata'] ['readXMLs'] as $xmlID ) {
				cLog ( "Current XML Candidate ID " . $xmlID );
				if (! in_array ( $xmlID, $Settings ['xmldata'] ['parsedXMLs'] )) {
					$Settings ['xmldata'] ['currentXMLID'] = $xmlID;
					break;
				}
			}
		}
		// Parse the CurrentXMLID.
		ParseXMLFile($Settings ['xmldata']['currentXMLFileNames'] [$Settings ['xmldata'] ['currentXMLID']], $Settings ['xmldata'] ['currentXMLID'] );
		
		if ( (count($Settings ['xmldata'] ['parsedXMLs'] ) ==  count($Settings ['xmldata'] ['readXMLs'] ) ) &&
			$Settings ['xmldata'] ['currentXMLID'] == -1) {
			//Reset Cron to initial stage.
			ResetCron("Iteration Completed");
		}
		
	}
	cLog ( "New Setting are : \r\n". print_r ( $Settings, true ) );
	update_option ( 'bi_schedularSettings', $Settings );
	
	$Settings = get_option ( "bi_schedularSettings" );
	cLog ( "Re-read settings ". print_r ( $Settings, true ) );
	
	UnlockScript ( $script );
}