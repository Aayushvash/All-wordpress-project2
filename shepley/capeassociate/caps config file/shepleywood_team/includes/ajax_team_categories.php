<?php 
 require_once('../../../../wp-config.php');
 require_once('team_categories.php');
 
 $obj = new TeamCategories();
 
 if($_REQUEST['action'] == "addnew")
 {
   $result = $obj->addCategory($_REQUEST);
   echo $result; 
 }
 if($_REQUEST['action'] == "editcat")
 {
	
    $result = $obj->editCategory($_REQUEST);
    echo $result; 
 }
 if($_REQUEST['action'] == "bulkdelete")
 {
	
   $result = $obj->deleteCategory($_REQUEST);
   echo $result; 
 }
?>