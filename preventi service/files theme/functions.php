<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

if (function_exists('add_theme_support')) {
	add_theme_support('menus');
}
$content_width = 450;
add_theme_support('post-thumbnails');
add_image_size('testimonial', 118, 118, true);
add_image_size('blog-img1', 796, 381, true);
add_image_size('blog-img2', 363, 231, true);
add_image_size('blog-img3', 81, 72, true);
add_image_size('img4', 134, 142, true);
add_image_size('img5', 763, 279, true);
automatic_feed_links(); 

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Home Right widget',
		'id' => 'home_right_sidebar',
		'description' => 'This area for home Right sidebar',	
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
	'name' => 'Onze Klaten Right widget',
	'id' => 'onzeklaten_right_sidebar',
	'description' => 'This area for Onze Klaten Right sidebar',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="widgettitle">',
	'after_title' => '</h4>',
	));
	register_sidebar(array(
	'name' => 'Enquete Right widget',
	'id' => 'enquete_right_sidebar',
	'description' => 'This area for Enquete Right sidebar',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));
	register_sidebar(array(
	'name' => 'Blog Right widget',
	'id' => 'blog_right_sidebar',
	'description' => 'This area for Blog Right sidebar',	
	'before_widget' => '<div id="%1$s" class="category-block widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));
	register_sidebar(array(
	'name' => 'Blog Details Right widget',
	'id' => 'blog_details_right_sidebar',
	'description' => 'This area for Blog Details Right sidebar',	
	'before_widget' => '<div id="%1$s" class="category-block widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Newsletter widget',
		'id' => 'newsletter_sidebar',
		'description' => 'This area for Newsletter sidebar',	
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
	'name' => 'Footer widget 1',
	'id' => 'footer_sidebar1',
	'description' => 'This area for Footer sidebar1',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="widgettitle">',
	'after_title' => '</h4>',
	));
	register_sidebar(array(
	'name' => 'Footer widget 2',
	'id' => 'footer_sidebar2',
	'description' => 'This area for Footer sidebar2',	
	'before_widget' => '<div id="%1$s" class="widget one secund %2$s">',
	'after_widget' => '</div></div>',
	'before_title' => '<div class="list"><h4 class="widgettitle">',
	'after_title' => '</h4>',
	));
	register_sidebar(array(
	'name' => 'Footer widget 3',
	'id' => 'footer_sidebar3',
	'description' => 'This area for Footer sidebar3',	
	'before_widget' => '<div id="%1$s" class="widget one third %2$s">',
	'after_widget' => '</div></div>',
	'before_title' => '<div class="list"><h4 class="widgettitle">',
	'after_title' => '</h4>',
	));
	register_sidebar(array(
	'name' => 'Curcus Right Sidebar',
	'id' => 'curcus_right_sidebar',
	'description' => 'This area for Curcus Right Sidebar',	
	'before_widget' => '<div id="%1$s" class="widget resquest %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="widgettitle">',
	'after_title' => '</h4>',
	));

}

function register_my_menus() {
	register_nav_menus(
		array(
	'Topmenu' => __('Topmenu Navigation', 'twentyten'),
	'Mainmenu' => __('Mainmenu Navigation', 'twentyten'),
	'Footermenu' => __('Footermenu Navigation', 'twentyten'),
	'Mobilemenu' => __('Mobilemenu Navigation', 'twentyten'),
	'Onzeservices' => __('Onze services Navigation', 'twentyten'),
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

//------ our setyting--------------
$themename = "Preventie";
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
	
	// Start Top left
	array(	"name" => "Topleft Text",
	"desc" => "Enter Topleft Text here",
	"id" => $shortname."_topleft",
	"std" => "#",
	"type" => "textarea"),
	// End Start Top left
	
	// Start Nu inschrijven Text
	array(	"name" => "Nu inschrijven Text",
	"desc" => "Enter Nu inschrijven Text here",
	"id" => $shortname."_nuins",
	"std" => "#",
	"type" => "textarea"),
	// End Nu inschrijven Text
	
	
	// Start Phone Number
	array(	"name" => "Phone Number Text",
	"desc" => "Enter Phone Number Text here",
	"id" => $shortname."_phone",
	"std" => "#",
	"type" => "textarea"),
	// End Phone Number
	
	// Start Email Number
	array(	"name" => "Email Text",
	"desc" => "Enter Email Text here",
	"id" => $shortname."_email",
	"std" => "#",
	"type" => "textarea"),
	// End Phone Number
	
	// Start Fax Number
	array(	"name" => "Fax Number Text",
	"desc" => "Enter Phone Number Text here",
	"id" => $shortname."_fax",
	"std" => "#",
	"type" => "textarea"),
	// End Fax Number
	
	// Start copyright
	array(	"name" => "Copyright Text",
	"desc" => "Enter Copyright Text here",
	"id" => $shortname."_copyright",
	"std" => "#",
	"type" => "textarea"),
	// End copyright
	
	// Start Bottom text 1
	array(	"name" => "Bottom Text 1",
	"desc" => "Enter Bottom Text 1 here",
	"id" => $shortname."_bottom1",
	"std" => "#",
	"type" => "textarea"),
	// End Bottom text 1
	
	// Start Bottom logo Link
	array(	"name" => "Bottom logo Link",
	"desc" => "Enter Bottom logo Link here",
	"id" => $shortname."_bottomLink",
	"std" => "#",
	"type" => "text"),
	// End Bottom text 1
	
		
		 
	array(	"type" => "close")
	
);

function my_post_type_nuinschrijven() {
	register_post_type( 'nuinschrijven',
                array( 
				'label' => __('Nu inschrijven'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => false,
				'menu_position' => 5,
				'supports' => array(
						'title','thumbnail','excerpt')
					) 
				);
	flush_rewrite_rules();
}
add_action('init', 'my_post_type_nuinschrijven');

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_type_taxonomies_Type', 0 );

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_type_taxonomies_Tag', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_type_taxonomies_Type() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Tag', 'taxonomy general name' ),
		'singular_name'     => _x( 'Tag', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Tag' ),
		'all_items'         => __( 'All Tag' ),
		'parent_item'       => __( 'Parent Tag' ),
		'parent_item_colon' => __( 'Parent Tag:' ),
		'edit_item'         => __( 'Edit Tag' ),
		'update_item'       => __( 'Update Tag' ),
		'add_new_item'      => __( 'Add New Tag' ),
		'new_item_name'     => __( 'New Tag Name' ),
		'menu_name'         => __( 'Tag' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tag-slug' ),
	);

	register_taxonomy( 'tags', array( 'nuinschrijven' ), $args );

}

// create two taxonomies, genres and writers for the post type "book"
function create_type_taxonomies_Tag() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Type', 'taxonomy general name' ),
		'singular_name'     => _x( 'Type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Types' ),
		'all_items'         => __( 'All Type' ),
		'parent_item'       => __( 'Parent Type' ),
		'parent_item_colon' => __( 'Parent Type:' ),
		'edit_item'         => __( 'Edit Type' ),
		'update_item'       => __( 'Update Type' ),
		'add_new_item'      => __( 'Add New Type' ),
		'new_item_name'     => __( 'New Type Name' ),
		'menu_name'         => __( 'Type' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'type-slug' ),
	);

	register_taxonomy( 'type', array( 'nuinschrijven' ), $args );

}

function my_post_type_testimonial() {
	register_post_type( 'testimonial',
                array( 
				'label' => __('Testimonial'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => false,
				'menu_position' => 5,
				'supports' => array(
						'title','thumbnail','editor')
					) 
				);
	flush_rewrite_rules();
	
	
}
add_action('init', 'my_post_type_testimonial');

function my_post_type_klanten() {
	register_post_type( 'klanten',
                array( 
				'label' => __('Onze klanten'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => false,
				'menu_position' => 5,
				'supports' => array(
						'title','thumbnail')
					) 
				);
	flush_rewrite_rules();
	
	
}
add_action('init', 'my_post_type_klanten');


function my_post_type_Certificeringen() {
	register_post_type( 'certifi',
                array( 
				'label' => __('Certificeringen'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => false,
				'menu_position' => 5,
				'supports' => array(
						'title','thumbnail')
					) 
				);
	flush_rewrite_rules();
	
	
}
add_action('init', 'my_post_type_Certificeringen');

function my_search_form( $form ) {
	$form = '<div class="search-block"><form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	<input type="text" value="' . get_search_query() . '" name="s" placeholder="Nieuwsbericht zoeken..." id="s" />
	<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
	</form></div>';

	return $form;
}

add_filter( 'get_search_form', 'my_search_form' );

/**
 * Recent News Widget Class
 */
class News_feed_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function News_feed_widget() {
        parent::WP_Widget(false, $name = 'Recent News Widget');	
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
		 $showposts 		= apply_filters('widget_title', $instance['showposts']);
     
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title;  ?>
                         <?php
							   query_posts('post_type=post&showposts='.$showposts);
							    if (have_posts()) : while (have_posts()) : the_post(); ?> 
    <div class="recent-post">
    
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-img3'); ?></a>
    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    <span class="post-date"><?php the_time('d F Y') ?></span>
    
    </div>
    
    <?php endwhile; wp_reset_query(); endif; ?> 
    <a href="?page_id=11" class="view-all">&gt; Bekijk alle berichten</a> 
                 <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['showposts'] = strip_tags($new_instance['showposts']);
	
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
 
        $title 		= esc_attr($instance['title']);
		 $showposts 		= esc_attr($instance['showposts']);
    
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('showposts'); ?>"><?php _e('Showposts:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('showposts'); ?>" name="<?php echo $this->get_field_name('showposts'); ?>" type="text" value="<?php echo $showposts; ?>" />
        </p>
       

        <?php 
    }
 
 
} // end class News_feed_widget
add_action('widgets_init', create_function('', 'return register_widget("News_feed_widget");'));

/**
 * Recent Social Widget Class
 */
class Social_feed_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function Social_feed_widget() {
        parent::WP_Widget(false, $name = 'Social Widget');	
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
		 $facebook 		= apply_filters('widget_title', $instance['facebook']);
		 $twitter 		= apply_filters('widget_title', $instance['twitter']);
		 $gplus 		= apply_filters('widget_title', $instance['gplus']);
     
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title;  ?>
					<div class="social">

						<ul>
							<?php if($facebook){ ?>
							<li><a href="<?php echo $facebook; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/facebook@2x.png" width="7" height="11" alt=""/></a></li>
							<?php } ?>
							<?php if($twitter){ ?>
							<li><a href="<?php echo $twitter; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/twitter@2x.png" width="12" height="11" alt=""/></a></li>
							<?php } ?>
							<?php if($gplus){ ?>
							<li><a href="<?php echo $gplus; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/google-plus@2x.png" width="13" height="13" alt=""/></a></li>
							<?php } ?>
						</ul>

					</div>
                 <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['gplus'] = strip_tags($new_instance['gplus']);
	
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
 
		$title 		= esc_attr($instance['title']);
		$facebook 		= esc_attr($instance['facebook']);
		$twitter 		= esc_attr($instance['twitter']);
		$gplus 		= esc_attr($instance['gplus']);
    
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook Link:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter Link:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('gplus'); ?>"><?php _e('Gplus Link:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('gplus'); ?>" name="<?php echo $this->get_field_name('gplus'); ?>" type="text" value="<?php echo $gplus; ?>" />
        </p>
       

        <?php 
    }
 
 
} // end class Social_feed_widget
add_action('widgets_init', create_function('', 'return register_widget("Social_feed_widget");'));



/**
 * Custom tags Widget Class
 */
class Custom_tags_feed_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function Custom_tags_feed_widget() {
        parent::WP_Widget(false, $name = 'Top Tags Widget');	
    }
 
	/** @see WP_Widget::widget -- do not rename this */
	function widget($args, $instance) {	
	extract( $args );
	$title 		= apply_filters('widget_title', $instance['title']);


	?>
	<?php echo $before_widget; ?>
	<?php if ( $title )
	echo $before_title . $title . $after_title;  ?>
<?php $tags = get_tags();
$html = '<div class="toptag-block"><ul>';
foreach ( $tags as $tag ) {
	$tag_link = get_tag_link( $tag->term_id );
			
	$html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
	$html .= "{$tag->name}</a></li>";
}
$html .= '</ul></div>'; 
echo $html; ?>
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
 
        $title 		= esc_attr($instance['title']);
		 $showposts 		= esc_attr($instance['showposts']);
    
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

       

        <?php 
    }
 
 
} // end class Custom_tags_feed_widget
add_action('widgets_init', create_function('', 'return register_widget("Custom_tags_feed_widget");'));

/**
 * Recent Certificeringen  Widget Class
 */
class Certificeringen_feed_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function Certificeringen_feed_widget() {
        parent::WP_Widget(false, $name = 'Onze Certificeringen  Widget');	
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
		 $showposts 		= apply_filters('widget_title', $instance['showposts']);
     
        ?>
              <?php echo $before_widget; ?>
			  <img src="<?php bloginfo('template_url'); ?>/images/register-img2@2x.png" alt="" width="37" height="46" />
                  <?php if ( $title )
                        echo $before_title . $title . $after_title;  ?>
				<div class="certificates">
					<ul>
					<?php
					query_posts('post_type=certifi&showposts='.$showposts);
					if (have_posts()) : while (have_posts()) : the_post(); ?> 
						<?php if(get_field('add_link')){ ?>
						<li><a href="<?php echo get_field('add_link'); ?>"><?php the_post_thumbnail(); ?></a></li>
						<?php }else{ ?>
						<li><?php the_post_thumbnail(); ?></li>
						<?php }?>
					<?php endwhile; wp_reset_query(); endif; ?> 
					</ul>
				</div>
                 <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['showposts'] = strip_tags($new_instance['showposts']);
	
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
 
        $title 		= esc_attr($instance['title']);
		 $showposts 		= esc_attr($instance['showposts']);
    
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('showposts'); ?>"><?php _e('Showposts:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('showposts'); ?>" name="<?php echo $this->get_field_name('showposts'); ?>" type="text" value="<?php echo $showposts; ?>" />
        </p>
       

        <?php 
    }
 
 
} // end class Certificeringen _feed_widget
add_action('widgets_init', create_function('', 'return register_widget("Certificeringen_feed_widget");'));

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
?>