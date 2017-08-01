<?php 

// ========================= google map
		
function show_google_map(){
	
	$data = get_option('bo_options');
		$map = isset( $data['map']['bo_google_map'] ) ? $data['map']['bo_google_map'] : null; 
		extract((array)$map);
		 ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=true&amp;language=de"></script>
<script type="text/javascript">
var lng = '<?php echo $longitude;?>';
var lat = '<?php echo $latitude;?>';
var zoom = <?php echo $zoom; ?>;

function initialize() {
  var myLatlng = new google.maps.LatLng(lat, lng)
  var mapOptions = {
    zoom: zoom,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php return '<div id="map-canvas" style="width:'. $width .'px; height:'. $height .'px;"> </div>';	
	
}
add_shortcode('google-map', 'show_google_map');


// ========================= icons


function icon_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'size' => '24px',
		'name' => '',
			), $atts ) );
return '<i class="' . esc_attr($name) . '" style="font-size:'. esc_attr($size) .'; color:'. AdminPageFramework::getOption( 'bo_options', array( 'colors3', 'bo_icon_color'), '#999999' ) .'"></i>' ;
}
add_shortcode( 'icon', 'icon_shortcode' );


// ============================= columns 


function row_shortcode( $atts, $content = null ) {
	return '<div class="columns">'. do_shortcode($content) .'<div class="clear"></div></div>' ;
}
add_shortcode( 'row', 'row_shortcode' );

function col_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'typ' => 'col1-1',
			), $atts ) );
return '<div class="' . esc_attr($typ) . '"><div class="inner">' .do_shortcode($content) . '</div></div>' ;
}
add_shortcode( 'col', 'col_shortcode' );


// =========================== unordered lists

function list_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'typ' => 'default',
			), $atts ) );
return '<ul class="' . esc_attr($typ) . '">' . $content . '</ul>' ;
}
add_shortcode( 'ul', 'list_shortcode' );


// =========================== blockquotes

function quote_shortcode( $atts, $content = null ) {
	return '<blockquote>' . $content . '</blockquote>' ;
}
add_shortcode( 'quote', 'quote_shortcode' );


// ============== shortcode accordion =====================


function accordion_shortcode( $atts, $content = null ) {
	return '<div class="toggle-box">'. do_shortcode($content) .'</div>' ;
}
add_shortcode( 'accordion', 'accordion_shortcode' );


function item_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => '',
			), $atts ) );

return '<div class="toggle-headline"><i class="icon-down-dir"></i><h2>' . esc_attr($title) . '</h2></div><div class="toggle-more">' .do_shortcode($content) . '</div>' ;
}

add_shortcode( 'item', 'item_shortcode' );

// ============== shortcode tabber =====================


function tabbox_shortcode( $atts, $content = null ) {
	return '<div class="tab-box">'. do_shortcode($content) .'</div>' ;
}
add_shortcode( 'tabbox', 'tabbox_shortcode' );

function tabarea_shortcode( $atts, $content = null ) {
	return '<ul class="tabber">'. do_shortcode($content) .'</ul>' ;
}
add_shortcode( 'tabarea', 'tabarea_shortcode' );


function tabitem_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => '',
		'id' => '',
			), $atts ) );

return '<li><a href="#tab' . esc_attr($id) . '">' . esc_attr($title) . '</a></li>' ;
}

add_shortcode( 'tab', 'tabitem_shortcode' );

function panelarea_shortcode( $atts, $content = null ) {
	return '<div class="panelarea">'. do_shortcode($content) .'</div>' ;
}
add_shortcode( 'panelarea', 'panelarea_shortcode' );

function tabpanel_shortcode( $atts, $content = null ) {
extract( shortcode_atts( array(
		'id' => '',
			), $atts ) );
	return '<div class="panel" id="tab' . esc_attr($id) . '">'. do_shortcode($content) .'</div>' ;
}
add_shortcode( 'panel', 'tabpanel_shortcode' );


// ============== shortcode social media icons =====================


function show_sm_icons(){
	ob_start();
	get_template_part('social-media');
        $shcvar = ob_get_clean();
	return $shcvar; 
	
     }

add_shortcode('social-media', 'show_sm_icons');



// ============== shortcode contentbox =====================


function show_box( $atts, $content = null ) {

$data = get_option('bo_options');
$ic = AdminPageFramework::getOption( 'bo_options', array( 'colors3', 'bo_icon_color'), '#999999' );


	extract( shortcode_atts( array(
		'title' => '',
		'icon' => '',
		'iconsize' => '',
		'buttontext' => '',
		'buttonlink' => '',
				), $atts ) );
$html = '<div class="boxcontent">';

			if($icon) {
				$html .= '<div class="info-icon"><i style="color:'. $ic .'; font-size:'.$iconsize .';" class="'.$icon.'"></i></div>';
			}
			if($title) {
				$html .= '<h3>'.$title.'</h3>';
			}

			
			$html .= '<div class="boxtext">'. do_shortcode($content).'</div>';
			if($buttontext) {
				$html .= '<a class="boxbutton" href="';
				$html .= $buttonlink;
				$html .= '">';
				$html .= $buttontext;
				$html .= '</a>';
			}
			
$html .= '</div>';

		
		return $html;
	}
add_shortcode('box', 'show_box');



// ========================== filter shortcode content

function the_content_filter($content) {
    $block = join("|",array("col","row","ul", "box", "accordion","item", "panel"));
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
return $rep;
}
add_filter("the_content", "the_content_filter");
?>