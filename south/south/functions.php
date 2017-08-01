<?php 

/** * Proper way to enqueue scripts and styles */
function themename_scripts() {
	if (!is_admin()) {
		wp_enqueue_style( 'style-themename', get_stylesheet_uri() );
		
						
		wp_enqueue_script('jquery');
		
		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array(), '1.0.0', true );
		wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js', array(), '1.0.0', true );
		wp_enqueue_script( 'fancybox button', get_template_directory_uri() . '/js/jquery.fancybox-buttons.js', array(), '1.0.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'themename_scripts' );

add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
return '<a class="more-link" href="' . get_permalink() . '">See More</a>';
}


// side bar option start here
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Default Sidebar',
		'id' => 'default_sidebar',
		'description' => 'This area page Default sidebar',	
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Home Sidebar',
		'id' => 'home_sidebar',
		'description' => 'This area Home below slider',	
		'before_widget' => '<div id="%1$s" class="home_box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Home Sidebar Rental',
		'id' => 'home_rental',
		'description' => 'This area Home Rental',	
		'before_widget' => '<div id="%1$s" class="image %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	));
	
	register_sidebar(array(
		'name' => 'Home Sidebar Service',
		'id' => 'home_service',
		'description' => 'This area Service Rental',	
		'before_widget' => '<div id="%1$s" class="image %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	));
	
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'id' => 'blog_sidebar',
		'description' => 'This area Blog Sidebar',	
		'before_widget' => '<span class="icon"></span><div id="%1$s" class="image %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	));
	
	register_sidebar(array(
		'name' => 'Calender Sidebar',
		'id' => 'calender_sidebar',
		'description' => 'This area Calender Sidebar',	
		'before_widget' => '<div id="%1$s" class="image %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	));
	
}
// side bar option end here
// side bar option end here
function my_post_type_rental() {
	register_post_type( 'rental',
                array( 
				'label' => __('Rental Boats'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => false,
				'menu_position' => 5,
				'supports' => array(
						'title','editor','thumbnail')
					) 
				);
	flush_rewrite_rules();
}
add_action('init', 'my_post_type_rental');

// side bar option end here
function my_post_type_customers() {
	register_post_type( 'customer',
                array( 
				'label' => __('Customers'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => false,
				'menu_position' => 5,
				'supports' => array(
						'title')
					) 
				);
	flush_rewrite_rules();	
}
add_action('init', 'my_post_type_customers');

// side bar option end here
function my_post_type_rentaluser() {
	register_post_type( 'renteluser',
                array( 
				'label' => __('Rental New User'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => false,
				'menu_position' => 5,
				'supports' => array(
						'title')
					) 
				);
	flush_rewrite_rules();	
}
add_action('init', 'my_post_type_rentaluser');
// thumb option start here 
add_theme_support('post-thumbnails');
//set_post_thumbnail_size( 1680, 485, true ); 

add_image_size('custom-thumb', 328, 128, true);
add_image_size('brand-cat-thumb', 380, 275, true);
add_image_size('blog-thumb', 805, 385, true);
add_image_size('event-thumb', 390, 307, true);
add_image_size('gallery-thumb', 590, 445, true);
add_image_size('small-thumb', 128, 124, true); 
add_image_size('feat-thumb', 1680, 485, true); 
add_image_size('team-thumb', 460, 570, true); 
add_image_size('big-thumb', 460, 670, true); 
add_image_size('rental-img', 360, 280, true); 

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
			'footer' => __('Footer Navigation'),
		)
	);
}
add_action( 'init', 'register_my_menus' );
// wp nav menu option end here




/* brand testimonial */
add_action( 'init', 'create_post_type_testimonial' );
function create_post_type_testimonial() {
	register_post_type( 'testimonial',
		array(
			'labels' => array(
				'name' => __( 'Testimonial' ),
				'singular_name' => __( 'Testimonial' )
			),

			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'testimonial', 'with_front' => false ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ,'excerpt' ),
		)
		
	);
	flush_rewrite_rules();
}

/* brand testimonial */
/* Our Team */
add_action( 'init', 'create_post_type_our_team' );
function create_post_type_our_team() {
	register_post_type( 'our_team',
		array(
			'labels' => array(
				'name' => __( 'Our Team' ),
				'singular_name' => __( 'Our Team' )
			),

			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'our_team', 'with_front' => false ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ,'excerpt' ),
		)
		
	);
	flush_rewrite_rules();
}

/* Our Team */

/* Photo Gallery */
add_action( 'init', 'create_post_type_photo_gallery' );
function create_post_type_photo_gallery() {
	register_post_type( 'photo_gallery',
		array(
			'labels' => array(
				'name' => __( 'Photo Gallery' ),
				'singular_name' => __( 'Photo Gallery' )
			),

			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'photo_gallery', 'with_front' => false ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ,'excerpt' ),
		)
		
	);
	flush_rewrite_rules();
}

/* Photo Gallery */

/* brand page Inventory Baots */

add_action( 'init', 'create_post_type_brandbrochure' );
function create_post_type_brandbrochure() {
	register_post_type( 'brandbrochure',
		array(
			'labels' => array(
				'name' => __( 'Lowe Boats Broshure' ),
				'singular_name' => __( 'Lowe Boats Broshure' )
			),

			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'brandbrochure', 'with_front' => false ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' , 'excerpt' ),
		)
		
	);
	flush_rewrite_rules();
}
function brandbrochure_taxonomy() {
   register_taxonomy(
	'brand_category', 
	'brandbrochure',  
	array(  
		'hierarchical' => true,
		'label' => 'Brand Boats Category',		
		'show_ui' => true,'query_var' => true,		
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'brand_category')
		)
	); 
}
add_action('init', 'brandbrochure_taxonomy');


/* brand page Inventory Baots */


/* brand Stratos Baots */

add_action( 'init', 'create_post_type_stratos' );
function create_post_type_stratos() {
	register_post_type( 'stratos',
		array(
			'labels' => array(
				'name' => __( 'Stratos Boats Broshure' ),
				'singular_name' => __( 'Stratos Boats Broshure' )
			),

			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'stratos', 'with_front' => false ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' , 'excerpt' ),
		)
		
	);
	flush_rewrite_rules();
}
function stratos_taxonomy() {
   register_taxonomy(
	'stratos_category', 
	'stratos',  
	array(  
		'hierarchical' => true,
		'label' => 'Stratos Boats Category',		
		'show_ui' => true,'query_var' => true,		
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'stratos_category')
		)
	); 
}
add_action('init', 'stratos_taxonomy');


/* brand Stratos Baots */

/* brand Sylvan Baots */

add_action( 'init', 'create_post_type_sylvan' );
function create_post_type_sylvan() {
	register_post_type( 'sylvan',
		array(
			'labels' => array(
				'name' => __( 'Sylvan Boats Broshure' ),
				'singular_name' => __( 'Sylvan Boats Broshure' )
			),

			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'sylvan', 'with_front' => false ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' , 'excerpt' ),
		)
		
	);
	flush_rewrite_rules();
}
function sylvan_taxonomy() {
   register_taxonomy(
	'sylvan_category', 
	'sylvan',  
	array(  
		'hierarchical' => true,
		'label' => 'Sylvan Boats Category',		
		'show_ui' => true,'query_var' => true,		
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'sylvan_category')
		)
	); 
}
add_action('init', 'sylvan_taxonomy');


/* brand Sylvan Baots */

/* brand Sunchaser Baots */

add_action( 'init', 'create_post_type_sunchaser' );
function create_post_type_sunchaser() {
	register_post_type( 'sunchaser',
		array(
			'labels' => array(
				'name' => __( 'Sunchaser Boats Broshure' ),
				'singular_name' => __( 'Sunchaser Boats Broshure' )
			),

			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'sunchaser', 'with_front' => false ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' , 'excerpt' ),
		)
		
	);
	flush_rewrite_rules();
}
function sunchaser_taxonomy() {
   register_taxonomy(
	'sunchaser_category', 
	'sunchaser',  
	array(  
		'hierarchical' => true,
		'label' => 'Sunchaser Boats Category',		
		'show_ui' => true,'query_var' => true,		
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'sunchaser_category')
		)
	); 
}
add_action('init', 'sunchaser_taxonomy');


/* brand Sunchaser Baots */

add_action( 'init', 'create_post_type_events' );
function create_post_type_events() {
	register_post_type( 'events',
		array(
			'labels' => array(
				'name' => __( 'Events' ),
				'singular_name' => __( 'Events' )
			),

			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'events', 'with_front' => false ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' , 'excerpt' ),
		)
		
	);
	flush_rewrite_rules();
}



//------ our setyting--------------

$themename = "South Marina";

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

	

		

	// Start Phone

	array(	"name" => "Phone",

	"desc" => "Type Phone Number here",

	"id" => $shortname."_phone",

	"std" => "#",

	"type" => "text"),

	// finish phone

	

	// Start Facebook

	array(	"name" => "Facebook",

	"desc" => "Type facebook link here",

	"id" => $shortname."_face",

	"std" => "#",

	"type" => "text"),

	// Start Facebook
	
	// Address Text

	array(	"name" => "Address",

	"desc" => "Enter Address Text here",

	"id" => $shortname."_add",

	"std" => "#",

	"type" => "textarea"),

	// Address Text
	
	// Copyright Text

	array(	"name" => "Copyright Text",

	"desc" => "Enter Copyright Text here",

	"id" => $shortname."_copy",

	"std" => "#",

	"type" => "textarea"),

	// Copyright Text
	
	
	

		 

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

/**
 * Testimonial Widget Class
 */
class testi_feed_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function testi_feed_widget() {
        parent::WP_Widget(false, $name = 'Testimonial  Widget');    
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {    
        extract( $args );
        $title         = apply_filters('widget_title', $instance['title']);
     
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; if($tweet=="") { $tweet=2; } ?>
    <div class="para flexslider2">
                      
                        	<ul class="slides">
							<?php query_posts( array('post_type'=> 'testimonial', 'order'=>'ASC') ); ?>
                            	<?php if (have_posts()) : $i=1; while (have_posts()) : the_post(); ?>
                            <li>
                        	<p><small class="top">“</small><span><?php  $content = get_the_content(); echo mb_strimwidth($content, 0, 10000, '...');?><small class="bottom">,,</small></span></p>
                           
                            </li>
                            <?php $i++; endwhile; endif; wp_reset_query(); ?>  
                            </ul>
                        </div>
                 <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {        
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
    
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {    
 
        $title         = esc_attr($instance['title']);
    
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
       

        <?php 
    }
 
 
} // end class twitter_feed_widget
add_action('widgets_init', create_function('', 'return register_widget("testi_feed_widget");'));
?>
<?php 
function spacification_spec(){
	
	$sp.='<ul class="spec">';

			// check if the repeater field has rows of data
			if( have_rows('spacifications') ):
			// loop through the rows of data
			while ( have_rows('spacifications') ) : the_row();
			$title=get_sub_field('title');	
			$value = get_sub_field('value');	
			
			
		$sp.='<li><strong>'.$title.'</strong>:'.$value.'</li>';
			
			
			 endwhile; else :  endif;
			wp_reset_query();  
	$sp.='</ul>';
	return $sp;


}
add_shortcode( 'spacification', 'spacification_spec' );

function stand_fea(){
	
	

			// check if the repeater field has rows of data
			if( have_rows('standard_features') ):
			// loop through the rows of data
			while ( have_rows('standard_features') ) : the_row();
			$title=get_sub_field('title');	
			$value = get_sub_field('content');	
			
			
		$sp1.='<h2>'.$title.'</h2>'.$value.'';
			
			
			 endwhile; else :  endif;
			wp_reset_query();  
	
	return $sp1;


}
add_shortcode( 'standard', 'stand_fea' );

function option_fea(){
	
	

			// check if the repeater field has rows of data
			if( have_rows('optional_features') ):
			// loop through the rows of data
			while ( have_rows('optional_features') ) : the_row();
			$title=get_sub_field('title');	
			$value = get_sub_field('content');	
			
			
		$sp3.='<h2>'.$title.'</h2>'.$value.'';
			
			
			 endwhile; else :  endif;
			wp_reset_query();  
	
	return $sp3;


}
add_shortcode( 'option', 'option_fea' );
	

