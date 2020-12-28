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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_practical' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '~y&M--y{@aD0wgeG1hYPE,eG0vdbXv2*N^N.Vl(I3r?Yqvkrx~C#:]?D wS1XL?^' );
define( 'SECURE_AUTH_KEY',  'd1=U{3+tsLr)ETa&,P3r_7.h+]vYm7:N$f[;4K_d f}!W,`&XCgn(9qOBga3].&y' );
define( 'LOGGED_IN_KEY',    'kZ!Ap[^pSe%PiNFA{gCBk8a83*3/043$u$Zu+20yR.;vr?Tj!s1<tt$b*v)<2t?h' );
define( 'NONCE_KEY',        'A5TB@e#J+>XvZH]X/4~_ hE5{ >0h Ov7*uHMNwUcPG:uA94E7JmKI~$4z2eplE,' );
define( 'AUTH_SALT',        ';7va$Y0U>#B]cD(zCQHdL6iB;q}^Br*f+!1_qO^&#!Gq`)tDI$.ZZ9xt[0{Z3*Em' );
define( 'SECURE_AUTH_SALT', ']{<JR+}(fxtuPEALNO2<YSo2D)_d<=B-x9RkFt;0>u#.RP:(vvQ:]&zLQ)xH~VLo' );
define( 'LOGGED_IN_SALT',   'sb]rySF=.a!vZ#l@u>b3_4{m%]](;ft26ajpaqf!vZ2,IPCLS<#b,YEwev|j?M?k' );
define( 'NONCE_SALT',       'q}~-B7MfxJMEdOlgL]$N7L?s@3SzvOqMK<QH8PIoQL-4oXF.j*fSr!d[>*&6[W;=' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
