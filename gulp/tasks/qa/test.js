/**
 * @module gulp/tasks/qa/test
 */

// Gulp
const gulp = __require( 'gulp' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'qa/test';


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {};


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {};


/**
 * Gulp callback for `qa/test` task.
 *
 * @return {Function}
 */
export const callback = () =>
	console.log( 'Unit test task - replace with actual code' );


// Register the task.
gulp.task( task, callback );
