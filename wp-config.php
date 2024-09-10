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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'xwear' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'x`@dTo/ptztNO)v$~*3ySDepe&=yV)CJD?6ZG_Pqt|]6mUiC:7j2#F(IW7Pqscz@' );
define( 'SECURE_AUTH_KEY',  '>;e/9;qZgStl$nC=X9vt@Ir1}9a?yQWhb%|VBbgZkj$Sbh%1RU:O_?&v@bR=,$%Y' );
define( 'LOGGED_IN_KEY',    'IA~]N9^7l<(]G8i3AOleos+~ov.B5#9L!HOxDBD#UpZj}98T62sL~P])#s@GZA m' );
define( 'NONCE_KEY',        '_IsWHaoeUGPDSZUX[P,gvP&G|s,(] TCalxz-O,1.xt>n_Ct[Z];7gb-lSV`a:=b' );
define( 'AUTH_SALT',        '*>.,kg$0AvccI=OcXzH0hh 9vT^Ab3t+>-MT0~,mTZ_rpML|K(/!, M,MT!dp^%X' );
define( 'SECURE_AUTH_SALT', 'al{1x-~x;[0!xTR3u#Xln/QQ]{(9qwU+<ku+t4KGqUN{Z+%f1/0!/Wl^_V/bC_iF' );
define( 'LOGGED_IN_SALT',   'cE(Mb:B:a *m/@wj$A>&X;i6r5%CA>~ZWR!HiyzNhldxqXrb!2WVQv@vYyA@l4r-' );
define( 'NONCE_SALT',       'D%rAY-r.iNut8P*HE$wSfw9OB.qzPHg8xYcKPo|},c4|RT?6D`6&Z4~oTI$0_|!H' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'xwear_wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false);
// define( 'WP_DEBUG_DISPLAY', true);
// define( 'WP_DEBUG_LOG', true);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
