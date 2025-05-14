<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'zen' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'pGVb6yOmN L}FMWSW`IwWEV/z?Ui&{O<qjQ4Q]8R9}FN5 XCU7:Qtk%R }l!-av~' );
define( 'SECURE_AUTH_KEY',  '.BNfQ})cA7^Px;GG99!V<j&O@]Gh!PIhEp!(RsRH_QE)Z`|VYkKO4G>M$6X5C_c?' );
define( 'LOGGED_IN_KEY',    'ZZgn$eS qdR(qN7)HCzw0X#_rwVsky1fz,BRF^YkTYGrEH`QwGgk)_]af`]=tZ+t' );
define( 'NONCE_KEY',        '^qIw&OOJ9oaW009jSNZTU(^Gv ,9;c ^qn2AG1`Hc[V0,^_qsV9)N#{0JOcRWX/Z' );
define( 'AUTH_SALT',        'r;gx-|4!+)laTHO& 9:KpgYW[2-2nr @boOdU@JLv-a;Z~]t%vAbSEz7h%ovaNS ' );
define( 'SECURE_AUTH_SALT', '1i(^$5EQda]C shdE<t)kHm8x]=~=mK%h)r!yRmw,cc|Fh:eTA72xFGWXUpA$m9r' );
define( 'LOGGED_IN_SALT',   '|om3 F^4Y<$La9x-6o3k,F,aI[P;M9<|.LFnvVZzsZ7&+31u `l7!;|/d,:fpUE0' );
define( 'NONCE_SALT',       'g2JGsv%<o&LvE%S_m)00ePpQmsesqtJWBSiFFU4bm7ADx8|U<Yj6lTBRd8|2kE<p' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
