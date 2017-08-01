<?php 
//  ======================   custom fields ====================== 


if ( !class_exists('boTopFields') ) {  
class boTopFields {  
		 var $prefix = '_boT_';  
		 var $topFields = array(
		 
		 array(
		 "description"   => "Aktivieren Sie die Checkbox, wenn diese Immobilie auf der Startseite oben (Slider) angezeigt werden soll. (Templates: Startseite-1)", 
		 "type" 		 => "cfbox",
		 "scope"		=>  array("property"  ),  
		 "capability"    => "edit_posts" 
		 ),
		   array(  
         "name"          => "top-image-active",  
         "title"         => "Diese Immobilie auf der Startseite anzeigen:",  
         "type"          => "checkbox",  
	     "scope"		=>  array("property"  ),  
         "capability"    => "edit_posts",  
		 ),	
		 array(
		"name"          => "close",  
        "type"          => "closebox",  
		"scope"		=>  array("property"  ),  
        "capability"    => "edit_posts"
		),	 
		 array(
		 "description"   => "Laden Sie hier das Bild hoch, das im Slider angezeigt werden soll. (Template: Startseite-1). Das Bild sollte mindestens eine Breite von 980px haben.", 
		 "type" 		 => "cfbox",
		 "scope"		=>  array("property"  ),  
		 "capability"    => "edit_posts" 
		 ),
		array(  
        "name"          => "top-image",  
		"title"         => "Bild f&uuml;r die Startseite",  
        "type"          => "upload",  
        "scope"		=>  array("property"  ),  
		"capability"    => "edit_posts", 
		),	
		array(  
        "name"          => "top-shorttext",  
		"title"         => "Kurzbeschreibung einf&uuml;gen (optional)",  
        "type"          => "text",  
        "scope"		=>  array("property" ),  
		"capability"    => "edit_posts", 
		),	
    	array(
		"type"          => "help",
	    "scope"		=>  array("property"  ),  
		"capability"    => "edit_posts"
		),		 
		array(
		"name"          => "close",  
        "type"          => "closebox",  
		"scope"		=>  array("property"  ),  
        "capability"    => "edit_posts"
		)  );  
	  
	  
         function boTopFields() { $this->__construct(); }  
         function __construct() {  
             add_action( 'admin_menu', array( &$this, 'createTopFields' ) );  
             add_action( 'save_post', array( &$this, 'saveTopFields' ), 1, 2 );  
             // Comment this line out if you want to keep default custom fields meta box  
             add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );  
         }  
      
         function removeDefaultCustomFields( $type, $context, $post ) {  
             foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {  
                 
             }  
         }  
        
         function createTopFields() {  
             if ( function_exists( 'add_meta_box' ) ) {  
                 add_meta_box( 'top-fields', __('Darstellung auf der Startseite','bobox'), array( &$this, 'displayTopFields' ), 'property', 'normal', 'high' );  

             }  
         }  
         
        function displayTopFields() {  
             global $post;  
             ?>  
             <div class="form-wrap" style="margin:0; padding:0; ">  
                 <?php  
                 wp_nonce_field( 'top-fields', 'top-fields_wpnonce', false, true );  
                 foreach ( $this->topFields as $topField ) {  
                     $scope = $topField[ 'scope' ];  
                     $output = false;  
                     foreach ( $scope as $scopeItem ) {  
                         switch ( $scopeItem ) {  
						 
                     		 case "property": {  
                                if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="page-new.php" || $post->post_type=="property" )  
                                     $output = true;  
                                 break;  
                             } 
						                                
                         }  
                         if ( $output ) break;  
                     }  
                     if ( !current_user_can( $topField['capability'], $post->ID ) )  
                         $output = false;  
                     if ( $output ) { ?>  

<?php   switch ( $topField[ 'type' ] ) {  
							 							 
 case "checkbox": {  
	echo '<div style="margin:5px 0 15px 0;"><label for="' . $this->prefix . $topField[ 'name' ] .'" style="font-size:.8em; display:inline;">' . $topField['title'] . '</label>';  
	echo '<input type="checkbox" name="' . $this->prefix . $topField['name'] . '" id="' . $this->prefix . $topField['name'] . '" value="yes"';  
    if ( get_post_meta( $post->ID, $this->prefix . $topField['name'], true ) == "yes" )  
    echo ' checked="checked"';  
    echo ' /></div>';  
    break;  }
								
case "upload": {  
 	echo '<label style=" font-size:.8em; width:200px; display:inline-block; margin:4px 0;" for="' . $this->prefix . $topField[ 'name' ] .'">' . $topField[ 'title' ] . ':</label>';
	echo '<input class="custominput" style="width:350px; margin:4px 0; display:inline-block;" type="text" name="' . $this->prefix . $topField[ 'name' ] . '" id="' . $this->prefix . $topField[ 'name' ] . '" value="' . 
									htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $topField[ 'name' ], true ) ) . '" />';
									
	echo '<input type="button" style="margin:3px 0 0 7px;" name="' . $this->prefix . $topField[ 'name' ] . '" id="' . $this->prefix . $topField[ 'name' ] . '" class="customupload button-secondary" value="';
	echo 'Upload';
	echo '" /><br />';
    break; }  
										
case "help": {  ?><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/uploadpostimg.js"></script><?php
	break; }
								 
case "input": {  
    echo '<div class="">  ';
	echo '<label style="font-size:.8em; display:inline-block; margin:5px 0; width:200px;" for="' . $this->prefix . $topField[ 'name' ] .'">' . $topField[ 'title' ] . ':</label>';
	echo '<input style="width:360px; margin:3px 0; display:inline-block;" type="text" name="' . $this->prefix . $topField[ 'name' ] . '" id="' . $this->prefix . $topField[ 'name' ] . '" value="' . 
									htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $topField[ 'name' ], true ) ) . '" />';
	echo '</div>';
	break; }  
								 
case "text": {  
	echo '<label style="font-size:.8em; float:left; width:200px; display:inline-block; margin:4px 0;" for="' . $this->prefix . $topField[ 'name' ] .'">' . $topField[ 'title' ] . ':</label>';
	echo '<textarea style="width:400px; margin:4px 0;" name="' . $this->prefix . $topField[ 'name' ] . '" id="' . $this->prefix . $topField[ 'name' ] . '" >' . 
									htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $topField[ 'name' ], true ) ) . '</textarea>';
	if ( $topField[ 'description' ] ) echo '<p>' .  $topField[ 'description' ] . '</p>';
	break; }  														 
								
 								 
case "headline": {
	echo '<h2 style="margin:0; padding:0;">' . $topField['title'] . '</h2>';
	break; }				
case "separator": { ?><div style="margin:15px 0 ; border-bottom:1px solid #fff; background:#ccc; height:1px; display:block;"></div> <?php
	break; }  
							 
case "cfbox": { 
	echo '<div class="cfbox" style="padding:5px 0;">';
	echo '<h2 style="margin:0; padding:0;">' .  $topField[ 'title' ] . '</h2>';
	echo '<p style="margin:0 0 20px 0; padding:0;">' .  $topField[ 'description' ] . '</p>';
	break; }
							 
case "closebox": { echo '</div>';
	break; }						 
								 
	}  
     }  
      } ?>  

</div>

<?php  
         }  
		function saveTopFields( $post_id, $post ) {  
             if ( !wp_verify_nonce( $_POST[ 'top-fields_wpnonce' ], 'top-fields' ) )  
                 return;  
             if ( !current_user_can( 'edit_post', $post_id ) )  
                 return;  
             if ( $post->post_type != 'property')  
                 return;  
             foreach ( $this->topFields as $topField ) {  
                 if ( current_user_can( $topField['capability'], $post_id ) ) {  
                     if ( isset( $_POST[ $this->prefix . $topField['name'] ] ) && trim( $_POST[ $this->prefix . $topField['name'] ] ) ) {  
                         $value = $_POST[ $this->prefix . $topField['name'] ];  
                         // Auto-paragraphs for any WYSIWYG  
                         if ( $topField['type'] == "wysiwyg" ) $value = wpautop( $value );  
                         update_post_meta( $post_id, $this->prefix . $topField[ 'name' ], $value );  
                     } else {  
                         delete_post_meta( $post_id, $this->prefix . $topField[ 'name' ] );  
                     }  
                 }  
             }  
         }  
   
     } 
   
 } 
   
if ( class_exists('boTopFields') ) {  
     $boTopFields_var = new boTopFields();  
 }
 



// ===================== Custom fields property details ======================= 


if ( !class_exists('boPropFields') ) {  

class boPropFields {  
		 var $prefix = '_boP_';  
		 var $propFields = array(
		 
		 array(
		 "description"   => "Alle Angaben sind optional. Nicht ausgef&uuml;llte oder angeklickte Felder werden nicht angezeigt. Zus&auml;tzliche, individuelle Felder oder Haken k&ouml;nnen weiter unten eingerichtet werden.", 
		 "type" 		 => "cftable",
		 "capability"    => "edit_posts" 
		 ),
		array(  
                 "type"          => "tableseparator",  
				 "description"	 => 'Hier k&ouml;nnen Sie eine Objekt ID eintragen, die zur Kennung dieses Angebots genutzt wird.',
                 "capability"    => "edit_posts"  
				 	 ),	 
		 array(  
              	"name"          => "prop-id",  
               	"title"         => "Objektnummer (ID)",  
               	"type"          => "inputshort",  
               	"capability"    => "edit_posts"  
					 ),
					
		array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "type"          => "tableseparator",  
				 "description"	 => 'Angaben zu Zimmern und Gr&ouml;&szlig;e',
                 "capability"    => "edit_posts"  
				 	 ),	 
		array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
               "name"          => "prop-rooms",  
               "title"         => "Anzahl Zimmer",  
               "type"          => "inputshort",  
               "capability"    => "edit_posts"  
				 	 ),
		array(  
               "name"          => "prop-livrooms",  
               "title"         => "Anzahl Schlafzimmer",  
               "type"          => "inputshort",  
               "capability"    => "edit_posts"  
				 	 ),
		array(  
               "name"          => "prop-bathrooms",  
               "title"         => "Anzahl Badezimmer",  
               "type"          => "inputshort",  
               "capability"    => "edit_posts"  
				 	 ),
		array(  
               "name"          => "prop-basement-rooms",  
               "title"         => "Anzahl Kellerr&auml;ume",  
               "type"          => "inputshort",  
               "capability"    => "edit_posts"  
				 	 ),	 
		array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
				
		array(  
               "name"          => "prop-size",  
               "title"         => "Wohnfl&auml;che",  
                "type"          => "inputshort",  
               "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-size2",  
                 "title"         => "Gesamtfl&auml;che",  
                 "type"          => "inputshort",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-size3",  
                 "title"         => "Grundst&uuml;cksfl&auml;che",  
                 "type"          => "inputshort",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-size4",  
                 "title"         => "Nutzungsfl&auml;che",  
                 "type"          => "inputshort",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-size5",  
                 "title"         => "Verkaufsfl&auml;che",  
                 "type"          => "inputshort",  
                 "capability"    => "edit_posts"  
				 	 ),			 
		array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),						 
		array(  
                 "type"          => "tableseparator",  
				 "description"	 => 'Angaben zu Kosten',
                 "capability"    => "edit_posts"  
				 	 ),	 
		array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-price",  
                 "title"         => "Kaufpreis",  
                   "type"          => "inputshort",   
               "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-price6",  
                 "title"         => "Hauskosten",  
                   "type"          => "inputshort",  
				   "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-price2",  
                 "title"         => "Kaltmiete",  
                 "type"          => "inputshort",  
				 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-price3",  
                 "title"         => "Nebenkosten",  
                   "type"          => "inputshort",  
				   "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-price5",  
                 "title"         => "Miete PKW/Stellplatz",  
                   "type"          => "inputshort",  
				   "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-price4",  
                 "title"         => "Gesamtmiete",  
                   "type"          => "inputshort",  
				   "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-heat-costs",  
                 "title"         => "Heizungskosten",  
                  "type"          => "inputshort",   
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-deposit",  
                 "title"         => "Kaution",  
                   "type"          => "inputshort",   
               "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "name"          => "prop-prov1",  
                 "title"         => "Provision Mieter",  
                   "type"          => "inputshort",   
               "capability"    => "edit_posts"  
				 	 ),	
		array(  
                 "name"          => "prop-prov2",  
                 "title"         => "Provision K&auml;ufer",  
                   "type"          => "inputshort",   
               "capability"    => "edit_posts"  
				 	 ),	
		array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
		array(  
                 "type"          => "tableseparator",  
				 "description"	 => 'Angaben zum Objektstatus',
                 "capability"    => "edit_posts"  
				 	 ),	 
		array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
		 array(  
                 "name"          => "prop-year",  
                 "title"         => "Baujahr",  
                   "type"          => "inputshort",   
                 "capability"    => "edit_posts"  
				 	 ),
		  array(  
                 "name"          => "prop-re",  
                 "title"         => "Letzte Renovierung",  
                   "type"          => "inputshort",   
               "capability"    => "edit_posts"  
				 	 ),
		  array(  
                 "name"          => "prop-status",  
                 "title"         => "Objektzustand",  
                   "type"          => "inputshort",   
               "capability"    => "edit_posts"  
				 	 ),
		 array(  
                 "name"          => "prop-start",  
                 "title"         => "Verf&uuml;gbar ab",  
                   "type"          => "inputshort",   
               "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
			 array(  
                 "type"          => "tableseparator",  
				 "description"	 => 'Angaben zum Energiebedarf',
                 "capability"    => "edit_posts"  
				 	 ),	 
			array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-heat-tool",  
                 "title"         => "Heizungsart",  
                  "type"          => "inputshort",   
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-heat",  
                 "title"         => "Energietr&auml;ger",  
                  "type"          => "inputshort",   
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-eco",  
                 "title"         => "Endenergiebedarf",  
                  "type"          => "inputshort",   
                 "capability"    => "edit_posts"  
				 	 ),		
			array(  
                 "name"          => "prop-eco-mode",  
                 "title"         => "Art des Energieausweises",  
                  "type"          => "inputshort",   
                 "capability"    => "edit_posts"  
				 	 ),		
			array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),		 
			array(  
                 "name"          => "prop-eco-class",  
                 "title"         => "E-effizienzklasse",  
                  "type"          => "inputshort",   
                 "capability"    => "edit_posts"  
				 	 ),			 
					 
			array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),		 	 
			array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
			 array(  
                 "type"          => "tableseparator",  
				 "description"	 => 'Sonstige Angaben',
                 "capability"    => "edit_posts"  
				 	 ),	 
			array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-level",  
                 "title"         => "Etage",  
                   "type"          => "inputshort",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-level-count",  
                 "title"         => "Etagen insgesamt",  
                  "type"          => "inputshort",   
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
	 		array(  
                 "type"          => "close-cftable",  
                 "capability"    => "edit_posts"  
				 	 ),
			array (
				 "type" 		 => "cftable",
				 "capability"    => "edit_posts"  
		 		 ),
			array(  
                 "name"          => "prop-garden",  
                 "title"         => "Garten",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-balkony",  
                 "title"         => "Balkon",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-patio",  
                 "title"         => "Terasse",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-garage",  
                 "title"         => "Garage",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-carport",  
                 "title"         => "PKW Stellplatz",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),	 	 
			array(  
                 "name"          => "prop-lift",  
                 "title"         => "Aufzug",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),	 
			array(  
                 "name"          => "prop-access",  
                 "title"         => "Barrierefrei",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-kitchen",  
                 "title"         => "Einbauk&uuml;che",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-wc",  
                 "title"         => "G&auml;ste WC",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-basement",  
                 "title"         => "Keller",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-washing",  
                 "title"         => "Waschk&uuml;che",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-basement-bic",  
                 "title"         => "Fahrradkeller",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),	 	
			array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),			
			array(  
                 "name"          => "prop-pool",  
                 "title"         => "Pool",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "name"          => "prop-pets",  
                 "title"         => "Haustiere",  
                 "type"          => "checkbox",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
			array(  
                 "type"          => "close-cftable",  
                 "capability"    => "edit_posts"  
				 	 ),
			array (
				 "type" 		 => "cfbox",
				 "capability"    => "edit_posts"  
		 		 ),
			array(  
                 "name"          => "prop-extras",  
                 "title"         => "Textfeld f&uuml;r sonstige Angaben und Infos",  
                 "type"          => "text",  
                 "capability"    => "edit_posts"
			 	 ),	
		  array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
			 array(  
                 "type"          => "tableseparator",  
				 "description"	 => 'Standort auf Google Maps und Adresse',
                 "capability"    => "edit_posts"  
				 	 ),	 
			array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
		    array(  
                 "name"          => "prop-geolink",  
                 "title"         => "Google Map Code",  
                 "type"          => "text",  
                 "capability"    => "edit_posts",  
				 	 ),		 
			array (
				 "type" 		 => "separator",
				 "capability"    => "edit_posts"  
		 		 ),
			array(  
                 "name"          => "prop-address",  
                 "title"         => "Adresse",  
                 "type"          => "text",  
                 "capability"    => "edit_posts"  
         			), 
		  array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
			 array(  
                 "type"          => "tableseparator",  
				 "description"	 => 'Upload f&uuml;r Objektinfos (pdf) und/oder Energieausweise (jpg)',
                 "capability"    => "edit_posts"  
				 	 ),	 
			 array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
		 	 array(  
                 "name"          => "prop-ausweis",  
                 "title"         => "Energieausweis hochladen (jpg)",  
                 "type"          => "upload",  
                 "capability"    => "edit_posts"
				 ),			 
			array(  
                 "name"          => "prop-pdf",  
                 "title"         => "Objektinfos hochladen (pdf)",  
                 "type"          => "uploadinfo",  
                 "capability"    => "edit_posts", 
				 "button"        => "uploadpdf" 
				 	 ),	
			array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
					 
			array(
				"type"          => "help",
	    		"capability"    => "edit_posts"
			),		 
				 array(
				 "name"          => "close",  
                 "type"          => "closebox",  
                 "capability"    => "edit_posts"
				),
	
	  );  
	  
	  
         function boPropFields() { $this->__construct(); }  
         function __construct() {  
             add_action( 'admin_menu', array( &$this, 'createPropFields' ) );  
             add_action( 'save_post', array( &$this, 'savePropFields' ), 1, 2 );  
             // Comment this line out if you want to keep default custom fields meta box  
             add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );  
         }  
      
         function removeDefaultCustomFields( $type, $context, $post ) {  
             foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {  
                 
             }  
         }  
        
         function createPropFields() {  
             if ( function_exists( 'add_meta_box' ) ) {  
                 add_meta_box( 'prop-fields', __('Angaben zu den Immobilienobjekten','bobox'), array( &$this, 'displayPropFields' ), 'property', 'normal', 'high' );  
				 add_meta_box( 'prop-fields', __('Angaben zu den Referenzobjekten','bobox'), array( &$this, 'displayPropFields' ), 'portfolio', 'normal', 'high' );  
                  
             }  
         }  
         
         function displayPropFields() {  
             global $post;  
             ?>  
             <div class="form-wrap" style="margin:0; padding:0; ">  
                 <?php  
                 wp_nonce_field( 'prop-fields', 'prop-fields_wpnonce', false, true );  
                 foreach ( $this->propFields as $propField ) {  
       if ( $output = true ) { ?>  
                         
<?php  
switch ( $propField[ 'type' ] ) {  
							 
							 
case "checkbox": {  
     echo '<td style="border:1px solid #e5e5e5; margin:2px; padding:3px;"><label style=" font-size:.8em; display:inline-block; width:80px; margin:5px 0;" for="' . $this->prefix . $propField[ 'name' ] .'" style="display:inline;">' . $propField['title'] . '</label>';  
	 echo '<input type="checkbox" name="' . $this->prefix . $propField['name'] . '" id="' . $this->prefix . $propField['name'] . '" value="yes"';  
     if ( get_post_meta( $post->ID, $this->prefix . $propField['name'], true ) == "yes" )  
     echo ' checked="checked"';  
     echo '" style="width: auto; margin:5px 0;" /></td>';  
	 break;  }

case "select": {  
	echo '<label style="font-size:.8em; display:inline-block; margin:5px 5px 5px 0; width:140px;" for="' . $this->prefix . $propField[ 'name' ] .'">' . $propField[ 'title' ] . ':</label>';
	echo '<select name="' . $this->prefix . $propField['name'] . '" id="' . $this->prefix . $propField['name'] . '"';
										$counter=0;
	foreach ($propField['options'] as $option) { ?>
      <option
	<?php if ( get_post_meta( $post->ID, $this->prefix . $propField['name'], true ) == $propField['values'][$counter]) { 
		echo ' selected="selected"'; 
	}  ?>
	value="<?php echo($propField['values'][$counter]);?>"><?php echo $option; ?></option>
      <?php
	$counter++; }
  	echo '</select>';
    break; } 
								
case "input": {  
     echo '<div class="">  ';
	echo '<label style=" font-size:.9em; display:inline-block; margin:5px 0; width:120px;" for="' . $this->prefix . $propField[ 'name' ] .'">' . $propField[ 'title' ] . ':</label>';
	echo '<input style="font-size:.9em; margin:3px 0; display:inline-block;" type="text" name="' . $this->prefix . $propField[ 'name' ] . '" id="' . $this->prefix . $propField[ 'name' ] . '" value="' . 
									htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $propField[ 'name' ], true ) ) . '" />';
	echo '</div>';
	break; }  

case "inputshort": {  
    echo '<td style=""><label style="font-size:.85em; display:inline-block; margin:5px 0; width:45%;" for="' . $this->prefix . $propField[ 'name' ] .'">' . $propField[ 'title' ] . ':</label>';
	echo '<input style="width:50%; margin:5px 0 5px 0; display:inline-block; font-size:.9em;" type="text" name="' . $this->prefix . $propField[ 'name' ] . '" id="' . $this->prefix . $propField[ 'name' ] . '" value="' . 
									htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $propField[ 'name' ], true ) ) . '" /></td>';
	break;  }  

case "upload": {  
    echo '<td colspan="2" style=""><label style=" font-size:.8em; width:200px; display:inline-block; margin:5px 0;" for="' . $this->prefix . $propField[ 'name' ] .'">' . $propField[ 'title' ] . ':</label>';
	echo '<input class="custominput" style="width:360px; margin:5px 0; display:inline-block;" type="text" name="' . $this->prefix . $propField[ 'name' ] . '" id="' . $this->prefix . $propField[ 'name' ] . '" value="' . 
									htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $propField[ 'name' ], true ) ) . '" />';
	echo '<input type="button" style="margin:3px 0 0 7px;" name="' . $this->prefix . $propField[ 'name' ] . '" id="' . $this->prefix . $propField[ 'name' ] . '" class="customupload button-secondary" value="';
	echo 'Upload';
	echo '" /><br /></td>';
    break; }  
								  
case "uploadinfo": {  
    echo '<label style="font-size:.8em; display:inline-block; margin:5px 0; width:200px;" for="' . $this->prefix . $propField[ 'name' ] .'">' . $propField[ 'title' ] . ':</label>';
	echo '<input class="custominfoinput" style="width:360px; margin:5px 0; display:inline-block;" type="text" name="' . $this->prefix . $propField[ 'name' ] . '" id="' . $this->prefix . $propField[ 'name' ] . '" value="' . 
									htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $propField[ 'name' ], true ) ) . '" />';
	echo '<input type="button" style="margin:3px 0 0 7px;" name="' . $this->prefix . $propField[ 'name' ] . '" id="' . $this->prefix . $propField[ 'name' ] . '" class="custominfoupload button-secondary" value="';
	echo 'Upload';
	echo '" />';
    break; }  
								 
case "help": { ?><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/uploadpostimg.js" ></script><?php
	break; }
								 								 
case "text": {  
	echo '<label style="font-size:.8em; display:block; margin:5px 0; width:340px;" for="' . $this->prefix . $propField[ 'name' ] .'">' . $propField[ 'title' ] . ':</label>';
	echo '<textarea rows="6" style="width:60%; margin:5px 0; " name="' . $this->prefix . $propField[ 'name' ] . '" id="' . $this->prefix . $propField[ 'name' ] . '" >' . 
									htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $propField[ 'name' ], true ) ) . '</textarea>';
	if ( $propField[ 'description' ] ) echo '<p><br />' .  $propField[ 'description' ] . '</p>';
	break;  }  									
													 
case "headline": {
	echo '<h2 style="margin:0; padding:0;">' . $topField['title'] . '</h2>';
	break; }				
case "separator": { ?><div style="margin:15px 0 ; border-bottom:1px solid #fff; background:#ccc; height:1px; display:block;"></div> <?php
	break; }  

case "tableseparator": {  ?><tr><td colspan="4"><hr />
      <?php  if ( $propField[ 'description' ] ) echo '<div style="font-size:1em; color:#666; font-style:italic; padding:0 0 15px 0;">' .  $propField[ 'description' ] . '</div>'; ?> </td></tr> <?php
	break; }
	
case "cfbox": { 
	echo '<div class="cfbox" style="padding:5px 0;">';
	echo '<h2 style="margin:0; padding:0;">' .  $topField[ 'title' ] . '</h2>';
	echo '<p style="margin:0 0 20px 0; padding:0;">' .  $topField[ 'description' ] . '</p>';
	break; }

																						 
case "cftable": { echo '<table style="margin:20px 0 0 0; padding:5px; width:100%;"><tr>';
	if ( $propField[ 'description' ] ) echo '<p>' .  $propField[ 'description' ] . '</p>';  		break; }
case "close-cftable": { echo '</tr></table>'; break; }
case "row-open": { echo '<tr>'; break; }
case "row-close": { echo '</tr>'; break; }
case "closebox": { echo '</div>'; break; 
								 }						 
							 }  
                               }  
                 } ?>  
           </div>

<?php  
         }  
		function savePropFields( $post_id, $post ) {  
             if ( !wp_verify_nonce( $_POST[ 'prop-fields_wpnonce' ], 'prop-fields' ) )  
                 return;  
             if ( !current_user_can( 'edit_post', $post_id ) )  
                 return;  
             if ( $post->post_type != 'property' && $post->post_type != 'portfolio')  
                 return;  
             foreach ( $this->propFields as $propField ) {  
                 if ( current_user_can( $propField['capability'], $post_id ) ) {  
                     if ( isset( $_POST[ $this->prefix . $propField['name'] ] ) && trim( $_POST[ $this->prefix . $propField['name'] ] ) ) {  
                         $value = $_POST[ $this->prefix . $propField['name'] ];  
                         if ( $propField['type'] == "wysiwyg" ) $value = wpautop( $value );  
                         update_post_meta( $post_id, $this->prefix . $propField[ 'name' ], $value );  
                     } else {  
                         delete_post_meta( $post_id, $this->prefix . $propField[ 'name' ] );  
                     }  
                 }  
             }  
         }  
   
     } 
   
 } 
   
if ( class_exists('boPropFields') ) {  
     $boPropFields_var = new boPropFields();  
 }
 
 
 
 
 
 
 
 
 
 // ===================== Custom fields property ref ======================= 


if ( !class_exists('boRefFields') ) {  

class boRefFields {  
		 var $prefix = 'bor_';  
		 var $refFields = array(
		 
		 array(
		 "type" 		 => "cftable",
		 "capability"    => "edit_posts", 
		 "description"	 => 'Hier können Sie das Objekt als verkauft/vermietet markieren.',
		 ),
		 array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
		 array(  
              	"name"          => "prop-sale",  
               	"title"         => "Angebotsstatus",  
               	"type"          => "select",  
				"values"		=> array('','sold','rented'),
				"options"		=> array('.. offen ..','Verkauft','Vermietet'),
               	"capability"    => "edit_posts"  
					 ),
		array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
 
 
  array(
				 "name"          => "close",  
                 "type"          => "close-cftable",  
                 "capability"    => "edit_posts"
				),
	
	  );  
	  
	  
         function boRefFields() { $this->__construct(); }  
         function __construct() {  
             add_action( 'admin_menu', array( &$this, 'createRefFields' ) );  
             add_action( 'save_post', array( &$this, 'saveRefFields' ), 1, 2 );  
             // Comment this line out if you want to keep default custom fields meta box  
             add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );  
         }  
      
         function removeDefaultCustomFields( $type, $context, $post ) {  
             foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {  
                 
             }  
         }  
        
         function createRefFields() {  
             if ( function_exists( 'add_meta_box' ) ) {  
                 add_meta_box( 'ref-fields', __('Markierung des Referenzobjekts','bobox'), array( &$this, 'displayRefFields' ), 'portfolio', 'normal', 'high' );  
                  
             }  
         }  
         
         function displayRefFields() {  
             global $post;  
             ?>  
             <div class="form-wrap" style="margin:0; padding:0; ">  
                 <?php  
                 wp_nonce_field( 'ref-fields', 'ref-fields_wpnonce', false, true );  
                 foreach ( $this->refFields as $refField ) {  
       if ( $output = true ) { ?>  
                         
<?php  
switch ( $refField[ 'type' ] ) {  
							 
							 
case "checkbox": {  
     echo '<td style="border:1px solid #e5e5e5; margin:2px; padding:3px;"><label style=" font-size:.8em; display:inline-block; width:140px; margin:5px 0;" for="' . $this->prefix . $refField[ 'name' ] .'" style="display:inline;">' . $refField['title'] . '</label>';  
	 echo '<input type="checkbox" name="' . $this->prefix . $refField['name'] . '" id="' . $this->prefix . $refField['name'] . '" value="yes"';  
     if ( get_post_meta( $post->ID, $this->prefix . $refField['name'], true ) == "yes" )  
     echo ' checked="checked"';  
     echo '" style="width: auto; margin:5px 0;" /></td>';  
	 break;  }
	
	case "text": {  
	echo '<label style="font-size:.8em; display:block; margin:5px 0; width:340px;" for="' . $this->prefix . $refField[ 'name' ] .'">' . $refField[ 'title' ] . ':</label>';
	echo '<textarea rows="6" style="width:60%; margin:5px 0; " name="' . $this->prefix . $refField[ 'name' ] . '" id="' . $this->prefix . $refField[ 'name' ] . '" >' . 
									htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $refField[ 'name' ], true ) ) . '</textarea>';
	if ( $refField[ 'description' ] ) echo '<p><br />' .  $refField[ 'description' ] . '</p>';
	break;  }  	 

case "select": {  
	echo '<td style="border:1px solid #e5e5e5; margin:2px; padding:3px;"><label style="font-size:.8em; display:inline-block; margin:5px 5px 5px 0; width:140px;" for="' . $this->prefix . $refField[ 'name' ] .'">' . $refField[ 'title' ] . ':</label>';
	echo '<select name="' . $this->prefix . $refField['name'] . '" id="' . $this->prefix . $refField['name'] . '">';
										$counter=0;
	foreach ($refField['options'] as $option) { ?>
      <option
	<?php if ( get_post_meta( $post->ID, $this->prefix . $refField['name'], true ) == $refField['values'][$counter]) { 
		echo ' selected="selected"'; 
	}  ?>
	value="<?php echo($refField['values'][$counter]);?>"><?php echo $option; ?></option>
      <?php
	$counter++; }
  	echo '</select></td>';
    break; } 
								

																			 
case "cftable": { echo '<table style="margin:20px 0 0 0; padding:5px; width:100%;">';
	if ( $refField[ 'description' ] ) echo '<p>' .  $refField[ 'description' ] . '</p>';  		break; }
case "close-cftable": { echo '</table>'; break; }
case "row-open": { echo '<tr>'; break; }
case "row-close": { echo '</tr>'; break; }
					 
							 }  
                               }  
                 } ?>  
           </div>

<?php  
         }  
		function saveRefFields( $post_id, $post ) {  
             if ( !wp_verify_nonce( $_POST[ 'ref-fields_wpnonce' ], 'ref-fields' ) )  
                 return;  
             if ( !current_user_can( 'edit_post', $post_id ) )  
                 return;  
             if ( $post->post_type != 'portfolio')  
                 return;  
             foreach ( $this->refFields as $refField ) {  
                 if ( current_user_can( $refField['capability'], $post_id ) ) {  
                     if ( isset( $_POST[ $this->prefix . $refField['name'] ] ) && trim( $_POST[ $this->prefix . $refField['name'] ] ) ) {  
                         $value = $_POST[ $this->prefix . $refField['name'] ];  
                         if ( $refField['type'] == "wysiwyg" ) $value = wpautop( $value );  
                         update_post_meta( $post_id, $this->prefix . $refField[ 'name' ], $value );  
                     } else {  
                         delete_post_meta( $post_id, $this->prefix . $refField[ 'name' ] );  
                     }  
                 }  
             }  
         }  
   
     } 
   
 } 
   
if ( class_exists('boRefFields') ) {  
     $boRefFields_var = new boRefFields();  
 }
  
 
 


 // ===================== Custom fields property ref ======================= 


if ( !class_exists('boNewFields') ) {  

class boNewFields {  
		 var $prefix = 'bor_';  
		 var $newFields = array(
		 
		 array(
		 "type" 		 => "cftable",
		 "capability"    => "edit_posts", 
		 "description"	 => 'Hier können Sie das Objekt mit einem beliebigen Text markieren.',
		 ),
		 array(  
                 "type"          => "row-open",  
                 "capability"    => "edit_posts"  
				 	 ),
		 
		array(  
              	"name"          => "prop-new",  
               	"title"         => "Markierung eintragen",  
               	"type"          => "input",  
               	"capability"    => "edit_posts"  
					 ),			 
		array(  
                 "type"          => "row-close",  
                 "capability"    => "edit_posts"  
				 	 ),
 
 
  array(
				 "name"          => "close",  
                 "type"          => "close-cftable",  
                 "capability"    => "edit_posts"
				),
	
	  );  
	  
	  
         function boNewFields() { $this->__construct(); }  
         function __construct() {  
             add_action( 'admin_menu', array( &$this, 'createNewFields' ) );  
             add_action( 'save_post', array( &$this, 'saveNewFields' ), 1, 2 );  
             // Comment this line out if you want to keep default custom fields meta box  
             add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );  
         }  
      
         function removeDefaultCustomFields( $type, $context, $post ) {  
             foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {  
                 
             }  
         }  
        
         function createNewFields() {  
             if ( function_exists( 'add_meta_box' ) ) {  
                 add_meta_box( 'new-fields', __('Objekt-Markierung','bobox'), array( &$this, 'displayNewFields' ), 'property', 'normal', 'high' );  
                  
             }  
         }  
         
         function displayNewFields() {  
             global $post;  
             ?>  
             <div class="form-wrap" style="margin:0; padding:0; ">  
                 <?php  
                 wp_nonce_field( 'new-fields', 'new-fields_wpnonce', false, true );  
                 foreach ( $this->newFields as $newField ) {  
       if ( $output = true ) { ?>  
                         
<?php  
switch ( $newField[ 'type' ] ) {  
							 
							 
case "checkbox": {  
     echo '<td style="border:1px solid #e5e5e5; margin:2px; padding:3px;"><label style=" font-size:.8em; display:inline-block; width:140px; margin:5px 0;" for="' . $this->prefix . $newField[ 'name' ] .'" style="display:inline;">' . $newField['title'] . '</label>';  
	 echo '<input type="checkbox" name="' . $this->prefix . $newField['name'] . '" id="' . $this->prefix . $newField['name'] . '" value="yes"';  
     if ( get_post_meta( $post->ID, $this->prefix . $newField['name'], true ) == "yes" )  
     echo ' checked="checked"';  
     echo '" style="width: auto; margin:5px 0;" /></td>';  
	 break;  }
	 
case "input": {  
    echo '<div class="">  ';
	echo '<label style="font-size:.85em; display:inline-block; margin:5px 0; width:200px;" for="' . $this->prefix . $newField[ 'name' ] .'">' . $newField[ 'title' ] . ':</label>';
	echo '<input maxlength="10" style="width:100px; margin:3px 0; display:inline-block;" type="text" name="' . $this->prefix . $newField[ 'name' ] . '" id="' . $this->prefix . $newField[ 'name' ] . '" value="' . 
									htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $newField[ 'name' ], true ) ) . '" />';
	echo '</div>';
	break; }  
																			 
case "cftable": { echo '<table style="margin:20px 0 0 0; padding:5px; width:100%;">';
	if ( $newField[ 'description' ] ) echo '<p>' .  $newField[ 'description' ] . '</p>';  		break; }
case "close-cftable": { echo '</table>'; break; }
case "row-open": { echo '<tr>'; break; }
case "row-close": { echo '</tr>'; break; }
					 
							 }  
                               }  
                 } ?>  
           </div>

<?php  
         }  
		function saveNewFields( $post_id, $post ) {  
             if ( !wp_verify_nonce( $_POST[ 'new-fields_wpnonce' ], 'new-fields' ) )  
                 return;  
             if ( !current_user_can( 'edit_post', $post_id ) )  
                 return;  
             if ( $post->post_type != 'property')  
                 return;  
             foreach ( $this->newFields as $newField ) {  
                 if ( current_user_can( $newField['capability'], $post_id ) ) {  
                     if ( isset( $_POST[ $this->prefix . $newField['name'] ] ) && trim( $_POST[ $this->prefix . $newField['name'] ] ) ) {  
                         $value = $_POST[ $this->prefix . $newField['name'] ];  
                         if ( $newField['type'] == "wysiwyg" ) $value = wpautop( $value );  
                         update_post_meta( $post_id, $this->prefix . $newField[ 'name' ], $value );  
                     } else {  
                         delete_post_meta( $post_id, $this->prefix . $newField[ 'name' ] );  
                     }  
                 }  
             }  
         }  
   
     } 
   
 } 
   
if ( class_exists('boNewFields') ) {  
     $boNewFields_var = new boNewFields();  
 }
  



 
 
 // ========================== Custom Fields


function Print_customdata_fields($cnt, $i = null) {
if ($i === null){
    $b = $c = '';
}else{
    $b = $i['d'];
    $c = $i['i'];
}
return  <<<HTML
<tr><td>
    <label style="font-size:.85em;">Feldname:</label>
    <input type="text" name="custom_data[$cnt][d]" size="40" value="$b"/></td>
<td>
    <label style="font-size:.85em;">Feldinhalt:</label>
    <input type="text" class="custominput" name="custom_data[$cnt][i]" size="40" value="$c"/>
   </td>
<td>	<span class="sort"> </span></td>
  
<td>    <span class="remove"></span></td>
</tr>
HTML
;
}


add_action("add_meta_boxes", "customdata_init");

function customdata_init(){
  add_meta_box("customdata_meta_id", "Zus&auml;tzliche Eintr&auml;ge (Felder)","customdata_meta", "property", "normal", "high");
	add_meta_box("customdata_meta_id", "Zus&auml;tzliche Eintr&auml;ge (Felder)","customdata_meta", "portfolio", "normal", "high");
}

function customdata_meta(){
 global $post;
 
  $data = get_post_meta($post->ID,"custom_data",true);
  echo '<div>';
  echo '<table id="custom_items">';
  $c = 0;
    if (count($data) > 0){
        foreach((array)$data as $i ){
            if (isset($i['i']) || isset($i['d'])){
                echo Print_customdata_fields($c,$i);
                $c = $c +1;
            }
        }

    }
    echo '</table>';

    ?>
        
        <div style=" background:#f2f2f2 url(<?php bloginfo('template_url'); ?>/images/add.png) left no-repeat; border:1px solid #ccc; border-radius: 3px; width:50%; padding:8px 10px 8px 35px; margin:15px 0; cursor:pointer;" 
        class="adddata"><?php echo __('Hier klicken, um zus&auml;tzliche Eintr&auml;ge zu machen (Textfelder)', 'bobox'); ?></div>
        <script>
            var $ =jQuery.noConflict();
                $(document).ready(function() {
                var count = <?php echo $c; ?>;
                $(".adddata").click(function() {
                    count = count + 1;
                   $('#custom_items').append('<?php echo implode('',explode("\n",Print_customdata_fields('count'))); ?>'.replace(/count/g, count));
                    return false;
                });
               $('.remove').on('click', function() {
$(this).parents('tr').remove();
return false;
});
				
$('#custom_items tbody').sortable({
revert: true,
cursor: 'move',
handle: '.sort'
});
  });
</script>

<style>
		#custom_items {list-style: none;}
        .remove { background:url(<?php bloginfo('template_url'); ?>/images/remove.png) bottom no-repeat; display:inline-block; width:34px; height:34px; cursor:pointer;}
        
        </style>
    <?php
    echo '</div>';
}

 
add_action('save_post', 'save_detailscd');

function save_detailscd($post_id){ 
global $post;

if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id; 
	
	if (isset($_POST['custom_data'])){
        $data = $_POST['custom_data'];
        update_post_meta($post_id,'custom_data',$data);
    }else{
        delete_post_meta($post_id,'custom_data');
    }
} 
 

// =======================  Custom Boxes


function Print_customboxdata_fields($box, $i = null) {
if ($i === null){
    $b = $c = '';
}else{
    $b = $i['d'];
    $c = $i['i'];
}
return  <<<HTML
<tr>
   <td> 
   <label>Feldname:</label>
   <input type="text" name="custombox_data[$box][d]" size="40" value="$b"/>
</td>
<td>	<span class="sort"> </span></td>
  
<td>    <span class="remove"></span></td>
</tr>
HTML
;
}

add_action("add_meta_boxes", "customboxdata_init");

function customboxdata_init(){
  add_meta_box("customboxdata_meta_id", "Zus&auml;tzliche Eintr&auml;ge (Haken)","customboxdata_meta", "property", "normal", "high");
  add_meta_box("customboxdata_meta_id", "Zus&auml;tzliche Eintr&auml;ge (Haken)","customboxdata_meta", "portfolio", "normal", "high");

}

function customboxdata_meta(){
 global $post;
 
  $data = get_post_meta($post->ID,"custombox_data",true);
  echo '<div>';
  echo '<table id="custombox_items">';
  $c = 0;
    if (count($data) > 0){
        foreach((array)$data as $i ){
            if (isset($i['i']) || isset($i['d'])){
                echo Print_customboxdata_fields($c,$i);
                $c = $c +1;
            }
        }

    }
    echo '</table>';

    ?>
        
        <div style=" background:#f2f2f2 url(<?php bloginfo('template_url'); ?>/images/add.png) left no-repeat; border:1px solid #ccc; border-radius: 3px; width:50%; padding:8px 10px 8px 35px; margin:15px 0; cursor:pointer;" 
        class="addboxdata"><?php echo __('Hier klicken, um zus&auml;tzliche Eintr&auml;ge zu machen (Haken)', 'bobox'); ?></div>
        <script>
            var $ =jQuery.noConflict();
                $(document).ready(function() {
                var count = <?php echo $c; ?>;
                $(".addboxdata").click(function() {
                    count = count + 1;
                   $('#custombox_items').append('<?php echo implode('',explode("\n",Print_customboxdata_fields('count'))); ?>'.replace(/count/g, count));
                    return false;
                });
                 $('.remove').on('click', function() {
$(this).parents('tr').remove();
return false;
});
				
				
$('#custombox_items tbody').sortable({
revert: true,
cursor: 'move',
handle: '.sort'
});
				
  });
    </script>
        <style>
		#custombox_items {list-style: none;}
        .remove { background:url(<?php bloginfo('template_url'); ?>/images/remove.png) bottom no-repeat; display:inline-block; width:34px; height:34px; cursor:pointer;}
            </style>
    <?php
    echo '</div>';
}

add_action('save_post', 'save_detailscbd');
function save_detailscbd($post_id){ 
global $post;

 if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id; 
    if (isset($_POST['custombox_data'])){
        $data = $_POST['custombox_data'];
        update_post_meta($post_id,'custombox_data',$data);
    }else{
        delete_post_meta($post_id,'custombox_data');
    }
} 
 
 
 // ==================  Image Gallery Fields


function Print_image_fields($cnt, $i = null) {
if ($i === null){
    $b = $c = '';
}else{
    $b = $i['d'];
    $c = $i['i'];
}
return  <<<HTML
<tr>
  <td> 
    <label>Beschreibung:</label>
    <input type="text" name="image_data[$cnt][d]" size="40" value="$b"/>
</td>
<td>
    <label>Bild URL :</label>
    <input type="text" class="custominput" name="image_data[$cnt][i]" size="40" value="$c"/>
	<input type="button" class="customupload button-secondary" name="image_data[$cnt][i]" id="image_data[$cnt][i]" value="UPLOAD" />
	</td>
	 <td> <img src="$c" width="50px" height="30px" style="margin:0 10px;"/></td>
	<td>	<span class="sort"> </span></td>
    <td>	<span class="remove"></span></td>
</tr>
HTML
;
}


//add custom image gallery
add_action("add_meta_boxes", "galery_init");

function galery_init(){
  add_meta_box("image_meta_id", "Bildergalerie","image_meta", "property", "normal", "high");
 	add_meta_box("image_meta_id", "Bildergalerie","image_meta", "portfolio", "normal", "high");
}

function image_meta(){
 global $post;
 
  $data = get_post_meta($post->ID,"image_data",true);
  echo '<div>';
  echo '<table id="image_items">';
  $c = 0;
    if (count($data) > 0){
        foreach((array)$data as $i ){
            if (isset($i['i']) || isset($i['d'])){
                echo Print_image_fields($c,$i);
                $c = $c +1;
            }
        }

    }
    echo '</table>';

    ?>
        
        <div class="addimage"><?php echo __('Hier klicken, um (weitere) Bilder hochzuladen', 'bobox'); ?></div>
        <script>
            var $ =jQuery.noConflict();
                $(document).ready(function() {
                var count = <?php echo $c; ?>;
                $(".addimage").click(function() {
                    count = count + 1;
                   $('#image_items').append('<?php echo implode('',explode("\n",Print_image_fields('count'))); ?>'.replace(/count/g, count));
                    return false;
                });
                $('.remove').on('click', function() {
$(this).parents('tr').remove();
return false;
                });
				
				$('#image_items tbody').sortable({
revert: true,
cursor: 'move',
handle: '.sort'
});
				
				var uploadID = ''; 
				var storeESendToEditor = '';
				var newESendToEditor   = '';
jQuery('.customupload').live('click', function() {
	window.send_to_editor = newESendToEditor;
    uploadID = jQuery(this).prev('input');     
     wp.media.editor.open(this);
        return false;
});

storeESendToEditor = window.send_to_editor;
newESendToEditor  = (function(html) { 
    imgurl = jQuery('img',html).attr('src');
    uploadID.val(imgurl);
    tb_remove();
});				
				
 });
</script>
      <style>
		#image_items {list-style: none;}
		#image_items td {padding:3px 0; border-bottom:1px solid #f2f2f2;}
		#image_items input { margin:0 5px 0 0; width:250px;}
		#image_items input.button-secondary { margin:0 5px 0 0; width:auto !important;}
.remove { background:#ebebeb url(<?php bloginfo('template_url'); ?>/images/remove.png) center no-repeat; display:inline-block; width:24px; height:24px; border:1px solid #ccc; border-radius:3px; cursor:pointer; margin:0 0 0 10px;}
.sort {background:#ebebeb url(<?php bloginfo('template_url'); ?>/images/sortable3.png) center no-repeat; display:inline-block; width:24px; height:24px; border:1px solid #ccc; border-radius:3px;  cursor:pointer; margin:0 0 0 10px;}
     .addimage {background:#f2f2f2 url(<?php bloginfo('template_url'); ?>/images/add.png) left no-repeat; border:1px solid #ccc; border-radius: 3px; width:50%; padding:8px 10px 8px 35px; margin:15px 0; cursor:pointer; }
.addimage:hover { box-shadow:0 0 1px #999;}
        </style>
    <?php
    echo '</div>';
}

 
add_action('save_post', 'save_detailss');
function save_detailss($post_id){ 
global $post;
if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX))
    return $post_id; 
if (isset($_POST['image_data'])){
        $data = $_POST['image_data'];
        update_post_meta($post_id,'image_data',$data);
    }else{
        delete_post_meta($post_id,'image_data');
    }
} 
 

 // =================== Custom Fields SEO 
	 
	 
	     $prefix = '_boT_';
    $meta_box2 = array(
    'id' => 'bo-meta-box2',
    'title' => 'SEO - Angaben',
    'page' => array('property','page', 'post','services'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
    array(
    'name' => 'Meta Tag: Title',
    'desc' => 'Tragen Sie hier einen individuellen Titel f&uuml;r diese Seite ein',
    'id' => $prefix . 'meta-title',
    'type' => 'text'
   ),
      array(
    'name' => 'Meta Tag: Description',
    'desc' => 'Tragen Sie hier eine individuelle Beschreibung f&uuml;r diese Seite ein',
    'id' => $prefix . 'meta-description',
    'type' => 'textarea'
   ),
   array(
    'name' => 'Meta Tag: Keywords',
    'desc' => 'Tragen Sie hier die Keywords f&uuml;r diese Seite ein (mit Kommas trennen)',
    'id' => $prefix . 'meta-keywords',
    'type' => 'text'
   )

    
    )
    );
	
	   add_action('admin_menu', 'mytheme_add_box2');
    function mytheme_add_box2() {
    global $meta_box2;
  
foreach ($meta_box2['page'] as $page_type){
$data = get_option('bo_options');
$seo = isset( $data['seo']['bo_theme_seo'] ) ? $data['seo']['bo_theme_seo'] : null;
if($seo == 'yes') {
add_meta_box($meta_box2['id'], $meta_box2['title'], 'mytheme_show_box2', $page_type, $meta_box2['context'], $meta_box2['priority']);
}}
	
  }
	
    function mytheme_show_box2() {
    global $meta_box2, $post;
    echo '<input type="hidden" name="mytheme_meta_box2_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';
    foreach ($meta_box2['fields'] as $field) {
    $meta = get_post_meta($post->ID, $field['id'], true);
   
    echo '<tr>',
    '<th style="width:15%; font-weight:bold;border-bottom:1px solid #fff; padding:15px 0;"><label style="font-size:.85em; padding-top:3px;" for="', $field['id'], '">', $field['name'], '</label></th>',
    '<td style="border-bottom:1px solid #fff;padding:15px 0;">';
    switch ($field['type']) {
    case 'text':
    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />';
    break;
    case 'textarea':
    echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="50" rows="3" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />';
    break;
    }
    echo '</td><td valign="top" style="border-bottom:1px solid #fff;padding:15px 0;">',
	'<span style="font-style:italic; font-size:11px;">' . $field['desc'] .'</span>',
    '</td></tr>';
    }
    echo '</table>';
    }
	
	    add_action('save_post', 'mytheme_save_data2');
    function mytheme_save_data2($post_id) {
    global $meta_box2;
    if (!wp_verify_nonce($_POST['mytheme_meta_box2_nonce'], basename(__FILE__))) {
    return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
    }
    if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
    return $post_id;
    }
    } elseif (!current_user_can('edit_post', $post_id)) {
    return $post_id;
    }
    foreach ($meta_box2['fields'] as $field) {
    $old = get_post_meta($post_id, $field['id'], true);
    $new = $_POST[$field['id']];
    if ($new && $new != $old) {
    update_post_meta($post_id, $field['id'], $new);
    } elseif ('' == $new && $old) {
    delete_post_meta($post_id, $field['id'], $old);
    }
    }
    }