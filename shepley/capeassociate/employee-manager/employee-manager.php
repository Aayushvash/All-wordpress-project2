<?php

  /* 

    Plugin Name: Employee Manager

    Plugin URI: http://lhmediasolutions.com/capeassociates/

    Description: This is new plugin for Employee Manager.

    Author: capassociates

    Version: 1.0 

    Author URI: http://lhmediasolutions.com/capeassociates/

    */

   
	require_once('includes/frontView.php');
	
	register_activation_hook(__FILE__, 'employee_manager_install');
	register_deactivation_hook( __FILE__, 'employee_manager_uninstall' );
	
	function employee_manager_install()
	{
	    global $wpdb;
	    $table_name = $wpdb->prefix . "employee_category";
		$table_name_profile = $wpdb->prefix . "employee_profiles";  
	    
		$sql = "CREATE TABLE " . $table_name . "(
		  id int(11) NOT NULL AUTO_INCREMENT,
		  name varchar(255) DEFAULT '' NOT NULL,
		  description text DEFAULT '' NOT NULL,
		  cat_order INT( 11 ) NOT NULL ,
		  status INT( 11 ) NOT NULL ,
		  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  PRIMARY KEY(id)		  
		);";
		
		$sqlprofile = "CREATE TABLE " . $table_name_profile . "(
		  id int(11) NOT NULL AUTO_INCREMENT,
		  name varchar(255) DEFAULT '' NOT NULL,
		  phone varchar(255) DEFAULT '' NOT NULL,
		  fax INT( 20 ) NOT NULL ,
		  email varchar(255) DEFAULT '' NOT NULL,
		  biography text DEFAULT '' NOT NULL,
		  profile_img_id INT( 20 ) NOT NULL ,
		  profile_img_url varchar(255) DEFAULT '' NOT NULL,
		  certification_logo_id varchar(255) DEFAULT '' NOT NULL,
		  certification_logo_url varchar(255) DEFAULT '' NOT NULL,
		  category_id INT( 11 ) NOT NULL ,
		  status INT( 11 ) NOT NULL ,
		  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  profile_order INT( 11 ) NOT NULL ,
		  PRIMARY KEY(id)		  
		);";
		
		$wpdb->query($sql);
		$wpdb->query($sqlprofile);
		
	}
	
	function employee_manager_uninstall()
	{
	    global $wpdb;
	    $table_name = $wpdb->prefix . "employee_category";
		$table_name_profile = $wpdb->prefix . "employee_profiles";
	    //$wpdb->query("DROP TABLE IF EXISTS  $table_name");
		//$wpdb->query("DROP TABLE IF EXISTS $table_name_profile");
	}
	

    function employee_admin_menu()

	{

	    global $title;

	    $menu_title = 'Employee Manager';		

       add_menu_page($title,$menu_title,'10','employee_manager','employee_pages',plugins_url('employee-manager/images/wordpress-icon.png')); 	
  
	   add_submenu_page('employee_manager','','','10','employee_manager','employee_categories');
	   
	   add_submenu_page('employee_manager',$page_title, 'Employee Categories','10', 'employee_categories', 'employee_categories');
	   add_submenu_page('employee_manager',$page_title, 'Employee Profiles','10', 'employee_profiles', 'employee_profiles');

	}

	add_action('admin_menu','employee_admin_menu');

	function employee_categories()
	{
	   require_once('includes/emp_categories.php');
	   $cobj = new EmpCategories();
	}

    function employee_profiles()
	{
	   require_once('includes/emp_profiles.php');
	   $pobj = new EmpProfiles();
	}
	
	
?>