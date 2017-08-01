<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

function themename_scripts() {

if (!is_admin()) {
	wp_deregister_script('jquery');
	//wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"), true, '1.8.2');
	wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"), true, '1.8.2');
	wp_enqueue_script('jquery');
}


}
add_action( 'wp_enqueue_scripts', 'themename_scripts' );

 
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
}
$content_width = 450;
add_theme_support('post-thumbnails');

automatic_feed_links(); 

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name'=>'Top Header Social Media widget',
		'id'=>'top-header-social-media-widget',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar(array(
		'name'=>'ShowRoom Text Widget area',
		'id'=>'show-room-text-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar(array(
		'name'=>'TRade Professionals Text Widget area',
		'id'=>'trade-professionals-text-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar(array(
		'name'=>'Footer Address',
		'id'=>'footer-address',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name'=>'Subscribe Newsletter Widget',
		'id'=>'subscribe-newsletter-widget',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	
	register_sidebar(array(
		'name'=>'Download Media Kit',
		'id'=>'download-media-kit',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar(array(
		'name'=>'Java Video Application Image Widget',
		'id'=>'java-video-application-image-widget',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar(array(
		'name'=>'Sidebar Page',
		'id'=>'sidebar-page',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name'=>'Home product Widget',
		'id'=>'home-product-page',
		'before_widget' => '<div id="%1$s" class="widget hproduct %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=>'Footer Address2',
		'id'=>'footer-address2',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name'=>'Blog Sidebar',
		'id'=>'blog-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=>'Blog Single Sidebar',
		'id'=>'blog-single-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=>'Product Left Sidebar',
		'id'=>'product-left-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=>'Product Right Sidebar',
		'id'=>'product-right-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=>'page Left Sidebar',
		'id'=>'page-left-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=>'Page Right Sidebar',
		'id'=>'page-right-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=>'Nantucket Sidebar',
		'id'=>'nantucket-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}

function register_my_menus() {
	register_nav_menus(
		array(
	'primary' => __('Primary Navigation', 'twentyten'),
	'footer' => __('Footer Navigation', 'twentyten'),
	'productmenu' => __('Product Left Navigation', 'twentyten'),
	)
	);
}
add_action( 'init', 'register_my_menus' );


//------ our setyting--------------
$themename = "Theme Name";
$shortname = str_replace(' ', '_', strtolower($themename));

function get_theme_option($option)
{
	global $shortname;
	return stripslashes(get_option($shortname . '_' . $option));
}

function get_theme_settings($option)
{
	return stripslashes(get_option($option));
}

$options = array (
			
	array(	"type" => "open"),
	
		// Start Phone Number
		array(	"name" => "Phone Number",
		"desc" => "Enter Phone Number here",
		"id" => $shortname."_phone",
		"std" => "#",
		"type" => "textarea"),
		// End Phone Number
		
		// Start copyright
		array(	"name" => "Copyright Text",
		"desc" => "Enter Copyright Text here",
		"id" => $shortname."_copyright",
		"std" => "#",
		"type" => "textarea"),
		// End copyright
		
		// Blog Image Url
		array(	"name" => "Blog Image Url",
		"desc" => "Enter Blog Image Url here",
		"id" => $shortname."_burl",
		"std" => "#",
		"type" => "textarea"),
		// Blog Image Url
		
		 
	array(	"type" => "close")
	
);

function mytheme_add_admin() {
    global $themename, $shortname, $options;
	
    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                echo '<meta http-equiv="refresh" content="0;url=themes.php?page=functions.php&saved=true">';
                die;

        } 
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}


function mytheme_admin_init() {

    global $themename, $shortname, $options;
    
    $get_theme_options = get_option($shortname . '_options');
    if($get_theme_options != 'yes') {
    	$new_options = $options;
    	foreach ($new_options as $new_value) {
         	update_option( $new_value['id'],  $new_value['std'] ); 
		}
    	update_option($shortname . '_options', 'yes');
    }
}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>
<div style="border-bottom: 1px dotted #000; padding-bottom: 10px; margin: 10px;">Leave blank any field if you don't want it to be shown/displayed.</div>
<form method="post">



<?php foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table width="100%" border="0" style=" padding:10px;">
		
        
        
		<?php break;
		
		case "close":
		?>
		
        </table><br />
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="padding:5px 10px;"><tr>
        	<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;

		case 'text':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:100%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo get_theme_settings( $value['id'] ); ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:100%; height:140px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php echo get_theme_settings( $value['id'] ); ?></textarea></td>
            
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%">
				<select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
					<?php 
						foreach ($value['options'] as $option) { ?>
						<option value="<?php echo $option['value']; ?>" <?php if ( get_theme_settings( $value['id'] ) == $option['value']) { echo ' selected="selected"'; } ?>><?php echo $option['title']; ?></option>
						<?php } ?>
				</select>
			</td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><? if(get_theme_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            
        <?php 		break;
//----------------------------------upload---------------------
			case 'upload':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%">
			<input type="file" name="<?php echo $option['title']; ?>"  id="<?php echo $value['id']; ?>"  />
		
			</td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
	
 
} 
}
?>

<!--</table>-->


<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>

<?php }
add_action('admin_menu', 'mytheme_add_admin');
add_image_size('some name', 284, 203, true);
add_image_size('some name1', 202, 136, true);
add_image_size('blog-img', 113, 86, true);
add_image_size('blog-img2', 330, 215, true);
add_image_size('blog-img3', 933, 496, true);
add_image_size('blog-img4', 315, 215, true);
add_image_size('blog-img5', 200, 170, true);

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'..<span><a href="'.get_permalink().'">Read More</a></span>';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

?>
<?php
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'Job',
		array(
			'labels' => array(
				'name' => __( 'Job' ),
				'singular_name' => __( 'Job' )
				
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array('title','editor'),

		)
	);
	/*register_post_type( 'Team',

		array(

			'labels' => array(

				'name' => __( 'Team' ),

				'singular_name' => __( 'Team' )

			),

			'public' => true,

			'has_archive' => true,

		'supports' => array('title','thumbnail','editor'),

		'taxonomies' => array('teamcategory'),

		)	

	);
*/	

}
function add_custom_taxonomies() {

	// Add new "Locations" taxonomy to Posts

	register_taxonomy('teamcategory', 'Team', array(

		// Hierarchical taxonomy (like categories)

		'hierarchical' => true,

		// This array of options controls the labels displayed in the WordPress Admin UI

		'labels' => array(

			'name' => _x( 'Team Category', 'taxonomy general name' ),

			'singular_name' => _x( 'Team Category', 'taxonomy singular name' ),

			'search_items' =>  __( 'Search Category' ),

			'all_items' => __( 'All Category' ),

			'parent_item' => __( 'Parent Category' ),

			'parent_item_colon' => __( 'Parent Category:' ),

			'edit_item' => __( 'Edit Category' ),

			'update_item' => __( 'Update Category' ),

			'add_new_item' => __( 'Add New Category' ),

			'new_item_name' => __( 'New Category Name' ),

			'menu_name' => __( 'Team Category' ),

		),

		// Control the slugs used for this taxonomy

		'rewrite' => array(

			'slug' => 'teamcategory', // This controls the base slug that will display before each term

			'with_front' => false, // Don't display the category base before "/locations/"

			'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/"

		),

	));

}

//add_action( 'init','add_custom_taxonomies', 0 );
add_image_size( 'homepage-thumb', 245, 170, true );

add_action('init', 'my_post_type_Skylight');
function my_post_type_Skylight() {
	
	
	$skylight_args = array(
		'labels' => array(
			'name' => __( 'Products' ),
			'singular_name' => __( 'Products' ),
			'add_new' => __('Add New Products'),
			'all_items' => __('View/Edits All Products'),
			'edit_item' => __('View/Edits All Products'),
			'add_new_item' => __('Add New Products'),
		),
		'singular_label' => __('Products'),
		'public' => true,
		'exclude_from_search' => 'true',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'class-products'),
		'menu_icon' => 'dashicons-portfolio',
		'has_archive' => true,
		'supports' => array('title', 'excerpt', 'author', 'editor', 'thumbnail')
	);
	register_post_type('skylight',$skylight_args);
	
	flush_rewrite_rules();
}

function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'your-text-domain' ) . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


?>