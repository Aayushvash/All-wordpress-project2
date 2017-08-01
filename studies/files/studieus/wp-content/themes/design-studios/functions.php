<?php 
include(get_template_directory().'/widget/post-type-widget.php');
include(get_template_directory().'/widget/our-training-widget.php');
/** * Proper way to enqueue scripts and styles */
function themename_scripts() {
	if (!is_admin()) {
		wp_enqueue_style( 'style-themename', get_stylesheet_uri() );
		wp_enqueue_style( 'layout-custom', get_template_directory_uri() . '/css/layout.css');
		wp_enqueue_style( 'fonts-custom', get_template_directory_uri() . '/fonts/fonts.css');
		wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css');
						
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'flexslider-scripts', get_template_directory_uri() . '/js/jquery.flexslider.js', array(), '1.0.0', true );	
		wp_enqueue_script( 'custom-scripts', get_template_directory_uri() . '/js/custom.js', array(), '1.0.0', true );	
	}
}
add_action( 'wp_enqueue_scripts', 'themename_scripts' );


if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';

	
}


// side bar option start here
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Lees OOK Sidebar',
		'id' => 'default_sidebar',
		'description' => 'This area page Default sidebar',	
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Logo Sidebar',
		'id' => 'logo_sidebar',
		'description' => 'This area page Logo sidebar',	
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Footer Sidebar',
		'id' => 'footer_sidebar',
		'description' => 'This area footer sidebar',	
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Mail Chimp Sidebar',
		'id' => 'mailchimp_sidebar',
		'description' => 'This area footer sidebar',	
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Our Training Sidebar',
		'id' => 'training_sidebar',
		'description' => 'This area footer sidebar',	
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	
	
}
// side bar option end here

function wpb_comment_reply_text( $link ) {
$link = str_replace( 'Reply', 'reageren', $link );
return $link;
}
add_filter( 'comment_reply_link', 'wpb_comment_reply_text' );

function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		
    <?php endif; ?>
    <span class="profile_icon">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
      
    </span>
    <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <br />
    <?php endif; ?>
	 <span class="comment_content">
	   <?php printf( __( '<strong>%s</strong>' ), get_comment_author_link() ); ?>
   <?php comment_text(); ?>
	   <span class="comment_date">
	   <?php			
						$time = get_comment_date();
						//Let's set the current time						
						$currentTime = date('Y-m-d H:i:s');
						$toTime = strtotime($currentTime);
						//And the time the notification was set
						$fromTime = strtotime($time);
						//Now calc the difference between the two
						$timeDiff = floor(abs($toTime - $fromTime) / 60);					
						if ($timeDiff < 2) {							
							$timeDiff = "Just now";
							echo "<span class='last'><i>".$timeDiff."</i></span>";						
						} elseif ($timeDiff > 2 && $timeDiff < 60) {
							$timeDiff = floor(abs($timeDiff)) . " notulen geleden";
							echo "<span class='last'><i>".$timeDiff."</i></span>";  						
						} elseif ($timeDiff > 60 && $timeDiff < 120) {
							$timeDiff = floor(abs($timeDiff / 60)) . " uur geleden";
							echo "<span class='last'><i>".$timeDiff."</i></span>";	
							
						} elseif ($timeDiff < 1440) {
							$timeDiff = floor(abs($timeDiff / 60)) . " uur geleden";
							echo "<span class='last'><i>".$timeDiff."</i></span>";	
							
						} elseif ($timeDiff > 1440 && $timeDiff < 2880) {
							$timeDiff = floor(abs($timeDiff / 1440)) . " dag geleden";
							echo "<span class='last'><i>".$timeDiff."</i></span>";	
							
						} elseif ($timeDiff > 2880) {
							$timeDiff = floor(abs($timeDiff / 1440)) . " dagen geleden";
							echo "<span class='last'><i>".$timeDiff."</i></span>";
						}
						
					?> | <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>		
	   <?php
			/* translators: 1: date, 2: time */
			//printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
			?>
		</span>
    </span>
    

 

  
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
    }


/**
 * To display number of posts.
 *
 * @param $postID current post/page id
 *
 * @return string
 */
function subh_get_post_view( $postID ) {
 $count_key = 'post_views_count';
 $count     = get_post_meta( $postID, $count_key, true );
 if ( $count == '' ) {
 delete_post_meta( $postID, $count_key );
 add_post_meta( $postID, $count_key, '0' );
 
 return '0 View';
 }
 
 return $count . ' Views';
}
 
/**
 * To count number of views and store in database.
 *
 * @param $postID currently viewed post/page
 */
function subh_set_post_view( $postID ) {
 $count_key = 'post_views_count';
 $count     = (int) get_post_meta( $postID, $count_key, true );
 if ( $count < 1 ) {
 delete_post_meta( $postID, $count_key );
 add_post_meta( $postID, $count_key, '0' );
 } else {
 $count++;
 update_post_meta( $postID, $count_key, (string) $count );
 }
}
 
/**
 * Add a new column in the wp-admin posts list
 *
 * @param $defaults
 *
 * @return mixed
 */
function subh_posts_column_views( $defaults ) {
 $defaults['post_views'] = __( 'Views' );
 
 return $defaults;
}
 
/**
 * Display the number of views for each posts
 *
 * @param $column_name
 * @param $id
 *
 * @return void simply echo out the number of views
 */
function subh_posts_custom_column_views( $column_name, $id ) {
 if ( $column_name === 'post_views' ) {
 echo subh_get_post_view( get_the_ID() );
 }
}
 
add_filter( 'manage_posts_columns', 'subh_posts_column_views' );
add_action( 'manage_posts_custom_column', 'subh_posts_custom_column_views', 5, 2 );

// thumb option start here 
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 255, 55, true );

add_image_size('custom-thumb', 328, 128, true);
add_image_size('custom-banner', 897, 340, true);
add_image_size('custom-readalso', 396, 157, true);
add_image_size('training-img', 137, 95, true);
add_image_size('search-img', 137, 95, true);

// complete_version_removal
function complete_version_removal() {
	return '';
}
add_filter('the_generator', 'complete_version_removal');

// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// custom excerpt length
function custom_excerpt_length($length) {
	return 100;
}
add_filter('excerpt_length', 'custom_excerpt_length');


// custom excerpt ellipses for 2.9+
function custom_excerpt_more($more) {
	return ' ';
}
add_filter('excerpt_more', 'custom_excerpt_more');

/* custom excerpt ellipses for 2.8-
function custom_excerpt_more($excerpt) {
	return str_replace('[...]', '...', $excerpt);
}
add_filter('wp_trim_excerpt', 'custom_excerpt_more'); 
*/

function register_my_menus() {
	register_nav_menus(
		array(
			'primary' => __('Primary Navigation'),
			'secondry' => __('Footer Navigation'),
		)
	);
}
add_action( 'init', 'register_my_menus' );
// wp nav menu option end here

// projects custom post type
add_action('init', 'create_projects');
function create_projects() {
	$projects_args = array(
		'labels' => array(
			'name' => __( 'Projects' ),
			'singular_name' => __( 'Projects' ),
			'add_new' => __('Add Project'),
			'all_items' => __('All Projects'),
			'edit_item' => __('Edit Project'),
			'add_new_item' => __('Add New Project'),
		),
		'singular_label' => __('Projects'),
		'public' => true,
		'exclude_from_search' => 'true',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'class-projects'),
		'menu_icon' => 'dashicons-portfolio',
		'has_archive' => true,
		'supports' => array('title', 'excerpt', 'author', 'editor', 'thumbnail')
	);
	register_post_type('projects',$projects_args);
	flush_rewrite_rules();
}


/* exclude the pages for search result */

function SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

add_filter('pre_get_posts','SearchFilter');
