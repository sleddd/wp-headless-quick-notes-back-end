/**
 * Webpack configurations for the development environment
 * based on the script from package.json
 * Run with: "npm run dev" or "npm run dev:watch"
 *
 * @since 1.0.0
 */

const ESLintPlugin    = require( 'eslint-webpack-plugin' );
const StylelintPlugin = require( 'stylelint-webpack-plugin' );
const externals = require('./config.externals');
module.exports = ( projectOptions ) => {

    process.env.NODE_ENV = 'development';

    /**
     * The base skeleton
     */
    const Base = require( './config.base' )( projectOptions );

    /**
     * CSS rules
     */
    const cssRules = {
        ...Base.cssRules, ...{
            // add CSS rules for development here
        }
    };

    /**
     * JS rules
     */
    const jsRules = {
        ...Base.jsRules
    };

    /**
     * Image rules
     */
    const imageRules = {
        ...Base.imageRules
    }

    /**
     * Optimizations rules
     */
    const optimizations = {
        ...Base.optimizations
    }

    /**
     * Plugins
     */
    const plugins = [
        ...Base.plugins
    ]
    // Add eslint to plugins if enabled
    if ( projectOptions.projectJs.eslint === true ) {
        plugins.push( new ESLintPlugin() )
    }
    // Add stylelint to plugins if enabled
    if ( projectOptions.projectJs.eslint === true ) {
        plugins.push( new StylelintPlugin() )
    }

    /***
     * Add sourcemap for development if enabled
     */
    const sourceMap = { devtool: false };
    if ( projectOptions.projectSourceMaps.enable === true && (
        projectOptions.projectSourceMaps.env === 'dev' || projectOptions.projectSourceMaps.env === 'dev-prod'
    ) ) {
        sourceMap.devtool = projectOptions.projectSourceMaps.devtool;
    }

    /**
     * Configuration that's being returned to Webpack
     */
    return {
        mode:         'development',
        entry:        projectOptions.projectJs.entry,
        output:       {
            path:     projectOptions.projectOutput,
            filename: projectOptions.projectJs.filename
        },
        devtool:      sourceMap.devtool,
        optimization: optimizations,
        module:       { rules: [ cssRules, jsRules, imageRules ], },
        plugins:   plugins,
	externals: externals
    }
}