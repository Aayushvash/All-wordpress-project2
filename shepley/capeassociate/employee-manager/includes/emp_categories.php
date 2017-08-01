<?php 
/***
 This is Main class For Employee Categories.
***/
 

class EmpCategories
{

     private $alert;
	 private $alert_status;
	 private $tablename;
	 private $categories;
	 
    /* constructor method */
    public function __construct($params= false)
    {
	   global $wpdb;
	   $this->tablename = $wpdb->prefix."employee_category";
	   
	   //Set Categories
	   if(empty($_GET['catid']))
	    $this->categories = $this->getCategories();
	   else
	    $this->categories = $this->getCategories($_GET['catid']);
		 	
	   //Set Alert Message
	   if(empty($_GET['message']))
	     $this->alert = null;
	   else
	     $this->alert = $this->message($_GET['message']);	 
		 	 	
	   //Set Alert status
	   if(empty($_GET['status']))
	     $this->alert_status = null;
	   elseif($_GET['status'] == "success" )
	     $this->alert_status = 1;
	   elseif($_GET['status'] == "error" )
	     $this->alert_status = 0;  	 	 
	  
	  //Set View
	   if(empty($_GET['action']))
	    { $this->view(); } 
	   elseif($_GET['action'] == "search")
	     { $this->search(); }
	   elseif($_GET['action'] == "edit")
	     { $this->edit(); }
	   elseif($_GET['action'] == "delete")
	     { 
		    $data['ids']=$_GET['catid'];
		    $response = json_decode($this->deleteCategory($data)); 
			header("Location:".$response->redirect."");
		 }	 
	}
	
	public function view()
	{
		require_once('templates/category/view.php');
	}
	
	public function search()
	{
		
		$this->categories = $this->getCategories('',$_REQUEST['search_category_input']);
		require_once('templates/category/view.php');
	}
	
	public function edit()
	{
		require_once('templates/category/edit.php');
	}
	
	public function message($message)
	{
		switch($message)
		{
			case 'inserted' : $alert = 'Category has been successfully inserted.'; break;
			case 'inserterror' : $alert = 'An Error occued to create new category.'; break;
			case 'updated' : $alert = 'Category has been successfully updated.'; break;
			case 'updateerror' : $alert = 'An Error occued to update category.'; break; 
			case 'deleted' : $alert = 'Category has been successfully deleted.'; break;
			case 'deleteerror' : $alert = 'An error occued to deleted category.'; break; 
		}
		
		return $alert;
	}
	
	public function getCategories($id='',$search='')
	{
		global $wpdb;
		$query = "SELECT * FROM ".$this->tablename." WHERE status=1";
		if($id)
		 $query .= " AND id=$id";
		if($search)
		 $query .= " AND (name LIKE '%".$search."%' OR description LIKE '%".$search."%')";
		  
		$query .= " ORDER By cat_order ASC"; 
		
		return $wpdb->get_results($query); 
	}
	
	public function addCategory($data)
	{
		global $wpdb;
		$date=date("Y-m-d H:i:s");
		
		$status=1; 
		$data=array(
		  'name'=> $data['category'],
		  'description' => $data['categorydesc'],
		  'cat_order'=> $data['categoryorder'],
		  'status' => $status,
		  'date' => $date
		);
		
		$wpdb->insert($this->tablename,$data); $wpdb->print_error();
		$id = $wpdb->insert_id;
		if($id)
		{
			$result['status'] = 'success';
			$result['redirect'] = 'admin.php?page=employee_categories&message=inserted&status=success'; 
		}
		else
		{
			$result['status'] = 'error';
			$result['redirect'] = 'admin.php?page=employee_categories&message=inserterror&status=error'; 
		}
		
		return json_encode($result);
	}
	
	public function editCategory($data)
	{
		global $wpdb;
		$date=date("Y-m-d H:i:s");
		
		$status=1; 
		$udata=array(
		  'name'=> $data['category'],
		  'description' => $data['categorydesc'],
		  'cat_order'=> $data['categoryorder'],
		  'status' => $status,
		  'date' => $date
		);
		
		$where=array('id' => $data['category_id']);
	    $res = $wpdb->update($this->tablename, $udata, $where,$format = null, $where_format = null );
		if($res)
		{
			$result['status'] = 'success';
			$result['redirect'] = 'admin.php?page=employee_categories&message=updated&status=success'; 
		}
		else
		{
			$result['status'] = 'error';
			$result['redirect'] = 'admin.php?page=employee_categories&message=updateerror&status=error'; 
		}
		
		return json_encode($result);
	}
	
	public function updateOrder($postId,$order)
	{
		global $wpdb;
		$i=0;
		foreach($postId as $post)
		{
		  $udata = array('cat_order'=>$order[$i]);
		  $where=array('id' => $post);
	      $res = $wpdb->update($this->tablename, $udata, $where,$format = null, $where_format = null );
		  $i++;
		}
		if($res)
		{
			$result['status'] = 'success';
			$result['redirect'] = 'admin.php?page=employee_categories&message=updated&status=success'; 
		}
		else
		{
			$result['status'] = 'success';
			$result['redirect'] = 'admin.php?page=employee_categories&message=updated&status=success'; 
		}
		
		return json_encode($result);
	}
	
	public function deleteCategory($data)
	{
		global $wpdb;
		
		$rids=$data['ids'];
		$rgid=explode(",",$rids);
		
		foreach($rgid as $a)
		{
		if( !empty($a) AND $a != NULL AND $a != 0 ) 
		$ids[]=$a; 
		}
		
		foreach($ids as $id)
		{
			$status=0;
			$update=array('status' => $status);
			
			$where=array('id' => $id);
			$res = $wpdb->update($this->tablename, $update, $where,$format = null, $where_format = null );

		}
		
		if($res)
		{
			$result['status'] = 'success';
			$result['redirect'] = 'admin.php?page=employee_categories&message=deleted&status=success'; 
		}
		else
		{
			$result['status'] = 'error';
			$result['redirect'] = 'admin.php?page=employee_categories&message=deleteerror&status=error'; 
		}
		
		return json_encode($result);
	}
	
	
}

 

?>