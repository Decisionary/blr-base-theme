/**
 * @module gulp/tasks/build/fonts
 */

// Gulp
const gulp = __require( 'gulp' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'build/fonts';


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {
	source: [
		'assets/source/fonts/*',
		'bower_components/font-awesome/fonts/fontawesome-webfont.*',
	],
	dest: 'assets/dist/fonts',
};


/**
 * Gulp callback for `build/fonts` task.
 *
 * @return {Function}
 */
export const callback = () =>
	gulp.src( files.source )
		.pipe( gulp.dest( files.dest ) );


// Register the task.
gulp.task( task, callback );
