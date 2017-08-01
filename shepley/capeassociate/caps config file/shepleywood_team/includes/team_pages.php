<?php 
/***
 This is Main class For team_pages.
***/
 

class TeamPages 
{

     private $alert;
	 private $alert_status;
	 private $tablename;
	 private $categories;
	 private $pages;
	 private $cattablename;
    /* constructor method */
    public function __construct($params= false)
    {
		global $wpdb;
        $this->cattablename = $wpdb->prefix."team_category";
		$this->tablename = $wpdb->prefix."team_pages";
		$this->categories = $this->getCategories(); //Get categories
		
		//Set pages
	   if(empty($_GET['pageid']))
	    $this->pages = $this->getPages();
	   else
	    $this->pages = $this->getPages($_GET['pageid']);
	
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
		    $data['ids']=$_GET['pageid'];
		    $response = json_decode($this->deletePages($data)); 
			header("Location:".$response->redirect."");
		 }
    }
	public function search()
	{
		
		$this->pages = $this->getPages('',$_REQUEST['search_page_input']);
		require_once('templates/pages/view.php');
	}
	public function view()
	{
		require_once('templates/pages/view.php');
	}
	public function edit()
	{
		require_once('templates/pages/edit.php');
	}
	public function getPages($id='',$search='')
	{
		global $wpdb;
		$query = "SELECT * FROM ".$this->tablename." WHERE status=1";
		if($id)
		 $query .= " AND id=$id";
		if($search)
		 $query .= " AND (title LIKE '%".$search."%' OR descr LIKE '%".$search."%')";
		  
		$query .= " ORDER By title ASC"; 
		
		$pages = $wpdb->get_results($query); 
		
		if($pages)
		{
		  $i=0;	
		  foreach($pages as $page)
		  {
			  $category = $this->getCategories($page->category_id);
			  $pages[$i]->category_name = $category[0]->name;
			  $i++;
		  }
		}
		return $pages;
	}
	
	public function message($message)
	{
		switch($message)
		{
			case 'inserted' : $alert = 'Page has been successfully inserted.'; break;
			case 'inserterror' : $alert = 'An Error occued to create new page.'; break;
			case 'updated' : $alert = 'Page has been successfully updated.'; break;
			case 'updateerror' : $alert = 'An Error occued to update page.'; break; 
			case 'deleted' : $alert = 'Page has been successfully deleted.'; break;
			case 'deleteerror' : $alert = 'An error occued to deleted page.'; break; 
		}
		
		return $alert;
	}
	
	public function addPages($data)
	{
		global $wpdb;
		$date=date("Y-m-d H:i:s");
		
		$status=1; 
		$idata=array(
		  'title'=> $data['page'],
		  'descr' => $data['pagedesc'],
		  'category_id'=> $data['pagecategory'],
		  'status' => $status,
		  'date' => $date
		);
		
		$pageId = $this->addPostPage($idata); // Add Page in posts
		$idata['page_id']=$pageId;
		
		$wpdb->insert($this->tablename,$idata); $wpdb->print_error();
		$id = $wpdb->insert_id;
		if($id)
		{
			
			$result['status'] = 'success';
			$result['redirect'] = 'admin.php?page=shepley_team_pages&message=inserted&status=success'; 
		}
		else
		{
			$result['status'] = 'error';
			$result['redirect'] = 'admin.php?page=shepley_team_pages&message=inserterror&status=error'; 
		}
		
		return json_encode($result);
	}
	
	public function addPostPage($data)
	{
		global $wpdb;
		$posttable = $wpdb->prefix."posts";
		$postName = $this->filterHTACCES_linktitle(strtolower($data['title']));
		$postContent = '[shepleywood_team_listing id='.$data['category_id'].']';
		$postdata =array(
		  'post_author'=> 1,
		  'post_content' => $postContent,
		  'post_title'=> $data['title'],
		  'post_status' => 'publish',
		  'comment_status' => 'closed',
		  'ping_status' => 'closed',
		  'post_name' => $postName,
		  'post_type' => 'page'
		);
		
	   	$wpdb->insert($posttable,$postdata); $wpdb->print_error();
		return $wpdb->insert_id;
	}
	
	public function deletePostPage($tpageid)
	{
		global $wpdb;
		$posttable = $wpdb->prefix."posts";
		$pageid = $this->getPages($tpageid,'');
		
		$postdata = array('post_status' => 'trash');
		$where=array('ID' => $pageid[0]->page_id);
		
		$res = $wpdb->query("DELETE FROM ".$posttable." WHERE ID = ".$pageid[0]->page_id."");
		
	    //$res = $wpdb->update($posttable, $postdata, $where,$format = null, $where_format = null );
		
	}
	
	public function editPostPage($pdata)
	{
		global $wpdb;
		$posttable = $wpdb->prefix."posts";
		
		$postName = $this->filterHTACCES_linktitle(strtolower($pdata['page']));
		$postContent = '[shepleywood_team_listing id='.$pdata['pagecategory'].']';
		
		$postdata =array('post_content' => $postContent ,'post_title' => $pdata['page'], 'post_name' => $postName);
		$where=array('ID' => $pdata['post_page_id']);
		
	    $res = $wpdb->update($posttable, $postdata, $where,$format = null, $where_format = null );
		
	}
	
	public function editPages($data)
	{
		global $wpdb;
		$date=date("Y-m-d H:i:s");
		
		$status=1; 
		$udata=array(
		  'title'=> $data['page'],
		  'descr' => $data['pagedesc'],
		  'category_id'=> $data['pagecategory'],
		  'status' => $status,
		  'date' => $date
		);
		
		$where=array('id' => $data['page_id']);
		$this->editPostPage($data); // Edit Page in posts
		
	    $res = $wpdb->update($this->tablename, $udata, $where,$format = null, $where_format = null );
		if($res)
		{
			$result['status'] = 'success';
			$result['redirect'] = 'admin.php?page=shepley_team_pages&message=updated&status=success'; 
		}
		else
		{
			$result['status'] = 'error';
			$result['redirect'] = 'admin.php?page=shepley_team_pages&message=updateerror&status=error'; 
		}
		
		return json_encode($result);
	}
	
	public function deletePages($data)
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
			
			$this->deletePostPage($id); //Delete post page 
			$res = $wpdb->update($this->tablename, $update, $where,$format = null, $where_format = null );
			
		}
		
		if($res)
		{
			$result['status'] = 'success';
			$result['redirect'] = 'admin.php?page=shepley_team_pages&message=deleted&status=success'; 
		}
		else
		{
			$result['status'] = 'error';
			$result['redirect'] = 'admin.php?page=shepley_team_pages&message=deleteerror&status=error'; 
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
  public function filterHTACCES_linktitle($title)
   {
	$linktitle=str_replace("%","",str_replace(" ","-",$title));
	$linktitle=str_replace("(","",$linktitle);
	$linktitle=str_replace(")","",$linktitle);
	$linktitle=str_replace(":","",$linktitle);
	$linktitle=str_replace("!","",$linktitle);
	$linktitle=str_replace("&gt;","",$linktitle);
	$linktitle=str_replace("&lt;","",$linktitle);
	$linktitle=str_replace("`","",$linktitle);
	$linktitle=str_replace("'","",$linktitle);
	$linktitle=str_replace("&amp;","",$linktitle);
	$linktitle=str_replace("&quot;","",$linktitle);
	$linktitle=str_replace("&apos;","",$linktitle);
	$linktitle=str_replace("&","",$linktitle);
	$linktitle=str_replace("?","",$linktitle);
	$linktitle=str_replace("||","",$linktitle);
	$linktitle=str_replace("\"","",$linktitle);
	$linktitle=str_replace("+","",$linktitle);
	$linktitle=str_replace("=","",$linktitle);
	$linktitle=str_replace("#","",$linktitle);
	$linktitle=str_replace("}","",$linktitle);
	$linktitle=str_replace("{","",$linktitle);
	$linktitle=str_replace(";","",$linktitle);
	$linktitle=str_replace(":","",$linktitle);
	$linktitle=str_replace("~","",$linktitle);
	$linktitle=str_replace("^","",$linktitle);
	$linktitle=str_replace("[","",$linktitle);
	$linktitle=str_replace("]","",$linktitle);
	$linktitle=str_replace("»","",$linktitle);
	$linktitle=str_replace("Š","",$linktitle);
	$linktitle=str_replace("š","",$linktitle);
	$linktitle=str_replace("ª","",$linktitle);
	$linktitle=str_replace("¬","",$linktitle);
	$linktitle=str_replace("®","",$linktitle);
	$linktitle=str_replace("°","",$linktitle);
	$linktitle=str_replace("²","",$linktitle);
	$linktitle=str_replace("¶","",$linktitle);
	$linktitle=str_replace("ž","",$linktitle);
	$linktitle=str_replace("º","",$linktitle);
	$linktitle=str_replace("Œ","",$linktitle);
	$linktitle=str_replace("Ÿ","",$linktitle);
	$linktitle=str_replace("À","",$linktitle);
	$linktitle=str_replace("Â","",$linktitle);
	$linktitle=str_replace("Ò","",$linktitle);
	$linktitle=str_replace("§","",$linktitle);
	$linktitle=str_replace("©","",$linktitle);
	$linktitle=str_replace("±","",$linktitle);
	$linktitle=str_replace("µ","",$linktitle);
	$linktitle=str_replace("»","",$linktitle);
	$linktitle=str_replace("¿","",$linktitle);
	$linktitle=str_replace("¿","",$linktitle);
	$linktitle=str_replace("?","",$linktitle);
	$linktitle=str_replace("÷","",$linktitle);
	$linktitle=str_replace("","",$linktitle);
	$linktitle=str_replace("","",$linktitle);
	$linktitle=str_replace("à¹","",$linktitle);
	$linktitle=str_replace("à","",$linktitle);
	$linktitle=str_replace("¡à¹à","",$linktitle);
	$linktitle=str_replace("«à","",$linktitle);
	$linktitle=str_replace("¥à¹à","",$linktitle);
	$linktitle=str_replace("à","",$linktitle);
	$linktitle=str_replace("¥","",$linktitle);
	$linktitle=str_replace("à¹à","",$linktitle);
	$linktitle=str_replace("à","",$linktitle);
	$linktitle=str_replace("?","",$linktitle);
	$linktitle=ereg_replace("[^[:space:]a-zA-Z0-9*_.-]", "", $linktitle);

	$linktitle=str_replace("  "," ",$linktitle);
	$linktitle=str_replace("|","-",$linktitle);
	$linktitle=str_replace(",","-",$linktitle);
	$linktitle=str_replace("*","-",$linktitle);
	$linktitle=str_replace(".","-",$linktitle);
	$linktitle=str_replace("_","-",$linktitle);
	$linktitle=str_replace("/","-",$linktitle);
	$linktitle=str_replace("\\","-",$linktitle);
	$linktitle=str_replace(",","-",$linktitle);
	$linktitle=str_replace("`","-",$linktitle);
	$linktitle=str_replace("'","-",$linktitle);
	$linktitle=str_replace("-","-",$linktitle);
	$linktitle=str_replace("----","-",$linktitle);
	$linktitle=str_replace("---","-",$linktitle);
	$linktitle=str_replace("--","-",$linktitle);
	return $linktitle;
  }
}

 

?>