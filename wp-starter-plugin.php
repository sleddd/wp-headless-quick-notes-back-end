<?php
/**
 * Plugin Name:       WordPress plugin starter code
 * Description:       Base code for beginning a WordPress Plugin
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Claudette Raynor
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-starter-plugin
 */

/* Constants */
define( 'WP_STARTER_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WP_STARTER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/* Autoloader */
require WP_STARTER_PLUGIN_PATH . 'vendor/autoload.php';

new \WpStarterPlugin\WpStarterPlugin();