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
define('DB_NAME', 'wordpress_curso');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '[bS)qAo9TJJ!k6IcB@JrYV=J&tFH]I{(P.%os8^z7d*;RetWrIv#X!~6X:nbR:Y9');
define('SECURE_AUTH_KEY',  '4Z~$vM)q9_Ui]^/`9dQ[$KP9?CAUlc[du<`e1T!&+bz!`p]M:yO0 6y4/6FA3DwX');
define('LOGGED_IN_KEY',    'bh9~h^:_OrJTh&x,=O<W<w#O15ursOP28yw@]xM8@_jtzz}i#b620D%of4~mjab!');
define('NONCE_KEY',        '$KvPNJy&VOtS0AaNWl`i:vs2j o1 [6tN3gO3kqA?CU!YQ^,a_qGI N.`0I?pb@Z');
define('AUTH_SALT',        '9Xlg]zK6JjVD|eA/rJ3uG3yZa5t`p~#ZkdfiG^m1zx7%EbveZy^(kksEq}q=at1}');
define('SECURE_AUTH_SALT', 'hjdj{joh:IW@UR$2kmL]e<^RFryd?t@4dV{G;OZHA29-L!HjLZpT,o!mIP8i}wP_');
define('LOGGED_IN_SALT',   'QI h!Yc6r2aZ9KR%_oKGBEe/kEyc8fBR)[_BtN<)kJ`5UzRTd7K0|qoyX1P{-RIy');
define('NONCE_SALT',       '9AeJ*]Rvv}6k[T]M<,tzKF6.9UB2Lr,kJBo1gM8xZ(ADmY)e3 >0^f|&1s~n*C8y');

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
