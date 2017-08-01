<?php
// Add sidebars
include('inc/sidebars.php');
// Add widgets
include('inc/widgets.php');
// Add cpts
include('inc/cpt.php');
// Page BUilder
include('page-builder/page-builder.php');

require_once("newsletterWidget.php");
// smart jquery inclusion
if (!is_admin()) {
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"), false, '1.8.2');
	wp_enqueue_script('jquery');
}

// theme options
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

// thumb option start here 
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 255, 55, true );
add_image_size('slider-img', 1280, 480, true);
add_image_size('journal-small', 94, 120, true);
add_image_size('journal-medium', 170, 216, true);
add_image_size('journal-big', 240, 305, true);
add_image_size('thumb-big', 290, 180, true);
add_image_size('small-img', 130, 200, true);
add_image_size('featured-img', 16, 16, false);

// wp nav menu option start here
function nav_menu_first_last( $items ) {
	$position = strrpos($items, 'class="menu-item', -1);
	$items=substr_replace($items, 'menu-item-last ', $position+7, 0);
	$position = strpos($items, 'class="menu-item');
	$items=substr_replace($items, 'menu-item-first ', $position+7, 0);
	return $items;
}
add_filter( 'wp_nav_menu_items', 'nav_menu_first_last' );

function register_my_menus() {
	register_nav_menus(
		array(
			'primary' => __('Primary Navigation'),
			'mobile' => __('Primary Mobile'),
			'footer' => __('Bottom Navigation'),
		)
	);
}
add_action( 'init', 'register_my_menus' );
// wp nav menu option end here

// complete_version_removal
function complete_version_removal() {
	return '';
}
add_filter('the_generator', 'complete_version_removal');

// remove nofollow from comments
function xwp_dofollow($str) {
	$str = preg_replace(
		'~<a ([^>]*)\s*(["|\']{1}\w*)\s*nofollow([^>]*)>~U',
		'<a ${1}${2}${3}>', $str);
	return str_replace(array(' rel=""', " rel=''"), '', $str);
}
remove_filter('pre_comment_content',     'wp_rel_nofollow');
add_filter   ('get_comment_author_link', 'xwp_dofollow');
add_filter   ('post_comments_link',      'xwp_dofollow');
add_filter   ('comment_reply_link',      'xwp_dofollow');
add_filter   ('comment_text',            'xwp_dofollow');

// count words in posts
function word_count() {
	global $post;
	echo str_word_count($post->post_content);
}

// spam & delete links for all versions of wordpress
function delete_comment_link($id) {
	if (current_user_can('edit_post')) {
		echo '| <a href="'.get_bloginfo('wpurl').'/wp-admin/comment.php?action=cdc&c='.$id.'">del</a> ';
		echo '| <a href="'.get_bloginfo('wpurl').'/wp-admin/comment.php?action=cdc&dt=spam&c='.$id.'">spam</a>';
	}
}

// escape html entities in comments
function encode_code_in_comment($source) {
	$encoded = preg_replace_callback('/<code>(.*?)<\/code>/ims',
	create_function('$matches', '$matches[1] = preg_replace(array("/^[\r|\n]+/i", "/[\r|\n]+$/i"), "", $matches[1]); 
	return "<code>" . htmlentities($matches[1]) . "</"."code>";'), $source);
	if ($encoded)
		return $encoded;
	else
		return $source;
}
add_filter('pre_comment_content', 'encode_code_in_comment');

// enable threaded comments
function enable_threaded_comments(){
	if (!is_admin()) {
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
			wp_enqueue_script('comment-reply');
		}
}
add_action('get_header', 'enable_threaded_comments');


// add feed links to header
if (function_exists('automatic_feed_links')) {
	automatic_feed_links();
} else {
	return;
}


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

// category id in body and post class
function category_id_classes_new($classes) {
	global $post;
	foreach((get_the_category($post->ID)) as $category)
		$classes [] = 'cat-' . $category->cat_ID . '-id';
		return $classes;
}
add_filter('post_class', 'category_id_classes_new');
add_filter('body_class', 'category_id_classes_new');

// start gallery tag 
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'gallery_shortcode_custom');

function gallery_shortcode_custom($attr)
{ 
	
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'dl';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'dd';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'dt';

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>.entry .gallery-data { display: none;}</style>
		<!-- see gallery_shortcode() in wp-includes/media.php -->";
		
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery-data galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	//$i = 0;
	//echo "<pre>";print_r($attachments);
	
	 foreach ( $attachments as $id => $attachment ) {
		$tid=count($attachments);
		//echo "Hello " .$id . " perma " . get_permalink($id);
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
		$output .= "<a class='button' href='".get_permalink($id)."'>BILDER</a>";
		break;
	}
	
	session_start();
	$_SESSION['pg_no'] = $tid;
	
	$output .= "</div>\n";

	return $output;
}
// end gallery tag

// start class on more load article
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="button"';
}
// end class on more load article


// comments pagination
 function wp_comments_corenavi() {
   $pages = '';
   $max = get_comment_pages_count();
   $page = get_query_var('cpage');
   if (!$page) $page = 1;
   $a['current'] = $page;
   $a['echo'] = false;

   $total = 0; //1 - display the text "Page N of N", 0 - not display
   $a['mid_size'] = 3; //how many links to show on the left and right of the current
   $a['end_size'] = 1; //how many links to show in the beginning and end
   $a['prev_text'] = '&laquo; Previous'; //text of the "Previous page" link
   $a['next_text'] = 'Next &raquo;'; //text of the "Next page" link
   $a['prev_next'] = false;
   

   if ($max > 1) echo '<div class="pagination">';
   if ($total == 1 && $max > 1) $pages = '<span class="pages">Page ' . $page . ' of ' . $max . '</span>'."\r\n";
   echo $pages . paginate_comments_links($a);
   if ($max > 1) echo '</div>';
}
// end comment pagination

// custom comments list
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php printf(__('<cite class="fn">%s</cite> '), get_comment_author_link()) ?> <?php printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?> <?php edit_comment_link(__('(Edit)'),'  ','' ); ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; }

function getPostsById($id)
{
	global $wpdb;
	$query= "SELECT * FROM ".$wpdb->prefix."posts where post_parent=$id AND post_type='attachment'";
	$posts = $wpdb->get_results($query);
	return $posts;
	} ?>