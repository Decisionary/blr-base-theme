/**
 * @module gulp/tasks/build/js
 */

// Gulp
const gulp = __require( 'gulp' );

// Files
const size       = __require( 'gulp-size' );
const rename     = __require( 'gulp-rename' );
const concat     = __require( 'gulp-concat' );
const sourcemaps = __require( 'gulp-sourcemaps' );

// JS
const babel  = __require( 'gulp-babel' );
const uglify = __require( 'gulp-uglify' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'build/js';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {
	size: {
		title: 'JS:',
	},
};


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {
	source: [
		'../blr-base-theme/assets/source/js/**/*.js',
		'assets/source/js/**/*.js',
	],
	dest: 'assets/dist/js',
};


/**
 * Gulp callback for `build/js` task.
 *
 * @return {Function}
 */
export const callback = () =>
	gulp.src( files.source )
		.pipe( sourcemaps.init() )
		.pipe( concat( 'app.js' ) )
		.pipe( babel() )
		.pipe( gulp.dest( files.dest ) )
		.pipe( uglify() )
		.pipe( size( config.size ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( sourcemaps.write( './maps' ) )
		.pipe( gulp.dest( files.dest ) );


// Register the task.
gulp.task( task, callback );
