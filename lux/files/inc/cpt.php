<?php
// eJournal custom post type
add_action('init', 'create_ejournal');
function create_ejournal() {
	$ejournal_args = array(
		'labels' => array(
			'name' => __( 'eJournals' ),
			'singular_name' => __( 'eJournal' ),
			'add_new' => __('Add eJournal'),
			'all_items' => __('All eJournals'),
			'edit_item' => __('Edit eJournal'),
			'add_new_item' => __('Add New eJournal'),
		),
		'singular_label' => __('eJournals'),
		'public' => true,
		'exclude_from_search' => 'true',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'all-ejournals'),
		'menu_icon' => get_stylesheet_directory_uri() . '/images/ejournal-icon.png',
		'has_archive' => true,
		'supports' => array('title', 'excerpt', 'thumbnail')
	);
	register_post_type('ejournal',$ejournal_args);
}
// end eJournal custom post type

// Mediadaten custom post type
add_action('init', 'create_mediadaten');
function create_mediadaten() {
	$mediadaten_args = array(
		'labels' => array(
			'name' => __( 'Mediadaten' ),
			'singular_name' => __( 'Mediadaten' ),
			'add_new' => __('Add Mediadaten'),
			'all_items' => __('All Mediadaten'),
			'edit_item' => __('Edit Mediadaten'),
			'add_new_item' => __('Add New Mediadaten'),
		),
		'singular_label' => __('Mediadaten'),
		'public' => true,
		'exclude_from_search' => 'true',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'all-mediadaten'),
		'menu_icon' => get_stylesheet_directory_uri() . '/images/mediadaten-icon.png',
		'has_archive' => true,
		'supports' => array('title', 'excerpt', 'thumbnail')
	);
	register_post_type('mediadaten',$mediadaten_args);
}
// end Mediadaten custom post type

// Flip custom post type
add_action('init', 'create_flip_feature');
function create_flip_feature() {
	$flip_feature_args = array(
		'labels' => array(
			'name' => __( 'Flip Feature' ),
			'singular_name' => __( 'Flip Feature' ),
			'add_new' => __('Add Flip Post'),
			'all_items' => __('All Flip Posts'),
			'edit_item' => __('Edit Flip Post'),
			'add_new_item' => __('Add New Flip Post'),
		),
		'singular_label' => __('flip_feature'),
		'public' => true,
		'exclude_from_search' => 'true',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'all-flip_feature'),
		'has_archive' => true,
		'supports' => array('title','thumbnail')
	);
	register_post_type('flip_feature',$flip_feature_args);
}
// end Flip custom post type