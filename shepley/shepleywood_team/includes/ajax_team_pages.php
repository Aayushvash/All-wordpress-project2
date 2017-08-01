<?php 
 require_once('../../../../wp-config.php');
 require_once('team_pages.php');
 
 $obj = new TeamPages();
 
 if($_REQUEST['action'] == "addnew")
 {
	 $result = $obj->addPages($_REQUEST);
     echo $result; 
 }
 if($_REQUEST['action'] == "editpage")
 {
	
    $result = $obj->editPages($_REQUEST);
    echo $result; 
 }
 if($_REQUEST['action'] == "bulkdelete")
 {
	
   $result = $obj->deletePages($_REQUEST);
   echo $result; 
 }
?>