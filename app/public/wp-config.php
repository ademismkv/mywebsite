<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv('MYSQLDATABASE') ?: 'local' );

/** Database username */
define( 'DB_USER', getenv('MYSQLUSER') ?: 'root' );

/** Database password */
define( 'DB_PASSWORD', getenv('MYSQLPASSWORD') ?: 'root' );

/** Database hostname */
define( 'DB_HOST', getenv('MYSQLHOST') ? getenv('MYSQLHOST') . ':' . getenv('MYSQLPORT') : 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'w!<U;G-)IDlR>E8HbC,m#O;&%+W*Nl7Jcgzw_.P*dS:+sexA=U(MOJapirk+G}:h' );
define( 'SECURE_AUTH_KEY',   '`bX^rU/]rWO,Co)>+LZ*Waw* R@jw#$CcBA/z)@{9x{MSKnqE:O!:c8[y8#w(b[~' );
define( 'LOGGED_IN_KEY',     '_j.q(3US35QK[Su))e*6A8_!Sv47SYz[B%;/!7:6t*tv{6Bk?3={5J)eq=77(Vq%' );
define( 'NONCE_KEY',         '*<UsPe%}]nmy=6uNZ=F@HOVUh1l+BGhs9Z7<]ddihGo$Q*=V0*WwC1t;/A6Px ko' );
define( 'AUTH_SALT',         'luaK.d&+P?ZjE :oFIv~_Q7LNm8d7-=aaf77X^A* b2w!d~D2Lc3?t@1,NBs}>;5' );
define( 'SECURE_AUTH_SALT',  'GoC9{jIN_/rDvpQsop9ET4_pnzc<CiNCf zc(2 /h+Uctp_J{7Vye,E(8qRH!WR#' );
define( 'LOGGED_IN_SALT',    'JH5l_frVI1MAgo[I^?*d5{sd>ge(+90P?4g)xt3iG?JI`82@3Ff*MEK/R/ I1A|w' );
define( 'NONCE_SALT',        ',MTM_XhHl}}X.O-r(pzhQ,bglX#?aX2~ PgPZzCp}@S~ _gWQ8O)V5LPj-jg_sAs' );
define( 'WP_CACHE_KEY_SALT', '##d^0+NrsQ|z#4i-CWE>8,Kj.VK,q@:u=`se$U6Q-{yT^H=c]I9Yz?!Ek$nMD3N$' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
