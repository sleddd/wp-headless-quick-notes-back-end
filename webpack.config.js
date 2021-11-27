// Removes old files and adds new 
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const cleanOptions = { 
	cleanStaleWebpackAssets: true,
	verbose: true, 
	dry: false, 
	exclude: [],
};

// Extracts CSS into separate file
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const cssOptions = {
	filename: '[name].min.css',
};

// Minifies CSS
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

// Used to ignore node modules when bundling 
const nodeExternals = require('webpack-node-externals');

// Used to remove or exclude files from dist build 
// primarily empty js files from css extractor
const IgnoreEmitPlugin = require('ignore-emit-webpack-plugin');
const excludedFiles = [ 
	'styles.min.js', 
	'admin.min.js'
];

const path = require('path');

module.exports = {
    mode: 'none',
    externals: [nodeExternals()],
    entry: {
       	plugin: ['/assets/js/index.js'],
	styles:['/assets/scss/styles.scss'],
	admin:['/assets/scss/admin.scss']
    },
    output: {
        path: path.resolve( 'dist'),
        filename: "[name].min.js"
    },
    resolve: {
        extensions: [".ts", ".js"],
	fallback: {
		"util": false, 
		"path": false,
		"crypto": false, 
		"https": false,
		"http": false,
		"url": false, 
		"vm": false,
		"buffer": false,
		"querystring": false,
		"os": false,
		"fs": false,
		"stream": false,
		"assert": false,
		"constants": false,
		"zlib": false,
		"child_process": false,
		"worker_threads": false,
		"inspector": false,
	}
    },
    module: {
	rules: [
	  {
		test: /\.(scss|css)$/,
		use: [ MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader']
	  },
	  {
		test: /\.js$/,
		exclude: /node_modules/,
		use: {
			loader: 'babel-loader',
			options: {
				presets: ['@babel/env', 'minify']
			}	
		}
	 }
	],
    },
    optimization: {
	minimize: true,
	minimizer: [
	  new CssMinimizerPlugin(),
	],
      },
    plugins: [
	new CleanWebpackPlugin( cleanOptions ),
	new IgnoreEmitPlugin( excludedFiles ),
	new MiniCssExtractPlugin( cssOptions ),
      ],
};