<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '><AuHA,tQ|kWD!?r5ixZgd6bl>>R@;|Neg|-CQm[)@xiih&qFXU_gz2OU>#+G8*M');
define('SECURE_AUTH_KEY',  '@+VjW+7mJ:-.*ImT}nb/<arK.P[JxQU8+zPp LUa$:t.lAOfx]V#q0 ~^.no|B9L');
define('LOGGED_IN_KEY',    '2y1%f{GyZqU@H|}<Im5hDeKc+g9:hY+A@Tn7 qWf[+rf[?6C^v#nb]Fpb}octWWP');
define('NONCE_KEY',        'uo#dqE8Tr>aUZrM!FzT)!x|N9J?;LVQ@VV%5pj!G/p7o+bPEqoCsO|MS6M~:o2dG');
define('AUTH_SALT',        '!Q,B(+_]DQAAlCq@,R7Xa8|pC$Hgt4cwUvX80gHN+/T)IkXDe6u-Y]vEEhIL:k$$');
define('SECURE_AUTH_SALT', '+xtnzW&rT]^O5jv<%<S8(R|&;)Ch1j7.8Hl;pIdZ[+]e0S6,=fTTvX(-^@F)|XVa');
define('LOGGED_IN_SALT',   ':U&R8xh6%]ubaYPcj, Qm#c#x4Td-C$&&kkRc/%dA Nv)wsW4Y)t[U2cIMP7YtFO');
define('NONCE_SALT',       'J (vFK->S=-W&;`(g+F?i<+IBu]*u>9:%Uy+Ji&b]n9DJ!go-u$fA6Yc4HR;7qcm');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('FTP_USER','root');
define('FTP_PASS','Th3WorldOfTheoryAnalysis');
define('FTP_HOST','localhost');
define('WP_MEMORY_LIMIT','128M');


?>
