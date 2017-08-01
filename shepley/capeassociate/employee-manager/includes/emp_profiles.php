<?php 
/***
 This is Main class For Employee Profiles.
***/
 

class EmpProfiles
{
     private $alert;
	 private $alert_status;
	 private $tablename;
	 private $categories;
	 private $profiles;
	 private $cattablename;
    /* constructor method */
    public function __construct($params= false)
    {
        global $wpdb;
		
        $this->cattablename = $wpdb->prefix."employee_category";
		$this->tablename = $wpdb->prefix."employee_profiles";
		$this->categories = $this->getCategories(); //Get categories
		
		//Set pages
	   if(empty($_GET['profileid']))
	    $this->profiles = $this->getProfiles();
	   else
	    $this->profiles = $this->getProfiles($_GET['profileid']);
		
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
	   elseif($_GET['action'] == "filter")
	     { $this->filter(); }	 
	   elseif($_GET['action'] == "delete")
	     { 
		    $data['ids']=$_GET['profileid'];
		    $response = json_decode($this->deleteProfiles($data)); 
			header("Location:".$response->redirect."");
		 }   
    }
	
	public function view()
	{
		wp_enqueue_media(); //add Media files
        require_once('templates/profile/view.php');
	}
	public function edit()
	{
		wp_enqueue_media(); //add Media files
		require_once('templates/profile/edit.php');
	}
	public function search()
	{
		
		$this->profiles = $this->getProfiles('',$_REQUEST['search_profile_input']);
		require_once('templates/profile/view.php');
	}
	public function filter()
	{
		
		$this->profiles = $this->getProfiles('','',$_GET['category_id']);
		require_once('templates/profile/view.php');
	}	
	public function message($message)
	{ 
		switch($message)
		{
			case 'inserted' : $alert = 'Profile has been successfully inserted.'; break;
			case 'inserterror' : $alert = 'An Error occued to create new profile.'; break;
			case 'updated' : $alert = 'Profile has been successfully updated.'; break;
			case 'updateerror' : $alert = 'An Error occued to update profile.'; break; 
			case 'deleted' : $alert = 'Profile has been successfully deleted.'; break;
			case 'deleteerror' : $alert = 'An error occued to deleted profile.'; break; 
		}
		
		return $alert;
	}
	public function getProfiles($id='',$search='',$catid='')
	{
		global $wpdb;
		$query = "SELECT * FROM ".$this->tablename." WHERE status=1";
		if($id)
		 $query .= " AND id=$id";
		if($catid)
		 $query .= " AND category_id=$catid"; 
		if($search)
		$query .= " AND (name LIKE '%".$search."%' OR email LIKE '%".$search."%' OR biography LIKE '%".$search."%' OR phone LIKE '%".$search."%' OR fax LIKE '%".$search."%')";
		  
		$query .= " ORDER By profile_order ASC"; 
		
		$profiles = $wpdb->get_results($query); 
		
		if($profiles)
		{
		  $i=0;	
		  foreach($profiles as $profile)
		  {
			  $category = $this->getCategories($profile->category_id);
			  $profiles[$i]->category_name = $category[0]->name;
			  $i++;
		  }
		}
		return $profiles;
	}
	public function deleteProfiles($data)
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
			$result['redirect'] = 'admin.php?page=employee_profiles&message=deleted&status=success'; 
		}
		else
		{
			$result['status'] = 'error';
			$result['redirect'] = 'admin.php?page=employee_profiles&message=deleteerror&status=error'; 
		}
		
		return json_encode($result);
	}
	public function addProfiles($profile)
	{
		global $wpdb;
		$date=date("Y-m-d H:i:s");
		
		$status=1; 
		
		$profiledata=array(
		  'name'=> $profile['profile-name'],
		  'phone'=> $profile['profile-phone'],
		  'fax'=> $profile['profile-fax'],
		  'email'=> $profile['profile-email'],
		  'biography' => $profile['profile-biography'],
		  'profile_img_id'=> $profile['profile_image_id'],
		  'profile_img_url'=> $profile['profile_image_url'],
		  'certification_logo_id'=> json_encode($profile['certification_logo']['id']),
		  'certification_logo_url'=> json_encode($profile['certification_logo']['url']),
		  'category_id'=> $profile['profile-category'],
		  'status' => $status,
		  'date' => $date
		);
		
		$wpdb->insert($this->tablename,$profiledata); $wpdb->print_error();
		$id = $wpdb->insert_id;
		if($id)
		{
			
			$result['status'] = 'success';
			$result['redirect'] = 'admin.php?page=employee_profiles&message=inserted&status=success'; 
		}
		else
		{
			$result['status'] = 'error';
			$result['redirect'] = 'admin.php?page=employee_profiles&message=inserterror&status=error'; 
		}
		
		return json_encode($result);
	}
	
	public function editProfiles($profile)
	{
		global $wpdb;
		$date=date("Y-m-d H:i:s");
		
		$status=1; 
		$profiledata=array(
		  'name'=> $profile['profile-name'],
		  'phone'=> $profile['profile-phone'],
		  'fax'=> $profile['profile-fax'],
		  'email'=> $profile['profile-email'],
		  'biography' => $profile['profile-biography'],
		  'profile_img_id'=> $profile['profile_image_id'],
		  'profile_img_url'=> $profile['profile_image_url'],
		  'certification_logo_id'=> json_encode($profile['certification_logo']['id']),
		  'certification_logo_url'=> json_encode($profile['certification_logo']['url']),
		  'category_id'=> $profile['profile-category'],
		  'status' => $status,
		  'date' => $date
		);
		
		$where=array('id' => $profile['profile_id']);
		
	    $res = $wpdb->update($this->tablename, $profiledata, $where,$format = null, $where_format = null );
		if($res)
		{
			$result['status'] = 'success';
			$result['redirect'] = 'admin.php?page=employee_profiles&message=updated&status=success'; 
		}
		else
		{
			$result['status'] = 'error';
			$result['redirect'] = 'admin.php?page=employee_profiles&message=updateerror&status=error'; 
		}
		
		return json_encode($result);
	}
	
	public function updateOrder($postId,$order)
	{
		global $wpdb;
		$i=0;
		foreach($postId as $post)
		{
		  $profiledata = array('profile_order'=>$order[$i]);
		  $where=array('id' => $post);
	      $res = $wpdb->update($this->tablename, $profiledata, $where,$format = null, $where_format = null );
		  $i++;
		}
		if($res)
		{
			$result['status'] = 'success';
			$result['redirect'] = 'admin.php?page=employee_profiles&message=updated&status=success'; 
		}
		else
		{
			$result['status'] = 'success';
			$result['redirect'] = 'admin.php?page=employee_profiles&message=updated&status=success'; 
		}
		
		return json_encode($result);
	}
	
	
    public function getCategories($id='')
	{
		global $wpdb;
		$query = "SELECT id,name FROM ".$this->cattablename." WHERE status=1";
		if($id)
		 $query .= " AND id=$id";
		
		$query .= " ORDER By name ASC"; 
		
		return $wpdb->get_results($query); 
	}
}

 

?>