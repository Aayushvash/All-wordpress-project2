<?php 
 require_once('../../../../wp-config.php');
 require_once('emp_profiles.php');
 
 $obj = new EmpProfiles();
 
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
 
 if($_REQUEST['action'] == "updateorder")
 {
     if($_REQUEST['orderData']) $order = explode(",",$_REQUEST['orderData']); 
	 if($_REQUEST['postId']) $postids = explode(",",$_REQUEST['postId']);
	 
	 $result = $obj->updateOrder($postids,$order);
	 echo $result;
 }
?>