/**
 * @module gulp/tasks/default
 */

// Gulp
const gulp = __require( 'gulp' );

// Tasks
__requireTask( 'build' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'default';


// Register the task.
gulp.task( task, gulp.series( 'build' ) );
