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
define('DB_NAME', 'rubyhills_wp_db');

/** MySQL database username */
define('DB_USER', 'ishy_4tdx9rw');

/** MySQL database password */
define('DB_PASSWORD', '5es6rx6no8322zs');

/** MySQL hostname */
define('DB_HOST', 'riverism.powwebmysql.com');

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
define('AUTH_KEY',         '#CO@ `E3{h9P(3yDn]g0 p&T`[A@g~cI`yen4npu}(R`eP0)-$E[dCR33@EI$0[)');
define('SECURE_AUTH_KEY',  'Z=eg1<yX9`5;uuCUMZD~t1ZK:?Kdei?y U? Ci#ZT,Z/hDZKuXeA4TXHf<n|pb6!');
define('LOGGED_IN_KEY',    'iprXO7jv0X2./R(s|,Us5,^v*e#<,%KZduh  XKPXq;k8k.ol0t(d&KwzvV 35tb');
define('NONCE_KEY',        '<$/k!dh_z8bUy5,+[.l]7*S0=PcuK~z[aSoY,F0(A8?ccBkio)%M%&<EhIhd-EQ?');
define('AUTH_SALT',        'mU]=/.)1(42@4=mW4Ee-N[{4gPD(3y1.5oi?Hibucnm&o%nZ <QaH72x*V.2E;+g');
define('SECURE_AUTH_SALT', ')F;A/};+,&JqwF*pv9]$Y7$JaLk/SWJW~dPEC]s7$ Cv:KCX7B`/p.Af535p+B9V');
define('LOGGED_IN_SALT',   'S*pc~e`1i.+]:qJ9h{X6sI+vSYaCg8[rr8wApQJ(L8[C5ML(WkK~I ((0HS9AP/[');
define('NONCE_SALT',       'C9(IDEca~X?U.RW-3|MKgH1BnF|J@HJhcC]@8+A?|L7Kf;.B}QDZ>!q,jH31NCwg');

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

define('WP_POST_REVISIONS', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/*Hardcoded home and siteurl paths for troubleshooting basedirectory issues. Uncomment them when you cannot get to admin due to a problem with wp_home or wp_siteurl*/
	
/*define('WP_HOME','http://localhost/');*/
/*define('WP_SITEURL','http://localhost/');*/	

/* Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/*Overrides the login URL condition to access through to admin. Should wordpress be moved to another directory Uncommenting the line of code below will make admin accessible in the new directory while URL changes are made to tables. After that you may need to recomment this line out.*/
define('RELOCATE',true);
