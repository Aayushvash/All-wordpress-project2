<?php 
/***
 Code For frontView
***/
 
    add_filter('the_content', 'shepleywood_team_front_view');
	
	function shepleywood_team_front_view($content)
	{
		global $wpdb,$user;
		$pattern = '#\[shepleywood_team_listing id=[0-9]+]#';
		
		preg_match_all($pattern, $content, $matches);
		foreach ($matches[0] as $match)
		{ 
		$idTemp=explode('id=',$match);
		$CATid=explode(']',$idTemp[1]);
		$rpl=frontendShepleywoodListing($CATid[0]);
		$content= preg_replace($pattern, $rpl, $content);
		}
		return $content;
	}
    function getPageContent($psgeId)
	{
		global $wpdb;
		$query = "SELECT descr FROM ".$wpdb->prefix."team_pages WHERE status=1 AND page_id=$psgeId";
		$result = $wpdb->get_results($query); 
		return $result[0]->descr;
		
	}
	function frontendShepleywoodListing($catID)
	{
		global $wpdb;
		$profiles = getProfiles($catID); 
		$output = '';
		$output .= getPageContent(get_the_ID());
		if(count($profiles) > 0)
		{
			$output .= '<div align="center">
				  <table border="1" class="storeteamtable">
					<tbody>';
			$i = 0;		
			foreach($profiles as $profile)
			{		
			   $i++;
			   if($i == 1) { $output .='<tr valign="top">'; }
			   $output .='<td align="center">';
			   $output .='<img alt="" src="'.$profile->profile_img_url.'" width="200px" />';
			   $output .='<strong>'.$profile->name.'</strong>';
			   if($profile->dagination) $output .= '<br/>'.$profile->dagination;
			   if($profile->cell) $output .= '<br/>Cell: '.$profile->cell;
			   if($profile->direct_cell) $output .= '<br/>Direct Number: '.$profile->direct_cell;
			   if($profile->fax) $output .=  '<br/>Fax: '.$profile->fax;
			   if($profile->email) $output .= '<br/><a href="mailto:'.$profile->email.'">'.$profile->email.'</a>';
			   $output .= '</td>';
			   if($i == 4 || $i == count($profiles)) { $output .= '</tr>'; unset($i); }
			}
			$output .= '</tbody></table></div>';
		}
		else
		 $output .= '<div align="center"><h3>No Profile Found</h3></div>';
		return $output;
	}
    function getProfiles($catid)
	{ 
		global $wpdb;
		$query = "SELECT * FROM ".$wpdb->prefix."team_profiles WHERE status=1";
		
		if($catid)
		 $query .= " AND category_id=$catid"; 
		
		$query .= " ORDER By id ASC"; 
		
		$profiles = $wpdb->get_results($query); 
		
		return $profiles;
	}
?>