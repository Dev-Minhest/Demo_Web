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
define('DB_NAME', 'shopbh_antien');

/** MySQL database username */
define('DB_USER', 'shopbh_antien');

/** MySQL database password */
define('DB_PASSWORD', 'k3SbgpP9');

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
define('AUTH_KEY',         'l+z|8l>U;p@)b`t=^>^IJ=-+k%3&au1,{*TFy%Mkv,<[`vB*K,3j/=M.4Mou_vpM');
define('SECURE_AUTH_KEY',  '1D2,n+=FbS(-,+iV)XSXj++Q(r+mr<r6:s4oV-&}sb/m><}*Bcl;AxiJV,>7NMbI');
define('LOGGED_IN_KEY',    '.e.%;)t=46kcH7A<6k30/n~}w=Xf=mz/5e&gU/OCx$%km}^S;|Hy*CXX1$M3=;LB');
define('NONCE_KEY',        '0Wf,&JKAQ@LoI9w5]f57IOPo0tvtR!y(=Ec1:APhH^`zW+NpEgjp=)G(^om5t46)');
define('AUTH_SALT',        'UEyp5^)T2})f`kZz_v.SKNFe~]Vlp^-AFCb|HKEj*KIt,Z7~NF:c%{es>L^0JBr1');
define('SECURE_AUTH_SALT', '#vG6OW{3/hmP&GK<77i/|Wmywgdw4d!Ppy5=<,vUU^4>|}C3. xo;wRE$/ck]S1F');
define('LOGGED_IN_SALT',   ']_>x6;rjHnK$oBVPVsS@^PC%@&a; 9PA6,C?Ska3MrO(7VGH|SU)eun/xiyHqJY_');
define('NONCE_SALT',       'Avoyl4a_fmeEi/kem%TC%?1]*qu1c6#_H]jkvx;BJ*LUV(-R34/tAEJRB8[P<Q6C');

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
