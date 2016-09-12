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

function get_config_consts($build){

    if($build == 'development'){
	  $settings = array('mobstar_wp_db', 'root', '5es6rx6no8322zs', 'localhost');
	} 
elseif($build == 'testing'){
	  $settings = array('bestprp0_mobstar_wp_db', 'bestprp0_isma153', '5es6rx6no8322zs', 'localhost');
	}	
elseif($build == 'production'){
	  $settings = array('savvypl1_mobstar_wp_db', 'savvypl1_msta693', '?9~,@EbCiy#u', 'localhost');
	} 

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $settings[0]);

/** MySQL database username */
define('DB_USER', $settings[1]);

/** MySQL database password */
define('DB_PASSWORD', $settings[2]);

/** MySQL hostname */
define('DB_HOST', $settings[3]);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
}

get_config_consts('development');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '2tN #/Ov?NV*5Y~eQ@%PI}Fzj+x|]c`5Dt1DBc53>I|#,<g|lRwM[f=Sl7f1/4#A');
define('SECURE_AUTH_KEY',  'OdE/Ecuw*=%gzEx-uC1r[NSEg%~QOuG5un-$w;^cm:)YJW{uN|X[(L|bAo!g!j{{');
define('LOGGED_IN_KEY',    '2T+uu9JBTjh?GEIcRUNJ~lOJ.Qvf-%B40}k-f?gqv8NC_at41cnXE+C+-{`%gH#g');
define('NONCE_KEY',        'z|_ryRi+Mlw5q680byT+BY4e{F-L3MMlQ,nEZ[JiaR9suiRQdlqcC/@$FVo}xq&A');
define('AUTH_SALT',        '!@kqir3raPox50An5VYmRld<PKP8|z)=2{-G$aqgx/0zY1pdhc HxvDl-v<0c3s(');
define('SECURE_AUTH_SALT', 'c{EyT&8L7(+GY h)}]IbM5#})]k8S|^HNaay`tIY~bpm!Uv(>M7|W7d%lp|G)Y`%');
define('LOGGED_IN_SALT',   ']<,8VJ~xsxY,[5bj_P/x*Hr0uE~huOaws6+4/XV3b[Tu55@P}55VB8*h5.I|NU@K');
define('NONCE_SALT',       'p%yruKV.q-/Th3VVH-Nqfz_%HI<@(-`={zu@vVxN?>&vAuur_(P=>T5-0-|V0?t/');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_b98m5tyj4du4r';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
