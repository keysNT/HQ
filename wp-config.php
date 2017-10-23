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
define('DB_NAME', 'wooc_blubell');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '|t}k6JN_xqg9F%yfj!|K$O}HJ?,=/Mk{;aagCrAM!r6M@Zu^OB%j|<55$2Ol1*`E');
define('SECURE_AUTH_KEY',  '$72E|fKeF{(ki0^o!|)t67ZY74=H;) /:47`%LA:rM~Yj+ii1xil4 4TXmA<^S#S');
define('LOGGED_IN_KEY',    '1QVOB>{c!eh%t|Dd1xLE~WO}/i*!9|)VN9vbcvgJk.4*FqB2HlSkq(q} -DxoR&z');
define('NONCE_KEY',        ' >m>pHw2lbt!qCjg,-(|+#:N23&c:nNZ4EA{`s Pe:A)f&ibv@oIFbBLt<|jL@]b');
define('AUTH_SALT',        '7@nU26:3>^,$J=dL2y}Ak%[[J%&)*X65%4i9~NCfx*/S>dU#F#Ny)1 =Y+Q#Rtn(');
define('SECURE_AUTH_SALT', 'hMFnjbDa=zT{>jq7omhfk43N=TR`*,5}XnoTrfxU<8%X:gxNL4ics{Y{Lg8rX:_b');
define('LOGGED_IN_SALT',   '(g|r[m:dQ!SW{uFdB;IT^Z`i/ DAnh[p9PN@1G{O;T;^}}$<!a/^bSDpNP>KR[!R');
define('NONCE_SALT',       'R%J!c!pY:?EHU#aS=%M8Zr9iBI}1Y)u$R+OiI9xv-CaE*t)^X<a(<xtEeXWT *AA');

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
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
