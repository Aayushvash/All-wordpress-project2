<?php 
/**
 * Audio format post
 * Display audio embed code from SoundCloud from custom meta field
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.4
**/ 
global $ti_option;

if ( $ti_option['single_featured_image'] == 1 ) {
	if ( has_post_thumbnail() ) { // Set Featured Image
		the_post_thumbnail( 'big-size' );
	}
}
			
// Output SoundCloud iframe by page url
if ( get_field( 'add_audio_url' ) ):

	$audio_embed = wp_oembed_get( get_field( 'add_audio_url' ) ); 
	echo $audio_embed;

endif;