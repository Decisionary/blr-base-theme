/**
 * @module gulp/tasks/release
 */

// Gulp
const gulp = __require( 'gulp' );

// Tasks
const build = __requireTask( 'build' );
const docs  = __requireTask( 'docs' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'release';


// Register the task.
gulp.task( task, gulp.series( build.task, docs.task ) );
