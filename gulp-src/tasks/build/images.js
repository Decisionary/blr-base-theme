/**
 * @module gulp/tasks/build/images
 */

// Gulp
const gulp = __require( 'gulp' );

// Files
const size = __require( 'gulp-size' );

// Images
const imagemin = __require( 'gulp-imagemin' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'build/images';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {
	size: {
		title: 'Images:',
	},
};


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {
	source: [
		'../blr-base-theme/assets/source/images/*',
		'assets/source/images/*',
	],
	dest: 'assets/dist/images',
};


/**
 * Gulp callback for `build/images` task.
 *
 * @return {Function}
 */
export const callback = () =>
	gulp.src( files.source )
		.pipe( imagemin() )
		.pipe( size( config.size ) )
		.pipe( gulp.dest( files.dest ) );


// Register the task.
gulp.task( task, callback );
