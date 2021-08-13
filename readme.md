=== WP Starter Plguin === \
Contributors: Claudette Raynor \
License: GPLv2 or later \
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WordPress plugin starter code.

== Installation ==

1. Download the plugin zip file and upload to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Developers notes ==

This starter code uses Webpack 5 versus gulp to compile css and js. It does not polyfill by default. It uses autoloading and WordPress coding standards via composer.

Basic build commands include: \
npm run build \
npm run watch 
