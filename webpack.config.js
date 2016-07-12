
/* eslint-disable no-var */

var path = require( 'path' );

// Get the path to the `blr-base-theme` folder.
var baseThemePath = (
	'blr-base-theme' === path.basename( process.cwd() )
	? process.cwd()
	: path.resolve( '../blr-base-theme' )
);


module.exports = {

	context: path.join( __dirname, 'assets/source/js' ),

	entry: {
		frontend: './frontend',
		admin:    './admin',
	},

	output: {
		path:          path.join( __dirname, 'assets/dist/js' ),
		filename:      '[name].js',
		chunkFilename: '[name].chunk.js',
	},

	module: {
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
				test:   /\.json?$/,
				loader: 'json',
			},
		],
		resolve: {
			extensions: [
				'',
				'.js',
				'.json',
				'.coffee',
			],
		},
	},

};
