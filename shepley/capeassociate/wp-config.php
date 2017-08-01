<?php
# Database Configuration
define( 'DB_NAME', 'wp_shepley' );
define( 'DB_USER', 'shepley' );
define( 'DB_PASSWORD', 'tEymapWVTrqozmCy' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'swp_';

# Security Salts, Keys, Etc
define( 'AUTH_KEY', '{$b`/X vh0=T+_&Eg?imo f:s (^eTC,#e}Iq|>A&.BnL1qBK(1F;!r^FE13UwQ5' );
define( 'SECURE_AUTH_KEY', 'ZeGt@l)}M/X AxD#pqyX#c@zxgTa3zie*ozFNm:5,^k[%GnAS@q#s?z*~p~c{G`c' );
define( 'LOGGED_IN_KEY', 've}cvm:|;Am8]h8Q.,4c(OQmOlw;2H`jP`7=^+UtFEA()dIJ+mSOK_d>1(IQ+C8g' );
define( 'NONCE_KEY', 'Lbx-hcxU)bVvA+n>q#/s<fo`$;~BnjJ<rFWss3Vim*@64w~t~Z*a !T8zK-TX275' );
define( 'AUTH_SALT', '70S,l!l$rv*FG4+^?|_26WFj/pe6`.L7.S,@p8w6f(mqppfk+IP~]f!Y&i4|5N!&' );
define( 'SECURE_AUTH_SALT', '7WR}C^rg)FL5dVyhAR!abrG/4cd~UJ*F9ri%}_}Lg8M}Pgxd(gv3,lB<1O1v7M)u' );
define( 'LOGGED_IN_SALT', 'SNy;u1t$j[1_H(?ADksQ:Q;S3Z)gW$<Hzs1@a]p4BsP*d$kV#7NXN$BE?#|V#_<*' );
define( 'NONCE_SALT', '#/`OAtaIX[$sj#MFHlhy5nQjWCn~!74mrZqtzYn<,y8Phx`t/QUw/h`[ClL*9-RL' );


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'shepley' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '7425048b8ce39833fc5ddb86050044ff3d48a45b' );

define( 'WPE_FOOTER_HTML', "" );

define( 'WPE_CLUSTER_ID', '32580' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '166.78.247.120' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'shepleywood.com', 1 => 'www.shepleywood.com', 2 => 'shepley.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-32580', );

$wpe_special_ips=array ( 0 => '166.78.247.120', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( 0 =>  array ( 'match' => 'shepleywood.com', 'zone' => '2wc2w9mzv6nxyse51pkuze1d', 'enabled' => true, ), );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );

define( 'WP_SITEURL', 'http://shepleywood.com' );

define( 'WP_HOME', 'http://shepleywood.com' );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
