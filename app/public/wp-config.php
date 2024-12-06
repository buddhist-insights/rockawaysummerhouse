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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'SZ{ o@KA|V2{R4f1dQV_$!cRK~CHvzz>QP._N`63>k#M{! gA1xBiWr_JUM7{4+!' );
define( 'SECURE_AUTH_KEY',   '7 _h`v,5+4DAJDj=K8&1!gdX(r%q_LCK*d=/<?.{xt,IB,S#`JV6*0-%>kjon=Vw' );
define( 'LOGGED_IN_KEY',     '(h/~e;hGVKmucPch`[wxW&7M1S7v}8v9%hr?Q.Xq!mnY:.ZsO|/RC}3$>_#(vE4;' );
define( 'NONCE_KEY',         '/w?J^u^cG P:F8CczLz@E9*(F,c[p0=R0awH%F|jgu<LSs5PyZ6UAB&{s3$NOI%#' );
define( 'AUTH_SALT',         '}3TMH_51Y&GQF5CgbvO4Z3uL?DGm%pt_}C>)DxrHx_UZJuEP~|b*}doX1kP007UW' );
define( 'SECURE_AUTH_SALT',  'bQOQe>S.O;i0Urgd2#Z;._,oo?Nv;@Xv*S${JkzkV>c:jJ#J%@c,(pF`g;>j$KJ4' );
define( 'LOGGED_IN_SALT',    'cN}4tb8e@/A@W[SvijadU1i($FX#]!MrGC9dQ5ceUUz_+2%8j)oYW]*5TAQ%4voc' );
define( 'NONCE_SALT',        '>1U?p<kXA >-6WXM$fmR&hI@ $d|aNMqMiER2i=V.,p*6b-jp_9I`{ql2Iapw3_o' );
define( 'WP_CACHE_KEY_SALT', 'F;s`&P?&.4VdAU)8bg1Z%pEGOi|:&0ezm]L:/|?[(wk<lg[tt;6V~*/{3vXX1~*I' );


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
