<?php
/**
 *	Adds and register blocks for the Aqua Page Builder
 *
 *	@package Smarald
 *
 */


if(class_exists('AQ_Page_Builder')) {
	define('ICY_CUSTOM_DIR', get_template_directory() . '/page-builder/');
	define('ICY_CUSTOM_URI', get_template_directory_uri() . '/page-builder/');
	
	//include the block files
	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-slogan-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-horizontal-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-centered-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-contact-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-Page-Background-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-contentbox-text-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-image-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-video-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-html-block.php');	
	//register the blocks
	
	aq_register_block('ICY_Centered_Block');	
	aq_register_block('ICY_Contact_Block');
	aq_register_block('ICY_Horizontal_Block');
	aq_register_block('ICY_Slogan_Block');
	aq_register_block('ICY_Page_Background_Block');
	aq_register_block('ICY_Contentbox_Text_Block');
	aq_register_block('ICY_Image_Block');
	aq_register_block('ICY_Video_Block');
	aq_register_block('ICY_Html_Block');
		
}

?>