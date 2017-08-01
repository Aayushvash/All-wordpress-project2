<?php

/* WP Theme Property2
   brings-online.com
   
*/


require_once('includes/custom-fields.php');
require_once('options/options.php');
require_once('options/custom-styles.php');
require_once('options/shortcodes.php');
require_once('includes/plugin-activation.php');


   
// =========================== theme text domain   
   
load_theme_textdomain( 'bobox', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
		
		
// =========================== theme scripts/styles

function property_scripts() {
	
	
	wp_enqueue_style( 'themestyle', get_stylesheet_uri(), array(), '2.0.0', 'all' );
	wp_enqueue_style( 'fontello', get_template_directory_uri() . '/css/fontello.css', array(), '2.0.1', 'all' );
	wp_enqueue_style( 'animated', get_template_directory_uri() . '/css/animated.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'chosen', get_template_directory_uri() . '/css/chosen.css', array(), '2.0.1', 'all' );
	wp_enqueue_style( 'print', get_template_directory_uri() . '/print.css', array(), '2.0.0', 'print' );
	wp_enqueue_style( 'ptsans', 'https://fonts.googleapis.com/css?family=PT+Sans', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'quicksand', 'https://fonts.googleapis.com/css?family=Quicksand', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'customstyle', esc_url( home_url()) . '/?custom-content=css', array(), '2.0.0', 'all' );
	
if(is_single('property' || 'portfolio') || is_page_template('homepage.php') || is_page_template('homepage2.php') || is_page_template('homepage3.php') || is_page_template('homepage4.php')) {
	wp_enqueue_script('cyclemain',  get_template_directory_uri() . '/js/jquery.cycle2.min.js',  array(), '2.1.6', false );
	wp_enqueue_script('swipe',  get_template_directory_uri() . '/js/jquery.cycle2.swipe.min.js',  array(), '1.0.1', true );
	wp_enqueue_script('tile',  get_template_directory_uri() . '/js/jquery.cycle2.tile.js',  array(), '1.0.1', true );
	wp_enqueue_script('scrollVert',  get_template_directory_uri() . '/js/jquery.cycle2.scrollVert.js',  array(), '1.0.1', true );
	wp_enqueue_script('shuffle',  get_template_directory_uri() . '/js/jquery.cycle2.shuffle.js',  array(), '1.0.1', true );
	wp_enqueue_script('flip',  get_template_directory_uri() . '/js/jquery.cycle2.flip.js',  array(), '1.0.1', true );
	wp_enqueue_script('carousel',  get_template_directory_uri() . '/js/jquery.cycle2.carousel.js',  array(), '1.0.1', false );
	}
	
	wp_enqueue_script('scriptmin',  get_template_directory_uri() . '/js/script.js',  array(), '1.0.1', true );
	wp_enqueue_script('modern',  get_template_directory_uri() . '/js/modernizr.custom.js',  array(), '1.0.1', true );		   
}

add_action( 'wp_enqueue_scripts', 'property_scripts' );
		
		

// =========================== feed links 		

add_theme_support(automatic_feed_links());
function myfeed_request($qv) {
	if (isset($qv['feed']))
		$qv['post_type'] = get_post_types(array( 'public' => true ));
	return $qv;
}
add_filter('request', 'myfeed_request');


// =========================== support page excerpts - shortcodes 

add_post_type_support( 'page', 'excerpt' );
add_filter('widget_text', 'do_shortcode', 11);

// =========================== custom content 

add_action( 'parse_request', 'my_custom_wp_request' );
function my_custom_wp_request( $wp ) {
    if (
        !empty( $_GET['custom-content'] )
        && $_GET['custom-content'] == 'css'
    ) {
        header( 'Content-Type: text/css' );
        require dirname( __FILE__ ) . '/custom-css.php';
        exit;
    }
}



// ==================  add image sizes ========================

if( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	/* add_image_size( 'prop-box-thumb', 280, 180, true ); */
	add_image_size( 'prop-box-thumb', 1300, 800, true );
	add_image_size( 'prop-featured', 980, 380, true );
	/*add_image_size( 'prop-single-thumb', 600, 400, true );*/
	add_image_size( 'prop-single-thumb', 1300, 800, true );
	add_image_size( 'prop-single-small-thumb', 109, 57, true );
	add_image_size( 'prop-icon', 85, 65, true );
	add_image_size( 'news-thumb', 225, 150, true );
	add_image_size( 'big-thumb', 1300, 800, true );
	
	
	
}


// ================== register custom menus =====================

register_nav_menus( array(
		'main-menu' => __('Header Main-Menu', 'bobox'),
		'top-menu' => __('Top-Menu', 'bobox'),
		'footer-menu' => __('Footer-Menu', 'bobox'),
) );
	
	
	
// ================ shortcodes in text widgets =====================

	
add_filter('widget_text', 'do_shortcode', 11);



// ==================== dashboard widget =========================

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'Infos zum Property-Theme', 'custom_dashboard_help');
}

function custom_dashboard_help() {
echo '<img src="'. get_bloginfo('template_url') .'/screenshot.png" style="float:right; width:45%; height:auto;"/><ul><li><a href="'. get_bloginfo('url') .'/wp-admin/themes.php?page=theme_options">Individuelle Theme-Einstellungen</a></li><li>...................... ......................</li><li><a href="'. get_bloginfo('url') .'/wp-admin/edit.php?post_type=property">Immobilien verwalten</a></li><li><a href="'. get_bloginfo('url') .'/wp-admin/edit.php?post_type=services">Services verwalten</a></li><li>...................... ......................</li><li><a href="'. get_bloginfo('url') .'/wp-admin/nav-menus.php">Men&uuml;s einrichten</a></li><li><a href="'. get_bloginfo('url') .'/wp-admin/widgets.php">Widgets einrichten</a></li><li><a href="'. get_bloginfo('url') .'/wp-admin/options-reading.php">Startseite einstellen</a></li><li>...................... ......................</li><li><a target="blank" href="'. get_bloginfo('url') .'/wp-content/themes/property2/property-anleitung.html">Kurzanleitung zum Theme</a></li><li><a target="blank" href="https://brings-online.com/kontakt/">Kontakt mit brings-online</a></li></ul><div style="clear:both;"></div>';
}


// ================== register custom posts =====================
    
add_action('init', 'my_custom_init');
function my_custom_init() {

register_post_type('services', 
array('labels' => array(
'name' => __( 'Services','bobox'),
'singular_name' => __( 'Service','bobox' ),
'add_new' => __('Add New', 'bobox'), 
'add_new_item' => __('Add New Service','bobox'), 
'edit_item' => __('Edit Service','bobox'),
'new_item' => __('New Service','bobox'),
'view_item' => __('View Service','bobox'),
'search_items' => __('Search Service','bobox'),), 
'menu_icon' => 'dashicons-pressthis',
'public' => true, 
'hierarchical' => false,
'rewrite' => array("slug" => "service", 'with_front' => true),
'has_archive' => true,
'show_in_nav_menus' => true,
'_builtin' =>  false,
'supports' => array('title','editor','excerpt','custom-fields','page-attributes','thumbnail','revisions','author')

));

register_post_type('property', 
array('labels' => array(
'name' => __( 'Real Estates','bobox'),
'singular_name' => __( 'Property','bobox' ),
'add_new' => __('Add New', 'bobox'), 
'add_new_item' => __('Add New Property','bobox'), 
'edit_item' => __('Edit Property','bobox'),
'new_item' => __('New Property','bobox'),
'view_item' => __('View Property','bobox'),
'search_items' => __('Search Property','bobox'),), 
'menu_icon' => 'dashicons-admin-home',
'public' => true, 
'has_archive' => true,
'hierarchical' => false,
'rewrite' => array("slug" => "immobilie", 'with_front' => true),
'show_in_nav_menus' => true,
'_builtin' =>  false,
'supports' => array('title','editor','excerpt','custom-fields','page-attributes','thumbnail','revisions','author')
));

register_post_type('portfolio', 
array('labels' => array(
'name' => __( 'Portfolio','bobox'),
'singular_name' => __( 'Portfolio-Entry','bobox' ),
'add_new' => __('Add New', 'bobox'), 
'add_new_item' => __('Add new Portfolio','bobox'), 
'edit_item' => __('Edit Portfolio','bobox'),
'new_item' => __('New Portfolio','bobox'),
'view_item' => __('View Portfolio','bobox'),
'search_items' => __('Search Portfolio','bobox'),), 
'menu_icon' => 'dashicons-admin-home',
'public' => true, 
'has_archive' => true,
'hierarchical' => false,
'rewrite' => array("slug" => "referenz", 'with_front' => true),
'show_in_nav_menus' => true,
'_builtin' =>  false,
'supports' => array('title','editor','excerpt','custom-fields','thumbnail','revisions','author'),
));
}; 


// ===================== register taxonomies =====================

add_action( 'init', 'register_property_taxonomies', 0 );

function register_property_taxonomies() 
{
	
	$labels = array(
	'name' => __( 'Angebotstyp', 'bobox' ),
    'singular_name' => __( 'Angebotstyp', 'bobox' ),
    'search_items' =>  __( 'Angebotstyp suchen', 'bobox' ),
    'all_items' => __( 'Alle Angebotstypen', 'bobox' ),
    'parent_item' => __( 'Übergeordneter Angebotstyp', 'bobox' ),
    'parent_item_colon' => __( 'Übergeordnete Angebotstypen:', 'bobox' ),
    'edit_item' => __( 'Angebotstyp editieren' , 'bobox'), 
    'update_item' => __( 'Angebotstyp aktualisieren' , 'bobox'),
    'add_new_item' => __( 'Neuen Angebotstyp hinzufügen', 'bobox' ),
    'new_item_name' => __( 'Neuer Angebotstyp', 'bobox' ),
  ); 	


  register_taxonomy('offertype',array('property','portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
	'show_admin_column' => true, 
    'rewrite' => array( 'slug' => 'angebotstyp', 'with_front' => false ),
  ));
	
  $labels = array(
	'name' => __( 'Immobilientyp', 'bobox' ),
    'singular_name' => __( 'Immobilientyp', 'bobox' ),
    'search_items' =>  __( 'Immobilientyp suchen', 'bobox' ),
    'all_items' => __( 'Alle Immobilientypen', 'bobox' ),
    'parent_item' => __( 'Übergeordneter Immobilientyp', 'bobox' ),
    'parent_item_colon' => __( 'Übergeordnete Immobilientypen:', 'bobox' ),
    'edit_item' => __( 'Immobilientyp editieren' , 'bobox'), 
    'update_item' => __( 'Immobilientyp aktualisieren' , 'bobox'),
    'add_new_item' => __( 'Neuen Immobilientyp hinzufügen', 'bobox' ),
    'new_item_name' => __( 'Neuer Immobilientyp', 'bobox' ),
  ); 	


  register_taxonomy('proptype',array('property','portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
	'show_admin_column' => true, 
    'rewrite' => array( 'slug' => 'immobilientyp', 'with_front' => false ),
  ));
  
  $labels = array(
    'name' => __( 'Location', 'bobox' ),
    'singular_name' => __( 'Location', 'bobox' ),
    'search_items' =>  __( 'Search Locations', 'bobox' ),
    'all_items' => __( 'All Locations', 'bobox' ),
    'parent_item' => __( 'Parent Location', 'bobox' ),
    'parent_item_colon' => __( 'Parent Location:' ),
    'edit_item' => __( 'Edit Location', 'bobox' ), 
    'update_item' => __( 'Update Location', 'bobox' ),
    'add_new_item' => __( 'Add New Location', 'bobox' ),
    'new_item_name' => __( 'New Location', 'bobox' ),
  ); 	

  register_taxonomy('location',array('property','portfolio'), array(
    'name' => __( 'ort'),
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
	'show_admin_column' => true, 
    'rewrite' => array( 'slug' => 'standort' ),
  ));

  $labels = array(
    'name' => __( 'Zimmer', 'bobox' ),
    'singular_name' => __( 'Zimmerkategorie', 'bobox' ),
    'search_items' =>  __( 'Zimmerkategorie suchen', 'bobox' ),
    'all_items' => __( 'Alle Zimmerkategorie', 'bobox' ),
    'parent_item' => __( 'Haupt Zimmerkategorie', 'bobox' ),
    'parent_item_colon' => __( 'Haupt Zimmerkategorie:', 'bobox' ),
    'edit_item' => __( 'Zimmerkategorie editieren' , 'bobox'), 
    'update_item' => __( 'Zimmerkategorie aktualisieren', 'bobox' ),
    'add_new_item' => __( 'Neue Zimmerkategorie hinzufügen', 'bobox' ),
    'new_item_name' => __( 'Neue Zimmerkategorie', 'bobox' ),
  );
   	
    register_taxonomy('rooms',array('property','portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
	'show_admin_column' => true, 
    'rewrite' => array( 'slug' => 'zimmerkategorie' ),
  ));
   $labels = array(
    'name' => __( 'Größe', 'bobox' ),
    'singular_name' => __( 'Größenkategorie', 'bobox' ),
    'search_items' =>  __( 'Größenkategorie suchen', 'bobox' ),
    'all_items' => __( 'Alle Größenkategorien', 'bobox' ),
    'parent_item' => __( 'Haupt Größenkategorie', 'bobox' ),
    'parent_item_colon' => __( 'Haupt Größenkategorie:', 'bobox' ),
    'edit_item' => __( 'Größenkategorie editieren' , 'bobox'), 
    'update_item' => __( 'Größenkategorie aktualisieren', 'bobox' ),
    'add_new_item' => __( 'Neue Größenkategorie hinzufügen', 'bobox' ),
    'new_item_name' => __( 'Neue Größenkategorie', 'bobox' ),
  );
   	
    register_taxonomy('size',array('property','portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
	'show_admin_column' => true, 
    'rewrite' => array( 'slug' => 'flaeche' ),
  ));
  
      
  $labels = array(
    'name' => __( 'Tags', 'bobox' ),
    'singular_name' => __( 'Tag', 'bobox' ),
    'search_items' =>  __( 'Search Tags', 'bobox' ),
    'all_items' => __( 'All Tags', 'bobox' ),
    'parent_item' => __( 'Parent Tags', 'bobox' ),
    'parent_item_colon' => __( 'Parent Tags:', 'bobox' ),
    'edit_item' => __( 'Edit Tags' , 'bobox'), 
    'update_item' => __( 'Update Tags', 'bobox' ),
    'add_new_item' => __( 'Add New Tag', 'bobox' ),
    'new_item_name' => __( 'New Tag', 'bobox' ),
  );
   	
    register_taxonomy('keyword',array('property','portfolio'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
	'show_admin_column' => true, 
    'rewrite' => array( 'slug' => 'schlagwort' ),
  ));
  

}

add_action( 'init', 'register_service_taxonomies', 0 );

function register_service_taxonomies() 
{
	
	
	
  $labels = array(
	'name' => __( 'Service Kategorie', 'bobox' ),
    'singular_name' => __( 'Service Kategorie', 'bobox' ),
    'search_items' =>  __( 'Service Kategorie suchen', 'bobox' ),
    'all_items' => __( 'Alle Service Kategorien', 'bobox' ),
    'parent_item' => __( 'Übergeordnete Service Kategorie', 'bobox' ),
    'parent_item_colon' => __( 'Übergeordnete Service Kategorien:', 'bobox' ),
    'edit_item' => __( 'Service Kategorie editieren' , 'bobox'), 
    'update_item' => __( 'Service Kategorie aktualisieren' , 'bobox'),
    'add_new_item' => __( 'Neue Service Kategorie hinzufügen', 'bobox' ),
    'new_item_name' => __( 'Neue Service Kategorie', 'bobox' ),
  ); 	


  register_taxonomy('service-category',array('services'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
	'show_admin_column' => true, 
    'rewrite' => array( 'slug' => 'service-kategorie' ),
  ));
  
 
}



add_action('init', 'my_rewrite');
function my_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->add_permastruct('typename', 'typename/%year%/%postname%/', true, 1);
    add_rewrite_rule('typename/([0-9]{4})/(.+)/?$', 'index.php?typename=$matches[2]', 'top');
    $wp_rewrite->flush_rules(); // !!!
}



// ===================== register sidebars =======================

if ( function_exists('register_sidebar') ) {
	
	register_sidebar(array(
		'name' => __('Homepage Sidebar', 'bobox'),
		'description' => __('Diese Sidebar wird auf der Startseite angezeigt','bobox'),
		'before_widget' => '<div id="%1$s" class="sidebarbox %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="sidebartitle">',
		'after_title' => '</div>',
		
	));
		
	register_sidebar(array(
		'name' => __('Page Sidebar', 'bobox'),
		'description' => __('Diese Sidebar wird auf allen statischen Seiten angezeigt','bobox'),
		'before_widget' => '<div id="%1$s" class="sidebarbox %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="sidebartitle">',
		'after_title' => '</div>',
		
	));
	
	
		register_sidebar(array(
		'name' => __('Service Sidebar', 'bobox'),
		'description' => __('Diese Sidebar wird auf allen Service-Seiten angezeigt','bobox'),
		'before_widget' => '<div id="%1$s" class="sidebarbox %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="sidebartitle">',
		'after_title' => '</div>',
		
	));
		
	register_sidebar(array(
		'name' => __('Kontakt Sidebar', 'bobox'),
		'description' => __('Diese Sidebar wird auf der Kontaktseite angezeigt','bobox'),
		'before_widget' => '<div id="%1$s" class="sidebarbox %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="sidebartitle">',
		'after_title' => '</div>',
		
	));
	
		
	register_sidebar(array(
		'name' => __('Blog Sidebar', 'bobox'),
		'description' => __('Diese Sidebar wird auf allen Blog-Seiten angezeigt','bobox'),
		'before_widget' => '<div id="%1$s" class="sidebarbox %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="sidebartitle">',
		'after_title' => '</div>',
		
	));
	
	
	register_sidebar(array(
		'name' => 'Makler Logo',
		'id' => 'logo_slider',
		'description' => 'This area  Makler Logo sidebar',	
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'footer Logo',
		'id' => 'logo_footer',
		'description' => 'This area  footer Logo sidebar',	
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	
}




// ============= admin scripts and styles


function my_admin_scripts() {
    wp_enqueue_media();
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_register_script('myupload', WP_PLUGIN_URL.'/upload.js', array('jquery','media-new','thickbox'));
	wp_enqueue_script('myupload');
	}
	
		 
function my_admin_styles() {
	wp_enqueue_style('thickbox');
	}
	 
	if (isset($_GET['page']) && $_GET['page'] == 'functions.php') {
	add_action('admin_print_scripts', 'my_admin_scripts');
	add_action('admin_print_styles', 'my_admin_styles');
	}

function my_theme_scripts() {
    wp_enqueue_script('thickbox');
	}
	
		 
function my_theme_styles() {
	wp_enqueue_style('thickbox');
	}




// ===================   unregister some default WP Widgets =================== 

function unregister_default_wp_widgets() {

 	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_RSS');
	
}

add_action('widgets_init', 'unregister_default_wp_widgets', 1);




// ===================  list of recent properties

class Widget_Recent_Properties extends WP_Widget {

		function Widget_Recent_Properties() {
		$widget_ops = array('classname' => 'widget_recent_properties', 'description' => __( 'Eine Liste mit den neuesten Immobilien', 'bobox') );
		$this->WP_Widget('recent-properties', __('Neueste Immobilien', 'bobox'), $widget_ops);
		$this->alt_option_name = 'widget_recent_properties';
		}

	        function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		$r = new WP_Query(array('showposts' => $number, 'post_type' => 'property', 'nopaging' => 0, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'caller_get_posts' => 1));
		if ($r->have_posts()) :
?>

		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
              
		<ul class="recentposts">
        <?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a></li>
        <?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php	wp_reset_query();  
		endif;
}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		return $instance;
	}

	function form( $instance ) {
		$title = esc_attr($instance['title']);
		if ( !$number = (int) $instance['number'] )
		$number = 5;
?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of entries to show:'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e('(at most 15)'); ?></small></p>
<?php
	}
}
register_widget('Widget_Recent_Properties');






// ===================  slider with recent properties

class Widget_Slide_Properties extends WP_Widget {

		function Widget_Slide_Properties() {
		$widget_ops = array('classname' => 'widget_slide_properties', 'description' => __( 'Ein Slider mit den neuesten Immobilien', 'bobox') );
		$this->WP_Widget('slide-properties', __('Immobilien-Slider', 'bobox'), $widget_ops);
		$this->alt_option_name = 'widget_slide_properties';
		}

	        function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		$r = new WP_Query(array('showposts' => $number, 'post_type' => 'property', 'nopaging' => 0, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'caller_get_posts' => 1));
		if ($r->have_posts()) :
?>

		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
              <div class="slideprops-wrap">
		<div class="slideprops" 
    data-cycle-fx="scrollHorz"
    data-cycle-speed="500"
    data-cycle-timeout="3000"
    data-cycle-manual-fx="fadeOut"
    data-cycle-manual-speed="300"
    data-cycle-loader="wait"
    data-cycle-prev=".slide-prev"
	data-cycle-next=".slide-next"
    data-cycle-swipe="true"
    data-cycle-slides=">div">
    
        <?php  while ($r->have_posts()) : $r->the_post();  ?>
		<div><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"> <?php the_post_thumbnail('prop-box-thumb'); ?> <span><?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?></span> </a></div>
        <?php endwhile; ?>
		</div>
        <div class="slide-prev"><i class="icon-angle-double-left"></i></div>
<div class="slide-next"><i class="icon-angle-double-right"></i></div>
</div>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.cycle2.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.cycle2.swipe.min.js"></script>
        <script type="text/javascript">
jQuery( '.slideprops' ).cycle();
</script>
		<?php echo $after_widget; ?>
<?php	wp_reset_query();  
		endif;
}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		return $instance;
	}

	function form( $instance ) {
		$title = esc_attr($instance['title']);
		if ( !$number = (int) $instance['number'] )
		$number = 5;
?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of entries to show:'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e('(at most 15)'); ?></small></p>
<?php
	}
}
register_widget('Widget_Slide_Properties');







//===================   tag cloud with custom post taxonomy terms 

class Widget_Property_Tag_Cloud extends WP_Widget {

	function Widget_Property_Tag_Cloud() {
		$widget_ops = array( 'description' => __( 'Immobilien Schlagworte', 'bobox') );
		$this->WP_Widget('property_tag_cloud', __('Immobilien Schlagwort-Wolke', 'bobox'), $widget_ops);
	}
	
	
	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Tags', 'bobox') : $instance['title']);

			echo '<div class="tagcloudbox">';
		if ( $title )
			echo $before_title . $title . $after_title;
			
			echo '<div class="tags">'; 
	
	 wp_tag_cloud( array( 'taxonomy' => 'keyword', 'number' => 15, 'smallest' => 12, 'largest' => 22, 'order' => 'RAND', 'unit' => 'px' ) ); 
	
	echo '</div>'; 
	
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		return $instance;
	}

	function form( $instance ) {
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>
<?php
	}
}

register_widget('Widget_Property_Tag_Cloud');




// ======================   modified excerpt-more link ======================

$moretext = get_option('bo_more_text');

function custom_excerpt_more($more) {
	if(!empty($moretext)) { 
return ' <a class="more" href="'. get_permalink($post->ID) .'">'. $moretext .'</a>';
   } else { return ' <a class="more" href="'. get_permalink($post->ID) .'">Hier weiterlesen &raquo;</a>';}}
   
add_filter('excerpt_more', 'custom_excerpt_more');

 
// ====================== copyright data  ======================

function comicpress_copyright() {
global $wpdb;
$copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
$output = '';
if($copyright_dates) {
$copyright = "&copy; " . $copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= '-' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}


// ============================ easy google font controls 
   
   
 function prop_egf_default_controls( $options ) {

 unset( $options['tt_default_heading_4'] );
 unset( $options['tt_default_heading_5'] );
 unset( $options['tt_default_heading_6'] );
 
$options['theme_title'] = array(
        'name'        => 'theme_title',
        'title'       => __('Website Titel','bobox'),
        'properties'  => array( 'selector' => 'h1.logotitle, h1.logotitle a' )
    );
	$options['theme_slogan'] = array(
        'name'        => 'theme_slogan',
        'title'       => __('Slogans','bobox'),
        'properties'  => array( 'selector' => 'h2.slogan' )
    );
	

return $options;
}
add_filter( 'tt_font_get_option_parameters', 'prop_egf_default_controls' );





// ======================================

/* Convert hexdec color string to rgb(a) string */

function hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
          return $default; 

	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
}







 
 

// ================= echo meta tags

function bop_meta_title() {
global $wpdb, $post;

if(is_tax('location')) {
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); $tax = get_query_var('taxonomy'); 
echo $term->name; 
echo ': ';
echo bloginfo('name');
} //

if(is_tax('offertype')) {
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); $tax = get_query_var('taxonomy'); 
echo $term->name; 
echo ': ';
echo bloginfo('name');
} //

if(is_tax('proptype')) {
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); $tax = get_query_var('taxonomy'); 
echo $term->name; 
echo ': ';
echo bloginfo('name');
} //

if(is_tax('rooms')) {
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); $tax = get_query_var('taxonomy'); 
echo $term->name; 
echo ': ';
echo bloginfo('name');
} //

if(is_tax('keyword')) {
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); $tax = get_query_var('taxonomy'); 
echo $term->name; 
echo ': ';
echo bloginfo('name');
} //

if(is_home()) {
if(AdminPageFramework::getOption( 'bo_options', array( 'blog', 'bo_blog_headline'), '' )) {
echo AdminPageFramework::getOption( 'bo_options', array( 'blog', 'bo_blog_headline'), '' ); }
	else { 
echo bloginfo('name');
	}
} //

if(is_category()) {
	echo single_cat_title() ; 	
	echo ' - ';
	echo bloginfo('name');
} //

if(is_archive()) {
if( is_tag() ) {
	echo single_tag_title() ; 	
	echo ' - '; 
	echo bloginfo('name');
} }

if(is_single() || is_page()) {
	
if(get_post_meta($post->ID, '_boT_meta-title', true )) { 
echo get_post_meta($post->ID, '_boT_meta-title', true ); 
echo ' - ';
echo bloginfo('name');
}
elseif ( AdminPageFramework::getOption( 'bo_options', array( 'seo', 'bo_general_meta_title'), '' )) {  
echo AdminPageFramework::getOption( 'bo_options', array( 'seo', 'bo_general_meta_title'), '' ); 
echo ' - ';
the_title();
}
else {
the_title();
}}
}

function bop_meta_description() {
global $wpdb, $post;

if(get_post_meta($post->ID, '_boT_meta-description', true )) { 
echo get_post_meta($post->ID, '_boT_meta-description', true ); 
}
elseif (AdminPageFramework::getOption( 'bo_options', array( 'seo', 'bo_general_meta_description'), '' )) {  
echo AdminPageFramework::getOption( 'bo_options', array( 'seo', 'bo_general_meta_description'), '' ); 
}
else  {
the_title();
echo ' - ';
echo bloginfo('description');
}
}

function bop_meta_keywords() {
global $wpdb, $post;

if(get_post_meta($post->ID, '_boT_meta-keywords', true )) { 
echo get_post_meta($post->ID, '_boT_meta-keywords', true ); 
}
else { 
echo AdminPageFramework::getOption( 'bo_options', array( 'seo', 'bo_general_meta_keywords'), '' );
}
}



// comments

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='64',$default='<path_to_url>'); ?>

         <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', 'bobox') ?></em>
         <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>

      <?php comment_text() ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
      <div class="clear"></div>
     </div>


<?php
        }
		
		
function my_qmt_reset_url( $reset_url ) {
	
$data = get_option('bo_options'); 
$jumpurl = isset( $data['contact1']['bo_object_list_url'] ) ? $data['contact1']['bo_object_list_url'] : null;
		
    return $jumpurl;
}
add_filter( 'qmt_reset_url', 'my_qmt_reset_url' );



// =========== change tag title attribute to description

add_filter(
    'wp_tag_cloud', # filter name
    array ( 'Bo_Tag_Cloud_Filter', 'filter_cloud' ), # callback
    10, # priority
    2   # number of arguments
);

class Bo_Tag_Cloud_Filter
{
       protected static $taxonomy = 'post_tag';

    public static function filter_cloud( $tagcloud, $args )
    {
        self::$taxonomy = $args['taxonomy'];
        return preg_replace_callback(
            '~class=\'tag-link-(\d+)\' title=\'([^\']+)\'~m',
            array ( __CLASS__, 'preg_callback' ),
            $tagcloud
        );
    }

    protected static function preg_callback( $matches )
    {
        $term_id = $matches[1];
        $desc = term_description( $term_id, self::$taxonomy );
        $desc = wp_strip_all_tags( $desc, TRUE );
        $desc = esc_attr( $desc );

        return "class='tag-link-$term_id' title='$desc'";
    }
}



// =========================== immonex alias 

add_filter( 'immonex_oi2wp_supported_themes', 'mysite_add_theme_alias' );

function mysite_add_theme_alias( $supported_themes ) {
    $supported_themes['property']['alias'] = 'property2';

    return $supported_themes;
} 





// ================== enable gallery thickbox



wp_enqueue_script( 'thickbox' );
wp_enqueue_style( 'thickbox' );
add_action( 'wp_print_footer_scripts', 'enable_thickbox_for_gallery_shortcode' );
function enable_thickbox_for_gallery_shortcode() {
print <<<EOF
<script type="text/javascript">
/* <![CDATA[ */
jQuery( document ).ready( function( $ ) {
    tb_init( '.gallery-icon a' );
});
/* ]]> */
</script>
EOF;
}

add_filter( 'wp_get_attachment_link', 'add_rel_attribute_to_attachment_link', 1, 2 );
function add_rel_attribute_to_attachment_link( $anchor_tag, $image_id ) {
    $image = get_post( $image_id );
    $rel = '';
    if( isset( $image->post_parent ) ) {
        $rel = ' rel="attached-to-' . (int) $image->post_parent . '"';
    }
    if( !empty( $rel ) ) {
        $anchor_tag = str_replace( '<a', '<a' . $rel, $anchor_tag );
    }
    return $anchor_tag;
}


add_filter('gallery_style', create_function('$a', 'return "<div class=\'gallery\'>";'));


/**
 * inveris: Alias für Property-Theme ergänzen.
 */

add_filter( 'immonex_oi2wp_supported_themes', 'voba_add_theme_alias' );

function voba_add_theme_alias( $supported_themes ) {
	$supported_themes['property']['alias'] = 'pageworkers';

	return $supported_themes;
} // mysite_add_theme_alias






/**
 * Abschnittsüberschriften in der Haupt-Objektbeschreibung ergänzen.
 */

add_filter( 'immonex_oi2wp_add_post_data_element', 'mysite_add_property_descriptions_subheadings', 10, 3 );

function mysite_add_property_descriptions_subheadings( $value, $immobilie, $mapping ) {
    if ( ! trim( $value ) ) return $value;

    switch( $mapping['source'] ) {
        case 'freitexte->objektbeschreibung+' :
            $value = "<h3>Objektbeschreibung</h3>\n" . $value;
            break;
        case 'freitexte->lage+':
            $value = "<h3>Lage</h3>\n" . $value;
            break;
        case 'freitexte->ausstatt_beschr+' :
            $value = "<h3>Ausstattung</h3>\n" . $value;
            break;
        case 'freitexte->sonstige_angaben+' :
            $value = "<h3>Sonstiges</h3>\n" . $value;
            break;
    }

    return $value;
} // mysite_add_property_descriptions_subheadings

/**
 * Erlaubte HTML-Tags für Beitragsinhalte beim automatisierten Import ergänzen.
 */

add_filter( 'wp_kses_allowed_html', 'mysite_kses_add_allowed_html_tags', 10, 2 );

function mysite_kses_add_allowed_html_tags( $allowed_tags, $context ) {
    if ( 'post' === $context ) $allowed_tags = array_merge( $allowed_tags, array(
        'h2' => array(),
        'h3' => array()
    ) );

    return $allowed_tags;
} // mysite_kses_add_allowed_html_tags 








//------ our setyting--------------

$themename = "Thema";

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

	
	
	array(	"name" => "facebook",

	"desc" => "facebook link here",

	"id" => $shortname."_fb",

	"std" => "#",

	"type" => "text"),
	
		 

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

  </table>

  <br />

  <?php break;

		

		case "title":

		?>

  <table width="100%" border="0" style="padding:5px 10px;">

  <tr>

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

  </tr>

  <tr>

    <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2">&nbsp;</td>

  </tr>

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

  </tr>

  <tr>

    <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2">&nbsp;</td>

  </tr>

  <?php 

		break;

		

		case 'select':

		?>

  <tr>

    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>

    <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">

        <?php 

						foreach ($value['options'] as $option) { ?>

        <option value="<?php echo $option['value']; ?>" <?php if ( get_theme_settings( $value['id'] ) == $option['value']) { echo ' selected="selected"'; } ?>><?php echo $option['title']; ?></option>

        <?php } ?>

      </select></td>

  </tr>

  <tr>

    <td><small><?php echo $value['desc']; ?></small></td>

  </tr>

  <tr>

    <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2">&nbsp;</td>

  </tr>

  <?php

        break;

            

		case "checkbox":

		?>

  <tr>

    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>

    <td width="80%"><? if(get_theme_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>

      <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> /></td>

  </tr>

  <tr>

    <td><small><?php echo $value['desc']; ?></small></td>

  </tr>

  <tr>

    <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2">&nbsp;</td>

  </tr>

  <?php 		break;

//----------------------------------upload---------------------

			case 'upload':

		?>

  <tr>

    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>

    <td width="80%"><input type="file" name="<?php echo $option['title']; ?>"  id="<?php echo $value['id']; ?>"  /></td>

  </tr>

  <tr>

    <td><small><?php echo $value['desc']; ?></small></td>

  </tr>

  <tr>

    <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2">&nbsp;</td>

  </tr>

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
