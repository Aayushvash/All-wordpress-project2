<?php ob_start(); //error_reporting(0);
//This document imports the XML feeds from the spice rack service, you will need to set up a cron job to run this file once a day or more often if the client requires it
ini_set('max_execution_time', '3000');

//Set IMT Spicerack URLS, add a new line in the array for each office URL, comment out code below to use elba single broker feed
/*
	$urls = array(
	"http://account.boatwizard.com/spice-rack/owner/6105/boats?status=on",
	"http://account.boatwizard.com/spice-rack/owner/19462/boats?status=on",
	"http://account.boatwizard.com/spice-rack/owner/19486/boats?status=on",
	);
*/
//-------------No need to edit below this line--------------
require("../wp-config.php");
global $wpdb;
$table_prefix=$wpdb->prefix;
$query="select * from `".$table_prefix."bv_pluginsettings` where status='1'";
require_once(ABSPATH . 'wp-content/plugins/boats inventory/HtAccessURL.php');
$resultTemp = mysql_query($query);

while($resultFinal = mysql_fetch_array($resultTemp))
{
	$urls[] = trim($resultFinal['api']);
}

//Clear Database
$structure1 = "DELETE FROM `".$table_prefix."bv_boatdetails`";
$structure2 = "DELETE FROM `".$table_prefix."bv_descriptions`";
$structure3 = "DELETE FROM `".$table_prefix."bv_engines`";
$structure4 = "DELETE FROM `".$table_prefix."bv_features`";
$structure5 = "DELETE FROM `".$table_prefix."bv_images`";
$structure6 = "DELETE FROM `".$table_prefix."bv_videos`";
$wpdb->query("DELETE FROM `".$table_prefix."posts` WHERE `post_type`='inventory'");
//$wpdb->query("DELETE FROM `".$table_prefix."posts` WHERE `post_type`='biinventory'");
$wpdb->query($structure1);
$wpdb->query($structure2);
$wpdb->query($structure3);
$wpdb->query($structure4); 
$wpdb->query($structure5);
$wpdb->query($structure6);


//Google Currency Converter
    	function currency($from_Currency, $to_Currency, $amount) {
 		global $wpdb;
		$table_prefix=$wpdb->prefix;
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
		
		//Length Units Converter
    	function units($to_unit, $amount) {
		global $wpdb;
		$table_prefix=$wpdb->prefix;
    	if ($to_unit == "metres"){
    		$times = 0.3048;
    	} else {
    		$times = 3.2808399;
 		}
        $data = $amount * $times;
        return round($data, 2);
		}		
	
    	//Run import
    	function run_import($filename){
 		global $wpdb;
		$table_prefix=$wpdb->prefix;		
			$xml = simplexml_load_file($filename, 'SimpleXMLElement', LIBXML_NOCDATA) or die ("Unable to load XML file!");
			$records = $xml->VehicleRemarketing;
			$partyError=0;
			
			foreach( $records as $record ) 
			{ 	
				//Declare and empty variables
				$BoatID = $Added = $NewUsed = $Make = $Model = $Length = $LengthUnit = $LOA = $LOAUnit = $LWL = $LWLUnit = $Year = $Price = $PriceCurrency = $TaxStatus = $Fuel = $HullMaterial = $Keel = $Designer = $Builder = $Name = $Status = $Coop = $Category = $Class = $Description = $LocationCountry = $LocationCity = $LocationState = $Company = $OfficeID = $BrokerName = $BrokerEmail = $BrokerTel = $BrokerFax = $Beam = $BeamUnit = $BridgeClearance = $BridgeClearanceUnit = $MinDraft = $MinDraftUnit = $MaxDraft = $MaxDraftUnit = $CabinHeadroom = $CabinHeadroomUnit = $Freeboard = $FreeboardUnit = $DryWeight = $DryWeightUnit = $Ballast = $BallastUnit = $Displacement = $DisplacementUnit = $CruisingSpeed = $CruisingSpeedUnit = $MaxSpeed = $MaxSpeedUnit = $FuelTankCap = $FuelTankCapUnit =$FuelTankNo = $WaterTankCap = $WaterTankCapUnit = $WaterTankNo = $HoldingTankCap = $HoldingTankCapUnit = $HoldingTankNo = $SingleBerthNo = $DoubleBerthNo = $TwinBerthNo = $CabinNo = $BathroomNo = $HeadNo = $DispalyStatus = $share_commision = $exclusive_contract = $stockNo = $boatClass = $seatingCapacity = $postcode = $addressLineOne = $businessName = $businessLocation = "";
				
				//Populate Boat Details from XML
				//$BoatID = $record->VehicleRemarketingHeader->DocumentIdentificationGroup->DocumentIdentification->DocumentID;
				$Added = $record->VehicleRemarketingBoatLineItem->ItemReceivedDate;
				$NewUsed = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->SaleClassCode;
				$Make = addslashes($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MakeString);
				$Model = trim(addslashes($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Model));
				// echo $Model;
				//Loop through Length Nodes
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatLengthGroup){
					$processlengths = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatLengthGroup;
				  	foreach($processlengths as $processlength)
					{
						if ($processlength->BoatLengthCode == "Nominal Length"){
							if($processlength->BoatLengthMeasure){
								$Length = $processlength->BoatLengthMeasure;
								$LengthUnit = $processlength->BoatLengthMeasure[0]->attributes();
							}
						} else if ($processlength->BoatLengthCode == "Length At Water Line"){
							if($processlength->BoatLengthMeasure){
								$LWL = $processlength->BoatLengthMeasure;
								$LWLUnit = $processlength->BoatLengthMeasure[0]->attributes();
							}
						} else if ($processlength->BoatLengthCode == "Length Overall"){
							if($processlength->BoatLengthMeasure){
								$LOA = $processlength->BoatLengthMeasure;
								$LOAUnit = $processlength->BoatLengthMeasure[0]->attributes();
							}
						}
					}
				}
				
				//Loop through IDs
				if($record->VehicleRemarketingBoatLineItem->Marketing){
					$processIDs = $record->VehicleRemarketingBoatLineItem->Marketing;
				  	foreach($processIDs as $processID)
					{
						if ($processID->PublicationID == "yw"){
							if($processID->MarketingID){
								$BoatID = $processID->MarketingID;
							}
						} 
					}
				}
				$DispalyStatus='false';
				
				$DispalyStatus=$record->VehicleRemarketingBoatLineItem->PricingABIE->PriceHideIndicator; 
				$Year = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->ModelYear;
			
				$var=0;
				if($record->VehicleRemarketingBoatLineItem->PricingABIE->Price){
				$Prices=$record->VehicleRemarketingBoatLineItem->PricingABIE->Price;
				
					foreach($Prices as $tempPrice)
					{
						if($tempPrice->PriceCode=='Total')
						{
							 $Price=$tempPrice->ChargeAmount;
							$var++;
						}
					}
				if($var==0)
				{
					$Price=$record->VehicleRemarketingBoatLineItem->PricingABIE->Price->ChargeAmount;
				}
				}
				
				
				$PriceCurrency ='USD'; //$record->VehicleRemarketingBoatLineItem->PricingABIE->Price->ChargeAmount[0]->attributes();
				$TaxStatus = $record->VehicleRemarketingBoatLineItem->Tax->TaxStatusCode;
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingEngineLineItem->VehicleRemarketingEngine->FuelTypeCode){
					$Fuel = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingEngineLineItem->VehicleRemarketingEngine->FuelTypeCode;
				}
				
				$HullMaterial = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Hull->BoatHullMaterialCode;
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatKeelCode){
					$Keel = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatKeelCode;
				}
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DesignerName){
					$Designer = addslashes($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DesignerName);
				}
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BuilderName){
					$Builder = addslashes($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BuilderName);
				}
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatName){
					$Name = addslashes($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatName);
				}
				
				$Status = $record->VehicleRemarketingBoatLineItem->SalesStatus;	
				
				//define broker is willing to share commision
				$share_commision='false'; 
				$exclusive_contract='false';
				$initArray=objectToArray($record->VehicleRemarketingBoatLineItem); 
			    $share_commision = $initArray['Co-OpIndicator'];
				$exclusive_contract = $record->VehicleRemarketingBoatLineItem->CentralIndicator;
				//define broker is willing to share commision
				
				//Encapsulated elements with a dash			
				$Coop = $record->VehicleRemarketingBoatLineItem->{'Co-OpIndicator'};
				$Category = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatCategoryCode;
				$Class = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatClassGroup;
				$Description = addslashes(utf8_decode($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->GeneralBoatDescription));
				
				$LocationCountry = $record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PostalAddress->CountryID;
				$LocationState = $record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PostalAddress->{'StateOrProvinceCountrySub-DivisionID'};
				$LocationCity = $record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PostalAddress->CityName;
				$postcode= $record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PostalAddress->Postcode;
				
				/*$addressLineOne= $record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PostalAddress->LineOne;
				
				if($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PostalAddress->LineTwo)
				{
					$addressLineOne .=', '.$record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PostalAddress->LineTwo;
				}*/
				
				/*$LocationCountry = $record->VehicleRemarketingBoatLineItem->Location->LocationAddress->CountryID;
				
				if($record->VehicleRemarketingBoatLineItem->Location->LocationAddress->CityName){				
					$LocationCity = addslashes($record->VehicleRemarketingBoatLineItem->Location->LocationAddress->CityName);
				}
				
				//Encapsulated elements with a dash
				if($record->VehicleRemarketingBoatLineItem->Location->LocationAddress->{'StateOrProvinceCountrySub-DivisionID'}){
					$LocationState = $record->VehicleRemarketingBoatLineItem->Location->LocationAddress->{'StateOrProvinceCountrySub-DivisionID'};				
				}*/
				
				//$Company = addslashes($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->CompanyName);
				$OfficeID = $record->VehicleRemarketingBoatLineItem->DealerParty->PartyID;
				
				if($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->PersonName){
					$BrokerName = addslashes($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->PersonName);
				}
				
				$BrokerEmail = addslashes($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->URICommunication->CompleteNumber);
				//$BrokerTel = addslashes($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->TelephoneCommunication->CompleteNumber);
				/**new Update**/
				$BrokerTel=null;
				$Company=null;  
				// if(!empty($OfficeID))
				// {
				// 	if(empty($partyError))
				// 	  { 
				// 	    $partyinfo=getPartyinfo($OfficeID);  
				// 		$BrokerTel=$partyinfo->OfficeAddress->Phone;
				// 		$Company=$partyinfo->OfficeAddress->OfficeName;
				// 	  }
				// 	$partyinfo='error';  
				// 	if($partyinfo == "error") { $partyError++; $BrokerTel=null; $Company='Singleton Marine Group';}   
				// }  
				
				
				if($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->FaxCommunication->CompleteNumber){
					$BrokerFax = addslashes($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->FaxCommunication->CompleteNumber);
				}
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BeamMeasure){
					$Beam = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BeamMeasure;
					$BeamUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BeamMeasure[0]->attributes();
				}
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BridgeClearanceMeasure){
					$BridgeClearance = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BridgeClearanceMeasure;
					$BridgeClearanceUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BridgeClearanceMeasure[0]->attributes();
				}
				
				//Loop through Draft Measure Nodes
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DraftMeasureGroup){
					$processdrafts = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DraftMeasureGroup;
				  	foreach($processdrafts as $processdraft)
					{
						if ((string) $processdraft->BoatDraftCode == "Min Draft"){
							if($processdraft->DraftMeasure){
								$MinDraft = $processdraft->DraftMeasure;
								$MinDraftUnit = $processdraft->DraftMeasure[0]->attributes();
							}
						} else if ((string) $processdraft->BoatDraftCode == "Max Draft"){
							if($processdraft->DraftMeasure){
								$MaxDraft = $processdraft->DraftMeasure;
								$MaxDraftUnit = $processdraft->DraftMeasure[0]->attributes();
							}
						}				
					}
				}
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CabinHeadroomMeasure){
					$CabinHeadroom = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CabinHeadroomMeasure;
					$CabinHeadroomUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CabinHeadroomMeasure[0]->attributes();
				}
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->FreeboardMeasure){
					$Freeboard = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->FreeboardMeasure;
					$FreeboardUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->FreeboardMeasure[0]->attributes();
				}
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DryWeightMeasure){
					$DryWeight = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DryWeightMeasure;
					$DryWeightUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DryWeightMeasure[0]->attributes();
				}
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BallastWeightMeasure){
					$Ballast = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BallastWeightMeasure;
					$BallastUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BallastWeightMeasure[0]->attributes();
				}
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DisplacementMeasure){
					$Displacement = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DisplacementMeasure;
					$DisplacementUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DisplacementMeasure[0]->attributes();
				}
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CruisingSpeedMeasure){
					$CruisingSpeed = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CruisingSpeedMeasure;
					$CruisingSpeedUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CruisingSpeedMeasure[0]->attributes();
				}
				
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MaximumSpeedMeasure){
					$MaxSpeed = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MaximumSpeedMeasure;
					$MaxSpeedUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MaximumSpeedMeasure[0]->attributes();
				}
				
				//Loop through Tank Nodes
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Tank){
					$processtanks = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Tank;
				  	foreach($processtanks as $processtank)
					{
						if ((string) $processtank->TankUsageCode == "Fuel"){
							if($processtank->TankCapacityMeasure){
								$FuelTankCap = $processtank->TankCapacityMeasure;
								$FuelTankCapUnit = $processtank->TankCapacityMeasure[0]->attributes();
								if ($processtank->TankCountNumeric){
									$FuelTankNo = $processtank->TankCountNumeric;
								} else {
									$FuelTankNo = 1;
								}
							}	
						} else if ((string) $processtank->TankUsageCode == "Water"){
							if($processtank->TankCapacityMeasure){
								$WaterTankCap = $processtank->TankCapacityMeasure;
								$WaterTankCapUnit = $processtank->TankCapacityMeasure[0]->attributes();
								if ($processtank->TankCountNumeric){
									$WaterTankNo = $processtank->TankCountNumeric;
								} else {
									$WaterTankNo = 1;
								}
							}
						} else if ((string) $processtank->TankUsageCode == "Black Water"){
							if($processtank->TankCapacityMeasure){
								$HoldingTankCap = $processtank->TankCapacityMeasure;
								$HoldingTankCapUnit = $processtank->TankCapacityMeasure[0]->attributes();
								if ($processtank->TankCountNumeric){	
									$HoldingTankNo = $processtank->TankCountNumeric;
								} else {
									$HoldingTankNo = 1;
								}
							}
						}
					}
				}
				
				//Loop through Accommodation Nodes
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Accommodation){
					$processaccomms = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Accommodation;
				  	foreach($processaccomms as $processaccomm)
					{
						if ((string) $processaccomm->AccommodationTypeCode == "SingleBerth"){
						$SingleBerthNo = $processaccomm->AccommodationCountNumeric;
						} else if ((string) $processaccomm->AccommodationTypeCode == "DoubleBerth"){
						$DoubleBerthNo = $processaccomm->AccommodationCountNumeric;
						} else if ((string) $processaccomm->AccommodationTypeCode == "TwinBerth"){
						$TwinBerthNo = $processaccomm->AccommodationCountNumeric;
						} else if ((string) $processaccomm->AccommodationTypeCode == "Cabin"){
						$CabinNo = $processaccomm->AccommodationCountNumeric;	
						} else if ((string) $processaccomm->AccommodationTypeCode == "Bathroom"){
						$BathroomNo = $processaccomm->AccommodationCountNumeric;
						} else if ((string) $processaccomm->AccommodationTypeCode == "Head"){
						$HeadNo = $processaccomm->AccommodationCountNumeric;
						}			
					}
				}
				//-- For stock no --// Newly added (VehicleRemarketingBoat)
				if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->VehicleStockString){
					$stockNo = $record->VehicleRemarketingHeader->DocumentIdentificationGroup->DocumentIdentification->DocumentID;				
				}else{
				$stockNo='';
				}
				//-- End Stock no --//
				
				
				//-- For boat Class --// Newly added (boatClass)
				$arrayBoatClasses=$record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatClassGroup;
				$vartemp=0;
				foreach($arrayBoatClasses as $arrayBoatClass)
				{
					if($arrayBoatClass->PrimaryBoatClassIndicator=='true')
					{
						$boatClass=$arrayBoatClass->BoatClassCode;
					}
					$vartemp++;
				}
				if($vartemp==0)
				{
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatClassGroup->PrimaryBoatClassIndicator=='true')
					{
						$boatClass=$record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatClassGroup->BoatClassCode;
					}
					else
					{
						$boatClass='';
					}
				}	
				//-- End boat Class --//
				
				//-- Seating capacity --//
				$seatingCapacity=$record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MaximumNumberOfPassengersNumeric;
				// End Seating capacity --//
				//echo $seatingCapacity.'safdsd';
				//exit;
								

				// Removed following fields since they weren't in the db and were causing errors in the import
				// postcode = '$postcode',
				// share_commision= '$share_commision',
				// exclusive_contract= '$exclusive_contract',
				// seatingCapacity='$seatingCapacity',
				// businessName='$businessName',
				// businessLocation='$businessLocation'

				//Insert Boat Details, used SET in order to make future addition of fields easier
				$insert = "INSERT INTO `".$table_prefix."bv_boatdetails` 
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
				
			    echo $$insert; 
				// echo $insert;
				$result = mysql_query(  $insert );
				// echo $result;
				
				
				
				//$postName=$Make.'-'.$Model;
				if($Model!='')
				{
					$postName=filterHTACCES_linktitle($Make)."-".filterHTACCES_linktitle($Model)."-".filterHTACCES_linktitle($BoatID);
				}
				else
				{
					$postName=filterHTACCES_linktitle($Make)."-".filterHTACCES_linktitle($BoatID);
				} 
				 @mysql_query("INSERT INTO `".$table_prefix."posts` (`ID` ,`post_author` ,`post_date` ,`post_date_gmt` ,`post_content` ,
							`post_title` ,`post_excerpt` ,`post_status` ,`comment_status` ,`ping_status` ,`post_password` ,`post_name` ,
							`to_ping` ,`pinged` ,`post_modified` ,`post_modified_gmt` ,`post_content_filtered` ,`post_parent` ,`guid` ,
							`menu_order` ,`post_type` ,`post_mime_type` ,`comment_count`)
							VALUES (NULL , '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '[bi_boats_listing id=$BoatID]', '$Make',
							 '','publish', 'closed', 'closed', '','$postName', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 
							 '', '0', '', '0', 'inventory', '', '0')");
							 //@mysql_query
							
				
				
				if ($result == 1 && $record->VehicleRemarketingBoatLineItem->AdditionalDetailDescription){
					//Populate Descriptions from XML
					//Loop through Descriptions Nodes
					//Declare and Clear Variables
					
						$processdescs = $record->VehicleRemarketingBoatLineItem->AdditionalDetailDescription;
					  	foreach($processdescs as $processdesc)
						{
							$AddTitle = $AddDescription = "";
							$AddTitle = addslashes(utf8_decode($processdesc->Title));
							$AddDescription = addslashes(utf8_decode($processdesc->Description));
							$AddDescription = str_replace("<div>","",$AddDescription);
							$AddDescription = str_replace("</div>","",$AddDescription);
							//Insert Descriptions, used SET in order to make future addition of fields easier
							$insert = "INSERT INTO `".$table_prefix."bv_descriptions` 
							SET BoatID = '$BoatID',
							AddTitle = '$AddTitle',	
							AddDescription = '$AddDescription'					
							";
							$result = mysql_query(  $insert );
							
														
							if (!$result){ echo mysql_error(); }
						}
				}
				
				if ($result == 1){
					//Populate Engines from XML
					//Loop through Engines Nodes
					//Declare and Clear Variables
					$EngineMake = $EngineModel = $EngineYear = $EngineFuel = $EngineNo = $DriveType = $TotalPower = $TotalPowerUnit = $PropellerType = $EngineHours = "";
					$EngineNo = 0;
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingEngineLineItem){
						$processengines = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingEngineLineItem;
					  	foreach($processengines as $processengine)
						{
							$EngineMake = addslashes($processengine->VehicleRemarketingEngine->MakeString);
							$EngineModel = addslashes($processengine->VehicleRemarketingEngine->Model);
							$EngineYear = $processengine->VehicleRemarketingEngine->ModelYear;
							$EngineFuel = $processengine->VehicleRemarketingEngine->FuelTypeCode;
							$EngineNo++;
							$DriveType = $processengine->VehicleRemarketingEngine->DriveTypeCode;
							$TotalPower = $processengine->VehicleRemarketingEngine->TotalEnginePowerQuantity;
							if ($processengine->VehicleRemarketingEngine->TotalEnginePowerQuantity){
								$TotalPowerUnit = $processengine->VehicleRemarketingEngine->TotalEnginePowerQuantity[0]->attributes();
							}
							$PropellerType = $processengine->VehicleRemarketingEngine->PropellerType;
							$EngineHours = $processengine->VehicleRemarketingEngine->TotalEngineHoursNumeric;
						}
					}
					//Insert Engines, used SET in order to make future addition of fields easier
					$insert = "INSERT INTO `".$table_prefix."bv_engines` 
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
					$result = mysql_query(  $insert );
				}
				if ($result == 1){
					//Populate Features from XML
					//Loop through Features Nodes
					
					if($record->VehicleRemarketingBoatLineItem->FeatureGroupDataNode->FeatureDataNode){
						$processfeatures = $record->VehicleRemarketingBoatLineItem->FeatureGroupDataNode->FeatureDataNode;
					  	foreach($processfeatures as $processfeature)
						{
							$Feature = $FeatureDetails = "";
							$Feature = addslashes($processfeature->DataNodeID);
							if ($processfeature->FreeFormTextGroup->Description){
								$FeatureDetails = addslashes(utf8_decode($processfeature->FreeFormTextGroup->Description));
							}
							//Insert Features, used SET in order to make future addition of fields easier
							$insert = "INSERT INTO `".$table_prefix."bv_features` 
							SET BoatID = '$BoatID',
							Feature = '$Feature',
							FeatureDetails = '$FeatureDetails'
							";
							$result = mysql_query(  $insert );
						}
					}	
				}
				if ($result == 1){
					//Populate Images from XML
					//Loop through Images Nodes
					
					if($record->VehicleRemarketingBoatLineItem->ImageAttachmentExtended){
						$processimages = $record->VehicleRemarketingBoatLineItem->ImageAttachmentExtended;
					  	foreach($processimages as $processimage)
						{
							$ImageURL = $ImageRanking = $ImageTitle = "";
							$ImageURL = addslashes($processimage->URI);
							$ImageRanking = addslashes($processimage->UsagePreference->PriorityRankingNumeric);
							if ($processimage->ImageAttachmentTitle){
								$ImageTitle = addslashes(utf8_decode($processimage->ImageAttachmentTitle));
							}
							//Insert Features, used SET in order to make future addition of fields easier
							$insert = "INSERT INTO `".$table_prefix."bv_images` 
							SET BoatID = '$BoatID',
							ImageURL = '$ImageURL',
							ImageRanking = '$ImageRanking',
							ImageTitle = '$ImageTitle'
							";
							$result = mysql_query(  $insert );
						}
					}	
				}
				if ($result == 1){
					//Populate Videos from XML
					//Loop through Videos Nodes
					
					if($record->VehicleRemarketingBoatLineItem->AdditionalMedia->MediaTypeString == "Video" || $record->VehicleRemarketingBoatLineItem->AdditionalMedia->MediaTypeString == "Embedded Video"|| $record->VehicleRemarketingBoatLineItem->AdditionalMedia->MediaTypeString == "Video Brochure"){
						$processvideos = $record->VehicleRemarketingBoatLineItem->AdditionalMedia;
					  	foreach($processvideos as $processvideo)
						{
							$VideoURL = $VideoTitle = $VideoThumb = $VideoEmbed = "";
							$VideoURL = addslashes($processvideo->MediaSourceURI);
							if ($processvideo->MediaAttachmentTitle){
								$VideoTitle = addslashes(utf8_decode($processvideo->MediaAttachmentTitle));
							}
							if ($processvideo->MediaThumbURI){
								$VideoThumb = addslashes($processvideo->MediaThumbURI);
							}
							if ($processvideo->EmbeddedData->DataString){
								$VideoEmbed = addslashes($processvideo->EmbeddedData->DataString);
							}
							//Insert Features, used SET in order to make future addition of fields easier
							$insert = "INSERT INTO `".$table_prefix."bv_videos` 
							SET BoatID = '$BoatID',
							VideoURL = '$VideoURL',
							VideoTitle = '$VideoTitle',
							VideoThumb = '$VideoThumb',
							VideoEmbed = '$VideoEmbed'
							";
							$result = mysql_query(  $insert );
						}
					}	
				}
			}
			
			updatePartyinfo();
			return $result;
		}

function updatePartyinfo()
{
	global $wpdb;
	$sql = "SELECT DISTINCT(`OfficeID`) FROM `".$wpdb->prefix."bv_boatdetails` WHERE 1=1";  
	$partyids=$wpdb->get_results($sql);
	
	
	
	if(!empty($partyids))
	{
		foreach($partyids as $ids)
		{
			$partyData[$ids->OfficeID]=getPartyinfo($ids->OfficeID);
	    }
		//Update To Database..
		if(count($partyData) > 0)
		{
			$table_name=$wpdb->prefix."bv_boatdetails";
			foreach($partyData as $id => $data)
			{
				//$sql="UPDATE ".$wpdb->prefix."bv_boatdetails SET BrokerTel='".$data->OfficeAddress->Phone."', Company='".$data->OfficeAddress->OfficeName."' WHERE OfficeID='".$id."'";
				$businessName = $data->OfficeAddress->OfficeName;
				$businessLocation = $data->OfficeAddress->CityName.', '.$data->OfficeAddress->StateOrProvince.', '.$data->OfficeAddress->CountryID;
				
				$address=$data->UserAddress->LineOne;
				if($data->UserAddress->LineTwo)
				if(!empty($data->UserAddress->LineTwo))
				 $address .= '<br>'.$data->UserAddress->LineTwo;
				  
				$data=array('BrokerTel'=>$data->UserAddress->Phone,'Company'=>$data->UserAddress->PersonName,'addressLineOne'=>$address,'LocationCity'=>$data->UserAddress->CityName,'LocationState'=>$data->UserAddress->StateOrProvince,'LocationCountry'=>$data->UserAddress->CountryID,'postcode'=>$data->UserAddress->Postcode,'businessName'=>$businessName,'businessLocation'=>$businessLocation);
				$where=array('OfficeID' => $id);
                $wpdb->update($table_name, $data, $where,$format = null, $where_format = null );
			}
		}
	}
	
}
		
function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}
	
	function getPartyinfo($partyID)
	{
		$patyurl="https://services.boatwizard.com/bridge/party/".$partyID;
		$partyinfo =  simpleXML_load_file($patyurl,"SimpleXMLElement",LIBXML_NOCDATA); //or die ("<br>Unable to load XML data for partyid: ".$partyID);
			
		if($partyinfo ===  FALSE)
		 return 'error';	
		else { return $partyinfo;	 } 
	}

//Run import on each XML URL in array
foreach ($urls as $url){

$result = run_import($url);
if ($result == 1){
	echo "$url Feed imported sucsessfully<br>";
} else {
	echo "$url Feed import unsucessful<br>";
}
}
?>
