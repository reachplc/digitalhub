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

/**
 * Load database info and local development parameters
 */
define( 'WP_LOCAL_DEV', false );
define( 'DB_NAME', 'tmdh_staging' );
define( 'DB_USER', 'tmdh' );
define( 'DB_PASSWORD', 'QIeNQbVCzvff' );
define( 'DB_HOST', 'localhost' ); // Probably 'localhost'

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**
 * Custom Content Directory
 */
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'L_V3AAjM:*,s>ee03X#;juj$m+8PCz1|I|ae`L._O,=QNCLf -xXELR2R4OKBAT#');
define('SECURE_AUTH_KEY',  'W|(jVvt(3m/O;K%LANs]9;J=sa:_4?E(SF$<k _|/u%BR2O=cm-oI(tkG:vtk2OR');
define('LOGGED_IN_KEY',    '#PD-)Sj*Rx4}Axr$gcy?RdT<4))y`O@4/sf8:y5-b35kDI$M-mTm2]7xS3i|gRxV');
define('NONCE_KEY',        'q4~,M9Q[l%nY~<jK>HJru:^>_H7N|qSmz<eTv +-nSzzV})RG_k|Til1b,EpE1LV');
define('AUTH_SALT',        '3>lHA+ ZB/*@CuAPH+<N_[p9M)Jp#KL^%>ordbU5e>MMP`!&+:Z =Y07E0Y=(+,/');
define('SECURE_AUTH_SALT', ']o@d-)/d(WI;oLI;|PR8j@C<VGmq#BIb8VK8.#`;Y12Hgk1,g9f34Xw(d|=Dh7Bw');
define('LOGGED_IN_SALT',   'N~9+8uPT!:3G%SyxC7xazs,khHK;>z S~I c1$144Nd4eP?`ATG-^*{PeL,o&E3#');
define('NONCE_SALT',       'n8w?9aF`K_r;N35@A}1!I!^mTEKR;.],[<xN<81-K#Sb-/DtLLADS>MEN4Jh;]u~');

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

/**
 * Reduce number of revisions saved
 */
define('WP_POST_REVISIONS', 3);

/**
 * Increase PHP memory limit if possible
 */
define('WP_MEMORY_LIMIT', '96M');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
