<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'devdemo_studieus');

/** MySQL database username */
define('DB_USER', 'devdemo_studieus');

/** MySQL database password */
define('DB_PASSWORD', 'studieus');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'b=1V!<]3FpL82J7.$3A&}KE%e[ZJ.]/U#-;yBQ_P/Y5__CBOc!=k:)z[M)diz!IQ');
define('SECURE_AUTH_KEY',  'j|J(@S|?l=G`8mW`t=`d$-r}R~2{&A`@}D9ClBG~(P~#UFc~=NZsTqs#(2A[l~H~');
define('LOGGED_IN_KEY',    '2s9%^*n!,S;SZ;SX<;|j$xd8fnXsx4zeO!(#/H,HJ|z4$jfM/#}tlOTEcv]&N#%x');
define('NONCE_KEY',        '8GynO;ETC~}ZOp)Fr=/u(gL(>8LMvQ7.z>G-<V[MMI1%Y;Nni~9,jB7ou}_[?n{X');
define('AUTH_SALT',        'C++@:Wm~[Nyn<I7q<R-:=@>Z+>VxlIBdE9v0i2@sG^c!zGk[Y5B%I)t}uJy ]kR$');
define('SECURE_AUTH_SALT', '/rT,}<KfSE{Z>^RJ5,ZYle$`h]idM-EXU/cp$c@rf{5ZzFb!tKOyqBq0}u%f2-G2');
define('LOGGED_IN_SALT',   'lc(cb~u*kxery<RAm.Rlt>3T.%mXc_Y^NRiAT;Cs7YW> ]HbZ[PW9jE9]%we`BL ');
define('NONCE_SALT',       'm7+&`YJ?)9O;,XFl@[)p(qI&5IR@3@^k->DgUh,]2k`iuh,*HunVj?9IfW7%V1D:');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
