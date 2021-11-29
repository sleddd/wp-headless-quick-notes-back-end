=== WP Starter Plguin === \
Contributors: Claudette Raynor \
License: GPLv2 or later \
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WordPress plugin starter code for easier development.

== Installation ==

1. Download the plugin zip file and upload to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Developers notes ==
To extend the plugin you will need both node and composer installed, then at command line run:\
composer install \
npm run build

If you need to regenerate autload files use:\
composer dump-autoload

To watch css and js files while in development use:
npm run watch

This starter code uses Webpack 5 versus gulp to compile css and js. It does not polyfill by default. It uses autoloading and WordPress coding standards via composer.

This project's webpack configuration adapated from: https://github.com/wp-strap/wordpress-webpack-workflow
