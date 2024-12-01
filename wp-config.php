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
define( 'DB_NAME', 'mywordpress' );

/** Database username */
define( 'DB_USER', 'wordpress_user' );

/** Database password */
define( 'DB_PASSWORD', '123456' );

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
define( 'AUTH_KEY',         '-D@&2=.O{l84pW`^bEkfH3g=N7$V>=QOgwYZ 2cI^yZ9GR1@*BftF<gYb.M1jx~|' );
define( 'SECURE_AUTH_KEY',  '&a~NKG.D8tI!knd] H>2x8ou#s)H`G%>[J#>v ?j(u63A_C`~F/17_]y&zMR&O-k' );
define( 'LOGGED_IN_KEY',    'k7!wNZvTKvqw|zPn=XiM=Vb4=ed.YVtaugK C[cvZriK<)p!K`2%^|pW?Ag{yvi}' );
define( 'NONCE_KEY',        '?S*h6Rm/)?n?v.luuFmT9Odzle[YvbiuXqOq{EnXkj|zk#_$VGQ7nf?;x&0Z<e_R' );
define( 'AUTH_SALT',        '*$Er>hF85~MbI}(O2u?wY$2f%%YR.ICYcWy/K|ao|m*IAt*Hy,1F=ehOHppqumzw' );
define( 'SECURE_AUTH_SALT', 'l30N4PQFiPLOR}T+WE$#wrF+i@^|jwr MtWd6 N^Q%iR2,r,~T?XHS$^p2v]`q]~' );
define( 'LOGGED_IN_SALT',   'ZT`%k]|9/:nxD%X>%&gFfi)o[Ff5&D8Nvnav@]AW#(3E4:v]<,Al&_}luJhk//}P' );
define( 'NONCE_SALT',       '<Tu<7Awqiy+OhaC;,UL&X(L,vbr>t|9gKgpT}q3q!qUM=v6.gRnvbktX[-(ee57[' );

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
