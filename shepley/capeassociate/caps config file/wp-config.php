<?php
# Database Configuration
define( 'DB_NAME', 'wp_capeassociates' );
define( 'DB_USER', 'capeassociates' );
define( 'DB_PASSWORD', 'ldc1psEUNKVgFtXd' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         'w!L/mxL%;NIUqmJ.vIGjURj3iN+jq g(~Ix  ng9_]_M3w)L w-?[K]xt|BB%%:R');
define('SECURE_AUTH_KEY',  ',VgR2BQ|SVzp4K2XOC/mqwIKR]-Al@z:CZzg{f,>U7l:K4HeK WI)}QvQny*)J:`');
define('LOGGED_IN_KEY',    'BzIsp 1]NTm/&9@3K@:DjoHu{Q3}Dc0S3CUh;:!81ntKdK`Z:|D_[hdBP(:/HrCc');
define('NONCE_KEY',        '1$n (#@&#4M)W~yMvTKx=fClUBbG/+ltU8.ki{O4/vnGsc^U$xHE-?Dz/,PABSrJ');
define('AUTH_SALT',        'o6h>tEZ!@qr]t6C-br*gDP+d88_MJ<*C2gX%/H(NyX|1>VvIM!Tbhpi)w%PFg{uW');
define('SECURE_AUTH_SALT', '" g"6pJd:1J4I0ll{HH^7%}$COTY:FnKNES-htK.~mqO2;Xt@qM~{s.XPH[Z;>{x');
define('LOGGED_IN_SALT',   'BE`B`~lEg M"k}d[fg,~peQ"+uB|x%_g?IUy1t::QeR(75%%sAo-O?yt[-e]=- ,');
define('NONCE_SALT',       '7mk<TjoMW":I~_+Oo]`J5ij  <[=rO[,}!JM.2l"f8tt%8ad/}{9DCFE*4)E$^n9');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'capeassociates' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '30a33d587b0734e5c740efeaeb1fcc0a19b99f61' );

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

$wpe_all_domains=array ( 0 => 'capeassociates.com', 1 => 'www.capeassociates.com', 2 => 'capeassociates.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-32580', );

$wpe_special_ips=array ( 0 => '166.78.247.120', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






define('WPCACHEHOME', '/nas/wp/www/cluster-40981/capeassociates/wp-content/plugins/wp-super-cache/');
define('WP_DEBUG', false);


# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
