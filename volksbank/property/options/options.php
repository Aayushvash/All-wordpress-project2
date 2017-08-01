<?php 
if ( ! class_exists( 'AdminPageFramework' ) ) {
    include_once( dirname( __FILE__ ) . '/library/admin-page-framework/admin-page-framework.php' );
	}


if ( ! class_exists( 'AdminPageFramework_MetaBox' ) ) {
    return;
}
class bo_ImageBox extends AdminPageFramework_MetaBox {
public function setUp() {

$this->addSettingFields(
array(
'field_id'      => 'new_image_data',
'type'          => 'image',
'repeatable' => true,
'sortable' => true,
'attributes_to_store' => array('alt','caption'),
'attributes'	=> array(
'preview'	=> array(
'style'	=> 'max-width: 100px;'
),
),	
'title'         => __( 'Bilder-Upload', 'bobox' ),
'description'   => __( 'Hier können Sie Objektbilder für die Bildergalerie hochladen. Sie können mehrere Bilder gleichzeitig einbinden, indem Sie diese vorab in der Mediathek auswählen. Bilder können auch anschließend per Drag&Drop sortiert werden.', 'bobox' ),
'label'         => __( 'Upload', 'bobox' ),
)
);     
}

public function validate( $aInput, $aOldInput, $oAdmin ) {
return $aInput;
}
}
new bo_ImageBox("new_image_meta_id", __( 'Bildergalerie (Multiple Upload) ', 'bobox' ), array('property','portfolio'), 'normal', 'high');	
	
   
   
class bo_options extends AdminPageFramework {


// ======================  third party

public function start_bo_options() {	

$aFiles = array(
dirname( __FILE__ ) . '/library/third-party/geometry-custom-field-type/GeometryCustomFieldType.php',
);

foreach( $aFiles as $sFilePath )
	if ( file_exists( $sFilePath ) ) include_once( $sFilePath );
					
	$sClassName = get_class( $this );
		new GeometryCustomFieldType( $sClassName );
	}



	
// ======================  page
   
public function setUp() {
$this->setRootMenuPage( 'Appearance' );   
 
// ======================  submenu

$this->addSubMenuItems(
            array(
                'title'    =>    'Theme Einstellungen',    
                      'page_slug'    =>    'theme_options',  
					 					  
            )
        );   

// ======================  styles 
       
$this->enqueueStyle(  dirname( __FILE__ ) . '/apf.css', 'theme_options' );
$this->enqueueStyle(  dirname( __FILE__ ) . '/font-styles.css', 'theme_options' );
	 
// ======================  tabs

$this->addInPageTabs(
    'theme_options',   
	
	array(
        'tab_slug'    =>    'tab_basis', 
        'title'        =>    __( 'Basis', 'bobox' ),
    ),       
    array(
        'tab_slug'    =>    'tab_color',
        'title'        =>    __( 'Layout', 'bobox' ),
    ),
	                  
    array(
        'tab_slug'    =>    'tab_home',
        'title'        =>    __( 'Startseiten', 'bobox' ),
    ),
	 array(
        'tab_slug'    =>    'tab_home_custom',
        'title'        =>    __( 'Individuelle Startseite', 'bobox' ),
    ),
	array(
        'tab_slug'    =>    'tab_home2',
        'title'        =>    __( 'Startseiten Infoboxen', 'bobox' ),
    ),
	array(
        'tab_slug'    =>    'tab_serv',
        'title'        =>    __( 'Leistungen', 'bobox' ),
    ),
	array(
        'tab_slug'    =>    'tab_blog',
        'title'        =>    __( 'Blog', 'bobox' ),
    ),
	array(
        'tab_slug'    =>    'tab_contact',
        'title'        =>    __( 'Kontakt &amp; Anfragen', 'bobox' ),
    ),
	array(
        'tab_slug'    =>    'tab_seo',
        'title'        =>    __( 'SEO', 'bobox' ),
    ),
	array(
        'tab_slug'    =>    'tab_map',
        'title'        =>    __( 'Google Map', 'bobox' ),
    ),
	array(
        'tab_slug'    =>    'tab_social',
        'title'        =>    __( 'Social Media', 'bobox' ),
    ),
	array(
        'tab_slug'    =>    'tab_sc',
        'title'        =>    __( 'Shortcodes', 'bobox' ),
    )
	
);    
	 



	 
// ===================================================  sections

$this->addSettingSections(	
			'theme_options',
			array(
				'section_id'		=>	'basis1',	
				'tab_slug'		=>	'tab_basis',
				'title'			=>	__( 'Logo Upload', 'bobox' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie ein Logo f&uuml;r die Webseite hochladen', 'bobox' ),	
				
			),	
			array(
				'section_id'		=>	'basis2',	
				'tab_slug'		=>	'tab_basis',
				'title'			=>	__( 'Website Titel und Untertitel', 'bobox' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie alternativ zum Logo einen Titel f&uuml;r die Webseite eintragen. Einen individuellen Schrifttyp k&ouml;nnen Sie unter: <a href="'.  home_url()  . '/wp-admin/customize.php">Anpassen - Typography</a> einstellen. Dazu muss das empfohlene Plugin: Easy Google Fonts <a href="'.  home_url()  . '/wp-admin/themes.php?page=tgmpa-install-plugins">installiert und aktiviert sein</a>.', 'bobox' ),	
				
			),	
			array(
				'section_id'		=>	'basis3',	
				'tab_slug'		=>	'tab_basis',
				'title'			=>	__( 'Favicon und Touch Icons', 'bobox' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie die Icons f&uuml;r verschiedene Ausgabeger&auml;te hochladen.', 'bobox' ),	
				
			),
			array(
				'section_id'		=>	'basis4',	
				'tab_slug'		=>	'tab_basis',
				'title'			=>	__( 'Währung', 'bobox' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie ein Währungskürzel eintragen, Standard ist EUR', 'bobox' ),	
				
			),		
			array(
				'section_id'	=>	'social',	
				'tab_slug'		=>	'tab_social',
				'title'			=>	__( 'Social Media Icons', 'bobox' ),
				'description'	=>	__( 'Hier können Sie die Links zu Ihren Social Media Profilen eintragen. Die Icons werden mit dem Shortcode [social-media] ausgegeben. Hier finden Sie Infos <a href="'.  home_url()  . '/wp-admin/themes.php?page=theme_options&tab=tab_sc">zu den Shortcodes</a>. ', 'bobox' ),
			),
			array(
				'section_id'	=>	'colors',
				'tab_slug'		=>	'tab_color',
				'title'			=>	__( 'Textfarben', 'box' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie die Farben f&uuml;r verschiedene Textelemente ausw&auml;hlen.', 'bobox' ),
			),
			array(
				'section_id'	=>	'colors2',
				'tab_slug'		=>	'tab_color',
				'title'			=>	__( 'Men&uuml;farben', 'box' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie Text und Hintergrundfarbe f&uuml;r die Hauptnavigation ausw&auml;hlen.', 'bobox' ),
			),
			array(
				'section_id'	=>	'colors6',
				'tab_slug'		=>	'tab_color',
				'title'			=>	__( 'Men&uuml;farben Top', 'box' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie Text und Hintergrundfarbe f&uuml;r die Navigation am Seitenanfang ausw&auml;hlen.', 'bobox' ),
			),
			array(
				'section_id'	=>	'colors4',
				'tab_slug'		=>	'tab_color',
				'title'			=>	__( 'Buttonfarben', 'box' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie die Farbe f&uuml;r die Button ausw&auml;hlen.', 'bobox' ),
			),
			array(
				'section_id'	=>	'colors3',
				'tab_slug'		=>	'tab_color',
				'title'			=>	__( 'Hintergrundfarben', 'box' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie Hintergrundfarben ausw&auml;hlen.', 'bobox' ),
			),
			array(
				'section_id'	=>	'colors5',
				'tab_slug'		=>	'tab_color',
				'title'			=>	__( 'Hintergrundbilder', 'box' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie Hintergrundbilder für die komplette Seite hochladen.', 'bobox' ),
			),
			array(
				'section_id'	=>	'homeSl',	
				'tab_slug'		=>	'tab_home',
				'title'			=>	__( 'Slogans für die Startseiten', 'bobox' ),
				'description'	=>	__( 'Hier können Sie optional die Slogans/Headlines für die Startseiten (Template: Startseite-1, Startseite-2, Startseite-3) eintragen.', 'bobox' ),
								
			),
			array(
				'section_id'	=>	'home1',	
				'tab_slug'		=>	'tab_home',
				'title'			=>	__( 'Slider auf den Startseiten', 'bobox' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie die Einstellungen f&uuml;r die Slider auf der Startseite (Template: Startseite-1, Startseite-2, Startseite-3) machen', 'bobox' ),	
			),
			array(
				'section_id'	=>	'homeS',	
				'tab_slug'		=>	'tab_home',
				'title'			=>	__( 'Bilder für die Startseite-2', 'bobox' ),
				'description'	=>	__( 'Hier können Sie beliebig viele Bilder für den Slider (Template: Startseite-2) hochladen', 'bobox' ),
								
			),
			array(
				'section_id'	=>	'homeS2',	
				'tab_slug'		=>	'tab_home',
				'title'			=>	__( 'Bilder für die Startseite-3', 'bobox' ),
				'description'	=>	__( 'Hier können Sie beliebig viele Bilder für den Slider (Template: Startseite-3) hochladen', 'bobox' ),
								
			),
			array(
				'section_id'	=>	'homeEXS',	
				'tab_slug'		=>	'tab_home_custom',
				'title'			=>	__( 'Externer Slider', 'bobox' ),
				'description'	=>	__( 'Hier können Sie einen Slider-Shortcode eintragen, wenn Sie ein zusätzliches Slider-Plugin nutzen und einen Slider auf der Startseite einbinden möchten.', 'bobox' ),
								
			),
			array(
				'section_id'	=>	'homeI',	
				'tab_slug'		=>	'tab_home_custom',
				'title'			=>	__( 'Individuelle Startseite', 'bobox' ),
				'description'	=>	__( 'Hier können Sie eine individuelle Startseite zusammenstellen. Es können insgesamt zehn Abschnitte aus folgenden Elementen aufgebaut werden: Slider mit ausgesuchten Immobilien, Karussell mit allen Immobilien, Slider mit Bildern, Slogans, Textbereich, Infoboxen, Trennlinien oder einen Slider via Shortcode (wenn ein zusätzliches Slider-Plugin genutzt wird)', 'bobox' ),
								
			),
			array(
				'section_id'	=>	'homeB',	
				'tab_slug'		=>	'tab_home2',
				'title'			=>	__( 'Infoboxen anzeigen?', 'bobox' ),
				'description'	=>	__( 'Wählen Sie hier aus, ob die Infoboxen auf den Startseiten angezeigt werden sollen.', 'bobox' ),
				),
				
			array(
				'section_id'	=>	'home2',	
				'tab_slug'		=>	'tab_home2',
				'repeatable'	=> 'true',
				'title'			=>	__( 'Infoboxen erstellen', 'bobox' ),
				'description'	=>	__( 'Um eine weitere Box zu erstellen, klicken Sie auf das Pluszeichen rechts.', 'bobox' ),
								
			),
			
			array(
				'section_id'	=>	'services',	
				'tab_slug'		=>	'tab_serv',
				'title'			=>	__( 'Leistungen', 'bobox' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie einstellen, in welcher Reihenfolge die Leistungen gelistet werden sollen (Template: Leistungen).', 'bobox' ),
			),
			array(
				'section_id'	=>	'blog',	
				'tab_slug'		=>	'tab_blog',
				'title'			=>	__( 'Einstellungen f&uuml;r die Blogseiten', 'bobox' ),
				'description'	=>	__( 'Hier können verschiedene Einstellungen für die Blogseiten (News/Aktuelles) vorgenommen werden.', 'bobox' ),
			),
			array(
				'section_id'	=>	'contact1',	
				'tab_slug'		=>	'tab_contact',
				'title'			=>	__( 'Button', 'bobox' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie Einstellungen f&uuml;r die verschiedenen Button vornehmen', 'bobox' ),
			),
			array(
				'section_id'	=>	'contact2',	
				'tab_slug'		=>	'tab_contact',
				'title'			=>	__( 'Kontaktformular', 'bobox' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie Einstellungen f&uuml;r das interne Kontaktformular vornehmen. (Template: Kontaktformular). Wenn Sie zus&auml;tzliche Formulare einrichten m&ouml;chten, muss das empfohlene Plugin: Contactform 7 <a href="'.  home_url()  . '/wp-admin/themes.php?page=tgmpa-install-plugins">installiert und aktiviert sein</a>.', 'bobox' ),
					
			),
			array(
				'section_id'	=>	'contact3',	
				'tab_slug'		=>	'tab_contact',
				'title'			=>	__( 'Anfragen', 'bobox' ),
				'description'	=>	__( 'Wenn Sie die Anfragen über das interne Kontaktformular plus Widerrufsbelehrung nutzen möchten, nehmen Sie hier die Einstellungen dazu vor. Zuerst muss auch eine neue Seite mit dem Template "Widerrufsbelehrung" erstellt werden, um den Link unten in das Feld "URL der Widerrufsbelehrung" einzutragen. 
<br /><br />
Nach erfolgter Anfrage wird eine automatische Mail* inklusive Aufforderung zur Zustimmung zur sofortigen Tätigkeit versendet. Wenn Sie diese Mail nicht automatisch, sondern lieber manuell nach Sichtung der Anfrage versenden möchten, können Sie dies unten entsprechend einstellen. <br /><br />
Den Text zur Widerrufsbelehrung (Datei: widerrufsbelehrung.php) und den Inhalt der automatischen Mail (Datei: wrmail.php) können Sie falls erforderlich direkt in WordPress (Design/Editor) oder lokal mit einem Texteditor bearbeiten. 
<br /><br />Sämtliche Textvorlagen entsprechen den Vorgaben lt. <a href="http://www.immobilienscout24.de/anbieten/gewerbliche-anbieter/lp/widerrufsbelehrung.html">immobilienscout24.de</a>. Eine Gewährleistung für Aktualität, Vollständigkeit und Richtigkeit kann selbstverständlich nicht gegeben werden.', 'bobox' ),
			),
			array(
				'section_id'	=>	'seo',	
				'tab_slug'		=>	'tab_seo',
				'title'			=>	__( 'SEO', 'bobox' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie die Standard Meta-Tags f&uuml;r alle Seiten eintragen. Die Angaben k&ouml;nnen auf jeder einzelnen Seite individuell &uuml;berschrieben werden (unbedingt empfohlen).', 'bobox' ),
						
			),
			array(
				'section_id'	=>	'map',	
				'tab_slug'		=>	'tab_map',
				'title'			=>	__( 'Google Map', 'bobox' ),
				'description'	=>	__( 'Hier k&ouml;nnen Sie Ihren Standort auf Google Maps festlegen. Die Karte k&ouml;nnen Sie anschlie&szlig;end via Shortcode [google-map] im Content oder in einer Sidebar (per Text-Widget) einbinden.', 'bobox' ),
						
			)
			);
	         


// ======================= fields 


// ======================= basis 
  
$this->addSettingFields(
			'basis1',
			array(	
				'field_id'	=>	'bo_logo_image',
				'type'	=>	'image',
				'attributes_to_store' => array('alt'),
				'title'	=>	__( 'Website Logo', 'bobox' ),
				
	));
	
$this->addSettingFields(
			'basis2',
	array(	
				'field_id'	=>	'logotitle',
				'type'	=>	'text',
				'title'	=>	__( 'Website Titel', 'bobox' ),
				'attributes'	=>	array(
					'size'	=>	60,
				),
	),
	array(	
				'field_id'	=>	'logosubtitle',
				'type'	=>	'text',
				'title'	=>	__( 'Website Untertitel', 'bobox' ),
				'attributes'	=>	array(
					'size'	=>	60,
				),
	));
	

$this->addSettingFields(
			'basis3',
			array(	
				'field_id'	=>	'bo_favicon',
				'type'	=>	'image',
				'title'	=>	__( 'Favicon (16x16px)', 'bobox' ),),
		array(	
				'field_id'	=>	'bo_touch_icon_144',
				'type'	=>	'image',
				'title'	=>	__( 'Touch Icon - iPad3 Retina Display (144x144px)', 'bobox' ),),
		array(	
				'field_id'	=>	'bo_touch_icon_114',
				'type'	=>	'image',
				'title'	=>	__( 'Touch Icon - iPhone Retina Display (114x114px)', 'bobox' ),),
		array(	
				'field_id'	=>	'bo_touch_icon_72',
				'type'	=>	'image',
				'title'	=>	__( 'Touch Icon - iPad1 und iPad2 (72x72px)', 'bobox' ),),
		array(	
				'field_id'	=>	'bo_touch_icon_57',
				'type'	=>	'image',
				'title'	=>	__( 'Touch Icon - iPhone, iPod Touch, Android 2.1+ (57x57px)', 'bobox') 
			));
	

$this->addSettingFields(
			'basis4',
			array(	
				'field_id'	=>	'bo_currency',
				'type'	=>	'text',
				'title'	=>	__( 'Währungskürzel', 'bobox' ),
				
	));
	
// ======================= sm

$this->addSettingFields(
			'social',
			array(	
				'field_id'	=>	'bo_social_google',
				'title'	=>	__( 'Google', 'bobox' ),
				'type'	=>	'text',
				),
			array(	
				'field_id'	=>	'bo_social_fb',
				'title'	=>	__( 'Facebook', 'bobox' ),
				'type'	=>	'text',
				),
			array(	
				'field_id'	=>	'bo_social_twitter',
				'title'	=>	__( 'Twitter', 'bobox' ),
				'type'	=>	'text',
				),
			array(	
				'field_id'	=>	'bo_social_linkedin',
				'title'	=>	__( 'Linkedin', 'bobox' ),
				'type'	=>	'text',
				),
			array(	
				'field_id'	=>	'bo_social_yt',
				'title'	=>	__( 'YouTube', 'bobox' ),
				'type'	=>	'text',
				),
			array(	
				'field_id'	=>	'bo_social_xing',
				'title'	=>	__( 'Xing', 'bobox' ),
				'type'	=>	'text',
				),
			array(	
				'field_id'	=>	'bo_social_rss',
				'title'	=>	__( 'RSS', 'bobox' ),
				'type'	=>	'text',
				),
			array(	
				'field_id'	=>	'bo_social_mail',
				'title'	=>	__( 'E-Mail', 'bobox' ),
				'type'	=>	'text',
				)	
								);  


// ======================= color
	
$this->addSettingFields(
			'colors',
			array(	
				'field_id'	=>	'logotitle_color',
				'title'	=>	__( 'Farbe des Website Titels', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#eeeeee',
				'description' => __( 'Standardfarbe ist #eeeeee', 'bobox' ),
				),
				array(	
				'field_id'	=>	'logosubtitle_color',
				'title'	=>	__( 'Farbe des Website Untertitels', 'bobox' ),
				'type'	=>	'color',
				'description' => __( 'Standardfarbe ist #eeeeee', 'bobox' ),
				),
				array(	
				'field_id'	=>	'headline_color',
				'title'	=>	__( 'Farbe der Headlines (h1)', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#454545',
				'description' => __( 'Standardfarbe ist #454545', 'bobox' ),
				),
				array(	
				'field_id'	=>	'headline2_color',
				'title'	=>	__( 'Farbe der Headlines (h2)', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#454545',
				'description' => __( 'Standardfarbe ist #454545', 'bobox' ),
				),
				array(	
				'field_id'	=>	'headline3_color',
				'title'	=>	__( 'Farbe der Headlines (h3)', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#454545',
				'description' => __( 'Standardfarbe ist #454545', 'bobox' ),
				),
				array(	
				'field_id'	=>	'bo_text_color',
				'title'	=>	__( 'Allgemeine Textfarbe', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#454545',
				'description' => __( 'Standardfarbe ist #454545', 'bobox' ),
				),
				array(	
				'field_id'	=>	'bo_link_color',
				'title'	=>	__( 'Farbe der Links', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#00A8BF',
				'description' => __( 'Standardfarbe ist #00A8BF', 'bobox' ),
				));  
				
				
			
$this->addSettingFields(
			'colors2',
			array(	
				'field_id'	=>	'bo_menu_border_color',
				'title'	=>	__( 'Rahmenfarbe des Menüs', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#454545',
				'description' => __( 'Standardfarbe ist #454545', 'bobox' ),
				),
			array(	
				'field_id'	=>	'bo_menu_bg_color',
				'title'	=>	__( 'Hintergrundfarbe des aktiven Elements', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#454545',
				'description' => __( 'Standardfarbe ist #454545', 'bobox' ),
				),
			array(	
				'field_id'	=>	'bo_menu_color',
				'title'	=>	__( 'Textfarbe im Hauptmenü', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#454545',
				'description' => __( 'Standardfarbe ist #454545', 'bobox' ),
				),
				array(	
				'field_id'	=>	'bo_current_menu_color',
				'title'	=>	__( 'Textfarbe des aktiven Elements', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#ffffff',
				'description' => __( 'Standardfarbe ist weiß.', 'bobox' ),
				),
				array(	
				'field_id'	=>	'bo_submenu_bg_color',
				'title'	=>	__( 'Hintergrundfarbe des Submenüs', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#ffffff',
				'description' => __( 'Standardfarbe ist #ffffff', 'bobox' ),
				),
				array(	
				'field_id'	=>	'bo_submenu_color',
				'title'	=>	__( 'Textfarbe des Submenüs', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#454545',
				'description' => __( 'Standardfarbe ist #454545', 'bobox' ),
				));  

$this->addSettingFields(
			'colors6',
			array(	
				'field_id'	=>	'bo_topmenu_color',
				'title'	=>	__( 'Textfarbe des Topmenüs', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#ebebeb',
				'description' => __( 'Standardfarbe ist #ebebeb', 'bobox' ),
				),
			array(	
				'field_id'	=>	'bo_topmenu_hover_color',
				'title'	=>	__( 'Textfarbe des Topmenüs (Mouseover)', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#fffff',
				'description' => __( 'Standardfarbe ist #ffffff', 'bobox' ),
				)
			);  


$this->addSettingFields(
			'colors4',
			array(	
				'field_id'	=>	'bo_button_bg_color',
				'title'	=>	__( 'Hintergrundfarbe Button', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#00A8BF',
				'description' => 'Hintergrundfarbe für den Button. Standardfarbe ist #00A8BF'
				),
				array(	
				'field_id'	=>	'bo_button_bg_hcolor',
				'title'	=>	__( 'Hintergrundfarbe Button (Mouseover)', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#454545;',
				'description' => 'Hintergrundfarbe für den Button. Standardfarbe ist #454545'
				),
				array(	
				'field_id'	=>	'bo_button_color',
				'title'	=>	__( 'Textfarbe der Button', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#ffffff',
				'description' => __( 'Farbe für den Text in den Button. Standardfarbe ist #ffffff', 'bobox' ),
				));  
				
$this->addSettingFields(
			'colors3',
			array(
			'field_id' => 'bo_headerbg_color',
			'title'	=>	__( 'Hintergrundfarbe Header', 'bobox' ),
			'type'	=>	'color',
			'default'	=>	'#454545',
			'description' => __( 'Standardfarbe ist #454545', 'bobox' ),),
			
			array(
			'field_id' => 'bo_footer_color',
			'title'	=>	__( 'Rahmenfarbe Footer', 'bobox' ),
			'type'	=>	'color',
			'default'	=>	'#454545',
			'description' => __( 'Standardfarbe ist #454545', 'bobox' ),),
			array(
			'field_id' => 'bo_sidebar_title',
			'title'	=>	__( 'Hintergrund Sidebar Titel', 'bobox' ),
			'type'	=>	'color',
			'default'	=>	'#00A8BF',
			'description' => __( 'Standardfarbe ist #00A8BF', 'bobox' ),),
					
			array(	
				'field_id'	=>	'bo_icon_color',
				'title'	=>	__( 'Icons', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#999999',
			'description' => __( 'Standardfarbe ist #999999', 'bobox' ),	
				),
				array(	
				'field_id'	=>	'bo_icon_hover_color',
				'title'	=>	__( 'Icons (Mouseover)', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#00A8BF',
				'description' => __( 'Standardfarbe ist #00A8BF', 'bobox' ),
				),
				array(	
				'field_id'	=>	'bo_sm_color',
				'title'	=>	__( 'Social Media Icons', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#999999',
				'description' => __( 'Standardfarbe ist #999999', 'bobox' ),
				),
				array(	
				'field_id'	=>	'bo_sm_hover_color',
				'title'	=>	__( 'Social Media Icons Iconfarbe (Mouseover)', 'bobox' ),
				'type'	=>	'color',
				'default'	=>	'#00A8BF',
				'description' => __( 'Standardfarbe ist #00A8BF', 'bobox' ),
				)
				);  													
  


$this->addSettingFields(
'colors5',

				array(
				'field_id'	=>	'bo_body_img',
				'title'	=>	__( 'Hintergrundbild', 'bobox' ),
				'type'	=>	'image',
				'description' => __( 'Hier k&ouml;nnen Sie ein eigenes Hintergrundbild hochladen', 'bobox' ),
				),
				array(
				'field_id'	=>	'bo_body_img_repeat',
				'title'	=>	__( 'Bild wiederholen?', 'bobox' ),
				'type'	=>	'select',
				'default' =>  'no-repeat',
				'label'	=>	array(
					'no-repeat' => 'Nein',
					'repeat' => 'Ja',
					),
				'description' => __( 'Hier k&ouml;nnen Sie ausw&auml;hlen, ob sich das Hintergrundbild wiederholen oder über die gesamte Seite gestreckt werden soll.', 'bobox' ),
				),
				array(	
				'field_id'	=>	'bo_body_bgcolor',
				'title'	=>	__( 'Hintergrundfarbe Seite', 'bobox' ),
				'type'	=>	'color',
				'default' => '#ffffff',
				'description' => __( 'Hier kann eine Farbe für die komplette Seite ausgewählt werden.', 'bobox' ),
				),
				array(	
				'field_id'	=>	'bo_page_color',
				'title'	=>	__( 'Hintergrundfarbe Content', 'bobox' ),
				'type'	=>	'color',
				'default' => '#ffffff',
				'description' => __( 'Hier kann eine Farbe für den Contentbereich ausgewählt werden. Wichtig z.B., wenn das Hintergrundbild dunkel ist und über die ganze Seite eingebunden wird.', 'bobox' ),
				),
array(	
				'field_id'	=>	'bo_page_trans',
				'title'	=>	__( 'Transparenz des Seitenhintergrunds', 'bobox' ),
				'type'	=>	'text',
'attributes'	=>	array(
					'size'	=>	10,
				),
				'default' => '0.1',
				'description' => __( 'Hier kann ein Wert für die Transparenz (0.1 bis 1) im Contentbereich ausgewählt werden.', 'bobox' ),
				)
);




// ======================= slider
  
$this->addSettingFields(
			'home1',
			array(	
				'field_id'	=>	'slider_effect',
				'title'	=>	__( 'Slidereffekt', 'bobox' ),
				'type'	=>	'select',
				'default'	=>	'fade',
				'label'	=>	array(
				'none'  => 'None',
				'all'  => 'Alle - Zufällig',
					'fade' => 'Fade', 
					'fadeOut' => 'FadeOut',
					'tileSlide' => 'tileSlide', 
					'tileBlind' => 'tileBlind',
					'shuffle'  => 'shuffle', 
					'flipVert' => 'Flip Vertikal',
					'flipHorz' => 'Flip Horizontal',
					'scrollHorz'  => 'scrollHorz',
					'scrollVert' => 'scrollVert'),
								),
			array(	
				'field_id'	=>	'slider_speed',
				'title'	=>	__( 'Wechsel-Geschwindigkeit (in Millisekunden)', 'bobox' ),
				'type'	=>	'text',
				'default'	=>	'500',
				'attributes'	=>	array(
					'size'	=>	10,
				),
					),		
			array(	
				'field_id'	=>	'slider_pause',
				'title'	=>	__( 'Anzeigedauer (in Millisekunden)', 'bobox' ),
				'type'	=>	'text',
				'default'	=>	'3500',
				'attributes'	=>	array(
					'size'	=>	10,
				),
					)									
			);    
 
 
 
 // ========================= slider images 
 
 $this->addSettingFields(
			'homeS',
 array(	
				'field_id'	=>	'home_slider',
				'title'	=>	__( 'Bilder f&uuml;r den Slider (Startseite-2)', 'bobox' ),
				'type'	=>	'image',
				'repeatable' => true,
				'sortable' => true,
				'attributes_to_store' => array(	'alt', 'width', 'height', 'caption','link'),
				'attributes'	=> array(
					'preview'	=> array(
						'style'	=> 'max-width: 120px;'
					),
				),	
				'description'	=> __( 'Hier werden die Bilder für die Startseite (Template: Startseite-2) hochgeladen. Die Bilder sollten mind. 600px breit sein, die Höhe ist variabel und kann der Höhe der Infoboxen angepasst werden. In der <a href="'.  home_url()  . '/wp-admin/upload.php">Mediathek</a> können Sie Ihre Bilder individuell schneiden oder skalieren.  Um weitere Bilder einzubinden, klicken Sie auf das Pluszeichen rechts. Um Bilder zu l&ouml;schen, klicken Sie auf das Minuszeichen.<br /> Die Reihenfolge der Bilder k&ouml;nnen Sie &auml;ndern, indem Sie einzelne Bl&ouml;cke via Drag&Drop verschieben.', 'bobox' ),
			
	));
	

$this->addSettingFields(
			'homeS2',
 array(	
				'field_id'	=>	'home_slider2',
				'title'	=>	__( 'Bilder f&uuml;r den Slider (Startseite-3)', 'bobox' ),
				'type'	=>	'image',
				'repeatable' => true,
				'sortable' => true,
				'attributes_to_store' => array(	'alt', 'width', 'height', 'caption'),
				'attributes'	=> array(
					'preview'	=> array(
						'style'	=> 'max-width: 120px;'
					),
				),	
				'description'	=> __( 'Hier werden die Bilder für die Startseite (Template: Startseite-3) hochgeladen. Die Bilder sollten mind. 980px breit sein, die Höhe ist variabel. In der <a href="'.  home_url()  . '/wp-admin/upload.php">Mediathek</a> können Sie Ihre Bilder individuell schneiden oder skalieren.  Um weitere Bilder einzubinden, klicken Sie auf das Pluszeichen rechts. Um Bilder zu l&ouml;schen, klicken Sie auf das Minuszeichen.<br /> Die Reihenfolge der Bilder k&ouml;nnen Sie &auml;ndern, indem Sie einzelne Bl&ouml;cke via Drag&Drop verschieben.', 'bobox' ),
			
	));	
 
 
 
 // ========================= slogans 
		 
 $this->addSettingFields(
 	'homeSl',
			array(	
				'field_id'	=>	'bo_slogan1',
				'title'	=>	__( 'Slogan/Headline 1', 'bobox' ),
				'type'	=>	'text',
				'attributes'	=>	array(
					'size'	=>	80,
				),
					),		
			array(	
				'field_id'	=>	'bo_slogan2',
				'title'	=>	__( 'Slogan/Headline 2', 'bobox' ),
				'type'	=>	'text',
				'attributes'	=>	array(
					'size'	=>	80,
				),
					)							
			);    
			
			
// ========================= custom homepage slider shortcode


 $this->addSettingFields(
 	'homeEXS',
			array(	
				'field_id'	=>	'bo_ex_slider_plugin',
				'title'	=>	__( 'Slider Shortcode', 'bobox' ),
				'type'	=>	'text',
				'attributes'	=>	array(
					'size'	=>	80,
				),
					)						
			);    

// ========================= custom homepage section
		 
 $this->addSettingFields(
 	'homeI',
			array(	
				'field_id'	=>	'bo_home_part1',
				'title'	=>	__( 'Abschnitt 1', 'bobox' ),
				'type'	=>	'select',
				'label'	=>	array(
				'' => '',
				'slogan1'  => 'Slogan 1',
				'slogan2'  => 'Slogan 2',
				'home-featured-objects' => 'Immobilien-Slider', 
				'home-images-full' => 'Bilder-Slider (breit)',
				'list_properties_home' => 'Immobilien-Karussel', 
				'home-images-short' => 'Bilder-Slider und Infoboxen vertikal',
				'infobox-horz' => 'Infoboxen horizontal',
				'home-content' => 'Content und Sidebar',
				'separator' => 'Trennlinie',
				'ex-slider-code' => 'Slider via Shortcode',
				),
					),		
			array(	
				'field_id'	=>	'bo_home_part2',
				'title'	=>	__( 'Abschnitt 2', 'bobox' ),
				'type'	=>	'select',
				'label'	=>	array(
				'' => '',
				'slogan1'  => 'Slogan 1',
				'slogan2'  => 'Slogan 2',
				'home-featured-objects' => 'Immobilien-Slider', 
				'home-images-full' => 'Bilder-Slider',
				'list_properties_home' => 'Immobilien-Karussel', 
				'home-images-short' => 'Bilder-Slider und Infoboxen vertikal',
				'infobox-horz' => 'Infoboxen',
				'home-content' => 'Content und Sidebar',
				'separator' => 'Trennlinie',
				),
					),		
				array(	
				'field_id'	=>	'bo_home_part3',
				'title'	=>	__( 'Abschnitt 3', 'bobox' ),
				'type'	=>	'select',
				'label'	=>	array(
				'' => '',
				'slogan1'  => 'Slogan 1',
				'slogan2'  => 'Slogan 2',
				'home-featured-objects' => 'Immobilien-Slider', 
				'list_properties_home' => 'Immobilien-Karussel', 
				'home-images-short' => 'Bilder-Slider und Infoboxen vertikal',
				'infobox-horz' => 'Infoboxen',
				'home-content' => 'Content und Sidebar',
				'separator' => 'Trennlinie',
				),
					),		
				array(	
				'field_id'	=>	'bo_home_part4',
				'title'	=>	__( 'Abschnitt 4', 'bobox' ),
				'type'	=>	'select',
				'label'	=>	array(
				'' => '',
				'slogan1'  => 'Slogan 1',
				'slogan2'  => 'Slogan 2',
				'home-featured-objects' => 'Immobilien-Slider', 
				'home-images-full' => 'Bilder-Slider',
				'list_properties_home' => 'Immobilien-Karussel', 
				'home-images-short' => 'Bilder-Slider und Infoboxen vertikal',
				'infobox-horz' => 'Infoboxen',
				'home-content' => 'Content und Sidebar',
				'separator' => 'Trennlinie',
				),
				),
					array(	
				'field_id'	=>	'bo_home_part5',
				'title'	=>	__( 'Abschnitt 5', 'bobox' ),
				'type'	=>	'select',
				'label'	=>	array(
				'' => '',
				'slogan1'  => 'Slogan 1',
				'slogan2'  => 'Slogan 2',
				'home-featured-objects' => 'Immobilien-Slider', 
				'home-images-full' => 'Bilder-Slider',
				'list_properties_home' => 'Immobilien-Karussel', 
				'home-images-short' => 'Bilder-Slider und Infoboxen vertikal',
				'infobox-horz' => 'Infoboxen',
				'home-content' => 'Content und Sidebar',
				'separator' => 'Trennlinie',
				),
					),
					array(	
				'field_id'	=>	'bo_home_part6',
				'title'	=>	__( 'Abschnitt 6', 'bobox' ),
				'type'	=>	'select',
				'label'	=>	array(
				'' => '',
				'slogan1'  => 'Slogan 1',
				'slogan2'  => 'Slogan 2',
				'home-featured-objects' => 'Immobilien-Slider', 
				'home-images-full' => 'Bilder-Slider',
				'list_properties_home' => 'Immobilien-Karussel', 
				'home-images-short' => 'Bilder-Slider und Infoboxen vertikal',
				'infobox-horz' => 'Infoboxen',
				'home-content' => 'Content und Sidebar',
				'separator' => 'Trennlinie',
				),
				),
					array(	
				'field_id'	=>	'bo_home_part7',
				'title'	=>	__( 'Abschnitt 7', 'bobox' ),
				'type'	=>	'select',
				'label'	=>	array(
				'' => '',
				'slogan1'  => 'Slogan 1',
				'slogan2'  => 'Slogan 2',
				'home-featured-objects' => 'Immobilien-Slider', 
				'home-images-full' => 'Bilder-Slider',
				'list_properties_home' => 'Immobilien-Karussel', 
				'home-images-short' => 'Bilder-Slider und Infoboxen vertikal',
				'infobox-horz' => 'Infoboxen',
				'home-content' => 'Content und Sidebar',
				'separator' => 'Trennlinie',
				),
					),
					array(	
				'field_id'	=>	'bo_home_part8',
				'title'	=>	__( 'Abschnitt 8', 'bobox' ),
				'type'	=>	'select',
				'label'	=>	array(
				'' => '',
				'slogan1'  => 'Slogan 1',
				'slogan2'  => 'Slogan 2',
				'home-featured-objects' => 'Immobilien-Slider', 
				'home-images-full' => 'Bilder-Slider',
				'list_properties_home' => 'Immobilien-Karussel', 
				'home-images-short' => 'Bilder-Slider und Infoboxen vertikal',
				'infobox-horz' => 'Infoboxen',
				'home-content' => 'Content und Sidebar',
				'separator' => 'Trennlinie',
				),
					),	
					array(	
				'field_id'	=>	'bo_home_part9',
				'title'	=>	__( 'Abschnitt 9', 'bobox' ),
				'type'	=>	'select',
				'label'	=>	array(
				'' => '',
				'slogan1'  => 'Slogan 1',
				'slogan2'  => 'Slogan 2',
				'home-featured-objects' => 'Immobilien-Slider', 
				'home-images-full' => 'Bilder-Slider',
				'list_properties_home' => 'Immobilien-Karussel', 
				'home-images-short' => 'Bilder-Slider und Infoboxen vertikal',
				'infobox-horz' => 'Infoboxen',
				'home-content' => 'Content und Sidebar',
				'separator' => 'Trennlinie',
				),
					),
					array(	
				'field_id'	=>	'bo_home_part10',
				'title'	=>	__( 'Abschnitt 10', 'bobox' ),
				'type'	=>	'select',
				'label'	=>	array(
				'' => '',
				'slogan1'  => 'Slogan 1',
				'slogan2'  => 'Slogan 2',
				'home-featured-objects' => 'Immobilien-Slider', 
				'home-images-full' => 'Bilder-Slider',
				'list_properties_home' => 'Immobilien-Karussel', 
				'home-images-short' => 'Bilder-Slider und Infoboxen vertikal',
				'infobox-horz' => 'Infoboxen',
				'home-content' => 'Content und Sidebar',
				'separator' => 'Trennlinie',
				),
					)																		
			);    			
 
 
 

 // ========================= repeatable info box 
 
 
 $this->addSettingFields(
'homeB', 
array(
			'field_id'	=>	'bo_show_box',
			'type'	=>	'select',
			'title'	=>	__( 'Info-Boxen auf der Startseite einbinden?', 'bobox' ),
			'default' => 'yes',
			'label'	=>	array( 
					'yes'	=>	'Ja',		
					'no'	=>	'Nein',	
						
				),
			));



$this->addSettingFields(
			'home2',
			array(	
				'field_id'	=>	'bo_box_headline',
				'title'	=>	__( 'Überschrift f&uuml;r diese Infobox', 'bobox' ),
				'type'	=>	'text',
				'attributes'	=>	array(
					'size'	=>	40,
				),
				),
			array(	
				'field_id'	=>	'bo_box_icon',
				'title'	=>	__( 'Icon für diese Box', 'bobox' ),
				'type'	=>	'text',
				'description' => __( 'Tragen Sie hier, wenn gewünscht, einen Icon Shortcode ein. Infos dazu und alle verfügbaren Icons finden Sie <a href="'.  home_url()  . '/wp-admin/themes.php?page=theme_options&tab=tab_sc">hier &raquo;</a>. ', 'bobox' ),
				'attributes'	=>	array(
					'size'	=>	40,
				),
				),			
			array(	
				'field_id'	=>	'bo_box_text',
				'title'	=>	__( 'Text f&uuml;r diese Infobox', 'bobox' ),
				'type'	=>	'textarea',
				),			
			array(	
				'field_id'	=>	'bo_box_link',
				'title'	=>	__( 'URL der verlinkten Seite', 'bobox' ),
				'type'	=>	'text',
				'description' => __( 'Tragen Sie hier die URL der Seite ein, die über den Button in der Box erreicht werden soll.', 'bobox' ),
				'attributes'	=>	array(
					'size'	=>	40,
				),
							),
			array(	
				'field_id'	=>	'bo_box_link_text',
				'title'	=>	__( 'Beschriftung des Button in der Box', 'bobox' ),
				'type'	=>	'text',
				'default' => 'Hier erfahren Sie mehr &rarr;',
				'description' => __( 'Hier können Sie eine individuelle Beschriftung für den Button/Link eintragen. Standardmäßig wird "Hier erfahren Sie mehr &rarr;" genutzt.', 'bobox' ),	
				)							
			
					 );


				
				
// ======================= service

$this->addSettingFields(
			'services',
			array(	
				'field_id'	=>	'serv_post_order',
				'title'	=>	__( 'Reihenfolge', 'bobox' ),
				'type'	=>	'select',
				'default' => 'date',
				'label'	=>	array( 
					'title'	=>	'Alphabetisch',		
					'date'	=>	'Chronologisch',	
					'menu_order'	=>	'Seitenreihenfolge',	
					'rand'	=>	'Zuf&auml;llig',
					),					
				'description'	=> __( 'Die alphabetische Reihenfolge richtet sich nach dem Seitentitel. Die Seitenreihenfolge kann unter "Attribute" auf jeder Seite selbst festgelegt werden.', 'bobox' ),
				),
				array(	
				'field_id'	=>	'serv_post_sort',
				'title'	=>	__( 'Sortierung', 'bobox' ),
				'type'	=>	'select',
				'default' => 'DESC',
				'label'	=>	array( 
					'ASC'	=>	'Aufsteigend',		
					'DESC'	=>	'Absteigend',	
					)	
				),
				array(	
				'field_id'	=>	'bo_more_text',
				'title'	=>	__( 'Beschriftung des "Weiter-Links"', 'bobox' ),
				'type'	=>	'text',
				'default' => 'Hier mehr erfahren'
					));
				
		
  
 

// ========================  blog 

$this->addSettingFields(
			'blog',
			
			array(	
				'field_id'	=>	'bo_blog_headline',
				'type'	=>	'text',
				'attributes'	=>	array(
					'size'	=>	60,
				),
				'title'	=>	__( 'Überschrift f&uuml;r die Blogseite (index.php)', 'bobox' ),
				),
			array(	
				'field_id'	=>	'bo_show_categories',
				'title'	=>	__( 'Kategorien anzeigen?', 'bobox' ),
				'type'	=>	'select',
				'default' => 'no',
				'label'	=>	array( 
					'yes'	=>	'Ja',		
					'no'	=>	'Nein',	
					),					
				), 
				array(	
				'field_id'	=>	'bo_show_date',
				'title'	=>	__( 'Ver&ouml;ffentlichungsdatum anzeigen?', 'bobox' ),
				'type'	=>	'select',
				'default' => 'no',
				'label'	=>	array( 
					'yes'	=>	'Ja',		
					'no'	=>	'Nein',	
					),					
				), 
				array(	
				'field_id'	=>	'bo_show_author',
				'title'	=>	__( 'Autor anzeigen?', 'bobox' ),
				'type'	=>	'select',
				'default' => 'no',
				'label'	=>	array( 
					'yes'	=>	'Ja',		
					'no'	=>	'Nein',	
					),					
				), 
				array(	
				'field_id'	=>	'bo_show_tags',
				'title'	=>	__( 'Schlagw&ouml;rter anzeigen?', 'bobox' ),
				'type'	=>	'select',
				'default' => 'no',
				'label'	=>	array( 
					'yes'	=>	'Ja',		
					'no'	=>	'Nein',	
					),					
				)
				);





// ======================= contact


$this->addSettingFields(
			'contact1',
			array(
			'field_id'	=>	'bo_object_request_button_text',
			'type' => 'text',
			'title'	=>	__( 'Anfragebutton', 'bobox' ), 
			'default' => __( 'Anfrage für dieses Objekt senden', 'bobox' ), 
			'description' => __( 'Tragen Sie hier die Beschriftung für den Anfragebutton (Immobilien-Einzelseite) ein. Standardbeschriftung ist: Eine Anfrage zu diesem Objekt senden', 'bobox' ),
			),
			array(
			'field_id'	=>	'bo_contact_form_button',
			'type' => 'text',
			'title'	=>	__( 'Kontaktbutton', 'bobox' ), 
			'default' => __( 'Nachricht senden', 'bobox' ), 
			'description' => __( 'Tragen Sie hier die Beschriftung für den Kontaktbutton (Template: Kontaktformular) ein. ', 'bobox' ),
			),
			array(
			'field_id'	=>	'bo_object_list_url',
			'type' => 'text',
			'title'	=>	__( 'URL Immobilienübersicht', 'bobox' ), 
			'description' => __( 'Tragen Sie hier die URL der Immobilienübersicht (Template: Immobilienliste) ein. ', 'bobox' ),
			),
			array(
			'field_id'	=>	'bo_contact_page_url',
			'type' => 'text',
			'title'	=>	__( 'URL Kontaktseite', 'bobox' ), 
			'description' => __( 'Tragen Sie hier die URL der Kontaktseite (Template: Kontaktformular) ein. ', 'bobox' ),
			)

);




$this->addSettingFields(
			'contact2',
			array(	
				'field_id'	=>	'bo_formmail_address',
				'title'	=>	__( 'E-Mail Adresse des Empf&auml;ngers', 'bobox' ),
				'type'	=>	'text',
				'description'	=> __( 'Tragen Sie hier die Adresse des Empf&auml;ngers ein.', 'bobox' ),
				),
				array(	
				'field_id'	=>	'bo_formmail_subject',
				'title'	=>	__( 'Betreffzeile der verschickten Mail', 'bobox' ),
				'type'	=>	'text',
				),
				array(	
				'field_id'	=>	'bo_contact_response',
				'title'	=>	__( 'Antwortzeile nach dem Versand', 'bobox' ),
				'type'	=>	'text',
				'default' => __( 'Vielen Dank - wir werden Ihre Nachricht schnellstm&ouml;glich bearbeiten', 'bobox' ),
				'description'	=> __( 'Diese Zeile wird nach dem Versand einer Nachricht angezeigt.', 'bobox' ),
				'attributes'	=>	array(
					'size'	=>	60,
				),
				),
				array(	
				'field_id'	=>	'bo_contact_response_offer',
				'title'	=>	__( 'Antwortzeile nach dem Versand', 'bobox' ),
				'type'	=>	'text',
				'default' => __( 'Vielen Dank - wir werden Ihre Anfrage schnellstm&ouml;glich bearbeiten', 'bobox' ),
				'description'	=> __( 'Diese Zeile wird nach dem Versand einer Anfrage angezeigt.', 'bobox' ),
				'attributes'	=>	array(
					'size'	=>	60,
				),
				)
				);  
				
				
$this->addSettingFields(
			'contact3', 
			array(	
				'field_id'	=>	'bo_show_wr',
				'title'	=>	__( 'Checkbox zu Widerrufsbelehrung anzeigen?', 'bobox' ),
				'type'	=>	'select',
				'description'	=> __( 'Wählen Sie hier aus, ob die Checkbox zur Widerrufsbelehrung angezeigt werden soll.', 'bobox' ),
				'default' => 'yes',
				'label'	=>	array( 
					'yes'	=>	'Ja',		
					'no'	=>	'Nein',	
					),					
				),
				array(	
				'field_id'	=>	'bo_wr_page_url',
				'title'	=>	__( 'URL der Widerrufsbelehrung', 'bobox' ),
				'type'	=>	'text',
				'description'	=> __( 'Tragen Sie hier die URL der Widerrufsbelehrung (Template: Widerrufsbelehrung) ein.', 'bobox' ),
				),
				array(	
				'field_id'	=>	'bo_wr_address',
				'title'	=>	__( 'Adresse für die Widerrufsbelehrung', 'bobox' ),
				'type'	=>	'textarea',
				'description'	=> __( 'Tragen Sie hier Ihre vollständige Adresse plus Telefon/E-Mail-Adresse ein. Hier können Sie HTML-Tags, z.B. für Zeilenumbrüche nutzen.', 'bobox' ),
				),
			
			array(	
				'field_id'	=>	'bo_send_wrmail',
				'title'	=>	__( 'Automatische Antwortmail versenden?', 'bobox' ),
				'type'	=>	'select',
				'description'	=> __( 'Wählen Sie hier aus, ob nach einer Anfrage, eine automatische Antwortmail an den User geschickt werden soll. ', 'bobox' ),
				'default' => 'yes',
				'label'	=>	array( 
					'yes'	=>	'Ja',		
					'no'	=>	'Nein',	
					),					
				),
			array(	
				'field_id'	=>	'bo_wr_mailaddress',
				'title'	=>	__( 'Ihre Signatur', 'bobox' ),
				'type'	=>	'textarea',
				'description'	=> __( 'Tragen Sie hier Ihre Signatur für die automatische Antwortmail ein. Hier bitte keine HTML-Tags eintragen!', 'bobox' ),
				),
			
			array(	
				'field_id'	=>	'bo_imprint_url',
				'title'	=>	__( 'URL Ihres Impressums', 'bobox' ),
				'type'	=>	'text',
				'description'	=> __( 'Tragen Sie hier die URL Ihres Impressums ein.', 'bobox' ),
				)
			
			
			
			);				
				
  

// ======================= seo

$this->addSettingFields(
			'seo',
				array(	
				'field_id'	=>	'bo_theme_seo',
				'title'	=>	__( 'Interne SEO Funktion nutzen?', 'bobox' ),
				'type'	=>	'select',
				'default' => 'no',
				'label'	=>	array( 
					'yes'	=>	'Ja',		
					'no'	=>	'Nein',	
				),		
				'description'	=>	'Setzen Sie die Auswahl auf "Ja", wenn Sie die interne Funktion nutzen und kein zusätzliches SEO-Plugin einsetzen möchten.',
				),
				array(	
				'field_id'	=>	'bo_general_meta_title',
				'title'	=>	__( 'Meta Tag: Title', 'bobox' ),
				'type'	=>	'text',
				'attributes'	=>	array(
					'size'	=>	60,
				),
				),
				array(	
				'field_id'	=>	'bo_general_meta_description',
				'title'	=>	__( 'Meta-Tag: Description', 'bobox' ),
				'type'	=>	'textarea',
				'description'	=>	'Die Beschreibung sollte nicht mehr als 156 Zeichen haben.',
				),
				array(	
				'field_id'	=>	'bo_general_meta_keywords',
				'title'	=>	__( 'Meta-Tag: Keywords', 'bobox' ),
				'type'	=>	'text',
				'attributes'	=>	array(
					'size'	=>	60,
				),
				'description'	=>	'Trennen Sie die einzelnen Keywords mit einem Komma',
				)
				);  				
  			
  

// ======================= map

$this->addSettingFields(
			'map',
		array(	
				'field_id'	=>	'bo_google_map',
				'title'	=>	__( 'Ihre Standortdaten', 'bobox' ),
				'type'	=>	'geometry',
				'description'	=>	__( 'Sie k&ouml;nnen Ihren Standort auf der Karte ausw&auml;hlen, indem Sie den Marker per Doppelklick setzen', 'bobox' ),
				'default'	=>	array(
					'latitude'	=>	50.93444522049262,
					'longitude'	=>	6.950569152832031,
					'zoom' 		=> 8,
				),
				)
				);  			  
 
 
  
    }
 
 
 
 	public function content_theme_options_tab_sc( $sContent ) {	// content_ + {page slug}
		
		$sContent ='<h2>Google Map</h2>'
		.'<div class="tab-content" style="margin-bottom:80px;">'
		.'<code>[google-map]</code>'
		.'<p class="admin-page-framework-fields-description"><span class="description">So k&ouml;nnen Sie die Karte mit Ihrem Standort im Content oder in einer Sidebar einbinden</span></p>'
		.'<code>[box icon="" iconsize="" title="" buttonlink="" buttontext=""]</code>'
		.'<code>[box icon="icon-smile" iconsize="24px" title="&Uuml;berschrift" buttonlink="http//www.example.com" buttontext="Hier klicken"]</code>'
		.'<p class=""><span class="description">Tragen Sie hier optional einen Icon-Namen (siehe unten), eine &Uuml;berschrift, einen Buttontext und einen Link ein.</span></p>'
		.'<div class="separator"><hr /></div>'
		.'<h2>Accordion</h2>'
		.'<code>[accordion][item title=""]...[/item][/accordion]</code><br />'
		.'<code>[accordion][item title="Headline"]Infotext[/item][item title="Headline2"]Infotext2[/item][/accordion]</code>'
		.'<p class="admin-page-framework-fields-description"><span class="description">Es kann ein Akkordion mit beliebig vielen Elementen gestaltet werden.</span></p>'
		.'<div class="separator"><hr /></div>'
		.'<h2>Tabs</h2>'
		.'<code>[tabbox][tabarea][tab id="1" title="Tab1"][/tabarea][panelarea][panel id="1"] ... [/panel][/panelarea][/tabbox]</code><br />'
		.'<code>[tabbox][tabarea][tab id="1" title="Tab1"][tab id="2" title="Tab2"][/tabarea][panelarea][panel id="1"] Inhalt unter Tab1 [/panel][panel id="2"] Inhalt unter Tab2 [/panel][/panelarea][/tabbox]</code>'
		.'<p class="admin-page-framework-fields-description"><span class="description">Es kann eine Box mit beliebig vielen Tabs gestaltet werden.</span></p>'
		.'<div class="separator"><hr /></div>'
		.'<h2>Icons</h2>'
		.'<code>[icon size="" name="" ]</code>'
		.'<code>[icon size="24px" name="icon-phone-squared" ]</code>'
		.'<p class="admin-page-framework-fields-description"><span class="description">Tragen Sie die gew&uuml;nschte Gr&ouml;&szlig;e in px und den Namen des Icons entsprechend ein.</span></p>'
		.'<h4>In diesem Theme verf&uuml;gbare Icons</h4>'
.'<table>
<tr>
<td><i class="icon-chat-alt"></i>  </td><td>    icon-chat-alt  </td>
<td><i class="icon-search"></i> </td><td>icon-search</td>
<td><i class="icon-mail"></i> </td><td>icon-mail</td>
<td><i class="icon-mail-alt"></i> </td><td>icon-mail-alt</td>
</tr><tr>
<td><i class="icon-heart"></i> </td><td>icon-heart</td>
<td><i class="icon-heart-empty"></i> </td><td>icon-heart-empty</td>
<td><i class="icon-star"></i> </td><td>icon-star</td>
<td><i class="icon-star-empty"></i> </td><td>icon-star-empty</td>
</tr><tr>
<td><i class="icon-user"></i> </td><td>icon-user</td>
<td><i class="icon-users"></i> </td><td>icon-users</td>
<td><i class="icon-male"></i> </td><td>icon-male</td>
<td><i class="icon-female"></i> </td><td>icon-female</td>
</tr><tr>
<td><i class="icon-child"></i> </td><td>icon-child</td>
<td><i class="icon-videocam"></i> </td><td>icon-videocam</td>
<td><i class="icon-picture"></i> </td><td>icon-picture</td>
<td><i class="icon-camera-alt"></i> </td><td>icon-camera-alt</td>
</tr><tr>
<td><i class="icon-th-large"></i> </td><td>icon-th-large</td>
<td><i class="icon-attach"></i> </td><td>icon-attach</td>
<td><i class="icon-lock"></i> </td><td>icon-lock</td>
<td><i class="icon-lock-open"></i> </td><td>icon-lock-open</td>
</tr><tr>
<td><i class="icon-doc-text"></i> </td><td>icon-doc-text</td>
<td><i class="icon-pin"></i> </td><td>icon-pin</td>
<td><i class="icon-tag"></i> </td><td>icon-tag</td>
<td><i class="icon-tags"></i> </td><td>icon-tags</td>
</tr><tr>
<td><i class="icon-bookmark"></i> </td><td>icon-bookmark</td>
<td><i class="icon-bookmark-empty"></i> </td><td>icon-bookmark-empty</td>
<td><i class="icon-flag"></i> </td><td>icon-flag</td>
<td><i class="icon-flag-empty"></i> </td><td>icon-flag-empty</td>
</tr><tr>
<td><i class="icon-share"></i> </td><td>icon-share</td>
<td><i class="icon-print"></i> </td><td>icon-print</td>
<td><i class="icon-comment"></i> </td><td>icon-comment</td>
<td><i class="icon-chat"></i> </td><td>icon-chat</td>
</tr><tr>
<td><i class="icon-trash"></i> </td><td>icon-trash</td>
<td><i class="icon-file-pdf"></i> </td><td>icon-file-pdf</td>
<td><i class="icon-file-word"></i> </td><td>icon-file-word</td>
<td><i class="icon-file-excel"></i> </td><td>icon-file-excel</td>
</tr><tr>
<td><i class="icon-file-powerpoint"></i> </td><td>icon-file-powerpoint</td>
<td><i class="icon-file-image"></i> </td><td>icon-file-image</td>
<td><i class="icon-rss"></i> </td><td>icon-rss</td>
<td><i class="icon-rss-squared"></i> </td><td>icon-rss-squared</td>
</tr><tr>
<td><i class="icon-phone"></i> </td><td>icon-phone</td>
<td><i class="icon-phone-squared"></i> </td><td>icon-phone-squared</td>
<td><i class="icon-fax"></i> </td><td>icon-fax</td>
<td><i class="icon-cog-alt"></i> </td><td>icon-cog-alt</td>
</tr><tr>
<td><i class="icon-wrench"></i> </td><td>icon-wrench</td>
<td><i class="icon-calendar"></i> </td><td>icon-calendar</td>
<td><i class="icon-calendar-empty"></i> </td><td>icon-calendar-empty</td>
<td><i class="icon-resize-full-alt"></i> </td><td>icon-resize-full-alt</td>
</tr><tr>
<td><i class="icon-zoom-in"></i> </td><td>icon-zoom-in</td>
<td><i class="icon-zoom-out"></i> </td><td>icon-zoom-out</td>
<td><i class="icon-down-dir"></i> </td><td>icon-down-dir</td>
<td><i class="icon-up-dir"></i> </td><td>icon-up-dir</td>
</tr><tr>
<td><i class="icon-left-dir"></i> </td><td>icon-left-dir</td>
<td><i class="icon-right-dir"></i> </td><td>icon-right-dir</td>
<td><i class="icon-angle-double-left"></i> </td><td>icon-angle-double-left</td>
<td><i class="icon-angle-double-right"></i> </td><td>icon-angle-double-right</td>
</tr><tr>
<td><i class="icon-angle-double-up"></i> </td><td>icon-angle-double-up</td>
<td><i class="icon-angle-double-down"></i> </td><td>icon-angle-double-down</td>
<td><i class="icon-down"></i> </td><td>icon-down</td>
<td><i class="icon-left"></i> </td><td>icon-left</td>
</tr><tr>
<td><i class="icon-right"></i> </td><td>icon-right</td>
<td><i class="icon-up"></i> </td><td>icon-up</td>
<td><i class="icon-arrows-cw"></i> </td><td>icon-arrows-cw</td>
<td><i class="icon-cw"></i> </td><td>icon-cw</td>
</tr><tr>
<td><i class="icon-ccw"></i> </td><td>icon-ccw</td>
<td><i class="icon-award"></i> </td><td>icon-award</td>
<td><i class="icon-desktop"></i> </td><td>icon-desktop</td>
<td><i class="icon-laptop"></i> </td><td>icon-laptop</td>
</tr><tr>
<td><i class="icon-tablet"></i> </td><td>icon-tablet</td>
<td><i class="icon-mobile"></i> </td><td>icon-mobile</td>
<td><i class="icon-briefcase"></i> </td><td>icon-briefcase</td>
<td><i class="icon-hammer"></i> </td><td>icon-hammer</td>
</tr><tr>
<td><i class="icon-sitemap"></i> </td><td>icon-sitemap</td>
<td><i class="icon-coffee"></i> </td><td>icon-coffee</td>
<td><i class="icon-bank"></i> </td><td>icon-bank</td>
<td><i class="icon-wheelchair"></i> </td><td>icon-wheelchair</td>
</tr><tr>
<td><i class="icon-lifebuoy"></i> </td><td>icon-lifebuoy</td>
<td><i class="icon-facebook-1"></i> </td><td>icon-facebook-1</td>
<td><i class="icon-facebook-squared"></i> </td><td>icon-facebook-squared</td>
<td><i class="icon-gplus-1"></i> </td><td>icon-gplus-1</td>
</tr><tr>
<td><i class="icon-gplus-squared"></i> </td><td>icon-gplus-squared</td>
<td><i class="icon-linkedin-squared"></i> </td><td>icon-linkedin-squared</td>
<td><i class="icon-linkedin-1"></i> </td><td>icon-linkedin-1</td>
<td><i class="icon-twitter-squared"></i> </td><td>icon-twitter-squared</td>
</tr><tr>
<td><i class="icon-twitter-1"></i> </td><td>icon-twitter-1</td>
<td><i class="icon-vimeo-squared"></i> </td><td>icon-vimeo-squared</td>
<td><i class="icon-vine"></i> </td><td>icon-vine</td>
<td><i class="icon-xing"></i> </td><td>icon-xing</td>
</tr><tr>
<td><i class="icon-xing-squared"></i> </td><td>icon-xing-squared</td>
<td><i class="icon-youtube"></i> </td><td>icon-youtube</td>
<td><i class="icon-youtube-squared"></i> </td><td>icon-youtube-squared</td>
<td><i class="icon-stumbleupon-1"></i> </td><td>icon-stumbleupon-1</td>
</tr><tr>
<td><i class="icon-stumbleupon-circled"></i> </td><td>icon-stumbleupon-circled</td>
<td><i class="icon-users-1"></i> </td><td>icon-users-1</td>
<td><i class="icon-quote"></i> </td><td>icon-quote</td>
<td><i class="icon-print-alt"></i> </td><td>icon-print-alt</td>
</tr><tr>
<td><i class="icon-tools"></i> </td><td>icon-tools</td>
<td><i class="icon-dropbox"></i> </td><td>icon-dropbox</td>
<td><i class="icon-skype"></i> </td><td>icon-skype</td>
<td><i class="icon-address"></i> </td><td>icon-address</td>
</tr><tr>
<td><i class="icon-location"></i> </td><td>icon-location</td>
<td><i class="icon-tag-alt"></i> </td><td>icon-tag-alt</td>
<td><i class="icon-brush"></i> </td><td>icon-brush</td>
<td><i class="icon-traffic-cone"></i> </td><td>icon-traffic-cone</td>
</tr><tr>
<td><i class="icon-bucket"></i> </td><td>icon-bucket</td>
<td><i class="icon-info"></i> </td><td>icon-info</td>
<td><i class="icon-help"></i> </td><td>icon-help</td>
<td><i class="icon-check-1"></i> </td><td>icon-check-1</td>
</tr><tr>
<td><i class="icon-cancel"></i> </td><td>icon-cancel</td>
<td><i class="icon-home-alt"></i> </td><td>icon-home-alt</td>
<td><i class="icon-download"></i> </td><td>icon-download</td>
<td><i class="icon-box"></i> </td><td>icon-box</td>
</tr>
<tr>
<td><i class="icon-home"></i> </td><td>icon-home</td>
<td><i class="icon-cab"></i> </td><td>icon-cab</td>
<td><i class="icon-truck"></i> </td><td>icon-truck</td>
</tr></table>'
.'<div class="separator"><hr /></div>'
	.'<h2>Text in Spalten</h2>'
	.'<code>[row][col typ="col1-1"] ... einspaltiger Text ... [/col][/row]</code><br />'
	.'<code>[row][col typ="col1-2"] ... zwei Spalten ... [/col][col typ="col1-2"] ... zwei Spalten ... [/col][/row]</code><br />'
	.'<code>[row][col typ="col1-3"] ... drei Spalten ... [/col][col typ="col1-3"] ... drei Spalten ... [/col][col typ="col1-3"] ... drei Spalten ... [/col][/row]</code><br />'
	.'<code>[row][col typ="col1-4"] ... vier Spalten ... [/col][col typ="col1-4"] ... vier Spalten ... [/col][col typ="col1-4"] ... vier Spalten ... [/col][col typ="col1-4"] ... vier Spalten ... [/col][/row]</code><br />'
	.'<h4>Beispiele dazu finden Sie hier<a href="http://brings-online.com/demo/wp-theme-property/shortcodes"> &raquo; Theme-Infos</a></h4>'
	.'<div class="separator"><hr /></div>'
	.'<h2>Text in Listen</h2>'
	.'<code>[ul typ=""]&lt;li&gt;Listenzeile&lt;/li&gt;[/ul]</code><br />'
	.'<code>Typ: standard, check, pfeil</code><br />'
	.'<table><tr><th>Standard</th><th>Check</th><th>Plus</th></tr></tr><tr><td width="200px"><ul class="standard"><li>Listenzeile 1</li><li>Listenzeile 2</li></ul></td>'
	.'<td width="200px"><ul class="check"><li>Listenzeile 1</li><li>Listenzeile 2</li></ul></td>'
	.'<td width="200px"><ul class="pfeil"><li>Listenzeile 1</li><li>Listenzeile 2</li></ul></td></tr></table>'
	.'<div class="separator"><hr /></div>'
	.'<h2>Zitate</h2>'
	.'<code>[quote]Zitat[/quote]</code><br />'
	.'<blockquote>Zitat</blockquote>'
	.'<div class="separator"><hr /></div>'
	.'</div>'	; 
	
		return $sContent;
			
	}
	
public function do_theme_options() {    
               
        submit_button();
       
}
   
}
 
if ( is_admin() ) {
    new bo_options;
}
 
// ===================================

	
 ?>