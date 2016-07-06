/**
 * @module gulp/tasks/deps
 */

// Gulp
const gulp = __require( 'gulp' );

// Tasks
const sync = __requireTask( 'deps/sync' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'deps';


// Register the task.
gulp.task( task, gulp.series( sync.task ) );
