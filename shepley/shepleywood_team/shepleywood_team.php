<?php

  /* 

    Plugin Name: Shepleywood Team

    Plugin URI: http://shepleywood.com/

    Description: this is fully new plugin for team members of Shepleywood.

    Author: Shepleywood.com

    Version: 1.0 

    Author URI: http://shepleywood.com/

    */

   
	require_once('includes/frontView.php');
	


    function team_admin_menu()

	{

	    global $title;

	    $menu_title = 'Shepley Team';		

       add_menu_page($title,$menu_title,'10','shepley_team','team_profiles',plugins_url('shepleywood_team/images/wordpress-icon.png')); 	

	   add_submenu_page('shepley_team','','','10','shepley_team','team_profiles');

	   add_submenu_page('shepley_team',$page_title, 'Team Categories','10', 'shepley_team_categories', 'team_categories');
	   add_submenu_page('shepley_team',$page_title, 'Team Pages','10', 'shepley_team_pages', 'team_pages');
	   add_submenu_page('shepley_team',$page_title, 'Team Profiles','10', 'shepley_team_profiles', 'team_profiles');

	}

	add_action('admin_menu','team_admin_menu');

	function team_pages()
	{
		require_once('includes/team_pages.php');
		$tobj = new TeamPages();
	}
	
	function team_categories()
	{
	   require_once('includes/team_categories.php');
	   $cobj = new TeamCategories();
	}

    function team_profiles()
	{
	   require_once('includes/team_profiles.php');
	   $pobj = new TeamProfiles();
	}
	
?>