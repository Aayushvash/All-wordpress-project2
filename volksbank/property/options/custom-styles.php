<?php 

$themename = "property";
$shortname = "bo";
$options = array (
				  				  
array(
"name" => __('Individuelles CSS', 'bobox'),
"desc" => __('','bobox'),
"extra" => __('<span style="float:right; font-size:10px;"><a href="http://brings-online.com/demo/property/">Live Demo</a> | <a href="http://brings-online.com/kontakt/">Kontakt</a> - WordPress Theme von brings-online.com</span>', 'bobox'),
"type" => "topinfo"),

array(
"type" => "start",
),
array (
"type" => "panel",
),
array (
"type" => "boxdescription",
"desc" => 'Hier k&ouml;nnen Sie individuellen CSS Code eintragen. Die Eingaben werden in der custom-css.php gespeichert und überschreiben das Stylesheet des Themes.'
),
array(
"name" => 'CSS',
"id" => $shortname."_code",
"type" => "codearea",
),
array(
"type" => "submit"
),

array(
"type" => "closepanel"
),
array (
"type" => "closeform"
)
);

function mytheme_page_head() {
?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/functions.css" type="text/css" />  
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/js/codemirror/codemirror.css" type="text/css" /> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/codemirror/codemirror.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/codemirror/javascript/javascript.js"></script>
<?php
}

// ============= admin scripts and styles

function bop3_add_admin() {
	
	global $themename, $shortname, $options;
	foreach ($options as $value) {
		if(get_option($value['id'])=='' && isset($value['std'])){
			update_option( $value['id'], $value['std']);
		} 
	}

	if ( $_GET['page'] == basename(__FILE__) ) {

		if ( 'save' == $_REQUEST['action'] ) {

			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

				foreach ($options as $value) {
					if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

					header("Location: themes.php?page=custom-styles.php&saved=true");
					die;

		} else if( 'reset' == $_REQUEST['action'] ) {

			foreach ($options as $value) {
				delete_option( $value['id'] ); }

				header("Location: themes.php?page=custom-styles.php&reset=true");
				die;

		}
		
		add_action('admin_head', 'mytheme_page_head');
	}

	add_theme_page('Property', __('Individuelles CSS','bobox'), 'edit_themes', basename(__FILE__), 'bop3_admin');

}

function bop3_admin() {

global $themename, $shortname, $options;
if ( $_REQUEST['saved'] ) echo '<div id="optionmessage" class="updated fade" style="width:500px; padding:4px 10px; margin:15px 0 0 10px">Einstellungen wurden gespeichert.</div>';
	

?>

<div class="wrap">
<form method="post">

  <?php foreach ($options as $value) {
	switch ( $value['type'] ) {
	
	case "topinfo":
	?>
    <div class="topbox">
    <h2> <?php echo $value['name']; ?> <?php echo $value['extra']; ?></h2>
	  
    </div>
    <?php break; 
	case "start": ?> <div class="adminpanels"> <?php break;
	case "close": ?> </div> <?php break;
	case "panel": ?> <div class="panel">  <?php break;
	case "closepanel": ?> 	</div> <?php break;
	case "boxdescription" : ?> <h3><?php echo $value['desc']; ?></h3> <div class="showinfos"><?php echo $value['info']; ?></div><?php break;
	case "separator": ?> <hr /> <?php break;
	
	case 'codearea': ?>
	<label class="shortlabel" style="width:60px;"><?php echo $value['name']; ?> </label> 
 	<textarea class="code" cols="50" rows="6" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } ?></textarea>
     <script>
      var editor = CodeMirror.fromTextArea(document.getElementById("bo_code"), {
        lineNumbers: true,
        matchBrackets: true,
        continueComments: "Enter",
           });
    </script>
 	<?php break; 
		case "submit":
	?>
  <p class="submit">
<input name="save" type="submit" class="changebutton" value="Änderungen speichern" />
<input type="hidden" name="action" value="save" />
</p>
	<?php break; 	
	case "closeform":
	?>
    <div class="clear"> </div></form></div>
  <?php break;
	}
}
}

add_action('admin_menu', 'bop3_add_admin');

function getOption($option) {
	global $mytheme;
	return $mytheme->option[$option];
}

?>