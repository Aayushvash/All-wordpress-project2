<?php 
 require_once('../../../../wp-config.php');
 require_once('emp_categories.php');
 
 $obj = new EmpCategories();
 
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
 if($_REQUEST['action'] == "updateorder")
 {
     if($_REQUEST['orderData']) $order = explode(",",$_REQUEST['orderData']); 
	 if($_REQUEST['postId']) $postids = explode(",",$_REQUEST['postId']);
	 
	 $result = $obj->updateOrder($postids,$order);
	 echo $result;
 }
?>