<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}
 
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
}
$content_width = 450;
add_theme_support('post-thumbnails');

add_image_size( 'post-small', 274, 94, true );
add_image_size( 'post-medium', 410, 161, true );
add_image_size( 'post-large', 543, 222, true );
add_image_size( 'icon-small', 75, 75, true );
add_image_size( 'post-large-ban', 698, 342, true );
add_image_size( 'bottom_image', 161, 91, true );
add_image_size( 'post-large-ban-right', 235, 130, true );

automatic_feed_links(); 

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'id' => 'photo-bar',
		'name' => 'Photo Bar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
}

function register_my_menus() {
	register_nav_menus(
		array(
	'primary' => __('Primary Navigation', 'twentyten'),
	'secondry' => __('Secondry Navigation', 'twentyten'),
	)
	);
}
add_action( 'init', 'register_my_menus' );

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

/* Custom post type  */
add_action('init', 'create_post_type');
function create_post_type()
{
    register_post_type('profino', array(
        'labels' => array(
            'name' => __('Profino'),
            'singular_name' => __('Profino')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'profino'
        ),
        'supports' => array(
            'title', 'editor', 'thumbnail'
        )
    ));
	
	register_post_type('team', array(
        'labels' => array(
            'name' => __('team'),
            'singular_name' => __('team')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'team'
        ),
        'supports' => array(
            'title', 'editor', 'thumbnail'
        )
    ));
	
	
	register_post_type('agenda', array(
        'labels' => array(
            'name' => __('agenda'),
            'singular_name' => __('agenda')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'agenda'
        ),
        'supports' => array(
            'title', 'editor', 'thumbnail'
        )
    ));
	
	register_post_type('aussteller', array(
        'labels' => array(
            'name' => __('aussteller'),
            'singular_name' => __('aussteller')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'aussteller'
        ),
        'supports' => array(
            'title', 'editor', 'thumbnail'
        )
    ));
	
	register_post_type('bottom_image', array(
        'labels' => array(
            'name' => __('Footer Logo'),
            'singular_name' => __('Footer Logo')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'Bottom-image'
        ),
        'supports' => array(
            'title', 'editor', 'thumbnail'
        )
    ));
	
	
}
