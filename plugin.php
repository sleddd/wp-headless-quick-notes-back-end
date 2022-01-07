<?php
/**
 * Plugin Name:       Quick Notes Backend
 * Description:       Backend for Quick Notes journal headless WordPress version.
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Claudette Raynor
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       QuickNotes
 */

/* Constants */
define( 'QUICK_NOTES_PATH', plugin_dir_path( __FILE__ ) );
define( 'QUICK_NOTES_URL', plugin_dir_url( __FILE__ ) );

/* Autoloader */
require QUICK_NOTES_PATH . 'vendor/autoload.php';

/* Initializing plugin */
$QUICK_NOTES = \QuickNotes\QuickNotes::init();