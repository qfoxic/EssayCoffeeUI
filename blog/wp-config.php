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
define('DB_NAME', 'blog');

/** MySQL database username */
define('DB_USER', 'transport');

/** MySQL database password */
define('DB_PASSWORD', 'Secret677');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf16');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf16_unicode_ci');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'b3}V8z.iH/dAU!9!)0;}SK)w+6_Zs9%?Yq;au;-Thb&9*Pv2,5~&/ICE/BM7)=.A');
define('SECURE_AUTH_KEY',  'T=@j$fr:Eq-b(*(e0!2%U9Pn2~V~CC4=q!+2;-J}TQ^FQ-t-gOgH5JWJF3`2[*$n');
define('LOGGED_IN_KEY',    'Tnr;`>|F&aD.1/`DBA]ylns(|adQe^@W!$> +Y<<V+e%>N/bm04WqoCToa#3j<G4');
define('NONCE_KEY',        'W],rY +:!+|Q|QxSP^__bne.4 @ ,+;+A$ HaBfWB9{@4n) /_vgZV91|%>mtPmD');
define('AUTH_SALT',        'avK$ap+vt5)6xq<<saIeHa^YV?UJQ}U,u$qJR_:}ltspv@eav;?p|hq1Qiyri+:D');
define('SECURE_AUTH_SALT', '|6C$||C$R1,^7U|wzpQ58vjTzg)o=^k1!W3{C!HPpGr=zylm?k!PB7py)s/S4Oo#');
define('LOGGED_IN_SALT',   ',reb|sk^$[nr8S35e6-SJ>EX>$;q.-tHf8^T[TFskN26v|kOC) L,jtj%y%wSc}C');
define('NONCE_SALT',       't~vKR:<>nhb@ 7+M<_NEobx<s|(TwW,Uvl]0!aDdpt0@2h*:;m%?8phOP,#}i!v5');

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
require_once(ABSPATH . 'wp-admin/setup-config.php');
require( ABSPATH . 'wp-settings.php');
