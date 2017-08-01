<?php 
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Home Three Boxes',
		'id' => 'home_three_boxes',
		'description' => 'This area for home page three boxes widget',	
		'before_widget' => '<div id="%1$s" class="homeThree %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => 'Home Full Widget',
		'id' => 'home_full_widget',
		'description' => 'This area for home page full widget',	
		'before_widget' => '<div id="%1$s" class="homeFull %2$s"><div class="centering">',
		'after_widget' => '</div></div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));	
	register_sidebar(array(
		'name' => 'Top Ad Banner',
		'id' => 'top_ad_banner',
		'description' => 'This area for Top Ad Banner Widget',	
		'before_widget' => '<div id="%1$s" class="adWidgetTop %2$s"><div class="centering">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'id' => 'page_sidebar',
		'description' => 'This area for Default Page Sidenar Widgets',	
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));		
	register_sidebar(array(
		'name' => 'Article Sidebar',
		'id' => 'article_sidebar',
		'description' => 'This area for Article List and Article Detail Sidenar',	
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="cat-title"><span class="widgetTitle">',
		'after_title' => '</span></div>',
	));	
	register_sidebar(array(
		'name' => 'Category Sidebar',
		'id' => 'category_sidebar',
		'description' => 'This area for Category Articles Page Sidebar',	
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="cat-title"><span class="widgetTitle">',
		'after_title' => '</span></div>',
	));		
	register_sidebar(array(
		'name' => 'Gewinnspiel Sidebar',
		'id' => 'gewinnspiel_sidebar',
		'description' => 'This area for Gewinnspiel Template Page',	
		'before_widget' => '<div id="%1$s" class="formWidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));	
	register_sidebar(array(
		'name' => 'Newsletter Sidebar',
		'id' => 'newsletter_sidebar',
		'description' => 'This area for Newsletter Template Page',	
		'before_widget' => '<div id="%1$s" class="formWidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));	
	register_sidebar(array(
		'name' => 'Kontakt Sidebar',
		'id' => 'kontakt_sidebar',
		'description' => 'This area for Kontakt Template Page',	
		'before_widget' => '<div id="%1$s" class="formWidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));			
	register_sidebar(array(
		'name' => 'Mediadaten Sidebar',
		'id' => 'mediadaten_sidebar',
		'description' => 'This area for mediadaten Page Sidenar Widgets',	
		'before_widget' => '<div id="%1$s" class="widgetSimple %2$s"><div class="inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));	
	register_sidebar(array(
		'name' => '404 Page Content',
		'id' => 'page404_sidebar',
		'description' => 'This area for 404 Page Content Text',	
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	));				
	register_sidebar(array(
		'name' => 'Bottom Widget',
		'id' => 'bottom_widget',
		'description' => 'This area for Bottom Widget Area but Before Footer',	
		'before_widget' => '<div id="%1$s" class="bottomWidget %2$s"><div class="middle"><div class="inner">',
		'after_widget' => '</div></div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));	
	register_sidebar(array(
		'name' => 'Footer Widgets',
		'id' => 'footer_widget',
		'description' => 'This area for Footer Sidebar Widgets',	
		'before_widget' => '<div id="%1$s" class="footerWidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));	
} 