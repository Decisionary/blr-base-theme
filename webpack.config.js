
/* eslint-disable */

var path = require( 'path' );

/* eslint-enable */


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
				test:   /\.json?$/,
				loader: 'json',
			},
		],
	},

};
