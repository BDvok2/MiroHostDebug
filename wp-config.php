<?php
//Begin Really Simple Security session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple Security cookie settings
//Begin Really Simple Security key
define('RSSSL_KEY', 'JaEo7WAmWjL810m7vg1K7evdIVr0l3ravkBRIohH54n93ekyOHew5KT3clGdcM3i');
//END Really Simple Security key

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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "krndsh" );

/** Database username */
define( 'DB_USER', "u_krndsh" );

/** Database password */
define( 'DB_PASSWORD', "jQhdeKVm" );

/** Database hostname */
define( 'DB_HOST', "localhost" );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '{[Q)gJ7{nQ/XG>|J&mrC}cSZ,f$E(SB?$J]}g`pc/j`[1}EhXO-qes340CQ0*hfv' );
define( 'SECURE_AUTH_KEY',  ' FGQQ>:Wag1;pkontj8}/+TI;[ ej@A5}t3p9+hRe[Eke?g$9yv,V0q};5^G3wz+' );
define( 'LOGGED_IN_KEY',    'gG54;h|[<8,X_@`dJ#C^#?L$[QdWtsvESQ8y1(ofwu7H?IM 0.M3*l,^LV~g=mcs' );
define( 'NONCE_KEY',        'HssTjHdSk5rF(f](w?VSk$Ef=>~BdAVz[Wb1<>u{$v^O&YK{QSr%6+,RSLHp5y(P' );
define( 'AUTH_SALT',        '>+(oUDlgQap,?P1oI`2WGnpMC7#T:XO3AM/IRSYv$0bEU(}!QB[Vh57(<Ey79ds)' );
define( 'SECURE_AUTH_SALT', 'CbgwNZ6u8kk5*%?tzqD;,[]mZ3fX.oo1tQKC{AUnZ$C<wH&i[?5~ av}Xg6z}m<P' );
define( 'LOGGED_IN_SALT',   'c@.vC&**zNl%A!}jbd8;xC$9!]O P|GP>kz>v~{>k3IIKOD4Ot$#;fKl<l7|qm$4' );
define( 'NONCE_SALT',       'cprlK^TB@J[N#CwO_J^9E4}bRU)#1jS5Pk^dF9U{=L[wm4d<R&1zBd+@BfBp_p5`' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'zmso_';

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
define('ALLOW_UNFILTERED_UPLOADS', true);

define( 'WP_SITEURL', 'https://krndsh.com/' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';