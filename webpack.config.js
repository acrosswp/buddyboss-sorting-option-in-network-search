/**
 * External dependencies
 */
const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const wpPot = require('wp-pot');

var custom_module = {
  plugins: [new MiniCssExtractPlugin()],
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader'
        ]
      }
    ],
  },
};

var script_output = {
  output: {
    path: path.resolve( process.cwd(), 'assets/dist', 'js' ),
		filename: '[name].js',
		chunkFilename: '[name].js',
  },
};

var style_output = {
  output: {
    path: path.resolve( process.cwd(), 'assets/dist', 'css' ),
		filename: '[name].[contenthash].css',
    chunkFilename: '[name].[contenthash].css',
  },
};

var backend_script = Object.assign({}, script_output,{
  entry: {
      'backend-script': [
        './assets/src/backend/js/index.js'
      ],
  },
});

var backend_style = Object.assign({}, custom_module, style_output,{
  entry: {
      'backend-style': [
        './assets/src/backend/css/index.js'
      ],
  },
});

//// POT file.
wpPot( {
	package: 'Sorting Option In Network Search For BuddyBoss',
	domain: 'sorting-option-in-network-search-for-buddyboss',
	destFile: 'languages/sorting-option-in-network-search-for-buddyboss.pot',
	relativeTo: './',
	src: [ './**/*.php' ],
	bugReport: 'https://github.com/acrosswp/sorting-option-in-network-search-for-buddyboss/issues'
} );

// Return Array of Configurations
module.exports = [
  backend_script,
  backend_style
];