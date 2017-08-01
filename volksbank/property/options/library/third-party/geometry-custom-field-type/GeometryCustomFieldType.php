<?php
if ( ! class_exists( 'GeometryCustomFieldType' ) ) :
class GeometryCustomFieldType extends AdminPageFramework_FieldType {
		

	public $aFieldTypeSlugs = array( 'geometry' );	
		
	protected $aDefaultKeys = array(
		'attributes'	=> array(
			'value'	=>	array(
				'latitude'	=> 30,
				'longitude'	=> 30,
				'width'	=>	400,
				'height'	=>	300,
				'location_name'	=> '',
				'zoom'	=> 9,
			),
			'latitude'	=> array(),
			'longitude'	=> array(),
			'width'	=> array(),
			'height'	=> array(),
			'zoom'	=> array(),
			'location_name'	=> array(),
			'button'	=> array(),
		),	
	);

	protected function setUp() {}
	
	protected function getEnqueuingScripts() { 
		return array(
			"https://maps.googleapis.com/maps/api/js?sensor=false",	// load this first
			dirname( __FILE__ ) . '/js/jquery-gmaps-latlon-picker.js',	// load this next - a file path can be passed, ( as well as a url )
		);
	}	

	protected function getEnqueuingStyles() { 
		return array(
			dirname( __FILE__ ) . '/css/jquery-gmaps-latlon-picker.css',	// a file path can be passed, ( as well as a url )
		); 
	}	
	
	protected function getScripts() { return ''; } 

	protected function getIEStyles() { return ''; }

	protected function getStyles() {
		return "/* Geometry Custom Field Type */
			.admin-page-framework-field .gllpMap {width: 100%}
			.admin-page-framework-section .form-table td .gllpLatlonPicker label {
				display: inline-block;
			}
		";
	}
	
	protected function getField( $aField ) { 
			
		return 
			$aField['before_label']
			. "<div class='admin-page-framework-input-label-container'>"
					. $aField['before_input']
					. ( $aField['label'] && ! $aField['repeatable']
						? "<span class='admin-page-framework-input-label-string' style='min-width:" .  $aField['label_min_width'] . "px;'>" . $aField['label'] . "</span>"
						: "" 
					)
					. $this->_getInputs( $aField )
					. $aField['after_input']
			. "</div>"
			. $aField['after_label'];
		
	}
		protected function _getInputs( &$aField ) {
			
			/* Set up attributes */
			$aBaseAttributes = $aField['attributes'];
unset( $aBaseAttributes['latitude'], $aBaseAttributes['longitude'], $aBaseAttributes['width'], $aBaseAttributes['height'], $aBaseAttributes['location_name'], $aBaseAttributes['zoom'], $aBaseAttributes['button'] );

			$aButtonAttributes = array(
				'type'	=>	'button',
				'id'	=>	"{$aField['input_id']}_button",
			) + $aField['attributes']['button'] + $aBaseAttributes;
			$aButtonAttributes['class']	.= ' gllpUpdateButton button button-small';
			
			$aLattitudeAttributes = array(
				'type'	=>	'text',
				'id'	=>	"{$aField['input_id']}_latitude",
				'value'	=>	isset( $aField['attributes']['value']['latitude'] ) ? $aField['attributes']['value']['latitude'] : 50,
				'name'	=>	"{$aField['_input_name']}[latitude]",						
			) + $aField['attributes']['latitude'] + $aBaseAttributes;
			$aLattitudeAttributes['class'] .= ' gllpLatitude';
			
			$aLongitudeAttributes = array(
				'type'	=>	'text',
				'id'	=>	"{$aField['input_id']}_longitude",
				'value'	=>	isset( $aField['attributes']['value']['longitude'] ) ? $aField['attributes']['value']['longitude'] : 8,
				'name'	=>	"{$aField['_input_name']}[longitude]",
			) + $aField['attributes']['longitude'] + $aBaseAttributes;			
			$aLongitudeAttributes['class'] .= ' gllpLongitude';

			$aLocationNameAttributes = array(
				'type'	=>	'text',
				'id'	=>	"{$aField['input_id']}_name",
				'value'	=>	isset( $aField['attributes']['value']['location_name'] ) ? $aField['attributes']['value']['location_name'] : '',
				'name'	=>	"{$aField['_input_name']}[location_name]",
			) + $aField['attributes']['location_name'] + $aBaseAttributes;			
			$aLocationNameAttributes['class'] .= ' gllpLocationName';
			
			$aZoomAttributes = array(
				'type'	=>	'text',
				'id'	=>	"{$aField['input_id']}_zoom",
				'value'	=>	isset( $aField['attributes']['value']['zoom'] ) ? $aField['attributes']['value']['zoom'] : '10',
				'name'	=>	"{$aField['_input_name']}[zoom]",
			) + $aField['attributes']['zoom'] + $aBaseAttributes;			
			$aZoomAttributes['class'] .= ' gllpZoom';
			
			$aWidthAttributes = array(
				'type'	=>	'text',
				'id'	=>	"{$aField['input_id']}_width",
				'value'	=>	isset( $aField['attributes']['value']['width'] ) ? $aField['attributes']['value']['width'] : '400',
				'name'	=>	"{$aField['_input_name']}[width]",
			) + $aField['attributes']['width'] + $aBaseAttributes;			
			$aWidthAttributes['class'] .= ' gllpWidth';	
			
			$aHeightAttributes = array(
				'type'	=>	'text',
				'id'	=>	"{$aField['input_id']}_height",
				'value'	=>	isset( $aField['attributes']['value']['height'] ) ? $aField['attributes']['value']['height'] : '300',
				'name'	=>	"{$aField['_input_name']}[height]",
			) + $aField['attributes']['height'] + $aBaseAttributes;			
			$aHeightAttributes['class'] .= ' gllpHeight';		
			
			
			/* Return the output */
			return
				"<div class='gllpLatlonPicker'>"
					. "<div class='gllpMap map'>" . __( 'Google Maps', 'bobox' ) . "</div>"
					. "<label for='{$aField['input_id']}_button' class='update-button'>"
						. "<a " . $this->generateAttributes( $aButtonAttributes ) . ">" . __( 'Karte aktualisieren', 'bobox' ) . "</a>"
					. "</label>"					
					. "<label for='{$aField['input_id']}_latitude'>"
						. "<span class='admin-page-framework-input-label-string' style='min-width:" .  $aField['label_min_width'] . "px;'>" . __( 'Latitude', 'bobox' ) . "</span>"
						. "<input " . $this->generateAttributes( $aLattitudeAttributes ) . " />"				
					. "</label><br />"
					. "<label for='{$aField['input_id']}_longitude'>"
						. "<span class='admin-page-framework-input-label-string' style='min-width:" .  $aField['label_min_width'] . "px;'>" . __( 'Longitude', 'bobox' ) . "</span>"
						. "<input " . $this->generateAttributes( $aLongitudeAttributes ) . " />"	
					. "</label><br />"
								
					. "<label for='{$aField['input_id']}_name'>"
						. "<span class='admin-page-framework-input-label-string' style='min-width:" .  $aField['label_min_width'] . "px;'>" . __( 'Standort Name', 'bobox' ) . "</span>"
						. "<input " . $this->generateAttributes( $aLocationNameAttributes ) . " />"
					. "</label><br />"
					. "<label for='{$aField['input_id']}_zoom'>"
						. "<span class='admin-page-framework-input-label-string' style='min-width:" .  $aField['label_min_width'] . "px;'>" . __( 'Zoom', 'bobox' ) . "</span>"	
						. "<input " . $this->generateAttributes( $aZoomAttributes ) . "/>"
					. "</label><br />"
					. "<label for='{$aField['input_id']}_width'>"
						. "<span class='admin-page-framework-input-label-string' style='min-width:" .  $aField['label_min_width'] . "px;'>" . __( 'Breite der Karte', 'bobox' ) . "</span>"	
						. "<input " . $this->generateAttributes( $aWidthAttributes ) . "/>"
					. "</label><br />"
					. "<label for='{$aField['input_id']}_height'>"
						. "<span class='admin-page-framework-input-label-string' style='min-width:" .  $aField['label_min_width'] . "px;'>" . __( 'Höhe der Karte', 'bobox' ) . "</span>"	
						. "<input " . $this->generateAttributes( $aHeightAttributes ) . "/>"
					. "</label><br />"
				. "</div>";	
			
		}
	
}
endif;