/**
 * @module gulp/tasks/build/fonts
 */

// Gulp
const gulp = __require( 'gulp' );

// Utilities
const _ = __require( 'lodash' );


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
		`${ __config.paths.assets.source }/fonts/*`,
	],

	dest: `${ __config.paths.assets.dist }/fonts`,

};

// Includes.
if ( ! _.isEmpty( __config.includes.fonts ) ) {
	files.source = _.concat(
		__config.includes.fonts,
		files.source
	);
}


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
