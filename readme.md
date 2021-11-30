# WordPress Starter or Boilerplate Plugin
Contributors: Claudette Raynor \
License: GPLv2 or later \
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WordPress plugin starter code for easier development.

![Composer](https://img.shields.io/badge/Composer-brightgreen)
![Node 14.16.0](https://img.shields.io/badge/Node-14.16.0-brightgreen)
![WebPack 5.12.3](https://img.shields.io/badge/WebPack-5.12.3-brightgreen)
![Babel 7.12.10](https://img.shields.io/badge/Babel-7.12.10-brightgreen)
![BrowserSync 2.26.13](https://img.shields.io/badge/BrowserSync-2.26.13-brightgreen)
![PostCSS 8.2.4](https://img.shields.io/badge/PostCSS-8.2.4-brightgreen)
![PurgeCSS 3.1.3](https://img.shields.io/badge/PurgeCSS-3.1.3-brightgreen)

This plugin uses webpack code from [wp-strap/wordpress-webpack-workflow](https://github.com/wp-strap/wordpress-webpack-workflow) which has been modified to support the development of JavaScript registered Gutenberg blocks. 

This plugin owes wp-strap a good cup of coffee! For more details on the options for wp-strap/wordpress-webpack-workflow visit:
https://github.com/wp-strap/wordpress-webpack-workflow


== Basic Installation ==

1. Download the plugin zip file and upload to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

Before beginning development be sure to install composer and node:
From the plugin directory command line run: 
- composer install or composer i
- npm run build


== Developer Notes == 

NPM Scripts include: 
- npm run prod
- npm run prod-watch 
- npm run dev
- npm run dev-watch

This starter code uses Webpack 5 versus gulp. It uses autoloading and WordPress coding standards via composer and will integrate nicely with the VS [PHP CodeSniffer and Beautifier](https://marketplace.visualstudio.com/items?itemName=ValeryanM.vscode-phpsab) if you point it to the composer.json.

To add a custom post type see the example post type in src/classes/PostTypes/ExamplePostType.php. 

You can also build custom posts types and taxonomies via the library functions found in src/lib/postTypes.php
Examples:
\WpStarterPlugin\PostTypes\register_post_type('example');\
\WpStarterPlugin\PostTypes\add_taxonomy('example tax', 'example');

Post types do support basic custom meta boxes and fields for text, textarea, checkboxes, radio, and select.

For additional support consider a 3rd party plugin like ACF or Metabox.io.

To add a block: 
- Go to src/blocks and add a folder with the block name. 
- Add your block.json and block.js file to the block folder.
- Import the block.js file into src/blocks/blocks.js

See hello world block as an example. You can also register a block in PHP in the main plugin file WpStarterPlugin.php.

To rename this plugin with your plugin name, you will want to find and replace the following: 
- WP_STARTER_PLUGIN
- WpStarterPlugin
- wpstarterplugin

Be sure to run composer dump-autoload -o to rebuild the autoload files when done.

!! This plugin is use at your own risk and you can do what you want with it. While this plugin is not currently being maintained except when I get time, I do plan to add additional support for REST API, customizer, settings, tables, and easy ACF integration. Although, I do not know when that will be.

