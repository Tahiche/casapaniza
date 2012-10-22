<?php
/** 
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'qpe375');

/** MySQL database username */
define('DB_USER', 'qpe375');

/** MySQL database password */
define('DB_PASSWORD', 'Casapaniza12');

/** MySQL hostname */
define('DB_HOST', 'lldh108.servidoresdns.net');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '54D&U1mLR9Ld29)B8o@iMBsdk570S4MaPm8%ffDWjdN)KKrOBwj%vm)i%(GbnmDG');
define('SECURE_AUTH_KEY',  'RjZwmvoj!RjhcnO7lpRj3rIlszG0Y1&L0gE7#ltp7*U7PAf*RKXx1vKYvu(5w&ju');
define('LOGGED_IN_KEY',    'ZDgp(W7L*&Q%YWGBuO387*2R%AfaLobI@YPDSZV5In^3jwyel^y$#7%YhlU8hjpX');
define('NONCE_KEY',        'ofO(ZTDuaOegKDtC8N^OM*7xx*(!VPQNE2VZlLu17RLXb4VcgcqDICQLILbNV0@u');
define('AUTH_SALT',        'NdygR5zoPH$*v$*AKgv2l9Zv!(Qt7^x%9%92Fo0v!p2UeE%w2cmKHwxfmWLxyaK8');
define('SECURE_AUTH_SALT', 'wLGHPGZ22OYD1wWSHyLMjLm6!Q%sX@GTofv1lvh3ePUQvj2c6OXRC!5WDhgfx4YF');
define('LOGGED_IN_SALT',   'aq!qP(KxPowy$Xgtev!Nmcgs48LblwYPyJPV!RuLEWcuG0aF3EUT(lPKe9H0TXaC');
define('NONCE_SALT',       '5YShlZ!WLDAfhQ2LJVq)X5vB$J#Fl!*lg(b($MoG#^S4*2%8GDHWiFxhTOlW%ycr');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'Wordpress17984_wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'es_ES');

define ('FS_METHOD', 'direct');

define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

?>
