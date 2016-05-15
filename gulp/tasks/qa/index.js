/**
 * @module gulp/tasks/qa
 */

// Gulp
const gulp = __require( 'gulp' );

// Tasks
const lint   = __requireTask( 'qa/lint' );
const test   = __requireTask( 'qa/test' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'qa';


// Register the task.
gulp.task( task, gulp.parallel( lint.task, test.task ) );
