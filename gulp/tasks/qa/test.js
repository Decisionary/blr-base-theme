/**
 * @module gulp/tasks/qa/test
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
	console.log( 'Unit test task - replace with actual code' );


// Register the task.
gulp.task( 'qa/test', callback );
