/**
 * @module gulp/tasks/qa/lint
 */

// Gulp
const gulp = __require( 'gulp' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'qa/lint';


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
 * Gulp callback for `qa/lint` task.
 *
 * @return {Function}
 */
export const callback = () =>
	console.log( 'Lint task - replace with actual code' );


// Register the task.
gulp.task( task, callback );
