
/* eslint-disable no-var */

var path = require( 'path' );

// Get the path to the current folder.
var currentPath = process.cwd();

// Get the path to the `blr-base-theme` folder.
var baseThemePath = (
	'blr-base-theme' === path.basename( currentPath )
	? currentPath
	: path.resolve( '../blr-base-theme' )
);

// Store base / child theme paths for later use.
var paths = {
	baseTheme: {
		source: path.join( baseThemePath, 'assets/source/js' ),
		dist:   path.join( baseThemePath, 'assets/dist/js' ),
	},
	childTheme: {
		source: path.join( currentPath, 'assets/source/js' ),
		dist:   path.join( currentPath, 'assets/dist/js' ),
	},
};


// Webpack config.
module.exports = {

	// Base directory to check when resolving `entry` paths.
	context: paths.childTheme.source,

	// Source files.
	entry: {
		frontend: './frontend',
		admin:    './admin',
	},

	// Output file / path settings.
	output: {
		path:          paths.childTheme.dist,
		filename:      '[name].js',
		chunkFilename: '[name].chunk.js',
	},

	// Determines how module imports are resolved.
	resolve: {

		// Paths to search when importing modules.
		root: [
			paths.childTheme.source,
			paths.baseTheme.source,
		],

		// Set up an alias for importing from the base theme specifically.
		alias: {
			baseTheme: paths.baseTheme.source,
		},

		// Extensions to look for when none is specified (e.g. `@import 'path/to/module'`).
		extensions: [
			'',
			'.js',
			'.json',
			'.coffee',
		],
	},

	// Module settings.
	module: {

		// Module loader plugins.
		loaders: [
			{
				test:   /\.js$/,
				loader: 'babel-loader',
				query:  {
					presets: [
						'es2015',
						'stage-3',
					],
					plugins: [
						'transform-es3-member-expression-literals',
						'transform-es3-property-literals',
					],
				},
			},
			{
				test:   /\.coffee$/,
				loader: 'coffee-loader',
			},
			{
				test:   /\.json$/,
				loader: 'json',
			},
		],
	},

};
