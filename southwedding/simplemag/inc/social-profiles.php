<?php 
/**
 * Social profiles links 
 * Refer to Theme Options, Social Profiles tab
 *
 * @package SimpleMag
 * @since 	SimpleMag 2.0
**/

global $ti_option;

// Build social profiles array
$profiles = array ( 
	'sp_feed' => 'icon-feed',
	'sp_facebook' => 'icon-facebook', 
	'sp_twitter' => 'icon-twitter', 
	'sp_google' => 'icon-google-plus',
	'sp_linkedin' => 'icon-linkedin', 
	'sp_instagram' => 'icon-instagram', 
	'sp_flickr' => 'icon-flickr',
	'sp_vimeo' => 'icon-vimeo', 
	'sp_youtube' => 'icon-youtube',
	'sp_behance' => 'icon-behance',
	'sp_dribble' => 'icon-dribbble',
	'sp_pinterest' => 'icon-pinterest',
	'sp_soundcloud' => 'icon-soundcloud',
	'sp_lastfm' => 'icon-lastfm'
);

echo '<ul class="social">';
	// Loop through array and output the item only if the field is not empty
	foreach ( $profiles as $profile => $class ) {
		if ( !empty ( $ti_option[$profile] )) { echo '<li><a href="' . esc_url( $ti_option[$profile] ) . '" class="' . $class . '" target="_blank"></a></li>'; }
	}
echo '</ul>';