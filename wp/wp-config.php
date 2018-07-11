<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
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
define('DB_NAME', 'mysunless_wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '4m:5eMm`ep!:pCJ.:&Dc=|kX[(?;x>G[YGsr6H_4++C#A}h(Gh>z1E (|M8(G+bG');
define('SECURE_AUTH_KEY',  'j93G!VS)]~u}x|}c1hlGhL1iUA5e75MPYMHS~?AN$;p$78:Kz8v+grpsY+|MN~NC');
define('LOGGED_IN_KEY',    'KM .iXQt0[|?wV|JPqSxR?RK/vO &-?8c@Z!*{LXp3Sz5/)/n@+d].Dg-p(X&Ecr');
define('NONCE_KEY',        'QCfTfgn#u_Kio({D1W?$`]!*z`8ok&%TV=1(DnH|{8Ge$CEkphkew9aqCM*KOiv=');
define('AUTH_SALT',        '{t|&a+lXCbE49[VljU=D+,p~P{4YHOH)Rn2u*WiZtG-vGo*W|aqnrrdE-:B8SNck');
define('SECURE_AUTH_SALT', 'D`uTV58C-guH{84,42*W+eVrD;Hh?ZvS-X9&v+%M-~/%`+P,?F2aSR|VER_M+Uh3');
define('LOGGED_IN_SALT',   '.k6^nc:%4RqtZ=gmD;,1!}t;cW3sxml?v,K1s?/gs|FTuN-Hrw%%C(<*RxJvPmQt');
define('NONCE_SALT',       'sa<0 &jh0G$|yT$Oq (N>QSXsW:4Y4&>sA#?n=_9FoujO}iAN}:.k[i00ssft{x.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
