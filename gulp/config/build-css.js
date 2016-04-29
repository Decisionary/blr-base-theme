/**
 * @module gulp/config/build-css
 */

export default {

	sass: {
		outputStyle:  'expanded',
		precision:    10,
		includePaths: [
			'bower_components',
			'node_modules',
		],
	},

	autoprefixer: {
		browsers: [
			'last 2 versions',
			'android 4',
			'opera 12',
			'ie > 8',
			'> 1%',
		],
	},

};
