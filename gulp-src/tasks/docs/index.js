/**
 * @module gulp/tasks/docs
 */

// Gulp
const gulp = __require( 'gulp' );

// Tasks
const usage = __requireTask( 'docs/usage' );
const sass  = __requireTask( 'docs/sass' );
const js    = __requireTask( 'docs/js' );
const php   = __requireTask( 'docs/php' );

/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'docs';


// Register the task.
gulp.task( task, gulp.parallel( usage.task, sass.task, js.task, php.task ) );
