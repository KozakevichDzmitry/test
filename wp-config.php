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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'local');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'whatever');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'YjJnCGCXh1qGoBc95taBryC5OLeqi9ROJr4YmJry7YonzAmUBrqhG/KsAeVArFNmPX26CGJ+xF0+I63WuPwG0w==');
define('SECURE_AUTH_KEY',  'EbHO6JNWSumeFphFAMAF0kfZc67zX2DaMOEnpG02aVPAYE/Ik5+VmWG67ByYcESXhgm9MZ9Oks02oIBKsl9Ugg==');
define('LOGGED_IN_KEY',    'bZTqaLubXP2MGlgbPN997IFgNK3dp4t4/l98bKdbGLk03ISzz1oOQ8c3hIW8KU8vswquPT1aH32BKh3x3oJJEA==');
define('NONCE_KEY',        'UCZhh0SCM7GYlaK7yxkL2IdUV2Wi+EntFIhfblhMfGRY5s479CLIJyDvoCZRKdC6vtJaupuycbMyD+R+OyiESQ==');
define('AUTH_SALT',        'hWqyErQ1Buhj/PppgrXUa7VKdRgaAlb/TvSkHmnhckOEoQbxzgYCa3gXCezu4reawkVR2T4y4LDSwsi9x7YVnw==');
define('SECURE_AUTH_SALT', 'e4zhmFiHl3AimFesv95C/o8ecqL5B4AAKgNhXieoCtk3ZB1nMGzAsqToUSKnbshxChcr+WjbrdhKagwKHDOBng==');
define('LOGGED_IN_SALT',   'cwUhNv1Ih4talY9U0tU/wm6WFfsoVBKNu4NZgN2f5+M9zHuZLCb2X2XOEZvQnUXfJ4GSObCmduXl5qX1uNg0TQ==');
define('NONCE_SALT',       'l/0egvygTIaa3SOxCOtw9XjWoEKGjUCrf2G34S4fOIFRatzprU+nG0Wr5CVaG++N1V9PsVvlBslGPfSZ6rVbYQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

# Разрешить загрузку всех типов файлов
define('ALLOW_UNFILTERED_UPLOADS', true);
