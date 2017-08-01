<?php 
 require_once('../../../../wp-config.php');
 require_once('team_profiles.php');
 
 $obj = new TeamProfiles();
 
 if($_REQUEST['action'] == "addnew")
 {
	 
	 $result = $obj->addProfiles($_REQUEST);
     echo $result; 
 }
 if($_REQUEST['action'] == "editprofile")
 {
	
    $result = $obj->editProfiles($_REQUEST);
    echo $result; 
 }
 if($_REQUEST['action'] == "bulkdelete")
 {
	
   $result = $obj->deleteProfiles($_REQUEST);
   echo $result; 
 }
?>