<?php
/**
 * SimpleMag functions and definitions
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/

/* Content Width */
if ( ! isset( $content_width ) ) $content_width = 690; /* pixels */


/* Theme Options */
require_once ( 'admin/index.php' );


/* Google Fonts */
include_once( 'inc/google-fonts.php' ); // Load Fonts from Google


/* Custom Fields */
include_once( 'admin/acf/acf.php' );
include_once( 'admin/acf/acf-fields.php' );


/* Register Menus  */
register_nav_menus( array(
	'main_menu' => __( 'Main Menu', 'themetext' ), // Main site menu
	'secondary_menu' => __( 'Secondary Menu', 'themetext' ) // Main site menu
));



/* Images */
add_theme_support( 'post-thumbnails' );
add_image_size( 'medium-size', 600, 400, true );
add_image_size( 'menu-size', 296, 197, true );
add_image_size( 'masonry-size', 600, 9999 );
add_image_size( 'big-size', 1050, 700, true );
add_image_size( 'gallery-carousel', 9999, 580 );
add_image_size( 'gallery-vendor', 150, 150 );




/* Includes */
global $ti_option;
if ( $ti_option['single_wp_gallery'] == 1 ) {
include_once( 'inc/wp-gallery.php' );
}
include_once( 'inc/user-fields.php' );
include_once( 'inc/mega-menu.php' );
include_once( 'inc/comment-template.php' );
include_once( 'inc/styling-options.php' );



/* Widgets */
include_once( 'widgets/ti-video.php' );
include_once( 'widgets/ti-authors.php' );
include_once( 'widgets/ti-about-site.php' );
include_once( 'widgets/ti-latest-posts.php' );
include_once( 'widgets/ti-code-banner.php' );
include_once( 'widgets/ti-image-banner.php' );
include_once( 'widgets/ti-latest-reviews.php' );
include_once( 'widgets/ti-featured-posts.php' );
include_once( 'widgets/ti-most-commented.php' );
include_once( 'widgets/ti-latest-comments.php' );



/* Register jQuery Scripts and CSS Styles */
include_once( 'inc/register-scripts.php' );


/* Pagination */
include_once( 'inc/pagination.php' );



/* Enable post and comment RSS feed links */
add_theme_support( 'automatic-feed-links' );



/*  Post Formats */
add_theme_support( 'post-formats', 
		array( 
			'video',
			'gallery',
			'audio'
		) 
);


// A callback function to add a custom field to our "vvcategories" taxonomy
/* function vvcategories_taxonomy_custom_fields($tag) { 
   // Check for existing taxonomy meta for the term you're editing
    $t_id = $tag->term_id; // Get the ID of the term you're editing
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
?>

<tr class="form-field">
	<th scope="row" valign="top"> 
		<label for="vvcategories_id"><?php _e('Text your Blog Category Slug Here of Post'); ?></label> 
	</th>
	<td>
		<input type="text" name="term_meta[vvcategories_id]" id="term_meta[vvcategories_id]" size="25" style="width:60%;" value="<?php echo $term_meta['vvcategories_id'] ? $term_meta['vvcategories_id'] : ''; ?>"><br />
		<span style="font-size:15px; line-height:30px; font-weight:bold;" class="description"><?php _e('The vvcategories\'s WordPress User ID . ask-the-experts , bridal-shower , bridal-shows , bridesmaids , cakes-and-sweets , caterering , catering-2 , celebrity-weddings-2 , chatty-brides , date-ideas-2 , decor , destination-weddings , diy , engagements , event-rentals , expert-advice , family-beginnings , fashion-and-accessories , flowers , food-and-beverage , gifts-and-favors , giveaways , glbt-weddings , grooms-and-guys , hair-beauty , holiday , home-making , honeymoon-2 , indian-weddings , inspiration-2 , jackie-o , jewelers , jfk ,  kids-corner , letter-from-the-editor , little-ones , magazine , music , new-england , new-england-style ,  news-and-events , photography , pop-culture-2 , real-weddings , reception-sites-boston-area , reception-sites-cape-cod-and-the-islands , reception-sites-connecticut , reception-sites-maine , reception-sites-massachusetts , reception-sites-new-hampshire , reception-sites-newport-area , reception-sites-providence-area , reception-sites-rhode-island , reception-sites-vermont , registry , south-coast , south-county-reception-sites , spas-retreats , styled-wedding-shoots , tabletop-designs , the-daily-snew , transportation , travel-2 , videopgrahy , advice , wedding-ceremony , entertainment , wedding-invitations-and-calligraphy , planning , wellness-exercise  '   ); ?></span> 
	</td>
</tr>

<?php
} */


// A callback function to save our extra taxonomy field(s)
function save_taxonomy_custom_fields( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_term_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ){
            if ( isset( $_POST['term_meta'][$key] ) ){
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        //save the option array
        update_option( "taxonomy_term_$t_id", $term_meta );
    }
}

// Add the fields to the "vvcategories" taxonomy, using our callback function
add_action( 'vvcategories_edit_form_fields', 'vvcategories_taxonomy_custom_fields', 10, 2 );

// Save the changes made on the "vvcategories" taxonomy, using our callback function
add_action( 'edited_vvcategories', 'save_taxonomy_custom_fields', 10, 2 );


/* Define sidebars */
if (function_exists('register_sidebars')) {
	
	// Sidebar for blog section of the site
	register_sidebar(
	   array(
		'name' => __( 'Magazine', 'themetext' ),
		'id' => 'sidebar-1',
		'description'   => __( 'Sidebar for categories and single posts', 'themetext' ),		   
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	   )
	);

	register_sidebar(
	   array(
		'name' => __( 'Pages', 'themetext' ),  
		'id' => 'sidebar-2',
		'description'   => __( 'Sidebar for static pages', 'themetext' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	   )
	);

	register_sidebar(
	   array(
		'name' => __( 'Footer Area One', 'themetext' ),  
		'id' => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	   )
	);
	
	register_sidebar(
	   array(
		'name' => __( 'Footer Area Two', 'themetext' ),
		'id' => 'sidebar-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	   )
	);
	
	register_sidebar(
	   array(
		'name' => __( 'Footer Area Three', 'themetext' ),  
		'id' => 'sidebar-5',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	   )
	);
}


/* Count the number of footer sidebars to enable dynamic classes for the footer */
function ti_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = ' col-1';
			break;
		case '2':
			$class = ' col-2';
			break;
		case '3':
			$class = ' col-3';
			break;
	}

	if ( $class )
		echo $class;
}


/* Add SoundCloud oEmbed */
function add_oembed_soundcloud(){
	wp_oembed_add_provider( 'http://soundcloud.com/*', 'http://soundcloud.com/oembed' );
}
add_action('init','add_oembed_soundcloud');



/* Simple Mag Gravatar */
function ti_gravatar ( $avatar_defaults ) {
	$new_avatar = get_template_directory() . '/images/ti-gravatar.png';
	$avatar_defaults[$new_avatar] = "SimpleMag";
	return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'ti_gravatar' );



/**
 * Excerpt length
 * Excerpt more
*/
// Excerpt Length
function ti_excerpt_length( $length ) {
	global $ti_option;
	return $ti_option['site_wide_excerpt_length'];
}
add_filter( 'excerpt_length', 'ti_excerpt_length' );


// Excerpt more
function ti_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'ti_excerpt_more' );




/**
 * Get The First Image From a Post
 */
function first_post_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	if( preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches ) ){
		$first_img = $matches[1][0];
		return $first_img;
	}
}


/*vendorsvenues post Type */
add_action( 'init', 'create_post_type_vendorsvenues' );
function create_post_type_vendorsvenues() { 

	register_post_type( 'vendorsvenues', 

		array(

			'labels' => array(

				'name' => __( 'Vendors and Venues' ),

				'singular_name' => __( 'Vendors and Venues' )

			),

			'public' => true,

			'has_archive' => true,

			'rewrite' => array( 'slug' => 'vendorsvenues', 'with_front' => false ),

			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			
			


		)


	);

	flush_rewrite_rules();

} 
/*taxonomy vendorsvenues*/
register_taxonomy('vvcategories',array (

  0 => 'vendorsvenues',

),array( 'hierarchical' => true, 'label' => 'vendors category','show_ui' => true,'query_var' => true, 'show_admin_column' => true, 'rewrite' => array('slug' => ''),'singular_label' => 'Category') );

/*taxonomy vendorsvenues finish*/


/**
 * Remove rel attribute from the category list
 */
function remove_category_list_rel( $output ) {
    return str_replace( 'rel="category tag"', '', $output );
}
add_filter( 'wp_list_categories', 'remove_category_list_rel' );
add_filter( 'the_category', 'remove_category_list_rel' );


/**
 * Theme localization
 */
load_theme_textdomain( 'themetext', get_template_directory() . '/languages' );
$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);

