<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
ob_start();
session_start();
$content_width = 450;

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_image_size( 'menu-image', 454, 347, true );
add_image_size( 'cam-thumb2', 300, 200, true );
add_image_size( 'cam-thumb3', 114, 74, true );
add_image_size( 'thumb4', 330, 210, true );

if ( function_exists('register_sidebar') ) {
	
register_sidebar(array(
   	'name'=>'Intro Sidebar',
	'id' => 'intro-sidebar',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h3 class="title">',
	'after_title' => '</h3>',
));

register_sidebar(array(
   	'name'=>'Footer Sidebar',
	'id' => 'footer-sidebar',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="title">',
	'after_title' => '</h3>',
));

register_sidebar(array(
   	'name'=>'Copyright Sidebar',
	'id' => 'copyright-sidebar',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="title">',
	'after_title' => '</h3>',
));
	
}

// wp nav menu option start here
function register_my_menus() {
	register_nav_menus(
		array(
			'mainnav' => __('Main Navigation'),
			'highlight' => __('Highlighted Navigation'),
		)
	);
}
add_action( 'init', 'register_my_menus' );
// wp nav menu option end here

// post type start here
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'menu',
		array(
			'labels' => array(
				'name' => __( 'Menu' ),
				'singular_name' => __( 'Menu' )
				
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array('title','editor','thumbnail','custom-fields'),

		)
	);	
	register_post_type( 'special',
		array(
			'labels' => array(
				'name' => __( 'Special' ),
				'singular_name' => __( 'Special' )
				
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array('title','editor','thumbnail','custom-fields'),

		)
	);	
	register_post_type( 'onlineorder',
		array(
			'labels' => array(
				'name' => __( 'Online Order' ),
				'singular_name' => __( 'Online Order' )
				
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array('title','thumbnail','custom-fields'),

		)
	);	
}
// post type end here

///------ our setyting--------------

///--- Soliloquy auto play   This code was pulled from plugin site. 


    add_action( 'tgmsp_callback_start', 'tgm_autoplay_youtube_videos' );
    add_action( 'tgmsp_callback_after', 'tgm_autoplay_youtube_videos' );
    function tgm_autoplay_youtube_videos( $id ) {
     
    $js = 'var $slide = $("#soliloquy-container-' . absint( $id ) . '").find(".soliloquy-active-slide");';
    $js .= 'if ( $slide.hasClass("soliloquy-video-slide") && "youtube" == $slide.find("iframe").attr("rel") ) {';
    // Play the video and pause the slider.
    $js .= 'var yt_player = soliloquy_youtube_players[$slide.find("iframe").attr("id")];';
    $js .= 'if ( typeof yt_player == "undefined" || false == yt_player ) {';
    $js .= 'return;'; // This is to prevent errors when the video hasn't yet initialized but the slider is already proceeding to it
    $js .= '} else {';
    $js .= 'if ( typeof yt_player.getPlayerState == "function" ){';
    $js .= 'yt_player.playVideo();';
    $js .= '}';
    $js .= '}';
    $js .= '}';
     
    echo $js;
     
    }

///---- end Soliloquy auto play.  This code was pulled from plugin site.

$themename = "Mr Chicken";

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



function cats_to_select()

{

	$categories = get_categories('hide_empty=0'); 

	$categories_array[] = array('value'=>'0', 'title'=>'Select');

	foreach ($categories as $cat) {

		if($cat->category_count == '0') {

			$posts_title = 'No posts!';

		} elseif($cat->category_count == '1') {

			$posts_title = '1 post';

		} else {

			$posts_title = $cat->category_count . ' posts';

		}

		$categories_array[] = array('value'=> $cat->cat_ID, 'title'=> $cat->cat_name . ' ( ' . $posts_title . ' )');

	  }

	return $categories_array;

} 



$options = array (

			

array(	"type" => "open"),

// Start Hotline Number Option
array(	"name" => "Catering Hotline Number",
"desc" => "Enter Catering Hotline Here",
"id" => $shortname."_hotline",
"std" => "",
"type" => "text"),
// End Hotline Number Option

// Start Online Order Email Option
array(	"name" => "Online Order Email",
"desc" => "Enter Online Order Email Here",
"id" => $shortname."_onlineorder",
"std" => "",
"type" => "text"),
// End Online Order Email Option

// Start Tagline Image Option
array(	"name" => "Tagline Image",
"desc" => "Enter Tagline Image Here",
"id" => $shortname."_tagline",
"std" => "",
"type" => "text"),
// End Tagline Image Option

// Start Banner Text Option
array(	"name" => "Banner Text",
"desc" => "Enter Banner Text Here",
"id" => $shortname."_bannertext",
"std" => "",
"type" => "textarea"),
// End Banner Text Option

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



<?php

}

mytheme_admin_init();



add_action('admin_menu', 'mytheme_add_admin');


	function wp_list_addon(){
	}

function kubrick_theme_page() {
	if ( isset( $_REQUEST['saved'] ) ) echo '<div id="message" class="updated"><p><strong>'.__('Options saved.').'</strong></p></div>';
?>
<div class='wrap'>
	<h2><?php _e('Customize Header'); ?></h2>
	<div id="kubrick-header">
		<div id="headwrap">
			<div id="header">
				<div id="headerimg">
					<h1><?php bloginfo('name'); ?></h1>
					<div class="description"><?php bloginfo('description'); ?></div>
				</div>
			</div>
		</div>
		<br />
		<div id="nonJsForm">
			<form method="post" action="">
				<?php wp_nonce_field('kubrick-header'); ?>
				<div class="zerosize"><input type="submit" name="defaultsubmit" value="<?php esc_attr_e('Save'); ?>" /></div>
					<label for="njfontcolor"><?php _e('Font Color:'); ?></label><input type="text" name="njfontcolor" id="njfontcolor" value="<?php echo esc_attr(kubrick_header_color()); ?>" /> <?php printf(__('Any CSS color (%s or %s or %s)'), '<code>red</code>', '<code>#FF0000</code>', '<code>rgb(255, 0, 0)</code>'); ?><br />
					<label for="njuppercolor"><?php _e('Upper Color:'); ?></label><input type="text" name="njuppercolor" id="njuppercolor" value="#<?php echo esc_attr(kubrick_upper_color()); ?>" /> <?php printf(__('HEX only (%s or %s)'), '<code>#FF0000</code>', '<code>#F00</code>'); ?><br />
				<label for="njlowercolor"><?php _e('Lower Color:'); ?></label><input type="text" name="njlowercolor" id="njlowercolor" value="#<?php echo esc_attr(kubrick_lower_color()); ?>" /> <?php printf(__('HEX only (%s or %s)'), '<code>#FF0000</code>', '<code>#F00</code>'); ?><br />
				<input type="hidden" name="hi" id="hi" value="<?php echo esc_attr(kubrick_header_image()); ?>" />
				<input type="submit" name="toggledisplay" id="toggledisplay" value="<?php esc_attr_e('Toggle Text'); ?>" />
				<input type="submit" name="defaults" value="<?php esc_attr_e('Use Defaults'); ?>" />
				<input type="submit" class="defbutton" name="submitform" value="&nbsp;&nbsp;<?php esc_attr_e('Save'); ?>&nbsp;&nbsp;" />
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="njform" value="true" />
			</form>
		</div>
		<div id="jsForm">
			<form style="display:inline;" method="post" name="hicolor" id="hicolor" action="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>">
				<?php wp_nonce_field('kubrick-header'); ?>
	<input type="button"  class="button-secondary" onclick="tgt=document.getElementById('fontcolor');colorSelect(tgt,'pick1');return false;" name="pick1" id="pick1" value="<?php esc_attr_e('Font Color'); ?>"></input>
		<input type="button" class="button-secondary" onclick="tgt=document.getElementById('uppercolor');colorSelect(tgt,'pick2');return false;" name="pick2" id="pick2" value="<?php esc_attr_e('Upper Color'); ?>"></input>
		<input type="button" class="button-secondary" onclick="tgt=document.getElementById('lowercolor');colorSelect(tgt,'pick3');return false;" name="pick3" id="pick3" value="<?php esc_attr_e('Lower Color'); ?>"></input>
				<input type="button" class="button-secondary" name="revert" value="<?php esc_attr_e('Revert'); ?>" onclick="kRevert()" />
				<input type="button" class="button-secondary" value="<?php esc_attr_e('Advanced'); ?>" onclick="toggleAdvanced()" />
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="fontdisplay" id="fontdisplay" value="<?php echo esc_attr(kubrick_header_display()); ?>" />
				<input type="hidden" name="fontcolor" id="fontcolor" value="<?php echo esc_attr(kubrick_header_color()); ?>" />
				<input type="hidden" name="uppercolor" id="uppercolor" value="<?php echo esc_attr(kubrick_upper_color()); ?>" />
				<input type="hidden" name="lowercolor" id="lowercolor" value="<?php echo esc_attr(kubrick_lower_color()); ?>" />
				<input type="hidden" name="headerimage" id="headerimage" value="<?php echo esc_attr(kubrick_header_image()); ?>" />
				<p class="submit"><input type="submit" name="submitform" class="button-primary" value="<?php esc_attr_e('Update Header'); ?>" onclick="cp.hidePopup('prettyplease')" /></p>
			</form>
			<div id="colorPickerDiv" style="z-index: 100;background:#eee;border:1px solid #ccc;position:absolute;visibility:hidden;"> </div>
			<div id="advanced">
				<form id="jsAdvanced" style="display:none;" action="">
					<?php wp_nonce_field('kubrick-header'); ?>
					<label for="advfontcolor"><?php _e('Font Color (CSS):'); ?> </label><input type="text" id="advfontcolor" onchange="advUpdate(this.value, 'fontcolor')" value="<?php echo esc_attr(kubrick_header_color()); ?>" /><br />
					<label for="advuppercolor"><?php _e('Upper Color (HEX):');?> </label><input type="text" id="advuppercolor" onchange="advUpdate(this.value, 'uppercolor')" value="#<?php echo esc_attr(kubrick_upper_color()); ?>" /><br />
					<label for="advlowercolor"><?php _e('Lower Color (HEX):'); ?> </label><input type="text" id="advlowercolor" onchange="advUpdate(this.value, 'lowercolor')" value="#<?php echo esc_attr(kubrick_lower_color()); ?>" /><br />
					<input type="button" class="button-secondary" name="default" value="<?php esc_attr_e('Select Default Colors'); ?>" onclick="kDefaults()" /><br />
					<input type="button" class="button-secondary" onclick="toggleDisplay();return false;" name="pick" id="pick" value="<?php esc_attr_e('Toggle Text Display'); ?>"></input><br />
				</form>
			</div>
		</div>
	</div>
</div>
<?php } ?><?php	update_option('sl_website_label','Store Page');?>