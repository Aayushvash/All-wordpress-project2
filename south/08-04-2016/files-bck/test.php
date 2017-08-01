<?php
define ( 'WP_USE_THEMES', false );
define ( 'DEBUG', true );

error_reporting(E_ALL);

/**
 * Loads the WordPress Environment and Template
*/
require (dirname ( __FILE__ ) . '/../../../wp-blog-header.php');
global $wpdb;

$curl = curl_init ();
echo plugin_dir_url( __FILE__ ) . 'scheduler.php' ;
curl_setopt ( $curl, CURLOPT_URL, plugin_dir_url( __FILE__ ) . 'scheduler.php'  ); // input
curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt( $curl, CURLOPT_USERPWD, "huntyachts:186515");
$status = curl_exec ( $curl );
print_r($status);
curl_close ( $curl );