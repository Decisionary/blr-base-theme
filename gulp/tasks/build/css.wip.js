/**
 * @module gulp/tasks/build/css
 */

// Gulp
const gulp = __require( 'gulp' );

// Files
const size       = __require( 'gulp-size' );
const rename     = __require( 'gulp-rename' );
const concat     = __require( 'gulp-concat' );
const sourcemaps = __require( 'gulp-sourcemaps' );

// CSS / Sass
const sass    = __require( 'gulp-sass' );
// const postcss = __require( 'gulp-postcss' );

/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'build/css-wip';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {

	sass: {
		outputStyle:  'expanded',
		precision:    10,
		includePaths: [
			'../blr-base-theme/assets/source/css',
			'bower_components',
			'node_modules',
		],
	},

	// postcss: {
	// 	plugins: [
	// 		__require( 'rucksack-css' ),
	// 		__require( 'postcss-cssnext' ),
	// 		__require( 'postcss-assets' ),
	// 		__require( 'postcss-flexibility' ),
	// 		__require( 'postcss-font-awesome' ),
	// 		__require( 'postcss-font-variant' ),
	// 		__require( 'postcss-single-charset' ),
	// 		__require( 'postcss-em-media-query' ),
	// 		__require( 'postcss-nested-ancestors' ),
	// 		__require( 'postcss-pseudo-class-any-button' ),
	// 		__require( 'postcss-pseudo-content-insert' ),
	// 		__require( 'css-mqpacker' ),
	// 		__require( 'pixrem' ),
	// 		__require( 'doiuse' ),
	// 	],
	// 	pluginsMinify: [
	// 		__require( 'cssnano' ),
	// 	],
	// },

	autoprefixer: {
		browsers: [
			'last 2 versions',
			'android 4',
			'opera 12',
			'ie > 8',
			'> 1%',
		],
	},

	size: {
		title: 'Sass:',
	},

};


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {
	watch:  'assets/source/css/**/*.scss',
	source: [
		'assets/source/css/**/*.scss',
		'!assets/source/css/**/_*.scss',
	],
	dest: 'assets/dist/css/',
};


/**
 * Gulp callback for `build/css` task.
 *
 * @return {Function}
 */
export const callback = () =>
	gulp.src( files.source )
		.pipe( sourcemaps.init() )
		.pipe( sass( config.sass ) )
		.pipe( postcss( config.postcss.plugins ) )
		.pipe( concat( 'app.css' ) )
		.pipe( gulp.dest( files.dest ) )
		.pipe( postcss( config.postcss.pluginsMinify ) )
		.pipe( size( config.size ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( sourcemaps.write( './maps' ) )
		.pipe( gulp.dest( files.dest ) );


// Register the task.
gulp.task( task, callback );
