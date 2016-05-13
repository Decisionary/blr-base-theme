/**
 * @module gulp/tasks/qa/travis
 */

// Gulp
const gulp = __require( 'gulp' );


// Task files.
export const files = {};


/**
 * Gulp callback for `build/fonts` task.
 *
 * @return {Function}
 */
export const callback = () =>
	console.log( 'Travis-CI build task - replace with actual code' );


// Register the task.
gulp.task( 'qa/travis', callback );
