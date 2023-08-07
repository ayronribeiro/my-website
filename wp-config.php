<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'u381205461_qmNCh' );

/** Database username */
define( 'DB_USER', 'u381205461_cOHfA' );

/** Database password */
define( 'DB_PASSWORD', 'RQGwhkaTII' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          'KUA^60|`un>?(PNQMx?vF#Zf6N[EP@A_0J>_`z8Nkv.PODsZT`TytaH4?|Wo0(hA' );
define( 'SECURE_AUTH_KEY',   '_,(r/gq#D/jcIXMpjKL5$Fq.aWTQE-GYsXm3FX6f}l 6.MsgdA HJpwRo-Mr]t.}' );
define( 'LOGGED_IN_KEY',     'vi$u@;#dUz5-b<kxujWbEciB=B`nnis~]*3O n,$yEKE=?:U+6Q!1 5Z?Ys=qxaC' );
define( 'NONCE_KEY',         'AgD*^N5nhJEohNDM6213M>6cISVxRm9f/X*1(pjrd!AX9sIR[pS1SXZj` HRk8)o' );
define( 'AUTH_SALT',         'e7:nvXB/}:b%4UhEg(.);+ob?;JFs=<Q_<%c)lu!fMi{ltlK}8>r].6rQE{8y;o4' );
define( 'SECURE_AUTH_SALT',  'l=[R2a~2&ghzidXTVXkz<.n6.i9[PK1>U%URDgoY4n[kIv!nr^DW)(KSYdovU_;i' );
define( 'LOGGED_IN_SALT',    '>MWWqxdHTZ1Xu#H~$dAff!DNN!~N/~pW:;/V0h+~COBn:ej2ye<_tyEvF67o.]xN' );
define( 'NONCE_SALT',        '0cke>!rw?!pL|3K2jtzt/FJ3OIDC[6,FnaO86>OKzzu`nonbNf8: :w?K+OAg~XL' );
define( 'WP_CACHE_KEY_SALT', 'Rm#6}HP.h.i+jf4~7jM^oU z23mtI=qg7Q/NC{S*QypjO6ID-)_Il`t,j8jY#>?}' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



define( 'WP_AUTO_UPDATE_CORE', 'minor' );
define( 'FS_METHOD', 'direct' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
