/**
 * @module gulp/tasks/qa/travis
 */

// Gulp
const gulp = __require( 'gulp' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'qa/travis';


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
 * Gulp callback for `qa/travis` task.
 *
 * @return {Function}
 */
export const callback = () =>
	console.log( 'Travis-CI task - replace with actual code' );


// Register the task.
gulp.task( task, callback );
