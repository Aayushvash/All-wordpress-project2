<?php 
/***
 Code For frontView
***/

    add_filter('the_content', 'employee_manager_front_view');
    add_shortcode( 'employee_manager', 'frontendListing' );

	function employee_manager_front_view($content)
	{
		global $wpdb,$user;
		$pattern = '#\[employee_manager]#';
		
		preg_match_all($pattern, $content, $matches);
		
		foreach ($matches[0] as $match)
		{ 
		  $rpl=frontendListing();
		  $content= preg_replace($pattern, $rpl, $content);
		}
		return $content;
	}
    function frontendListing()
	{
		 global $wpdb;
		 $query = "SELECT * FROM ".$wpdb->prefix."employee_category WHERE status=1 ORDER By cat_order ASC";
		 $cats = $wpdb->get_results($query);
		 $output = '';
		 $counter= 1;
		 foreach($cats as $cat)
			{
				$output .= '<h3 class="team">'.$cat->name.':</h3>';
				 
						$profile = "SELECT * FROM ".$wpdb->prefix."employee_profiles WHERE status=1 and category_id=$cat->id  ORDER By profile_order ASC";
						$profile = $wpdb->get_results($profile);
							$i= 1;
							$count= 1;
							foreach($profile as $profiles)
							{
							 
							 $output .='<div class="team-member team'.$counter.$count; if ($i%2==0) { $output .=' even'; } else { $output .=' odd'; } 
							  $output .='">';
                        
                            		    $output .='<div class="team-bottom">
                            
                                		<div class="team-mid">
                                			<div class="team-center">
												<div class="thumb">
													<img src="'.$profiles->profile_img_url.'" />';
													 $logo=  json_decode($profiles->certification_logo_url);
													   if($logo){
													   foreach($logo as $logos)
													   {
														 
														 $output .='<img class="logo" src="'.$logos.'" />';
													   }
													   }
													
												 $output .='</div>
                              
										 <div class="details">
										<h3>'.$profiles->name.'</h3>
										
										<p>'.$profiles->biography.'</p>';
										
										 $output .='<span class="phone">Phone :'.$profiles->phone.'</span>
										 			<div class="clear"></div>
										 			<span class="fax">Fax : '.$profiles->fax.'</span>
													<div class="clear"></div>
										 			<a class="email" href="mailto:'.$profiles->email.'">'.$profiles->email.'</a> 
																		
										</div>
										 
										<div class="clear"></div>
                                </div>
                                </div>
                            </div>
                        </div>';
							if ($i%2==0)
						{
							$output = $output.'<div class="clear"></div>';
                           
						}
					
						
							 $i++;
							 $count++;							 
							}
				
			$counter++;}
		 
		  return $output;		
	}
	 
?>